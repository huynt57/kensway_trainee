<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h3 id="user-infos"><?php echo $administrator->username; ?></h3>
</div>
<div class="modal-body">
	<div class="row-fluid">
		<div class="span2">
			<img src="img/demo/user-1.jpg" alt="">
		</div>
		<div class="span10">
			<dl class="dl-horizontal" style="margin-top:0;">
				<dt><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Username');?></dt>
				<dd><?php echo $administrator->username; ?></dd>
				<dt><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Name');?></dt>
				<dd><?php echo StringHelper::spaceIfNullString($administrator->name); ?></dd>
				<dt><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Email');?></dt>
				<dd><?php echo StringHelper::spaceIfNullString($administrator->email); ?></dd>
				<dt><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Company');?></dt>
				<dd><?php echo StringHelper::spaceIfNullString($administrator->company);  ?></dd>
				<dt><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Join Date');?></dt>
				<dd>
					<?php echo DateTimeHelper::dateOnlyFromDateTimeString($administrator->createddate)  ?>
				</dd>
			</dl>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button class="btn" data-dismiss="modal"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Close');?></button>
</div>
