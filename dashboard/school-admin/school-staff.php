<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | Admin Staff</title>
    <?php include '../includes/head.php'; ?>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php
        if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'SAD')) {
            $user_id = $_SESSION['USER']['USER_NAME'];
            require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
            require_once('../../classes/general_class.php');
            $obj = new General();
            include_once 'stastics.php';
    /*$sqlnote=mysql_query("SELECT *,'att_in_time','attout_time','usr_salary','dept_name'  FROM  essort_user_header WHERE usr_role IN ('Teacher')");
    $rowatt=array();
    while($rownote=mysql_fetch_array($sqlnote))
    {
        //salary
        $sqlsal=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_details WHERE usr_id='".$rownote['usr_id']."'"));
        $sql=mysql_query("SELECT att_in_time,attout_time FROM essort_class_attendence WHERE stu_id='".$rownote['att_ref_id']."' AND att_date='".date('Y-m-d')."'" );
        $rowusr=mysql_fetch_array($sql);
        $rownote['att_in_time']=$rowusr['att_in_time'];
        $rownote['usr_salary']=$sqlsal['usr_salary'];
        $rownote['dept_name']=$sqlsal['dept_name'];
        $rownote['attout_time']=$rowusr['attout_time'];
        $rowatt[]=$rownote;

    }
    $num_of_rows=mysql_num_rows($sqlnote);
    $sqlstu=mysql_query("SELECT * FROM essort_class_attendence WHERE att_status='P' AND att_date='".date('Y-m-d')."'");
    $tnum_of_rows=mysql_num_rows($sqlstu);
    $availabele=$num_of_rows-$tnum_of_rows;
    //Leave
    $sqlleave=mysql_query("SELECT *,MAX(leave_date) as maxdate,MIN(leave_date) as mindate,'usr_fname','usr_lname' FROM essort_teacher_leave_info GROUP BY submit_date,usr_id");
    $rowattleaveinfo=array();
    while($rowleave=mysql_fetch_array($sqlleave))
    {
        $sqlusr=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='".$rowleave['usr_id']."'"));
        $rowleave['usr_fname']=$sqlusr['usr_fname'];
        $rowleave['usr_lname']=$sqlusr['usr_lname'];
        $rowattleaveinfo[]=$rowleave;

    }
    //print_r($rowatt);
    //ATTENDENCE
    $sqlattnote=mysql_query("SELECT *  FROM  essort_user_header WHERE usr_role IN ('Teacher')");
    $rowattle=array();
    while($rowattleave=mysql_fetch_array($sqlattnote))
    {
        $sql=mysql_query("SELECT att_status,attout_time FROM essort_class_attendence WHERE stu_id='".$rowattleave['att_ref_id']."' AND att_date='".date('Y-m-d')."'" );
        $rowusr=mysql_fetch_array($sql);
        $rowleave['att_status']=$rowusr['att_status'];
        $rowleave['attout_time']=$sqlusr['attout_time'];
        $rowleave['attin_time']=$sqlusr['attin_time'];
        $rowattle[]=$rowattleave;

    }
    $attnum_of_rows=mysql_num_rows($sqlattnote);*/
    if (isset($_REQUEST['SubmitUS'])) {
        $res = $obj->UPLOADSALARY();
        if ($res == 1) {
            echo "<script>alert('Salary Uploaded successfully.');</script>";
            echo "<script>window.location.href='school-staff.php';</script>";
        }
        else if ($res == 2) {
            echo "<script>alert('Invalid User Id');</script>";
            echo "<script>window.location.href='school-staff.php';</script>";
        }
    }
    $formErr = '';
    if (isset($_REQUEST['EditA'])) {
        if ($_REQUEST['present'] == "Absent") {
            $data = $obj->DELETEATT();
            if ($data == 1) {
                $formErr = 'Attendance Removed successfully';
                $reurl = 'school-staff.php';
            } elseif ($data == 2) {
                echo "<script>alert('Issue in sql query')</script>";
            }
        } else {
            $res = $obj->EDITATT();
            if ($res == 2) {
                $formErr = 'Required parameter missing';
            } else if ($res == 0) {
                $formErr = 'Problem in network.Please try again.';

            } else if ($res == 1) {
                $formErr = 'Edit Attendance successfully';
                $reurl = 'school-staff.php';
            }
        }
    }


} else {
    echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
}
?>
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
                <?php include_once("../includes/header-notice-circular.php"); ?>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <ol class="breadcrumb bread-change">
                    <li>
                        <a href="<?php echo ADMIN_DASHBOARD_LINK; ?>">Dashboard</a>
                    </li>
                    <li class="active">School Staff</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!--notice circular row st-->
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="my-box">

                    <section class="m-t-40">
                        <!--tab st-->
                        <div class="sttabs-1 sttabs tabs-style-flip-1">
                            <nav>
                                <ul>
                                    <li class="tab-current tab-current-1"><a href="#student"><strong>Staff Attendance</strong></a>
                                    </li>
                                    <li><a href="#staff"><strong> Staff Salary</strong></a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="content-wrap">
                                <section id="#student" class="content-current">
                                    <div>
                                        <div>
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <div class="my-box comment-center">
                                                        <form method="post" action="">
                                                            <div class="c_teach_att_search clearfix">
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="mar-4">
                                                                        <div class="input-group date" data-provide="datepicker">
                                                                            <input type="hidden" name="session" id="db" value="<?php echo $dbname; ?>"/>
                                                                            <input type="text" class="form-control datestaff searchmain" id="date"
                                                                            value="<?php echo date('Y-m-d'); ?>">

                                                                            <div class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="mar-4">
                                                                        <div class="input-group">
                                                                            <input type="search" class="form-control searchmain" id="search"
                                                                            placeholder="Search By Name">

                                                                            <div class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-search"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <div class="table-responsive new_tbl_height_onee">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr class="table-bg1">
                                                                        <th>S No.</th>
                                                                        <th>Name</th>
                                                                        <th>Profile</th>
                                                                        <th>Designation</th>
                                                                        <th>In Time</th>
                                                                        <th>Out Time</th>
                                                                        <th>Edit</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="c_teach_tabel" id="Table">
                                                                    <?php
                                                                    $i = 1;
                                                                    foreach ($rowatt as $vluetr) {
                                                                        if ($vluetr['usr_pic'] == '') {
                                                                            $vluetr['usr_pic'] = 'images.png';
                                                                        }

                                                                        ?>
                                                                        <tr>
                                                                            <tr>
                                                                                <td class="text-center"><?php echo $i;?></td>
                                                                                <td><?php echo $vluetr['usr_fname'];?></td>
                                                                                <td><a href="staff-profile.php?teach_id=<?php echo $vluetr['usr_id']; ?>"><img
                                                                                    src="../../<?php echo $_SESSION['USER']['DB_NAME']; ?>/uploads/staff/<?php echo  $vluetr['usr_pic']; ?>"></a>
                                                                                </td>

                                                                                <td><?php echo $vluetr['usr_role'];?></td>
                                                                                <td id="att_in_time_value"><?php if ($vluetr['att_in_time'] != '') {
                                                                                    echo $vluetr['att_in_time'];
                                                                                } else {
                                                                                    echo '-';
                                                                                }?></td>
                                                                                <td><?php if ($vluetr['attout_time'] != '') {
                                                                                    echo $vluetr['attout_time'];
                                                                                } else {
                                                                                    echo '-';
                                                                                }?></td>
                                                                                <td class="text-center">
                                                                                    <?php if ($vluetr['att_ref_id'] != '') {
                                                                                        ?>

                                                                                        <a href="javascript:void(0)" class="editattend"
                                                                                        data-user="<?php echo $vluetr['att_ref_id']; ?>"
                                                                                        data-id="<?php echo $vluetr['att_id']; ?>"
                                                                                        data-in="<?php echo $vluetr['att_in_time']; ?>"
                                                                                        data-out="<?php echo $vluetr['attout_time']; ?>">
                                                                                        <i class="fa fa-pencil-square font-icon-size" aria-hidden="true"></i>
                                                                                    </a>


                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $i++;
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                        <div class="row mar-top">
                                                            <div class="col-sm-12">
                                                                <a href="staff-month-attendance.php">
                                                                    <button type="button" class="pull-right btn btn-info">View Full Month Attendance</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--progress en-->

                                                </div>


                                                <!--col-en-->
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <!--latest circular st-->

                                                    <div class="col-sm-12 prin-1 panel-embose-b my-box clearfix">
                                                        <div class="col-md-3 col-sm-4 col-xs-4">
                                                            <img src="../images/staff.png" alt="user" class="img-size img-circle">
                                                        </div>
                                                        <div class="col-sm-9 col-sm-8 col-xs-8">
                                                            <div class="mail-contnet">
                                                                <h5 class="text-center">Staff</h5>
                                                                <h5 class="head-web"><?php echo $num_of_staffs;?></h5>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-6 for_new">
                                                                <button type="button"
                                                                class="panel-embose-d btn btn-success btn-sm"><?php echo $pnum_of_staffs;?></button>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-6 for_new">
                                                                <button type="button"
                                                                class="panel-embose-d btn btn-danger btn-sm"><?php echo $anum_of_staffs;?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="my-box fee-head">
                                                        <h5 class="text-center"><a href="#">Staff on Leave</a></h5>

                                                        <div class="staff-table">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th>Designation</th>
                                                                        <th>View</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    foreach ($rowattleaveinfo as $rowvlue) {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $rowvlue['usr_fname'];?></td>
                                                                            <td><?php echo $rowvlue['usr_role'];?></td>
                                                                            <td>
                                                                                <a href="#id" data-toggle="modal" class="staffLeave"
                                                                                data-reason="<?php echo $rowvlue['leave_reason']; ?>"
                                                                                data-from="<?php echo date('d-m-Y', strtotime($rowvlue['mindate'])); ?>"
                                                                                data-to="<?php echo date('d-m-Y', strtotime($rowvlue['maxdate'])); ?>">
                                                                                <i class="view_btn fa fa-eye" aria-hidden="true"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>

                                                    </div>

                                                </div>

                                                <div class="my-box clearfix">

                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <select class="form-control seldata" id="seldata">
                                                                <option value="">Select</option>
                                                                <?php
                                                                foreach ($staffarray as $vluestaff) {
                                                                    ?>
                                                                    <option
                                                                    value="<?php echo $vluestaff['att_ref_id']; ?>" <?php if ($vluestaff['att_ref_id'] == DEFAULT_STAFF) echo 'selected';?>><?php echo $vluestaff['usr_fname'];?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <select class="form-control seldata" id="selyear">
                                                                <option value="2017-2018" <?php if (DEFAULT_SESSION == '2017-2018') echo 'selected';?>>2017-2018
                                                                </option>
                                                                <option value="2016-2017">2016-2017</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div id="chartdiv"></div>

                                                    <div>
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr class="table-bg1">
                                                                    <th>Month</th>
                                                                    <th>No of Days</th>
                                                                    <th>Days Present</th>
                                                                    <th>Days Absent</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="c_teach_tabel" id="SideTable">
                                                                <?php
                                                                foreach ($rowtble as $rowtblvlue) {
                                                                    $monthNum = $rowtblvlue['m'];
                                                                    $dateObj = DateTime::createFromFormat('!m', $monthNum);
                    $monthName = $dateObj->format('F'); // March

                    ?>
                    <tr>
                        <td><?php echo $monthName;?></td>
                        <td><?php echo $rowtblvlue['TOTAL'];?></td>
                        <td><?php echo $rowtblvlue['PRESENT'];?></td>
                        <td><?php echo $rowtblvlue['ABSENT'];?></td>
                    </tr>
                    <?php
                }
                ?>
                <!-- <tr>
                     <td>May</td>
                     <td>25</td>
                     <td>24</td>
                     <td>1</td>
                 </tr>
                 <tr>
                     <td>June</td>
                     <td>25</td>
                     <td>24</td>
                     <td>1</td>
                 </tr>
                 <tr>
                     <td>July</td>
                     <td>25</td>
                     <td>24</td>
                     <td>1</td>
                 </tr>
                 <tr>
                     <td>August</td>
                     <td>25</td>
                     <td>24</td>
                     <td>1</td>
                 </tr>
                 <tr>
                     <td>September</td>
                     <td>25</td>
                     <td>24</td>
                     <td>1</td>
                 </tr>
                 <tr>
                     <td>October</td>
                     <td>25</td>
                     <td>24</td>
                     <td>1</td>
                 </tr>
                 <tr>
                     <td>November</td>
                     <td>25</td>
                     <td>24</td>
                     <td>1</td>
                 </tr>
                 <tr>
                     <td>December</td>
                     <td>25</td>
                     <td>24</td>
                     <td>1</td>
                 </tr>
                 <tr>
                     <td>January</td>
                     <td>25</td>
                     <td>24</td>
                     <td>1</td>
                 </tr>
                 <tr>
                     <td>February</td>
                     <td>25</td>
                     <td>24</td>
                     <td>1</td>
                 </tr>
                 <tr>
                     <td>March</td>
                     <td>25</td>
                     <td>24</td>
                     <td>1</td>
                 </tr>-->
             </tbody>
         </table>
     </div>
     <div class="row">
        <div class="col-sm-12 col-xs-12">
            <a href="attendance-staff.php?id=<?php echo DEFAULT_STAFF; ?>" id="viewdetail"
               class="btn btn-link pull-right v-detail"><span class="fa fa-eye"></span> View Detail</a><!---->
           </div>
       </div>


   </div>


</div>


<!-- sunny25 -->


</div>
</div>

</div>

</section>

<!-- first tab end -->

<section id="#staff">
    <div>
        <div class="panel-wrapper collapse in table-responsive">
            <section id="#student" class="content-current">
                <div>

                    <div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div class="my-box comment-center">
                                    <div class="c_teach_att_search clearfix">
                                        <form action="" method="post">
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="mar-4">
                                                    <select class="form-control salarydata" id="salyear" name="salyear">
                                                        <option value="">Select</option>
                                                        <option>2017-2018</option>
                                                        <option>2016-2017</option>
                                                        <option>2015-2016</option>
                                                        <option>2014-2015</option>
                                                        <option>2013-2014</option>
                                                        <option>2012-2013</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="mar-4">
                                                    <select class="form-control salarydata" id="salmonth" name="salmonth">
                                                        <option value="">Select</option>
                                                        <option>January</option>
                                                        <option>February</option>
                                                        <option>March</option>
                                                        <option>April</option>
                                                        <option>May</option>
                                                        <option>June</option>
                                                        <option>July</option>
                                                        <option>August</option>
                                                        <option>September</option>
                                                        <option>October</option>
                                                        <option>November</option>
                                                        <option>December</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="mar-4">
                                                    <div class="input-group">
                                                        <input class="form-control salarydata" type="search" name="elementsearch" id="salarydata"
                                                        placeholder="Search By Name"><!--id="salarydata"-->
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-search"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                <!-- <div class="row col-sm-8 mar-top">
             <h5><b>Total Salary: <i class="fa fa-inr" aria-hidden="true"></i> 600000</b></h5>
         </div>-->

         <div class="row col-sm-4 pull-right mar-top">
            <div class="input-group">

                <input type="button" data-toggle="modal" data-target="#myModall" class="all-btm form-control"
                aria-label="Upload" value="Upload Salary"><br><br>

                <p><a href="<?php echo HTTP_SERVER . "" . 'salary.xlsx'; ?>" id="downloadexcel">Download Excel
                    Format <i class="fa fa-download" aria-hidden="true"></i></a></p>
                </div>
            </div>
        </form>


    </div>

    <div class="table-responsive new_tbl_height_two22">
        <table class="table table-bordered">
            <thead>
                <tr class="table-bg1">
                    <th>S No.</th>
                    <th>Name</th>
                    <th>Profile</th>
                    <th>Emp Id</th>
                    <th>Depatment Name</th>
                    <th>Salary</th>
                    <th>Status</th>


                </tr>
            </thead>
            <tbody class="c_teach_tabel" id="c_teach_staffsal">
                <?php
                $i = 1;

                foreach ($rowatt as $rvlue) {
                    if ($rvlue['usr_pic'] == '') {
                        $rvlue['usr_pic'] = 'images.png';
                    }
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i;?></td>
                        <td><?php echo $rvlue['usr_fname'];?></td>
                        <td><a href="staff-profile.php?teach_id=<?php echo $rvlue['usr_id']; ?>"><img
                            src="../../<?php echo $_SESSION['USER']['DB_NAME']; ?>/uploads/staff/<?php echo $rvlue['usr_pic']; ?>"></a>
                        </td>
                        <td><?php echo $rvlue['emp_id'];?></td>
                        <td><?php echo $rvlue['dept_name'];?></td>
                        <td><?php echo $rvlue['usr_salary'];?></td>
                        <td><?php if ($rvlue['salary_status'] == 'Confirmed') echo 'A'; else echo 'P';?></td>


                    </tr>
                    <?php
                    $i++;
                }
                ?>


            </tbody>
        </table>
        <div class="col-sm-6 col-xs-6 margin-to"><p class="pull-left"><span class="red_o">&#9632;</span> A&#8594; Approved</p>
        </div>
        <div class="col-sm-6 col-xs-6 margin-to"><p class="pull-right"><span class="green_o">&#9632;</span> P&#8594; Pending</p>
        </div>
    </div>
</div>
<!--progress en-->

</div>


<!--col-en-->
<div class="col-md-4 col-sm-4 col-xs-12">
    <div class="my-box clearfix ">
        <h5 class="text-center"><b>Last 5 Months Salary Summary</b></h5>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Months</th>
                        <th>No. of Staff</th>
                        <th>Ammount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($saldata as $sqlvlue) {
                        ?>
                        <tr>
                            <td><?php echo $sqlvlue['m'];?></td>
                            <td><?php echo $sqlvlue['NO_OF_STAFF'];?></td>
                            <td><i class="fa fa-inr" aria-hidden="true"></i><?php echo $sqlvlue['salary_amount'];?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>
        <div id="stackedbar" style="width:100%; height:180px;">

        </div>


    </div>

</div>

<div class="col-md-4 col-sm-4 col-xs-12">
    <!--latest circular st-->


    <div class="my-box clearfix">

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <select class="form-control staff_sal" id="staffname">
                    <?php echo $optionstaffsal;?>
                </select>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <select class="form-control staff_sal" id="staffyear">
                    <option value="2017-2018">2017-2018</option>
                    <option value="2016-2017">2016-2017</option>
                    <option value="2015-2016">2015-2016</option>
                    <option value="2014-2015">2014-2015</option>
                    <option value="2013-2014">2013-2014</option>
                    <option value="2012-2013">2012-2013</option>

                </select>
            </div>
        </div>


        <div class="col-sm-12 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-bg1">
                        <th>Month</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tbody class="c_teach_tabel" id="salsidemenu">
                    <?php
                    foreach ($saldata as $salv) {
                        ?>

                        <tr>
                            <td><?php echo $salv['m'];?></td>
                            <td><?php echo $salv['salary_amount'];?></td>

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
</section>
</div>
</div>
</section>


</div>


<!-- /content -->
</div>
<!--tab en-->

</section>

</div>
<!--en white-box-->
</div>

<!--en col-->
</div>
<!--en row-->

<!--notice circular row en-->

</div>

<!-- .right-sidebar st here-->
</div>

<!-- /.container-fluid -->
<?php include'../includes/footer.php'; ?>
</div>
<!-- /#wrapper -->
<!-- Modal -->
<div class="modal fade" id="myModall" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Salary</h4>
            </div>
            <form action="" method="post" enctype="multipart/form-data" onsubmit="return filevalidation()">
                <div id="noticemsg"></div>
                <div class="modal-body">
                    <div class="col-lg-6">
                        <label class="m-t-20">Select Month</label>

                        <div class="input-group clockpicker">
                            <select class="form-control" name="month" id="month">
                                <option value="">Select</option>
                                <option>January</option>
                                <option>February</option>
                                <option>March</option>
                                <option>April</option>
                                <option>May</option>
                                <option>June</option>
                                <option>July</option>
                                <option>August</option>
                                <option>September</option>
                                <option>October</option>
                                <option>November</option>
                                <option>December</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="m-t-20">Select Year</label>

                        <div class="input-group clockpicker">
                            <select class="form-control" name="sal_year" id="sal_year">
                                <option value="">Select</option>
                                <option value="2017-2018">2017-2018</option>
                                <option value="2016-2017">2016-2017</option>
                                <option value="2015-2016">2015-2016</option>
                                <option value="2014-2015">2014-2015</option>
                                <option value="2013-2014">2013-2014</option>
                                <option value="2012-2013">2012-2013</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="m-t-20">Select File</label>

                        <div class="input-group">
                            <input value="Browse" type="file" name="sal_file" id="fileChooser" >

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-default" id="SubmitUS" name="SubmitUS" value="Submit">
                </div>
            </form>
        </div>

    </div>
</div>
<!-- Modal -->
<!-- Modal -->
<!-- Modal -->

<script>
    jQuery(document).ready(function () {
        $(document).on('click', '.editattend', function (e) {
            var user = jQuery(this).attr("data-user");
            var id = jQuery(this).attr("data-id");
            //alert(id);
            var intime = jQuery(this).attr("data-in");
            if (intime == '-' || intime == '') {
                jQuery("#present_radio_div").show();
                jQuery("#absent_radio_div").hide();
                jQuery("#present_radio").attr('checked', 'checked');
            }
            else {
                jQuery("#present_radio_div").show();
                jQuery("#absent_radio_div").show();
            }
            var outtime = jQuery(this).attr("data-out");
            var date = jQuery(".datestaff").val();
            jQuery("#outtime").val(outtime);
            jQuery("#user").val(user);
            jQuery("#intime").val(intime);
            jQuery("#att_id").val(id);
            jQuery("#date_popup").val(date);
            jQuery("#myModal").modal('show');
        });
    });
</script>

<div class="modal fade my-modal" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Attendance</h4>

                <div id="inouterror"></div>
            </div>
            <form class="form-inline" method="post" id="myform2" action="" onsubmit="return TimeValidation();">
                <div class="modal-body">
                    <input class="form-control" value="09:30" type="hidden" id="att_id" name="att_id">
                    <input class="form-control" value="" type="hidden" id="user" name="id">
                    <input class="form-control" type="hidden" id="date_popup" name="att_date">
                    <input class="form-control" value="<?php echo CURRENT_SESSION; ?>" type="hidden"
                    name="curr_session">

                    <div id="present_radio_div">
                        <input type="radio" id="present_radio" name="present" value="present">Present
                    </div>
                    <div class="col-lg-6">
                        <label>Intime</label>

                        <div class="input-group clockpicker">
                            <input class="form-control" value="09:30" type="text" id="intime" name="intime">
                            <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label>Outtime</label>

                        <div class="input-group clockpicker">
                            <input class="form-control" value="09:30" type="text" id="outtime" name="outtime">
                            <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
                        </div>
                    </div>
                    <div id="absent_radio_div">
                        <input type="radio" id="absent_radio" name="present" value="Absent">Absent
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-12">
                        <input type="button" class="btn btn-default reset" value="Cancel">
                        <input type="submit" class="btn btn-default" name="EditA" value="Submit">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Modal -->
<!---------------mODAL FOR STAFF ON LEAVE TODAY----------------------->
<div class="modal fade" id="staffLeave" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Staff on Leave Today</h4>

            </div>

            <div class="modal-body">
                <span id="from"></span>
                <span id="l_to"></span>

                <p id="reason" class="text-justify"></p>
            </div>
            <div class="modal-footer">
                <div class="row">
                </div>
            </div>
        </div>

    </div>
</div>
<?php include '../includes/foot.php'; ?>
<!------------STAFF ON LEAVE TODAY----------------------->
<script>
    $(".staffLeave").click(function () {
        var reason = $(this).attr("data-reason");
        var l_from = $(this).attr("data-from");
        var l_to = $(this).attr("data-to");
        if (l_from == l_to) {
            $("#from").html(l_from);
        }
        else {
            $("#from").text(' From : ' + l_from);
            $("#l_to").text(' To : ' + l_to);
        }
        $("#reason").html(reason);
        $("#staffLeave").modal('show');


    });
</script>
<!--Style Switcher -->
<script type="text/javascript">
    $(".searchmain").bind("change keyup", function (e) {
        var action = 'searchstaff';
        var session = '<?php echo $dbname; ?>';
        var txtElement = $("#search").val();
        var date = $("#date").val();
//if(txtElement=='')
//{
    //return false;
//}
//if(date=='')
//{
    //return false;
//}
var dataString = 'element=' + txtElement + '&session=' + session + '&date=' + date + '&action=' + action;

$.ajax({
    type: 'POST',
    data: dataString,
    url: '../../ajax.php',
    success: function (data) {
        if (data != "") {
                //window.location.reload();
                if (data == 1) {
                    alert("Required Parameter Missing");
                    $("#preloader").css("display", "none");
                    return false;
                }
                else if (data == 4) {
                    alert("Session Expired......Try Again.....");
                    $("#preloader").css("display", "none");
                    //$('.loginform .user').val("");
                    //$('.loginform .password').val("");
                    //window.location.reload();
                }
                else {
                    //alert("Successfully");
                    $("#preloader").css("display", "none");
                    $("#Table").html(data);
                    //$('.loginform .user').val("");
                    //$('.loginform .password').val("");
                    //window.location.reload();
                }
            }
        }

    });

});
///////////////////////////

$(".salarydata").keyup(function (e) {
    var action = 'searchsalarydata';
    var salyear = $("#salyear").val();
    var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>';
    var salmonth = $("#salmonth").val();
    var elementsearch = $("#salarydata").val();
    var dataString = 'salyear=' + salyear + '&salmonth=' + salmonth + '&session=' + session + '&elementsearch=' + elementsearch + '&action=' + action;
//alert(dataString);
$.ajax({
    type: 'POST',
    data: dataString,
    url: '../../ajax.php',
    success: function (data) {
            //alert(data);
            if (data != "") {
                //window.location.reload();
                if (data == 1) {
                    alert("Required Parameter Missing");
                    $("#preloader").css("display", "none");
                    return false;
                }
                else if (data == 4) {
                    alert("Session Expired......Try Again.....");
                    $("#preloader").css("display", "none");
                    //$('.loginform .user').val("");
                    //$('.loginform .password').val("");
                    window.location.reload();
                }
                else {
                    //alert(data);
                    $("#preloader").css("display", "none");
                    $("#c_teach_staffsal").html(data);
                    //$('.loginform .user').val("");
                    //$('.loginform .password').val("");
                    //window.location.reload();
                }
            }
        }

    });


});
//##############################################################################################

$(".seldata").change(function (e) {
    var action = 'searchstaffatt';
    var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>';
    var txtElement = $("#seldata").val();
    var selyear = $("#selyear").val();
    if (txtElement == '') {
        $("#viewdetail").hide();
    }
    else {
        $("#viewdetail").show();
        $("#viewdetail").attr('href', 'attendance-staff.php?id=' + txtElement);
    }
    var dataString = 'element=' + txtElement + '&session=' + session + '&salyear=' + selyear + '&action=' + action;
//alert(dataString);
$.ajax({
    type: 'POST',
    data: dataString,
    url: '../../ajax.php',
    success: function (data) {
            //alert(data);
            if (data != "") {
                //window.location.reload();
                if (data == 1) {
                    alert("Required Parameter Missing");
                    $("#preloader").css("display", "none");
                    return false;
                }
                else if (data == 4) {
                    alert("Session Expired......Try Again.....");
                    $("#preloader").css("display", "none");
                    //$('.loginform .user').val("");
                    //$('.loginform .password').val("");
                    //window.location.reload();
                }
                else {
                    //alert(data);
                    $("#preloader").css("display", "none");
                    $("#SideTable").html(data);
                    //$('.loginform .user').val("");
                    //$('.loginform .password').val("");
                    //window.location.reload();
                }
            }
        }

    });


});
//##############################################################################################

$(".staff_sal").change(function (e) {
    var action = 'searchstaffsidemenue';
    var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>';
    var staffname = $("#staffname").val();
    var staffyear = $("#staffyear").val();
    var dataString = 'staffname=' + staffname + '&session=' + session + '&staffyear=' + staffyear + '&action=' + action;
//alert(dataString);
$.ajax({
    type: 'POST',
    data: dataString,
    url: '../../ajax.php',
    success: function (data) {
            //alert(data);
            if (data != "") {
                //window.location.reload();
                if (data == 1) {
                    alert("Required Parameter Missing");
                    $("#preloader").css("display", "none");
                    return false;
                }
                else if (data == 4) {
                    alert("Session Expired......Try Again.....");
                    $("#preloader").css("display", "none");
                    //$('.loginform .user').val("");
                    //$('.loginform .password').val("");
                    window.location.reload();
                }
                else {
                    //alert(data);
                    $("#preloader").css("display", "none");
                    $("#salsidemenu").html(data);
                    //$('.loginform .user').val("");
                    //$('.loginform .password').val("");
                    //window.location.reload();
                }
            }
        }

    });


});
//##############################################################################################

$("#downloadexcel").keypress(function (e) {
    var action = 'download';
    var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>';
    var dataString = 'session=' + session + '&action=' + action;
//alert(dataString);
$.ajax({
    type: 'POST',
    data: dataString,
    url: '../../ajax.php',
    success: function (data) {
        alert(data);

    }

});


});
//##############################################################################################
</script>

<?php
#Show form error message
if ($formErr != "") {
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
    function TimeValidation() {
        var intime = jQuery("#intime").val();
        var outtime = jQuery("#outtime").val();
        //alert(outtime);
        if (outtime != '') {
            if (intime > outtime) {
                document.getElementById("inouterror").innerHTML = 'Out time should be Greater than InTime';
                document.getElementById("outtime").focus();
                return false;
            }
        }
        else {
            if (intime == '') {
                document.getElementById("inouterror").innerHTML = 'In time must be Fiiled';
                return false;
            }

        }
    }
</script>
<script>

    var chart = AmCharts.makeChart("stackedbar", {
        "theme": "light",
        "type": "serial",
        "dataProvider": [
        <?php
                            //$i = 0;
                            //$size = count($saldata);
        foreach ($saldata as $key=>$sqlvlue) {
                            //echo ($size==++$i)?'':', ';
         ?>
         {

            "country": "<?php echo $sqlvlue['m'];?>",
            "year2004": (<?php echo $sqlvlue['salary_amount'];?>+0)
        },
        <?php
    }
    ?>

    ],
    "valueAxes": [
    {
        "stackType": "3d",
        "unit": "",
        "position": "left",
        "title": "Last 5 month Salary"
    }
    ],
    "startDuration": 1,
    "graphs": [
    {
        "balloonText": " [[category]]: <b>[[value]]</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "2004",
        "type": "column",
        "valueField": "year2004"
    },
    {
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "2016",
        "type": "column",
        "valueField": "year2005"
    }
    ],
    "plotAreaFillAlphas": 0.1,
    "depth3D": 60,
    "angle": 30,
    "categoryField": "country",
    "categoryAxis": {
        "gridPosition": "start"
    },
    "export": {
        "enabled": true
    }
});
    jQuery('.chart-input').off().on('input change', function () {
        var property = jQuery(this).data('property');
        var target = chart;
        chart.startDuration = 0;

        if (property == 'topRadius') {
            target = chart.graphs[0];
            if (this.value == 0) {
                this.value = undefined;
            }
        }

        target[property] = this.value;
        chart.validateNow();
    });
</script>
<script>

    $(function () {
        var chart = AmCharts.makeChart("chartdiv", {

            "labelRadius": -40,
            "labelText": "[[status]]: [[percents]]%",

            "type": "pie",
            "theme": "light",
            "dataProvider": [
            {
                "status": "Present",
                "value": (<?php echo $sqlclasssectionstaff; ?>+0)
            },
            {
                "status": "Absent",
                "value": (<?php echo $sqlclasssectionstaffab; ?>+0)
            }
            ],
            "valueField": "value",
            "titleField": "status",
            "outlineAlpha": 0.4,
            "depth3D": 25,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 40,
            "export": {
                "enabled": true
            }

        });
    });
</script>
<!---------FOR RESET FIELDS------------>
<script>
    $(document).ready(function () {
        $(".reset").click(function () {
            $('#outtime').val("");
            $('#intime').val("");
        });
    });
</script>
<!--On Click Absent Blank Data-->
<script>
    $(document).ready(function () {
        $("#absent_radio").click(function () {
            $('#outtime').val("");
            $('#intime').val("");
        })
    });
</script>
<!----------------------FILE VALIDATION------------------------------------>
<script>
    $(document).ready(function(){
        $("#SubmitUS").click(function(){
            var month = $("#month").val();
            var sal_year = $("#sal_year").val();
            var fileChooser = $("#fileChooser").val();
            if(month == ""){
                $("#noticemsg").html("Please select month");
                return false;
            }
            else if(sal_year == ""){
                $("#noticemsg").html("Please select Year");
                return false;
            }
        });
    });
</script>
<script> 
    function filevalidation() {
        var ext = $('#fileChooser').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['xlsx', 'xls']) == -1) {
            document.getElementById('noticemsg').innerHTML = 'Please select Excel File';
            return false;
        }
    }
</script>

</body>
</html>