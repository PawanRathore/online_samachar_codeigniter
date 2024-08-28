<!DOCTYPE html>
<html lang="en">
   <?php include('head.php');?>
   <body>
      <style>
         .error{
         color:red;
         }
      </style>
      <?php include('header.php'); ?>
      <section class="mainContent pt-5">
         <div class="container">
         <div class="row">
         <div class="col-md-3">
            <?php include('left_navigation.php'); ?> 
         </div>
         <div class="col-md-9">
				<?php
				
				$category = "";
				$status =  "";
				$fromDate = "";
				$toDate =  "";
				$search_news_id = "";
				
                $adminId = $this->session->userdata('admin_id');
				//$query1 = "SELECT * FROM `news` ORDER BY `id` desc limit 100";
				$query1 = "SELECT * FROM `news` where 1=1  ";
				$limit = 150;
				
				$where = "";
				if(isset($_POST['fromDate']) && !empty($_POST['fromDate']) ){
				$fromDate =  $_POST['fromDate'];
				$where .= " and date>='".$fromDate."'"; 
				}
				
				if(isset($_POST['toDate'])  && !empty($_POST['toDate']) ){
				$toDate =  $_POST['toDate'];
				$where .= " and date<='".$toDate."'"; 
				}
				
				if(isset($_POST['category'])  && !empty($_POST['category']) ){
				// 
				$category = $_POST['category'];				
				$where .= " and category='".$category."'"; 
				}
				
				if(isset($_POST['status'])  && $_POST['status']!='' ){
				// status
				$status = $_POST['status'];
				$where .= " and status='".$status."'";
				}
				
				if(isset($_POST['search_news_id']) && !empty($_POST['search_news_id']) ){
				$search_news_id = $_POST['search_news_id'];
				$where = " and id='".$search_news_id."'";
				}  
				
				$limit = ($where!='') ? '500' : '150';
				$query1 .=  $where;
				$query1 .=  " ORDER BY `id` desc limit $limit";
                //$query1 = "SELECT * FROM `news` ORDER BY `id` desc limit 100";
                $news = $this->master_model->customQueryArray($query1);
                ?>
                
                <form name="filterForm" id="filterForm" action="<?php echo base_url()?>admin/dashboard" method="post">
                <div class="row">
                 <div class="col-4"> 
                 <input type="text" class="form-control" name="fromDate" id="fromDate" placeholder='From Date' value="<?php echo $fromDate;?>"> 
                 </div>
                 <div class="col-4"> 
                  <input type="text" class="form-control" name="toDate" id="toDate" placeholder='To Date' value="<?php echo $toDate;?>">
                 </div>
                 <div class="col-4"> 
                 <select class="form-control" id="category" name="category">
                     <option value=''>Select</option>
                     <?php 					     
                        foreach($categeries as $key=> $categerie){                        
                          ?>
                     <option value='<?php echo $key?>' <?php if($key==$category){?> selected <?php }?>> <?php echo $categerie?></option>
                     <?php 
                        } ?>
                  </select>
                 </div>                                
                </div>
                
                 <div class="row" style="margin-top:15px;">
                 
                 <div class="col-4"> 
                 <select class="form-control" id="status" name='status'>
                     <option value=''>Select</option>
                     <?php 
					 	
                        foreach($statusString as $statusKey=>$statusItem){                        
                         ?>
                     <option value="<?php echo $statusKey?>" <?php if($status==$statusKey){?> selected <?php }?>> <?php echo $statusItem?> </option>
                     <?php 
                        }?>
                  </select>
                 </div>
                 
                  <div class="col-4"> 
                 <input class="form-control" type="text" name="search_news_id" id="search_news_id" placeholder='Search By Id' value="<?php echo $search_news_id;?>"> 
                 </div>
                 
                 <div class="col-4"> </div>                                
                </div>
                
                 <div class="row" style="margin-top:15px;">
                 <div class="col-4"> </div>
                 <div class="col-4"> 
                 <input class="btn btn-primary" type="submit" name="submit" id="submit" value="submit">
                 </div>
                 <div class="col-4"> </div>                                
                </div>
                </form>
                
            <table class="table" style="margin-top:15px;">
               <thead>
                  <th>Sr</th>
                  <th style='width:100px'>Date</th>
                  <th>Category</th>
                  <th>Heading</th>
                  <th>Decrption</th>
                  <th>Status</th>
                  <th>Action</th>
               </thead>
               <tbody>
                  <?php 
                     foreach($news as $key=>$newsItem){                     
                       $newsId = $newsItem['id'];                     
                       $status = $newsItem['status'];                     
                       $statusType =  $statusString[$status];                     
                       $category = $categeries[$newsItem['category']];                     
                     ?>
                  <tr>
                     <td><?php echo $key+1?></td>
                     <td><?php echo $newsItem['date']?></td>
                     <td><?php echo $category?></td>
                     <td><?php echo $newsItem['heading']?></td>
                     <td> <textarea cols="50" rows="20"><?php echo $newsItem['description']?></textarea>  </td>
                     <td><?php echo $statusType?></td>
                     <td style='font-size:15px'>
                        <a target="_blank" href="<?php echo base_url()?>admin/addNews?id=<?php echo $newsId?>" title='Edit'>
                        <i class="fa fa-edit"></i>
                        </a>                   
                        <a title='Delete' onclick="return confirm('Are you sure Deletet This News ?')" href="<?php echo base_url()?>admin/deleteNews?id=<?php echo $newsId?>">
                        <i class="fa fa-trash" aria-hidden="true" style="color:red"></i>
                        </a>
                     </td>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
         <!--container-->
      </section>
      <!--mainSection-->
      <br/>
      <br/>
      <?php include_once("footer.php");?>