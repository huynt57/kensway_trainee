<script type="text/javascript">
$(document).ready(function() {
	/*-------------------------------------------VARIABLE DEFINE-------------------------------------------*/
    var tblAdminId = 'tblAdministrator';

    var tblDetailButtonId = 'modal-button-detail';
    var tblDeleteButtonId = 'modal-button-delete';
    var tblEditButtonId = 'modal-button-edit';
    var tblChangePermissionButtonId = 'modal-button-change_permission';
    var tblChangePasswordButtonId = 'modal-button-change-pass';
    var tblCleanSearchButtonId = 'btn-clear-search';
    var tblClearCreateButtonId = 'btn-clear-create';
    var tblSearchFieldEnablerId = 'field-enabler';
    
    var tblCreateModalId = 'adminsitrator-user-create-modal';
    var tblSearchModalId = 'adminsitrator-user-search-modal';
    var tblEditModalId = 'adminsitrator-user-edit-modal';
    var tblChangePassModalId = 'adminsitrator-user-change-pass-modal';
    var tblChangePermissionModalId = 'adminsitrator-user-change-permission-modal';

    var tblSearchFormId = 'administrator_search_form';
    var tblCreateFormId = 'administrator_create_form';
    var tblEditFormId = 'administrator_edit_form';
    var tblChangePassFormId = 'administrator_change_password_form';
    var tblChangePermissionFormId = 'administrator_change_permission_form';

    var tblAdminSortPath = '<?php echo Yii::app()->createAbsoluteUrl('User/Sort');?>';
    var tblEntitiesNumberPath = '<?php echo Yii::app()->createAbsoluteUrl('User/ChangeEntityNumber');?>';
    var tblPagingPath = '<?php echo Yii::app()->createAbsoluteUrl('User/Paging');?>';
    var tblProfilePath = '<?php echo Yii::app()->createAbsoluteUrl('User/View');?>';
    var tblCreatePath = '<?php echo Yii::app()->createAbsoluteUrl('User/Create');?>';
    var tblRefreshPath = '<?php echo Yii::app()->createAbsoluteUrl('User/Refresh');?>';
    var tblChangePasswordPath = '<?php echo Yii::app()->createAbsoluteUrl('User/ChangePassword');?>';
    var tblChangePasswordSubmitPath = '<?php echo Yii::app()->createAbsoluteUrl('User/SubmitPassword');?>';
    var tblChangePermissionPath = '<?php echo Yii::app()->createAbsoluteUrl('User/ChangePermission');?>';
    var tblChangePermissionSubmitPath = '<?php echo Yii::app()->createAbsoluteUrl('User/SubmitPermission');?>';
    var tblDeletePath = '<?php echo Yii::app()->createAbsoluteUrl('User/Delete');?>';
    var tblEditPath = '<?php echo Yii::app()->createAbsoluteUrl('User/Update');?>';
    var tblEditSubmitPath = '<?php echo Yii::app()->createAbsoluteUrl('User/SubmitUpdate');?>';
    /*-------------------------------------------PREPARE TABLE-------------------------------------------*/
    //make sure the table id is right, and all the header have the id which match the model property

  //replace text in the table
	replaceTableElementText(tblAdminId,'search','<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Search');?>');
	replaceTableElementText(tblAdminId,'add','<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'New User');?>');
	
	ajaxSortTable(tblAdminId,tblAdminSortPath);
	ajaxTableEntitiesNumber(tblAdminId,tblEntitiesNumberPath);
	ajaxPagingTable(tblAdminId,tblPagingPath);
	ajaxShowModalForObjectInTable(tblAdminId,tblProfilePath,tblDetailButtonId);
	deleteObjectFromTable(tblAdminId,tblDeletePath,tblDeleteButtonId,tblRefreshPath,'<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Are you sure you want to delete this user?');?>');

	/*-------------------------------------------CREATE-------------------------------------------*/
	//clear the table when show
	function createModalShowHandler() {
		clearAllTextfieldInForm(tblCreateFormId);
    };
    
  	//attact modal to event
	attachModalToObjectClickEventWithShowHandler(tblCreateModalId,getAddButtonIdOfTable(tblAdminId),createModalShowHandler);

	$('#'+tblClearCreateButtonId).click(function() {
		if (confirm('<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Are you sure you want to clear all the field?');?>')){
			//remove text
			clearAllTextfieldInForm(tblCreateFormId);
		}
	});
	
	$( "#"+tblCreateFormId ).submit(function( event ){
    	if($(this).valid()){
			postEditDataForAjaxForm($(this).attr('id'),tblCreatePath,tblAdminId,tblRefreshPath,tblCreateModalId);
    	}
	});

	/*-------------------------------------------EDIT-------------------------------------------*/
	showEditModal(tblAdminId,tblEditPath,tblEditButtonId);

	$( "#"+tblEditFormId ).submit(function( event ){
		if($(this).valid()){
			postEditDataForAjaxForm($(this).attr('id'),tblEditSubmitPath,tblAdminId,tblRefreshPath,tblEditModalId);
		}
	});

	/*-------------------------------------------Change Password-------------------------------------------*/
	showEditModal(tblAdminId,tblChangePasswordPath,tblChangePasswordButtonId);

	//form event
	$( "#"+tblChangePassFormId ).submit(function( event ){
    	if($(this).valid()){
			postEditDataForAjaxForm($(this).attr('id'), tblChangePasswordSubmitPath,tblAdminId,'',tblChangePassModalId);
    	}
	});

	/*-------------------------------------------Change Permission-------------------------------------------*/
	showEditModal(tblAdminId,tblChangePermissionPath,tblChangePermissionButtonId);

	//form event
	$( "#"+tblChangePermissionFormId ).submit(function( event ){
    	if($(this).valid()){
			postEditDataForAjaxForm($(this).attr('id'), tblChangePermissionSubmitPath,tblAdminId,'',tblChangePermissionModalId);
    	}
	});

	/*-------------------------------------------SEARCH-------------------------------------------*/
	//attach modal to event
	attachModalToObjectClickEvent(tblSearchModalId,getSearchButtonIdOfTable(tblAdminId));
	
	//check the checkbox to disable or enable the target
	enableCheckboxTargetDisableWithClass(tblSearchFieldEnablerId);

	//disable the keyboard on date time input
	disableKeyboardInputForObject('search_date_range');

	//reset when click
	$('#'+tblCleanSearchButtonId).click(function() {
		if (confirm('<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Are you sure you want to clear all the search field to default?');?>')){
			//disable all field and checkbox
			toggleEnablerCheckboxWithClass(tblSearchFieldEnablerId,false);
			//remove text
			clearAllTextfieldInForm(tblSearchFormId);
			
			//reset the search
			setSearchStringForTable(tblAdminId,'');
			
			refreshTable(tblAdminId,tblRefreshPath);
		}
	});

	//form event
	$( "#"+tblSearchFormId ).submit(function( event ){
		postSearchDataToTable($(this).attr('id'),tblAdminId,tblRefreshPath,tblSearchModalId);
	});
});
</script>