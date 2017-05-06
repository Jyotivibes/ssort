<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>School Management System - SMS | Events & Holidays</title>
							<?php include '../includes/head.php'; ?>
</head>
<body>
							
<div id="wrapper">
<!-- Navigation -->
<?php
$formErr='';
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Principal') )
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
		$user_role=$_SESSION['USER']['ROLE_ID'];
		require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
		require_once('../../classes/general_class.php');
		$obj = new General();
		include_once 'stastics.php';

        if(isset($_REQUEST['submit'])){
            $res = $obj->ADDHOLIDAY();
            if($res == 0){
                echo mysql_error();
            }
            elseif($res == 1){
				$formErr='Event detail added successfully';
                //echo "<script>alert('Event detail added successfully.');</script>";
                //echo "<script>window.location.href='eventsholidays.php';</script>";
            }
            elseif($res == 2){
				$formErr='Problem in network.Please try again.';
                //echo "<script>alert('Problem in network.Please try again.');</script>";
            }
        }
		$sqlnote=mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM  essort_holidays WHERE occassion_type='Event' GROUP BY occassion");
		$sqlholnote=mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM  essort_holidays WHERE occassion_type='Holiday' GROUP BY occassion");
		$sqlcir=mysql_query("SELECT * FROM  essort_circular_activities");
		$sqlnotelist=mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM  essort_holidays  WHERE occassion_type='Event' GROUP BY occassion");
		
	}
	else
	{
		echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
	} 
?>	
<?php include'../includes/header-configuration.php'; ?>
<!--sidebar nav st-->
<?php include '../includes/sidebar-principal.php'; ?>                           
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
                            <a href="javascript:void(0);">Principal</a>
                        </li>
                        <li class="active">Events & Holidays</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!--modal window st-->
            <div class="modal" id="eventModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            <h4 class="modal-title">Event List</h4>
                        </div>
                        <div class="modal-body">
                           <div class="event-box">
                            <div class="message-center"> 
                                <a href="#">
                                  <div class="user-img"> <img src="../images/event_img1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                  <div class="mail-contnet">
                                    <h5>Event - 1</h5>
                                    <span class="mail-desc">The Event Dashboard lets you know how things are going with your event.</span> <span class="time">9:30 AM</span> </div>
                                </a> 
                                <a href="#">
                                  <div class="user-img"> <img src="../images/event_img2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                  <div class="mail-contnet">
                                    <h5>Event - 2</h5>
                                    <span class="mail-desc">The Event Dashboard lets you know how things are going with your event.</span> <span class="time">9:10 AM</span> </div>
                                </a> 
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <!--<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>-->
            <!--modal window en-->
            
            <!--event row st-->
             <div class="row">
                <div class="col-sm-12 col-xs-12">
                <div class="my-box">
                    <h3 class="box-title">Search Event/Holiday</h3>
                    <div class="m-t-20 event-panel">
                    <div class="col-md-9 col-sm-9 col-xs-12">
                     
                          <div class="form-group"> 
                                <div class="input-group"> 
                                  <input placeholder="Event name" class="form-control" type="text">
                                    <a href="#" class="input-group-addon" data-toggle="modal" data-target="#eventModal">
                                        <span class="fa fa-search"></span>
                                    </a>
                                </div>
                          </div>
                          <!-- form-group -->
                        </form>
                        </div><!--en col-->   
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <button type="button" class="btn btn-default pull-right border-round btn-event-bg" data-toggle="modal" data-target="#myEvent">
                                <span class="fa fa-calendar-check-o"></span> Create Event</button>
                        </div>
                    </div>
                  </div><!--en white-box-->
                </div><!--en col-->
            </div><!--en row-->
             <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <div class="my-box">
                        <div id="calendar-fancy"></div>
                    </div>
                </div><!--en col-->

                 <div class="col-sm-6 col-xs-12">
                    <div class="my-box event-list">
                        <h3 class="box-title">Event List - <span class="today" id="todaydate"></span></h3>
                       <section class="panel section-panel">
                            <div class="panel-body" id="eventoccassion">
							<?php
							$i=1;
								while($rowlist=mysql_fetch_array($sqlnotelist))
								{
								if($i%2==0)
								{
									$tag='info';
								}
								else
								{
									$tag='success';
								}
								?>
                                <div class="alert alert-<?php echo $tag;?> clearfix alert-height"> 
                                    <div class="notification-info">
                                        <ul class="clearfix notification-meta">
                                            <li class="pull-left notification-sender">
                                            <span class="alert-icon"><img src="../images/icons/event.ico" class="icon-size"></span> <span><a href="javascript:void(0);"><?php echo $rowlist['occassion'];?></a></span>
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
                      </div><!--en my-box-->
                </div><!--en col-->
            </div><!--en row-->


            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <div class="my-box">
                        <div class="panel panel-default">
                            <div class="col-sm-12 col-xs-12">
                                <div class="panel-heading">All Events
                                <form class="form-default pull-right">
                                  <div class="form-group">                    
                                    <div class="input-group">
                                      <input placeholder="Search event" class="form-control input-sm" type="text">
                                         <a href="#" class="input-group-addon">
                                             <span class="fa fa-search"></span>
                                         </a>
                                    </div>
                                  </div>
                                  <!-- form-group -->
                                </form>
                                </div>
                            </div>
                           
                            <div class="panel-wrapper collapse in">
                              <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th class="text-center">S. No.</th>
                                    <th>Event Name</th>
                                    <th>Date</th>
                                  </tr>
                                </thead>
                                <tbody>
								<?php
							$i=1;
								while($rowlist=mysql_fetch_array($sqlnote))
								{
								if($i%2==0)
								{
									$tag='info';
								}
								else
								{
									$tag='success';
								}
								?>
                                  <tr>
                                    <td align="center"><?php echo $i; ?></td>
                                    <td><?php echo $rowlist['occassion'];?></td>
                                    <td><span><?php echo $rowlist['minoff']."".$rowlist['maxoff'];?></span></td>
                                  </tr>
                                <?php
								}
								?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                      </div><!--en my-box-->
                </div><!--en col-->

                 <div class="col-sm-6 col-xs-12">
                    <div class="my-box">
                        <div class="panel panel-default">
                            
                            <div class="col-sm-12 col-xs-12">
                                <div class="panel-heading">All Holidays
                                <form class="form-default pull-right">
                                  <div class="form-group">                    
                                    <div class="input-group">
                                      <input placeholder="Search holiday" class="form-control input-sm" type="text">
                                         <a href="#" class="input-group-addon">
                                             <span class="fa fa-search"></span>
                                         </a>
                                    </div>
                                  </div>
                                  <!-- form-group -->
                                </form>
                                </div>
                            </div>
                            <div class="panel-wrapper collapse in">
                              <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th class="text-center">S. No.</th>
                                    <th>Holiday</th>
                                    <th>Date</th>
                                  </tr>
                                </thead>
                                <tbody>
								<?php
                                $i= 0;
								foreach($holarraym as $holvlue)
								{
                                    $i++;
								?>
                                  <tr>
                                    <td align="center"><?php echo $i; ?></td>
                                    <td><?php echo $holvlue['occassion'];?></td>
                                    <td><span><?php echo $holvlue['minoff'];?> to <?php echo $holvlue['maxoff'];?></span></td>
                                  </tr>
                                <?php
								}
								?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                      </div><!--en my-box-->
                </div><!--en col-->
            </div><!--en row-->
            <!--event row en-->

</div>

            <!-- .right-sidebar st here-->
         </div>
        <!-- /.container-fluid -->
          <?php include'../includes/footer.php'; ?>
    </div>
    <!-- /#page-wrapper -->
<!--event modal st-->
<div class="modal fade" id="myEvent" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header-1">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Event</h4>
        </div>
       <!--st modal-body-->
          <div class="modal-body">
              <div id="alertmsg"></div>
           <form class="form-horizontal" name="frm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return classsectionValidate();" >
              <div class="form-group">
                <!--radio st-->
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="checkbox checkbox-circle">
                      <input id="checkbox7" type="checkbox" checked>
                      <label for="checkbox7"> Event</label>
                    </div>
                  </div>
                <!--radio en-->
              </div>
			  <input type="hidden" name="role" value="Principal">
			  <input type="hidden" name="type" value="Event">
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-1 control-label">Date:</label>  
                <label for="inputPassword3" class="col-sm-1 control-label">From:</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control mydatepicker" id="date_form" name="date_form">
                </div>
                  <label for="inputPassword3" class="col-sm-2 control-label">To:</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control mydatepicker" name="date_to">
                </div>
              </div>
               <div class="form-group marg-bott">
                <label for="textarea" class="col-sm-2 control-label">Subject:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="subject">
                </div>  
              </div> 
              <div class="form-group marg-bott">
                <label for="textarea" class="col-sm-2 control-label">Description:</label>
                <div class="col-sm-10">
                  <textarea rows="5" class="message" name="message"></textarea>
                </div>  
              </div>
               <div class="modal-footer">
                   <div class="row">
                       <div class="col-sm-12 col-xs-12 pull-right text-center">
                           <button type="submit" name="submit" class="btn btn-default btn-color border-round">
                               <i class="fa fa-calendar-check-o"></i> Create Event</button>
                       </div>
                   </div>
               </div>
           </form>
        </div>
<!--end modal-body-->

      </div>
      
    </div>
  </div>    
<!--event modal en-->  
<!-- /#wrapper -->
<?php include '../includes/foot.php'; ?>
<?php
#Show form error message
if( $formErr!="" )
{
	?>
	<script>
		$('#myModalLabel').html('');
		$('#error_message').html("<?php echo $formErr; ?>");
		$('#alert_modal').modal('show');
	</script>
	<?php
}
?>
<!--Style Switcher -->
<!--<script src="js/jQuery.style.switcher.js"></script>-->
<script>
    function classsectionValidate(){
		
        if($('#date_form').val() ==''){
            document.getElementById('alertmsg').innerHTML='Please enter Date';
            $('#date_form').focus();
            return false;
        }
        return true;
    }
</script>
</body>
</html>
