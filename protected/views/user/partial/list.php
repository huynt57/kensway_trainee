<?php foreach ( $paginationData[Yii::app()->params['PAGINATION_MODEL']] as $administrator ){ ?>
<tr>
	<td><?php echo $administrator->name ?></td>
	<td><?php echo $administrator->company ?></td>
	<td><?php echo $administrator->email ?></td>
	<td><?php echo $administrator->username ?></td>
	<td class="hidden-350">
	<?php if ($administrator->active) { ?>
		<span class="label label-satgreen"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Active');?></span>
	<?php } else { ?>
		<span class="label label-lightred"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Deactive');?></span>
	<?php } ?>
	</td>
	<td class="hidden-480">
		<a href="javascript:void(0);" objectId="<?php echo $administrator->user_id; ?>" id="modal-button-detail" modal-view="adminsitrator-user-detail-modal" class="btn" data-toggle="modal" rel="tooltip" title="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'View');?> "><i class="icon-eye-open"></i></a>
		<a href="javascript:void(0);" objectId="<?php echo $administrator->user_id; ?>" id="modal-button-edit" modal-view="adminsitrator-user-edit-modal" class="btn" rel="tooltip" title="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Edit');?>"><i class="icon-edit"></i></a>
		<a href="javascript:void(0);" objectId="<?php echo $administrator->user_id; ?>" id="modal-button-change-pass" modal-view="adminsitrator-user-change-pass-modal" class="btn" rel="tooltip" title="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Change Password');?>"><i class="icon-key"></i></a>
		<a href="javascript:void(0);" objectId="<?php echo $administrator->user_id; ?>" id="modal-button-change_permission" modal-view="adminsitrator-user-change-permission-modal" class="btn" data-toggle="modal" rel="tooltip" title="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Permission');?> "><i class="icon-user"></i></a>
		<a href="javascript:void(0);" objectId="<?php echo $administrator->user_id; ?>" id="modal-button-delete" class="btn" rel="tooltip" title="<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Delete');?>"><i class="icon-remove"></i></a>
	</td>
</tr>
<?php } ?>