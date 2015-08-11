var googleWin = null;
var redirectUrl = '';

function openGoogleWin(elHref) {
	googleWin = window.open(elHref,'GoogleConnectorPopup','width=700,height=600,left=100,top=100,location=no,status=yes,scrollbars=yes,resizable=yes');
	googleWin.focus();
	var watchClose = setInterval(function() {
		if (googleWin && googleWin.closed) {
			clearTimeout(watchClose);
			if(redirectUrl) {
				window.location.href = redirectUrl;
			} else {
				window.location.reload();
			}
		}
	}, 200);
}

Event.observe(window, 'load', function() {
	$$('span.googleconnect\-button > a').each(function(el) {
		el.setAttribute('onclick', "openGoogleWin('"+el.href+"')");
		el.onclick = Function("openGoogleWin('"+el.href+"')");
		el.href = 'javascript:void(0);';
	});
    moveGoogleConnectButton();
});


function moveGoogleConnectButton()
{
    var wrapper = $('googleconnect_wrapper');
    if(wrapper){
        //standart login page
        var element = $$('.customer-account-login .account-login').first();
        if(Object.isElement(element)){
            element.insert({after:wrapper});
            wrapper.setStyle({'display':'inline-block'});
            return;
        }

        //standart checkout page
        element = $$('.checkout-onepage-index #checkout-step-login #login-form').first();
        if(Object.isElement(element)){
            element.insert({after:wrapper});
            wrapper.setStyle({'display':'block'});
            return;
        }

        //aheadworks checkout page
        element = $$('.aw-onestepcheckout-index-index #aw-onestepcheckout-authentification').first();
        if(Object.isElement(element)){
            element.insert({before:wrapper});
            wrapper.setStyle({'display':'inline-block','margin-left': '10px'});
            return;
        }
    }
}
