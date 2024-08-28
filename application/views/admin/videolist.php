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
                $adminId = $this->session->userdata('admin_id');
                $query1 = "SELECT * FROM `videos` ORDER BY `id` desc limit 50 ";
                $news = $this->master_model->customQueryArray($query1);
                ?>
            <table class="table">
               <thead>
                  <th>Sr</th>
                  <th style='width:100px'>Date</th>
                  <th>Heading</th>
                  <th>Link</th>   
                  <th>Status</th>
                  <th>Action</th>
               </thead>
               <tbody>
                  <?php 
                     foreach($news as $key=>$newsItem){                     
                       $newsId = $newsItem['id'];                     
                       $status = $newsItem['status'];  
                       $heading = $newsItem['heading'];                     
                       $link = $newsItem['link'];                     
                       $statusType =  $statusString[$status]; 
                   ?>
                  <tr>
                     <td><?php echo $key+1?></td>
                     <td><?php echo $newsItem['create_at']?></td>                    
                     <td><?php echo $newsItem['heading']?></td>
                     <td> <textarea cols="50" rows="20"><?php echo $link?></textarea>  </td>
                     <td><?php echo $statusType?></td>
                     <td style='font-size:15px'>
                        <!-- <a href="<?php echo base_url()?>admin/addNews?id=<?php echo $newsId?>" title='Edit'>
                        <i class="fa fa-edit"></i>
                        </a>                    -->
                        <a title='Delete' onclick="return confirm('Are you sure Deletet This Video ?')" href="<?php echo base_url()?>admin/deleteVideo?id=<?php echo $newsId?>">
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