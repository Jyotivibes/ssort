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
if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'SAD')) {
    $user_id = $_SESSION['USER']['USER_NAME'];
    require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
    require_once('../../classes/general_class.php');
    $obj = new General();
    //echo '<script>window.location="http://localhost/sms/dashboard/teacher/teacher.php"</script>';
    $sql = mysql_query("SELECT *,'TOTAL_PRESENT' FROM essort_user_header WHERE usr_role IN ('Teacher')");
    $attregister = array();
    while ($row = mysql_fetch_array($sql)) {
        $date = date('Y-m-d');
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $number = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
        $attregister[$row['usr_fname']] = $row;
        $totalpresent = 0;
        for ($i = 1; $i <= $number; $i++) {
            $attdate = $year . "-" . $month . "-" . $i;
            $attdate = date('Y-m-d', strtotime($attdate));
            $status = $obj->getCurrentAttendenece($attdate, $row['att_ref_id']);
            if ($status == 'AB') {
                $tag = 'absent';
                $status = 'A';
            } else if ($status == 'PR') {
                $tag = 'present';
                $status = 'P';
                $totalpresent++;
            } else if ($status == 'LV') {
                $tag = 'cancel';
                $status = 'L';
            } else {


            }
            $attregister[$row['usr_fname']][$i] = $status;
            $attregister[$row['usr_fname']]['TOTAL_PRESENT'] = $totalpresent;
        }

        //print_r($attregister);
    }

} else {
    echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
}
//$sql=mysql_query("SELECT * FROM essort_user_header WHERE usr_role='Principal' LIMIT 1");
//$row=mysql_fetch_array($sql);
?>
<!-- Navigation -->
<?php include'../includes/header-configuration.php'; ?>
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
        <div class="row bg-title">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting from 15 November 2016.</span>
                </h4>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <ol class="breadcrumb bread-change">
                    <li>
                        <a href="../school-admin/school-admin.php">Dashboard</a>
                    </li>
                    <li class="active">Full Attendance</li>
                </ol>
            </div>
        </div>


        <div class="row">


            <div class="col-sm-12">

                <h3 class="m-b-20">Staff Month Attendance
                    <a href="javascript:void(0)"
                       class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span
                            class="fa fa-backward"></span> Back</a>
                </h3>

                <div class="table-responsive my-box school-tb">


                    <div class="col-sm-4">
                        <select class="form-control attsession" id="attsession">
                            <option value="">Select</option>
                            <option value="2016-2017">2018-2019</option>
                            <option value="2016-2017">2017-2018</option>
                            <option value="2016-2017">2016-2017</option>
                            <option value="2015-2016">2015-2016</option>
                            <option value="2014-2015">2014-2015</option>
                            <option value="2013-2014">2013-2014</option>
                            <option value="2012-2013">2012-2013</option>

                        </select>
                    </div>
                    <div class="col-sm-4"><select class="form-control attsession" id="attmonth">
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select></div>

                    <div class="col-sm-4">
                        <form>
                            <div class="form-group">
                                <div class="input-group">
                                    <input placeholder="Employee name" class="form-control attsession" type="text"
                                           id="emp_name">
                                    <a href="#" class="input-group-addon" data-toggle="modal" data-target="#eventModal">
                                        <span class="fa fa-search"></span>
                                    </a>
                                </div>
                            </div>
                            <!-- form-group -->
                        </form>
                    </div>
                    <table class="table table-bordered" id="attdata">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <!--<th>Emp ID</th>-->
                            <?php
                            for ($i = 1; $i <= $number; $i++) {
                                ?>
                                <th><?php echo $i;?></th>
                            <?php
                            }
                            ?>
                            <th>Total Present</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($attregister as $key => $attvlue) {
                            ?>
                            <tr>
                                <td><?php echo $key;?></td>
                                <!--<td>1001</td>-->
                                <?php
                                for ($i = 1; $i <= $number; $i++) {
                                    if ($attvlue[$i] == 'A') {
                                        $tag = 'warning';
                                    } else if ($attvlue[$i] == 'P') {
                                        $tag = '';
                                    } else if ($attvlue[$i] == 'L') {
                                        $tag = 'info';
                                    } else if ($attvlue[$i] == 'S') {
                                        $tag = 'danger';
                                    } else if ($attvlue[$i] == 'H') {
                                        $tag = 'danger';
                                    }
                                    ?>
                                    <td class="<?php echo $tag; ?>"><?php echo $attvlue[$i];?></td>
                                <?php
                                }
                                ?>
                                <td><?php echo $attvlue['TOTAL_PRESENT']; ?></td>


                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include'../includes/footer.php'; ?>
</div>
<?php include '../includes/foot.php'; ?>
<script>
    $(".attsession").on('change keyup', function (e) {
        var action = 'searchstaffregister';
        var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>';
        var attmonth = $("#attmonth").val();
        var attsession = $("#attsession").val();
        var emp_name = $("#emp_name").val();
        var dataString = 'attsession=' + attsession + '&session=' + session + '&attmonth=' + attmonth + '&emp_name=' + emp_name + '&action=' + action;
//alert(dataString);
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
                        window.location.reload();
                    }
                    else {
                        //alert(data);
                        $("#preloader").css("display", "none");
                        $("#attdata").html(data);
                        //$('.loginform .user').val("");
                        //$('.loginform .password').val("");
                        //window.location.reload();
                    }
                }
            }

        });
    });
    //##############################################################################################
</script>
<script>
    $(document).ready(function () {
        $('#attdata').DataTable({
            paging: false,
            ordering: false,
            searching: false,
            info: false,

//            select: false,
//            select: {
//                info: false
//            }
            dom: 'frtipB',
//            dom: 'B<"clear">lfrtip',
            buttons: {
                buttons: [
                    { extend: 'excel', className: 'btn btn-default', text: 'Download As Excel'},
                    { extend: 'pdfHtml5', orientation: 'landscape',
                        pageSize: 'LEGAL', className: 'btn btn-default', text: 'Download As PDF' }

                ]

            }
//            buttons: [
//                'excel', 'pdf'
//            ]
        });
    });
</script>


</body>

</html>