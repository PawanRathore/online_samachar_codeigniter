<html>
<meta http-equiv="refresh" content="50; URL=adminSearchListNews">
</head>
<body onLoad="openWin()">
<p>hello </p>

<button onClick="openWin()">Open "myWindow"</button>

<?php 
$pages = array('http://onlinesamachar.in/Madhya-Pradesh','http://onlinesamachar.in/National','http://onlinesamachar.in/International'
,'http://onlinesamachar.in/Ujjain','http://onlinesamachar.in/Business','http://onlinesamachar.in/Sports');
$rand_url = array_rand($pages, 2);
echo $rand_url_serch =  $pages[$rand_url[0]];
?>


<script>
function openWin() 
{
    var myWindow = window.open('<?php echo $rand_url_serch;?>', "myWindow", "width=800,height=600","location=top");
    myWindow.focus();	
	window.resizeTo(0,0); 
    window.moveTo(0,window.screen.availHeight+10);    	
	setTimeout(function(){ myWindow.close() }, 30000); 
}

</script>

</body>