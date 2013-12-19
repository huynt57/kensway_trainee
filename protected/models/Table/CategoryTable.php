<?php
Yii::import('application.models.Category');

class CategoryTable
{
	public function listCategory(){
		return Category::model()->findAll();
	}
	
	public function categoryWithId($id){
		return Category::model()->find('category_id=:categoryid', array(':categoryid'=>$id));
	}
	
	public function createCategory($data){
		$newCategory = new Category;
		
		$newCategory->setAttributes($data,true);
		
		
		$result = array();
		
		$categorynameValidator = Validator::validateCategoryname($newCategory->name);
		if($categorynameValidator){
			$result['result'] = false;
			$result['message'] = $categorynameValidator;
			return $result;
		}
		
		if($newCategory->save()){
			$result['result'] = true;
			$result['message'] = '';
		}
		else{
			$errors = $newCategory->getErrors();
			$result['result'] = false;
			$result['message'] = Validator::getFirstError($errors);
		}
		
		return $result;
	}
	
	public function updateCategory($category, $data){
		$category->setAttributes($data,true);
		
		$result = array();
		
		if($category->save()){
			$result['result'] = true;
			$result['message'] = '';
		}
		else{
			$errors = $category->getErrors();
			$result['result'] = false;
			$result['message'] = Validator::getFirstError($errors);
		}
		
		return $result;
	}
	
	public function deleteCategoryWithId($categoryId){
		$category=  Category::model()->findByPk($categoryId);
		
		$result = array();
		if($category){
			$category->delete();
			$result['result'] = true;
			$result['message'] = '';
		}
		else{
			$result['result'] = false;
			$result['message'] = 'User not existed';
		}
		
		return $result;
	}
	
	public function getPagination($sortField = 'category_id', $isASC = true, $rowNumber = 0, $currentPage = 0, $searchString = null){
		
		$criteria = new CDbCriteria();
		
		if($sortField == ''){
			$sortField = 'category_id';
		}
       	
       	if(!$isASC){
       		$criteria->order = '`'.$sortField.'`' . ' DESC';
       	}
       	else{
       		$criteria->order = '`'.$sortField.'`';
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
                                case Yii::app()->params['SEARCH_INPUT_TYPE_NUMBER']:
       					{
       						$criteria->addCondition("$searchModel = $searchValue");
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
       	
       	$item_count = Category::model()->count($criteria);
       	
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
                        Yii::app()->params['PAGINATION_MODEL']=> Category::model()->findAll($criteria), // must be the same as $item_count
		                Yii::app()->params['PAGINATION_PAGE']=>$pages,
		                Yii::app()->params['PAGINATION_ITEM_COUNT']=>$item_count,
        );
	}
}