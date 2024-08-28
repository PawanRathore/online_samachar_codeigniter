<html>
<meta http-equiv="refresh" content="50; URL=adminSearchNews">
</head>
<body onLoad="openWin()">
<p>hello </p>

<button onClick="openWin()">Open "myWindow"</button>

<?php 
$query = "SELECT * FROM `news` where status=1 ORDER BY rand() limit 1";
$nationalNews = $this->master_model->customQueryRow($query);                          
echo $rand_url_serch = getNewsFullPageLink($nationalNews); 
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