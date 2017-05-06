<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | Chairman</title>
    <?php include '../includes/head.php'; ?>
</head>

<body>
<!-- Preloader -->
<div id="wrapper">
        <!-- Navigation -->
        <?php include '../includes/header-configuration.php'; ?>
        <!--sidebar nav st-->
        <?php include '../includes/sidebar-chairman.php'; ?>

		<?php
		
		if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Chairman') )
		{ 	
				print_r($_SESSION);
				$user_id=$_SESSION['USER']['USER_NAME'];
				require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
				require_once('../../classes/general_class.php');
				$obj = new General();
                include_once("stastics.php");
                $eventNotification = $obj->getEventsNotification();
				$circularNotice = $obj->getCircularActivities();
                $markholidays = mysql_query("SELECT * FROM essort_holidays");
                $cirarray=array();
                while($rowcir=mysql_fetch_array($circularNotice))
                {
                    $cirarray[]=$rowcir;
                }
				$eventlist = $obj->getEventsNotification();
            /*************THIS CODE WILL BE ON STASTICS*****************/
          

		}
		else
		{
			echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
		}
        ?>
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
                <div class="row bg-title">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting from 15 November 2016.</span></h4>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="javascript:void(0);">Chairman</a>
                            </li>
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- massage box-->
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <a href="inbox.php">
                            <div class="white-box text-center co-messages">
                                <h1 class="text-white counter">
                                    <!--  <i class="fa fa-envelope fa-messages"></i>-->
                                    <img src="../images/icons/message.ico" class="icon-size">
                                </h1>
                                <p class="text-muted">Messages</p>
                            </div>
                        </a>
                    </div>

                    
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <a href="eventsholidays.php">
                            <div class="white-box text-center co-events">
                                <h1 class="counter">
                                    <img src="../images/icons/event.ico" class="icon-size">
                                </h1>
                                <p class="text-muted">Events &amp; Holidays</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <a href="noticecircular.php">
                            <div class="white-box text-center co-notifications">
                                <h1 class="text-white counter">
                                    <img src="../images/icons/notification.png" class="icon-size">
                                </h1>
                                <p class="text-muted">Notice & Circulars</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="javascript:void(0);">	
                          <div class="white-box text-center co-assessment">
                            <h1 class="text-white counter">
                              <img src="../images/icons/assessment.png" class="icon-size">
                              </h1>
                            <p class="text-muted">Assessment</p>
                          </div>
                        </a>	
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <a href="administration.php">
                            <div class="white-box text-center co-administration">
                                <h1 class="text-white counter">
                                    <img src="../images/icons/admin.png" class="icon-size">
                                </h1>
                                <p class="text-muted">Administration</p>
                            </div>
                        </a>
                    </div>
                </div>
                <!--mid info-->
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12">
                       <div class="my-box">
                           <div class="profile-panel">
                            <!--<h2 class="text-center text-white">Profile</h2>-->
                                <div class="row make-gap-1">    
                                    <div class="overlay-box">
                                        <div class="user-content text-center">
                                            <?php
                                            if($rows['usr_pic']==""){
                                                ?>
                                                <a href="javascript:void(0)"><img src="../images/images.png" class="thumb-chairman-lg img-circle" alt="img"></a>
                                            <?php
                                            }
                                            else{
                                                ?>
                                                <a href="javascript:void(0)"><img src="../images/<?php echo $rows['usr_pic']; ?>" class="thumb-chairman-lg img-circle" alt="img"></a>
                                            <?php
                                            }
                                            ?>

                                            <h4 class="text-white"><?php echo $rows['usr_fname']." ".$rows['usr_mname']." ".$rows['usr_lname']; ?></h4>
                                            <h5 class="text-white">(<?php echo $rows['usr_role']; ?>)</h5>
                                        </div>
                                    </div>
                                </div><!--end row-->
                           </div><!--en profile panel-->    
                        </div>
                        <div class="my-box">
                            <h2 class="text-center">Welcome To <?php echo $sch_name;?></h2>
                            <div class="row make-gap">
                                
                                    <div class="col-sm-3 col-xs-12 part box-effect side-gap">
                                        <a href="chairman-details.php">
                                            <h5 class="text-center head-new">
                                                <img src="../images/<?php echo $sch_logo; ?>" class="c_logo_cambridge img-responsive">
                                                <div class="c_school_cambridge"></div> <?php echo $resultsch['sch_city']; ?>
                                            </h5>
                                        </a>
                                    </div>
                               
                                </div><!--end row-->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                           <div class="panel my-box">
                            <h3>Staff Attendance</h3>
                            <div class="row">
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" id="sch_name">
                                            
                                            <option value="<?php echo $sch_name; ?>"><?php echo $sch_name; ?></option>
                                           
                                        </select>
                                    </div><!--en col-->
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" id="month_att">
										  <option value="">Select</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                        </select>
                                    </div>                                                    
                            </div>  <!--en row-->
                              <div class="row">
                                <div col-sm-12 col-xs-12> 
                                    <div id="chartdiv_staffattendance" style="width:270px;height:207px;">
                                        <script>
                                            $(function(){
                                                var chart = AmCharts.makeChart( "chartdiv_staffattendance", {

                                                    "labelRadius": -40,
                                                    "labelText": "[[status]]: [[percents]]%",

                                                    "type": "pie",
                                                    "theme": "light",
                                                    "dataProvider": [ {
                                                        "status": "Present",
                                                        "value": (<?php echo $sqlpreseent; ?>+0)
                                                    }, {
                                                        "status": "Absent",
                                                        "value": (<?php echo $absent; ?>+0)
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
                                    </div>
                                </div>
                              </div>
                            </div>    
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 ">
                         <div class="panel my-box">
                            <h3>Fees Collection</h3>
                           <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control">
									
										<option><?php echo $sch_name;?></option>
										
									</select>
                               </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="stu_fee">
									  <option value="">Select</option>
										<option value="quarter1">Quarter1</option>
										<option value="quarter2">Quarter2</option>
										<option value="quarter3">Quarter3</option>
										<option value="quarter4">Quarter4</option>
									</select>
                                </div>
                            </div>  <!--en row-->  
                            <div class="row">
                                <div col-sm-12 col-xs-12>
									<div id="chartdiv_feescollection" style="width:270px;height:207px;">
                                        <script>
                                            $(function(){
                                                var chart = AmCharts.makeChart( "chartdiv_feescollection", {

                                                    "labelRadius": -40,
                                                    "labelText": "[[collection]]: [[percents]]%",

                                                    "type": "pie",
                                                    "theme": "light",
                                                    "dataProvider": [ {
                                                        "collection": "Received",
                                                        "value": (<?php echo $feerecieved; ?>+0)
                                                    }, {
                                                        "collection": "Pending",
                                                        "value": (<?php echo $feepending; ?>+0)
                                                    }],
                                                    "valueField": "value",
                                                    "titleField": "collection",
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
                        <!--progress en-->
                        </div>
                    </div>
                    <!--col-en-->
                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <!--calendar st-->
                        <div class="my-box">
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
                                </script>
                            </div>
                            <!--<img src="images/calendar.jpg" class="img-responsive" />-->

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
                                    <span><a href="" data-toggle="modal" data-target="#myMails"
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

                                                ?>
                                                <span class="text-muted">
                                                    <?php echo date('d-m-Y',strtotime($cirvlue['date'])); ?>
                                                </span>
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
                    <!--calendar en-->
                </div>
                <!--stu info st-->

                <!--col-en-->
            </div>
            <!--col-en-->
        </div>
        <!--stu info en-->
        <!-- .right-sidebar st here-->
    </div>
<!-----------------FOR LATEST CIRCULAR----------------->
<div class="modal fade" id="getCircular" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="subject_message"></h4>

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
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
    <!-- /.container-fluid -->
    <?php include'../includes/footer.php'; ?>

<!---------------FOR SCHOOL STAFF ATTENDANCE--------------------->
<script>
    $(document).ready(function(){
        $("#month_att").change(function(){
            var month = $("#month_att").val();
            $.ajax({
                url: "<?php echo HTTP_SERVER; ?>ajax.php?action=staff_month&session=<?php echo $_SESSION['USER']['DB_NAME']; ?>",
                type: "POST",
                data: {
                    month: month
                },
                success: function (data) {
                $("#chartdiv_staffattendance").html(data);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function(){
        $("#stu_fee").change(function(){
            var fee = $("#stu_fee").val();
            $.ajax({
                url: "<?php echo HTTP_SERVER; ?>ajax.php?action=stu_fee&session=<?php echo $_SESSION['USER']['DB_NAME']; ?>",
                type: "POST",
                data: {
                    fee: fee
                },
                success: function (data) {
                $("#chartdiv_feescollection").html(data);
                }
            });
        });
    });
</script>

    <!-- /#wrapper -->
       
   
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Attendance</h4>
                </div>
                <div class="modal-body">
                    In Time
                    <input type="text" class="time start" placeholder="HH:MM:SS" /> Out Time
                    <input type="text" class="time end" placeholder="HH:MM:SS" />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
                </div>
            </div>
        </div>
    </div>
	 <!--latest circular st-->

    <!-- Modal -->
     <?php include '../includes/foot.php'; ?>

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
    <!-- #page-wrapper -->
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

</body>

</html>