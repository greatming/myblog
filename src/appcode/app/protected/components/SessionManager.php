<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/10/11
 * Time: 22:28
 */

class SessionManager {

    private  $_sessionObj;

    public function __construct(){
        $this->_sessionObj = Yii::app()->session;
    }

    public function setSession($key,$data){
        $this->_sessionObj[$key] = $data;
    }

    public function getSession($key){
        if(isset($this->_sessionObj[$key])){
            return $this->_sessionObj[$key];
        }else{
            return false;
        }
    }

    public function delSession($key){
        if(isset($this->_sessionObj[$key])){
            unset($this->_sessionObj[$key]);
        }
        return true;
    }

    public function clearSession(){
        Yii::app()->session->clear();
    }

    public function destroySession(){
        Yii::app()->session->destroy();
    }
} 