/*
 * enable the ability to open modal when click an object
 * Input: id of the clicked object, modal id
 * output: 
 */
function attachModalToObjectClickEvent(modalId,objectId){
	//event when hit the button detail
	var modal = $('#'+modalId);
	var object = $('#'+objectId);
	
	if(modal.length > 0 && object.length > 0){
		object.click(function() {
			modal.modal('show');
		});
	}
}

function attachModalToObjectClickEventWithShowHandler(modalId,objectId,handler){
	//event when hit the button detail
	var modal = $('#'+modalId);
	var object = $('#'+objectId);
	
	if(modal.length > 0 && object.length > 0){
		object.click(function() {
			modal.modal('show');
			handler();
		});
	}
}