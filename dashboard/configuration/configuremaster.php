<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | Class Master</title>
    <?php include '../includes/head.php'; ?>
</head>
<body>
<div id="wrapper">
    <?php include '../includes/header-configuration.php'; ?>
    <?php include '../includes/sidebar-configuration.php'; ?>
    <?php
    if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'SAD')) {
        $user_id = $_SESSION['USER']['USER_NAME'];
        require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
        require_once('../../classes/general_class.php');
        $obj = new General();
        //echo '<script>window.location="http://localhost/sms/dashboard/teacher/teacher.php"</script>';
    } else {
        echo "<script>window.location='http://localhost/ssort/index.php';</script>";
    }
    //SELECT SCHOOL NAME

    ?>

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
            <!------------------------FOR NEWS AND NOTIFICATION IN HEADER SECTION------------------->
            <?php include_once("../includes/header-notice.php"); ?>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 my-box">
                    <h1 class="full-panel">
                        <a href="javascript:void(0)"
                           class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span
                                class="fa fa-backward"></span> Back</a>
                    </h1>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>School Name</th>
                                <th><?php echo $resultsch['sch_name'];?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Address</th>
                                <td><?php echo $resultsch['sch_local_address'];?></td>
                            </tr>
                            <tr>
                                <th>Contact No.</th>
                                <td><?php echo $resultsch['sch_contact_phone'];?></td>
                            </tr>
                            <tr>
                                <th>country</th>
                                <td><?php echo $resultsch['sch_country'];?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 my-box">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="master-panel panel-embose create-master">
                                <div class="row make-gap">
                                    <div class="overlay-box">
                                        <div class="user-content text-center">
                                            <a href="javascript:void(0)">
                                                <img src="../images/super_admin.png"
                                                     class="thumb-chairman-sc img-circle" alt="img"> </a>
                                            <h4 class="text-white-1"><b>Create/View Master</b></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--en col-->
                    </div>
                    <!--en row-->

                    <div class="row">

                        <div class="col-sm-3 col-xs-12">
                            <div class="staff-panel panel-embose manage-staff">
                                <div class="row make-gap">
                                    <div class="overlay-box">
                                        <div class="user-content text-center">
                                            <a href="javascript:void(0)">
                                                <img src="../images/staff-new.png" class="thumb-chairman-sc img-circle"
                                                     alt="img"> </a>
                                            <h4 class="text-white-1"><b>Manage Staff</b></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--en col-->
                        <div class="col-sm-3 col-xs-12">
                            <a href="manage_school_details.php">
                                <div class="students-panel panel-embose manage-student">
                                    <div class="row make-gap">
                                        <div class="overlay-box">
                                            <div class="user-content text-center">
                                                <img src="../images/icons/Setting.png"
                                                     class="thumb-chairman-sc img-circle" alt="img">
                                                <h4 class="text-white-1"><b>Manage School Details</b></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <a href="staff-att-entry.php">
                                <div class="students-panel panel-embose manage-student">
                                    <div class="row make-gap">
                                        <div class="overlay-box">
                                            <div class="user-content text-center">
                                                <img src="../images/icons/attendance.png"
                                                     class="thumb-chairman-sc img-circle" alt="img">
                                                <h4 class="text-white-1"><b>Staff Card Number Entry</b></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
						 <div class="col-sm-3 col-xs-12">
                            <a href="student-att-entry.php">
                                <div class="students-panel panel-embose manage-student">
                                    <div class="row make-gap">
                                        <div class="overlay-box">
                                            <div class="user-content text-center">
                                                <img src="../images/icons/attendance.png"
                                                     class="thumb-chairman-sc img-circle" alt="img">
                                                <h4 class="text-white-1"><b>Student Card Number Entry</b></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
						

                    </div>

                </div>
                <!--col-en-->
            </div>
            <!--en row-->
        </div>
    </div>
    <!--en page-wrapper-->
    <?php include'../includes/footer.php'; ?>
</div>
<!--en wrapper-->
<?php include '../includes/foot.php'; ?>
</body>
</html>

