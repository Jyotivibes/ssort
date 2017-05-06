<?php
		#################STAFF ON LEAVE############################################
		$currdate=date("Y-m-d");
		$sqlleave = $obj->getStaffonLeave();
		$stuleaveidarr=array();
		while($rowleavestu=mysql_fetch_array($sqlleave))
		{
			$stusql=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='".$rowleavestu['usr_id']."'"));
			$rowleavestu['USERFANME']=$stusql['usr_fname'];
			$rowleavestu['USERLNAME']=$stusql['usr_lname'];
			$rowleavestu['usr_role']=$stusql['usr_role'];
			$stuleaveidarr[]=$rowleavestu;
		}
		#################STAFF ON LEAVE TODAY############################################
		$sqlleavetoday = $obj->getStaffonLeaveToday();
		$stuleaveidarrtoday=array();
		while($rowleavestu=mysql_fetch_array($sqlleavetoday))
		{
			$stusql=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='".$rowleavestu['usr_id']."'"));
			$rowleavestu['USERFANME']=$stusql['usr_fname'];
			$rowleavestu['USERLNAME']=$stusql['usr_lname'];
			$rowleavestu['usr_role']=$stusql['usr_role'];
			$stuleaveidarrtoday[]=$rowleavestu;
		}
		
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
		$sqlholiday=mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM  essort_holidays WHERE occassion_type='Event' GROUP BY occassion");
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
			//present no of Students
			$pstusql=mysql_query("SELECT * FROM essort_class_attendence WHERE att_status='P' AND DATE_FORMAT(att_date,'%Y-%m-%d')='".$currdate."' AND stu_id IN ('".$aa."')");
			$pnum_of_students=mysql_num_rows($pstusql);
			$anum_of_students=$num_of_students-$pnum_of_students;
		}
		////NO OF STAFF
		$sqlstaff=mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher')");
		$staffarray=array();
		$sstaffattarray=array();
		$num_of_staffs=mysql_num_rows($sqlstaff);
		while($rowstff=mysql_fetch_array($sqlstaff))
		{
			
			$staffarray[]=$rowstff;
			$sstaffattarray[]=$rowstff['att_ref_id'];
		}
		$staffidconcat='';
		foreach($sstaffattarray as $stfpvlue)
		{
			$staffidconcat.=$stfpvlue.",";
		}
		//echo"STAFFCONACT".$staffidconcat;
		$staffids='';
		if($staffidconcat!='')
		{
			$staffids=substr(trim($staffidconcat), 0, -1);
		}
		if($staffids=="")
		{
			$staffids=0;
		}
		//echo "SELECT * FROM essort_class_attendence WHERE att_status='P' AND DATE_FORMAT(att_date,'%Y-%m-%d')='".$currdate."' AND stu_id IN (".$staffids.")";
		$pstfsql=mysql_query("SELECT * FROM essort_class_attendence WHERE att_status='P' AND DATE_FORMAT(att_date,'%Y-%m-%d')='".$currdate."' AND stu_id IN (".$staffids.")");
		$pnum_of_staffs=mysql_num_rows($pstfsql);
		$anum_of_staffs=$num_of_staffs-$pnum_of_staffs;
		##################################SALARY###########################
		$saldata = $obj->LAST5MONTHSALARY();
		$sqlstaff=mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher')");
		$staffarray=array();
		$sstaffattarray=array();
		$optionstaff='';
		$num_of_staffs=mysql_num_rows($sqlstaff);
		while($rowstff=mysql_fetch_array($sqlstaff))
		{
			
			$staffarray[]=$rowstff;
			$sstaffattarray[]=$rowstff['att_ref_id'];
			$optionstaff.='<option value="'.$rowstff['emp_id'].'">'.$rowstff['usr_fname'].'</option>';
		}
		
		$salmonthlydata = $obj->MONTHLYSALARY();
		
		##################################################################
		$rowatt = $obj->ALLSTAFFWITHSALARY();
		$sqlmsgs = $obj->VIEWALLMESSAGE($_SESSION['USER']['USER_ID'],'Principal');
		//print_r($sqlmsgs);
		$sqlteacher=mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher')");
		$optionstaff='';
		while($row=mysql_fetch_array($sqlteacher))
		{
			$optionstaff.='<option value='.$row['usr_id'].'>'.$row['usr_fname'].'</option>';
		}

?>