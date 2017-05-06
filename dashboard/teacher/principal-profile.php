<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Principal Profile</title>
    <?php include '../includes/head.php'; ?>
</head>
<body>
<div id="wrapper">
    <?php
    if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Teacher')) {
        $user_id = $_SESSION['USER']['USER_NAME'];
        require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
        require_once('../../classes/general_class.php');
        $obj = new General();
        include_once 'stastics.php';
        if (isset($_REQUEST['submit'])) {
            $addmessage = $obj->ADDMESSAGE();
            if ($addmessage == 1) {
                echo "<script>alert('Message send')</script>";
            }
        }
    } else {
        echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
    }
    ?>
    <!-- Navigation -->
    <?php include '../includes/header-configuration.php'; ?>
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
            <!-------------------FOR CIRCULAR ACTIVITIES ON HEADER AND BRADCRUMB---------------------------------->
            <?php include '../includes/header-notice.php'; ?>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="my-box">
                        <h3 class="box-title box-title pad-b-10">Profile <a href="#" class="btn btn-color pull-right"
                                                                            data-toggle="modal"
                                                                            data-target="#myMail"><span
                                    class="fa fa-envelope"></span> Email to contact</a></h3>
                        <section class="m-t-20">
                            <div class="row">
                                <div class="col-md-2 col-xs-12">
                                    <!--<img src="../images/<?php /*echo $sqlprincipal['usr_pic']; */?>" alt="Teacher" class="img-responsive img-rounded img-thumbnail">-->
                                    <?php
                                    print_r($sqlprincipal);
                                    $filenamePrincipal = "../images/" . $select_prnc['usr_pic'];
                                    if ($select_prnc['usr_pic'] == "") {
                                        ?>
                                        <img src="../images/images.png"
                                             class="img-responsive img-rounded img-thumbnail"/>
                                    <?php
                                    } elseif (file_exists($filenamePrincipal)) {
                                        ?>
                                        <img src="../images/<?php echo $select_prnc['usr_pic']; ?>" alt="Teacher"
                                             class="img-responsive img-rounded img-thumbnail"/>
                                    <?php
                                    } else {
                                        ?>
                                        <img src="../images/images.png"
                                             class="img-responsive img-rounded img-thumbnail"/>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-md-9 col-xs-12">
                                    <div class="panel panel-default">
                                        <!--<div class="panel-heading">Student Contact Details</div>-->
                                        <div class="panel-wrapper collapse in">
                                            <table class="table table-hover">
                                                <tbody>
                                                <tr>
                                                    <td><strong>First Name </strong></td>
                                                    <td><?php echo $select_prnc['usr_fname']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Middle Name </strong></td>
                                                    <td><?php echo $select_prnc['usr_mname']; ?></td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Last Name </strong></td>
                                                    <td><?php echo $select_prnc['usr_lname']; ?></td>
                                                </tr>

                                                <!--<tr>
															<td><strong>Class Teacher </strong></td>
															<td><?php /*echo $stuarray[0]['class_name'];*/?> - <?php /*echo $stuarray[0]['section_name'];*/?></td>
														</tr>-->

                                                <tr>
                                                    <td><strong>Gender </strong></td>
                                                    <td><?php echo $select_prnc['usr_gender']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Date of Birth </strong></td>
                                                    <td>
                                                        <?php
                                                        if ($select_prnc['usr_dob'] == '') {
                                                            echo "--";
                                                        } else {
                                                            echo date('d-m-Y', strtotime($select_prnc['usr_dob']));
                                                        }

                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Marital Status </strong></td>
                                                    <td><?php echo $select_prnc['usr_marital_status']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Qualification </strong></td>
                                                    <td><?php echo $select_prnc['education']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Total Experience </strong></td>
                                                    <td>
                                                        <?php
                                                        if ($select_prnc['exp_yr'] == '') {
                                                            echo "--";
                                                        } else {
                                                            echo $select_prnc['exp_yr'];
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">

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


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <!--<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Attendance</h4>
                </div>
                <div class="modal-body">
                    In Time
                    <input type="text" class="time start" placeholder="HH:MM:SS" /> Out Time
                    <input type="text" class="time end" placeholder="HH:MM:SS" />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
                </div>
            </div>-->
    </div>
</div>
<!-- Modal -->
<!--mail modal st-->
<div class="modal fade" id="myMail" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Email to contact</h4>
            </div>
            <div class="modal-body">
                <div id="alertmsg"></div>
                <form class="form-horizontal" method="post" enctype="multipart/form-data"
                      action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="from_id" value="<?php echo $_SESSION['USER']['USER_ID']; ?>">
                    <input type="hidden" name="from_role" value="Parent">
                    <input type="hidden" name="to_role" value="Principal">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">To:</label>

                        <div class="col-sm-10">
                            <input type="text" id="to_id" name="to_id" class="form-control"
                                   value="<?php echo $sqlprincipal['usr_email']; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Subject:</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject">
                        </div>
                    </div>
                    <div class="form-group marg-bott">
                        <label for="textarea" class="col-sm-2 control-label">Message:</label>

                        <div class="col-sm-10">
                            <textarea rows="5" id="message" class="message" name="message"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2 col-xs-12"></div>
                            <div class="col-sm-10">
                                <label class="btn btn-link pull-right marg-right">
                                    <span class="fa fa-paperclip"></span>
                                    Attachment <input type="file" id="attach" class="hidden" name="attach">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12 pull-right text-center">
                                <button type="submit" onclick="return emailValid();" name="submit"
                                        class="btn btn-default btn-color border-round"><i class="fa fa-paper-plane"></i>
                                    Send
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--mail modal en-->
<?php include '../includes/foot.php'; ?>
<!--------------FORM VALIDATION--------------------->
<script>
    function emailValid() {
        if ($('#to_id').val() == '') {
            document.getElementById('alertmsg').innerHTML = 'Please insert Email Id';
            $('#to_id').focus();
            return false;
        }
        else if ($('#subject').val() == '') {
            document.getElementById('alertmsg').innerHTML = 'Please insert Subject';
            $('#subject').focus();
            return false;
        }
        else if ($('#message').val() == '') {
            document.getElementById('alertmsg').innerHTML = 'Please insert Message';
            $('#message').focus();
            return false;
        }
        else if ($('#attach').val() == '') {
            document.getElementById('alertmsg').innerHTML = 'Please Attach a file';
            $('#attach').focus();
            return false;
        }

    }
</script>
</body>
</html>