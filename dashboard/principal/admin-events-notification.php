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
</head>

<body>
<div id="wrapper">
    <?php
    $message ='';
    if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Principal')) {
        $user_id = $_SESSION['USER']['USER_NAME'];
        $user_role = $_SESSION['USER']['ROLE_ID'];
        require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
        require_once('../../classes/general_class.php');
        require_once('../../classes/config.php');
        $obj = new General();
        include_once 'stastics.php';
        ######################################FOR EVENT APPROVAL START##################################################
        if (isset($_REQUEST['event_aprove'])) {
            $res = $obj->APPROVEHOLIDAY();

            if ($res == 0) {
                $formErr = 'Problem in network.Please try again';
            } else if ($res == 1) {
                $message = 'Event Approved successfully.';
            }
        }
        ######################################FOR EVENT APPROVAL END##################################################
    } else {
        echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
    }
    ?>
    <!-- Navigation -->
    <?php include'../includes/header-configuration.php'; ?>
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
            <div class="row bg-title">
               <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <?php include_once("../includes/header-notice-circular.php"); ?>
                    </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    <ol class="breadcrumb bread-change">
                        <li>
                            <a href="<?php echo DASHBOARD_LINK;?>">Dashboard</a>
                        </li>
                        <li class="active">Events & Holidays</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>


            <!--stu info st-->
            <div class="row">
                <div class="col-xs-12 my-box">
                    <h5><b>Event & Notifications</b></h5>

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
                            if(count($holarray) != 0){
                                foreach ($holarray as $cirvalue) {
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
                                                <?php
                                                if($cirvalue['status'] == 1){
                                                    ?>
                                                    <span class="btn btn-success" id="">Approved</span>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="submit" class="btn btn-info" value="Approve" id="event_aprove" name="event_aprove">
                                                    <?php
                                                }
                                                ?>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                            }
                            else{
                                ?>
                                <tr>
                                    <td colspan="6" class="text-center">No Record Found</td>
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
        </div>
        <!--col-en-->
    </div>
    <!--stu info en-->

    <?php include'../includes/footer.php'; ?>
</div>
<!-- /#page-wrapper -->

<!-- /#wrapper -->
<?php include '../includes/foot.php'; ?>

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
<?php
#Show form  message
if( $message!="" )
{
    ?>
    <script>
        $('#eventholiday').text('Event Approval');
        $('#message').html("<?php echo $message; ?>");
        $('#EventApproveModal').modal('show');
    </script>
<?php
}
?>
</body>
</html>