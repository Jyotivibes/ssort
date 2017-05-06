<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | School Fee</title>
    <?php include '../includes/head.php'; ?>
	
	
</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include '../includes/header-configuration.php'; ?>
        <!--sidebar nav st-->
        <?php include '../includes/sidebar-fee.php'; ?>
		<?php
	 if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']))
	{ 	
	$user_id=$_SESSION['USER']['USER_NAME'];
		require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
		require_once('../../classes/general_class.php');
		$obj = new General();
		include_once 'stastics.php';
	}
	
	
	
$stufeesql = mysql_query("SELECT *, att_ref_id,'USERFNAME','USERLNAME','att_status','att_intime','att_outtime' ,'app_no','att_id','amount','last_payment','last_date','usr_pic' FROM essort_user_relation");
$num_of_rows=mysql_num_rows($stufeesql);
while ($rowstff = mysql_fetch_array($stufeesql)) {

    $staffarray[] = $rowstff;
    if ($rowstff['stu_id'] != '') {
        $sstaffattarray[] = $rowstff['stu_id'];
    }

}
$sstaffattarray = array_filter($sstaffattarray);
$id = implode(",", $sstaffattarray);


$date = date('Y-m-d');
$month = date('F', strtotime($date));

$montharr = array("April", "May", "June");
$monthsecarr = array("July", "August", "September");
$monththirdcarr = array("October", "November", "December");
$monthfourthcarr = array("January", "February", "March");
if (in_array($month, $montharr)) {
    $type = 'first';
} elseif (in_array($month, $monthsecarr)) {
    $type = 'second';

} elseif (in_array($month, $monththirdcarr)) {
    $type = 'third';

} else {
    $type = 'fourth';

}


$feerecievedsql = mysql_query("SELECT * FROM essort_fee_transaction
        WHERE user_id IN (" . $id . ") AND fee_quarter='" . $type . "'");
$feerecieved = mysql_num_rows($feerecievedsql);
$feepending = $num_of_students - $feerecieved;

	?>
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
                        <?php include_once("../includes/header-notice-circular.php"); ?>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="../fee/school-fee.php">Dashboard</a>
                            </li>
                            <li class="active">Fee</li>
                        </ol>
                    </div>
                </div>


                <div class="row">


                    <div class="row">
                        <div class="col-sm-12 col-xs-12 mar-top my-box">
                            <div class="row">
                                <div class="col-sm-4 col-xs-12">
                                    <div class="panel message-center panel-embose bg-color-box user-img tot-staff-bg">
                                        <div class="content">
                                            <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">
                                            <div>
                                                <span>Total Students</span>
                                                <h1 class="my-white"><?php echo $num_of_rows;?></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <!--en panel-->
                                </div>
                                <!--en col-->
                                <div class="col-sm-4 col-xs-12">
                                    <div class="panel message-center panel-embose bg-color-box staffp-bg">
                                        <div class="content">
                                            <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">
                                            <div>
                                                <span>Students Fee Received</span>
                                               <h1 class="my-white"><?php echo $feerecieved;?></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <!--en panel-->
                                </div>
                                <!--en col-->
                                <div class="col-sm-4 col-xs-12">
                                    <div class="panel message-center panel-embose bg-color-box staffa-bg">
                                        <div class="content">
                                            <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">
                                            <div>
                                                <span>Students Fee Pending</span>
                                                <h1 class="my-white"><?php echo $feepending;?></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <!--en panel-->
                                </div>
                            </div>
                            <!--en col-->
                            <div class="row">
                                <div class="pull-left col-sm-12">
                                    <div class="input-group">
                                        <input class="form-control section2" type="search" id="stuname" placeholder="Search Here">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <!--latest circular st-->

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <h5>Select Class</h5>
                                       <select class="form-control" id="class2" onchange="showSubType(this.value,this.id);">
                                           <?php echo $class;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <h5>Select Section</h5>
                                         <select class="form-control section2" id="section2">
											<option value="<?php echo $sqlsection['section_id'];?>"> <?php echo $sqlsection['section_name'];?></option>			

                                       </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr class="table-bg1">
                                                <th>S No.</th>
                                                <th>Name</th>
                                                <th>Profile</th>
                                                <th>Admission No.</th>
                                                <th>Last Payment Amount</th>
                                                <th>Last Payment Date</th>
                                                <th>Current Dues</th>
                                                <th>View Details</th>

                                            </tr>
                                        </thead>
                                        <tbody class="c_teach_tabel" id="studentfee">
										 <?php
                    foreach ($stuidarr as $stufeevalue) {
                        ?>
                        <tr>
                            <td class="text-center">1</td>
                            <td><?php echo $stufeevalue['USERFNAME'];?></td>
                            <td><a href="student-profile.php?stu_id=<?php echo $stufeevalue['stu_id']; ?>"><img
                                        src="../images/images.png"></a>
                            </td>
                            <td><?php echo $stufeevalue['app_no'];?></td>
                            <td><?php echo $stufeevalue['last_payment'];?></td>
                            <td><?php echo $stufeevalue['last_date'];?></td>
                            <td><?php echo $stufeevalue['amount']?></td>
                            <td>
                                <a href="../fee/fees.php?id=<?php echo $stufeevalue['stu_id']; ?>"> <i
                                        class="fa fa-eye view_btn" aria-hidden="true"></i></a>

                            </td>

                        </tr>
                    <?php
                    }
                    ?>										
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                 






                </div>
            </div>
        </div>
        <?php include'../includes/footer.php'; ?>
    </div>
   
<!-- Modal -->
  <div class="modal fade" id="myModalasa" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reason For Cheque Return</h4>
        </div>
        <div class="modal-body">
           <div class="form-group">
               <select class="selectBox2">
    <option>- Select -</option>
    <option>Insufficient Funds</option>
    <option>Signature Mismatch</option>
    <option>Stop Cheque</option>
    <option>Problems with Date of the Cheques</option>
    <option>Difference in Amount in Words and Numbers</option>
    <option>Disfigured or Damaged Cheque</option>
    <option>Scribbling, Overwriting on Cheque</option>
    <option>Other</option>
</select>
<!--  <label for="comment">Reason:</label>-->
<!--  <textarea class="form-control" rows="3" id="comment"></textarea>-->
</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
        </div>
      </div>
      
    </div>
  </div>
<!--  modal End-->
  
    <?php include '../includes/foot.php'; ?>
   


</body>
<script>
    $(document).ready(function () {
        $(".section2").bind("keyup change", function () {
            var classes = $("#class2").val();
            var section = $("#section2").val();
            var studname = $("#stuname").val();
            $.ajax({
                url: "<?php echo HTTP_SERVER; ?>ajax.php?action=students_fee&session=<?php echo $_SESSION['USER']['DB_NAME']; ?>",
                type: "POST",
                data: {
                    classes: classes,
                    section: section,
                    studname: studname
                },
                success: function (data) {
                    $("#studentfee").html(data);
                }
            });
        });
    });
</script>
</html>