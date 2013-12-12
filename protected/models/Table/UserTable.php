<?php
Yii::import('application.models.User');

class UserTable
{
	public function listUser(){
		return User::model()->findAll();
	}
	
	public function userWithId($id){
		return User::model()->find('user_id=:userid', array(':userid'=>$id));
	}
	
	public function userWithEmail($email){
		return User::model()->find('email=:email', array(':email'=>$email));
	}
	
	public function createUser($data){
		$newUser = new User;
		
		$newUser->setAttributes($data,true);
		$newUser->createddate = DateTimeHelper::date();
		
		$result = array();
		
		$usernameValidator = Validator::validateUsername($newUser->username);
		if($usernameValidator){
			$result['result'] = false;
			$result['message'] = $usernameValidator;
			return $result;
		}
		
		if($newUser->save()){
			$result['result'] = true;
			$result['message'] = '';
		}
		else{
			$errors = $newUser->getErrors();
			$result['result'] = false;
			$result['message'] = Validator::getFirstError($errors);
		}
		
		return $result;
	}
	
	public function updateUser($user, $data){
		$user->setAttributes($data,true);
		
		$result = array();
		
		if($user->save()){
			$result['result'] = true;
			$result['message'] = '';
		}
		else{
			$errors = $user->getErrors();
			$result['result'] = false;
			$result['message'] = Validator::getFirstError($errors);
		}
		
		return $result;
	}
	
	public function deleteUserWithId($userId){
		$user=User::model()->findByPk($userId);
		
		$result = array();
		if($user){
			$user->delete();
			$result['result'] = true;
			$result['message'] = '';
		}
		else{
			$result['result'] = false;
			$result['message'] = 'User not existed';
		}
		
		return $result;
	}
	
	public function getPagination($sortField = 'user_id', $isASC = true, $rowNumber = 0, $currentPage = 0, $searchString = null){
		
		$criteria = new CDbCriteria();
		
		if($sortField == ''){
			$sortField = 'user_id';
		}
       	
       	if(!$isASC){
       		$criteria->order = $sortField . ' DESC';
       	}
       	else{
       		$criteria->order = $sortField;
       	}
       	if($searchString){
       		foreach ($searchString as $searchData) {
       			$searchType = $searchData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_TYPE']];
       			$searchValue = $searchData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_VALUE']];
       			$searchModel = $searchData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_MODEL_NAME']];
       			switch($searchType){
       				case Yii::app()->params['SEARCH_INPUT_TYPE_TEXT']:
       					{
       						$criteria->addCondition("$searchModel LIKE '%".$searchValue."%'",'AND');
       					}
       					break;
       				case Yii::app()->params['SEARCH_INPUT_TYPE_BOOL']:
       					{
       						if($searchValue == 'true'){
       							$criteria->addCondition("$searchModel = 1",'AND');
       						}
       						else{
       							$criteria->addCondition("$searchModel = 0",'AND');
       						}
       							
       					}
       					break;
       				case Yii::app()->params['SEARCH_INPUT_TYPE_DATE_UPPER']:
       					{
       						$criteria->addCondition("$searchModel <= '".DateTimeHelper::convertToCommonDateTimeFormatWithEndOfDay($searchValue)."'","AND");
       					}
       					break;
       				case Yii::app()->params['SEARCH_INPUT_TYPE_DATE_LOWER']:
       					{
       						$criteria->addCondition("$searchModel >= '".DateTimeHelper::convertToCommonDateTimeFormatWithEndOfDay($searchValue)."'","AND");
       					}
       					break;
       				default:
       					break;
       			}
       		}
       	}
       	
       	$item_count = User::model()->count($criteria);
       	
       	if($rowNumber == 0){
       		$pageSize = Yii::app()->params['NUMBER_ENTITY_PER_PAGE_DEFAULT'];
       	}
       	else{
       		$pageSize = $rowNumber;
       	}
       	
       	if($rowNumber == -1){
       		$pageSize = $item_count;
       	}
                
        $pages = new CPagination($item_count);
        $pages->setPageSize($pageSize);
        $pages->setCurrentPage($currentPage);
        $pages->applyLimit($criteria);  // the trick is here!
        return array(
                        Yii::app()->params['PAGINATION_MODEL']=> User::model()->findAll($criteria), // must be the same as $item_count
		                Yii::app()->params['PAGINATION_PAGE']=>$pages,
		                Yii::app()->params['PAGINATION_ITEM_COUNT']=>$item_count,
        );
	}
	
	public function parsePermissions($permissions){
		$permissionValue = '';
		$counter = 0;
		foreach ($permissions as $permission){
			$counter++;
			if($counter != count($permissions)){
				$permissionValue .= $permission . '|';
			}
			else{
				$permissionValue .= $permission;
			}
		}
		return $permissionValue;
	}
}