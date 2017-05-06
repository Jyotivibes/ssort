<?php
@session_start();
include_once '../classes/config.php';
include_once '../classes/connection.php';
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='admin') )
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
		echo '<script>window.location="'.HTTP_SERVER.'/dashboard/admin/super-admin.php"</script>';	
	}
?>

<!DOCTYPE html>
  <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMS - School Management System | Login</title>        
        <!--include head st-->
        <?php include '../includes/head-admin.php'; ?>
         <!--include head en-->
    </head>
    <body>
         <!-- full bg st -->
        <section class="login-super" id="full-bg">
            <div class="container">		
                <div class="row">
                <div class="wrapper"><!--wrapper st-->

                   <!--content info st-->
                   <div class="content-info content-info-sidebar">
                       <h2 class="title-text">Smart Solutions on Realtime Technologies </h2>
<!--                       <p class="lead lead-text">Click here to apply online for School Admission for the session 2016-2017</p>-->
                   
                   </div>
                   <!--content info en-->
                    <!--login st-->
                    <div class="login-box login-sidebar">
                            <div class="wh-box"> 
                                 <div class="panel panel-info panel-login signin-bg">
                                 <div class="panel-body">
                                 <div class="logo-school">
                                    <a href="index.php" class="text-center db-logo">
                                       <img src="../img/super-logo.png" alt="Home" class="center-block">
                                    </a>
                                  </div>
                                  <form class="form-horizontal adminform" id="adminform" method="post">
                                    <div class="form-group m-t-40">
                                      <div class="col-xs-12">
                                          <div class="input-group">
                                              <a href="#" class="input-group-addon"><span class="fa fa-user"></span></a>
                                            <input class="form-control user bg-input" type="text" name="user" placeholder="Username">
                                          </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="col-xs-12">
                                          <div class="input-group">
                                            <a href="#" class="input-group-addon"><span class="fa fa-lock"></span></a>
                                            <input class="form-control password bg-input" type="password" name="password" placeholder="Password">
                                          </div>      
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="col-xs-12">
                                            <input class="form-control btn btn-info dashboard-login btn-signin-full" type="submit" value="Sign In" onclick="return loginformValidationCheckout();">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="col-md-12">
                                        <div class="checkbox checkbox-primary pull-left p-t-0">
                                          <input id="checkbox-signup" type="checkbox">
                                          <label for="checkbox-signup" class="content-color"> Remember me </label>
                                        </div>
                                        <a href="javascript:void(0)" id="to-recover" data-toggle="modal" data-target="#forgotModal" class="text-dark pull-right content-color"><i class="fa fa-lock m-r-5"></i> Forgot password?</a> </div>
                                    </div>
                                                                                                                                        
                                  </form> 
                                  </div><!--panel-body-->
                                  
                                 </div><!--en panel--> 
                                 <!--login btn st>-->
                                 <!-- <span class="icon-wrapper">
                                  <a href="javascript:void(0);" class="sub-link dashboard-login">
                                    <span class="icon">
                                        <i class="fa fa-long-arrow-right"></i>
                                    </span>
                                  </a>
                                  </span>-->
                                  <!--login btn en>-->
                                <!--forgot modal st-->
                                <div class="modal fade" id="forgotModal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="h4 forgot-title">Forgot Password</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal"><!--.form-material-->
                                                <!--<div class="form-group">
                                                        <div class="col-xs-12">
                                                            <input type="text" class="form-control" placeholder="Enter your email id or enrollment no." />
                                                        </div>    
                                                    </div>-->
                                                    <div class="form-group m-t-40">
                                                      <div class="col-xs-12">
                                                          <div class="input-group">
                                                              <a href="#" class="input-group-addon"><span class="fa fa-envelope"></span></a>
                                                            <input class="form-control" type="text"  required="" placeholder="Enter your email id or enrollment no.">
                                                          </div>
                                                      </div>
                                                    </div>
                                                     <div class="form-group m-b-0">
                                                      <div class="col-sm-12 text-center">
                                                        <p>Link to reset password will be sent to your registered email id. In case your email id is not registered please <a href="register2.html" class="text-primary m-l-5"><b>contact</b></a> to school admin department.</p>
                                                      </div>
                                                    </div>  
                                                </form>
                                            </div>
                                            <div class="modal-footer btn-center">
                                                <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <button type="submit" class="btn btn-link">Cancel</button>
                                                            <button type="submit" class="btn btn-info">Submit</button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                                <!--forgot modal en-->
                        </div>
                    </div>
                    <!--login en-->
                </div><!--en wrapper-->
            </div>
        </div>
        </section>    
        <!-- full bg en -->
	  
        <!-- Carousel st -->
		
        <!--modal login st-->
        <!-- Modal -->
<!--<div id="invalidLogin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title h4">Invalid Login</h4>
      </div>
      <div class="modal-body">
        <p class="text-center">Please, enter correct user name & password.</p>
      </div>
    </div>

  </div>
</div>-->
        <!--modal login en-->
        
       
        <!--include footer st-->        
		<?php include '../includes/foot-admin.php'; ?>
        <!--include footer en--> 
    </body>
	 <script type="text/javascript">
////// Login Form validation CHECKOUT
function loginformValidationCheckout(){
alert('hiii');
	if($(".adminform .user").val()==''){
		alert("Please enter your email address");
		$(".adminform .user").focus();
		return false;
	}
	if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test($('.adminform .user').val()))) 
	{
		alert('Invalid Email ID. Please enter the correct Email ID.');
		$(".adminform .user").focus();
		return false;
	}
	if($(".adminform .password").val()==''){		
		alert("Please enter password");
		$(".adminform .password").focus();
		return false;
	}
	var user_email = $('.adminform .user').val();
	alert(user_email);
	var user_password = $('.adminform .password').val();
	alert('<?php echo HTTP_SERVER_ADMIN;?>');
	var xhr=$.post("<?php echo HTTP_SERVER_ADMIN;?>ajax.php",{action:'userlogin',user_email:user_email,user_password:user_password});
	xhr.done(function(data){
			alert(data);
			if(data!="")
				{
					//window.location.reload();
					if(data==1){
						alert("Please enter email and password");
						$("#preloader").css("display","none");
						return false;
					}else if(data==9){
						alert("The email or password you entered is incorrect");
						$("#preloader").css("display","none");
						return false;
					}else if(data==3){
						alert("Your email address is not verified yet");
						$("#preloader").css("display","none");
						return false;
					}else if(data==5){
						//alert("Login Successfully");
						$("#preloader").css("display","none");
						$('.adminform .user').val("");
						$('.adminform .password').val("");
						window.location.reload();
					}
				}
			});
			xhr.fail(function(data){
			//alert("error in network for login");
			$("#preloader").css("display","none");
			return false;
			});
			return false;
			
}
</script>

</html>
