<?php
Yii::import('application.models.Table.UserTable');

class SiteController extends Controller
{
	public $headerTitle;
	public $userTable;
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	protected function beforeAction($event)
	{
		$this->headerTitle = Yii::app()->params['SITE_NAME'];
		$this->layout = 'login';
		$this->userTable = new UserTable();
		return true;
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{	
		if(!Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->createUrl('User/'));
			return;
		}
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$this->layout = 'error';
		//var_dump($error=Yii::app()->errorHandler->error);
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render( 'error' . ( $this->getViewFile( 'error' . $error['code'] ) ? $error['code'] : '' ), array('error'=>$error) );
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	
	public function actionForgotPassword(){
		$this->render('forgotPassword');
	}
	
	public function actionRecoveryPassword(){
		if (isset($_POST['email'])){
			$user = $this->userTable->userWithEmail($_POST['email']);
				
			if($user){
				$newPassword = StringHelper::generateRandomString(10);
				$oldPassword = $user->password;
				
				$data = array();
				$data['password'] = md5($newPassword);
				
				$updateResult = $this->userTable->updateUser($user, $data);
					
				if($updateResult){
					$emailError = EmailHelper::sendRecoveryPasswordEmail($user, $newPassword);
						
					if($emailError){
						//fail to send mail
						$data = array();
						$data['password'] = $oldPassword;
						$updateResult = $this->userTable->updateUser($user, $data);
						
						$result = CJSON::encode ( array (
								'success' => false,
								'message' => $emailError
						) );
					}
					else{
						$result = CJSON::encode ( array (
								'success' => true,
								'message' => 'An email was sent to your mailbox. Please follow the instruction to change your password'
						) );
					}
				}
				else{
					$result = CJSON::encode ( array (
							'success' => false,
							'message' => "There is an error with the system. Please try again",
					) );
				}
			}
			else{
				$result = CJSON::encode ( array (
						'success' => false,
						'message' => 'This email isn\'t existed in our system. Please recheck the email.'
				) );
			}
				
		}
		else {
			$result = CJSON::encode ( array (
					'success' => false,
					'message' => 'The registrtion email is invalid!'
			) );
		}
		
		echo $result;
	}
	
	public function actionChangePassword(){
		$id = Yii::app()->getRequest()->getQuery('id');
		if (!empty ( $id )){
			$this->render( 'changePassword', array('administrator_id'=>$id) );
		}
		else{
			$this->redirect(Yii::app()->createUrl('Site/'));
		}
	}
	
	public function actionChangePasswordSubmit(){
		if (isset($_POST['administrator_old_password']) && isset($_POST['administrator_new_password']) && isset($_POST['administrator_id'])){
    		$objectId = Yii::app()->request->getPost('administrator_id', '');
    		$oldPassword = Yii::app()->request->getPost('administrator_old_password', '');
    		$password = Yii::app()->request->getPost('administrator_new_password', '');
            $user = $this->userTable->userWithId($objectId);
    		 
    		if ($user) {
    			//check the old password
    			if(strcmp(md5($oldPassword), $user->password) == 0){
    				//change the password
    				$data = array();
					$data['password'] = md5($password);
				
					$updateResult = $this->userTable->updateUser($user, $data);
    				
    				if($updateResult){
    					$result = CJSON::encode ( array (
    								'success' => true,
    								'message' => 'Your password was reset'
    						) );
    				}
    				else{
    					$result = CJSON::encode ( array (
    							'success' => false,
    							'message' => 'There is a problem with the system. Please try again'
    					) );
    				}
    			}
    			else{
    				$result = CJSON::encode ( array (
    						'success' => false,
    						'message' => 'Wrong verify password'
    				) );
    			}
    		}
    		else{
    			$result = CJSON::encode ( array (
    					'success' => false,
    					'message' => 'This account isn\'t existed'
    			) );
    		}
    	}
    	else {
    		$result = CJSON::encode ( array (
    				'success' => false,
    				'message' => 'The verify information is invalid'
    		) );
    	}
    	 
    	echo $result;
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (isset($_POST['username']) && isset($_POST['password'])){
			$identity=new UserIdentity($_POST['username'],$_POST['password']);
			
			if($identity->authenticate()){
				if (isset($_POST['remember'])){
					Yii::app()->user->login($identity,Yii::app()->params['SESSION_DURATION']);
				}
				else{
					Yii::app()->user->login($identity);
				}
				
				$result = CJSON::encode ( array (
						'success' => true,
						'message' => 'Authentication successfully. Retrieving data...'
				) );
			}
			else{
				$result = CJSON::encode ( array (
						'success' => false,
						'message' => 'Authentication failed! Please recheck your account information.'
				) );
			}
			
		}
		else {
			$result = CJSON::encode ( array (
					'success' => false,
					'message' => 'Login information is invalid. Please make sure you input the right information of your account.'
			) );
		}
			 
		echo $result;
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->createUrl('Site/'));
	}
}