<?php
date_default_timezone_set("Asia/Kolkata");
global $monthArray;
global $globalDateTime;
$monthArray = array("1"=>"Jan","2"=>"Feb","3"=>"Mar","4"=>"Apr","5"=>"May","6"=>"Jun","7"=>"Jul","8"=>"Aug","9"=>"Sep","10"=>"Oct","11"=>"Nov","12"=>"Dec");

$globalDateTime=gmdate("Y-m-d H:i:s", time()+19800);


define('HTTP_SERVER_ADMIN', 'http://www.ssort.in/admin/');
define('HTTP_SERVER', 'http://localhost/ssort/');
define('SITEURL', 'http://vibescomm.in/wip_projects/development/pggrabber/');
define('BASE_URL', 'http://vibescomm.in/wip_projects/development/pggrabber/');
define('IMAGEPATH', 'http://vibescomm.in/wip_projects/development/pggrabber/img/logo.png');
define("DASHBOARD_LINK","".HTTP_SERVER."dashboard/principal/principal.php");
define("TEACHER_DASHBOARD_LINK","".HTTP_SERVER."dashboard/teacher/teacher.php");
define("ADMIN_DASHBOARD_LINK","".HTTP_SERVER."dashboard/school-admin/school-admin.php");
define("PARENT_DASHBOARD_LINK","".HTTP_SERVER."dashboard/parents/parents.php");


/*************EMAIL****************************/
define('ADMINEMAIL', 'jyoti.sharma@vibescom.in');
define('ADMINNAME', 'Opstand Solutions');
define('Email_FROM', 'info@pggrabber.com');
define('Email_FROMNAME', 'PG Grabber'); 
define('DATE_TIME', $globalDateTime);


define('CONTACTNO1', '011-395-95813');
define('CONTACTNO2', '011-395-89589');



/**************EXOTEL*******************************/
define('POST_URL' , 'https://pggrabber:789815df83cf2e9a38094364875b53ea5a7f19d9@twilix.exotel.in/v1/Accounts/pggrabber/Calls/connect');
define('CALLERID' , '01139595813');
define('CALLERTYPE' , 'trans');

/*********************************************/
define("FILESIZE","10485760");
define("FIFTEENMB","14679000");
define("TENMB","10485760");
define("IMGSIZE","512000");
define("EIGHTMB","8228608");
define("FOURMB","4194304");
?>