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

      $categeriesHindiName = getCategeriesHindiName();
      $hindiName=  $categeriesHindiName[$sectionKey];
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
                        <?php 
                        foreach($news as $newsData){
                        $newsId = $newsData['id'];
                        $heading = $newsData['heading'];
                        $category = $newsData['category'];
                        $description = $newsData['description'];
                        $image = $newsData['image'];
                        $date = $newsData['date'];
                        $status = $newsData['status'];
                        $link = getNewsFullPageLink($newsData);  
                        ?>                     
                         <article class="news-item page-row has-divider clearfix row" style='padding-bottom: 0px;'>       
                             <div class="details col-lg-12 col-md-12 col-12">
                                 <h3 style='margin-bottom:0px;'>
                                    <a href="<?php echo $link?>"><?php echo $heading?></a></h3>
                                    <p ><?php echo substr($description,0,1500)?></p>
                                 <a class="btn btn-theme read-more" href="<?php echo $link?>">Read more<svg class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg><!-- <i class="fas fa-chevron-right"></i> --></a>
                             </div>
                         </article><!--//news-item-->
                         <?php } ?>
                         
                         <nav class="pagination-container text-center">
                                <ul class="pagination">
                                <?php foreach ($links as $link) {
                                echo "<li class='page-item'>". $link."</li>";
                                } ?>
                                </ul>
                        </nav>
                         
                        <!-- <nav class="pagination-container text-center">
                           <ul class="pagination">
                               <li class="page-item disabled">
                                   <a class="page-link" href="#" arial-label="previous">
                                       <span aria-hidden="true">«</span>
                                       <span class="sr-only">Previous</span>
                                   </a>
                               </li>
                               <li class="page-item"><a class="page-link" href="#">1<span class="sr-only">(current)</span></a></li>
                               <li class="page-item"><a class="page-link" href="#">2</a></li>
                               <li class="page-item"><a class="page-link" href="#">3</a></li>
                               <li class="page-item"><a class="page-link" href="#">4</a></li>
                               <li class="page-item"><a class="page-link" href="#">5</a></li>
                               <li class="page-item">
                                   <a class="page-link" href="#">
                                       <span aria-hidden="true">»</span>
                                       <span class="sr-only">Next</span>
                                   </a>
                               </li>
                           </ul>
                       </nav>  -->
                         
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
</html>
