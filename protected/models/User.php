<?php

Yii::import('application.models._base.BaseUser');

class User extends BaseUser
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function rules() {
		return array(
				array('username, password, name, email, createddate', 'required'),
				array('active', 'numerical', 'integerOnly'=>true),
				array('username, name, company, email, permission', 'length', 'max'=>255),
				array('password', 'length', 'max'=>70),
				array('company, active', 'default', 'setOnEmpty' => true, 'value' => null),
				array('user_id, username, password, name, company, email, active, permission, createddate', 'safe', 'on'=>'search'),
				array('email,username','unique', 'className' => 'User'),
		);
	}
}