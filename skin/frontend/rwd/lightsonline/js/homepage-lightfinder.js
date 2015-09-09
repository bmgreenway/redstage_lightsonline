jQuery(document).ready(function() {
jQuery( ".reset" ).click(function() {
	//for mobile
	if(jQuery("#main-lightfinder"))
		jQuery("#main-lightfinder").find("select option").prop("selected", false);
	//for desktop
	if(jQuery("#main-lightfinder-desktop"))
		jQuery("#main-lightfinder-desktop").find("select option").prop("selected", false);
});
});
