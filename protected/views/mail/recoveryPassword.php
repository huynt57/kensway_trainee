<h3 style="font-weight:normal; margin: 20px 0;"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Password Recovery');?></h3>
<p style="font-size:12px; line-height:18px;">
	<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'We just received a recovery password request from you:');?>
	<br /><br />
	<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Username');?>: <a href="#"><?php echo $administrator->username ;?></a><br />
	<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Email');?>: <a href="#"><?php echo $administrator->email ;?></a>
</p>
<p style="font-size:12px; line-height:18px;">
	<?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'This is the new password for your account: ');?><?php echo $new_password ;?>
</p>
<p style="font-size:12px; line-height:18px;">
	<a href="<?php echo Yii::app()->createAbsoluteUrl('Site/ChangePassword',array('id'=>$administrator->user_id));?>"><?php echo Yii::t(Yii::app()->params['TRANSLATE_FILE'],'Please follow this link to begin reset your password');?></a>
</p>