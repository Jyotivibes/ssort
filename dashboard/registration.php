<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>Configuration | Registration</title>
							<?php include '../includes/head.php'; ?>	
</head>
<body>
<div id="wrapper">
<?php
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='SAD') )
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
		require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
		require_once('../../classes/general_class.php');
		$obj = new General();
		include_once 'stastics.php';
		if(isset($_REQUEST['SubmitR']))
		{	
			$res = $obj->STUREGISTRATION(); 
			if($res == 2){
				echo "<script>alert('Please select only .jpg or .jpeg or .png image');</script>";
				echo "<script>window.location.href='school-notice-circular.php';</script>";
			}
			else if($res == 3){
				echo "<script>alert('Required parameter missing');</script>";
				echo "<script>window.location.href='school-events-notification.php';</script>";
			}
			else if($res == 0){
				echo "<script>alert('Problem in network.Please try again.');</script>";
			}
			else if($res == 1){
				echo "<script>alert('Student Information added successfully.');</script>";
				//echo "<script>window.location.href='registration.php';</script>";
			}
			else if($res == 4){
				echo "<script>alert('Please select Group Logo.');</script>";
				echo "<script>window.location.href='create-group.php';</script>";
			}
			else if($res == 5){
				echo "<script>alert('Please select Chairman Image.');</script>";
				echo "<script>window.location.href='school-notice-circular.php';</script>";
			}
		}
	
		$sqlnote=mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM  essort_holidays GROUP BY occassion");
	}
	else
	{
		echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
	} 
?>	
 <?php include '../includes/header-configuration.php'; ?>
<!--sidebar nav st-->
     <?php include '../includes/sidebar-school.php'; ?>                           
<!--sidebar nav en-->         
    
    <div id="page-wrapper" class="bg-texture">
        <div>
            <div id="clouds">
                <div class="cloud x1"></div>           
                <div class="cloud x2"></div>
                <div class="cloud x3"></div>
                <div class="cloud x4"></div>
                <div class="cloud x5"></div>
            </div>
        </div>

            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting from 15 November 2016.</span></h4>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="javascript:void(0)">Configuration </a>
                            </li>
                            <li class="active">Master</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div><!--en row-->

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 my-box">
                        <h3 class="m-b-20">Student Registration
                             <a href="javascript:void(0)" class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span class="fa fa-backward"></span> Back</a>

                             <button type="button" class="btn btn-theme bord-radius pull-right text-white input-sm m-r-20" id="approval-status"><span class="fa fa-user"></span> Student Approval Status</button>
                         
                         </h3>

                         <form method="post"  name="stuform" action="#" class="stuform" onsubmit="return validateStudent();" >
						 <div id="alertstumsg"></div>
                             <!--accordian st-->
                                 <div class = "panel-group" id = "accordion">
                                   <div class = "panel panel-default">
                                      <div class = "panel-heading">
                                         <h4 class = "panel-title">
                                            <a data-toggle = "collapse" data-parent = "#accordion" href = "#collapseOne">
                                              Student Information
                                            </a>
                                         </h4>
                                      </div>

                                      <div id = "collapseOne" class = "panel-collapse collapse in">
                                         <div class = "panel-body">
                                            <fieldset class="newFieldset">
                                                 <legend class="legendText">Student Information</legend>
                                                 <div class="row">          
                                                       <div class="col-md-3 col-sm-12 col-xs-12">                                
                                                          <div class="form-group">
                                                            <label for="">First Name</label>
                                                            <div class="input-group">
                                                              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                              <input class="form-control input-sm first_name" placeholder="First Name" type="text" name="first_name"/>
                                                            </div>
                                                          </div>
                                                      </div><!--en col-3--> 
                                                                       
                                                        <div class="col-md-3 col-sm-12 col-xs-12">  
                                                          <div class="form-group">
                                                            <label for="">Middle Name</label>
                                                            <div class="input-group">
                                                              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                              <input class="form-control input-sm middle_name" placeholder="Middle Name" type="text" name="middle_name"/>
                                                            </div>
                                                          </div>
                                                          </div><!--en col-3-->  
														  <div class="col-md-3 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Last Name</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                  <input class="form-control input-sm last_name" placeholder="Last Name" type="text" name="last_name" />
                                                                </div>
                                                              </div>
                                                         </div><!--en col-3--> 
														  <div class="col-md-3 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Email</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                  <input class="form-control input-sm last_name" placeholder="Last Name" type="text" name="email" />
                                                                </div>
                                                              </div>
                                                         </div><!--en col-3--> 
                                                    </div> <!--en row-->  
                                                   
                                                    <div class="row">          
                                                      <div class="col-md-3 col-sm-12 col-xs-12">                                
                                                          <div class="form-group">
                                                            <label for="">DOB</label>
                                                            <div class="input-group">
                                                              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                              <input class="form-control input-sm dob" placeholder="DOB" type="text" name="dob" />
                                                            </div>
                                                          </div>
                                                      </div><!--en col-3-->  
                                                         <div class="col-md-3 col-sm-12 col-xs-12">  
                                                          <div class="form-group">
                                                            <label for="">Birth Place</label>
                                                            <div class="input-group">
                                                              <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                                              <input class="form-control input-sm birth_place" placeholder="Birth Place" name="birth_place" type="text" />
                                                            </div>
                                                          </div>
                                                          </div><!--en col-3--> 
                                                         <div class="col-md-3 col-sm-12 col-xs-12">  
                                                          <div class="form-group">
                                                            <label for="">Class ID</label>
                                                            <div class="input-group">
                                                              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                             <!-- <input class="form-control input-sm" placeholder="Class ID" type="text" name="class"/>-->
															  <select class="form-control input-sm class"   name="class">
															  <option value="">Select</option>
															  <?php echo $class;?>
															  </select>
                                                            </div>
                                                          </div>
                                                        </div><!--en col-3-->  
                                                          <div class="col-md-3 col-sm-12 col-xs-12">  
                                                          <div class="form-group">
                                                            <label for="">Religion</label>
                                                            <div class="input-group">
                                                              <div class="input-group-addon"><i class="fa fa-users"></i></div>
                                                              <input class="form-control input-sm religion" placeholder="Religion" type="text" name="religion"/>
                                                            </div>
                                                          </div> 
                                                        </div>   <!--en col-3-->         
                                                </div> <!--en row-->       

                                                 <div class="row">          
                                                      <div class="col-md-3 col-sm-12 col-xs-12">                                
                                                          <div class="form-group">
                                                            <label for="">Gender</label>
                                                            <div class="input-group">
                                                              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                              <select class="form-control input-sm class"   name="gender">
															  <option value="">Select</option>
															  <option value="Male">Male</option>
															  <option value="Female">Female</option>
															  </select>
                                                            </div>
                                                          </div>
                                                      </div><!--en col-3-->  
                                                               
                                                </div> <!--en row-->       
												
                                            </fieldset>      
                                         </div>
                                      </div>
                                   </div>

                                   <div class = "panel panel-default">
                                      <div class = "panel-heading">
                                         <h4 class = "panel-title">
                                            <a data-toggle = "collapse" data-parent = "#accordion" href = "#collapseTwo">
                                              Family Information
                                            </a>
                                         </h4>
                                      </div>

                                      <div id = "collapseTwo" class = "panel-collapse collapse">
                                         <div class = "panel-body">
                                            <fieldset class="newFieldset m-t-20">                        
                                                 <legend class="legendText">Family Information</legend>
                                                 <!--father info st-->
                                                <div class="col-md-6 col-sm-6 col-xs-12"> 
                                                     <fieldset class="newFieldset">
                                                         <legend class="legendText">Father Information</legend>
                                                    <div class="row">                                                                 
                                                         <div class="col-md-6 col-sm-12 col-xs-12">  
                                                          <div class="form-group">
                                                            <label for="">Initial</label>
                                                            <div class="input-group">
                                                              <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                                              <input class="form-control input-sm father_initial" placeholder="Initial" type="text" name="father_initial"/>
                                                            </div>
                                                          </div> 
                                                        </div>   <!--en col-3-->
                                                        <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Name</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                                                  <input class="form-control input-sm father_name " placeholder="Father Name" type="text" name="father_name"/>
                                                                </div>
                                                              </div>
                                                            </div><!--en col-3-->   
                                                        </div> <!--en row-->  
                                                        
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Email Id</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                                                  <input class="form-control input-sm father_email" placeholder="Email Id" type="text" name="father_email" />
                                                                </div>
                                                              </div>
                                                            </div><!--en col-3-->  
                                                          <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Age</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                                                  <input class="form-control input-sm father_age" placeholder="Father Age" type="text" name="father_age"/>
                                                                </div>
                                                              </div>
                                                        </div>   <!--en col-3--> 
                                                        </div><!--en row-->

                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Occupation</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-briefcase"></i></div>
                                                                  <input class="form-control input-sm father_occupation" placeholder="Occupation" type="text" name="father_occupation"/>
                                                                </div>
                                                              </div>
                                                            </div><!--en col-3-->  
                                                          <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Designation</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                  <input class="form-control input-sm father_designation" placeholder="Designation" type="text" name="father_designation"/>
                                                                </div>
                                                              </div>
                                                          </div>   <!--en col-3--> 
                                                        </div><!--en row-->

                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Organization Name</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                                                  <input class="form-control input-sm father_organization" placeholder="Organization Name" type="text" name="father_organization"/>
                                                                </div>
                                                              </div>
                                                            </div><!--en col-3-->  
                                                          <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Office Address</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                                                  <input class="form-control input-sm off_address" placeholder="Office Address" type="text" name="off_address"/>
                                                                </div>
                                                              </div>
                                                          </div>   <!--en col-3--> 
                                                        </div><!--en row-->

                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Office Timing</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                                                  <input class="form-control input-sm off_time" placeholder="Office Timing" type="text" name="off_time" />
                                                                </div>
                                                              </div>
                                                            </div><!--en col-3-->  
                                                          <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Office Contact</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                                                  <input class="form-control input-sm f_office_contact" placeholder="Office Contact" type="text" name="f_office_contact"/>
                                                                </div>
                                                              </div>
                                                          </div>   <!--en col-3--> 
                                                        </div><!--en row-->

                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Monthly Income</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-inr"></i></div>
                                                                  <input class="form-control input-sm f_monthly_income" placeholder="Monthly Income" type="text" name="f_monthly_income"/>
                                                                </div>
                                                              </div>
                                                            </div><!--en col-3-->  
                                                          <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Role</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                  <input class="form-control input-sm f_role" placeholder="Role" type="text" name="f_role"/>
                                                                </div>
                                                              </div>
                                                          </div>   <!--en col-3--> 
                                                        </div><!--en row-->

                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Mother Tongue</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                                                  <input class="form-control input-sm father_tongue"  placeholder="Mother Tongue" type="text" name="father_tongue" />
                                                                </div>
                                                              </div> 
                                                            </div><!--en col-3-->  
                                                           <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Primary Contact</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                                                  <input class="form-control input-sm f_primary_contact" placeholder="Primary Contact" type="text" name="f_primary_contact"/>
                                                                </div>
                                                              </div>
                                                            </div><!--en col-3-->  
                                                        </div><!--en row-->

                                                        <div class="row">
                                                          <div class="col-md-12 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Alternate Contact</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                                                  <input class="form-control input-sm f_alt_contact" placeholder="Alternate Contact" type="text" name="f_alt_contact"/>
                                                                </div>
                                                              </div> 
                                                          </div>   <!--en col-3--> 
                                                        </div><!--en row-->
                                                     </fieldset>
                                                </div> <!--en col-->   
                                                 <!--father info en-->

                                                 <!--mother info st-->
                                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                                     <fieldset class="newFieldset">
                                                         <legend class="legendText">Mother Information</legend>
                                                    <div class="row">          
                                                      <div class="col-md-6 col-sm-12 col-xs-12">  
                                                          <div class="form-group">
                                                            <label for="">Initial</label>
                                                            <div class="input-group">
                                                              <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                                              <input class="form-control input-sm mother_initial" placeholder="Initial" type="text" name="mother_initial"/>
                                                            </div>
                                                          </div> 
                                                        </div>   <!--en col-3-->   
                                                        <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Name</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                                                  <input class="form-control input-sm mother_name" placeholder="Mother Name" type="text" name="mother_name" />
                                                                </div>
                                                              </div>
                                                        </div><!--en col-3-->                                                 
                                                    </div> <!--en row-->  
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Email Id</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                                                  <input class="form-control input-sm m_email" placeholder="Email Id" type="text" name="m_email"/>
                                                                </div>
                                                              </div>
                                                            </div><!--en col-3-->  
                                                          <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Age</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                                                  <input class="form-control input-sm m_age" placeholder="Father Age" type="text" name="m_age" />
                                                                </div>
                                                              </div>
                                                        </div>   <!--en col-3--> 
                                                        </div><!--en row-->                                                       

                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Occupation</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-briefcase"></i></div>
                                                                  <input class="form-control input-sm m_occupation" placeholder="Occupation" type="text" name="m_occupation" />
                                                                </div>
                                                              </div>
                                                            </div><!--en col-3-->  
                                                          <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Designation</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                  <input class="form-control input-sm m_designation" placeholder="Designation" type="text" name="m_designation" />
                                                                </div>
                                                              </div>
                                                          </div>   <!--en col-3--> 
                                                        </div><!--en row-->

                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Organization Name</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                                                  <input class="form-control input-sm m_org" placeholder="Organization Name" type="text" name="m_org" />
                                                                </div>
                                                              </div>
                                                            </div><!--en col-3-->  
                                                          <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Office Address</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                                                  <input class="form-control input-sm m_ofc_add" placeholder="Office Address" type="text" name="m_ofc_add" />
                                                                </div>
                                                              </div>
                                                          </div>   <!--en col-3--> 
                                                        </div><!--en row-->

                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Office Timing</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                                                  <input class="form-control input-sm m_ofc_time" placeholder="Office Timing" type="text" name="m_ofc_time"/>
                                                                </div>
                                                              </div>
                                                            </div><!--en col-3-->  
                                                          <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Office Contact</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                                                  <input class="form-control input-sm m_ofc_contact" placeholder="Office Contact" type="text" name="m_ofc_contact"/>
                                                                </div>
                                                              </div>
                                                          </div>   <!--en col-3--> 
                                                        </div><!--en row-->

                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Monthly Income</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-inr"></i></div>
                                                                  <input class="form-control input-sm m_monthly_income" placeholder="Monthly Income" type="text" name="m_monthly_income"/>
                                                                </div>
                                                              </div>
                                                            </div><!--en col-3-->  
                                                          <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Role</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                  <input class="form-control input-sm m_ofc_role" placeholder="Role" type="text" name="m_ofc_role"/>
                                                                </div>
                                                              </div>
                                                          </div>   <!--en col-3--> 
                                                        </div><!--en row-->

                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Mother Tongue</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                                                  <input class="form-control input-sm m_tongue" placeholder="Mother Tongue" type="text" name="m_tongue"/>
                                                                </div>
                                                              </div> 
                                                            </div><!--en col-3-->  
                                                              <div class="col-md-6 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Primary Contact</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                                                  <input class="form-control input-sm m_pri_conact" placeholder="Primary Contact" type="text" name="m_pri_conact" />
                                                                </div>
                                                              </div>
                                                            </div><!--en col-3-->  
                                                        </div><!--en row-->

                                                        <div class="row">                                                            
                                                          <div class="col-md-12 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Alternate Contact</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                                                  <input class="form-control input-sm m_alt_contact" placeholder="Alternate Contact" type="text" name="m_alt_contact"/>
                                                                </div>
                                                              </div> 
                                                          </div>   <!--en col-3--> 
                                                        </div><!--en row-->
                                                     </fieldset>
                                                </div> <!--en col-->  
                                                 <!--mother info en-->                                                                                                
                                            </fieldset>   
                                         </div>
                                      </div>
                                   </div>

								   
                                   <div class = "panel panel-default">
                                      <div class = "panel-heading">
                                         <h4 class = "panel-title">
                                            <a data-toggle = "collapse" data-parent = "#accordion" href = "#collapseThree">
                                               Student Medical Information
                                            </a>
                                         </h4>
                                      </div>

                                      <div id = "collapseThree" class = "panel-collapse collapse">
                                         <div class = "panel-body">
                                            <fieldset class="newFieldset m-t-20">
                                                 <legend class="legendText">Student Medical Information</legend>
                                                 <div class="row">          
                                                      <div class="col-md-2 col-sm-12 col-xs-12">                                
                                                          <div class="form-group">
                                                            <label for="">Blood Group</label>
                                                            <div class="input-group">
                                                              <div class="input-group-addon"><i class="glyphicon glyphicon-tint"></i></div>
                                                              <input class="form-control input-sm blood_group" placeholder="Student Blood Group" type="text" name="blood_group"/>
                                                            </div>
                                                          </div>
                                                      </div><!--en col-3-->  
                                                         <div class="col-md-2 col-sm-12 col-xs-12">  
                                                          <div class="form-group">
                                                            <label for="">Allergies</label>
                                                            <div class="input-group">
                                                              <div class="input-group-addon"><i class="fa fa-user-md"></i></div>
                                                              <input class="form-control input-sm alergy" placeholder="Allergies" type="text" name="alergy"/>
                                                            </div>
                                                          </div>
                                                          </div><!--en col-3--> 
                                                         <div class="col-md-2 col-sm-12 col-xs-12">  
                                                          <div class="form-group">
                                                            <label for="">Illness</label>
                                                            <div class="input-group">
                                                              <div class="input-group-addon"><i class="fa fa-medkit"></i></div>
                                                              <input class="form-control input-sm illness" placeholder="Illness" type="text" name="illness" />
                                                            </div>
                                                          </div>
                                                        </div><!--en col-3-->  
                                                          <div class="col-md-3 col-sm-12 col-xs-12">  
                                                          <div class="form-group">
                                                            <label for="">Emergency Treatment</label>
                                                            <div class="input-group">
                                                              <div class="input-group-addon"><i class="fa fa-ambulance"></i></div>
                                                              <input class="form-control input-sm eme_treat" placeholder="Emergency Treatment" type="text" name="eme_treat" />
                                                            </div>
                                                          </div> 
                                                        </div>   <!--en col-3-->                                                           
                                                          <div class="col-md-3 col-sm-12 col-xs-12">  
                                                              <div class="form-group">
                                                                <label for="">Medication</label>
                                                                <div class="input-group">
                                                                  <div class="input-group-addon"><i class="fa fa-stethoscope"></i></div>
                                                                  <input class="form-control input-sm medication" placeholder="Medication" type="text"  name="medication"/>
                                                                </div>
                                                              </div> 
                                                          </div>   <!--en col-3-->      
                                                </div> <!--en row-->     
                                            </fieldset>   
                                         </div>
                                      </div>

                                   </div>
                                </div>
                             <!--accordian en-->
                                <div class="row">
                                    <div class="col-md-12 col-sm text-center">                                        
                                          <!--<button type="submit" class="btn btn-success btn-theme m-r-10 bord-radius">Submit</button>-->
                                          <input type="submit" class="btn btn-success btn-theme m-r-10 bord-radius" value="Submit" name="SubmitR">
                                          <button type="submit" class="btn btn-inverse bord-radius">Cancel</button>
                                    </div>
                                </div>
                        </form>
                    </div><!--col-12-en-->
                </div><!--en row-->
            </div>
        </div><!--en page-wrapper-->
 <?php include'../includes/footer.php'; ?>
</div><!--en wrapper-->
<?php include '../includes/footadmin.php'; ?>  
<script>
 function validateStudent(){
	if(document.stuform.first_name.value == '')
	{
		document.getElementById('alertstumsg').innerHTML='Please Select First Name';
		document.stuform.first_name.focus();
		//document.getElementById("collapseOne").className = "";
		return false;
	}
	if(document.stuform.middle_name.value == '')
	{
		document.getElementById('alertstumsg').innerHTML='Please Select Middle Name';
		document.stuform.middle_name.focus();
		document.getElementById("collapseOne").className = "";
		return false;
	}
	if(document.stuform.last_name.value == '')
	{
		document.getElementById('alertstumsg').innerHTML='Please Select Last Name';
		document.stuform.last_name.focus();
		document.getElementById("collapseOne").className = "";
		return false;
	}
	if(document.stuform.dob.value == '')
	{
		document.getElementById('alertstumsg').innerHTML='Please Select DOB';
		document.stuform.dob.focus();
		document.getElementById("collapseOne").className = "";
		return false;
	}
	if(document.stuform.birth_place.value == '')
	{
		document.getElementById('alertstumsg').innerHTML='Please Select BIRTh Place';
		document.stuform.birth_place.focus();
		document.getElementById("collapseOne").className = "";
		return false;
	}
	if(document.stuform.class.value == '')
	{
		document.getElementById('alertstumsg').innerHTML='Please Select class';
		document.stuform.class.focus();
		document.getElementById("collapseOne").className = "";
		return false;
	}
	if(document.stuform.religion.value == '')
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter religion';
		document.stuform.religion.focus();
		document.getElementById("collapseOne").className = "";
		return false;
	}
	if(document.stuform.father_initial.value == '')
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Father Initial';
		document.stuform.father_initial.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.father_name.value == '')
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Father Name';
		document.stuform.father_name.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.father_email.value == '')
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Father Email';
		document.stuform.father_email.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.father_age.value == '')
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Father Age';
		document.stuform.father_age.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.father_occupation.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Father Occupation';
		document.stuform.father_occupation.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.father_designation.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Father Designation';
		document.stuform.father_designation.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.father_organization.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Father Organisation';
		document.stuform.father_organization.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.off_address.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Father Office Address';
		document.stuform.off_address.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	} 
	if(document.stuform.off_time.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Father Office Time';
		document.stuform.off_time.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	} 
	if(document.stuform.f_office_contact.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Father Office Contact';
		document.stuform.f_office_contact.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	} 
	if(document.stuform.f_monthly_income.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Father Monthly Income';
		document.stuform.f_monthly_income.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	} 
	if(document.stuform.f_role.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Father Role';
		document.stuform.f_role.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	} 
	if(document.stuform.father_tongue.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Tongue';
		document.stuform.father_tongue.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	} 
	if(document.stuform.f_primary_contact.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Primary Contact';
		document.stuform.f_primary_contact.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	} 
	if(document.stuform.f_alt_contact.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Alternative Contact';
		document.stuform.f_alt_contact.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	} 
	if(document.stuform.mother_initial.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Mother Initial';
		document.stuform.mother_initial.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	} 
	if(document.stuform.mother_name.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Mother Name';
		document.stuform.mother_name.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	} 
	if(document.stuform.m_email.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Mother Email';
		document.stuform.m_email.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	} 
	if(document.stuform.m_age.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Mother Age';
		document.stuform.m_age.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	} 
	if(document.stuform.m_occupation.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Mother Occupation';
		document.stuform.m_occupation.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.m_designation.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Mother Designation';
		document.stuform.m_designation.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.m_org.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Mother Organisation';
		document.stuform.m_org.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.m_ofc_add.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Mother Office Address';
		document.stuform.m_ofc_add.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.m_ofc_time.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Mother Office Time';
		document.stuform.m_ofc_time.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.m_monthly_income.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Mother Income';
		document.stuform.m_monthly_income.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.m_ofc_role.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Mother Role';
		document.stuform.m_ofc_role.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.m_tongue.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Mother Tongue';
		document.stuform.m_tongue.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.m_pri_conact.value == '') 
	{
		document.getElementById('alertstumsg').innerHTML='Please Enter Mother Primary Contact';
		document.stuform.m_pri_conact.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	if(document.stuform.m_alt_contact.value == '')  
	{  
		document.getElementById('alertstumsg').innerHTML='Please Enter Mother Primary Contact';
		document.stuform.m_pri_conact.focus();
		document.getElementById("collapseTwo").className = "";
		return false;
	}
	return true;
}
</script>
</body>
</html>

