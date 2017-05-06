<?php
define("DEFAULT_STAFF","00000016");
define("DEFAULT_STU","18640");
define("DEFAULT_SESSION","2017-2018");
define("SESSION_START_DATE","2017-04-01");
define("CURRENT_SESSION","2017-2018");
define("DEFAULT_CLASS","1");
$sqlsection=mysql_fetch_array(mysql_query("SELECT section_id,section_name FROM  essort_section WHERE class_id='".DEFAULT_CLASS."' LIMIT 1"));
	$rowtblee=array();
		for($i=1;$i<=12;$i++)
		{
			$dateObj   = DateTime::createFromFormat('!m', $i);
			$monthName = $dateObj->format('F');
			$rowtblee[$monthName]['PRESENT']=0;
			$rowtblee[$monthName]['ABSENT']=0;
		}
		$cheque_detail = mysql_query("SELECT * FROM essort_fee_transaction ft
				INNER JOIN essort_application_header uh
				ON ft.user_id = usr_application_id WHERE `payment_mode` = 'cheque' AND status = 0");
		#################STAFF ON LEAVE TODAY############################################ 
		$currdate=date('Y-m-d');
		$sqlholidays=mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM  essort_holidays WHERE occassion_type='Event' GROUP BY occassion");
		//$sqlciract = $obj->getCircularActivities();
		$sqlleave = $obj->getStaffonLeaveToday();
		$leavearray=array();
		if($sqlleave!=0)
		{
			while($rowleave=mysql_fetch_array($sqlleave))
			{
				$slleave = mysql_fetch_array(mysql_query("SELECT *,MAX(leave_date) as maxdate,MIN(leave_date) as mindate FROM essort_teacher_leave_info WHERE submit_date='".$rowleave['submit_date']."' AND usr_id='".$rowleave['usr_id']."' AND leave_reason='".$rowleave['leave_reason']."'"));
				
				$sqlusr=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='".$rowleave['usr_id']."'"));
				$rowleave['USERFNAME']=$sqlusr['usr_fname'];
				$rowleave['USERLNAME']=$sqlusr['usr_lname'];
				$rowleave['minoff']=$slleave['mindate'];
				$rowleave['maxoff']=$slleave['maxdate'];
				$leavearray[]=$rowleave;
			}

		}
		//CIRCULAR
		$sqlciract = $obj->getCircularActivities();
		$sqlnote = $obj->getCircularActivities();
		$cirarray=array();
		while($rowcir=mysql_fetch_array($sqlciract))
		{
			$cirarray[]=$rowcir;
		}
		//NO OF STUDENTS
		$sqlstudent=mysql_query("SELECT *  FROM  essort_user_relation");
		$stuarray=array();
		$num_of_students=mysql_num_rows($sqlstudent);
		$stuparray=array();
		while($rowstu=mysql_fetch_array($sqlstudent))
		{
			
			$stuarray[]=$rowstu;
			$stuparray[]=$rowstu['att_ref_id'];
		}
		$aa='';
		if (count($stuparray)!=0)
		{
			$uidconcat='';
			foreach($stuparray as $stupvlue)
			{
				$uidconcat.=$stupvlue.",";
			}
		
		$aa="".substr(trim($uidconcat), 0, -1)."";
		}
		if($aa=='')
		{
			$aa=0;
		}
		else
		{
			$aa=rtrim($aa,",");

		
		}
		//present no of Students
		
		$pstusql=mysql_query("SELECT * FROM essort_class_attendence WHERE att_status='P' AND DATE_FORMAT(att_date,'%Y-%m-%d')='".$currdate."' AND stu_id IN (".$aa.")");
		$pnum_of_students=mysql_num_rows($pstusql);
		$anum_of_students=$num_of_students-$pnum_of_students;
		////NO OF STAFF
		$sqlstaff=mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher')");
		$staffarray=array();
		$sstaffattarray=array();
		$optionstaffsal='';
		$num_of_staffs=mysql_num_rows($sqlstaff);
		while($rowstff=mysql_fetch_array($sqlstaff))
		{
			
			$staffarray[]=$rowstff;
			$sstaffattarray[]=$rowstff['att_ref_id'];
			$optionstaffsal.='<option value="'.$rowstff['emp_id'].'">'.$rowstff['usr_fname'].'</option>';
		}
		//echo $optionstaffsal;
		$staffids='';
		if(count($sstaffattarray)!=0)
		{
			$staffidconcat='';
			foreach($sstaffattarray as $stfpvlue)
			{ 
				if($stfpvlue!='')
				{
					$staffidconcat.=$stfpvlue.",";
				}
			}
			$staffids=substr(trim($staffidconcat), 0, -1);
		}
		if($staffids=='')
		{
			$staffids=0;
		}
		$pstfsql=mysql_query("SELECT * FROM essort_class_attendence WHERE att_status='P' AND DATE_FORMAT(att_date,'%Y-%m-%d')='".$currdate."' AND stu_id IN (".$staffids.")");
		$pnum_of_staffs=mysql_num_rows($pstfsql);
		$anum_of_staffs=$num_of_staffs-$pnum_of_staffs;
		//ALL STAFF WITH ATTENDENCE
		$sqlnote=mysql_query("SELECT *,'att_in_time','attout_time','usr_salary','dept_name','salary_status','att_status','att_id'  FROM  essort_user_header WHERE usr_role IN ('Teacher')");
		$rowatt=array();
		while($rownote=mysql_fetch_array($sqlnote))
		{
			//salary
			$sqlsal=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_details WHERE usr_id='".$rownote['usr_id']."'"));
			$sqlhd=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='".$rownote['usr_id']."'"));
			$sql=mysql_query("SELECT att_in_time,attout_time,att_status,attendence_id FROM essort_class_attendence WHERE stu_id='".$rownote['att_ref_id']."' AND att_date='".date('Y-m-d')."'" );
			$rowusr=mysql_fetch_array($sql);
			//SELECT SALARY
			$sqlsald=mysql_fetch_array(mysql_query("SELECT salary_amount,salary_status FROM essort_staff_salary WHERE emp_id='".$sqlhd['emp_id']."'"));
			$rownote['att_in_time']=$rowusr['att_in_time'];
			$rownote['usr_salary']=$sqlsald['salary_amount'];
			$rownote['salary_status']=$sqlsald['salary_status'];
			$rownote['dept_name']=$sqlsal['dept_name'];
			$rownote['attout_time']=$rowusr['attout_time'];
			$rownote['att_status']=$rowusr['att_status'];
			$rownote['att_id']=$rowusr['attendence_id'];
			$rowatt[]=$rownote;
		
		}
		//print_r($rowatt);
		
		//Leave
		$sqlleave=mysql_query("SELECT *,MAX(leave_date) as maxdate,MIN(leave_date) as mindate,'usr_fname','usr_lname','usr_role' FROM essort_teacher_leave_info GROUP BY submit_date,usr_id");
		$rowattleaveinfo=array();
		while($rowleave=mysql_fetch_array($sqlleave))
		{
			$sqlusr=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='".$rowleave['usr_id']."'"));
			$rowleave['usr_fname']=$sqlusr['usr_fname'];
			$rowleave['usr_lname']=$sqlusr['usr_lname'];
			$rowleave['usr_role']=$sqlusr['usr_role'];
			$rowattleaveinfo[]=$rowleave;
			
		}
		
		$sqlatttble=mysql_query("SELECT YEAR( att_date ) AS y, MONTH( att_date ) AS m, COUNT( DISTINCT att_date ),'ABSENT','PRESENT','TOTAL'
		FROM essort_class_attendence
		WHERE stu_id = '".DEFAULT_STAFF."' AND att_session='".DEFAULT_SESSION."' GROUP BY y, m");
		$rowtble=array();
		while($rowleavetble=mysql_fetch_array($sqlatttble))
		{
			//$sql=mysql_query("SELECT attendence_id FROM essort_class_attendence WHERE MONTH(att_date) = '".$rowleavetble['m']."' AND stu_id = '".DEFAULT_STAFF."'"); //AND YEAR(happened_at) = 2009
			//$num_of_rows=mysql_num_rows($sql);
			$sql = mysql_query("SELECT DATE_FORMAT(`off_day` , '%Y-%m-%d') as date
            FROM essort_holidays  WHERE occassion_type='Holiday' AND DATE_FORMAT(off_day,'%m')='".$rowleavetble['m']."' AND status='1'") OR DIE(mysql_error());
			$holidays=array();
			while($row=mysql_fetch_array($sql))
			{
				$holidays[]=$row['date'];
			}
			$todaydate=date('Y-m-d');
			$start_date=date(''.$rowleavetble['y'].'-'.$rowleavetble['m'].'-01');
			$d=cal_days_in_month(CAL_GREGORIAN,$rowleavetble['m'],$rowleavetble['y']);
			$todaydate=date(''.$rowleavetble['y'].'-'.$rowleavetble['m'].'-'.$d);
			$num_of_rows=$obj->getWorkingDays($start_date,$todaydate,$holidays);
			
			//PRESEENT DAYS
			$sqlp=mysql_query("SELECT attendence_id FROM essort_class_attendence 
			WHERE MONTH(att_date) = '".$rowleavetble['m']."' AND stu_id = '".DEFAULT_STAFF."' AND att_status='P'");
			$pnum_of_rows=mysql_num_rows($sqlp);
			//ABSENT DAYS
			$anum_of_rows=$num_of_rows-$pnum_of_rows;
			$rowleavetble['ABSENT']=$anum_of_rows; 
			$rowleavetble['PRESENT']=$pnum_of_rows;
			$rowleavetble['TOTAL']=$num_of_rows; 
			$rowtble[]=$rowleavetble;
			
		}
		################################################################################################################
		//SCHOOL STUDENTS.PHP
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
		$att_ref_idlist = rtrim($att_ref_idlist, ',');
		$stunum_of_rows=mysql_num_rows($stusql);
		
		
		############SLECT ALL CLASSE########################
		$sqlclassesed=mysql_query("SELECT * FROM essort_classes");
		$class='';
		while($rowclass=mysql_fetch_array($sqlclassesed)) 
		{
			$selected="";
			if($rowclass['class_id']==DEFAULT_CLASS)
			{
				$selected='selected';
			}
			$class.='<option value="'.$rowclass['class_id'].'" '.$selected.'>'.$rowclass['class_name'].'</option>';
		}
		############SLECT Staff Salary########################
		$sqlstfatted=mysql_query("SELECT salary_month AS m,salary_year as y,'NO_OF_STAFF',salary_amount
		FROM essort_staff_salary
		GROUP BY y, m");
		$saldata=array();
		while($rowstaff=mysql_fetch_array($sqlstfatted))
		{
			$sqlusr=mysql_query("SELECT DISTINCT emp_id FROM essort_staff_salary WHERE salary_month='".$rowstaff['m']."' AND salary_year='".$rowstaff['y']."'");
			$no_of_staff=mysql_num_rows($sqlusr);
			$sqlusrsum=mysql_fetch_array(mysql_query("SELECT SUM( salary_amount ) AS value_sum
				FROM essort_staff_salary
				WHERE salary_month ='".$rowstaff['m']."' AND salary_year='".$rowstaff['y']."'"));
			$amount=$sqlusrsum['value_sum'];
			$rowstaff['NO_OF_STAFF']=$no_of_staff;
			$rowstaff['salary_amount']=$amount;
			$saldata[]=$rowstaff;
		}
		#######################SELECT ALL APPLICATION#############################################
		$sqlstuapp=mysql_query("SELECT *,'class_name','section','sec_id' FROM essort_application_header WHERE  usr_application_id NOT IN (SELECT stu_id FROM essort_user_relation)");
		$appdata=array();
		while($rowapp=mysql_fetch_array($sqlstuapp))
		{
			$sqlclassinfo=mysql_fetch_array(mysql_query("SELECT class_name FROM essort_classes WHERE class_id='".$rowapp['usr_class_id']."'"));
			$sqlsecinfo=mysql_query("SELECT section_id,section_name FROM essort_section WHERE class_id='".$rowapp['usr_class_id']."'");
			$section=array();
			$section_idarrr=array();
			while($rowsec=mysql_fetch_array($sqlsecinfo))
			{
				$section[$rowsec['section_id']]=$rowsec['section_name'];
				$section_idarrr[]=$rowsec['section_id'];
			}
			$sec='';
			foreach($section as $secvlue)
			{
					$sec.=$secvlue.',';
			}
			$secid='';
			foreach($section_idarrr as $secidvlue)
			{
					$secid.=$secidvlue.',';
			}
			
			$rowapp['class_name']=$sqlclassinfo['class_name'];
			$rowapp['section']=$sec;
			$rowapp['sec_id']=$secid;
			$appdata[]=$rowapp;
		}
		//print_r($appdata);
		//SELECT FEE
		//$sql="";
		
		//$countarr=mysql_num_rows($sqlmsgmain);
		$sqlteacher=mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher')");
		$optionstaff='';
		while($row=mysql_fetch_array($sqlteacher))
		{
			$optionstaff.='<option value='.$row['usr_id'].'>'.$row['usr_fname'].'</option>';
		}
		
		$rowstutble = $obj->getAttendnce(DEFAULT_STU);
		$rowstafftble = $obj->getAttendnce(DEFAULT_STAFF);
		//print_r($rowstafftble);
		
		
		//COUNT OF NO OF STUDENTS,PRESENT AND ABSENT
		$sqlholidayss = mysql_query("SELECT DATE_FORMAT(`off_day` , '%Y-%m-%d') as date
            FROM essort_holidays  WHERE occassion_type='Holiday' AND status='1'") OR DIE(mysql_error());
			$holidayss=array();
			while($row=mysql_fetch_array($sqlholidayss))
			{
				$holidayss[]=$row['date'];
			}
		$sqlclasssectionstu=mysql_num_rows(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".DEFAULT_STU."' AND att_session='".DEFAULT_SESSION."'"));
		$todaysdates=date("Y-m-d");
		$currstu=$obj->getWorkingDays(SESSION_START_DATE,$todaysdates,$holidayss);
		$sqlclasssectionstuab=$currstu-$sqlclasssectionstu;  
		
		$sqlclasssectionstaff=mysql_num_rows(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".DEFAULT_STAFF."' AND att_session='".DEFAULT_SESSION."'"));
		$sqlclasssectionstaffab=$currstu-$sqlclasssectionstaff;   
		 
?>