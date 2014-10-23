<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/10/4
 * Time: 19:50
 */

class PublicController extends BaseController{

    public function actionLogin(){
        $this->actionTitle = "登录";
        $this->renderPartial("login");
    }

    public function actionSLogin(){
        $model = new UserForm("login");
        $model->attributes=$_POST['LoginForm'];
        if($model->validate()){
            $model->saveUserLoginData();
            $this->ajaxReturn(1,"登录成功");
        }else{
            $info = $model->getErrors();
            $this->ajaxReturn(0,$info);
        }
    }

    public function actionSLogout(){
        $model = new UserForm();
        $model->logoutUser();
    }

}