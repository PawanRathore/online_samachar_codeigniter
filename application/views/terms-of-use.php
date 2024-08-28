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
      $heading = "Terms of Use";
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
                         <li class="current">Terms of Use</li>
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

                           <div class="content">
   <div class="container">
        <div class="page" style="min-height:400px;">
         <div class="page-title">
            <h1>Terms of Use</h1>
         </div>
         <div class="page-body">
            <p style="text-align:justify"><strong>Overview</strong><br />
               This Agreement, sets forth the terms and conditions that apply to websites, content and community services offered through site (http://www.onlinesamachar.in&nbsp;and all of it&#39;s) by a Subscriber. &quot;Subscriber&quot; means every person who use/visit/access this/these websites.<br />
               <br />
               <strong>Restrictions on use</strong><br />
               This website is owned and operated by bhadasmedia&nbsp;Team. Contains material which is derived in whole or in part from material supplied by the Company, various news agencies and other sources, and is protected by copyright. The restrictions on use of the material and content on this website by pradeshlive.com are specified below. Except where specifically authorised, the Subscriber may not modify, copy, reproduce, republish, upload, post, transmit or distribute in any way any material from this site including code and software.<br />
               <br />
               By using the http://www.onlinesamachar.in&nbsp;website (other than to read this Agreement for the first time), agrees to comply with all of the terms and conditions hereof. The right to use http://www.onlinesamachar.in&nbsp;website is personal not transferable to any other person or entity.<br />
               <br />
               The Company shall have the right at any time to change or discontinue any aspect or feature of http://www.onlinesamachar.in&nbsp;website, content, hours of availability and equipment needed for access or use.<br />
               <br />
               <strong>Disclaimer of warranty</strong><br />
               The information, Services or data (collectively &quot;information&quot;) made available on http://www.onlinesamachar.in&nbsp;website are provided without warranties of any kind, http://www.onlinesamachar.in&nbsp;specially disclaims any representations and warranties including without limitation, the implied warranties on merchantability and fitness for a particular purpose. http://www.onlinesamachar.in&nbsp;shall absolutely have no liability in connection with the services including without limitation, any liability for damage to your computer/hard ware, data information, materials and business resulting from the information or the lack of information available on http://www.onlinesamachar.in. http://www.onlinesamachar.in&nbsp;shall have no liability for:<br />
               &nbsp;&nbsp;&nbsp; Any loss, or injury caused either in whole or in part by its acts, omissions or for conditions beyond its control, in procuring, compiling or delivering information.<br />
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Any omissions, errors or inaccuracies in the information regardless of how it is caused, or delays or interruptions in delivery of the information; or<br />
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Any decision made or action taken or any damage in reliance upon the Information furnished herein below.<br />
               <br />
               <strong>Copyright</strong><br />
               Unless otherwise stated, copyright and all intellectual property rights in all material presented on http://www.onlinesamachar.in&nbsp;(including but not limited to text, audio, video or graphical images), logos appearing on this site are the property of www.onlinesamachar.in&nbsp;its affiliates and are protected under applicable Indian laws. You agree not to use any framing techniques to enclose any trademark or logo or other proprietary information of http://www.onlinesamachar.in; or remove, conceal or obliterate any copyright or other proprietary notice or any credit-line or date-line on other mark or source identifier included on the webSite/Service, including without limitation, the size, color, location or style of all proprietary marks. Any infringement shall be vigorously defended and pursued to the fullest extent permitted by law.<br />
               <br />
               <strong>Links to Third Party Website</strong><br />
               http://www.onlinesamachar.in&nbsp;has links to other website/websites in the World Wide Web. The privacy policies of these website/websites is not under our control. Once you leave our servers, use of any information you provide is governed by the privacy policy of the website you are visiting. It is advisable to read their privacy policies for further information on the use of website.<br />
               <br />
               If you have any query regarding other operation of http://www.onlinesamachar.in&nbsp;then please feel free to Contact Us by getting our contact details on Contact Us page.
            </p>
            </div>
        </div>
    </div>


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
