<?php
############################FIND PARENT CHILDREN ############################################################
$sqlchild=mysql_query("SELECT *,'class_name','section_name' FROM essort_user_relation WHERE parent_id='".$_SESSION['USER']['USER_ID']."'");
$stuarray=array();
while($rowstu=mysql_fetch_array($sqlchild))
{
	//class name
	$sqlclass=mysql_fetch_array(mysql_query("SELECT class_name FRom essort_classes WHERE class_id='".$rowstu['class_id']."'"));
	$rowstu['class_name']=$sqlclass['class_name'];
	//Section Name
	$sqlsec=mysql_fetch_array(mysql_query("SELECT section_name FRom essort_section WHERE class_id='".$rowstu['class_id']."' AND section_id='".$rowstu['sec_id']."'"));
	$rowstu['class_name']=$sqlclass['class_name'];
	$rowstu['section_name']=$sqlsec['section_name'];
	$stuarray[]=$rowstu;
}
#############################FIND CHILDERN DATA###################################################################

foreach($stuarray as $studata)
{
	$sql=mysql_query("SELECT * FROM  essort_application_header WHERE usr_application_id='".$studata['stu_id']."'");
	$stuadata=array();
	while($rowstudetail=mysql_fetch_array($sql))
	{
		$stuadata[]=$rowstudetail;
	}
}

#############################FIND FATHER CHILDERN DATA###################################################################
$sqlfather=mysql_fetch_array(mysql_query("SELECT * FROM  essort_application_family_info WHERE usr_application_id='".$stuarray[0]['stu_id']."' AND usr_relation='father'"));
//print_r($sqlfather);
#############################FIND FATHER CHILDERN DATA###################################################################
$sqlmother=mysql_fetch_array(mysql_query("SELECT * FROM  essort_application_family_info WHERE usr_application_id='".$stuarray[0]['stu_id']."' AND usr_relation='mother'"));
#############################FIND PRINCIPAL###################################################################
$sqlprincipal=mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header WHERE usr_role='principal'"));
#############################FIND CLASS TEACHER###################################################################
$sqlclassteacher=mysql_fetch_array(mysql_query("SELECT staff_id FROM  essort_teacher_class WHERE class_id='".$stuarray[0]['class_id']."' AND section_id='".$stuarray[0]['sec_id']."' AND is_classteacher='1'"));
$sqlclassteacherdata=mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header as a JOIN essort_user_details as b ON a.usr_id=b.usr_id WHERE a.usr_id='".$stuarray[0]['stu_id']."'"));
####################################################################################################################################3
$classteacherdata=mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header as a JOIN essort_user_details as b ON a.usr_id=b.usr_id WHERE a.usr_id='".$sqlclassteacher['staff_id']."'"));

$select_sad =mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header WHERE usr_role='SAD'"));
$select_user =mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header WHERE usr_id='".$_SESSION['USER']['USER_ID']."'"));
$select_tech =mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header WHERE usr_role='Teacher'"));
#########################################FOR PRICIPAL PROFILE ON PARENT DASHBOARD###############################################
$select_prnc = mysql_fetch_array(mysql_query("
SELECT * FROM essort_user_header uh
INNER JOIN essort_user_details  ud
ON uh.usr_id = ud.usr_id
WHERE uh.usr_role='principal'"));


$sqlmsgs = $obj->VIEWALLMESSAGE($_SESSION['USER']['USER_ID'],'Parent',$_REQUEST['page']);
		$countarr=count($sqlmsgs);
		//print_r($sqlmsgs);
		$sqlteacher=mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher') AND usr_id='".$sqlclassteacher['staff_id']."'");
		$optionstaff='';
		while($row=mysql_fetch_array($sqlteacher))
		{
			$optionstaff.='<option value='.$row['usr_id'].'>'.$row['usr_fname'].'</option>';
		}
		
#################################FOR LATEST CIRCULAR#######################################################
$sqlciract = $obj->getCircularActivities();
$cirarray=array();
while($rowcir=mysql_fetch_array($sqlciract))
{
    $cirarray[]=$rowcir;
}		
#############################SELECT FEE###################################################################	
$sql=mysql_query("SELECT *,'element_name' FROM essort_fee_structure WHERE class_id='".$stuarray[0]['class_id']."' AND sec_id='".$stuarray[0]['sec_id']."'");	
$element=array();
while($row=mysql_fetch_array($sql))
{
	$sqlelemname=mysql_fetch_array(mysql_query("SELECT fee_elem_name FROm essort_fee_detail WHERE fee_id='".$row['fee_elem_id']."'"));
	$row['element']=$sqlelemname['fee_elem_name'];
	$element[]=$row;
}
$no_of_element_count=count($element);
#############################SELECT FEE###################################################################	
$date =date('Y-m-d');
$month=date('F',strtotime($rdate));

$montharr = array("April", "May", "June");
$monthsecarr = array("July", "August", "September");
$monththirdcarr = array("October", "November", "December");
$monthfourthcarr = array("October", "November", "December");
if (in_array($month, $montharr))
{
	$type='first';
}
elseif(in_array($month, $monthsecarr))
{
	$type='second';

}
elseif(in_array($month, $monththirdcarr))
{
	$type='third';

}
else
{
	$type='fourth';

}

$sqlfeetrans=mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='".$stuarray[0]['stu_id']."' AND fee_quarter='".$type."'");	
$fee_trans_no_of_rows=mysql_num_rows($sqlfeetrans);
if($fee_trans_no_of_rows==0)
{
	$type=$type;
}
else
{
	$type='No Due';
}
########################################################PENDING DUES###########################################################################
if($type=='fourth')
{
	$amount=0;
	$penality=0;
	//PENALITY
		$sqlpenality=mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='fourth'"));
		$now = time(); 
		$your_date = strtotime($sqlpenality['ftime_edate']);
		$datediff = $now - $your_date;
		$count=floor($datediff / (60 * 60 * 24));
		$penality=0;
		for($i=1;$i<=$count;$i++)
		{
			$penality=$penality+$sqlpenality['fpenality'];
		}
		
	$sqlpendingdues=mysql_query("SELECT * FROM essort_fee_transaction WHERE WHERE user_id='".$stuarray[0]['stu_id']."' AND fee_quarter='third");
	$fee_pending_no_of_rows=mysql_num_rows($sqlpendingdues);
	if($fee_pending_no_of_rows==0)
	{
		$sqltype=mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='".$stuarray[0]['class_id']."' AND sec_id='".$stuarray[0]['sec_id']."'");
		while($rowtype=mysql_fetch_array($sqltype))
		{
			if($rowtype['fee_elem_type']=='Monthly')
			{
				$rowtype['fee_elem_amount']=$rowtype['fee_elem_amount']*3;
				$amount=$amount+$rowtype['fee_elem_amount'];
			}
			else
			{
				$amount=$amount+$rowtype['fee_elem_amount'];
			}
		
		}
		
		//PENALITY
		$sqlpenality=mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='third'"));
		$now = time(); 
		$your_date = strtotime($sqlpenality['ftime_edate']);
		$datediff = $now - $your_date;
		$count=floor($datediff / (60 * 60 * 24));
		
		for($i=1;$i<=$count;$i++)
		{
			$penality=$penality+$sqlpenality['fpenality'];
		}
		//echo "PEN". $amount;
	}
	//SECOND QUARTER
	$sqlpendingsdues=mysql_query("SELECT * FROM essort_fee_transaction WHERE WHERE user_id='".$stuarray[0]['stu_id']."' AND fee_quarter='second");
	$fee_pending_nos_of_rows=mysql_num_rows($sqlpendingsdues);
	if($fee_pending_nos_of_rows==0)
	{
		$sqltype=mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='".$stuarray[0]['class_id']."' AND sec_id='".$stuarray[0]['sec_id']."'");
		while($rowtype=mysql_fetch_array($sqltype))
		{
			if($rowtype['fee_elem_type']=='Monthly')
			{
				$rowtype['fee_elem_amount']=$rowtype['fee_elem_amount']*3;
				$amount=$amount+$rowtype['fee_elem_amount'];
			}
			else
			{
				$amount=$amount+$rowtype['fee_elem_amount'];
			}
		
		}
		//PENALITY
		$sqlpenality=mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='second'"));
		$now = time(); 
		$your_date = strtotime($sqlpenality['ftime_edate']);
		$datediff = $now - $your_date;
		$count=floor($datediff / (60 * 60 * 24));
		
		for($i=1;$i<=$count;$i++)
		{
			$penality=$penality+$sqlpenality['fpenality'];
		}
	}
	//FIRST QUARTER
	$sqlpendingfdues=mysql_query("SELECT * FROM essort_fee_transaction WHERE WHERE user_id='".$stuarray[0]['stu_id']."' AND fee_quarter='first");
	$fee_pending_nof_of_rows=mysql_num_rows($sqlpendingfdues);
	if($fee_pending_nof_of_rows==0)
	{
		$sqltype=mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='".$stuarray[0]['class_id']."' AND sec_id='".$stuarray[0]['sec_id']."'");
		while($rowtype=mysql_fetch_array($sqltype))
		{
			if($rowtype['fee_elem_type']=='Monthly')
			{
				$rowtype['fee_elem_amount']=$rowtype['fee_elem_amount']*3;
				$amount=$amount+$rowtype['fee_elem_amount'];
			}
			else
			{
				$amount=$amount+$rowtype['fee_elem_amount'];
			}
		
		}
		//PENALITY
		$sqlpenality=mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='first'"));
		$now = time(); 
		$your_date = strtotime($sqlpenality['ftime_edate']);
		$datediff = $now - $your_date;
		$count=floor($datediff / (60 * 60 * 24));
		
		for($i=1;$i<=$count;$i++)
		{
			$penality=$penality+$sqlpenality['fpenality'];
		}
	}
}
elseif($type=='third')
{
	$amount=0;
	$penality=0;
	//SECOND QUARTER
	$sqlpendingsdues=mysql_query("SELECT * FROM essort_fee_transaction WHERE WHERE user_id='".$stuarray[0]['stu_id']."' AND fee_quarter='second");
	$fee_pending_nos_of_rows=mysql_num_rows($sqlpendingsdues);
	if($fee_pending_nos_of_rows==0)
	{
		$sqltype=mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='".$stuarray[0]['class_id']."' AND sec_id='".$stuarray[0]['sec_id']."'");
		while($rowtype=mysql_fetch_array($sqltype))
		{
			if($rowtype['fee_elem_type']=='Monthly')
			{
				$rowtype['fee_elem_amount']=$rowtype['fee_elem_amount']*3;
				$amount=$amount+$rowtype['fee_elem_amount'];
			}
			else
			{
				$amount=$amount+$rowtype['fee_elem_amount'];
			}
		
		}
		$sqlpenality=mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='second'"));
		$now = time(); 
		$your_date = strtotime($sqlpenality['ftime_edate']);
		$datediff = $now - $your_date;
		$count=floor($datediff / (60 * 60 * 24));
		
		for($i=1;$i<=$count;$i++)
		{
			$penality=$penality+$sqlpenality['fpenality'];
		}
	}
	//FIRST QUARTER
	$sqlpendingfdues=mysql_query("SELECT * FROM essort_fee_transaction WHERE WHERE user_id='".$stuarray[0]['stu_id']."' AND fee_quarter='first");
	$fee_pending_nof_of_rows=mysql_num_rows($sqlpendingfdues);
	if($fee_pending_nof_of_rows==0)
	{
		$sqltype=mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='".$stuarray[0]['class_id']."' AND sec_id='".$stuarray[0]['sec_id']."'");
		while($rowtype=mysql_fetch_array($sqltype))
		{
			if($rowtype['fee_elem_type']=='Monthly')
			{
				$rowtype['fee_elem_amount']=$rowtype['fee_elem_amount']*3;
				$amount=$amount+$rowtype['fee_elem_amount'];
			}
			else
			{
				$amount=$amount+$rowtype['fee_elem_amount'];
			}
		
		}
		$sqlpenality=mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='first'"));
		$now = time(); 
		$your_date = strtotime($sqlpenality['ftime_edate']);
		$datediff = $now - $your_date;
		$count=floor($datediff / (60 * 60 * 24));
		
		for($i=1;$i<=$count;$i++)
		{
			$penality=$penality+$sqlpenality['fpenality'];
		}
	}
}
elseif($type=='second')
{
	$amount=0;
	//FIRST QUARTER
	$sqlpendingfdues=mysql_query("SELECT * FROM essort_fee_transaction WHERE WHERE user_id='".$stuarray[0]['stu_id']."' AND fee_quarter='first");
	$fee_pending_nof_of_rows=mysql_num_rows($sqlpendingfdues);
	if($fee_pending_nof_of_rows==0)
	{
		$sqltype=mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='".$stuarray[0]['class_id']."' AND sec_id='".$stuarray[0]['sec_id']."'");
		while($rowtype=mysql_fetch_array($sqltype))
		{
			if($rowtype['fee_elem_type']=='Monthly')
			{
				$rowtype['fee_elem_amount']=$rowtype['fee_elem_amount']*3;
				$amount=$amount+$rowtype['fee_elem_amount'];
			}
			else
			{
				$amount=$amount+$rowtype['fee_elem_amount'];
			}
		
		}
		$sqlpenality=mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='first'"));
		$now = time(); 
		$your_date = strtotime($sqlpenality['ftime_edate']);
		$datediff = $now - $your_date;
		$count=floor($datediff / (60 * 60 * 24));
		
		for($i=1;$i<=$count;$i++)
		{
			$penality=$penality+$sqlpenality['fpenality'];
		}
	}
}
$fquarter=$obj->VIEWFEETIMELINE('first');
$squarter=$obj->VIEWFEETIMELINE('second');
$tquarter=$obj->VIEWFEETIMELINE('third');
$frthquarter=$obj->VIEWFEETIMELINE('fourth');

?>