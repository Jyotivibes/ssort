 <?php
 define("DEFAULT_STAFF","00000016");
 define("DEFAULT_STU","00029");
 $eventNotification = $obj->getEventsNotification();
 $eventlistNotification = $obj->getEventsNotification();
 $holidayNotification = $obj->getHolidayNotification();
  $circularNotice = $obj->getCircularActivities();
  $rowatt = $obj->ALLSTAFFWITHSALARY();
  $saldata = $obj->LAST5MONTHSALARY();
  $salmonthlydata = $obj->MONTHLYSALARY();
    /*****************FOR CHAIRMAN IMAGE ON DASHBOARD AND PROFILE**********************/
            $sqlchairman = mysql_query("SELECT * FROM essort_user_header uh
                 INNER JOIN
                    essort_user_details ud
                 ON
                    uh.usr_id = ud.usr_id
                 WHERE
                    uh.usr_role = 'Chairman'
            ");
            $rows = mysql_fetch_array($sqlchairman);
	/***********************************************************************************************/
  $optionstaff='';
	$sqlstaff=mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher')");
	$staffarray=array();
	$sstaffattarray=array();
	$num_of_staffs=mysql_num_rows($sqlstaff);
	while($rowstff=mysql_fetch_array($sqlstaff))
	{
		
		$staffarray[]=$rowstff;
		if($rowstff['att_ref_id']!='')
		{
			$sstaffattarray[]=$rowstff['att_ref_id'];
		}
		$optionstaff.='<option value="'.$rowstff['emp_id'].'">'.$rowstff['usr_fname'].'</option>';
	}
	print_r($sstaffattarray);
	$id=implode(",",$sstaffattarray);
	$sqlpreseent=mysql_num_rows(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id IN (".$id.")"));
	$absent=$num_of_staffs-$sqlpreseent;

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
     $type = 3;
 }
 $sqlmsgs = $obj->VIEWALLMESSAGE($_SESSION['USER']['USER_ID'], 'Chairman', $page, $type);
 $countarr = count($sqlmsgs);
 //print_r($sqlmsgs);

		//$sqlmsgs = $obj->VIEWALLMESSAGE($_SESSION['USER']['USER_ID'],'Chairman');
		//print_r($sqlmsgs);
		$sqlteacher=mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher')");
		$optionstaff='';
		while($row=mysql_fetch_array($sqlteacher))
		{
			$optionstaff.='<option value='.$row['usr_id'].'>'.$row['usr_fname'].'</option>';
			$optionattstaff.='<option value='.$row['att_ref_id'].'>'.$row['usr_fname'].'</option>';
		}
		//HOLIDYAS
 $sqlholiday=mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM  essort_holidays WHERE occassion_type='Event' AND DATE_FORMAT( `off_day` , '%Y-%m-%d' ) >= '" . $currdate . "' AND status= 1 GROUP BY occassion LIMIT 5");
 $holarray=array();
 while($rowhol=mysql_fetch_array($sqlholiday))
 {
     $holarray[]=$rowhol;
 }
 
 //ALL STAFF WITH ATTENDENCE
		$sqlnote=mysql_query("SELECT *,'att_in_time','attout_time','usr_salary','dept_name','salary_status' FROM  essort_user_header WHERE usr_role IN ('Teacher')");
		$rowatt=array();
		while($rownote=mysql_fetch_array($sqlnote))
		{
			//salary
			$sqlsal=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_details WHERE usr_id='".$rownote['usr_id']."'"));
			$sqlhd=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='".$rownote['usr_id']."'"));
			$sql=mysql_query("SELECT att_in_time,attout_time FROM essort_class_attendence WHERE stu_id='".$rownote['att_ref_id']."' AND att_date='".date('Y-m-d')."'" );
			$rowusr=mysql_fetch_array($sql);
			//SELECT SALARY
			$sqlsald=mysql_fetch_array(mysql_query("SELECT salary_amount,salary_status FROM essort_staff_salary WHERE emp_id='".$sqlhd['emp_id']."'"));
			$rownote['att_in_time']=$rowusr['att_in_time'];
			$rownote['usr_salary']=$sqlsald['salary_amount'];
			$rownote['salary_status']=$sqlsald['salary_status'];
			$rownote['dept_name']=$sqlsal['dept_name'];
			$rownote['attout_time']=$rowusr['attout_time'];
			$rowatt[]=$rownote;
		
		}
		//DEFAULT STAFF ATTENDENCE
		$sql=mysql_query("SELECT YEAR( att_date ) AS y, MONTH( att_date ) AS m, COUNT( DISTINCT att_date ),'ABSENT','PRESENT','TOTAL'
			FROM essort_class_attendence
			WHERE stu_id = '".DEFAULT_STAFF."' GROUP BY y, m");
			$no_of_ros=mysql_num_rows($sql);
			if($no_of_ros==0)
			{
				$arraydata.='<tr>
																			<td></td>
																			<td>No Data Found</td>
																			<td></td>
																			<td></td>
								</tr>';
								echo $arraydata;exit;	
			}
			while($rowleavetble=mysql_fetch_array($sql))
				{
					$sqlt=mysql_query("SELECT attendence_id FROM essort_class_attendence 
					WHERE MONTH(att_date) = '".$rowleavetble['m']."' AND stu_id = '".DEFAULT_STAFF."'"); //AND YEAR(happened_at) = 2009
					$num_of_rows=mysql_num_rows($sqlt);
					//PRESEENT DAYS
					$sqlp=mysql_query("SELECT attendence_id FROM essort_class_attendence 
					WHERE MONTH(att_date) = '".$rowleavetble['m']."' AND stu_id = '".DEFAULT_STAFF."' AND att_status='P'");
					$pnum_of_rows=mysql_num_rows($sqlp);
					//ABSENT DAYS
					$sqla=mysql_query("SELECT attendence_id FROM essort_class_attendence 
					WHERE MONTH(att_date) = '".$rowleavetble['m']."' AND stu_id = '".DEFAULT_STAFF."'  AND att_status='A'");
					$anum_of_rows=mysql_num_rows($sqla);
					$rowleavetble['ABSENT']=$anum_of_rows;
					$rowleavetble['PRESENT']=$pnum_of_rows;
					$rowleavetble['TOTAL']=$num_of_rows;
					$rowattside[]=$rowleavetble;
					
				}
				
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
		//TOTAL SALARY
		$result = mysql_query('SELECT SUM(salary_amount) AS total_salary FROM essort_staff_salary'); 
		$row = mysql_fetch_assoc($result); 
		$sum = $row['total_salary'];
		//classes list
		$sqlclassesed=mysql_query("SELECT * FROM essort_classes");
		$class='';
		while($rowclass=mysql_fetch_array($sqlclassesed)) 
		{
			$class.='<option value="'.$rowclass['class_id'].'">'.$rowclass['class_name'].'</option>';
		}
		#################STUDENT RECORD##########################################
		$stusql=mysql_query("SELECT *, att_ref_id,'USERFNAME','USERLNAME','att_status','att_intime','att_outtime' ,'app_no','att_id' FROM essort_user_relation"); 
		$total_no_of_students= mysql_num_rows($stusql);
		$stuidarr=array();
		$stuatt=array();
		while($rowstu=mysql_fetch_array($stusql))
		{
			
			$stuusql=mysql_fetch_array(mysql_query("SELECT * FROM essort_application_header WHERE usr_application_id=(SELECT stu_id FROM essort_user_relation WHERE att_ref_id='".$rowstu['att_ref_id']."' LIMIT 1) LIMIT 1"));
			$sqlatt=mysql_fetch_array(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".$rowstu['att_ref_id']."' AND att_date='".date('Y-m-d')."'"));
			$rowstu['USERFNAME']=$stuusql['usr_fname'];
			$rowstu['USERLNAME']=$stuusql['usr_lname'];
			$rowstu['att_status']=$sqlatt['att_status'];
			$rowstu['att_intime']=$sqlatt['att_in_time'];
			$rowstu['att_id']=$sqlatt['attendence_id'];
			$rowstu['att_outtime']=$sqlatt['attout_time'];
			$rowstu['app_no']=$stuusql['usr_application_no'];
			$stuoption.='<option>'.$rowstu['USERFNAME'].'</option>';
			$stuidarr[]=$rowstu;
		}
		//NUMBER OF STUDENTS
			$uidconcat='';
			foreach($stuidarr as $stupvlue)
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
			$anum_of_students=$total_no_of_students-$pnum_of_students;
			
		//RIGhT SIDE ATTENDENCE
		$rowstutble = $obj->getAttendnce(DEFAULT_STU);
		//DASHBOARD>PHP (FEE GRAPH RECORD)
		while($rowstff=mysql_fetch_array($stusql))
        {

            $staffarray[]=$rowstff;
            if($rowstff['stu_id']!='')
            {
                $sstaffattarray[]=$rowstff['stu_id'];
            }

        }

        $id=implode(",",$sstaffattarray);
        //echo $id;
        $feerecieved=mysql_num_rows(mysql_query("SELECT * FROM essort_fee_transaction
        WHERE user_id IN (".$id.")"));
        $feepending=$num_of_staffs-$feerecieved;
		//QUARTER 1 FEE
		$firstsql="SELECT *,SUM(payment_amount_by_user) as amount FROM essort_fee_transaction WHERE fee_quarter='first'";
		$firstresult=mysql_fetch_array(mysql_query($firstsql));
		$firstcount=mysql_num_rows(mysql_query($firstsql));
		$secsql="SELECT *,SUM(payment_amount_by_user) as amount FROM essort_fee_transaction WHERE fee_quarter='second'";
		$secresult=mysql_fetch_array(mysql_query($secsql));
		$seccount=mysql_num_rows(mysql_query($secsql));
		$thirdsql="SELECT *,SUM(payment_amount_by_user) as amount FROM essort_fee_transaction WHERE fee_quarter='third'";
		$thirdresult=mysql_fetch_array(mysql_query($thirdsql));
		$thirdcount=mysql_num_rows(mysql_query($thirdsql));
		$fourthsql="SELECT *,SUM(payment_amount_by_user) as amount FROM essort_fee_transaction WHERE fee_quarter='fourth'";
		$fourthresult=mysql_fetch_array(mysql_query($fourthsql));
		$fourthcount=mysql_num_rows(mysql_query($fourthsql));
		$totalfee=0;
		$totalfee=$firstresult['amount']+$secresult['amount']+$thirdresult['amount']+$fourthresult['amount'];
		 ?>