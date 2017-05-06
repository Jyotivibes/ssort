<?php
############################SEARCH DATA OF STUDENT######################################################
if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchstudent') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');
    require_once('classes/assessment_class.php');
    $obj = new Assessment();
	$cond="";
	$class="";
	$section="";
	$stuname="";
	if(isset($_REQUEST['classdata']) && ($_REQUEST['classdata']!='') ){
		$class=$_REQUEST['classdata'];
	}
	if(isset($_REQUEST['section']) && ($_REQUEST['section']!='') ){
		$section=$_REQUEST['section'];
	}
	if(isset($_REQUEST['stuname']) && ($_REQUEST['stuname']!='') ){
		$stuname=$_REQUEST['stuname'];
	}
	
	if($class!='')
	{
		if($cond=='')
		{
			$cond.="WHERE class_id='".$class."'";
		}
		else
		{
			$cond.="AND class_id='".$class."'";
		}
	}
	if($section!='')
	{
		if($cond=='')
		{
			$cond.="WHERE sec_id='".$section."'";
		}
		else
		{
			$cond.="AND sec_id='".$section."'";
		}
	}
	if($stuname!='')
	{
		$sqlallusers=mysql_query("SELECT usr_application_id FROM essort_application_header WHERE usr_fname like '%".$stuname."%' OR usr_fname like '%".$stuname."%' OR usr_lname like '%".$stuname."%'");
		$stuids="";
		while($row=mysql_fetch_array($sqlallusers))
		{
			$stuids.=$row['usr_application_id'].",";
		}
		$stuids=rtrim($stuids,',');
		if($stuids!='')
		{
			if($cond=='')
			{
				$cond.="WHERE stu_id IN (".$stuids.")";
			}
			else
			{
				$cond.="AND stu_id IN (".$stuids.")";
			}
		}
		
		
		
	}
	
	
	$sql=mysql_query("SELECT stu_id,'PIC','STUNAME','GRADE',(SELECT emp_id FROM essort_user_header WHERE usr_id=parent_id) as admission_no FROM essort_user_relation ".$cond."");
	$arr=array();
	while($rowuser=mysql_fetch_array($sql))
	{
		$sqluser=mysql_fetch_array(mysql_query("SELECT usr_fname,usr_mname,usr_lname,usr_photo FROM essort_application_header WHERE usr_application_id='".$rowuser['stu_id']."'"));
		//print_r($sqluser);
		$rowuser['STUNAME']=$sqluser['usr_fname']." ".$sqluser['usr_mname']." ".$sqluser['usr_lname'];
		$rowuser['GRADE']="A";
		if($sqluser['usr_photo']=='')
		{
			$sqluser['usr_photo']='images.png';
		}
		$rowuser['PIC']=$sqluser['usr_photo'];
		$arr[]=$rowuser;
	}
	echo json_encode($arr);
	exit;
					
}


##############################SEARCH DATA OF STUDENT##########################################


?>