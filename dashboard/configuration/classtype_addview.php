<?php
require_once '../../classes/config.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>School Management System - SMS | Class Type</title>
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
		if(isset($_REQUEST['SubmitC']))
		{	
			$res = $obj->ADDCLASSES();
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
				echo "<script>alert('Class detail added successfully.');</script>";
				echo "<script>window.location.href='classtype_addview.php';</script>";
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
	
		$sqlclass=mysql_query("SELECT * FROM  essort_classes ORDER BY class_desc");
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
                            <li class="active">Class Master</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div><!--en row-->

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 my-box">
                       <h4 class="h4">Add/View Class Type</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <a href="#" data-toggle="modal" data-target="#addNewClass" class="btn btn-info pull-right"><span class="fa fa-plus"></span> Add New Class</a>
                            </div>
                        </div>
                        <div class="row">
                         <div class="col-sm-12 col-xs-12">
                             <div class="table-responsive">
                                  <table class="table addclass" border="1">
                                    <thead>
                                      <tr>
                                        <th>Sl. No.</th>
                                        <th>Class</th>
                                        <th>Action</th>                                
                                      </tr>
                                    </thead>
                                    <tbody>
									<?php
									while($row=mysql_fetch_array($sqlclass))
								    {
									?>
                                      <tr>
                                        <td><?php echo $row['class_desc'];?></td>
                                        <td><?php echo $row['class_name'];?></td>
                                        <td>
                                            <a href="#" data-toggle="tooltip" data-original-title="Edit" ><span class="fa fa-pencil text-inverse m-r-10"></span></a>
                                            <a href="#" data-toggle="tooltip" data-original-title="Disable"><span class="fa fa fa-eye-slash text-inverse"></span></a>
                                        </td>                                
                                      </tr>
                                       <?php
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
<!--add new class st -->
<div class="modal fade" id="addNewClass" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header-1">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Class</h4>
        </div>
		<form method="post" action="" enctype="mutlipart/form-data">
        <div class="modal-body">     
           <div class="table-responsive">
              <table class="table addClassTable">
                <thead>
                  <tr>
                    <th>Sequence No.</th>
                    <th>Class Name</th>                                        
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control input-sm" name="txtSequence" placeholder="Sequence No." /></td>
                        <td><input type="text" class="form-control input-sm" name="txtClassName" placeholder="Class Name" /></td>
                    </tr>                    
                </tbody>
              </table>               
            </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-sm-12 col-xs-12 pull-right text-center">
               <!-- <button type="submit" value="Submit" class="btn btn-default btn-color border-round" name="SubmitC"><i class="fa fa-plus"></i> Add Class</button>-->
				<input type="submit" class="btn btn-default btn-color border-round" value="Submit" name="SubmitC">
                <button type="button" class="btn btn-warning btn-color border-round"><i class="fa fa-times-circle"></i> Cancel</button>
            </div>        
          </div>
        </div> 
    </form>		
      </div>
      
    </div>
  </div>    
<!--add new class en-->
</body>
</html>

