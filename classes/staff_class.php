<?php
//require_once('config.php');
//require_once('email.class.php'); 

###############################CONNECTION#############################/

class Staff extends Connection
{
    function __construct()
    {
        $this->createConnection();
    }
	##################################GET ALL STAFF IN DROPDOWN#####################################################################3
	function optionofstaff()
	{
			$sqlteacher=mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher')");
			$optionstaff='';
			
			while($row=mysql_fetch_array($sqlteacher))
			{
				$optionstaff.='<option value='.$row['usr_id'].'>'.$row['usr_fname'].'</option>';
				
			}
			return $optionstaff;
	
	}
	#######################################################################################################3
	function getteacherdetail($id)
	{
		$sqlteachheader=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='".$id."'"));
		return $sqlteachheader;
	}
	#######################################################################################################3
	function getprincipaldetail()
	{
		$resprincipal=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_role='Principal'"));		
		return $resprincipal;
	}

	###############################################get TEACHERCLASS AND SECTION########################################################3
	function gettaecherclasssection($id)
	{
		 $sql = mysql_query("SELECT *,(SELECT class_name FROM essort_classes WHERE class_id=class_id LIMIT 1) as class,(SELECT section_name FROM essort_section WHERE class_id=class_id AND section_id=section_id LIMIT 1) as section FROM essort_teacher_class WHERE is_classteacher='1' AND staff_id='" . $id . "'");
		 $stuidarr = mysql_fetch_array($sql);
		 return $stuidarr;
	
	}
	#######################################################################################################3
	function getnoofstaff()
	{
		$sqlstaff=mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher')");
		$num_of_staffs=mysql_num_rows($sqlstaff);
		return $num_of_staffs;
	
	}
	########################################################################################################
	function getpresentnoofstaffs()
	{
		$sqlstaff=mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher')");
		$staffarray=array();
		$sstaffattarray=array();
		$currdate=date("Y-m-d");
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
		return $pnum_of_staffs;
	
	}
	########################################################################################################
	function getStaffonLeaveToday()
    {
        $sqlleavetoday = mysql_query("SELECT *,leave_date as maxdate,leave_date as mindate,'USERFNAME','USERLNAME','PIC' FROM essort_teacher_leave_info WHERE leave_date='" . date('Y-m-d') . "' AND leave_status = 'Confirmed'");
        $stuleaveidarrtoday=array();
		while($rowleavestu=mysql_fetch_array($sqlleavetoday))
			{
				$slleave = mysql_fetch_array(mysql_query("SELECT *,MAX(leave_date) as maxdate,MIN(leave_date) as mindate FROM essort_teacher_leave_info WHERE submit_date='".$rowleavestu['submit_date']."' AND usr_id='".$rowleavestu['usr_id']."' AND leave_reason='".$rowleavestu['leave_reason']."'"));
				$stusql=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='".$rowleavestu['usr_id']."'"));
				$rowleavestu['USERFANME']=$stusql['usr_fname'];
				$rowleavestu['mindate']=$slleave['mindate'];
				$rowleavestu['maxdate']=$slleave['maxdate'];
				$rowleavestu['USERLNAME']=$stusql['usr_lname'];
				$rowleavestu['usr_role']=$stusql['usr_role'];
				$rowleavestu['PIC']=$stusql['usr_pic'];
				$stuleaveidarrtoday[]=$rowleavestu;
			}
		
		return $stuleaveidarrtoday;
    }
	########################################################################################################
	function getStaffonLeave()
    {
        $sqlleave = mysql_query("SELECT *,max(leave_date) as maxdate,min(leave_date) as mindate,'USERFNAME','USERLNAME','PIC' FROM essort_teacher_leave_info WHERE leave_status = 'Pending' GROUP BY leave_reason");
		$stuleaveidarr=array();
		while($rowleavestu=mysql_fetch_array($sqlleave))
			{
				$stusql=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='".$rowleavestu['usr_id']."'"));
				$rowleavestu['USERFANME']=$stusql['usr_fname'];
				$rowleavestu['USERLNAME']=$stusql['usr_lname'];
				$rowleavestu['usr_role']=$stusql['usr_role'];
				$rowleavestu['usr_id']=$stusql['usr_id'];
				$rowleavestu['PIC']=$stusql['usr_pic'];
				$stuleaveidarr[]=$rowleavestu;
			}
		
		
		return $stuleaveidarr;
    }
	########################################################################################################
	function allholidays()
    {
		 $currdate=date("Y-m-d");
		 $sqlmholiday = mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM  essort_holidays WHERE
		 occassion_type IN('Event','Holiday') AND DATE_FORMAT( off_day, '%Y-%m-%d' ) >= '" . $currdate . "'
		 AND status=0 GROUP BY occassion");

		$holarrays = array();
		while ($rowholme = mysql_fetch_array($sqlmholiday)) {
			$holarrays[] = $rowholme;
		}
		return $holarrays;
	}
	########################################################################################################
	function allstaffstastics()
    {
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
		return $staff;
	}
	########################################################################################################
	function staffmonthwiseatt($staff,$session)
    {
		$sqlatttble=mysql_query("SELECT YEAR( att_date ) AS y, MONTH( att_date ) AS m, COUNT( DISTINCT att_date ),'ABSENT','PRESENT','TOTAL'
		FROM essort_class_attendence
		WHERE stu_id = '".$staff."' AND att_session='".$session."' GROUP BY y, m");
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
			require_once('../../classes/general_class.php');
			$obj = new General();
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
		return $rowtble;
	}
	########################################################################################################
	function findclassandsection($staffid)
    {
		$sql=mysql_fetch_array(mysql_query("SELECT (SELECT class_name FROM essort_classes WHERE class_id=t.class_id) as class_id,(SELECT section_name FROM essort_section WHERE section_id=t.section_id) as section_id FROM essort_teacher_class as t WHERE staff_id='".$staffid."' AND is_classteacher='1'"));
		return $sql;
	
	}
	########################################################################################################
	function StaffApproval()
    {
		$staffid=$_REQUEST['id'];
		$sql=mysql_query("UPDATE essort_user_header SET usr_status='1' WHERE usr_id='".$staffid."'");
		if($sql==true)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	
	}
	########################################################################################################
	function presentinsession($staff,$session)
    {
		$sqlclasssectionstu=mysql_num_rows(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".$staff."' AND att_session='".$session."'"));
		return $sqlclasssectionstu;
	
	}
	########################################################################################################
	
  
}

?>