<?php
@session_start();
require_once('classes/config.php');
if(isset($_SESSION['USER']) && !empty($_SESSION['USER'])){
//echo '-------------------------';
$dbname=$_SESSION['USER']['DB_NAME'];
unset($_SESSION['USER']);
}
echo "<script>window.location='".HTTP_SERVER.$dbname."/';</script>";
?>