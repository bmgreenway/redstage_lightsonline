
var mpFBConnect = function() {
	return {
		connectStatus: '',
		href: '',
		facebookconnectform: '',
		displayLoginWin: false,
		
		init: function(href) {
			if(FB) {
				FB.getLoginStatus(function(loginStatusResponse) {
					mpFBConnect.connectStatus = loginStatusResponse.status;
				}, true);
			}
			
			if(href) {
				mpFBConnect.href = href;
			}
		},
		
		insertFBConnectForm: function() {
			try {
				if($('facebookconnectform') == null) {
					$$('body').first().insert(mpFBConnect.facebookconnectform);
				}
			} catch(e) {console.log(e);}
		},

		submitFBConnectForm: function() {
			try {
				if($('facebookconnectform') == null) {
					mpFBConnect.insertFBConnectForm();
				}

				$('facebookconnectform').submit();
			} catch(e) {console.log(e);}
		},

		openFBWin: function() {
			if(!mpFBConnect.href) {
				window.location.reload();
			}

			var fbWin = window.open(mpFBConnect.href, 'FacebookConnectorPopup', 'width=500,height=300,left=100,top=100,location=no,status=yes,scrollbars=yes,resizable=yes');
			if(fbWin) {
				fbWin.focus();
			}
		},
		
		loginFB: function() {
			if(mpFBConnect.connectStatus == 'connected') {
				mpFBConnect.submitFBConnectForm();
			} else {
				mpFBConnect.openFBWin();
			}
			return false;
		}
	}
}();


Event.observe(window, 'load', function() {
	$$('span.facebookconnect-button > a').each(function(el) {
		el.setAttribute('onclick', "mpFBConnect.loginFB()");
		el.onclick = Function("mpFBConnect.loginFB()");
		el.href = 'javascript:void(0);';
	});

    moveFacebookConnectButton();
	
	if(mpFBConnect.displayLoginWin) {
		mpFBConnect.openFBWin();
	}
});


function moveFacebookConnectButton()
{
    var wrapper = $('facebookconnect_wrapper');
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