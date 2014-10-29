<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/10/4
 * Time: 16:45
 */
class IndexController extends BaseController
{

    public function actionIndex()
    {
        $article_model = new Article();
        $article_list = $article_model->getArticleList(ArticleVars::HOME_ARTICLE_lIMIT);
        $tags_model = new Tags();
        $tags_list = $tags_model->getTagsList(ArticleVars::HOME_TAGS_lIMIT);
        $this->render('index', array(
            "article_list" => json_encode($article_list),
            "tags_list" => json_encode($tags_list)
        ));
    }

    public function actionTags(){
        $tags_model = new Tags();
        $tags_list = $tags_model->getTagsList();
        $this->render('tags', array(
            "tags_list" => $tags_list
        ));
    }

    public function actionSearch(){
        $tag = HttpHeler::getGET("tag","all");
        $articletags_model = new ArticleTags();
        list($article_list,$page) = $articletags_model->getArticleListPageByTag($tag);
        $this->render('search', array(
            "article_list" => $article_list,
            "page" => $page
        ));
    }

    public function actionDetail($id){
        $artitle_model = new Article();
        $artitle_data = $artitle_model->getArticleInfoById($id);
        $this->render('detail', array(
            "artitle_data" => $artitle_data,
        ));
    }

    public function actionTest(){
        $comment_model  = new Comment();
        $comment_model->user_name = 'hmreal';
        $comment_model->status = 0;
        $comment_model->pid = 0;
        $comment_model->create_time = time();
        $ret = $comment_model->save();
//        $aa = new ArticleAddi();
//        $aa->article_id = 2;
//        $aa->content = '111';
//        $aa->save();
    }


}