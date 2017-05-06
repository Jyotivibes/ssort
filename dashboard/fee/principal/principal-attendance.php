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
                <div class="row bg-title">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting from 15 November 2016.</span></h4>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="javascript:void(0);">Principal</a>
                            </li>
                            <li class="active">Attendance</li>
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
                                                                    <img src="../images/logo.png" alt="Table Logo" />
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

                                                            <tr class="text-center">
                                                                <td>
                                                                    <select class="selectpicker">
                                                                          <optgroup label="Section">
                                                                            <option>NUR</option>
                                                                            <option  onclick="location.href='details-att.php'">A</option>
                                                                            <option  onclick="location.href='details-att.php'">B</option>
                                                                            <option  onclick="location.href='details-att.php'">C</option>
                                                                            <option  onclick="location.href='details-att.php'">D</option>
                                                                          </optgroup>
                                                                         
                                                                        </select>

                                                                </td>
                                                                <td><a href="#">20</a></td>
                                                                <td><a href="#">10</a></td>
                                                                <td><a href="#">30</a></td>
                                                                <td><a href="#">22</a></td>
                                                                <td><a href="#">7</a></td>
                                                                <td><a href="#">29</a></td>
                                                                <td><a href="#">33</a></td>
                                                                <td><a href="#">6</a></td>
                                                                <td><a href="#">39</a></td>
                                                                <td><a href="#">25</a></td>
                                                                <td><a href="#">5</a></td>
                                                                <td><a href="#">30</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>
                                                                    <select class="selectpicker">
                                                                          <optgroup label="Section">
                                                                            <option>KG</option>
                                                                            <option  onclick="location.href='details-att.php'">A</option>
                                                                            <option  onclick="location.href='details-att.php'">B</option>
                                                                            <option  onclick="location.href='details-att.php'">C</option>
                                                                            <option  onclick="location.href='details-att.php'">D</option>
                                                                          </optgroup>
                                                                         
                                                                        </select>

                                                                </td>
                                                                <td><a href="#">20</a></td>
                                                                <td><a href="#">10</a></td>
                                                                <td><a href="#">30</a></td>
                                                                <td><a href="#">22</a></td>
                                                                <td><a href="#">7</a></td>
                                                                <td><a href="#">29</a></td>
                                                                <td><a href="#">33</a></td>
                                                                <td><a href="#">6</a></td>
                                                                <td><a href="#">39</a></td>
                                                                <td><a href="#">25</a></td>
                                                                <td><a href="#">5</a></td>
                                                                <td><a href="#">30</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td> 
                                                                    <select class="selectpicker">
                                                                          <optgroup label="Section">
                                                                            <option>1<sup>st</sup></option>
                                                                            <option  onclick="location.href='details-att.php'">A</option>
                                                                            <option  onclick="location.href='details-att.php'">B</option>
                                                                            <option  onclick="location.href='details-att.php'">C</option>
                                                                            <option  onclick="location.href='details-att.php'">D</option>
                                                                          </optgroup>
                                                                         
                                                                    </select>
                                                                </td>
                                                                <td><a href="#">20</a></td>
                                                                <td><a href="#">10</a></td>
                                                                <td><a href="#">30</a></td>
                                                                <td><a href="#">22</a></td>
                                                                <td><a href="#">7</a></td>
                                                                <td><a href="#">29</a></td>
                                                                <td><a href="#">33</a></td>
                                                                <td><a href="#">6</a></td>
                                                                <td><a href="#">39</a></td>
                                                                <td><a href="#">25</a></td>
                                                                <td><a href="#">5</a></td>
                                                                <td><a href="#">30</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td> 
                                                                    <select class="selectpicker">
                                                                          <optgroup label="Section">
                                                                            <option>2<sup>nd</sup></option>
                                                                            <option  onclick="location.href='details-att.php'">A</option>
                                                                            <option  onclick="location.href='details-att.php'">B</option>
                                                                            <option  onclick="location.href='details-att.php'">C</option>
                                                                            <option  onclick="location.href='details-att.php'">D</option>
                                                                          </optgroup>
                                                                         
                                                                        </select>
                                                                    </td>
                                                                <td><a href="#">20</a></td>
                                                                <td><a href="#">10</a></td>
                                                                <td><a href="#">30</a></td>
                                                                <td><a href="#">22</a></td>
                                                                <td><a href="#">7</a></td>
                                                                <td><a href="#">29</a></td>
                                                                <td><a href="#">33</a></td>
                                                                <td><a href="#">6</a></td>
                                                                <td><a href="#">39</a></td>
                                                                <td><a href="#">25</a></td>
                                                                <td><a href="#">5</a></td>
                                                                <td><a href="#">30</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td> 
                                                                    <select class="selectpicker">
                                                                          <optgroup label="Section">
                                                                            <option>3<sup>rd</sup></option>
                                                                            <option  onclick="location.href='details-att.php'">A</option>
                                                                            <option  onclick="location.href='details-att.php'">B</option>
                                                                            <option  onclick="location.href='details-att.php'">C</option>
                                                                            <option  onclick="location.href='details-att.php'">D</option>
                                                                          </optgroup>
                                                                         
                                                                        </select>
                                                                    </td>
                                                                <td><a href="#">20</a></td>
                                                                <td><a href="#">10</a></td>
                                                                <td><a href="#">30</a></td>
                                                                <td><a href="#">22</a></td>
                                                                <td><a href="#">7</a></td>
                                                                <td><a href="#">29</a></td>
                                                                <td><a href="#">33</a></td>
                                                                <td><a href="#">6</a></td>
                                                                <td><a href="#">39</a></td>
                                                                <td><a href="#">25</a></td>
                                                                <td><a href="#">5</a></td>
                                                                <td><a href="#">30</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td> 
                                                                    <select class="selectpicker">
                                                                          <optgroup label="Section">
                                                                            <option>4<sup>th</sup></option>
                                                                            <option  onclick="location.href='details-att.php'">A</option>
                                                                            <option  onclick="location.href='details-att.php'">B</option>
                                                                            <option  onclick="location.href='details-att.php'">C</option>
                                                                            <option  onclick="location.href='details-att.php'">D</option>
                                                                          </optgroup>
                                                                         
                                                                        </select>
                                                                    </td>
                                                                <td><a href="#">20</a></td>
                                                                <td><a href="#">10</a></td>
                                                                <td><a href="#">30</a></td>
                                                                <td><a href="#">22</a></td>
                                                                <td><a href="#">7</a></td>
                                                                <td><a href="#">29</a></td>
                                                                <td><a href="#">33</a></td>
                                                                <td><a href="#">6</a></td>
                                                                <td><a href="#">39</a></td>
                                                                <td><a href="#">25</a></td>
                                                                <td><a href="#">5</a></td>
                                                                <td><a href="#">30</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td> 
                                                                    <select class="selectpicker">
                                                                          <optgroup label="Section">
                                                                            <option>5<sup>th</sup></option>
                                                                            <option  onclick="location.href='details-att.php'">A</option>
                                                                            <option  onclick="location.href='details-att.php'">B</option>
                                                                            <option  onclick="location.href='details-att.php'">C</option>
                                                                            <option  onclick="location.href='details-att.php'">D</option>
                                                                          </optgroup>
                                                                         
                                                                        </select>
                                                                    </td>
                                                                <td><a href="#">20</a></td>
                                                                <td><a href="#">10</a></td>
                                                                <td><a href="#">30</a></td>
                                                                <td><a href="#">22</a></td>
                                                                <td><a href="#">7</a></td>
                                                                <td><a href="#">29</a></td>
                                                                <td><a href="#">33</a></td>
                                                                <td><a href="#">6</a></td>
                                                                <td><a href="#">39</a></td>
                                                                <td><a href="#">25</a></td>
                                                                <td><a href="#">5</a></td>
                                                                <td><a href="#">30</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td> 
                                                                    <select class="selectpicker">
                                                                          <optgroup label="Section">
                                                                            <option>6<sup>th</sup></option>
                                                                            <option  onclick="location.href='details-att.php'">A</option>
                                                                            <option  onclick="location.href='details-att.php'">B</option>
                                                                            <option  onclick="location.href='details-att.php'">C</option>
                                                                            <option  onclick="location.href='details-att.php'">D</option>
                                                                          </optgroup>
                                                                         
                                                                        </select>
                                                                    </td>
                                                                <td><a href="#">20</a></td>
                                                                <td><a href="#">10</a></td>
                                                                <td><a href="#">30</a></td>
                                                                <td><a href="#">22</a></td>
                                                                <td><a href="#">7</a></td>
                                                                <td><a href="#">29</a></td>
                                                                <td><a href="#">33</a></td>
                                                                <td><a href="#">6</a></td>
                                                                <td><a href="#">39</a></td>
                                                                <td><a href="#">25</a></td>
                                                                <td><a href="#">5</a></td>
                                                                <td><a href="#">30</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td> 
                                                                    <select class="selectpicker">
                                                                          <optgroup label="Section">
                                                                            <option>7<sup>th</sup></option>
                                                                            <option  onclick="location.href='details-att.php'">A</option>
                                                                            <option  onclick="location.href='details-att.php'">B</option>
                                                                            <option  onclick="location.href='details-att.php'">C</option>
                                                                            <option  onclick="location.href='details-att.php'">D</option>
                                                                          </optgroup>
                                                                         
                                                                        </select>
                                                                    </td>
                                                                <td><a href="#">20</a></td>
                                                                <td><a href="#">10</a></td>
                                                                <td><a href="#">30</a></td>
                                                                <td><a href="#">22</a></td>
                                                                <td><a href="#">7</a></td>
                                                                <td><a href="#">29</a></td>
                                                                <td><a href="#">33</a></td>
                                                                <td><a href="#">6</a></td>
                                                                <td><a href="#">39</a></td>
                                                                <td><a href="#">25</a></td>
                                                                <td><a href="#">5</a></td>
                                                                <td><a href="#">30</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td> 
                                                                    <select class="selectpicker">
                                                                          <optgroup label="Section">
                                                                            <option>8<sup>th</sup></option>
                                                                            <option  onclick="location.href='details-att.php'">A</option>
                                                                            <option  onclick="location.href='details-att.php'">B</option>
                                                                            <option  onclick="location.href='details-att.php'">C</option>
                                                                            <option  onclick="location.href='details-att.php'">D</option>
                                                                          </optgroup>
                                                                         
                                                                        </select>
                                                                    </td>
                                                                <td><a href="#">20</a></td>
                                                                <td><a href="#">10</a></td>
                                                                <td><a href="#">30</a></td>
                                                                <td><a href="#">22</a></td>
                                                                <td><a href="#">7</a></td>
                                                                <td><a href="#">29</a></td>
                                                                <td><a href="#">33</a></td>
                                                                <td><a href="#">6</a></td>
                                                                <td><a href="#">39</a></td>
                                                                <td><a href="#">25</a></td>
                                                                <td><a href="#">5</a></td>
                                                                <td><a href="#">30</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td> 
                                                                    <select class="selectpicker">
                                                                          <optgroup label="Section">
                                                                            <option>9<sup>th</sup></option>
                                                                            <option  onclick="location.href='details-att.php'">A</option>
                                                                            <option  onclick="location.href='details-att.php'">B</option>
                                                                            <option  onclick="location.href='details-att.php'">C</option>
                                                                            <option  onclick="location.href='details-att.php'">D</option>
                                                                          </optgroup>
                                                                         
                                                                        </select>
                                                                    </td>
                                                                <td><a href="#">20</a></td>
                                                                <td><a href="#">10</a></td>
                                                                <td><a href="#">30</a></td>
                                                                <td><a href="#">22</a></td>
                                                                <td><a href="#">7</a></td>
                                                                <td><a href="#">29</a></td>
                                                                <td><a href="#">33</a></td>
                                                                <td><a href="#">6</a></td>
                                                                <td><a href="#">39</a></td>
                                                                <td><a href="#">25</a></td>
                                                                <td><a href="#">5</a></td>
                                                                <td><a href="#">30</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td> 
                                                                    <select class="selectpicker">
                                                                          <optgroup label="Section">
                                                                            <option>10<sup>th</sup></option>
                                                                            <option  onclick="location.href='details-att.php'">A</option>
                                                                            <option  onclick="location.href='details-att.php'">B</option>
                                                                            <option  onclick="location.href='details-att.php'">C</option>
                                                                            <option  onclick="location.href='details-att.php'">D</option>
                                                                          </optgroup>
                                                                         
                                                                        </select>
                                                                    </td>
                                                                <td><a href="#">20</a></td>
                                                                <td><a href="#">10</a></td>
                                                                <td><a href="#">30</a></td>
                                                                <td><a href="#">22</a></td>
                                                                <td><a href="#">7</a></td>
                                                                <td><a href="#">29</a></td>
                                                                <td><a href="#">33</a></td>
                                                                <td><a href="#">6</a></td>
                                                                <td><a href="#">39</a></td>
                                                                <td><a href="#">25</a></td>
                                                                <td><a href="#">5</a></td>
                                                                <td><a href="#">30</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td> 
                                                                    <select class="selectpicker">
                                                                          <optgroup label="Section">
                                                                            <option>11<sup>th</sup></option>
                                                                            <option  onclick="location.href='details-att.php'">A</option>
                                                                            <option  onclick="location.href='details-att.php'">B</option>
                                                                            <option  onclick="location.href='details-att.php'">C</option>
                                                                            <option  onclick="location.href='details-att.php'">D</option>
                                                                          </optgroup>
                                                                         
                                                                        </select>
                                                                    </td>
                                                                <td><a href="#">20</a></td>
                                                                <td><a href="#">10</a></td>
                                                                <td><a href="#">30</a></td>
                                                                <td><a href="#">22</a></td>
                                                                <td><a href="#">7</a></td>
                                                                <td><a href="#">29</a></td>
                                                                <td><a href="#">33</a></td>
                                                                <td><a href="#">6</a></td>
                                                                <td><a href="#">39</a></td>
                                                                <td><a href="#">25</a></td>
                                                                <td><a href="#">5</a></td>
                                                                <td><a href="#">30</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td> 
                                                                    <select class="selectpicker">
                                                                          <optgroup label="Section">
                                                                            <option>12<sup>th</sup></option>
                                                                            <option  onclick="location.href='details-att.php'">A</option>
                                                                            <option  onclick="location.href='details-att.php'">B</option>
                                                                            <option  onclick="location.href='details-att.php'">C</option>
                                                                            <option  onclick="location.href='details-att.php'">D</option>
                                                                          </optgroup>
                                                                         
                                                                        </select>
                                                                    </td>
                                                                <td><a href="#">20</a></td>
                                                                <td><a href="#">10</a></td>
                                                                <td><a href="#">30</a></td>
                                                                <td><a href="#">22</a></td>
                                                                <td><a href="#">7</a></td>
                                                                <td><a href="#">29</a></td>
                                                                <td><a href="#">33</a></td>
                                                                <td><a href="#">6</a></td>
                                                                <td><a href="#">39</a></td>
                                                                <td><a href="#">25</a></td>
                                                                <td><a href="#">5</a></td>
                                                                <td><a href="#">30</a></td>
                                                            </tr>





                                                      
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
                                                            <tr>
                                                                <td>Teacher</td>
                                                                <td>36</td>
                                                                <td>4</td>
                                                                <td>40</td>
                                                            </tr>
                                                            <tr class="bg-color">
                                                                <td>Account</td>
                                                                <td><a href="#">5</a></td>
                                                                <td>0</td>
                                                                <td><a href="#">5</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>House-keeping</td>
                                                                <td>9</td>
                                                                <td>1</td>
                                                                <td><a href="#">10</a></td>
                                                            </tr>
                                                            <tr class="bg-color">
                                                                <td>Guards</td>
                                                                <td><a href="#">5</a></td>
                                                                <td>0</td>
                                                                <td><a href="#">5</a></td>
                                                            </tr>
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