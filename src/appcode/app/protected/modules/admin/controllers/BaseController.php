<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/10/4
 * Time: 17:19
 */

class BaseController extends Controller{

    public  $layout = '/layouts/main';

    public $appName;

    public $actionTitle;

    private $_oLoginController = array(
        "public"
    );

    public function init(){
        if(!in_array($this->getId(),$this->_oLoginController)){
            if(!$this->checkLogin()){
                $this->redirect(array("public/login"));
            }
            $this->_renderDefault();
        }

    }
    private function _renderDefault(){
        $this->appName = "后台管理系统";
        $this->assignParams(array("user_info"=>$this->getUserInfo()));
        $this->assignParams(array("menu"=>Yii::app()->controller->module->menu));
        $this->assignParams(array("channel_name"=>$this->channelName));
    }

    public function ajaxReturn($status,$info = "",$data = array()){
        echo json_encode(array("status"=>$status,"info"=>$info,"data"=>json_encode($data)));
    }

    public function checkLogin(){
        $user_model = new UserForm();
        $user_info = $user_model->getUserLoginData();
        if($user_info){
            return true;
        }else{
            return false;
        }
    }

    public function getUserInfo(){
        $user_model = new UserForm();
        $user_info = $user_model->getUserLoginData();
        return ($user_info) ? $user_info : array();
    }

    public function assignParams($array){
        foreach($array as $key => $value){
            Yii::app()->params[$key] = $value;
        }
    }

    public function setActionName($name = ""){
        $this->assignParams(array("action_name"=>$name));
    }

} 