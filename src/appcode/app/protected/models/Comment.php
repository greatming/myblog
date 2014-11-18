<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/10/29
 * Time: 16:56
 */

class Comment extends EMongoDocument
{
    public $user_name;
    public $pid;
    public $status;
    public $create_time;
    public $content;


    // This has to be defined in every model, this is same as with standard Yii ActiveRecord
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    // This method is required!
    public function getCollectionName()
    {
        return 'comment';
    }

    public function rules()
    {
        return array(

        );

    }

    public function attributeLabels()
    {
        return array(
            'user_name'  => 'User Name',
            'pid'   => 'Pid',
            'status'   => 'Status',
            'create_time' => 'Create Time',
            'content'   => 'Content'
        );
    }
}