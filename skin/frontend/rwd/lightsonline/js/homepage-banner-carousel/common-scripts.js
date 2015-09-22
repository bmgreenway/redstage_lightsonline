/* Enabling support for new HTML5 tags for IE6, IE7 and IE8 */
if(navigator.appName == 'Microsoft Internet Explorer' ){
	if( ( navigator.userAgent.indexOf('MSIE 6.0') >= 0 ) || ( navigator.userAgent.indexOf('MSIE 7.0') >= 0 ) || ( navigator.userAgent.indexOf('MSIE 8.0') >= 0 ) ){
		document.createElement('header')
		document.createElement('nav')
		document.createElement('section')
		document.createElement('aside')
		document.createElement('footer')
		document.createElement('article')
		document.createElement('hgroup')
		document.createElement('figure')
		document.createElement('figcaption')
	}
}
/* Enabling support for new HTML5 tags for IE6, IE7 and IE8 */

;(function(jQuery){
	jQuery(function(){

		// Begin input common focus and blur for value.
        jQuery('input:text,input:password,textarea')
			.focus(function(){if(this.value==this.defaultValue){this.value=''}})
			.blur(function(){if(!this.value){this.value=this.defaultValue;}})
		// Ends input common focus and blur for value.
				
		
		if (window.PIE) {jQuery('.gradient, .rounded, .shadow').each(function() {PIE.attach(this);});}
		
		// top nav			
        jQuery('#nav > li').mouseenter(function(){
            jQuery(this).addClass('drpdown');
		})
        jQuery('#nav > li').mouseleave(function(){
            jQuery(this).removeClass('drpdown');
		})		

})// End ready function.


	// Home Slider
    jQuery(window).load(function(){
        jQuery('#homeSlider').flexslider({
			   animation: "slide",
			   slideshow: false,
			   controlNav: true,
			   directionNav: true,
			   useCSS : false,
			   pauseOnHover: true,
			   start: function(slider){
                   jQuery('main').removeClass('loading');
				
			   },
			   animationLoop: true
		  });
		
	});

})(jQuery)