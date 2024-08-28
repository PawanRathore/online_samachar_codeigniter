   <style>
    .cline{
    border-top: 2px solid #f56f10;
    display: inline-block;
    padding: 0 15px;
    padding-top: 5px;
    font-size: 18px;   
    font-weight: 600;
    color: #f56f10;
    }

    .title{
    font-size: 18px;
    font-weight: 500;
    /* height: 50px; */
    height: auto;
    margin-bottom: 5px;
    line-height: 25px;
    overflow: hidden;
    }
    .title_des{
    text-align: justify;
    overflow: hidden;
    }
    .c-news-item{
    margin-left: 15px;
    float: left;
    height: 180px;
    margin-bottom: 10px;
    width: -webkit-fill-available;
    }
    .mb15{
    margin-bottom: 15px;
    }
    .mr15{
    margin-right: 15px;
    }
    .ml15{
    margin-left: 15px;
    }
    .mb30{
    margin-bottom: 30px; 
    }
    .mt{
    margin-top: 15px;
    }
    .section_background {
    background: #f5f5f5;
    overflow: hidden;   
    }
    .bootam_line{
    border-bottom: 1px solid #f56f10;
    }
    .read-more{
    font-size: 14px;
    font-weight: 500;
    color: #f56f10; 
    }
    .thumb{
    float: left;margin-right: 10px; padding-top: 5px;
    }

    .page-wrapper .page-sidebar .news-item {
     margin-bottom: 0px; !important;
}

a {
    color: #000;
    -webkit-transition: all 0.4s ease-in-out;
    -moz-transition: all 0.4s ease-in-out;
    -ms-transition: all 0.4s ease-in-out;
    -o-transition: all 0.4s ease-in-out;
    line-height: initial;
}

p{
    color: #444;
    font-size: 15px;
    text-align: justify;
}

.page-wrapper .page-heading h1.heading-title {
    margin-top: 0;
    display: inline-block;
    font-size: 28px;
    line-height: initial !important;
}

.heading{
   font-size: 18px;
   font-weight: 600;
}

.text-muted {
    color: #000000!important;
    font-weight: 500;
} 

.footer .bottom-bar .copyright {
    font-size: 15px;
    color: #ffe000e8;
    line-height: 3;
    font-weight: 600;
}

.page-link {
    position: relative;
   display: inline; 
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
}

.page-item.current .page-link {
    background: #f56f10;
    border-color: #f56f10;
}
.page-item.current .page-link {
    z-index: 3;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}

.current{
   position: relative;
    display: inline;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #fff !important;
    background-color: #f56f10;
    border: 1px solid #dee2e6;
}

/* slider heading on small device */
.d-none {
    display: block !important;
}

.page-wrapper .breadcrumbs ul li.current {
    max-width: 100% !important;  
    /* white-space: 'break-spaces' !important;  */
}
</style>

<?php
$appName    = "";
$appMobile  = "";
$appEmail   = "";
$appAddress = "";

$query = "select * from app_details order by id desc limit 1";
$app_details = $this->master_model->customQueryRow($query);
if($app_details){
   $appName    = $app_details['name'];
   $appMobile  = $app_details['mobile'];
   $appEmail   = $app_details['email'];
   $appAddress = $app_details['address'];
}

$categeries = getCategeries();
$statusString = getStatusString();
$getCategeriesHindiName = getCategeriesHindiName();
?>

<header class="header">
        
        <!--//to-bar-->
        <div class="header-main container">
           <div class="row">
              <h1 class="logo col-md-4 col-12">
                 <a href="<?php echo base_url()?>" style="font-family: emoji;color:#FFC700!important;">
                     Online Samachar
                   <!-- <img id="logo" src="<?php echo base_url();?>logo.png" alt="Logo"> -->
               </a>
              </h1>
              <!--//logo-->           
              <div class="info col-md-8 col-12">                  
               
                 <div class="contact float-right">
                    <p class="phone">
                       <svg width="20" height="20" class="svg-inline--fa fa-phone fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                          <path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path>
                       </svg>
                       <!-- <i class="fas fa-phone"></i> --><?php echo $appMobile?>
                    </p>
                    <p class="email">
                       <svg width="20" height="20" class="svg-inline--fa fa-envelope fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                          <path fill="currentColor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
                       </svg>
                       <!-- <i class="fas fa-envelope"></i> --><a href="#"><?php echo $appEmail ?></a>
                    </p>
                 </div>
                 
                 <!--//contact-->
              </div>
              <!--//info-->
           </div>
           <!--//row-->
        </div>
        <!--//header-main-->
     </header>
