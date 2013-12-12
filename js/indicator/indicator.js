function showIndicatorInObject(objectId){
	var indicatorOwner = $('#' + objectId);
	var html = "" +
			"<div class=\"indicator-table\" id=\"indicator-table_" + objectId + "\">"
			+"<img src=\"/kensway/js/indicator/rotateLoader.gif\" class=\"loading-indicator\" />"
			+"</div>";
	$( html ).insertBefore( indicatorOwner );
	$("#indicator-table_"+objectId).css({
		  opacity : 0.5,
		  top     : indicatorOwner.position().top,
		  width   : indicatorOwner.outerWidth(),
		  height  : indicatorOwner.outerHeight()
		});
		$(".loading-indicator").css({
		  top  : (indicatorOwner.height() / 2),
		  left : (indicatorOwner.width() / 2)
		});
		
		$("#indicator-table_"+objectId).fadeIn();
}

function hideIndicatorInObject(objectId){
	var indicatorOwner = $('#' + objectId);
	indicatorOwner.siblings('#indicator-table_' + objectId).fadeOut();
}