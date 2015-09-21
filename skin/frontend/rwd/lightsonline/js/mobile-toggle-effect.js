//Mobile view toggle effect
jQuery(document).ready(function() {
	jQuery('#main-lightfinder').hide();
	jQuery('#footer_shop_links').hide();
	jQuery('#footer_account_links').hide();
	jQuery('#footer_aboutus_links').hide();
	jQuery('#footer_learn_links').hide();
	jQuery('#home_page_heading_section').hide();
	jQuery('#category_description_std').hide();
	
		jQuery( ".show_hide_toggle" ).click(function() { 
			var toggleDiv = "";
			var toggleClass = '';
			toggleClassName = jQuery(this);
			toggleDiv = toggleClassName.attr('dataparam');	
			
			jQuery('#'+toggleDiv).toggle("slow", function () {
				//for only light finder dive to display show hide option
				if(jQuery(this).is(':visible')){
					//for light finder and home_page_heading_section text change only
					if(toggleDiv == "main-lightfinder" || toggleDiv == "home_page_heading_section" || toggleDiv == "category_description_std")
					{
						toggleClassName.html('Hide');
					}
					toggleClassName.removeClass('show_hide_toggle magic_arrow_down');	
					toggleClassName.addClass('show_hide_toggle magic_arrow_up');
				}else{	
					//for light finder and home_page_heading_section text change only
					if(toggleDiv == "main-lightfinder" || toggleDiv == "home_page_heading_section" || toggleDiv == "category_description_std")
					{
						toggleClassName.html('Show');
					}				
					toggleClassName.removeClass('show_hide_toggle magic_arrow_up');					
					toggleClassName.addClass('show_hide_toggle magic_arrow_down');
				}			
			}); 
			return false;
		});
});