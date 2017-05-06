<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Chairman - Students Status </title>
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
        <?php include '../includes/topnav.php'; ?>
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
                                            <li class="tab-current tab-current-1"><a href="#studentattendance"><strong>Student Attendance</strong></a></li>
                                            <li><a href="#staffsalary"><strong>Student Fees</strong></a></li>

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
                                                                    <span>Total Student</span>
                                                                    <h1 class="my-white"><?php echo $total_no_of_students;?></h1>
                                                                </div>
                                                            </div>
                                                        </div><!--en panel-->
                                                        </div><!--en col-->
                                                         <div class="col-sm-4 col-xs-12">
                                                        <div class="panel message-center panel-embose bg-color-box staffp-bg">
                                                           <div class="content">
                                                                <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">
                                                                <div>
                                                                    <span>Student Present</span>
                                                                    <h1 class="my-white"><?php echo $pnum_of_students;?></h1>
                                                                </div>
                                                            </div>
                                                        </div><!--en panel-->
                                                        </div><!--en col-->
                                                         <div class="col-sm-4 col-xs-12">
                                                        <div class="panel message-center panel-embose bg-color-box staffa-bg">
                                                           <div class="content">
                                                                <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">
                                                                <div>
                                                                    <span>Student Absent</span>
                                                                    <h1 class="my-white"><?php echo $anum_of_students;?></h1>
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
                          <div class="col-sm-12 col-xs-12">
                        <!--latest circular st-->
						<div class="mar-top clearfix">
							<!--<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <select class="form-control"  id="class1" onchange="showSubType(this.value,this.id);">
									<option>Select Class</option>
										<?php echo $class;?>
								  </select>
								</div>
							</div>	
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <select class="form-control" id="section1">
								</select>
								</div>
							</div>-->
                            
                              
                            
    						
                          
						</div>
					</div>
                        <div class="my-box comment-center">
                            <div class="c_teach_att_search clearfix">
                                <div class="pull-left">
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="date" class="form-control"  id="date" > 
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <div class="input-group">
                                        <input type="search" class="form-control" id="elementnme" >
                                        <div class="input-group-addon">
                                           <span class="glyphicon glyphicon-search" id="targetresult"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive student_tbl_height_two2">
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
                                        </tr>
                                    </thead>
                                    <tbody class="c_teach_tabel" id="Table">
									<?php
									foreach($stuidarr as $stuvlue)
									{
									?>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td><?php echo $stuvlue['USERFNAME']?></td>
                                            <td><img src="../images/father-pic.jpg"></td>
                                            <td><?php echo $stuvlue['app_no']?></td>
                                            <td><?php echo $stuvlue['att_status']?></td>
                                            <td><?php echo $stuvlue['att_intime']?> </td>
                                            <td><?php echo $stuvlue['att_outtime']?></td>
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
                                                                                <h5 class="text-center">Student</h5>
                                                                                <h5 class="head-web"><?php echo $total_no_of_students;?></h5>


                                                                            </div>
                                                                            <div class="col-md-6 for_new">
                                                                               <button type="button" class="panel-embose-d btn btn-success btn-sm"> <?php echo $pnum_of_students;?></button>
                                                                            </div>
                                                                            <div class="col-md-6 for_new">
                                                                               <button type="button" class="panel-embose-d btn btn-danger btn-sm"><?php echo $anum_of_students;?></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            
                                                            <div class="my-box clearfix">

                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                      <select class="form-control" id="seldata">
																	  <option value="">Select</option>
                                                                        <?php
																		
									foreach($stuidarr as $stuvar)
									{
									?>
									<option value="<?php echo $stuvar['att_ref_id'];?>" <?php if ($stuvar['att_ref_id']==DEFAULT_STU) echo 'selected';?>><?php echo $stuvar['USERFNAME'];?></option>
									<?php
									}
									?>
                                                                      </select>
                                                                    </div>
                                                                </div>  
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                       <select class="form-control" id="salyear">
									<option value="2016-2017">2016-2017</option>
									<option value="2017-2018">2017-2018</option>									
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
                                                                        <tbody class="c_teach_tabel" id="SideTable">
                                                                            <?php
																			Foreach ($rowstutble as $rowstuvalue)
																			{
																				$monthNum  = $rowstuvalue['m'];
																				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
																				$monthName = $dateObj->format('F'); // March
																			?>
																				<tr>
																					<td><?php echo $monthName;?></td>
																					<td><?php echo $rowstuvalue['TOTAL'];?></td>
																					<td><?php echo $rowstuvalue['PRESENT'];?></td>
																					<td><?php echo $rowstuvalue['ABSENT'];?></td>
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
                                                   <div id="barchartstudent"  style="width: 100%; height: 366px;"></div>
                                                  </div>
                                               </div>
                                               <div class="col-md-5 col-sm-5 col-xs-12">      
                                                  <div class="my-box panel-summary">
                                                   <div class="panel panel-default">
                                                   <div class="panel-heading"><h3 class="box-title">Fees Collection</h3></div>
                                                   <div class="panel-body"> 
                                                      <div class="panel-wrapper collapse in ">
                                                       <!--staff status st-->
                                                           <div class="table-responsive">
                                                              <table class="table table-striped">
                                                                <thead>
                                                                  <tr>
                                                                    <th>S. No.</th>
                                                                    <th>Month</th>
                                                                    <th>No. of Student</th>
                                                                    <th>Collection</th>
                                                                  </tr>
                                                                </thead>
                                                                <tbody>
                                                                  <tr>
                                                                    <td>1</td>
                                                                    <td>Quarter-1 </td>
                                                                    <td class="text-center"><?php echo $firstcount;?></td>
                                                                    <td class="text-center"><?php if($firstresult['amount']=='') echo '0'; else echo $firstresult['amount'];?></td>
                                                                  </tr>  
                                                                  <tr>
                                                                    <td>2</td>
                                                                    <td>Quarter-2</td>
                                                                  <td class="text-center"><?php echo $seccount;?></td>
                                                                    <td class="text-center"><?php if($secresult['amount']=='') echo '0'; else $secresult['amount'];?></td>
                                                                  </tr>  
                                                                  <tr>
                                                                    <td>3</td>
                                                                    <td>Quarter-3</td>
                                                                   <td class="text-center"><?php echo $thirdcount;?></td>
                                                                    <td class="text-center"><?php if($thirdresult['amount']=='') echo '0'; else $thirdresult['amount'];?></td>
                                                                  </tr>  
                                                                  <tr>
                                                                    <td>4</td>
                                                                    <td>Quarter-4</td>
                                                                    <td class="text-center"><?php echo $fourthcount;?></td>
                                                                    <td class="text-center"><?php if($fourthresult['amount']=='') echo '0'; else $fourthresult['amount'];?></td>
                                                                  </tr>  
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
                                                                        <th>No. of Student</th>
                                                                        <th>Total Fees Collection</th>
                                                                        <th>Status</th>
                                                                      </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                      <tr>
                                                                        <td>1</td>
                                                                        <td><?php echo $sch_name;?> - Noida</td>
                                                                        <td class="text-center"><?php echo $num_of_staffs;?></td>
                                                                        <td class="text-center"><?php echo $totalfee; ?></td>
                                                                       <td><span class="label label-danger">30/54</span></td>
                                                                      </tr>     
                                                                                                                      
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
	<script type="text/javascript">
$("#targetresult").click(function(e) {
var action='searchstuattfromchairman';
var session = '<?php echo $dbname; ?>'; 
var txtElement = $("#elementnme").val(); 
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
alert(dataString);
 $.ajax({
	type:'POST',
	data:dataString,
	url:'../../ajax.php',
	success:function(data) {
	alert(data);
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
</script>
	<script>

$("#seldata").change(function(e) {
var action='searchstaffatt';
var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>'; 
var txtElement = $("#seldata").val(); 
var selyear = $("#salyear").val(); 
var dataString = 'element='+txtElement+'&session='+session+'&salyear='+selyear+'&action='+action;
$("#viewdetail").attr('href','attendance-student.php?id='+txtElement);

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
</script>
</body>

</html>