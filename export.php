<?php
@session_start();
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']))
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
		$db_name=$_SESSION['USER']['DB_NAME'];
		require_once('MISMTC/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment;filename=exported-data.csv');
		$select = mysql_query("SELECT * FROM essort_staff_salary");
		$row = mysql_fetch_assoc($select);
		if($row){
			getcsv(array_keys($row));
		}
		while($row){
			getcsv($row);
			$row = mysql_fetch_assoc($select);
		}
	}
?>
<?php
function getcsv($no_of_field_names){
    $separate = '';
    foreach($no_of_field_names as $field_name){
        echo $separate . $field_name;
        $separate = ',';
    }
    echo "\r\n";
}
?>