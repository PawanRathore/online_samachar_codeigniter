<!DOCTYPE html>
<html lang="en">
   <?php include('head.php');?>
   <body>
      <style>
         .error{
         color:red;
         }
      </style>
      <?php 
         include('header.php');         
         ?>
      <section class="mainContent pt-5">
         <div class="container">
         <div class="row">
         <div class="col-md-3">
            <?php include('left_navigation.php'); ?>           
         </div>
         <div class="col-md-9">
            <?php
               $adminId = $this->session->userdata('admin_id');
               ?>
            <?php 
               $heading = "";               
               $category = "";               
               $description = "";               
               $image ="";               
               $date = date('Y-m-d');               
               $status = "10";
			   
			   if(isset($_GET['id'])){               
               $newsId = $_GET['id'];               
               $query = "SELECT * FROM `news` where id='".$newsId."' limit 1";               
               $newsData = $this->master_model->customQueryRow($query);               
               //pr($newsData);
			   //echo "<br>"; echo "<br>";
			   $heading = trim(stripslashes($newsData['heading']));  
			   //echo $heading = trim($newsData['heading']);               
               $category = $newsData['category'];               
               $description = trim(stripslashes($newsData['description']));               
               $image = $newsData['image'];               
               $date = $newsData['date'];               
               $status = $newsData['status'];               
               }
               
               ?>
            <form action='<?php echo base_url()?>Admin/addNewsPost' method="post" enctype="multipart/form-data">
               <div class="form-group">
					<?php 
                    if(isset($_GET['id'])){                    
                    ?>
                    <input type="hidden" name='id' id='id' value='<?php echo $_GET['id'];?>'>
                    <?php  
                    }                    
                    ?>
                  <label for="exampleFormControlInput1">Heading</label>
                  <input type="heading" class="form-control" id="heading" name="heading" value="<?php print $heading;?>" placeholder="" required>
               </div>
               <div class="form-group">
                  <label for="category">Category</label>
                  <select class="form-control" id="category" name="category" required>
                     <option value=''>Select</option>
                     <?php 
                        foreach($categeries as $key=> $categerie){
                        
                          ?>
                     <option value='<?php echo $key?>' <?php if($key==$category){?> selected <?php }?>> <?php echo $categerie?></option>
                     <?php 
                        } 
                        
                        ?>
                  </select>
               </div>
               <!-- <div class="form-group">
                  <label for="exampleFormControlSelect2">Example multiple select</label>
                  
                  <select multiple class="form-control" id="exampleFormControlSelect2">
                  
                    <option>1</option>
                  
                    <option>2</option>
                  
                    <option>3</option>
                  
                    <option>4</option>
                  
                    <option>5</option>
                  
                  </select>
                  
                  </div> -->
               <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="50"><?php echo $description;?></textarea>
               </div>
               <div class="form-group">
                  <label for="description">Date</label>
                  <input type="text" class="form-control" id="date" name="date" value='<?php echo $date;?>' placeholder="" required>
               </div>
               <div class="form-group">
                  <label for="exampleFormControlFile1">Image</label>
                  <input type="file" class="form-control-file" id="image" name='image'>
                  <?php 
                     if($image){
                     
                     ?>
                  <img src="<?php echo base_url()?>uploads/<?php echo $image?>" alt="" width='200' height='150'>
                  <?php } ?>
               </div>
               <div class="form-group">
                  <label for="category">Status</label>
                  <select class="form-control" id="status" name='status' required>
                     <option value=''>Select</option>
                     <?php 
                        foreach($statusString as $statusKey=>$statusItem){
                        
                         ?>
                     <option value="<?php echo $statusKey?>" <?php if($status==$statusKey){?> selected <?php }?>> <?php echo $statusItem?> </option>
                     <?php 
                        }
                        
                        ?>
                  </select>
               </div>
               <button type="submit" id='submit' name='submit' class="btn btn-primary">Submit</button>
            </form>
         </div>
         <!--container-->
      </section>
      <!--mainSection-->
      <br/>
      <br/>
      <script>
         ClassicEditor         
         .create( document.querySelector( '#description' ) )         
         .catch( error => {         
         console.error( error );         
         } );         
      </script>
      <!-----Date picker----->
      <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>-->
      <?php include_once("footer.php");?>
      <?php /*?><link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
      <link rel="stylesheet" href="/resources/demos/style.css">
      <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
      <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
      <script>
         $( function() {         
           $( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' });         
         } );         
      </script><?php */?>