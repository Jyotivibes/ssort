<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Admin Staff</title>
    <?php include '../includes/head.php'; ?>
</head>

<body>
<div id="wrapper">
<?php
if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Principal')) {
    $user_id = $_SESSION['USER']['USER_NAME'];
    require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
    require_once('../../classes/general_class.php');
    $obj = new General();
	require_once('../../classes/staff_class.php');
    $obj2 = new Staff();
	require_once('../../classes/student_class.php');
    $obj3 = new Student();
    include_once '../stastics.php';
    $rowatt = $obj->ALLSTAFFWITHSALARY();
	//#######TOTAL NO OF STAFFS##################
	$num_of_staffs = $obj2->getnoofstaff();
	$pnum_of_staffs = $obj2->getpresentnoofstaffs();
	$stuleaveidarr  = $obj2->getStaffonLeave();
	$saldata = $obj->LAST5MONTHSALARY();
	$salmonthlydata = $obj->MONTHLYSALARY(CURRENT_STAFF_SAL,CURRENT_SESSION);
	$rowtble  = $obj2->staffmonthwiseatt(DEFAULT_STAFF,CURRENT_SESSION);
	$sqlclasssectionstaff  = $obj2->presentinsession(DEFAULT_STAFF,CURRENT_SESSION);
	$todaySdate=date("Y-m-d");
	$currstu=$obj->getWorkingDays(SESSION_START_DATE,$todaySdate,$holidayss);
	$sqlclasssectionstaffab=$currstu-$sqlclasssectionstaff;  
	$anum_of_staffs = $num_of_staffs-$pnum_of_staffs;
	$sessionarr = $obj->allsessions();
    $formErr = '';
    if (isset($_REQUEST['EditA'])) {
        $res = $obj->EDITATT();

        if ($res == 2) {
            $formErr = 'Required parameter missing';
        } else if ($res == 0) {
            $formErr = 'Problem in network.Please try again.';

        } else if ($res == 1) {
            $formErr = 'Edit Attendance successfully';
            $reurl = 'admin-staff.php';
        }
    }
	$stuleaveidarr  = $obj2->getStaffonLeaveToday();
	
	  if (isset($_REQUEST['StaffApproval'])) {
        $resStaffApproval = $obj2->StaffApproval();
		echo $resStaffApproval;
		

        if ($resStaffApproval == 1) {
            $formErr = 'Approved successfully';
        } else if ($resStaffApproval == 0) {
            $formErr = 'Problem in network.Please try again.';

        } 
		
    }
	
	
} else {
    echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
}
?>
<!-- Navigation -->
<?php include '../includes/header-configuration.php'; ?>
<!--sidebar nav st-->
<?php include '../includes/sidebar-principal.php'; ?>
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
                    <div class="pull-left">
                        <div class="input-group date" data-provide="datepicker">
                            <input type="hidden" name="session" id="db" value="<?php echo $dbname; ?>"/>
                            <input type="text" class="form-control datestaff" id="date">

                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="pull-right">
                        <div class="input-group">
                            <input type="search" class="form-control" id="search" placeholder="Search By Name">

                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-search"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive new_tbl_height_one">
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
                                    src="../../<?php echo $_SESSION['USER']['DB_NAME']; ?>/uploads/staff/<?php echo $vluetr['usr_pic']; ?>"></a>
                        <td><?php echo $vluetr['usr_role'];?></td>
                        <td><?php if ($vluetr['att_in_time'] != '') {
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
						<?php
						if($vluetr['att_ref_id'] !='')
						{
						?>
                            <a href="#" class="editattend" data-user="<?php echo $vluetr['att_ref_id']; ?>"
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
    </div>
    <!--progress en-->

</div>


<!--col-en-->
<div class="col-md-4 col-sm-4 col-xs-12">
    <!--latest circular st-->

    <div class="col-sm-12 prin-1 panel-embose-b my-box">
        <div class="col-md-3">
            <img src="../images/staff.png" alt="user" class="img-size img-circle">
        </div>
        <div class="col-sm-9">
            <div class="mail-contnet">
                <h5 class="text-center">Staff</h5>
                <h5 class="head-web"><?php echo $num_of_staffs;?></h5>
            </div>
            <div class="col-md-6 for_new">
                <button type="button"
                        class="panel-embose-d btn btn-success btn-sm"> <?php echo $pnum_of_staffs;?></button>
            </div>
            <div class="col-md-6 for_new">
                <button type="button"
                        class="panel-embose-d btn btn-danger btn-sm"> <?php echo $anum_of_staffs;?></button>
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
                <tbody>
                <?php
                foreach ($stuleaveidarr as $rowvlue) {
                    ?>
                    <tr>
                        <td><?php echo $rowvlue['USERFANME'];?></td>
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
					
                    foreach ($rowatt as $vluestaff) {
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
				<?php
								foreach($sessionarr as $value)
								{
								?>
								<option value="<?php echo $value; ?>" <?php if(CURRENT_SESSION==$value) echo 'selected'; ?>><?php echo $value;?></option>
								<?php
								}
								?>
                   
                </select>
            </div>
        </div>
        <div id="chartdiv"></div>
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


    </div>


</div>
<div class="table-box col-sm-12 bottom-22 my-box">


    <div class="table-responsive">
        <h5 class="text-center"><b>Staff Leave Summary</b></h5>

        <table class="table">
            <thead>
            <tr>
                <th>S No.</th>
                <th>Name</th>
                <th>Profile</th>
                <th>Designation</th>
                <th>From</th>
                <th>To</th>
                <th>View</th>
                <!--<th>Action</th>-->
            </tr>
            </thead>
            <tbody>
			 <?php
			 $i=1;
			 foreach($stuleaveidarr as $stuvlue) {
			    if($stuvlue['PIC']=='')
				{
					$stuvlue['PIC']='images.png';
				}
				?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $stuvlue['USERFANME'];?>  <?php echo $stuvlue['USERLNAME'];?></td>
                <td class="c_teach_tabel">
                    <a href="staff-profile.php?teach_id=<?php echo $stuvlue['usr_id']; ?>"><img src="../../<?php echo  $_SESSION['USER']['DB_NAME'];?>/uploads/staff/<?php echo $stuvlue['PIC'];?>">
                    </a>
		
                </td>
                <td><?php echo $stuvlue['usr_role'];?></td>
                <td><?php echo date('d-m-Y', strtotime($stuvlue['mindate'])); ?></td>
                <td><?php echo date('d-m-Y', strtotime($stuvlue['maxdate'])); ?></td>
                <td>
                    <a href="#id" data-toggle="modal" class="staffLeave"
                                                   data-reason="<?php echo $stuvlue['leave_reason']; ?>"
                                                   data-from="<?php echo date('d-m-Y', strtotime($stuvlue['mindate'])); ?>"
                                                   data-to="<?php echo date('d-m-Y', strtotime($stuvlue['maxdate'])); ?>"
                                                    >
                                                    <i class="view_btn fa fa-eye" aria-hidden="true"></i>
												</a>
                </td>
                <!--<td>
                    <button type="button" class="btn btn-danger btn-sm">cancel</button>
                </td>-->

            </tr>
			 <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="table-box col-sm-12 my-box">


    <div class="table-responsive">
        <h5 class="text-center"><b>New Staff Login Approval</b></h5>

        <table class="table">
            <thead>
            <tr>
                <th>S No.</th>
                <th>Name</th>
                <th class="text-center">Profile</th>
                <th class="text-center">Designation</th>
                <!--<th class="text-center">Date of Joining</th>-->
                <th class="text-center">class</th>
                <th class="text-center">Section</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
			<?php
                $i = 1;
                foreach ($rowatt as $vluetr) {
                    if ($vluetr['usr_pic'] == '') {
                        $vluetr['usr_pic'] = 'images.png';
                    }
					 $array = $obj2->findclassandsection($vluetr['usr_id']);
					 
                    ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $vluetr['usr_fname'];?></td>
                <td class="c_teach_tabel text-center">
                    <a href="staff-profile.php?teach_id=<?php echo $vluetr['usr_id']; ?>"><img
                                    src="../../<?php echo $_SESSION['USER']['DB_NAME']; ?>/uploads/staff/<?php echo $vluetr['usr_pic']; ?>">
                    </a>
                    </a>
                </td>
                <td class="text-center"><?php echo $vluetr['usr_role'];?></td>
                <!--<td class="text-center">01-12-2012</td>-->
                <td class="text-center"><?php echo $array['class_id'];?></td>
                <td class="text-center"><?php echo $array['section_id'];?></td>

                <td class="text-center">
                    <a href="#">
					<?php if($vluetr['usr_status']==1)
					{
					?>
                        <button type="button" class="btn btn-success btn-sm disabled">Approved</button>
					<?php
					}
					else
					{
					?>
					<form>
					<input type="hidden" name="id" value="<?php echo $vluetr['usr_id'];?>">
					 <button type="submit" class="btn btn-success btn-sm" name="StaffApproval">Approve</button>
					</form>
					<?php
					}
					?>
                    </a>
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
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="form-control salarydata" id="salyear" name="salyear">
                   <?php
								foreach($sessionarr as $value)
								{
								?>
								<option value="<?php echo $value; ?>" <?php if(CURRENT_SESSION==$value) echo 'selected'; ?>><?php echo $value;?></option>
								<?php
								}
								?>

                </select>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="pull-left">
                    <select class="form-control salarydata" id="salmonth" name="salmonth">
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
                <div class="pull-right">
                    <div class="input-group">
                        <input class="form-control salarydata" type="search" name="elementsearch" id="salarydata" placeholder="Search By Name"><!--id="salarydata"-->
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-search"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row col-sm-7 mar-top">
                <!--<h5><b>Total Salary: <i class="fa fa-inr" aria-hidden="true" id="total_salary"></i> 600000</b></h5>-->
            </div>
            <div class="row col-sm-3 pull-right mar-top">
                <div class="input-group">

                    <input type="button" class="all-btm form-control btnGetAll" aria-label="Approve" value="Approve">
                                                                                        <span class="input-group-addon">
                                                                                         <input type="checkbox"
                                                                                                aria-label="Approve"
                                                                                                class="chkSelectAll">
                                                                                    </span>
                </div>
            </div>


        </div>

        <div class="table-responsive new_tbl_height_two2">
            <table class="table table-bordered">
                <thead>
                <tr class="table-bg1">
                    <th>S No.</th>
                    <th>Name</th>
                    <th>Profile</th>
                    <th>Emp Id</th>
                    <th>Designation</th>
                    <th>Salary</th>
                    <th>Status</th>
                    <th></th>

                </tr>
                </thead>
                <tbody class="c_teach_tabel" id="c_teach_staffsal">
                <?php
				$i=1;
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
                        <td><?php echo $rvlue['salary_status'];?></td>
                        <td class="text-center">
                            <input type="checkbox" class="chkNumber" value="<?php echo $rvlue['sal_info_id']; ?>">
                        </td>


                    </tr>
                <?php
				$i++;
                }
                ?>


                </tbody>
            </table>

        </div>

        <div class="col-sm-6 margin-to">
            <p class="pull-right"><span class="green_o">&#9632;</span> P&#8594; Pending</p>
        </div>

        <div class="col-sm-6 margin-to">
            <p class="pull-left"><span class="red_o">&#9632;</span> A&#8594; Approved</p>
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
        <div id="stackedbar" style="width:100%; height:180px;"></div>
    </div>

</div>

<div class="col-md-4 col-sm-4 col-xs-12">
    <!--latest circular st-->


    <div class="my-box clearfix">

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <select class="form-control staff_sal" id="staffname">
                    <?php
					
                    foreach ($rowatt as $vluestaff) {
                        ?>
                        <option
                            value="<?php echo $vluestaff['emp_id']; ?>" <?php if ($vluestaff['att_ref_id'] == DEFAULT_STAFF) echo 'selected';?>><?php echo $vluestaff['usr_fname'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <select class="form-control staff_sal" id="staffyear">
                    <?php
								foreach($sessionarr as $value)
								{
								?>
								<option value="<?php echo $value; ?>" <?php if(CURRENT_SESSION==$value) echo 'selected'; ?>><?php echo $value;?></option>
								<?php
								}
								?>

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
                foreach ($salmonthlydata as $salv) {
                    ?>

                    <tr>
                        <td><?php echo $salv['salary_month'];?></td>
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
<!-- Modal -->

<!-- Modal -->
<!-- /.container-fluid -->
<?php include'../includes/footer.php'; ?>
</div>
<!-- /#wrapper -->
<?php include '../includes/foot.php'; ?>
<!--Style Switcher -->
<script type="text/javascript">
$("#targetresult").click(function (e) {
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

$(".salarydata").click(function (e) {
    var action = 'searchsalarydataprinc';
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
    var salyear = '<?php echo CURRENT_SESSION; ?>';
    var session_start_date  = '<?php echo SESSION_START_DATE; ?>';
    var txtElement = $("#seldata").val();
    var salyear = $("#selyear").val();
    var dataString = 'element=' + txtElement + '&session=' + session + '&salyear=' + salyear + '&session_start_date=' + session_start_date + '&action=' + action;
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
//######################################CHECKBOX########################################################

$(function () {
    $('.btnGetAll').click(function () {
        if ($('.chkNumber:checked').length) {
            var chkId = '';
            $('.chkNumber:checked').each(function () {
                chkId += $(this).val() + ",";
            });
            chkId = chkId.slice(0, -1);
            //alert(chkId);
            var approvesalary = 'approvesalary';
            var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>';
            var dataString = 'action=' + approvesalary + '&session=' + session + '&chkId=' + chkId;
            //AJAX START
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
                            alert("Approved Salary");
                            $("#preloader").css("display", "none");
                            //$('.loginform .user').val("");
                            //$('.loginform .password').val("");
                            window.location.reload();
                        }
                    }
                }

            });

            //AJAX END
        }
        else {
            alert('Nothing Selected');
        }
    });

    $('.chkSelectAll').click(function () {
        $('.chkNumber').prop('checked', $(this).is(':checked'));
    });

    $('.chkNumber').click(function () {
        if ($('.chkNumber:checked').length == $('.chkNumber').length) {
            $('.chkSelectAll').prop('checked', true);
        }
        else {
            $('.chkSelectAll').prop('checked', false);
        }
    });

});
//######################################CHECKBOX########################################################
</script>

<script>
    $(".editattend").click(function () {
        var id = $(this).attr("data-id");
        var intime = $(this).attr("data-in");
        var outtime = $(this).attr("data-out");
        var user = $(this).attr("data-user");
        var date = $(".datestaff").val();
        if (date == '') {
            var today = new Date();
            var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();

        }
        $("#outtime").val(outtime);
        $("#user").val(user);
        $("#intime").val(intime);
        $("#att_id").val(id);
        $("#date_popup").val(date);
        $("#myModal").modal('show');
    });
</script>
<div class="modal fade my-modal" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Attendance</h4>
            </div>
            <form class="form-inline" method="post" action="">
                <div class="modal-body">
                    <input class="form-control" value="09:30" type="hidden" id="att_id" name="att_id">
                    <input class="form-control" value="" type="hidden" id="user" name="id">
                    <input class="form-control" value="<?php echo date('Y-m-d'); ?>" type="hidden" id="date_popup"
                           name="att_date">
                    <input class="form-control" value="<?php echo CURRENT_SESSION; ?>" type="hidden"
                           name="curr_session">

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

                </div>
                <div class="modal-footer">
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-default" name="EditA" value="Submit">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

</body>
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

<script type="text/javascript">
    $("#search").keyup(function (e) {
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
</script>

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
<!----------FOR CLOCK PICKER---------------->
<script>
    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });

    $('.clockpicker').clockpicker({
        donetext: 'Done',
    })
        .find('input').change(function(){
            console.log(this.value);
        });

    $('#check-minutes').click(function(e){
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show')
            .clockpicker('toggleView', 'minutes');
    });
</script>
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

</html>