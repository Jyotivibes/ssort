<?php
@session_start();
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='admin') )
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
		//ssecho '<script>window.location="http://localhost/ssort/dashboard/admin/super-admin.php"</script>';	
	}
	else
	{
		echo "<script>window.location='http://localhost/ssort/admin/';</script>";
	
	}
	

include ('../../classes/group_class.php');
$obj=new GROUP();

if(isset($_REQUEST['SubmitP']))
	{	
		$res = $obj->addGROUP();
		if($res == 2){
			echo "<script>alert('Please select only .jpg or .jpeg or .png image');</script>";
			echo "<script>window.location.href='create-group.php';</script>";
		}
		else if($res == 3){
			echo "<script>alert('Required parameter missing');</script>";
			echo "<script>window.location.href='create-group.php';</script>";
		}
		else if($res == 0){
			echo "<script>alert('Problem in network.Please try again.');</script>";
		}
		else if($res == 1){
			echo "<script>alert('Group detail added successfully.');</script>";
			echo "<script>window.location.href='create-group.php';</script>";
		}
		else if($res == 4){
			echo "<script>alert('Please select Group Logo.');</script>";
			echo "<script>window.location.href='create-group.php';</script>";
		}
		else if($res == 5){
			echo "<script>alert('Please select Chairman Image.');</script>";
			echo "<script>window.location.href='create-group.php';</script>";
		}
	}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | Create Group</title>
    <?php include '../includes/headteacher.php'; ?>
	<script>
	    function addGroupValidation(){
		if(document.group_form.group_name.value.trim() == '')
			{
				document.getElementById('alertmsg').innerHTML='Please enter Group Name';
				//alert('Please enter Group Name');
				document.group_form.group_name.focus();
				return false;
			}
		if(document.group_form.group_contact1.value.trim() == '')
			{
				//alert('Please enter Group Contact Number');
				document.getElementById('alertmsg').innerHTML='Please enter Group Contact Number';
				document.group_form.group_contact1.focus();
				return false;
			}
		if(document.group_form.group_email.value.trim() == '')
			{
				//alert('Please enter Group Email');
				document.getElementById('alertmsg').innerHTML='Please enter Group Email';
				document.group_form.group_email.focus();
				return false;
			}
			if(document.group_form.chairman_name.value.trim() == '')
			{
				//alert('Please enter Chairman Name');
				document.getElementById('alertmsg').innerHTML='Please enter Chairman Name';
				document.group_form.chairman_name.focus();
				return false;
			}
			return true;
		}
	</script>	
	
</head>

<body> 
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="ti-menu"></i>
                </a>
                <ul class="nav navbar-top-links navbar-left hidden-xs active hamburger">
                    <li>
                        <a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                    <li>

                    </li>
                </ul>
                <div class="col-sm-1 logo-shift">
                    <ul class="nav pull-left logo-area">
                        <li>
                            <div class="top-left-part">
                                <a class="logo navbar-brand" href="index.php">
                                    <img src="../images/super-logo.png" />
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <!--en col-->

                <div class="col-sm-5 col-xs-12 marg-left">
                    <div class="school-loc">
                        <h1 class="school-super">Smart Solutions on Realtime Technologies</h1>
                     
                    </div>
                    <!--school-loc en-->

                </div>
                <!--en col-->
                <ul class="nav navbar-top-links navbar-right pull-right profile-area">
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="javascript:void(0);">
                            <!--<i class="icon-envelope"></i>-->
                            <img src="../images/icons/mail.ico" />
                            <div class="notify">
                                <!--<span class="heartbit"></span>
    <span class="point"></span>-->
                                <span class="heartbit"></span>
                                <span class="badge notify-badge">4</span>
                                <!--.bg-badge-->
                            </div>
                        </a>
                        <ul class="dropdown-menu mailbox animated bounceInDown messages-panel">
                            <li>
                                <div class="drop-title">You have 4 new messages</div>
                            </li>
                            <li>
                                <div class="message-center">
                                    <a href="javascript:void(0);">
                                        <div class="user-img">
                                            <img src="../images/student-pic.jpg" alt="user" class="img-circle">
                                            <span class="profile-status online pull-right"></span>
                                        </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5>
                                            <span class="mail-desc">Just see the my admin!</span>
                                            <span class="time">9:30 AM</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);">
                                        <div class="user-img">
                                            <img src="../images/avatar1_small.jpg" alt="user" class="img-circle">
                                            <span class="profile-status busy pull-right"></span>
                                        </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5>
                                            <span class="mail-desc">Just see the my admin!</span>
                                            <span class="time">9:30 AM</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);">
                                        <div class="user-img">
                                            <img src="../images/avatar1_small.jpg" alt="user" class="img-circle">
                                            <span class="profile-status away pull-right"></span>
                                        </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5>
                                            <span class="mail-desc">Just see the my admin!</span>
                                            <span class="time">9:30 AM</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);">
                                        <div class="user-img">
                                            <img src="../images/avatar1_small.jpg" alt="user" class="img-circle">
                                            <span class="profile-status offline pull-right"></span>
                                        </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5>
                                            <span class="mail-desc">Just see the my admin!</span>
                                            <span class="time">9:02 AM</span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="text-center" href="javascript:void(0);">
                                    <strong>See all messages</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="javascript:void(0);">
                           
                            <img src="../images/icons/event.ico" />
                            <div class="notify">
                               
                                <span class="heartbit"></span>
                                <span class="badge notify-badge">4</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-tasks animated bounceInDown events-panel">
                            <li>
                                <a href="javascript:void(0);">
                                    <div>
                                        <p>
                                            <strong>Event 1</strong>
                                            <span class="pull-right text-muted">Annual Function</span>
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div>
                                        <p>
                                            <strong>Event 2</strong>
                                            <span class="pull-right text-muted">Annual Function</span>
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div>
                                        <p>
                                            <strong>Event 3</strong>
                                            <span class="pull-right text-muted">Annual Function</span>
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div>
                                        <p>
                                            <strong>Event 4</strong>
                                            <span class="pull-right text-muted">Annual Function</span>
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="javascript:void(0);">
                                    <strong>See All Events</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-tasks -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown profile">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <img alt="" src="../images/icons/super_admin.png">
                            <span class="username">Hello Admin</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="fa fa-suitcase"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="change-password.php">
                                    <i class="fa fa-cog"></i> Settings
                                </a>
                            </li>
                            <li>
                                <a href="../../signin-super.php">
                                    <i class="fa fa-lock"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!--sidebar nav st-->
        <?php include '../includes/sidebar-admin.php'; ?>
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
                <div class="row bg-title">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting form 15 November 2016.</span></h4>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="../admin/super-admin.php">Admin</a>
                            </li>
                            <li class="active">Create Group</li>
                        </ol>
                    </div>
                </div>
             <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my-box-23">
                        <h5 class="text-center m-b-30"><strong>Create Group</strong></h5>
								<div id="alertmsg"></div>
                                 <form class="form-horizontal group_form" id="group_form" name="group_form" enctype="multipart/form-data" method="post" onsubmit="return addGroupValidation();">
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-left bord-right">
                                   <h5 class="text-center m-b-30"><b>Group Details</b></h5> 
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Group Name <sup>*</sup></label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control input-sm" placeholder="Group Name" name="group_name"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">HQ Address </label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control input-sm" placeholder="HQ Address" name="hq_address"/>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">City</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control input-sm" placeholder="City" name="group_city">
                                        </div>
                                    </div>
                                      <div class="form-group">
                                        <label class="control-label col-xs-3">Pin Code</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control input-sm" placeholder="Pin Code" name="group_pincode">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Contact No. 1 <sup>*</sup></label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control input-sm" placeholder="Contact No. 1" name="group_contact1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Contact No. 2</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control input-sm" placeholder="Contact No. 2" name="group_contact2">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Email<sup>*</sup></label>
                                        <div class="col-xs-9">
                                            <input type="email" class="form-control input-sm" placeholder="Email Id" name="group_email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Alternate Email</label>
                                        <div class="col-xs-9">
                                            <input type="email" class="form-control input-sm" placeholder="Alternate Email Id" name="group_alemail">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Group Logo<sup>*</sup></label>
                                        <div class="col-xs-9">
                                            <input type="file" class="form-control input-sm no-padd-fileupload" name="group_logo" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">No. of schools</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control input-sm" placeholder="No. of schools" name="group_no_of_schools" >
                                        </div>
                                    </div>
                                  </div> <!--en one half-->  

                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
                                   <h5 class="text-center m-b-30"><b>Chairman Details</b></h5>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">First name <sup>*</sup></label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control input-sm" placeholder="First name" name="chairman_name" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Middle name</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control input-sm" placeholder="Middle name" name="chairman_middlename" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Last name</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control input-sm" placeholder="Last name" name="chairman_lastname"/>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Landline No.</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control input-sm" placeholder="Landline No." name="chairman_landlineno">
                                        </div>
                                    </div>
                                      <div class="form-group">
                                        <label class="control-label col-xs-3">Contact No.</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control input-sm" placeholder="Contact No." name="chairman_contactno">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Email ID</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control input-sm" placeholder="Email ID" name="chairman_email">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Chairman image<sup>*</sup></label>
                                        <div class="col-xs-9">
                                            <input type="file" class="form-control input-sm no-padd-fileupload" name="chairman_image"/>
                                        </div>
                                    </div>
                                    
                                  </div> <!--en one half-->  
                                  <div class="row">
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      <div class="form-group text-center">                                       
                                            <input type="submit" class="btn btn-default m-t-10" type="submit" value="Submit" name="SubmitP">
											
                                      </div>
                                      </div><!--en col-->
                                  </div>    
                                </form>                           
                    </div><!--en col-->
                </div>
                
            </div>
              </div>
            
        </div>
   
        <?php include'../includes/footer.php'; ?>
    </div>

    </div>

    <?php include '../includes/footteacher.php'; ?>

</body>

</html>