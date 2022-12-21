function gotolink(link) {		
	window.location.href = link;
}

// close layer when click-out
//document.onclick = mclose; 
var myArray = new Array();
var clkColor;
var newColor;
function mOvr(src,clrOver) {
	src.bgColor = clrOver;
	src.style.cursor = 'hand';
	newColor = clrOver;
}
function mOut(src,clrOut) {	
	if (myArray[src.id] == undefined)
	{
		src.bgColor = clrOut;
		src.style.cursor = 'hand';
	} else {
		src.bgColor = clkColor;
	}
}
function mClk(src,clrOver,clrOut) {
	if (myArray[src.id] == undefined)
	{
		myArray[src.id] = "Click";
		src.bgColor = clrOver;
		clkColor = clrOver;
	} else {
		myArray[src.id] = undefined;
		src.bgColor = newColor;
	}
}
//***********************************

function popupgoto(msg,url) {
	$('<div></div>').dialog({
			modal: true,
			autoOpen: true,
			/*show: 'fade',
			hide: 'fade',*/
			title: 'TPP',
			width: 600,
			height: 300,
			open: function() {
				$('.ui-dialog-buttonpane').find('button:contains(" OK ")')
					.css({
					"background-image": "url(./template/image/icon/tick.png)", "background-repeat":"no-repeat",
					"background-position":"left",
					"width":"80px"
					}
				);				
			 },
			buttons: {
				" OK ": function() { 
					$(this).empty();
					$(this).dialog("close"); 					
				}
			},
			close: function() { 
				location = url;
			 }
		})
		.html(msg)		
}

function popup(msg) {
	$('<div></div>').dialog({
			modal: true,
			autoOpen: true,
			/*show: 'fade',
			hide: 'fade',*/
			title: 'TPP',
			width: 600,
			height: 300,
			open: function() {
				$('.ui-dialog-buttonpane').find('button:contains(" OK ")')
					.css({
					"background-image": "url(./template/image/icon/tick.png)", "background-repeat":"no-repeat",
					"background-position":"left",
					"width":"80px"
					}
				);				
			 },
			buttons: {
				" OK ": function() { 
					$(this).empty();
					$(this).dialog("close"); 
				}
			}
		})
		.html(msg)
}

function confirmgoto(msg,url) {
	$('<div></div>').dialog({
			modal: true,
			autoOpen: true,
			/*show: 'fade',
			hide: 'fade',*/
			title: 'TPP',
			width: 600,
			height: 300,
			open: function() {
				$('.ui-dialog-buttonpane').find('button:contains(" OK ")')
					.css({
					"background-image": "url(./template/image/icon/tick.png)", "background-repeat":"no-repeat",
					"background-position":"left",
					"width":"80px"
					}
				);
				$('.ui-dialog-buttonpane').find('button:contains(" Cancel ")')
					.css({
					"background-image": "url(./template/image/icon/cancel.png)", "background-repeat":"no-repeat",
					"background-position":"left",
					"width":"80px"
					}
				);
			 },
			buttons: {
				" OK ": function() { 
					location = url;				
				},
				" Cancel ": function() { 
					$(this).empty();
					$(this).dialog("close"); 					
				}
			}
		})
		.html(msg)		
}

function showProcessing(){
	//$("#ShowProcessing").css('zIndex',9999);
	
	$("#ShowProcessing").dialog({
			modal: false,
			resizable: false,
			autoOpen: true,
			show: "fade",			
			width: 250,
			height: 110,
			create: function (event, ui) {
       			// $(".ui-widget-header").hide();
				 $('#ShowProcessing').prev('.ui-dialog-titlebar').hide();
				
   			 }
	})
		.html('<div style="padding-top:20px; padding-left:50px; "><img  src="./image/ajax-loader.gif" align="absbottom"/> Processing...</div>');
}

function closeProcessing(){
	$("#ShowProcessing").dialog("close");
	$("#ShowProcessing").empty();
}