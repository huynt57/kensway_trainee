<div id="adminsitrator-user-change-permission-modal" class="modal hide">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="user-infos"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Change Permission');?></h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span12">
				<div class="box box-color box-bordered">
					<div class="box-title">
						<h3>
							<i class="icon-edit"></i><span id="administrator_username"></span></h3>
					</div>
					<div class="box-content nopadding">
						<!-- Message box (make sure the id match the form) -->
						<div id="administrator_change_permission_form_message_error" class="alert alert-error" style="display: none;">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<span id="administrator_change_permission_form_message_error_placeholder"></span>
						</div>
						<div class="alert alert-success" id="administrator_change_permission_form_message_success" style="display: none;">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Change Permission successfully');?>
						</div>
						<!-- Form -->
						<form action="javascript:void(0);" method="POST" class='form-horizontal form-bordered form-validate' id="administrator_change_permission_form">
							<input type="hidden" id="administrator_id" name="administrator_id" value="">
							<div class="control-group">
								<label for="policy" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Permissions');?></label>
								<div class="controls">
									<select multiple="multiple" id="administrator_edit_permission" name="administrator_edit_permission[]" class='multiselect'>
										<option value='<?php echo Yii::app()->params['PERMISSION_ADMINISTRATOR']?>'>Administrator</option>
										<option value='<?php echo Yii::app()->params['PERMISSION_GLOBAL_CREATE_UPDATE_PROJECT']?>'>Create/Edit Project</option>
										<option value='<?php echo Yii::app()->params['PERMISSION_GLOBAL_DELETE_PROJECT']?>'>Delete Project</option>
										<option value='<?php echo Yii::app()->params['PERMISSION_GLOBAL_VIEW_CLOSED_PROJECT']?>'>View Closed Project</option>
										<option value='<?php echo Yii::app()->params['PERMISSION_GLOBAL_VIEW_PROJECT_HISTORY']?>'>View Project History</option>
										<option value='<?php echo Yii::app()->params['PERMISSION_GLOBAL_CREATE_UPDATE_USER']?>'>Create/Edit User</option>
										<option value='<?php echo Yii::app()->params['PERMISSION_GLOBAL_DELETE_USER']?>'>Delete User</option>
										<option value='<?php echo Yii::app()->params['PERMISSION_GLOBAL_CREATE_EDIT_CLIENT']?>'>Create/Edit Client</option>
										<option value='<?php echo Yii::app()->params['PERMISSION_GLOBAL_DELETE_CLIENT']?>'>Edit Client</option>
									</select>
								</div>
							</div>
							<div class="form-actions">
								<input type="submit" class="btn btn-primary" value="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Change');?>">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Close');?></button>
	</div>
</div>