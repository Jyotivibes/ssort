<?php
//FIND CURRENT SESSION
$rescurrsession = $obj->getcurrentsession();
define("CURRENT_SESSION",$rescurrsession);
//FIND SESSION START DATE
define("SESSION_START_DATE","2017-04-01");
define("DEFAULT_CLASS","1");
define("DEFAULT_STAFF","00000016");
define("CURRENT_STAFF_SAL","EMP000003");
$sqlsection=mysql_fetch_array(mysql_query("SELECT section_id,section_name FROM  essort_section WHERE class_id='".DEFAULT_CLASS."' LIMIT 1"));

?>