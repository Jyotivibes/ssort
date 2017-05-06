<?php
	
	//############# LOGIN ##################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='userlogin') ){
		require_once(''.$_REQUEST['user_dbname'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
	
		if(  ($_REQUEST['user_email']=='') && ($_REQUEST['user_password']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			 $user_email =$_REQUEST['user_email'] ;
			$user_password = md5($_REQUEST['user_password']);
			//$user_type=$_REQUEST['user_type'] ;
			$userData=array();
			$sql = "SELECT * from essort_user_header where usr_email='".$user_email."' and password='".$user_password."'";			
			$res=mysql_query($sql) or die(mysql_error());
			//echo mysql_num_rows($res);
			$res2=mysql_num_rows($res);
            if($res2 == 0){
                echo 9; exit; // login email and password worng
            }
			$result = mysql_fetch_array($res); 
			if($result['usr_status']==0 || $result['usr_status']=='0'){
				echo 3; exit;
			}
			
			$userData['USER_ID'] = $result['usr_id'];
			$userData['USER_NAME'] = $result['usr_fname'];
			$userData['USER_LNAME'] = $result['usr_lname'];
			//$userData['USER_MO'] = $result['usr_lname'];
			$userData['EMAIL'] = $result['usr_email'];
			$userData['ROLE_ID'] = $result['usr_role'];
			$userData['DB_NAME'] = $_REQUEST['user_dbname'];
			
			$_SESSION['USER'] = $userData;
			echo 5;exit;			
		}
	}
	//############# LOGIN ##################################
	
	//############# LOGIN ##################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='contactus') ){
		require_once('classes/connection.php');
		require_once('classes/general_class.php');
		require_once('classes/email.class.php');
		require_once('classes/config.php');
		$obj = new General();
	    if(($_REQUEST['user_email']=='') && ($_REQUEST['user_name']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			$user_email =$_REQUEST['user_email'] ;
			$user_name = $_REQUEST['user_name'];
			$user_subject = $_REQUEST['user_subject'];
			$user_message = $_REQUEST['user_message'];
			//$user_type=$_REQUEST['user_type'] ;
			$userData=array();
			$sql = "INSERT INTO essort_contact_info Set name='".$user_name."',email='".$user_email."',subject='".$user_subject."',message='".$user_message."'";			
			$res=mysql_query($sql) or die(mysql_error());
			//echo mysql_num_rows($res);
			if($res){
					$emailObj = new Emailclass();
					$emailObj->mailaccount='vibescom';
					$emailObj->to=ADMINEMAIL;	
					$emailObj->toname=ADMINNAME;						
					$emailObj->from=$user_email;
					$emailObj->fromname=$user_name;
					$emailObj->subject=$user_subject;
					$emailObj->body.=$user_message;
					//print_r($emailObj);
					$email_response = $emailObj->sendemail();
                echo 5; exit; // Success
            }
			else
			{
				echo 0;exit;	
			}			
		}
	}
	//############# LOGIN ##################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='autocomplete') ){
		require_once('classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
	    if(($_REQUEST['keyword']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			$keyword=$_REQUEST['keyword'];
			$sql = "SELECT sch_reg_no,sch_name FROM essort_school_info WHERE sch_name LIKE '".$keyword."%' ORDER BY sch_id ASC LIMIT 0, 10";
			$res=mysql_query($sql) or die(mysql_error());
			$list=array();
			while($data=mysql_fetch_array($res))
			{
				$list[]=$data;
			}
			if(count($list)==0)
			{
			  $list=array("sch_name"=>'No Data Found');
			}
				foreach ($list as $rs) {
					// put in bold the written text
					$country_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['sch_name']);
					// add new option
					echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['sch_name']).'\')">'.$country_name.'</li>';
				}
			
			//echo $a;exit;		
		}
	}
	//################################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='addfeeelement') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
	   if(($_REQUEST['action']=='' && $_REQUEST['session'])){
				echo 1;exit;// required Parametre missing
		}else{
			//$feetype=$_REQUEST['test']."/".$_REQUEST['chk'];
			$sql="INSERT INTO essort_fee_detail SET fee_elem_name='".$_REQUEST['element']."'";
			$res=mysql_query($sql);
			echo 5;exit;	
		}
	}
	//################################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='addfeestructure') ){
		require_once(''.$_REQUEST['db'].'/classes/connection.php');
		
		require_once('classes/general_class.php');
		$obj = new General();
	   if(($_REQUEST['myArray']=='' && $_REQUEST['db'])){
				echo 1;exit;// required Parametre missing
		}else{
			$data=$_REQUEST['myArray'];
			echo $count=count($data);
			for ($i=0;$i<$count;$i++)
			{
				$sql="INSERT INTO essort_fee_structure SET structure_name='".$_REQUEST['sname']."',structure_element='".$data[$i]."'";
				$res=mysql_query($sql);
			}
			echo 5;exit;	
		}
	}
	//#############################################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='getsection') ){
		require_once(''.$_REQUEST['db'].'/classes/connection.php');
		
		require_once('classes/general_class.php');
		$obj = new General();
	   if(($_REQUEST['db']=='' && $_REQUEST['db'])){
				echo 1;exit;// required Parametre missing
		}else{
			$q=$_REQUEST['q'];
			$sql=mysql_query("SELECT * FROM essort_section WHERE class_id='".$q."'");
			while($row=mysql_fetch_array($sql))
			{
				$tag.='<option value='.$row['section_id'].'>'.$row['section_name'].'</option>';
                                                       
			}
			echo $tag;exit;	
		}
	}
	//#############################################################################################################
	
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='getsectioncheckbox') ){
		require_once(''.$_REQUEST['db'].'/classes/connection.php');
		
		require_once('classes/general_class.php');
		$obj = new General();
	   if(($_REQUEST['db']=='' && $_REQUEST['db'])){
				echo 1;exit;// required Parametre missing
		}else{
			$q=$_REQUEST['q'];
			$sql=mysql_query("SELECT * FROM essort_section WHERE class_id='".$q."'");
			while($row=mysql_fetch_array($sql))
			{
				$tag.='<label><input type="checkbox"  name="sectionc[]" value='.$row['section_id'].' /> '.$row['section_name'].'</label> ';
                                                       
			}
			echo $tag;exit;	
		}
	}
	//#############################################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchstaff') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		
		require_once('classes/general_class.php');
		$obj = new General();
	   if(($_REQUEST['session']=='')){
				echo 1;exit;// required Parametre missing
		}else{
			$element=$_REQUEST['element'];
			$date=date("Y-m-d", strtotime($date));
			if($_REQUEST['date']=='')
			{
				$date=date('Y-m-d');
			}
			$sql=mysql_query("SELECT *  FROM  essort_user_header WHERE usr_role IN ('Teacher') AND usr_fname like '".$element."%'");
			if($element=='')
			{
				$sql=mysql_query("SELECT *  FROM  essort_user_header WHERE usr_role IN ('Teacher')");
			}
			$arraydata=array();
			if(mysql_num_rows($sql)==0)
			{
				echo 'No data Found';
				exit;
			
			}
			else
			{
				while($row=mysql_fetch_array($sql))
				{
					$sql=mysql_query("SELECT att_in_time,attout_time FROM essort_class_attendence WHERE stu_id='".$row['usr_id']."' AND stu_role IN ('Teacher') AND att_date='".$date."'" );
					$rowusr=mysql_fetch_array($sql);
					$arraydata.='<tr>
																					<tr>
																						<td class="text-center">1</td>
																						<td>'.$row['usr_fname'].'</td>
																						 <td><a href="../principal/profile.php"><img src="../images/father-pic.jpg"></a>                                                                                             </td>
																					 
																						<td>'.$row['usr_role'].'</td>
																						<td>'.$rowusr['att_in_time'].'</td>
																						<td>'.$rowusr['attout_time'].'</td>
																						<td class="text-center">
																							<a href="#" data-toggle="modal" data-target="#myModal">
																								<i class="fa fa-pencil-square font-icon-size" aria-hidden="true"></i>
																							</a>
																						</td>
																					</tr>';
				}
				echo $arraydata;exit;	
			}
		}
	}
	//#############################################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchstuatt') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		
		require_once('classes/general_class.php');
		$obj = new General();
	   if(($_REQUEST['session']=='')){
				echo 1;exit;// required Parametre missing
		}else
		{
			$element=$_REQUEST['element'];
			$date=date("Y-m-d", strtotime($date));
			if($_REQUEST['date']=='')
			{
				$date=date('Y-m-d');
			}
			$sqlr=mysql_query("SELECT * FROM essort_user_relation");
			$arrdata=array();
			while($rowr=mysql_fetch_array($sqlr))
			{
				$arrdata[]=$rowr['stu_id'];
			}
			foreach($arrdata as $value)
			{
				$string.=$value.",";
			}
			$trimdata=rtrim($string,',');
			if($element!='')
			{
				$sql=mysql_query("SELECT *  FROM  essort_application_header WHERE  usr_application_id IN ('".$trimdata."') AND usr_fname like '".$element."%'");
			}
			else
			{
				$sql=mysql_query("SELECT *  FROM  essort_application_header WHERE  usr_application_id IN ('".$trimdata."')");
			}
			
			if(mysql_num_rows($sql)==0)
			{
				echo 'No data Found';
				exit;
			
			}
			else
			{
				$arraydata=array();
			while($rowatt=mysql_fetch_array($sql))
			{
				$sql=mysql_query("SELECT att_in_time,attout_time FROM essort_class_attendence WHERE stu_id='(SELECT att_ref_id FROM essort_user_relation WHERE stu_id='".$row['usr_id']."' LIMIT 1) AND att_date='".$date."'" );
				$rowusr=mysql_fetch_array($sql);
				$arraydata.='<tr>
																					<tr>
																						<td class="text-center">1</td>
																						<td>'.$rowatt['usr_fname'].'</td>
																						 <td><a href="../principal/profile.php"><img src="../images/father-pic.jpg"></a>                                                                                             </td>
																					 
																						<td>'.$rowatt['usr_role'].'</td>
																						<td>'.$rowusr['att_in_time'].'</td>
																						<td>'.$rowusr['attout_time'].'</td>
																						<td class="text-center">
																							<a href="#" data-toggle="modal" data-target="#myModal">
																								<i class="fa fa-pencil-square font-icon-size" aria-hidden="true"></i>
																							</a>
																						</td>
																					</tr>';
			}
			echo $arraydata;
			exit;
			
			
			}
			
		}
	}
	//#############################################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchstaffatt') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		
		require_once('classes/general_class.php');
		$obj = new General();
	   if(($_REQUEST['session']=='')){
				echo 1;exit;// required Parametre missing
		}else{
			$element=$_REQUEST['element'];
			$date=date("Y-m-d", strtotime($date));
			
			$arraydata='';
			$sql=mysql_query("SELECT YEAR( att_date ) AS y, MONTH( att_date ) AS m, COUNT( DISTINCT att_date ),'ABSENT','PRESENT','TOTAL'
			FROM essort_class_attendence
			WHERE stu_id = '".$element."' GROUP BY y, m");
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
					WHERE MONTH(att_date) = '".$rowleavetble['m']."' AND stu_id = '".$element."'"); //AND YEAR(happened_at) = 2009
					$num_of_rows=mysql_num_rows($sqlt);
					//PRESEENT DAYS
					$sqlp=mysql_query("SELECT attendence_id FROM essort_class_attendence 
					WHERE MONTH(att_date) = '".$rowleavetble['m']."' AND stu_id = '".$element."' AND att_status='P'");
					$pnum_of_rows=mysql_num_rows($sqlp);
					//ABSENT DAYS
					$sqla=mysql_query("SELECT attendence_id FROM essort_class_attendence 
					WHERE MONTH(att_date) = '".$rowleavetble['m']."' AND stu_id = '".$element."'  AND att_status='A'");
					$anum_of_rows=mysql_num_rows($sqla);
					$rowleavetble['ABSENT']=$anum_of_rows;
					$rowleavetble['PRESENT']=$pnum_of_rows;
					$rowleavetble['TOTAL']=$num_of_rows;
					$rowatt[]=$rowleavetble;
					
				}
				foreach($rowatt as $rowtblvlue)
				{
					$monthNum  = $rowtblvlue['m'];
					$dateObj   = DateTime::createFromFormat('!m', $monthNum);
					$monthName = $dateObj->format('F'); // March
					$arraydata.='<tr>
																			<td>'.$monthName.'</td>
																			<td>'.$rowtblvlue['TOTAL'].'</td>
																			<td>'.$rowtblvlue['PRESENT'].'</td>
																			<td>'.$rowtblvlue['ABSENT'].'</td>
								</tr>';
				}
				echo $arraydata;exit;	
			
		}
	}
	
	
	//#############################################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='approvestatus') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		
		require_once('classes/general_class.php');
		$obj = new General();
	   if(($_REQUEST['session']=='')){
				echo 1;exit;// required Parametre missing
		}else{
			$element=$_REQUEST['element'];
			$cls_id=$_REQUEST['cls'];
			$sec_id=$_REQUEST['sec'];
			$Id=$_REQUEST['id'];
			$password=md5(rand());
			$date=date("Y-m-d", strtotime($date));
			$sqldata=mysql_fetch_array(mysql_query("SELECT * FROM essort_application_family_info WHERE usr_application_id='".$element."' LIMIT 1"));	
			//SELECT Parent DETAILS
			$sqlh = "insert into  essort_user_header set usr_fname='".$sqldata['usr_r_name']."',usr_mname='K',usr_lname='".$sqldata['usr_r_lname']."',usr_role='Parent',usr_email='".$sqldata['usr_r_email']."',password='".$password."',usr_status='1',usr_mobile='".$sqldata['usr_r_contact_no']."'"; 
			$resp = mysql_query($sqlh);
			$staff_id = mysql_insert_id();
			//DETAIL 
			if ($resp==true)
			{
				$sqldetail = "insert into  essort_user_details set usr_id='".$staff_id."',dept_name='".$sqldata['usr_r_role']."',usr_salary='".$sqldata['	usr_r_monthly_income']."'"; 
				$respdetail = mysql_query($sqldetail);
			}
				
			$sql=mysql_query("INSERT INTO essort_user_relation SET class_id='".$cls_id."',sec_id='".$sec_id."',stu_id='".$element."',parent_id='".$staff_id."'");	
			//INSERT PARENT DATA
			if($sql==true)
			{
				echo 5;exit;	
			}
			
		}
	}
	
	
	//#############################################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchsalarydata') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		
		require_once('classes/general_class.php');
		$obj = new General();
	   if(($_REQUEST['session']=='')){
				echo 1;exit;// required Parametre missing
		}else{
			$salyear=$_REQUEST['salyear'];
			$salmonth=$_REQUEST['salmonth'];
			$salarydata=$_REQUEST['elementsearch']; 
			$date=date("Y-m-d", strtotime($date));
			$cond='';
			if($salyear!='')
			{
				$cond.="WHERE salary_year='".$salyear."'";
			}
			if($salmonth!='')
			{	 
				if($cond=='')
				{
					$cond.="WHERE salary_month='".$salmonth."'";
				}
				else
				{
					$cond.="AND salary_month='".$salmonth."'";
				}
			}
			if($salarydata!='')
			{
				$sqlsal=mysql_query("SELECT usr_id FROM essort_user_header WHERE usr_fname like '".$salarydata."%'");
				$dataarr='';
				while($resultsal=mysql_fetch_array($sqlsal))
				{
					$dataarr.=$resultsal['usr_id'].",";
				}
				$uidconcat=rtrim($dataarr,',');
				if($cond=='')
				{
					$cond.="WHERE emp_id IN ('".$uidconcat."')";
				}
				else
				{
					$cond.="AND emp_id IN ('".$uidconcat."')";
				}
			}
			$stfrslt=mysql_query("SELECT *,'usr_fname','dept_name','salary_status' FROM essort_staff_salary ".$cond."");
			$stfarray=array();
			while($rowrslt=mysql_fetch_array($stfrslt))
			{
				$sqlusrhde=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header as a JOIN  essort_user_details as b WHERE a.usr_id=b.usr_id AND a.usr_id='".$rowrslt['emp_id']."'"));
				$rowrslt['usr_fname']=$sqlusrhde['usr_fname'];
				$rowrslt['dept_name']='Teaching';
				$rowrslt['salary_status']='APPROVED';
				$stfarray[]=$rowrslt;
			}
			$tbldata='';
			foreach($stfarray as $stfvlue)
			{
				$tbldata='<tr>
					<td class="text-center">1</td>
					<td>'.$stfvlue['usr_fname'].'</td>
					<td><a href="#"><img src="../../"'.$session.'"/uploads/"'.$stfvlue['usr_pic'].'""></a>
					</td>
					<td>101162</td>
					<td>'.$stfvlue['dept_name'].'</td>
					<td>'.$stfvlue['salary_amount'].'</td>
					<td>'.$stfvlue['salary_status'].'</td>
					</tr>';
			
			
			}
			echo $tbldata;
			exit;
			//$sqldata=mysql_query("SELECT * FROM essort_staff_salary'" $cond);	
			//INSERT PARENT DATA
			
			
		}
	}
	
	//#############################################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchstaffsidemenue') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		
		require_once('classes/general_class.php');
		$obj = new General();
	   if(($_REQUEST['session']=='')){
				echo 1;exit;// required Parametre missing
		}else{
			$staffname=$_REQUEST['staffname'];
			$staffyear=$_REQUEST['staffyear'];
			$sql=mysql_query("SELECT * FROM essort_staff_salary GROUP BY salary_month");	
			$salarray=array();
			$arraydata='';
			$cond='';
			while($row=mysql_fetch_array($sql))
			{
				if($staffname!='')
				{
					$cond="WHERE emp_id='".$staffname."'";
				}
				if($staffyear!='')
				{
					if($cond=='')
					{
						$cond.="WHERE salary_year='".$staffyear."'";
					}
					else
					{
						$cond.="AND salary_year='".$staffyear."'";
					}
				}
				//echo "SELECT salary_amount FROM essort_staff_salary ".$cond."";
				$sqlmonth=mysql_fetch_array(mysql_query("SELECT salary_amount FROM essort_staff_salary '".$cond."'"));
				$salarray[]=$row;
				
			}
			$arrvlue='';
			foreach ($salarray as $salvalue) 
			{
				$arrvlue='<tr>
						<td>'.$salvalue['salary_month'].'</td>
						<td>'.$salvalue['salary_amount'].'</td>
					</tr>';
				
			
			}
			echo $arrvlue;
			exit;
			
			
			
		}
	}
	//#############################################################################################################
	
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchstudata') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		
		require_once('classes/general_class.php');
		$obj = new General();
	   if(($_REQUEST['session']=='')){
				echo 1;exit;// required Parametre missing
		}else{
			$class=$_REQUEST['class'];
			$cond='';
			$section=$_REQUEST['section'];
			$date=$_REQUEST['date'];
			if($date=='')
			{
				$date=date("Y-m-d");
			}
			$element=$_REQUEST['element'];
				if($element!='')
				{
					//echo "SELECT * FROM essort_application_header WHERE usr_fname like '".$element."%'";
					$sqlelem=mysql_query("SELECT * FROM essort_application_header WHERE usr_fname like '".$element."%'");
					$elemconcat='';
					while($rowelem=mysql_fetch_array($sqlelem))
					{
						$elemconcat.="'".$rowelem['usr_application_id']."'".',';
					}
					$uidconcat=rtrim($elemconcat,',');
					
					if($cond=='')
					{
						$cond.="WHERE stu_id IN (".$uidconcat.")";
					}
					else
					{
						$cond.="WHERE stu_id IN (".$uidconcat.")";
					}
					
				}
				if($section!='')
				{
					if($cond=='')
					{
						$cond.="WHERE sec_id='".$section."'";
					}
					else
					{
						$cond.="AND sec_id='".$section."'";
					}
				}
				if($class!='')
				{
					if($cond=='')
					{
						$cond.="WHERE class_id='".$class."'";
					}
					else
					{
						$cond.="AND class_id='".$class."'";
					}
				}
			$sql=mysql_query("SELECT *,'usr_fname','att_status','att_intime','att_outtime' FROM essort_user_relation ".$cond."");	
			$salarray=array();
			$arraydata='';
			$cond='';
			while($row=mysql_fetch_array($sql))
			{
				
				//echo "SELECT salary_amount FROM essort_staff_salary ".$cond."";
				$sqlvlue=mysql_fetch_array(mysql_query("SELECT * FROM essort_application_header WHERE usr_application_id='".$row['stu_id']."'"));
				$row['usr_fname']=$sqlvlue['usr_fname'];
				//Attendence
				$slatt=mysql_fetch_array(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".$row['att_ref_id']."' AND att_date='".$date."'"));
				$salarray[]=$row;
				
			}
			$arrvlue='';
			foreach ($salarray as $salvalue) 
			{
				$arrvlue='<tr>
                                            <td class="text-center">1</td>
                                            <td>"'.$stuvar['usr_fname'].'"</td>
                                            <td><img src="../images/father-pic.jpg"></td>
                                            <td>101162</td>
                                            <td>"'.$stuvar['att_status'].'"</td>
                                            <td>"'.$stuvar['att_intime'].'"</td>
                                            <td>"'.$stuvar['att_outtime'].'"</td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal" data-target="#myModal">
                                                    <i class="fa fa-pencil-square font-icon-size" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>';
				
			
			}
			echo $arrvlue;
			exit;
			
			
			
		}
	}
	#########################################################################################
	
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='editdatabyclass') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		
		require_once('classes/general_class.php');
		$obj = new General();
	   if(($_REQUEST['session']=='')){
				echo 1;exit;// required Parametre missing
		}else{
			$class=$_REQUEST['classname'];
			echo "SELECT *,'SECTIONS' FROM essort_classes WHERE class_id='".$class."'";
			$sql=mysql_query("SELECT *,'SECTIONS' FROM essort_classes WHERE class_id='".$class."'");	
			$classarray=array();
			$arraydata='';
			$cond='';
			while($row=mysql_fetch_array($sql))
			{
				
				//echo "SELECT salary_amount FROM essort_staff_salary ".$cond."";
				$sqlsection=mysql_query("SELECT * FROM essort_section WHERE class_id='".$row['class_id']."'");
				$secarray='';
				while($rowsection=mysql_fetch_array($sqlsection))
				{
					$secarray.=$rowsection['section_name'].',';
				}
				$row['SECTIONS']=$secarray;
				$classarray[]=$row;
			}
			echo $classarray;
			exit;
		}
	}
	#########################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchcircular') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
	
		if(  ($_REQUEST['element']=='') && ($_REQUEST['user_password']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			 $sql=mysql_query("SELECT * FROM essort_circular_activities WHERE message like '".$_REQUEST['element']."'");
			 $tabledata=''
			 while($row=mysql_fetch_array($sql))
			 {
				$tabledata.=' <tr>
                                                <td>"'.$row['date'].'"</td>
                                                <td>"'.$row['subject'].'"</td>
                                                <td>
													<a href="javascript:void(0);">
                                                      <a data-toggle="modal" class="getdata" data-href="'.$row['attachment'].'"
                                                        <a href="../school-admin/uploads/"'.$row['attachment'].'"" target="_blank">
                                                        <span class="glyphicon glyphicon-download-alt">  </span>
														</a>
													</a>

                                                </td>
                                            </tr>';
			 }
			 echo $tabledata;
			 exit;
		}
	}
	#########################################################################################
	
?>