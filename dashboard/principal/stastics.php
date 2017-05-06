<?php
define("DEFAULT_STAFF","00000016");
define("DEFAULT_STU","18640");
define("DEFAULT_SESSION","2017-2018");
define("SESSION_START_DATE","2017-04-01");
define("CURRENT_SESSION","2017-2018"); 
define("CURRENT_SESSION_SAL","2017-2018");
define("CURRENT_STAFF_SAL","EMP000003");
define("DEFAULT_CLASS","1");
$sqlsection=mysql_fetch_array(mysql_query("SELECT section_id,section_name FROM  essort_section WHERE class_id='".DEFAULT_CLASS."' LIMIT 1"));

		#################STAFF ON LEAVE############################################
		$currdate=date("Y-m-d");
		$sqlleave = $obj->getStaffonLeave();
		$stuleaveidarr=array();
		if($sqlleave!=0)
		{
			while($rowleavestu=mysql_fetch_array($sqlleave))
			{
				$stusql=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='".$rowleavestu['usr_id']."'"));
				$rowleavestu['USERFANME']=$stusql['usr_fname'];
				$rowleavestu['USERLNAME']=$stusql['usr_lname'];
				$rowleavestu['usr_role']=$stusql['usr_role'];
				$rowleavestu['usr_id']=$stusql['usr_id'];
				$stuleaveidarr[]=$rowleavestu;
			}
		}
		//print_r($stuleaveidarr);
		#################STAFF ON LEAVE TODAY############################################
		$sqlleavetoday = $obj->getStaffonLeaveToday();
		$stuleaveidarrtoday=array();
		if($sqlleavetoday!=0)
		{
			while($rowleavestu=mysql_fetch_array($sqlleavetoday))
			{
				$slleave = mysql_fetch_array(mysql_query("SELECT *,MAX(leave_date) as maxdate,MIN(leave_date) as mindate FROM essort_teacher_leave_info WHERE submit_date='".$rowleavestu['submit_date']."' AND usr_id='".$rowleavestu['usr_id']."' AND leave_reason='".$rowleavestu['leave_reason']."'"));
				$stusql=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='".$rowleavestu['usr_id']."'"));
				$rowleavestu['USERFANME']=$stusql['usr_fname'];
				$rowleavestu['mindate']=$slleave['mindate'];
				$rowleavestu['maxdate']=$slleave['maxdate'];
				$rowleavestu['USERLNAME']=$stusql['usr_lname'];
				$rowleavestu['usr_role']=$stusql['usr_role'];
				$stuleaveidarrtoday[]=$rowleavestu;
			}
		}
		//print_r($stuleaveidarrtoday);
		$select = mysql_query("SELECT * FROM essort_user_header WHERE usr_role='Principal'");
		$rowprinc = mysql_fetch_array($select);
		

//print_r($stuleaveidarr);
		//CIRCULAR
		$sqlciract = $obj->getCircularActivities();
		$sqlnote = $obj->getCircularActivities();
		$cirarray=array();
		while($rowcir=mysql_fetch_array($sqlciract))
		{
			$cirarray[]=$rowcir;
		}
		//HOLIDYAS
		$sqlholiday=mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM  essort_holidays WHERE occassion_type='Event' AND DATE_FORMAT( `off_day` , 'Y-m-d' ) >= '".$currdate."' GROUP BY occassion");
		$holarray=array();
		while($rowhol=mysql_fetch_array($sqlholiday))
		{
			$holarray[]=$rowhol;
		}
		//HOLIDYAS
		$sqlmholiday=mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM  essort_holidays WHERE occassion_type='Holiday' GROUP BY occassion");
		$holarraym=array();
		while($rowholm=mysql_fetch_array($sqlmholiday))
		{
			$holarraym[]=$rowholm;
		}
		//NO OF STUDENTS
		$sqlstudent=mysql_query("SELECT *  FROM  essort_user_relation");
		$stuarray=array();
		$num_of_students=mysql_num_rows($sqlstudent);
		while($rowstu=mysql_fetch_array($sqlstudent))
		{
			
			$stuarray[]=$rowstu;
			$stuparray[]=$rowstu['att_ref_id'];
		}
		$pnum_of_students=0;
		$anum_of_students=0;
		if(count($stuarray)!=0)
		{
			$uidconcat='';
			foreach($stuparray as $stupvlue)
			{
				$uidconcat.=$stupvlue.",";
			}
			
			$aa=substr(trim($uidconcat), 0, -1);
			if($aa=='')
			{
				$aa=0;
			}
			else
			{
				$aa=rtrim($aa,',');

			
			}
			//present no of Students
			$pstusql=mysql_query("SELECT * FROM essort_class_attendence WHERE att_status='P' AND DATE_FORMAT(att_date,'%Y-%m-%d')='".$currdate."' AND stu_id IN (".$aa.")");
			$pnum_of_students=mysql_num_rows($pstusql);
			$anum_of_students=$num_of_students-$pnum_of_students;
		}
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
		if($pnum_of_staffs===0)
		{
			$pnum_of_staffs=0;
		}
		$anum_of_staffs=$num_of_staffs-$pnum_of_staffs;
		##################################SALARY###########################
		$saldata = $obj->LAST5MONTHSALARY();
		
		
		$salmonthlydata = $obj->MONTHLYSALARY(CURRENT_STAFF_SAL,CURRENT_SESSION_SAL);
		
		##################################################################
		$rowatt = $obj->ALLSTAFFWITHSALARY();
		$stuidarr = $obj->ALLSTUWITHFEE(DEFAULT_CLASS,$sqlsection['section_id']);
		if(isset($_REQUEST['page'])=='')
		{
			$page=1;
		}
		else
		{
			$page=$_REQUEST['page'];
		
		}
		if(isset($_REQUEST['type'])=='')
		{
			$type=0;
		}
		else if($_REQUEST['type']=='unread')
		{
			$type=2;
		}
		else if($_REQUEST['type']=='read')
		{
			$type=1;
		
		}
		else if($_REQUEST['type']=='delete')
		{
			$type=4;
		
		}
		else
		{
			$type=0; 
		
		}
        if(isset($_REQUEST['records'])=='')
		{
			$records=20;
		}
		else
		{
			$records=$_REQUEST['records'];
		
		}
		
		$sqlmsgs = $obj->VIEWALLMESSAGE($_SESSION['USER']['USER_ID'],'Principal',$page,$type,$records);
		
		$sqlmsgmain = mysql_query("SELECT *,'messages','from_name' FROM essort_message_master WHERE to_id='" . $_SESSION['USER']['USER_ID'] . "' AND to_role='Principal'  AND delete_status=0 GROUP BY subject ORDER BY `date` DESC");
		//$records = $_REQUEST['records'];
		$countarr=mysql_num_rows($sqlmsgmain);

		//print_r($sqlmsgs);
		$sqlteacher=mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher')");
		$optionstaff='';
		$optionstaffemp='';
		while($row=mysql_fetch_array($sqlteacher))
		{
			$optionstaff.='<option value='.$row['usr_id'].'>'.$row['usr_fname'].'</option>';
			$optionstaffemp.='<option value='.$row['emp_id'].'>'.$row['usr_fname'].'</option>';
		}
		###############################################
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
       //print_r($classes);

#################################################HOLIDYAS EVENT FOR APPROVAL########################################################


	   ####################################################################################################
	   
		
		###############################################
		
		##########################################################################################3
		$sqlteachercount=mysql_query("SELECT *,'PRESENT','ABSENT','total' FROM essort_user_header WHERE usr_role='Teacher' GROUP BY usr_role");
		$staff=array();
		$present=0;
		while($row=mysql_fetch_array($sqlteachercount))
		{
			$totalsql=mysql_query("SELECT * FROM essort_user_header WHERE usr_role='".$row['usr_role']."'");
			$total=mysql_num_rows($totalsql);
			$row['total']=$total;
			while($rowpresnt=mysql_fetch_array($totalsql))
			{
				$prsent=mysql_num_rows(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".$rowpresnt['att_ref_id']."'"));
				if($prsent>0)
				{
					$present=$present+1;
				}
			}
			$absent=$total-$present;
			$row['PRESENT']=$present;
			$row['ABSENT']=$absent;
			$staff[$row['usr_role']]=$row;
		}
		//print_R($staff);
	   ############################################################################
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
	   ############################################################################
	   $rowstutble = $obj->getAttendnce(DEFAULT_STU);
	   ########################FIND QUARTER#########################################
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
        $feepending=$num_of_students-$feerecieved;
		##########################################
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
		##########################################
		
		//COUNT OF NO OF STUDENTS,PRESENT AND ABSENT
		$sqlholidayss = mysql_query("SELECT DATE_FORMAT(`off_day` , '%Y-%m-%d') as date
            FROM essort_holidays  WHERE occassion_type='Holiday' AND status='1'") OR DIE(mysql_error());
			$holidayss=array();
			while($row=mysql_fetch_array($sqlholidayss))
			{
				$holidayss[]=$row['date'];
			}
			
		$sqlclasssectionstu=mysql_num_rows(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".DEFAULT_STU."' AND att_session='".DEFAULT_SESSION."'"));
		$todaySdate=date("Y-m-d");
		$currstu=$obj->getWorkingDays(SESSION_START_DATE,$todaySdate,$holidayss);
		$sqlclasssectionstuab=$currstu-$sqlclasssectionstu;   
		
		
		$sqlclasssectionstaff=mysql_num_rows(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".DEFAULT_STAFF."' AND att_session='".DEFAULT_SESSION."'"));
		$sqlclasssectionstaffab=$currstu-$sqlclasssectionstaff;   
		
		
		
?>