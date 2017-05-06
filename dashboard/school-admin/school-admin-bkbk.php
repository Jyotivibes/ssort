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
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='SAD') )
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
		require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
		require_once('../../classes/general_class.php');
		$obj = new General();
		$eventNotification = $obj->getEventsNotification();
		$markholidays = $obj->markHoliday();
		include_once 'stastics.php';
		
	}
	else
	{
		echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
	}
	//$sql=mysql_query("SELECT * FROM essort_user_header WHERE usr_role='Principal' LIMIT 1");
	//$row=mysql_fetch_array($sql);
?>
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

        <?php include '../includes/header-notice.php'; ?>
           
            <!--stu info st-->
        
                <div class="row">
                <div class="col-md-7 col-sm-7 col-xs-12 my-box">
                         <div class="row">
					 <div class="col-md-6 col-sm-6 col-xs-12">
                       <div class="">
                           <div class="profile-panel_one1 panel-embose">
                                <div class="row make-gap">    
                                    <div class="overlay-box school-administration">
                                        <div class="user-content text-center">
                                            <a href="javascript:void(0)">
                                                <img src="../images/super_admin.png" class="thumb-chairman-sc img-circle" alt="img"> </a>
                                            <h4 class="text-white-1"><b>Administration</b></h4>
                                          
                            
                                        </div>
                                    </div>
                                  
                                        
                                </div>
                           </div> 
                        </div>
                    </div><!--en col-->
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       <div class="">
                           <div class="profile-panel_one panel-embose">
                                <div class="row make-gap">    
                                    <div class="overlay-box fee-fee">
                                        <div class="user-content text-center">
                                            <a href="javascript:void(0)">
                                                <img src="../images/rupee.png" class="thumb-chairman-sc img-circle" alt="img"> </a>
                                            <h4 class="text-white-1"><b>Fee</b></h4>
                                        </div>
                                    </div>
                                </div>
                           </div> 
                        </div>
                    </div><!--en col-->
					   <div class="col-md-6 col-sm-6 col-xs-12">
                       <div class="">
                           <div class="profile-panel_one2 panel-embose" data-toggle="modal" data-target="#myModalra">
                                <div class="row make-gap">    
                                    <div class="overlay-box">
                                        <div class="user-content text-center">
                                            <a href="../configuration/configuremaster.php" >
                                                <img src="../images/setting.png" class="thumb-chairman-sc img-circle" alt="img" /> <h4 class="text-white-1"><b>Configuration</b></h4>
                                             </a>
                                           
                                        </div>
                                    </div>
                                </div>
                           </div> 
                        </div>
                    </div><!--en col-->
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       <div class="">
                           <div class="profile-panel_one2 panel-embose stu-register">
                                <div class="row make-gap">    
                                    <div class="overlay-box">
                                        <div class="user-content text-center">
                                            <a href="javascript:void(0)" >
                                                <img src="../images/icons/attendance.png" class="thumb-chairman-sc img-circle" alt="img" />
                                             </a>
                                            <h4 class="text-white-1"><b>Registration</b></h4>
                                        </div>
                                    </div>
                                </div>
                           </div> 
                        </div>
                    </div><!--en col-->
                    
				</div>
                     <div class="row"> 
                       <div class="col-sm-6 new-gd">
                                <div class="new-block clr-block-1">
                                    <div class="col-md-8 new-left new_super">
                                        <h3><?php echo $pnum_of_students;?></h3>
                                        <h4>Total Present Students</h4>
                                       
                                    </div>
                                    <div class="col-md-4 new-right">
                                            <img src="../images/staff.png" class="img-responsive" alt="img"> 
                                    </div>
                                  <div class="clearfix"> </div>
                                </div>
			             </div>
                            
                      <div class="col-sm-6 new-gd">
                                <div class="new-block clr-block-2">
                                    <div class="col-md-8 new-left new_super">
                                        <h3><?php echo $pnum_of_staffs;?></h3>
                                        <h4>Total Present Staff</h4>
                                       
                                    </div>
                                    <div class="col-md-4 new-right">
                                            <img src="../images/staff-new.png" class="img-responsive" alt="img"> 
                                    </div>
                                  <div class="clearfix"> </div>
                                </div>
			             </div>
                     </div>
                    <div class="row m-t-20">
                    <div class="col-sm-12">
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
                                                            <a href="" data-toggle="modal" data-target=""
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
                </div>
                </div><!--col-en-->
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <!--calendar st-->
                    <div class="my-box">
                         <div class="table-responsive">
                             <h3 class="box-title latest-cir">Staff on Leave Today</h3>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>View</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								if(count($leavearray)!=0)
								{
									foreach($leavearray as $leavevlue)
									{
										?>
										
										<tr>
											<td><?php echo $leavevlue['USERFNAME'];?></td>
											 <td><?php echo $leavevlue['mindate'];?></td>
											<td><?php echo $leavevlue['maxdate'];?></td>
											<td>
												<a href="#id" data-toggle="modal" class="staffLeave"
                                                   data-reason="<?php echo $leavevlue['leave_reason']; ?>"
                                                   data-from="<?php echo date('d-m-Y', strtotime($leavevlue['mindate'])); ?>"
                                                   data-to="<?php echo date('d-m-Y', strtotime($leavevlue['maxdate'])); ?>"
                                                    >
                                                    <i class="view_btn fa fa-eye" aria-hidden="true"></i>
												</a>

											</td>
											<td><?php echo $leavevlue['leave_status'];?></td>
										</tr>
									 <?php
									 }
								 }
								 else
								 {
									echo '<tr><td colspan="6">No staff on leave today</td></tr>';
								 }
								 ?>
								
                                </tbody>
                            </table>

                        </div>
                       
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
        </div>
        <?php include'../includes/footer.php'; ?>
</div>


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
</body>
</html>

