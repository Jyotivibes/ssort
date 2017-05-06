<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | School Students</title>
    <?php include '../includes/head.php'; ?> 

</head>

<body>
   
    <div id="wrapper">
	<?php
		if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='SAD') )
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
		require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
		require_once('../../classes/general_class.php');
		$obj = new General();
		include_once 'stastics.php';
		
	}
	else
	{
		echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
	} 
?>	
        <!-- Navigation -->
        <?php include'../includes/header-configuration.php'; ?>        
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
                                <a href="javascript:void(0);">School</a>
                            </li>
                            <li class="active">Student</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <!--notice circular row st-->
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="my-box">

                            <section class="m-t-40">
                                <!--tab st-->
                                <div class="sttabs-1 sttabs tabs-style-flip-1">
                                    <nav>
                                        <ul>
                                            <li class="tab-current tab-current-1"><a href="#student"><strong>Students Attendance</strong></a></li>
                                            <li><a href="#staff"><strong> Students Fee</strong></a></li>

                                        </ul>
                                    </nav>
                                    <div class="content-wrap">
                                        
                                        <section id="#student" class="content-current">
                                         
                                                                  <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                          <div class="col-sm-12 col-xs-12">
                        <!--latest circular st-->
						<div class="mar-top clearfix">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <select class="form-control" id="class1" onchange="showSubType(this.value,this.id);">
								  <option value="">Select Class</option>
								  <?php
								  echo $class;
								  ?>
									
								  </select>
								</div>
							</div>	
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <select class="form-control" id="section1">
								   
								  </select>
								</div>
							</div>
                            
                              
                            
    						
                          
						</div>
					</div>
                        <div class="my-box comment-center">
                            <div class="c_teach_att_search clearfix">
                                <div class="pull-left">
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="date" class="form-control">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <div class="input-group">
                                        <input type="search" class="form-control">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive new_tbl_height_two2">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-bg1">
                                            <th>S No.</th>
                                            <th>Name</th>
                                            <th>Profile</th>
                                            <th>Admission No.</th>
                                            <th>Status</th>
                                            <th>In Time</th>
                                            <th>Out Time</th> 
                                            <th>Edit</th>

                                        </tr>
                                    </thead>
                                    <tbody class="c_teach_tabel">
									<?php
									foreach($stuidarr as $stuvar)
									{
									?>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td><?php echo $stuvar['USERFNAME']?></td>
                                            <td><img src="../images/father-pic.jpg"></td>
                                            <td>101162</td>
                                            <td><?php echo $stuvar['att_status']?></td>
                                            <td><?php echo $stuvar['att_intime']?></td>
                                            <td><?php echo $stuvar['att_outtime']?></td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal" data-target="#myModal">
                                                    <i class="fa fa-pencil-square font-icon-size" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--progress en-->

                    </div>
                    <!--col-en-->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <!--latest circular st-->
						<div class="my-box clearfix">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <select class="form-control" id="sel1">
									<?php echo $stuoption; ?>
								  </select>
								</div>
							</div>	
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <select class="form-control" id="sel1">
									<option>April</option>
									<option>May</option>
									<option>June</option>
									<option>July</option>
									<option>August</option>
									<option>September</option>
									<option>October</option>
									<option>November</option>
									<option>December</option>
									<option>January</option>
									<option>February</option>
									<option>March</option>
								  </select>
								</div>
							</div>
                            <div id="chartdiv"></div>
    						
                            <div>
                              <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-bg1">
                                            <th>Month</th>
                                            <th>No of Days</th>
                                            <th>Days Present</th>
                                            <th>Days Absent</th>
                                        </tr>
                                    </thead>
                                    <tbody class="c_teach_tabel">
                                        <tr>
                                            <td>April</td>
                                            <td>25</td>
                                            <td>24</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>May</td>
                                            <td>25</td>
                                            <td>24</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>June</td>
                                            <td>25</td>
                                            <td>24</td>
                                            <td>1</td>
                                        </tr>
                                            <tr><td>July</td>
                                            <td>25</td>
                                            <td>24</td>
                                            <td>1</td>
                                        </tr>
                                            <tr><td>August</td>
                                            <td>25</td>
                                            <td>24</td>
                                            <td>1</td>
                                        </tr>
                                            <tr><td>September</td>
                                            <td>25</td>
                                            <td>24</td>
                                            <td>1</td>
                                        </tr>
                                            <tr><td>October</td>
                                            <td>25</td>
                                            <td>24</td>
                                            <td>1</td>
                                        </tr>
                                            <tr><td>November</td>
                                            <td>25</td>
                                            <td>24</td>
                                            <td>1</td>
                                        </tr>
                                            <tr><td>December</td>
                                            <td>25</td>
                                            <td>24</td>
                                            <td>1</td>
                                        </tr>
                                            <tr><td>January</td>
                                            <td>25</td>
                                            <td>24</td>
                                            <td>1</td>
                                        </tr>
                                            <tr><td>February</td>
                                            <td>25</td>
                                            <td>24</td>
                                            <td>1</td>
                                        </tr>
                                            <tr><td>March</td>
                                            <td>25</td>
                                            <td>24</td>
                                            <td>1</td>
                                        </tr>
                                    </tbody>
                                </table>  
                            </div>
						</div>
					</div>
                                                                      
                        <!--latest circular en-->
                    </div>
                
                                        </section>
                                        
                              <!--Second  tabs start-->

                                        <section id="#staff" class="">
                              <div class="row"> 
                                   <div class="col-sm-offset-9 col-sm-3 pull-left">
                                                                                    <select class="form-control" id="sel1">
                                                                                            <option>January</option>
                                                                                            <option>February</option>
                                                                                            <option>March</option>
                                                                                            <option>April</option>
                                                                                            <option>May</option>
                                                                                            <option>June</option>
                                                                                            <option>July</option>
                                                                                            <option>August</option>
                                                                                            <option>September</option>
                                                                                            <option>October</option>
                                                                                            <option>November</option>
                                                                                            <option>December</option>
                                                                                    </select>
                                                                                </div>
                    <div class="col-sm-12 col-xs-12 mar-top my-box">
                    
                       
                           
                      
                       
                            <div class="col-sm-4 col-xs-12">
                            <div class="panel message-center panel-embose bg-color-box user-img tot-staff-bg">
                               <div class="content">
                                    <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">
                                    <div>
                                        <span>Total Students</span>
                                        <h1 class="my-white">55</h1>
                                    </div>
                                </div>
                            </div><!--en panel-->
                            </div><!--en col-->
                             <div class="col-sm-4 col-xs-12">
                            <div class="panel message-center panel-embose bg-color-box staffp-bg">
                               <div class="content">
                                    <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">
                                    <div>
                                        <span>Students Fee Received</span>
                                        <h1 class="my-white">45</h1>
                                    </div>
                                </div>
                            </div><!--en panel-->
                            </div><!--en col-->
                             <div class="col-sm-4 col-xs-12">
                            <div class="panel message-center panel-embose bg-color-box staffa-bg">
                               <div class="content">
                                    <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">
                                    <div>
                                        <span>Students Fee Pending</span>
                                        <h1 class="my-white">10</h1>
                                    </div>
                                </div>
                            </div><!--en panel-->
                            </div><!--en col-->
                        
                        <!--latest circular st-->
						<div class="clearfix">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
                                    <h5>Select Class</h5>
								  <select class="form-control" id="sel1">
									
									<option>NUR</option>
									<option>KG</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
									<option>6</option>
									<option>7</option>
									<option>8</option>
									<option>9</option>
									<option>10</option>
									<option>11</option>
									<option>12</option>
								  </select>
								</div>
							</div>	
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
                                    <h5>Select Section</h5>
								  <select class="form-control" id="sel1">
									
									<option>A</option>
									<option>B</option>
									<option>C</option>
									<option>D</option>
									
								  </select>
								</div>
							</div>
                        </div>
                        	
                               <div class="table-responsive">
                                                                                <table class="table table-bordered">
                                                                                    <thead>
                                                                                        <tr class="table-bg1">
                                                                                            <th>S No.</th>
                                                                                            <th>Name</th>
                                                                                            <th>Profile</th>
                                                                                            <th>Admission No.</th>
                                                                                            <th>Last Payment Amount</th>
                                                                                            <th>Last Payment Date</th>
                                                                                            <th>Current Dues</th>
                                                                                            <th>View Details</th>

                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody class="c_teach_tabel">
                                                                                        <tr>
                                                                                            <td class="text-center">1</td>
                                                                                            <td>Abhi Singh</td>
                                                                                            <td><a href="../school-admin/school-profile.php"><img src="../images/father-pic.jpg"></a>
                                                                                            </td>
                                                                                            <td>101162</td>
                                                                                            <td>25000</td>
                                                                                            <td>25-11-2016</td>
                                                                                            <td>12000</td>
                                                                                            <td>
                                                                                              <a href="../school-admin/school-admin-fee.php" >  <i class="fa fa-eye view_btn" aria-hidden="true"></i></a>

                                                                                            </td>

                                                                                        </tr>
                                                                                        <tr class="table-tr1">
                                                                                            <td class="text-center">2</td>
                                                                                            <td>Abhi Singh</td>
                                                                                             <td><a href="../school-admin/school-profile.php"><img src="../images/father-pic.jpg"></a>                                                                                             </td>
                                                                                          
                                                                                            <td>101162</td>
                                                                                            <td>25000</td>
                                                                                            <td>25-11-2016</td>
                                                                                            <td>15000</td>
                                                                                            <td class="text-center">
                                                                                            <a href="../school-admin/school-admin-fee.php" >  <i class="fa fa-eye view_btn" aria-hidden="true"></i></a>
                                                                                            </td>

                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="text-center">3</td>
                                                                                            <td>Abhi Singh</td>
                                                                                             <td><a href="../school-admin/school-profile.php"><img src="../images/father-pic.jpg"></a>                                                                                             </td>
                                                                                           
                                                                                            <td>101162</td>
                                                                                            <td>25000</td>
                                                                                            <td>25-11-2016</td>
                                                                                            <td>13000</td>
                                                                                            <td class="text-center">
                                                                                                <a href="../school-admin/school-admin-fee.php" >  <i class="fa fa-eye view_btn" aria-hidden="true"></i></a>

                                                                                            </td>

                                                                                        </tr>
                                                                                        <tr class="table-tr1">
                                                                                            <td class="text-center">4</td>
                                                                                            <td>Abhi Singh</td>
                                                                                             <td><a href="../school-admin/school-profile.php"><img src="../images/father-pic.jpg"></a>                                                                                             </td>
                                                                                          
                                                                                            <td>101162</td>
                                                                                            <td>25000</td>
                                                                                            <td>25-11-2016</td>

                                                                                            <td>14000</td>
                                                                                            <td class="text-center">
                                                                                                <a href="../school-admin/school-admin-fee.php" >  <i class="fa fa-eye view_btn" aria-hidden="true"></i></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                   </table>
                            </div>   </div>
                              
                            
    						
                          
						</div>
				
                                              
                                         
                                        </section>
                             <!--end second tab-->





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
                    <div class="col-lg-6">
                        <label class="m-t-20">Intime</label>
                        <div class="input-group clockpicker">
                            <input class="form-control" value="09:30" type="text">
                            <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
                        </div>        
                    </div>
                    <div class="col-lg-6">
                        <label class="m-t-20">Outtime</label>
                        <div class="input-group clockpicker">
                            <input class="form-control" value="09:30" type="text">
                            <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
                        </div>        
                    </div>
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