/*
 * enable the ajax for a table. We need to make sure all the <th> tag have the id which is match the model property. This id will be used to detect which field will be used for sorting.
 * Input: table id (will be return in the ajax post so we will know which table call the ajax),postPath
 * output: POST: 
 * 	tblSortField: the id of the column which triggered sorting action.
 * 	tblIsAsc: 1 = asc, 0 = desc
 * 	tblId: id of the table
 * NOTE: table have to have sortable class
 */
function ajaxSortTable(tableId, postPath) {
	// sort table tblAdministrator when header was tapped

	// get the table (only work if the table have sortable class)
	var tableSort = $('.table.sortable#' + tableId);

	// handle the click on header event
	$('th.sortable', tableSort).on("click", function() {

		// get the sort state
		var isAsc = 1;
		if ($(this).hasClass('sorting_asc')) {
			isAsc = 0;
		}

		// the header id, this will match the model id
		var elementId = $(this).attr('id');

		var header = $(this);

		showIndicatorInObject(tableSort.attr('id'));
		$.post(postPath, {
			tblSortField : elementId,
			tblIsAsc : isAsc,
			tbnNumberOfEntities : getEntitiesNumberForTable(tableId),
			tblPage : getPageForTable(tableId),
			tblSearch : getSearchStringForTable(tableId),
			tblId : tableSort.attr('id'),
		}, function(data) {
			hideIndicatorInObject(tableSort.attr('id'));
			
			if (data.success == false) {
				// print error message
				console.log('table ajax sort: cannot update table data');
			} else {
				// using ajax to change table data
				$("table#" + data.tblId + " tbody").html(data.tblData);

				// make all the sorting indicator return to default
				$('th.sortable', tableSort).each(function(index) {
					if ($(this).hasClass('sorting_asc')) {
						$(this).toggleClass('sorting_asc sorting');
					} else if ($(this).hasClass('sorting_desc')) {
						$(this).toggleClass('sorting_desc sorting');
					}
				});

				// check the current state of sorting
				if (isAsc == 1) {
					header.toggleClass('sorting sorting_asc');
				} else {
					header.toggleClass('sorting sorting_desc');
				}
				
				//set the data in the field
				setSortObjectForTable(tableId, elementId);
				setSortOrderForTable(tableId, isAsc);
			}
		}, 'json');
	});
}

/*
 * enable the ajax for a table. This will change the number of row the table can display.
 * Input: table id (will be return in the ajax post so we will know which table call the ajax),postPath
 * output: POST: 
 * 	tbnNumberOfEntities: -1 mean all
 * 	tblId: id of the table
 * NOTE: Make sure the table have the class: numberChangable
 */
function ajaxTableEntitiesNumber(tableId, postPath){
	$( "#" + tableId + "-entities-select" )
	  .change(function () {
	    var str = "";
	    $( "#" + tableId + "-entities-select option:selected" ).each(function() {
	      str += $( this ).text() + " ";
	    });
	    
	    showIndicatorInObject(tableId);
	    //call the ajax
	    $.post(postPath, {
	    	tblSortField : getSortObjectForTable(tableId),
			tblIsAsc : getSortOrderForTable(tableId),
	    	tbnNumberOfEntities : str,
	    	tblPage : getPageForTable(tableId),
	    	tblSearch : getSearchStringForTable(tableId),
			tblId : tableId
		}, function(data) {
			hideIndicatorInObject(tableId);
			if (data.success == false) {
				// print error message
				console.log('table ajax number of entities: cannot update table data');
			} else {
				// using ajax to change table data
				$("table#" + data.tblId + " tbody").html(data.tblData);
				$('div#' + tableId + '_paginator').html(data.tblPaginator);
				
				//set value
				setEntitiesNumberForTable(tableId,str);
				
				
			}
		}, 'json');
	  })
	  .change();
}

/*
 * enable the ajax for a table. This will handle the paging in the table
 * Input: table id (will be return in the ajax post so we will know which table call the ajax),postPath
 * output: POST: 
 * 	page: page number
 * 	tblId: id of the table
 * NOTE: Make sure the table have the sibling: <div id="tableId + paginator">
 */
function ajaxPagingTable(tableId, postPath){
	var paginatorDiv = $('div#' + tableId + '_paginator');
	paginatorDiv.on("click","a.paging-number", function() {
		if (!$(this).hasClass('disabled') && !$(this).hasClass('active')) {
			var page = $(this).attr("pagenumber");
			showIndicatorInObject(tableId);

		    //call the ajax
		    $.post(postPath, {
		    	tblSortField : getSortObjectForTable(tableId),
				tblIsAsc : getSortOrderForTable(tableId),
		    	tbnNumberOfEntities : getEntitiesNumberForTable(tableId),
		    	tblPage : page,
		    	tblSearch : getSearchStringForTable(tableId),
				tblId : tableId
			}, function(data) {
				hideIndicatorInObject(tableId);
				if (data.success == false) {
					// print error message
					console.log('table ajax paging: cannot update table data');
				} else {
					// using ajax to change table data
					$("table#" + data.tblId + " tbody").html(data.tblData);
					paginatorDiv.html(data.tblPaginator);
					
					//set paging
					setPageForTable(tableId,page);
				}
			}, 'json');
		}
	});
}

/*
 * Refresh table data
 * Input: table id (will be return in the ajax post so we will know which table call the ajax),postPath
 * output: POST: 
 * 	page: page number
 * 	tblId: id of the table
 * NOTE: Make sure the table have the sibling: <div id="tableId + paginator">
 */
function refreshTable(tableId, postPath){
	showIndicatorInObject(tableId);

    //call the ajax
    $.post(postPath, {
    	tblSortField : getSortObjectForTable(tableId),
		tblIsAsc : getSortOrderForTable(tableId),
    	tbnNumberOfEntities : getEntitiesNumberForTable(tableId),
    	tblPage : getPageForTable(tableId),
    	tblSearch : getSearchStringForTable(tableId),
		tblId : tableId
	}, function(data) {
		hideIndicatorInObject(tableId);
		if (data.success == false) {
			// print error message
			console.log('table ajax refresh: cannot update table data');
		} else {
			// using ajax to change table data
			$("table#" + data.tblId + " tbody").html(data.tblData);
			paginatorDiv.html(data.tblPaginator);
		}
	}, 'json');
}

/*
 * enable the ajax for a table. This will handle the modal view display for object detail
 * Input: table id (will be return in the ajax post so we will know which table call the ajax),postPath
 * output: POST: 
 * 	objectId: id of the object
 * 	tblId: id of the table
 */
function ajaxShowModalForObjectInTable(tableId, postPath,objectId){
	//event when hit the button detail
	var table = $('#'+tableId);
	table.on("click","#"+objectId, function() {
		var buttonDetail = $(this);
		
		var objectId = $(this).attr("objectId");
		if(objectId.length){
			showIndicatorInObject(tableId);
			
			//call the ajax
		    $.post(postPath, {
		    	objectId : objectId,
				tblId : tableId
			}, function(data) {
				hideIndicatorInObject(tableId);
				if (data.success == false) {
					// print error message
					console.log('table ajax modal: cannot update table data');
				} else {
					var modalViewId = buttonDetail.attr("modal-view");
					var modalView = $("#"+modalViewId);
					if(modalView.length){
                                            
						modalView.html(data.modalData);
						modalView.modal('show');
					}
				}
			}, 'json');
		}
	});
}

/*
 * Get, set the sort object (id of the field). Return empty string if not found
 */
function getSortObjectForTable(tableId){
	var tableSort = $('.table.sortable#' + tableId);
	if ( tableSort.length ){
		var sortField = tableSort.siblings('#' + tableId + '_sort_object');
		if(sortField.length){
			return sortField.val();
		}
		else{
			return "";
		}
	}
	else{
		return "";
	}
}

function setSortObjectForTable(tableId, value){
	var tableSort = $('.table.sortable#' + tableId);
	if ( tableSort.length ){
		var sortField = tableSort.siblings('#' + tableId + '_sort_object');
		if(sortField.length){
			return sortField.val(value);
		}
	}
}

/*
 * Get the sort order (id of the field). Return empty string if not found
 */
function getSortOrderForTable(tableId){
	var tableSort = $('.table.sortable#' + tableId);
	if ( tableSort.length ){
		var sortField = tableSort.siblings('#' + tableId + '_sort_order');
		if(sortField.length){
			return sortField.val();
		}
		else{
			return "";
		}
	}
	else{
		return "";
	}
}

function setSortOrderForTable(tableId, value){
	var tableSort = $('.table.sortable#' + tableId);
	if ( tableSort.length ){
		var sortField = tableSort.siblings('#' + tableId + '_sort_order');
		if(sortField.length){
			return sortField.val(value);
		}
	}
}

/*
 * Get the entities number (id of the field). Return empty string if not found
 */
function getEntitiesNumberForTable(tableId){
	var tableSort = $('.table.numberChangable#' + tableId);
	if ( tableSort.length ){
		var entitiesField = tableSort.siblings('#' + tableId + '_entities_number');
		if(entitiesField.length){
			return entitiesField.val();
		}
		else{
			return "";
		}
	}
	else{
		return "";
	}
}

function setEntitiesNumberForTable(tableId,value){
	var tableSort = $('.table.numberChangable#' + tableId);
	if ( tableSort.length ){
		var entitiesField = tableSort.siblings('#' + tableId + '_entities_number');
		if(entitiesField.length){
			return entitiesField.val(value);
		}
	}
}

/*
 * Get the page number (id of the field). Return empty string if not found
 */
function getPageForTable(tableId){
	var tablePage = $('.table#' + tableId);
	if ( tablePage.length ){
		var pageField = tablePage.siblings('#' + tableId + '_paging');
		if(pageField.length){
			return pageField.val();
		}
		else{
			return "0";
		}
	}
	else{
		return "0";
	}
}

function setPageForTable(tableId,value){
	var tablePage = $('.table#' + tableId);
	if ( tablePage.length ){
		var pageField = tablePage.siblings('#' + tableId + '_paging');
		if(pageField.length){
			return pageField.val(value);
		}
	}
}

/*
 * Get the search string. Return empty string if not found
 */
function getSearchStringForTable(tableId){
	var tablePage = $('.table#' + tableId);
	if ( tablePage.length ){
		var pageField = tablePage.siblings('#' + tableId + '_search_string');
		if(pageField.length){
			return pageField.val();
		}
		else{
			return "";
		}
	}
	else{
		return "";
	}
}

function setSearchStringForTable(tableId,value){
	var tablePage = $('.table#' + tableId);
	if ( tablePage.length ){
		var pageField = tablePage.siblings('#' + tableId + '_search_string');
		if(pageField.length){
			return pageField.val(value);
		}
	}
}

/*
 * post the ajax form data
 * Input: 
 * 	form id, 
 * 	post path, 
 * 	the table which will be effected (refresh). Optional
 *  the path for refresh action. optional
 *  modalId: the modal view will be close: optional
 *  
 *  Note: make sure the form have the message div which have id: formId + _message
 */
function postEditDataForAjaxForm(formId, postPath,effectTableId,refreshPath, modalId){
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
				
				//wait a bit before close the modal
				setTimeout(function (){

					if(modalId.length){
						//hide the modal view
						var modalView = $("#"+modalId);
						if(modalView.length){
							modalView.modal('hide');
						}
						else{
							console.log('cannot get the modal view');
						}
					}

		         }, 500);
	
				//refresh table
				if(effectTableId.length && refreshPath.length){
					refreshTable(effectTableId,refreshPath);
				}
			}
		}, 'json');
	}
	else{
		console.log('cannot get the edit form');
	}
}

/*
 * send the search data to the table
 * Input: 
 * 	form id, 
 * 	post path (path to the search action), 
 * 	the table which will be searched
 *  the path for refresh action. optional
 *  modalId: the modal view will be close: optional
 *  
 *  Note: The search string will be serialize and store in the hidden search field of the table
 */
function postSearchDataToTable(formId,tableId,refreshPath, modalId){
	var form = $('#'+formId);
	if(form.length){
		setSearchStringForTable(tableId,getFormDataInJson(form));
		//hide the modal view
		var modalView = $("#"+modalId);
		if(modalView.length){
			modalView.modal('hide');
		}
		else{
			console.log('cannot get the modal view');
		}
		
		//refresh table
		if(tableId.length && refreshPath.length){
			refreshTable(tableId,refreshPath);
		}
	}
	else{
		console.log('cannot get the edit form');
	}
}

/*
 * delete the object from table
 * Input: 
 * 	table id : the table which call this event, 
 * 	post path, 
 * 	objectId: the id of the object will trigger the delete event
 * 
 */
function deleteObjectFromTable(tableId, postPath,deleteButtonId,refreshPath, confirmMessage){
	//event when hit the button detail
	var table = $('#'+tableId);
	table.on("click","#"+deleteButtonId, function() {
		if (confirm(confirmMessage)){
			var objectId = $(this).attr("objectId");
			if(objectId.length){
				showIndicatorInObject(tableId);
				
				//call the ajax
			    $.post(postPath, {
			    	objectId : objectId,
					tblId : tableId
				}, function(data) {
					hideIndicatorInObject(tableId);
					if (data.success == false) {
						// print error message
						console.log('table ajax delete object: cannot update table data');
						var messageDialog = $("#"+tableId+'_message_error');
						messageDialog.html(data.message);
						messageDialog.show();
						messageDialog.delay(2000).fadeOut();
					} else {
						refreshTable(tableId,refreshPath);
						
						var messageDialog = $("#"+tableId+'_message_success');
						messageDialog.html(data.message);
						messageDialog.show();
						messageDialog.delay(2000).fadeOut();
					}
				}, 'json');
			}
		}
	});
}

/*
 * show the edit form
 * Input: 
 * 	table id : the table which call this event, 
 * 	post path, 
 * 	objectId: the id of the object will trigger the open modal event
 *  Note: make sure the form have the input which have name match with the json output
 */
function showEditModal(tableId, postPath,objectId){
	//event when hit the button detail
	var table = $('#'+tableId);
	table.on("click","#"+objectId, function() {
		var buttonDetail = $(this);
		
		var objectId = $(this).attr("objectId");
		if(objectId.length){
			showIndicatorInObject(tableId);
			
			//call the ajax
		    $.post(postPath, {
		    	objectId : objectId,
				tblId : tableId
			}, function(data) {
				hideIndicatorInObject(tableId);
				if (data.success == false) {
					// print error message
					console.log('table ajax edit modal: cannot update table data');
				} else {
					var modalViewId = buttonDetail.attr("modal-view");
					var modalView = $("#"+modalViewId);
					if(modalView.length){
						fillJsonDataToForm(data, modalViewId);
						//input the information
						modalView.modal('show');
					}
				}
			}, 'json');
		}
	});
}

/*
 * fill the return json data to the form
 * Data: json data
 * modalId: the id of the modal view (or parent view) which contain the form. Only the field in this parent can be filled with data
 */
function fillJsonDataToForm(data, modalId){
	var modalView = $("#"+modalId);
	if(modalView.length){
		$.each(data, function(key,value){
			var field = modalView.find('#'+key);
			if(field.length){
				
				var fieldTag = field.prop("tagName");
				switch(fieldTag){
					case 'SPAN':
						field.html(value);
						break;
					case 'SELECT':
						field.multiSelect('deselect_all');
						var selected = [];
						$.each(value.split("|"), function(i,e){
							selected.push( e );
			        	});
						field.multiSelect('select', selected);
						break;
					default:
					{
						type = field.attr('type');
						switch(type){
					        case 'checkbox':
					        	if(value == 1){
					        		if(field.hasClass('icheck-me')){
					        			field.iCheck('check');
					        		}
					        		else{
					        			field.attr('checked', true);
					        		}
					        	}
					        	else{
					        		if(field.hasClass('icheck-me')){
					        			field.iCheck('uncheck');
					        		}
					        		else{
					        			field.attr('checked', false);
					        		}
					        	}
					            break;
					        case 'radio':
					        	field.filter('[value="'+value+'"]').attr('checked', 'checked');
					            break;
					        default:
					        	field.val(value);
						}
					}
				}
			}
	      });
	}
}

/*
 * Replace text in the table.
 * Input: table id, object type, new text
 * Objec type: search, add
 * NOTE: only work with span
 */
function replaceTableElementText(tableId, objectType, text){
	var table = $("#"+tableId);
	if(table.length > 0){
		var tag = $("#"+tableId);
		switch(objectType){
			case 'search':
				tag = $('#'+tableId+'_search_button_title');
				break;
			case 'add':
				tag = $('#'+tableId+'_add_button_title');
				break;
			default:
				break;
		}
		if(tag.length > 0){
			var fieldTag = tag.prop("tagName");
			if(fieldTag == 'SPAN'){
				tag.html(text);
			}
		}
	}
}

/*
 * Get the table's add button id
 * Input:tableId
 * Output:buttonId
 */
function getAddButtonIdOfTable(tableId){
	var table = $("#"+tableId);
	if(table.length > 0){
		return tableId + '_add_button';
	}
	
	return '';
}

/*
 * Get the table's search button id
 * Input:tableId
 * Output:buttonId
 */
function getSearchButtonIdOfTable(tableId){
	var table = $("#"+tableId);
	if(table.length > 0){
		return tableId + '_search_button';
	}
	
	return '';
}

//make the element for ajax ready
$(document).ready(function() {
	//add 2 hidden fields to store the order id and order direction
	var tblSort = $('table.normalTable.sortable');
	var tblSortId = tblSort.attr('id');
	var htmlSort = 	'<input id="'+tblSortId+'_sort_object" value="" type="hidden"/>'+
					'<input id="'+tblSortId+'_sort_order" value="1" type="hidden" />';
	$( htmlSort ).insertAfter( tblSort );
	
	//add the hidden fiends to store the search string (JSON)
	var tblNormal = $('table.normalTable');
	var tblNormalId = tblNormal.attr('id');
	var htmlHiddenSearch = 	'<input id="'+tblNormalId+'_search_string" value="" type="hidden"/>';
	$( htmlHiddenSearch ).insertAfter( tblNormal );
	
	//insert message field
	var tblMessage = $('table.normalTable');
	var tblMessageId = tblMessage.attr('id');
	var htmlMessage = '<div id="'+tblMessageId+'_message_error" class="alert alert-error" style="display: none;">'+
		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		'<span id="'+tblMessageId+'_message_error_placeholder"></span>'+
	'</div>'+
	'<div class="alert alert-success" id="'+tblMessageId+'_message_success" style="display: none;">'+
		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		'<span id="'+tblMessageId+'_message_success_placeholder"></span>'+
	'</div>';
	$( htmlMessage ).insertBefore( tblMessage );
	
	//add the div to contain the number of entity and search
	var htmlTopDiv = '<div id="'+tblMessageId+'_top" class="table_top_div"></div>';
	$( htmlTopDiv ).insertBefore( tblMessage );
	
	//add the entity number selector on top of the table if it have the numberChangable class
	var tblEntities = $('table.normalTable.numberChangable');
	var tblEntitiesId = tblEntities.attr('id');
	var tblEntitiesTopDiv = $('#'+tblEntitiesId+'_top');
	var htmlEntities = "<div class=\"controls table-entites-number\">" +
			"<div class=\"input-mini table-entry-number\">" +
			"<select name=\"select\" size=\"1\" id=\""+tblEntitiesId+"-entities-select\" class='chosen-select nosearch' data-nosearch=\"true\">" +
			"<option value=\"10\">10</option>" +
			"<option value=\"20\">20</option>" +
			"<option value=\"30\">30</option>" +
			"<option value=\"50\">50</option>" +
			"<option value=\"100\">100</option>" +
			"<option value=\"-1\">All</option>" +
			"";
	tblEntitiesTopDiv.append( htmlEntities );
	
	//add the search field
	var tblSearch = $('table.normalTable.advanceSearch');
	var tblSearchId = tblSearch.attr('id');
	var tblSearchTopDiv = $('#'+tblSearchId+'_top');
	var htmlSearch = '<div class="table-advance-search">'+
		'<button class="btn" id="'+tblSearchId+'_search_button"><i class="icon-search"></i><span id="'+tblSearchId+'_search_button_title">Tìm kiếm nâng cao</span></button>'+
		'</div>';
	tblSearchTopDiv.append( htmlSearch );
	
	//add the add new button
	var tblAddNew = $('table.normalTable.addNew');
	var tblAddNewId = tblAddNew.attr('id');
	var tblAddNewTopDiv = $('#'+tblAddNewId+'_top');
	var htmlAddnew = '<div class="table-add-new">'+
		'<button class="btn" id="'+tblAddNewId+'_add_button"><i class="icon-plus-sign"></i><span id="'+tblAddNewId+'_add_button_title">Thêm mới</span></button>'+
		'</div>';
	tblAddNewTopDiv.append( htmlAddnew );
	
	//add a field to store the entity number (hidden)
	var htmlEntitiesInput = '<input id="'+tblEntitiesId+'_entities_number" value="10" type="hidden"/>';
	$( htmlEntitiesInput ).insertAfter( tblEntities );
	
	//add hidden field to store the paging number
	var tblPaging = $('table.normalTable');
	var tblPagingId = tblPaging.attr('id');
	var htmlPage = 	'<input id="'+tblPagingId+'_paging" value="0" type="hidden"/>';
	$( htmlPage ).insertAfter( tblPaging );
});