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
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchstafffromchairman') ){
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
			echo "SELECT *  FROM  essort_user_header WHERE usr_role IN ('Teacher') AND usr_fname like '".$element."%'";
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
																					 <td>'.$row['emp_id'].'</td>
																						<td>'.$row['usr_role'].'</td>
																						<td>'.$rowusr['att_in_time'].'</td>
																						<td>'.$rowusr['attout_time'].'</td>
																						<td class="text-center">
																							'.$rowusr['att_status'].'
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
				
				$sqla=mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id=(SELECT att_ref_id FROM essort_user_relation WHERE stu_id='".$rowatt['usr_application_id']."' LIMIT 1) AND att_date='".$date."'" );
				$rowusr=mysql_fetch_array($sqla);
				$arraydata.='<tr>
																					<tr>
																						<td class="text-center">1</td>
																						<td>'.$rowatt['usr_fname'].'</td>
																						 <td><a href="../principal/profile.php"><img src="../images/images.png"></a>                                                                                             </td>
																						<td>'.$rowatt['usr_application_no'].'</td>
																						<td>'.$rowusr['att_status'].'</td>
																						<td>'.$rowusr['att_in_time'].'</td>
																						<td>'.$rowusr['attout_time'].'</td>';
																						?>
																						<?php
																						if($rowusr['att_status']=='')
																						{
																						
																						$arraydata.='<td class="text-center">
																						</td>';
																						?>
																						
																						<?php
																						}
																						else{
																						$arraydata.='<td class="text-center">
																						<a href="student-profile.php?stu_id='.$rowatt['usr_application_id'].'" data-toggle="modal" data-target="#myModal">
                                                    <i class="fa fa-pencil-square font-icon-size" aria-hidden="true"></i>
                                                </a></td>';
																						
																						}
																						?>
																					</tr>';
																					<?php
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
				$sqlsal=mysql_query("SELECT emp_id FROM essort_user_header WHERE usr_fname like '".$salarydata."%'");
				$dataarr='';
				while($resultsal=mysql_fetch_array($sqlsal))
				{
					$dataarr.=$resultsal['emp_id'].",";
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
			$stfrslt=mysql_query("SELECT *,'usr_fname','dept_name',salary_status FROM essort_staff_salary ".$cond."");
			$no_of_rows=mysql_num_rows($stfrslt);
			if($no_of_rows>0)
			{
				$stfarray=array();
				while($rowrslt=mysql_fetch_array($stfrslt))
				{
					$sqlusrhde=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header as a JOIN  essort_user_details as b WHERE a.usr_id=b.usr_id AND a.emp_id='".$rowrslt['emp_id']."'"));
					$rowrslt['usr_fname']=$sqlusrhde['usr_fname'];
					$rowrslt['dept_name']='Teaching';
					$rowrslt['salary_status']=$rowrslt['salary_status'];
					$stfarray[]=$rowrslt;
				}
				$tbldata='';
				foreach($stfarray as $stfvlue)
				{
					$tbldata.='<tr>
						<td class="text-center">1</td>
						<td>'.$stfvlue['usr_fname'].'</td>
						<td><a href="#"><img src="../../'.$_REQUEST['session'].'/uploads/images.png"></a>
						</td>
						<td>'.$stfvlue['emp_id'].'</td>
						<td>'.$stfvlue['dept_name'].'</td>
						<td>'.$stfvlue['salary_amount'].'</td>
						<td>'.$stfvlue['salary_status'].'</td>
						</tr>';
				
				
				}
				echo $tbldata;
				exit;
			}
			else
			{
				$tbldata='';
				$tbldata='<tr>
						<td class="text-center"></td>
						<td></td>
						<td></a>
						</td>
						<td>No Data Found</td>
						<td></td>
						<td></td>
						<td></td>
						</tr>';
				echo $tbldata;
				exit;
			
			
			
			}
			//$sqldata=mysql_query("SELECT * FROM essort_staff_salary'" $cond);	
			//INSERT PARENT DATA
			
			
		}
	}
	
	//###############################################PRINCIPAL##############################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchsalarydataprinc') ){
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
				$sqlsal=mysql_query("SELECT emp_id FROM essort_user_header WHERE usr_fname like '".$salarydata."%'");
				$dataarr='';
				while($resultsal=mysql_fetch_array($sqlsal))
				{
					$dataarr.=$resultsal['emp_id'].",";
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
			$stfrslt=mysql_query("SELECT *,'usr_fname','dept_name',salary_status FROM essort_staff_salary ".$cond."");
			$no_of_rows=mysql_num_rows($stfrslt);
			if($no_of_rows>0)
			{
				$stfarray=array();
				while($rowrslt=mysql_fetch_array($stfrslt))
				{
					$sqlusrhde=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header as a JOIN  essort_user_details as b WHERE a.usr_id=b.usr_id AND a.emp_id='".$rowrslt['emp_id']."'"));
					$rowrslt['usr_fname']=$sqlusrhde['usr_fname'];
					$rowrslt['dept_name']='Teaching';
					$rowrslt['salary_status']=$rowrslt['salary_status'];
					$stfarray[]=$rowrslt;
				}
				$tbldata='';
				foreach($stfarray as $stfvlue)
				{
					$tbldata.='<tr>
						<td class="text-center">1</td>
						<td>'.$stfvlue['usr_fname'].'</td>
						<td><a href="#"><img src="../../'.$_REQUEST['session'].'/uploads/images.png"></a>
						</td>
						<td>'.$stfvlue['emp_id'].'</td>
						<td>'.$stfvlue['dept_name'].'</td>
						<td>'.$stfvlue['salary_amount'].'</td>
						<td>'.$stfvlue['salary_status'].'</td>
						<td class="text-center">
                          <input type="checkbox" class="chkNumber" value="'.$stfvlue['sal_info_id'].'">
                         </td>
						</tr>';
				
				
				}
				echo $tbldata;
				exit;
			}
			else
			{
				$tbldata='';
				$tbldata='<tr>
						<td class="text-center"></td>
						<td></td>
						<td></a>
						</td>
						<td>No Data Found</td>
						<td></td>
						<td></td>
						<td></td>
						</tr>';
				echo $tbldata;
				exit;
			
			
			
			}
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
			$sql=mysql_query("SELECT * FROM essort_staff_salary WHERE emp_id='".$staffname."' AND salary_year='".$staffyear."' GROUP BY salary_month");	
			$salarray=array();
			$arraydata='';
			$cond='';
			while($salary_month=mysql_fetch_array($sql))
			{
				$sqlusrsum=mysql_fetch_array(mysql_query("SELECT SUM( salary_amount ) AS value_sum
				FROM essort_staff_salary
				WHERE salary_month ='".$salary_month['salary_month']."' AND salary_year='".$salary_month['salary_year']."'"));
				$row['salary_amount']=$sqlusrsum['value_sum'];
				$salarray[]=$salary_month;
				
			}
			$arrvlue='';
			foreach ($salarray as $salvalue) 
			{
				$arrvlue.='<tr>
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
	
		if(($_REQUEST['element']=='')){
				echo 1;exit;// require Parametre missing
		}else{
		$sql=mysql_query("SELECT * FROM essort_circular_activities WHERE subject like '".$_REQUEST['element']."%'");
			$tabledata['data']=array();
			while($row=mysql_fetch_array($sql))
			 {
				$tabledata['data'][]=$row;
			 }
			 echo json_encode($tabledata);
			 exit;
			
		}
	}
	#########################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchevent') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
	    if(($_REQUEST['date']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			$date =$_REQUEST['date'] ;
			$date=substr($date, 0, 10); 
			//$user_type=$_REQUEST['user_type'] ;
			$userData='';
			$sql = "SELECT * FROM essort_holidays WHERE DATE_FORMAT(off_day,'%Y-%m-%d')='".$date."'";
			$res=mysql_query($sql) or die(mysql_error());
			$num_of_rows=mysql_num_rows($res);
			if($num_of_rows>0)
			{
			while($rowholiday=mysql_fetch_array($res))
			{
				$userData.='<div class="alert alert-success clearfix alert-height"> 
                                    <div class="notification-info">
                                        <ul class="clearfix notification-meta">
                                            <li class="pull-left notification-sender">
                                            <span class="alert-icon"><img src="../images/icons/event.ico" class="icon-size"></span> <span><a href="javascript:void(0);">'.$rowholiday['occassion'].'-'.$rowholiday['additional_info'].'</a></span>
                                            </li>

                                        </ul>

                                    </div>
                                </div>';
			}
			}
			else
			{
				$userData.='<div class="alert alert-success clearfix alert-height"> 
                                    <div class="notification-info">
                                        <ul class="clearfix notification-meta">
                                            <li class="pull-left notification-sender">
                                            <span class="alert-icon"><img src="../images/icons/event.ico" class="icon-size"></span> <span><a href="javascript:void(0);">No Data Found</a></span>
                                            </li>

                                        </ul>

                                    </div>
                                </div>';
			
			}
			echo $userData;
			exit;
			//echo mysql_num_rows($res);
						
		}
	}
	#########################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='approvesalary') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
	    if(($_REQUEST['chkId']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			$arr=explode(',',$_REQUEST['chkId']);
			print_r($arr);
			foreach($arr as $arrvlue)
			{
				echo "UPDATE essort_staff_salary SET salary_status='Confirmed' WHERE sal_info_id='".$arrvlue."'";
				echo $sql=mysql_query("UPDATE essort_staff_salary SET salary_status='Confirmed' WHERE sal_info_id='".$arrvlue."'");
				echo 'jyoti';
			}
			//echo mysql_num_rows($res);
			echo 'jyoti';exit;			
		}
	}
	#########################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='download') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
	    if(($_REQUEST['session']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			//create MySQL connection  
				header('Content-Type: text/csv');
				header('Content-Disposition: attachment;filename=exported-data.csv');
				$select = mysql_query("SELECT * FROM essort_staff_salary");
				$row = mysql_fetch_assoc($select);
				if($row){
					getcsv(array_keys($row));
				}
				while($row){
					getcsv($row);
					$row = mysql_fetch_assoc($select);
				}
				function getcsv($no_of_field_names){
				$separate = '';
				foreach($no_of_field_names as $field_name){
					echo $separate . $field_name;
					$separate = ',';
				}
				echo "\r\n";
			}

								
		}
	}
	#########################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='trashmsg') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
	    if(($_REQUEST['session']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			$chkId=$_REQUEST['chkId'];
			$sql=mysql_query("UPDATE essort_message_master SET delete_status='1' WHERE message_id='".$chkId."'");
		}
	}
	#########################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='deletemsg') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
	    if(($_REQUEST['session']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			$chkId=$_REQUEST['chkId'];
			
			$chkId=explode(",",$chkId);
			print_r($chkId);
			foreach($chkId as $chkvalue)
			{
				$sql=mysql_query("UPDATE essort_message_master SET delete_status='1' WHERE message_id='".$chkvalue."'");

			}
		}
	}
	#########################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='mymsgs') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
	    if(($_REQUEST['session']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			$chkId=$_REQUEST['chkId'];
			$sql=mysql_query("SELECT *,'messages','from_name' FROM essort_message_master WHERE to_id='".$_REQUEST['id']."' AND to_role='".$_REQUEST['role']."' AND delete_status ='1' GROUP BY from_role,from_id,subject");
		}
	}
	######################################PAGINATION FOR Page######################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='viewallmsgs') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
	    if(($_REQUEST['session']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			 $id=$_REQUEST['id'];
			 $role=$_REQUEST['role'];
			 $num_rec_per_page='2';
			 if(isset($id)){
				//PAGINATION
				if (isset($_REQUEST["page"]) and $_REQUEST["page"]>0){ 
						$page  = $_REQUEST["page"]; 
						
					}  
					else{ 
						$page=1;    
					}	
					$start_from = ($page-1) * $num_rec_per_page;
					$end = $num_rec_per_page;
					$sql=mysql_query("SELECT *,'messages','from_name' FROM essort_message_master WHERE to_id='".$id."' AND to_role='".$role."' AND delete_status ='0' GROUP BY subject LIMIT $start_from,$end");
				   $arr=array();
				  
				   while($row=mysql_fetch_array($sql))
				   {
								$sqlmsg=mysql_query("SELECT *,'from_name' FROM essort_message_master WHERE to_id='".$row['from_id']."' AND from_id='".$row['to_id']."' AND subject='".$row['subject']."' ");
								$sqlusr=mysql_fetch_array(mysql_query("SELECT usr_fname,usr_role FROM essort_user_header WHERE usr_id='".$row['from_id']."'"));
								$row['from_name']=$sqlusr['usr_fname'];
								$row['from_role']=$sqlusr['usr_role'];
							  //Name of user
							  $sqlmsgs=mysql_query("SELECT *,'messages','from_name' FROM essort_message_master WHERE to_id='".$id."'  AND to_role='".$role."' AND subject='".$row['subject']."'");
							   $message=array(); 
							  while($rowmsgs=mysql_fetch_array($sqlmsgs))
							   {
									  $sqlusrd=mysql_fetch_array(mysql_query("SELECT usr_fname,usr_role FROM essort_user_header WHERE usr_id='".$row['from_id']."'"));
									  $rowmsgs['from_name']=$sqlusrd['usr_fname'];
										$rowmsgs['from_role']=$sqlusrd['usr_role'];
									 $message[]=$rowmsgs;
									 
							   }
					 
					 while($rowmsg=mysql_fetch_array($sqlmsg))
					   {
						   $sqlname=mysql_fetch_array(mysql_query("SELECT usr_fname,usr_role FROM essort_user_header WHERE usr_id='".$rowmsg['from_id']."'"));
							$rowmsg['from_name']=$sqlname['usr_fname'];
							array_push($message,$rowmsg);
					   }
					   $row['messages']=$message;
					 $arr[]=$row;
				   }
				   //PAGINATION
					echo json_encode($arr);
					exit;
                }
		}
	}
	######################################UNREAD TO RAED######################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='readtounread') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
	    if(($_REQUEST['session']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			$data=$_REQUEST['data'];
			$role=$_REQUEST['role'];
			if($_REQUEST['role']=='SAD')
			{
				$role='Admin';
			}
			else
			{
				$role=$_REQUEST['role'];
			}
			$arr=explode(',',$data);
			foreach($arr as $arrvlue)
			{
				if($arrvlue!='')
				{
					
					$sql=mysql_query("UPDATE essort_message_master SET message_status='1' WHERE to_id='".$_REQUEST['id']."' AND to_role='".$role."' AND message_id='".$arrvlue."' ");
				}
			}
			
		}
	}
	###################PAGINATION FOR Page######################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searcheventbyname') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
	   $arraydata='';
			echo "SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM  essort_holidays WHERE occassion like '".$_REQUEST['element']."%' GROUP BY occassion ORDER BY maxoff DESC";
			$sql=mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM  essort_holidays WHERE occassion like '".$_REQUEST['element']."%' GROUP BY occassion ORDER BY maxoff DESC");
			while($row=mysql_fetch_array($sql))
			{
				$arraydata.='<tr>
                                        <td>'.$row['usr_role'].'</td>
                                        
                                        <td>'.date('d-m-Y', strtotime($row['minoff'])).'</td>
                                       <td>'.date('d-m-Y', strtotime($row['maxoff'])).'</td>
                                       <td>'.$row['occassion_type'].'</td>
                                        <td>'.$row['occassion'].'</td>
                                        <td>
                                            <a data-toggle="modal" data-href="" data-subject='.$row['occassion_type'].' data-id='.$row['occassion'].'> <i class="view_btn fa fa-eye getdata" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        
                                    </tr>';
			}
			echo $arraydata;
			exit;
	}
	###################EMAIL VALIDATION FOR STUDENT######################################################
if(isset($_REQUEST['action']) && ($_REQUEST['action']=='email_validate') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');
    require_once('classes/general_class.php');
    $obj = new General();
    $email = $_POST['email'];
    $sql = mysql_query("SELECT usr_email FROM essort_application_header WHERE usr_email ='".$email."'");
    if(mysql_num_rows($sql) > 0){
        echo 1;
        exit;
    }

}
############################EMAIL VALIDATION FOR FATHER######################################################
if(isset($_REQUEST['action']) && ($_REQUEST['action']=='father_email_validate') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');
    require_once('classes/general_class.php');
    $obj = new General();
    $father_email = $_POST['father_email'];
    $sql = mysql_query("SELECT usr_email FROM essort_user_header WHERE usr_email ='".$father_email."'");
    if(mysql_num_rows($sql) > 0){
        echo 1;
        exit;
    }

}
############################AUTO SEARCH IN NOTICE CIRCULAR IN PRINCIPAL DASHBOARD############################################
if(isset($_REQUEST['action']) && ($_REQUEST['action']=='notice_circular') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');
    require_once('classes/general_class.php');
    $obj = new General();
    $notice_circular = $_POST['notice_circular'];
    $sql = mysql_query("SELECT * FROM essort_circular_activities WHERE  subject ='".$notice_circular."'");
    if(mysql_num_rows($sql) <= 0){
        echo 0;
        return 0;
    }
    $row = mysql_fetch_array($sql);
    ?>
    <div class="event-box">
        <div class="message-center">
            <a href="#">
                <div class="user-img"> <img src="../images/event_img1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                <div class="mail-contnet">
                    <h5><?php echo $row['subject']; ?></h5>
                    <span class="mail-desc">
                        <?php echo $row['message']; ?>
                    </span>
                    <span class="time"><?php echo date('d-m-Y',strtotime($row['date'])); ?>
                        <?php
                        if($row['attachment']!='')
                        {
                            ?>
                            <a href="../school-admin/uploads/<?php echo $row['attachment']; ?>" target="_blank">Download Attachment
                            </a>
                        <?php
                        }
                        ?>
                    </span>
                </div>
            </a>
        </div>
    </div>
<?php
}
##########################AUTO SEARCH IN EVENT & HOLIDAYS IN EVENTHOLIDAYS IN PRINCIPAL DASHBOARD#############################
if(isset($_REQUEST['action']) && ($_REQUEST['action']=='event_holidays') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');
    require_once('classes/general_class.php');
    $obj = new General();
    $occasion = $_POST['holiday'];
    $sql = mysql_query("SELECT * FROM essort_holidays WHERE occassion ='".$occasion."'");
    if(mysql_num_rows($sql) <= 0){
        echo 0;
        return 0;
    }
    $row = mysql_fetch_array($sql);
    ?>
    <div class="event-box">
        <div class="message-center">
            <a href="#">
                <div class="user-img"> <img src="../images/event_img1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                <div class="mail-contnet">
                    <h5><?php echo $row['occassion']; ?></h5>
                    <span class="mail-desc"><?php echo $row['additional_info']; ?></span>
                    <span class="time"><?php echo date('d-m-Y',strtotime($row['off_day'])); ?></div>
            </a>
        </div>
    </div>
<?php
}

/***************************************FOR ALL EVENT ************************************/
if(isset($_REQUEST['action']) && ($_REQUEST['action']=='All_events') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');
    require_once('classes/general_class.php');
    $obj = new General();
    $all_event = $_POST['all_event'];
    $sql = mysql_query("SELECT * FROM essort_holidays WHERE occassion_type='Event' AND  occassion ='".$all_event."'");
    if(mysql_num_rows($sql) <= 0){
        echo 0;
        return 0;
    }
    $row = mysql_fetch_array($sql);
    ?>
    <div class="event-box">
        <div class="message-center">
            <a href="#">
                <div class="user-img"> <img src="../images/event_img1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                <div class="mail-contnet">
                    <h5><?php echo $row['occassion']; ?></h5>
                    <span class="mail-desc">
                        <?php echo $row['additional_info']; ?>
                    </span>
                    <span class="time"><?php echo date('d-m-Y',strtotime($row['off_day'])); ?></span>
                </div>
            </a>
        </div>
    </div>
<?php
}
/***************************************FOR ALL HOLIDAYS************************************/
if(isset($_REQUEST['action']) && ($_REQUEST['action']=='all_holidays') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');
    require_once('classes/general_class.php');
    $obj = new General();
    $holidays = $_POST['all_holidays'];
    $sql = mysql_query("SELECT * FROM essort_holidays WHERE occassion_type='Holiday' AND  occassion ='".$holidays."'");
    if(mysql_num_rows($sql) <= 0){
        echo 0;
        return 0;
    }
    $row = mysql_fetch_array($sql);
    ?>
    <div class="event-box">
        <div class="message-center">
            <a href="#">
                <div class="user-img"> <img src="../images/event_img1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                <div class="mail-contnet">
                    <h5><?php echo $row['occassion']; ?></h5>
                    <span class="mail-desc">
                        <?php echo $row['additional_info']; ?>
                    </span>
                    <span class="time"><?php echo date('d-m-Y',strtotime($row['off_day'])); ?></span>
                </div>
            </a>
        </div>
    </div>
<?php
}
################################################################################################

if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchattdatabysession') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');
    require_once('classes/general_class.php');
    $obj = new General();
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
    foreach($classesfee as $key=>$classvlue)
	{
									
    ?>
    <tr>
                                        <td> 
                                             <?php echo $key;?>
                                        </td>
                                        <td><?php echo $classvlue['A']['recieved_fee'];?></td>
                                        <td><?php echo $classvlue['A']['pending_fee'];?></td>
                                        <td><?php echo $classvlue['A']['total_stu'];?></td>
                                         <td><?php echo $classvlue['B']['recieved_fee'];?></td>
                                        <td><?php echo $classvlue['B']['pending_fee'];?></td>
                                        <td><?php echo $classvlue['B']['total_stu'];?></td>
                                         <td><?php echo $classvlue['C']['recieved_fee'];?></td>
                                        <td><?php echo $classvlue['C']['pending_fee'];?></td>
                                        <td><?php echo $classvlue['C']['total_stu'];?></td>
                                         <td><?php echo $classvlue['D']['recieved_fee'];?></td>
                                        <td><?php echo $classvlue['D']['pending_fee'];?></td>
                                        <td><?php echo $classvlue['D']['total_stu'];?></td>
    </tr>
<?php
}
}
################################################################################################

	
?>