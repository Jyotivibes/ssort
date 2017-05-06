<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>Configuration | Subject Master</title>
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
		if(isset($_REQUEST['SubmitSub']))
		{	
			$res = $obj->ADDSUBJECT();
			if($res == 2){
				echo "<script>alert('Please select only .jpg or .jpeg or .png image');</script>";
				echo "<script>window.location.href='create-group.php';</script>";
			}
			else if($res == 3){
				echo "<script>alert('Required parameter missing');</script>";
				echo "<script>window.location.href='create-group.php';</script>";
			}
			else if($res == 0){
				$formErr='Problem in network.Please try again.';
			}
			else if($res == 1){
				$formErr='Subject added successfully.';
			}
			else if($res == 4){
				echo "<script>alert('Please select Group Logo.');</script>";
				echo "<script>window.location.href='create-group.php';</script>";
			}
			else if($res == 5){
				$formErr='Already This Subject Exist.';
			}
		}
		$sql=mysql_query("SELECT * FROM essort_subject_master");
	}
	else
	{
		echo "<script>window.location='http://localhost/ssort/index.php';</script>";
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
                <?php include '../includes/header-notice.php'; ?>

                <div class="row">
                    <div class="col-sm-12 my-box">
					<a href="javascript:void(0)" class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span class="fa fa-backward"></span> Back</a>
                        <h3>Create Subject</h3>                                                
                        <!--st element-->
                            <div class="row m-t-20">
                                <div  class="col-sm-12 col-xs-12" id="crFee">
                                    <div class="table-responsive">
									<div id="alertsubmsg"></div>
                                       <form action="" name="subjectform" method="post" onsubmit="return validateSubject();">
                                            <table class="table color-table primary-table" id="feeStructure">   
                                                <tbody>
                                                    <tr>   
                                                        <td width="12%"><label>Enter subject</label></td>
                                                        <td width="20%">
                                                             <input type="text" class="form-control input-sm subject" name="subject"/>
                                                        </td> 
                                                        <td colspan="2">
                                                           <!-- <button type="button" class="btn btn-info btn-theme input-sm bord-radius"><span class="fa fa-save"></span> Save</button>-->
																<input type="submit" class="btn btn-info btn-theme input-sm bord-radius" value="Save" name="SubmitSub">
                                                        </td>                                                                                                                 
                                                    </tr>                                                                   
                                                </tbody>
                                             </table>
											</form>
                                              <table class="table color-table primary-table"> 
                                                        <thead>
                                                           <tr>
                                                            <th>S No</th>
                                                            <th>Subject</th>
                                                           <th>Edit</th>
                                                           </tr>
                                                        </thead>
                                                        <tbody>
														
													    <?php
														$i=1;
														while($row=mysql_fetch_array($sql))
														{
														?>
                                                          <tr>
                                                               <td><?php echo $i;?></td> 
                                                               <td><?php echo $row['sub_name'];?></td>
																<td>
															   <a href="editsubject.php?sub_id=<?php echo $row['sub_id'];?>"><span class="fa fa-pencil text-inverse m-r-10"></span></a>
															   <!-- <a href="#" data-toggle="tooltip" data-original-title="Disable"><span class="fa fa fa-eye-slash text-inverse"></span></a>-->
															</td>
                                                           </tr>
                                                        <?php
														$i++;
														}
														?>														 
                                                        </tbody>
                                               </table>
                                        
                                    </div>                                
                                    
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
	</script>
	<?php
}
?>
<script>
 function validateSubject(){
	if(document.subjectform.subject.value == '')
	{
		document.getElementById('alertsubmsg').innerHTML='Please Enter Subject';
		document.subjectform.subject.focus();
		return false;
	}
	return true;
}
</script>

</body>
</html>

