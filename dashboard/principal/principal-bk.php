<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Principal</title>
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
                                <a href="../principal/principal.php">Principal</a>
                            </li>
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <div class="row hidden-sm hidden-xs">

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="../principal/inbox.php">
                            <div class="white-box text-center co-messages">
                                <h1 class="text-white counter">                                  
                                    <img src="../images/icons/message.ico" class="icon-size" />
                                </h1>
                                <p class="text-muted">Messages</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="../principal/principal-attendance.php">
                            <div class="white-box text-center co-attendance">
                                <h1 class="text-white counter">
                                    <img src="../images/icons/attendance.png" class="icon-size" />
                                </h1>
                                <p class="text-muted">Attendance</p>
                            </div>
                        </a>
                    </div>


                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="../principal/eventsholidays.php">
                            <div class="white-box text-center co-events">
                                <h1 class="counter">
                                    <img src="../images/icons/event.ico" class="icon-size" />
                                </h1>
                                <p class="text-muted">Events & Holidays</p>
                            </div>
                        </a>
                    </div>





                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="../principal/noticecircular.php">
                            <div class="white-box text-center co-notifications">
                                <h1 class="text-white counter">
                                    <img src="../images/icons/notification.png" class="icon-size" />
                                </h1>
                                <p class="text-muted">Notice & Circulars</p>
                            </div>
                        </a>
                    </div>



                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="javascript:void(0);">
                            <div class="white-box text-center co-assessment ">
                                <h1 class="counter">
                                    <img src="../images/icons/assessment.png" class="icon-size" />

                                </h1>
                                <p class="text-muted">Assessment</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="javascript:void(0);">
                            <div class="white-box text-center co-administration">
                                <h1 class="text-white counter">
                                    <img src="../images/icons/admin.png" class="icon-size" />

                                </h1>
                                <p class="text-muted">Administration</p>
                            </div>
                        </a>
                    </div>
                </div>



                <!--stu info st-->
                <div class="row">
                
                    <div class="col-sm-6 col-xs-12">
                       <div class="my-box-23">
                           <div class="profile-panel">
                         
                                <div class="row make-gap">    
                                    <div class="overlay-box">
                                        <div class="user-content text-center">
                                            <a href="javascript:void(0)">
                                                <img src="../images/principal_img.jpg" class="thumb-chairman-lg img-circle" alt="img"></a>
                                            <h4 class="text-white">Mrs. <?php echo $_SESSION['USER']['USER_NAME'];?><?php echo $_SESSION['USER']['USER_LNAME'];?></h4>
                                            <h5 class="text-white"><?php echo $_SESSION['USER']['ROLE_ID'];?></h5>
                                            <a href="#" rel="tooltip" data-original-title="Message to contact"> 
                                        <img src="../images/icons/chat.png" class="icon-two-size"></a>
                                        <a href="javascript:void(0)" rel="tooltip" data-original-title="Email to contact" >
                                        <img src="../images/icons/mail.ico" class="icon-two-size">
                                        </a>
                            
                                        </div>
                                    </div>
                                  
                                        
                                </div>
                           </div> 
                        </div>
                    </div><!--en col-->



                    <div class="col-sm-6 col-xs-12">

                        <div class="col-sm-12 col-xs-12 my-boxnew shadow-a">


                            <div class="col-md-6">
                                <div class="col-md-12 prin panel-embose-b">
                                    <div class="col-md-3">
                                        <img src="../images/eduaction.png" alt="user" class="img-size img-circle image-responsive">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="mail-contnet">
                                            <h5 class="text-center">Students</h5>
                                            <h5 class="head-web"><?php echo $num_of_students;?></h5>
                                        </div>
                                        <div class="col-sm-6 for_new">
                                           <button type="button" class="panel-embose-d btn btn-success btn-sm"><?php echo $pnum_of_students;?></button>                                              
                                               
                                         
                                        </div>
                                        <div class="col-sm-6 for_new">
                                          <button type="button" class="panel-embose-d btn btn-danger btn-sm"> <?php echo $anum_of_students;?></button>                                              
                                               
                                           
                                        </div>
                                    </div>


                                </div>
                                 <div id="chartdivone" style="width: 100%; height: 180px;" ></div>
                            </div>

                            <div class="col-sm-6">
                                <div class="col-sm-12 prin-1 panel-embose-b">
                                    <div class="col-md-3">
                                        <img src="../images/staff.png" alt="user" class="img-size img-circle">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="mail-contnet">
                                            <h5 class="text-center">Staff</h5>
                                            <h5 class="head-web"><?php echo $num_of_staffs; ?></h5>


                                        </div>
                                        <div class="col-md-6 for_new">
                                           <button type="button" class="panel-embose-d btn btn-success btn-sm"> <?php echo $pnum_of_staffs; ?></button>
                                        </div>
                                        <div class="col-md-6 for_new">
                                           <button type="button" class="panel-embose-d btn btn-danger btn-sm"> <?php echo $anum_of_staffs; ?></button>
                                        </div>
                                    </div>


                                </div>
                               <div id="chartdivtwo" style="width: 100%; height: 180px;" ></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                    <!--stu info st-->

                   <div class="row">
                    <div class="col-sm-9 col-xs-12 my-box-11 fee-head shadow-a">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <h5>Fee Summary</h5>
                            </div>

                            <div class="col-sm-6  dropdown">
                                <div class="col-sm-2">
                                    <h5> Select</h5>
                                </div>
                                <div class="col-sm-10">
                                    <select class="selectpicker_one">
                                  <option>First Quarter (Apr-Jun)</option>
                                  <option>Second Quarter (Jul-Sept)</option>
                                  <option>Third Quarter (Oct-Dec)</option>
                                  <option>Fourth Quarter (Jan-Mar)</option>
                                </select>
                                </div>

                            </div>
                            <div class="col-sm-3">
                                <h5>Session 2016-17</h5>
                            </div>
                        </div>
                        <div class="col-sm-12 table-responsive fee-wrapper fee-size">

                            <table class="table table-bordered custom-table">
                                <tbody>
                                    <tr>
                                    </tr>
                                    <tr>
                                        <td rowspan="2" colspan="1">
                                           
                                        </td>

                                        <td colspan="13" class="sectiopart">Section</td>


                                    </tr>
                                    <tr class="table-new">

                                        <td colspan="3">A</td>
                                        <td colspan="3">B</td>
                                        <td colspan="3">C</td>
                                        <td colspan="3">D</td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">Class</td>
                                        <td class="table-present">Recieved</td>
                                        <td class="table-absent">Pending</td>
                                        <td class="table-total">Total</td>
                                        <td class="table-present">Recieved</td>
                                        <td class="table-absent">Pending</td>
                                        <td class="table-total">Total</td>
                                        <td class="table-present">Recieved</td>
                                        <td class="table-absent">Pending</td>
                                        <td class="table-total">Total</td>
                                        <td class="table-present">Recieved</td>
                                        <td class="table-absent">Pending</td>
                                        <td class="table-total">Total</td>
                                    </tr>

                                    <!--                                 <tr>
                                    <td rowspan="15">Class</td>

                                </tr> -->

                                    <tr>
                                        <td> 
                                             <select class="selectpicker">
                                                <optgroup label="Section">
                                                    <option>NUR</option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                </optgroup>                                                                         
                                            </select>
                                        </td>
                                        <td>20</td>
                                        <td>10</td>
                                        <td>30</td>
                                        <td>22</td>
                                        <td>7</td>
                                        <td>29</td>
                                        <td>33</td>
                                        <td>6</td>
                                        <td>39</td>
                                        <td>25</td>
                                        <td>5</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>
                                             <select class="selectpicker">
                                                <optgroup label="Section">
                                                    <option>KG</option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                </optgroup>                                                                         
                                            </select>
                                        </td>
                                        <td>20</td>
                                        <td>10</td>
                                        <td>30</td>
                                        <td>22</td>
                                        <td>7</td>
                                        <td>29</td>
                                        <td>33</td>
                                        <td>6</td>
                                        <td>39</td>
                                        <td>25</td>
                                        <td>5</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="selectpicker">
                                                <optgroup label="Section">
                                                    <option>1<sup>st</sup></option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                </optgroup>                                                                         
                                            </select>
                                        </td>
                                        <td>20</td>
                                        <td>10</td>
                                        <td>30</td>
                                        <td>22</td>
                                        <td>7</td>
                                        <td>29</td>
                                        <td>33</td>
                                        <td>6</td>
                                        <td>39</td>
                                        <td>25</td>
                                        <td>5</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>
                                             <select class="selectpicker">
                                                <optgroup label="Section">
                                                    <option>2<sup>nd</sup></option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                </optgroup>                                                                         
                                            </select>
                                        </td>
                                        <td>20</td>
                                        <td>10</td>
                                        <td>30</td>
                                        <td>22</td>
                                        <td>7</td>
                                        <td>29</td>
                                        <td>33</td>
                                        <td>6</td>
                                        <td>39</td>
                                        <td>25</td>
                                        <td>5</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="selectpicker">
                                                <optgroup label="Section">
                                                    <option>3<sup>rd</sup></option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                </optgroup>                                                                         
                                            </select>
                                        </td>
                                        <td>20</td>
                                        <td>10</td>
                                        <td>30</td>
                                        <td>22</td>
                                        <td>7</td>
                                        <td>29</td>
                                        <td>33</td>
                                        <td>6</td>
                                        <td>39</td>
                                        <td>25</td>
                                        <td>5</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="selectpicker">
                                                <optgroup label="Section">
                                                    <option>4<sup>th</sup></option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                </optgroup>                                                                         
                                            </select>
                                        </td>
                                        <td>20</td>
                                        <td>10</td>
                                        <td>30</td>
                                        <td>22</td>
                                        <td>7</td>
                                        <td>29</td>
                                        <td>33</td>
                                        <td>6</td>
                                        <td>39</td>
                                        <td>25</td>
                                        <td>5</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="selectpicker">
                                                <optgroup label="Section">
                                                    <option>5<sup>th</sup></option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                </optgroup>                                                                         
                                            </select>
                                        </td>
                                        <td>20</td>
                                        <td>10</td>
                                        <td>30</td>
                                        <td>22</td>
                                        <td>7</td>
                                        <td>29</td>
                                        <td>33</td>
                                        <td>6</td>
                                        <td>39</td>
                                        <td>25</td>
                                        <td>5</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="selectpicker">
                                                <optgroup label="Section">
                                                    <option>6<sup>th</sup></option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>                       
                                                </optgroup>
                                                                         
                                            </select>
                                        </td>
                                        <td>20</td>
                                        <td>10</td>
                                        <td>30</td>
                                        <td>22</td>
                                        <td>7</td>
                                        <td>29</td>
                                        <td>33</td>
                                        <td>6</td>
                                        <td>39</td>
                                        <td>25</td>
                                        <td>5</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="selectpicker">
                                                <optgroup label="Section">
                                                    <option>7<sup>th</sup></option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                </optgroup>                                                                         
                                            </select>
                                        </td>
                                        <td>20</td>
                                        <td>10</td>
                                        <td>30</td>
                                        <td>22</td>
                                        <td>7</td>
                                        <td>29</td>
                                        <td>33</td>
                                        <td>6</td>
                                        <td>39</td>
                                        <td>25</td>
                                        <td>5</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="selectpicker">
                                                <optgroup label="Section">
                                                    <option>8<sup>th</sup></option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                </optgroup>                                                                         
                                            </select>
                                        </td>
                                        <td>20</td>
                                        <td>10</td>
                                        <td>30</td>
                                        <td>22</td>
                                        <td>7</td>
                                        <td>29</td>
                                        <td>33</td>
                                        <td>6</td>
                                        <td>39</td>
                                        <td>25</td>
                                        <td>5</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="selectpicker">
                                                <optgroup label="Section">
                                                    <option>9<sup>th</sup></option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                </optgroup>                                                                         
                                            </select>
                                        </td>
                                        <td>20</td>
                                        <td>10</td>
                                        <td>30</td>
                                        <td>22</td>
                                        <td>7</td>
                                        <td>29</td>
                                        <td>33</td>
                                        <td>6</td>
                                        <td>39</td>
                                        <td>25</td>
                                        <td>5</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>
                                           <select class="selectpicker">
                                                <optgroup label="Section">
                                                    <option>10<sup>th</sup></option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                </optgroup>                                                                         
                                            </select>
                                        </td>
                                        <td>20</td>
                                        <td>10</td>
                                        <td>30</td>
                                        <td>22</td>
                                        <td>7</td>
                                        <td>29</td>
                                        <td>33</td>
                                        <td>6</td>
                                        <td>39</td>
                                        <td>25</td>
                                        <td>5</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td> 
                                            <select class="selectpicker">
                                                <optgroup label="Section">
                                                    <option>11<sup>th</sup></option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                </optgroup>                                                                         
                                            </select>
                                        </td>
                                        <td>20</td>
                                        <td>10</td>
                                        <td>30</td>
                                        <td>22</td>
                                        <td>7</td>
                                        <td>29</td>
                                        <td>33</td>
                                        <td>6</td>
                                        <td>39</td>
                                        <td>25</td>
                                        <td>5</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="selectpicker">
                                                <optgroup label="Section">
                                                    <option>12<sup>th</sup></option>
                                                    <option>A</option>
                                                    <option>B</option>
                                                    <option>C</option>
                                                    <option>D</option>
                                                </optgroup>                                                                         
                                            </select>
                                        </td>
                                        <td>20</td>
                                        <td>10</td>
                                        <td>30</td>
                                        <td>22</td>
                                        <td>7</td>
                                        <td>29</td>
                                        <td>33</td>
                                        <td>6</td>
                                        <td>39</td>
                                        <td>25</td>
                                        <td>5</td>
                                        <td>30</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12 shadow-a">

                        <div class="my-box-11">
                           <h3 class="text-center">Session 2016-2017</h3>
                           <!--pie chart st-->
						   <div id="chartdiv"></div>
                        </div>
                    </div>
                </div>
                

                 <div class="row">
                    <div class="col-sm-12 col-xs-12 my-box">
                        <h5><b>Staff Leave Approval</b></h5>
                        <div class="table-responsive twenty_three">

                            <table class="table table-responsive panel-embose-c">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Status</th>
                                        <th>View</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								foreach($stuleaveidarr as $stuvlue)
								{
								?>
                                    <tr>
                                        <td>Ms. <?php echo $stuvlue['USERFANME'];?>  <?php echo $stuvlue['USERLNAME'];?></td>
                                        <td><?php echo $stuvlue['usr_role'];?></td>
                                        <td><?php echo  $stuvlue['minoff'];?></td>
                                        <td><?php echo  $stuvlue['maxoff'];?></td>
                                        <td><?php echo $stuvlue['leave_status'];?></td>
                                        <td>
                                            <a href="#id"><i class="view_btn fa fa-eye" aria-hidden="true"></i></a>

                                        </td>
                                        <td>
                                            <button type="button" class="btn-info view-btn">Approve</button>
                                        </td>
                                    </tr>
								<?php
								}
								?>
                                </tbody>
                            </table>

                        </div>
                     


                    </div>
                </div>
                 <div class="row">
                       <div class="col-xs-12 my-box">
                           <h5><b>Staff on Leave Today</b></h5>
                        <div class="table-responsive twenty_three">
                            <table class="table table-responsive panel-embose-c">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Designation</th>
                                         <th>From</th>
                                        <th>To</th>
                                        <th>View</th>
                                        <th>Status</th>


                                    </tr>
                                </thead>
                                <tbody>
								<?php
								foreach($stuleaveidarrtoday as $stuvlue)
								{
								?>
                                    <tr>
                                        <td>Mrs. <?php echo $stuvlue['USERFANME'];?> <?php echo $stuvlue['USERFANME'];?></td>
                                        <td><?php echo $stuvlue['usr_role'];?></td>
                                        <td><?php echo $stuvlue['minoff'];?></td>
                                        <td><?php echo $stuvlue['maxoff'];?></td>
                                        <td>
                                            <a href="#id"> <i class="view_btn fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>Leave</td>


                                    </tr>
								<?php
								}
								?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-xs-12 my-box">
                        <h5><b>Event Approval</b></h5>
                        <div class="table-responsive twenty_three">

                            <table class="table table-responsive panel-embose-c">
                                <thead>
                                    <tr>
                                        <th>By</th>

                                        <th>From</th>
                                        <th>To</th>
                                        <th>Event Name</th>
                                        <th>View</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								foreach($holarray as $cirvalue)
								{
								?>
                                    <tr>
                                        <td>School Admin</td>
                                        
                                        <td><?php echo $cirvalue['minoff'];?></td>
                                        <td><?php echo $cirvalue['maxoff'];?></td>

                                        <td><?php echo $cirvalue['occassion'];?></td>
                                        <td>
                                            <a href="#id"> <i class="view_btn fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn-info view-btn">Approve</button>
                                        </td>
                                    </tr>
                                <?php
								}
								?>								

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                 <div class="row">

                    <div class="col-xs-12 my-box">
                        <h5><b>Assessment</b></h5>
                        <p>Coming soon!</p>
                    </div>
                </div>

                   <div class="row">
                    <div class="col-sm-6 col-xs-12 my-boxes">



                        <div id="calendar-fancy"></div>
                        <section class="panel section-panel">
                            <header class="panel-heading heading-event">
                                <h3 class="box-title">Event Occasion - <span class="today"></span></h3>
                            </header>
                            <div class="panel-body">
							<?php
							foreach($cirarray as $cirvalue)
							{
							?>
							<div class="alert alert-info clearfix alert-height">
                                    <div class="notification-info">
                                        <ul class="clearfix notification-meta">
                                            <li class="pull-left notification-sender">
                                                <span class="alert-icon"><img src="../images/icons/event.ico" class="icon-size"></span> <span><a href="javascript:void(0);">Annual Sports Day</a></span>
                                            </li>

                                        </ul>

                                    </div>
                                </div>
							<?php
							}
							?>
							</div>
                        </section>



                    </div>

                    <div class="col-sm-6 col-xs-12">

                        <div class="col-sm-12 col-xs-12 my-box-last shadow-a">
                            <h3 class="box-title latest-cir">Latest Circular</h3>
                            <div class="feeds-principal-panel">
                                <ul class="feeds">
								<?php
								foreach($cirarray as $cirvlue)
								{
								?>
                                    <li>
                                        <div class="bg-info"><i class="fa fa-calendar"></i></div>
                                        <?php echo $cirvlue['message'];?>... <span class="text-muted"> <?php echo $cirvlue['date'];?></span></li>
                                <?php
								}
								?>
                                </ul>
                            </div>

                        </div>
                    </div>
                    





                </div>
                <!--col-en-->
            </div>
            <!--col-en-->
        </div>
        <!--stu info en-->
        <!-- .right-sidebar st here-->
    </div>
    <!-- /.container-fluid -->
    <?php include'../includes/footer.php'; ?>

    <!-- /#page-wrapper -->
    
    <!-- /#wrapper -->
    <?php include '../includes/foot.php'; ?>

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