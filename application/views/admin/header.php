   <style>
    .cline{
    border-top: 2px solid #6091ba;
    display: inline-block;
    padding: 0 15px;
    padding-top: 5px;
    font-size: 18px;
    font-weight: 500;
    font-weight: 600;
    }
    .title{
    font-size: 18px;
    font-weight: 500;
    height: 50px;
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
    border-bottom: 1px solid #464444;
    }
    .read-more{
    font-size: 14px;
    font-weight: 500;
    }
    .thumb{
    float: left;margin-right: 10px; padding-top: 5px;
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
?>

<header class="header">
        
        <!--//to-bar-->
        <div class="header-main container">
           <div class="row">
              <h1 class="logo col-md-4 col-12">
                 <a href="#" style="font-family: emoji;">
                     <!--Online Samachar-->
                   <!-- <img id="logo" src="<?php echo base_url();?>logo.png" alt="Logo"> -->
               </a>
              </h1>
              <!--//logo-->           
              <div class="info col-md-8 col-12">                  
               <?php 
               if($this->session->userdata('admin_id')){	                 
               ?>
                 <div class="contact float-right">                    
                       <a href="<?php echo base_url()?>admin/logout"> Logout </i> </a>
                    </p>
                 </div>
                 <?php } ?>
                 <!--//contact-->
              </div>
              <!--//info-->
           </div>
           <!--//row-->
        </div>
        <!--//header-main-->
     </header>
<?php 
$categeries = getCategeries();
$statusString = getStatusString();
$getCategeriesHindiName = getCategeriesHindiName();
?>