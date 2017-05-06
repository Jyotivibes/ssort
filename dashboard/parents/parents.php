<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parents | Parents</title>
    <?php include '../includes/head.php'; ?>
</head>
<body>
<div id="wrapper">
<?php

if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Parent') )
{
    $user_id=$_SESSION['USER']['USER_NAME'];
    require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
    require_once('../../classes/general_class.php');
    $obj = new General();
    $circularNotice = $obj->getCircularActivities();
    $eventNotification = $obj->getEventsNotification();
    $markholidays = $obj->markHoliday();
    include_once 'stastics.php';
	if(isset($_REQUEST['submitM'])){
        $addmessage = $obj->ADDMESSAGE(); 
        if($addmessage == 1){
            echo "<script>alert('Message send')</script>";
        }
    }
    if(isset($_POST['submitsms'])){
        include("../../classes/send-sms.class.php");
        $sms = new SMS();
        $sms->CLI="SSORTDBAA";
        //$sms->CLI="SSORT";
		//$userdata=$arr[$key];
        //echo "Dear Admin,"."\n"."Your Employee ".$userdata['name']." left school at ".$invlaue['time']->format('H:i')."";
        $sms->mobile=$_POST['mobile_no'];
        $sms->message='Student Name:- '.$stuadata[0]['usr_fname'].' '.$stuadata[0]['usr_lname']."\n".'Class:- '
        .$sqlclass['class_name'].' '.$sqlsec['section_name']."\n".$_POST['sms'];
        //$sms->mobile=$outvlaue['contactno'];
        //$sms->mobile="9654170280";
        //$sms->allmobile="9654170280";
        $sms->accountName="vibescom";
		$sms_response = $sms->sendsms();
        //print_r($sms_response);
        echo "<script>alert('".$sms_response."')</script>";
    }
}

else
{
    echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
}
?>
<!-- header Navigation st-->
<?php include '../includes/header-configuration.php'?>
<!-- header Navigation en-->

<!--sidebar nav st-->
<?php include '../includes/sidebar.php'; ?>
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
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <a href="inbox.php">
            <div class="white-box text-center co-messages">
                <h1 class="text-white counter">
                    <!--  <i class="fa fa-envelope fa-messages"></i>-->
                    <img src="../images/icons/message.ico" class="icon-size" />
                </h1>
                <p class="text-muted">Messages</p>
            </div>
        </a>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <a href="attendance.php">
            <div class="white-box text-center co-attendance">
                <h1 class="text-white counter">
                    <img src="../images/icons/attendance.png" class="icon-size" />
                </h1>
                <p class="text-muted">Attendance</p>
            </div>
        </a>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <a href="fees.php">
            <div class="white-box text-center co-fees">
                <h1 class="counter">
                    <img src="../images/icons/fees.png" class="icon-size" />
                </h1>
                <p class="text-muted">Fee</p>
            </div>
        </a>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <a href="eventsholidays.php">
            <div class="white-box text-center co-events">
                <h1 class="counter">
                    <img src="../images/icons/event.ico" class="icon-size" />
                </h1>
                <p class="text-muted">Events & Holidays</p>
            </div>
        </a>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <a href="noticecircular.php">
            <div class="white-box text-center co-notifications">
                <h1 class="text-white counter">
                    <img src="../images/icons/notification.png" class="icon-size" />
                </h1>
                <p class="text-muted">Notice & Circulars</p>
            </div>
        </a>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <a href="javascript:void(0);">
            <div class="white-box text-center co-assessment">
                <h1 class="text-white counter">
                    <img src="../images/icons/assessment.png" class="icon-size" />
                </h1>
                <p class="text-muted">Assessment</p>
            </div>
        </a>
    </div>
</div>
<!--stu info st-->
<div class="row">
<div class="col-md-7 col-sm-12 col-xs-12">
    <div class="my-box">
        <h3 class="box-title">Demo International School - Location</h3>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="panel message-center panel-embose bg-color-box">
                    <div class="content">
                        <!--<img src="../images/<?php /*echo $stuadata[0]['usr_photo']; */?>" alt="user" class="img-circle student-profile">-->
                        <?php
                        $filename = "../images/".$stuadata[0]['usr_photo'];
                        if($stuadata[0]['usr_photo'] == ""){
                            ?>
                            <img src="../images/images.png" class="img-circle student-profile" />
                            <?php
                        }
                        elseif(file_exists($filename)){
                            ?>
                            <img src="../images/<?php echo $stuadata[0]['usr_photo']; ?>" class="img-circle student-profile"/>
                                <?php
                        }
                        else{
                            ?>
                            <img src="../images/images.png" class="img-circle student-profile" />
                                <?php
                            }
                            ?>
                        <div>
                            <strong><?php echo $stuadata[0]['usr_fname']."".$stuadata[0]['usr_mname']."".$stuadata[0]['usr_lname'];?></strong>
                            <h6><?php echo $stuarray[0]['class_name'];?> - <?php echo $stuarray[0]['section_name'];?></h6>
                            <h6>Enrollment No. - 2345</h6>
                        </div>
                    </div>
                </div><!--en panel-->
            </div><!--en col-->


        </div><!--en row-->
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <div class="panel message-center panel-embose bg-parents shadow-box-height">
                    <div class="content">
                        <!--<img src="../images/father-pic.jpg" alt="user" class="img-circle">-->
                        <?php
                        $filenameFather = "../images/".$sqlfather['usr_r_image'];
                        if($sqlfather['usr_r_image'] == ""){
                            ?>
                            <img src="../images/images.png" class="img-circle" />
                        <?php
                        }
                        elseif(file_exists($filenameFather)){
                            ?>
                            <img src="../images/<?php echo $sqlfather['usr_r_image']; ?>" class="img-circle"/>
                        <?php
                        }
                        else{
                            ?>
                            <img src="../images/images.png" class="img-circle" />
                        <?php
                        }
                        ?>
                        <div>
                            <strong><?php echo $sqlfather['usr_r_name'];?></strong>
                            <h6>Father</h6>
                            <h6><?php echo $sqlfather['usr_r_primary_contact'];?></h6>
                        </div>
                    </div>
                </div><!--en panel-->

                <div class="panel message-center panel-embose bg-parents shadow-box-height">
                    <div class="content">
                        <!--<img src="../images/mother-pic.jpg" alt="user" class="img-circle">-->
                        <?php
                        $filenameFather = "../images/".$sqlmother['usr_r_image'];
                        if($sqlmother['usr_r_image'] == ""){
                            ?>
                            <img src="../images/images.png" class="img-circle" />
                        <?php
                        }
                        elseif(file_exists($filenameFather)){
                            ?>
                            <img src="../images/<?php echo $sqlmother['usr_r_image']; ?>" class="img-circle"/>
                        <?php
                        }
                        else{
                            ?>
                            <img src="../images/images.png" class="img-circle"/>
                        <?php
                        }
                        ?>

                        <div>
                            <strong><?php echo $sqlmother['usr_r_name'];?></strong>
                            <h6>Mother</h6>
                            <h6><?php echo $sqlmother['usr_r_primary_contact'];?></h6>
                        </div>
                    </div>
                </div><!--en panel-->
            </div><!--en col-->

            <div class="col-sm-6 col-xs-12">
                <div class="panel message-center panel-embose bg-school box-padding">
                    <div class="content">
                        <?php
                        $filenamePrincipal = "../images/".$sqlprincipal['usr_pic'];
                        if($sqlprincipal['usr_pic'] == ""){
                            ?>
                            <img src="../images/images.png" class="img-circle principal-profile" />
                        <?php
                        }
                        elseif(file_exists($filenamePrincipal)){
                            ?>
                            <img src="../images/<?php echo $sqlprincipal['usr_pic']; ?>" class="img-circle principal-profile"/>
                        <?php
                        }
                        else{
                            ?>
                            <img src="../images/images.png" class="img-circle principal-profile"/>
                        <?php
                        }
                        ?>

                        <div>
                            <strong>Ms. <?php echo $sqlprincipal['usr_fname'];?><?php echo $sqlprincipal['usr_mname'];?> <?php echo $sqlprincipal['usr_lname'];?></strong>
                            <h6>Principal</h6>
                        </div>
                        <div class="info-panel">
                            <a href="javascript:void(0)" class="message_popup" data-toggle="modal"
                               data-mobile ="<?php echo $sqlprincipal['usr_mobile']; ?>">
                                <img src="../images/icons/chat.png" class="icon-two-size effect-icon" data-toggle="tooltip" data-placement="top" title="Message">
                            </a>
                             <a href="javascript:void(0)" data-toggle="modal" data-target="#myMail" class="getdata"
                               data-pid="<?php echo $sqlprincipal['usr_id']; ?>"
                               data-prole ="<?php echo $sqlprincipal['usr_role']; ?>"
                               data-pname="<?php echo $sqlprincipal['usr_fname']." ".$sqlprincipal['usr_mname']." ".$sqlprincipal['usr_lname']; ?>">
                                <img src="../images/icons/message.ico" class="icon-two-size effect-icon" data-toggle="tooltip" data-placement="top" title="E-mail">
                            </a>
                        </div>
                    </div>
                </div><!--en panel-->
            </div><!--en col-->

            <div class="col-sm-6 col-xs-12">
                <div class="panel message-center panel-embose bg-school box-padding">
                    <div class="content">
                        <!--<img src="../images/clteacher-pic.jpg" alt="user" class="img-circle teacher-profile">-->
                        <?php
                        $filenameTeacher = "../images/".$classteacherdata['usr_pic'];
                        if($classteacherdata['usr_pic'] == ""){
                            ?>
                            <img src="../images/images.png" class="img-circle teacher-profile" />
                        <?php
                        }
                        elseif(file_exists($filenameTeacher)){
                            ?>
                            <img src="../images/<?php echo $classteacherdata['usr_pic']; ?>" class="img-circle teacher-profile"/>
                        <?php
                        }
                        else{
                            ?>
                            <img src="../images/images.png" class="img-circle teacher-profile"/>
                        <?php
                        }
                        ?>
                        <div>
                            <strong><?php echo $classteacherdata['usr_fname']." ".$classteacherdata['usr_mname']." ".$classteacherdata['usr_lname']; ?></strong>
                            <h6>Class Teacher</h6>
                        </div>
                        <div class="info-panel">
                            <a href="javascript:void(0)" class="message_popup" data-toggle="modal"
                               data-mobile ="<?php echo $classteacherdata['usr_mobile']; ?>">
                                <img src="../images/icons/chat.png" class="icon-two-size effect-icon" data-toggle="tooltip" data-placement="top" title="Message"></a>
                           <a href="#" data-toggle="modal" data-target="#myMail" class="getdata" data-pid="<?php echo $classteacherdata['usr_id']; ?>"
                               data-prole ="<?php echo $classteacherdata['usr_role']; ?>"
                               data-pname="<?php echo $classteacherdata['usr_fname']." ".$classteacherdata['usr_mname']." ".$classteacherdata['usr_lname']; ?>"><img src="../images/icons/message.ico" class="icon-two-size effect-icon"  data-toggle="tooltip" data-placement="top" title="E-mail"></a>
                        </div>
                    </div>
                </div><!--en message center-->
            </div><!--en col-->
        </div><!--en row-->
    </div>
    <!--progress st-->
    <div class="my-box comment-center">
        <div class="comment-body comment-profile">
            <div class="panel-attendance">
                <span class="text-heavy">Month's Attendance</span>
                <div class="circle__content">
                    <?php
                    if($monthpercentage ==''){
                        echo 0;
                    }
                    else{
                        echo number_format($monthpercentage,2);
                    }
                    ?> %</div>

                <a href="javascript:void(0)" class="pull-right label-<?php if($status=='Absent') echo 'info'; else echo 'success';?> label" ><?php echo $status;?></a> <span class="pull-right text-today">Today</span>
            </div>
			<?php 
			if($status=='Present')
			{
			?>
            <div class="pull-right in-out-time">
                <a href="javascript:void(0)" class="pull-left label-info label m-r-8 padding-time" >IN TIME <span class="btn-block m-t-5"><?php echo $in_time;?></span></a>
                <a href="javascript:void(0)" class="pull-right label-warning label padding-time" >OUT TIME<span class="btn-block m-t-5"><?php echo $out_time;?></span></a>
            </div>
			<?php
			}
			?>
        </div>
    </div>
    <!--progress en-->
    <!--graph st-->
    <div class="my-box rem-extra">
        <h3 class="text-center">Session <?php echo CURRENT_SESSION;?></h3>
        <div id="chartdiv" class="bg-chart"></div>
		<script>
                                    $(function(){
                                        var chart = AmCharts.makeChart( "chartdiv", {
                                            "labelRadius": -40,
                                            "labelText": "[[status]]: [[percents]]%",
                                            "type": "pie",
                                            "theme": "light",
                                            "dataProvider": [{
                                                "status": "Present",
                                                "value": (<?php echo $no_of_days_present_session; ?>+0)
                                            },{
                                                "status": "Absent",
                                                "value": (<?php echo $no_of_days_absent_session; ?>+0)
                                            }],
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

        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table color-table info-table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Days</th>
                            <th>%</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Present</td>
                            <td><?php echo $no_of_days_present_session; ?></td>
                            <td><?php echo number_format($yearpresentpercentage,2);?>%</td>
                        </tr>
                        <tr>
                            <td>Absent</td>
                            <td><?php echo $no_of_days_absent_session; ?></td>
                            <td><?php echo number_format($yearabsentpercentage,2);?>%</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--en row-->
    </div>
    <!--graph en-->
</div><!--col-en-->
<div class="col-md-5 col-sm-12 col-xs-12 m-top-20">
<div class="my-box"> 
                       <h3 class="box-title">My Subject</h3>                       
                        <section class="panel section-panel">                            
                           <!--subject teacher st-->
                               <div class="table-responsive">
                                  <table class="table table-hover table-scroll teacher-profile">
                                    <thead>
                                      <tr>
                                        <th><strong>#</strong></th>
                                        <th><strong>Teacher Name</strong></th>
                                        <th><strong>Subject</strong></th>                                        
                                      </tr>
                                    </thead>
                                    <tbody class="panel-scroll">
									<?php
									$i=1;
									foreach($allteacher as $teachdata)
									{
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $teachdata['STAFF_NAME'];?></td>
                                        <td><?php echo $teachdata['subject_id'];?></td>                                        
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
    <!--calendar st-->
    <div class="my-box">
        <!--<div id="calendar-fancy"></div>-->
        <div id="calendar-fancy">
		<script>
                                    /*Mark Calendar*/
                                    var markHolidays=[
                                        <?php
                                        $i = 0;
                                        $size = count($markholidays);
                                        while($row = mysql_fetch_array($markholidays)){
                                        echo ($size==++$i)?'':', ';
                                         ?>
                                        {
                                            month:(<?php echo date('m',strtotime($row['off_day'])); ?>-1),
                                            year: (<?php echo date('Y',strtotime($row['off_day'])); ?>+0),
                                            holidays:[

                                                {
                                                    holiday:"<?php echo $row['occassion']; ?>",
                                                    day:(<?php echo date('d',strtotime($row['off_day'])); ?>+0)
                                                }
                                            ]
                                        }
                                        <?php
                                        }
                                         ?>
                                    ];
                                </script></div>
        <!--<img src="../images/calendar.jpg" class="img-responsive" />-->

        <section class="panel section-panel">
            <header class="panel-heading heading-event">
                <h3 class="box-title">Upcoming Events & Holidays - <span class="today" id="todaydate"></span></h3>
            </header>
            <div class="panel-body panel-scroll" id="eventoccassion">
                <?php
                $i=1;
                while($row = mysql_fetch_array($eventNotification)){
                    if($i%2==0)
                    {
                        $tag='success';
                    }
                    else
                    {
                        $tag='info';
                    }
                    ?>
                    <div class="alert alert-<?php echo $tag;?> clearfix alert-height">
                        <div class="notification-info">
                            <ul class="clearfix notification-meta">
                                <li class="pull-left notification-sender">
                                    <span><a href="" data-toggle="modal" data-target="#myMail"
                                                         class="getholidays"
                                                         data-oc="<?php echo $row['occassion']; ?>"
                                                         data-to="<?php echo date('d-m-Y', strtotime($row['maxoff'])); ?>"
                                                         data-from="<?php echo date('d-m-Y', strtotime($row['minoff'])); ?>"
                                                         data-info="<?php echo $row['additional_info']; ?>">
                                                        <?php echo $row['occassion']; ?>
                                                    </a></span>
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
                        data-date="<?php echo date('d-m-Y',strtotime($cirvlue['date'])); ?>">
                        <div class="bg-info icon-thumb"><i class="fa fa-calendar"></i></div>
                        <p><?php
                            if(strlen($cirvlue['subject']) > 20){
                                echo substr($cirvlue['subject'],0,20)." . . .";
                            }
                            else{
                                echo $cirvlue['subject'];
                            }

                            ?><span
                               class="text-muted"> <?php echo date('d-m-Y',strtotime($cirvlue['date'])); ?></span></p>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>

    </div>
    <!--latest circular en-->
</div>
<!--calendar en-->
</div><!--col-en-->
</div>
<!--stu info en-->
<!-- .right-sidebar st here-->
</div>
<!-- /.container-fluid -->
<?php include'../includes/footer.php'; ?>
</div>
<!-- /#page-wrapper -->


<!--mail modal st-->
<div class="modal fade" id="myMails" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Email to contact</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
                    <div class="form-group">
                        <input type="hidden" name="from_id" value="<?php echo $select_user['usr_id']; ?>">
                        <input type="hidden" name="from_role" value="<?php echo $select_user['usr_role']; ?>">
                        <input type="hidden" name="to_role" id="p_role">
                        <input type="hidden" name="teacher_id" id="p_id">
                        <label for="inputPassword3" class="col-sm-2 control-label">Subject:</label>
                        <div class="col-sm-10">
                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                        </div>
                    </div>
                    <div class="form-group marg-bott">
                        <label for="textarea" class="col-sm-2 control-label">Message:</label>
                        <div class="col-sm-10">
                            <textarea rows="5" name="message" class="message"></textarea>
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
                        <input type="submit" name="submitM" class="btn btn-default btn-color border-round" value="Send">
                           <!-- <i class="fa fa-paper-plane"></i> </button>-->
                    </div>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>
<!--mail modal en-->
<!--mail modal en-->

<!--latest circular st-->
<div class="modal fade" id="latestCircular" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Latest Circular</h4>
            </div>
            <div class="modal-body" id="showCircularModal">
                <p>Latest Circular</p>
            </div>
        </div>
    </div>
</div>
<!--latest circular en-->
<!-- /#wrapper -->

<?php include '../includes/foot.php'; ?>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();

    });
</script>

<script>
    $(document).ready(function(){
        $(".data").click(function(){
            var linkId=$(this).attr("data-id")
            $("#showCircularModal").html(linkId);
            $("#latestCircular").modal('show');

        });
    });
</script>

<script>
    $(".getdata").click(function() {
        var pid=$(this).attr("data-pid");
        var prole=$(this).attr("data-prole");
        var pname=$(this).attr("data-pname");
        $("#p_id").val(pid);
        $("#p_role").val(prole);
        $("#p_name").val(pname);
        $("#myMails").modal('show');
    });
</script>
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
<!-- /#page-wrapper -->
<div class="modal fade" id="getCircular" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="subject_message">Did this Notice & Circulars is relevent</h4>

            </div>

            <div class="modal-body" >
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
</body>
</html>
