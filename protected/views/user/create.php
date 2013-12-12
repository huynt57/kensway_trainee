<div id="adminsitrator-user-create-modal" class="modal hide">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="user-infos"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'User');?></h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span12">
				<div class="box box-color box-bordered">
					<div class="box-title">
						<h3>
							<i class="icon-plus"></i><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Create New User');?></h3>
					</div>
					<div class="box-content nopadding">
						<div id="administrator_create_form_message_error" class="alert alert-error" style="display: none;">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<span id="administrator_create_form_message_error_placeholder"></span>
						</div>
						<div class="alert alert-success" id="administrator_create_form_message_success" style="display: none;">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Successfully add new user!');?>
						</div>
						<!-- Form -->
						<form action="javascript:void(0);" method="POST" class='form-horizontal form-bordered form-validate' id="administrator_create_form">
							<div class="control-group">
								<label for="emailfield" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Username');?></label>
								<div class="controls">
									<input type="text" name="administrator_username" id="administrator_username" class="input-xlarge" data-rule-required="true" data-rule-minlength="5">
								</div>
							</div>
							<div class="control-group">
								<label for="pwfield" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Password');?></label>
								<div class="controls">
									<div class="input-xlarge">
										<input type="password" class='complexify-me input-xlarge' name="administrator_new_password" id="administrator_new_password" data-rule-required="true" data-rule-minlength="5">
										<span class="help-block">
											<div class="progress progress-info">
												<div class="bar bar-red" style="width: 0%"></div>
											</div>
										</span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label for="confirmfield" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Confirm Password');?></label>
								<div class="controls">
									<input type="password" name="administrator_confirm_password" id="administrator_confirm_password" class="input-xlarge" data-rule-equalTo="#administrator_new_password" data-rule-required="true" data-rule-minlength="5">
								</div>
							</div>
							<div class="control-group">
								<label for="emailfield" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Name');?></label>
								<div class="controls">
									<input type="text" name="administrator_name" id="administrator_name" class="input-xlarge" data-rule-required="true">
								</div>
							</div>
							<div class="control-group">
								<label for="emailfield" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Company');?></label>
								<div class="controls">
									<input type="text" name="administrator_company" id="administrator_company" class="input-xlarge">
								</div>
							</div>
							<div class="control-group">
								<label for="emailfield" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Email');?></label>
								<div class="controls">
									<input type="text" name="administrator_email" id="administrator_email" class="input-xlarge" data-rule-email="true" data-rule-required="true">
								</div>
							</div>
							<div class="control-group">
								<label for="policy" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Is Active');?></label>
								<div class="controls">
									<div class="checkbox non-left-padding">
										<input type="checkbox" class='icheck-me' id="administrator_active" name="administrator_active" value="1" data-rule-required="no" data-skin="square" data-color="blue">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label for="policy" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Permission');?></label>
								<div class="controls">
									<select multiple="multiple" id="administrator_pemission" name="administrator_pemission[]" class='multiselect'>
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
								<input type="submit" class="btn btn-primary" value="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Create');?>">
								<button type="button" class="btn" id="btn-clear-create"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Reset');?></button>
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