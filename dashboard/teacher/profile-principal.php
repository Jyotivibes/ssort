<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Principal - Profile</title>
    <?php include '../includes/headteacher.php'; ?>
</head>

<body>
<div id="wrapper">
    <!-- Navigation -->
    <?php include'../includes/header-principal.php'; ?>
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
            <!-------------------FOR CIRCULAR ACTIVITIES ON HEADER AND BRADCRUMB---------------------------------->
            <?php include '../includes/header-notice.php'; ?>

            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="my-box">
                        <h3 class="box-title box-title pad-b-10">Profile</h3>
                        <section class="m-t-20">
                            <div class="row">
                                <div class="col-md-2 col-xs-12"><img src="../images/principal_img.jpg" alt="Teacher"
                                                                     class="img-responsive img-rounded img-thumbnail">
                                </div>
                                <div class="col-md-9 col-xs-12">
                                    <div class="panel panel-default">
                                        <!--<div class="panel-heading">Student Contact Details</div>-->
                                        <div class="panel-wrapper collapse in">
                                            <table class="table table-hover">
                                                <tbody>
                                                <tr>
                                                    <td><strong>First Name </strong></td>
                                                    <td>Ms. Monika</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Middle Name </strong></td>
                                                    <td>K</td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Last Name </strong></td>
                                                    <td>Sharma</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Designation </strong></td>
                                                    <td>Principal</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Teaching to </strong></td>
                                                    <td>--</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Contact No </strong></td>
                                                    <td>9582098982</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Gender </strong></td>
                                                    <td>Female</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Date of Birth </strong></td>
                                                    <td>02/09/1976</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Address</strong></td>
                                                    <td>Alpha Administrative Complex Sector 6, Noida</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Marital Status </strong></td>
                                                    <td>Married</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Qualifacation </strong></td>
                                                    <td>B-Ed</td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Total Experience </strong></td>
                                                    <td>8 Years</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Previous Experience </strong></td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td><strong>GNIT Noida</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Assistant Professor</td>
                                                            </tr>
                                                            <tr>
                                                                <td>2 Years 4 Months</td>
                                                            </tr>
                                                        </table>
                                                        <hr/>
                                                        <table>
                                                            <tr>
                                                                <td><strong>Sunlight School</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Professor</td>
                                                            </tr>
                                                            <tr>
                                                                <td>3 Years 6 Months</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <!--col-en-->
        </div>
        <!--stu info en-->
        <!-- .right-sidebar st here-->
    </div>
    <!-- /.container-fluid -->
    <?php include'../includes/footer.php'; ?>
</div>
<!-- /#page-wrapper -->

<!-- /#wrapper -->
<?php include '../includes/footteacher.php'; ?>
<!--Style Switcher -->
<!--<script src="js/jQuery.style.switcher.js"></script>-->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Attendance</h4>
            </div>
            <div class="modal-body">
                In Time
                <input type="text" class="time start" placeholder="HH:MM:SS"/> Out Time
                <input type="text" class="time end" placeholder="HH:MM:SS"/>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
            </div>
        </div>

    </div>
</div>
<!-- Modal -->

</body>

</html>