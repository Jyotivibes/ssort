<?php
//require_once('config.php');
//require_once('email.class.php');

	###############################CONNECTION#############################/

	class General extends Connection{
		function __construct(){
		   $this->createConnection();
		}
		
		###############################NEWS AND EVENTS#############################/
		function getNewsEvents(){
			$array = array();
			$query=mysql_query("SELECT * FROM pgg_events WHERE status=1");
			if($query){
				while($result = mysql_fetch_assoc($query)){
					$array[] = $result;
				}
			}
			return $array;
			
		}
		################################SHORTLIST PG#############################/
		function addShortList($pg_id){
			
			if(isset($_SESSION['USER']['USER_ID'])){
				$user_id = $_SESSION['USER']['USER_ID'];
			}else{
				$user_id='';
			}
			if($user_id !=''){
				$shortlistQuery = mysql_query("SELECT * FROM pgg_pg_shortlist WHERE pg_id='".$pg_id."' AND user_id='".$user_id."' AND status=1 ");
				if(mysql_num_rows($shortlistQuery) == 0){
					$query = mysql_query("INSERT INTO pgg_pg_shortlist SET pg_id='".$pg_id."' , user_id='".$user_id."' , status=1 , created_on=NOW() , updated_on = NOW()");
					if($query){
						return 1;
					}else{
						return 0;
					}
				}else {
					return 2;
				}
			}
		}
		function removeShortList($pg_id){
			
			if(isset($_SESSION['USER']['USER_ID'])){
				$user_id = $_SESSION['USER']['USER_ID'];
			}else{
				$user_id='';
			}
			if($user_id !=''){
				$query = mysql_query("DELETE FROM  pgg_pg_shortlist WHERE pg_id='".$pg_id."' AND user_id='".$user_id."'");
				if($query){
					return 1;
				}else{
					return 0;
				}
			}
		}
		function isShortList($pg_id){
			if(isset($_SESSION['USER']['USER_ID'])){
				$user_id = $_SESSION['USER']['USER_ID'];
			}else{
				$user_id='';
			}
			$shortlistQuery = mysql_query("SELECT * FROM pgg_pg_shortlist WHERE pg_id='".$pg_id."' AND user_id='".$user_id."' AND status=1 ");
			if($shortlistQuery){
				return mysql_num_rows($shortlistQuery);
			}else {
				return 0;
			}
		}
		function shortListCount(){
			
			if(isset($_SESSION['USER']['USER_ID'])){
				$user_id = $_SESSION['USER']['USER_ID'];
			}else{
				$user_id='';
			}
			$shortlistQuery = mysql_query("SELECT * FROM pgg_pg_shortlist WHERE user_id='".$user_id."' AND status=1 ");
			if($shortlistQuery){
				return mysql_num_rows($shortlistQuery);
			}else {
				return 0;
			}
		}
		function getShortListPg(){
			$result = array();
			if(isset($_SESSION['USER']['USER_ID'])){
				$user_id = $_SESSION['USER']['USER_ID'];
			}else{
				$user_id='';
			}
			$shortlistQuery = mysql_query("SELECT p.*, min_price as price FROM pgg_pg p ,pgg_pg_shortlist s WHERE p.pg_id=s.pg_id AND s.user_id='".$user_id."' AND s.status=1 AND p.status=1");
			if($shortlistQuery){
				while($shortlistResult = mysql_fetch_assoc($shortlistQuery)){
					$result[] = $shortlistResult;
				}
			}
			return $result;
		}
	
		################################RATE PG##########################################
		function isPgRated($pg_id){
			if(isset($_SESSION['USER']['USER_ID'])){
				$user_id = $_SESSION['USER']['USER_ID'];
			}else{
				$user_id='';
			}
			$rateQuery = mysql_query("SELECT * FROM pgg_pg_rate WHERE pg_id='".$pg_id."' AND user_id='".$user_id."'");
			if($rateQuery){
				return mysql_num_rows($rateQuery);
			}else {
				return 0;
			}
		
		}
		function getPgRating($pg_id){
			$rate = 0;
			$average = 0;
			$rateQuery = mysql_query("SELECT * FROM pgg_pg_rate WHERE pg_id='".$pg_id."'");
		
			if($rateQuery){
				$count = mysql_num_rows($rateQuery);
				if($count){
					while($rateresult=mysql_fetch_assoc($rateQuery)){
						
						$rate += $rateresult['rate'];	
					}
					$average = $rate/$count;
				}
			}
			return $average;
		}
		
		################################ADD CLASSES##########################################
		function ADDCLASSES()
		{ 
			if(isset($_REQUEST['txtSequence'],$_REQUEST['txtClassName']) ){    
				
				$txtSequence =  mysql_real_escape_string($_POST["txtSequence"]);
				$txtClassName = mysql_real_escape_string($_POST["txtClassName"]);
				//SELECT Sequence Number
				$sqlmax=mysql_query("SELECT MAX(class_desc) as class_desc  FROM essort_classes");
				$result=mysql_fetch_array($sqlmax);
				//echo "UPDATE essort_classes SET class_desc='".$result['class_desc']."' WHERE class_desc='".$txtSequence."'";
				$nxt=$result['class_desc']+1;
				$sqlupdate=mysql_query("UPDATE essort_classes SET class_desc='".$nxt."' WHERE class_desc='".$txtSequence."'");
				//INSERT CLASSES
				$sql = "insert into  essort_classes set class_name='".$txtClassName."', class_desc='".$txtSequence."'"; 
				$resp = mysql_query($sql);
				$class_id = mysql_insert_id();
				if($resp==true){
					return 1;
				}else{
					return 0;
				}
			}else{
				return 2;
			}
		}
		
		###############################ADD SECTIONS#########################################

		function ADDSECTIONS()
		{ 
			if(isset($_REQUEST['txtSection'])){    
				
				$txtSection =  mysql_real_escape_string($_POST["txtSection"]);
				//INSERT SECTION
				$sql = "insert into  essort_section_master set section_name='".$txtSection."'"; 
				$resp = mysql_query($sql);
				$section_id = mysql_insert_id();
				if($resp==true){
					return 1;
				}else{
					return 0;
				}
			}else{
				return 2;
			}
		}
		
		###############################ADD STAFF#########################################
		function ADDSTAFF()
		{ 
			if(isset($_REQUEST['staff_type'])){    
				
				$txtEmail =  mysql_real_escape_string($_POST["txtEmail"]);
				$txtName =  mysql_real_escape_string($_POST["txtName"]);
				$txtMName =  mysql_real_escape_string($_POST["txtMName"]);
				$txtLName =  mysql_real_escape_string($_POST["txtLName"]);
				$txtContact =  mysql_real_escape_string($_POST["txtContact"]);
				$txtDesignation =  mysql_real_escape_string($_POST["txtDesignation"]);
				$txtExperience =  mysql_real_escape_string($_POST["txtExperience"]);
				$txtDeptName =  mysql_real_escape_string($_POST["txtDeptName"]);
				$staffconnect =  mysql_real_escape_string($_POST["staffconnect"]);
				$txtSalary =  mysql_real_escape_string($_POST["txtSalary"]);
				$staff_type =  mysql_real_escape_string($_POST["staff_type"]);
				$password=md5(rand());
				//SEELCT DATA
				$sql=mysql_query("SELECT * FROM essort_user_header WHERE usr_email='".$txtEmail."'");
				$numrows=mysql_fetch_row($sql);
				if($numrows>0)
				{
					return 4;
				}
				//INSERT SECTION
				$sql = "insert into  essort_user_header set usr_fname='".$txtName."',usr_mname='".$txtMName."',usr_lname='".$txtLName."',usr_role='".$staff_type."',usr_email='".$txtEmail."',password='".$password."',usr_status='1',usr_mobile='".$txtContact."'"; 
				$resp = mysql_query($sql);
				$staff_id = mysql_insert_id();
				//DETAIL 
				if ($resp==true)
				{
					$sqldetail = "insert into  essort_user_details set usr_id='".$staff_id."',dept_name='".$txtDeptName."',usr_salary='".$txtSalary."'"; 
					$respdetail = mysql_query($sqldetail);
				}
				for($i=1;$i<=$staffconnect;$i++)
				{
					//Class
					$classvar='class';
					$varname=$classvar."".$i;
					$class =  mysql_real_escape_string($_POST['class1']);
					//Section
					$secvar='section';
					$varsname=$secvar."".$i;
					$sec =  mysql_real_escape_string($_POST[$varsname]);
					//Subect
					$subvar='subject';
					$varsubname=$subvar."".$i;
					$sub =  mysql_real_escape_string($_POST[$varsubname]);
					//INSERT
					$sql = mysql_query("insert into  essort_teacher_class set staff_id='".$staff_id."',class_id='".$class."',section_id='".$sec."',subject_id='".$sub."'"); 
					
				}
				
				if($resp==true){
					return 1;
				}else{
					return 0;
				}
			}else{
				return 2;
			}
		}
		###############################ADD STAFF#########################################
		function ADDCLASSESSECTION()
		{ 
			if(isset($_REQUEST['txtSection1'],$_REQUEST['txtClassName']) ){    
				
				$txtClassName =  mysql_real_escape_string($_POST["txtClassName"]);
				$txtSection1 = mysql_real_escape_string($_POST["txtSection1"]);
				$txtSection2 = mysql_real_escape_string($_POST["txtSection2"]);
				$txtSection3 = mysql_real_escape_string($_POST["txtSection3"]);
				$txtSection4 = mysql_real_escape_string($_POST["txtSection4"]);
				$txtSection5 = mysql_real_escape_string($_POST["txtSection5"]);
				$txtSection6 = mysql_real_escape_string($_POST["txtSection6"]);
				$txtSection7 = mysql_real_escape_string($_POST["txtSection7"]);
				$txtSection8 = mysql_real_escape_string($_POST["txtSection8"]);
				$info = array($txtSection1,$txtSection2,$txtSection3,$txtSection4,$txtSection5,$txtSection6,$txtSection7,$txtSection8);
				$infod=array();
				$infod=array_filter($info);
				$sql = "insert into  essort_classes set class_name='".$txtClassName."'"; 
				$resp = mysql_query($sql);
				$class_id = mysql_insert_id();
				foreach($infod as $value)
				{
					$respd=mysql_query("INSERT INTO essort_section SET class_id='".$class_id."',section_name='".$value."'");
				}
				if($resp==true){
					return 1;
				}else{
					return 0;
				}
			}else{
				return 2;
			}
		}
		###############################ADD LEAVE#########################################
		function ADDLEAVE()
		{ 
			if(isset($_REQUEST['rforleave'],$_REQUEST['fromd']) ){    
				
				$fromd =  $_POST["fromd"];
				$fromt = $_POST["fromt"];
				$fromd=date("Y-m-d", strtotime($fromd));
				$fromt=date("Y-m-d", strtotime($fromt));
				$rforleave = mysql_real_escape_string($_POST["rforleave"]);
				$type = mysql_real_escape_string($_POST["type"]);
				$id = mysql_real_escape_string($_POST["id"]);
				$daylen = 60*60*24;
				$days=(strtotime($fromt)-strtotime($fromd))/$daylen+1;
				$i=1;
				for($i=1;$i<=$days;$i++)
				{
					$sql=mysql_query("insert into  essort_teacher_leave_info set usr_id='".$id."',leave_apply_by='".$type."',leave_date='".$fromd."',is_half_day='0',submit_date='".date('Y-m-d')."',leave_status='Pending',leave_reason='".$rforleave."'");
					$fromd = strtotime("+1 day", strtotime($fromd));
					$fromd=date("Y-m-d", $fromd);
				}
				if($sql==true){
					return 1;
				}else{
					return 0;
				}
			}else{
				return 2;
			}
		
		}
		###############################ADD LEAVE#########################################
		function ADDFEESTRUCTURE()
		{ 
			if(isset($_REQUEST['pay'],$_REQUEST['txtAmount']) ){    
				
				$txtAmount =  $_POST["txtAmount"];
				$class=$_POST["class"];
				$pay = $_POST["pay"];
				$fee_elem_id = $_POST["fee_elem_id"];
				$sectionc = $_POST["sectionc"];
				foreach($sectionc as $vluesec)
				{
					$i=0;
					foreach ($txtAmount as $vlue)
					{
						if($vlue!='')
						{
							$sql=mysql_query("INSERT INTO essort_fee_structure SET class_id='".$class."',sec_id='".$vluesec."',fee_elem_id='".$fee_elem_id[$i]."',fee_elem_amount='".$vlue."',fee_elem_type='".$pay[$i]."'");
						}
						$i++;
					}
				}
				if($sql==true){
					return 1;
				}else{
					return 0;
				}
			}else{
				return 2;
			}
		
		}
		###############################ADD LEAVE#########################################
		function ADDSUBJECT()
		{ 
			if(isset($_REQUEST['subject']) ){    
				
				$subject =  $_POST["subject"];
				$sql = "insert into  essort_subject_master set sub_name='".$subject."'"; 
				$resp = mysql_query($sql);
				$sub_id = mysql_insert_id();
				
				if($resp==true){
					return 1;
				}else{
					return 0;
				}
			}else{
				return 2;
			}
		
		}
		###############################ADD LEAVE#########################################
		function ADDSCHOOLNOTICE()
		{ 
			if(isset($_REQUEST['subject']) ){    
				
				$subject =  $_POST["subject"];
				$message =  $_POST["message"];
				$sql = "insert into  essort_circular_activities set subject='".$subject."',message='".$message."',date='".date('Y-m-d')."'"; 
				$resp = mysql_query($sql);
				$sub_id = mysql_insert_id();
				if($resp==true){
					return 1;
				}else{
					return 0;
				}
			}else{
				return 2;
			}
		
		}
		###############################ADD LEAVE#########################################
		function ADDHOLIDAY()
		{ 
			if(isset($_REQUEST['date_form']) ){    
				
				$date_form =  $_POST["date_form"];
				$date_to =  $_POST["date_to"];
				$role =  $_POST["role"];
				$subject =  $_POST["subject"];
				$message =  $_POST["message"];
				$id =  $_SESSION['USER']['USER_ID'];
				$daylen = 60*60*24;
				$date_form=date("Y-m-d", strtotime($date_form));
				$date_to=date("Y-m-d", strtotime($date_to));
				$days=(strtotime($date_to)-strtotime($date_form))/$daylen+1;
				$i=1;
				for($i=1;$i<=$days;$i++)
				{
					$sql=mysql_query("insert into  essort_holidays set usr_id='".$id."',usr_role='".$role."',off_day='".$date_form."',occassion='".$subject."',additional_info='".$message."'");
					$date_form = strtotime("+1 day", strtotime($date_form));
					$date_form=date("Y-m-d", $date_form);
					
				}
				
				/*$subject =  $_POST["subject"];
				$message =  $_POST["message"];
				$sql = "insert into  essort_holidays set off_day='".$date_form."',occassion='".$subject."',additional_info='".$message."'"; 
				$resp = mysql_query($sql);
				$sub_id = mysql_insert_id();*/
				if($sql==true){
					return 1;
				}else{
					return 0;
				}
			}else{
				return 2;
			}
		
		}
		###############################ADD LEAVE#########################################
		
		function UPLOADSALARY()
		{ 
			if(isset($_REQUEST['month']) ){    
				
				$month =  $_POST["month"];
				$file = $_FILES['sal_file']['tmp_name'];
				$handle = fopen($file, “r”);
				$c = 0;
				while(($filesop = fgetcsv($handle, 1000, “,”)) !== false)
				{
					$name = $filesop[0];
					$project = $filesop[1];

					$sql = mysql_query("INSERT INTO essort_staff_salary (emp_id, salary_year,salary_month,salary_amount) VALUES ('".$name."','".$project."','".$month."','".$project."')");
					$c = $c + 1;
				}
				if($sql==true){
					return 1;
				}else{
					return 0;
				}
			}else{
				return 2;
			}
		
		}
		###################################################################################################################
		function STUREGISTRATION()
		{ 
			if(isset($_REQUEST['first_name']) ){    
				
				$first_name =  $_POST["first_name"];
				$middle_name =  $_POST["middle_name"];
				$last_name =  $_POST["last_name"];
				$dob =  $_POST["dob"]; 
				$birth_place =  $_POST["birth_place"];
				$class =  $_POST["class"];
				$religion =  $_POST["religion"];
				$father_name =  $_POST["father_initial"]."".$_POST["father_name"];
				$father_email =  $_POST["father_email"];
				$father_age =  $_POST["father_age"];
				$father_occupation =  $_POST["father_occupation"];
				$father_designation =  $_POST["father_designation"];
				$father_organization =  $_POST["father_organization"];
				$off_address =  $_POST["off_address"];
				$off_time =  $_POST["off_time"];
				$f_office_contact =  $_POST["f_office_contact"];
				$f_monthly_income =  $_POST["f_monthly_income"];
				$f_role =  $_POST["f_role"];
				$f_primary_contact =  $_POST["f_primary_contact"];
				$father_tongue =  $_POST["father_tongue"];
				$f_alt_contact=  $_POST["f_alt_contact"];
				$mother_initial=$_POST["mother_initial"];
				$mother_name=$_POST["mother_name"];
				$m_email=$_POST["m_email"];
				$m_age=$_POST["m_age"];
				$m_occupation=$_POST["m_occupation"];
				$m_designation=$_POST["m_designation"];
				$m_org=$_POST["m_org"];
				$m_ofc_add=$_POST["m_ofc_add"];
				$m_ofc_time=$_POST["m_ofc_time"];
				$m_ofc_contact=$_POST["m_ofc_contact"];
				$m_monthly_income=$_POST["m_monthly_income"];
				$m_ofc_role=$_POST["m_ofc_role"];
				$m_tongue=$_POST["m_tongue"];
				$m_pri_conact=$_POST["m_pri_conact"];
				$m_alt_contact=$_POST["m_alt_contact"];
				$blood_group=$_POST["blood_group"];
				$alergy=$_POST["alergy"];
				$illness=$_POST["illness"];
				$eme_treat=$_POST["eme_treat"];
				$medication=$_POST["medication"];
				
				//INSERT PARENT DATA
				
				$sql=mysql_query("INSERT INTO essort_application_header SET usr_fname='".$first_name."',usr_mname='".$middle_name."',usr_lname='".$last_name."',usr_email='".$email."',usr_dob='".$dob."',usr_birth_place='".$birth_place."',usr_class_id='".$class."',usr_gender='".$gender."',usr_religion='".$religion."',usr_present_school='',user_blood_group='".$blood_group."',user_allergies='".$alergy."',user_Illness='".$illness."',user_emergency_treatment='".$eme_treat."',user_medication='".$medication."'");
				$usr_id = mysql_insert_id();
				//INSERT FATHER INFO
				$sqlfpar=mysql_query("INSERT INTO essort_application_family_info SET usr_application_id='".$usr_id."',usr_relation='father',usr_r_initial='".$_POST["father_initial"]."',usr_r_name='".$_POST["father_name"]."',usr_r_age='".$father_age."',usr_school_name='',usr_r_qualification='',usr_r_occupatrion='".$father_occupation."',usr_r_designation='".$father_designation."',usr_r_org_name='".$father_organization."',usr_r_office_address='".$off_address."',usr_r_office_timings='".$off_time."',usr_r_email='".$father_email."',usr_r_office_contact_no='".$f_office_contact."',usr_r_contact_no='".$f_primary_contact."',usr_r_monthly_income='".$f_monthly_income."',usr_r_primary_contact='".$f_primary_contact."',usr_r_role='".$f_role."'");
				//INSERT MOTHER INFO
				$sqlmpar=mysql_query("INSERT INTO essort_application_family_info SET usr_application_id='".$usr_id."',usr_relation='mother',usr_r_initial='".$_POST["mother_initial"]."',usr_r_name='".$_POST["mother_name"]."',usr_r_age='".$m_age."',usr_school_name='',usr_r_qualification='',usr_r_occupatrion='".$m_occupation."',usr_r_designation='".$m_designation."',usr_r_org_name='".$m_organization."',usr_r_office_address='".$m_ofc_add."',usr_r_office_timings='".$m_ofc_time."',usr_r_email='".$m_email."',usr_r_office_contact_no='".$m_ofc_contact."',usr_r_contact_no='".$m_primary_contact."',usr_r_monthly_income='".$m_monthly_income."',usr_r_primary_contact='".$m_pri_conact."',usr_r_role='".$m_role."'");
				if($sql==true){
					return 1;
				}else{
					return 0;
				}
			}else{
				return 2;
			}
		
		}
		###################################################################################################################
		

	}
?>