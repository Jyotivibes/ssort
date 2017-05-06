<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Chairman</title>
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
                                <a href="../chairman/chairman.php">Dashboard</a>
                            </li>
                            <li class="active">Chairman</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <div class="row hidden-sm hidden-xs">

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href="../principal/inbox.php">
                            <div class="white-box text-center co-messages">
                                <h1 class="text-white counter">
                                    <!--  <i class="fa fa-envelope fa-messages"></i>-->
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
                                <p class="text-muted">Notifications</p>
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
                                            <h4 class="text-white">Ms. Monika Sharma</h4>
                                            <h5 class="text-white">Principal</h5>
                                            <a href="#" rel="tooltip" data-original-title="Message to contact"> 
                                        <img src="../images/icons/chat.png" class="icon-two-size"></a>
                                        <a href="javascript:void(0)" rel="tooltip" data-toggle="modal" data-target="#myCompose" data-original-title="Email to contact">
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
                                            <h5 class="head-web">1240</h5>
                                        </div>
                                        <div class="col-sm-6 for_new">
                                           <button type="button" class="panel-embose-d btn btn-success btn-sm">  1020</button>

                                              
                                               
                                         
                                        </div>
                                        <div class="col-sm-6 for_new">
                                          <button type="button" class="panel-embose-d btn btn-danger btn-sm"> 220</button>
                                               
                                               
                                           
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
                               <div id="chartdivtwo" style="width: 100%; height: 180px;" ></div>
                            </div>
                        </div>
                    </div>
                    <!--stu info st-->


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
                                            <!-- <img src="../images/logo.png" alt="Table Logo"> -->
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


                    <div class="col-sm-12 col-xs-12 my-box">
                        <h5><b>Staff Leave Approval</b></h5>
                        <div class="table-responsive twenty_three">

                            <table class="table table-responsive panel-embose-c">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Status</th>
                                        <th>View</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Chinmayraj</td>
                                        <td>12-A</td>
                                        <td>18/11/2016</td>
                                        <td>20/11/2016</td>
                                        <td>Leave</td>

                                        <td>
                                            <a href="#id"> <i class="view_btn fa fa-eye" aria-hidden="true"></i>
                                            </a>

                                        </td>
                                        <td>
                                            <button type="button" class="btn-info view-btn">Approve</button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                     


                    </div>
                       <div class="col-xs-12 my-box">
                           <h5><b>Staff on Leave Today</b></h5>
                        <div class="table-responsive twenty_three">

                            <table class="table table-responsive panel-embose-c">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>View</th>
                                        <th>Status</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Chinmayraj</td>
                                        <td>12-A</td>
                                        <td>18/11/2016</td>
                                        <td>20/11/2016</td>
                                        <td>
                                            <a href="#id"> <i class="view_btn fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>Leave</td>


                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="col-xs-12 my-box">
                        <h5><b>Event Approval</b></h5>
                        <div class="table-responsive twenty_three">

                            <table class="table table-responsive panel-embose-c">
                                <thead>
                                    <tr>
                                        <th>By</th>
                                        <th>Class</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Event Name</th>
                                        <th>View</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Amit</td>
                                        <td>2-B</td>
                                        <td>21/11/2016</td>
                                        <td>22/11/2016</td>

                                        <td>Rain Day</td>
                                        <td>
                                            <a href="#id"> <i class="view_btn fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn-info view-btn">Approve</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Admin</td>
                                        <td>All</td>
                                        <td>28/11/2016</td>
                                        <td>29/11/2016</td>
                                        <td>Annual Function</td>
                                        <td>
                                            <a href="#id"> <i class="view_btn fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn-info view-btn">Approve</button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="col-xs-12 my-box">
                        <h5><b>Assessment</b></h5>
                        <p>Coming soon!</p>
                    </div>


                    <div class="col-sm-6 col-xs-12 my-box">



                        <div id="calendar-fancy"></div>
                        <section class="panel section-panel">
                            <header class="panel-heading heading-event">
                                <h3 class="box-title">Event Occasion - <span class="today"></span></h3>
                            </header>
                            <div class="panel-body">
                                <div class="alert alert-info clearfix alert-height">
                                    <div class="notification-info">
                                        <ul class="clearfix notification-meta">
                                            <li class="pull-left notification-sender">
                                                <span class="alert-icon"><img src="../images/icons/event.ico" class="icon-size"></span> <span><a href="javascript:void(0);">Annual sports day</a></span>
                                            </li>

                                        </ul>

                                    </div>
                                </div>

                                <div class="alert alert-success alert-height rem-margin">
                                    <div class="notification-info">
                                        <ul class="clearfix notification-meta">
                                            <li class="pull-left notification-sender">
                                                <span class="alert-icon">
                                                <img src="../images/icons/event.ico" class="icon-size"></span>
                                                <span><a href="javascript:void(0);">Inter school football competition</a></span> </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>



                    </div>

                    <div class="col-sm-6 col-xs-12">

                        <div class="col-sm-12 col-xs-12 my-box-last shadow-a">
                            <h3 class="box-title latest-cir">Latest Circular</h3>
                            <div class="feeds-panel">
                                <ul class="feeds">
                                    <li>
                                        <div class="bg-info"><i class="fa fa-calendar"></i></div>
                                        Your message here... <span class="text-muted">09/Nov/2016</span></li>
                                    <li>
                                        <div class="bg-success"><i class="fa fa-calendar"></i></div>
                                        Your message here... <span class="text-muted">08/Nov/2016</span></li>
                                    <li>
                                        <div class="bg-warning"><i class="fa fa-calendar"></i></div>
                                        Your message here... <span class="text-muted">07/Nov/2016</span></li>
                                    <li>
                                        <div class="bg-info"><i class="fa fa-calendar"></i></div>
                                        Your message here... <span class="text-muted">09/Nov/2016</span></li>
                                    <li>
                                        <div class="bg-success"><i class="fa fa-calendar"></i></div>
                                        Your message here... <span class="text-muted">08/Nov/2016</span></li>
                                    <li>
                                        <div class="bg-warning"><i class="fa fa-calendar"></i></div>
                                        Your message here... <span class="text-muted">07/Nov/2016</span>
										</li>
										 <li>
                                        <div class="bg-info"><i class="fa fa-calendar"></i></div>
                                        Your message here... <span class="text-muted">09/Nov/2016</span></li>
                                    <li>
                                        <div class="bg-success"><i class="fa fa-calendar"></i></div>
                                        Your message here... <span class="text-muted">08/Nov/2016</span></li>
                                    <li>
                                        <div class="bg-warning"><i class="fa fa-calendar"></i></div>
                                        Your message here... <span class="text-muted">07/Nov/2016</span></li>
                                    <li>
                                        <div class="bg-info"><i class="fa fa-calendar"></i></div>
                                        Your message here... <span class="text-muted">09/Nov/2016</span></li>
                                    <li>
                                        <div class="bg-success"><i class="fa fa-calendar"></i></div>
                                        Your message here... <span class="text-muted">08/Nov/2016</span></li>
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
        
  
    <!-- /.container-fluid -->
    <?php include'../includes/footer.php'; ?> 
    <!-- /#page-wrapper -->
    </div>
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
<!-- Modal -->
<div class="modal fade" id="myCompose" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header-1">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">New Message</h4>
</div>
<div class="modal-body">     
<form class="form-horizontal">
<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">To:</label>
<div class="col-sm-10">
<select class="wd-select">
<option>--select--</option>
<option>Principal</option>
<option>Admin</option>
<option>Teacher</option>
</select>
</div>
</div>
<div class="form-group">
<label for="inputPassword3" class="col-sm-2 control-label">Subject:</label>
<div class="col-sm-10">
<input type="text" class="form-control">
</div>
</div>
<div class="form-group marg-bott">
<label for="textarea" class="col-sm-2 control-label">Message:</label>
<div class="col-sm-10">
<textarea rows="5" class="message"></textarea>
</div>  
</div>    
<div class="form-group">
<div class="row">
<div class="col-sm-2 col-xs-12"></div>
<div class="col-sm-10">
<button href="#" class="btn btn-link pull-right marg-right"><span class="fa fa-paperclip"></span> Attachment</button>
</div>        
</div> 
</div>     

</form>
</div>
<div class="modal-footer">
<div class="row">
<div class="col-sm-12 col-xs-12 pull-right text-center">
<button type="button" class="btn btn-default btn-color border-round"><i class="fa fa-paper-plane"></i> Send</button>
</div>        
</div>
</div>  
</div>
</div>
</div>
<!-- Modal -->

</body>
</html>