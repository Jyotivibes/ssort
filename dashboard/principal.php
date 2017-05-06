<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Principal</title>
    <?php include '../includes/head.php'; ?>
    <style type="text/css">
        .custom-table tr:nth-child(1) td{background: #5bc0de}
        .custom-table tr td:first-child, .custom-table tr:nth-child(2) td:first-child{background: transparent;color: #000}
    </style>
</head>
<body>
<div id="wrapper">
<?php
$message ='';
if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Principal')) {
    $user_id = $_SESSION['USER']['USER_NAME'];
    require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
    require_once('../../classes/general_class.php');
    $obj = new General();
    $eventNotification = $obj->getEventsNotification();
    include_once 'stastics.php';
    $sqlleave = mysql_query("SELECT *,leave_date as maxdate,leave_date as mindate,'USERFNAME','USERLNAME' FROM essort_teacher_leave_info WHERE leave_status = 'Pending' GROUP BY 'leave_reason'");
    $stuleaveidarr=array();
    if($sqlleave!=0)
    {
        while($rowleavestu=mysql_fetch_array($sqlleave))
        {
            $stusql=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='".$rowleavestu['usr_id']."'"));
            $rowleavestu['USERFANME']=$stusql['usr_fname'];
            $rowleavestu['USERLNAME']=$stusql['usr_lname'];
            $rowleavestu['usr_role']=$stusql['usr_role'];
            $rowleavestu['usr_id']=$stusql['usr_id'];
            $stuleaveidarr[]=$rowleavestu;
        }
    }
    $markholidays = $obj->markHoliday();
    if (isset($_REQUEST['Approve'])) {
        ///echo "<script>alert('hi');</script>";

        $res = $obj->APPROVELEAVE();
        print_r($res);
		$message='';
		 if ($res == 3) {
            $message = 'Required parameter missing';
            $reurl = 'principal.php';
            //echo "<script>alert('Required parameter missing');</script>";
            //echo "<script>window.location.href='create-group.php';</script>";
        } else if ($res == 0) {
            $message = 'Problem in network.Please try again';
            $reurl = 'principal.php';
            //echo "<script>alert('Problem in network.Please try again.');</script>";
        } else if ($res == 1) {
            $message = 'Leave Approved!';
            $reurl = 'principal.php';
        } else if ($res == 4) {
            $message = 'Already Registered with this Email Id';
            $reurl = 'principal.php';
        }
    }
    ######################################FOR EVENT APPROVAL START##################################################
    if (isset($_REQUEST['event_aprove'])) {
        $resleave = $obj->APPROVEHOLIDAY();
		$message='';
        if ($resleave == 0) {
            $message = 'Problem in network.Please try again';
			$reurl = 'principal.php';
        } else if ($resleave == 1) {
            $message = 'Event Approved successfully.';
			$reurl = 'principal.php';
        }
	 
    }
    ######################################FOR EVENT APPROVAL END##################################################
    if (isset($_REQUEST['SendM'])) {
        $addmessage = $obj->ADDMESSAGE();
        if ($addmessage == 1) {
            echo "<script>alert('Message send')</script>";
        }

    }
} else {
    echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
}
?>
<!-- Navigation -->
<?php include '../includes/header-configuration.php'; ?>
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
 <?php include '../includes/header-notice.php'; ?>

<div class="row hidden-sm hidden-xs">

    <div class="col-md-2 col-sm-2 col-xs-12">
        <a href="../principal/inbox.php">
            <div class="white-box text-center co-messages">
                <h1 class="text-white counter">
                    <img src="../images/icons/message.ico" class="icon-size"/>
                </h1>

                <p class="text-muted">Messages</p>
            </div>
        </a>
    </div>

    <div class="col-md-2 col-sm-2 col-xs-12">
        <a href="../principal/principal-attendance.php">
            <div class="white-box text-center co-attendance">
                <h1 class="text-white counter">
                    <img src="../images/icons/attendance.png" class="icon-size"/>
                </h1>

                <p class="text-muted">Attendance</p>
            </div>
        </a>
    </div>


    <div class="col-md-2 col-sm-2 col-xs-12">
        <a href="../principal/eventsholidays.php">
            <div class="white-box text-center co-events">
                <h1 class="counter">
                    <img src="../images/icons/event.ico" class="icon-size"/>
                </h1>

                <p class="text-muted">Events & Holidays</p>
            </div>
        </a>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-12">
        <a href="../principal/noticecircular.php">
            <div class="white-box text-center co-notifications">
                <h1 class="text-white counter">
                    <img src="../images/icons/notification.png" class="icon-size"/>
                </h1>

                <p class="text-muted">Notice & Circulars</p>
            </div>
        </a>
    </div>


    <div class="col-md-2 col-sm-2 col-xs-12">
        <a href="javascript:void(0);">
            <div class="white-box text-center co-assessment ">
                <h1 class="counter">
                    <img src="../images/icons/assessment.png" class="icon-size"/>

                </h1>

                <p class="text-muted">Assessment</p>
            </div>
        </a>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-12">
        <a href="../principal/administration.php">
            <div class="white-box text-center co-administration">
                <h1 class="text-white counter">
                    <img src="../images/icons/admin.png" class="icon-size"/>

                </h1>

                <p class="text-muted">Administration</p>
            </div>
        </a>
    </div>
</div>


<!--stu info st-->
<div class="row">

    <div class="col-sm-6 col-xs-12">
        <div class="my-box-23">
            <div class="profile-panel">

                <div class="row make-gap">
                    <div class="overlay-box">
                        <div class="user-content text-center">
                            <a href="javascript:void(0)">
                                <?php
                                if ($rowprinc['usr_pic'] == '') {
                                    $rowprinc['usr_pic'] = 'images.png';
                                }
                                ?>
                                <img src="../../<?php echo $_SESSION['USER']['DB_NAME'];?>/uploads/staff/<?php echo $rowprinc['usr_pic']; ?>"
                                     class="thumb-chairman-lg img-circle" alt="img"></a>
                            <h4 class="text-white"><?php echo $_SESSION['USER']['USER_NAME'] . " ";?><?php echo $_SESSION['USER']['USER_LNAME'];?></h4>
                            <h5 class="text-white"><?php echo $_SESSION['USER']['ROLE_ID'];?></h5>
                            <a href="#" rel="tooltip" data-original-title="Message to contact">
                                <img src="../images/icons/chat.png" class="icon-two-size"></a>
                            <a rel="tooltip" class="emailtocontact" data-target="#myMail"
                               data-original-title="Email to contact">
                                <img src="../images/icons/mail.ico" class="icon-two-size">
                            </a>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--en col-->
    <div class="col-sm-6 col-xs-12">
        <div class="col-sm-12 col-xs-12 my-boxnew shadow-a">
            <div class="col-md-6">
                <div class="col-md-12 prin panel-embose-b">
                    <div class="col-md-3">
                        <img src="../images/eduaction.png" alt="user" class="img-size img-circle image-responsive">
                    </div>
                    <div class="col-sm-9">
                        <div class="mail-contnet">
                            <h5 class="text-center">Students</h5>
                            <h5 class="head-web"><?php echo $num_of_students;?></h5>
                        </div>
                        <div class="col-sm-6 for_new">
                            <button type="button"
                                    class="panel-embose-d btn btn-success btn-sm"><?php echo $pnum_of_students; ?></button>
                        </div>
                        <div class="col-sm-6 for_new">
                            <button type="button"
                                    class="panel-embose-d btn btn-danger btn-sm"><?php echo $anum_of_students; ?></button>
                        </div>
                    </div>
                </div>
                <div id="chartdivone" style="width: 100%; height: 180px;"></div>
                <script>
                    $(function () {
                        var chart = AmCharts.makeChart("chartdivone", {
                            "labelRadius": -40,
                            "labelText": "[[status]]: [[percents]]%",
                            "type": "pie",
                            "theme": "light",
                            "dataProvider": [
                                {
                                    "status": "Present",
                                    "value": (<?php echo $pnum_of_students; ?>+0)
                                },
                                {
                                    "status": "Absent",
                                    "value": (<?php echo $anum_of_students; ?>+0)
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

            </div>
            <div class="col-sm-6">
                <div class="col-sm-12 prin-1 panel-embose-b">
                    <div class="col-md-3">
                        <img src="../images/staff.png" alt="user" class="img-size img-circle">
                    </div>
                    <div class="col-sm-9">
                        <div class="mail-contnet">
                            <h5 class="text-center">Staff</h5>
                            <h5 class="head-web"><?php echo $num_of_staffs; ?></h5>
                        </div>
                        <div class="col-md-6 for_new">
                            <button type="button"
                                    class="panel-embose-d btn btn-success btn-sm"> <?php echo $pnum_of_staffs; ?></button>
                        </div>
                        <div class="col-md-6 for_new">
                            <button type="button"
                                    class="panel-embose-d btn btn-danger btn-sm"> <?php echo $anum_of_staffs; ?></button>
                        </div>
                    </div>
                </div>
                <div id="chartdivtwo" style="width: 100%; height: 180px;"></div>
                <script>
                    $(function () {
                        var chart = AmCharts.makeChart("chartdivtwo", {
                            "labelRadius": -40,
                            "labelText": "[[status]]: [[percents]]%",
                            "type": "pie",
                            "theme": "light",
                            "dataProvider": [
                                {
                                    "status": "Present",
                                    "value": (<?php echo $pnum_of_staffs; ?>+0)
                                },
                                {
                                    "status": "Absent",
                                    "value": (<?php echo $anum_of_staffs; ?>+0)
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

            </div>
        </div>
    </div>
</div>
<!--stu info st-->

<div class="row">
    <div class="col-sm-9 col-xs-12 my-box-11 fee-head shadow-a">
        <div class="col-sm-12">
            <div class="col-sm-3">
                <h5>Fee Summary</h5>
            </div>
            <div class="col-sm-6  dropdown">
                <div class="col-sm-2">
                    <h5> Select</h5>
                </div>
                <div class="col-sm-10">
                    <select class="selectpicker_one" id="seldata">
                        <option value="first">First Quarter (Apr-Jun)</option>
                        <option value="second">Second Quarter (Jul-Sept)</option>
                        <option value="third">Third Quarter (Oct-Dec)</option>
                        <option value="fourth">Fourth Quarter (Jan-Mar)</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <h5>Session <?php echo DEFAULT_SESSION;?></h5>
            </div>
        </div>
        <div class="col-sm-12 table-responsive fee-wrapper fee-size">
            <table class="table table-bordered custom-table">
                <thead>
                <tr>
                </tr>
                <tr>
                    <td rowspan="2" colspan="1"></td>
                    <td colspan="13" class="sectiopart">Section</td>
                </tr>
                <tr class="table-new">
                    <td colspan="3">A</td>
                    <td colspan="3">B</td>
                    <td colspan="3">C</td>
                    <td colspan="3">D</td>
                </tr>
                <tr>
                    <td colspan="1">Class</td>
                    <td class="table-present">Recieved</td>
                    <td class="table-absent">Pending</td>
                    <td class="table-total">Total</td>
                    <td class="table-present">Recieved</td>
                    <td class="table-absent">Pending</td>
                    <td class="table-total">Total</td>
                    <td class="table-present">Recieved</td>
                    <td class="table-absent">Pending</td>
                    <td class="table-total">Total</td>
                    <td class="table-present">Recieved</td>
                    <td class="table-absent">Pending</td>
                    <td class="table-total">Total</td>
                </tr>
</thead>
 <tbody id="TableAtt">
                <!--                                 <tr>
                <td rowspan="15">Class</td>

            </tr> -->
                <?php
                foreach ($classesfee as $key => $classvlue) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $key;?>
                        </td>
                        <td><?php if (array_key_exists("A",$classvlue)) {echo $classvlue['A']['recieved_fee'];}  else { echo '-';} 
						?></td>
                        <td><?php if (array_key_exists("A",$classvlue)) {echo $classvlue['A']['pending_fee'];} else { echo '-'; }?></td>
                        <td><?php if (array_key_exists("A",$classvlue)) {echo $classvlue['A']['total_stu'];} else {echo '-';}?></td>
                        <td><?php if (array_key_exists("B",$classvlue)) {echo $classvlue['B']['recieved_fee'];} else {echo '-';}?></td>
                        <td><?php if (array_key_exists("B",$classvlue)) {echo $classvlue['B']['pending_fee'];} else {echo '-';}?></td>
                        <td><?php if (array_key_exists("B",$classvlue)) {echo $classvlue['B']['total_stu'];} else { echo '-';}?></td>
                        <td><?php if (array_key_exists("C",$classvlue)) {echo $classvlue['C']['recieved_fee'];} else { echo '-';}?></td>
                        <td><?php if (array_key_exists("C",$classvlue)) {echo $classvlue['C']['pending_fee']; } else { echo '-'; }?></td>
                        <td><?php if (array_key_exists("C",$classvlue))  {echo $classvlue['C']['total_stu']; } else {echo '-'; }?></td>
                        <td><?php if (array_key_exists("D",$classvlue)) { echo $classvlue['D']['recieved_fee'];} else {echo '-';}?></td>
                        <td><?php if (array_key_exists("D",$classvlue)) { echo $classvlue['D']['pending_fee'];} else { echo '-'; }?></td>
                        <td><?php if (array_key_exists("D",$classvlue)) { echo $classvlue['D']['total_stu'];} else { echo '-'; }?></td>
                    </tr>
                <?php
                }
                ?>

                </tbody>
            </table>

        </div>
    </div>
    <div class="col-sm-3 col-xs-12 shadow-a">

        <div class="my-box-11">
            <h3 class="text-center">Session <?php echo DEFAULT_SESSION;?></h3>
            <!--pie chart st-->
            <div id="chartdiv">
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
                                    "value": (<?php echo $pnum_of_students; ?>+0)
                                },
                                {
                                    "status": "Absent",
                                    "value": (<?php echo $anum_of_students; ?>+0)
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
                </script></div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12 col-xs-12 my-box">
        <h5><b>Staff Leave Approval</b></h5>

        <div class="table-responsive twenty_three">

            <table class="table table-responsive panel-embose-c">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                    <th>View</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($stuleaveidarr as $stuvlue) {
                    ?>
                    <tr>
                        <td>Ms. <?php echo $stuvlue['USERFANME'];?>  <?php echo $stuvlue['USERLNAME'];?></td>
                        <td><?php echo $stuvlue['usr_role'];?></td>
                        <td><?php echo  $stuvlue['mindate'];?></td>
                        <td><?php echo  $stuvlue['maxdate'];?></td>
                        <td><?php echo $stuvlue['leave_status'];?></td>
                        <td><a href="#id" data-toggle="modal" class="staffLeave"
                                                   data-reason="<?php echo $stuvlue['leave_reason']; ?>"
                                                   data-from="<?php echo date('d-m-Y', strtotime($stuvlue['mindate'])); ?>"
                                                   data-to="<?php echo date('d-m-Y', strtotime($stuvlue['maxdate'])); ?>"
                                                    >
                                                    <i class="view_btn fa fa-eye" aria-hidden="true"></i>
												</a>

                        </td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" value="<?php echo $stuvlue['mindate']; ?>" name="from_date">
                                <input type="hidden" value="<?php echo $stuvlue['maxdate']; ?>" name="to_date">
                                <input type="hidden" value="<?php echo $stuvlue['submit_date']; ?>" name="submit_date">
                                <input type="hidden" value="<?php echo $stuvlue['usr_id']; ?>" name="usr_id">
                                <input type="submit" class="btn-info view-btn" value="Approve" name="Approve">
                            </form>
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
<div class="row">
    <div class="col-xs-12 my-box">
        <h5><b>Staff on Leave Today</b></h5>

        <div class="table-responsive twenty_three">
            <table class="table table-responsive panel-embose-c">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>From</th>
                    <th>To</th>
                    <th>View</th>
                    <th>Status</th>


                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($stuleaveidarrtoday as $stuvlue) {
                    ?>
                    <tr>
                        <td>Mrs. <?php echo $stuvlue['USERFANME'];?> <?php echo $stuvlue['USERFANME'];?></td>
                        <td><?php echo $stuvlue['usr_role'];?></td>
                        <td><?php echo $stuvlue['mindate'];?></td>
                        <td><?php echo $stuvlue['maxdate'];?></td>
                        <td>
                           <a href="#id" data-toggle="modal" class="staffLeave"
                                                   data-reason="<?php echo $stuvlue['leave_reason']; ?>"
                                                   data-from="<?php echo date('d-m-Y', strtotime($stuvlue['mindate'])); ?>"
                                                   data-to="<?php echo date('d-m-Y', strtotime($stuvlue['maxdate'])); ?>"
                                                    >
                                                    <i class="view_btn fa fa-eye" aria-hidden="true"></i>
												</a>
                        </td>
                        <td>Leave</td>


                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 my-box">
        <h5><b>Event Approval</b></h5>

        <div class="table-responsive twenty_three">

            <table class="table table-responsive panel-embose-c">
                <thead>
                <tr>
                    <th>By</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Event Name</th>
                    <th>View</th>
                    <th>Status</th>
                    <!-- <th>Action</th>-->
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($holarrays as $cirvalue) {
                    ?>
                    <tr>
                        <td><?php echo $cirvalue['usr_role'];?></td>
                        <td><?php echo $cirvalue['minoff'];?></td>
                        <td><?php echo $cirvalue['maxoff'];?></td>
                        <td><?php echo $cirvalue['occassion'];?></td>
                        <td>
                            <a data-toggle="modal" class="getholidays" data-href=""
                               data-oc="<?php echo $cirvalue['occassion']; ?>"
                               data-info="<?php echo $cirvalue['additional_info']; ?>"
                               data-to="<?php echo date('d-m-Y', strtotime($cirvalue['maxoff'])); ?>"
                               data-from="<?php echo date('d-m-Y', strtotime($cirvalue['minoff'])); ?>">
                                <i class="view_btn fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" value="<?php echo $cirvalue['id']; ?>" name="event_id">
                                <input type="hidden"
                                       value="<?php echo date('Y-m-d', strtotime($cirvalue['minoff'])); ?>"
                                       name="date_from">
                                <input type="hidden"
                                       value="<?php echo date('Y-m-d', strtotime($cirvalue['maxoff'])); ?>"
                                       name="date_to">
                                <input type="hidden" value="<?php echo $cirvalue['occassion']; ?>" name="occassion">
                                <input type="submit" class="btn-info view-btn" value="Approve" id="event_aprove" name="event_aprove">
                            </form>
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
<div class="row">

    <div class="col-xs-12 my-box">
        <h5><b>Assessment</b></h5>

        <p>Coming soon!</p>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-xs-12 my-boxes">


        <div id="calendar-fancy">
            <script>
                /*Mark Calendar*/
                var markHolidays = [
                    <?php
                    $i = 0;
                    $size = count($markholidays);
                    while($row = mysql_fetch_array($markholidays)){
                    echo ($size==++$i)?'':', ';
                     ?>
                    {
                        month: (<?php echo date('m',strtotime($row['off_day'])); ?>-1),
                        year: (<?php echo date('Y',strtotime($row['off_day'])); ?>+0),
                        holidays: [

                            {
                                holiday: "<?php echo $row['occassion']; ?>",
                                day: (<?php echo date('d',strtotime($row['off_day'])); ?>+0)
                            }
                        ]
                    }
                    <?php
                    }
                     ?>
                ];
            </script>
        </div>

        <section class="panel section-panel">
            <header class="panel-heading heading-event">
                <h3 class="box-title">Upcoming Events & Holidays - <span class="today" id="todaydate"></span></h3>
            </header>
            <div class="panel-body panel-scroll" id="eventoccassion">
                <?php
                $i = 1;
                if($eventNotification != 0){
                    while ($row = mysql_fetch_array($eventNotification)) {
                        if ($i % 2 == 0) {
                            $tag = 'success';
                        } else {
                            $tag = 'info';
                        }
                        ?>
                        <div class="alert alert-<?php echo $tag; ?> margin-btm-5 clearfix alert-height">
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender">
                                    <span><a href="" data-toggle="modal" data-target=""
                                             class="getholidays"
                                             data-oc="<?php echo $row['occassion']; ?>"
                                             data-to="<?php echo date('d-m-Y', strtotime($row['maxoff'])); ?>"
                                             data-from="<?php echo date('d-m-Y', strtotime($row['minoff'])); ?>"
                                             data-info="<?php echo $row['additional_info']; ?>">
                                            <?php echo $row['occassion']; ?>&nbsp
                                            <?php
                                            $from_date = date('d-m-Y', strtotime($row['maxoff']));
                                            $to_date = date('d-m-Y', strtotime($row['minoff']));
                                            if($from_date != $to_date ){
                                                echo " - From ".$to_date." TO ".$from_date;
                                            }
                                            else{
                                                echo " - ".$from_date;
                                            }
                                            ?>
                                        </a>
                                    </span>
                                        <span class="pull-right">
                                            <?php echo $row['occassion_type'];?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php
                        $i++;
                    }
                }
                ?>
            </div>
        </section>
    </div>
    <div class="col-sm-6 col-xs-12">

        <!--latest circular st-->
        <div class="col-sm-12 col-xs-12 my-box-last shadow-a">
            <h3 class="box-title latest-cir">Latest Circular</h3>

            <div class="feeds-principal-panel">
                <ul class="feeds">
                    <?php
                    foreach ($cirarray as $cirvlue) {
                        ?>
                        <li data-toggle="modal" class="getCircular content-circular"
                            data-href="<?php echo $cirvlue['attachment']; ?>"
                            data-subject="<?php echo $cirvlue['subject']; ?>"
                            data-id="<?php echo $cirvlue['message']; ?>"
                            data-date="<?php echo date('d-m-Y', strtotime($cirvlue['date'])); ?>">
                            <div class="bg-info icon-thumb"><i class="fa fa-calendar"></i></div>
                            <p><?php
                                if (strlen($cirvlue['subject']) > 20) {
                                    echo substr($cirvlue['subject'], 0, 20) . " . . .";
                                } else {
                                    echo $cirvlue['subject'];
                                }

                                ?><span
                                    class="text-muted"> <?php echo date('d-m-Y', strtotime($cirvlue['date'])); ?></span>
                            </p>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>

        </div>
        <!--latest circular en-->

    </div>
</div>
</div>
<!--col-en-->
</div>
<!--col-en-->
</div>
<!--stu info en-->
<!-- .right-sidebar st here-->
</div>
<!-- /.container-fluid -->
<?php include'../includes/footer.php'; ?>

<!-- /#page-wrapper -->

<!-- /#wrapper -->



<?php include '../includes/foot.php'; ?>

<!-- Modal -->
<div class="modal fade" id="successModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Attendance</h4>
            </div>
            <div class="modal-body">
                In Time
                <input type="text" class="time start" placeholder="HH:MM:SS"/> Out Time
                <input type="text" class="time end" placeholder="HH:MM:SS"/>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
            </div>
        </div>

    </div>
</div>
<!-- Modal -->

<!--------------------------------FOR UPCOMING EVENTS HOLIDAYS---------------------------------------->
<script>
    $(".getholidays").click(function () {
        var oc = $(this).attr("data-oc");
        var to = $(this).attr("data-to");
        var from = $(this).attr("data-from");
        var info = $(this).attr("data-info");
        $("#oc").html(oc);
        if (from == to) {
            $("#from_day").html(from);
        }
        else {
            $("#from_day").text(' From : ' + from);
            $("#to_day").text(' To : ' + to);
        }
        $("#info").html(info);
        $("#HolidayModal").modal('show');
    });
</script>
<!--mail modal st-->
<div class="modal fade" id="HolidayModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="oc"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <span id="from_day"></span>
                    <span id="to_day"></span>

                    <p id="info"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script>
    $(".getCircular").click(function () {
        var dra = $(this).attr("data-id");
        var subject = $(this).attr("data-subject");
        var href = $(this).attr("data-href");
        var date = $(this).attr("data-date");
        $("#target").css("display", "block");
        if (href == '') {
            $("#target").css("display", "none");
        }

        $("#success_message").html(dra);
        $("#subject_message").html(subject);
        $("#date").html(date);
        $("#target").attr("href", "<?php echo HTTP_SERVER;?>dashboard/school-admin/uploads/" + href + "");
        $("#getCircular").modal('show');


    });
</script>
<script>
    $(".emailtocontact").click(function () {
        $("#myMail").modal('show');

    });
</script>

<!-- /#page-wrapper -->
<div class="modal fade" id="getCircular" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="subject_message"></h4>

            </div>

            <div class="modal-body">
                <p id="date"></p>

                <p id="success_message" class="text-justify"></p>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 pull-right text-center">
                        <a href="#" class="btn btn-link marg-right" id="target" target="_blank"><span
                                class="fa fa-paperclip"></span> Download Attachment</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!--mail modal st-->
<div class="modal fade" id="myMail" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Email to contact</h4>
            </div>
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">

                        <input type="hidden" class="form-control" placeholder="Email to contact" name="from_id"
                               value="<?php echo $_SESSION['USER']['USER_ID']; ?>">
                        <input type="hidden" class="form-control" placeholder="Email to contact" name="from_role"
                               value="<?php echo $_SESSION['USER']['ROLE_ID']; ?>">
                        <input type="hidden" class="form-control" placeholder="Email to contact" name="to_role"
                               value="SAD">

                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Subject:</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Subject" name="subject">
                        </div>
                    </div>
                    <div class="form-group marg-bott">
                        <label for="textarea" class="col-sm-2 control-label">Message:</label>

                        <div class="col-sm-10">
                            <textarea rows="5" class="message" name="message"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2 col-xs-12"></div>
                            <div class="col-sm-10">
                                <label class="btn btn-link pull-right marg-right">
                                    <span class="fa fa-paperclip"></span>
                                    Attachment <input type="file" class="hidden" name="attach">
                                </label>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 pull-right text-center">
                            <input type="submit" class="btn btn-default btn-color border-round" name="SendM"
                                   value="Send">
                            <!--<i class="fa fa-paper-plane"></i> Send</button>-->
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<script>
    $("#seldata").change(function (e) {
//alert('cxcxcx');
        var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>';
        var action = 'searchattdatabysession';
        var txtElement = $("#seldata").val();
        var dataString = 'element=' + txtElement + '&session=' + session + '&action=' + action;
       // alert(dataString);
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
                        $("#TableAtt").html(data);
                        //$('.loginform .user').val("");
                        //$('.loginform .password').val("");
                        //window.location.reload();
                    }
                }
            }


        });

    });
</script>
<!-- FOR OPEN ON SUCCESS EVENT APPROVAL Modal -->
<div class="modal fade" id="EventApproveModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="eventholiday"></h4>
            </div>
            <div class="modal-body">
                <p id="message"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- FOR OPEN ON SUCCESS EVENT APPROVAL Modal -->
<?php
echo "PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP".$message;
#Show form  message
if($message!="" )
{
    ?>
    <script>
        $('#eventholiday').text('Event Approval');
        $('#message').html("<?php echo $message; ?>");
        $('#EventApproveModal').modal('show');
		var url = "<?php echo $reurl;?>";    
		window.location.href = url;  
    </script>
<?php
}
?>

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
<!---------------mODAL FOR STAFF ON LEAVE TODAY----------------------->
<div class="modal fade" id="staffLeave" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Staff on Leave Today</h4>

            </div>

            <div class="modal-body" >
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
</body>

</html>