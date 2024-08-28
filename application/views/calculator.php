<!DOCTYPE html>
<!DOCTYPE html>
<!-- saved from url=(0066)https://themes.3rdwavemedia.com/college-green/bs4/4.1.1/index.html -->
<html lang="en" class="fontawesome-i2svg-active fontawesome-i2svg-complete">
   
    <?php 
	include('head.php');
	?>   

   <body class="home-page">
      <div class="">
      <!-- ******HEADER****** --> 
      <?php include('header.php');?>
      <!--//header-->
      <!-- ******NAV****** -->
      <?php include('nav.php');?>
      <!--//main-nav-container-->
      <!-- ******CONTENT****** --> 
<style>
.read-more{
    font-size: 14px;
    font-weight: 500;
    color: #fff !important;
    }
</style>
      <?php
      $section = $this->uri->segment(1);
      $Categeries = getCategeries();
      //$sectionKey = array_search($section, $Categeries); 

      //$query = "SELECT * FROM `news` where 'status'='1' and category='".$sectionKey."' ORDER BY `date` desc";
      //$news = $this->master_model->customQueryArray($query);
	  
	  //$categeriesHindiName = getCategeriesHindiName();
      $hindiName =  'Calculator';
	  $section = $hindiName; 
      ?>
      <div class="content container">
         <div class="page-wrapper">
             <header class="page-heading clearfix">
                 <h1 class="heading-title float-left"><?php echo $hindiName  ?></h1>
                 <div class="breadcrumbs float-right">
                     <ul class="breadcrumbs-list">
                         <li class="breadcrumbs-label">You are here:</li>
                         <li><a href="<?php echo base_url()?>">Home</a><svg class="svg-inline--fa fa-angle-right fa-w-8" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path></svg><!-- <i class="fas fa-angle-right"></i> --></li>
                         <li class="current"><?php echo $section  ?></li>

                     </ul>
                 </div><!--//breadcrumbs-->
             </header> 
             <div class="page-content">
                 <div class="row page-row">
                     <div class="news-wrapper col-lg-9 col-md-9">  
                       <div class="row">
                       <div class="col-12">
                       
            <form id="calculator" name='calculator' action='<?php echo base_url();?>calculator' method='post'>
            <div class="form-group">
            <label for="startDate">Start Date</label>
            <input type="text" class="form-control" id="startDate" name="startDate" aria-describedby="startDate" placeholder="Enter Start Date" required>
            <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
            </div>
            
            <div class="form-group">
            <label for="endDate">End Date</label>
            <input type="text" class="form-control" id="endDate" name="endDate"aria-describedby="endDate" placeholder="Enter End Date" required>
            
            </div>
            
            
             <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" aria-describedby="amount" placeholder="Enter Amount" required>
            
            </div>
            
            
            <div class="form-group">
            <label for="rate">Rate</label>
            <input type="text" class="form-control" id="rate" name="rate" aria-describedby="rate" placeholder="Enter Rate" required>
           
            </div>
            
             
            <!-- <button type="button" class="btn btn-primary" onClick="showResult();">Submit</button> -->
            <button type="submit" name='submit' id='submit' class="btn btn-primary">Submit</button>
            </form> 
            
            </div>
            </div>
            
            <div class="row">
            <div class="col-12" id="calculator_result" style="margin-top: 20px;font-size: 18px;"> 

            <?php 
            if(isset($_POST['submit'])){
			
                

                $startDate      = $_POST['startDate']; 
                $endDate        = $_POST['endDate'];
                //$days = $_POST['days'];             
                $principalAmount = $_POST['amount'];                
                //$time = $_POST['time'];
                $rate = $_POST['rate'];
                

                echo 'Start Date : '.$startDate.'   End Date : '.$endDate;
                echo "<br>";
                echo "Amount : ".$principalAmount;
                echo "<br>";
                echo "Rate : ".$rate;
                echo "<br>";  echo "<br>";


                //$earlier = new DateTime("2023-12-02");
                //$later = new DateTime("2023-12-16");				
                //$abs_diff = $later->diff($earlier)->format("%a"); //

                $daydiffence = daydiffence($startDate,$endDate);
                //print_r($daydiffence);
                $totalYear   = $daydiffence['totalYear'];
                $totalMonth  = $daydiffence['totalMonth'];
                $days = $daydiffence['totalDays'];
                
                // $total = ($principalAmount*$time*$rate)/100;
                $Annualy = ($principalAmount*12*$rate)/100;
                $oneMonth = ($principalAmount*1*$rate)/100;
                // echo "Annualy Charge for One Year  : " . $Annualy;
                // echo "<br>";
                // echo "One Month Charge : " . $oneMonth;
                // echo "<br>";
                 $perDay = $Annualy/360;
                 $perDay =  round($perDay,4);
                // echo "Per Day Charge : " . $perDay;
                // echo "<br>";
                // echo "<br>";
                // echo "<br>";
                // // echo "Per Day To Monthly : " . round($perDay*30);
                // // echo "<br>";    
                // echo $time ." Month Charge: " . round($oneMonth*$time);
                // echo "<br>";
                // if($days){
                // echo "$days Day Charge: " . round($perDay*$days);
                //}
                echo "Per Day : " . $perDay;                 
                echo "<br>"; 
                echo "Total Days : " . $days;                 
                echo "<br>";                
                $interest =  round($perDay*$days);
                echo "Total interest : " . $interest; 
                echo "<br>";  
                $totalAmount = $principalAmount + $interest;
                echo "Total Amount To Pay : " .$totalAmount;    
                echo "<br>"; echo "<br>";
                echo "Note: The result may vary. Please refer to the manual for confirmation.";		

                
            } 
            ?>
            
            </div>
            </div>
            
  

                        
                         
                     </div><!--//news-wrapper-->
                     
                     <?php 
                     include('other-news-section.php');
                     ?>
                     
                 </div><!--//page-row-->
             </div><!--//page-content-->
         </div><!--//page--> 
     </div>
      <!--//wrapper-->
      <!-- ******FOOTER****** --> 
      <?php 
	 include('footer.php'); 
	  ?>
   </body>

   <script>
       $('.carousel').carousel({
  interval: 2000
})

$('#videos-carousel').carousel({
  interval: 2000
})


   </script>

        <?php 
        if($this->session->userdata('admin_id')){			
        ?>
            <script>
            setTimeout(function(){ myWindow.close() }, 10000);
            </script> 
        <?php 
        }
        ?>
        
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script>
$( function() {
    
	$( "#startDate" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  dateFormat: 'yy-mm-dd'
    });
	
	
	$( "#endDate" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  dateFormat: 'yy-mm-dd'
    });
	
} );

function showResult(){
	var startDate =  $('#startDate').val();
	var endDate =  $('#endDate').val();
	var amount =  $('#amount').val();
	var rate =  $('#rate').val();
	var errorStatus = true;	
	console.log(startDate, endDate, amount, rate);
	
	if(startDate==''){
	errorStatus = false;
	}
	if(endDate==''){
	errorStatus = false;
	}
	if(amount==''){
	errorStatus = false;
	}
	if(rate==''){
	errorStatus = false;
	}
	
	
	if(errorStatus){
	$.ajax({
	url: '<?php echo base_url()?>Welcome/daydiffence', 
	type: 'POST',
	//dataType: "json",
	data: 'startDate='+escape(startDate)+'&endDate='+endDate+'&amount='+amount+'&rate='+rate,
	success: function (response) {
	console.log(response);
	$('#calculator_result').html(response);
	}
	});
	}else{
	$('#calculator_result').html('Please Enter Valid Details');
	}
	
}
</script>
</html>
