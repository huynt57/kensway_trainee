 <?php 
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/validation/jquery.validate.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/form/jquery.form.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/validation/additional-methods.min.js');

 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/Form/ajaxForm.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/indicator/indicator.js');
 ?>
<script type="text/javascript">
 $(document).ready(function() {
	 var retrieverPasswordFormId = 'administrator_forgot_password_form';
	 
	 var tblPasswordRecoveryPath = '<?php echo Yii::app()->createAbsoluteUrl('Site/RecoveryPassword');?>';
	
	 //login handler
	 function retrieverPasswordHandler(result, message) {
	 };
	 
	 $( "#"+retrieverPasswordFormId ).submit(function( event ){
		 if($(this).valid()){
			 postFormDataToPathWithHandler(retrieverPasswordFormId, tblPasswordRecoveryPath, retrieverPasswordHandler);
		 }
		 else{
			 event.preventDefault();
		 }
	 });
 
 });
 </script>
<h2><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Forgot Password');?></h2>
<div id="administrator_forgot_password_form_message_error" class="alert alert-error" style="display: none;">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="administrator_forgot_password_form_message_error_placeholder"></span>
</div>
<div class="alert alert-success" id="administrator_forgot_password_form_message_success" style="display: none;">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="administrator_forgot_password_form_message_success_placeholder"></span>
</div>
<div class="alert alert-info">
	<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'To retrieve the lost password, please input your registration email and we will send you an instruction.');?>
</div>
<form action="javascript:void(0);" method='POST' class='form-validate' id="administrator_forgot_password_form">
	<div class="control-group">
		<div class="email controls">
			<input type="text" name='email' placeholder="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Registration Email');?>" data-rule-email="true" class='input-block-level' data-rule-required="true">
		</div>
	</div>
	<div class="submit">
		<input type="submit" value="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Send');?>" class='btn btn-primary'>
	</div>
</form>
<div class="forget">
	<a href="<?php echo Yii::app()->createAbsoluteUrl('');?>"><span><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Back');?></span></a>
</div>