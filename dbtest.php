<?php

require("xmlapi.php"); // this can be downlaoded from https://github.com/CpanelInc/xmlapi-php/blob/master/xmlapi.php
$xmlapi = new xmlapi("https://gains.nanosupercloud.com");   
$xmlapi->set_port('2083');   
$xmlapi->password_auth('ssort','yFaNy~{8]ize');    
$xmlapi->set_debug(0);//output actions in the error log 1 for true and 0 false 

$cpaneluser='ssort';
$databasename="something";
$databaseuser="else";
$databasepass='yFaNy~{8]ize';

//create database    
$createdb = $xmlapi->api1_query($cpaneluser, "Mysql", "adddb", array($databasename));   
//create user 
$usr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduser", array($databaseuser, $databasepass));   
//add user 
$addusr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduserdb", array("".$cpaneluser."_".$databasename."", "".$cpaneluser."_".$databaseuser."", 'all'));

?>