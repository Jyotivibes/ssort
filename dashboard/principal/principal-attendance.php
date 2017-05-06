<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | Principal Attendance</title>
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
		$sqlnote=mysql_query("SELECT * FROM  essort_circular_activities");
		require_once('../../classes/student_class.php');
	    $obj3 = new Student();
		
		require_once('../../classes/staff_class.php');
	    $obj2 = new Staff();
		$classes = $obj3->attsummaryofstudent();
		$staff = $obj2->allstaffstastics();
		
	}
	else
	{
		echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
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

                <!--notice circular row st-->
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="my-box">

                            <section class="m-t-40">
                                <!--tab st-->
                                <div class="sttabs-1 sttabs tabs-style-flip-1">
                                    <nav>
                                        <ul>
                                            <li class="tab-current tab-current-1"><a href="#student"><strong>Students</strong></a></li>
                                            <li><a href="#staff"><strong> Staff</strong></a></li>

                                        </ul>
                                    </nav>
                                    <div class="content-wrap">
                                        <section id="#student" class="content-current">
                                            <div class="panel panel-default">

                                                <div class="panel-wrapper collapse in table-responsive">
                                                    <table class="table table-bordered custom-table-two">
                                                    

                                                            <tr>
                                                                <td rowspan="3" colspan="2" class="text-center">
                                                                    <img src="<?php echo HTTP_SERVER; ?>/<?php echo $dbname; ?>/uploads/<?php echo $sch_logo;?>" style="width:100px;height:100px;" alt="Table Logo" />
                                                                </td>
                                                                <td colspan="12" class="text-center sectiopart">Section</td>

                                                            </tr>
                                                            <tr class="table-new">
                                                                <td colspan="3" class="text-center">A</td>
                                                                <td colspan="3" class="text-center">B</td>
                                                                <td colspan="3" class="text-center">C</td>
                                                                <td colspan="3" class="text-center">D</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table-present">Present</td>
                                                                <td class="table-absent">Absent</td>
                                                                <td class="table-total">Total</td>
                                                                <td class="table-present">Present</td>
                                                                <td class="table-absent">Absent</td>
                                                                <td class="table-total">Total</td>
                                                                <td class="table-present">Present</td>
                                                                <td class="table-absent">Absent</td>
                                                                <td class="table-total">Total</td>
                                                                <td class="table-present">Present</td>
                                                                <td class="table-absent">Absent</td>
                                                                <td class="table-total">Total</td>
                                                            </tr>

                                                            <tr>
                                                                <td rowspan="15">Class</td>

                                                            </tr>
															<?php
															
															foreach($classes as $key=>$classvlue){
															?>												
                                                            <tr class="text-center">
                                                                <td><?php echo $key;?></td>
                                                                <td><a href="#"><?php if (array_key_exists("A",$classvlue)) { echo $classvlue['A']['present_count'];} else {echo '-';} ?></a></td>
                                                                <td><a href="#"><?php  if (array_key_exists("A",$classvlue)) {echo $classvlue['A']['absent_count'];} else {echo '-';};?></a></td>
                                                                <td><a href="#"><?php  if (array_key_exists("A",$classvlue)) { echo $classvlue['A']['total_stu'];} else { echo '-';}?></a></td>
                                                                <td><a href="#"><?php  if (array_key_exists("B",$classvlue)) { echo $classvlue['B']['present_count'];} else {echo '-';}?></a></td>
                                                                <td><a href="#"><?php  if (array_key_exists("B",$classvlue)) {  echo $classvlue['B']['absent_count'];} else {echo '-';}?></a></td>
                                                                <td><a href="#"><?php if (array_key_exists("B",$classvlue)) { echo $classvlue['B']['total_stu'];} else {echo '-';}?></a></td>
                                                               <td><a href="#"><?php if (array_key_exists("C",$classvlue)) { echo $classvlue['C']['present_count'];} else {echo '-';}?></a></td>
                                                                <td><a href="#"><?php if (array_key_exists("C",$classvlue)) {  echo $classvlue['C']['absent_count'];} else {echo '-';}?></a></td>
                                                                <td><a href="#"><?php if (array_key_exists("C",$classvlue)) { echo $classvlue['C']['total_stu'];} else {echo '-';};?></a></td>
                                                                <td><a href="#"><?php if (array_key_exists("D",$classvlue)) {  echo $classvlue['D']['present_count'];} else {echo '-';}?></a></td>
                                                                <td><a href="#"><?php if (array_key_exists("D",$classvlue)) {   echo $classvlue['D']['absent_count'];} else {echo '-';}?></a></td>
                                                                <td><a href="#"><?php if (array_key_exists("D",$classvlue)) { echo $classvlue['D']['total_stu'];} else { echo '-';}?></a></td>
                                                            </tr>
															<?php
															}
															?>
                                                        </table>
                                                </div>
                                            </div>
                                        </section>

                                        <section id="#staff" class="">
                                            <div class="panel panel-default">
                                                <div class="panel-wrapper collapse in table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead class="table-new">
                                                            <tr>
                                                                <th>Category</th>
                                                                <th>Present</th>
                                                                <th>Absent</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
														<?php
														foreach($staff as $key=>$staffvalue)
														{
														
														?>
                                                            <tr>
                                                                <td><?php echo $key;?></td>
                                                                <td><?php echo $staffvalue['PRESENT'];?></td>
                                                                <td><?php echo $staffvalue['ABSENT'];?></td>
                                                                <td><?php echo $staffvalue['total'];?></td>
                                                            </tr>
                                                        <?php 
														}
														?>														
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </section>





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


            <!-- .right-sidebar st here-->
        </div>   </div>
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