
jQuery(function () {
	jQuery('#book_lists').DataTable();

	jQuery('#book_lists_shelf').DataTable();
	// Get the image value
	jQuery(document).on('click', '#text_image', function () {
		var image = wp.media({
			title: "Upload book image",
			multiple: false,
		}).open().on("select", function (e) {
			var upload_image = image.state().get("selection").first();
			var imagejson = upload_image.toJSON();
			jQuery("#book_image").attr("src", imagejson.url);
			jQuery("#book_cover_image").val(imagejson.url);
			//console.log(upload_image.toJSON());
		})
	});

	// Processing Data with using ajax 
	jQuery(document).on('click', '#shelfForm', function () {
		jQuery("#shelfForm").validate({      // form validation with jquery validate
			submitHandler: function () {     //passing data with jQuery ajax
				var shelfForm = jQuery("#shelfForm").serialize();
				shelfForm += "&action=admin_ajax_request&param=create_book_self";
				jQuery.post(ajaxurl, shelfForm, function (response) {
					var data = jQuery.parseJSON(response);
					if (data.status == 1) {
						alert("Book Shelf data insert successfully");
						swal("Book Shelf data insert successfully");
						setTimeout(function () {
							location.reload();
						}, 1000)
					} else {
						alert("Book Shelf data insert failed");
					}
				});
			}
		});
	});

	//Delete book shelf Data
	jQuery(document).on('click', '.btn_delete_book_shelf', function () {
		var book_shelf_id = jQuery(this).attr("data-id");
		var postdata = "action=admin_ajax_request&param=delete_book_self&book_shelf_id=" + book_shelf_id;
		jQuery.post(ajaxurl, postdata, function (response) {
			var data = jQuery.parseJSON(response);
			if (data.status == 1) {
				alert("Book Shelf delete successfully");
				swal("Book Shelf delete successfully");
				setTimeout(function () {
					location.reload();
				}, 1000)
			} else {
				alert("Book shelf delete failed");
			}
		})
	});


	// Create Book Create code
	jQuery(document).on('click', '#sub_mit', function () {
		jQuery("#create_book_form").validate({      // form validation with jquery validate
			submitHandler: function () {     //passing data with jQuery ajax
				var create_book_form = jQuery("#create_book_form").serialize();
				create_book_form += "&action=admin_ajax_request&param=create_book";
				jQuery.get(ajaxurl, create_book_form, function (response) {
					var data = jQuery.parseJSON(response);
					if (data.status == 1) {
						alert("Book  data insert successfully");
						swal("Book  data insert successfully");
						setTimeout(function () {
							location.reload();
						}, 1000)
					} else {
						alert("Book  data insert failed");
					}
				});


			}
		});
	});

	//Delete book  Data
	jQuery(document).on('click', '.btn_delete_book', function () {
		var book_id = jQuery(this).attr("data-id");
		var conf = confirm("Are you sure to delete book list?");
		if (conf) {
			var postdata = "action=admin_ajax_request&param=delete_book&book__id=" + book_id;
			jQuery.post(ajaxurl, postdata, function (response) {
				var data = jQuery.parseJSON(response);
				if (data.status == 1) {
					alert("Book delete successfully");
					setTimeout(function () {
						location.reload();
					}, 500)
				} else {
					alert("Book delete failed");
				}
			});
		}
	});


});