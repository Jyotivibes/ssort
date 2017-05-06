<?php
//require_once('config.php');
//require_once('email.class.php'); 

###############################CONNECTION#############################/

class Assessment extends Connection
{
    function __construct()
    {
        $this->createConnection();
    }

###############################GET SECTION OF STAFF#############################/
    function findclasssectionofteacher($user_id)
    {
        $sql=mysql_query("SELECT class_id,section_id FROM essort_teacher_class WHERE staff_id='".$user_id."'");
		$arr=array();
		while($row=mysql_fetch_array($sql))
		{
			$arr[]=$row;
		}
		return $arr;
    }

################################GET STUDENT OF CLASS AND SECTION WITH GRADE#############################/
	function getstu($class,$section)
    {
        $sql=mysql_query("SELECT stu_id FROM essort_user_relation WHERE class_id='".$class."' AND sec_id='".$section."'");
		$stuids="";
		while($row=mysql_fetch_array($sql))
		{
			$stuids.=$row['stu_id'].",";
		}
		$stuids=rtrim($stuids,',');
		
		$sqlallusers=mysql_query("SELECT stu_id,'PIC','STUNAME','GRADE',(SELECT emp_id FROM essort_user_header WHERE usr_id=parent_id) as admission_no  FROM essort_user_relation WHERE stu_id IN (".$stuids.")");
		$arr=array();
		while($rowuser=mysql_fetch_array($sqlallusers))
		{
			$sqluser=mysql_fetch_array(mysql_query("SELECT usr_fname,usr_mname,usr_lname,usr_photo FROM essort_application_header WHERE usr_application_id='".$rowuser['stu_id']."'"));
			//print_r($sqluser);
			$rowuser['STUNAME']=$sqluser['usr_fname']." ".$sqluser['usr_mname']." ".$sqluser['usr_lname'];
			$rowuser['GRADE']="A";
			$rowuser['PIC']=$sqluser['usr_photo'];
			$arr[]=$rowuser;
		}
		return $arr;
    }
   
    ###################################GET STUDENT DATA####################################
	function getstudata($stu_id)
    {
        $sqluser=mysql_fetch_array(mysql_query("SELECT usr_fname,usr_dob,user_resident_local_address,usr_mname,usr_lname,usr_photo,(SELECT emp_id FROM essort_user_header WHERE usr_id=(SELECT parent_id FROM essort_user_relation WHERE stu_id=usr_application_id)) as admission_no,(SELECT CONCAT(usr_r_name,usr_r_mname,usr_r_lname) as usr_r_name FROM essort_application_family_info WHERE usr_application_id=h.usr_application_id AND usr_relation='father') as father_name,(SELECT CONCAT(usr_r_name,usr_r_mname,usr_r_lname) as usr_r_name FROM essort_application_family_info WHERE usr_application_id=h.usr_application_id AND usr_relation='mother') as mother_name FROM essort_application_header as h WHERE usr_application_id='".$stu_id."'"));
		return $sqluser;
    }
   
    ###################################FOR REST PASSWORD ####################################
	function allterms()
    {
        $sqlterm=mysql_query("SELECT *,'DATA' from essort_term_master as t");
		$arr=array();
		while($row=mysql_fetch_assoc($sqlterm))
		{
			$examarr=array();
			$marks=0;
			$examname="";
			$sqlexm=mysql_query("SELECT exam,marks FROM  essort_exams WHERE exam_term='".$row['term_id']."'");
			while($rowexam=mysql_fetch_assoc($sqlexm))
			{
				$examarr[]=$rowexam;
				$marks=$marks+$rowexam['marks'];
				$examname.=$rowexam['exam'].'+';
			}
			end($examarr);         // move the internal pointer to the end of the array
			$key = key($examarr);  // fetches the key of the element pointed to by the internal pointer
			$key=$key+1;
			$examname=rtrim($examname,'+');
			$examarr[$key] = array("exam"=>"Total (".$examname.")","marks"=>$marks);

			$arr[$row['term_name']]=$examarr;
		}
		return $arr;
    }
    ###################################FOR REST PASSWORD ####################################
	function allsubject($section)
    {
	
        $sqlsub=mysql_query("SELECT (SELECT sub_name FROM  essort_subject_master WHERE sub_id=sa.sub_id) as sub_id from essort_subject_allocation as sa WHERE section_id='2'");//".$section."
		$arr=array();
		while($row=mysql_fetch_array($sqlsub))
		{
			$arr[]=$row;
		}
		return $arr;
		
    }
    ###################################FOR REST PASSWORD ####################################
	function parameterize_array($array) {
    $out = array();
    foreach($array as $key => $value)
        $out[] = "$key=$value";
    return $out;
}

	
    ###################################FOR REST PASSWORD ####################################
    
}

?>