<!-- ******NAV****** -->
<div class="main-nav-wrapper">
         <div class="container">
            <nav class="main-nav navbar navbar-expand-md" role="navigation">
               <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button><!--//nav-toggle-->
               <div class="navbar-collapse collapse" id="navbar-collapse">
                  <ul class="nav navbar-nav">
                     <?php 
                     $linkeSection = $this->uri->segment(1);
                     ?>
                     <li class="nav-item"><a class="nav-link<?php if($linkeSection==''){?> active <?php }?>"  href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                     <li class="nav-item"><a class="nav-link <?php if($linkeSection=='National'){?> active <?php }?>" href="<?php echo base_url();?>National">राष्ट्रीय</a></li>
                     <li class="nav-item"><a class="nav-link <?php if($linkeSection=='International'){?> active <?php }?>"  href="<?php echo base_url();?>International">अंतर्राष्ट्रीय</a></li>
                     <li class="nav-item"><a class="nav-link <?php if($linkeSection=='Madhya-Pradesh'){?> active <?php }?>" href="<?php echo base_url();?>Madhya-Pradesh">मध्य प्रदेश</a></li>
                     <li class="nav-item"><a class="nav-link <?php if($linkeSection=='Ujjain'){?> active <?php }?>" href="<?php echo base_url();?>Ujjain">उज्जैन</a></li>                     
                     <li class="nav-item"><a class="nav-link <?php if($linkeSection=='Business'){?> active <?php }?>" href="<?php echo base_url();?>Business">कारोबार</a></li>
                     <li class="nav-item"><a class="nav-link <?php if($linkeSection=='Sports'){?> active <?php }?>" href="<?php echo base_url();?>Sports">खेल</a></li>
                     <!--<li class="nav-item"><a class="nav-link <?php if($linkeSection=='Other'){?> active <?php }?>" href="<?php echo base_url();?>Other">अन्य</a></li>-->
                     <li class="nav-item"><a class="nav-link <?php if($linkeSection=='footer'){?> active <?php }?>" href="<?php echo base_url();?>#footer">सम्पर्क</a></li>
                     
                    
                     <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           News 
                           <svg class="svg-inline--fa fa-angle-down fa-w-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                              <path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path>
                           </svg>                         
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown-2">
                           <a class="dropdown-item" href="<?php echo base_url();?>news.html">News List</a>
                           <a class="dropdown-item" href="<?php echo base_url();?>news-single.html">Single News (with image)</a>   
                           <a class="dropdown-item" href="<?php echo base_url();?>news-single-2.html">Single News (with video)</a>         
                        </div>
                     </li>                    -->
                     
                  </ul>
                  <!--//nav-->
               </div>
               <!--//navabr-collapse-->
            </nav>
            <!--//main-nav-->
         </div>
         <!--//container-->
      </div>
      <!--//main-nav-container-->

      