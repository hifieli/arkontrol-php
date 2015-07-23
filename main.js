$(document).ready(function() {
	
	/*	Handle Close button events	*/
	$('.close').each(function () {
		$(this).click( function () {
			$(this).parent().hide();
		});
	});
	
	/* Initialize tooltips */
    $('[data-toggle="tooltip"]').tooltip(); 

		
});



function ajax_request(call, data) {
	var url	= '/do/ajax.php';

	if (url.indexOf("?") === -1) {
		url += '?callback=?';
	} else {
		url += '&callback=?';
	}
	
	var parms	= data;
	parms.call	= call;

	$.ajax({
		dataType:		"jsonp",	/* quirk: I hate the term 'jsonp'. So, as to not dignify it further, I chose to continue to use the term 'AJAX' even though we are definitely 100% using jsonp. */
		crossDomain:	true,
		url:			url,
		async:			true,
		data:			parms,
		success:		function (response) { ajax_response_handle(response); },
		error:			function (response) { ajax_error(response); }
	})
		
}
function ajax_response_handle(response) {
	//console.log(response);
	if (typeof response !== "undefined") {
		if (typeof response.result !== "undefined") {
			if (response.result !== "error") {
				if ((typeof response.callback !== "undefined") && (response.callback != ""))  {
					window[response.callback](response.data);
					return true;
				}
			}
		}
	}
	
	ajax_error(response);
	return false;
}
function ajax_error(response) {
	//console.log(response);
	if (typeof response !== "undefined") {
		if (typeof response.result !== "undefined") {
			if (response.result == "error") {
				if ((typeof response.msg !== "undefined") && (response.msg != ""))  {
					console.log('AJAX Error:' + response.msg);
				}
			}
		}
	}
}