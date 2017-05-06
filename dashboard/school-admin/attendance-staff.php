<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>School Management Solutions - SMS | Attendance</title>
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
		//SELECT CLASS AND SECTION
		$sql=mysql_query("SELECT *,(SELECT class_name FROM essort_classes WHERE class_id=class_id LIMIT 1) as class,(SELECT section_name FROM essort_section WHERE class_id=class_id AND section_id=section_id LIMIT 1) as section FROM essort_teacher_class WHERE is_classteacher='1' AND staff_id='".$_SESSION['USER']['USER_ID']."'");
		$taecherdata=mysql_fetch_array($sql);
		##################SELECT (ATT REF ID) FOR ALL STUDENTS OF CLASS AND SECTION######################################################################
		include_once 'stastics.php';
		$no_of_students=mysql_num_rows($stusql);
		#######PRESENT STUDENTS##############################
		$sqlatttble=mysql_query("SELECT YEAR( att_date ) AS y, MONTH( att_date ) AS m, COUNT( DISTINCT att_date ),'ABSENT','PRESENT','TOTAL'
		FROM essort_class_attendence
		WHERE stu_id = '".$_REQUEST['id']."' AND att_session='".CURRENT_SESSION."' GROUP BY y, m");
		$rowtble=array();
		while($rowleavetble=mysql_fetch_array($sqlatttble))
		{
			$sql=mysql_query("SELECT attendence_id FROM essort_class_attendence 
			WHERE MONTH(att_date) = '".$rowleavetble['m']."' AND stu_id = '".$_REQUEST['id']."'"); //AND YEAR(happened_at) = 2009
			$num_of_rows=mysql_num_rows($sql);
			$num=01;
			$start_date=date($rowleavetble['y'].'-'.$rowleavetble['m'].'-'.$num);
			$days=cal_days_in_month(CAL_GREGORIAN, $rowleavetble['m'], $rowleavetble['y']);
			$end_date=date($rowleavetble['y'].'-'.$rowleavetble['m'].'-'.$days);
			$num_of_rows=$obj->getWorkingDays($start_date,$end_date,$holidays);

			//PRESEENT DAYS
			$sqlp=mysql_query("SELECT attendence_id FROM essort_class_attendence 
			WHERE MONTH(att_date) = '".$rowleavetble['m']."' AND stu_id = '".$_REQUEST['id']."' AND att_status='P'");
			$pnum_of_rows=mysql_num_rows($sqlp);
			//ABSENT DAYS
			$anum_of_rows=$num_of_rows-$pnum_of_rows;
			 
			$rowleavetble['PRESENT']=$pnum_of_rows;
			$rowleavetble['TOTAL']=$num_of_rows;
			$rowleavetble['ABSENT']=$num_of_rows-$pnum_of_rows;
			$monthNum  = $rowleavetble['m'];
			$dateObj   = DateTime::createFromFormat('!m', $monthNum);
			$monthName = $dateObj->format('F'); // March
			$rowtble[$monthName]=$rowleavetble;
			
		}
		$months = array();
		for ($i = 1; $i <= 12; $i++) {
			$monthNum  = $i;
			$dateObj   = DateTime::createFromFormat('!m', $monthNum);
			$monthName = $dateObj->format('F'); // March
			if(array_key_exists ($monthName,$rowtble)==0)
			{
				$sql = mysql_query("SELECT DATE_FORMAT(`off_day` , '%Y-%m-%d') as date
				FROM essort_holidays  WHERE occassion_type='Holiday' AND DATE_FORMAT(off_day,'%m')='".$monthNum."'") OR DIE(mysql_error());
				$holidays=array();
				while($row=mysql_fetch_array($sql))
					{
						$holidays[]=$row['date'];
					}
					$todaydate=date('Y-m-d');
					$start_date=date(''.$todaydate['y'].'-'.$monthNum.'-01');
					$days=cal_days_in_month(CAL_GREGORIAN, $monthNum, $todaydate['y']);
					$end_date=date(''.$todaydate['y'].'-'.$monthNum.'-'.$days);
					$num_of_rows=$obj->getWorkingDays($start_date,$end_date,$holidays);
				$pnum_of_rows=0;
				$rowleavetble['TOTAL']=$num_of_rows;
				$rowleavetble['ABSENT']=$num_of_rows-$pnum_of_rows;
				$rowleavetble['PRESENT']=$pnum_of_rows;
				$rowleavetble['y']=$todaydate['y'];
				$rowtble[$monthName]=$rowleavetble;
			}
		}

		//print_R($rowtble);
		//FIND 
		####################################################
		$year = date("y",strtotime(SESSION_START_DATE));
		$todaydate=date('Y-m-d');
		
		$sql = mysql_query("SELECT DATE_FORMAT(`off_day` , '%Y-%m-%d') as date
            FROM essort_holidays  WHERE occassion_type='Holiday' AND DATE_FORMAT(off_day,'%y')='".$year."'") OR DIE(mysql_error());
			$holidays=array();
			while($row=mysql_fetch_array($sql))
			{
				$holidays[]=$row['date'];
			}
			$workingdayssession=$obj->getWorkingDays(SESSION_START_DATE,$todaydate,$holidays);
	$sqlattendancesqlsession=mysql_query("SELECT * FROM essort_class_attendence  WHERE stu_id='".$_REQUEST['id']."' AND att_session='".CURRENT_SESSION."'");
	
	echo $no_of_days_present_session=mysql_num_rows($sqlattendancesqlsession);
	echo $no_of_days_absent_session=$workingdayssession-$no_of_days_present_session;
	$yearpresentpercentage=($no_of_days_present_session/$workingdayssession)*100;
	$yearabsentpercentage=($no_of_days_absent_session/$workingdayssession)*100;
		####################################################
	}
	else
	{
		echo "<script>window.location='".HTTP_SERVER."index.php';</script>";
	} 
 ?>  
<!-- Navigation -->
<!-- header Navigation st-->
<?php include '../includes/header-configuration.php'?>

<!-- header Navigation en-->
<!-- Left navbar-header -->
<?php include'../includes/sidebar-school.php'; ?>
<!-- Left navbar-header end -->
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
        <?php include '../includes/header-notice.php';?>


        <!--stu info st-->
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
            <!--graph st-->
                    <div class="my-box">       
                        <div id="barchart"  style="width: 100%; height: 366px;"></div>
                    </div>
            <!--graph en-->    

</div><!--col-en-->
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="my-box rem-extra chart-height">  
 <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12">
         <select class="form-control input-sm" id="selgraph">
		    <option <?php if(CURRENT_SESSION=='2017-2018') echo 'selected'; ?>>2017-2018</option>
		    <option <?php if(CURRENT_SESSION=='2016-2017') echo 'selected'; ?>>2016-2017</option>
            <option <?php if(CURRENT_SESSION=='2015-2016') echo 'selected'; ?>>2015-2016</option>
            <option <?php if(CURRENT_SESSION=='2014-2015') echo 'selected'; ?>>2014-2015</option>
            <option <?php if(CURRENT_SESSION=='2013-2014') echo 'selected'; ?>>2013-2014</option>									
          </select>
     </div>
 </div>        
<div id="chartdiv">
<script>
                                    $(function(){
                                        var chart = AmCharts.makeChart( "chartdiv", {
                                            "labelRadius": -40,
                                            "labelText": "[[status]]: [[percents]]%",
                                            "type": "pie",
                                            "theme": "light",
                                            "dataProvider": [{
                                                "status": "Present",
                                                "value": (<?php echo $no_of_days_present_session; ?>+0)
                                            },{
                                                "status": "Absent",
                                                "value": (<?php echo $no_of_days_absent_session; ?>+0)
                                            }],
                                            "valueField": "value",
                                            "titleField": "status",
                                            "outlineAlpha": 0.4,
                                            "depth3D": 25,
                                            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                            "angle": 40,
                                            "export": {
                                                "enabled": true
                                            }

                                       });
                                    });
                                </script></div>
<!--legend st-->
<div class="text-center btn-block highchart-legend">
<ul class="list-inline">
<li><a href="javascript:void(0);"><span class="color-gr"></span> <span class="legend-name">Present</span></a></li>
<li><a href="javascript:void(0);"><span class="color-lorange"></span> <span class="legend-name">Absent</span></a></li>
</ul>
</div>    
<!--legend en-->

<!--table st-->
   <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                      <table class="table table-striped table-bordered">
                        <tbody>
                          <tr>
                            <th>Present</th>
                            <td><?php echo $no_of_days_present_session;?></td>
                            <td><?php echo $yearpresentpercentage;?>%</td>
                          </tr>
                          <tr>
                            <th>Absent</th>
                            <td><?php echo $no_of_days_absent_session;?></td>
                            <td><?php echo $yearabsentpercentage;?>%</td>
                          </tr>
                        </tbody>                
                      </table>
            </div>
        </div><!--en col-->
    </div><!--en row-->
<!--table en-->
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
<div class="table-bg table-responsive">
<div class="row m-b-10">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <h4>Select Session 
    <select class="input-sm changeattend" id="changeattend">
        <option value="2016-2017">-2016-2017-</option>
        <option value="2017-2018">-2017-2018-</option>
       
    </select>
    </h4>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <h4 class="pull-right">Session - <?php echo CURRENT_SESSION;?></h4>
    </div>
</div>
<table class="table table-bordered">
<thead>
<tr class="thead-bg ">
<th>Date</th>
<th>1</th>
<th>2</th>
<th>3</th>
<th>4</th>
<th>5</th>
<th>6</th>
<th>7</th>
<th>8</th>
<th>9</th>
<th>10</th>
<th>11</th>
<th>12</th>
<th>13</th>
<th>14</th>
<th>15</th>
<th>16</th>
<th>17</th>
<th>18</th> 
<th>19</th>
<th>20</th>
<th>21</th>
<th>22</th>
<th>23</th>
<th>24</th>
<th>25</th>
<th>26</th>
<th>27</th>
<th>28</th>
<th>29</th>
<th>30</th>
<th>31</th>

</tr>
</thead>
<tbody id="sessionwisesearch">
<?php
								for($i=4;$i<16;$i++)
								{
								
								$monthNum  = $i;
								if($monthNum==13)
								{
									$monthNum=01;
								}
								else if($monthNum==14)
								{
									$monthNum=02;
								}
								else if($monthNum==15)
								{
									$monthNum=03;
								}
								else
								{
									$monthNum=$monthNum;
								}
								$dateObj   = DateTime::createFromFormat('!m', $monthNum);
								$monthName = $dateObj->format('F');
								$number = cal_days_in_month(CAL_GREGORIAN, $monthNum,date("Y")); // 31
								?>
								
								<tr>
                                        <td><?php echo $monthName;?></td>
										<?php
										for($y=1;$y<=$number;$y++)
										{
										
										$date=date("Y")."-".$monthNum."-".$y;
										$date=date('Y-m-d',strtotime($date));
										require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
										require_once('../../classes/general_class.php');
										$obj = new General();
										$status=$obj->getCurrentAttendenece($date,$_REQUEST['id']);
										if($status=='AB')
										{
											$tag='absent';
											$status='A';
										}
										else if($status=='PR')
										{
											$tag='present';
											$status='P';
										}
										else if($status=='LV')
										{
											$tag='cancel';
											$status='L';
										}
										else
										{
											
										
										}
										?>
                                        <td class="<?php echo $tag;?>"><?php if($tag=='present'){
										?><a href="#" data-toggle="tooltip" data-original-title="In Time: 9:30AM<br/> Out Time: 2:30PM">
										<?php
										}
										?><?php echo $status;?></a>
                                        </td>
										<?php
										}
										?>
                                        


                                    </tr>
									<?php
									}
									
									?>
                                    
                                </tbody>
</tbody>
</table>
</div>
            </div>
                <!--calendar en-->
            </div><!--col-en-->
        </div>
        <!--stu info en-->	
        <!-- .right-sidebar st here-->
    </div>
    <!-- /.container-fluid -->
     <?php include'../includes/footer.php'; ?>
</div>
<!-- /#page-wrapper -->

<!-- /#wrapper -->
<?php include '../includes/foot.php'; ?>
<script>
$("#selgraph").change(function(e) {
var action='staffgaraphindividual';
var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>'; 
var id = '<?php echo $_REQUEST['id']; ?>'; 
var startsessiondate = '<?php echo SESSION_START_DATE; ?>'; 
var  staffyear= $("#selgraph").val(); 
var dataString = 'id='+id+'&session='+session+'&staffyear='+staffyear+'&startsessiondate='+startsessiondate+'&action='+action;
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
						$("#chartdiv").html(data);
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
$(".changeattend").change(function(e) {
var action='attregisterindividaul';
var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>'; 
var id = '<?php echo $_REQUEST['id']; ?>'; 
var startsessiondate = '<?php echo SESSION_START_DATE; ?>'; 
var  staffyear= $("#changeattend").val(); 
var dataString = 'id='+id+'&session='+session+'&staffyear='+staffyear+'&startsessiondate='+startsessiondate+'&action='+action;
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
						$("#sessionwisesearch").html(data);
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

