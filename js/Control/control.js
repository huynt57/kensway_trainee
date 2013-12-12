/*
 * disable or enable an object
 * Input: id of the object, state
 * 
 */
function toggleObjectEnableState(objectId, isEnable){
	//disable the keyboard on date time input
	if(isEnable){
		$('#'+objectId).prop('disabled', false);
	}
	else{
		$('#'+objectId).prop('disabled', true);
	}
}