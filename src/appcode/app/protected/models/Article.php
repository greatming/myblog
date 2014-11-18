<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $tags
 * @property string $thumbnail_url
 * @property integer $browse_count
 * @property string $author
 * @property string $create_time
 * @property integer $is_repost
 * @property integer $is_del
 */
class Article extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */

    public $addi;

    public function tableName()
    {
        return 'article';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('browse_count, is_repost, is_del', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 100),
            array('description', 'length', 'max' => 200),
            array('thumbnail_url', 'length', 'max' => 200),
            array('author', 'length', 'max' => 45),
            array('tags', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, description, tags, thumbnail_url, browse_count, author, create_time, is_repost, is_del', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'tags' => 'Tags',
            'thumbnail_url' => 'Thumbnail Url',
            'browse_count' => 'Browse Count',
            'author' => 'Author',
            'create_time' => 'Create Time',
            'is_repost' => 'Is Repost',
            'is_del' => 'Is Del',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('tags', $this->tags, true);
        $criteria->compare('thumbnail_url', $this->thumbnail_url, true);
        $criteria->compare('browse_count', $this->browse_count);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('is_repost', $this->is_repost);
        $criteria->compare('is_del', $this->is_del);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function addArticleProcess($data)
    {
        if (!$data['title']) {
            return array("success" => false, "info" => "请输入标题");
        }
        if (count($data['select_tags']) < 1) {
            return array("success" => false, "info" => "请最少选择一个标签");
        }
        if (!$data['content']) {
            return array("success" => false, "info" => "请输入内容");
        }
        if ($this->_addArticle($data)) {
            return array("success" => true);
        } else {
            return array("success" => false, "info" => "添加失败");
        }
    }

    public function editArticleProcess($data)
    {
        if (!$data['title']) {
            return array("success" => false, "info" => "请输入标题");
        }
        if (!$data['content']) {
            return array("success" => false, "info" => "请输入内容");
        }
        if ($this->_editArticle($data)) {
            return array("success" => true);
        } else {
            return array("success" => false, "info" => "添加失败");
        }
    }

    private function _addArticle($data)
    {
        $this->title = $data['title'];
        $this->description = ($data['description']) ? $data['description'] : mb_substr(addslashes(strip_tags($data['content'])), 0, 100, 'utf-8');
        $tags_data = $this->_getArticleTagData($data['select_tags']);
        $this->tags = json_encode($tags_data);
        $this->thumbnail_url = str_replace(Yii::app()->request->hostInfo, "", $data['thumbsrc']);
        $this->browse_count = 0;
        $this->author = $data['author'];
        $this->is_repost = $data['is_repost'];
        $this->is_del = 0;
        if ($this->save()) {
            //添加文章附表
            $this->_addArticleAddi($this->id, $data['content']);
            //添加文章标签关系表 和更新 tags表belong_num字段
            $this->_addArticleAndTagsRelated($this->id, $tags_data);
            return true;
        } else {
            var_dump($this->getErrors());
        }
        return false;
    }

    private function _editArticle($data)
    {
        //TODO 暂不更新tags
        $update_attributes = array(
            "title" => $data['title'],
            "description" => $data['description'],
            "thumbnail_url" => str_replace(Yii::app()->request->hostInfo, "", $data['thumbsrc']),
            "author" => $data['author'],
            "is_repost" => $data['is_repost']
        );
        self::model()->updateByPk($data['id'], $update_attributes);
        if (count($this->getErrors()) < 1) {
            //添加文章附表
            $article_addi_model = new ArticleAddi();
            $article_addi_model->updateAll(array("content" => $data['content']), "article_id=" . $data['id']);
            return true;
        } else {
            return false;
        }
    }

    public function getArticleInfoById($id)
    {
        $article_data = self::model()->findByPk($id);
        $article_data->addi = ArticleAddi::model()->findByAttributes(array("article_id" => $article_data->id));
        return $article_data;
    }

    private function _getArticleTagData($name)
    {
        $tags_data = array();
        if (is_array($name)) {
            foreach ($name as $item) {
                $tag_obj = Tags::model()->findByAttributes(array("name" => $item));
                array_push($tags_data, array("id" => $tag_obj->id, "name" => $item));
            }
        }
        return $tags_data;
    }

    private function _addArticleAddi($article_id, $content)
    {
        $article_addi_model = new ArticleAddi();
        $article_addi_model->article_id = $article_id;
        $article_addi_model->content = $content;
        if ($article_addi_model->save()) {
            return true;
        } else {
            return false;
        }
    }

    //添加文章标签关系表 和更新 tags表belong_num字段
    private function _addArticleAndTagsRelated($article_id, $tags_data)
    {
        foreach ($tags_data as $tag) {
            $article_tag_model = new ArticleTags();
            $article_tag_model->article_id = $article_id;
            $article_tag_model->tag_id = $tag['id'];
            $article_tag_model->tag_name = $tag['name'];
            $article_tag_model->save();
            Tags::model()->updateCounters(array('belong_num' => 1), "id=" . $tag['id']);
        }
        return true;
    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Article the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getArticleList($limit = PHP_INT_MAX, $start = 0)
    {
        $article_list = Article::model()->findAll("is_del=:is_del order by id desc limit :start,:limit",
            array(':is_del' => 0, ":start" => $start, ":limit" => $limit));
        return CommonHelper::formatArrayData($article_list);
    }

    public function getArticleListPage(){
        $criteria = new CDbCriteria();
        $criteria->compare('is_del',0);
        $count=self::model()->count($criteria);
        $article_list = array();
        $pages=new CPagination($count);
        $pages->pageSize=ArticleVars::MORE_TAGS_LIMIT;
        $pages->applyLimit($criteria);
        $list = self::model()->findAll($criteria);
        foreach($list as $item){
            array_push($article_list,$item);
        }
        return array($article_list,$pages);
    }

}
