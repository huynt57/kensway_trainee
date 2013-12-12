/*
 * function to validate form
 * Input: form id
 * Output: result
 */
function isFormValidate(formId){
	var form = $('#' + formId);
	if(form.length > 0){
		form.validate({
			errorElement:'span',
			errorClass: 'help-block error',
			errorPlacement:function(error, element){
				element.parents('.controls').append(error);
			},
			highlight: function(label) {
				$(label).closest('.control-group').removeClass('error success').addClass('error');
			},
			success: function(label) {
				label.addClass('valid').closest('.control-group').removeClass('error success').addClass('success');
			}
		});
		
		return form.valid();
	}
	
	return false;
}

/*
 * clear all textfield in a form
 * Input: formId
 */
function clearAllTextfieldInForm(formId){
	$("form#"+formId+" :input[type=text]").each(function(){
		 $(this).val('');
	});
	
	$("form#"+formId+" :input[type=password]").each(function(){
		 $(this).val('');
	});
}

/*
 * get from data in JSON format
 * Input: form
 * Output: form data in JSON
 */
function getFormDataInJson($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return JSON.stringify(indexed_array);
}

/*
 * post the ajax form data to backend, and then call the handler
 * Input: 
 * 	form id, 
 * 	post path, 
 * 	handler (bool result, string message): function handler 
 *  
 *  Note: make sure the form have the message div which have id: formId + _message
 */
function postFormDataToPathWithHandler(formId, postPath, handler){
	var form = $('#'+formId);
	if(form.length && postPath.length){
		showIndicatorInObject(formId);

		$.post(postPath, form.serialize(), function(data) {
			hideIndicatorInObject(formId);
			if (data.success == false) {
				//show the message box
				var messageDialog = $('#'+formId+'_message_error');
				if(messageDialog.length){
					messageDialog.show();
					messageDialog.delay(2000).fadeOut();
	
					var messageDialogPlaceholer = $('#'+messageDialog.attr('id')+'_placeholder');
					messageDialogPlaceholer.html(data.message);
					
					//call the handler
					handler(false, null);
				}
				else{
					console.log('cannot get the edit form message placeholder');
				}
			} else {
				var messageDialog = $('#'+formId+'_message_success');
				if(messageDialog.length){
					messageDialog.show();
					messageDialog.delay(2000).fadeOut();
				}
				
				var messageDialogPlaceholer = $('#'+messageDialog.attr('id')+'_placeholder');
				messageDialogPlaceholer.html(data.message);
				
				//call the handler
				handler(true, null);
			}
		}, 'json');
	}
	else{
		console.log('cannot get the edit form');
	}
}