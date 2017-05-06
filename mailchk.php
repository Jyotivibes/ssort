<?php
error_reporting(-1);
error_reporting(E_ALL);
define("SITE_NAME","Strat-Board");
define("CURRENT_TIME",date('Y-m-d H:i:s'));
define("CC",'requirements@strat-board.com');
define("From_mail","memberservices@strat-board.com");
?>

<?php
$to = 'jyoti.sharma@vibescom.in';
$to1 = 'jyotics09@gmail.com';
$cc='jyoti.sharma@vibescom.in';
$from=From_mail; 
$fromname=SITE_NAME;
$message2 .="<b>Dear jyoti</b>,<br/><br/>A new partner requirement has been posted on Strat-Board, which may interest you. Details are as follows:<br/><br/>";
$title = 'Title';
$industry = 'Industry';
$specifications = 'Specifications';
$message2 = preg_replace('/\"/', '\\"', $message2);
$subject2 = "Subject";

$rtnMSG2 = system("curl -F to=".$to." -F cc=".$cc." -F subject=\"".$subject2."\" -F text=\"\" --form-string html=\"".$message2."\" -F fromname=".$fromname."  -F from=".$from." -F api_user=vibescom -F api_key=123-vibes-456 https://sendgrid.com/api/mail.send.json");
//$rtnMSG2 = system("curl -F to=".$to1." -F subject=\"".$subject2."\" -F text=\"\" --form-string html=\"".$message2."\" -F fromname=".$fromname."  -F from=".$from." -F api_user=strat-board -F api_key=abcd1234 https://sendgrid.com/api/mail.send.json");
echo "Jyoti: ".$rtnMSG2;


?>