<?php
$dbhost = 'localhost';
   $dbuser = 'MISMTCUSER';
   $dbpass = 'vnW30t%8';
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   if(! $conn )
   {
     die('Could not connect: ' . mysql_error());
   }
   echo 'Connected successfully';
   mysql_select_db('MISMTC',$conn);


$sql=mysql_query("SELECT * FROM essort_user_relation") or die(mysql_error());
while($row=mysql_fetch_array($sql))
{
	$newcode=rand();
	$sqlupdate=mysql_query("UPDATE essort_user_relation SET att_ref_id='".$newcode."' WHERE stu_id='".$row['stu_id']."'");
}
//print_r($arr);
?>