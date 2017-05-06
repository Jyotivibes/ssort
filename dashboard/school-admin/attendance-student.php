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
if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'SAD')) {
    $user_id = $_SESSION['USER']['USER_NAME'];
    require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
    require_once('../../classes/general_class.php');
   
    $obj = new General();
    //SELECT CLASS AND SECTION
    $sql = mysql_query("SELECT *,(SELECT class_name FROM essort_classes WHERE class_id=class_id LIMIT 1) as class,(SELECT section_name FROM essort_section WHERE class_id=class_id AND section_id=section_id LIMIT 1) as section FROM essort_teacher_class WHERE is_classteacher='1' AND staff_id='" . $_SESSION['USER']['USER_ID'] . "'");
    $taecherdata = mysql_fetch_array($sql);
    ##################SELECT (ATT REF ID) FOR ALL STUDENTS OF CLASS AND SECTION######################################################################
    require_once('../stastics.php');
	 $stusql=mysql_query("SELECT * FROM essort_user_relation"); 
    $no_of_students = mysql_num_rows($stusql);
    #######PRESENT STUDENTS##############################
    $sqlatttble = mysql_query("SELECT YEAR( att_date ) AS y, MONTH( att_date ) AS m, COUNT( DISTINCT att_date ),'ABSENT','PRESENT','TOTAL'
		FROM essort_class_attendence
		WHERE stu_id = '" . $_REQUEST['id'] . "' GROUP BY y, m");
    $rowtble = array();
    while ($rowleavetble = mysql_fetch_array($sqlatttble)) {
        $sql = mysql_query("SELECT attendence_id FROM essort_class_attendence
			WHERE MONTH(att_date) = '" . $rowleavetble['m'] . "' AND stu_id = '" . $_REQUEST['id'] . "'"); //AND YEAR(happened_at) = 2009
        $num_of_rows = mysql_num_rows($sql);
        //PRESEENT DAYS
        $sqlp = mysql_query("SELECT attendence_id FROM essort_class_attendence
			WHERE MONTH(att_date) = '" . $rowleavetble['m'] . "' AND stu_id = '" . $_REQUEST['id'] . "' AND att_status='P'");
        $pnum_of_rows = mysql_num_rows($sqlp);
        //ABSENT DAYS
        $sqla = mysql_query("SELECT attendence_id FROM essort_class_attendence
			WHERE MONTH(att_date) = '" . $rowleavetble['m'] . "' AND stu_id = '" . $_REQUEST['id'] . "'  AND att_status='A'");
        $anum_of_rows = mysql_num_rows($sqla);

        $rowleavetble['PRESENT'] = $pnum_of_rows;
        $rowleavetble['TOTAL'] = $num_of_rows;
        $rowleavetble['ABSENT'] = $num_of_rows - $pnum_of_rows;
        $monthNum = $rowleavetble['m'];
        $dateObj = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F'); // March
        $rowtble[$monthName] = $rowleavetble;

    }
    //print_R($rowtble);
    //FIND
    ####################################################
	$year = date("y", strtotime(SESSION_START_DATE));
    $todaydate = date('Y-m-d');
    $sql = mysql_query("SELECT DATE_FORMAT(`off_day` , '%Y-%m-%d') as date
            FROM essort_holidays  WHERE occassion_type='Holiday' AND DATE_FORMAT(off_day,'%y')='" . $year . "'") OR DIE(mysql_error());
    $holidays = array();
    while ($row = mysql_fetch_array($sql)) {
        $holidays[] = $row['date'];
    }
    $workingdayssession = $obj->getWorkingDays(SESSION_START_DATE, $todaydate, $holidays);
    $sqlattendancesqlsession = mysql_query("SELECT * FROM essort_class_attendence  WHERE stu_id='" . $_REQUEST['id'] . "' AND att_session='" . CURRENT_SESSION . "'");

    $no_of_days_present_session = mysql_num_rows($sqlattendancesqlsession);
    $no_of_days_absent_session = $workingdayssession - $no_of_days_present_session;
    $yearpresentpercentage = ($no_of_days_present_session / $workingdayssession) * 100;
    $yearabsentpercentage = ($no_of_days_absent_session / $workingdayssession) * 100;
	$sessionarr = $obj->allsessions();
	
    ####################################################
} else {
    echo "<script>window.location='" . HTTP_SERVER . "index.php';</script>";
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
<!-------------------FOR CIRCULAR ACTIVITIES ON HEADER AND BRADCRUMB---------------------------------->
 <div class="row bg-title">
               <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <?php include_once("../includes/header-notice-circular.php"); ?>
                    </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    <ol class="breadcrumb bread-change">
                        <li>
                            <a href="<?php echo ADMIN_DASHBOARD_LINK;?>">Dashboard</a>
                        </li>
                        <li class="active">Attendance Details</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="row">
<div class="col-md-8 col-sm-6 col-xs-12">
    <!--graph st-->
    <div class="my-box">
        <div id="barchart" style="width: 100%; height: 366px;"></div>
    </div>
    <!--graph en-->

</div>
<!--col-en-->
<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="my-box rem-extra chart-height">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <select class="form-control input-sm" id="sel1">
				<?php
							foreach($sessionarr as $value)
							{
							?>
							<option value="<?php echo $value; ?>" <?php if(CURRENT_SESSION==$value) echo 'selected'; ?>><?php echo $value;?></option>
							<?php
							}
							?>
                    
                </select>
            </div>
        </div>
        <div id="chartdiv"></div>
        <script>
            $(function () {
                var chart = AmCharts.makeChart("chartdiv", {
                    "labelRadius": -40,
                    "labelText": "[[status]]: [[percents]]%",
                    "type": "pie",
                    "theme": "light",
                    "dataProvider": [
                        {
                            "status": "Present",
                            "value": (<?php echo $no_of_days_present_session; ?>+0)
                        },
                        {
                            "status": "Absent",
                            "value": (<?php echo $no_of_days_absent_session; ?>+0)
                        }
                    ],
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
        </script>
        <!--legend st-->
        <div class="text-center btn-block highchart-legend">
            <ul class="list-inline">
                <li><a href="javascript:void(0);"><span class="color-gr"></span> <span
                            class="legend-name">Present</span></a></li>
                <li><a href="javascript:void(0);"><span class="color-lorange"></span> <span
                            class="legend-name">Absent</span></a></li>
            </ul>
        </div>
        <!--legend en-->

        <!--table st-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="SideTable">
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
            </div>
            <!--en col-->
        </div>
        <!--en row-->
        <!--table en-->
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="table-bg table-responsive">
        <div class="row m-b-10">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h4>Select Session
                    <select class="input-sm" id="attsesssion">
                       <?php
							foreach($sessionarr as $value)
							{
							?>
							<option value="<?php echo $value; ?>" <?php if(isset($_REQUEST['type']) && ($_REQUEST['type']==$value)) { echo 'selected';} else {echo ''; } ?>><?php echo $value;?></option>
							<?php
							}
							?>

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
            <tbody>
            <?php
			$year=date("Y");
			$afteroneyear = $year+1;
			if(isset($_REQUEST['type']) && ($_REQUEST['type']!=''))
						{
							$type=$_REQUEST['type'];
							$type = explode("-", $type);
							$year=$type[0];
							$afteroneyear = $type[1];
						}
						
            for ($i = 4; $i < 16; $i++) {

                $monthNum = $i;
				//echo $monthNum;
                if ($monthNum == 13) {
                    $monthNum = 01;
					$year = $afteroneyear;
                } else if ($monthNum == 14) {
                    $monthNum = 02;
					$year = $afteroneyear;
                } else if ($monthNum == 15) {
                    $monthNum = 03;
					$year = $afteroneyear;
                } else {
                    $monthNum = $monthNum;
                }
				//echo $year;
                $dateObj = DateTime::createFromFormat('!m', $monthNum);
                $monthName = $dateObj->format('F');
                $number = cal_days_in_month(CAL_GREGORIAN, $monthNum, date("Y")); // 31
                ?>

                <tr>
                    <td><?php echo $monthName;?></td>
                    <?php
                    for ($y = 1; $y <= $number; $y++) {
						
                        $date = $year . "-" . $monthNum . "-" . $y;
                        $date = date('Y-m-d', strtotime($date));
                        require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
                        require_once('../../classes/general_class.php');
                        $obj = new General();
                        $status = $obj->getCurrentAttendenece($date, $_REQUEST['id']);
                        if ($status == 'AB') {
                            $tag = 'absent';
                            $status = 'A';
                        } else if ($status == 'PR') {
                            $tag = 'present';
                            $status = 'P';
                        } else if ($status == 'LV') {
                            $tag = 'cancel';
                            $status = 'L';
                        } else if ($status == 'S') {
                            $tag = 'cancel';
                            $status = 'S';
                        } else {


                        }
                        ?>
                        <td class="<?php echo $tag; ?>"><?php if($tag == 'present'){
                            ?><a href="#" data-toggle="tooltip"
                                 data-original-title="In Time: 9:30AM<br/> Out Time: 2:30PM">
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
<?php include '../includes/foot.php'; ?>
<script type="text/javascript">
$("#attsesssion").change(function(e) {
var action='mymsgs';
var session = '<?php echo $_SESSION['USER']['DB_NAME'];?>'; 
var id = '<?php echo $_SESSION['USER']['USER_ID'];?>'; 
var role = '<?php echo $_SESSION['USER']['ROLE_ID'];?>'; 
var selectedCountry = $("#attsesssion option:selected").val();
var dataString = 'seelectedoption='+selectedCountry+'&session='+session+'&role='+role+'&action='+action;
//alert(dataString);

function getQueryVariable(url, variable) {
  	 var query = url.substring(1);
     var vars = query.split('&');
     for (var i=0; i<vars.length; i++) {
          var pair = vars[i].split('=');
          if (pair[0] == variable) {
            return pair[1];
          }
     }

     return false;
  }
  
  
var url = window.location.href; 
  if (url.indexOf('?') > -1){
	if (url.indexOf('type') > -1){
			var w = getQueryVariable(url, 'type');
			//alert(selectedCountry);
			var params = {'type':''+selectedCountry+''};
			//alert(params);
			var pathname = window.location.pathname;
			var url = '<?php echo HTTP_SERVER;?>/dashboard/school-admin/attendance-student.php?id=<?php echo $_REQUEST['id']; ?>&' + jQuery.param(params);
			//url.replace(url.split('/')[5], 'edited');
			//url += '&type='+selectedCountry;


   }
   else
   {
	 url += '&type='+selectedCountry;
   }
}else{
	if (url.indexOf('type') > -1){
		 url += '&type='+selectedCountry;

   }
   else
   {
	url += '?type='+selectedCountry;
   }
}
var qs = new String(window.location);

window.location.href = url;
});
</script>

<script>
    $("#sel1").change(function(e) {
        var action = 'searchstugraph';
        var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>';
        var session_start_date = '<?php echo SESSION_START_DATE;?>';
        var id = '<?php echo $_REQUEST['id']?>';
        var attsession = $("#sel1").val();
        var dataString = 'session=' + session + '&id=' + id + '&attsession=' + attsession + '&session_start_date=' + session_start_date + '&action=' + action;
		
    //alert(dataString);
     $.ajax({ 
            type: 'POST',
            data: dataString,
            url: '../../ajax.php',
			success: function (data) {
			//alert(data);
				 if (data != "") {
                    //window.location.reload();
                    if (data == 1) {
                        alert("Required Parameter Missing");
                        $("#preloader").css("display", "none");
                        return false;
                    }
                    else if (data == 4) {
                        alert("Session Expired......Try Again.....");
                        window.location.reload();
                    }
                    else {
                         $("#SideTable").html(data);
						 // $("#loader").hide();
						  
                    }
                }
            }

        });
    });
    //##############################################################################################
</script>

</body>
</html>

