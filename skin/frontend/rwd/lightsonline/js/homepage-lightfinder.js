jQuery(document).ready(function() {
jQuery( "#reset" ).click(function() {
	jQuery("#main-lightfinder").find("select option").prop("selected", false);
});
});
