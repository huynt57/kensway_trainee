<div id="adminsitrator-user-edit-modal" class="modal hide">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="user-infos"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Change user information');?></h3>
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
						<div id="administrator_edit_form_message_error" class="alert alert-error" style="display: none;">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<span id="administrator_edit_form_message_error_placeholder"></span>
						</div>
						<div class="alert alert-success" id="administrator_edit_form_message_success" style="display: none;">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Successfully edit user information');?>
						</div>
						<!-- Form -->
						<form action="javascript:void(0);" method="POST" class='form-horizontal form-bordered form-validate' id="administrator_edit_form">
							<input type="hidden" id="administrator_id" name="administrator_id" value="">
							<div class="control-group">
								<label for="emailfield" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Email');?></label>
								<div class="controls">
									<input type="text" name="administrator_email" id="administrator_email" class="input-xlarge" data-rule-email="true" data-rule-required="true">
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
								<label for="policy" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Active');?></label>
								<div class="controls">
									<div class="checkbox non-left-padding">
										<input type="checkbox" class='icheck-me' id="administrator_active" name="administrator_active" value="1" data-rule-required="no" data-skin="square" data-color="blue">
									</div>
								</div>
							</div>
							<div class="form-actions">
								<input type="submit" class="btn btn-primary" value="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Edit');?>">
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