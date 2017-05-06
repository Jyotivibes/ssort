<?php
//require_once('config.php');
//require_once('email.class.php'); 

###############################CONNECTION#############################/

class General extends Connection
{
    function __construct()
    {
        $this->createConnection();
    }

    ###############################NEWS AND EVENTS#############################/
    function MySubject($user_id)
    {
        $array = array();
        $query = mysql_query("SELECT * FROM essort_teacher_class WHERE staff_id='" . $user_id . "'");
        $subarr = array();
        while ($rowsubject = mysql_fetch_array($query)) {
            $sqlclass = mysql_fetch_array(mysql_query("SELECT class_name From essort_classes WHERE class_id='" . $rowsubject['class_id'] . "'"));
            $rowsubject['class_id'] = $sqlclass['class_name'];
            $sqlsub = mysql_fetch_array(mysql_query("SELECT sub_name From essort_subject_master WHERE sub_id='" . $rowsubject['subject_id'] . "'"));
            $rowsubject['subject_id'] = $sqlsub['sub_name'];
            $subarr[] = $rowsubject;
        }
        return $subarr;

    }

    ################################SHORTLIST PG#############################/
    function getClass($class_id)
    {
        $array = array();
        $query = mysql_fetch_array(mysql_query("SELECT * FROM essort_classes WHERE class_id='" . $class_id . "'"));
        if ($query) {
            $class = $query['class_name'];
        }
        return $class;

    }

    ################################ALL SESSIONS#############################/
	function allsessions()
    {
        $array = array();
        $query = mysql_query("SELECT * FROM session_master");
        while ($rowsession = mysql_fetch_array($query)) {
             $subarr[] = $rowsession['session'];
        }
        return $subarr;
	

    }
    ################################GET CURRENT SESSION #############################/
	function getcurrentsession()
    {
        $array = array();
        $query = mysql_fetch_array(mysql_query("SELECT * FROM session_master WHERE status='1'"));
        if ($query) {
            $session = $query['session'];
        }
        return $session;
	

    }
    ################################SHORTLIST PG#############################/
    function getSection($class_id, $section_id)
    {
        $array = array();
        $query = mysql_fetch_array(mysql_query("SELECT * FROM essort_section WHERE class_id='" . $class_id . "' AND section_id='" . $section_id . "'"));
        if ($query) {
            $section_name = $query['section_name'];
        }
        return $section_name;

    }

    ################################SHORTLIST PG#############################/
    function addShortList($pg_id)
    {

        if (isset($_SESSION['USER']['USER_ID'])) {
            $user_id = $_SESSION['USER']['USER_ID'];
        } else {
            $user_id = '';
        }
        if ($user_id != '') {
            $shortlistQuery = mysql_query("SELECT * FROM pgg_pg_shortlist WHERE pg_id='" . $pg_id . "' AND user_id='" . $user_id . "' AND status=1 ");
            if (mysql_num_rows($shortlistQuery) == 0) {
                $query = mysql_query("INSERT INTO pgg_pg_shortlist SET pg_id='" . $pg_id . "' , user_id='" . $user_id . "' , status=1 , created_on=NOW() , updated_on = NOW()");
                if ($query) {
                    return 1;
                } else {
                    return 0;
                }
            } else {
                return 2;
            }
        }
    }

    function removeShortList($pg_id)
    {

        if (isset($_SESSION['USER']['USER_ID'])) {
            $user_id = $_SESSION['USER']['USER_ID'];
        } else {
            $user_id = '';
        }
        if ($user_id != '') {
            $query = mysql_query("DELETE FROM  pgg_pg_shortlist WHERE pg_id='" . $pg_id . "' AND user_id='" . $user_id . "'");
            if ($query) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    function isShortList($pg_id)
    {
        if (isset($_SESSION['USER']['USER_ID'])) {
            $user_id = $_SESSION['USER']['USER_ID'];
        } else {
            $user_id = '';
        }
        $shortlistQuery = mysql_query("SELECT * FROM pgg_pg_shortlist WHERE pg_id='" . $pg_id . "' AND user_id='" . $user_id . "' AND status=1 ");
        if ($shortlistQuery) {
            return mysql_num_rows($shortlistQuery);
        } else {
            return 0;
        }
    }

    function shortListCount()
    {

        if (isset($_SESSION['USER']['USER_ID'])) {
            $user_id = $_SESSION['USER']['USER_ID'];
        } else {
            $user_id = '';
        }
        $shortlistQuery = mysql_query("SELECT * FROM pgg_pg_shortlist WHERE user_id='" . $user_id . "' AND status=1 ");
        if ($shortlistQuery) {
            return mysql_num_rows($shortlistQuery);
        } else {
            return 0;
        }
    }

    function getShortListPg()
    {
        $result = array();
        if (isset($_SESSION['USER']['USER_ID'])) {
            $user_id = $_SESSION['USER']['USER_ID'];
        } else {
            $user_id = '';
        }
        $shortlistQuery = mysql_query("SELECT p.*, min_price as price FROM pgg_pg p ,pgg_pg_shortlist s WHERE p.pg_id=s.pg_id AND s.user_id='" . $user_id . "' AND s.status=1 AND p.status=1");
        if ($shortlistQuery) {
            while ($shortlistResult = mysql_fetch_assoc($shortlistQuery)) {
                $result[] = $shortlistResult;
            }
        }
        return $result;
    }

    ################################RATE PG##########################################
    function isPgRated($pg_id)
    {
        if (isset($_SESSION['USER']['USER_ID'])) {
            $user_id = $_SESSION['USER']['USER_ID'];
        } else {
            $user_id = '';
        }
        $rateQuery = mysql_query("SELECT * FROM pgg_pg_rate WHERE pg_id='" . $pg_id . "' AND user_id='" . $user_id . "'");
        if ($rateQuery) {
            return mysql_num_rows($rateQuery);
        } else {
            return 0;
        }

    }

    function getPgRating($pg_id)
    {
        $rate = 0;
        $average = 0;
        $rateQuery = mysql_query("SELECT * FROM pgg_pg_rate WHERE pg_id='" . $pg_id . "'");

        if ($rateQuery) {
            $count = mysql_num_rows($rateQuery);
            if ($count) {
                while ($rateresult = mysql_fetch_assoc($rateQuery)) {

                    $rate += $rateresult['rate'];
                }
                $average = $rate / $count;
            }
        }
        return $average;
    }

    ################################ADD CLASSES##########################################
    function ADDCLASSES()
    {
        if (isset($_REQUEST['txtSequence'], $_REQUEST['txtClassName'])) {

            $txtSequence = mysql_real_escape_string($_POST["txtSequence"]);
            $txtClassName = mysql_real_escape_string($_POST["txtClassName"]);
            //SELECT Sequence Number
            $sqlmax = mysql_query("SELECT MAX(class_desc) as class_desc  FROM essort_classes");
            $result = mysql_fetch_array($sqlmax);
            //echo "UPDATE essort_classes SET class_desc='".$result['class_desc']."' WHERE class_desc='".$txtSequence."'";
            $nxt = $result['class_desc'] + 1;
            $sqlupdate = mysql_query("UPDATE essort_classes SET class_desc='" . $nxt . "' WHERE class_desc='" . $txtSequence . "'");
            //INSERT CLASSES
            $sql = "insert into  essort_classes set class_name='" . $txtClassName . "', class_desc='" . $txtSequence . "'";
            $resp = mysql_query($sql);
            $class_id = mysql_insert_id();
            if ($resp == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }
    }

    ###############################ADD SECTIONS#########################################
    function EDITATT()
    {
        if (isset($_REQUEST['att_id'], $_REQUEST['intime'])) {

            $att_id = mysql_real_escape_string($_POST["att_id"]);
            $intime = mysql_real_escape_string($_POST["intime"]);
            $outtime = mysql_real_escape_string($_POST["outtime"]);
            $att_date = mysql_real_escape_string($_POST["att_date"]);
            $id = mysql_real_escape_string($_POST["id"]);
            if ($att_id != '') {
                $sqlupdate = mysql_query("UPDATE essort_class_attendence SET att_in_time='" . $intime . "',attout_time='" . $outtime . "' WHERE attendence_id='" . $att_id . "'");
            } else {
                $sqlupdate = mysql_query("INSERT INTO essort_class_attendence SET att_in_time='" . $intime . "',attout_time='" . $outtime . "',att_date='" . date('Y-m-d', strtotime($att_date)) . "',att_session='" . $_POST['curr_session'] . "',stu_id='" . $id . "',att_status='P'");
            }
            //INSERT CLASSES
            if ($sqlupdate == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }
    }

    ###############################ADD SECTIONS#########################################

    function ADDSECTIONS()
    {
        if (isset($_REQUEST['txtSection'])) {

            $txtSection = mysql_real_escape_string($_POST["txtSection"]);
            //INSERT SECTION
            $sql = "insert into  essort_section_master set section_name='" . $txtSection . "'";
            $resp = mysql_query($sql);
            $section_id = mysql_insert_id();
            if ($resp == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }
    }

    ###############FOR DELETE ATTENDANCE START########################
    function DELETEATT()
    {
        if (isset($_REQUEST['att_id'], $_REQUEST['intime'])) {

            $att_id = mysql_real_escape_string($_POST["att_id"]);
            $intime = mysql_real_escape_string($_POST["intime"]);
            $outtime = mysql_real_escape_string($_POST["outtime"]);
            $att_date = mysql_real_escape_string($_POST["att_date"]);
            $id = mysql_real_escape_string($_POST["id"]);
            if ($att_id != '') {
                $sqldelete = mysql_query("DELETE FROM essort_class_attendence WHERE att_date='" . date('Y-m-d',
                    strtotime($att_date)) . "' AND attendence_id='" . $att_id . "'");
                if ($sqldelete == true) {
                    return 1;
                } else {
                    return mysql_error();
                }
            }
        }
    }

    ###############FOR DELETE ATTENDANCE END########################

    ###############################ADD STAFF#########################################
    function ADDSTAFF()
    {
        if (isset($_REQUEST['staff_type'])) {

            $txtEmail = mysql_real_escape_string($_POST["txtEmail"]);
            $txtName = mysql_real_escape_string($_POST["txtName"]);
            $txtMName = mysql_real_escape_string($_POST["txtMName"]);
            $txtLName = mysql_real_escape_string($_POST["txtLName"]);
            $txtContact = mysql_real_escape_string($_POST["txtContact"]);
            $txtDesignation = mysql_real_escape_string($_POST["txtDesignation"]);
            $txtExperience = mysql_real_escape_string($_POST["txtExperience"]);
            $txtDeptName = mysql_real_escape_string($_POST["txtDeptName"]);
            $staffconnect = mysql_real_escape_string($_POST["staffconnect"]);
            $txtSalary = mysql_real_escape_string($_POST["txtSalary"]);
            $staff_type = mysql_real_escape_string($_POST["staff_type"]);
            $file = $_FILES['profile_image']['name'];
            $tmp_file = $_FILES['profile_image']['tmp_name'];
            $folder = "../../" . $_SESSION['USER']['DB_NAME'] . "/uploads/staff/";

            $password = md5(rand());
            //SEELCT DATA
            move_uploaded_file($tmp_file, $folder . $file);
            $sql = mysql_query("SELECT * FROM essort_user_header WHERE usr_email='" . $txtEmail . "'");
            $numrows = mysql_fetch_row($sql);
            if ($numrows > 0) {
                return 4;
            }
            //INSERT SECTION

            $sql = "insert into  essort_user_header set usr_fname='" . $txtName . "',usr_mname='" . $txtMName . "',usr_lname='" . $txtLName . "',usr_pic='" . $file . "',usr_role='" . $staff_type . "',usr_email='" . $txtEmail . "',password='" . $password . "',usr_status='1',usr_mobile='" . $txtContact . "'";
            $resp = mysql_query($sql);
            $staff_id = mysql_insert_id();
            $paddedNum = sprintf("%06d", $staff_id);
            $roleode = "EMP";
            $emp_id = $roleode . "" . $paddedNum;
            //UPDATE EMP_ID
            $upsql = mysql_query("UPDATE essort_user_header SET emp_id='" . $emp_id . "' WHERE usr_id='" . $staff_id . "'");
            //DETAIL
            if ($resp == true) {
                $sqldetail = "insert into  essort_user_details set usr_id='" . $staff_id . "',dept_name='" . $txtDeptName . "',usr_salary='" . $txtSalary . "'";
                $respdetail = mysql_query($sqldetail);
            }
            for ($i = 1; $i <= $staffconnect; $i++) {
                //Class
                $classvar = 'class';
                $varname = $classvar . "" . $i;
                $class = mysql_real_escape_string($_POST['class1']);
                //Section
                $secvar = 'section';
                $varsname = $secvar . "" . $i;
                $sec = mysql_real_escape_string($_POST[$varsname]);
                //Subect
                $subvar = 'subject';
                $varsubname = $subvar . "" . $i;
                $sub = mysql_real_escape_string($_POST[$varsubname]);

                $chkvar = 'chkClTeacher';
                @$varchkname = $chkvar . "" . $i;
                @$chk = mysql_real_escape_string($_POST[$varchkname]);
                //SELECT DUPLICATE RECORD
                $sqlchk = mysql_query("SELECT * FROM essort_teacher_class WHERE class_id='" . $class . "' AND section_id='" . $sec . "' AND subject_id='" . $sub . "'");
                $no_of_rows = mysql_num_rows($sqlchk);
                if ($no_of_rows > 0) {

                } else {
                    //SELECT CLASS TEACHER RECORD
                    $sqlclschk = mysql_query("SELECT * FROM essort_teacher_class WHERE class_id='" . $class . "' AND section_id='" . $sec . "' AND is_classteacher='1'");
                    $no_chk_of_rows = mysql_num_rows($sqlclschk);
                    if ($no_chk_of_rows > 0) {
                        $sql = mysql_query("insert into  essort_teacher_class set staff_id='" . $staff_id . "',class_id='" . $class . "',section_id='" . $sec . "',subject_id='" . $sub . "',is_classteacher='0'");
                    } else {
                        //INSERT
                        $sql = mysql_query("insert into  essort_teacher_class set staff_id='" . $staff_id . "',class_id='" . $class . "',section_id='" . $sec . "',subject_id='" . $sub . "',is_classteacher='" . $chk . "'");
                    }
                }

            }

            if ($resp == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }
    }

    ###############################ADD STAFF#########################################  

    function UPDATESTAFF()
    {
        if (isset($_REQUEST['staff_type'])) {

            $staff_id = mysql_real_escape_string($_POST["staff_id"]);
            $txtEmail = mysql_real_escape_string($_POST["txtEmail"]);
            $txtName = mysql_real_escape_string($_POST["txtName"]);
            $txtMName = mysql_real_escape_string($_POST["txtMName"]);
            $txtLName = mysql_real_escape_string($_POST["txtLName"]);
            $txtContact = mysql_real_escape_string($_POST["txtContact"]);
            $txtDesignation = mysql_real_escape_string($_POST["txtDesignation"]);
            $txtExperience = mysql_real_escape_string($_POST["txtExperience"]);
            $txtDeptName = mysql_real_escape_string($_POST["txtDeptName"]);
            $staffconnect = mysql_real_escape_string($_POST["staffconnect"]);
            $txtSalary = mysql_real_escape_string($_POST["txtSalary"]);
            $staff_type = mysql_real_escape_string($_POST["staff_type"]);
            $password = md5(rand());
            //SEELCT DATA

            //INSERT SECTION
            $sql = "update  essort_user_header set usr_fname='" . $txtName . "',usr_mname='" . $txtMName . "',usr_lname='" . $txtLName . "',usr_role='" . $staff_type . "',usr_email='" . $txtEmail . "',password='" . $password . "',usr_status='1',usr_mobile='" . $txtContact . "' WHERE usr_id='" . $staff_id . "'";
            $resp = mysql_query($sql);
            //$staff_id = mysql_insert_id();
            //DETAIL 
            if ($resp == true) {
                $sqldetail = "update  essort_user_details set dept_name='" . $txtDeptName . "',usr_salary='" . $txtSalary . "',usr_designation='" . $txtDesignation . "' WHERE usr_id='" . $staff_id . "'";
                $respdetail = mysql_query($sqldetail);
            }
            if ($staffconnect > 0) {
                $sqlchk = mysql_query("DELETE  FROM essort_teacher_class WHERE staff_id='" . $staff_id . "'");
            }
            for ($i = 1; $i <= $staffconnect; $i++) {
                //Class
                $classvar = 'class';
                $varname = $classvar . "" . $i;
                $class = mysql_real_escape_string($_POST['class1']);
                //Section
                $secvar = 'section';
                $varsname = $secvar . "" . $i;
                $sec = mysql_real_escape_string($_POST[$varsname]);
                //Subect
                $subvar = 'subject';
                $varsubname = $subvar . "" . $i;
                $sub = mysql_real_escape_string($_POST[$varsubname]);

                $chkvar = 'chkClTeacher';
                $varchkname = $chkvar . "" . $i;
                $chk = mysql_real_escape_string($_POST[$varchkname]);

                //SELECT CLASS TEACHER RECORD
                $sqlclschk = mysql_query("SELECT * FROM essort_teacher_class WHERE class_id='" . $class . "' AND section_id='" . $sec . "' AND is_classteacher='1'");
                $no_chk_of_rows = mysql_num_rows($sqlclschk);
                if ($no_chk_of_rows > 0) {
                    $sql = mysql_query("insert into  essort_teacher_class set staff_id='" . $staff_id . "',class_id='" . $class . "',section_id='" . $sec . "',subject_id='" . $sub . "',is_classteacher='0'");
                } else {
                    //INSERT
                    $sql = mysql_query("insert into  essort_teacher_class set staff_id='" . $staff_id . "',class_id='" . $class . "',section_id='" . $sec . "',subject_id='" . $sub . "',is_classteacher='" . $chk . "'");
                }


            }
            if ($resp == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }
    }


    ###############################UPDATE STAFF#########################################
    function ADDCLASSESSECTION()
    {
        if (isset($_REQUEST['txtSection1'], $_REQUEST['txtClassName'])) {

            $txtClassName = mysql_real_escape_string($_POST["txtClassName"]);
            $txtSection1 = mysql_real_escape_string($_POST["txtSection1"]);
            $txtSection2 = mysql_real_escape_string($_POST["txtSection2"]);
            $txtSection3 = mysql_real_escape_string($_POST["txtSection3"]);
            $txtSection4 = mysql_real_escape_string($_POST["txtSection4"]);
            $txtSection5 = mysql_real_escape_string($_POST["txtSection5"]);
            $txtSection6 = mysql_real_escape_string($_POST["txtSection6"]);
            $txtSection7 = mysql_real_escape_string($_POST["txtSection7"]);
            $txtSection8 = mysql_real_escape_string($_POST["txtSection8"]);
            $info = array($txtSection1, $txtSection2, $txtSection3, $txtSection4, $txtSection5, $txtSection6, $txtSection7, $txtSection8);
            $infod = array();
            $infod = array_filter($info);
            //SELECT EXISTING CLASS
            $sqlclass = mysql_query("SELECT * FROM essort_classes WHERE class_name='" . $txtClassName . "'");
            $num_of_rows = mysql_num_rows($sqlclass);
            if ($num_of_rows > 0) {
                return 3;
            }
            $sql = "insert into  essort_classes set class_name='" . $txtClassName . "'";
            $resp = mysql_query($sql);
            $class_id = mysql_insert_id();
            foreach ($infod as $value) {
                $respd = mysql_query("INSERT INTO essort_section SET class_id='" . $class_id . "',section_name='" . $value . "'");
            }
            if ($resp == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }
    }

    ###############################ADD LEAVE#########################################
    function UPDATECLASSESSECTION()
    {
        if (isset($_REQUEST['editclass_id'], $_REQUEST['txtClassEdit'], $_REQUEST['txtsectionEdit0'])) {

            $editclass_id = mysql_real_escape_string($_POST["editclass_id"]);
            $txtClassEdit = mysql_real_escape_string($_POST["txtClassEdit"]);
            $txtsectionEdit0 = mysql_real_escape_string($_POST["txtsectionEdit0"]);
            $txtsectionEdit1 = mysql_real_escape_string($_POST["txtsectionEdit1"]);
            $txtsectionEdit2 = mysql_real_escape_string($_POST["txtsectionEdit2"]);
            $txtsectionEdit3 = mysql_real_escape_string($_POST["txtsectionEdit3"]);
            $txtsectionEdit4 = mysql_real_escape_string($_POST["txtsectionEdit4"]);
            $txtsectionEdit5 = mysql_real_escape_string($_POST["txtsectionEdit5"]);
            $txtsectionEdit6 = mysql_real_escape_string($_POST["txtsectionEdit6"]);
            $txtsectionEdit7 = mysql_real_escape_string($_POST["txtsectionEdit7"]);
            $sqlclass = mysql_query("SELECT * FROM essort_classes WHERE class_id='" . $editclass_id . "'");
            $num_of_rows = mysql_num_rows($sqlclass);
            $info = array($txtsectionEdit0, $txtsectionEdit1, $txtsectionEdit2, $txtsectionEdit3, $txtsectionEdit4, $txtsectionEdit5, $txtsectionEdit6, $txtsectionEdit7);
            $infod = array();
            $infod = array_filter($info);
            $resp = '';
            if ($num_of_rows > 0) {
                $sql = "Update essort_classes set class_name='" . $txtClassEdit . "' WHERE class_id='" . $editclass_id . "'";
                $resp = mysql_query($sql);
            }
            //DELETE SECTION ID
            $slcsql = mysql_query("SELECT section_id FROM essort_section WHERE class_id='" . $editclass_id . "'");
            $section = array();
            while ($slcarr = mysql_fetch_array($slcsql)) {
                $section[] = $slcarr['section_id'];
            }
            $infoarrcount = count($infod);
            $secarrcount = count($section);
            if ($infoarrcount < $secarrcount) {
                return 4;

            }
            if ($infoarrcount > $secarrcount) {
                $diff = $infoarrcount - $secarrcount;
                for ($i = 1; $i <= $diff; $i++) {
                    array_push($section, '');

                }

            }
            //$section=array_filter($section);
            //print_r($infod);
            $i = 0;
            foreach ($section as $value) {
                if ($value == '') {
                    $respd = mysql_query("INSERT INTO essort_section SET class_id='" . $editclass_id . "',section_name='" . $infod[$i] . "'");
                } else {
                    $respd = mysql_query("UPDATE essort_section SET section_name='" . $infod[$i] . "' WHERE section_id='" . $value . "'");
                }
                $i++;
            }
            if ($resp == true) {
                return 1;
            } elseif ($resp == false && $respd == true) {
                return 3;
            } else {
                return 0;
            }
        } else {
            return 2;
        }
    }

    ###############################ADD LEAVE#########################################
    function ADDLEAVE()
    {
        if (isset($_REQUEST['rforleave'], $_REQUEST['fromd'])) {

            $fromd = $_POST["fromd"];
            $fromt = $_POST["fromt"];
            $fromd = date("Y-m-d", strtotime($fromd));
            $fromt = date("Y-m-d", strtotime($fromt));
            $rforleave = mysql_real_escape_string($_POST["rforleave"]);
            $type = mysql_real_escape_string($_POST["type"]);
            $id = mysql_real_escape_string($_POST["from_id"]);
            $daylen = 60 * 60 * 24;
            $days = (strtotime($fromt) - strtotime($fromd)) / $daylen + 1;
            $array = array();
            $select = mysql_query("SELECT * FROM essort_teacher_leave_info WHERE usr_id='".$_SESSION['USER']['USER_ID']."'");
            while ($rowdata = mysql_fetch_array($select)) {
                $array[] = $rowdata['leave_date'];
            }
            $i = 1;
            for ($i = 1; $i <= $days; $i++) {
                if (in_array($fromd, $array)) {
                    return 2;
                }

                else{
                    $sql = mysql_query("insert into  essort_teacher_leave_info set usr_id='" . $id . "',leave_apply_by='" . $type . "',leave_date='" . $fromd . "',is_half_day='0',submit_date='" . date('Y-m-d') . "',leave_status='Pending',leave_reason='" . $rforleave . "'");
                    $fromd = strtotime("+1 day", strtotime($fromd));
                    $fromd = date("Y-m-d", $fromd);
                }
                }

            if ($sql == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }

    }
    ###############################TTEACHER All  LEAVE#########################################
    function STAFFALLLEAVE(){
        $array = array();
        $sql = mysql_query("SELECT *,MAX(leave_date) as maxoff,MIN(leave_date) as minoff FROM essort_teacher_leave_info WHERE usr_id='".$_SESSION['USER']['USER_ID']."' GROUP BY leave_reason");
        while($row = mysql_fetch_array($sql)){
            $array[] = $row;
        }
        return $array;
    }

    ###############################ADD LEAVE#########################################
    function ADDSTULEAVE()
    {
        if (isset($_REQUEST['rforleave'], $_REQUEST['fromd'])) {

            $fromd = $_POST["fromd"];
            $fromt = $_POST["fromt"];
            $fromd = date("Y-m-d", strtotime($fromd));
            $fromt = date("Y-m-d", strtotime($fromt));
            $rforleave = mysql_real_escape_string($_POST["rforleave"]);
            $type = mysql_real_escape_string($_POST["type"]);
            $id = mysql_real_escape_string($_POST["id"]);
            $daylen = 60 * 60 * 24;
            $days = (strtotime($fromt) - strtotime($fromd)) / $daylen + 1;
            $i = 1;
            for ($i = 1; $i <= $days; $i++) {
                $sql = mysql_query("insert into  essort_student_leave_info set usr_id='" . $id . "',leave_apply_by='" . $type . "',leave_date='" . $fromd . "',is_half_day='0',submit_date='" . date('Y-m-d') . "',leave_status='Pending',leave_reason='" . $rforleave . "'");
                $fromd = strtotime("+1 day", strtotime($fromd));
                $fromd = date("Y-m-d", $fromd);
            }
            if ($sql == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }

    }

    ###############################ADD LEAVE#########################################
    function ADDFEESTRUCTURE()
    {
        if (isset($_REQUEST['pay'], $_REQUEST['txtAmount'])) {

            $txtAmount = $_POST["txtAmount"];
            $class = $_POST["class"];
            $pay = $_POST["pay"];
            $fee_elem_id = $_POST["fee_elem_id"];
            $sectionc = $_POST["sectionc"];
            foreach ($sectionc as $vluesec) {
                $i = 0;
                foreach ($txtAmount as $vlue) {

                    $monthdata = "";
                    if ($pay[$i] == 'Quarterly') {
                        $monthdata = "April,July,October,January";
                    } else if ($pay[$i] == 'Monthly') {
                        $monthdata = "";

                    } else if ($pay[$i] == 'One') {
                        $monthdata = "April";

                    } else {
                        $monthdata = "";
                    }

                    if ($vlue != '') {
                        $sql = mysql_query("INSERT INTO essort_fee_structure SET class_id='" . $class . "',sec_id='" . $vluesec . "',fee_elem_id='" . $fee_elem_id[$i] . "',fee_elem_amount='" . $vlue . "',fee_elem_type='" . $pay[$i] . "',fee_elem_month='" . $monthdata . "'");
                    }
                    $i++;
                }
            }
            if ($sql == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }

    }

    ###############################ADD LEAVE#########################################
    function ADDSUBJECT()
    {
        if (isset($_REQUEST['subject'])) {

            $subject = $_POST["subject"];
            $sybchksl = mysql_query("SELECT * FROM  essort_subject_master WHERE  sub_name='" . $subject . "'");
            $sub_no_of_rows = mysql_num_rows($sybchksl);
            if ($sub_no_of_rows > 0) {
                return 5;
            }
            $sql = "insert into  essort_subject_master set sub_name='" . $subject . "'";
            $resp = mysql_query($sql);
            $sub_id = mysql_insert_id();

            if ($resp == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }

    }

    ###############################ADD LEAVE#########################################
    function UPDATESUBJECT()
    {
        if (isset($_REQUEST['subject'])) {

            $subject_id = $_POST["subject_id"];
            $subject = $_POST["subject"];
            $sybchksl = mysql_query("SELECT * FROM  essort_subject_master WHERE  sub_name='" . $subject . "'");
            $sub_no_of_rows = mysql_num_rows($sybchksl);
            if ($sub_no_of_rows > 0) {
                return 5;
            }
            $sql = "update  essort_subject_master set sub_name='" . $subject . "' WHERE sub_id='" . $subject_id . "'";
            $resp = mysql_query($sql);
            $sub_id = mysql_insert_id();

            if ($resp == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }
    }

    ###############################ADD LEAVE#########################################
    function ADDSCHOOLNOTICE()
    {
        if (isset($_REQUEST['subject'])) {

            $subject = $_POST["subject"];
            $message = $_POST["message"];
            $date_form = date('Y-m-d', strtotime($_POST["date_form"]));
            if (isset($_FILES['attach'])) {
                $file_name = $_FILES['attach']['name'];
                $file_tmp = $_FILES['attach']['tmp_name'];
                move_uploaded_file($file_tmp, "uploads/" . $file_name);
                // exit;
            }

            $sql = "insert into  essort_circular_activities set subject='" . $subject . "',message='" . $message . "',date='" . date('Y-m-d') . "',attachment='" . $file_name . "',valid_till='" . $date_form . "'";
            $resp = mysql_query($sql);
            $sub_id = mysql_insert_id();
            if ($resp == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }

    }

    ###############################ADD LEAVE#########################################
    function ADDHOLIDAY()
    {
        if (isset($_REQUEST['date_form'])) {

            $date_form = $_POST["date_form"];
            $type = $_POST["type"];
            $date_to = $_POST["date_to"];
            $role = $_POST["role"];
            $subject = $_POST["subject"];
            $message = $_POST["message"];
            $id = $_SESSION['USER']['USER_ID'];
            $daylen = 60 * 60 * 24;
            $date_form = date("Y-m-d", strtotime($date_form));
            $date_to = date("Y-m-d", strtotime($date_to));
            $days = (strtotime($date_to) - strtotime($date_form)) / $daylen + 1;
            $i = 1;
            for ($i = 1; $i <= $days; $i++) {
                $sql = mysql_query("insert into  essort_holidays set usr_id='" . $id . "',occassion_type='" . $type . "',usr_role='" . $role . "',off_day='" . $date_form . "',occassion='" . $subject . "',additional_info='" . $message . "'");
                $date_form = strtotime("+1 day", strtotime($date_form));
                $date_form = date("Y-m-d", $date_form);

            }

            /*$subject =  $_POST["subject"];
				$message =  $_POST["message"];
				$sql = "insert into  essort_holidays set off_day='".$date_form."',occassion='".$subject."',additional_info='".$message."'"; 
				$resp = mysql_query($sql);
				$sub_id = mysql_insert_id();*/
            if ($sql == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }

    }

    ###############################ADD LEAVE#########################################

    function UPLOADSALARY()
    {
        if (isset($_FILES["sal_file"]["tmp_name"])) {
            $month = $_POST['month'];
            $year = $_POST['sal_year'];
            $file = $_FILES['sal_file']['name'];
            $tmp_file = $_FILES['sal_file']['tmp_name'];
            $folder = "../../" . $_SESSION['USER']['DB_NAME'] . "/uploads/";
            if (move_uploaded_file($tmp_file, $folder . $file)) {
                include "../../" . $_SESSION['USER']['DB_NAME'] . "/PHPExcel/Classes/PHPExcel/IOFactory.php";
                $objPHPExcel = PHPExcel_IOFactory::load("$folder/$file");
				
				//$sqlselectfee="SELECT * FROM essort_staff_salary WHERE emp_id='".."' AND salary_month='".."' ";
                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $array = array();
                    $select = mysql_query("SELECT emp_id FROM essort_user_header");
                    while ($rowdata = mysql_fetch_array($select)) {
                        $array[] = $rowdata['emp_id'];
                    }
                    
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $emp_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $amount = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        if (in_array($emp_id, $array) == 0) {
                            /*echo "<script>alert('Invalid user id');</script>";*/
                            return 2;
                        }
                        else{
						
							$sqlselectsal=mysql_num_rows(mysql_query("SELECT * FROM essort_staff_salary WHERE emp_id='".$emp_id."' AND salary_month='".$month."'"));
							if($sqlselectsal>0)
							{

							}
							else
							{
								$sql = mysql_query("INSERT INTO essort_staff_salary (emp_id, salary_year,salary_month,salary_amount,salary_status) VALUES ('" . $emp_id . "','" . $year . "','" . $month . "','" . $amount . "','Pending')");
							}

                        }

                        }
                    }
                    //unlink($folder.$file);
                    if ($sql == true) {
                        return 1;
                    }
                }
            }
            /*if ($_FILES["sal_file"]["size"] > 0) {
                $file = fopen($filename, "r");
                while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {

                    $sql = mysql_query("INSERT INTO essort_staff_salary (emp_id, salary_year,salary_month,salary_amount,salary_status) VALUES ('" . $emapData[0] . "','" . $year . "','" . $month . "','" . $emapData[1] . "','Pending')");
                    if (!$sql) {
                        echo "<script type=\"text/javascript\">
									alert(\"Invalid File:Please Upload CSV File.\");
									window.location = \"index.php\"
								</script>";

                    }

                }

            }
            fclose($file);*/
            /*if ($sql == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }*/

    }

    ###################################################################################################################
    function STUREGISTRATION()
    {
        if (isset($_REQUEST['first_name'])) {

            $first_name = $_POST["first_name"];
            $middle_name = $_POST["middle_name"];
            $last_name = $_POST["last_name"];
            $dob = $_POST["dob"];
            $email = $_POST["email"];
            $gender = $_POST["gender"];
            $file = $_FILES['image']['name'];
            $tmp_file = $_FILES['image']['tmp_name'];
            $folder = "../../" . $_SESSION['USER']['DB_NAME'] . "/uploads/student/";
            $birth_place = $_POST["birth_place"];
            $class = $_POST["class"];
            $religion = $_POST["religion"];
            $father_email = $_POST["father_email"];
            $father_age = $_POST["father_age"];
            $father_qualification = $_POST["father_qualification"];
            $father_occupation = $_POST["father_occupation"];
            $father_designation = $_POST["father_designation"];
            $father_organization = $_POST["father_organization"];
            $off_address = $_POST["off_address"];
            $father_area = $_POST["father_area"];
            $off_city = $_POST["off_city"];
            $off_state = $_POST["off_state"];
            $off_time = $_POST["off_time"];
            $f_office_contact = $_POST["f_office_contact"];
            $f_monthly_income = $_POST["f_monthly_income"];
            $f_role = $_POST["f_role"];
            $f_primary_contact = $_POST["f_primary_contact"];
            $f_file = $_FILES['f_image']['name'];
            $f_tmp_file = $_FILES['f_image']['tmp_name'];
            $father_tongue = $_POST["father_tongue"];
            $f_alt_contact = $_POST["f_alt_contact"];

            $m_email = $_POST["m_email"];
            $m_age = $_POST["m_age"];
            $m_qualification = $_POST["m_qualification"];
            $m_occupation = $_POST["m_occupation"];
            $m_designation = $_POST["m_designation"];
            $m_organization = $_POST["m_org"];
            $m_ofc_add = $_POST["m_ofc_add"];
            $mother_area = $_POST["mother_area"];
            $off_m_city = $_POST["off_m_city"];
            $off_m_state = $_POST["off_m_state"];
            $m_ofc_time = $_POST["m_ofc_time"];
            $m_ofc_contact = $_POST["m_ofc_contact"];
            $m_monthly_income = $_POST["m_monthly_income"];
            $m_role = $_POST["m_ofc_role"];
            $m_tongue = $_POST["m_tongue"];
            $m_pri_conact = $_POST["m_pri_conact"];
            $m_file = $_FILES['m_image']['name'];
            $m_tmp_file = $_FILES['m_image']['tmp_name'];
            $m_primary_contact = $_POST["m_pri_conact"];
            $m_alt_contact = $_POST["m_alt_contact"];

            $g_email = $_POST['guardian_email'];
            $g_age = $_POST['guardian_age'];
            $g_qualification = $_POST['guardian_qualification'];
            $g_occupation = $_POST['guardian_occupation'];
            $g_designation = $_POST['guardian_designation'];
            $g_org = $_POST['guardian_org'];
            $g_ofc_add = $_POST['guardian_ofc_add'];
            $g_ofc_area = $_POST['guardian_area'];
            $g_off_city = $_POST['off_guardian_city'];
            $g_off_state = $_POST['off_guardian_state'];
            $g_ofc_time = $_POST['guardian_ofc_time'];
            $g_ofc_contact = $_POST['guardian_ofc_contact'];
            $g_monthly_income = $_POST['guardian_monthly_income'];
            $g_ofc_role = $_POST['guardian_ofc_role'];
            $g_tongue = $_POST['guardian_tongue'];
            $g_pri_conact = $_POST['guardian_pri_conact'];
            $g_alt_conact = $_POST['guardian_alt_contact'];


            $r_local_addr = $_POST["r_local_addr"];
            $r_area = $_POST["r_area"];
            $r_city = $_POST["r_city"];
            $r_state = $_POST["r_state"];
            $r_pin = $_POST["r_pin"];
            $r_country = $_POST["r_country"];
            $r_contact = $_POST["r_contact"];
            $c_local_addr = $_POST["c_local_addr"];
            $c_area = $_POST["c_area"];
            $c_city = $_POST["c_city"];
            $c_state = $_POST["c_state"];
            $c_pin = $_POST["c_pin"];
            $c_countryt = $_POST["c_country"];
            $c_contact = $_POST["c_contact"];
            $blood_group = $_POST["blood_group"];
            $height = $_POST["height"];
            $weight = $_POST["weight"];
            $alergy = $_POST["alergy"];
            $illness = $_POST["illness"];
            $eme_treat = $_POST["eme_treat"];
            $medication = $_POST["medication"];

            //INSERT PARENT DATA
            move_uploaded_file($tmp_file, $folder . $file);
            move_uploaded_file($f_tmp_file, $folder . $f_file);
            move_uploaded_file($m_tmp_file, $folder . $m_file);
            $sql = mysql_query("INSERT INTO essort_application_header SET usr_fname='" . $first_name . "',
                usr_mname='" . $middle_name . "',usr_lname='" . $last_name . "',usr_email='" . $email . "',
                usr_dob='" . $dob . "',usr_birth_place='" . $birth_place . "',usr_class_id='" . $class . "',usr_gender='" . $gender . "',
                usr_religion='" . $religion . "',usr_photo='" . $file . "',usr_present_school='',usr_mother_tounge='" . $m_tongue . "',

                user_resident_local_address='" . $r_local_addr . "',user_resident_area_address='" . $r_area . "',
                                                                user_resident_city='" . $r_city . "',user_resident_state='" . $r_state . "',user_resident_pin='" . $r_pin . "',
                                                user_resident_country='" . $r_country . "',user_resident_contact_no='" . $r_contact . "',user_comm_local_address='" . $c_local_addr . "',
                                                                user_comm_area_address='" . $c_area . "',user_comm_city='" . $c_city . "',user_comm_state='" . $c_state . "',
                                                                user_comm_pin='" . $c_pin . "',user_comm_country='" . $c_countryt . "',user_comm_contact_no='" . $c_contact . "',

                user_blood_group='" . $blood_group . "',user_height='" . $height . "',user_weight='" . $weight . "',
                user_allergies='" . $alergy . "',user_Illness='" . $illness . "',
                user_emergency_treatment='" . $eme_treat . "',
                user_medication='" . $medication . "'");
            $usr_id = mysql_insert_id();

            $paddedNum = sprintf("%06d", $usr_id);
            $roleode = "APP";
            $usr_application_no = $roleode . "" . $paddedNum;

            $sql = mysql_query("UPDATE essort_application_header SET usr_application_no='" . $usr_application_no . "' WHERE
                usr_application_id='" . $usr_id . "'");


            //INSERT FATHER INFO
            $sqlfpar = mysql_query("INSERT INTO essort_application_family_info SET usr_application_id='" . $usr_id . "',
                usr_relation='father',usr_r_initial='" . $_POST["father_initial"] . "',usr_r_name='" . $_POST["father_first_name"] . "',
                usr_r_mname='" . $_POST["father_middle_name"] . "',usr_r_lname='" . $_POST["father_last_name"] . "',
                usr_r_age='" . $father_age . "',usr_r_qualification='" . $father_qualification . "',usr_r_occupatrion='" . $father_occupation . "',
                usr_r_designation='" . $father_designation . "',usr_r_org_name='" . $father_organization . "',
                usr_r_office_address='" . $off_address . "',usr_r_offc_area='" . $father_area . "',usr_r_offc_city='" . $off_city . "',
                                                                usr_r_offc_state='" . $off_state . "',usr_r_office_timings='" . $off_time . "',usr_r_email='" . $father_email . "',
                usr_r_office_contact_no='" . $f_office_contact . "',usr_r_contact_no='" . $f_primary_contact . "',
                usr_r_monthly_income='" . $f_monthly_income . "',usr_r_primary_contact='" . $f_primary_contact . "',
                usr_r_alter_contact='" . $f_alt_contact . "',usr_r_mother_tounge='" . $father_tongue . "',
                usr_r_role='" . $f_role . "', usr_r_image='" . $f_file . "'");
            //INSERT MOTHER INFO
            $sqlmpar = mysql_query("INSERT INTO essort_application_family_info SET usr_application_id='" . $usr_id . "',
                usr_relation='mother',usr_r_initial='" . $_POST["mother_initial"] . "',usr_r_name='" . $_POST["mother_fname"] . "',
                                                                usr_r_mname='" . $_POST["mother_mname"] . "',usr_r_lname='" . $_POST["mother_lname"] . "',
                usr_r_age='" . $m_age . "',usr_r_qualification='" . $m_qualification . "',usr_r_occupatrion='" . $m_occupation . "',
                usr_r_designation='" . $m_designation . "',usr_r_org_name='" . $m_organization . "',usr_r_office_address='" . $m_ofc_add . "',
                usr_r_offc_area='" . $mother_area . "',     usr_r_offc_city='" . $off_m_city . "',usr_r_offc_state='" . $off_m_state . "',
                usr_r_office_timings='" . $m_ofc_time . "',usr_r_email='" . $m_email . "',usr_r_office_contact_no='" . $m_ofc_contact . "',
                usr_r_contact_no='" . $m_primary_contact . "',usr_r_monthly_income='" . $m_monthly_income . "',
                usr_r_mother_tounge='" . $m_tongue . "',usr_r_primary_contact='" . $m_pri_conact . "',usr_r_alter_contact='" . $m_alt_contact . "',
                usr_r_role='" . $m_role . "', usr_r_image='" . $m_file . "'");
            //INSERT GUARDIAN INFO
            $sqlgpar = mysql_query("INSERT INTO essort_application_family_info SET usr_application_id='" . $usr_id . "',
                usr_relation='guardian',usr_r_initial='" . $_POST["guardian_initial"] . "',usr_r_name='" . $_POST["guardian_fname"] . "',
                                                                usr_r_mname='" . $_POST["guardian_mname"] . "',usr_r_lname='" . $_POST["guardian_lname"] . "',
                usr_r_age='" . $g_age . "',usr_r_qualification='" . $g_qualification . "',usr_r_occupatrion='" . $g_occupation . "',
                usr_r_designation='" . $g_designation . "',usr_r_org_name='" . $g_org . "',usr_r_office_address='" . $g_ofc_add . "',
                usr_r_offc_area='" . $g_ofc_area . "',usr_r_offc_city='" . $g_off_city . "',usr_r_offc_state='" . $g_off_state . "',
                usr_r_office_timings='" . $g_ofc_time . "',usr_r_email='" . $g_email . "',usr_r_office_contact_no='" . $g_ofc_contact . "',
                usr_r_contact_no='" . $g_pri_conact . "',usr_r_monthly_income='" . $g_monthly_income . "',
                usr_r_mother_tounge='" . $g_tongue . "',usr_r_primary_contact='" . $g_pri_conact . "',usr_r_alter_contact='" . $g_alt_conact . "',
                usr_r_role='" . $g_ofc_role . "', usr_r_image=''");
            if ($sql == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }
    }


    ###################################################################################################################
    function STUUPDATEDETAILS()
    {
        if (isset($_REQUEST['updatestu'])) {
            $usr_id = $_REQUEST['stu_id'];
            $first_name = $_POST["first_name"];
            $middle_name = $_POST["middle_name"];
            $last_name = $_POST["last_name"];
            $dob = $_POST["dob"];
            $email = $_POST["email"];
            $gender = $_POST["gender"];
            $file = $_FILES['image']['name'];
            if($file == ''){
                $file =  $_REQUEST['old_stu_img'];
            }
            $tmp_file = $_FILES['image']['tmp_name'];
            $folder = "../../" . $_SESSION['USER']['DB_NAME'] . "/uploads/student/";
            $birth_place = $_POST["birth_place"];
            $class = $_POST["class"];
            $religion = $_POST["religion"];
            $father_email = $_POST["father_email"];
            $father_age = $_POST["father_age"];
            $father_qualification = $_POST["father_qualification"];
            $father_occupation = $_POST["father_occupation"];
            $father_designation = $_POST["father_designation"];
            $father_organization = $_POST["father_organization"];
            $off_address = $_POST["off_address"];
            $father_area = $_POST["father_area"];
            $off_city = $_POST["off_city"];
            $off_state = $_POST["off_state"];
            $off_time = $_POST["off_time"];
            $f_office_contact = $_POST["f_office_contact"];
            $f_monthly_income = $_POST["f_monthly_income"];
            $f_role = $_POST["f_role"];
            $f_primary_contact = $_POST["f_primary_contact"];
            $f_file = $_FILES['f_image']['name'];
            $f_tmp_file = $_FILES['f_image']['tmp_name'];
            if($f_file == ''){
                $f_file =  $_REQUEST['old_fath_img'];
            }
            $father_tongue = $_POST["father_tongue"];
            $f_alt_contact = $_POST["f_alt_contact"];

            $m_email = $_POST["m_email"];
            $m_age = $_POST["m_age"];
            $m_qualification = $_POST["m_qualification"];
            $m_occupation = $_POST["m_occupation"];
            $m_designation = $_POST["m_designation"];
            $m_organization = $_POST["m_org"];
            $m_ofc_add = $_POST["m_ofc_add"];
            $mother_area = $_POST["mother_area"];
            $off_m_city = $_POST["off_m_city"];
            $off_m_state = $_POST["off_m_state"];
            $m_ofc_time = $_POST["m_ofc_time"];
            $m_ofc_contact = $_POST["m_ofc_contact"];
            $m_monthly_income = $_POST["m_monthly_income"];
            $m_role = $_POST["m_ofc_role"];
            $m_tongue = $_POST["m_tongue"];
            $m_pri_conact = $_POST["m_pri_conact"];
            $m_file = $_FILES['m_image']['name'];
            if($m_file == ''){
                $m_file =  $_REQUEST['old_moth_img'];
            }
            $m_tmp_file = $_FILES['m_image']['tmp_name'];
            $m_primary_contact = $_POST["m_pri_conact"];
            $m_alt_contact = $_POST["m_alt_contact"];

            $g_email = $_POST['guardian_email'];
            $g_age = $_POST['guardian_age'];
            $g_qualification = $_POST['guardian_qualification'];
            $g_occupation = $_POST['guardian_occupation'];
            $g_designation = $_POST['guardian_designation'];
            $g_org = $_POST['guardian_org'];
            $g_ofc_add = $_POST['guardian_ofc_add'];
            $g_ofc_area = $_POST['guardian_area'];
            $g_off_city = $_POST['off_guardian_city'];
            $g_off_state = $_POST['off_guardian_state'];
            $g_ofc_time = $_POST['guardian_ofc_time'];
            $g_ofc_contact = $_POST['guardian_ofc_contact'];
            $g_monthly_income = $_POST['guardian_monthly_income'];
            $g_ofc_role = $_POST['guardian_ofc_role'];
            $g_tongue = $_POST['guardian_tongue'];
            $g_pri_conact = $_POST['guardian_pri_conact'];
            $g_alt_conact = $_POST['guardian_alt_contact'];


            $r_local_addr = $_POST["r_local_addr"];
            $r_area = $_POST["r_area"];
            $r_city = $_POST["r_city"];
            $r_state = $_POST["r_state"];
            $r_pin = $_POST["r_pin"];
            $r_country = $_POST["r_country"];
            $r_contact = $_POST["r_contact"];
            $c_local_addr = $_POST["c_local_addr"];
            $c_area = $_POST["c_area"];
            $c_city = $_POST["c_city"];
            $c_state = $_POST["c_state"];
            $c_pin = $_POST["c_pin"];
            $c_countryt = $_POST["c_country"];
            $c_contact = $_POST["c_contact"];
            $blood_group = $_POST["blood_group"];
            $height = $_POST["height"];
            $weight = $_POST["weight"];
            $alergy = $_POST["alergy"];
            $illness = $_POST["illness"];
            $eme_treat = $_POST["eme_treat"];
            $medication = $_POST["medication"];

            //INSERT PARENT DATA
            move_uploaded_file($tmp_file, $folder . $file);
            move_uploaded_file($f_tmp_file, $folder . $f_file);
            move_uploaded_file($m_tmp_file, $folder . $m_file);
            $sql = mysql_query("UPDATE essort_application_header SET usr_fname='" . $first_name . "',
                usr_mname='" . $middle_name . "',usr_lname='" . $last_name . "',usr_email='" . $email . "',
                usr_dob='" . $dob . "',usr_birth_place='" . $birth_place . "',usr_class_id='" . $class . "',
                usr_gender='" .$gender . "',  usr_religion='" . $religion . "',usr_photo='" . $file . "',usr_present_school='',
                usr_mother_tounge='" . $m_tongue . "', user_resident_local_address='" . $r_local_addr . "',
                user_resident_area_address='" . $r_area ."', user_resident_city='" . $r_city . "',
                user_resident_state='".$r_state."',user_resident_pin='".$r_pin."',user_resident_country='".$r_country . "',                      user_resident_contact_no='" . $r_contact . "',user_comm_local_address='" . $c_local_addr . "',
                user_comm_area_address='" . $c_area . "',user_comm_city='" . $c_city . "',user_comm_state='" . $c_state . "',
                user_comm_pin='" . $c_pin . "',user_comm_country='" . $c_countryt . "',user_comm_contact_no='" . $c_contact . "',
                user_blood_group='" . $blood_group . "',user_height='" . $height . "',user_weight='" . $weight . "',
                user_allergies='" . $alergy . "',user_Illness='" . $illness . "', user_emergency_treatment='" . $eme_treat . "',
                user_medication='" . $medication . "' WHERE usr_application_id = '".$usr_id."'");


            //INSERT FATHER INFO
            $sqlfpar = mysql_query("UPDATE essort_application_family_info SET usr_application_id='" . $usr_id . "',
                usr_relation='father',usr_r_initial='" . $_POST["father_initial"] . "',
                usr_r_name='" . $_POST["father_first_name"] . "',usr_r_mname='" . $_POST["father_middle_name"] . "',
                usr_r_lname='" . $_POST["father_last_name"] . "', usr_r_age='" . $father_age . "',
                usr_r_qualification='" . $father_qualification . "', usr_r_occupatrion='" . $father_occupation . "',
                usr_r_designation='" . $father_designation . "',usr_r_org_name='" . $father_organization . "',
                usr_r_office_address='" . $off_address . "',usr_r_offc_area='" . $father_area . "',
                usr_r_offc_city='" . $off_city . "',  usr_r_offc_state='" . $off_state . "',
                usr_r_office_timings='" . $off_time . "',usr_r_email='" . $father_email . "',
                usr_r_office_contact_no='" . $f_office_contact . "',usr_r_contact_no='" . $f_primary_contact . "',
                usr_r_monthly_income='" . $f_monthly_income . "',usr_r_primary_contact='" . $f_primary_contact . "',
                usr_r_alter_contact='" . $f_alt_contact . "',usr_r_mother_tounge='" . $father_tongue . "',
                usr_r_role='" . $f_role . "', usr_r_image='" . $f_file . "' WHERE usr_application_id = '".$usr_id."' AND
                usr_relation='father'");
            //INSERT MOTHER INFO
            $sqlmpar = mysql_query("UPDATE essort_application_family_info SET usr_application_id='" . $usr_id . "',
                usr_relation='mother',usr_r_initial='" . $_POST["mother_initial"] . "',usr_r_name='" . $_POST["mother_fname"] . "',
                usr_r_mname='" . $_POST["mother_mname"] . "',usr_r_lname='" . $_POST["mother_lname"] . "',
                usr_r_age='" . $m_age . "',usr_r_qualification='" . $m_qualification . "',
                usr_r_occupatrion='" . $m_occupation . "', usr_r_designation='" . $m_designation . "',
                usr_r_org_name='" . $m_organization . "',usr_r_office_address='" . $m_ofc_add . "',
                usr_r_offc_area='" . $mother_area . "',     usr_r_offc_city='" . $off_m_city . "',
                usr_r_offc_state='" . $off_m_state . "', usr_r_office_timings='" . $m_ofc_time . "',
                usr_r_email='" . $m_email . "',usr_r_office_contact_no='" . $m_ofc_contact . "',
                usr_r_contact_no='" . $m_primary_contact . "',usr_r_monthly_income='" . $m_monthly_income . "',
                usr_r_mother_tounge='" . $m_tongue . "',usr_r_primary_contact='" . $m_pri_conact . "',
                usr_r_alter_contact='" . $m_alt_contact . "', usr_r_role='" . $m_role . "', usr_r_image='" . $m_file . "'
                WHERE usr_application_id = '".$usr_id."' AND usr_relation='mother'");
            //INSERT GUARDIAN INFO
            $select = mysql_query("SELECT usr_relation FROM essort_application_family_info WHERE usr_application_id = '".$usr_id."'");
            $array = array();
            while($row = mysql_fetch_array($select)){
                $array[] =$row['usr_relation'];
            }
            if(in_array('guardian',$array)){
                $sqlgpar = mysql_query("UPDATE essort_application_family_info SET usr_application_id='" . $usr_id . "',
                usr_relation='guardian',usr_r_initial='" . $_POST["guardian_initial"] . "',
                usr_r_name='" . $_POST["guardian_fname"] . "',usr_r_mname='" . $_POST["guardian_mname"] . "',
                usr_r_lname='" . $_POST["guardian_lname"] . "', usr_r_age='" . $g_age . "',
                usr_r_qualification='" . $g_qualification . "',usr_r_occupatrion='" . $g_occupation . "',
                usr_r_designation='" . $g_designation . "',usr_r_org_name='" . $g_org . "',
                usr_r_office_address='" . $g_ofc_add . "', usr_r_offc_area='" . $g_ofc_area . "',
                usr_r_offc_city='" . $g_off_city . "', usr_r_offc_state='" . $g_off_state . "',
                usr_r_office_timings='" . $g_ofc_time . "',usr_r_email='" . $g_email . "',
                usr_r_office_contact_no='" . $g_ofc_contact . "', usr_r_contact_no='" . $g_pri_conact . "',
                usr_r_monthly_income='" . $g_monthly_income . "', usr_r_mother_tounge='" . $g_tongue . "',
                usr_r_primary_contact='" . $g_pri_conact . "',usr_r_alter_contact='" . $g_alt_conact . "',
                usr_r_role='" . $g_ofc_role . "' WHERE usr_application_id = '".$usr_id."' AND usr_relation='guardian'");
            }
            else{
                $sqlgpar = mysql_query("INSERT INTO essort_application_family_info SET usr_application_id='" . $usr_id . "',
                usr_relation='guardian',usr_r_initial='" . $_POST["guardian_initial"] . "',
                usr_r_name='" . $_POST["guardian_fname"] . "',usr_r_mname='" . $_POST["guardian_mname"] . "',
                usr_r_lname='" . $_POST["guardian_lname"] . "', usr_r_age='" . $g_age . "',
                usr_r_qualification='" . $g_qualification . "',usr_r_occupatrion='" . $g_occupation . "',
                usr_r_designation='" . $g_designation . "',usr_r_org_name='" . $g_org . "',
                usr_r_office_address='" . $g_ofc_add . "', usr_r_offc_area='" . $g_ofc_area . "',
                usr_r_offc_city='" . $g_off_city . "', usr_r_offc_state='" . $g_off_state . "',
                usr_r_office_timings='" . $g_ofc_time . "',usr_r_email='" . $g_email . "',
                usr_r_office_contact_no='" . $g_ofc_contact . "', usr_r_contact_no='" . $g_pri_conact . "',
                usr_r_monthly_income='" . $g_monthly_income . "', usr_r_mother_tounge='" . $g_tongue . "',
                usr_r_primary_contact='" . $g_pri_conact . "',usr_r_alter_contact='" . $g_alt_conact . "',
                usr_r_role='" . $g_ofc_role . "'");
            }

            if ($sql == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }
    }

    ###################################################################################################################
    function OLDSTUREGISTRATION()
    {
        if (isset($_REQUEST['first_name'])) {

            $first_name = $_POST["first_name"];
            $middle_name = $_POST["middle_name"];
            $last_name = $_POST["last_name"];
            $dob = $_POST["dob"];
            $email = $_POST["email"];
            $gender = $_POST["gender"];
            $birth_place = $_POST["birth_place"];
            $class = $_POST["class"];
            $religion = $_POST["religion"];
            $father_name = $_POST["father_initial"] . "" . $_POST["father_name"];
            $father_email = $_POST["father_email"];
            $father_age = $_POST["father_age"];
            $father_occupation = $_POST["father_occupation"];
            $father_designation = $_POST["father_designation"];
            $father_organization = $_POST["father_organization"];
            $off_address = $_POST["off_address"];
            $off_time = $_POST["off_time"];
            $f_office_contact = $_POST["f_office_contact"];
            $f_monthly_income = $_POST["f_monthly_income"];
            $f_role = $_POST["f_role"];
            $f_primary_contact = $_POST["f_primary_contact"];
            $father_tongue = $_POST["father_tongue"];
            $f_alt_contact = $_POST["f_alt_contact"];
            $mother_initial = $_POST["mother_initial"];
            $mother_name = $_POST["mother_name"];
            $m_email = $_POST["m_email"];
            $m_age = $_POST["m_age"];
            $m_occupation = $_POST["m_occupation"];
            $m_designation = $_POST["m_designation"];
            $m_organization = $_POST["m_org"];
            $m_ofc_add = $_POST["m_ofc_add"];
            $m_ofc_time = $_POST["m_ofc_time"];
            $m_ofc_contact = $_POST["m_ofc_contact"];
            $m_monthly_income = $_POST["m_monthly_income"];
            $m_role = $_POST["m_ofc_role"];
            $m_tongue = $_POST["m_tongue"];
            $m_pri_conact = $_POST["m_pri_conact"];
            $m_primary_contact = $_POST["m_pri_conact"];
            $m_alt_contact = $_POST["m_alt_contact"];
            $blood_group = $_POST["blood_group"];
            $alergy = $_POST["alergy"];
            $illness = $_POST["illness"];
            $eme_treat = $_POST["eme_treat"];
            $medication = $_POST["medication"];

            //INSERT PARENT DATA

            $sql = mysql_query("INSERT INTO essort_application_header SET usr_fname='" . $first_name . "',usr_mname='" . $middle_name . "',usr_lname='" . $last_name . "',usr_email='" . $email . "',usr_dob='" . $dob . "',usr_birth_place='" . $birth_place . "',usr_class_id='" . $class . "',usr_gender='" . $gender . "',usr_religion='" . $religion . "',usr_present_school='',user_blood_group='" . $blood_group . "',user_allergies='" . $alergy . "',user_Illness='" . $illness . "',user_emergency_treatment='" . $eme_treat . "',user_medication='" . $medication . "'");
            $usr_id = mysql_insert_id();

            $paddedNum = sprintf("%06d", $usr_id);
            $roleode = "APP";
            $usr_application_no = $roleode . "" . $paddedNum;

            $sql = mysql_query("UPDATE essort_application_header SET usr_application_no='" . $usr_application_no . "' WHERE usr_application_id='" . $usr_id . "'");


            //INSERT FATHER INFO
            $sqlfpar = mysql_query("INSERT INTO essort_application_family_info SET usr_application_id='" . $usr_id . "',usr_relation='father',usr_r_initial='" . $_POST["father_initial"] . "',usr_r_name='" . $_POST["father_name"] . "',usr_r_age='" . $father_age . "',usr_r_qualification='',usr_r_occupatrion='" . $father_occupation . "',usr_r_designation='" . $father_designation . "',usr_r_org_name='" . $father_organization . "',usr_r_office_address='" . $off_address . "',usr_r_office_timings='" . $off_time . "',usr_r_email='" . $father_email . "',usr_r_office_contact_no='" . $f_office_contact . "',usr_r_contact_no='" . $f_primary_contact . "',usr_r_monthly_income='" . $f_monthly_income . "',usr_r_primary_contact='" . $f_primary_contact . "',usr_r_role='" . $f_role . "'");
            //INSERT MOTHER INFO
            $sqlmpar = mysql_query("INSERT INTO essort_application_family_info SET usr_application_id='" . $usr_id . "',usr_relation='mother',usr_r_initial='" . $_POST["mother_initial"] . "',usr_r_name='" . $_POST["mother_name"] . "',usr_r_age='" . $m_age . "',usr_r_qualification='',usr_r_occupatrion='" . $m_occupation . "',usr_r_designation='" . $m_designation . "',usr_r_org_name='" . $m_organization . "',usr_r_office_address='" . $m_ofc_add . "',usr_r_office_timings='" . $m_ofc_time . "',usr_r_email='" . $m_email . "',usr_r_office_contact_no='" . $m_ofc_contact . "',usr_r_contact_no='" . $m_primary_contact . "',usr_r_monthly_income='" . $m_monthly_income . "',usr_r_primary_contact='" . $m_pri_conact . "',usr_r_role='" . $m_role . "'");
            if ($sql == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }

    }

    ###################################################################################################################
    function UPDATEFEEELEMENT()
    {
        if (isset($_REQUEST['fee_id'])) {

            $fee_id = $_POST["fee_id"];
            $txtElement = $_POST["txtElement"];
            $sqlupdate = mysql_query("UPDATE essort_fee_detail SET fee_elem_name='" . $txtElement . "' WHERE fee_id='" . $fee_id . "'");
            if ($sqlupdate == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }

    }

    ###################################################################################################################
    function getPrincipleProfile()
    {
        $array = array();
        $query = mysql_query("SELECT * FROM essort_user_header uh
             INNER JOIN essort_user_details ud
             ON
             uh.usr_id = ud.usr_id
             WHERE uh.usr_role = 'Principal'");
        if ($query) {
            $result = mysql_fetch_assoc($query);
            $array[] = $result;
        }
        return $array;
    }
    #####################################FOR MARK HOLIDAY################################################
    function markHoliday()
    {
        $markholidays = mysql_query("SELECT * FROM essort_holidays WHERE DATE_FORMAT(off_day,'%Y') = '" . date('Y') . "' And status='1'");
        if (mysql_num_rows($markholidays) > 0) {
            return $markholidays;
        }
    }

    ###################################################################################################################
    function getEventsNotification()
    {
        $sql = mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM
            essort_holidays WHERE occassion_type IN('Event','Holiday') AND status = 1
            AND DATE_FORMAT( `off_day` , '%Y-%m-%d' ) >= '" . date('Y-m-d') . "' GROUP BY occassion ORDER BY off_day ASC LIMIT 5") OR DIE(mysql_error());
        if (mysql_num_rows($sql) > 0) {
            return $sql;
        } else {
            return 0;
        }
    }
    ########################################SearchAllEventsNotification######################################################
    function SearchAllEventsNotification()
    {
        $sql = mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM
            essort_holidays WHERE occassion_type IN('Event','Holiday') AND status = 1 GROUP BY occassion") OR DIE(mysql_error());
        if (mysql_num_rows($sql) > 0) {
            return $sql;
        } else {
            return 0;
        }
    }
    ###################################################################################################################
    function getHolidayNotification()
    {
        $sql = mysql_query("SELECT *, DATE_FORMAT(MAX(off_day),'%d %b %Y') as fromDate, DATE_FORMAT(MAX(off_day),'%d %b %Y') as toDate
            FROM essort_holidays  WHERE occassion_type='Holiday' GROUP BY occassion") OR DIE(mysql_error());
        if (mysql_num_rows($sql) > 0) {
            return $sql;
        } else {
            return 0;
        }
    }

    ###################################################################################################################
    function getCircularActivities()
    {
		$select = mysql_query("SELECT * FROM essort_circular_activities WHERE STR_TO_DATE(valid_till, '%Y-%m-%d')>='" . date('Y-m-d') . "'");
        if (mysql_num_rows($select) > 0) {
            return $select;
        } else {
            return 0;
        }

    }

    ###################################################################################################################
    function getStaffonLeaveToday()
    {
        $sqlleave = mysql_query("SELECT *,leave_date as maxdate,leave_date as mindate,'USERFNAME','USERLNAME' FROM essort_teacher_leave_info WHERE leave_date='" . date('Y-m-d') . "' AND leave_status = 'Confirmed'");
        
        if (mysql_num_rows($sqlleave) > 0) {
            return $sqlleave;
        } else {
            return 0;
        }
    }

    ###################################################################################################################
    function getStaffonLeave()
    {
        //$sqlleave=mysql_query("SELECT *,leave_date as maxdate,leave_date as mindate,'USERFNAME','USERLNAME' FROM essort_teacher_leave_info WHERE leave_status='Pending'");
        $sqlleave = mysql_query("SELECT *,MAX(leave_date) as maxdate,MIN(leave_date) as mindate,'USERFNAME','USERLNAME','usr_role' FROM essort_teacher_leave_info GROUP BY submit_date,usr_id");
        if (mysql_num_rows($sqlleave) > 0) {
            return $sqlleave;
        } else {
            return 0;
        }
    }

    ###################################################################################################################
    function APPROVELEAVE()
    {
        if (isset($_REQUEST['usr_id'])) {
            $usr_id = $_POST["usr_id"];
            $fromd = $_POST["from_date"];
            $submit_date = $_POST["submit_date"];
            $date_to = $_POST["to_date"];
            $daylen = 60 * 60 * 24;
            $days = (strtotime($date_to) - strtotime($fromd)) / $daylen + 1;
            ?>

            <?php
            for ($i = 1; $i <= $days; $i++) {

                $sqlupdate = mysql_query("update  essort_teacher_leave_info set leave_status='Confirmed' WHERE
                    leave_date = '" . $fromd . "' AND submit_date='" . $submit_date . "' AND usr_id='".$usr_id."'");
                /*echo "update  essort_teacher_leave_info set leave_status='Confirmed' WHERE
                    leave_date = '" . $fromd . "' AND submit_date='" . $submit_date . "' AND usr_id='".$usr_id."'";*/
                $fromd = strtotime("+1 day", strtotime($fromd));
                $fromd = date("Y-m-d", $fromd);
            }
            return 1;

        } else {
            return 2;
        }

    }

    ###################################################################################################################
    function SUBMITMSG()
    {
        if (isset($_REQUEST['role'])) {
            $role_from = $_POST["role_from"];
            $role_from_id = $_POST["role_from_id"];
            $subject = $_POST["subject"];
            $message = $_POST["message"];
            $rslt = mysql_query("SELECT * FROM essort_user_header WHERE usr_role='" . $role . "'");
            $arr = array();
            while ($row = mysql_fetch_array($rslt)) {
                $arr[] = $row;
            }
            print_r($arr);
            if ($sqlupdate == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }

    }

    #####################################################################################################################
    function CHANGEPASSWORD()
    {
        if (isset($_POST['n_pass'])) {
            if ($_POST['n_pass'] != $_POST['r_n_pass']) {
                return 2;
            } else {
                $sql = "UPDATE essort_user_header
                SET
                    `password` = '" . md5($_POST['n_pass']) . "'
                WHERE
                    `usr_id` = '" . $_SESSION['USER']['USER_ID'] . "'";
                if (mysql_query($sql) == true) {
                    return 1;
                } else {
                    echo mysql_error();
                }
            }

        }
    }

    #########################LAST 5 MONTH SALARY#########################################
    function LAST5MONTHSALARY()
    {
        $sqlstfatted = mysql_query("SELECT salary_month AS m,salary_year as y,'NO_OF_STAFF',salary_amount
		FROM essort_staff_salary
		GROUP BY y, m");
        $saldata = array();
        while ($rowstaff = mysql_fetch_array($sqlstfatted)) {
            $sqlusr = mysql_query("SELECT DISTINCT emp_id FROM essort_staff_salary WHERE salary_month='" . $rowstaff['m'] . "' AND salary_year='" . $rowstaff['y'] . "'");
            $no_of_staff = mysql_num_rows($sqlusr);
            $sqlusrsum = mysql_fetch_array(mysql_query("SELECT SUM( salary_amount ) AS value_sum
				FROM essort_staff_salary
				WHERE salary_month ='" . $rowstaff['m'] . "' AND salary_year='" . $rowstaff['y'] . "'"));
            $amount = $sqlusrsum['value_sum'];
            $rowstaff['NO_OF_STAFF'] = $no_of_staff;
            $rowstaff['salary_amount'] = $amount;
            $saldata[] = $rowstaff;
        }
        return $saldata;
    }

    ##################################################################
    function MONTHLYSALARY($staffname, $staffyear)
    {
        $sql = mysql_query("SELECT * FROM essort_staff_salary WHERE emp_id='" . $staffname . "' AND salary_year='" . $staffyear . "' GROUP BY salary_month");
        $salarray = array();
        $arraydata = '';
        $cond = '';
        while ($salary_month = mysql_fetch_array($sql)) {
            $sqlusrsum = mysql_fetch_array(mysql_query("SELECT salary_amount AS value_sum
				FROM essort_staff_salary
				WHERE salary_month ='" . $salary_month['salary_month'] . "' AND salary_year='" . $salary_month['salary_year'] . "' AND emp_id='EMP000002'"));
            $row['salary_amount'] = $sqlusrsum['value_sum'];
            $salarray[] = $salary_month;

        }

        return $salarray;

    }

    ##################################################################
    function ALLSTAFFWITHSALARY()
    {
        //ALL STAFF WITH ATTENDENCE
        $sqlnote = mysql_query("SELECT *,'att_in_time','attout_time','usr_salary','dept_name','sal_info_id','salary_status','att_status','att_id' FROM  essort_user_header WHERE usr_role IN ('Teacher')");
        $rowatt = array();
        while ($rownote = mysql_fetch_array($sqlnote)) {
            //salary
            $sqlsal = mysql_fetch_array(mysql_query("SELECT * FROM essort_user_details WHERE usr_id='" . $rownote['usr_id'] . "'"));
            $sqlhd = mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header WHERE usr_id='" . $rownote['usr_id'] . "'"));
            $sql = mysql_query("SELECT att_in_time,attout_time,att_status,attendence_id FROM essort_class_attendence WHERE stu_id='" . $rownote['att_ref_id'] . "' AND att_date='" . date('Y-m-d') . "'");
            $rowusr = mysql_fetch_array($sql);
            //SELECT SALARY
            $sqlsald = mysql_fetch_array(mysql_query("SELECT sal_info_id,salary_amount,salary_status FROM essort_staff_salary WHERE emp_id='" . $sqlhd['emp_id'] . "'"));
            $rownote['att_in_time'] = $rowusr['att_in_time'];
            $rownote['usr_salary'] = $sqlsald['salary_amount'];

            $rownote['dept_name'] = $sqlsal['dept_name'];
            $rownote['attout_time'] = $rowusr['attout_time'];
            $rownote['sal_info_id'] = $sqlsald['sal_info_id'];
            $rownote['salary_status'] = $sqlsald['salary_status'];
            $rownote['att_status'] = $rowusr['att_status'];
            $rownote['att_id'] = $rowusr['attendence_id'];
            $rowatt[] = $rownote;

        }
        return $rowatt;

    }

    ################################FOR STUDENTS#################################
    function ALLSTUWITHFEE($classess, $sec)
    {
        $cond = "";
        if ($classess != '') {
            if ($cond == '') {
                $cond .= "WHERE class_id='" . $classess . "'";
            } else {
                $cond .= "AND class_id='" . $classess . "'";
            }
        }
        if ($sec != '') {
            if ($cond == '') {
                $cond .= "WHERE sec_id='" . $sec . "'";
            } else {
                $cond .= "AND sec_id='" . $sec . "'";
            }
        }
        $stusql = mysql_query("SELECT *, att_ref_id,'USERFNAME','USERLNAME','att_status','att_intime','att_outtime' ,'app_no','att_id','amount','last_payment','last_date' FROM essort_user_relation " . $cond . "");
        $total_no_of_students = mysql_num_rows($stusql);
        $stuidarr = array();
        $stuatt = array();
        $amount = 0;
        $stuoption = '';
        $date = date('Y-m-d');
        $month = date("F", strtotime($date));
        while ($rowstu = mysql_fetch_array($stusql)) {
            //APPLICATION NO
            $resappno = mysql_fetch_array(mysql_query("SELECT emp_id FROM essort_user_header WHERE usr_id=(SELECT parent_id FROM essort_user_relation WHERE stu_id='" . $rowstu['stu_id'] . "' LIMIT 1)"));
            $stuusql = mysql_fetch_array(mysql_query("SELECT * FROM essort_application_header WHERE usr_application_id=(SELECT stu_id FROM essort_user_relation WHERE att_ref_id='" . $rowstu['att_ref_id'] . "' LIMIT 1) LIMIT 1"));
            $sqlatt = mysql_fetch_array(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='" . $rowstu['att_ref_id'] . "' AND att_date='" . date('Y-m-d') . "'"));
            //TOTAL FEE
            $sqltype = mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='" . $rowstu['class_id'] . "' AND sec_id='" . $rowstu['sec_id'] . "'");
            $amount = 0;
            while ($rowtype = mysql_fetch_array($sqltype)) {
                if ($rowtype['fee_elem_type'] == 'Monthly') {
                    $rowtype['fee_elem_amount'] = $rowtype['fee_elem_amount'] * 3;
                    $amount = $amount + $rowtype['fee_elem_amount'];
                } else {
                    $a = $month;
                    $montharr = explode(",", $rowtype['fee_elem_month']);
                    if (in_array($a, $montharr)) {
                        $amount = $amount + $rowtype['fee_elem_amount'];

                    }
                }

            }
            //last payment
            $sqllastpaymentsql = mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='" . $rowstu['stu_id'] . "' ORDER BY fee_created_on DESC LIMIT 1");
            $laspaynumrows = mysql_num_rows($sqllastpaymentsql);
            $sqllastpayment = mysql_fetch_array($sqllastpaymentsql);
            if ($laspaynumrows == 0) {
                $sqllastpayment['payment_amount_by_user'] = 0;
                $sqllastpayment['fee_created_on'] = '-';
            }

            $rowstu['USERFNAME'] = $stuusql['usr_fname'];
            $rowstu['ID'] = $stuusql['usr_application_id'];
            $rowstu['USERLNAME'] = $stuusql['usr_lname'];
            $rowstu['att_status'] = $sqlatt['att_status'];
            $rowstu['att_intime'] = $sqlatt['att_in_time'];
            $rowstu['att_id'] = $sqlatt['attendence_id'];
            $rowstu['att_outtime'] = $sqlatt['attout_time'];
            $rowstu['app_no'] = $resappno['emp_id'];
            $rowstu['amount'] = $amount - $sqllastpayment['payment_amount_by_user'];
            $rowstu['last_payment'] = $sqllastpayment['payment_amount_by_user'];
            $rowstu['last_date'] = $sqllastpayment['fee_created_on'];

            $stuoption .= '<option>' . $rowstu['USERFNAME'] . '</option>';
            $stuidarr[] = $rowstu;
        }
        return $stuidarr;

    }

    ################################FOR MESSAGE#################################
    function ADDMESSAGE()
    {
        if (isset($_POST['from_id'])) {
            $from_id = $_POST['from_id'];
            $from_role = $_POST['from_role'];
            $to_role = $_POST['to_role'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $file = $_FILES['attach']['name'];
            $tmp_file = $_FILES['attach']['tmp_name'];
            $folder = "../../" . $_SESSION['USER']['DB_NAME'] . "/uploads/msg/";
            if ($to_role == 'SAD') {
                $to_role_name = 'Admin';
            } else {
                $to_role_name = $to_role;

            }

            if ($to_role == 'Teacher') {
                $teacher_id = $_POST['teacher_id'];
                $sql = mysql_query("INSERT INTO essort_message_master
							(from_id,from_role,to_id,to_role,subject,message,attachment,date)
							values ('" . $from_id . "','" . $from_role . "','" . $teacher_id . "','" . $to_role_name . "','" . $subject . "','" . $message . "','" . $file . "',now())");

            } else if ($to_role == 'Parent') {
                $parent_id = $_POST['parent_id'];
				 $sql = mysql_query("INSERT INTO essort_message_master
							(from_id,from_role,to_id,to_role,subject,message,attachment,date)
							values ('" . $from_id . "','" . $from_role . "','" . $parent_id . "','" . $to_role_name . "','" . $subject . "','" . $message . "','" . $file . "',now())") or die(mysql_error());
                /*echo "INSERT INTO essort_message_master
							(from_id,from_role,to_id,to_role,subject,message,attachment,date)
							values ('" . $from_id . "','" . $from_role . "','" . $parent_id . "','" . $to_role_name . "','" . $subject . "','" . $message . "','" . $file . "',now())";
                die();*/

            } else {
                if($to_role == 'Admin'){
                    $to_role = 'SAD';
                }
                $select_user = mysql_fetch_array(mysql_query("SELECT * FROM  essort_user_header WHERE usr_role='" . $to_role . "'"));

                $sql = mysql_query("INSERT INTO essort_message_master
						(from_id,from_role,to_id,to_role,subject,message,attachment,date)
						values ('" . $from_id . "','" . $from_role . "','" . $select_user['usr_id'] . "','" . $to_role_name . "','" . $subject . "','" . $message . "','" . $file . "',now())");

            }

            if ($sql == true) {
                move_uploaded_file($tmp_file, $folder . $file);
                return 1;
            }
        }
    }
    ##################################################################
    function VIEWALLMESSAGE($id, $role, $page, $type,$records)
    {
        /*echo $records;
        echo $page;
        exit();*/
        if (isset($id)) {
            $num_rec_per_page = $records;
            if (isset($page) and $page > 0) {
                $page = $page;
            } else {
                $page = 1;
            }
            if ($type == 0) {
                $cond = 'AND delete_status=0';

            } elseif ($type == 4) {
                $cond = 'AND delete_status=1';

            } else {
                $cond = 'AND message_status=' . $type . ' AND delete_status=0';

            }
            $start_from = ($page - 1) * $num_rec_per_page;
            $end = $num_rec_per_page;
			$sql = mysql_query("SELECT *,'messages','from_name' FROM essort_message_master WHERE to_id='" . $id . "' AND to_role='" . $role . "' $cond GROUP BY subject ORDER BY `date` DESC LIMIT $start_from,$end  ");

            $arr = array();
            while ($row = mysql_fetch_array($sql)) {
                $sqlmsg = mysql_query("SELECT *,'from_name' FROM essort_message_master WHERE to_id='" . $row['from_id'] . "' AND from_id='" . $row['to_id'] . "' AND subject='" . $row['subject'] . "' ");
                $sqlusr = mysql_fetch_array(mysql_query("SELECT usr_fname,usr_mname,usr_lname,usr_role FROM essort_user_header WHERE usr_id='" . $row['from_id'] . "'"));
                $row['from_name'] = $sqlusr['usr_fname'] . " " . $sqlusr['usr_mname'] . " " . $sqlusr['usr_lname'];
                $row['from_role'] = $sqlusr['usr_role'];
                if ($row['from_role'] == "SAD") {
                    $row['from_role'] = "Admin";
                }
                
                //Name of user
                $sqlmsgs = mysql_query("SELECT *,'messages','from_name' FROM essort_message_master WHERE to_id='" . $id . "'  AND to_role='" . $role . "' AND subject='" . $row['subject'] . "' ORDER BY `date` DESC");
                $message = array();
                while ($rowmsgs = mysql_fetch_array($sqlmsgs)) {
                    $sqlusrd = mysql_fetch_array(mysql_query("SELECT usr_fname,usr_mname,usr_lname,usr_role FROM essort_user_header WHERE usr_id='" . $row['from_id'] . "'"));
                    $rowmsgs['from_name'] = $sqlusrd['usr_fname'] . " " . $sqlusr['usr_mname'] . " " . $sqlusr['usr_lname'];
                    $rowmsgs['from_role'] = $sqlusrd['usr_role'];
                    if ($rowmsgs['from_role'] == "SAD") {
                        $rowmsgs['from_role'] = "Admin";
                    }
                    //echo "<script>alert('".$rowmsgs['from_role']."');</script>";
                    $message[] = $rowmsgs;
                }
                while ($rowmsg = mysql_fetch_array($sqlmsg)) {
                    $sqlname = mysql_fetch_array(mysql_query("SELECT usr_fname,usr_mname,usr_lname,usr_role FROM essort_user_header WHERE usr_id='" . $rowmsg['from_id'] . "'"));
                    $rowmsg['from_name'] = $sqlname['usr_fname'] . " " . $sqlusr['usr_mname'] . " " . $sqlusr['usr_lname'];
                    array_push($message, $rowmsg);
                }
                $row['messages'] = $message;
                $arr[] = $row;
            }
            return $arr;
        }
    }

    ##################################################################
	function getnoofmessages($id, $role, $page, $type,$records)
    {
        /*echo $records;
        echo $page;
        exit();*/
        if (isset($id)) {
            $num_rec_per_page = $records;
            if (isset($page) and $page > 0) {
                $page = $page;
            } else {
                $page = 1;
            }
            if ($type == 0) {
                $cond = 'AND delete_status=0';

            } elseif ($type == 4) {
                $cond = 'AND delete_status=1';

            } else {
                $cond = 'AND message_status=' . $type . ' AND delete_status=0';

            }
            $start_from = ($page - 1) * $num_rec_per_page;
            $end = $num_rec_per_page;
			$sql = mysql_num_rows(mysql_query("SELECT *,'messages','from_name' FROM essort_message_master WHERE to_id='" . $id . "' AND to_role='" . $role . "' $cond GROUP BY subject ORDER BY `date` DESC"));
			
            return $sql;
        }
    }
    ##################################################################

    function VIEWFEETIMELINE($quarter)
    {
        if (isset($quarter)) {
            $sql = mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='" . $quarter . "'"));
            return $sql;
        }
    }


    ##########################FIND NO OF WORKING DAYS########################################
    function APPROVEHOLIDAY()
    {
        if (isset($_REQUEST['event_id'])) {
            $event_id = $_POST["event_id"];
            $fromd = $_POST["date_from"];
            $occassion = $_POST["occassion"];
            $date_to = $_POST["date_to"];
            $daylen = 60 * 60 * 24;
            $days = (strtotime($date_to) - strtotime($fromd)) / $daylen + 1;
            ?>

            <?php
            for ($i = 1; $i <= $days; $i++) {

                $sqlupdate = mysql_query("update  essort_holidays set status = 1 WHERE
                    off_day = '" . $fromd . "' AND occassion='" . $occassion . "'");
                $fromd = strtotime("+1 day", strtotime($fromd));
                $fromd = date("Y-m-d", $fromd);

            }
            return 1;

        } else {
            return 2;
        }

    }

    ##########################FIND NO OF WORKING DAYS########################################
    function getWorkingDays($startDate, $endDate, $holidays)
    {
        // do strtotime calculations just once
        $endDate = strtotime($endDate);
        $startDate = strtotime($startDate);


        //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
        //We add one to inlude both dates in the interval.
        $days = ($endDate - $startDate) / 86400 + 1;

        $no_full_weeks = floor($days / 7);
        $no_remaining_days = fmod($days, 7);

        //It will return 1 if it's Monday,.. ,7 for Sunday
        $the_first_day_of_week = date("N", $startDate);
        $the_last_day_of_week = date("N", $endDate);

        //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
        //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
        if ($the_first_day_of_week <= $the_last_day_of_week) {
            if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
            if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
        } else {
            // (edit by Tokes to fix an edge case where the start day was a Sunday
            // and the end day was NOT a Saturday)

            // the day of the week for start is later than the day of the week for end
            if ($the_first_day_of_week == 7) {
                // if the start date is a Sunday, then we definitely subtract 1 day
                $no_remaining_days--;

                if ($the_last_day_of_week == 6) {
                    // if the end date is a Saturday, then we subtract another day
                    $no_remaining_days--;
                }
            } else {
                // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
                // so we skip an entire weekend and subtract 2 days
                $no_remaining_days -= 2;
            }
        }

        //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
        //---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
        $workingDays = $no_full_weeks * 5;
        if ($no_remaining_days > 0) {
            $workingDays += $no_remaining_days;
        }

        //We subtract the holidays
        foreach ($holidays as $holiday) {
            $time_stamp = strtotime($holiday);
            //If the holiday doesn't fall in weekend
            if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N", $time_stamp) != 6 && date("N", $time_stamp) != 7)
                $workingDays--;
        }

        return $workingDays;
    }

    ##########################FIND NO OF WORKING DAYS########################################
    function getCurrentAttendenece($Date, $stu_id)
    {
        $sql = mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='" . $stu_id . "' AND DATE_FORMAT(att_date,'%Y-%m-%d')='" . $Date . "'") or die(mysql_error());
        // echo "SELECT * FROM essort_class_attendence WHERE stu_id='".$stu_id."' AND DATE_FORMAT(att_date,'%Y-%m-%d')='".$Date."'";
        $num_of_rows = mysql_num_rows($sql);
        if ($num_of_rows > 0) {
            return 'PR';
        } else {
            if ($day = date('l', strtotime($Date)) == 'Sunday') {
                return 'S';
            }
            $sqlholidays = mysql_query("SELECT * FROM essort_holidays WHERE off_day='" . $Date . "'  AND occassion_type = 'Holiday' AND status = 1");
            $hnum_of_rows = mysql_num_rows($sqlholidays);
            if ($hnum_of_rows > 0) {
                return 'H';
            }
            $Sqlrletion = mysql_fetch_array(mysql_query("SELECT stu_id FROM essort_user_relation WHERE att_ref_id='" . $stu_id . "'"));
            $sqlleave = mysql_query("SELECT * FROM essort_student_leave_info WHERE leave_date='" . $Date . "' AND usr_id='" . $Sqlrletion['stu_id'] . "'");

            $lnum_of_rows = mysql_num_rows($sqlleave);
            if ($lnum_of_rows > 0) {
                return 'LV';
            }

            return 'AB';

        }
    }

    ##########################FIND NO OF WORKING DAYS########################################
    function getAttendnce($element)
    {

        $sql = mysql_query("SELECT YEAR( att_date ) AS y, MONTH( att_date ) AS m, COUNT( DISTINCT att_date ),'ABSENT','PRESENT','TOTAL'
			FROM essort_class_attendence
			WHERE stu_id = '" . $element . "' GROUP BY y, m");
        $no_of_ros = mysql_num_rows($sql);
        $arraydata = '';
        if ($no_of_ros == 0) {
            $arraydata .= '<tr>
																			<td></td>
																			<td>No Data Found</td>
																			<td></td>
																			<td></td>
								</tr>';
            return $arraydata;
            exit;
        }
        while ($rowleavetble = mysql_fetch_array($sql)) {
            //$sqlt = mysql_query("SELECT attendence_id FROM essort_class_attendence WHERE MONTH(att_date) = '" . $rowleavetble['m'] . "' AND stu_id = '" . $element . "'"); //AND YEAR(happened_at) = 2009
            //$num_of_rows = mysql_num_rows($sqlt);
			
			$holidays=array();
			$sql = mysql_query("SELECT DATE_FORMAT(`off_day` , '%Y-%m-%d') as date
            FROM essort_holidays  WHERE occassion_type='Holiday' AND DATE_FORMAT(off_day,'%m')='".$rowleavetble['m']."' AND status='1'") OR DIE(mysql_error());
			$holidays=array();
			while($row=mysql_fetch_array($sql))
			{
				$holidays[]=$row['date'];
			}
			
			$start_date=date(''.$rowleavetble['y'].'-'.$rowleavetble['m'].'-01');
			$d=cal_days_in_month(CAL_GREGORIAN,$rowleavetble['m'],$rowleavetble['y']);
			$todaydate=date(''.$rowleavetble['y'].'-'.$rowleavetble['m'].'-'.$d);
			$num_of_rows=$this->getWorkingDays($start_date,$todaydate,$holidays);
			
            //PRESEENT DAYS
            $sqlp = mysql_query("SELECT attendence_id FROM essort_class_attendence 
					WHERE MONTH(att_date) = '" . $rowleavetble['m'] . "' AND stu_id = '" . $element . "' AND att_status='P'");
            $pnum_of_rows = mysql_num_rows($sqlp);
            //ABSENT DAYS
            $sqla = mysql_query("SELECT attendence_id FROM essort_class_attendence 
					WHERE MONTH(att_date) = '" . $rowleavetble['m'] . "' AND stu_id = '" . $element . "'  AND att_status='A'");
            $anum_of_rows = mysql_num_rows($sqla);
            $rowleavetble['ABSENT'] = $anum_of_rows;
            $rowleavetble['PRESENT'] = $pnum_of_rows;
            $rowleavetble['TOTAL'] = $num_of_rows;
            $rowatt[] = $rowleavetble;

        }
        return $rowatt;

    }

    ##########################FIND NO OF WORKING DAYS########################################
##############################FOR GET MESSAGE ON HEADER SECTION NOTIFICATION #####################
    function getMessage()
    {
        $user_id = $_SESSION['USER']['USER_ID'];
        $sql = mysql_query("SELECT * FROM essort_message_master mm
            INNER JOIN essort_user_header uh
            ON
            mm.from_id = uh.usr_id
            WHERE mm.to_id='" . $user_id . "' AND message_status = 2") OR DIE(mysql_error());
        $result = array();
        if ($sql) {
            while ($row = mysql_fetch_assoc($sql)) {
                $result[] = $row;
            }
            return $result;
        }
    }

###########################################################################################################
##############################FOR REMOVE FEE COLLECTOR ###########################
    function REMOVEFEECOLLECTOR()
    {
        $user_id = $_REQUEST['collect_id'];
        $sql = mysql_query("DELETE FROM essort_user_header WHERE usr_id='" . $user_id . "'") OR DIE(mysql_error());
        if ($sql == true) {
            return 1;
        } else {
            return 0;
        }
    }

    #####################################################################################
    ########################FOR ALL EVENT####################
    function SEARCHALLEVENT()
    {
        $sqldata = mysql_query("SELECT *, MAX(off_day) as maxoff, MIN(off_day) as minoff FROM
    essort_holidays WHERE occassion_type='Event' AND DATE_FORMAT(off_day, '%Y-%m-%d') >= '" . date('Y-m-d') . "'
    AND status = 1  GROUP BY occassion");
        $result = array();
        if ($sqldata) {
            while ($row = mysql_fetch_assoc($sqldata)) {
                $result[] = $row;
            }
            return $result;
        }
    }

    ########################FOR ALL HOLIDAYS####################
    function SEARCHALLHOLIDAY()
    {
        $sqldata = mysql_query("SELECT *, MAX(off_day) as maxoff, MIN(off_day) as minoff FROM
    essort_holidays WHERE occassion_type='Holiday' AND DATE_FORMAT(off_day, '%Y-%m-%d') >= '" . date('Y-m-d') . "'
    AND status = 1  GROUP BY occassion");
        $result = array();
        if ($sqldata) {
            while ($row = mysql_fetch_assoc($sqldata)) {
                $result[] = $row;
            }
            return $result;
        }
    }


    ###############################ADD FEE TRANSACTION##############################################
    function ADDFEES()
    {
        if (isset($_REQUEST['quarterpopup'])) {
            $user_id = $_POST['stuid'];
            $quarterpopup = $_POST['quarterpopup'];
            $discountpopup = $_POST['discountpopup'];
            $penalitypopup = $_POST['penalitypopup'];
            $pendingpopup = $_POST['pendingpopup'];
            $rs = $_POST['rs'];
            $messageticks = isset($_POST['messageticks']);
            $cheque_no = $_POST['cheque_no'];
            $micr_code = $_POST['micr_code'];
            if (@$_POST['messageticks'] == 'Cash') {
                //echo "<script>alert('You have selct Cash')</script>";
                $sql = mysql_query("INSERT INTO essort_fee_transaction SET user_id='" . $user_id . "',
                fee_quarter='" . $quarterpopup . "',fee_created_on= NOW(),payment_amount_by_user='" . $rs . "',
                discount_by_school='" . $discountpopup . "',penality='" . $penalitypopup . "',
                previous_amount='" . $pendingpopup . "',payment_mode='Cash',status=1 ");
                if ($sql == TRUE) {
                    return 1;

                }
            } else {
                $sql1 = mysql_query("INSERT INTO essort_fee_transaction SET user_id='" . $user_id . "',                                                fee_quarter='" . $quarterpopup . "',fee_created_on= NOW(),payment_amount_by_user='" . $rs . "',
                  discount_by_school='" . $discountpopup . "',penality='" . $penalitypopup . "',
                  previous_amount='" . $pendingpopup . "',payment_mode='Cheque',status=0,cheque_no='" . $cheque_no . "',
                    micr_code='" . $micr_code . "' ");
                if ($sql1 = TRUE) {
                    return 1;
                }
            }
        }
    }

    function uploadStaff()
    {
        if (isset($_REQUEST['submit'])) {
            //$staffconnect = mysql_real_escape_string($_POST["staffconnect"]);
            $file = $_FILES['excel']['name'];
            $tmp_file = $_FILES['excel']['tmp_name'];
            $folder = "../../" . $_SESSION['USER']['DB_NAME'] . "/uploads/";
            if (move_uploaded_file($tmp_file, $folder . $file)) {
                include "../../" . $_SESSION['USER']['DB_NAME'] . "/PHPExcel/Classes/PHPExcel/IOFactory.php";
                $objPHPExcel = PHPExcel_IOFactory::load("$folder/$file");
                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $staff_type = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $txtName = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $txtMName = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $txtLName = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $filen = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $txtEmail = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $password = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $usr_status = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $txtContact = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $txtDeptName = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                        $txtSalary = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                        $class = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                        $sec = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                        $sub = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        $sql = "insert into  essort_user_header set usr_role='" . $staff_type . "', usr_fname='" . $txtName . "',
                        usr_mname='" . $txtMName . "', usr_lname='" . $txtLName . "',usr_pic='" . $filen . "',
                            usr_email='" . $txtEmail . "',password='" . md5($password) . "',usr_status=" . $usr_status . ",usr_mobile='" . $txtContact . "'";
                        $resp = mysql_query($sql);
                        $staff_id = mysql_insert_id();
                        $paddedNum = sprintf("%06d", $staff_id);
                        $roleode = "EMP";
                        $emp_id = $roleode . "" . $paddedNum;
                        //UPDATE EMP_ID
                        $upsql = mysql_query("UPDATE essort_user_header SET emp_id='" . $emp_id . "' WHERE usr_id='" . $staff_id . "'");
                        //DETAIL
                        if ($resp == true) {
                            $sqldetail = "insert into essort_user_details set usr_id='" . $staff_id . "',
                            dept_name='" . $txtDeptName . "',usr_salary='" . $txtSalary . "'";
                            $respdetail = mysql_query($sqldetail);
                        }
                        for ($i = 1; $i <= 1; $i++) {
                            //Class
                            $classvar = 'class';
                            $varname = $classvar . "" . $i;
                            //$class = mysql_real_escape_string($_POST['class1']);
                            //Section
                            $secvar = 'section';
                            $varsname = $secvar . "" . $i;
                            //$sec = mysql_real_escape_string($_POST[$varsname]);
                            //Subect
                            $subvar = 'subject';
                            $varsubname = $subvar . "" . $i;
                            //$sub = mysql_real_escape_string($_POST[$varsubname]);

                            $chkvar = 'chkClTeacher';
                            @$varchkname = $chkvar . "" . $i;
                            @$chk = mysql_real_escape_string($_POST[$varchkname]);
                            //SELECT DUPLICATE RECORD
                            $sqlchk = mysql_query("SELECT * FROM essort_teacher_class WHERE class_id='" . $class . "' AND section_id='" . $sec . "' AND subject_id='" . $sub . "'");
                            $no_of_rows = mysql_num_rows($sqlchk);
                            if ($no_of_rows > 0) {

                            } else {
                                //SELECT CLASS TEACHER RECORD
                                $sqlclschk = mysql_query("SELECT * FROM essort_teacher_class WHERE class_id='" . $class . "' AND section_id='" . $sec . "' AND is_classteacher='1'");
                                $no_chk_of_rows = mysql_num_rows($sqlclschk);
                                if ($no_chk_of_rows > 0) {
                                    $sql = mysql_query("insert into  essort_teacher_class set staff_id='" . $staff_id . "',class_id='" . $class . "',section_id='" . $sec . "',subject_id='" . $sub . "',is_classteacher='0'");
                                } else {
                                    //INSERT
                                    $sql = mysql_query("insert into  essort_teacher_class set staff_id='" . $staff_id . "',class_id='" . $class . "',section_id='" . $sec . "',subject_id='" . $sub . "',is_classteacher='" . $chk . "'");
                                }
                            }

                        }
                        unlink($folder . $file);
                        if ($resp == true) {
                            return 1;
                        } else {
                            return 0;
                        }

                    }
                }
            }
        } else {
            return 2;
        }
    }

    ###################FOR SUBJECT ALLOCATION#########################
    function SUBJECTALLOCATION()
    {
        if (isset($_REQUEST['subject_id'])) {

            $sec = $_POST['section_id'];
            $sub = $_POST['subject_id'];
            foreach ($sub as $key => $value) {
                $section_id = $key;

                foreach ($value as $subjects) {
                    //echo  "INSERT INTO  essort_subject_allocation (section_id,sub_id) VALUES ('".$section_id."','".$value[$i]."')";
                    //echo "subject ---------------".$subjects;
                    $subsql = mysql_query("INSERT INTO  essort_subject_allocation (section_id,sub_id) VALUES ('" . $section_id . "','" . $subjects . "')");

                }
            }
        }
        if ($subsql == TRUE) {
            return 1;
        } else {
            return 2;
        }
    }

    function uploadChallan()
    {
        if (isset($_REQUEST['submit_chln'])) {
            //echo "<script>alert('Hello');</script>";
            //$staffconnect = mysql_real_escape_string($_POST["staffconnect"]);
            $file = $_FILES['excel']['name'];
            $tmp_file = $_FILES['excel']['tmp_name'];
            $folder = "../../" . $_SESSION['USER']['DB_NAME'] . "/uploads/";
            if (move_uploaded_file($tmp_file, $folder . $file)) {
                include "../../" . $_SESSION['USER']['DB_NAME'] . "/PHPExcel/Classes/PHPExcel/IOFactory.php";
                $objPHPExcel = PHPExcel_IOFactory::load("$folder/$file");
                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $array = array();
                    $select = mysql_query("SELECT stu_id FROM essort_user_relation");
                    while ($rowdata = mysql_fetch_array($select)) {
                        $array[] = $rowdata['stu_id'];
                    }
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $user_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $fee_quarter = trim($worksheet->getCellByColumnAndRow(1, $row)->getValue(), " ");
                        $fee_created_on = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $fee_created_on = date("Y-m-d");
                        $amount = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $payment_mode = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        if (in_array($user_id, $array) == 0) {
                            return 2;
                        } /*elseif($fee_quarter == "first"){
                            echo "$fee_quarter";
                            die();
                        }*/
						$objective_array=array("first","second","third","fourth");
						if(!in_array($fee_quarter,$objective_array))
						{
							  return 3;
						}

                        else {
                            if ($fee_quarter == "first" || $fee_quarter != "second" || $fee_quarter != "third" || $fee_quarter != "fourth") {

								$findquarter=mysql_num_rows(mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='" . $user_id . "' AND fee_quarter='" . $fee_quarter . "'"));
								if($findquarter!=0)
								{
									return 4;
								}
                                $sql = mysql_query("insert into  essort_fee_transaction set user_id='" . $user_id . "',                                                      fee_quarter='" . $fee_quarter . "', fee_created_on='" . $fee_created_on . "', payment_amount_by_user='" . $amount . "',payment_mode='" . $payment_mode . "'") or die(mysql_error());
                            }
                            else{
                                echo "<script>alert('Invalid Quarter');</script>";
                            }
                        }


                    }
                    //unlink($folder.$file);
                    if ($sql == true) {
                        return 1;
                    } else {
                        return 0;
                    }
                }
            }
        } else {
            return 2;
        }
    }
    ###########################GET ALL STAFF WHERE ATTENDANCE ID BLANK FOR ATTENDANCE CARD ENTRY###############################
    function ADDATTENDANCESTAFFID(){
        $array = array();
        $select = mysql_query("SELECT * FROM essort_user_header WHERE usr_role='Teacher' AND att_ref_id = ''");
        while($query = mysql_fetch_array($select)){
            $array[] = $query;
        }

        return $array;

    }
    #########################################ADD CARD NUMBER##########################
	function ADDATTENDANCESTUID(){
        $array = array();
        $select = mysql_query("SELECT * FROM essort_user_relation WHERE att_ref_id = ''");
        while($query = mysql_fetch_array($select)){
            $array[] = $query;
        }

        return $array;

    }
    #########################################ADD CARD NUMBER##########################
    function  ADDCARDNUMBER(){
        if(isset($_REQUEST['card_no'])){
            $card_no = $_REQUEST['cardnumber'];
            $userid = $_REQUEST['userid'];

            $sql = mysql_query("UPDATE essort_user_header SET att_ref_id = '".$card_no."' WHERE usr_id = '".$userid."'");
            if($sql == true){
                return 1;
            }
        }
    }
    ###################################FOR REST PASSWORD ####################################
    function RESETPASS(){
        if(isset($_REQUEST['password'])){
            $mob = $_REQUEST['mobile_no'];
            $password = $_REQUEST['password'];
            $sql = mysql_query("UPDATE essort_user_header
            SET password = '".md5($password)."' WHERE usr_mobile = '".$mob."'") or die(mysql_error());
            if($sql == TRUE){
                return 1;
            }
        }
    }
}

?>