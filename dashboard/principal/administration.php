<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Principal Administration</title>
    <?php include '../includes/head.php'; ?>

</head>

<body>

<div id="wrapper">
    <?php
    if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Principal')) {
        $user_id = $_SESSION['USER']['USER_NAME'];
        require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
        require_once('../../classes/general_class.php');
        $obj = new General();
        $sqlnote = mysql_query("SELECT * FROM  essort_circular_activities");
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
                <!-- Time for multiple clouds to dance around -->
                <div class="cloud x2"></div>
                <div class="cloud x3"></div>
                <div class="cloud x4"></div>
                <div class="cloud x5"></div>
            </div>

        </div>

        <div class="container-fluid">
            <?php include_once("../includes/header-notice.php"); ?>

            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <div class="my-box-secton">
                        <div class="profile-panel_one1">

                            <div class="row make-gap">
                                <div class="overlay-box principal-staff">
                                    <div class="user-content text-center">
                                        <a href="javascript:void(0)">
                                            <img src="../images/staff-new.png" class="thumb-chairman-lg img-circle"
                                                 alt="img"> </a>
                                        <h4 class="text-white-1">Staff</h4>


                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!--en col-->
                <div class="col-sm-6 col-xs-12">
                    <div class="my-box-secton">
                        <div class="profile-panel_one">

                            <div class="row make-gap">
                                <div class="overlay-box principal-students">
                                    <div class="user-content text-center">
                                        <a href="javascript:void(0)">
                                            <img src="../images/eduaction.png" class="thumb-chairman-lg img-circle"
                                                 alt="img"> </a>
                                        <h4 class="text-white-1">Students</h4>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!--en col-->
                <div class="col-sm-6 col-xs-12">
                    <div class="my-box-secton">
                        <div class="profile-panel_one2">
                            <div class="row make-gap">
                                <div class="overlay-box principal-fees">
                                    <div class="user-content text-center">
                                        <a href="javascript:void(0)">
                                            <img src="../images/rupee.png" class="thumb-chairman-lg img-circle"
                                                 alt="img"> </a>
                                        <h4 class="text-white-1">Fee</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--en col-->
                <div class="col-sm-6 col-xs-12 ">
                    <div class="my-box-secton">
                        <div class="profile-panel_one3">

                            <div class="row make-gap">
                                <div class="overlay-box principal-events">
                                    <div class="user-content text-center">
                                        <a href="javascript:void(0)">
                                            <img src="../images/icons/event.ico" class="thumb-chairman-lg img-circle"
                                                 alt="img"></a>
                                        <h4 class="text-white-1">Events & Notification</h4>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!--en col-->
            </div>

        </div>

    </div>

    <?php include'../includes/footer.php'; ?>
</div>



<?php include '../includes/footteacher.php'; ?>


</body>

</html>