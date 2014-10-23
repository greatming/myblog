<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $username
 * @property string $password
 * @property string $create_time
 * @property integer $id
 */
class UserForm extends CFormModel
{
    const LOGIN_KEY = "user_info";
    public $username;
    public $password;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('username', 'length', 'max'=>16),
			array('password', 'length', 'max'=>32),
            array('password', 'authenticate', 'on'=>'login'),

		);
	}


    public function authenticate($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $identity = new UserIdentity($this->username,$this->password);
            if(!$identity->authenticate())
                $this->addError('password','Incorrect username or password.');
        }
    }


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'username' => 'Username',
			'password' => 'Password',
			'create_time' => 'Create Time',
			'id' => 'ID',
		);
	}

    public function getUserId($username){
        $connection = Yii::app()->db;
        $sql = "select id from user where username = :username limit 1";
        $command = $connection->createCommand($sql);
        $command->bindParam(":username",$username,PDO::PARAM_STR);
        return $command->queryScalar();
    }


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function saveUserLoginData(){
        $session_obj = new SessionManager();
        $user_id = $this->getUserId($this->username);
        $user_info = array("id"=>$user_id,"user_name"=>$this->username);
        $session_obj->setSession(self::LOGIN_KEY,$user_info);
    }

    public function logoutUser(){
        $session_obj = new SessionManager();
        $session_obj->delSession(self::LOGIN_KEY);
        $session_obj->clearSession();
        $session_obj->destroySession();
    }

    public function getUserLoginData(){
        $session_obj = new SessionManager();
        return $session_obj->getSession(self::LOGIN_KEY);
    }
}
