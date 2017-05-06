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
if (isset($_REQUEST['id']))
{
$sqlgrp=mysql_query("SELECT * FROM essort_group WHERE grp_id='".$_REQUEST['id']."'");	
$grpresult=mysql_fetch_array($sqlgrp);

$sqlsch=mysql_query("SELECT * FROM  essort_school_info WHERE grp_id='".$_REQUEST['id']."'");	


}
   //UPDATE GROUP
   if(isset($_REQUEST['SubmitP']))
	{	
		$res = $obj->UPDATEGROUP();
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
	//ADD NEW SCHOOL
	if(isset($_REQUEST['SubmitS']))
	{
		$ressc = $obj->addSchool();
	
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
							<title>School Management System - SMS | Admin</title>
							<?php include '../includes/headschool.php'; ?>	
</head>
<body>
<div id="wrapper">
<?php include '../includes/header-superadmin.php'; ?>
<!--sidebar nav st-->
     <?php include '../includes/sidebar-admin.php'; ?>                           
<!--sidebar nav en-->
    <!-- Page Content -->
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
                            <a href="../school-admin/school-admin.php">School </a>
                        </li>
                        <li class="active">School Admin</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>           
            <!--stu info st-->
            
           <div class="row">
            <div class="col-sm-12 col-xs-12 my-box p-t-20 p-b-20">
               <!--form st-->
               <form class="form-horizontal">
               <div class="row">                   
                    <div class="col-sm-6">
                    <div class="form-group marg-b-control ">
                    <label class="control-label col-xs-4">Group Name</label>
                    <div class="col-xs-8">
                    <input type="text" class="form-control no-border input-sm" disabled placeholder="Group Name" name="group_name" value="<?php echo $grpresult['grp_name']; ?>">
                    </div>
                    </div>
                    <div class="form-group marg-b-control">
                    <label class="control-label col-xs-4">City</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control no-border input-sm" disabled placeholder="City" name="group_city" value="<?php echo $grpresult['grp_city']; ?>">
                    </div>
                    </div>
                    <div class="form-group marg-b-control">
                    <label class="control-label col-xs-4">Address</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control no-border input-sm" disabled placeholder="Address" name="hq_address" value="<?php echo $grpresult['grp_hq_address']; ?>">
                        </div>
                    </div>
                    <div class="form-group marg-b-control">
                    <label class="control-label col-xs-4">Pin Code</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control no-border input-sm" disabled placeholder="Pin Code" name="group_pincode" value="<?php echo $grpresult['grp_pincode']; ?>">
                    </div>
                    </div>
                    <div class="form-group marg-b-control">
                        <label class="control-label col-xs-4">Contact No. 1</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control no-border input-sm" disabled placeholder="Contact No. 1" value="<?php echo $grpresult['grp_contact1']; ?>" name="group_contact1">
                            </div>
                        </div>
                        <div class="form-group marg-b-control">
                            <label class="control-label col-xs-4">Contact No. 2</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control no-border input-sm" disabled placeholder="Contact No. 2" value="<?php echo $grpresult['grp_contact2']; ?>" name="group_contact2">
                            </div>
                        </div>
                        <div class="form-group marg-b-control">
                            <label class="control-label col-xs-4">Email Id</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control no-border input-sm" disabled placeholder="Email Id" value="<?php echo $grpresult['grp_email']; ?>" name="group_email">
                            </div>
                        </div>
                        <div class="form-group marg-b-control">
                            <label class="control-label col-xs-4">Alternate Email Id</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control no-border input-sm" disabled placeholder="Alternate Email Id" value="<?php echo $grpresult['grp_alemail']; ?>" name="group_alemail">
                            </div>
                        </div>
                        <div class="form-group marg-b-control">
                            <label class="control-label col-xs-4">Group logo</label>
                            <div class="col-xs-8">
                                <input type="file" class="form-control no-border input-sm no-padd-fileupload" disabled />
                            </div>
                        </div>
                        <div class="form-group marg-b-control">
                            <label class="control-label col-xs-4">No. of Schools</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control no-border input-sm" disabled placeholder="No. of Schools" value="<?php echo $grpresult['grp_no_of_schools']; ?>" name="group_no_of_schools">
                            </div>
                        </div>
                    </div>
					<div class="col-sm-6">
						<div class="form-group marg-b-control">
							<label class="control-label col-xs-4">First name</label>
							<div class="col-xs-8">
								<input type="text" class="form-control no-border input-sm" disabled placeholder="First name" value="<?php echo $grpresult['grp_chairman_name']; ?>" name="chairman_name">
								</div>
							</div>
							<div class="form-group marg-b-control">
							<label class="control-label col-xs-4">Middle name</label>
							<div class="col-xs-8">
								<input type="text" class="form-control no-border input-sm" disabled placeholder="Middle name"  value="<?php echo $grpresult['grp_chairman_mname']; ?>" name="chairman_middlename">
								</div>
							</div>
							<div class="form-group marg-b-control">
							<label class="control-label col-xs-4">Last name</label>
							<div class="col-xs-8">
								<input type="text" class="form-control no-border input-sm" disabled placeholder="Last name"  value="<?php echo $grpresult['grp_chairman_lname']; ?>" name="chairman_lastname">
								</div>
							</div>
							<div class="form-group marg-b-control">
								<label class="control-label col-xs-4">Contact No.</label>
								<div class="col-xs-8">
									<input type="text" class="form-control no-border input-sm" disabled placeholder="Contact No."  value="<?php echo $grpresult['grp_chairman_contactno']; ?>" name="chairman_contactno">
									</div>
								</div>
								<div class="form-group marg-b-control">
									<label class="control-label col-xs-4">Email Id</label>
									<div class="col-xs-8">
										<input type="text" class="form-control no-border input-sm" disabled placeholder="Email Id" value="<?php echo $grpresult['grp_chairman_email']; ?>" name="chairman_email">
										</div>
									</div>
									<div class="form-group marg-b-control">
                                        <label class="control-label col-xs-4">Chairman image</label>
                                        <div class="col-xs-8">
                                            <input type="file" class="form-control no-border input-sm no-padd-fileupload" disabled />
                                        </div>
                                    </div>
                                      <div class="row m-t-10">                                                                                
                                            <div class="col-sm-6 col-xs-6">
                                               <div class="panel">
                                                <div class="thumbnail">
												<?php if($grpresult['grp_logo']=='')
														{
														  echo '<img src="../../admin/uploads/grplogo.jpg" class="img-thumbnail" alt="" />';
														}
														else
														{
														  echo '<img src="../../admin/uploads/'.$grpresult['grp_logo'].'" class="img-thumbnail" alt="" />';
														 }
												  ?>
                                                </div>
                                                </div><!--en panel-->
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="panel">
                                                    <div class="thumbnail">
													<?php if($grpresult['grp_chairman_image']=='')
														{
														  echo '<img src="../../admin/uploads/chairmanimg.jpg" class="img-thumbnail" alt="" />';
														}
														else
														{
														  echo '<img src="../../admin/uploads/'.$grpresult['grp_chairman_image'].'" class="img-thumbnail" alt="" />';
														}
													?>
                                                    </div>
                                                </div><!--en panel-->
                                            </div>                                          
                                     </div><!--en row-->                     
								</div>  
                           </div><!--en row-->
                           <div class="row m-t-10">
                               <div class="col-sm-12 col-xs-12 text-center">
                                   <button type="button" class="btn btn-info bord-radius m-r-10" id="edit-form">
                                                <span class="fa fa-edit"></span> Edit
                                   </button>
                               </div>
                           </div>
                    </form>
               <!--form en-->
                </div>
            </div>
                
            <div class="row">
              <div class="col-sm-12 col-xs-12 my-box">               
                <div class="row">
                    <div class="col-sm-6 col-xs-12">                     
                            <button type="button" class="super-btn btn btn-info" data-toggle="modal" data-target="#addnewSchool"><i class="fa fa-plus" aria-hidden="true"></i> Add New School</button>
                    </div>
            
           
                        <div class="col-sm-6 col-xs-12 mar-e">
                            <form class="navbar-form" role="search">
                                <div class="input-group pull-right">
                                    <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
                                    <div class="input-group-btn">
                                       <button class="btn btn-info" type="submit"><i class="glyphicon glyphicon-search"></i></button>
										
                                    </div>
                                </div>
                            </form>

                        </div>
                </div>
                  
                <div class="row">
				<?php 
				while($scrow=mysql_fetch_array($sqlsch))
				{
				?>
                        <div class="col-sm-2 col-xs-12 ">
							<div class="profile-panel_one42">
                         
                                <div class="row make-gap2">    
                                   <a href="javascript:void(0)">
                                    <div class="overlay-box">
                                        <div class="user-content text-center">                                            
                                                <img src="<?php echo HTTP_SERVER;?>/<?php echo $scrow['sch_reg_no']; ?>/uploads/<?php echo $scrow['sch_logo'];?>" class="thumb-chairman-sm img-responsive" alt="img">
                                            <h4 class="text-white-1"><?php echo $scrow['sch_name'];?></h4>
                                        </div>
                                    </div>
                                    </a>
                                        
                                </div>
                         
                           </div>
                        </div>
				<?php
				}
				?>
                       
               </div>
            </div><!--en col-->
        </div><!--en row-->
        </div>
    </div>
        <?php include'../includes/footer.php'; ?>
</div>
<?php include '../includes/footadmin.php'; ?>  
<!--add new school modal st-->
<div id="addnewSchool" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New School</h4>
      </div>      
       <form class="form-default" method="post" action="" enctype="multipart/form-data">
      <div class="modal-body">       
          <div class="row">           
           <div class="col-sm-6">  
			<input class="form-control control-border input-sm" type="hidden" value="<?php echo $_REQUEST['id'];?>" name="group_name">		   
             <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-university"></span></span>
                  <input placeholder="School Name" class="form-control control-border input-sm" type="text" name="school_name">
                </div>
              </div>  
			<div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-university"></span></span>
                  <input placeholder="School Affiliated By" class="form-control control-border input-sm" type="text" name="sch_affiliated_by">
                </div>
              </div> 
			  <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-university"></span></span>
                  <input placeholder="School Affiliation No" class="form-control control-border input-sm" type="text" name="sch_affiliation_no">
                </div>
              </div> 
			   <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-university"></span></span>
                  <input placeholder="School Tag Line" class="form-control control-border input-sm" type="text" name="sch_tag_line">
                </div>
              </div> 
              <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                  <input placeholder="Location" class="form-control control-border input-sm" type="text" name="sch_local_address">
                </div>
              </div>
              <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-building"></span></span>
                  <input placeholder="City" class="form-control control-border input-sm" type="text" name="sch_city">
                </div>
              </div>
			   <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-building"></span></span>
                  <input placeholder="State" class="form-control control-border input-sm" type="text" name="sch_state">
                </div>
              </div>
			   <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-building"></span></span>
                  <input placeholder="School Pin" class="form-control control-border input-sm" type="text" name="sch_pin">
                </div>
              </div>
			  <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-building"></span></span>
                  <input placeholder="School Country" class="form-control control-border input-sm" type="text" name="sch_country">
                </div>
              </div>
              <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                  <input placeholder="Contact No." class="form-control control-border input-sm" type="text" name="sch_contact_phone">
                </div>
              </div>
              <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                  <input placeholder="Alternate Contact No." class="form-control control-border input-sm" type="text"  name="sch_contact_phone1">
                </div>
              </div>
              <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                  <input placeholder="Email Id" class="form-control control-border input-sm" type="email"  name="sch_contact_email1"/>
                </div>
              </div>
              <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-file-image-o"></span></span>
                  <input class="form-control no-padd-fileupload control-border input-sm" type="file" name="sch_logo">
                </div>
              </div>
          </div><!--en col-->
          <div class="col-sm-6">           
              <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-user"></span></span>
                  <input placeholder="Contact Person Name" class="form-control control-border input-sm" type="text" name="sch_contact_person_name">
                </div>
              </div>
              <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                  <input placeholder="Email Id" class="form-control control-border input-sm" type="email" name="sch_contact_email2" />
                </div>
              </div>
              <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                  <input placeholder="Contact No." class="form-control control-border input-sm" type="text" name="sch_contact_phone2">
                </div>
              </div>
              <div class="form-group marg-b-control">            
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                  <input placeholder="Mobile No." class="form-control control-border input-sm" type="text">
                </div>
              </div>
              <fieldset class="bankdetails">
                  <legend class="legend-title">Bank Details</legend>
                  <div class="form-group marg-b-control">            
                    <div class="input-group"> <span class="input-group-addon"><span class="fa fa-building-o"></span></span>
                      <input placeholder="Bank Name" class="form-control control-border input-sm" type="text" name="sch_bank_name_address">
                    </div>
                  </div>
                  <div class="form-group marg-b-control">            
                    <div class="input-group"> <span class="input-group-addon"><span class="fa fa-code-fork"></span></span>
                      <input placeholder="Bank Branch" class="form-control control-border input-sm" type="text" name="sch_bank_branch">
                    </div>
                  </div>
                  <div class="form-group marg-b-control">            
                    <div class="input-group"> <span class="input-group-addon"><span class="fa fa-sort-numeric-asc"></span></span>
                      <input placeholder="A/c. No." class="form-control control-border input-sm" type="text" name="sch_bank_account_no">
                    </div>
                  </div>
                  <div class="form-group marg-b-control">            
                    <div class="input-group"> <span class="input-group-addon"><span class="fa fa fa-code"></span></span>
                      <input placeholder="IFSC Code" class="form-control control-border input-sm" type="text" name="sch_bank_ifsc_code">
                    </div>
                  </div>
              </fieldset>
          </div><!--en col-->
        </div><!--en row-->
               
      </div><!--en modal body-->
      <div class="modal-footer">
          <div class="row">
            <div class="col-sm-12 col-xs-12 text-center">
				<!--<button type="submit" class="btn btn-default">Submit</button>-->
				<input type="submit" class="btn btn-default m-t-10" type="submit" value="Submit" name="SubmitS">
            </div>
        </div>
      </div>
       </form>
      
    </div>

  </div>
</div>
<script type="text/javascript">
$("#submit").click(function(e) {
alert('submit');
});
</script>
</body>
</html>

