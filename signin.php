<?php 
$actual_link = "$_SERVER[REQUEST_URI]";
$a=explode('/',$actual_link);
//print_r($a);
$dbname=$a[2];
echo $dbname;

	$dbnew = mysql_connect('localhost', 'root', '');
	mysql_select_db("ssort_master", $dbnew);
	$ca=mysql_query("SELECT * FROM essort_school_info WHERE sch_reg_no='MISMTC'",$dbnew) OR die('Query 2 error:<br />' .mysql_error());
	$tableinfo = mysql_fetch_array($ca);
	
	//print_r($tableinfo);
//require_once('classes/connection.php');
require_once('classes/config.php');
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Teacher') )
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
		echo '<script>window.location="http://localhost/sms/dashboard/teacher/teacher.php"</script>';	
	}elseif (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Parent') )
	{		echo '<script>window.location="http://localhost/sms/dashboard/parents/parents.php"</script>';		 }
	elseif (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Chairman') )
	{		echo '<script>window.location="http://localhost/sms/dashboard/chairman/chairman.php"</script>';		 }
	elseif (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Principal') )
	{		echo '<script>window.location="http://localhost/sms/dashboard/principal/principal.php"</script>';		 }
?>
<!DOCTYPE html>
  <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMS - School Management Solutions | Login</title>        
        <!--include head st-->
        <?php include '../includes/head.php'; ?>
         <!--include head en-->
    </head>
    <body>
         <!-- full bg st -->
        <section class="login-background" id="full-bg">
            <div class="container">		
                <div class="row">
                <div class="wrapper"><!--wrapper st-->
                  <div class="login-message">
                      <div class="col-sm-9">
                        <h3 class="login-text"><span>Best School Management System for a 360 Degree Visibility and Administration of your Institution.</span></h3>                        
                      </div>
                      <div class="col-sm-3">
                          <div class="social social-icons">
                            <a href="javascript:void(0)" class="btn btn-facebook" rel="tooltip" data-original-title="Facebook">
                                <i aria-hidden="true" class="fa fa-facebook"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-twitter" rel="tooltip" data-original-title="Twitter">
                                <i aria-hidden="true" class="fa fa-twitter"></i>
                            </a>                              
                            <a href="javascript:void(0)" class="btn btn-googleplus" rel="tooltip" data-original-title="Google plus">
                                <i aria-hidden="true" class="fa fa-google-plus"></i>
                            </a>
                          </div>                 
                      </div>
                  </div><!--en login-message-->
                   
                   <!--content info st-->
                   <div class="content-info content-info-sidebar">
                       <h2 class="title-text"><?php echo $tableinfo[3];?></h2>
                        <!-- <p class="lead lead-text">Click here to apply online for School Admission for the session 2016-2017</p>-->
                   
                   </div>
                   <!--content info en-->
                    <!--login st-->
                    <div class="login-box login-sidebar">
                            <div class="wh-box"> 
                                 <div class="panel panel-info panel-login signin-bg">
                                 <div class="panel-body">
                                 <div class="logo-school">
                                    <a href="index.php" class="text-center db-logo">
                                        <img src="<?php echo HTTP_SERVER;?><?php echo $dbname;?>/uploads/<?php echo $tableinfo['sch_logo'];?>" alt="Home" class="center-block">
                                    </a>
                                  </div>
                                  <form class="form-horizontal loginform" id="loginform" action="">
								   <input class="form-control dbname" type="hidden" name="user_dbname" value="<?php echo $dbname;?>">
                                    <div class="form-group m-t-40">
                                      <div class="col-xs-12">
                                          <div class="input-group">
                                              <a href="#" class="input-group-addon"><span class="fa fa-user"></span></a>
                                            <input class="form-control user" type="text" name="user" required="" placeholder="Username">
                                          </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="col-xs-12">
                                          <div class="input-group">
                                            <a href="#" class="input-group-addon"><span class="fa fa-lock"></span></a>
                                            <input class="form-control password" type="password"  name="password"  required="" placeholder="Password">
                                          </div>      
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="col-xs-12">
                                            <input class="form-control btn btn-info dashboard-login btn-signin-full" type="submit" required="" value="Sign In" onclick="return loginformValidationCheckout();">
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
                                                    <div class="form-group m-t-40">
                                                      <div class="col-xs-12">
                                                          <div class="input-group">
                                                              <a href="#" class="input-group-addon"><span class="fa fa-envelope"></span></a>
                                                            <input class="form-control" type="text" required="" placeholder="Enter your email id or enrollment no.">
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
<div id="invalidLogin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
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
</div>
        <!--modal login en-->
        
       
        <!--include footer st-->        
		<?php include '../includes/foot.php'; ?>
        <!--include footer en--> 
    </body>
</html>
