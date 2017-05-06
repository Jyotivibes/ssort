<?php
define("DEFAULT_CLASS","1");
$sqlsection=mysql_fetch_array(mysql_query("SELECT section_id,section_name FROM  essort_section WHERE class_id='".DEFAULT_CLASS."' LIMIT 1"));

		//NO OF STUDENTS
		$sqlstudent=mysql_query("SELECT *  FROM  essort_user_relation");
		$num_of_students=mysql_num_rows($sqlstudent);
		$sqlclassesed=mysql_query("SELECT * FROM essort_classes");
		$class='';
		while($rowclass=mysql_fetch_array($sqlclassesed)) 
		{
			$class.='<option value="'.$rowclass['class_id'].'">'.$rowclass['class_name'].'</option>';
		}
		//NO OF STUDENTS
		$stusql=mysql_query("SELECT *, att_ref_id,'USERFNAME','USERLNAME','att_status','att_intime','att_outtime' ,'app_no','att_id','amount','last_payment','last_date','usr_pic' FROM essort_user_relation WHERE class_id='".DEFAULT_CLASS."' AND sec_id='".$sqlsection['section_id']."'"); 
		$total_no_of_students= mysql_num_rows($stusql);
		$stuidarr=array();
		$stuatt=array();
		$amount=0;
		$stuoption='';
		$att_ref_idlist='';
		
		$date =date('Y-m-d');
		$month =date("F",strtotime($date));
		while($rowstu=mysql_fetch_array($stusql))
		{
			$stuusql=mysql_fetch_array(mysql_query("SELECT * FROM essort_application_header WHERE usr_application_id=(SELECT stu_id FROM essort_user_relation WHERE stu_id='".$rowstu['stu_id']."' LIMIT 1) LIMIT 1"));
			$sqlatt=mysql_fetch_array(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".$rowstu['att_ref_id']."' AND att_date='".date('Y-m-d')."'"));
			//APPLICATION NO
			$resappno=mysql_fetch_array(mysql_query("SELECT emp_id FROM essort_user_header WHERE usr_id=(SELECT parent_id FROM essort_user_relation WHERE stu_id='".$rowstu['stu_id']."' LIMIT 1)"));
			//TOTAL FEE
			$sqltype=mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='".$rowstu['class_id']."' AND sec_id='".$rowstu['sec_id']."'");
			$amount=0;
				while($rowtype=mysql_fetch_array($sqltype))
				{
					if($rowtype['fee_elem_type']=='Monthly')
					{
						$rowtype['fee_elem_amount']=$rowtype['fee_elem_amount']*3;
						$amount=$amount+$rowtype['fee_elem_amount'];
					}
					else
					{
						
						$a = $month;
						$montharr=explode(",",$rowtype['fee_elem_month']);
						if (in_array($a, $montharr)) {
							$amount=$amount+$rowtype['fee_elem_amount'];
							
						}

					}
				
				}
			//last payment
			$sqllastpaymentsql=mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='".$rowstu['stu_id']."' ORDER BY fee_created_on DESC LIMIT 1");
			$laspaynumrows=mysql_num_rows($sqllastpaymentsql);
			$sqllastpayment=mysql_fetch_array($sqllastpaymentsql);
			if($laspaynumrows==0)
			{
				$sqllastpayment['payment_amount_by_user']=0;
				$sqllastpayment['fee_created_on']='-';
			}
			
			$rowstu['USERFNAME']=$stuusql['usr_fname']." ".$stuusql['usr_mname']." ".$stuusql['usr_lname'];
			$rowstu['ID']=$stuusql['usr_application_id'];
			$rowstu['USERLNAME']=$stuusql['usr_lname'];
			$rowstu['att_status']=$sqlatt['att_status'];
			$rowstu['att_intime']=$sqlatt['att_in_time'];
			$rowstu['att_id']=$sqlatt['attendence_id'];
			$rowstu['att_outtime']=$sqlatt['attout_time'];
			$rowstu['app_no']=$resappno['emp_id'];
			$rowstu['amount']=$amount-$sqllastpayment['payment_amount_by_user'];
			$rowstu['last_payment']=$sqllastpayment['payment_amount_by_user'];
			$rowstu['last_date']=$sqllastpayment['fee_created_on'];
			$rowstu['usr_pic']=$stuusql['usr_photo'];
			
			$stuoption.='<option>'.$rowstu['USERFNAME'].'</option>';
			if($rowstu['att_ref_id']!='')
			{
				$att_ref_idlist.=$rowstu['att_ref_id'].",";
			}
			
			$stuidarr[]=$rowstu;
		}
		//print_r($stuarray);
		#############################SELECT FEE###################################################################	
		
$sqlchild=mysql_fetch_array(mysql_query("SELECT *,(SELECT class_name FROM essort_classes as c WHERE c.class_id=r.class_id) as class_name,(SELECT section_name FROM essort_section as s WHERE s.class_id=r.class_id AND s.section_id=r.sec_id) as section_name FROM essort_user_relation as r WHERE stu_id='".$_REQUEST['id']."'"));
$sqlstuinfo=mysql_fetch_array(mysql_query("SELECT * FROM  essort_application_header WHERE usr_application_id='".$_REQUEST['id']."'"));

$sql=mysql_query("SELECT *,'element_name' FROM essort_fee_structure WHERE class_id='".$sqlchild['class_id']."' AND sec_id='".$sqlchild['sec_id']."'");	
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

$sqlfeetrans=mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='".$_REQUEST['id']."' AND fee_quarter='".$type."'");	
$fee_trans_no_of_rows=mysql_num_rows($sqlfeetrans);
if($fee_trans_no_of_rows==0)
{
	$type=$type;
}
else
{
	$type='No Due';
}
#####################PENDING DUES###########################################################################
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
		
	$sqlpendingdues=mysql_query("SELECT * FROM essort_fee_transaction WHERE  user_id='".$stuarray[0]['stu_id']."' AND fee_quarter='third");
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
	$sqlpendingsdues=mysql_query("SELECT * FROM essort_fee_transaction WHERE WHERE user_id='".$_REQUEST['id']."' AND fee_quarter='second");
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
	$sqlpendingfdues=mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='".$stuarray[0]['stu_id']."' AND fee_quarter='first");
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
	$sqlpendingsdues=mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='".$stuarray[0]['stu_id']."' AND fee_quarter='second");
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
	$sqlpendingfdues=mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='".$stuarray[0]['stu_id']."' AND fee_quarter='first");
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
	$sqlpendingfdues=mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='".$stuarray[0]['stu_id']."' AND fee_quarter='first");
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