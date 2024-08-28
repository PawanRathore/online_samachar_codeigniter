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
      <div class="content container">
            <div class="row">
                <div class="col-md-9 col-12">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            
                           <?php                         
                           //$query = "SELECT * FROM `news` where status=1 and category=1 and image!='' order by id desc limit 2";
                           $query = "SELECT * FROM `news` where status=1 and category=1  ORDER BY `date` desc limit 2";
                           $nationalNews = $this->master_model->customQueryArray($query);                            
                           $Sr = 1;
                           foreach($nationalNews as $newsData){
                                    $newsId = $newsData['id'];
                                    $heading = strip_tags($newsData['heading']);
                                    $heading_link = str_replace(' ','-',$newsData['heading']);
                                    $category = $newsData['category'];
                                    $description = strip_tags($newsData['description']);
                                    $image = $newsData['image'];
                                    $date = $newsData['date'];                               
                                    $link = getNewsFullPageLink($newsData);    
                                    $categoryListNewsLink = getNewsListingPage($newsData);
                                    $active =  ($Sr==1) ? "active" : "";
                           ?>
                            <div class="carousel-item <?php echo $active?>">
                            <?php 
                            if($image){
                            ?>
                                <img class="d-block w-100" src="<?php echo base_url();?>uploads/<?php echo $image; ?>" alt="First slide" style="height: 360px;">
                           <?php } ?>
                                <div class="carousel-caption d-none d-md-block">
                                <h5><a href="<?php echo $link;?>" style='color:#ffffff'><?php echo $heading;?></a></h5>                                   
                                </div>
                            </div>
                            <?php $Sr++; } ?>

                            <?php                         
                           $query = "SELECT * FROM `news` where status=1 and category=3 and image!='' ORDER BY `date` desc limit 3";
                           $nationalNews = $this->master_model->customQueryArray($query); 
                           $Sr = 1;
                           foreach($nationalNews as $newsData){
                                    $newsId = $newsData['id'];
                                    $heading = strip_tags($newsData['heading']);
                                    $heading_link = str_replace(' ','-',$newsData['heading']);
                                    $category = $newsData['category'];
                                    $description = strip_tags($newsData['description']);
                                    $image = $newsData['image'];
                                    $date = $newsData['date'];                               
                                    $link = getNewsFullPageLink($newsData);    
                                    $categoryListNewsLink = getNewsListingPage($newsData);
                                    $active =  ($Sr==1) ? "" : "";
                           ?>
                            <div class="carousel-item <?php echo $active?>">
                            <?php 
                            if($image){
                            ?>
                                <img class="d-block w-100" src="<?php echo base_url();?>uploads/<?php echo $image; ?>" alt="First slide" style="height: 360px;;">
                                <?php } ?>
                                <div class="carousel-caption d-none d-md-block">
                                <h5><a href="<?php echo $link;?>" style='color:#ffffff'><?php echo $heading;?></a></h5>                                   
                                </div>
                            </div>
                            <?php $Sr++; } ?>

                            
                            
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                      </div>
                </div>
                
                
                <div class="col-md-3 col-12">
                <div>
					
                        <div class="section_background" style="height: 360px;overflow: hidden;padding: 10px;">
                        <div>
                            <h5><span class="cline"> 
							 <?php 
							$categoryId = 3;
							//echo $getCategeriesHindiName[$categoryId]?> 
							<a style="color: #f56f10 !important;" href="https://mpinfo.org/RSSFeed/RSSFeed_News.xml" target="_blank">MP RSS FEED </a>
							</span>
                            </h5>
                        </div>
                         <marquee behavior="" Scrollamount=2 direction="up" style="height: 300px;overflow: hidden;font-size: 15px;" onmouseover="this.stop();" onmouseout="this.start();"> 
			<?php 
$url = "https://mpinfo.org/RSSFeed/RSSFeed_News.xml";
$rssData = file_get_contents('https://mpinfo.org/RSSFeed/RSSFeed_News.xml');

// From URL to get webpage contents.
// Initialize a CURL session.
// $ch = curl_init();  
// // Return Page contents.
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
// //grab URL and pass it to the variable.
// curl_setopt($ch, CURLOPT_URL, $url); 
// $rssData = curl_exec($ch);
//print($rssData);

            $xml             = simplexml_load_string($rssData);
           
            if($xml){
               $xml             = json_encode($xml);
               $newsItemes 	 = json_decode($xml, true);
			   
			  /* pr($newsItemes['channel']['item']);
			   die(); 
			   pr($newsItemes);
                echo "<br>"; echo "<br>";
			   pr(count($newsItemes['channel']));
			   echo "<br>"; echo "<br>";
			   pr($newsItemes['channel']['item']);
			   echo  count($newsItemes['channel']['item']);
               $channel = $newsItemes['channel'];
               $item = $channel['item'];*/
			   //var_dump($item);
			   //is_array($item);
			   //echo $count = count($item);
			   
			   
			   if(!$newsItemes['channel']['item'][0]['title']){
			   $item = array($newsItemes['channel']['item']); 
			   }else{
			   $item = $newsItemes['channel']['item'];
			   }
			   
               if($item){
               if(is_array($item)){
               foreach($item as $newsData) {
               $heading = $newsData['title'];
               $link = $newsData['link'];                                 
               ?>
               <div style='margin-bottom: 15px;'>
               <a href="<?php echo $link;?>" target="_blank">
               <?php echo $heading;?></a>
               </div>
               <?php } 
               } 
               }
            }?>                          
                         </marquee>
                    </div>
                    
                    
                </div>
                </div>
                
                

                <?php /*?><div class="col-md-3 col-12">
                <div>
                           <?php  
                           $categoryId = 3;
                           $section = $categeries[$categoryId]?>
                    <div class="section_background" style="height: 360px;overflow: hidden;padding: 10px;">
                        <div>
                            <h5><span class="cline"> <?php echo $getCategeriesHindiName[$categoryId]?> Live </span></h5>
                        </div>
                         <marquee behavior="" Scrollamount=2 direction="up" style="height: 300px;overflow: hidden;font-size: 15px;"> 
                            <?php 
                            $query = "SELECT * FROM `news` where status=1 and category=$categoryId ORDER BY `date` desc limit 6";
                            $nationalNews = $this->master_model->customQueryArray($query);                          
                              foreach($nationalNews as $newsData) {
                                 $newsId = $newsData['id'];
                                 $heading = strip_tags($newsData['heading']);
                                 $heading_link = str_replace(' ','-',$newsData['heading']);
                                 $category = $newsData['category'];
                                 $description = strip_tags($newsData['description']);
                                 $image = $newsData['image'];
                                 $date = $newsData['date'];                               
                                 $link = getNewsFullPageLink($newsData);    
                                 $categoryListNewsLink = getNewsListingPage($newsData);
                              ?>
                              <div style='margin-bottom: 15px;'><a href="<?php echo $link;?>"><?php echo $heading;?></a></div>
                              <?php }?>                          
                         </marquee>
                    </div>
                    
                    
                </div>
                </div><?php */?>
                
                
                
            </div>

            <div class="mb30"> </div>

             <section class="promo" style="background: #a3a3a3;color: #ffff;text-align: center;vertical-align: middle;">
               <div class="row">
                  <div class="col-lg-12 col-12" style="min-height: 100px;vertical-align: middle;padding: 30px;">
                     <h2 class="section-heading">Advertise Your Business Here</h2>
                     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed bibendum orci eget nulla mattis, quis viverra
                      tellus porta. Donec vitae neque ut velit eleifend commodo. Maecenas turpis odio, placerat eu lorem ut, suscipit 
                      commodo augue.  </p> -->
                  </div>                 
               </div>               
            </section> 

            <!--//promo-->
            
            <div class="mb30"> </div>
            <div class="row">
               <div class="col-md-9 col-12">
                  <div class="row">
                     <div class="col-md-6 col-12">
                        <div class="section_background">
                           <div>      
                             <?php  
                             $categoryId = 1;
                             $section = $categeries[$categoryId]?>                        
                              <h5><span class="cline"><?php echo $getCategeriesHindiName[$categoryId]?> </span></h5>
                           </div>
                           <?php    
                           $query = "SELECT * FROM `news` where status=1 and category=$categoryId ORDER BY `date` desc limit 2";
                           $nationalNews = $this->master_model->customQueryArray($query);                          
                           foreach($nationalNews as $newsData) {
                              $newsId = $newsData['id'];
                              $heading = strip_tags($newsData['heading']);
                              $heading_link = str_replace(' ','-',$newsData['heading']);
                              $category = $newsData['category'];
                              $description = strip_tags($newsData['description']);
                              $image = $newsData['image'];
                              $date = $newsData['date'];                               
                              $link = getNewsFullPageLink($newsData);    
                              $categoryListNewsLink = getNewsListingPage($newsData);
                           ?>
                           <div class="c-news-item mr15 bootam_line">
                              <div class="">
                                 <a href="<?php echo $link;?>" class='heading' target="_new">
                                 <?php echo substr($heading,0,250);?>
                               </a>
                              </div>
                              <div class="mb15">
                              <?php 
                            if($image){
                            ?>
                              <img class="thumb"  src="<?php echo base_url();?>uploads/<?php echo $image; ?>" width=100 height=100 alt="" style="float: left;margin-right: 10px;">
                                <?php } ?>
                                <div class="title_des">
                                 <?php echo substr($description,0,500);?> 
                                    <!-- <a class="read-more" href="<?php echo $link;?>" target="_new">
                                       Read more
                                       <svg class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                       </svg>                                       
                                    </a> -->
                                 </div>
                              </div>
                           </div>
                           <?php } ?>

                           <div style="margin-bottom: 10px;float: right;margin-right: 15px;">
                                 <a class="read-more" href="<?php echo base_url();?><?php echo $section?>" target="_new">
                                 Read more
                                 <svg width="20" height="20" class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                 <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                 </svg>
                                 <!-- <i class="fas fa-chevron-right"></i> -->
                                 </a>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6 col-12">  
                        <div class="section_background">
                           <div>      
                             <?php  
                             $categoryId = 3;
                             $section = $categeries[$categoryId]?>                        
                              <h5><span class="cline"><?php echo $getCategeriesHindiName[$categoryId]?> </span></h5>
                           </div>
                           <?php    
                           $query = "SELECT * FROM `news` where status=1 and category=$categoryId  ORDER BY `date` desc limit 2";
                           $nationalNews = $this->master_model->customQueryArray($query);                          
                           foreach($nationalNews as $newsData) {
                              $newsId = $newsData['id'];
                              $heading = strip_tags($newsData['heading']);
                              $heading_link = str_replace(' ','-',$newsData['heading']);
                              $category = $newsData['category'];
                              $description = strip_tags($newsData['description']);
                              $image = $newsData['image'];
                              $date = $newsData['date'];                               
                              $link = getNewsFullPageLink($newsData);    
                              $categoryListNewsLink = getNewsListingPage($newsData);
                           ?>
                           <div class="c-news-item mr15 bootam_line">
                              <div class="">
                                 <a href="<?php echo $link;?>" class='heading' target="_new">
                                 <?php echo substr($heading,0,250);?>
                               </a>
                              </div>
                              <div class="mb15">
                              <?php 
                            if($image){
                            ?>
                              <img class="thumb" src="<?php echo base_url();?>uploads/<?php echo $image; ?>" width=100 height=100 alt="" style="float: left;margin-right: 10px;">
                                 <?php } ?>                                 
                                 <div class="title_des">
                                 <?php echo substr($description,0,500);?> 
                                    <!-- <a class="read-more" href="<?php echo $link;?>" target="_new">
                                       Read more
                                       <svg class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                       </svg>                                       
                                    </a> -->
                                 </div>
                              </div>
                           </div>
                           <?php } ?>

                           <div style="margin-bottom: 10px;float: right;margin-right: 15px;">
                                 <a class="read-more" href="<?php echo base_url();?><?php echo $section?>" target="_new">
                                 Read more
                                 <svg width="20" height="20" class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                 <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                 </svg>
                                 <!-- <i class="fas fa-chevron-right"></i> -->
                                 </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-md-3 col-12">
                  <div>
                     <div class="section_background" style="height: 430px;overflow: hidden;">
                        <div>
                           <h5><span class="cline"> SENSEX </span></h5>
                        </div>
                        <div>
                        <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright">
  <a href="https://in.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
  {
  "colorTheme": "light",
  "dateRange": "1M",
  "showChart": true,
  "locale": "in",
  "largeChartUrl": "",
  "isTransparent": false,
  "showSymbolLogo": true,
  "showFloatingTooltip": true,
  "width": "100%",
  "height": "418",
  "plotLineColorGrowing": "rgba(41, 98, 255, 1)",
  "plotLineColorFalling": "rgba(41, 98, 255, 1)",
  "gridLineColor": "rgba(240, 243, 250, 0)",
  "scaleFontColor": "rgba(106, 109, 120, 1)",
  "belowLineFillColorGrowing": "rgba(41, 98, 255, 0.12)",
  "belowLineFillColorFalling": "rgba(41, 98, 255, 0.12)",
  "belowLineFillColorGrowingBottom": "rgba(41, 98, 255, 0)",
  "belowLineFillColorFallingBottom": "rgba(41, 98, 255, 0)",
  "symbolActiveColor": "rgba(41, 98, 255, 0.12)",
  "tabs": [
    {
      "title": "Indices",
      "symbols": [
        {
          "s": "BSE:SENSEX"
        }
      ],
      "originalTitle": "Indices"
    }
  ]
}
  </script>
</div>
<!-- TradingView Widget END -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="mb30"> </div>

            <div class="row">
               <div class="col-md-9">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="section_background">
                           <div>      
                             <?php  
                             $categoryId = 2;
                             $section = $categeries[$categoryId]?>                        
                              <h5><span class="cline"><?php echo $getCategeriesHindiName[$categoryId]?> </span></h5>
                           </div>
                           <?php    
                           $query = "SELECT * FROM `news` where status=1 and category=$categoryId ORDER BY `date` desc limit 2";
                           $nationalNews = $this->master_model->customQueryArray($query);                          
                           foreach($nationalNews as $newsData) {
                              $newsId = $newsData['id'];
                              $heading = strip_tags($newsData['heading']);
                              $heading_link = str_replace(' ','-',$newsData['heading']);
                              $category = $newsData['category'];
                              $description = strip_tags($newsData['description']);
                              $image = $newsData['image'];
                              $date = $newsData['date'];                               
                              $link = getNewsFullPageLink($newsData);    
                              $categoryListNewsLink = getNewsListingPage($newsData);
                           ?>
                           <div class="c-news-item mr15 bootam_line">
                              <div class="">
                                 <a href="<?php echo $link;?>" class='heading' target="_new">
                                 <?php echo substr($heading,0,250);?>
                               </a>
                              </div>
                              <div class="mb15">
                              <?php 
                            if($image){
                            ?>
                              <img class="thumb" src="<?php echo base_url();?>uploads/<?php echo $image; ?>"  width=100 height=100 alt="" style="float: left;margin-right: 10px;">
                                <?php }?>
                                 <div class="title_des">
                                 <?php echo substr($description,0,500);?> 
                                    <!-- <a class="read-more" href="<?php echo $link;?>" target="_new">
                                       Read more
                                       <svg class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                       </svg>                                       
                                    </a> -->
                                 </div>
                              </div>
                           </div>
                           <?php } ?>

                           <div style="margin-bottom: 10px;float: right;margin-right: 15px;">
                                 <a class="read-more" href="<?php echo base_url();?><?php echo $section?>" target="_new">
                                 Read more
                                 <svg width="20" height="20" class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                 <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                 </svg>
                                 <!-- <i class="fas fa-chevron-right"></i> -->
                                 </a>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="section_background">
                           <div>      
                             <?php  
                             $categoryId = 4;
                             $section = $categeries[$categoryId]?>                        
                              <h5><span class="cline"><?php echo $getCategeriesHindiName[$categoryId]?> </span></h5>
                           </div>
                           <?php    
                           $query = "SELECT * FROM `news` where status=1 and category=$categoryId ORDER BY `date` desc limit 2";
                           $nationalNews = $this->master_model->customQueryArray($query);                          
                           foreach($nationalNews as $newsData) {
                              $newsId = $newsData['id'];
                              $heading = strip_tags($newsData['heading']);
                              $heading_link = str_replace(' ','-',$newsData['heading']);
                              $category = $newsData['category'];
                              $description = strip_tags($newsData['description']);
                              $image = $newsData['image'];
                              $date = $newsData['date'];                               
                              $link = getNewsFullPageLink($newsData);    
                              $categoryListNewsLink = getNewsListingPage($newsData);
                           ?>
                           <div class="c-news-item mr15 bootam_line">
                              <div class="">
                                 <a href="<?php echo $link;?>" class='heading' target="_new">
                                 <?php echo substr($heading,0,250);?>
                               </a>
                              </div>
                              <div class="mb15">
                              <?php 
                            if($image){
                            ?>
                              <img class="thumb" src="<?php echo base_url();?>uploads/<?php echo $image; ?>" width=100 height=100 alt="" style="float: left;margin-right: 10px;">
                                 <?php }?>
                                 <div class="title_des">
                                 <?php echo substr($description,0,500);?> 
                                    <!-- <a class="read-more" href="<?php echo $link;?>" target="_new">
                                       Read more
                                       <svg class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                       </svg>                                       
                                    </a> -->
                                 </div>
                              </div>
                           </div>
                           <?php } ?>

                           <div style="margin-bottom: 10px;float: right;margin-right: 15px;">
                                 <a class="read-more" href="<?php echo base_url();?><?php echo $section?>" target="_new">
                                 Read more
                                 <svg width="20" height="20" class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                 <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                 </svg>
                                 <!-- <i class="fas fa-chevron-right"></i> -->
                                 </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3"> 

               <div class="section_background" style='height:430px; overflow:hidden;'>
               <h5><span class="cline">   स्टॉक मार्केट </span></h5>
               <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright"><a href="https://in.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-hotlists.js" async>
  {
  "colorTheme": "light",
  "dateRange": "12M",
  "exchange": "BSE",
  "showChart": true,
  "locale": "in",
  "largeChartUrl": "",
  "isTransparent": false,
  "showSymbolLogo": false,
  "showFloatingTooltip": false,
  "width": "100%",
  "height": "430",
  "plotLineColorGrowing": "rgba(41, 98, 255, 1)",
  "plotLineColorFalling": "rgba(41, 98, 255, 1)",
  "gridLineColor": "rgba(240, 243, 250, 0)",
  "scaleFontColor": "rgba(106, 109, 120, 1)",
  "belowLineFillColorGrowing": "rgba(41, 98, 255, 0.12)",
  "belowLineFillColorFalling": "rgba(41, 98, 255, 0.12)",
  "belowLineFillColorGrowingBottom": "rgba(41, 98, 255, 0)",
  "belowLineFillColorFallingBottom": "rgba(41, 98, 255, 0)",
  "symbolActiveColor": "rgba(41, 98, 255, 0.12)"
}
  </script>
</div>
<!-- TradingView Widget END -->
               </div>
               
               </div>
            </div>

            <div class="mb30"> </div>
            
            <div class="row cols-wrapper">
               <div class="col-lg-3 col-12">
                  <section class="links">
                     <h1 class="section-heading text-highlight"><span class="line">महत्वपूर्ण लिंक</span></h1>
                     <div class="section-content" style="height: 365px;overflow: hidden;">
                     <p>
                            <a href="https://india.gov.in/" target="_new">
                               <svg class="svg-inline--fa fa-caret-right fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                                  <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
                               </svg>
                               <!-- <i class="fas fa-caret-right"></i> -->भारत सरकार
                            </a>
                     </p>   
                     
                        <p>
                           <a href="https://mp.gov.in/" target="_new">
                              <svg class="svg-inline--fa fa-caret-right fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                                 <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
                              </svg>
                              <!-- <i class="fas fa-caret-right"></i> -->मध्य प्रदेश शासन
                           </a>
                        </p>

                        <p>
                           <a href="https://www.mpinfo.org" target="_new">
                              <svg class="svg-inline--fa fa-caret-right fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                                 <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
                              </svg>
                              <!-- <i class="fas fa-caret-right"></i> -->मध्य प्रदेश जनसम्पर्क विभाग 
                           </a>
                        </p>
                        
                        
                        <!--<p>-->
                        <!--   <a href="https://mpinfo.org/RSSFeed/RSSFeed_News.xml" target="_new">-->
                        <!--      <svg class="svg-inline--fa fa-caret-right fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">-->
                        <!--         <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>-->
                        <!--      </svg>-->
                        <!--      मध्य प्रदेश जनसम्पर्क विभाग RSS Feed -->
                        <!--   </a>-->
                        <!--</p>-->
                        
                        <p>
                           <a href="https://mpedistrict.gov.in/MPL/Index.aspx" target="_new">
                              <svg class="svg-inline--fa fa-caret-right fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                                 <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
                              </svg>
                              <!-- <i class="fas fa-caret-right"></i> -->लोक सेवा गारंटी , मध्यप्रदेश
                           </a>
                        </p>
                        <p>
                           <a href="https://samagra.gov.in/" target="_new">
                              <svg class="svg-inline--fa fa-caret-right fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                                 <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
                              </svg>
                              <!-- <i class="fas fa-caret-right"></i> -->समग्र 
                           </a>
                        </p>
                        <p>
                            <a href="https://cmhelpline.mp.gov.in/" target="_new">
                               <svg class="svg-inline--fa fa-caret-right fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                                  <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
                               </svg>
                               <!-- <i class="fas fa-caret-right"></i> -->सीएम हेल्पलाइन
                            </a>
                         </p>
                         
                        <!-- <p>
                            <a href="https://tourism.mp.gov.in/" target="_new">
                               <svg class="svg-inline--fa fa-caret-right fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                                  <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
                               </svg>
                              मध्य प्रदेश पर्यटन
                            </a>
                         </p>-->
                         
                         <p>
                            <a href="https://www.educationportal.mp.gov.in/" target="_new">
                               <svg class="svg-inline--fa fa-caret-right fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                                  <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
                               </svg>
                               <!-- <i class="fas fa-caret-right"></i> -->मध्य प्रदेश एजुकेशन पोर्टल
                            </a>
                         </p>
                         <p>
                            <a href="https://esb.mp.gov.in/" target="_new">
                               <svg class="svg-inline--fa fa-caret-right fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                                  <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
                               </svg>
                               <!-- <i class="fas fa-caret-right"></i> -->मध्यप्रदेश कर्मचारी चयन मंडल
                            </a>
                         </p>
                                               
                         
                     </div>
                     <!--//section-content-->
                  </section>
                  <!--//links-->                  
               </div>
               <!--//col-md-3-->
               <div class="col-lg-6 col-12">
                  
                  <!--//course-finder-->
                  <section class="video">
                     <h1 class="section-heading text-highlight"><span class="line">वीडियो गैलरी  </span></h1>
                     <div class="carousel-controls">
                        <a class="prev" href="#videos-carousel" data-slide="prev">
                           <svg width="20" height="20" class="svg-inline--fa fa-caret-left fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                              <path fill="currentColor" d="M192 127.338v257.324c0 17.818-21.543 26.741-34.142 14.142L29.196 270.142c-7.81-7.81-7.81-20.474 0-28.284l128.662-128.662c12.599-12.6 34.142-3.676 34.142 14.142z"></path>
                           </svg>
                           <!-- <i class="fas fa-caret-left"></i> -->
                        </a>
                        <a class="next" href="#videos-carousel" data-slide="next">
                           <svg width="20" height="20" class="svg-inline--fa fa-caret-right fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                              <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
                           </svg>
                           <!-- <i class="fas fa-caret-right"></i> -->
                        </a>
                     </div>
                     <!--//carousel-controls-->
                     <div class="section-content">
                        <div id="videos-carousel" class="videos-carousel carousel slide">
                           <div class="carousel-inner">

                             <?php 
                              $query = "SELECT * FROM `videos` where status=1 order by id desc limit 6";
                              $videoNews = $this->master_model->customQueryArray($query);  
                              $sv= 1;                        
                              foreach($videoNews as $videoData) {  
                                 $videoLink = $videoData['link'];
                                 $videoHeading = $videoData['heading'];
                                 $active = ($sv==1) ? "active":"";                           
                             ?>
                                 <!--//item-->
                                 <div class="carousel-item item <?php echo $active;?>">
                                 <div class="embed-responsive embed-responsive-16by9 mb-2">        
                                 <iframe class="embed-responsive-item" src="<?php echo $videoLink?>" frameborder="0" allowfullscreen=""></iframe>
                                 </div>
                                 <p class="description" style="font-weight: 600;"><?php echo $videoHeading?></p>
                                 </div>
                                 <!--//item-->
                              <?php 
                              $sv++;
                              }
                              ?>   
                              <!--//item-->
                              
                              
                           </div>
                           <!--//carousel-inner-->
                        </div>
                        <!--//videos-carousel-->  
                        </div>
                     <!--//section-content-->
                  </section>
                  <!--//video-->
               </div>
               <div class="col-lg-3 col-12">
                  
                  <section class="testimonials">
                     <h1 class="section-heading text-highlight"><span class="line"> सुविचार </span></h1>
                     <div class="carousel-controls">
                        <a class="prev" href="#testimonials-carousel" data-slide="prev">
                           <svg width="20" height="20" class="svg-inline--fa fa-caret-left fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                              <path fill="currentColor" d="M192 127.338v257.324c0 17.818-21.543 26.741-34.142 14.142L29.196 270.142c-7.81-7.81-7.81-20.474 0-28.284l128.662-128.662c12.599-12.6 34.142-3.676 34.142 14.142z"></path>
                           </svg>
                           <!-- <i class="fas fa-caret-left"></i> -->
                        </a>
                        <a class="next" href="#testimonials-carousel" data-slide="next">
                           <svg width="20" height="20" class="svg-inline--fa fa-caret-right fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                              <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
                           </svg>
                           <!-- <i class="fas fa-caret-right"></i> -->
                        </a>
                     </div>
                     <!--//carousel-controls-->
                     <div class="section-content" style="height: 365px;overflow: hidden;">
                        <div id="testimonials-carousel" class="testimonials-carousel carousel slide">
                           <div class="carousel-inner">

                           <div class="carousel-item item active">
                                 <blockquote class="quote">
                                    <p style="font-size: 22px;">
                                       <svg width="20" height="20"  class="svg-inline--fa fa-quote-left fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
                                       </svg>
                                       छोटे मन से कोई बड़ा नहीं होता, टूटे मन से कोई खड़ा नहीं होता
                                    </p>
                                 </blockquote>
                                 <div>
                                    <p class="people"><span class="name" style="font-size: 18px;">- अटल बिहारी वाजपेयी </span>
                                        <br>
                                        <span class="title"> </span>
                                    </p>
                                    <!-- <img class="profile" src="<?php echo base_url();?>profile-1.png" alt=""> -->
                                 </div>
                              </div>


                              <div class="carousel-item item">
                                 <blockquote class="quote">
                                    <p style="font-size: 22px;">
                                       <svg width="20" height="20"  class="svg-inline--fa fa-quote-left fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
                                       </svg>
                                       उठो, जागो और तब तक मत रुको जब तक लक्ष्य की प्राप्ति ना हो जाए।

                                    </p>
                                 </blockquote>
                                 <div>
                                    <p class="people"><span class="name" style="font-size: 18px;">- स्वामी विवेकानंद</span>
                                        <br>
                                        <span class="title"> </span>
                                    </p>
                                    <!-- <img class="profile" src="<?php echo base_url();?>profile-1.png" alt=""> -->
                                 </div>
                              </div>
                              
                              <div class="carousel-item item">
                                 <blockquote class="quote">
                                    <p style="font-size: 22px;">
                                       <svg width="20" height="20" class="svg-inline--fa fa-quote-left fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
                                       </svg>
                                       प्रकृति में गहराई से देखो, तब तुम हर एक चीज बेहतर ढंग से समझ पाओगे।
                                    </p>
                                 </blockquote>
                                 <div>
                                    <p class="people"><span class="name" style="font-size: 18px;">-अल्बर्ट आइंस्टीन </span>
                                        <br>
                                        <span class="title"> </span>
                                    </p>
                                    <!-- <img class="profile" src="<?php echo base_url();?>profile-1.png" alt=""> -->
                                 </div>
                              </div>

                              <div class="carousel-item item">
                                 <blockquote class="quote">
                                    <p style="font-size: 22px;">
                                       <svg width="20" height="20" class="svg-inline--fa fa-quote-left fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
                                       </svg>
                                       <!-- <i class="fas fa-quote-left"></i> -->स्वार्थ हर तरह की भाषा बोलता है, हर तरह की भूमिका अदा करता है, यहां तक कि नि:स्वार्थता की भाषा भी नहीं छोड़ता।

                                    </p>
                                 </blockquote>
                                 <div>
                                    <p class="people"><span class="name" style="font-size: 18px;">- रामधारी सिंह दिनकर</span>
                                        <br>
                                        <span class="title"> </span>
                                    </p>
                                    <!-- <img class="profile" src="<?php echo base_url();?>profile-1.png" alt=""> -->
                                 </div>
                              </div>
                              <!--//item-->

                              <div class="carousel-item item">
                                 <blockquote class="quote">
                                    <p style="font-size: 22px;">
                                       <svg width="20" height="20" class="svg-inline--fa fa-quote-left fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
                                       </svg>
                                       ज़िन्दगी साइकिल चलाने की तरह है। अपना बैलेंस बनाए रखने के लिए आपको चलते रहना होता है।
                                    </p>
                                 </blockquote>
                                 <div>
                                    <p class="people"><span class="name" style="font-size: 18px;">-अल्बर्ट आइंस्टीन </span>
                                        <br>
                                        <span class="title"> </span>
                                    </p>
                                    <!-- <img class="profile" src="<?php echo base_url();?>profile-1.png" alt=""> -->
                                 </div>
                              </div>

                              <div class="carousel-item item">
                                 <blockquote class="quote">
                                    <p style="font-size: 22px;">
                                       <svg width="20" height="20" class="svg-inline--fa fa-quote-left fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
                                       </svg>
                                       ख़ुद को कमज़ोर समझना सबसे बड़ा पाप है।

                                    </p>
                                 </blockquote>
                                 <div>
                                    <p class="people"><span class="name" style="font-size: 18px;">- स्वामी विवेकानंद</span>
                                        <br>
                                        <span class="title"> </span>
                                    </p>
                                    <!-- <img class="profile" src="<?php echo base_url();?>profile-1.png" alt=""> -->
                                 </div>
                              </div>


                              <div class="carousel-item item">
                                 <blockquote class="quote">
                                    <p style="font-size: 22px;">
                                       <svg width="20" height="20" class="svg-inline--fa fa-quote-left fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
                                       </svg>
                                       आप कभी फेल नहीं होते, जब तक आप प्रयास करना नहीं छोड़ देते हैं।
                                    </p>
                                 </blockquote>
                                 <div>
                                    <p class="people"><span class="name" style="font-size: 18px;">-अल्बर्ट आइंस्टीन </span>
                                        <br>
                                        <span class="title"> </span>
                                    </p>
                                    <!-- <img class="profile" src="<?php echo base_url();?>profile-1.png" alt=""> -->
                                 </div>
                              </div>

                              <div class="carousel-item item">
                                 <blockquote class="quote">
                                    <p style="font-size: 22px;">
                                       <svg width="20" height="20" class="svg-inline--fa fa-quote-left fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
                                       </svg>
                                       कभी-कभी जिंदगी आपको ईंट से सिर पर मारेगी, लेकिन तब भी आपको अपना भरोसा नहीं खोना है।
                                    </p>
                                 </blockquote>
                                 <div>
                                    <p class="people"><span class="name" style="font-size: 18px;">- स्टीव जॉब्स</span>
                                        <br>
                                        <span class="title"> </span>
                                    </p>
                                    <!-- <img class="profile" src="<?php echo base_url();?>profile-1.png" alt=""> -->
                                 </div>
                              </div>
                              
                              <div class="carousel-item item">
                                 <blockquote class="quote">
                                    <p style="font-size: 22px;">
                                       <svg width="20" height="20" class="svg-inline--fa fa-quote-left fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
                                       </svg>
                                       किसी दिन, जब आपके सामने कोई समस्या ना आए-आप सुनिश्चित हो सकते हैं कि आप गलत मार्ग पर चल रहे हैं।
                                    </p>
                                 </blockquote>
                                 <div>
                                    <p class="people"><span class="name" style="font-size: 18px;">- स्वामी विवेकानंद</span>
                                        <br>
                                        <span class="title"> </span>
                                    </p>
                                    <!-- <img class="profile" src="<?php echo base_url();?>profile-1.png" alt=""> -->
                                 </div>
                              </div>

                              <div class="carousel-item item">
                                 <blockquote class="quote">
                                    <p style="font-size: 22px;">
                                       <svg width="20" height="20" class="svg-inline--fa fa-quote-left fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
                                       </svg>
                                       आप केवल उसी चीज़ में वास्तव में निपुण हो सकते हैं जिसे आप प्यार करते हैं।
                                    </p>
                                 </blockquote>
                                 <div>
                                    <p class="people"><span class="name" style="font-size: 18px;">- माया एंजेलो</span>
                                        <br>
                                        <span class="title"> </span>
                                    </p>
                                    <!-- <img class="profile" src="<?php echo base_url();?>profile-1.png" alt=""> -->
                                 </div>
                              </div>

                              <div class="carousel-item item">
                                 <blockquote class="quote">
                                    <p style="font-size: 22px;">
                                       <svg width="20" height="20"  class="svg-inline--fa fa-quote-left fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                          <path fill="currentColor" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
                                       </svg>
                                       एक व्यक्ति भी फ़र्क़ ला सकता है, और हर किसी को यह कोशिश करनी चाहिए।
                                    </p>
                                 </blockquote>
                                 <div>
                                    <p class="people"><span class="name" style="font-size: 18px;">- जॉन एफ़ केनेडी.</span>
                                        <br>
                                        <span class="title"> </span>
                                    </p>
                                    <!-- <img class="profile" src="<?php echo base_url();?>profile-1.png" alt=""> -->
                                 </div>
                              </div>
                           </div>
                           <!--//carousel-inner-->
                        </div>
                        <!--//testimonials-carousel-->
                     </div>
                     <!--//section-content-->
                  </section>
                  <!--//testimonials-->
               </div>
               <!--//col-md-3-->
            </div>

               <div>
               <?php  
               $categoryId = 9;
               $section = $categeries[$categoryId];
               ?>                        

               </div>

            
            <section class="news">
                <h1 class="section-heading text-highlight"><span class="line"><?php echo $getCategeriesHindiName[$categoryId]?></span></h1>
                <div class="carousel-controls">
                   <a class="prev" href="#news-carousel" data-slide="prev">
                      <svg width="20" height="20" class="svg-inline--fa fa-caret-left fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                         <path fill="currentColor" d="M192 127.338v257.324c0 17.818-21.543 26.741-34.142 14.142L29.196 270.142c-7.81-7.81-7.81-20.474 0-28.284l128.662-128.662c12.599-12.6 34.142-3.676 34.142 14.142z"></path>
                      </svg>
                      <!-- <i class="fas fa-caret-left"></i> -->
                   </a>
                   <a class="next" href="#news-carousel" data-slide="next">
                      <svg width="20" height="20"  class="svg-inline--fa fa-caret-right fa-w-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512" data-fa-i2svg="">
                         <path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
                      </svg>
                      <!-- <i class="fas fa-caret-right"></i> -->
                   </a>
                </div>
                <!--//carousel-controls--> 
                <div class="section-content clearfix">
                   <div id="news-carousel" class="news-carousel carousel slide">
                      <div class="carousel-inner">
                         <div class="item carousel-item active">
                            <div class="row">

                            <?php    
                           $query = "SELECT * FROM `news` where status=1 and category=$categoryId ORDER BY `date` desc limit 0,3";
                           $nationalNews = $this->master_model->customQueryArray($query);                          
                           foreach($nationalNews as $newsData) {
                              $newsId = $newsData['id'];
                              $heading = strip_tags($newsData['heading']);
                              $heading_link = str_replace(' ','-',$newsData['heading']);
                              $category = $newsData['category'];
                              $description = strip_tags($newsData['description']);
                              $image = $newsData['image'];
                              $date = $newsData['date'];                               
                              $link = getNewsFullPageLink($newsData);    
                              $categoryListNewsLink = getNewsListingPage($newsData);
                           ?>

                               <div class="col-lg-4 col-12 news-item">
                                  <a href="<?php echo $link;?>" class='heading' target="_new">
                                  <?php echo substr($heading,0,150);?></a>
                                  <?php 
                            if($image){
                            ?>
                                  <img class="thumb" src="<?php echo base_url();?>uploads/<?php echo $image; ?>" width=100 height=100 alt="">
                                  <?php } ?>
                                  <p><?php echo substr($description,0,500);?> </p>
                                  <a class="read-more" href="<?php echo base_url();?><?php echo $section?>">
                                     Read more
                                     <svg width="20" height="20" class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                     </svg>
                                     <!-- <i class="fas fa-chevron-right"></i> -->
                                  </a>
                               </div>
                               <?php } ?>

                               <!--//news-item-->
                           </div>
                            <!--//row-->
                         </div>

                         <div class="item carousel-item">
                            <div class="row">

                            <?php    
                           $query = "SELECT * FROM `news` where status=1 and category=$categoryId ORDER BY `date` desc limit 3,6";
                           $nationalNews = $this->master_model->customQueryArray($query);                          
                           foreach($nationalNews as $newsData) {
                              $newsId = $newsData['id'];
                              $heading = strip_tags($newsData['heading']);
                              $heading_link = str_replace(' ','-',$newsData['heading']);
                              $category = $newsData['category'];
                              $description = strip_tags($newsData['description']);
                              $image = $newsData['image'];
                              $date = $newsData['date'];                               
                              $link = getNewsFullPageLink($newsData);    
                              $categoryListNewsLink = getNewsListingPage($newsData);
                           ?>

                               <div class="col-lg-4 col-12 news-item">
                                  <a href="<?php echo $link;?>" class='heading' target="_new">
                                  <?php echo substr($heading,0,150);?></a>
                                  <?php 
                            if($image){
                            ?>
                                  <img class="thumb" src="<?php echo base_url();?>uploads/<?php echo $image; ?>"  width=100 height=100 alt="">
                                  <?php }?>
                                  <p><?php echo substr($description,0,500);?> </p>
                                  <a class="read-more" href="<?php echo base_url();?><?php echo $section?>">
                                     Read more
                                     <svg width="20" height="20" class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                     </svg>
                                     <!-- <i class="fas fa-chevron-right"></i> -->
                                  </a>
                               </div>
                               <?php } ?>

                               <!--//news-item-->
                           </div>
                            <!--//row-->
                         </div>
                         <!--//item-->
                         
                         <!--//item-->
                      </div>
                      <!--//carousel-inner-->
                   </div>
                   <!--//news-carousel-->  
                </div>
                <!--//section-content-->     
             </section>
             </div>
             <!--//cols-wrapper-->
            </div>
         <!--//content-->
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
</html>
