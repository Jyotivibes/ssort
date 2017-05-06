<?php
include("C:/Inetpub/vhosts/ssort.in/httpdocs/ssort/send-sms.class.php");
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

$stmt=sqlsrv_query($conn,"SELECT * FROM Tran_MachineRawPunch WHERE Tran_MachineRawPunchId ORDER BY [PunchDatetime]");
if( $stmt === false) {
    die(print_r( sqlsrv_errors(), true) );
}
$arrdata=array();
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    $arrdata[]=$row;
}
//close connection of sql server
print_r($arrdata);
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
print_r($attdata);
$machineids=rtrim($machineids,',');
// get dbname, dbuser, dbpass from master using Machine No
$sqlfordb =mysql_query("
SELECT * FROM eesort_machine_setting as a JOIN eesort_db_setting as b WHERE a.db_setting_id=b.id AND a.Machine_no IN (".$machineids.")",$dbnewmain);
$dbdetails=array();
while($rowmachine=mysql_fetch_array($sqlfordb))
{
    $dbdetails[$rowmachine['Machine_no']]=$rowmachine;
}
print_R($dbdetails);
//insert attendance record to school database
$todaydate=date('Y-m-d');
foreach($dbdetails as $machineno=>$value)
{
    $dbnew = mysql_connect($value['database_host'], $value['database_user'], $value['database_pass']);
    mysql_select_db($value['database_name'], $dbnew);
    $sattdata=mysql_query("SELECT * FROM essort_class_attendence WHERE att_date='".date("Y-m-d", strtotime($todaydate))."'",$dbnew);
    //".date("Y-m-d", strtotime($todaydate))."-->
    

    mysql_close($dbnew);
}
//Send messages to User
// update attendance sequence table
mysql_close($dbnewmain);
?>