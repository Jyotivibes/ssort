<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Dashboard</title>
    <?php include '../includes/head.php'; ?>

</head>
<body>
<div id="wrapper">
<?php
if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Teacher')) {
    $user_id = $_SESSION['USER']['USER_NAME'];
    require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
    require_once('../../classes/general_class.php');
    require_once('../../classes/staff_class.php');
    require_once('../../classes/student_class.php');
    $obj = new General();
    $obj2 = new Staff();
    $obj3 = new Student();
    $formErr = '';
    //include_once 'stastics.php';
    $eventNotification = $obj->getEventsNotification();
	####TEACHER DETAILS#########
    $sqlteachheader  = $obj2->getteacherdetail($_SESSION['USER']['USER_ID']);
	#####PRINCIPAL DETAILS###############
    $resprincipal   = $obj2->getprincipaldetail();
	#####FIND TEACHER (My) CLASS SECTION #################
    $taecherdata  = $obj2->gettaecherclasssection($_SESSION['USER']['USER_ID']);
    $stuidarr   = $obj3->getallstulist($taecherdata['class_id'],$taecherdata['section_id']);
	#####FIND TEACHER (My) SUBJECTS #################
	$smysubject = $obj->MySubject($_SESSION['USER']['USER_ID']);
	$no_of_students = $obj3->getnoofstudents($taecherdata['class_id'],$taecherdata['section_id']);
	$present_no_of_students = $obj3->getpresentnoofstudents($taecherdata['class_id'],$taecherdata['section_id']);
	$stuleaveidarr = $obj3->getstudentonleave();
	$absent_no_of_students=$no_of_students-$present_no_of_students;
	$pper=0;
	if($no_of_students!=0)
	{
		$pper=$present_no_of_students/$no_of_students*100;
		$aper=$absent_no_of_students/$no_of_students*100;
	}
		
    $markholidays = $obj->markHoliday();
    if (isset($_REQUEST['SubmitL'])) {
        $res = $obj->ADDLEAVE();
        if ($res == 3) {
            $formErr = 'Required parameter missing';
        } else if ($res == 0) {
            $formErr = 'Problem in network.Please try again.';

        } else if ($res == 1) {
            $formErr = 'Leave Request Sent successfully';
            $reurl = 'teacher.php';
        }else if ($res == 2) {
            //$formErr = 'Leave Already applied on this date';
            //$reurl = 'teacher.php';
            echo "<script>alert('Leave Already applied on this date');</script>";
        }
    }
    ################################GET STAFF ALL LEAVE##########################
    $leave = $obj->STAFFALLLEAVE();
    ###########################SENDM######################################################
    if (isset($_REQUEST['SendM'])) {
        $addmessage = $obj->ADDMESSAGE();
        if ($addmessage == 1) {
            echo "<script>alert('Message send')</script>";
        }
    }
    ##################################################
    if (isset($_REQUEST['EditA'])) {
        if($_REQUEST['present'] == "Absent"){
            $data = $obj->DELETEATT();
            if($data == 1)
            {
                $formErr = 'Attendance Removed successfully';
                $reurl = 'teacher.php';
            }
            elseif($data == 2){
                echo "<script>alert('Issue in sql query')</script>";
            }
        }
        else{
            $res = $obj->EDITATT();
            if ($res == 2) {
                $formErr = 'Required parameter missing';
            } else if ($res == 0) {
                $formErr = 'Problem in network.Please try again.';

            } else if ($res == 1) {
                $formErr = 'Edit Attendance successfully';
                $reurl = 'teacher.php';
            }
        }
    }

#########################FOR SEND SMS#####################
    if(isset($_POST['submitsms'])){
        include("../../classes/send-sms.class.php");
        $sms = new SMS();
        $sms->CLI="SSORTDBAA";
        $sms->mobile=$_POST['mobile_no'];
        $sms->message='Teacher Name:- '.$_SESSION['USER']['USER_NAME'].' '.$_SESSION['USER']['USER_LNAME']."\n".$_POST['sms'];
        $sms->accountName="vibescom";
        $sms_response = $sms->sendsms();
        //print_r($sms_response);
        echo "<script>alert('".$sms_response."')</script>";
    }

} else {
    echo "<script>window.location='" . HTTP_SERVER . "index.php';</script>";
}
?>
<?php include '../includes/header-configuration.php'; ?>

<!--sidebar nav st-->
<?php include '../includes/sidebar-teacher.php'; ?>
<!--sidebar nav en-->
<!-- Page Content -->
<div id="page-wrapper" class="bg-texture">
<div>
    <div id="clouds">
        <div class="cloud x1"></div>
        <!-- Time for multiple clouds to dance around -->
        <div class="cloud x2"></div>
        <div class="cloud x3"></div>
        <div class="cloud x4"></div>
        <div class="cloud x5"></div>
    </div>
</div>
<div class="container-fluid">
    <!-------------------FOR CIRCULAR ACTIVITIES ON HEADER AND BREADCRUMB---------------------------------->
    <?php include '../includes/header-notice.php'; ?>
</div>
<div class="row">
    <div class="col-md-2 col-sm-2 col-xs-12">
        <a href="inbox.php">
            <div class="white-box text-center co-messages">
                <h1 class="text-white counter">
                    <!--  <i class="fa fa-envelope fa-messages"></i>-->
                    <img src="../images/icons/message.ico" class="icon-size"/>
                </h1>

                <p class="text-muted">Messages</p>
            </div>
        </a>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-12">
        <a href="../teacher/teacher-att.php">
            <div class="white-box text-center co-attendance">
                <h1 class="text-white counter">
                    <img src="../images/icons/attendance.png" class="icon-size"/>
                </h1>

                <p class="text-muted">Attendance</p>
            </div>
        </a>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-12">
        <a href="eventsholidays.php">
            <div class="white-box text-center co-events">
                <h1 class="counter">
                    <img src="../images/icons/event.ico" class="icon-size"/>
                </h1>

                <p class="text-muted">Events & Holidays</p>
            </div>
        </a>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-12">
        <a href="noticecircular.php">
            <div class="white-box text-center co-notifications">
                <h1 class="text-white counter">
                    <img src="../images/icons/notification.png" class="icon-size"/>
                </h1>

                <p class="text-muted">Notifications</p>
            </div>
        </a>
    </div>

    <div class="col-md-2 col-sm-2 col-xs-12">
        <a href="javascript:void(0);">
            <div class="white-box text-center co-assessment">
                <h1 class="text-white counter">
                    <img src="../images/icons/assessment.png" class="icon-size"/>
                </h1>

                <p class="text-muted">Assessment</p>
            </div>
        </a>
    </div>

    <div class="col-md-2 col-sm-2 col-xs-12">
        <a href="../teacher/teacher-profile.php">
            <div class="white-box text-center co-fees">
                <h1 class="counter">
                    <img src="../images/icons/profile.png" class="icon-size"/>
                </h1>

                <p class="text-muted">Profile</p>
            </div>
        </a>
    </div>
</div>
<!--stu info st-->
<div class="row">
<div class="col-md-7 col-sm-7 col-xs-12">
<div class="my-box">
    <h3 class="box-title"><?php echo $sch_name ." - ".$sch_location ;?></h3>
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <div class="panel message-center panel-embose bg-parents">
                <div class="content">
                    <!--<img src="../images/<?php /*echo $sqlteachheader['usr_pic']; */?>" alt="user" class="img-circle cl-profile">-->
                    <?php
                    $filenameTeacher = "../images/" . $sqlteachheader['usr_pic'];
                    if ($sqlteachheader['usr_pic'] == "") {
                        ?>
                        <img src="../images/images.png" alt="user" class="img-circle cl-profile"/>
                    <?php
                    } elseif (file_exists($filenameTeacher)) {
                        ?>
                        <img src="../images/<?php echo $sqlteachheader['usr_pic']; ?>" alt="Teacher" alt="user"
                             class="img-circle cl-profile"/>
                    <?php
                    } else {
                        ?>
                        <img src="../images/images.png" alt="user" class="img-circle cl-profile"/>
                    <?php
                    }
                    ?>
                    <div>
                        <strong>Ms. <?php echo $sqlteachheader['usr_fname'];?> <?php echo $sqlteachheader['usr_lname'];?></strong>
                        <h6>Class Teacher</h6>
                        <h6>Class: <?php echo $taecherdata['class'];?> - <?php echo $taecherdata['section'];?></h6>
                    </div>
                </div>
            </div>
            <!--en panel-->
        </div>
        <!--en col-->

        <div class="col-sm-6 col-xs-12">
            <div class="panel message-center panel-embose bg-school box-padding">
                <div class="content">
                    <!--<img src="../images/mistress-pic.jpg" alt="user" class="img-circle principal-profile">-->
                    <?php
                    $filenamePrincipal = "../images/" . $resprincipal['usr_pic'];
                    if ($resprincipal['usr_pic'] == "") {
                        ?>
                        <img src="../images/images.png" alt="user" class="img-circle principal-profile"/>
                    <?php
                    } elseif (file_exists($filenamePrincipal)) {
                        ?>
                        <img src="../images/<?php echo $resprincipal['usr_pic']; ?>" alt="user"
                             class="img-circle principal-profile"/>
                    <?php
                    } else {
                        ?>
                        <img src="../images/images.png" alt="user" class="img-circle principal-profile"/>
                    <?php
                    }
                    ?>
                    <div>
                        <strong>Ms. <?php echo $resprincipal['usr_fname']?> <?php echo $resprincipal['usr_lname']?></strong>
                        <h6>Principal</h6>
                    </div>
                    <div class="info-panel">
                        <a href="javascript:void(0)" class="message_popup" data-toggle="modal"
                            data-mobile ="<?php echo $resprincipal['usr_mobile']; ?>">
                            <img src="../images/icons/chat.png" class="icon-two-size effect-icon"
                                          data-toggle="tooltip" data-placement="top" title="Message"></a>
                        <a href="#" data-toggle="modal" data-target="#myMail">
                            <img src="../images/icons/message.ico" class="icon-two-size effect-icon" data-toggle="tooltip"
                                 data-placement="top" title="E-mail">
                        </a>
                    </div>
                </div>
            </div>
            <!--en panel-->
        </div>
        <!--en col-->
    </div>
    <!--en row-->
    <div class="row">
        <div class="col-sm-4 col-xs-12">
            <div class="panel message-center panel-embose bg-color-box user-img total-student">
                <div class="content">
                    <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">

                    <div>
                        <span>Total <br/>Students</span>

                        <h1><?php echo $no_of_students;?></h1>
                    </div>
                </div>
            </div>
            <!--en panel-->
        </div>
        <!--en col-->
        <div class="col-sm-4 col-xs-12">
            <div class="panel message-center panel-embose bg-color-box present-student bg-green ">
                <div class="content">
                    <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">

                    <div>
                        <span>Present <br/>Students</span>

                        <h1><?php echo $present_no_of_students;?></h1>
                    </div>
                </div>
            </div>
            <!--en panel-->
        </div>
        <!--en col-->
        <div class="col-sm-4 col-xs-12">
            <div class="panel message-center panel-embose bg-color-box absent-student bg-red">
                <div class="content">
                    <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">

                    <div>
                        <span>Absent <br/>Students</span>

                        <h1><?php echo $absent_no_of_students;?></h1>
                    </div>
                </div>
            </div>
            <!--en panel-->
        </div>
        <!--en col-->
    </div>
    <!--en row-->
</div>
<div id="widnow" class="my-box comment-center">
    <h3>Class Attendance This Month</h3>

    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table color-table info-table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>%</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Present</td>
                        <td><?php echo $pper; ?>%</td>
                    </tr>
                    <tr>
                        <td>Absent</td>
                        <td><?php echo $aper; ?>%</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="title_bar">
        <div id="button">+</div>
    </div>
    <div id="box">
        <div class="my-box rem-extra">
            <div id="chartdiv">
                <div id="chartdivone" style="width: 100%; height: 180px;"></div>
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
                                    "value": (<?php echo $present_no_of_students; ?>+0)
                                },
                                {
                                    "status": "Absent",
                                    "value": (<?php echo $absent_no_of_students; ?>+0)
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
<div class="my-box comment-center">
    <div class="table-responsive table-height">
        <table class="table table-bordered">
            <thead>
            <tr class="table-bg1">
                <th>Roll No.</th>
                <th>Name</th>
                <th>Profile</th>
                <th>Enrollment No.</th>
                <th>Status</th>
                <th>In Time</th>
                <th>Out Time</th>
                <th>Edit</th>
            </tr>
            </thead>
            <tbody class="c_teach_tabel" id="Table">
            <?php
            $i=1;
            foreach ($stuidarr as $stuvar) {
                ?>
                <tr>
                    <td class="text-center"><?php echo $i;?></td>
                    <td><?php echo $stuvar['USERFNAME'];?></td>
                    <td><a href="student-profile.php?stu_id=<?php echo $stuvar['stu_id']; ?>"><img
                                src="../images/images.png"></a></td>
                    <td><?php echo $stuvar['app_no']?></td>
                    <td><?php if($stuvar['att_status']!='') {echo $stuvar['att_status'];} else {
                            echo '-';
                        }?></td>

                    <td><?php if($stuvar['att_intime']!='') {echo $stuvar['att_intime'];} else {
                            echo '-';
                        }?></td>
                    <td><?php if($stuvar['att_outtime']!='') {echo $stuvar['att_outtime'];} else {
                            echo '-';
                        }?></td>
                    <td class="text-center">
						<?php
									if($stuvar['att_ref_id']!='')
									{
									?>
                        <?php echo '<a class="editattend"  style="cursor:pointer;" data-id="'.$stuvar['att_id'].'" data-user="'.$stuvar['att_ref_id'].'" data-in="'.$stuvar['att_intime'].'" data-out="'.$stuvar['att_outtime'].'" >
			   <i class="fa fa-pencil-square font-icon-size" aria-hidden="true"></i>
			   </a>';?>
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
<div class="my-box comment-center" id="onleave">
    <h3>Students on Leave Today</h3>
    <div class="table-responsive table-leave-height">
        <table class="table table-bordered">
            <thead>
            <tr class="table-bg1">
                <th>Roll No.</th>
                <th>Name</th>
                <th>Profile</th>
                <th>Enrollment No.</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody class="c_teach_tabel">
            <?php
            if (count($stuleaveidarr) != 0) {
                foreach ($stuleaveidarr as $vlue) {
                    ?>
                    <tr>
                        <td class="text-center">1</td>
                        <td><?php echo $vlue['USERFANME'];?></td>
                        <td>
                            <a href="profile.php">
                                <?php if ($vlue['IMAGE'] != '') {
                                    echo '<img src="../school-admin/uploads/' . $vlue['IMAGE'] . '">';
                                } else {
                                    echo '<img src="../images/images.png">';
                                }
                                ?>
                            </a>
                        </td>
                        <td>101164</td>
                        <td><a href="#" class="btn-block">Leave</a></td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5" class="text-center">No Record Found</td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<!--col-en-->
<div class="col-md-5 col-sm-5 col-xs-12">
    <!--calendar st-->
    <div class="my-box">
        <h3 class="box-title">My Subject</h3>
        <section class="panel section-panel">
            <!--subject teacher st-->
            <div class="table-responsive">
                <table class="table table-hover table-scroll teacher-profile">
                    <thead>
                    <tr>
                        <th><strong>#</strong></th>
                        <!--<th><strong>Teacher Name</strong></th>-->
                        <th><strong>Subject</strong></th>
                        <th><strong>Class</strong></th>
                        <th><strong>Section</strong></th>
                    </tr>
                    </thead>
                    <tbody class="panel-scroll">
                    <?php
                    $i = 1;
                    foreach ($smysubject as $smysubjectv) {
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <!--<td><?php /*echo $_SESSION['USER']['USER_NAME']*/?></td>-->
                            <td><?php echo $smysubjectv['subject_id']?></td>
                            <td><?php echo $smysubjectv['class_id']?></td>
                            <td><?php echo $taecherdata['section'];?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!--subject teacher en-->
        </section>
    </div>
    <div class="my-box">
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
                while ($row = mysql_fetch_array($eventNotification)) {
                    if ($i % 2 == 0) {
                        $tag = 'success';
                    } else {
                        $tag = 'info';
                    }
                    ?>
                    <div class="alert alert-<?php echo $tag; ?> clearfix alert-height">
                        <div class="notification-info">
                            <ul class="clearfix notification-meta">
                                <li class="pull-left notification-sender">
                                    <span>
                                        <a href="" data-toggle="modal" data-target="#myMails"
                                             class="getholidays"
                                             data-oc="<?php echo $row['occassion']; ?>"
                                             data-to="<?php echo date('d-m-Y', strtotime($row['maxoff'])); ?>"
                                             data-from="<?php echo date('d-m-Y', strtotime($row['minoff'])); ?>"
                                             data-info="<?php echo $row['additional_info']; ?>">
                                            <?php echo $row['occassion']; ?>&nbsp
                                            <?php
                                            $from_date = date('d-m-Y', strtotime($row['maxoff']));
                                            $to_date = date('d-m-Y', strtotime($row['minoff']));
                                            if ($from_date != $to_date) {
                                                echo " - From " . $to_date . " To " .$from_date;
                                            } else {
                                                echo " - " . $from_date;
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
                ?>


            </div>
        </section>
    </div>
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
                                class="text-muted"> <?php echo date('d-m-Y', strtotime($cirvlue['date'])); ?></span></p>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>

    </div>
    <div class="my-box">
        <section class="panel section-panel">
            <header class="panel-heading heading-event">
                <h3 class="box-title clearfix">Leave Status <a href="javascript:void(0)" data-toggle="modal" data-target="#myApplyLeave" class="btn btn-success pull-right">Apply Leave</a></h3>
            </header>
            <div class="panel-body">
                <!--leave section st-->
                <div class="table-responsive">
                    <table class="table table-bordered leave-status">
                        <thead>
                        <tr>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                            <th class="text-nowrap">View</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($leave as $val){

                        ?>
                        <tr>
                            <td><?php echo date('M/d/Y',strtotime($val['minoff'])); ?></td>
                            <td><?php echo date('M/d/Y',strtotime($val['maxoff'])); ?></td>
                            <td><?php echo $val['leave_status']; ?></td>
                            <td>
                                <a href="#" class="eye-big" data-toggle="modal">
                                    <span
                                        data-from="<?php echo date('M/d/Y',strtotime($val['minoff'])); ?>"
                                        data-to="<?php echo date('M/d/Y',strtotime($val['maxoff'])); ?>"
                                        data-status="<?php echo $val['leave_status']; ?>"
                                        data-reason="<?php echo $val['leave_reason']; ?>"
                                          class="fa fa-eye leave_details"></span>
                                </a></td>
                        </tr>
                        <?php
                        }
                        ?>

                        <!--<tr>
                            <td>Nov/22/2016</td>
                            <td>Nov/25/2016</td>
                            <td>Pending</td>
                            <td><a href="#" class="eye-big" data-toggle="modal" data-target="#myLeave"><span class="fa fa-eye"></span></a></td>
                        </tr>
                        <tr>
                            <td>Dec/02/2016</td>
                            <td>Dec/05/2016</td>
                            <td>Pending</td>
                            <td><a href="#" class="eye-big" data-toggle="modal" data-target="#myLeave"><span class="fa fa-eye"></span></a></td>
                        </tr>-->
                        </tbody>
                    </table>
                </div>
                <!--leave section en-->
            </div>
        </section>
    </div>
</div>
<!--calendar en-->
</div>
<!--col-en-->
</div>
<!--stu info en-->
<!-- .right-sidebar st here-->
</div>
<!-- /.container-fluid -->
<?php include'../includes/footer.php'; ?>
<!--</div>-->
<!-- /#page-wrapper -->

<!-- /#wrapper -->

<!-- Modal -->
<script>
    $(".editattend").click(function () {
        var id = $(this).attr("data-id");
        var intime = jQuery(this).attr("data-in");
        if(intime == '-' || intime ==''){
            jQuery("#present_radio_div").show();
            jQuery("#absent_radio_div").hide();
            jQuery("#present_radio").attr('checked', 'checked');
        }
        else{
            jQuery("#present_radio_div").show();
            jQuery("#absent_radio_div").show();
            jQuery("#present_radio").attr('checked', 'checked');
        }
        var user = $(this).attr("data-user");
        //var intime = $(this).attr("data-in");
        var outtime = $(this).attr("data-out");


        $("#outtime").val(outtime);
        $("#outtimehidden").val(outtime);
        $("#id").val(user);
        $("#intime").val(intime);
        $("#intimehidden").val(intime);
        $("#att_id").val(id);
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
                <div id="inouterror"></div>
            </div>
            <form class="form-inline" method="post" action="" onsubmit="return TimeValidation();">
                <div class="modal-body">
                    <input class="form-control"  type="hidden" id="att_id" name="att_id">
                    <input class="form-control"  type="hidden" id="id" name="id">
                    <input class="form-control" value="<?php echo date('Y-m-d');?>" type="hidden" id="att_date" name="att_date">
                    <input class="form-control" value="<?php echo CURRENT_SESSION;?>" type="hidden" id="curr_session" name="curr_session">
                    <div id="present_radio_div">
                        <input type="radio" id="present_radio" name="present" value="present">Present
                    </div>
                    <div class="col-lg-6">
                        <label>Intime</label>
                        <div class="input-group clockpicker">
                            <input class="form-control" type="text" id="intime" name="intime">
                            <input class="form-control" type="hidden" id="intimehidden">
                            <input class="form-control" type="hidden" id="outtimehidden">
                            <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label>Outtime</label>
                        <div class="input-group clockpicker">
                            <input class="form-control" type="text" id="outtime" name="outtime">
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
                               value="Principal">

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
<!--mail modal en-->
<!--leave modal st-->
<div class="modal fade" id="myLeave" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Leave Status</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>
                                <Span id="leave_date">Nov/19/2016</Span>
                                <Span id="leave_date_to">Nov/19/2016</Span>
                            </th>

                            <th colspan="2"><a href="" class="btn btn-default pull-right border-round">
                                    <div id="leave_sttus">Pending</div>
                                </a></th>
                        </tr>
                        </thead>
                    </table>
                    <div class="panel panel-leave">
                        <div class="panel-heading p-head">
                            <h4 class="panel-title">Reason of leave</h4>
                        </div>
                        <div class="panel-body">
                            <p>

                            <div id="leave_rforleave">Going to home for attending function.</div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 pull-right text-center">
                        <!--<button type="button" class="btn btn-default btn-color border-round" data-toggle="modal" data-target="#myApplyLeave" data-dismiss="modal"><i class="fa fa-pencil-square-o"></i> Edit</button>-->
                        <button type="button" class="btn btn-warning btn-color border-round"><i
                                class="fa fa-times-circle"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--leave modal en-->

<!-- Modal -->
<div id="alertleavemsg"></div>
<form action="" method="post" name="leaveform">

    <input type="hidden" class="form-control mydatepicker" name="from_role"
           value="<?php echo $_SESSION['USER']['ROLE_ID']; ?>">
    <input type="hidden" class="form-control mydatepicker" name="from_id"
           value="<?php echo $_SESSION['USER']['USER_ID']; ?>">

    <div class="modal fade" id="myApplyLeave" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header-1">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Apply Leave</h4>
                    <input type="hidden" class="form-control mydatepicker fromd" name="role" value="Teacher">
                </div>
                    <div class="modal-body">
                        <div id="alertmessage"></div>
                        <div class="col-md-6">
                            <h4>From: </h4>
                            <input type="text" class="form-control event_date" name="fromd" id="fromd">
                            <input type="hidden" name="type" value="Teacher">
                        </div>
                        <div class="col-md-6"><h4>To: </h4>
                            <input type="text" class="form-control event_date"  name="fromt" id="fromt"></div>
                        <div class="col-md-12">
                            <h4>Reason For Leave:</h4>
                            <textarea class="form-control" name="rforleave" id="rforleave"></textarea>
                        </div>
                        <div class="modal-footer-1">
                            <!--<button type="button" class="btn btn-default-1" data-dismiss="modal">Submit</button>-->
                            <input type="submit" class="btn btn-default-1" name="SubmitL" id="SubmitL" value="Submit">
                        </div>
                    </div>
            </div>
        </div>
    </div>
</form>
<!-- Modal -->
<!-------------FOR LATEST CIRCULAR-->
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
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<?php include '../includes/foot.php'; ?>
<!----------------------AFTER CLICK CALENDER THEN SHOW POPUP ON HOLIDAYS------------------------->
<script>
    $("#eventoccassion").click(function () {
        $("#HolidayEvent").modal('show');
    });
</script>

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
                <h4 class="modal-title " id="oc"></h4>
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

<!-----------------FOR LATEST CIRCULAR ON DASHBOARD------------->
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
    $(".getdata").click(function () {
        var dra = $(this).attr("data-id");
        var subject = $(this).attr("data-subject");
        var href = $(this).attr("data-href");
        $("#target").css("display", "block");
        if (href == '') {
            $("#target").css("display", "none");
        }

        $("#success_message").html(dra);
        $("#subject_message").html(subject);
        $("#target").attr("href", "<?php echo HTTP_SERVER;?>dashboard/school-admin/uploads/" + href + "");
        $("#myViewmodal").modal('show');


    });
</script>
<!-- /#page-wrapper -->
<div class="modal fade" id="myViewmodal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1" id="subject_message">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Did this Notice & Circulars is relevent</h4>
            </div>
            <div class="modal-body" id="success_message">
                <p class="text-justify"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
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
<script>
    function leaveValidate() {
        if (document.leaveform.fromt.value == '') {
            document.getElementById('alertleavemsg').innerHTML = 'Please enter class Name';
            document.leaveform.fromt.focus();
            return false;
        }
        if (document.leaveform.fromd.value == '') {
            document.getElementById('alertleavemsg').innerHTML = 'Please enter Atleast one Section';
            document.leaveform.fromd.focus();
            return false;
        }
        if (document.leaveform.rforleave.value == '') {
            document.getElementById('alertleavemsg').innerHTML = 'Please enter Reason For Leave';
            document.leaveform.rforleave.focus();
            return false;
        }
        return true;
    }
    function TimeValidation(){
        var intime = jQuery("#intime").val();
        var outtime = jQuery("#outtime").val();
        if(intime > outtime){
            document.getElementById("inouterror").innerHTML='Out time should be Grater than InTime';
            document.getElementById("outtime").focus();
            return false;
        }
    }
</script>
<!-------------------------SMS MODAL----------------------------->
<div class="modal fade" id="mySms" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Send SMS</h4>
            </div>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
                <div class="modal-body">
                    <div id="alertmsg"></div>
                    <div class="form-group marg-bott">
                        <input type="hidden" id="mobile" name="mobile_no">
                        <label for="textarea" class="col-sm-2 control-label">Message:</label>
                        <div class="col-sm-10">
                            <textarea rows="5" maxlength="100" id="sms" name="sms" class="message"></textarea>
                            <div id="textarea_feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 pull-right text-center">
                            <input type="submit" name="submitsms" onclick="return sms_validation()" class="btn btn-default btn-color border-round" value="Send">
                            <!-- <i class="fa fa-paper-plane"></i> </button>-->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    jQuery(".message_popup").click(function(){
        var mobile=jQuery(this).attr("data-mobile");
        jQuery("#mobile").val(mobile);
        jQuery("#mySms").modal("show");
    })
    function sms_validation(){
        var sms = jQuery("#sms").val();
        if(sms == ''){
            jQuery("#alertmsg").html("Plese insert Message");
            jQuery("#sms").focus();
            return false;
        }
    }
</script>
<!--FOR REMAINING CHARECTOR-->
<script>
    jQuery(document).ready(function(){
        var text_max = 100;
        jQuery("#textarea_feedback").html(text_max + ' Characters Remaining');
        jQuery("#sms").keyup(function(){
            var text_length = jQuery("#sms").val().length;
            console.log(text_length);
            var text_remaining = text_max - text_length;
            console.log(text_remaining);
            jQuery("#textarea_feedback").html(text_remaining + '  Characters Remaining');
        });
    })
</script>
<!---------FOR RESET FIELDS------------>
<script>
    $(document).ready(function() {
        $(".reset").click(function() {
            $('#outtime').val("");
            $('#intime').val("");
        });
    });
</script>
<!--On Click Absent Blank Data-->
<script>
    $(document).ready(function() {
        $("#absent_radio").click(function() {
            $('#outtime').val("");
            $('#intime').val("");
        })
        $("#present_radio").click(function() {
            var hiddenval = $("#intimehidden").val();
            var hiddenval2 = $("#outtimehidden").val();
            $("#intime").val(hiddenval);
            $('#outtime').val(hiddenval2);
        })

    });
</script>
<!--for datepicker-->
<script>
    jQuery('.event_date').datepicker({
        orientation: 'auto top',
        startDate:new Date(),
        format: 'dd-mm-yyyy',
        "autoclose": true,
        todayHighlight: true
    });
</script>
<script>
    $(document).ready(function(){
        $("#SubmitL").click(function(){
            var stdate= $("#fromd").val();
            var endate = $("#fromt").val();
            if(stdate >  endate){
                $("#fromt").focus();
                $("#alertmessage").html("To Date should be greater than From date");
                return false;
            }
        })
    })
</script>
<!---------FOR DATE VALIDATION-------->
<script>

</script>
<script>
    jQuery(".leave_details").click(function(){
        var fromd = jQuery(this).attr("data-from");
        var tod = jQuery(this).attr("data-to");
        var status = jQuery(this).attr("data-status");
        var leave_reason = jQuery(this).attr("data-reason");

        var blank="";
        $("#leave_date").html(blank);
        $("#leave_date_to").html(blank);
        if (fromd == tod) {
            $("#leave_date").html(fromd);
        }
        else {
            $("#leave_date").text(' From : ' + fromd);
            $("#leave_date_to").html(' To : ' + tod);
        }


        jQuery("#leave_sttus").html(status);
        jQuery("#leave_rforleave").html(leave_reason);

        jQuery("#myLeave").modal("show");
    });
</script>
</body>
</html>

