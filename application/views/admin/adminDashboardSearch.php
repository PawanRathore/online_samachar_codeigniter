<html>
<!---------using Meta Data Reload Page 10 Second--------->
	 <meta http-equiv="refresh" content="50; URL=adminDashboardSearch">
    <!---------using Meta Data Reload Page 15 Second End--------->
<head>

<!--<SCRIPT>
setTimeout("self.close()", 5000 ) // after 5 seconds
</SCRIPT>-->


<!--<script type="text/javascript">
setTimeout(
function ( )
{
  self.close();
}, 50);
</script>-->


<!--<script>
function loaded()
{
    alert("Beep!");
    window.setTimeout(CloseMe, 500);
}

function CloseMe() 
{
    window.close();
}
</script>-->
</head>
<body onLoad="openWin()">
<p>Click the button to open a new window and close the window after ten seconds (10000 milliseconds) And Page Is Refresh After 50 Second</p>

<button onClick="openWin()">Open "myWindow"</button>

<script>
function openWin() 
{
    var myWindow = window.open("https://www.google.co.in/search?q=onlinesamachar.in", "myWindow", "width=800,height=600","location=top");
    myWindow.focus();	
	window.resizeTo(0,0); 
    window.moveTo(0,window.screen.availHeight+10);
	
	
	
	//myWindow.document.write("<p>This is 'myWindow'</p>");
    //window.focus();s
	
	//function newwindow()  
//{  
   // var myChild= window.open('link.html','','width=,height=,resizable=no');  
   // myChild.blur();
//} 
	
	setTimeout(function(){ myWindow.close() }, 10000);
	
	
	<!-------Function For Reload Page 5 Second----->
	//setTimeout(function(){ window.location.reload(1);}, 5000);
	<!-------Function For Reload Page 5 Second End----->
	
	<!---------using Meta Data Reload Page 5 Second--------->
	// <meta http-equiv="refresh" content="5; URL=http://www.yourdomain.com/yoursite.html">
    <!---------using Meta Data Reload Page 5 Second End--------->
		
}

</script>

</body>