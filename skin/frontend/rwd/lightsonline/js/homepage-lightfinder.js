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
			 	catalogsearchUrl=catalogsearchUrl+'?rooms='+roomval;
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

			 		catalogsearchUrl=catalogsearchUrl+'?category='+typeval;
			 	}
			 	else
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'&category='+typeval;
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
			 		catalogsearchUrl=catalogsearchUrl+'?finish_filter='+finishval;
			 	}
			 	else
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'&finish_filter='+finishval;
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
			 		catalogsearchUrl=catalogsearchUrl+'?style_filter='+styleval;
			 	}
			 	else
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'&style_filter='+styleval;
			 	}
			 }
			 
			}
		//============================
		//===========================\
		//budget
			if(document.getElementById("budget"))
			{
			var budget = document.getElementById("budget");
			 var budgetval = budget.options[budget.selectedIndex].value;
			 if(budgetval!='') {
			 	validatedrop=1;
			 	 budgetval = budgetval.split("-");
			 	if(catalogsearchUrl.indexOf("?") == -1)
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'?price[from]='+budgetval[0]+'&price[to]='+budgetval[1];
			 	}
			 	else
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'&price[from]='+budgetval[0]+'&price[to]='+budgetval[1];
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
function sumitlightfinderMobile(catalogsearchUrl)
	{
		// room  type_of_bulbs  finish  style
		var indicator=0;
		var validatedrop=0;
		// Room
			if(document.getElementById("room-mobile"))
			{
			var room = document.getElementById("room-mobile");
			 var roomval = room.options[room.selectedIndex].value;
			 if(roomval!='') {
			 	validatedrop=1;
			 	catalogsearchUrl=catalogsearchUrl+'?rooms='+roomval;
			 }
			 
			}
		//---------------------------\
		//Type
			if(document.getElementById("type-mobile")){
			var type = document.getElementById("type-mobile");
			 var typeval = type.options[type.selectedIndex].value;
			 if(typeval!='') {
			 	validatedrop=1;
			 	
			 	if(catalogsearchUrl.indexOf("?") == -1)
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'?category='+typeval;
			 	}
			 	else
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'&category='+typeval;
			 	}
			 }
			
			}
		//==============================\	
		// finish

			if(document.getElementById("finish-mobile"))
			{
			var finish = document.getElementById("finish-mobile");
			 var finishval = finish.options[finish.selectedIndex].value;
			 if(finishval!='') {
			 	validatedrop=1;
			 	if(catalogsearchUrl.indexOf("?") == -1)
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'?finish_filter='+finishval;
			 	}
			 	else
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'&finish_filter='+finishval;
			 	}
			 }
			
			}
		//===========================\
		//style
			if(document.getElementById("style-mobile"))
			{
			var style = document.getElementById("style-mobile");
			 var styleval = style.options[style.selectedIndex].value;
			 if(styleval!='') {
			 	validatedrop=1;
			 	if(catalogsearchUrl.indexOf("?") == -1)
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'?style_filter='+styleval;
			 	}
			 	else
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'&style_filter='+styleval;
			 	}
			 }
			 
			}
		//============================
		//===========================\
		//budget
			if(document.getElementById("budget-mobile"))
			{
			var budget = document.getElementById("budget-mobile");
			 var budgetval = budget.options[budget.selectedIndex].value;
			 if(budgetval!='') {
			 	validatedrop=1;
			 	 budgetval = budgetval.split("-");
			 	if(catalogsearchUrl.indexOf("?") == -1)
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'?price[from]='+budgetval[0]+'&price[to]='+budgetval[1];
			 	}
			 	else
			 	{
			 		catalogsearchUrl=catalogsearchUrl+'&price[from]='+budgetval[0]+'&price[to]='+budgetval[1];
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

