<?php
define("CURRENT_SESSION", '2017-2018');
define("SESSION_START_DATE", '2016-04-01');
############################FIND PARENT CHILDREN ############################################################
$sqlchild = mysql_query("SELECT *,'class_name','section_name' FROM essort_user_relation WHERE parent_id='" . $_SESSION['USER']['USER_ID'] . "'");
$stuarray = array();
while ($rowstu = mysql_fetch_array($sqlchild)) {
    //class name
    $sqlclass = mysql_fetch_array(mysql_query("SELECT class_name FRom essort_classes WHERE class_id='" . $rowstu['class_id'] . "'"));
    $rowstu['class_name'] = $sqlclass['class_name'];
    //Section Name
    $sqlsec = mysql_fetch_array(mysql_query("SELECT section_name FRom essort_section WHERE class_id='" . $rowstu['class_id'] . "' AND section_id='" . $rowstu['sec_id'] . "'"));
    $rowstu['class_name'] = $sqlclass['class_name'];
    $rowstu['section_name'] = $sqlsec['section_name'];
    $stuarray[] = $rowstu;
}
#############################FIND CHILDERN DATA###################################################################

foreach ($stuarray as $studata) {
    $sql = mysql_query("SELECT * FROM  essort_application_header WHERE usr_application_id='" . $studata['stu_id'] . "'");
    $stuadata = array();
    while ($rowstudetail = mysql_fetch_array($sql)) {
        $stuadata[] = $rowstudetail;
    }
}
################FIND FATHER CHILDERN DATA###################################################################
//echo "SELECT * FROM  essort_application_family_info WHERE usr_application_id='" . $stuarray[0]['stu_id'] . "' AND usr_relation='father'";
$sqlfather = mysql_fetch_array(mysql_query("SELECT * FROM  essort_application_family_info WHERE usr_application_id='" . $stuarray[0]['stu_id'] . "' AND usr_relation='father'"));
//print_r($sqlfather);
##############FIND MOTHER CHILDERN DATA###################################################################
$sqlmother = mysql_fetch_array(mysql_query("SELECT * FROM  essort_application_family_info WHERE usr_application_id='" . $stuarray[0]['stu_id'] . "' AND usr_relation='mother'"));
#############################FIND PRINCIPAL###################################################################
$sqlprincipal = mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header WHERE usr_role='principal'"));
#############################FIND CLASS TEACHER###################################################################
$sqlclassteacher = mysql_fetch_array(mysql_query("SELECT staff_id FROM  essort_teacher_class WHERE class_id='" . $stuarray[0]['class_id'] . "' AND section_id='" . $stuarray[0]['sec_id'] . "' AND is_classteacher='1'"));
$sqlclassteacherdata = mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header as a JOIN essort_user_details as b ON a.usr_id=b.usr_id WHERE a.usr_id='" . $stuarray[0]['stu_id'] . "'"));
############################SELECT ALL TEACHERS DATA OF THIS CLAS####################################
$sqlallteacher = mysql_query("SELECT staff_id,'STAFF_NAME',subject_id FROM  essort_teacher_class WHERE class_id='" . $stuarray[0]['class_id'] . "' AND section_id='" . $stuarray[0]['sec_id'] . "'");
$allteacher = array();
while ($row = mysql_fetch_array($sqlallteacher)) {
    $sqlclassteacherdata = mysql_fetch_array(mysql_query("SELECT usr_fname FROM  essort_user_header WHERE usr_id='" . $row['staff_id'] . "'"));
    $row['STAFF_NAME'] = $sqlclassteacherdata['usr_fname'];
    $sqlsubjectdata = mysql_fetch_array(mysql_query("SELECT sub_name FROM  essort_subject_master WHERE sub_id='" . $row['subject_id'] . "'"));
    $row['subject_id'] = $sqlsubjectdata['sub_name'];
    $allteacher[] = $row;
}
//print_r($allteacher);
######CLASS TEACHER DEATILS##################################################################################
$classteacherdata = mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header as a JOIN essort_user_details as b ON a.usr_id=b.usr_id WHERE a.usr_id='" . $sqlclassteacher['staff_id'] . "'"));

$select_sad = mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header WHERE usr_role='SAD'"));
$select_user = mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header WHERE usr_id='" . $_SESSION['USER']['USER_ID'] . "'"));
$select_tech = mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header WHERE usr_role='Teacher'"));
#########################################FOR PRICIPAL PROFILE ON PARENT DASHBOARD###############################################
$select_prnc = mysql_fetch_array(mysql_query("
SELECT * FROM essort_user_header uh
INNER JOIN essort_user_details  ud
ON uh.usr_id = ud.usr_id
WHERE uh.usr_role='principal'"));

/*******************************FOR READ UNREAD*******************************/
if (isset($_REQUEST['page']) == '') {
    $page = 1;
} else {
    $page = $_REQUEST['page'];
}
/*if (isset($_REQUEST['type']) == '') {
    $type = 0;
} else if ($_REQUEST['type'] == 'unread') {
    $type = 2;
} else if ($_REQUEST['type'] == 'read') {
    $type = 1;
} else if ($_REQUEST['type'] == 'delete') {
    $type = 4;
} else {
    $type = 3;
}*/
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
		
		
$sqlmsgmain = mysql_query("SELECT *,'messages','from_name' FROM essort_message_master WHERE to_id='" . $_SESSION['USER']['USER_ID'] . "' AND to_role='Parent'  AND delete_status=0 GROUP BY subject ORDER BY `date` DESC");

$sqlmsgs = $obj->VIEWALLMESSAGE($_SESSION['USER']['USER_ID'], 'Parent', $page, $type,$records);
$countarr=mysql_num_rows($sqlmsgmain);
//print_r($sqlmsgs);
$sqlteacher = mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher') AND usr_id='" . $sqlclassteacher['staff_id'] . "'");
$optionstaff = '';
while ($row = mysql_fetch_array($sqlteacher)) {
    $optionstaff .= '<option value=' . $row['usr_id'] . '>' . $row['usr_fname'] . '</option>';
}
##############SELECT ATTENDENCE###################################################################	
$sqlattendancesql = mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='" . $stuarray[0]['att_ref_id'] . "' AND att_date='" . date('Y-m-d') . "'");
$todaydate = date('Y-m-d');
$resultatt = mysql_fetch_array($sqlattendancesql);
$att_num_of_rows = mysql_num_rows($sqlattendancesql);
$in_time = '';
$out_time = '';
if ($att_num_of_rows == 0) {
    $status = "Absent";
} else {
    $status = "Present";
    $in_time = $resultatt['att_in_time'];
    $out_time = $resultatt['attout_time'];


}
#############get working days#####################
$firstdate = date('01-m-Y');
$month = date("m", strtotime($firstdate));
$sql = mysql_query("SELECT DATE_FORMAT(`off_day` , '%Y-%m-%d') as date
            FROM essort_holidays  WHERE occassion_type='Holiday' AND DATE_FORMAT(off_day,'%m')='" . $month . "'") OR DIE(mysql_error());
$holidays = array();
while ($row = mysql_fetch_array($sql)) {
    $holidays[] = $row['date'];
}
//$holidays=array("2008-12-25","2008-12-26","2009-01-01");
//CURRENT MONTH CALCULATION
if($stuarray[0]['att_ref_id'] != ''){
    $workingdays = $obj->getWorkingDays($firstdate, $todaydate, $holidays);
    $sqlattendancesql = mysql_query("SELECT * FROM essort_class_attendence  WHERE stu_id='" . $stuarray[0]['att_ref_id'] . "' AND DATE_FORMAT(att_date,'%m')='" . $month . "' AND att_session='" . CURRENT_SESSION . "'");
    $no_of_days_present = mysql_num_rows($sqlattendancesql);
    $no_of_days_absent = $workingdays - $no_of_days_present;
    $monthpercentage = ($no_of_days_present / $workingdays) * 100;
}


//CURRENT SESSION CALCULATION
$year = date("y", strtotime(SESSION_START_DATE));
$sql = mysql_query("SELECT DATE_FORMAT(`off_day` , '%Y-%m-%d') as date
            FROM essort_holidays  WHERE occassion_type='Holiday' AND DATE_FORMAT(off_day,'%y')='" . $year . "'") OR DIE(mysql_error());
$holidays = array();
while ($row = mysql_fetch_array($sql)) {
    $holidays[] = $row['date'];
}
$workingdayssession = $obj->getWorkingDays(SESSION_START_DATE, $todaydate, $holidays);
if($stuarray[0]['att_ref_id'] != ''){
//echo "SELECT * FROM essort_class_attendence  WHERE stu_id='" . $stuarray[0]['att_ref_id'] . "' AND att_session='" . CURRENT_SESSION . "'";
    $sqlattendancesqlsession = mysql_query("SELECT * FROM essort_class_attendence  WHERE stu_id='" . $stuarray[0]['att_ref_id'] . "' AND att_session='" . CURRENT_SESSION . "'");
    $no_of_days_present_session = mysql_num_rows($sqlattendancesqlsession);
    $no_of_days_absent_session = $workingdayssession - $no_of_days_present_session;
    $yearpresentpercentage = ($no_of_days_present_session / $workingdayssession) * 100;
    $yearabsentpercentage = ($no_of_days_absent_session / $workingdayssession) * 100;
}
else{
    $no_of_days_present_session = 0;
    $no_of_days_absent_session = $workingdayssession - $no_of_days_present_session;
}


#############################SELECT FEE###################################################################
#################################FOR LATEST CIRCULAR#######################################################
$sqlciract = $obj->getCircularActivities();
$cirarray = array();
while ($rowcir = mysql_fetch_array($sqlciract)) {
    $cirarray[] = $rowcir;
}

#############################SELECT FEE###################################################################	

$sql = mysql_query("SELECT *,'element_name' FROM essort_fee_structure WHERE class_id='" . $stuarray[0]['class_id'] . "' AND sec_id='" . $stuarray[0]['sec_id'] . "'");
$element = array();
while ($row = mysql_fetch_array($sql)) {
    $sqlelemname = mysql_fetch_array(mysql_query("SELECT fee_elem_name FROm essort_fee_detail WHERE fee_id='" . $row['fee_elem_id'] . "'"));
    $row['element'] = $sqlelemname['fee_elem_name'];
    $element[] = $row;
}
$no_of_element_count = count($element);
#############################SELECT FEE###################################################################	
$date = date('Y-m-d');
$month = date('F', strtotime($date));

$montharr = array("April", "May", "June");
$monthsecarr = array("July", "August", "September");
$monththirdcarr = array("October", "November", "December");
$monthfourthcarr = array("October", "November", "December");
if (in_array($month, $montharr)) {
    $type = 'first';
} elseif (in_array($month, $monthsecarr)) {
    $type = 'second';

} elseif (in_array($month, $monththirdcarr)) {
    $type = 'third';

} else {
    $type = 'fourth';

}

$sqlfeetrans = mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='" . $stuarray[0]['stu_id'] . "' AND fee_quarter='" . $type . "'");
$fee_trans_no_of_rows = mysql_num_rows($sqlfeetrans);
if ($fee_trans_no_of_rows == 0) {
    $type = $type;
} else {
    $type = 'No Due';
}
########################################################PENDING DUES###########################################################################
if ($type == 'fourth') {
    $amount = 0;
    $penality = 0;
    //PENALITY
    $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='fourth'"));
    $now = time();
    $your_date = strtotime($sqlpenality['ftime_edate']);
    $datediff = $now - $your_date;
    $count = floor($datediff / (60 * 60 * 24));
    $penality = 0;
    for ($i = 1; $i <= $count; $i++) {
        $penality = $penality + $sqlpenality['fpenality'];
    }

    $sqlpendingdues = mysql_query("SELECT * FROM essort_fee_transaction  WHERE user_id='" . $stuarray[0]['stu_id'] . "' AND fee_quarter='third'");
    $fee_pending_no_of_rows = mysql_num_rows($sqlpendingdues);
    if ($fee_pending_no_of_rows == 0) {
        $sqltype = mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='" . $stuarray[0]['class_id'] . "' AND sec_id='" . $stuarray[0]['sec_id'] . "'");
        while ($rowtype = mysql_fetch_array($sqltype)) {
            if ($rowtype['fee_elem_type'] == 'Monthly') {
                $rowtype['fee_elem_amount'] = $rowtype['fee_elem_amount'] * 3;
                $amount = $amount + $rowtype['fee_elem_amount'];
            } else {
                $amount = $amount + $rowtype['fee_elem_amount'];
            }

        }

        //PENALITY
        $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='third'"));
        $now = time();
        $your_date = strtotime($sqlpenality['ftime_edate']);
        $datediff = $now - $your_date;
        $count = floor($datediff / (60 * 60 * 24));

        for ($i = 1; $i <= $count; $i++) {
            $penality = $penality + $sqlpenality['fpenality'];
        }
        //echo "PEN". $amount;
    }
    //SECOND QUARTER
    $sqlpendingsdues = mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='" . $stuarray[0]['stu_id'] . "' AND fee_quarter='second'");
    $fee_pending_nos_of_rows = mysql_num_rows($sqlpendingsdues);
    if ($fee_pending_nos_of_rows == 0) {
        $sqltype = mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='" . $stuarray[0]['class_id'] . "' AND sec_id='" . $stuarray[0]['sec_id'] . "'");
        while ($rowtype = mysql_fetch_array($sqltype)) {
            if ($rowtype['fee_elem_type'] == 'Monthly') {
                $rowtype['fee_elem_amount'] = $rowtype['fee_elem_amount'] * 3;
                $amount = $amount + $rowtype['fee_elem_amount'];
            } else {
                $amount = $amount + $rowtype['fee_elem_amount'];
            }

        }
        //PENALITY
        $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='second'"));
        $now = time();
        $your_date = strtotime($sqlpenality['ftime_edate']);
        $datediff = $now - $your_date;
        $count = floor($datediff / (60 * 60 * 24));

        for ($i = 1; $i <= $count; $i++) {
            $penality = $penality + $sqlpenality['fpenality'];
        }
    }
    //FIRST QUARTER
    $sqlpendingfdues = mysql_query("SELECT * FROM essort_fee_transaction WHERE  user_id='" . $stuarray[0]['stu_id'] . "' AND fee_quarter='first'");
    $fee_pending_nof_of_rows = mysql_num_rows($sqlpendingfdues);
    if ($fee_pending_nof_of_rows == 0) {
        $sqltype = mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='" . $stuarray[0]['class_id'] . "' AND sec_id='" . $stuarray[0]['sec_id'] . "'");
        while ($rowtype = mysql_fetch_array($sqltype)) {
            if ($rowtype['fee_elem_type'] == 'Monthly') {
                $rowtype['fee_elem_amount'] = $rowtype['fee_elem_amount'] * 3;
                $amount = $amount + $rowtype['fee_elem_amount'];
            } else {
                $amount = $amount + $rowtype['fee_elem_amount'];
            }

        }
        //PENALITY
        $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='first'"));
        $now = time();
        $your_date = strtotime($sqlpenality['ftime_edate']);
        $datediff = $now - $your_date;
        $count = floor($datediff / (60 * 60 * 24));

        for ($i = 1; $i <= $count; $i++) {
            $penality = $penality + $sqlpenality['fpenality'];
        }
    }
} elseif ($type == 'third') {
    $amount = 0;
    $penality = 0;
    //SECOND QUARTER
    $sqlpendingsdues = mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='" . $stuarray[0]['stu_id'] . "' AND fee_quarter='second'");
    $fee_pending_nos_of_rows = mysql_num_rows($sqlpendingsdues);
    if ($fee_pending_nos_of_rows == 0) {
        $sqltype = mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='" . $stuarray[0]['class_id'] . "' AND sec_id='" . $stuarray[0]['sec_id'] . "'");
        while ($rowtype = mysql_fetch_array($sqltype)) {
            if ($rowtype['fee_elem_type'] == 'Monthly') {
                $rowtype['fee_elem_amount'] = $rowtype['fee_elem_amount'] * 3;
                $amount = $amount + $rowtype['fee_elem_amount'];
            } else {
                $amount = $amount + $rowtype['fee_elem_amount'];
            }

        }
        $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='second'"));
        $now = time();
        $your_date = strtotime($sqlpenality['ftime_edate']);
        $datediff = $now - $your_date;
        $count = floor($datediff / (60 * 60 * 24));

        for ($i = 1; $i <= $count; $i++) {
            $penality = $penality + $sqlpenality['fpenality'];
        }
    }
    //FIRST QUARTER
    $sqlpendingfdues = mysql_query("SELECT * FROM essort_fee_transaction WHERE  user_id='" . $stuarray[0]['stu_id'] . "' AND fee_quarter='first'");
    $fee_pending_nof_of_rows = mysql_num_rows($sqlpendingfdues);
    if ($fee_pending_nof_of_rows == 0) {
        $sqltype = mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='" . $stuarray[0]['class_id'] . "' AND sec_id='" . $stuarray[0]['sec_id'] . "'");
        while ($rowtype = mysql_fetch_array($sqltype)) {
            if ($rowtype['fee_elem_type'] == 'Monthly') {
                $rowtype['fee_elem_amount'] = $rowtype['fee_elem_amount'] * 3;
                $amount = $amount + $rowtype['fee_elem_amount'];
            } else {
                $amount = $amount + $rowtype['fee_elem_amount'];
            }

        }
        $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='first'"));
        $now = time();
        $your_date = strtotime($sqlpenality['ftime_edate']);
        $datediff = $now - $your_date;
        $count = floor($datediff / (60 * 60 * 24));

        for ($i = 1; $i <= $count; $i++) {
            $penality = $penality + $sqlpenality['fpenality'];
        }
    }
} elseif ($type == 'second') {
    $amount = 0;
    //FIRST QUARTER
    $sqlpendingfdues = mysql_query("SELECT * FROM essort_fee_transaction WHERE  user_id='" . $stuarray[0]['stu_id'] . "' AND fee_quarter='first'");
    $fee_pending_nof_of_rows = mysql_num_rows($sqlpendingfdues);
    if ($fee_pending_nof_of_rows == 0) {
        $sqltype = mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='" . $stuarray[0]['class_id'] . "' AND sec_id='" . $stuarray[0]['sec_id'] . "'");
        while ($rowtype = mysql_fetch_array($sqltype)) {
            if ($rowtype['fee_elem_type'] == 'Monthly') {
                $rowtype['fee_elem_amount'] = $rowtype['fee_elem_amount'] * 3;
                $amount = $amount + $rowtype['fee_elem_amount'];
            } else {
                $amount = $amount + $rowtype['fee_elem_amount'];
            }

        }
        $sqlpenality = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='first'"));
        $now = time();
        $your_date = strtotime($sqlpenality['ftime_edate']);
        $datediff = $now - $your_date;
        $count = floor($datediff / (60 * 60 * 24));

        for ($i = 1; $i <= $count; $i++) {
            $penality = $penality + $sqlpenality['fpenality'];
        }
    }
}
$fquarter = $obj->VIEWFEETIMELINE('first');
$squarter = $obj->VIEWFEETIMELINE('second');
$tquarter = $obj->VIEWFEETIMELINE('third');
$frthquarter = $obj->VIEWFEETIMELINE('fourth');

#######################MONTHWISE ATTENDENCE#############################################
if($stuarray[0]['att_ref_id'] != ''){
    $sqlatttble = mysql_query("SELECT YEAR( att_date ) AS y, MONTH( att_date ) AS m, COUNT( DISTINCT att_date ),'ABSENT','PRESENT','TOTAL'
		FROM essort_class_attendence
		WHERE stu_id = '" . $stuarray[0]['att_ref_id'] . "' GROUP BY y, m");

    $rowtble = array();
    /*for($i=1;$i<=12;$i++)
    {
        $dateObj   = DateTime::createFromFormat('!m', $i);
        $monthName = $dateObj->format('F');
        $rowtble[$monthName]['PRESENT']=0;
        $rowtble[$monthName]['ABSENT']=0;

    }*/
    while ($rowleavetble = mysql_fetch_array($sqlatttble)) {
        $sql = mysql_query("SELECT attendence_id FROM essort_class_attendence
			WHERE MONTH(att_date) = '" . $rowleavetble['m'] . "' AND stu_id = '" . $stuarray[0]['att_ref_id'] . "'"); //AND YEAR(happened_at) = 2009
        $num_of_rows = mysql_num_rows($sql);
        //PRESEENT DAYS
        $sqlp = mysql_query("SELECT attendence_id FROM essort_class_attendence
			WHERE MONTH(att_date) = '" . $rowleavetble['m'] . "' AND stu_id = '" . $stuarray[0]['att_ref_id'] . "' AND att_status='P'");
        $pnum_of_rows = mysql_num_rows($sqlp);
        //ABSENT DAYS
        $sqla = mysql_query("SELECT attendence_id FROM essort_class_attendence
			WHERE MONTH(att_date) = '" . $rowleavetble['m'] . "' AND stu_id = '" . $stuarray[0]['att_ref_id'] . "'  AND att_status='A'");
        $anum_of_rows = mysql_num_rows($sqla);

        $rowleavetble['PRESENT'] = $pnum_of_rows;
        $rowleavetble['TOTAL'] = $num_of_rows;
        $rowleavetble['ABSENT'] = $num_of_rows - $pnum_of_rows;
        $monthNum = $rowleavetble['m'];
        $dateObj = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F'); // March
        $rowtble[$monthName] = $rowleavetble;

    }
}
#####################################FEE HISTORy###############################################
$classname=$obj->getClass($stuarray[0]['class_id']);
$sectionname=$obj->getSection($stuarray[0]['class_id'],$stuarray[0]['sec_id']);
$sqlfee=mysql_query("SELECT * FROM  essort_fee_transaction WHERE user_id='".$stuarray[0]['stu_id']."'");
$feetransarr=array();
while($rowfee=mysql_fetch_array($sqlfee))
{
    $feetransarr[]=$rowfee;

}
//print_r($rowtble);
#######################MONTHWISE ATTENDENCE#############################################
?>