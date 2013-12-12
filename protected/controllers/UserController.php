<?php
Yii::import('application.models.Table.UserTable');

class UserController extends GxController {

	public $navigationSelectedIndex;
	public $headerTitle;
	public $userTable;
	
	public $administratorTable = null;
	
	public $administratorTablePaginator = null;
	
	public $sortTblAdministrator = 'user_id';
	
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
		
		$this->navigationSelectedIndex = Yii::app()->params['NAV_USER_MANAGER_INDEX'];
		$this->headerTitle = 'User Manager';
		$this->userTable = new UserTable();
		return true;
	}

	public function actionView() {
		if (isset($_POST['objectId']) && isset($_POST['tblId'])){
			$objectId = $_POST['objectId'];
		
			$administrator = $this->userTable->userWithId($objectId);
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
		$data['username'] = Yii::app()->request->getPost('administrator_username', '');
		$data['password'] = Yii::app()->request->getPost('administrator_new_password', '');
		$data['email'] = Yii::app()->request->getPost('administrator_email', '');
		$data['active'] = Yii::app()->request->getPost('administrator_active', 0);
		$data['name'] = Yii::app()->request->getPost('administrator_name', '');
		$data['company'] = Yii::app()->request->getPost('administrator_company', '');
		
		//permission
		$permissions = Yii::app()->request->getPost('administrator_pemission', '');
		$data['permission'] = $this->userTable->parsePermissions($permissions);
		
		$createResult = $this->userTable->createUser($data);
		
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
							'message' => "Cannot create new user. An error has occurred : ".$createResult['message'],
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
			
			$user = $this->userTable->userWithId($objectId);
			
			if($user){
				$result = CJSON::encode ( array (
            				'administrator_id' => (!empty($user->user_id)) ? $user->user_id : '0',
            				'administrator_username' => (!empty($user->username)) ? $user->username : '',
            				'administrator_email' => (!empty($user->email)) ? $user->email : '',
            				'administrator_active' => (!empty($user->active)) ? $user->active : '0',
							'administrator_name' => (!empty($user->name)) ? $user->name : '',
							'administrator_company' => (!empty($user->company)) ? $user->company : '',
            				'success' => true
            		) );
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
					'message' => 'Cannot find this user. The input parameters are invalid'
			) );
		}
			 
		echo $result;
	}
	
	public function actionSubmitUpdate(){
		if(isset($_POST['administrator_id'])){
			$user = $this->userTable->userWithId($_POST['administrator_id']);
			
			if($user){
				$data = array();
				$data['email'] = Yii::app()->request->getPost('administrator_email', '');
				$data['active'] = Yii::app()->request->getPost('administrator_active', 0);
				$data['name'] = Yii::app()->request->getPost('administrator_name', '');
				$data['company'] = Yii::app()->request->getPost('administrator_company', '');
				
				$updateResult = $this->userTable->updateUser($user, $data);
				
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
			
			$deleteResult = $this->userTable->deleteUserWithId($objectId);
			
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
		
		$paginationData = $this->userTable->getPagination();
		
		$dataProvider = new CActiveDataProvider('User');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
			'paginationData' => $paginationData,
		));
	}
	
	public function actionChangePassword(){
		if (isset($_POST['objectId']) && isset($_POST['tblId'])){
			$user = $this->userTable->userWithId($_POST['objectId']);
			
			if($user){
				$result = CJSON::encode ( array (
						'administrator_id' => (!empty($user->user_id)) ? $user->user_id : '0',
						'administrator_username' => (!empty($user->username)) ? $user->username : '',
						'administrator_password' => (!empty($user->password)) ? $user->password : '',
						'success' => true
				) );
			}
			else{
				$result = CJSON::encode(array(
					'success' => false
				));
			}
		} else {
			$result = CJSON::encode(array(
					'success' => false
			));
		}
		
		echo $result;
	}
	
	public function actionSubmitPassword(){
		if (isset($_POST['administrator_id'])){
			$user = $this->userTable->userWithId($_POST['administrator_id']);
			
			$administrator_id = Yii::app()->request->getPost('administrator_id', '');
			$administrator_password = Yii::app()->request->getPost('administrator_password', '');
			
			$data = array();
			$data['password'] = md5($administrator_password);
				
			$updateResult = $this->userTable->updateUser($user, $data);
			
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
								'message' => "Cannot change user password. An error has occurred : ".$updateResult['message'],
						) );
				}
			}
			else{
				$result = CJSON::encode ( array (
						'success' => false,
						'message' => "Cannot change user password. An error has occurred.",
				) );
			}
		} else {
			$result = CJSON::encode(array(
					'success' => false
			));
		}
	
		echo $result;
	}
	
	public function actionChangePermission(){
		if (isset($_POST['objectId']) && isset($_POST['tblId'])){
			$user = $this->userTable->userWithId($_POST['objectId']);
				
			if($user){
				$result = CJSON::encode ( array (
						'administrator_id' => (!empty($user->user_id)) ? $user->user_id : '0',
						'administrator_username' => (!empty($user->username)) ? $user->username : '',
						'administrator_edit_permission' => (!empty($user->permission)) ? $user->permission : '',
						'success' => true
				) );
			}
			else{
				$result = CJSON::encode(array(
						'success' => false
				));
			}
		} else {
			$result = CJSON::encode(array(
					'success' => false
			));
		}
		
		echo $result;
	}
	
	public function actionSubmitPermission(){
		if(isset($_POST['administrator_id'])){
			$user = $this->userTable->userWithId($_POST['administrator_id']);
				
			if($user){
				$data = array();
				$permissions = Yii::app()->request->getPost('administrator_edit_permission', '');
				$data['permission'] = $this->userTable->parsePermissions($permissions);
		
				$updateResult = $this->userTable->updateUser($user, $data);
		
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
								'message' => "Cannot update user permission. An error has occurred : ".$updateResult['message'],
						) );
					}
				}
				else{
					$result = CJSON::encode ( array (
							'success' => false,
							'message' => "Cannot update user permission. An error has occurred.",
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
					'message' => 'Cannot update this user\'s permission. The input parameters are invalid'
			) );
		}
		
		echo $result;
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
				if(!empty($obj->{'search_username'})){
					$usernameData = array();
					$usernameData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_TYPE']] = Yii::app()->params['SEARCH_INPUT_TYPE_TEXT'];
					$usernameData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_VALUE']] = $obj->{'search_username'};
					$usernameData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_MODEL_NAME']] = 'username';
					$searchData[] = $usernameData;
				}
	
				if(!empty($obj->{'search_email'})){
					$emailData = array();
					$emailData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_TYPE']] = Yii::app()->params['SEARCH_INPUT_TYPE_TEXT'];
					$emailData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_VALUE']] = $obj->{'search_email'};
					$emailData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_MODEL_NAME']] = 'email';
					$searchData[] = $emailData;
				}
				
				if(!empty($obj->{'search_name'})){
					$nameData = array();
					$nameData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_TYPE']] = Yii::app()->params['SEARCH_INPUT_TYPE_TEXT'];
					$nameData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_VALUE']] = $obj->{'search_name'};
					$nameData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_MODEL_NAME']] = 'name';
					$searchData[] = $nameData;
				}
				
				if(!empty($obj->{'search_company'})){
					$companyData = array();
					$companyData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_TYPE']] = Yii::app()->params['SEARCH_INPUT_TYPE_TEXT'];
					$companyData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_VALUE']] = $obj->{'search_company'};
					$companyData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_MODEL_NAME']] = 'company';
					$searchData[] = $companyData;
				}
	
				if(!empty($obj->{'search_status'})){
					$statusData = array();
					$statusData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_TYPE']] = Yii::app()->params['SEARCH_INPUT_TYPE_BOOL'];
					$statusData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_VALUE']] = $obj->{'search_status'};
					$statusData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_MODEL_NAME']] = 'active';
					$searchData[] = $statusData;
				}
				 
				if(!empty($obj->{'search_date_range'})){
					$dateRanges = explode("-", $obj->{'search_date_range'});
	
					if(count($dateRanges) >= 1){
						//lower range
						$lowerDateData = array();
						$lowerDateData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_TYPE']] = Yii::app()->params['SEARCH_INPUT_TYPE_DATE_LOWER'];
						$lowerDateData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_VALUE']] = $dateRanges[0];
						$lowerDateData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_MODEL_NAME']] = 'createddate';
						$searchData[] = $lowerDateData;
					}
	
					if(count($dateRanges) >= 2){
						//upper range
						$upperDateData = array();
						$upperDateData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_TYPE']] = Yii::app()->params['SEARCH_INPUT_TYPE_DATE_UPPER'];
						$upperDateData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_VALUE']] = $dateRanges[1];
						$upperDateData[Yii::app()->params['SEARCH_FORM_AJAX_ELEMENT_MODEL_NAME']] = 'createddate';
						$searchData[] = $upperDateData;
					}
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
		$paginationData = $this->userTable->getPagination($this->sortTblAdministrator, $this->sortOrderTblAdministrator, $this->tblAdministratorNumberOfEntities, $this->tblAdministratorCurrentPage, $this->parseSearchString());
		
		return $this->renderPartial('partial/list', array('paginationData' => $paginationData), true, true);
	}
	
	public function renderAdministratorTablePaginator()
	{
		$paginationData = $this->userTable->getPagination($this->sortTblAdministrator, $this->sortOrderTblAdministrator, $this->tblAdministratorNumberOfEntities, $this->tblAdministratorCurrentPage, $this->parseSearchString());
		
		return $this->renderPartial('partial/pagination', array('paginationData' => $paginationData), true, true);
	}

}