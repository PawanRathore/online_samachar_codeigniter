<!DOCTYPE html>
<html lang="en">
    <?php 
        include('head.php');
        ?>
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
            <div class="col-md-3 pt"></div>
            <div class="col-md-6">
                <div id="error_message">
                </div>
                <div class="ContactusSection LoginSection">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">   
                                <label></label> 
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div style='text-aliegn:center'>
                                    <h4> Admin </h4>
                                    <br>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">   
                                <label></label> 
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div style='text-aliegn:center'>
                                    <div class='error' id='error_message'></div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">   
                                <label>Email</label> 
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="InputSection">
                                    <input type="text" placeholder="Email" id="email" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">   
                                <label>Password</label> 
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="InputSection">
                                    <input type="password" placeholder="Password" id="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6" style="text-align:center">   
                                <input type="button" onclick="return login();" class="subBtn sub" value="Login"/>
                            </div>
                        </div>
                    </div>
                    <!--ContactusSection-->
                </div>
                <!--col-lg-9 - containSection-->
                <div class="col-md-3"></div>
            </div>
            <!--container-->
        </section>
        <!--mainSection-->
        <br/>
        <br/>
        <script>
            function login(){
            	$("#error_message").html('');
            	var password = $("#password").val();
            	var email =    $("#email").val();
            	if(email == ''){
            		$("#error_message").html("<div class='alert alert-danger'><button data-close='alert' class='close'></button><span>Please Enter Email</span></div>");
            		return false;
            	}
            	
            	if(password == ''){
            		$("#error_message").html("<div class='alert alert-danger'><button data-close='alert' class='close'></button><span>Please Enter Password</span></div>");
            		return false;
            	}
            
            	 $.ajax({
                            url: '<?php echo base_url()?>/admin-login-post',
                            type: 'POST',
                            dataType: "json", 
                            data: 'email='+email+'&password='+password,
                            success: function(response) {
            					if(response.success){
            					 <?php /*?>window.location = '<?php echo base_url()?>/admin/Ipo/List';<?php */?>
            					 window.location = '<?php echo base_url()?>/admin';
            					}else{
            						$("#error_message").html("<div class='alert alert-danger'><button data-close='alert' class='close'></button><span>Invalid email or password</span></div>");
            					}
            				}
                        });
            } 
        </script>
        <?php include_once("footer.php");?>