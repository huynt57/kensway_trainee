<div id="adminsitrator-user-change-pass-modal" class="modal hide">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="user-infos"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Change Password');?></h3>
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
						<div id="administrator_change_password_form_message_error" class="alert alert-error" style="display: none;">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<span id="administrator_change_password_form_message_error_placeholder"></span>
						</div>
						<div class="alert alert-success" id="administrator_change_password_form_message_success" style="display: none;">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Change Password successfully');?>
						</div>
						<!-- Form -->
						<form action="javascript:void(0);" method="POST" class='form-horizontal form-bordered form-validate' id="administrator_change_password_form">
							<input type="hidden" id="administrator_id" name="administrator_id" value="">
							<div class="control-group">
								<label for="pwfield" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'New password');?></label>
								<div class="controls">
									<div class="input-xlarge">
										<input type="password" class='complexify-me' name="administrator_password" id="administrator_password" data-rule-required="true" data-rule-minlength="5">
										<span class="help-block">
											<div class="progress progress-info">
												<div class="bar bar-red" style="width: 0%"></div>
											</div>
										</span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label for="confirmfield" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Confirm password');?></label>
								<div class="controls">
									<input type="password" name="administrator_confirm_password" id="administrator_confirm_password" data-rule-equalTo="#administrator_password" data-rule-required="true" data-rule-minlength="5">
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