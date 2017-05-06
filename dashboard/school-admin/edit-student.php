<?php include '../../classes/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Configuration | Edit Students</title>
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
        include_once 'stastics.php';
        if (isset($_REQUEST['updatestu'])) {
            $res = $obj->STUUPDATEDETAILS();

            if ($res == 2) {
                echo "<script>alert('Please select only .jpg or .jpeg or .png image');</script>";
                echo "<script>window.location.href='school-notice-circular.php';</script>";
            } else if ($res == 3) {
                echo "<script>alert('Required parameter missing');</script>";
                echo "<script>window.location.href='school-events-notification.php';</script>";
            } else if ($res == 0) {
                echo "<script>alert('Problem in network.Please try again.');</script>";
            } else if ($res == 1) {
                echo "<script>alert('Student Information added successfully.');</script>";
                //echo "<script>window.location.href='registration.php';</script>";
            } else if ($res == 4) {
                echo "<script>alert('Please select Group Logo.');</script>";
                echo "<script>window.location.href='create-group.php';</script>";
            } else if ($res == 5) {
                echo "<script>alert('Please select Chairman Image.');</script>";
                echo "<script>window.location.href='school-notice-circular.php';</script>";
            }
        }
        ############################FIND PARENT CHILDREN ############################################################
        $sqlchild = mysql_query("SELECT *,'class_name','section_name','emp_id' FROM essort_user_relation WHERE stu_id='" . $_REQUEST['stu_id'] . "'");
        $stuarray = array();
        while ($rowstu = mysql_fetch_array($sqlchild)) {
            //Addmission number
            $admno = mysql_fetch_array(mysql_query("SELECT emp_id FROm essort_user_header WHERE usr_id = '".$rowstu['parent_id']."'"));
            $rowstu['emp_id'] = $admno['emp_id'];
            //class name
            $sqlclass = mysql_fetch_array(mysql_query("SELECT class_name FRom essort_classes WHERE class_id='" . $rowstu['class_id'] . "'"));
            $rowstu['class_name'] = $sqlclass['class_name'];
            //Section Name
            $sqlsec = mysql_fetch_array(mysql_query("SELECT section_name FRom essort_section WHERE class_id='" . $rowstu['class_id'] . "' AND section_id='" . $rowstu['sec_id'] . "'"));
            $rowstu['class_name'] = $sqlclass['class_name'];
            $rowstu['section_name'] = $sqlsec['section_name'];
            $stuarray[] = $rowstu;
            //print_r($stuarray);
            //die();
        }
#############################FIND CHILDEREN DATA###################################################################

        foreach ($stuarray as $studata) {
            $sql = mysql_query("SELECT * FROM  essort_application_header WHERE usr_application_id='" . $studata['stu_id'] . "'");
            $stuadata = array();
            while ($rowstudetail = mysql_fetch_array($sql)) {
                $stuadata[] = $rowstudetail;
            }
        }
#############################FIND FATHER CHILDERN DATA###################################################################
        $sqlfather = mysql_fetch_array(mysql_query("SELECT * FROM  essort_application_family_info fi
 INNER JOIN essort_application_header ah
 ON
 fi.usr_application_id = ah.usr_application_id
 WHERE fi.usr_application_id='" . $stuarray[0]['stu_id'] . "' AND ah.usr_application_id='" . $stuarray[0]['stu_id'] . "' AND usr_relation='father' "));
//print_r($sqlfather);
#############################FIND FATHER CHILDERN DATA###################################################################
        $sqlmother = mysql_fetch_array(mysql_query("SELECT * FROM  essort_application_family_info fi
 INNER JOIN essort_application_header ah
 ON
 fi.usr_application_id = ah.usr_application_id
 WHERE fi.usr_application_id='" . $stuarray[0]['stu_id'] . "' AND ah.usr_application_id='" . $stuarray[0]['stu_id'] . "' AND usr_relation='mother'"));

        $sqlguardian = mysql_fetch_array(mysql_query("SELECT * FROM  essort_application_family_info fi
 INNER JOIN essort_application_header ah
 ON
 fi.usr_application_id = ah.usr_application_id
 WHERE fi.usr_application_id='" . $stuarray[0]['stu_id'] . "' AND ah.usr_application_id='" . $stuarray[0]['stu_id'] . "' AND usr_relation='guardian'"));

#############################FIND CLASS TEACHER###################################################################
        $sqlclassteacher = mysql_fetch_array(mysql_query("SELECT staff_id FROM  essort_teacher_class WHERE class_id='" . $stuarray[0]['class_id'] . "' AND section_id='" . $stuarray[0]['sec_id'] . "' AND is_classteacher='1'"));
##################################################FOR CLASS TEACHER#######################################################
        $classteacherdata = mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header as a JOIN essort_user_details as b ON a.usr_id=b.usr_id WHERE a.usr_id='" . $sqlclassteacher['staff_id'] . "'"));
    }
    else {
        echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
    }
    ?>
    <?php include '../includes/header-configuration.php'; ?>
    <!--sidebar nav st-->
    <?php include '../includes/sidebar-school.php'; ?>
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
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 my-box">
                <h3 class="m-b-20">Edit Student Details
                    <a href="javascript:void(0)" class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span
                            class="fa fa-backward"></span> Back
                    </a>
                </h3>
                <form method="post" name="stuform" action="" enctype="multipart/form-data" class="stuform"
                      onsubmit="return validateStudent();">
                    <div id="alertstumsg"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a>
                                    Student Information
                                </a>
                            </h4>
                        </div>
                        <div class="panel-body">
                            <fieldset class="newFieldset">
                                <legend class="legendText">Student Information</legend>
                                <div class="row">
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">First Name</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input class="form-control input-sm first_name" value="<?php echo $stuadata[0]['usr_fname']; ?>" type="text" name="first_name"/>
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Middle Name</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input class="form-control input-sm middle_name"  value="<?php echo $stuadata[0]['usr_mname']; ?>"  type="text" name="middle_name"/>
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Last Name</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input class="form-control input-sm last_name" value="<?php echo $stuadata[0]['usr_lname']; ?>"  type="text" name="last_name"/>
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input class="form-control input-sm email"  value="<?php echo $stuadata[0]['usr_email']; ?>" type="text" name="email" id="email"/>
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->
                                </div>
                                <!--en row-->

                                <div class="row">
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">DOB</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                <input class="form-control  mydatepicker input-sm dob" value="<?php echo $stuadata[0]['usr_dob']; ?>"  type="text" name="dob"/>
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Birth Place</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                                <input class="form-control input-sm birth_place"  value="<?php echo $stuadata[0]['usr_birth_place']; ?>" name="birth_place" type="text"/>
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Class ID</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <!-- <input class="form-control input-sm" placeholder="Class ID" type="text" name="class"/>-->
                                                <select class="form-control input-sm class" name="class">
                                                    <option value="<?php echo $sqlclass['class_name']; ?>"><?php echo $sqlclass['class_name']; ?></option>
                                                    <?php echo $class;?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Religion</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-users"></i></div>
                                                <input class="form-control input-sm religion" value="<?php echo $stuadata[0]['usr_religion']; ?>" type="text" name="religion"/>
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->
                                </div>
                                <!--en row-->

                                <div class="row">
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Gender</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                <select class="form-control input-sm class" name="gender">
                                                    <option value="<?php echo $stuadata[0]['usr_gender']; ?>"><?php echo $stuadata[0]['usr_gender']; ?></option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Profile Image</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-image"></i></div>
                                                <input type="file" name="image" class="form-control input-sm class" id="fileChooser">
                                                <input type="hidden" name="old_stu_img" value="<?php echo $stuadata[0]['usr_photo']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--en row-->
                            </fieldset>
                        </div>
                    </div>
                    <div class="panel panel-default">
                    <!--<div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                Family Information
                            </a>
                        </h4>
                    </div>-->

                    <!--<div id="collapseTwo" class="panel-collapse collapse">-->
                    <div class="panel-body">
                    <fieldset class="newFieldset m-t-20">
                        <legend class="legendText">Family Information</legend>
                        <!--father info st-->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <fieldset class="newFieldset">
                        <legend class="legendText">Father Information</legend>
                    <!-----------------------------CHANGES START FOR MOTHER------------------------------------>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Initial</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                    <input class="form-control input-sm father_initial" type="text"
                                           value="<?php echo $sqlfather['usr_r_initial'] ?>"  name="father_initial" />
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                    <input class="form-control input-sm father_first_name " value="<?php echo $sqlfather['usr_r_name'] ?>" type="text" name="father_first_name"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                    </div>
                    <!--en row-->
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Middle Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                    <input class="form-control input-sm father_middle_name" value="<?php echo $sqlfather['usr_r_mname'] ?>" type="text" name="father_middle_name"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                    <input class="form-control input-sm father_last_name" value="<?php echo $sqlfather['usr_r_lname'] ?>" type="text" name="father_last_name"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                    </div>
                    <!--en row-->
                    <!-----------------------------CHANGES STOP FOR FATHER------------------------------------>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Email Id</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    <input class="form-control input-sm father_email" value="<?php echo $sqlfather['usr_r_email'] ?>" type="text" name="father_email" id="father_email"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Age</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                    <input class="form-control input-sm father_age" value="<?php echo $sqlfather['usr_r_age'] ?>" type="text" name="father_age"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Qualification</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                    <input class="form-control input-sm father_qualification" value="<?php echo $sqlfather['usr_r_qualification'] ?>" type="text" name="father_qualification"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--en row-->
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Occupation</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-briefcase"></i></div>
                                    <input class="form-control input-sm father_occupation" value="<?php echo $sqlfather['usr_r_occupatrion'] ?>" type="text" name="father_occupation"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Designation</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input class="form-control input-sm father_designation" value="<?php echo $sqlfather['usr_r_designation'] ?>" type="text" name="father_designation"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                    </div>
                    <!--en row-->
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Organization Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                    <input class="form-control input-sm father_organization" value="<?php echo $sqlfather['usr_r_org_name'] ?>" type="text" name="father_organization"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Office Address</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                    <input class="form-control input-sm off_address" value="<?php echo $sqlfather['usr_r_office_address'] ?>" type="text"
                                           name="off_address"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                    </div>
                    <!--en row-->
                    <!------------------------------------STRAT CODE CHANGES--------------------------------------->
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Office Area</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                    <input class="form-control input-sm father_area" value="<?php echo $sqlfather['usr_r_offc_area'] ?>" type="text" name="father_area"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Office City</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                    <input class="form-control input-sm off_city" value="<?php echo $sqlfather['usr_r_offc_city'] ?>" type="text" name="off_city"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Office State</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                    <input class="form-control input-sm off_state" value="<?php echo $sqlfather['usr_r_offc_state'] ?>" type="text" name="off_state"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--en row-->
                    <!------------------------------------END CODE CHANGES--------------------------------------->
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Office Timing</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                    <input class="form-control input-sm off_time" value="<?php echo $sqlfather['usr_r_office_timings'] ?>" type="text" name="off_time"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Office Contact</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input class="form-control input-sm f_office_contact" value="<?php echo $sqlfather['usr_r_office_contact_no'] ?>" type="text" name="f_office_contact"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                    </div>
                    <!--en row-->

                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Monthly Income</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-inr"></i></div>
                                    <input class="form-control input-sm f_monthly_income" value="<?php echo $sqlfather['usr_r_monthly_income'] ?>" type="text" name="f_monthly_income"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Role</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input class="form-control input-sm f_role" value="<?php echo $sqlfather['usr_r_role'] ?>" type="text" name="f_role"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                    </div>
                    <!--en row-->

                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Mother Tongue</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                    <input class="form-control input-sm father_tongue" value="<?php echo $sqlfather['usr_r_mother_tounge'] ?>" type="text" name="father_tongue"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Primary Contact</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input class="form-control input-sm f_primary_contact" onkeypress="return isNumber(event)" value="<?php echo $sqlfather['usr_r_primary_contact'] ?>" type="text" name="f_primary_contact" id="f_primary_contact"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                    </div>
                    <!--en row-->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Alternate Contact</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input class="form-control input-sm f_alt_contact" value="<?php echo $sqlfather['usr_r_alter_contact'] ?>" type="text"  name="f_alt_contact"/>
                                </div>
                                <label for="">Father Image</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-image"></i></div>
                                    <input type="file" name="f_image" class="form-control input-sm class">
                                    <input type="hidden" name="old_fath_img" value="<?php echo $sqlfather['usr_r_image']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--en row-->
                    </fieldset>
                    </div>
                    <!--en col-->
                    <!--father info en-->

                    <!--mother info st-->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <fieldset class="newFieldset">
                    <legend class="legendText">Mother Information</legend>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Initial</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-female"></i></div>
                                    <input class="form-control input-sm mother_initial" placeholder="Initial" type="text"
                                           name="mother_initial"value="<?php echo $sqlmother['usr_r_initial']; ?>" />
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <!------------------------------------CHANGES START FOR MOTHER------------------------------------------------>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">First Name</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-female"></i></div>
                                    <input class="form-control input-sm mother_fname" value="<?php echo $sqlmother['usr_r_name']; ?>" type="text" name="mother_fname"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                    </div>
                    <!--en row-->
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Middle Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-female"></i></div>
                                    <input class="form-control input-sm mother_mname" value="<?php echo $sqlmother['usr_r_mname'] ?>" type="text" name="mother_mname"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-female"></i></div>
                                    <input class="form-control input-sm mother_lname" value="<?php echo $sqlmother['usr_r_lname'] ?>" type="text" name="mother_lname"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                    </div>
                    <!--en row-->
                    <!------------------------------------CHANGES END FOR MOTHER------------------------------------------------>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Email Id</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    <input class="form-control input-sm m_email" value="<?php echo $sqlmother['usr_r_email'] ?>" type="text" name="m_email" id="m_email"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Age</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                    <input class="form-control input-sm m_age" value="<?php echo $sqlmother['usr_r_age'] ?>" type="text" name="m_age"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Qualification</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                    <input class="form-control input-sm m_qualification" value="<?php echo $sqlmother['usr_r_qualification'] ?>" type="text"  name="m_qualification"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--en row-->

                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Occupation</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-briefcase"></i></div>
                                    <input class="form-control input-sm m_occupation" value="<?php echo $sqlmother['usr_r_occupatrion'] ?>" type="text" name="m_occupation"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Designation</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input class="form-control input-sm m_designation" value="<?php echo $sqlmother['usr_r_designation'] ?>" type="text" name="m_designation"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                    </div>
                    <!--en row-->

                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Organization Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                    <input class="form-control input-sm m_org" value="<?php echo $sqlmother['usr_r_org_name'] ?>" type="text" name="m_org"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Office Address</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                    <input class="form-control input-sm m_ofc_add" value="<?php echo $sqlmother['usr_r_office_address'] ?>" type="text" name="m_ofc_add"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                    </div>
                    <!--en row-->
                    <!------------------------------------STRAT CODE CHANGES--------------------------------------->
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Office Area</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                    <input class="form-control input-sm mother_area" value="<?php echo $sqlmother['usr_r_offc_area'] ?>" type="text" name="mother_area"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Office City</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                    <input class="form-control input-sm off_m_city" value="<?php echo $sqlmother['usr_r_offc_city'] ?>" type="text" name="off_m_city"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Office State</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                    <input class="form-control input-sm off_m_state" value="<?php echo $sqlmother['usr_r_offc_state'] ?>" type="text" name="off_m_state"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--en row-->
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Office Timing</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                    <input class="form-control input-sm m_ofc_time" value="<?php echo $sqlmother['usr_r_office_timings'] ?>" type="text" name="m_ofc_time"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Office Contact</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input class="form-control input-sm m_ofc_contact" value="<?php echo $sqlmother['usr_r_office_contact_no'] ?>" type="text" name="m_ofc_contact"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                    </div>
                    <!--en row-->
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Monthly Income</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-inr"></i></div>
                                    <input class="form-control input-sm m_monthly_income" value="<?php echo $sqlmother['usr_r_monthly_income'] ?>" type="text" name="m_monthly_income"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Role</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input class="form-control input-sm m_ofc_role" value="<?php echo $sqlmother['usr_r_role'] ?>" type="text" name="m_ofc_role"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                    </div>
                    <!--en row-->
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Mother Tongue</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                    <input class="form-control input-sm m_tongue" value="<?php echo $sqlmother['usr_r_mother_tounge'] ?>" type="text" name="m_tongue"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Primary Contact</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input class="form-control input-sm m_pri_conact" onkeypress="return isNumber(event)" value="<?php echo $sqlmother['usr_r_primary_contact'] ?>" type="text" name="m_pri_conact" id="m_pri_conact"/>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                    </div>
                    <!--en row-->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Alternate Contact</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input class="form-control input-sm m_alt_contact" value="<?php echo $sqlmother['usr_r_alter_contact'] ?>" type="text" name="m_alt_contact"/>
                                </div>
                                <label for="">Mother Image</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-image"></i></div>
                                    <input type="file" name="m_image" class="form-control input-sm class">
                                    <input type="hidden" name="old_moth_img" value="<?php echo $sqlmother['usr_r_image']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--en col-3-->
                    </fieldset>
                    </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <fieldset class="newFieldset">
                        <legend class="legendText">Guardian Information</legend>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Initial</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                        <input class="form-control input-sm guardian_initial" placeholder="Initial" type="text"
                                               name="guardian_initial" value="<?php echo $sqlguardian['usr_r_initial']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                        <input class="form-control input-sm guardian_fname"  value="<?php echo $sqlguardian['usr_r_name']; ?>" type="text"  name="guardian_fname"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                        </div>
                        <!--en row-->
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Middle Name</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                        <input class="form-control input-sm guardian_mname"  value="<?php echo $sqlguardian['usr_r_mname']; ?>" type="text" name="guardian_mname"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Last Name</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                        <input class="form-control input-sm guardian_lname"  type="text"
                                        value="<?php echo $sqlguardian['usr_r_lname']; ?>"  name="guardian_lname"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Email Id</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                        <input class="form-control input-sm guardian_email"  value="<?php echo $sqlguardian['usr_r_email']; ?>" type="text" name="guardian_email" />
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Age</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                        <input class="form-control input-sm guardian_age"  value="<?php echo $sqlguardian['usr_r_age']; ?>" type="text"  name="guardian_age"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Qualification</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                        <input class="form-control input-sm guardian_qualification" value="<?php echo $sqlguardian['usr_r_qualification']; ?>"  type="text" name="guardian_qualification"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--en row-->

                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Occupation</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-briefcase"></i></div>
                                        <input class="form-control input-sm guardian_occupation"  value="<?php echo $sqlguardian['usr_r_occupatrion']; ?>" type="text" name="guardian_occupation"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Designation</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input class="form-control input-sm guardian_designation"  value="<?php echo $sqlguardian['usr_r_designation']; ?>" type="text"  name="guardian_designation"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                        </div>
                        <!--en row-->

                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Organization Name</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                        <input class="form-control input-sm guardian_org"  value="<?php echo $sqlguardian['usr_r_org_name']; ?>" type="text" name="guardian_org"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Office Address</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                        <input class="form-control input-sm guardian_ofc_add"  value="<?php echo $sqlguardian['usr_r_office_address']; ?>" type="text" name="guardian_ofc_add"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                        </div>
                        <!--en row-->

                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Office Area</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                        <input class="form-control input-sm guardian_area"  value="<?php echo $sqlguardian['usr_r_offc_area']; ?>" type="text" name="guardian_area"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Office City</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                        <input class="form-control input-sm off_guardian_city"  value="<?php echo $sqlguardian['usr_r_offc_city']; ?>" type="text"  name="off_guardian_city"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Office State</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                        <input class="form-control input-sm off_guardian_state"  value="<?php echo $sqlguardian['usr_r_offc_state']; ?>" type="text" name="off_guardian_state"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--en row-->
                        <!------------------------------------END CODE CHANGES--------------------------------------->

                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Office Timing</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                        <input class="form-control input-sm guardian_ofc_time"  value="<?php echo $sqlguardian['usr_r_office_timings']; ?>" type="text" name="guardian_ofc_time"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Office Contact</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input class="form-control input-sm guardian_ofc_contact"  value="<?php echo $sqlguardian['usr_r_office_contact_no']; ?>" type="text"  name="guardian_ofc_contact"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                        </div>
                        <!--en row-->

                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Monthly Income</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-inr"></i></div>
                                        <input class="form-control input-sm guardian_monthly_income"  value="<?php echo $sqlguardian['usr_r_monthly_income']; ?>" type="text" name="guardian_monthly_income"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Role</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input class="form-control input-sm guardian_ofc_role"  value="<?php echo $sqlguardian['usr_r_role']; ?>" type="text"  name="guardian_ofc_role"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                        </div>
                        <!--en row-->

                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Mother Tongue</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                        <input class="form-control input-sm guardian_tongue"  value="<?php echo $sqlguardian['usr_r_mother_tounge']; ?>" type="text" name="guardian_tongue"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Primary Contact</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input class="form-control input-sm guardian_pri_conact" onkeypress="return isNumber(event)"  value="<?php echo $sqlguardian['usr_r_primary_contact']; ?>" type="text" name="guardian_pri_conact" id="guardian_pri_conact"/>
                                    </div>
                                </div>
                            </div>
                            <!--en col-3-->
                        </div>
                        <!--en row-->

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Alternate Contact</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input class="form-control input-sm guardian_alt_contact"  value="<?php echo $sqlguardian['usr_r_alter_contact']; ?>" type="text" name="guardian_alt_contact"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--en col-3-->
                        </fieldset>
                        </div>
                    </fieldset>
                        </div>
                    <div class="panel panel-default">
                    <div class="panel-body">
                    <fieldset class="newFieldset m-t-20">
                    <legend class="legendText">Address Information</legend>
                    <!--father info st-->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <fieldset class="newFieldset">
                            <legend class="legendText">Residential Address</legend>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Local Address</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                            <input class="form-control input-sm" value="<?php echo $stuadata[0]['user_resident_local_address']; ?>" type="text" name="r_local_addr"/>
                                        </div>
                                    </div>
                                </div>
                                <!--en col-3-->
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Area Address</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                            <input class="form-control input-sm" value="<?php echo $stuadata[0]['user_resident_area_address']; ?>" type="text" name="r_area"/>
                                        </div>
                                    </div>
                                </div>
                                <!--en col-3-->
                            </div>
                            <!--en row-->

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">City</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-street-view"></i></div>
                                            <input class="form-control input-sm" value="<?php echo $stuadata[0]['user_resident_city']; ?>" type="text" name="r_city"/>
                                        </div>
                                    </div>
                                </div>
                                <!--en col-3-->
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">State</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map-signs"></i></div>
                                            <input class="form-control input-sm" value="<?php echo $stuadata[0]['user_resident_state']; ?>" type="text"
                                                   name="r_state"/>
                                        </div>
                                    </div>
                                </div>
                                <!--en col-3-->
                            </div>
                            <!--en row-->

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Pin</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-thumb-tack"></i></div>
                                            <input class="form-control input-sm" value="<?php echo $stuadata[0]['user_resident_pin']; ?>" type="text" name="r_pin"/>
                                        </div>
                                    </div>
                                </div>
                                <!--en col-3-->
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Country</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map"></i></div>
                                            <input class="form-control input-sm" value="<?php echo $stuadata[0]['user_resident_country']; ?>" type="text"  name="r_country"/>
                                        </div>
                                    </div>
                                </div>
                                <!--en col-3-->
                            </div>
                            <!--en row-->

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Contact Number</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input class="form-control input-sm" onkeypress="return isNumber(event)" value="<?php echo $stuadata[0]['user_resident_contact_no']; ?>" type="text" name="r_contact"/>
                                        </div>
                                    </div>
                                </div>
                                <!--en col-3-->
                            </div>
                            <!--en row-->
                        </fieldset>
                    </div>
                    <!--en col-->
                    <!--father info en-->

                    <!--mother info st-->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <fieldset class="newFieldset">
                            <legend class="legendText">Communication Address</legend>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Local Address</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                            <input class="form-control input-sm" value="<?php echo $stuadata[0]['user_comm_local_address']; ?>" type="text" name="c_local_addr"/>
                                        </div>
                                    </div>
                                </div>
                                <!--en col-3-->
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Area Address</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                            <input class="form-control input-sm" value="<?php echo $stuadata[0]['user_comm_area_address']; ?>" type="text" name="c_area"/>
                                        </div>
                                    </div>
                                </div>
                                <!--en col-3-->
                            </div>
                            <!--en row-->

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">City</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-street-view"></i></div>
                                            <input class="form-control input-sm" value="<?php echo $stuadata[0]['user_comm_city']; ?>" type="text" name="c_city"/>
                                        </div>
                                    </div>
                                </div>
                                <!--en col-3-->
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">State</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map-signs"></i></div>
                                            <input class="form-control input-sm" value="<?php echo $stuadata[0]['user_comm_state']; ?>" type="text" name="c_state"/>
                                        </div>
                                    </div>
                                </div>
                                <!--en col-3-->
                            </div>
                            <!--en row-->

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Pin</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-thumb-tack"></i></div>
                                            <input class="form-control input-sm" value="<?php echo $stuadata[0]['user_comm_pin']; ?>" type="text"  name="c_pin"/>
                                        </div>
                                    </div>
                                </div>
                                <!--en col-3-->
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Country</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map"></i></div>
                                            <input class="form-control input-sm" value="<?php echo $stuadata[0]['user_comm_country']; ?>" type="text" name="c_country"/>
                                        </div>
                                    </div>
                                </div>
                                <!--en col-3-->
                            </div>
                            <!--en row-->

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Contact Number</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input class="form-control input-sm" onkeypress="return isNumber(event)" value="<?php echo $stuadata[0]['user_comm_contact_no']; ?>" type="text"  name="c_contact"/>
                                        </div>
                                    </div>
                                </div>
                                <!--en col-3-->
                            </div>
                            <!--en row-->
                        </fieldset>
                    </div>
                    <!--en col-->
                    <!--mother info en-->
                    </fieldset>
                    </div>
                    </div>
                    <div class="panel panel-default">
                        <!--<div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                    Student Medical Information
                                </a>
                            </h4>
                        </div>-->

                        <!--<div id="collapseFour" class="panel-collapse collapse">-->
                            <div class="panel-body">
                                <fieldset class="newFieldset m-t-20">
                                    <legend class="legendText">Student Medical Information</legend>
                                    <div class="row">
                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Blood Group</label>

                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="glyphicon glyphicon-tint"></i></div>
                                                    <input class="form-control input-sm blood_group" value="<?php echo $stuadata[0]['user_blood_group'];?>" type="text" name="blood_group"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--en col-3-->
                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Height</label>

                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="glyphicon glyphicon-tint"></i></div>
                                                    <input class="form-control input-sm height" value="<?php echo $stuadata[0]['user_height'];?>" type="text" name="height"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--en col-3-->
                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Weight</label>

                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="glyphicon glyphicon-tint"></i></div>
                                                    <input class="form-control input-sm weight" value="<?php echo $stuadata[0]['user_weight'];?>" type="text" name="weight"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--en col-3-->
                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Allergies</label>

                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-user-md"></i></div>
                                                    <input class="form-control input-sm alergy" value="<?php echo $stuadata[0]['user_allergies'];?>" type="text" name="alergy"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--en col-3-->
                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Illness</label>

                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-medkit"></i></div>
                                                    <input class="form-control input-sm illness" value="<?php echo $stuadata[0]['user_Illness'];?>" type="text"  name="illness"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--en col-3-->
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Emergency Treatment</label>

                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-ambulance"></i></div>
                                                    <input class="form-control input-sm eme_treat" value="<?php echo $stuadata[0]['user_emergency_treatment'];?>" type="text" name="eme_treat"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--en col-3-->
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="">Medication</label>

                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-stethoscope"></i></div>
                                                    <input class="form-control input-sm medication" value="<?php echo $stuadata[0]['user_medication'];?>" name="medication"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--en col-3-->
                                    </div>
                                    <!--en row-->
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm text-center">
                            <!--<button type="submit" class="btn btn-success btn-theme m-r-10 bord-radius">Submit</button>-->
                            <input type="submit" class="btn btn-success btn-theme m-r-10 bord-radius" value="Update" name="updatestu">
                            <a href=""><button class="btn btn-inverse bord-radius">Cancel</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include'../includes/footer.php'; ?>
<?php include '../includes/footadmin.php'; ?>
</body>
</html>