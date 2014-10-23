<?php

class IndexController extends BaseController
{
    public $channelName = "内容管理";
    public $actionId;
	public function actionIndex(){
        $this->setActionName();
        $this->render('index');
	}

    public function actionArticle(){
        $this->setActionName("文章管理");
        $this->render('article');
    }

    public function actionAddArticle(){
        $this->setActionName("添加文章");
        $tags_model = new Tags();
        $this->render('addarticle',array("tags_list"=>$tags_model->findAll()));
    }

    public function actionEditArticle(){
        $this->setActionName("编辑文章");
        $article_model = new Article();
        $article_data = $article_model->getArticleInfoById($_GET['id']);
        $this->render('editarticle',array("article_data"=>$article_data));
    }

    public function actionSeditArticle(){
        $article_model = new Article();
        $ret = $article_model->editArticleProcess($_POST);
        if($ret['success']){
            $this->ajaxReturn(1,"添加成功!");
        }else{
            $this->ajaxReturn(0,$ret['info']);
        }
    }

    public function actionSaddArticle(){
        $article_model = new Article();
        $ret = $article_model->addArticleProcess($_POST);
        if($ret['success']){
            $this->ajaxReturn(1,"添加成功!");
        }else{
            $this->ajaxReturn(0,$ret['info']);
        }
    }

    public function actionTags(){
        $this->setActionName("标签管理");
        $tags_model = new Tags();
        $this->render("tags",array("tags_list"=>$tags_model->findAll()));
    }

    public function actionSaddTag(){
        $tags_model = new Tags();
        extract($_POST);
        $tags_model->name = trim($name);
        if($tags_model->save()){
            $this->ajaxReturn(1,"添加成功!",array("id"=>$tags_model->id));
        }else{
            $this->ajaxReturn(0,"添加失败");
        }
    }

    public function actionSdelTag(){
        $id = $_POST['id'];
        $tags_model=Tags::model()->findByPk($id);
        if($tags_model->delete()){
            $this->ajaxReturn(1,"删除成功!");
        }else{
            $this->ajaxReturn(0,"删除失败");
        }
    }

}