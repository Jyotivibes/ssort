<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Admin Staff</title>
    <?php include '../includes/head.php'; ?>
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
		include_once 'stastics.php';  
		
	}
	else
	{
		echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
	} 
?>	
        <!-- Navigation -->
        <?php include '../includes/header-configuration.php'; ?>
        <!--sidebar nav st-->
        <?php include '../includes/sidebar-principal.php'; ?>
        <!--sidebar nav en-->
        <!-- Page Content -->
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

            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting from 15 November 2016.</span></h4>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="javascript:void(0);">Principal</a>
                            </li>
                            <li class="active">Administration</li>
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
                                            <li class="tab-current tab-current-1"><a href="#student"><strong>Staff Attendance</strong></a>
                                            </li>
                                            <li><a href="#staff"><strong> Staff Salary</strong></a>
                                            </li>

                                        </ul>
                                    </nav>
                                    <div class="content-wrap">
                                        <section id="#student" class="content-current">
                                            <div>

                                                <div>
                                                    <div class="row">
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
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

                                                                <div class="table-responsive new_tbl_height_one">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr class="table-bg1">
                                                                                <th>S No.</th>
                                                                                <th>Name</th>
                                                                                <th>Profile</th>
                                                                                <th>Emp Id</th>
                                                                                <th>Designation</th>
                                                                                <th>In Time</th>
                                                                                <th>Out Time</th>
                                                                                <th>Edit</th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="c_teach_tabel">

                                                                                <tr>
                                                                                    <td class="text-center">1</td>
                                                                                    <td>Abhi Singh</td>
                                                                                    <td>
                                                                                        <a href="../principal/profile.php"><img src="../images/father-pic.jpg">
                                                                                        </a>
                                                                                    </td>

                                                                                    <td>101162</td>
                                                                                    <td>Teacher</td>
                                                                                    <td>12 : 25 </td>
                                                                                    <td>6 : 25</td>
                                                                                    <td class="text-center">
                                                                                        <a href="#" data-toggle="modal" data-target="#myModal">
                                                                                            <i class="fa fa-pencil-square font-icon-size" aria-hidden="true"></i>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                               
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <!--progress en-->

                                                        </div>


                                                        <!--col-en-->
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <!--latest circular st-->

                                                            <div class="col-sm-12 prin-1 panel-embose-b my-box">
                                                                <div class="col-md-3">
                                                                    <img src="../images/staff.png" alt="user" class="img-size img-circle">
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="mail-contnet">
                                                                        <h5 class="text-center">Staff</h5>
                                                                        <h5 class="head-web">60</h5>
                                                                    </div>
                                                                    <div class="col-md-6 for_new">
                                                                        <button type="button" class="panel-embose-d btn btn-success btn-sm"> 55</button>
                                                                    </div>
                                                                    <div class="col-md-6 for_new">
                                                                        <button type="button" class="panel-embose-d btn btn-danger btn-sm"> 5</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="my-box fee-head">
                                                                <h5 class="text-center"> <a href="#">Staff on Leave</a></h5>
                                                                <div class="staff-table">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th>Designation</th>
                                                                                <th>View</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Chinmay Raj</td>
                                                                                <td>Teacher</td>
                                                                                <td>
                                                                                    <a href="javascript:void(0);">
                                                                                        <i="" class="view_btn fa fa-eye" data-target="#myModal" data-target="#myModal" aria-hidden="true"></i>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Kapil chauhan</td>
                                                                                <td>Teacher</td>
                                                                                <td>
                                                                                    <a href="javascript:void(0)">
                                                                                        <i="" class="view_btn fa fa-eye" data-target="#myModal" aria-hidden="true"></i>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Gaurav Pandey</td>
                                                                                <td>Teacher</td>
                                                                                <td>
                                                                                    <a href="javascript:void(0)">
                                                                                        <i="" class="view_btn fa fa-eye" data-target="#myModal" aria-hidden="true"></i>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Abhay yadav</td>
                                                                                <td>Teacher</td>
                                                                                <td>
                                                                                    <a href="javascript:void(0)">
                                                                                        <i="" class="view_btn fa fa-eye" data-target="#myModal" aria-hidden="true"></i>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Sunny Chauhan</td>
                                                                                <td>Teacher</td>
                                                                                <td>
                                                                                    <a href="javascript:void(0)">
                                                                                        <i="" class="view_btn fa fa-eye" data-target="#myModal" aria-hidden="true"></i>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <div class="my-box clearfix">

                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <select class="form-control" id="sel1">
                                                                           <?php echo $optionstaff; ?>
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
                                                                            <tr>
                                                                                <td>July</td>
                                                                                <td>25</td>
                                                                                <td>24</td>
                                                                                <td>1</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>August</td>
                                                                                <td>25</td>
                                                                                <td>24</td>
                                                                                <td>1</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>September</td>
                                                                                <td>25</td>
                                                                                <td>24</td>
                                                                                <td>1</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>October</td>
                                                                                <td>25</td>
                                                                                <td>24</td>
                                                                                <td>1</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>November</td>
                                                                                <td>25</td>
                                                                                <td>24</td>
                                                                                <td>1</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>December</td>
                                                                                <td>25</td>
                                                                                <td>24</td>
                                                                                <td>1</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>January</td>
                                                                                <td>25</td>
                                                                                <td>24</td>
                                                                                <td>1</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>February</td>
                                                                                <td>25</td>
                                                                                <td>24</td>
                                                                                <td>1</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>March</td>
                                                                                <td>25</td>
                                                                                <td>24</td>
                                                                                <td>1</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>



                                                            </div>


                                                        </div>
                                                        <div class="table-box col-sm-12 bottom-22 my-box">


                                                            <div class="table-responsive">
                                                                <h5 class="text-center"><b>Staff Leave Summary</b></h5>

                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S No.</th>
                                                                            <th>Name</th>
                                                                            <th>Profile</th>
                                                                            <th>Designation</th>
                                                                            <th>From</th>
                                                                            <th>To</th>
                                                                            <th>View</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td>Abhay Yadav</td>
                                                                            <td class="c_teach_tabel">
                                                                                <a href="../principal/profile.php"><img src="../images/father-pic.jpg">
                                                                                </a>
                                                                            </td>
                                                                            <td>Teacher</td>
                                                                            <td>01-12-2016</td>
                                                                            <td>05-12-2016</td>
                                                                            <td>
                                                                                <a href="#id">
                                                                                    <i="" class="view_btn fa fa-eye" data-target="#myModal" aria-hidden="true">
                                                                                </a>
                                                                            </td>
                                                                            <td>
                                                                                <button type="button" class="btn btn-danger btn-sm">cancel</button>
                                                                            </td>

                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="table-box col-sm-12 my-box">


                                                            <div class="table-responsive">
                                                                <h5 class="text-center"><b>New Staff Login Approval</b></h5>

                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S No.</th>
                                                                            <th>Name</th>
                                                                            <th class="text-center">Profile</th>
                                                                            <th class="text-center">Designation</th>
                                                                            <th class="text-center">Date of Joining</th>
                                                                            <th class="text-center">class</th>
                                                                            <th class="text-center">Section</th>
                                                                            <th class="text-center">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td>Abhay Yadav</td>
                                                                            <td class="c_teach_tabel text-center">
                                                                                <a href="../principal/profile.php"><img src="../images/father-pic.jpg">
                                                                                </a>
                                                                            </td>
                                                                            <td class="text-center">Teacher</td>
                                                                            <td class="text-center">01-12-2012</td>
                                                                            <td class="text-center">12th</td>
                                                                            <td class="text-center">A</td>

                                                                            <td class="text-center">
                                                                                <a href="#">
                                                                                    <button type="button" class="btn btn-success btn-sm">Approve</button>
                                                                                </a>
                                                                            </td>


                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <!-- sunny25 -->



                                                    </div>
                                                </div>

                                            </div>

                                        </section>

                                        <!-- first tab end -->

                                        <section id="#staff">
                                            <div>
                                                <div class="panel-wrapper collapse in table-responsive">
                                                    <section id="#student" class="content-current">
                                                        <div>

                                                            <div>
                                                                <div class="row">
                                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                                        <div class="my-box comment-center">
                                                                            <div class="c_teach_att_search clearfix">
                                                                                 <div class="col-md-4 col-sm-4 col-xs-12">
																					<select class="form-control" id="salyear" name="salyear">
																					<option>2017-2018</option>
																							<option>2016-2017</option>
																							<option>2015-2016</option>
																							<option>2014-2015</option>
																							<option>2013-2014</option>
																							<option>2012-2013</option>
																							
																					</select>
                                                                                    </div>
																			
																			<div class="col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="pull-left">
                                                                                    <select class="form-control" id="salmonth" name="salmonth">
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
                                                                                </div>
																				 <div class="col-md-4 col-sm-4 col-xs-12">
																					<div class="pull-right">
																						<div class="input-group">
																							<input class="form-control" type="search" name="elementsearch" id="salarydata"><!--id="salarydata"-->
																							<div class="input-group-addon">
																								<span class="glyphicon glyphicon-search"></span>
																							</div>
																						</div>
																					</div>
																				</div>

                                                                                <div class="row col-sm-7 mar-top">
                                                                                    <!--<h5><b>Total Salary: <i class="fa fa-inr" aria-hidden="true" id="total_salary"></i> 600000</b></h5>-->
                                                                                </div>
                                                                                <div class="row col-sm-3 pull-right mar-top">
                                                                                    <div class="input-group">

                                                                                        <input type="button" class="all-btm form-control btnGetAll" aria-label="Approve" value="Approve">
                                                                                        <span class="input-group-addon">
                                                                                         <input type="checkbox" aria-label="Approve" class="chkSelectAll">
                                                                                    </span>
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
                                                                                            <th>Emp Id</th>
                                                                                            <th>Designation</th>
                                                                                            <th>Salary</th>
                                                                                            <th>Status</th>
                                                                                            <th></th>

                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody class="c_teach_tabel" id="c_teach_staffsal">
																					<?php
																					foreach($rowatt as $rvlue)
																					{
																						if($rvlue['usr_pic']=='')
																						{
																							$rvlue['usr_pic']='images.png';
																						}
																					?>
                                                                                        <tr>
                                                                                            <td class="text-center">1</td>
                                                                                            <td><?php echo $rvlue['usr_fname'];?></td>
                                                                                            <td><a href="staff-profile.php?teach_id=<?php echo $rvlue['usr_id'];?>"><img src="../../<?php echo $_SESSION['USER']['DB_NAME'];?>/uploads/<?php echo $rvlue['usr_pic'];?>"></a>
                                                                                            </td>
                                                                                            <td><?php echo $rvlue['emp_id'];?></td>
                                                                                            <td><?php echo $rvlue['dept_name'];?></td>
                                                                                            <td><?php echo $rvlue['usr_salary'];?></td>
                                                                                            <td><?php echo $rvlue['salary_status'];?></td>
																							<td class="text-center">
                                                                                                <input type="checkbox" class="chkNumber" value="<?php echo $rvlue['sal_info_id'];?>">
                                                                                            </td>
                                                                                           

                                                                                        </tr>
                                                                                    <?php
																					}
																					?>	
                                                                                       
                                                                                       
                                                                                    </tbody>
                                                                                </table>

                                                                            </div>

                                                                            <div class="col-sm-6 margin-to">
                                                                                <p class="pull-right"><span class="green_o">&#9632;</span> P&#8594; Pending</p>
                                                                            </div>

                                                                            <div class="col-sm-6 margin-to">
                                                                                <p class="pull-left"><span class="red_o">&#9632;</span> A&#8594; Approved</p>
                                                                            </div>


                                                                        </div>
                                                                        <!--progress en-->

                                                                    </div>


                                                                    <!--col-en-->
                                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                                        <div class="my-box clearfix ">
                                                                            <h5 class="text-center"><b>Last 5 Months Salary Summary</b></h5>
                                                                            <div class="table-responsive">
                                                                                <table class="table table-bordered">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Months</th>
                                                                                            <th>No. of Staff</th>
                                                                                            <th>Ammount</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                       <?php
																					   
																					foreach($saldata as $sqlvlue)
																					{
																					?>
                                                                                      <tr>
                                                                                        <td><?php echo $sqlvlue['m'];?></td>
                                                                                        <td><?php echo $sqlvlue['NO_OF_STAFF'];?></td>
                                                                                        <td><i class="fa fa-inr" aria-hidden="true"></i><?php echo $sqlvlue['salary_amount'];?></td>
                                                                                      </tr>
																				 <?php
																				 }
																				 ?>
                                                                                      </tbody>
                                                                                </table>

                                                                            </div>
                                                                            <div id="stackedbar" style="width:100%; height:180px;"></div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                                        <!--latest circular st-->


                                                                        <div class="my-box clearfix">

                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <select class="form-control" id="staffname">
                                                                                        <?php echo $optionstaff; ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                   <select class="form-control staff_sal" id="staffyear">
																					<option value="2017-2018">2017-2018</option>
																						<option value="2016-2017">2016-2017</option>
                                                                                        <option value="2015-2016">2015-2016</option>
                                                                                        <option value="2014-2015">2014-2015</option>
                                                                                        <option value="2013-2014">2013-2014</option>
                                                                                        <option value="2012-2013">2012-2013</option>
                                                                                        
                                                                                    </select>
                                                                                </div>
                                                                            </div>


                                                                            <div class="col-sm-12 table-responsive">
                                                                                <table class="table table-bordered">
                                                                                    <thead>
                                                                                        <tr class="table-bg1">
                                                                                            <th>Month</th>
                                                                                            <th>Salary</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody class="c_teach_tabel" id="salsidemenu">
                                                                                   <?php
																					foreach($salmonthlydata as $salv)
																					{
																					?>

                                                                                        <tr>
                                                                                            <td><?php echo $salv['salary_month'];?></td>
                                                                                            <td><?php echo $salv['salary_amount'];?></td>

                                                                                        </tr>
                                                                                     <?php
																					 }
																					 ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
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

            </div>

            <!-- .right-sidebar st here-->
        </div>
        <!-- Modal -->
        <div class="modal fade my-modal" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Attendance</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-inline">
                            <div class="col-lg-6">
                                <label>Intime</label>
                                <div class="input-group clockpicker">
                                    <input class="form-control" value="09:30" type="text">
                                    <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Outtime</label>
                                <div class="input-group clockpicker">
                                    <input class="form-control" value="09:30" type="text">
                                    <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Modal -->
        <!-- /.container-fluid -->
         <?php include'../includes/footer.php'; ?>
    </div>
    <!-- /#wrapper -->
    <?php include '../includes/foot.php'; ?>
    <!--Style Switcher -->
	<script type="text/javascript">
$("#targetresult").click(function(e) {
var action='searchstaff';
var session = '<?php echo $dbname; ?>'; 
var txtElement = $("#search").val(); 
var date = $("#date").val(); 
//if(txtElement=='')
//{
	//return false;
//}
//if(date=='')
//{
	//return false;
//}
var dataString = 'element='+txtElement+'&session='+session+'&date='+date+'&action='+action;

 $.ajax({
	type:'POST',
	data:dataString,
	url:'../../ajax.php',
	success:function(data) {
		if(data!="")
				{
					//window.location.reload();
					if(data==1){
						alert("Required Parameter Missing");
						$("#preloader").css("display","none");
						return false;  
					}
					else if(data==4){
						alert("Session Expired......Try Again.....");
						$("#preloader").css("display","none");
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						//window.location.reload();
					}
					else{
						//alert("Successfully");
						$("#preloader").css("display","none");
						$("#Table").html(data);
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						//window.location.reload();
					}
				}
	}

  });
  
});
///////////////////////////

$("#salarydata").click(function(e) {
var action='searchsalarydataprinc';
var salyear = $("#salyear").val(); 
var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>'; 
var salmonth = $("#salmonth").val(); 
var elementsearch = $("#salarydata").val(); 
var dataString = 'salyear='+salyear+'&salmonth='+salmonth+'&session='+session+'&elementsearch='+elementsearch+'&action='+action;
alert(dataString);
$.ajax({
	type:'POST',
	data:dataString,
	url:'../../ajax.php',
	success:function(data) {
	//alert(data);
		if(data!="")
				{
					//window.location.reload();
					if(data==1){
						alert("Required Parameter Missing");
						$("#preloader").css("display","none");
						return false;  
					}
					else if(data==4){
						alert("Session Expired......Try Again.....");
						$("#preloader").css("display","none");
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						window.location.reload();
					}
					else{
						//alert(data);
						$("#preloader").css("display","none");
						$("#c_teach_staffsal").html(data);
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						//window.location.reload();
					}
				}
	}

  });
  

  
});
//##############################################################################################

$("#seldata").change(function(e) {
var action='searchstaffatt';
var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>'; 
var txtElement = $("#seldata").val(); 
var dataString = 'element='+txtElement+'&session='+session+'&action='+action;
alert(dataString);
$.ajax({
	type:'POST',
	data:dataString,
	url:'../../ajax.php',
	success:function(data) {
	//alert(data);
		if(data!="")
				{
					//window.location.reload();
					if(data==1){
						alert("Required Parameter Missing");
						$("#preloader").css("display","none");
						return false;  
					}
					else if(data==4){
						alert("Session Expired......Try Again.....");
						$("#preloader").css("display","none");
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						//window.location.reload();
					}
					else{
						//alert(data);
						$("#preloader").css("display","none");
						$("#SideTable").html(data);
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						//window.location.reload();
					}
				}
	}

  });
  

  
});
//##############################################################################################

$(".staff_sal").change(function(e) {
var action='searchstaffsidemenue';
var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>'; 
var staffname = $("#staffname").val(); 
var staffyear = $("#staffyear").val(); 
var dataString = 'staffname='+staffname+'&session='+session+'&staffyear='+staffyear+'&action='+action;
//alert(dataString);
$.ajax({
	type:'POST',
	data:dataString,
	url:'../../ajax.php',
	success:function(data) {
	//alert(data);
		if(data!="")
				{
					//window.location.reload();
					if(data==1){
						alert("Required Parameter Missing");
						$("#preloader").css("display","none");
						return false;  
					}
					else if(data==4){
						alert("Session Expired......Try Again.....");
						$("#preloader").css("display","none");
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						window.location.reload();
					}
					else{
						//alert(data);
						$("#preloader").css("display","none");
						$("#salsidemenu").html(data);
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						//window.location.reload();
					}
				}
	}

  });
  

  
});
//######################################CHECKBOX########################################################

    $(function () {
      $('.btnGetAll').click(function () {
        if ($('.chkNumber:checked').length) {
          var chkId = '';
          $('.chkNumber:checked').each(function () {
            chkId += $(this).val() + ",";
          });
          chkId = chkId.slice(0, -1);
          alert(chkId);
		  var approvesalary='approvesalary';
		  var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>'; 
		  var dataString = 'action='+approvesalary+'&session='+session+'&chkId='+chkId;
		  //AJAX START
		  $.ajax({
	type:'POST',
	data:dataString,
	url:'../../ajax.php',
	success:function(data) {
	//alert(data);
		if(data!="")
				{
					//window.location.reload();
					if(data==1){
						alert("Required Parameter Missing");
						$("#preloader").css("display","none");
						return false;  
					}
					else if(data==4){
						alert("Session Expired......Try Again.....");
						$("#preloader").css("display","none");
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						//window.location.reload();
					}
					else{
						//alert(data);
						$("#preloader").css("display","none");
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						//window.location.reload();
					}
				}
	}

  });
  
		  //AJAX END
        }
        else {
          alert('Nothing Selected');
        }
      });

      $('.chkSelectAll').click(function () {
        $('.chkNumber').prop('checked', $(this).is(':checked'));
      });

      $('.chkNumber').click(function () {
        if ($('.chkNumber:checked').length == $('.chkNumber').length) {
          $('.chkSelectAll').prop('checked', true);
        }
        else {
          $('.chkSelectAll').prop('checked', false);
        }
      });

    });
//######################################CHECKBOX########################################################
</script>	
</body>

</html>