<?php
//require_once('config.php');
//require_once('email.class.php'); 

###############################CONNECTION#############################/

class Student extends Connection
{
    function __construct()
    {
        $this->createConnection();
    }

    ###############################NEWS AND EVENTS#############################/
	function getallstulist($class,$section)
	{
		$cond="";
		if(isset($_REQUEST['class']) && !empty($_REQUEST['class']))
		{
			if($cond!='')
			{
				$cond.="AND class_id='".$class."'";
			}
			else
			{
				$cond.="WHERE class_id='".$class."'";
			}
		}
		if(isset($_REQUEST['section']) && !empty($_REQUEST['section']))
		{
			if($cond!='')
			{
				$cond.="AND sec_id='".$section."'";
			}
			else
			{
				$cond.="WHERE sec_id='".$section."'";
			}
			
		}
		
		$stusql=mysql_query("SELECT *, att_ref_id,'USERFNAME','USERLNAME','att_status','att_intime','att_outtime' ,'app_no','att_id','amount','last_payment','last_date','usr_pic' FROM essort_user_relation ".$cond.""); 
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
		return $stuidarr;
	
	}
	############################################get TOTAL no ofstudents###########################################################3
	function getnoofstudents($class,$section)
	{
		$cond="";
		if(isset($_REQUEST['class']) && !empty($_REQUEST['class']))
		{
			if($cond!='')
			{
				$cond.="AND class_id='".$class."'";
			}
			else
			{
				$cond.="WHERE class_id='".$class."'";
			}
		}
		if(isset($_REQUEST['section']) && !empty($_REQUEST['section']))
		{
			if($cond!='')
			{
				$cond.="AND sec_id='".$section."'";
			}
			else
			{
				$cond.="WHERE sec_id='".$section."'";
			}
			
		}
		$stusql=mysql_query("SELECT *  FROM essort_user_relation ".$cond.""); 
		$no_of_rows=mysql_num_rows($stusql);
		return $no_of_rows;
	
	}
	
	############################################get PRESENT no ofstudents###########################################################3
	function getpresentnoofstudents($class,$section)
	{
		$cond="";
		if(isset($_REQUEST['class']) && !empty($_REQUEST['class']))
		{
			if($cond!='')
			{
				$cond.="AND class_id='".$class."'";
			}
			else
			{
				$cond.="WHERE class_id='".$class."'";
			}
		}
		if(isset($_REQUEST['section']) && !empty($_REQUEST['section']))
		{
			if($cond!='')
			{
				$cond.="AND sec_id='".$section."'";
			}
			else
			{
				$cond.="WHERE sec_id='".$section."'";
			}
			
		}
		
		$stusql=mysql_query("SELECT *, att_ref_id,'USERFNAME','USERLNAME','IMAGE','att_status','att_intime','att_outtime' ,'app_no','IMAGE','att_id' FROM essort_user_relation ".$cond."");
		$stuidarr=array();
		$stuatt=array();
        $stuoption = '';
		while($rowstu=mysql_fetch_array($stusql))
		{

            $stuusql=mysql_fetch_array(mysql_query("SELECT * FROM essort_application_header WHERE usr_application_id='".$rowstu['stu_id']."' LIMIT 1"));
            $sqlatt=mysql_fetch_array(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".$rowstu['att_ref_id']."' AND att_date='".date('Y-m-d')."'"));
			$rowstu['USERFNAME']=$stuusql['usr_fname'];
			$rowstu['USERLNAME']=$stuusql['usr_lname'];
            $rowstu['IMAGE']=$stuusql['usr_photo'];
			$rowstu['att_status']=$sqlatt['att_status'];
			$rowstu['att_intime']=$sqlatt['att_in_time'];
			$rowstu['att_id']=$sqlatt['attendence_id'];
			$rowstu['att_outtime']=$sqlatt['attout_time'];
			$rowstu['app_no']=$stuusql['usr_application_no'];
			$stuoption.='<option>'.$rowstu['USERFNAME'].'</option>';
			$stuidarr[]=$rowstu;
			$stuatt[]=$rowstu;
		}
		$allstuids='';
		if (count($stuatt)!=0)
		{
			$stuconcat='';
			foreach($stuatt as $stuattvlue)
			{
				$stuconcat.=$stuattvlue['att_ref_id'].",";
			}
		
		$allstuids="".substr(trim($stuconcat), 0, -1)."";
		}
		if($allstuids=='')
		{
			$allstuids=0;
		}
		$currdate=date("Y-m-d");
		$pstusql=mysql_query("SELECT * FROM essort_class_attendence WHERE att_status='P' AND DATE_FORMAT(att_date,'%Y-%m-%d')='".$currdate."' AND stu_id IN (".$allstuids.")");
		$present_no_of_students=mysql_num_rows($pstusql);
		return $present_no_of_students;
	
	}
	
	##################################STUDENT ON LEAVE#####################################################################3
	function getstudentonleave()
	{
		$sqlleave=mysql_query("SELECT usr_id,'USERFANME','USERLNAME','IMAGE' FROM essort_student_leave_info WHERE leave_date = '".date('Y-m-d')."' GROUP BY submit_date");
			$stuleaveidarr=array();
			while($rowleavestu=mysql_fetch_array($sqlleave))
			{
				$stusql=mysql_fetch_array(mysql_query("SELECT * FROM essort_application_header WHERE usr_application_id='".$rowleavestu['usr_id']."'"));
				$rowleavestu['USERFANME']=$stuusql['usr_fname'];
				$rowleavestu['USERLNAME']=$stuusql['usr_lname'];
				$rowleavestu['IMAGE']=$stuusql['usr_photo'];
				$stuleaveidarr[]=$rowleavestu;
			}
			return $stuleaveidarr;
	}
	#######################################################################################################3
	function feesummaryofstudent()
	{
	
	    $sqlfee=mysql_query("SELECT * FROM essort_classes");
		$classesfee=array();
		while($row=mysql_fetch_assoc($sqlfee))
		{
			$sections=mysql_query("SELECT *,'total_stu','pending_fee','recieved_fee' FROM essort_section WHERE class_id='".$row['class_id']."'");
			$secarray=array();
			while($rowsections=mysql_fetch_assoc($sections))
			{
				$sqltotalsql=mysql_query("SELECT * FROM essort_user_relation WHERE class_id='".$row['class_id']."' AND sec_id='".$rowsections['section_id']."'");
				$sqltotalstudent=mysql_num_rows($sqltotalsql);
				$totalrow=array();
				while($totalrstl=mysql_fetch_assoc($sqltotalsql))
				{
					$totalrow[]=$totalrstl['stu_id'];
				}
				$string=implode(",",$totalrow);
				if($string=='')
				{
					$string=0;
				}
				//attedance id
				$sqlatt=mysql_num_rows(mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id IN ($string) AND fee_quarter='first'"));
				if($sqlatt=='')
				{
					$sqlatt=0;
				}
				$rowsections['total_stu']=$sqltotalstudent;
				$rowsections['recieved_fee']=$sqlatt;
				$absencount=$sqltotalstudent-$sqlatt;
				$rowsections['pending_fee']=$absencount;
				$secarray[$rowsections['section_name']]=$rowsections;
			}
			//$classes[0]=$row['class_name'];
			$classesfee[$row['class_name']]=$secarray;
			//$classes[]=$row;
		}
		return $classesfee;
		
	}
	####################################################################################################################
	function attsummaryofstudent()
	{
	
	    $sql=mysql_query("SELECT * FROM essort_classes");
		$classes=array();
		while($row=mysql_fetch_assoc($sql))
		{
			$sections=mysql_query("SELECT *,'total_stu','present_count','absent_count' FROM essort_section WHERE class_id='".$row['class_id']."'");
			$secarray=array();
			while($rowsections=mysql_fetch_assoc($sections))
			{
				$sqltotalsql=mysql_query("SELECT att_ref_id FROM essort_user_relation WHERE class_id='".$row['class_id']."' AND sec_id='".$rowsections['section_id']."'");
				$sqltotalstudent=mysql_num_rows($sqltotalsql);
				$totalrow=array();
				while($totalrstl=mysql_fetch_assoc($sqltotalsql))
				{
					$totalrow[]=$totalrstl['att_ref_id'];
				}
				//print_r($totalrow);
				$string=implode(",",$totalrow);
				if($string=='')
				{
					$string=0;
				}
				//attedance id
				$sqlatt=mysql_num_rows(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id IN ($string) AND att_date='".date('Y-m-d')."'"));
				if($sqlatt=='')
				{
					$sqlatt=0;
				}
				$rowsections['total_stu']=$sqltotalstudent;
				$rowsections['present_count']=$sqlatt;
				$absencount=$sqltotalstudent-$sqlatt;
				$rowsections['absent_count']=$absencount;
				$secarray[$rowsections['section_name']]=$rowsections;
			}
			//$classes[0]=$row['class_name'];
			$classes[$row['class_name']]=$secarray;
			//$classes[]=$row;
		}
		return $classes;
		
	}
	####################################################################################################################
	function nooffeerecieved()
	{
	
	    $date =date('Y-m-d');
		$month=date('F',strtotime($date));

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
		$stusql=mysql_query("SELECT * FROM essort_user_relation"); 
		$total_no_of_students= mysql_num_rows($stusql);
		   while($rowstff=mysql_fetch_array($stusql))
			{
				if($rowstff['stu_id']!='')
				{
					$feearray[]=$rowstff['stu_id'];
				}

			}
		$feearray=array_filter($feearray);
		 $feeid=implode(",",$feearray);
		$feerecieved=mysql_num_rows(mysql_query("SELECT * FROM essort_fee_transaction
        WHERE user_id IN (".$feeid.") AND fee_quarter='".$type."'" ) );
		return $feerecieved;
		
	}
	####################################################################################################################
  
}

?>