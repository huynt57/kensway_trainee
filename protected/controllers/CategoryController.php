<?php
Yii::import('application.models.Table.CategoryTable');

class CategoryController extends GxController {

	public $navigationSelectedIndex;
	public $headerTitle;
	public $categoryTable;
	
	public $administratorTable = null;
	
	public $administratorTablePaginator = null;
	
	public $sortTblAdministrator = 'category_id';
	
	public $sortOrderTblAdministrator = true;
	
	public $tblAdministratorNumberOfEntities = 10;
	
	public $tblAdministratorCurrentPage = 0;
	
	public $tblAdministratorSearchString = null;
	
	protected function beforeAction($event)
	{
		if(Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->createUrl('Site/'));
			return;
		}
		
		$this->navigationSelectedIndex = Yii::app()->params['NAV_CATEGORY_MANAGER_INDEX'];
		$this->headerTitle = 'Category Manager';
		$this->categoryTable = new CategoryTable();
		return true;
	}
         
         

	public function actionView() {
		if (isset($_POST['objectId']) && isset($_POST['tblId'])){
			$objectId = $_POST['objectId'];
		
			$administrator = $this->categoryTable->categoryWithId($objectId);
			if(!empty($administrator)){
				$html = $this->renderPartial('view', array('administrator' => $administrator), true, true);
				
				$result = CJSON::encode ( array (
						'modalData' => $html,
						'tblId' => $_POST['tblId'],
						'success' => true
				) );
			}
			else{
				$result = CJSON::encode ( array (
						'success' => false
				) );
			}
			
		}
		else {
			$result = CJSON::encode ( array (
					'success' => false
			) );
		}
		
		echo $result;
	}
	
	public function actionRefresh(){
		if (isset($_POST['tblId'])){
			$this->getAjaxPostData();
			 
			$result = CJSON::encode ( array (
					'tblData' => $this->renderAdministratorTable (),
					'tblId' => $_POST['tblId'],
					'success' => true
			) );
		}
		else{
			$result = CJSON::encode ( array (
					'success' => false
			) );
		}
		 
		echo $result;
	}

	public function actionCreate() {
		$data = array();
		$data['name'] = Yii::app()->request->getPost('administrator_categoryname', '');
		$data['order'] = Yii::app()->request->getPost('administrator_order', '');
		$data['active'] = Yii::app()->request->getPost('administrator_active', 0);
		
		$createResult = $this->categoryTable->createCategory($data);
		
		if($createResult){
			if($createResult['result']){
				$result = CJSON::encode ( array (
						'tblData' => $this->renderAdministratorTable (),
						'tblPaginator' => $this->renderAdministratorTablePaginator (),
						'success' => true
				) );
			}
			else{
				$result = CJSON::encode ( array (
							'success' => false,
							'message' => "Cannot create new category. An error has occurred : ".$createResult['message'],
					) );
			}
		}
		else{
			$result = CJSON::encode ( array (
					'success' => false,
					'message' => "Cannot create new user. An error has occurred.",
			) );
		}
		
		echo $result;
	}

	public function actionUpdate() {
		if (isset($_POST['objectId']) && isset($_POST['tblId'])){
			$objectId = Yii::app()->request->getPost('objectId', '');
			
			$category = $this->categoryTable->categoryWithId($objectId);
			
			if($category){
				$result = CJSON::encode ( array (
            				'administrator_id' => (!empty($category->category_id)) ? $category->category_id : '0',
            				'administrator_categoryname' => (!empty($category->name)) ? $category->name : '',
            				'administrator_order' => (!empty($category->order)) ? $category->order : '',
            				'administrator_active' => (!empty($category->active)) ? $category->active : '0',
            				'success' => true
            		) );
			}
			else{
				$result = CJSON::encode ( array (
					'success' => false,
					'message' => 'Cannot find this category.'
			) );
			}
		}
		else {
			$result = CJSON::encode ( array (
					'success' => false,
					'message' => 'Cannot find this category. The input parameters are invalid'
			) );
		}
			 
		echo $result;
	}
	
	public function actionSubmitUpdate(){
		if(isset($_POST['administrator_id'])){
			$category = $this->categoryTable->categoryWithId($_POST['administrator_id']);
			
			if($category){
				$data = array();
				$data['name'] = Yii::app()->request->getPost('administrator_name', '');
				$data['active'] = Yii::app()->request->getPost('administrator_active', 0);
				
				$updateResult = $this->categoryTable->updateCategory($category, $data);
				
				if($updateResult){
					if($updateResult['result']){
						$result = CJSON::encode ( array (
								'tblData' => $this->renderAdministratorTable (),
								'tblPaginator' => $this->renderAdministratorTablePaginator (),
								'success' => true
						) );
					}
					else{
						$result = CJSON::encode ( array (
								'success' => false,
								'message' => "Cannot update user information. An error has occurred : ".$updateResult['message'],
						) );
					}
				}
				else{
					$result = CJSON::encode ( array (
							'success' => false,
							'message' => "Cannot update user information. An error has occurred.",
					) );
				}
			}
			else{
				$result = CJSON::encode ( array (
						'success' => false,
						'message' => 'Cannot find this user.'
				) );
			}
		}
		else {
			$result = CJSON::encode ( array (
					'success' => false,
					'message' => 'Cannot update this user. The input parameters are invalid'
			) );
		}
		
		echo $result;
	}

	public function actionDelete() {
		if (isset($_POST['objectId']) && isset($_POST['tblId'])){
			$objectId = Yii::app()->request->getPost('objectId', '');
			
			$deleteResult = $this->categoryTable->deleteCategoryWithId($objectId);
			
			if($deleteResult){
				if($deleteResult['result']){
					$result = CJSON::encode ( array (
							'message' => 'User was deleted',
    						'success' => true
					) );
				}
				else{
					$result = CJSON::encode ( array (
								'success' => false,
								'message' => "Cannot change user password. An error has occurred : ".$deleteResult['message'],
						) );
				}
			}
			else{
				$result = CJSON::encode ( array (
						'success' => false,
						'message' => "Cannot change user password. An error has occurred.",
				) );
			}
		}
		else {
			$result = CJSON::encode ( array (
					'success' => false,
					'message' => 'Fail to delete this user. The input parameters are invalid'
			) );
		}
			 
		echo $result;
	}

	public function actionIndex() {
		
		$paginationData = $this->categoryTable->getPagination();
		
		$dataProvider = new CActiveDataProvider('Category');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
			'paginationData' => $paginationData,
		));
	}
	
	public function actionSort(){
		if (isset($_POST['tblSortField']) && isset($_POST['tblId'])){
			$this->getAjaxPostData();
			 
			$result = CJSON::encode(array(
					'tblData' => $this->renderAdministratorTable (),
					'tblId' => $_POST['tblId'],
					'success' => true
			));
		} else {
			$result = CJSON::encode(array(
					'success' => false
			));
		}
		
		echo $result;
	}
	
	public function actionChangeEntityNumber(){
		if (isset($_POST['tbnNumberOfEntities']) && isset($_POST['tblId'])){
			$this->getAjaxPostData();
	
			$result = CJSON::encode(array(
					'tblData' => $this->renderAdministratorTable (),
					'tblPaginator' => $this->renderAdministratorTablePaginator (),
					'tblId' => $_POST['tblId'],
					'success' => true
			));
		} else {
			$result = CJSON::encode(array(
					'success' => false
			));
		}
	
		echo $result;
	}
	
	public function actionPaging()
	{
		if (isset($_POST['tblPage']) && isset($_POST['tblId'])){
			$this->getAjaxPostData();
	
			$result = CJSON::encode(array(
					'tblData' => $this->renderAdministratorTable (),
					'tblPaginator' => $this->renderAdministratorTablePaginator (),
					'tblId' => $_POST['tblId'],
					'success' => true
			));
		}
		else {
			$result = CJSON::encode(array(
					'success' => false
			));
		}
	
		echo $result;
	}
	
	/*
	 * Parse the search string (in JSON format) from the ajax, parse to the format which model can understand
	*/
	public function parseSearchString(){
		$searchData = array();
		if($this->tblAdministratorSearchString){
			$obj = json_decode($this->tblAdministratorSearchString);
			if($obj){
				if(!empty($obj->{'search_name'})){
					$nameData = array();
					$nameData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_TYPE']] = Yii::app()->params['SEARCH_INPUT_TYPE_TEXT'];
					$nameData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_VALUE']] = $obj->{'search_name'};
					$nameData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_MODEL_NAME']] = 'name';
					$searchData[] = $nameData;
                                }
				
                                if(!empty($obj->{'search_order'})){
					$orderData = array();
					$orderData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_TYPE']] = Yii::app()->params['SEARCH_INPUT_TYPE_NUMBER'];
					$orderData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_VALUE']] = $obj->{'search_order'};
					$orderData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_MODEL_NAME']] = '`'.'order'.'`';
					$searchData[] = $orderData;
                                }
	
				if(!empty($obj->{'search_status'})){
					$statusData = array();
					$statusData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_TYPE']] = Yii::app()->params['SEARCH_INPUT_TYPE_BOOL'];
					$statusData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_VALUE']] = $obj->{'search_status'};
					$statusData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_MODEL_NAME']] = 'active';
					$searchData[] = $statusData;
				}
			}
		}
		 
		return $searchData;
	}
	
	public function getAjaxPostData()
	{
		if (isset($_POST['tblSortField'])){
			$this->sortTblAdministrator = $_POST['tblSortField'];
			$this->sortOrderTblAdministrator = $_POST['tblIsAsc'];
		}
	
		if (isset($_POST['tbnNumberOfEntities'])){
			$this->tblAdministratorNumberOfEntities = intval($_POST['tbnNumberOfEntities']);
		}
		else{
			$this->tblAdministratorNumberOfEntities = 0;
		}
	
		if (isset($_POST['tblPage'])){
			$this->tblAdministratorCurrentPage = intval($_POST['tblPage']);
		}
		else{
			$this->tblAdministratorCurrentPage = 0;
		}
	
		if (isset($_POST['tblSearch'])){
			$this->tblAdministratorSearchString = $_POST['tblSearch'];
		}
	}
	
	public function renderAdministratorTable()
	{
		$paginationData = $this->categoryTable->getPagination($this->sortTblAdministrator, $this->sortOrderTblAdministrator, $this->tblAdministratorNumberOfEntities, $this->tblAdministratorCurrentPage, $this->parseSearchString());
		
		return $this->renderPartial('partial/list', array('paginationData' => $paginationData), true, true);
	}
	
	public function renderAdministratorTablePaginator()
	{
		$paginationData = $this->categoryTable->getPagination($this->sortTblAdministrator, $this->sortOrderTblAdministrator, $this->tblAdministratorNumberOfEntities, $this->tblAdministratorCurrentPage, $this->parseSearchString());
		
		return $this->renderPartial('partial/pagination', array('paginationData' => $paginationData), true, true);
	}

}