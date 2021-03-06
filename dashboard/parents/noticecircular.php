<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Notice & Circular</title>
    <?php include '../includes/head.php'; ?>
</head>
<body>

<div id="wrapper">
    <?php

    if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Parent')) {
        $user_id = $_SESSION['USER']['USER_NAME'];
        require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
        require_once('../../classes/general_class.php');
        $obj = new General();
        include_once 'stastics.php';
    } else {
        echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
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
                <!-- Time for multiple clouds to dance around -->
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
                        <h3 class="box-title box-title pad-b-10">Notice & Circulars</h3>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="ui-widget">
                                    <input placeholder="Search circular" class="form-control input-sm"
                                           id="notice_circular" type="text">
                                </div>
                                <!---->
                                <a href="javascript:void(0);" class="input-group-addon" id="search_notice">
                                    <span class="fa fa-search"></span>
                                </a>
                            </div>
                        </div>
                        <!-- form-group -->

                        <div class="m-t-20">
                            <!--table st-->
                            <div class="table-responsive color-table info-table overflow_remove">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Notice/Circular</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($cirarray as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo date('d-m-Y', strtotime($row['date']));?></td>
                                            <td>
                                                <?php
                                                if (strlen($row['subject']) > 30) {
                                                    echo substr($row['subject'], 0, 30) . ". . .";
                                                } else {
                                                    echo $row['subject'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);">
                                                    <a data-toggle="modal" class="getdata"
                                                       data-href="<?php echo $row['attachment']; ?>"
                                                       data-subject="<?php echo $row['subject']; ?>"
                                                       data-id="<?php echo $row['message']; ?>"
                                                       data-date="<?php echo date('d-m-Y', strtotime($row['date'])); ?>">
                                                        <i style="cursor: pointer; cursor: hand;" class="fa fa-eye"></i></a>
                                                    <?php
                                                    if ($row['attachment'] != '') {
                                                        ?>
                                                        <a href="../school-admin/uploads/<?php echo $row['attachment']; ?>"
                                                           target="_blank">
                                                            <span class="glyphicon glyphicon-download-alt">  </span>
                                                        </a>
                                                    <?php
                                                    }
                                                    ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!--table en-->
                        </div>
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
<!-- /#page-wrapper -->

<!--view modal st-->
<!--latest circular st-->

<!--latest circular en-->

<!--view modal en-->

<!-- /#wrapper -->
<!--modal window st-->
<div class="modal" id="eventModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title">Notice Circular</h4>
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
<script>
    $(".getdata").click(function () {
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
        $("#myViewmodal").modal('show');
    });
</script>
<!-- /#page-wrapper -->
<div class="modal fade" id="myViewmodal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="subject_message">Did this Notice & Circulars is relevent</h4>
            </div>
            <div class="modal-body">
                <p id="date"></p>

                <p class="text-justify" id="success_message"></p>
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
    $(document).ready(function () {
        $("[id^='activity_']").click(function () {
            var linkId = $(this).attr('id').split('_');
            $.ajax({
                type: 'POST',
                url: 'ajax/parents.php',
                data: {action: 'showCirclularAct', id: linkId[1]},
                success: function (result) {
                    $("#showCircularModal").html(result);
                    $("#latestCircular").modal('show');
                }
            });
        });
    });
</script>
<!--Style Switcher -->
<!--<script src="js/jQuery.style.switcher.js"></script>-->
<!--------------------------------FOR AUTO SEARCH EVENT AND HOLIDAYS  YESTERDAY NIGHT 4 A.M-------------------------------------->
<script>
    $(function () {
        var noticecircular = [
            <?php
            $i = 0;
            $size = count($cirarray);
            foreach($cirarray as $key=>$row){
            echo '"'.$row['subject'].'"';
            echo ($size==++$i)?'':', ';
            }
             ?>
        ];
        $("#notice_circular").autocomplete({
            source: noticecircular
        });
    });
    $(document).ready(function () {
        $("#search_notice").click(function (event) {
            var notice_circular = $("#notice_circular").val();
            if (notice_circular.length == 0) {
                $("#eventModal").find('.modal-body').html('No Record Found');
                $("#eventModal").modal('show');
                return false;
            }
            $.ajax({
                url: "ajax_search/getHolidays.php?call=notice_circular",
                type: "POST",
                data: {
                    notice_circular: notice_circular
                },
                success: function (data) {
                    //console.log(data)
                    if (data == 0) {

                        $("#eventModals").find('.modal-body').html(data);
                        $("#eventModals").modal('show');

                    }
                    else {
                        $("#eventModal").find('.modal-body').html(data);
                        $("#eventModal").modal('show');
                    }


                }
            });
        });
    });
</script>
</body>
</html>
