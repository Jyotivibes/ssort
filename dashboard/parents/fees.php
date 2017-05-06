<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Fee</title>
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
    $circularNotice = $obj->getCircularActivities();
    $eventNotification = $obj->getEventsNotification();

    if (isset($_REQUEST['submitfee'])) {
        $addfee = $obj->ADDFEES();
        if ($addfee == 1) {
            echo "<script>alert('Fee Deposited Successfully')</script>";
        }
    }
    include_once 'stastics.php';

    $stuarray = mysql_fetch_array(mysql_query("SELECT * FROM essort_user_relation WHERE stu_id='" . $studata['stu_id'] . "'"));
	$stuadata = mysql_fetch_array(mysql_query("SELECT * FROM essort_application_header WHERE usr_application_id='" . $studata['stu_id'] . "'"));
	$sql = mysql_query("SELECT *,'element_name' FROM essort_fee_structure WHERE class_id='" . $stuarray[0]['class_id'] . "' AND sec_id='" . $stuarray[0]['sec_id'] . "'");
    $element = array();
    while ($row = mysql_fetch_array($sql)) {
        $sqlelemname = mysql_fetch_array(mysql_query("SELECT fee_elem_name FROM essort_fee_detail WHERE fee_id='" . $row['fee_elem_id'] . "'"));
        $row['element'] = $sqlelemname['fee_elem_name'];
        $element[] = $row;
    }
    $no_of_element_count = count($element);
#############################SELECT FEE###################################################################
    $date = date('Y-m-d');
    $month = date('F', strtotime($date));

    $montharr = array("April", "May", "June");
    $monthsecarr = array("July", "August", "September");
    $monththirdcarr = array("October", "November", "December");
    $monthfourthcarr = array("January", "February", "March");
    if (in_array($month, $montharr)) {
        $type = 'first';
    } elseif (in_array($month, $monthsecarr)) {
        $type = 'second';

    } elseif (in_array($month, $monththirdcarr)) {
        $type = 'third';

    } else {
        $type = 'fourth';

    }
   // echo $type;
    $sqlfeetrans = mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='" . $studata['stu_id'] . "' AND fee_quarter='" . $type . "' AND status=1");
    $fee_trans_no_of_rows = mysql_num_rows($sqlfeetrans);
    if ($fee_trans_no_of_rows == 0) {
        $type = $type;
    } else {
        $type = 'No Due';
    }
	
######################PENDING DUES###########################################################################
if ($type == 'fourth') {
        $amount = 0;
        $pendingfquarter = 0;
        $pendingsquarter = 0;
        $pendingtquarter = 0;
        $pendingfrquarter = 0;
        $penality = 0;
        //PENALITY
        $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='fourth'"));
        $now = time();
        $your_date = strtotime($sqlpenality['ftime_edate']);
        $datediff = $now - $your_date;
        $count = floor($datediff / (60 * 60 * 24));
        $penality = 0;
        for ($i = 1; $i <= $count; $i++) {
            $penality = $penality + $sqlpenality['fpenality'];
        }
		 $sqlpendingdues = mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='" . $stuarray[0]['stu_id'] . "' AND fee_quarter='third' AND status=1");
        $fee_pending_no_of_rows = mysql_num_rows($sqlpendingdues);
        if ($fee_pending_no_of_rows > 0) {
            $pendingtquarter = 1;
            //PENALITY
            $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='third'"));
            $now = time();
            $your_date = strtotime($sqlpenality['ftime_edate']);
            $datediff = $now - $your_date;
            $count = floor($datediff / (60 * 60 * 24));

            for ($i = 1; $i <= $count; $i++) {
                $penality = $penality + $sqlpenality['fpenality'];
            }
        }
        //SECOND QUARTER
        $sqlpendingsdues = mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='" . $stuarray[0]['stu_id'] . "' AND fee_quarter='second' AND status=1");
        $fee_pending_nos_of_rows = mysql_num_rows($sqlpendingsdues);
        if ($fee_pending_nos_of_rows > 0) {
            $pendingsquarter = 1;
            //PENALITY
            $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='second'"));
            $now = time();
            $your_date = strtotime($sqlpenality['ftime_edate']);
            $datediff = $now - $your_date;
            $count = floor($datediff / (60 * 60 * 24));

            for ($i = 1; $i <= $count; $i++) {
                $penality = $penality + $sqlpenality['fpenality'];
            }
        }
        //FIRST QUARTER
        $sqlpendingfdues = mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='" . $stuarray[0]['stu_id'] . "' AND fee_quarter='first' AND status=1");
       $fee_pending_nof_of_rows = mysql_num_rows($sqlpendingfdues);
        if ($fee_pending_nof_of_rows > 0) {
            $pendingfquarter = 1;
            //PENALITY
            $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='first'"));
            $now = time();
            $your_date = strtotime($sqlpenality['ftime_edate']);
            $datediff = $now - $your_date;
            $count = floor($datediff / (60 * 60 * 24));

            for ($i = 1; $i <= $count; $i++) {
                $penality = $penality + $sqlpenality['fpenality'];
            }
        }
    } elseif ($type == 'third') {
        $amount = 0;
        $penality = 0;
        //SECOND QUARTER
        $sqlpendingsdues = mysql_query("SELECT * FROM essort_fee_transaction WHERE  user_id='" . $stuarray[0]['stu_id'] . "' AND fee_quarter='second' AND status=1");
        $fee_pending_nos_of_rows = mysql_num_rows($sqlpendingsdues);
        if ($fee_pending_nos_of_rows == 0) {
            $pendingsquarter = 1;
            $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='second'"));
            $now = time();
            $your_date = strtotime($sqlpenality['ftime_edate']);
            $datediff = $now - $your_date;
            $count = floor($datediff / (60 * 60 * 24));

            for ($i = 1; $i <= $count; $i++) {
                $penality = $penality + $sqlpenality['fpenality'];
            }
        }
        //FIRST QUARTER
        $sqlpendingfdues = mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='" . $stuarray[0]['stu_id'] . "' AND fee_quarter='first' AND status=1");
        $fee_pending_nof_of_rows = mysql_num_rows($sqlpendingfdues);
        if ($fee_pending_nof_of_rows == 0) {
            $pendingfquarter = 1;
            $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='first'"));
            $now = time();
            $your_date = strtotime($sqlpenality['ftime_edate']);
            $datediff = $now - $your_date;
            $count = floor($datediff / (60 * 60 * 24));

            for ($i = 1; $i <= $count; $i++) {
                $penality = $penality + $sqlpenality['fpenality'];
            }
        }
    } elseif ($type == 'second') {
        $amount = 0;
        //FIRST QUARTER
        $sqlpendingfdues = mysql_query("SELECT * FROM essort_fee_transaction  WHERE user_id='" . $stuarray[0]['stu_id'] . "' AND fee_quarter='first' AND status=1");
        $fee_pending_nof_of_rows = mysql_num_rows($sqlpendingfdues);
        if ($fee_pending_nof_of_rows == 0) {
            $pendingfquarter = 1;
            $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='first'"));
            $now = time();
            $your_date = strtotime($sqlpenality['ftime_edate']);
            $datediff = $now - $your_date;
            $count = floor($datediff / (60 * 60 * 24));

            for ($i = 1; $i <= $count; $i++) {
                $penality = $penality + $sqlpenality['fpenality'];
            }
        }
    }
	
	elseif ($type == 'first') {
        $amount = 0;
        //FIRST QUARTER
		
		$pendingsquarter=1;
		$pendingtquarter=1;
		$pendingfrquarter=1;
        $fee_pending_nof_of_rows = mysql_num_rows($sqlpendingfdues);
        if ($fee_pending_nof_of_rows == 0) {
            $pendingfquarter = 1;
            $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='first'"));
            $now = time();
            $your_date = strtotime($sqlpenality['ftime_edate']);
            $datediff = $now - $your_date;
            $count = floor($datediff / (60 * 60 * 24));

            for ($i = 1; $i <= $count; $i++) {
                $penality = $penality + $sqlpenality['fpenality'];
            }
        }
    }
	
	elseif ($type == 'No Due') {
        $amount = 0;
        //FIRST QUARTER
		$pendingfquarter=1;
		$pendingsquarter=1;
		$pendingtquarter=1;
		$pendingfrquarter=1;
        
    }
	
	//echo  "PPPP".$penality;
    $fquarter = $obj->VIEWFEETIMELINE('first');
    $squarter = $obj->VIEWFEETIMELINE('second');
    $tquarter = $obj->VIEWFEETIMELINE('third');
    $frthquarter = $obj->VIEWFEETIMELINE('fourth');
    #####################################FEE DISCOUNT###############################################
    $sqldiscount = mysql_query("SELECT * FROM `essort_fee_discount` WHERE stu_id='" . $stuarray[0]['stu_id'] . "' GROUP BY discount_quarter");
    $discountarr = array();
    $firstquarterdiscount = 0;
    $secquarterdiscount = 0;
    $thirdquarterdiscount = 0;
    $fourthquarterdiscount = 0;
    while ($rowfeed = mysql_fetch_array($sqldiscount)) {
        if ($rowfeed['discount_quarter'] == 'first') {
            $firstquarterdiscount = $rowfeed['discount_percent'];
        }
        if ($rowfeed['discount_quarter'] == 'second') {
            $secquarterdiscount = $rowfeed['discount_percent'];
        }
        if ($rowfeed['discount_quarter'] == 'third') {
            $thirdquarterdiscount = $rowfeed['discount_percent'];
        }
        if ($rowfeed['discount_quarter'] == 'third') {
            $fourthquarterdiscount = $rowfeed['discount_percent'];
        }
        $discountarr[$rowfeed['discount_quarter']] = $rowfeed;

    }

    //print_r($discountarr);

#####################################FEE HISTORy###############################################
    $classname = $obj->getClass($stuarray[0]['class_id']);
    $sectionname = $obj->getSection($stuarray['class_id'], $stuarray[0]['sec_id']);
    $sqlfee = mysql_query("SELECT * FROM  essort_fee_transaction WHERE user_id='" . $stuarray[0]['stu_id'] . "' AND status=1");
    $feetransarr = array();
    while ($rowfee = mysql_fetch_array($sqlfee)) {
        $feetransarr[] = $rowfee;

    }
//$sqlfee="SELECT * FROM ";
#####################################FEE HISTORy###############################################


} else {
    echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
}
?>
<!-- Navigation -->

<!-- header Navigation st-->
<?php include '../includes/header-configuration.php'?>
<!-- header Navigation en-->

<!--sidebar nav st-->
<?php include '../includes/sidebar.php'; ?>
<!--sidebar nav en-->
<!--#################################################################################-->
<div id="count" style="display:none;"><?php echo $no_of_element_count;?></div>
<div id="paydiv" style="display:none;"><?php echo $type;?></div>
<div id="pendingdues" style="display:none;"><?php echo $amount;?></div>
<div id="penality" style="display:none;"><?php echo $penality;?></div>
<div id="firstquarterdiscount" style="display:none;"><?php echo $firstquarterdiscount;?></div>
<div id="secquarterdiscount" style="display:none;"><?php echo $secquarterdiscount;?></div>
<div id="thirdquarterdiscount" style="display:none;"><?php echo $thirdquarterdiscount;?></div>
<div id="fourthquarterdiscount" style="display:none;"><?php echo $fourthquarterdiscount;?></div>
<!--#################################################################################-->
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
                        <?php include_once("../includes/header-notice-circular.php"); ?>
                    </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    <ol class="breadcrumb bread-change">
                        <li>
                            <a href="<?php echo PARENT_DASHBOARD_LINK;?>">Dashboard</a>
                        </li>
                        <li class="active">Fee</li> 
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<!--en row-->

<!--fee st-->
<div class="row">
    <div class="col-sm-6 col-xs-12">
        <div class="my-box">
            <section class="m-t-20">
                <div class="row">
                    <div class="col-md-3 col-xs-12">
                        <?php
                        if ($stuadata['usr_fname'] == '') {
                            echo'<img src="../images/student-pic.jpg" alt="user" class="img-responsive img-rounded img-thumbnail">';

                        } else {
                            echo'<img src="../images/images.png" alt="user" class="img-responsive img-rounded img-thumbnail">';

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
                                        <td><?php echo $stuadata['usr_fname'];?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Middle Name </strong></td>
                                        <td><?php echo $stuadata['usr_mname'];?></td>
                                    </tr>

                                    <tr>
                                        <td><strong>Last Name </strong></td>
                                        <td><?php echo $stuadata['usr_lname'];?></td>
                                    </tr>


                                    <tr>
                                        <td><strong>Admission Number </strong></td>
                                        <td><?php echo $stuadata['usr_application_no'];?> </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Class </strong></td>
                                        <td><?php echo $classname;?>  </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Section</strong></td>
                                        <td><?php echo $sectionname;?> </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <!--en white-box-->
    </div>
    <!--en col-->

    <div class="col-sm-6 col-xs-12">
        <div class="my-box">
            <h3 class="box-title box-title pad-b-10">Fee History</h3>
            <section class="m-t-10">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th class="text-nowrap">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (count($feetransarr) > 0) {
                                    foreach ($feetransarr as $feetransvlue) {
                                        if ($feetransvlue['fee_quarter'] == 'first') {
                                            $tag = 'collapseOne';
                                        } else if ($feetransvlue['fee_quarter'] == 'second') {
                                            $tag = 'collapseTwo';

                                        } else if ($feetransvlue['fee_quarter'] == 'third') {
                                            $tag = 'collapseThree';

                                        } else if ($feetransvlue['fee_quarter'] == 'fourth') {
                                            $tag = 'collapseFourth';

                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo date($feetransvlue['fee_created_on']);?></td>
                                            <td><span
                                                    class="fa fa-inr"></span><?php echo $feetransvlue['payment_amount_by_user'];?>
                                            </td>
                                            <td class="text-center"><a href="javascript:void(0)" data-toggle="tooltip"
                                                                       data-date="<?php echo date('d M , Y', strtotime($feetransvlue['fee_created_on'])); ?>"
                                                                       data-tag="<?php echo $tag; ?>" class="fee_pdf"
                                                                       data-original-title="Download Receipt"><span
                                                        class="fa fa-download"></span></a></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    echo'<tr>
														<td colspan="4">No Data Found</td>
													</tr>';

                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <!--en white-box-->
    </div>
    <!--en col-->
</div>
<!--en row-->


<div class="row">
<div class="col-sm-6 col-xs-12">
<div class="my-box">
<h3 class="box-title box-title pad-b-10">Session: 2016-2017</h3>
<section class="m-t-20">
<!--accordian st-->
<div class="panel-group" id="accordion">
<div class="panel panel-default">
    <div class="panel-heading bg-accordian">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                First Quarter (Apr-Jun)
                <span class="pull-right text-fff"><?php echo  $fquarter['ftime_sdate'];?>
                    - <?php echo  $fquarter['ftime_edate'];?> </span>
            </a>

        </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table color-table primary-table" id="collapse1">
                    <thead>
                    <tr>
                        <th>S. No.</th>
                        <th>Apr</th>
                        <th>May</th>
                        <th>Jun</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($element as $vlue) {
                        ?>
                        <tr>
                            <td><?php echo $vlue['element'];?></td>
                            <td>
                                <div
                                    id="April<?php echo $i; ?>"><?php if ($vlue['fee_elem_month'] == '' || preg_match('/\b' . "April" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div>
                            </td>
                            <td>
                                <div
                                    id="May<?php echo $i; ?>"><?php if ($vlue['fee_elem_month'] == '' || preg_match('/\b' . "May" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div>
                            </td>
                            <td>
                                <div
                                    id="June<?php echo $i; ?>"><?php if ($vlue['fee_elem_month'] == '' || preg_match('/\b' . "June" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                    <tr>
                        <td class="total-border"><strong>Total</strong></td>
                        <td class="total-border" colspan="3">
                            <div id="firstquarterfee">...</div>
                            ...
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <a class="btn btn-link text-muted text-fancy btn-block text-center">Payment
                                date: <?php echo  $fquarter['ftime_sdate'];?>
                                - <?php echo  $fquarter['ftime_edate'];?></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!--en table responsive-->
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading bg-accordian">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                Second Quarter (Jul-Sept)
                <span class="pull-right text-fff"><?php echo  $squarter['ftime_sdate'];?>
                    - <?php echo  $squarter['ftime_edate'];?></span>
            </a>
        </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table color-table primary-table" id="collapse2">
                    <thead>
                    <tr>
                        <th>S. No.</th>
                        <th>Jul</th>
                        <th>Aug</th>
                        <th>Sept</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($element as $vlue) {
                        ?>
                        <tr>
                            <td><?php echo $vlue['element'];?></td>
                            <td>
                                <div
                                    id="July<?php echo $i; ?>"><?php if ($vlue['fee_elem_month'] == '' || preg_match('/\b' . "July" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div>
                            </td>
                            <td>
                                <div
                                    id="August<?php echo $i; ?>"><?php if ($vlue['fee_elem_month'] == '' || preg_match('/\b' . "August" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div>
                            </td>
                            <td>
                                <div
                                    id="September<?php echo $i; ?>"><?php if ($vlue['fee_elem_month'] == '' || preg_match('/\b' . "September" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>

                    <tr>
                        <td class="total-border"><strong>Total</strong></td>
                        <td class="total-border" colspan="3">
                            <div id="secondquarterfee">...</div>
                            ...
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <a class="btn btn-link text-muted text-fancy btn-block text-center">Payment
                                date: <?php echo  $squarter['ftime_sdate'];?>
                                - <?php echo  $squarter['ftime_edate'];?> </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!--en table responsive-->
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading bg-accordian">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                Third Quarter (Oct-Dec)
                <span class="pull-right text-fff"><?php echo  $tquarter['ftime_sdate'];?>
                    - <?php echo  $tquarter['ftime_edate'];?></span>
            </a>
        </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table color-table primary-table" id="collapse3">
                    <thead>
                    <tr>
                        <th>S. No.</th>
                        <th>Oct</th>
                        <th>Nov</th>
                        <th>Dec</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($element as $vlue) {
                        ?>
                        <tr>
                            <td><?php echo $vlue['element'];?></td>
                            <td>
                                <div
                                    id="October<?php echo $i; ?>"><?php if ($vlue['fee_elem_month'] == '' || preg_match('/\b' . "October" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div>
                            </td>
                            <td>
                                <div
                                    id="November<?php echo $i; ?>"><?php if ($vlue['fee_elem_month'] == '' || preg_match('/\b' . "November" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div>
                            </td>
                            <td>
                                <div
                                    id="December<?php echo $i; ?>"><?php if ($vlue['fee_elem_month'] == '' || preg_match('/\b' . "December" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>

                    <tr>
                        <td class="total-border"><strong>Total</strong></td>
                        <td class="total-border" colspan="3">
                            <div id="thirdquarterfee">...</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <a class="btn btn-link text-muted text-fancy btn-block text-center">Payment
                                date: <?php echo  $tquarter['ftime_sdate'];?>
                                - <?php echo  $tquarter['ftime_edate'];?></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!--en table responsive-->
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading bg-accordian">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFourth">
                Fourth Quarter (Jan-Mar)
                <span class="pull-right text-fff"><?php echo  $frthquarter['ftime_sdate'];?>
                    - <?php echo  $frthquarter['ftime_edate'];?> </span>
            </a>
        </h4>
    </div>
    <div id="collapseFourth" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table color-table primary-table" id="collapse4">
                    <thead>
                    <tr>
                        <th>S. No.</th>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($element as $vlue) {
                        ?>
                        <tr>

                            <td><?php echo $vlue['element'];?></td>
                            <td>
                                <div
                                    id="January<?php echo $i; ?>"><?php if ($vlue['fee_elem_month'] == '' || preg_match('/\b' . "January" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div>
                            </td>
                            <td>
                                <div
                                    id="February<?php echo $i; ?>"><?php if ($vlue['fee_elem_month'] == '' || preg_match('/\b' . "February" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div>
                            </td>
                            <td>
                                <div
                                    id="March<?php echo $i; ?>"><?php if ($vlue['fee_elem_month'] == '' || preg_match('/\b' . "March" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                    <tr>
                        <td class="total-border"><strong>Total</strong></td>
                        <td class="total-border" colspan="3">
                            <div id="fourthquarterfee">...</div>
                        </td>
                    </tr>
                    <!-- <tr>
                         <td colspan="4">
                             <a class="btn btn-link text-muted text-fancy btn-block text-center">Payment date: Jan/01/2016 - Jan/10/2016 </a>
                         </td>
                     </tr>-->
                    </tbody>
                </table>
            </div>
            <!--en table responsive-->
        </div>
    </div>
</div>
</div>
<!--accordian en-->
</section>
</div>
<!--en white-box-->
</div>
<!--en col-->

<div class="col-sm-6 col-xs-12">
    <div class="my-box box-balance">
        <h3 class="box-title box-title pad-b-10">Fee Due</h3>
        <section class="m-t-20">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <a href="javascript:void(0);" class="btn btn-info bord-radius"><span class="fa fa-inr"></span>

                        <div id="totalfee"></div>
                    </a>
                    <!--<a href="javascript:void(0);" class="btn btn-success bord-radius">Click here for online payment </a>-->
                    <a href="javascript:void(0);" class="btn btn-success bord-radius Payment">Pay now!</a>

                    <div class="btn-block m-t-20">
                        <a class="btn btn-link text-muted text-fancy">Payment
                            date: <?php echo  $frthquarter['ftime_sdate'];?>
                            - <?php echo  $frthquarter['ftime_edate'];?></a>
                    </div>
                </div>
            </div>

            <!--acc st-->
            <!--accordian st-->
            <div class="panel-group" id="accordiondue">
                <div class="panel panel-default">
                    <div class="panel-heading bg-accordian">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordiondue"
                               href="#collapsedueOne">
                                Detail of Fee Due
                            </a>
                        </h4>
                    </div>
                    <div id="collapsedueOne" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table color-table primary-table no-collapse" id="newdiv">
                                    <thead>
                                    <tr>
                                        <th>S. No.</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody id="collapsedueTable">
                                    <?php
                                    foreach ($element as $vlue) {
                                        ?>
                                        <tr>
                                            <th><?php echo $vlue['element']; ?></th>
                                            <td><?php echo $vlue['fee_elem_amount']; ?></td>
                                            <td>...</td>
                                            <td>...</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="total-border"><strong>Current Dues</strong></td>
                                        <td class="total-border" colspan="3">...</td>
                                    </tr>
                                    <tr id="rowToClone1">
                                        <td class="total-border"><strong>Previous Dues</strong></td>
                                        <td class="total-border" colspan="3">...</td>
                                    </tr>
                                    <tr>
                                        <td class="total-border"><strong>Penalty</strong></td>
                                        <td class="total-border" colspan="3">...</td>
                                    </tr>
                                    <tr>
                                        <td class="total-border"><strong>Net Total</strong></td>
                                        <td class="total-border" colspan="3">...</td>
                                    </tr>
                                    <tr>
                                        <td class="total-border" colspan="4" align="right">
                                            <a href="javascript:void(0);" class="btn btn-success bord-radius">Click here
                                                for online payment</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--en table responsive-->
                        </div>
                    </div>
                </div>
            </div>
            <!--accordian en-->
            <!--acc en-->
        </section>
    </div>
    <!--en white-box-->
</div>
<!--en col-->
</div>
<!--en row-->
<!--fee en-->


<div class="col-sm-12 my-box">
<h5 class="text-center"><b>Discount &amp; Wave-off</b></h5>
<!--                dww-->


<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading bg-accordian">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne1">Discount <span
                        class="text-center pull-right"></span></a><!--20% Discount, Month January, February-->
            </h4>
        </div>


        <div id="collapseOne1" class="panel-collapse collapse">
            <div class="panel-body">

                <div class="row">
                    <div class="[ form-group ]">

                        <div class="[ btn-group ]">
                            <label for="fancy-checkbox-success" class="[ btn btn-success ]">
                                <span class="[ glyphicon glyphicon-ok ]"></span>
                                <span> </span>
                            </label>
                            <!--<input for="fancy-checkbox-success" type="text" class="[ btn btn-default active]" placeholder="Please Enter % of Discount">-->


                        </div>
                    </div>
                    <div class="col-md-6 new-section2 row">


                        <div class="funkyradio">
                            <!--  <div class="funkyradio-default">
                                 <input type="radio" name="test" value="a" checked="">
                                 <label for="checkbox1">Monthly</label>
                             </div>-->
                            <div class="funkyradio-primary">
                                <input type="radio" name="test" value="b" checked>
                                <label for="checkbox2">Quaterly</label>
                            </div>
                            <!-- <div class="funkyradio-success">
                                 <input type="radio" name="test" value="c">
                                 <label for="checkbox3">Session</label>
                             </div>-->
                            <!--<div class="funkyradio-danger">
                                <input type="radio" name="test" value="d">
                                <label for="checkbox4">Life Time</label>
                            </div>-->

                        </div>

                    </div>
                    <div class="col-sm-6 new-section2">
                        <div class="col-sm-12" id="show-me">
                            <div class="col-sm-6" style="display:none">
                                <div class="funkyradio">
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="checkbox" id="">
                                        <label for="checkbox1">April</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="checkbox" id="">
                                        <label for="checkbox1">May</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="checkbox" id="">
                                        <label for="checkbox1">June</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="checkbox" id="">
                                        <label for="checkbox1">July</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="checkbox" id="">
                                        <label for="checkbox1">August</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="checkbox" id="">
                                        <label for="checkbox1">Sepsember</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" style="display:none">
                                <div class="funkyradio">
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="checkbox" id="">
                                        <label for="checkbox1">October</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="checkbox" id="">
                                        <label for="checkbox1">November</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="checkbox" id="">
                                        <label for="checkbox1">December</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="checkbox" id="">
                                        <label for="checkbox1">January</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="checkbox" id="">
                                        <label for="checkbox1">Febuary</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="checkbox" id="">
                                        <label for="checkbox1">March</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" id="show-meb">
                            <div class="funkyradio">
                                <div class="funkyradio-default">
                                    <input type="checkbox" name="checkbox"
                                           id="" <?php if (array_key_exists("first", $discountarr)) echo 'checked';?>>
                                    <label for="checkbox1">Q1</label>
                                </div>
                                <div class="funkyradio-default">
                                    <input type="checkbox" name="checkbox"
                                           id="" <?php if (array_key_exists("second", $discountarr)) echo 'checked';?>>
                                    <label for="checkbox1">Q2</label>
                                </div>
                                <div class="funkyradio-default">
                                    <input type="checkbox" name="checkbox"
                                           id="" <?php if (array_key_exists("third", $discountarr)) echo 'checked';?>>
                                    <label for="checkbox1">Q3</label>
                                </div>
                                <div class="funkyradio-default">
                                    <input type="checkbox" name="checkbox"
                                           id="" <?php if (array_key_exists("fourth", $discountarr)) echo 'checked';?>>
                                    <label for="checkbox1">Q4</label>
                                </div>


                            </div>
                        </div>
                        <div class="col-sm-12" id="show-mec" style="display:none">
                            <div class="funkyradio">
                                <div class="funkyradio-default">
                                    <input type="checkbox" name="checkbox" id="">
                                    <label for="checkbox1">2016-2017</label>
                                </div>
                                <div class="funkyradio-default">
                                    <input type="checkbox" name="checkbox" id="">
                                    <label for="checkbox1">2017-2018</label>
                                </div>
                                <div class="funkyradio-default">
                                    <input type="checkbox" name="checkbox" id="">
                                    <label for="checkbox1">2019-2020</label>
                                </div>
                                <div class="funkyradio-default">
                                    <input type="checkbox" name="checkbox" id="">
                                    <label for="checkbox1">2021-2022</label>
                                </div>


                            </div>

                        </div>
                        <div class="col-sm-12" id="show-med" style="display:none">
                            <div class="funkyradio-default">
                                <input type="checkbox" name="checkbox" checked="">
                                <label for="checkbox1">Life Time</label>
                            </div>
                        </div>


                    </div>

                </div>

                <p class="mar-top">

                    <div id="firstquartertagg"></div>
                    <div id="secquartertagg"></div>
                    <div id="thirdquartertagg"></div>
                    <div id="forthquartertagg"></div>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading bg-accordian">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne2">Wave-off <span
                        class="text-center pull-right"></span></a>
            </h4>
        </div>


        <div id="collapseOne2" class="panel-collapse collapse">
            <div class="panel-body">

                <div class="row">

                    <div class="col-md-6 new-section2 row">


                        <div class="funkyradio">
                            <!--<div class="funkyradio-default">
                                <input type="radio" name="test2" value="e" checked="">
                                <label for="checkbox1">Monthly</label>
                            </div> -->
                            <div class="funkyradio-primary">
                                <input type="radio" name="test2" value="f">
                                <label for="checkbox2">Quaterly</label>
                            </div>
                            <!--<div class="funkyradio-success">
                                <input type="radio" name="test2" value="g">
                                <label for="checkbox3">Session</label>
                            </div>-->
                            <!--<div class="funkyradio-danger">
                               <input type="radio" name="test2" value="h">
                               <label for="checkbox4">Life Time</label>
                           </div>-->

                        </div>

                    </div>
                    <div class="col-sm-6 new-section2 row">
                        <div class="col-sm-12" id="show-mee">
                            <!--<div class="col-sm-6">
                                <div class="funkyradio">
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="test2" id="">
                                        <label for="checkbox1">April</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="test2" id="">
                                        <label for="checkbox1">May</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="test2" id="">
                                        <label for="checkbox1">June</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="test2" id="">
                                        <label for="checkbox1">July</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="test2" id="">
                                        <label for="checkbox1">August</label>
                                    </div>
                                    <div class="funkyradio-default">
                                        <input type="checkbox" name="test2" id="">
                                        <label for="checkbox1">Sepsember</label>
                                    </div>
                                </div>
                            </div>-->
                            <!-- <div class="col-sm-6">
                                 <div class="funkyradio">
                                     <div class="funkyradio-default">
                                         <input type="checkbox" name="test2" id="">
                                         <label for="checkbox1">October</label>
                                     </div>
                                     <div class="funkyradio-default">
                                         <input type="checkbox" name="test2" id="">
                                         <label for="checkbox1">November</label>
                                     </div>
                                     <div class="funkyradio-default">
                                         <input type="checkbox" name="test2" id="">
                                         <label for="checkbox1">December</label>
                                     </div>
                                     <div class="funkyradio-default">
                                         <input type="checkbox" name="test2" id="">
                                         <label for="checkbox1">January</label>
                                     </div>
                                     <div class="funkyradio-default">
                                         <input type="checkbox" name="" id="">
                                         <label for="checkbox1">Febuary</label>
                                     </div>
                                     <div class="funkyradio-default">
                                         <input type="checkbox" name="test2" id="">
                                         <label for="checkbox1">March</label>
                                     </div>
                                 </div>
                             </div>-->
                        </div>
                        <div class="col-sm-12" id="show-mef">
                            <div class="funkyradio">
                                <div class="funkyradio-default">
                                    <input type="checkbox"
                                           name="" <?php if ((array_key_exists("first", $discountarr)) AND $discountarr['first']['discount_percent'] == '100') echo 'checked';?>>
                                    <label for="checkbox1">Q1</label>
                                </div>
                                <div class="funkyradio-default">
                                    <input type="checkbox" name=""
                                           id="" <?php if ((array_key_exists("second", $discountarr)) AND $discountarr['first']['discount_percent'] == '100') echo 'checked';?>>
                                    <label for="checkbox1">Q2</label>
                                </div>
                                <div class="funkyradio-default">
                                    <input type="checkbox" name=""
                                           id="" <?php if ((array_key_exists("third", $discountarr)) AND $discountarr['first']['discount_percent'] == '100') echo 'checked';?>>
                                    <label for="checkbox1">Q3</label>
                                </div>
                                <div class="funkyradio-default">
                                    <input type="checkbox" name=""
                                           id="" <?php if ((array_key_exists("fourth", $discountarr)) AND $discountarr['first']['discount_percent'] == '100') echo 'checked';?>>
                                    <label for="checkbox1">Q4</label>
                                </div>


                            </div>
                        </div>
                        <div class="col-sm-12" id="show-meg" style="display:none">
                            <div class="funkyradio">
                                <div class="funkyradio-default">
                                    <input type="checkbox" name="" id="">
                                    <label for="checkbox1">2016-2017</label>
                                </div>
                                <div class="funkyradio-default">
                                    <input type="checkbox" name="" id="">
                                    <label for="checkbox1">2017-2018</label>
                                </div>
                                <div class="funkyradio-default">
                                    <input type="checkbox" name="" id="">
                                    <label for="checkbox1">2019-2020</label>
                                </div>
                                <div class="funkyradio-default">
                                    <input type="checkbox" name="" id="">
                                    <label for="checkbox1">2021-2022</label>
                                </div>


                            </div>
                        </div>
                        <div class="col-sm-12" id="show-meh" style="display:none">
                            <h5>Amount</h5>
                        </div>
                    </div>
                </div>
                <p class="mar-top"></p><!--Fees Waved-off, Month January, February-->
            </div>
        </div>
    </div>
</div>

<!--   dww-->

</div>
</div>
<!--container-fluid-->

<!-- .right-sidebar st here-->
</div>
<!---------------------------------------------------------->

<!---------------------------------------------------------->
<!-- /.container-fluid -->
<?php include'../includes/footer.php'; ?>

</div>
<!-- /#page-wrapper -->

<!-- /#wrapper -->
<?php include '../includes/foot.php'; ?>




<!--Style Switcher -->
<!--<script src="js/jQuery.style.switcher.js"></script>-->
<script type="text/javascript">
$(function () {
    var fname = document.getElementById('count').innerHTML;
    var aprilblnc = 0;
    var mayblnc = 0;
    var juneblnc = 0;
    var julyblnc = 0;
    var augblnc = 0;
    var sepblnc = 0;
    var octblnc = 0;
    var novblnc = 0;
    var decblnc = 0;
    var janblnc = 0;
    var febblnc = 0;
    var marblnc = 0;
    var penality = 0;

    for (var i = 1; i <= fname; i++) {
        var aprildata = document.getElementById("April" + i + "").innerHTML;
        if (aprildata == '') {
            var aprildata = 0;
        }
        var maydata = document.getElementById("May" + i + "").innerHTML;
        if (maydata == '') {
            var maydata = 0;
        }
        var junedata = document.getElementById("June" + i + "").innerHTML;
        if (junedata == '') {
            var junedata = 0;
        }
        var julydata = document.getElementById("July" + i + "").innerHTML;
        if (julydata == '') {
            var julydata = 0;
        }
        var augustdata = document.getElementById("August" + i + "").innerHTML;
        if (augustdata == '') {
            var augustdata = 0;
        }
        var septemberdata = document.getElementById("September" + i + "").innerHTML;
        if (septemberdata == '') {
            var septemberdata = 0;
        }
        var octoberdata = document.getElementById("October" + i + "").innerHTML;
        if (octoberdata == '') {
            var octoberdata = 0;
        }
        var novemberdata = document.getElementById("November" + i + "").innerHTML;
        if (novemberdata == '') {
            var novemberdata = 0;
        }
        var decemberdata = document.getElementById("December" + i + "").innerHTML;
        if (decemberdata == '') {
            var decemberdata = 0;
        }
        var januarydata = document.getElementById("January" + i + "").innerHTML;
        if (januarydata == '') {
            var januarydata = 0;
        }
        var februarydata = document.getElementById("February" + i + "").innerHTML;
        if (februarydata == '') {
            var februarydata = 0;
        }
        var marchdata = document.getElementById("March" + i + "").innerHTML;
        if (marchdata == '') {
            var marchdata = 0;
        }
        var aprilblnc = parseInt(aprilblnc) + parseInt(aprildata);
        var mayblnc = parseInt(mayblnc) + parseInt(maydata);
        var juneblnc = parseInt(juneblnc) + parseInt(junedata);
        var julyblnc = parseInt(julyblnc) + parseInt(julydata);
        var augblnc = parseInt(augblnc) + parseInt(augustdata);
        var sepblnc = parseInt(sepblnc) + parseInt(septemberdata);
        var octblnc = parseInt(octblnc) + parseInt(octoberdata);
        var novblnc = parseInt(novblnc) + parseInt(novemberdata);
        var decblnc = parseInt(decblnc) + parseInt(decemberdata);
        var janblnc = parseInt(janblnc) + parseInt(januarydata);
        var febblnc = parseInt(febblnc) + parseInt(februarydata);
        var marblnc = parseInt(marblnc) + parseInt(marchdata);


    }

    var onequarterfee = parseInt(aprilblnc) + parseInt(mayblnc) + parseInt(juneblnc);
    //AFTER DISCOUNT
    var disscountrate = 0;
    var firstquarterdiscount = document.getElementById("firstquarterdiscount").innerHTML;
    var disscountrate = (parseInt(onequarterfee) * parseInt(firstquarterdiscount)) / 100;
    document.getElementById("firstquartertagg").innerHTML = 'Rs.' + disscountrate + 'Discount on Q1';
    var secquarterfee = parseInt(julyblnc) + parseInt(augblnc) + parseInt(sepblnc);
    //AFTER DISCOUNT
    var secdisscountrate = 0;
    var secquarterdiscount = document.getElementById("secquarterdiscount").innerHTML;
    var secdisscountrate = (parseInt(secquarterfee) * parseInt(secquarterdiscount)) / 100;
    document.getElementById("secquartertagg").innerHTML = 'Rs.' + secdisscountrate + ' Discount on Q2';
    var thirdquarterfee = parseInt(octblnc) + parseInt(novblnc) + parseInt(decblnc);
    //THIRD QUARTER DISCOUNT
    var thrddisscountrate = 0;
    var thrdquarterdiscount = document.getElementById("thirdquarterdiscount").innerHTML;
    var thrddisscountrate = (parseInt(thirdquarterfee) * parseInt(thrdquarterdiscount)) / 100;
    document.getElementById("thirdquartertagg").innerHTML = 'Rs.' + thrddisscountrate + ' Discount on Q3';
    var fourthquarterfee = parseInt(janblnc) + parseInt(febblnc) + parseInt(marblnc);
    //THIRD QUARTER DISCOUNT
    var forthdisscountrate = 0;
    var forthquarterdiscount = document.getElementById("fourthquarterdiscount").innerHTML;
    var forthdisscountrate = (parseInt(fourthquarterfee) * parseInt(forthquarterdiscount)) / 100;
    document.getElementById("forthquartertagg").innerHTML = 'Rs.' + forthdisscountrate + ' Discount on Q4';
    //alert(fourthquarterfee);

	  var currentquarter = '<?php echo $type;?>';
	  //alert(currentquarter);
	var x = document.getElementById('newdiv');
	if(currentquarter=='No Due')
	{
		x.style.display = 'none';
		 document.getElementById("totalfee").innerHTML=0;

	}
	else
	{
		x.style.display = 'block';
	}
	
    var pendingfquarter = '<?php echo $pendingfquarter;?>';
	var pendingsquarter = '<?php echo $pendingsquarter;?>';
	//alert(pendingsquarter);
    var pendingtquarter = '<?php echo $pendingtquarter;?>';
	//alert(pendingtquarter);
    var pendingfrquarter = '<?php echo $pendingfrquarter;?>';
  
	
	
	
    var amount = 0;
    if (pendingfquarter == 0) {
		if(currentquarter!='first')
		{
			var amount = parseInt(amount) + parseInt(onequarterfee);
		}
		if (disscountrate != 0) {
            var tag = '<tr id="rowToClone1"><td class="total-border"><strong>First Quarter Discount</strong></td><td class="total-border" colspan="3"><div id="fdiscount">' + disscountrate + '</div></td></tr>';

        }
    }
	
    if (pendingsquarter == 0) {
		if(currentquarter!='second')
		{
		 var amount = parseInt(amount) + parseInt(secquarterfee);
		}
		
        if (secdisscountrate != 0) {
            var tag = tag + '<tr id="rowToClone1"><td class="total-border"><strong>Second Quarter Discount</strong></td><td class="total-border" colspan="3"><div id="sdiscount">' + secdisscountrate + '</div></td></tr>';

        }
    }
    if (pendingtquarter == 0) {
		if(currentquarter!='third')
		{
			var amount = parseInt(amount) + parseInt(thirdquarterfee);
		}
		 if (thrddisscountrate != 0) {
            var tag = tag + '<tr id="rowToClone1"><td class="total-border"><strong>Third Quarter Discount</strong></td><td class="total-border" colspan="3"><div id="tdiscount">' + thrddisscountrate + '</div></td></tr>';

        }
    }
	if (pendingfrquarter == 0) {
		if(currentquarter!='fourth')
		{
			var amount = parseInt(amount) + parseInt(fourthquarterfee);
		}
        if (forthdisscountrate != 0) {
            var tag = tag + '<tr id="rowToClone1"><td class="total-border"><strong>Fourth Quarter Discount</strong></td><td class="total-border" colspan="3"><div id="frdiscount">' + forthdisscountrate + '</div></td></tr>';
        }
    }
		//alert(amount);

    
    var totalfee = parseInt(onequarterfee) + parseInt(secquarterfee) + parseInt(thirdquarterfee) + parseInt(fourthquarterfee);

    document.getElementById("firstquarterfee").innerHTML = onequarterfee;
    document.getElementById("secondquarterfee").innerHTML = secquarterfee;
    document.getElementById("thirdquarterfee").innerHTML = thirdquarterfee;
    document.getElementById("fourthquarterfee").innerHTML = fourthquarterfee;
    //document.getElementById("totalfee").innerHTML = totalfee;
    var pendingdues = amount;
    var penality = document.getElementById("penality").innerHTML;
    if (document.getElementById("paydiv").innerHTML == 'first') {

        var a = $('#collapse1').html();
        var field = document.getElementById("firstquarterfee").innerHTML;
        var b = $('#newdiv').html(a);
        $('#newdiv').append('<tr id="rowToClone1"><td class="total-border"><strong>Previous Dues</strong></td><td class="total-border" colspan="3"><div id="pendingdues">' + pendingdues + '</div></td></tr><tr><td class="total-border"><strong>Penalty</strong></td><td class="total-border" colspan="3"><div id="penality">' + penality + '</div></td></tr><tr><td class="total-border"><strong>Net Total</strong></td><td class="total-border" colspan="3"><div id="grandtotal">...</div></td></tr><tr><td class="total-border" colspan="4" align="right"> <a href="javascript:void(0);" class="btn btn-success bord-radius">Click here for online payment</a></td></tr>')


    }
    else if (document.getElementById("paydiv").innerHTML == 'second') {

        var a = $('#collapse2').html();
        var field = document.getElementById("secondquarterfee").innerHTML;
        var b = $('#newdiv').html(a);
        $('#newdiv').append('<tr id="rowToClone1"><td class="total-border"><strong>Previous Dues</strong></td><td class="total-border" colspan="3"><div id="pendingdues">' + pendingdues + '</div></td></tr><tr><td class="total-border"><strong>Penalty</strong></td><td class="total-border" colspan="3"><div id="penality">' + penality + '</div></td></tr><tr><td class="total-border"><strong>Net Total</strong></td><td class="total-border" colspan="3"><div id="grandtotal">...</div></td></tr><tr><td class="total-border" colspan="4" align="right"> <a href="javascript:void(0);" class="btn btn-success bord-radius">Click here for online payment</a></td></tr>')


    }
    else if (document.getElementById("paydiv").innerHTML == 'third') {

        var a = $('#collaps3').html();
        var field = document.getElementById("thirdquarterfee").innerHTML;
        var b = $('#newdiv').html(a);
        $('#newdiv').append('<tr id="rowToClone1"><td class="total-border"><strong>Previous Dues</strong></td><td class="total-border" colspan="3"><div id="pendingdues">' + pendingdues + '</div></td></tr><tr><td class="total-border"><strong>Penalty</strong></td><td class="total-border" colspan="3"><div id="penality">' + penality + '</div></td></tr><tr><td class="total-border"><strong>Net Total</strong></td><td class="total-border" colspan="3"><div id="grandtotal">...</div></td></tr><tr><td class="total-border" colspan="4" align="right"> <a href="javascript:void(0);" class="btn btn-success bord-radius">Click here for online payment</a></td></tr>')


    }
    else if (document.getElementById("paydiv").innerHTML == 'fourth') {

        var a = $('#collapse4').html();
        var field = document.getElementById("fourthquarterfee").innerHTML;
        var b = $('#newdiv').html(a);
        $('#newdiv').append('<tr id="rowToClone1"><td class="total-border"><strong>Previous Dues</strong></td><td class="total-border" colspan="3"><div id="pendingdues">' + pendingdues + '</td></tr><tr><td class="total-border"><strong>Penality</strong></td><td class="total-border" colspan="3"><div id="penality">' + penality + '</div></td></tr>' + tag + '<tr><td class="total-border"><strong>Net Total</strong></td><td class="total-border" colspan="3"><div id="grandtotal">...</div></td></tr><tr><td class="total-border" colspan="4" align="right"> <a href="javascript:void(0);" class="btn btn-success bord-radius">Click here for online payment</a></td></tr>')


    } 
	var grandtotal = 0;
	var grandtotal = parseInt(field) + parseInt(penality) + parseInt(pendingdues);
    if (disscountrate != 0 && pendingfquarter == 0) {
		var grandtotal = parseInt(grandtotal) - parseInt(disscountrate);
    }
    if (secdisscountrate != 0 && pendingsquarter == 0) {
		var grandtotal = parseInt(grandtotal) - parseInt(secdisscountrate);
    }
    if (thrddisscountrate != 0 && pendingtquarter == 0) {
		var grandtotal = parseInt(grandtotal) - parseInt(thrddisscountrate);
    }
    if (forthdisscountrate != 0 && pendingfrquarter == 0) {
	   var grandtotal = parseInt(grandtotal) - parseInt(forthdisscountrate);
    }
    
    document.getElementById("grandtotal").innerHTML = grandtotal;
    document.getElementById("totalfee").innerHTML = grandtotal;
	
    $(".Payment").attr("user", pendingdues);

});
</script>
<script>
    $(".Payment").click(function () {
        var data_role = $("#totalfee").text();
        $('#pwd').val(data_role);
        var pay_div = $("#paydiv").text();
        var pending_dues = $("#pendingdues").html();
        var pending_dues = $('.Payment').attr("user");
        var penality_dues = $("#penality").text();
        $('#quarterpopup').val(pay_div);
        $('#penalitypopup').val(penality_dues);
        $('#pendingpopup').val(pending_dues);

        var fdiscount = 0;
        var sdiscount = 0;
        var tdiscount = 0;
        var frdiscount = 0;
        var fdiscount = $("#fdiscount").text();
        var sdiscount = $("#sdiscount").text();
        var tdiscount = $("#tdiscount").text();
        var frdiscount = $("#frdiscount").text();
        var discount = fdiscount + sdiscount + tdiscount + frdiscount;
        $('#discountpopup').val(discount);
        $("#myModalpay").modal('show');
    });
</script>

<div class="modal fade" id="myModalpay" role="dialog">
    <div class="modal-dialog">
        <form action="" method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;      </button>
                    <h4 class="modal-title">Pay-Now</h4>
                </div>
                <form method="post" action="">
                    <div id="alertmessage"></div>
                    <input type="hidden" name="stuid" value="<?php echo $studata['stu_id']; ?>">
                    <input type="hidden" class="form-control" name="quarterpopup" id="quarterpopup">
                    <input type="hidden" class="form-control" name="discountpopup" id="discountpopup">
                    <input type="hidden" class="form-control" name="penalitypopup" id="penalitypopup">
                    <input type="hidden" class="form-control" name="pendingpopup" id="pendingpopup">

                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Enter Amount:</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="pwd" name="rs" value=""
                                       placeholder="ENTER Rs" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label><input type="radio" id="cash_payment" name="messageticks" value="Cash"
                                                  checked="checked"> Cash</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <div class="checkbox">
                                    <label style="padding-bottom: 20px;">

                                        <input type="radio" name="messageticks" id="messsageticks" value="Cheque"
                                               style="">Cheque</label>

                                    <div class="contactmessages" style=display:none;>
                                        <table>
                                            <tr style="width:100%;">
                                                <label style="padding-bottom:20px;">Check Details</label>
                                                <td>
                                                    <label>Cheque Number</label>
                                                    <input type="text" name="cheque_no" id="cheque_no"
                                                           class="form-control" placeholder="Cheque Number">
                                                </td>
                                                <td style="margin-left:10px; padding-left:20px;">
                                                    <label>MICR CODE</label>
                                                    <input type="text" name="micr_code" id="micr_code"
                                                           class="form-control" placeholder="MICR CODE">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="submitfee" onclick="return checkvalidate()" class="btn btn-default">
                        <!--data-dismiss="modal"-->
                    </div>
                </form>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="fee-pdf" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row" id="myDiv">
                        <div class="well col-xs-10 col-sm-10 col-md-12">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-4">
                                    <address>
                                        <strong><?php echo $sch_name;?></strong>
                                        <br>
                                        2135 Sunset Blvd
                                        <br>
                                        New Delhi, CA 90026
                                        <br>
                                        <abbr title="Phone">P:</abbr> (213) 484-6829
                                    </address>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-4">
                                    <a href="javascript:void(0);"><img
                                            src="<?php echo HTTP_SERVER; ?>/<?php echo $dbname; ?>/uploads/<?php echo $sch_logo; ?>"
                                            class="img-responsive" style="margin: 0 auto;" alt="School Name"></a>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-4">
                                    <p class="text-center"><em><span>Date: </span><span id="receipt_date"></span></em>
                                    </p>

                                    <p class="text-center"><em>Receipt #: 34522677W</em></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center">
                                    <h2><b>Fee Receipt</b></h2>
                                </div>
                                <table class="table table-hover" id="first_qtr"
                                ">
                                <thead style="background-color: #5BC0DE;">
                                <tr>
                                    <th style="color:#fff;">S No.</th>
                                    <th style="color:#fff;">Apr</th>
                                    <th style="color:#fff;" class="text-center">May</th>
                                    <th style="color:#fff;" class="text-center">June</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><b>Mode of Payment:</b> Bank</td>
                                    <td colspan="2"><h4>Net Total:</h4></td>
                                    <td><h4>$339</h4></td>
                                </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="print" style="margin: 0 auto; text-align: center;">
                                <button class="btn btn-success" onclick="printDiv('myDiv')">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--FOR OPEN MODAL WITH JQUERY-->
    <script>
        jQuery(document).ready(function () {
            jQuery(".fee_pdf").click(function () {
                var tag = jQuery(this).attr("data-tag");
                var date = jQuery(this).attr("data-date");
                var first_qtr = jQuery("#" + tag + "").html();
                jQuery("#receipt_date").html(date);
                jQuery("#first_qtr").html(first_qtr);
                jQuery("#fee-pdf").modal('show');
            });
        });
        $("input[name='messageticks']").change(function () {
            //alert('hii');
            if ($(this).val() == "Cheque") {
                $(".contactmessages").css("display", "block");
            } else {
                $(".contactmessages").css("display", "none");
            }
        });
    </script>
    <script>
        function printDiv(myDiv) {
            var printContents = document.getElementById(myDiv).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
    <script>
        function checkvalidate() {
            var cheque = jQuery('input[name=messageticks]:checked').val();
            var cheque_no = jQuery('#cheque_no').val();
            var micr_code = jQuery('#micr_code').val();
            if (cheque == 'Cheque') {
                if (cheque_no == '') {
                    //alert("Please insert cheque no.");
                    jQuery("#alertmessage").html("Please insert Cheque Number")
                    jQuery('#cheque_no').focus();
                    return false;
                }
                if (micr_code == '') {
                    jQuery("#alertmessage").html("Please insert MICR Code.")
                    jQuery('#micr_code').focus();
                    return false;
                }
            }
        }
    </script>
</body>
</html>