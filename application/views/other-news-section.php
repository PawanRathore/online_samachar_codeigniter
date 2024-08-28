<aside class="page-sidebar col-lg-3 col-md-3 ">                    
                     <section class="widget has-divider" style="padding: 15px;">
                           <h3 class="title" style='margin-bottom: 15px !important;'>अन्य समाचार</h3>
                           <?php
                           $query = "SELECT * FROM `news` where status=1 and category!='9' order by id desc limit 15";
                           $otherNews = $this->master_model->customQueryArray($query);                           
                           ?>
                           <article class="news-item row">      
                                <div class="details col-xl-12 col-12">
                                    <?php 
                                    foreach($otherNews as $newsData){
                                        $newsId = $newsData['id'];
                                        $heading = $newsData['heading'];
                                        $heading_link = str_replace(' ','-',$newsData['heading']);
                                        $category = $newsData['category'];
                                        $description = $newsData['description'];
                                        $image = $newsData['image'];
                                        $date = $newsData['date']; 
                                        $section = $categeries[$newsData['category']]; 
                                        $link = base_url().$section.'/'.$heading_link.'?id='.$newsId;                            
                                    ?>
                                   <h4 class="title"><a href="<?php echo $link;?>"><?php echo $heading;?></a></h4>
                                   <?php } ?>
                               </div>
                           </article><!--//news-item-->                           
                       </section><!--//widget-->
</aside>