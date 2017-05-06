<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
require("xmlapi.php"); // this can be downlaoded from https://github.com/CpanelInc/xmlapi-php/blob/master/xmlapi.php

$opts = array( "cpanelUserName" => "ssort", //Cpanel UserUserName 
"cpanelPassword" => "yFaNy~{8]ize", //Cpanel UserPassword 
"dbPassword" => "DatabasePassword", //DatabasePassword
"dbusername" => "DatabaseUserbame", //DatabaseUsername 
); 


$host = "gains.nanosupercloud.com";
$xmlapi = new xmlapi($host);   
$xmlapi->set_port( 2083 );   
//$xmlapi->password_auth($opts['user'],$opts['pass']);  
$xmlapi->password_auth($opts['cpanelUserName'],$opts['cpanelPassword']);  
$xmlapi->set_debug(0);//output actions in the error log 1 for true and 0 false 

$cpaneluser="ssort";
$databasename="somethingjyoti";
$databaseuser="elsejyoti";
$databasepass="U,VM;(_H7cv";

//create database    
$createdb = $xmlapi->api1_query($cpaneluser, "Mysql", "adddb", array($databasename));   
echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
//create user 
$usr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduser", array($databaseuser, $databasepass)); 
print_r($usr);  
//add user 
$addusr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduserdb", array("".$cpaneluser."_".$databasename."", "".$cpaneluser."_".$databaseuser."", 'all'));

?>