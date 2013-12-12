 <?php 
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/validation/jquery.validate.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/form/jquery.form.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/validation/additional-methods.min.js');

 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/complexify/jquery.complexify-banlist.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/complexify/jquery.complexify.min.js');
 
 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/Form/ajaxForm.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/indicator/indicator.js');
 ?>
<script type="text/javascript">
 $(document).ready(function() {
	 var retrieverPasswordFormId = 'administrator_change_password_form';
	 
	 var tblPasswordChangePath = '<?php echo Yii::app()->createAbsoluteUrl('Site/ChangePasswordSubmit');?>';
	
	 //login handler
	 function changePasswordHandler(result, message) {
	 };
	 
	 $( "#"+retrieverPasswordFormId ).submit(function( event ){
		 if($(this).valid()){
			 postFormDataToPathWithHandler(retrieverPasswordFormId, tblPasswordChangePath, changePasswordHandler);
		 }
		 else{
			 event.preventDefault();
		 }
	 });
 
 });
 </script>
<h2><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Reset Password');?></h2>
<div id="administrator_change_password_form_message_error" class="alert alert-error" style="display: none;">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="administrator_change_password_form_message_error_placeholder"></span>
</div>
<div class="alert alert-success" id="administrator_change_password_form_message_success" style="display: none;">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="administrator_change_password_form_message_success_placeholder"></span>
</div>
<form action="javascript:void(0);" method='POST' class='form-validate' id="administrator_change_password_form">
	<input id="administrator_id" name="administrator_id" value="<?php echo $administrator_id;?>" type="hidden"/>
	<div class="control-group">
		<label for="confirmfield" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Old Password');?></label>
		<div class="controls">
			<input type="password" class="input-block-level" name="administrator_old_password" id="administrator_old_password" data-rule-required="true">
		</div>
	</div>
	<div class="control-group">
		<label for="pwfield" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'New Password');?></label>
		<div class="controls">
			<input type="password" class='complexify-me input-block-level' name="administrator_new_password" id="administrator_new_password" data-rule-required="true" data-rule-minlength="5">
			<span class="help-block">
				<div class="progress progress-info">
					<div class="bar bar-red" style="width: 0%"></div>
				</div>
			</span>
		</div>
	</div>
	<div class="control-group">
		<label for="confirmfield" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Confirm Password');?></label>
		<div class="controls">
			<input type="password" class="input-block-level" name="administrator_confirm_password" id="administrator_confirm_password" data-rule-equalTo="#administrator_new_password" data-rule-required="true" data-rule-minlength="5">
		</div>
	</div>
	<div class="submit">
		<input type="submit" value="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Change');?>" class='btn btn-primary'>
	</div>
</form>
<div class="forget">
	<a href="<?php echo Yii::app()->createAbsoluteUrl('');?>"><span><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Back to login');?></span></a>
</div>