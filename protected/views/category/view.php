<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h3 id="user-infos"><?php echo $administrator->name; ?></h3>
</div>
<div class="modal-body">
	<div class="row-fluid">
		<div class="span2">
			<img src="img/demo/user-1.jpg" alt="">
		</div>
		<div class="span10">
			<dl class="dl-horizontal" style="margin-top:0;">
				<dt><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Categoryname');?></dt>
				<dd><?php echo $administrator->name; ?></dd>
				<dt><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Order');?></dt>
				<dd><?php echo StringHelper::spaceIfNullString($administrator->order); ?></dd>
				
			</dl>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button class="btn" data-dismiss="modal"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Close');?></button>
</div>
