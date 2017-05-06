<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | School Administration</title>
    <?php include '../includes/head.php'; ?>


</head>

<body>
 
    <div id="wrapper">
	<?php
	$formErr='';
    if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='SAD') )
    {
        $user_id=$_SESSION['USER']['USER_NAME'];
        require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
        require_once('../../classes/general_class.php');
        $obj = new General();
        include_once 'stastics.php';
		
		if(isset($_REQUEST['feesubmit'])){
            $addmessage = $obj->ADDSTAFF();
             if($addmessage == 1){
                echo "<script>alert('Fee Collector Added Successfully')</script>";
            }
		
        }
        if(isset($_REQUEST['submit'])){
            $removecollector = $obj->REMOVEFEECOLLECTOR();
             if($removecollector == 1){
                 $formErr = "Fee Collector removed successfully";
            }

        }
		$sqlfeecollector=mysql_query("SELECT * FROM essort_user_header WHERE usr_role='Fee'");
		$feecollarr=array();
	    while($rowfeecoll=mysql_fetch_array($sqlfeecollector))
		{
			$feecollarr[]=$rowfeecoll;
		}
	   
		
    }
    else{
        echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
    }

    ?>
        <!-- Navigation -->
        <?php include'../includes/header-configuration.php'; ?>
        <!--sidebar nav st-->
        <?php include '../includes/sidebar-school.php'; ?>
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
                                <a href="../school-admin/school-admin.php">School</a>
                            </li>
                            <li class="active">Administration</li>
                        </ol>
                    </div>
                </div>


                <div class="row">
					
                <div class="col-sm-12 my-box">
                    <div>
                    <button type="button" class="mar-btn pull-right btn btn-info" data-toggle="modal" data-target="#myModalsa"><i class="fa fa-user-plus" aria-hidden="true"></i>
 Create Login</button>
                        </div>
                   
                    <table class="table table-bordered" id="myTables">
    <thead>
      <tr>
        <th>S No.</th>
        <th>Name</th>
        <th>Email Id</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <form method="post" action="">
	<?php
	foreach($feecollarr as $feecollvlue)
	{
	?>

      <tr>
        <td>1</td>
            <td><?php echo  $feecollvlue['usr_fname'];?></td>
            <td><?php echo  $feecollvlue['usr_email'];?></td>
            <td><button type="submit" name="submit" style="border: none"><i class="fa fa-times" aria-hidden="true"></i></button>
            <input type="hidden" name="collect_id" value="<?php echo  $feecollvlue['usr_id'];?>">
        </td>
      </tr>
   <?php
   }
   ?>
    </tbody>
    </form>
  </table>
                </div>
				</div>
                
            </div>
            
        </div>
   
       <?php include'../includes/footer.php'; ?>
    </div>
<!-- Modal -->
  <div class="modal fade" id="myModalsa" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create User</h4>
        </div>
		 <form class="form-horizontal" method="post" action="">
        <div class="modal-body">
       
 <input type="hidden" class="form-control" name="staff_type" value="fee">
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="txtName" id="email" placeholder="Enter Name">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Email:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="txtEmail" id="pwd" placeholder="Enter Email">
    </div>
  </div>
 <div class="modal-footer">
          <input type="submit" name="feesubmit" class="btn btn-default"><!-- data-dismiss="modal"  onclick="myFunctionsa()" -->
 </div>
        </div>
        </form>
      </div>
      
    </div>
  </div>
    <!-- FOR OPEN ON SUCCESS EVENT APPROVAL Modal -->
    <div class="modal fade" id="feeCollector" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Fee Collector</h4>
                </div>
                <div class="modal-body">
                    <p id="deletemessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<script>
function myFunction() {
    document.getElementById("myTables").deleteRow(1);
}
</script>
    <script>
function myFunctionsa() {
    alert("User Id & Password has been sent to user's Email Id.");
}
</script>
    <?php include'../includes/footer.php'; ?>
    <?php include '../includes/foot.php'; ?>
    <?php
    #Show form error message
    if( $formErr!="" )
    {
        ?>
        <script>
            $('#deletemessage').html("<?php echo $formErr; ?>");
            $('#feeCollector').modal('show');
        </script>
    <?php
    }
    ?>
</body>
</html>