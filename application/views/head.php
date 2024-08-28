<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      
      
      <?php /*?>
      
      <div style="font-size:20px;color:#F00;text-align:center;">
      This website is currently undergoing maintenance
      </div> 
      <?php 
	  die();
	  ?>
      <?php */ ?>
      
      <?php 
      $heading = "Online Samachar | News Portal";
      $category = "";
      $description = "";
      $image ="";
      $date = date('Y-m-d');;
      $status = "10";
      $newsId='';
      
      if(isset($_GET['id'])){
      $newsId = $_GET['id'];
      $query = "SELECT * FROM `news` where id='".$newsId."' and status=1 limit 1";
      $newsData = $this->master_model->customQueryRow($query);
      //pr($newsData);
      $heading = $newsData['heading'];
      $categoryId = $newsData['category'];
      
      $description = $newsData['description'];
      $image = $newsData['image'];
      $date = $newsData['date'];
      $status = $newsData['status'];
      $showDate = newsDateFormate($date);
      }       
      ?>
      
      
      <title><?php echo $heading;?></title>
      <!-- Meta -->
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="www.onlinesamachar.com is a leading  Hindi news ujjain portal,ujjain news live,उज्जैन ताजा समाचार, Mahakal Corridor Ujjain,उज्जैन न्यूज़ हेडलाइंस .">
      <meta name="keywords" content="samachar, Ujjain , ujjain News , Mp news , mahakaleshwar उज्जैन, bhasmarti उज्जैन, vikram university ujjain, hotels in ujjain, live ujjain news in hindi, ujjain tourism, ujjain visit, national news, political news, sports news, ujjain tourism">
      
      <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
      
      <meta name="author" content="">      
      <!-- <link rel="shortcut icon" href="https://themes.3rdwavemedia.com/college-green/bs4/4.1.1/favicon.ico"> -->
      <!-- <link href="./Responsive website template for education_files/css" rel="stylesheet" type="text/css"> -->
      <!-- FontAwesome JS -->
      <script src="<?php echo base_url();?>asset/css/all.js.download"></script>
      <!-- Global CSS -->
      <link rel="stylesheet" href="<?php echo base_url();?>asset/css/bootstrap.min.css">
      <!-- Plugins CSS -->
      <link rel="stylesheet" href="<?php echo base_url();?>asset/css/flexslider.css">
      <!-- Theme CSS -->  
      <link id="theme-style" rel="stylesheet" href="<?php echo base_url()?>asset/css/theme-1.css">

 <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     
<?php 
include('google_analytics.php');
?> 
   </head>