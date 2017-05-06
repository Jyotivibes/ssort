<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Chairman - Staff Status </title>
    <?php include '../includes/head.php'; ?>

   

</head>

<body>
   
    <div id="wrapper">
	<?php
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Chairman') )
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
                            <li class="active">Staff Status</li>
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
                                            <li class="tab-current tab-current-1"><a href="#studentattendance"><strong>Staff Attendance</strong></a></li>
                                            <li><a href="#staffsalary"><strong> Staff Salary</strong></a></li>

                                        </ul>
                                    </nav>
                                    <div class="content-wrap">
                                        <section id="#studentattendance" class="content-current">
                                            <div class="panel panel-default staff-status">

                                                <div class="panel-wrapper collapse in ">
                                                  <div class="row">
                                                        <div class="col-sm-4 col-xs-12">
                                                        <div class="panel message-center panel-embose bg-color-box user-img tot-staff-bg">
                                                           <div class="content">
                                                                <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">
                                                                <div>
                                                                    <span>Total Staff</span>
                                                                    <h1 class="my-white"><?php echo $num_of_staffs;?></h1>
                                                                </div>
                                                            </div>
                                                        </div><!--en panel-->
                                                        </div><!--en col-->
                                                         <div class="col-sm-4 col-xs-12">
                                                        <div class="panel message-center panel-embose bg-color-box staffp-bg">
                                                           <div class="content">
                                                                <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">
                                                                <div>
                                                                    <span>Staff Present</span>
                                                                    <h1 class="my-white"><?php echo $sqlpreseent;?></h1>
                                                                </div>
                                                            </div>
                                                        </div><!--en panel-->
                                                        </div><!--en col-->
                                                         <div class="col-sm-4 col-xs-12">
                                                        <div class="panel message-center panel-embose bg-color-box staffa-bg">
                                                           <div class="content">
                                                                <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">
                                                                <div>
                                                                    <span>Staff Absent</span>
                                                                    <h1 class="my-white"><?php echo $absent;?></h1>
                                                                </div>
                                                            </div>
                                                        </div><!--en panel-->
                                                        </div><!--en col-->
                                                    </div>
                                                    <div class="row verti-gap">
                                                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                           <select class="form-control">
                                                              <option selected><?php echo $sch_name;?></option>
                                                             
                                                           </select>
                                                       </div>                              
                                                    </div>
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
                                        <input type="search" class="form-control" id="search">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-search" id="targetresult"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive chairman_tbl_height_one">
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
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tbody class="c_teach_tabel" id="Table">
                                        <?php 
																		foreach($rowatt as $vluetr)
																		{
																			if($vluetr['usr_pic']=='')
																			{
																				$vluetr['usr_pic']='images.png';
																			}
																			
																		?>
                                                                           <tr>
                                                                                <tr>
                                                                                    <td class="text-center">1</td>
                                                                                    <td><?php echo $vluetr['usr_fname'];?></td>
                                                                                     <td><a href="staff-profile.php?teach_id=<?php echo $vluetr['usr_id'];?>"><img src="../../<?php echo $_SESSION['USER']['DB_NAME'];?>/uploads/<?php echo $vluetr['usr_pic']; ?>"></a>                                                                                             </td>
                                                                                  <td><?php echo $vluetr['emp_id'];?></td>
                                                                                    <td><?php echo $vluetr['usr_role'];?></td>
                                                                                    <td><?php echo $vluetr['att_in_time'];?></td>
                                                                                    <td><?php echo $vluetr['att_outtime'];?></td>
                                                                                    <td class="text-center">
                                                                                        <?php if($vluetr['att_status']!='') echo $vluetr['att_status']; else echo 'A';?>
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

                                                                    <div class="col-sm-12 prin-1 panel-embose-b my-box">
                                                                        <div class="col-md-3">
                                                                            <img src="../images/staff.png" alt="user" class="img-size img-circle">
                                                                        </div>
                                                                        <div class="col-sm-9">
                                                                            <div class="mail-contnet">
                                                                                <h5 class="text-center">Staff</h5>
                                                                                <h5 class="head-web"><?php echo $num_of_staffs;?></h5>


                                                                            </div>
                                                                            <div class="col-md-6 for_new">
                                                                               <button type="button" class="panel-embose-d btn btn-success btn-sm"> <?php echo$sqlpreseent;?></button>
                                                                            </div>
                                                                            <div class="col-md-6 for_new">
                                                                               <button type="button" class="panel-embose-d btn btn-danger btn-sm"> <?php echo$absent;?></button>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                            <div class="my-box box-2 fee-head">                  
                                                                <h5 class="text-center"> <a href="#">Staff on Leave</a></h5>
                                                                 <table class="table table-bordered">
                                                                    <thead>
                                                                      <tr>
                                                                        <th>Name</th>
                                                                        <th>Designation</th>
                                                                        <th>View</th>
                                                                      </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                     <?php
																		foreach($rowattleaveinfo as $rowvlue)
																		{
																			?>
                                                                            <tr>
                                                                                <td><?php echo $rowvlue['usr_fname'];?></td>
                                                                                <td><?php echo $rowvlue['usr_role'];?></td>
                                                                                <td>
                                                                                    <a href="javascript:void(0);"> <i="" class="view_btn fa fa-eye" data-target="#myModal" data-target="#myModal" aria-hidden="true"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                         <?php
																		}
																		?>		

                                                                    </tbody>
                                                                  </table>
                                                            </div>
                                                            <div class="my-box clearfix">

                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                      <select class="form-control staff_sal" id="staffname" >
                                                                         <?php echo $optionattstaff;?>
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
                                                                        <tbody class="c_teach_tabel" id="salsidemenu">
																		<?php
																		foreach($rowattside as $rowtblvlue)
																		{
																		$monthNum  = $rowtblvlue['m'];
																		$dateObj   = DateTime::createFromFormat('!m', $monthNum);
																		$monthName = $dateObj->format('F'); // March
																		?>
                                                                            <tr>
                                                                                <td><?php echo $monthName;?></td>
                                                                                <td><?php echo $rowtblvlue['TOTAL'];?></td>
                                                                                <td><?php echo $rowtblvlue['PRESENT'];?></td>
                                                                                <td><?php echo $rowtblvlue['ABSENT'];?></td>
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

                                        <section id="#staffsalary" class="">
                                           <div class="row">
                                               <div class="col-md-7 col-sm-7 col-xs-12">
                                                  <div class="my-box">
                                                   <div id="barchartschool"  style="width: 100%; height: 366px;"></div>
                                                  </div>
                                               </div>
                                               <div class="col-md-5 col-sm-5 col-xs-12">      
                                                  <div class="my-box panel-summary">
                                                   <div class="panel panel-default">
                                                   <div class="panel-heading"><h3 class="box-title">Last 5 Month Salary - Summary</h3></div>
                                                   <div class="panel-body"> 
                                                      <div class="panel-wrapper collapse in ">
                                                       <!--staff status st-->
                                                           <div class="table-responsive">
                                                              <table class="table table-striped">
                                                                <thead>
                                                                  <tr>
                                                                    <th>S. No.</th>
                                                                    <th>Month</th>
                                                                    <th>No. Of Staff</th>
                                                                    <th>Salary Amount</th>
                                                                  </tr>
                                                                </thead>
                                                                <tbody >
																 <?php
																					 $i=1;  
																					foreach($saldata as $sqlvlue)
																					{
																					?>
                                                                  <tr>
                                                                    <td><?php echo $i;?></td>
                                                                   
                                                                                        <td><?php echo $sqlvlue['m'];?></td>
                                                                                        <td><?php echo $sqlvlue['NO_OF_STAFF'];?></td>
                                                                                        <td><i class="fa fa-inr" aria-hidden="true"></i><?php echo $sqlvlue['salary_amount'];?></td>
                                                                                    
                                                                  </tr>  
                                                                  <?php
																  $i++;
																  }
																  ?>
                                                                </tbody>
                                                              </table>
                                                            </div>
                                                       <!--staff status en-->
                                                    </div>
                                                </div><!-- en panel body-->
                                            </div>
                                                   </div>
                                               </div>                                               
                                           </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12">
                                                   <div class="my-box">
                                                    <div class="panel panel-default panel-bgcover">
                                                           <section id="#staffsalary" class="content-current">
                                                            <div class="panel panel-default">
                                                            <div class="panel-wrapper">
                                                           <!--staff status st-->
                                                               <div class="table-responsive">
                                                                  <table class="table table-striped">
                                                                    <thead>
                                                                      <tr>
                                                                        <th>S. No.</th>
                                                                        <th>School Name</th>
                                                                        <th>No. 0f Staff</th>
                                                                        <th>Total Salary</th>
                                                                        <th>Status</th>
                                                                        <th class="text-center">View</th>
                                                                      </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                      <tr>
                                                                        <td>1</td>
                                                                        <td><?php echo $sch_name;?></td>
                                                                        <td><?php echo $num_of_staffs;?></td>
                                                                        <td><?php echo $sum;?></td>
                                                                       <td><a href="chairman-staff-salary.php"><span class="label label-success">Approved</span></a></td>
                                                                       <th class="text-center"><a href="chairman-admin-staff.php"><span  class="fa fa-eye view_btn"></span></a></th>
                                                                      </tr>     
                                                                      <!--<tr>
                                                                        <td>2</td>
                                                                        <td>Demo International - Gurgaon</td>
                                                                        <td>17</td>
                                                                        <td>28,680</td>
                                                                        <td><a href="javascript:void(0)"><span class="label label-danger">Pending</span></a> </td>
                                                                        <th class="text-center"><a href="javascript:void(0)"><span  class="fa fa-eye view_btn"></span></a></th>
                                                                      </tr>
                                                                      <tr>
                                                                        <td>3</td>
                                                                        <td>Demo International - Ghaziabad</td>
                                                                        <td>59</td>
                                                                        <td>75,890</td>
                                                                        <td><a href="javascript:void(0)"><span class="label label-success">Approved</span></a> </td>
                                                                        <th class="text-center"><a href="chairman-admin-staff.php"><span  class="fa fa-eye view_btn"></span></a></th>
                                                                      </tr>     
                                                                      <tr>
                                                                        <td>4</td>
                                                                        <td>Demo International - Meerut</td>
                                                                        <td>61</td>
                                                                        <td>98,990</td>
                                                                        <td><a href="javascript:void(0)"><span class="label label-danger">Pending</span></a> </td>
                                                                        <th class="text-center"><a href="javascript:void(0)"><span  class="fa fa-eye view_btn"></span></a></th>
                                                                      </tr>     
                                                                      <tr>
                                                                        <td>5</td>
                                                                        <td>Demo International - Lucknow</td>
                                                                        <td>33</td>
                                                                        <td>73,810</td>
                                                                          <td><a href="javascript:void(0)"><span class="label label-success">Approved</span></a> </td>
                                                                          <th class="text-center"><a href="chairman-admin-staff.php"><span  class="fa fa-eye view_btn"></span></a></th>
                                                                      </tr>-->                                                           
                                                                    </tbody>
                                                                  </table>
                                                                </div>
                                                           <!--staff status en-->
                                                        </div>
                                                    </div>
                                                </section>
                                                    </div>
                                                    </div><!--en my-box-->
                                                </div>    
                                            </div>
                                        </section>
                                    </div>
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
	<script>
	
$("#targetresult").click(function(e) {
var action='searchstafffromchairman';
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
//////////////////////////////////


$(".staff_sal").change(function(e) {
var action='searchstaffatt';
var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>'; 
var staffname = $("#staffname").val(); 
var staffyear = $("#staffyear").val(); 
var dataString = 'element='+staffname+'&session='+session+'&staffyear='+staffyear+'&action='+action;
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
						$("#salsidemenu").html(data);
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						//window.location.reload();
					}
				}
	}

  });
  

  
});
	</script>
	
</body>

</html>