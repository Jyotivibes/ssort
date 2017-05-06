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
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Chairman') )
{
    $user_id=$_SESSION['USER']['USER_NAME'];
    $user_role=$_SESSION['USER']['ROLE_ID'];
    require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
    require_once('../../classes/general_class.php');
    $obj = new General();
    $eventNotification = $obj->getEventsNotification();
    include_once 'stastics.php';
    $markholidays = mysql_query("SELECT * FROM essort_holidays");
    /********************FOR ALL EVENT SEARCH************************************/
    $sql = mysql_query("SELECT *, MAX(off_day) as maxoff, MIN(off_day) as minoff FROM
    essort_holidays WHERE occassion_type='Event' AND DATE_FORMAT(off_day, '%Y-%m-%d') >= '" .date('Y-m-d'). "' GROUP BY occassion");

    /********************FOR ALL HOLIDAYS SEARCH************************************/
    $sql_holidays = mysql_query("SELECT *, MAX(off_day) as maxoff, MIN(off_day) as minoff FROM
    essort_holidays WHERE occassion_type='Holiday' AND DATE_FORMAT(off_day, '%Y-%m-%d') >= '" .date('Y-m-d'). "' GROUP BY occassion");
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
<?php include '../includes/sidebar-chairman.php'; ?>
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
                    <div class="form-group">
                        <div class="input-group">
                                <input placeholder="Event name" class="form-control" id="tags" type="text">
                            <!---->
                            <a href="javascript:void(0);" class="input-group-addon" id="search_data">
                                <span class="fa fa-search"></span>
                            </a>
                        </div>
                    <!-- form-group -->
                </div><!--en col-->
            </div>
        </div><!--en white-box-->
    </div><!--en col-->
</div><!--en row-->
<div class="row">
    <div class="col-sm-6 col-xs-12">
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
        </div>
    </div><!--en col-->

    <div class="col-sm-6 col-xs-12">
        <div class="my-box event-list">
            <section class="panel section-panel">
                <header class="panel-heading heading-event">
                    <h3 class="box-title">Upcoming Events & Holidays - <span class="today" id="todaydate"></span></h3>
                </header>
                <div class="panel-body panel-scroll" id="eventoccassion">
                    <?php
                    $array = [];
                    $i = 1;
                    while ($row = mysql_fetch_array($eventNotification)) {
                        $array[] = $row;
                        if ($i % 2 == 0) {
                            $tag = 'success';
                        } else {
                            $tag = 'info';
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
                                    <input placeholder="Event name" class="form-control input-sm"
                                           id="all_event" type="text">
                                    <!---->
                                    <a href="javascript:void(0);" class="input-group-addon" id="search_event">
                                        <span class="fa fa-search"></span>
                                    </a>
                                </div>
                                <!-- form-group -->
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel-wrapper collapse in">
                    <table class="table table-hover table-scroll">
                        <thead>
                        <tr>
                            <th class="text-center">S. No.</th>
                            <th>Event Name</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                        </thead>
                        <tbody class="panel-scroll">
                        <?php
                        $i=1;
                        $data = [];
                        while($rowlist=mysql_fetch_array($sql))
                        {
                            $data[] =$rowlist;
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
                                <td><span><?php echo date('d/m/Y', strtotime($rowlist['minoff']));?></span></td>
                                <td><span><?php echo date('d/m/Y', strtotime($rowlist['maxoff']));?></span></td>

                            </tr>
                            <?php
                            $i++;
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
                                    <input placeholder="Holidays" class="form-control input-sm"
                                           id="all_holidays" type="text">
                                    <!---->
                                    <a href="javascript:void(0);" class="input-group-addon" id="search_holidays">
                                        <span class="fa fa-search"></span>
                                    </a>
                                </div>
                            </div>
                            <!-- form-group -->
                        </form>
                    </div>
                </div>
                <div class="panel-wrapper collapse in">
                    <table class="table table-hover table-scroll">
                        <thead>
                        <tr>
                            <th class="text-center">S. No.</th>
                            <th>Holiday</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                        </thead>
                        <tbody class="panel-scroll">
                        <?php
                        $i= 0;
                        $arrays = [];
                        while($row=mysql_fetch_array($sql_holidays))
                        {
                            $arrays[] = $row;
                            $i++;
                            ?>
                            <tr>
                                <td align="center"><?php echo $i; ?></td>
                                <td><?php echo $row['occassion'];?></td>
                                <td><span><?php echo date('d/m/Y', strtotime($row['minoff']));?> </span></td>
                                <td><span><?php echo date('d/m/Y', strtotime($row['maxoff']));?></span></td>
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

<!--event modal en-->
<!-- /#wrapper -->
<!--modal window st-->
<div class="modal" id="Modalevent">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title">Event Details</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
<div class="modal" id="eventModals">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <!--<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>-->
                <h4 class="modal-title">No Record Found</h4>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/foot.php'; ?>
<!--------------------------------FOR AUTO SEARCH EVENT AND HOLIDAYS  YESTERDAY NIGHT 4 A.M-------------------------------------->
<script>
    $(function () {
        var availableHolidays = [
            <?php
            $i = 0;
            $size = count($array);
            foreach($array as $key=>$row){
            echo '"'.$row['occassion'].'"';
            echo ($size==++$i)?'':', ';
            }
             ?>
        ];
        $("#tags").autocomplete({
            source: availableHolidays
        });
    });
    $(document).ready(function () {
        $("#search_data").click(function (event) {
            var holiday = $("#tags").val();
            if (holiday.length == 0) {
                $("#eventModals").find('.modal-body').html('No Record Found');
                $("#eventModals").modal('show');
                return false;
            }
            $.ajax({
                url: "<?php echo HTTP_SERVER; ?>ajax.php?action=event_holidays&session=<?php echo $_SESSION['USER']['DB_NAME']; ?>",
                type: "POST",
                data: {
                    holiday: holiday
                },
                success: function (data) {
                    //console.log(data)
                    if(data == 0){

                        $("#eventModals").find('.modal-body').html(data);
                        $("#eventModals").modal('show');

                    }
                    else{
                        $("#Modalevent").find('.modal-body').html(data);
                        $("#Modalevent").modal('show');
                    }
                }
            });
        });
    });
</script>
<!--------------------------------FOR AUTO SEARCH ALL  EVENT-------------------------------------->
<script>
    $(function () {
        var availableevents = [
            <?php
            $i = 0;
            $size = count($data);
            foreach($data as $key=>$row){
            echo '"'.$row['occassion'].'"';
            echo ($size==++$i)?'':', ';
            }
            ?>
        ];
        $("#all_event").autocomplete({
            source: availableevents
        });
    });

    $(document).ready(function () {
        $("#search_event").click(function (event) {
            var all_event = $("#all_event").val();
            if (all_event.length == 0) {
                $("#eventModals").find('.modal-body').html('No Record Found');
                $("#eventModals").modal('show');
                return false;
            }
            $.ajax({
                url: "<?php echo HTTP_SERVER; ?>ajax.php?action=All_events&session=<?php echo $_SESSION['USER']['DB_NAME']; ?>",
                type: "POST",
                data: {
                    all_event: all_event
                },
                success: function (data) {
                    //console.log(data)
                    if(data == 0){

                        $("#eventModals").find('.modal-body').html(data);
                        $("#eventModals").modal('show');

                    }
                    else{
                        $("#eventModal").find('.modal-body').html(data);
                        $("#eventModal").modal('show');
                    }
                }
            });
        });
    });
</script>

<!--------------------------------FOR AUTO SEARCH ALL  HOLIDAYS-------------------------------------->
<script>
    $(function () {
        var allHolidays = [

            <?php
            $i = 0;
            $size = count($arrays);
            foreach($arrays as $key=>$row){
            echo '"'.$row['occassion'].'"';
            echo ($size==++$i)?'':', ';
            }
             ?>

        ];
        $("#all_holidays").autocomplete({
            source: allHolidays
        });
    });

    $(document).ready(function () {
        $("#search_holidays").click(function (event) {
            var all_holidays = $("#all_holidays").val();
            if (all_holidays.length == 0) {
                $("#eventModals").find('.modal-body').html('No Record Found');
                $("#eventModals").modal('show');
                return false;
            }
            $.ajax({
                url: "<?php echo HTTP_SERVER; ?>ajax.php?action=all_holidays&session=<?php echo $_SESSION['USER']['DB_NAME']; ?>",
                type: "POST",
                data: {
                    all_holidays: all_holidays
                },
                success: function (data) {
                    //console.log(data)
                    if(data == 0){

                        $("#eventModals").find('.modal-body').html(data);
                        $("#eventModals").modal('show');

                    }
                    else{
                        $("#eventModal").find('.modal-body').html(data);
                        $("#eventModal").modal('show');
                    }
                }
            });
        });
    });
</script>
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
