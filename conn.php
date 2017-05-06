<?php 
$serverName = "tcp:sample.66.199.229.165, 8443";

$connectionOptions = array("Database" => "realsoftweb", 

                           "UID" => "sa",

                           "PWD" => "abc@123",

                           "MultipleActiveResultSets" => false);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if($conn === false)

{

     die(print_r(sqlsrv_errors(), true));

}
?>