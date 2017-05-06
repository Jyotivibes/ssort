<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>School Management System - SMS | Fee Structure Master</title>
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
		
		$sql=mysql_query("SELECT * FROM essort_fee_structure GROUP BY structure_name");
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
                            <li class="active">Fee Master</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div><!--en row-->

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 my-box">
                       <h4 class="h4">Add/View Fee Structure</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">                              
                                <a href="addnew_feestructure.php" class="btn btn-info pull-right"><span class="fa fa-plus"></span> Add New Fee Structure</a>
                                 <a href="newfeeelement.php" class="btn btn-info pull-right m-r-10"><span class="fa fa-inr"></span> Add New Fee Element</a>
                            </div>
                        </div>
                        <div class="row">
                         <div class="col-sm-12 col-xs-12">
                             <div class="table-responsive">
                            <table class="table table-striped color-table primary-table">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Fee Structure</th>
                                    <th>Yearly Fees</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
							$i=1;
							$amount=0;
							while($result=mysql_fetch_array($sql))
							{
								$amount=0;
								//echo "SELECT structure_element FROM essort_fee_structure WHERE structure_name='".$result['structure_name']."'";
								$sqlee=mysql_query("SELECT structure_element FROM essort_fee_structure WHERE structure_name='".$result['structure_name']."'");
								while($resstu=mysql_fetch_array($sqlee))
								{
									$sqlamount=mysql_fetch_array(mysql_query("SELECT fee_elemt_amount FROM essort_fee_detail WHERE fee_elem_name='".$resstu['structure_element']."'"));
									$amount=$amount+$sqlamount['fee_elemt_amount'];
								}
						
							?>
								
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $result['structure_name'];?></td>
                                    <td><span class="fa fa-inr"></span><?php echo $amount;?></td>
                                    <td>
                                        <a href="#" data-toggle="tooltip" data-original-title="Edit" ><span class="fa fa-pencil text-inverse m-r-10"></span></a>
                                        <a href="#" data-toggle="tooltip" data-original-title="Disable"><span class="fa fa fa-eye-slash text-inverse"></span></a>
                                    </td> 
                                </tr>
                            <?php
							$i++;
							}
							?>							
                            </tbody>
                            </table>
                            </div><!--table responsive-->
                         </div><!--en col-->
                         </div><!--en row-->
                    </div><!--col-en-->
                </div><!--en row-->
            </div>
        </div><!--en page-wrapper-->
 <?php include'../includes/footer.php'; ?>
</div><!--en wrapper-->
<?php include '../includes/foot.php'; ?>  

</body>
</html>

