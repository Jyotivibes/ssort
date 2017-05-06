<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>School Management Solutions - SMS | Change Password</title>
							<?php include '../includes/head.php'; ?>




    </head>
<body>						
<div id="wrapper">
    <?php
    if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Principal') )
    {
        $user_id=$_SESSION['USER']['USER_NAME'];
        require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
        require_once('../../classes/general_class.php');
        $obj = new General();
        if(isset($_REQUEST['submit'])){

            $setPassword = $obj->CHANGEPASSWORD();
            if($setPassword == 1){
                echo "<script>alert('Password changed');</script>";
            }
            elseif($setPassword == 0){
                echo "<script>alert('Data not updated');</script>";
            }
            elseif($setPassword == 2){
                echo "<script>alert('New password and Confirm password should be match');</script>";
            }
        }


    }
    else
    {
        echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
    }
    ?>

<!-- Navigation -->
<!-- header Navigation st-->
<?php include '../includes/header-configuration.php'?>
<!-- header Navigation en-->

<!--sidebar nav st-->
<?php include '../includes/sidebar-principal.php'; ?>                           
<!--sidebar nav en-->
<!-- Page Content -->
    <div id="page-wrapper" class="bg-texture">
        <div>
            <div id="clouds">
                <div class="cloud x1"></div>
                <!-- Time for multiple clouds to dance around -->
                <div class="cloud x2"></div>
                <div class="cloud x3"></div>
                <div class="cloud x4"></div>
                <div class="cloud x5"></div>
            </div>
        </div>

        <div class="container-fluid">
            <?php include_once '../includes/header-notice.php';?>
            
            <!--notice circular row st-->
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                <div class="my-box">
                    <h3 class="box-title box-title pad-b-10">Change Password</h3>
                    <section class="">
                       <div class="row">
						<div class="col-md-8 col-sm-8 col-xs-12">
							<div class="">
								<form class="form-horizontal" onsubmit="return validationfunt();"  method="POST"  action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                                    <div id="alertmsg"></div>
									<!--<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Your Current Login Id </label>
										<div class="col-sm-9">
											<input class="form-control" id="inputEmail3" placeholder="Imtesal@gmail.com" type="email">
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-3 control-label">Enter Current Password </label>
										<div class="col-sm-9">
											<input class="form-control" id="c_pass" placeholder="********" type="password">
										</div>
									</div>-->
									<div class="form-group">
										<label for="inputPassword4" class="col-sm-3 control-label">Enter New Password <font                                                     color="red">*</font></label>
										<div class="col-sm-9">
											<input value="<?php echo @$_POST['n_pass']; ?>" class="form-control password"                                                           id="new_pass" placeholder="" name="n_pass" type="password">
										</div>
									</div>

                                    <div class="form-group">
                                        <label for="inputPassword4" class="col-sm-3 control-label" style="font-size:13px;">Re-Enter                                              New Password <font color="red">*</font></label>
                                        <div class="col-sm-9">
                                            <input class="form-control password" id="r_pass" name="r_n_pass" placeholder=""                                                     type="password">
                                        </div>
                                    </div>

									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-9">
                                            <div class="c_cursor_pointer_show_pass" id="showHide">
											     <i class="fa fa-eye"></i>
											     <span>Show Password </span>
                                            </div>
										</div>
									</div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                           <div class="c_change_pass">
                                                Password must be minimum of 7 characters long & contain at least 1 letter & 1 number
                                            </div>
                                        </div>
                                    </div>
                                    
                                      
									<div class="form-group m-b-0">
										<div class="col-sm-offset-3 col-sm-9">
											<button type="submit" name="submit"  class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
                    </section>
                    
                  </div><!--en white-box-->
                </div><!--en col-->
            </div><!--en row-->

            <!--notice circular row en-->

</div>

            <!-- .right-sidebar st here-->
         </div>
        <!-- /.container-fluid -->
         <?php include'../includes/footer.php'; ?>
    </div>
    <!-- /#page-wrapper -->

<!-- /#wrapper -->
<?php include '../includes/foot.php'; ?>
<script>
        function validationfunt(){
            if($('#new_pass').val() ==''){
                document.getElementById('alertmsg').innerHTML='Please enter a new Password';
                $('#new_pass').focus();
                return false;
            }
            else if($('#new_pass').val().length < 7 ){
                document.getElementById('alertmsg').innerHTML='Password should be minimum 7 Character long';
                $('#new_pass').focus();
                return false;
            }
            else if($('#r_pass').val() == ''){
                document.getElementById('alertmsg').innerHTML='Re Enter New Password';
                $('#r_pass').focus();
                return false;
            }

            else if($('#new_pass').val() != $('#r_pass').val()){
                document.getElementById('alertmsg').innerHTML='New password and confirm password should be same';
                $('#r_pass').focus();
                return false;
            }
        }
</script>

<script type="text/javascript">
 $(document).ready(function () {
 $("#showHide").click(function () {
 if ($(".password").attr("type")=="password") {
 $(".password").attr("type", "text");
 }
 else{
 $(".password").attr("type", "password");
 }
 
 });
 });
</script>

<!--Style Switcher -->
<!--<script src="js/jQuery.style.switcher.js"></script>-->
</body>
</html>
