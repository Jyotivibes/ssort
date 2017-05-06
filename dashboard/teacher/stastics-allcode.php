<?php
define("DEFAULT_STU","18640");
define("DEFAULT_SESSION","2017-2018");
define("SESSION_START_DATE","2017-04-01");
//SELECT CLASS AND SECTION
$sql=mysql_query("SELECT *,(SELECT class_name FROM essort_classes as c WHERE c.class_id=main.class_id LIMIT 1) as class,(SELECT section_name FROM essort_section WHERE class_id=main.class_id AND section_id=main.section_id LIMIT 1) as section FROM essort_teacher_class as main WHERE is_classteacher='1' AND staff_id='".$_SESSION['USER']['USER_ID']."'");
//echo "SELECT *,(SELECT class_name FROM essort_classes as c WHERE c.class_id=main.class_id LIMIT 1) as class,(SELECT section_name FROM essort_section WHERE class_id=main.class_id AND section_id=main.section_id LIMIT 1) as section FROM essort_teacher_class as main WHERE is_classteacher='1' AND staff_id='".$_SESSION['USER']['USER_ID']."'";
		$taecherdata=mysql_fetch_array($sql);
		//SELECT PRINCIPAL
		$resprincipal=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_role='Principal'"));
		//SELECT DATA OF TEACHER
		$sqlteachheader=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='".$_SESSION['USER']['USER_ID']."'"));
		$sqlteachdetail=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_details WHERE usr_id='".$_SESSION['USER']['USER_ID']."'"));
		##################SELECT ALL STUDENTS OF CLASS AND SECTION######################################################################
		
		$stusql=mysql_query("SELECT *, att_ref_id,'USERFNAME','USERLNAME','IMAGE','att_status','att_intime','att_outtime' ,'app_no','IMAGE','att_id' FROM essort_user_relation WHERE class_id='".$taecherdata['class_id']."' AND sec_id='".$taecherdata['section_id']."'");
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
		
		$no_of_students=mysql_num_rows($stusql);
		#######PRESENT STUDENTS##############################
		$currdate=date("Y-m-d");
		//echo "SELECT * FROM essort_class_attendence WHERE att_status='P' AND DATE_FORMAT(att_date,'%Y-%m-%d')='".$currdate."' AND stu_id IN (".$allstuids.")";
		$pstusql=mysql_query("SELECT * FROM essort_class_attendence WHERE att_status='P' AND DATE_FORMAT(att_date,'%Y-%m-%d')='".$currdate."' AND stu_id IN (".$allstuids.")");
		$present_no_of_students=mysql_num_rows($pstusql);
		#######ABSENT STUDENTS##############################
		$absent_no_of_students=$no_of_students-$present_no_of_students;
		###############################PERCENTAGE######################################
		$aper=0;
		$pper=0;
		if($no_of_students!=0)
		{
			$pper=$present_no_of_students/$no_of_students*100;
			$aper=$absent_no_of_students/$no_of_students*100;
		}
		$smysubject = $obj->MySubject($_SESSION['USER']['USER_ID']);
		$rowstutble = $obj->getAttendnce(DEFAULT_STU);

        #################STUDENTS ON LEAVE TODAY############################################
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

        //CIRCULAR
        $sqlciract = $obj->getCircularActivities();
        $sqlnote = $obj->getCircularActivities();
        $cirarray=array();
        while($rowcir=mysql_fetch_array($sqlciract))
        {
            $cirarray[]=$rowcir;
        }
		//STUDEnts on Leave
		//$resultleave = array_intersect($stuidarr, $stuleaveidarr);
		$sqlholiday=mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM  essort_holidays WHERE occassion_type='Event' GROUP BY occassion");
		//CIRCULAR ACTIVITIES
		$sqlciract = $obj->getCircularActivities();
		$sqlnote = $obj->getCircularActivities();
		$holidayarr=array();
		$sqlleaved=mysql_query("SELECT usr_id,leave_date as maxoff,leave_date as minoff,leave_status,leave_reason FROM essort_teacher_leave_info WHERE usr_id='".$_SESSION['USER']['USER_ID']."'");
/*******************************FOR READ UNREAD*******************************/
if (isset($_REQUEST['page']) == '') {
    $page = 1;
} else {
    $page = $_REQUEST['page'];
}
if (isset($_REQUEST['type']) == '') {
    $type = 0;
} else if ($_REQUEST['type'] == 'unread') {
    $type = 2;
} else if ($_REQUEST['type'] == 'read') {
    $type = 1;
} else if ($_REQUEST['type'] == 'delete') {
    $type = 4;
} else {
    $type = 0;
}
if(isset($_REQUEST['records'])=='')
		{
			$records=20;
		}
		else
		{
			$records=$_REQUEST['records'];
		
		}

$sqlmsgmain = mysql_query("SELECT *,'messages','from_name' FROM essort_message_master WHERE to_id='" . $_SESSION['USER']['USER_ID'] . "' AND to_role='Teacher'  AND delete_status=0 GROUP BY subject ORDER BY `date` DESC");

$sqlmsgs = $obj->VIEWALLMESSAGE($_SESSION['USER']['USER_ID'],'Teacher',$page,$type,$records);
$countarr=mysql_num_rows($sqlmsgmain);
$sqlteacher=mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher') AND usr_id NOT IN ('" .$_SESSION['USER']['USER_ID'] . "')");
$optionstaff='';
while($row=mysql_fetch_array($sqlteacher))
{
    $optionstaff.='<option value='.$row['usr_id'].'>'.$row['usr_fname'].'</option>';
}
		$select_prnc = mysql_fetch_array(mysql_query("
		SELECT * FROM essort_user_header uh
		INNER JOIN essort_user_details  ud
		ON uh.usr_id = ud.usr_id
		WHERE uh.usr_role='principal'"));
		
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
		
?>