jQuery(document).ready(function(){


jQuery('#btn-upload').on("click", function(){
		var image = wp.media({
			title:"Upload Image for My Book",
			multiple:false
		}).open().on("select", function(){
			var upload_image = image.state().get("selection").first();
			var getImage = upload_image.toJSON().url;
			jQuery("#show-image").html("<img src ='" +getImage+"' style='height:50px;width:50px'>");
			jQuery("#image_name").val(getImage);

		});

});

	jQuery('#my-book').DataTable();

jQuery('#frmAddBook').validate({
	submitHandler:function(){
		var postdata = "action=mybook_action&param=save_book&"+jQuery('#frmAddBook').serialize();
		jQuery.post(mybookajaxurl, postdata, function(response){
			var data = jQuery.parseJSON(response);
			if (data.status==1) {
				jQuery.notifyBar({
					cssClass:"success",
					html:data.message
				});				
				setTimeout(function(){
					location.reload();
				},1300)
			}
			else{

			}
		});
	}

});


jQuery('#frmEditBook').validate({
	submitHandler:function(){
		var postdata = "action=mybook_action&param=edit_book&"+jQuery('#frmEditBook').serialize();
		jQuery.post(mybookajaxurl, postdata, function(response){
			var data = jQuery.parseJSON(response);
			if (data.status==1) {
				jQuery.notifyBar({
					cssClass:"success",
					html:data.message
				});
				setTimeout(function(){
					location.reload();
				},1300)
			}
			else{

			}
		});
	}

});

jQuery(document).on("click",".btnbookdelete",function(){
	var conf = confirm("Are You Sure You Want to Delete???");
	if (conf) {

		var book_id = jQuery(this).attr("data-id");
var postdata = "action=mybook_action&param=delete_book&id=" + book_id;
	
		jQuery.post(mybookajaxurl, postdata, function(response){
			var data = jQuery.parseJSON(response);
			if (data.status==1) {
				jQuery.notifyBar({
					cssClass:"success",
					html:data.message
				});
				setTimeout(function(){
					location.reload();
				},1300)
			}
			else{

			}
		});

	}
});


});