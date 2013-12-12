<?php

Yii::import('application.models._base.BaseCategory');

class Category extends BaseCategory
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function rules() {
		return array(
                        array('name', 'required'),
			array('order, active', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('order, active', 'default', 'setOnEmpty' => true, 'value' => null),
			array('category_id, name, order, active', 'safe', 'on'=>'search'),
                        array('name','unique', 'className' => 'Category'),
		);
	}
}