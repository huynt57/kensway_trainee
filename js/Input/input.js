/*
 * disable the keyboard event of an object
 * Input: id of the object
 * output: 
 */
function disableKeyboardInputForObject(objectId){
	//disable the keyboard on date time input
	$('#'+objectId).on('keydown',function(e)
	{ 
	    e.preventDefault();
	});
}

/*
 * disable the object when click checkbox
 * Input: class of the checkbox
 * NOTE: checkbox have to have "target" attribute
 * You can target multi object by put | into target attribute
 */
function enableCheckboxTargetDisableWithClass(checkboxClass){
	$("."+checkboxClass).change( function(){
		var targetId = $(this).attr('target');
		var targetIds = targetId.split('|');

		for ( var i = 0; i < targetIds.length; i++ ) {
    		var objectId = targetIds[i];
    		if(objectId.length > 0){
        		var target = $('#'+objectId);
        		if(target.length > 0){
            		if($(this).prop('checked')){
            			target.prop('disabled', false);
            		}
            		else{
            			target.prop('disabled', true);
            		}
        		}
    		}
		}
	});
}

/*
 * disable or enable an enablercheckbox, this will also change the disable state of the target object
 * Input: class of the checker
 * NOTE: this will work on all checkbox and target with the same class
 */
function toggleEnablerCheckboxWithClass(checkboxClass,isEnable){
	$("."+checkboxClass).each( function(){
		if(isEnable){
			if($(this).prop('checked')){
			}
			else{
				$(this).iCheck('check');
			}
		}
		else{
			if($(this).prop('checked')){
				$(this).iCheck('uncheck');
			}
		}
		
		var targetId = $(this).attr('target');
		var targetIds = targetId.split('|');

		for ( var i = 0; i < targetIds.length; i++ ) {
    		var objectId = targetIds[i];
    		if(objectId.length > 0){
        		var target = $('#'+objectId);
        		if(target.length > 0){
            		if(isEnable){
            			target.prop('disabled', false);
            		}
            		else{
            			target.prop('disabled', true);
            		}
        		}
    		}
		}
	});
}

function toggleICheckboxWithId(checkboxId,isEnable){
	$("#"+checkboxId).each( function(){
		if(isEnable){
			if($(this).prop('checked')){
			}
			else{
				$(this).iCheck('check');
			}
		}
		else{
			if($(this).prop('checked')){
				$(this).iCheck('uncheck');
			}
		}
	});
}