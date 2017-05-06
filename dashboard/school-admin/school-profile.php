<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | School - Profile</title>
    <?php include '../includes/headteacher.php'; ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>    
    <div id="wrapper">
        <!-- Navigation -->
        <?php include'../includes/header-school.php'; ?>
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
                <div class="row bg-title">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting from 15 November 2016.</span></h4>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="../principal/principal.php">school</a>
                            </li>
                            <li class="active">Profile</li>
                        </ol>
                    </div>
                </div>


                <div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="my-box">
                            <h3 class="box-title box-title pad-b-10">Profile</h3>
							<section class="m-t-20">
								<div class="row">
									<div class="col-md-2 col-xs-12"><img src="../images/principal_img.jpg" alt="Teacher" class="img-responsive img-rounded img-thumbnail"></div>
									<div class="col-md-9 col-xs-12">
										<div class="panel panel-default">
											<!--<div class="panel-heading">Student Contact Details</div>-->
											<div class="panel-wrapper collapse in">
												<table class="table table-hover">
													<tbody>
														<tr>
															<td><strong>First Name </strong> </td>
															<td>Ms. Monika </td>
														</tr>
														<tr>
															<td><strong>Middle Name </strong> </td>
															<td>K</td>
														</tr>

														<tr>
															<td><strong>Last Name </strong> </td>
															<td>Sharma</td>
														</tr>
														<tr>
															<td><strong>Designation</strong> </td>
															<td>Principal</td>
														</tr>


														<tr>
															<td><strong>Teaching to </strong></td>
															<td>--</td>
														</tr>
														<tr>
															<td><strong>Contact No </strong></td>
															<td>9582098982 </td>
														</tr>
														<tr>
															<td><strong>Gender </strong></td>
															<td>Female </td>
														</tr>
                                                        <tr>
                                                            <td><strong>Date of Birth  </strong></td>
                                                            <td>02/09/1976 </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Address</strong></td>
                                                            <td>Alpha Administrative Complex Sector 6, Noida </td>
                                                        </tr>
														<tr>
                                                            <td><strong>Marital Status </strong></td>
                                                            <td>Married </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Qualification</strong></td>
                                                            <td>B-Ed </td>
                                                        </tr>                                                         
                                                        <tr>
                                                            <td><strong>Total Experience  </strong></td>
                                                            <td>8 Years </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Previous Experience  </strong></td>
                                                            <td>
                                                                <table>
                                                                    <tr>
                                                                        <td><strong>GNIT Noida</strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Assistant Principal</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2 Years 4 Months</td>
                                                                    </tr>
                                                                </table>
                                                                <hr />
                                                                <table>
                                                                    <tr>
                                                                        <td><strong>Sunlight School</strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Principal</td>
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
    </div>
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