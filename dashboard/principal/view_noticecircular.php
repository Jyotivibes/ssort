<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Principal | View Notice & Circular</title>
    <?php include '../includes/head.php'; ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>    
    <div id="wrapper">
        <?php
        if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Principal') )
        {
            $user_id=$_SESSION['USER']['USER_NAME'];
            require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
            require_once('../../classes/general_class.php');
            $obj = new General();
            $sqlnote=mysql_query("SELECT * FROM  essort_circular_activities WHERE id = '".$_REQUEST['noticeId']."'");
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
                            <li class="active">View Notice & Circulars</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <!--notice circular row st-->
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="my-box">
                            <h3 class="box-title box-title pad-b-10">View Notice & Circulars</h3>
                            <div class="m-t-20">
                               <!--list group st-->
                                <div class="list-group">
                                    <a href="javascript:void(0)" class="list-group-item">
                                        <?php
                                        $row = mysql_fetch_array($sqlnote);
                                        ?>
                                        <h4 class="list-group-item-heading"><?php echo $row['subject']; ?><span class="pull-right"><?php echo $row['date']; ?></span></h4>
                                        <p class="list-group-item-text"><?php echo $row['message']; ?></p>
                                    </a>
                                </div>
                               <!--list group en-->
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

    <!-- /#wrapper -->
    <?php include '../includes/foot.php'; ?>
    <!--Style Switcher -->
    <!--<script src="js/jQuery.style.switcher.js"></script>-->
</body>

</html>