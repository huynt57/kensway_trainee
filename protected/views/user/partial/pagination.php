<?php 
	$this->widget('MyLinkPager', array(
			'currentPage'=>($paginationData[Yii::app()->params['PAGINATION_PAGE']]->getCurrentPage()),
			'itemCount'=>$paginationData[Yii::app()->params['PAGINATION_ITEM_COUNT']],
			'pageSize'=>$paginationData[Yii::app()->params['PAGINATION_PAGE']]->getPageSize(),
	));
 ?>