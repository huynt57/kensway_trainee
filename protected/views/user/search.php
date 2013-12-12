<div id="adminsitrator-user-search-modal" class="modal hide">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="user-infos"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Search');?></h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span12">
				<div class="box box-color box-bordered">
					<div class="box-title">
						<h3>
							<i class="icon-search"></i><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Search');?></h3>
					</div>
					<div class="box-content nopadding">
						<!-- Form -->
						<div id="administrator_search_form_message_error" class="alert alert-error" style="display: none;">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<span id="administrator_search_form_message_error_placeholder"></span>
						</div>
						<form action="javascript:void(0);" method="POST" class='form-horizontal form-bordered form-validate' id="administrator_search_form">
							<div class="control-group">
								<label for="emailfield" class="control-label">
									<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'By Username');?>
								</label>
								<div class="controls">
									<div class="span1 check-box-enable-search-field">
										<input type="checkbox" class='icheck-me field-enabler' target="search_username" checked="checked" data-skin="square" data-color="blue">
									</div>
									<div class="span11">
										<input type="text" class="span10" name="search_username" id="search_username" class="input-xlarge">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label for="emailfield" class="control-label">
									<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'By Email');?>
								</label>
								<div class="controls">
									<div class="span1 check-box-enable-search-field">
										<input type="checkbox" class='icheck-me field-enabler' target="search_email" data-skin="square" data-color="blue">
									</div>
									<div class="span11">
										<input type="text" class="span10" name="search_email" disabled id="search_email" class="input-xlarge">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label for="emailfield" class="control-label">
									<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'By Name');?>
								</label>
								<div class="controls">
									<div class="span1 check-box-enable-search-field">
										<input type="checkbox" class='icheck-me field-enabler' target="search_name" data-skin="square" data-color="blue">
									</div>
									<div class="span11">
										<input type="text" class="span10" name="search_name" id="search_name" disabled class="input-xlarge">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label for="emailfield" class="control-label">
									<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'By Company');?>
								</label>
								<div class="controls">
									<div class="span1 check-box-enable-search-field">
										<input type="checkbox" class='icheck-me field-enabler' target="search_company" data-skin="square" data-color="blue">
									</div>
									<div class="span11">
										<input type="text" class="span10" name="search_company" id="search_company" disabled class="input-xlarge">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label for="emailfield" class="control-label">
									<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'By State');?>
								</label>
								<div class="controls">
									<div class="span1 check-box-enable-search-field">
										<input type="checkbox" class='icheck-me field-enabler' target="search_status" data-skin="square" data-color="blue">
									</div>
									<div class="span11">
										<select  id="search_status" name="search_status" disabled="disabled" class='select2-me input-xlarge' data-nosearch="true">
											<option value="true"> <?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Active');?> </option>
											<option value="false"> <?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Deactive');?></option>
										</select>
									</div>
									
								</div>
							</div>
							<div class="control-group">
								<label for="emailfield" class="control-label">
									<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'By join date');?>
								</label>
								<div class="controls">
									<div class="span1 check-box-enable-search-field">
										<input type="checkbox" class='icheck-me field-enabler' target="search_date_range" data-skin="square" data-color="blue">
									</div>
									<div class="span11">
										<input type="text" name="search_date_range" disabled="disabled" id="search_date_range" class="input-large daterangepick">
									</div>
								</div>
							</div>
							<div class="form-actions">
								<input type="submit" class="btn btn-primary" value="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Search');?>">
								<button type="button" class="btn" id="btn-clear-search"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Reset');?></button>
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