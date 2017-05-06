<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Attendance</title>
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
    $formErr = '';
    if (isset($_REQUEST['SubmitLeave'])) {
        $res = $obj->ADDSTULEAVE();
        if ($res == 3) {
            $formErr = 'Required parameter missing';
            $reurl = 'attendance.php';
            //echo "<script>alert('Required parameter missing');</script>";
            //echo "<script>window.location.href='create-group.php';</script>";
        } else if ($res == 0) {
            $formErr = 'Problem in network.Please try again';
            $reurl = 'attendance.php';
            //echo "<script>alert('Problem in network.Please try again.');</script>";
        } else if ($res == 1) {
            $formErr = 'Leave detail added successfully';
            $reurl = 'attendance.php';
            //echo "<script>alert('Staff detail added successfully.');</script>";
            //echo "<script>window.location.href='manage_staff.php';</script>";
        } else if ($res == 4) {
            $formErr = 'Already Registered with this Email Id';
            $reurl = 'attendance.php';
            //echo "<script>alert('Already Registered with this Email Id');</script>";
            //echo "<script>window.location.href='manage_staff.php';</script>";
        }
    }

} else {
    echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
}
?>
<!-- Navigation -->
<!-- header Navigation st-->
<?php include '../includes/header-configuration.php'?>
<!-- header Navigation en-->
<!-- Left navbar-header -->
<?php include '../includes/sidebar.php'; ?>
<!-- Left navbar-header end -->
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
    <!--stu info st-->
    <div class="row">
        <div class="col-md-8 col-sm-6 col-xs-12">
            <!--graph st-->
            <div class="my-box">
                <div id="barchart" style="width: 100%; height: 366px;"></div>
            </div>
            <!--graph en-->

        </div>
        <!--col-en-->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="my-box  rem-extra">
                <?php //echo $no_of_days_present_session; ?>
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
                                    "value": (<?php echo $no_of_days_present_session; ?>+0)
                                },
                                {
                                    "status": "Absent",
                                    "value": (<?php echo $no_of_days_absent_session; ?>+0)
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

                <!--legend st-->
                <div class="text-center btn-block highchart-legend">
                    <ul class="list-inline">
                        <li><a href="javascript:void(0);"><span class="color-gr"></span> <span class="legend-name">Present</span></a>
                        </li>
                        <li><a href="javascript:void(0);"><span class="color-lorange"></span> <span class="legend-name">Absent</span></a>
                        </li>
                    </ul>
                </div>
                <!--legend en-->
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 head-3">
            <div class="my-box box-2">
                <a href="javascript:void(0)" class="btn btn-block btn-info bord-radius" data-toggle="modal"
                   data-target="#myModal">Apply Leave</a>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="table-bg table-responsive">
                <div class="row m-b-10">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h4>Select Session
                            <select class="input-sm">
                                <option value="2016-2017">2016-2017</option>
                                <option value="2017-2018"<?php if (CURRENT_SESSION=='2017-2018') echo 'selected';?>>2017-2018</option>

                            </select>
                        </h4>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h4 class="pull-right">Session - <?php echo CURRENT_SESSION;?></h4>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr class="thead-bg ">
                        <th>Date</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>11</th>
                        <th>12</th>
                        <th>13</th>
                        <th>14</th>
                        <th>15</th>
                        <th>16</th>
                        <th>17</th>
                        <th>18</th>
                        <th>19</th>
                        <th>20</th>
                        <th>21</th>
                        <th>22</th>
                        <th>23</th>
                        <th>24</th>
                        <th>25</th>
                        <th>26</th>
                        <th>27</th>
                        <th>28</th>
                        <th>29</th>
                        <th>30</th>
                        <th>31</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for ($i = 4; $i < 16; $i++) {

                        $monthNum = $i;
						 $varify_date=date('Y');
                       

                        if ($monthNum == 13) {
                            $varify_date=date('Y', strtotime(' +1 year'));
                            $monthNum = 01;

                        } else if ($monthNum == 14) {
                            $varify_date=date('Y', strtotime(' +1 year'));
                            $monthNum = 02;
                        } else if ($monthNum == 15) {
                             $varify_date=date('Y', strtotime(' +1 year'));
                            $monthNum = 03;
                        } else {
                            $monthNum = $monthNum;
                        }
                        $dateObj = DateTime::createFromFormat('!m', $monthNum);
                        $monthName = $dateObj->format('F');
                        $number = cal_days_in_month(CAL_GREGORIAN, $monthNum, date("Y")); // 31
                        ?>

                        <tr>
                            <td><?php echo $monthName;?></td>
                            <?php
                            for ($y = 1; $y <= $number; $y++) {

                                $date = $varify_date . "-" . $monthNum . "-" . $y;
                                $date = date('Y-m-d', strtotime($date));
                                require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
                                require_once('../../classes/general_class.php');
                                $obj = new General();
                                $status = $obj->getCurrentAttendenece($date, $stuarray[0]['att_ref_id']);
                                if ($status == 'AB') {
                                    $tag = 'absent';
                                } else if ($status == 'PR') {
                                    $tag = 'present';
                                } else if ($status == 'LV') {
                                    $tag = 'cancel';
                                } else {
                                    $tag = 'absent';

                                }
                                ?>
                                <td class="<?php echo $tag; ?>"><?php if($tag == 'present'){
                                    ?>
                                    <a href="#" data-toggle="tooltip" title="In Time">
                                        <?php
                                        }
                                        ?>
                                        <?php echo $status;?>
                                    </a>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--calendar en-->
    </div>
    <!--col-en-->
</div>

</div>
<!-- /.container-fluid -->
<?php include'../includes/footer.php'; ?>
</div>
<!-- /#page-wrapper -->


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Apply Leave</h4>
            </div>
            <form action="" method="post">
                <input type="hidden" class="form-control mydatepicker" name="type" value="student">
                <input type="hidden" class="form-control mydatepicker" name="id"
                       value="<?php echo $stuarray[0]['stu_id']; ?>">

                <div class="modal-body">
                    <div class="col-md-6">
                        <h4>From: </h4>
                        <input type="text" class="form-control mydatepicker" name="fromd">
                    </div>
                    <div class="col-md-6">
                        <h4>To: </h4>
                        <input type="text" class="form-control mydatepicker" name="fromt">
                    </div>


                    <div class="col-md-12">
                        <h4>Reason For Leave:</h4>
                        <textarea class="form-control textarea-resize" name="rforleave"></textarea>
                    </div>


                    <div class="modal-footer-1">
                        <input type="submit" class="btn btn-default-1" name="SubmitLeave" value="Submit">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<!-- Modal -->
<?php include '../includes/foot.php'; ?>
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
</body>
</html>