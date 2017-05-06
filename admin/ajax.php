<?php
		require_once('../classes/connection.php');
		require_once('../classes/general_class.php');
		$obj = new General();
	//############# LOGIN ##################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='userlogin') ){
		if(($_REQUEST['user_email']=='') && ($_REQUEST['user_password']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			$user_email =$_REQUEST['user_email'] ; 
			$user_password = md5($_REQUEST['user_password']);
			//$user_type=$_REQUEST['user_type'] ;
			$userData=array();
			$sql = "SELECT * from eesort_admin where usr_email='".$user_email."' and usr_pass='".$user_password."'";		
			$res=mysql_query($sql) or die(mysql_error());
			//echo mysql_num_rows($res);
			$res2=mysql_num_rows($res);
            if($res2 == 0){
                echo 9; exit; // login email and password worng
            }
			$result = mysql_fetch_array($res); 
			if($result['usr_status']==0 || $result['usr_status']=='0'){
				echo 3; exit;
			}
			
			//$userData['USER_ID'] = $result['usr_id'];
			$userData['USER_NAME'] = $result['usr_full_name'];
			$userData['EMAIL'] = $result['usr_email'];
			$userData['ROLE_ID'] = $result['usr_role'];
			$_SESSION['USER'] = $userData;
			echo 5;exit;			
		}
	}
	//############# LOGIN ##################################
	
?>