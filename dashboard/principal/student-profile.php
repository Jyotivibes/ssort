<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Profile</title>
    <?php include '../includes/head.php'; ?>
</head>
<body>

<div id="wrapper">
<?php
//error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);
if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Principal')) {
    $user_id = $_SESSION['USER']['USER_ID'];
    require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
    require_once('../../classes/general_class.php');
    $obj = new General();
    ############################FIND PARENT CHILDREN ############################################################
    $sqlchild = mysql_query("SELECT *,'class_name','section_name' FROM essort_user_relation WHERE stu_id='" . $_REQUEST['stu_id'] . "'");
    $stuarray = array();
    while ($rowstu = mysql_fetch_array($sqlchild)) {
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

#############################FIND CLASS TEACHER###################################################################
    $sqlclassteacher = mysql_fetch_array(mysql_query("SELECT staff_id FROM  essort_teacher_class WHERE class_id='" . $stuarray[0]['class_id'] . "' AND section_id='" . $stuarray[0]['sec_id'] . "' AND is_classteacher='1'"));
##################################################FOR CLASS TEACHER#######################################################
    $classteacherdata = mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header as a JOIN essort_user_details as b ON a.usr_id=b.usr_id WHERE a.usr_id='" . $sqlclassteacher['staff_id'] . "'"));

    ###########################SENDM######################################################
    if (isset($_REQUEST['SendM'])) {
        //echo "<script>alert('Hello');</script>";
        $addmessage = $obj->ADDMESSAGE();
        if ($addmessage == 1) {
            echo "<script>alert('Message send')</script>";
        } else {
            echo mysql_error();
        }
    }
    #########################FOR SEND SMS#####################
    if(isset($_POST['submitsms'])){
        include("../../classes/send-sms.class.php");
        $sms = new SMS();
        $sms->CLI="SSORTDBAA";
        $sms->mobile=$_POST['mobile_no'];
        $sms->message='Teacher Name:- '.$_SESSION['USER']['USER_NAME'].' '.$_SESSION['USER']['USER_LNAME']."\n".$_POST['sms'];
        $sms->accountName="vibescom";
        $sms_response = $sms->sendsms();
        //print_r($sms_response);
        echo "<script>alert('".$sms_response."')</script>";
    }
} else {
    echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
}
?>
<!-- header Navigation st-->
<?php include'../includes/header-configuration.php'; ?>
<!-- header Navigation en-->

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

<!--notice circular row st-->
<div class="row">
<div class="col-sm-12 col-xs-12">
<div class="my-box">
<h3 class="box-title box-title pad-b-10">Student Profile
    <div class="btn-group pull-right">
        <a href="#" class="btn btn-bgblue" data-toggle="modal"
           data-target="#myMail"><span class="fa fa-envelope"></span> Send Message</a>
        <a href="" class="btn btn-defaul" data-target="#mySms" data-toggle="modal">
            <span class="fa fa-mobile"></span> Send SMS</a>
    </div>
</h3>
<section class="m-t-20">
    <div class="row">
        <div class="col-md-2 col-xs-12">
            <!--<img src="../images/student-pic.jpg" alt="user" class="img-responsive img-rounded img-thumbnail">-->
            <?php
            $filenameStudent = "../images/" . $stuadata[0]['usr_photo'];
            if ($stuadata[0]['usr_photo'] == "") {
                ?>
                <img src="../images/images.png" class="img-responsive img-rounded img-thumbnail"/>
            <?php
            } elseif (file_exists($filenameStudent)) {
                ?>
                <img src="../images/<?php echo $stuadata[0]['usr_photo']; ?>" alt="Teacher"
                     class="img-responsive img-rounded img-thumbnail"/>
            <?php
            } else {
                ?>
                <img src="../images/images.png" class="img-responsive img-rounded img-thumbnail"/>
            <?php
            }
            ?>
        </div>
        <div class="col-md-9 col-xs-12">
            <div class="panel panel-default">

                <div class="panel-wrapper collapse in">
                    <table class="table table-hover">

                        <tbody>
                        <tr>
                            <td><strong>First Name</strong></td>
                            <td><?php echo $stuadata[0]['usr_fname'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Middle Name </strong></td>
                            <td><?php echo $stuadata[0]['usr_mname'];?></td>
                        </tr>

                        <tr>
                            <td><strong>Last Name </strong></td>
                            <td><?php echo $stuadata[0]['usr_lname'];?></td>
                        </tr>

                        <tr>
                            <td><strong>Class</strong></td>
                            <td><?php echo $sqlclass['class_name']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Section</strong></td>
                            <td><?php echo $sqlsec['section_name']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Class Teacher </strong></td>
                            <td><?php echo $classteacherdata['usr_fname'] . " " . $classteacherdata['usr_mname'] . " " . $classteacherdata['usr_lname']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Admission Number </strong></td>
                            <td><?php echo $stuadata[0]['usr_application_no'];?> </td>
                        </tr>
                        <tr>
                            <td><strong>Date of Birth </strong></td>
                            <td>
                                <?php
                                if ($stuadata[0]['usr_dob'] == '') {
                                    echo "--";
                                } else {
                                    echo date('d-m-Y', strtotime($stuadata[0]['usr_dob']));
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
<section class="m-t-40">
<!--tab st-->
<div class="sttabs tabs-style-flip">
<nav>
    <ul>
        <li class="tab-current"><a href="#contact"><i class="fa fa-phone"></i> <span>Student Contact Details</span></a>
        </li>
        <li><a href="#address"><i class="fa fa-map-marker"></i> <span> Address</span></a></li>
        <li><a href="#parent-info"><i class="fa fa-mars parents"></i> <span>Parents Information </span></a></li>
        <!--<li><a href="#guardian-info"><i class="fa fa-user"></i> <span>Guardian</span></a></li>-->
        <li><a href="#medical-info"><i class="fa fa-medkit"></i> <span>Medical Information </span></a></li>
    </ul>
</nav>
<div class="content-wrap">
<section id="#contact" class="content-current">
    <div class="panel panel-default">
        <!--<div class="panel-heading">Student Contact Details</div>-->
        <div class="panel-wrapper collapse in">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="text-center">S. No.</th>
                    <th colspan="2"><h4 class="h4">Student Contact Details</h4></th>
                </tr>
                </thead>
                <tbody>
                <tr class="separate-row">
                    <td align="center">&nbsp;</td>
                    <td><strong>Primary Contact</strong></td>
                    <td>Father</td>
                </tr>
                <tr>
                    <td align="center">1</td>
                    <td><strong>First Name</strong></td>
                    <td>
                        <?php
                        $split = explode(" ", $sqlfather['usr_r_name']);
                        echo @$split['0'];
                        ?>

                    </td>
                </tr>
                <tr>
                    <td align="center">2</td>
                    <td><strong>Middle Name </strong></td>
                    <td><?php echo @$split['1']; ?></td>
                </tr>
                <tr>
                    <td align="center">3</td>
                    <td><strong>Last Name</strong></td>
                    <td><?php echo @$split['2']; ?></td>
                </tr>
                <tr>
                    <td align="center">4</td>
                    <td><strong>Contact No.</strong></td>
                    <td><?php echo $sqlfather['usr_r_contact_no'];?> </td>
                </tr>
                <tr>
                    <td align="center">5</td>
                    <td><strong>E-mail</strong></td>
                    <td><?php echo $sqlfather['usr_r_email'];?></td>
                </tr>

                <tr class="separate-row">
                    <td align="center">&nbsp;</td>
                    <td><strong>Secondary Contact</strong></td>
                    <td>Mother</td>
                </tr>

                <tr>
                    <td align="center">1</td>
                    <td><strong>First Name</strong></td>
                    <td><?php
                        $explode = explode(" ", $sqlmother['usr_r_name']);
                        echo @$explode[0];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td align="center">2</td>
                    <td><strong>Middle Name </strong></td>
                    <td><?php echo @$explode[1];?></td>
                </tr>
                <tr>
                    <td align="center">3</td>
                    <td><strong>Last Name </strong></td>
                    <td><?php echo @$explode[2];?></td>
                </tr>

                <tr>
                    <td align="center">4</td>
                    <td><strong>Contact No. </strong></td>
                    <td><?php echo $sqlmother['usr_r_contact_no'];?></td>
                </tr>

                <tr>
                    <td align="center">5</td>
                    <td><strong>E-mail</strong></td>
                    <td><?php echo $sqlmother['usr_r_email'];?> </td>
                </tr>


                </tbody>
            </table>
        </div>
    </div>
</section>

<section id="#address" class="">
    <div class="panel panel-default">
        <div class="panel-wrapper collapse in">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="text-center">S. No.</th>
                    <th colspan="2"><h4 class="h4">Permanent Address Details</h4></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td align="center">1</td>
                    <td><strong>Address</strong></td>
                    <td><?php echo $stuadata[0]['user_resident_local_address']; ?></td>
                </tr>
                <tr>
                    <td align="center">2</td>
                    <td><strong>Area</strong></td>
                    <td><?php echo $stuadata[0]['user_resident_area_address']; ?></td>
                </tr>
                <tr>
                    <td align="center">3</td>
                    <td><strong>City / State</strong></td>
                    <td><?php echo $stuadata[0]['user_resident_city']; ?>
                        / <?php echo $stuadata[0]['user_resident_state']; ?></td>
                </tr>
                <tr>
                    <td align="center">4</td>
                    <td><strong>Contact No.</strong></td>
                    <td><?php echo $stuadata[0]['user_resident_contact_no']; ?> </td>
                </tr>
                <tr>
                    <td align="center">5</td>
                    <td><strong>Pin Code</strong></td>
                    <td><?php echo $stuadata[0]['user_resident_pin']; ?></td>
                </tr>
                <tr class="separate-row">
                    <td align="center">&nbsp;</td>
                    <td colspan="2"><strong>Communication Address Details </strong></td>
                </tr>

                <tr>
                    <td align="center">1</td>
                    <td><strong>Address</strong></td>
                    <td><?php echo $stuadata[0]['user_comm_local_address']; ?></td>
                </tr>
                <tr>
                    <td align="center">2</td>
                    <td><strong>Area</strong></td>
                    <td><?php echo $stuadata[0]['user_comm_area_address']; ?></td>
                </tr>
                <tr>
                    <td align="center">3</td>
                    <td><strong>City / State</strong></td>
                    <td><?php echo $stuadata[0]['user_comm_city']; ?>
                        / <?php echo $stuadata[0]['user_comm_state']; ?></td>
                </tr>
                <tr>
                    <td align="center">4</td>
                    <td><strong>Contact No.</strong></td>
                    <td><?php echo $stuadata[0]['user_comm_contact_no']; ?></td>
                </tr>
                <tr>
                    <td align="center">5</td>
                    <td><strong>Pin Code</strong></td>
                    <td><?php echo $stuadata[0]['user_comm_pin']; ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section id="#parent-info" class="">
    <div class="panel panel-default">
        <div class="panel-wrapper collapse in">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="text-center">S. No.</th>
                    <th colspan="2"><h4 class="h4">Parent Information </h4></th>
                </tr>
                </thead>
                <tbody>
                <tr class="separate-row">
                    <td align="center">&nbsp;</td>
                    <td colspan="2">
                        <ul class="list-inline">
                            <li>
                                <a href="#">
                                    <!--<img src="../images/<?php /*echo $stuadata[0]['usr_mother_photo'];*/?>" class="img-circle" />-->
                                    <?php
                                    $filenameMother = "../images/" . $stuadata[0]['usr_mother_photo'];
                                    if ($stuadata[0]['usr_mother_photo'] == "") {
                                        ?>
                                        <img src="../images/images.png" class="img-circle"/>
                                    <?php
                                    } elseif (file_exists($filenameMother)) {
                                        ?>
                                        <img src="../images/<?php echo $stuadata[0]['usr_mother_photo']; ?>"
                                             class="img-circle"/>
                                    <?php
                                    } else {
                                        ?>
                                        <img src="../images/images.png" class="img-circle"/>
                                    <?php
                                    }
                                    ?>
                                </a>
                            </li>
                            <li><strong>Mother Details</strong></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td align="center">1</td>
                    <td><strong>First Name </strong></td>
                    <td><?php echo @$explode[0]; ?></td>
                </tr>
                <tr>
                    <td align="center">2</td>
                    <td><strong>Middle Name </strong></td>
                    <td><?php echo @$explode[1]; ?></td>
                </tr>
                <tr>
                    <td align="center">3</td>
                    <td><strong>Last Name </strong></td>
                    <td><?php echo @$explode[2]; ?></td>
                </tr>
                <tr>
                    <td align="center">4</td>
                    <td><strong>Occupation </strong></td>
                    <td><?php echo $sqlmother['usr_r_occupatrion']; ?></td>
                </tr>
                <tr>
                    <td align="center">5</td>
                    <td><strong>Designation </strong></td>
                    <td><?php echo $sqlmother['usr_r_designation']; ?></td>
                </tr>
                <tr>
                    <td align="center">6</td>
                    <td><strong>Name Of Organization</strong></td>
                    <td><?php echo $sqlmother['usr_r_org_name']; ?></td>
                </tr>

                <tr>
                    <td align="center">7</td>
                    <td><strong>Address</strong></td>
                    <td><?php echo $sqlmother['usr_r_office_address']; ?></td>
                </tr>
                <tr>
                    <td align="center">8</td>
                    <td><strong>Area</strong></td>
                    <td><?php echo $sqlmother['usr_r_offc_area']; ?></td>
                </tr>
                <tr>
                    <td align="center">9</td>
                    <td><strong>City / State</strong></td>
                    <td><?php echo $sqlmother['usr_r_offc_city']; ?>
                        / <?php echo $sqlmother['usr_r_offc_state']; ?></td>
                </tr>
                <tr>
                    <td align="center">10</td>
                    <td><strong>Contact No.</strong></td>
                    <td><?php echo $sqlmother['usr_r_office_contact_no']; ?></td>
                </tr>
                <tr>
                    <td align="center">11</td>
                    <td><strong>E-mail</strong></td>
                    <td><?php echo $sqlmother['usr_r_email']; ?></td>
                </tr>

                <tr class="separate-row">
                    <td align="center">&nbsp;</td>
                    <td colspan="2">
                        <ul class="list-inline">
                            <li>
                                <a href="#">
                                    <!--<img src="../images/<?php /*echo $stuadata[0]['usr_father_photo'];*/?>" class="img-circle" />-->
                                    <?php
                                    $filenameFather = "../images/" . $stuadata[0]['usr_father_photo'];
                                    if ($stuadata[0]['usr_father_photo'] == "") {
                                        ?>
                                        <img src="../images/images.png" class="img-circle"/>
                                    <?php
                                    } elseif (file_exists($filenameFather)) {
                                        ?>
                                        <img src="../images/<?php echo $stuadata[0]['usr_father_photo']; ?>"
                                             class="img-circle"/>
                                    <?php
                                    } else {
                                        ?>
                                        <img src="../images/images.png" class="img-circle"/>
                                    <?php
                                    }
                                    ?>
                                </a>
                            </li>
                            <li><strong>Father Details</strong></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td align="center">1</td>
                    <td><strong>First Name </strong></td>
                    <td><?php echo @$split['0']; ?></td>
                </tr>
                <tr>
                    <td align="center">2</td>
                    <td><strong>Middle Name </strong></td>
                    <td><?php echo @$split['1']; ?></td>
                </tr>
                <tr>
                    <td align="center">3</td>
                    <td><strong>Last Name </strong></td>
                    <td><?php echo @$split['2']; ?></td>
                </tr>
                <tr>
                    <td align="center">4</td>
                    <td><strong>Occupation </strong></td>
                    <td><?php echo $sqlfather['usr_r_occupatrion']; ?></td>
                </tr>
                <tr>
                    <td align="center">5</td>
                    <td><strong>Designation </strong></td>
                    <td><?php echo $sqlfather['usr_r_designation']; ?></td>
                </tr>
                <tr>
                    <td align="center">6</td>
                    <td><strong>Name Of Organization</strong></td>
                    <td><?php echo $sqlfather['usr_r_org_name']; ?></td>
                </tr>

                <tr>
                    <td align="center">7</td>
                    <td><strong>Address</strong></td>
                    <td><?php echo $sqlfather['usr_r_office_address']; ?></td>
                </tr>
                <tr>
                    <td align="center">8</td>
                    <td><strong>Area</strong></td>
                    <td><?php echo $sqlfather['usr_r_offc_area']; ?></td>
                </tr>
                <tr>
                    <td align="center">9</td>
                    <td><strong>City / State</strong></td>
                    <td><?php echo $sqlfather['usr_r_offc_city']; ?>
                        / <?php echo $sqlmother['usr_r_offc_state']; ?></td>
                </tr>
                <tr>
                    <td align="center">10</td>
                    <td><strong>Contact No.</strong></td>
                    <td><?php echo $sqlfather['usr_r_office_contact_no']; ?></td>
                </tr>
                <tr>
                    <td align="center">11</td>
                    <td><strong>E-mail</strong></td>
                    <td><?php echo $sqlfather['usr_r_email']; ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!--<section id="#guardian-info" class="">
    <div class="panel panel-default">
        <div class="panel-wrapper collapse in">
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="text-center">S. No.</th>
                <th colspan="2"><h4 class="h4">Guardian Details </h4></th>
              </tr>
            </thead>
            <tbody>
              <tr class="separate-row">
                <td align="center">&nbsp;</td>
                  <td colspan="2">
                      <ul class="list-inline">
                        <li>
                            <a href="#"><img src="../images/uncle-pic.jpg" class="img-circle" /></a>
                        </li>
                        <li><strong>Guardian Details</strong></li>
                      </ul>
                  </td>
              </tr>
              <tr>
                <td align="center">1</td>
                  <td><strong>First Name  </strong></td>
                <td>Mr. Sanni </td>
              </tr>
                <tr>
                <td align="center">2</td>
                  <td><strong>Middle Name  </strong></td>
                <td>Lal</td>
              </tr>
                <tr>
                <td align="center">3</td>
                  <td><strong>Last Name  </strong></td>
                <td>Chauhan</td>
              </tr>
                <tr>
                    <td align="center">4</td>
                      <td><strong>Relation  </strong></td>
                    <td>Uncle </td>
                </tr>
              <tr>
                <td align="center">5</td>
                  <td><strong>Occupation  </strong></td>
                <td>Govt. Employee</td>
              </tr>
              <tr>
                <td align="center">6</td>
                  <td><strong>Designation </strong> </td>
                <td>Bank Manager</td>
              </tr>
                <tr>
                <td align="center">7</td>
                    <td><strong>Name Of Organization</strong> </td>
                    <td>ICICI Bank </td>
              </tr>

               <tr>
                <td align="center">8</td>
                  <td><strong>Address</strong></td>
                <td>A-321, Orange Zodiac</td>
              </tr>
                <tr>
                <td align="center">9</td>
                  <td><strong>Area</strong></td>
                <td>Sector-120</td>
              </tr>
              <tr>
                <td align="center">10</td>
                  <td><strong>City / State</strong> </td>
                <td>Noida / Uttar Pradesh</td>
              </tr>
              <tr>
                <td align="center">11</td>
                  <td><strong>Contact No.</strong></td>
                <td>955402521</td>
              </tr>
              <tr>
                <td align="center">12</td>
                  <td><strong>E-mail</strong> </td>
                <td>abc.example@gmail.com</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  </section>-->

<section id="#medical-info" class="">
    <div class="panel panel-default">
        <div class="panel-wrapper collapse in">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="text-center">S. No.</th>
                    <th colspan="2"><h4 class="h4">Medical Information </h4></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td align="center">1</td>
                    <td><strong>Blood Group </strong></td>
                    <td><?php echo $stuadata[0]['user_blood_group'];?></td>
                </tr>
                <tr>
                    <td align="center">2</td>
                    <td><strong>Height</strong></td>
                    <td><?php echo $stuadata[0]['user_height'];?></td>
                </tr>
                <tr>
                    <td align="center">3</td>
                    <td><strong>Weight</strong></td>
                    <td><?php echo $stuadata[0]['user_weight'];?> Kg.</td>
                </tr>
                <tr>
                    <td align="center">4</td>
                    <td><strong>Allergies </strong></td>
                    <td><?php echo $stuadata[0]['user_allergies'];?></td>
                </tr>
                <tr>
                    <td align="center">5</td>
                    <td><strong>Illness </strong></td>
                    <td><?php echo $stuadata[0]['user_Illness'];?></td>
                </tr>
                <tr>
                    <td align="center">6</td>
                    <td><strong>Emergency Treatment</strong></td>
                    <td><?php echo $stuadata[0]['user_emergency_treatment'];?></td>
                </tr>
                <tr>
                    <td align="center">7</td>
                    <td><strong>Regular Medication</strong></td>
                    <td><?php echo $stuadata[0]['user_medication'];?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--section-->
</div>
<!-- /content -->
</div>
<!--tab en-->
</section>
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
<!----------FOR EMAIL TO PARETS POPUP------------>
<div class="modal fade" id="myMail" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Email to contact</h4>
            </div>
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">

                        <input type="hidden" class="form-control" placeholder="Email to contact" name="from_id"
                               value="<?php echo $_SESSION['USER']['USER_ID']; ?>">
                        <input type="hidden" class="form-control" placeholder="Email to contact" name="from_role"
                               value="<?php echo $_SESSION['USER']['ROLE_ID']; ?>">
                        <input type="hidden" class="form-control" placeholder="Email to contact" name="to_role"
                               value="Parent">
                        <input type="hidden" class="form-control" placeholder="Email to contact" name="parent_id"
                               value="<?php echo $stuarray[0]['parent_id']; ?>">

                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Subject:</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Subject" name="subject">
                        </div>
                    </div>
                    <div class="form-group marg-bott">
                        <label for="textarea" class="col-sm-2 control-label">Message:</label>

                        <div class="col-sm-10">
                            <textarea rows="5" class="message" name="message"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2 col-xs-12"></div>
                            <div class="col-sm-10">
                                <label class="btn btn-link pull-right marg-right">
                                    <span class="fa fa-paperclip"></span>
                                    Attachment <input type="file" class="hidden" name="attach">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 pull-right text-center">
                            <input type="submit" class="btn btn-default btn-color border-round" name="SendM"
                                   value="Send">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-------------------------SMS MODAL----------------------------->
<div class="modal fade" id="mySms" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Send SMS</h4>
            </div>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
                <div class="modal-body">
                    <div id="alertmsg"></div>
                    <div class="form-group marg-bott">
                        <input type="hidden" value="<?php echo $sqlfather['usr_r_contact_no']; ?>" name="mobile_no">
                        <label for="textarea" class="col-sm-2 control-label">Message:</label>
                        <div class="col-sm-10">
                            <textarea rows="5" maxlength="100" id="sms" name="sms" class="message"></textarea>
                            <div id="textarea_feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 pull-right text-center">
                            <input type="submit" name="submitsms" onclick="return sms_validation()" class="btn btn-default btn-color border-round" value="Send">
                            <!-- <i class="fa fa-paper-plane"></i> </button>-->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Style Switcher -->
<!--<script src="js/jQuery.style.switcher.js"></script>-->
<script>
    /*jQuery(".message_popup").click(function(){
        alert("ji");
        var mobile=jQuery(this).attr("data-mobile");
        alert(mobile);
        jQuery("#mobile").val(mobile);
        jQuery("#mySms").modal("show");
    })*/
    function sms_validation(){
        var sms = jQuery("#sms").val();
        if(sms == ''){
            jQuery("#alertmsg").html("Plese insert Message");
            jQuery("#sms").focus();
            return false;
        }
    }
</script>
<!--FOR REMAINING CHARECTOR-->
<script>
    jQuery(document).ready(function(){
        var text_max = 100;
        jQuery("#textarea_feedback").html(text_max + ' Characters Remaining');
        jQuery("#sms").keyup(function(){
            var text_length = jQuery("#sms").val().length;
            console.log(text_length);
            var text_remaining = text_max - text_length;
            console.log(text_remaining);
            jQuery("#textarea_feedback").html(text_remaining + '  Characters Remaining');
        });
    })
</script>
</body>
</html>
