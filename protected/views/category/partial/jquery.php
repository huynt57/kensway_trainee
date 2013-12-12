<script type="text/javascript">
$(document).ready(function() {
	/*-------------------------------------------VARIABLE DEFINE-------------------------------------------*/
    var tblAdminId = 'tblAdministrator';

    var tblDetailButtonId = 'modal-button-detail';
    var tblDeleteButtonId = 'modal-button-delete';
    var tblEditButtonId = 'modal-button-edit';
    var tblCleanSearchButtonId = 'btn-clear-search';
    var tblClearCreateButtonId = 'btn-clear-create';
    var tblSearchFieldEnablerId = 'field-enabler';
    
    var tblCreateModalId = 'adminsitrator-category-create-modal';
    var tblSearchModalId = 'adminsitrator-category-search-modal';
    var tblEditModalId = 'adminsitrator-category-edit-modal';

    var tblSearchFormId = 'administrator_search_form';
    var tblCreateFormId = 'administrator_create_form';
    var tblEditFormId = 'administrator_edit_form';

    var tblAdminSortPath = '<?php echo Yii::app()->createAbsoluteUrl('Category/Sort');?>';
    var tblEntitiesNumberPath = '<?php echo Yii::app()->createAbsoluteUrl('Category/ChangeEntityNumber');?>';
    var tblPagingPath = '<?php echo Yii::app()->createAbsoluteUrl('Category/Paging');?>';
    var tblProfilePath = '<?php echo Yii::app()->createAbsoluteUrl('Category/View');?>';
    var tblCreatePath = '<?php echo Yii::app()->createAbsoluteUrl('Category/Create');?>';
    var tblRefreshPath = '<?php echo Yii::app()->createAbsoluteUrl('Category/Refresh');?>';
    var tblDeletePath = '<?php echo Yii::app()->createAbsoluteUrl('Category/Delete');?>';
    var tblEditPath = '<?php echo Yii::app()->createAbsoluteUrl('Category/Update');?>';
    var tblEditSubmitPath = '<?php echo Yii::app()->createAbsoluteUrl('Category/SubmitUpdate');?>';
    /*-------------------------------------------PREPARE TABLE-------------------------------------------*/
    //make sure the table id is right, and all the header have the id which match the model property

  //replace text in the table
	replaceTableElementText(tblAdminId,'search','<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Search');?>');
	replaceTableElementText(tblAdminId,'add','<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'New Category');?>');
	
	ajaxSortTable(tblAdminId,tblAdminSortPath);
	ajaxTableEntitiesNumber(tblAdminId,tblEntitiesNumberPath);
	ajaxPagingTable(tblAdminId,tblPagingPath);
	ajaxShowModalForObjectInTable(tblAdminId,tblProfilePath,tblDetailButtonId);
	deleteObjectFromTable(tblAdminId,tblDeletePath,tblDeleteButtonId,tblRefreshPath,'<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Are you sure you want to delete this category?');?>');

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