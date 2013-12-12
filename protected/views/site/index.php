 <?php 
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/validation/jquery.validate.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/form/jquery.form.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/validation/additional-methods.min.js');

 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/Form/ajaxForm.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/indicator/indicator.js');
 ?>
 
  <script type="text/javascript">
 $(document).ready(function() {
	 var loginFormId = 'administrator_login_form';
	 
	 var tblAdminLoginPath = '<?php echo Yii::app()->createAbsoluteUrl('Site/Login');?>';
	
	 //login handler
	 function adminLoginHandler(result, message) {
	      if(result){
	    	  window.location.replace("<?php echo Yii::app()->createAbsoluteUrl('User');?>");
	      }
	 };
	 
	 $( "#"+loginFormId ).submit(function( event ){
		 if($(this).valid()){
			 postFormDataToPathWithHandler(loginFormId, tblAdminLoginPath, adminLoginHandler);
		 }
		 else{
			 event.preventDefault();
		 }
	 });
 
 });
 </script>
 
<h2><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Login');?></h2>
<div id="administrator_login_form_message_error" class="alert alert-error" style="display: none;">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="administrator_login_form_message_error_placeholder"></span>
</div>
<div class="alert alert-success" id="administrator_login_form_message_success" style="display: none;">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="administrator_login_form_message_success_placeholder"></span>
</div>
<form action="javascript:void(0);" method='POST' class='form-validate' id="administrator_login_form">
	<div class="control-group">
		<div class="email controls">
			<input type="text" name='username' placeholder="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Username');?>" class='input-block-level' data-rule-required="true">
		</div>
	</div>
	<div class="control-group">
		<div class="pw controls">
			<input type="password" name="password" placeholder="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Password');?>" class='input-block-level' data-rule-required="true">
		</div>
	</div>
	<div class="submit">
		<div class="remember">
			<input type="checkbox" name="remember" class='icheck-me' data-skin="square" data-color="blue" id="remember"> <label for="remember"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Remember Me');?></label>
		</div>
		<input type="submit" value="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Login');?>" class='btn btn-primary'>
	</div>
</form>
<div class="forget">
	<a href="<?php echo Yii::app()->createAbsoluteUrl('Site/ForgotPassword');?>"><span><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Forgot Password');?></span></a>
</div>