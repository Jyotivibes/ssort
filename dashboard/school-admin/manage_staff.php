<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>School Management System - SMS | Manage Staff</title>
							<?php include '../includes/head.php'; ?>	
</head>
<body>
<div id="wrapper">
 <?php include '../includes/header-configuration.php'; ?>
 <?php include '../includes/sidebar-configuration.php'; ?>          
  <?php
 if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='SAD') )
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
		require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
		require_once('../../classes/general_class.php');
		$obj = new General();
		$formErr='';
		if(isset($_REQUEST['SubmitMS']))
		{	
			$res = $obj->ADDSTAFF();
			if($res == 3){
				$formErr='Required parameter missing';
				$reurl='manage_staff.php';
				//echo "<script>alert('Required parameter missing');</script>";
				//echo "<script>window.location.href='create-group.php';</script>";
			}
			else if($res == 0){
				$formErr='Problem in network.Please try again';
				$reurl='manage_staff.php';
				//echo "<script>alert('Problem in network.Please try again.');</script>";
			}
			else if($res == 1){
				$formErr='Staff detail added successfully';
				$reurl='manage_staff.php';
				//echo "<script>alert('Staff detail added successfully.');</script>";
				//echo "<script>window.location.href='manage_staff.php';</script>";
			}
			else if($res == 4){
				$formErr='Already Registered with this Email Id';
				$reurl='manage_staff.php';
				//echo "<script>alert('Already Registered with this Email Id');</script>";
				//echo "<script>window.location.href='manage_staff.php';</script>";
			}
		}
		$sql=mysql_query("SELECT * FROM essort_user_header as a LEFT JOIN essort_user_details as b ON a.usr_id=b.usr_id WHERE usr_role NOT IN('SAD')");
		$sqlclasses=mysql_query("SELECT * FROM essort_classes");
		$sqlclassesed=mysql_query("SELECT * FROM essort_classes");
		$sqlrole=mysql_query("SELECT * FROM eesort_role");
		$sqlsubject=mysql_query("SELECT * FROM essort_subject_master");
		$sqlsubjectd=mysql_query("SELECT * FROM essort_subject_master");
	}
	else
	{
		echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
	} 
 ?>      
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
                                <a href="javascript:void(0)">Configuration</a>
                            </li>
                            <li class="active">Manage Staff</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div><!--en row-->

                <div class="row">
                    <div class="col-sm-12 my-box">
                        <h3>Add New Staff</h3>                        
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading bg-accordian">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne1">Add New Staff</a>
                                    </h4>
                                </div>
                                <div id="collapseOne1" class="panel-collapse collapse">
                                   <div class="table-responsive">
								   <div id="alertstaffmsg" style="align:middle;"></div>
								    <form action="" name="staffclass" method="post" onsubmit="return manageValidate();">
                                    <table class="table table-default color-table primary-table" id="new-staff">  
                                        <tbody>
                                          <tr><td><input type="hidden" id="staffconnect" name="staffconnect" value="1" /></td></tr>
                                           <tr>                                               
                                               <td>First Name</td> 
                                               <td>
                                                    <input type="text" class="form-control input-sm txtName" name="txtName" />
                                               </td>
                                               <td>Middle Name</td>
                                               <td>
                                                    <input type="text" class="form-control input-sm txtMName" name="txtMName" />
                                               </td>
                                               <td>Last Name</td>
                                               <td>
                                                    <input type="text" class="form-control input-sm txtLName" name="txtLName" />
                                               </td>
                                           </tr>
                                           <tr>
                                               <td>Contact No.</td>
                                               <td>
                                                    <input type="text" class="form-control input-sm txtContact" name="txtContact" />
                                               </td>
                                               <td>Staff Type</td>
                                               <td>
                                                    <select class="form-control input-sm staff_type" name="staff_type" >
													 <option value="">Select</option>
													<?php
														while($rowrole=mysql_fetch_array($sqlrole))
														{
													?>
													    <option value="<?php echo $rowrole['role_name'];?>"><?php echo $rowrole['role_name'];?></option>
                                                    <?php
														}
													?>
                                                    </select>
                                               </td>
                                               <td>Dept. Name</td>
                                               <td>
                                                    <input type="text" class="form-control input-sm txtDeptName" name="txtDeptName" />
                                               </td>
                                           </tr>
										   <tr>                                               
                                                <td>Email</td>
                                               <td>
                                                    <input type="text" class="form-control input-sm txtEmail" name="txtEmail" />
                                               </td>
                                               <td>Designation</td>
                                               <td>
                                                    <input type="text" class="form-control input-sm txtDesignation" name="txtDesignation" />
                                               </td>
											   <td>Gender</td>
                                               <td>
                                                    <select class="form-control input-sm gender" name="gender">
                                                       <option value="Male">Male</option>
                                                       <option value="Female">Female</option>
                                                   </select>  
                                               </td>
                                           </tr>  
										   <tr>                                               
                                                <td>Salary</td>
                                               <td>
                                                    <input type="text" class="form-control input-sm txtSalary" name="txtSalary" />
                                               </td>
                                           </tr>
                                           <tr>
                                               <td colspan="6"><strong>Related to</strong></td>                                               
                                           </tr>
                                           <tr>
                                               <td>Class</td>
                                               <td>Section</td>
                                               <td colspan="2">Subject</td>
                                               <td colspan="2">Is a class teacher</td>                                               
                                           </tr>
										   <select class="form-control input-sm" id="hiddenclass" style="display:none;">
													<option value="">Select class</option>
														<?php
															while($rowclass=mysql_fetch_array($sqlclassesed))
															{
														?>
                                                       <option value="<?php echo $rowclass['class_id'];?>"><?php echo $rowclass['class_name'];?></option>
														   <?php
															}
														   ?>
                                             </select> 
                                            
                                           <tr>
                                               <td>
                                                   <select class="form-control input-sm" name="class1" id="class1" onchange="showSubType(this.value,this.id);">
														<option value="">Select class</option>
														<?php
															while($rowclass=mysql_fetch_array($sqlclasses))
															{
														?>
                                                       <option value="<?php echo $rowclass['class_id'];?>"><?php echo $rowclass['class_name'];?></option>
														   <?php
															}
														   ?>
                                                   </select>
                                               </td>  
                                               <td>
                                                   <select class="form-control input-sm" name="section1" id="section1">
                                                    </select>
                                               </td>
											     <select class="form-control input-sm" id="hiddensub" style="display:none;">
													<option value="">Select Subject</option>
														 <?php
														while($rowsubjectd=mysql_fetch_array($sqlsubjectd))
														{
														?>
                                                       <option value="<?php echo $rowsubjectd['sub_id'];?>"><?php echo $rowsubjectd['sub_name'];?></option>
                                                       <?php
													   }
													   ?>
                                             </select> 
                                            
                                               <td colspan="2">
                                                   <select class="form-control input-sm" name="subject1">
												    <option value="">Select Subject</option>
												   <?php
														while($rowsubject=mysql_fetch_array($sqlsubject))
														{
														?>
                                                       <option value="<?php echo $rowsubject['sub_id'];?>"><?php echo $rowsubject['sub_name'];?></option>
                                                       <?php
													   }
													   ?>
                                                   </select>  
                                               </td> 
                                               <td colspan="2">
                                                   <label><input type="checkbox" name="chkClTeacher1" id="classteacher1" value="1"/></label>
                                               </td>                                                                                            
                                           </tr>
                                            <tr>
                                                <td colspan="6" align="center">
                                                    <!--<button type="button" class="btn btn-info bord-radius btn-theme input-sm m-r-20">
                                                    <span class="fa fa-save"></span> Save</button>-->
													<input type="submit" class="btn btn-info bord-radius btn-theme input-sm m-r-20" name="SubmitMS" value="Save">
                                                    <button type="button" class="btn btn-theme bord-radius text-white input-sm btn-add" id="add-row"><span class="fa fa-plus"></span> Add</a>
                                                </td>
                                            </tr>                     
                                        </tbody>
                                    </table>
                                    </form>
                            </div><!--en table responsive-->    
                            </div>
                            </div>
                        </div><!--en accordian-->
                        <!--st element-->
                            <div class="row m-t-20">
                            <div  class="col-sm-12 col-xs-12">
                            <div class="table-responsive">
                            <table class="table table-bordered color-table primary-table" border="2">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Name</th>
                                    <th>Emp Id</th>
                                    <th>Department Name</th>
                                    <th>Staff Type</th>
                                    
                                    <th>Login Id</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							while($row=mysql_fetch_array($sql))
							{
							?>
                                <tr>
                                    <td>1</td>
                                    <td><?php echo $row['usr_fname'];?></td>
                                    <td>E00<?php echo $row['usr_id']?></td>
                                    <td><?php echo $row['dept_name'];?></td> 
                                    <th><?php echo $row['usr_role'];?></th>                                   
                                    <!--<td><span class="fa fa-inr"></span> 45,000</td>-->
                                    <td><?php echo $row['usr_email']?></td>
                                   
                                    <td>
                                        <a href="edit_manage_staff.php?id=<?php echo $row['usr_id'];?>" data-toggle="tooltip" data-original-title="Edit" ><span class="fa fa-pencil text-inverse m-r-10"></span></a>
                                       <!-- <a href="#" data-toggle="tooltip" data-original-title="Disable"><span class="fa fa fa-eye-slash text-inverse"></span></a>-->
                                    </td> 
                                </tr> 
                            <?php
							}
							?>							 
                            </tbody>
                            </table>
                            </div>
                            <!--en table responsive-->    
                            </div><!--en col-->
                            </div><!--en row-->   
                        <!--en element-->
                    </div>                    
                </div><!--en row-->
            </div>
        </div><!--en page-wrapper-->
	
 <?php include'../includes/footer.php'; ?>
</div><!--en wrapper-->
<?php include '../includes/foot.php'; ?>  
	<?php
#Show form error message
if( $formErr!="" )
{
	?>
	<script>
		$('#myModalLabel').html('');
		$('#error_message').html("<?php echo $formErr; ?>");
		$('#alert_modal').modal('show');
		var url = "<?php echo $reurl;?>";    
		window.location.href = url;  
	</script>
	<?php
}
?>
<script>
 function manageValidate(){
	if(document.staffclass.txtName.value == '')
	{
		document.getElementById('alertstaffmsg').innerHTML='Please enter First Name';
		document.staffclass.txtName.focus();
		return false;
	}
	if(document.staffclass.txtMName.value == '')
	{
		document.getElementById('alertstaffmsg').innerHTML='Please enter Middle Name';
		document.staffclass.txtMName.focus();
		return false;
	}
	if(document.staffclass.txtLName.value == '')
	{
		document.getElementById('alertstaffmsg').innerHTML='Please enter Last Name';
		document.staffclass.txtLName.focus();
		return false;
	}
	var x=document.staffclass.txtEmail.value;
	var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
		document.getElementById('alertstaffmsg').innerHTML='Not a valid e-mail address';
		document.staffclass.txtEmail.focus();
        return false;
    }
	
	if(document.staffclass.txtContact.value == '')
	{
		document.getElementById('alertstaffmsg').innerHTML='Please enter Contact Number';
		document.staffclass.txtContact.focus();
		return false;
	}
	if(document.staffclass.txtSalary.value == '')
	{
		document.getElementById('alertstaffmsg').innerHTML='Please enter Salary';
		document.staffclass.txtSalary.focus();
		return false;
	}
	if(document.staffclass.staff_type.value == '')
	{
		document.getElementById('alertstaffmsg').innerHTML='Please enter Staff Type';
		document.staffclass.staff_type.focus();
		return false;
	}
	if(document.staffclass.txtDeptName.value == '')
	{
		document.getElementById('alertstaffmsg').innerHTML='Please enter Department Name';
		document.staffclass.txtDeptName.focus();
		return false;
	}
	if(document.staffclass.class1.value == '')
	{
		document.getElementById('alertstaffmsg').innerHTML='Please Select Class';
		document.staffclass.class1.focus();
		return false;
	}
	if(document.staffclass.section1.value == '')
	{
		document.getElementById('alertstaffmsg').innerHTML='Please Select Section';
		document.staffclass.section1.focus();
		return false;
	}
	if(document.staffclass.subject1.value == '')
	{
		document.getElementById('alertstaffmsg').innerHTML='Please Select Subject';
		document.staffclass.subject1.focus();
		return false;
	}
	return true;
}
</script>

</body>
</html>

