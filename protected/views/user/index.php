<?php 
$this->widget('application.components.BreadCrumb', array(
  'crumbs' => array(
    array('name' => 'User Manager', 'url' => Yii::app()->createUrl('user')),
  ),
  'delimiter' => ' > ', // if you want to change it
)); 
 ?>
 
 <?php 
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/datatable/jquery.dataTables.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/datatable/TableTools.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/datatable/ColReorderWithResize.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/datatable/ColVis.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/datatable/jquery.dataTables.columnFilter.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/datatable/jquery.dataTables.grouping.js');
 
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/multiselect/jquery.multi-select.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/maskedinput/jquery.maskedinput.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/tagsinput/jquery.tagsinput.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/daterangepicker/daterangepicker.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/daterangepicker/moment.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/validation/jquery.validate.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/form/jquery.form.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/validation/additional-methods.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/complexify/jquery.complexify-banlist.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/complexify/jquery.complexify.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/icheck/jquery.icheck.min.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/plugins/mockjax/jquery.mockjax.js ');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/Json/json2.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/Form/ajaxForm.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/table/ajaxTable.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/indicator/indicator.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/Chosen/chosen.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/Modal/modal.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/Input/input.js');
 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/Control/control.js');
 ?>
 
  <!-- Javascript and Jquery -->
 <?php $this->renderPartial('partial/jquery'); ?>
 
  <!-- Modal View -->
 <div id="adminsitrator-user-detail-modal" class="modal hide"></div>
 
 <!-- Modal View for create -->
<?php $this->renderPartial('create');?>

<!-- Modal View for change password -->
<?php echo $this->renderPartial('changePassword');?>

<!-- Modal View for edit -->
<?php echo $this->renderPartial('update');?>

<!-- Modal View for search -->
<?php echo $this->renderPartial('search');?>

<!-- Modal View for permission -->
<?php echo $this->renderPartial('permission');?>
 
  <div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'User Manager');?>
				</h3>
				
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-bordered normalTable sortable numberChangable advanceSearch addNew" id="tblAdministrator">
					<thead>
						<tr>
							<th class="sorting sortable" id="name"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Name');?></th>
							<th class="sorting sortable" id=company><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Company');?></th>
							<th class="sorting sortable" id="email"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Email');?></th>
							<th class="hidden-1024 sorting sortable" id="username"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Username');?></th>
							<th class="hidden-350 sorting sortable" id="active"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Status');?></th>
							<th class="hidden-480 sorting"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Setting');?></th>
						</tr>
					</thead>
					<tbody>
						<?php $this->renderPartial('partial/list', array('paginationData'=>$paginationData)); ?>
					</tbody>
				</table>
				<div class="table-pagination" id="tblAdministrator_paginator">
					<?php $this->renderPartial('partial/pagination', array('paginationData'=>$paginationData)); ?>
				</div>
			</div>
		</div>
	</div>
</div>