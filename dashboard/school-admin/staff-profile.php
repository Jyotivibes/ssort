<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Chairman - Staff Profile</title>
    <?php include '../includes/head.php'; ?>



</head>

<body>    
    <div id="wrapper">
        <?php
        if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='SAD'))
        {
            $user_id=$_SESSION['USER']['USER_NAME'];
            require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
            require_once('../../classes/general_class.php');
            $obj = new General();
            $select=mysql_query("SELECT * FROM essort_user_header as a
            JOIN essort_user_details as b WHERE a.usr_id='".$_REQUEST['teach_id']."' AND a.usr_id=b.usr_id");
            $datas=mysql_fetch_array($select);
            //CLASS AND SECTION OF USER
            $classsql="SELECT * , (
			SELECT class_name
			FROM essort_classes AS a
			WHERE a.class_id = b.class_id
			) AS class,
			(SELECT section_name
			FROM essort_section AS c
			WHERE c.section_id = b.section_id
			) AS section
			FROM essort_teacher_class AS b
			WHERE staff_id = '".$_REQUEST['teach_id']."'";
            $classresult=mysql_query($classsql);
            $rowclass=mysql_fetch_array($classresult);
        }
        else
        {
            echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
        }
        ?>
        <!-- Navigation -->
         <?php include '../includes/header-configuration.php'; ?>
         
        <!--sidebar nav st-->
        <?php include '../includes/sidebar-school.php'; ?>
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
                <?php include '../includes/header-notice.php'; ?>


                <div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="my-box">
                            <h3 class="box-title box-title pad-b-10">Teacher Profile</h3>
							<section class="m-t-20">
								<div class="row">
									<div class="col-md-2 col-xs-12">
                                        <!--<img src="../images/indian-teacher.jpg" alt="Teacher" class="img-responsive img-rounded img-thumbnail">-->
                                        <?php
                                        $filename = "../images/".$datas['usr_pic'];
                                        if($datas['usr_pic'] == ""){
                                            ?>
                                            <img src="../images/images.png" class="img-responsive img-rounded  img-thumbnail"/>
                                        <?php
                                        }
                                        elseif(file_exists($filename)){
                                            ?>
                                            <img src="../images/<?php echo $datas['usr_pic']; ?>" alt="Teacher" class="img-responsive img-rounded  img-thumbnail"/>
                                        <?php
                                        }
                                        else{
                                            ?>
                                            <img src="../images/images.png" class="img-responsive img-rounded  img-thumbnail"/>
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
															<td><strong>First Name </strong> </td>
															<td><?php echo $datas['usr_fname']; ?> </td>
														</tr>
														<tr>
															<td><strong>Middle Name </strong> </td>
															<td><?php echo $datas['usr_mname']; ?></td>
														</tr>

														<tr>
															<td><strong>Last Name </strong> </td>
															<td><?php echo $datas['usr_lname']; ?></td>
														</tr>

														<tr>
															<td><strong>Teaching to </strong></td>
															<td><?php echo $rowclass['class'];?> -<?php echo $rowclass['section'];?></td>
														</tr>
														<tr>
															<td><strong>Contact No </strong></td>
															<td><?php echo $datas['usr_mobile']; ?> </td>
														</tr>
														<tr>
															<td><strong>Gender </strong></td>
															<td><?php echo $datas['usr_gender']; ?> </td>
														</tr>
                                                        <tr>
                                                            <td><strong>Date of Birth  </strong></td>
                                                            <td><?php
                                                                if($datas['usr_dob'] == '')
                                                                {
                                                                    echo "--";
                                                                }
                                                                else
                                                                {
                                                                    echo date('d-m-Y', strtotime($datas['usr_dob']));
                                                                }
                                                                ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Address</strong></td>
                                                            <td><?php echo $datas['usr_address']; ?> </td>
                                                        </tr>
														<tr>
                                                            <td><strong>Marital Status </strong></td>
                                                            <td><?php echo $datas['usr_marital_status']; ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Graduation </strong></td>
                                                            <td><?php echo $datas['graduation']; ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Post-Graduation </strong></td>
                                                            <td><?php echo $datas['master_graduation']; ?> </td>
                                                        </tr> 
                                                        <tr>
                                                            <td><strong>Teaching Experience  </strong></td>
                                                            <td><?php
                                                                if($datas['exp_yr'] == ''){
                                                                    echo "--";
                                                                }
                                                                else
                                                                {
                                                                    echo $datas['exp_yr'];
                                                                }
                                                                ?></td>
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
                    <input type="text" class="time start" placeholder="HH:MM:SS" /> Out Time
                    <input type="text" class="time end" placeholder="HH:MM:SS" />

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