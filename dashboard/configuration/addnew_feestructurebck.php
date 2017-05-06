<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>School Management System - SMS | Add New Fee Structure</title>
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
		if(isset($_REQUEST['SubmitS']))
		{	
			$res = $obj->ADDSECTIONS();
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
				echo "<script>alert('Section detail added successfully.');</script>";
				echo "<script>window.location.href='section_addview.php';</script>";
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
	
		$sqlclass=mysql_query("SELECT * FROM  essort_section_master");
		$sqfeedetail=mysql_query("SELECT * FROM  essort_fee_detail");
		//$resultclass=mysql_fetch_array($sqlclass);
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
                <div class="row bg-title">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting from 15 November 2016.</span></h4>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="javascript:void(0)">Configuration</a>
                            </li>
                            <li class="active">Fee Structure</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div><!--en row-->

                <div class="row">
                    <div class="col-sm-12 my-box">
                        <h3>Fee Structure Full View</h3>                                                
                        <!--st element-->
                            <div class="row m-t-20"> 
                                <div  class="col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table color-table primary-table" id="feeStructure">                            
                                            <tbody>
											<tr>
											<td><input type="hidden" class="form-control" id="srlconnect" value="1"></td>
											</tr>
                                                <tr>
                                                    <td width="20%"><label for="txtStrName">Fee structure name</label></td>
                                                    <td width="80%"><input type="text" name="txtStrName" class="form-control input-sm" id="sname"/></td>  
                                                      
                                                </tr> 
                                                <tr>
                                                   <td><label for="element1">Element Name</label></td>
                                                    <td>
                                                        <select class="form-control input-sm" name="element1[]" id="element1">
														<?php  
														while($row=mysql_fetch_array($sqfeedetail))
														{
														?>
                                                            <option value="<?php echo $row['fee_elem_name'];?>"><?php echo $row['fee_elem_name'];?></option>
														<?php
														}
														?>
                                                            
                                                        </select>
                                                    </td>  
                                                     
                                                      
                                                </tr>  
                                                                                                                        
                                            </tbody>
                                        </table>
                                    </div>
                                <!--en table responsive-->    
                                    <div class="m-t-10 m-b-10 text-right"><a href="javascript:void(0)" class="btn btn-info bord-radius" id="addmore_Element"><span class="fa fa-plus"></span> Add More</a></div>
                                    <div class="m-t-10 m-b-10 text-center"><a  class="btn btn-info bord-radius" id="feestructure_fullview">View</a></div><!--href="feestructure_fullview.php"-->
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
<script type="text/javascript">
$("#feestructure_fullview").click(function(e) {
var srlcount=parseInt($('#srlconnect').val());
var sname=$('#sname').val();
var action='addfeestructure';
//alert(srlcount);
var myArray = [];
for (var i = 1; i <= srlcount; i++) { 
	var textvlue=$('#element'+i).val(); 
	myArray.push(textvlue);
    }
 //alert(myArray); 
 var dataString = 'myelements='+myArray+'&action='+action;
 alert(dataString);
 //$.post( "feestructure_fullview.php", { name: myArray, time: "2pm" } );
 var url = "feestructure_fullview.php?name=" +myArray + "&sname="+sname+"&technology=" + myArray;
  window.location.href = url;
  
});
</script>

</body>
</html>

