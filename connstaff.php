<?php
include("C:/Inetpub/vhosts/vibescom.org/httpdocs/ssort/send-sms.class.php");
$sms = new SMS();
$sms->CLI="SSORTDBAA";
error_reporting(E_ALL);
$serverName = "66.199.229.165";
$dbnewmain = mysql_connect('localhost', 'ssortmaster', '69dG$xu5');
mysql_select_db("admin_ssort_master", $dbnewmain);

//Get Last Punch Id 
$sqldata=mysql_fetch_array(mysql_query("SELECT PunchNo FROM essort_punch_id WHERE id='2'",$dbnewmain));
// close mysql connection here

// get MS Sql connection
$connectionInfo = array( "Database"=>"realsoftweb", "UID"=>"sa", "PWD"=>"abc@123");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
//Check connection established or Not
if($conn) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r(sqlsrv_errors(),true));
}
// get attendance records from master table
$stmt=sqlsrv_query($conn,"SELECT * FROM Tran_MachineRawPunch WHERE Tran_MachineRawPunchId>'".$sqldata['PunchNo']."' ORDER BY [PunchDatetime]");
if( $stmt === false) {
    die(print_r( sqlsrv_errors(), true) );
}
$arrdata=array();
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
      $arrdata[]=$row;
}
//close connection of sql server
sqlsrv_close ($conn);

$attdata=array();
$punchID = '';
$machineids = '';
foreach($arrdata as $arrvlue)
{
	
	$attdata[$arrvlue['MachineNo']][$arrvlue['CardNo']]['time']=$arrvlue['PunchDatetime'];
	// here PunchDateTime will give a DataTime Object. Please see the following example
	/*DateTime Object
	(
		[date] => 2017-01-21 15:28:00.000000
		[timezone_type] => 3
		[timezone] => UTC
	)*/
	//last punch Id
	$punchID=$arrvlue['Tran_MachineRawPunchId'];
	//Get All machine ids 
	$machineids.= "'".$arrvlue['MachineNo']."',";
	
	
}
$machineids=rtrim($machineids,',');
// get dbname, dbuser, dbpass from master using Machine No
$sqlfordb =mysql_query("
SELECT * FROM eesort_machine_setting as a JOIN eesort_db_setting as b WHERE a.db_setting_id=b.id AND a.Machine_no IN (".$machineids.")",$dbnewmain); 
$dbdetails=array();
while($rowmachine=mysql_fetch_array($sqlfordb))
{
    $dbdetails[$rowmachine['Machine_no']]=$rowmachine;
}
//print_R($dbdetails);
//insert attendance record to school database
$todaydate=date('Y-m-d');
foreach($dbdetails as $machineno=>$value)
{
	$dbnew = mysql_connect($value['database_host'], $value['database_user'], $value['database_pass']);
	mysql_select_db($value['database_name'], $dbnew); 
	$sattdata=mysql_query("SELECT * FROM essort_class_attendence WHERE att_date='".date("Y-m-d", strtotime($todaydate))."'",$dbnew);
	//".date("Y-m-d", strtotime($todaydate))."-->
	$todayattdata=array();
	while($rowsattdata=mysql_fetch_array($sattdata))
	{
		$todayattdata[$rowsattdata['stu_id']]=$rowsattdata;
	}
	
	$sattdata=mysql_query("SELECT * FROM essort_class_attendence WHERE att_date='".date("Y-m-d", strtotime($todaydate))."'",$dbnew);
	//".date("Y-m-d", strtotime($todaydate))."-->
	$todayattdata=array();
	while($rowsattdata=mysql_fetch_array($sattdata))
	{
		$todayattdata[$rowsattdata['stu_id']]=$rowsattdata;
	}
	//print_r($todayattdata);

	
	$sql=mysql_query("SELECT * FROM essort_user_header GROUP BY usr_id",$dbnew);
	$arr=array();
		
		while($row=mysql_fetch_array($sql))
		{
		  $arr[$row['usr_id']]=array("name"=>$row['usr_fname']);
		}
		
		//print_r($arr['00000014']);
	$insert_cnt = 0;
	$insert_cnt = 0;
	$intime=array();
	$insert_txt='';
	foreach($attdata[$machineno] as $key=>$cardnodata)
	{
		//print_r($cardnodata);
		//echo $cardnodata['time']->format('Y-m-d H:i:s');
		
		$sqldata=mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".$key."' AND att_date='".$cardnodata['time']->format('Y-m-d')."'",$dbnew);
		$num_of_rows=mysql_num_rows($sqldata);//'".date("Y-m-d", strtotime($todaydate))."'
		
		if($num_of_rows==0)
		{
			if($insert_cnt != 0) {
				$insert_txt .= ", ";
			}
			$insert_txt.="('".$key."', '".$cardnodata['time']->format('H:i')."','-','".$cardnodata['time']->format('Y-m-d')."','P')";
			$insert_cnt++;
			$intime[$key]=$cardnodata['time']->format('H:i');
			
		}
		else
		{
			 $sqlattend=mysql_query("UPDATE essort_class_attendence SET attout_time='".$cardnodata['time']->format('H:i')."' WHERE DATE_FORMAT(att_date,'Y-m-d')='".$cardnodata['time']->format('Y-m-d')."' AND stu_id='".$key."'",$dbnew) or die(mysql_error());
			$outtime[$key]=$cardnodata;
			
		}
		
		
		
	}
	echo $insert_txt;
	   if($insert_txt!=''){
		echo "INSERT INTO essort_class_attendence (stu_id, att_in_time, attout_time, att_date, att_status) VALUES $insert_txt";
		$sqlattend=mysql_query("INSERT INTO essort_class_attendence (stu_id, att_in_time, attout_time, att_date, att_status) VALUES $insert_txt", $dbnew) or die(mysql_error());
		   
		}
	//echo "Arraydfg".print_r($outtime);

	mysql_close($dbnew);
}
//Send messages to User
foreach($outtime as $key=>$outvlaue)
{
	$userdata=$arr[$key]; 
	echo "Dear Admin,"."\n"."Your Employee ".$userdata['name']." left school at ".$invlaue['time']->format('H:i')."";
    $sms->message="Dear Admin,"."\n"."Your Employee ".$userdata['name']." left school at ".$outvlaue['time']->format('H:i')."";
	$sms->mobile=$outvlaue['contactno'];
	$sms->accountName="vibescom";
	//$sms_response = $sms->sendsms();
}

foreach($intime as $key=>$invlaue)
{
	$userdata=$arr[$key]; 
	echo "Dear Admin,"."\n"."Your Employee ".$userdata['name']." left school at ".$invlaue['time']->format('H:i')."";
    $sms->message="Dear Admin,"."\n"."Your Employee ".$userdata['name']." left school at ".$invlaue['time']->format('H:i')."";
	$sms->mobile=$invlaue['contactno'];
	$sms->accountName="vibescom";  
	//$sms_response = $sms->sendsms();
}
// update attendance sequence table
$dbnewmain = mysql_connect('localhost', 'ssortmaster', '69dG$xu5');
mysql_select_db("admin_ssort_master", $dbnewmain);
if($punchID!='')
{
	$sqldata=mysql_query("UPDATE essort_punch_id SET PunchNo='".$punchID."' WHERE id='2'",$dbnewmain);
}
mysql_close($dbnewmain);
?>