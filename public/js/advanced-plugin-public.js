jQuery(function () {
	var ajaxurl = smc_book.ajaxurl;
	jQuery(document).on('click', '#btn_fontend_ajax', function () {
		var postdata = "action=public_ajax_request&param=first_ajax_request";
		jQuery.post(ajaxurl, postdata, function (response) {
			var data = jQuery.parseJSON(response);
			if (data.status == 1) {
				alert(data.message);
			}

		});

	});
});