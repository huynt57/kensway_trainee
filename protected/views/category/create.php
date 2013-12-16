<div id="adminsitrator-category-create-modal" class="modal hide">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="user-infos"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Category');?></h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span12">
				<div class="box box-color box-bordered">
					<div class="box-title">
						<h3>
							<i class="icon-plus"></i><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Create New Category');?></h3>
					</div>
					<div class="box-content nopadding">
						<div id="administrator_create_form_message_error" class="alert alert-error" style="display: none;">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<span id="administrator_create_form_message_error_placeholder"></span>
						</div>
						<div class="alert alert-success" id="administrator_create_form_message_success" style="display: none;">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Successfully add new category!');?>
						</div>
						<!-- Form -->
						<form action="javascript:void(0);" method="POST" class='form-horizontal form-bordered form-validate' id="administrator_create_form">
							<div class="control-group">
								<label for="emailfield" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Categoryname');?></label>
								<div class="controls">
									<input type="text" name="administrator_categoryname" id="administrator_username" class="input-xlarge" data-rule-required="true" data-rule-minlength="5">
								</div>
							</div>
							
							<div class="control-group">
								<label for="emailfield" class="control-label"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'order');?></label>
								<div class="controls">
									<input type="text" name="administrator_order" id="administrator_name" class="input-xlarge" data-rule-required="true">
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