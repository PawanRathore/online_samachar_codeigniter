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
      

      <?php 
      $heading = "";
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
      <div class="content container">
         <div class="page-wrapper">
             <header class="page-heading clearfix">
                 <h1 class="heading-title float-left"><?php echo $heading?></li></h1>
                 <div class="breadcrumbs float-right">
                     <ul class="breadcrumbs-list">
                         <li class="breadcrumbs-label">You are here:</li>
                         <li><a href="<?php echo base_url()?>">Home</a><svg class="svg-inline--fa fa-angle-right fa-w-8" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path></svg><!-- <i class="fas fa-angle-right"></i> --></li>
                         <li class="current"><?php echo $heading?></li>
                     </ul>
                 </div><!--//breadcrumbs-->
             </header> 
             <div class="page-content">
               <div class="row page-row">
                   <div class="news-wrapper col-lg-9 col-md-9">                         
                       <article class="news-item">
                           <p class="meta text-muted">
                           <!-- By: <a href="#">Admin</a> |  -->
                           Posted on: <?php echo $showDate?>
                           <?php                           
                            // $wheading = str_replace(' ','-',$heading);
                            // $section = $categeries[$categoryId];
                            // $currentUrl ='http://onlinesamachar.in/'.$section.'?id='.$newsId;
                            
                            $currentUrl = getNewsFullPageLink($newsData);
                            //$whatsupUrl = URLWithoutIndex($currentUrl);
                            $whatsupUrl = rawurlencode($currentUrl);                           
                           ?>
                           <span style="float: right;">
                           <a target="_blank" href="https://api.whatsapp.com/send?text=<?php echo $heading?>!! क्लिक करें:- <?php echo $whatsupUrl;?>" title="whatsapp">
                           <img src="<?php echo base_url()?>/asset/img/whatsapp.png" alt="Share" style="width: 30px;"> 
                           </a>
                           </span> 
                           </p>
                           
                           
                           
                           <?php 
                           if($image){?>
                           <p class="featured-image">
                              <img class="img-fluid" src="<?php echo base_url()?>uploads/<?php echo $image  ?>" alt="image" width="100%"></p>
                           <?php } ?>

                           <?php echo $description;?>

                       </article><!--//news-item-->
                   </div><!--//news-wrapper-->
                   <?php 
                     include('other-news-section.php');
                     ?>
               </div><!--//page-row-->
           </div>
             <!--//page-content-->
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
  interval: 20000
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

</html>
