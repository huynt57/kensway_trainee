<div id="adminsitrator-category-search-modal" class="modal hide">
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
									<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'By Categoryname');?>
								</label>
								<div class="controls">
									<div class="span1 check-box-enable-search-field">
										<input type="checkbox" class='icheck-me field-enabler' target="search_categoryname" checked="checked" data-skin="square" data-color="blue">
									</div>
									<div class="span11">
										<input type="text" class="span10" name="search_categoryname" id="search_username" class="input-xlarge">
									</div>
								</div>
							</div>
				
							<div class="control-group">
								<label for="emailfield" class="control-label">
									<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'By Order');?>
								</label>
								<div class="controls">
									<div class="span1 check-box-enable-search-field">
										<input type="checkbox" class='icheck-me field-enabler' target="search_order" data-skin="square" data-color="blue">
									</div>
									<div class="span11">
										<input type="text" class="span10" name="search_order" id="search_name" disabled class="input-xlarge">
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