<?php
date_default_timezone_set("Asia/Kolkata");
global $monthArray;
global $globalDateTime;
$monthArray = array("1"=>"Jan","2"=>"Feb","3"=>"Mar","4"=>"Apr","5"=>"May","6"=>"Jun","7"=>"Jul","8"=>"Aug","9"=>"Sep","10"=>"Oct","11"=>"Nov","12"=>"Dec");

$globalDateTime=gmdate("Y-m-d H:i:s", time()+19800);


define('HTTP_SERVER_ADMIN', 'http://localhost/ssort/admin/');
define('HTTP_SERVER',  'http://localhost/ssort/');
define('SITEURL', 'http://vibescomm.in/wip_projects/development/pggrabber/');
define('BASE_URL', 'http://vibescomm.in/wip_projects/development/pggrabber/');
define('IMAGEPATH', 'http://vibescomm.in/wip_projects/development/pggrabber/img/logo.png');


/*************EMAIL****************************/
define('Email_BCC', 'shilpi.singh@vibescom.in');
define('BCC', 'gulshancac@gmail.com');
define('Email_FROM', 'info@pggrabber.com');
define('Email_FROMNAME', 'PG Grabber'); 
define('DATE_TIME', $globalDateTime);

define('ADMINEMAIL', 'booking@pggrabber.com');
define('ADMINNAME', 'PGGRABBER-TEAM');

define('ORDEREMAIL', 'booking@pggrabber.com');
define('ORDERNAME', 'PGGRABBER-TEAM');

define('SUPPORTEMAIL', 'support@pggrabber.com');
define('SUPPORTNAME', 'PGGRABBER-TEAM');

define('DONOTREPLYMAIL', 'donotreply@pggrabber.com');
define('DONOTREPLYNAME', 'PGGRABBER-TEAM');



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