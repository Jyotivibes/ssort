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
<?php
$formErr = '';
if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'SAD')) {
    $user_id = $_SESSION['USER']['USER_NAME'];
    require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
    require_once('../../classes/general_class.php');
    $obj = new General();
    include_once 'stastics.php';
    if(isset($_POST['submit_chln'])){
        $excel = $obj->uploadChallan();
        if($excel == 1){
            //$formErr='Challan Uploaded Successfull';
            echo "<script>alert('challan uploaded Successful')</script>";
        }
        else if($excel == 2){
            echo "<script>alert('Invalid User id');</script>";
        }
        else if($excel == 3){
            echo "<script>alert('Invalid Fee Quarter');</script>";
        }
        else if($excel == 4){
            echo "<script>alert('Already submitted for this session');</script>";
        }
        //elseif($excel == 2){
            //echo "<script>alert('File is not going into folder');</script>";
        //}
    }


} else {
    echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
}

$stufeesql = mysql_query("SELECT *, att_ref_id,'USERFNAME','USERLNAME','att_status','att_intime','att_outtime' ,'app_no','att_id','amount','last_payment','last_date','usr_pic' FROM essort_user_relation");
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

<!-- Navigation -->
<?php include '../includes/header-configuration.php'; ?>
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
<?php include_once("../includes/header-notice.php"); ?>


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

                            <h1 class="my-white"><?php echo $num_of_students;?></h1>
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
            <div class="pull-left col-sm-6">
                <div class="input-group">
                    <input class="form-control section2" type="search" id="stuname" placeholder="Search Here">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-search"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="btn-group">
                    <div id="noticemsg"></div>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" onsubmit="return filevalidation()">


                        <ul class="list-inline">
                            <li style="position: relative;top: -13px;">
                                <div class="fileinput fileinput-new btn-info" data-provides="fileinput">
                                    <span class="btn btn-info btn-file"><span class="fileinput-new"><i class="fa fa-upload"
                                                                                               aria-hidden="true"></i> Upload Challan</span><span
                                    class="fileinput-exists">Change</span><input type="file" name="excel" id="fileChooser"></span>
                                    <span class="fileinput-filename"></span>
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput"
                                       style="float: none">&times;</a>
                                </div>
                            </li>
                            <li style="position: relative;top: -13px;">
                                <button type="submit" name="submit_chln" class="btn btn-info" style="">Submit Challan</button>
                            </li>
                            <li>
                                <a href="../school-admin/fee-collector.php">
                                    <button type="button" class="btn btn-success  pull-right"><i class="fa fa-plus"
                                                                                                  aria-hidden="true"></i>
                                        Fee Collectors
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </form>
                    <p><a href="../uploads/upload_challan.xlsx" target="_blank">Download Sample Upload Challan Format <i class="fa fa-download" aria-hidden="true"></i></a>
                    </p>


                </div>
            </div>
        </div>
        <!--latest circular st-->

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <h5>Select Class</h5>
                    <select class="form-control" id="class2" onchange="showSubType(this.value,this.id);">
                        <option value="">Select</option>
                        <?php echo $class; ?>
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
                <table class="table table-bordered">
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
                    <tbody class="c_teach_tabel"  id="studentfee">
                    <?php
					$i=1;
                    foreach ($stuidarr as $stufeevalue) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i;?></td>
                            <td><?php echo $stufeevalue['USERFNAME'];?></td>
                            <td><a href="student-profile.php?stu_id=<?php echo $stufeevalue['stu_id']; ?>"><img
                                        src="../images/images.png"></a>
                            </td>
                            <td><?php echo $stufeevalue['app_no'];?></td>
                            <td><?php echo $stufeevalue['last_payment'];?></td>
                            <td><?php echo $stufeevalue['last_date'];?></td>
                            <td><?php echo $stufeevalue['amount']?></td>
                            <td>
                                <a href="../school-admin/fees.php?id=<?php echo $stufeevalue['stu_id']; ?>"> <i
                                        class="fa fa-eye view_btn" aria-hidden="true"></i></a>

                            </td>

                        </tr>
                    <?php
					$i++;
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-12 my-box">


        <div class="table-responsive">
            <h5><b>All Cheque Details</b></h5>
            <table class="table table-bordered">
                <thead>
                <tr class="table-bg1">
                    <th>S No.</th>
                    <th>Name</th>
                    <th>Deposit Date</th>
                    <th>Admission No.</th>
                    <th>Amount</th>
                    <th>Cheque No.</th>

                    <th>Action</th>

                </tr>
                </thead>
                <tbody class="c_teach_tabel">
                <?php
                if (mysql_num_rows($cheque_detail) == 0) {
                    ?>
                    <tr>
                        <td colspan="7" class="text-center"><?php echo "No record found"; ?></td>
                    </tr>
                <?php
                } else {
                    $i = 1;
                    while ($row = mysql_fetch_array($cheque_detail)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td><?php echo $row['usr_fname'];?></td>
                            <td><?php echo $row['fee_created_on'];?></td>
                            <td><?php echo $row['usr_application_no'];?></td>
                            <td><?php echo $row['payment_amount_by_user'];?></td>
                            <td id="cheque_no_ajx" class="js-check_no"><?php echo $row['cheque_no'];?></td>
                            <td>
                                <select class="selectBox3" name="cheque_status" id="cheque_status">
                                    <option value="">- Select -</option>
                                    <option value="1">Clear</option>
                                    <option value="2" data-toggle="modal" data-target="#myModalasa">Return</option>
                                </select>
                                <input type="hidden" class="js-usr_id" value="<?php echo $row['user_id']; ?>">
                            </td>

                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 my-box">
        <h5><b>Recieved Fee</b></h5>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">From:</label>
                    <div class="col-sm-4">
                        <input class="form-control mydatepicker" placeholder="" type="text">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 control-label">To:</label>
                    <div class="col-sm-4">
                        <input class="form-control mydatepicker" placeholder="" type="text">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-group">
                    <input class="form-control" placeholder="Search Here" type="search">

                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-search"></span>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <!--<h5>Total Amount: <i class="fa fa-inr" aria-hidden="true"></i>
                    960000</h5>-->
            </div>
        </div>
        <div class="table-responsive mar-top">

            <table class="table table-bordered" id="attdata">
                <thead>
                <tr class="table-bg1">
                    <th>S No.</th>
                    <th>Name</th>

                    <th>Admission No.</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Payment Mode</th>

                </tr>
                </thead>
                <tbody class="c_teach_tabel">
                <?php
                $i = 1;
                while ($row = mysql_fetch_array($feerecievedsql)) {
                    $ssqluserdetail = mysql_fetch_array(mysql_query("SELECT * FROM essort_application_header WHERE usr_application_id='" . $row['user_id'] . "'"));

                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i;?></td>
                        <td><?php echo $ssqluserdetail['usr_fname'];?></td>


                        <td><?php echo $ssqluserdetail['usr_application_no'];?></td>
                        <td><?php echo $row['fee_created_on'];?></td>
                        <td><?php echo $row['payment_amount_by_user'];?></td>
                        <td><?php echo $row['payment_mode']; ?></td>


                    </tr>
                    <?php
                    $i++;
                }
                ?>

                </tbody>
            </table>
        </div>
        <!--<div class="row">
            <div class="col-sm-12">
                <button type="button" class="btn btn-info pull-right">Download</button>
            </div>
        </div>-->
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
            <div class="modal-header modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reason For Cheque Return</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select class="selectBox2 form-control" id="slct" name="reason">
                        <option>- Select -</option>
                        <option>Insufficient Funds</option>
                        <option>Signature Mismatch</option>
                        <option>Stop Cheque</option>
                        <option>Problems with Date of the Cheques</option>
                        <option>Difference in Amount in Words and Numbers</option>
                        <option>Disfigured or Damaged Cheque</option>
                        <option>Scribbling, Overwriting on Cheque</option>
                        <option value="Other">Other</option>
                    </select>

                    <textarea form="input" id="txtarea" placeholder="Write your reason here..." name="reason"
                              class="form-control mar-top"></textarea>
                    <!--  <label for="comment">Reason:</label>-->
                    <!--  <textarea class="form-control" rows="3" id="comment"></textarea>-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Submit</button>
            </div>
        </div>

    </div>
</div>
<!--  modal End-->
<script>

    $("#txtarea").hide();
    $("#slct").change(function () {
        var val = $("#slct").val();
        if (val == "Other") {
            $("#txtarea").show();
        } else {
            $("#txtarea").hide();
        }
    });
</script>
<?php include '../includes/foot.php'; ?>
<script>
    $('select[name="cheque_status"]').change(function () {
        console.log('running');
        //$("[id^='cheque_status']").change(function(){

        //var cheqSplit = $(this).attr('id').split('#');
        //alert(cheqSplit[1]);
//        var cheque = $("#cheque_status option:selected").val();
        var cheque = $(this).val();
        console.log(cheque);
//        var cheque_no_ajx = $("#cheque_no_ajx").html();
        var cheque_no_ajx = $(this).closest('td').siblings('td.js-check_no').html();
        console.log(cheque_no_ajx);
        //var user_id_ajx = $("#user_id_ajx").val();
        var user_id_ajx = $(this).siblings(".js-usr_id").val();
        console.log(user_id_ajx);
        //alert(cheque_no_ajx);
        //alert(user_id_ajx);
        //alert(cheque);
        if (cheque == 1) {
            //alert("Check is running");
            $.ajax({
                url: "<?php echo HTTP_SERVER; ?>ajax.php?action=insert_cheque_details&session=<?php echo $_SESSION['USER']['DB_NAME']; ?>",
                type: "POST",
                data: {
                    cheque_no_ajx: cheque_no_ajx,
                    user_id_ajx: user_id_ajx
                },
                success: function (data) {
                    //console.log(data)
                    if (data == 1) {
                        alert("Check has been cleared");
                    }
                }
            });
        }
        if (cheque == 2) {
            $("#myModalasa").modal('show');
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('#attdata').DataTable({
            paging: false,
            ordering: false,
            searching: false,
            info: false,

//            select: false,
//            select: {
//                info: false
//            }
            dom: 'frtipB',
//            dom: 'B<"clear">lfrtip',
            buttons: {
                buttons: [
                    { extend: 'excel', className: 'btn btn-default', text: 'Download As Excel'},
                    { extend: 'pdf', className: 'btn btn-default', text: 'Download As PDF' }

                ]
            }
//            buttons: [
//                'excel', 'pdf'
//            ]
        });
    });
</script>
<script>
    function filevalidation(){
        var ext = $('#fileChooser').val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['xlsx','xls']) == -1) {
            document.getElementById('noticemsg').innerHTML='Please select Excel File';
            return false;
        }
    }

</script>
<!-------------------FOR STUDENT CALSS AND SECTION SELECTION----------------->
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
</body>

</html>