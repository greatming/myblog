<?php

/**
 * This is the model class for table "article_tags".
 *
 * The followings are the available columns in table 'article_tags':
 * @property integer $id
 * @property integer $article_id
 * @property integer $tag_id
 * @property string $tag_name
 * @property string $create_time
 */
class ArticleTags extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'article_tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article_id, tag_id', 'numerical', 'integerOnly'=>true),
			array('tag_name', 'length', 'max'=>45),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, article_id, tag_id, tag_name, create_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'article_id' => 'Article',
			'tag_id' => 'Tag',
			'tag_name' => 'Tag Name',
			'create_time' => 'Create Time',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('article_id',$this->article_id);
		$criteria->compare('tag_id',$this->tag_id);
		$criteria->compare('tag_name',$this->tag_name,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ArticleTags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getArticleListPageByTag($tag){
        $criteria = new CDbCriteria();
        $criteria->compare('is_del',0);
        $criteria->compare('tag_name',$tag);
        $count=self::model()->count($criteria);
        $article_list = array();
        $pages=new CPagination($count);
        $pages->pageSize=ArticleVars::SEARCH_TAGS_LIMIT;
        $pages->applyLimit($criteria);
        $list = self::model()->findAll($criteria);
        foreach($list as $item){
            $article_data = Article::model()->findByPk($item->article_id);
            array_push($article_list,$article_data);
        }
        return array($article_list,$pages);
    }
}
