function ajaxCompare(url,id){
	
	//check if checkbox checked
	/*if(jQuery(this).prop('checked') == true){
		alert('rer');
			jQuery(this).prop('checked', true); 
	}else
	{
		alert('else');
	}*/
	
	var saveurl=url;
	
	url = url.replace("catalog/product_compare/add","ajax/whishlist/compare");
	url += 'isAjax/1/';
	jQuery('#ajax_loading'+id).show();
	jQuery.ajax( {
		url : url,
		dataType : 'json',
		success : function(data) {
			jQuery('#ajax_loading'+id).hide();
			if(data.status == 'ERROR'){
				jQuery('#ajax-response-compare .message').html(data.message);
			}else{
				jQuery("#ajaxCompare-"+id).addClass("active");
				jQuery("#ajaxCompare-"+id).attr("onclick", "ajaxdelete('"+saveurl+"',"+id+")");
				jQuery('#ajax-response-compare .message').html(data.message);
				showMessage();
				if(jQuery('.block-compare').length){
                    jQuery('.block-compare').replaceWith(data.sidebar);
                }else{
                    if(jQuery('.col-right').length){
                    	jQuery('.col-right').prepend(data.sidebar);
                    }
                }
			}
		}
	});
}
function ajaxdelete(url,id){
	
	//check if checkbox checked
	/*if(jQuery(this).prop('checked') == true){
		alert('rer');
			jQuery(this).prop('checked', true); 
	}else
	{
		alert('else');
	}*/
	
	
	var saveurl=url;
	url = url.replace("catalog/product_compare/add","ajax/whishlist/deletecompare");
	url += 'isAjax/1/';
	jQuery('#ajax_loading'+id).show();
	jQuery.ajax( {
		url : url,
		dataType : 'json',
		success : function(data) {
			jQuery('#ajax_loading'+id).hide();
			if(data.status == 'ERROR'){
				jQuery('#ajax-response-compare .message').html(data.message);
			}else{
				jQuery('#ajax-response-compare .message').html(data.message);
				showMessage();
				jQuery("#ajaxCompare-"+id).removeClass("active");
				jQuery("#ajaxCompare-"+id).attr('onclick', 'ajaxCompare("'+saveurl+'",'+id+')');
				if(jQuery('.block-compare').length){
                    jQuery('.block-compare').replaceWith(data.sidebar);
                }else{
                    if(jQuery('.col-right').length){
                    	jQuery('.col-right').prepend(data.sidebar);
                    }
                }
			}
		}
	});
}
function ajaxWishlist(url,id){
	url = url.replace("wishlist/index","ajax/whishlist");
	url += 'isAjax/1/';
	jQuery('#ajax_loading'+id).show();
	jQuery.ajax( {
		url : url,
		dataType : 'json',
		success : function(data) {
			jQuery('#ajax_loading'+id).hide();
			if(data.status == 'ERROR'){
				alert(data.message);
			}else{
				alert(data.message);
				if(jQuery('.block-wishlist').length){
                    jQuery('.block-wishlist').replaceWith(data.sidebar);
                }else{
                    if(jQuery('.col-right').length){
                    	jQuery('.col-right').prepend(data.sidebar);
                    }
                }
			}
		}
	});
}


function showMessage()
{
	jQuery(".overlay_image").fadeIn(1000);
	jQuery("#ajax-response-compare").fadeIn(1000);	
}
jQuery(document).ready(function(){
	jQuery('.close_ajax').click(function(){
	jQuery(".overlay_image").fadeOut(1000);
	jQuery("#ajax-response-compare").fadeOut(1000);
});
});
