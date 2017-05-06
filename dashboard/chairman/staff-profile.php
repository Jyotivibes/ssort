<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Chairman - Staff Profile</title>
    <?php include '../includes/headteacher.php'; ?>

   

</head>

<body>    
    <div id="wrapper">
        <!-- Navigation -->
         <?php include '../includes/header-chairman.php'; ?>
         
        <!--sidebar nav st-->
        <?php include '../includes/sidebar-chairman.php'; ?>
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
                                <a href="javascript:void(0);">Chairman</a>
                            </li>
                            <li class="active">Staff Profile</li>
                        </ol>
                    </div>
                </div>


                <div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="my-box">
                            <h3 class="box-title box-title pad-b-10">Teacher Profile</h3>
							<section class="m-t-20">
								<div class="row">
									<div class="col-md-2 col-xs-12"><img src="../images/indian-teacher.jpg" alt="Teacher" class="img-responsive img-rounded img-thumbnail"></div>
									<div class="col-md-9 col-xs-12">
										<div class="panel panel-default">
											<!--<div class="panel-heading">Student Contact Details</div>-->
											<div class="panel-wrapper collapse in">
												<table class="table table-hover">
													<tbody>
														<tr>
															<td><strong>First Name </strong> </td>
															<td>Ritu </td>
														</tr>
														<tr>
															<td><strong>Middle Name </strong> </td>
															<td>K</td>
														</tr>

														<tr>
															<td><strong>Last Name </strong> </td>
															<td>Verma</td>
														</tr>

														<tr>
															<td><strong>Teaching to </strong></td>
															<td>Nursery -D</td>
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
                                                            <td>Single </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Graduation </strong></td>
                                                            <td>B-Ed </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Post-Graduation </strong></td>
                                                            <td>MA </td>
                                                        </tr> 
                                                        <tr>
                                                            <td><strong>Teaching Experience  </strong></td>
                                                            <td>8 Years </td>
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