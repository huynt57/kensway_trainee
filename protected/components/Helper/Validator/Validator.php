<?php
class Validator{
	public static function validatePostParam($postParams, $isNumber = false){
		if(isset($_POST[$postParams])){
			return $_POST[$postParams];
		}

		if(!$isNumber){
			return '';
		}
		else{
			return 0;
		}
	}
	
	public static function getError($errors){
		$errorString = '';
		foreach($errors as $error)
		{
			$errorString .= $error[0].'</br>';
		}
		return $errorString;
	}
	
	public static function getFirstError($errors){
		$errorString = '';
		foreach($errors as $error)
		{
			$errorString = $error[0];
		}
		return $errorString;
	}
	
	public static function validateUsername($value){
		if ( preg_match('/\s/',$value)) {
			return 'Username cannot contain space';
		}
		
		if(!$value){
			return 'Username cannot empty';
		}
		
		if(strlen($value) < 5){
			return 'Username too short';
		}
		return null;
	}
        
        public static function validateCategoryname($value){
		if ( preg_match('/\s/',$value)) {
			return 'Category name cannot contain space';
		}
		
		if(!$value){
			return 'Category name cannot empty';
		}
		
		if(strlen($value) < 5){
			return 'Categoryname too short';
		}
		return null;
	}
}