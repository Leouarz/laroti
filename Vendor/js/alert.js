/**
* 	display an alert with the gived message
*/
function display_message(alert_class , message) 
{
	document.getElementById("alert-box").className = "alert-box alert-" + alert_class;
	$("#alert-box").html(message + '<span class="alert-close" onclick="hide_alert()"> x </span>');
	$("#alert-box").fadeIn();
}

/**
* 	hide the alert box
*/
function hide_alert() 
{
	$("#alert-box").fadeOut("slow");
}