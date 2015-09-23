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
	function sumitlightfinder(catalogsearchUrl)
	{
		// room  type_of_bulbs  finish  style
		var indicator=0;
		var validatedrop=0;
		// Room
			if(document.getElementById("room"))
			{
			var room = document.getElementById("room");
			 var roomval = room.options[room.selectedIndex].value;
			 if(roomval!='') {
			 	validatedrop=1;
			 	catalogsearchUrl=catalogsearchUrl+'?room='+roomval;
			 }
			 
			}
		//---------------------------\
		//Type
			if(document.getElementById("type")){
			var type = document.getElementById("type");
			 var typeval = type.options[type.selectedIndex].value;
			 if(typeval!='') {
			 	validatedrop=1;
			 	
			 	if(catalogsearchUrl.indexOf("?") == -1)
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'?type_of_bulbs='+typeval;
			 	}
			 	else
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'&type_of_bulbs='+typeval;
			 	}
			 }
			
			}
		//==============================\	
		// finish

			if(document.getElementById("finish"))
			{
			var finish = document.getElementById("finish");
			 var finishval = finish.options[finish.selectedIndex].value;
			 if(finishval!='') {
			 	validatedrop=1;
			 	if(catalogsearchUrl.indexOf("?") == -1)
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'?finish='+finishval;
			 	}
			 	else
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'&finish='+finishval;
			 	}
			 }
			
			}
		//===========================\
		//style
			if(document.getElementById("style"))
			{
			var style = document.getElementById("style");
			 var styleval = style.options[style.selectedIndex].value;
			 if(styleval!='') {
			 	validatedrop=1;
			 	if(catalogsearchUrl.indexOf("?") == -1)
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'?style='+styleval;
			 	}
			 	else
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'&style='+styleval;
			 	}
			 }
			 
			}
		//============================
		if(validatedrop==0)
		{
			alert("Please select at least one option.");
			return false;
		}else{
			window.location.href=catalogsearchUrl;
		}
		
	}

