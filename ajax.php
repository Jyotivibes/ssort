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
			$sql = "SELECT * from essort_user_header where (emp_id='".$user_email."' OR usr_email='".$user_email."') and password='".$user_password."'";
			$res=mysql_query($sql) or die(mysql_error());
			//echo mysql_num_rows($res);
			$res2=mysql_num_rows($res);
			//echo $res2;
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
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='chairmanlogin') ){
		require_once('classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();

		if(  ($_REQUEST['user_email']=='') && ($_REQUEST['user_password']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			 $user_email =$_REQUEST['user_email'] ;
			$user_password = md5($_REQUEST['user_password']);
			//$user_type=$_REQUEST['user_type'] ;
			$userData=array();
			$sql = "SELECT * from essort_group where grp_chairman_email='".$user_email."' and grp_password='".$user_password."'";
			$res=mysql_query($sql) or die(mysql_error());
			//echo mysql_num_rows($res);
			$res2=mysql_num_rows($res);
            if($res2 == 0){
                echo 9; exit; // login email and password worng
            }
			$result = mysql_fetch_array($res);
			$sqlschool=mysql_fetch_array(mysql_query("SELECT * FROM essort_school_info WHERE grp_id='".$result['grp_id']."'"));
			$userData['USER_ID'] = $result['grp_id'];
			$userData['USER_NAME'] = $result['grp_chairman_name'];
			$userData['USER_LNAME'] = $result['grp_chairman_lname'];
			//$userData['USER_MO'] = $result['usr_lname'];
			$userData['EMAIL'] = $result['grp_email'];
			$userData['GROUP_ID'] = $result['grp_id'];
			$userData['ROLE_ID'] = 'Chairman';
			$userData['DB_NAME'] = $sqlschool['sch_reg_no'];

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
               // print_r($rs);
                // put in bold the written text
                $country_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['sch_name']);
                // add new option
                echo '<a><li class="set_itemclass">'.$country_name.'</li></a>'; //onclick="set_item(\''.str_replace("'", "\'", $rs['sch_name']).'\')"
            }

			?>
			<script>
			function set_item(item) {
				// change input value
				$('#country_id').val(item);
				// hide proposition list
				$('#country_list_id').hide();
			}
			</script>
			<?php

			//echo $a;exit;
		}
	}
	//################################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='finddata') ){
		require_once('classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
	    if(($_REQUEST['keyword']=='')){
				echo 1;exit;// require Parametre missing
		}else{
            $keyword=$_REQUEST['keyword'];
			$sql = mysql_query("SELECT sch_reg_no FROM essort_school_info WHERE sch_name LIKE '".$keyword."%'");
            //echo "SELECT sch_reg_no FROM essort_school_info WHERE sch_name LIKE '".$keyword."%'";
            if(mysql_num_rows($sql) == 0){
                echo 0;
            }
			$res=mysql_fetch_array($sql);
			echo $res['sch_reg_no'];

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
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='approvefeestructure') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();
		$class=$_REQUEST['classdata'];
		echo $class;
		$sec=$_REQUEST['secdata'];
		$quarter=$_REQUEST['quarter'];
	   if(($_REQUEST['action']=='' && $_REQUEST['session'])){
				echo 1;exit;// required Parametre missing
		}else{
			$noofrows=mysql_num_rows(mysql_query("SELECT * FROM  essort_fee_structure_approval WHERE app_class='".$class."' AND app_sec='".$sec."' AND  app_quarter='".$quarter."'"));
			if($noofrows==0)
			{
				
				$sql=mysql_query("INSERT INTO essort_fee_structure_approval (app_quarter,app_class,app_sec) VALUES('".$quarter."',".$class.",".$sec.")");
				if($sql==true) 
				{
					echo 1; exit;
				}
			}
			
			
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
			$tag='<option value="">Select</option>';
			while($row=mysql_fetch_array($sql))
			{
				$tag.='<option value='.$row['section_id'].'>'.$row['section_name'].'</option>';

			}
			echo $tag;exit;
		}
	}
	//#############################################################################################################

	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='getallstuofsection') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();

		if(  ($_REQUEST['class']=='') && ($_REQUEST['section']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			$class =$_REQUEST['class'] ;
			$section = md5($_REQUEST['section']);
			//$user_type=$_REQUEST['user_type'] ;
			$userData=array();
			$sql = "SELECT att_ref_id as stu_id,(SELECT usr_fname FROM  essort_application_header WHERE usr_application_id=r.stu_id) as usr_name from essort_user_relation as r where class_id='".$class."' and sec_id='".$class."'";
			$res=mysql_query($sql) or die(mysql_error());
			//echo mysql_num_rows($res);'
			$arr=array();
			while($row=mysql_fetch_array($res))
			{
				$arr[]=$row;
			}
			echo json_encode($arr);exit;
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
			$date=date("Y-m-d", strtotime($_REQUEST['date']));
			if($_REQUEST['date']=='')
			{
				$date=date('Y-m-d');
			}
			//echo "SELECT *  FROM  essort_user_header WHERE usr_role IN ('Teacher') AND usr_fname like '".$element."%'";
			$sql=mysql_query("SELECT *  FROM  essort_user_header WHERE usr_role IN ('Teacher') AND usr_fname like '".$element."%'");
			if($element=='')
			{
				$sql=mysql_query("SELECT *  FROM  essort_user_header WHERE usr_role IN ('Teacher')");
			}

			if(mysql_num_rows($sql)==0)
			{
				echo 'No data Found';
				exit;

			}
			else
			{
				$arraydata='';
                $i = 1;
				while($row=mysql_fetch_array($sql))
				{
					//echo "SELECT att_in_time,attout_time,att_status FROM essort_class_attendence WHERE stu_id='".$row['usr_id']                       ."' AND att_date='".$date."'" ;
					$sqlatt=mysql_query("SELECT attendence_id,att_in_time,attout_time,att_status FROM essort_class_attendence
                    WHERE stu_id='".$row['att_ref_id']."' AND att_date='".$date."'" );
					$rowusr=mysql_fetch_array($sqlatt);
					if($row['usr_pic']=='')
					{
						$row['usr_pic']='images.png';
					
					}
					$arraydata.='<tr>
                        <tr>
                            <td class="text-center">'.$i.'</td>
                            <td>'.$row['usr_fname'].'</td>
                            <td><a href="staff-profile.php?teach_id='.$row['usr_id'].'"><img src="../../'.$_REQUEST['session'].'/uploads/staff/'.$row['usr_pic'].'"></a></td>
                            <td>'.$row['usr_role'].'</td>';
                    ?>
                    <?php
                    if ($rowusr['att_status'] == '') {
                        $arraydata .=
                            '<td>' . '-' . '</td>
                        <td>' . '-' .'</td>';
                    }
                    else{
                        $arraydata .=
                            '<td>' . $rowusr['att_in_time'] . '</td>
                        <td>' . $rowusr['attout_time'] . '</td>';
                    }
                            ?>
                            <?php
                            if($row['att_ref_id']=='')
                            {

                            $arraydata.=
                                '<td class="text-center">
                                    -
                                </td>';
                            ?>
                            <?php
                            }
                            else{
                            $arraydata.=
                                '<td class="text-center">
                                    <a href="#" data-toggle="modal" class="editattend"
                                    data-id="'.$rowusr['attendence_id'].'"
                                    data-user="'.$row['att_ref_id'].'"
                                    data-in="'.$rowusr['att_in_time'].'"
                                    data-out="'.$rowusr['attout_time'].'"
                                    data-target="#myModal">
                                        <i class="fa fa-pencil-square font-icon-size" aria-hidden="true"></i>
                                    </a>
                                </td>';
				            }
                    echo $i++;
				}
				echo $arraydata;
                exit;
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
					if($rowusr['att_status']=='')
					{
						$rowusr['att_status']='A';
					}
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
																							'.$rowusr['att_status'].'</td>
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
			$date=date("Y-m-d", strtotime($_REQUEST['date']));
			if($_REQUEST['date']=='')
			{
				$date=date('Y-m-d');
			}
			$cond="";
			if(isset($_REQUEST['class']) && ($_REQUEST['class']!='') )
			{
				$class=$_REQUEST['class'];
				$cond.=" AND class_id='".$class."'";
			}
			if(isset($_REQUEST['section']) && ($_REQUEST['section']!='') )
			{
				$sec=$_REQUEST['section'];
				$cond.=" AND sec_id='".$sec."'";
			}
			$sqlr=mysql_query("SELECT * FROM essort_user_relation WHERE 1=1 $cond");
			$arrdata=array();
			$att_ref_id=array();
			while($rowr=mysql_fetch_array($sqlr))
			{
				$arrdata[]=$rowr['stu_id'];
				$att_ref_id[]=$rowr['att_ref_id'];
			}
			if($att_ref_id[0]!='')
			{
				$default_stu=$att_ref_id[0];
			}
			$sessionstartdate=$_REQUEST['sessionstartdate'];
			$sessionrange=$_REQUEST['sessionrange'];
			$string='';
			foreach($arrdata as $value)
			{
				$string.=$value.",";
			}
			$trimdata=rtrim($string,',');
			if($element!='')
			{
                $sql=mysql_query("SELECT * FROM `essort_user_header` uh
                INNER JOIN essort_user_relation ur
                ON uh.`usr_id` = ur.parent_id
                INNER JOIN essort_application_header ah
                on ur.stu_id = ah.usr_application_id WHERE  usr_application_id IN (".$trimdata.") AND (ah.usr_fname like '%".$element                  ."%' OR ah.usr_mname like '%".$element."%' OR ah.usr_lname like '%".$element."%' OR emp_id like '%".$element."%')");
				/*$sql=mysql_query("SELECT *  FROM  essort_application_header WHERE  usr_application_id IN (".$trimdata.") AND (usr_fname like '%".$element."%' OR usr_mname like '%".$element."%' OR usr_lname like '%".$element."%' )");*/

			}
			else
			{
				$sql=mysql_query("SELECT *  FROM  essort_application_header WHERE  usr_application_id IN (".$trimdata.")");

			}

			if(mysql_num_rows($sql)==0)
			{
				echo 'No data Found';
				exit;

			}
			else
			{
				$sqlclasssectionstu=mysql_num_rows(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".$default_stu."' AND att_session='".$sessionrange."'"));
				$todaysdates=date("Y-m-d");
				define("SESSION_START_DATE",$sessionstartdate);
				//COUNT OF NO OF STUDENTS,PRESENT AND ABSENT
					$sqlholidayss = mysql_query("SELECT DATE_FORMAT(`off_day` , '%Y-%m-%d') as date
						FROM essort_holidays  WHERE occassion_type='Holiday' AND status='1'") OR DIE(mysql_error());
						$holidayss=array();
						while($row=mysql_fetch_array($sqlholidayss))
						{
							$holidayss[]=$row['date'];
						}

				$currstu=$obj->getWorkingDays($sessionstartdate,$todaysdates,$holidayss);
				$sqlclasssectionstuab=$currstu-$sqlclasssectionstu;

				$arraydata='';
				$i=1;
                ob_start();
                ?>
                <script>
                    $(function () {
                        var chart = AmCharts.makeChart("chartdiv", {
                            "labelRadius": -40,
                            "labelText": "[[status]]: [[percents]]%",
                            "type": "pie",
                            "theme": "light",
                            "dataProvider": [
                                {
                                    "status": "Present",
                                    "value": (<?php echo $sqlclasssectionstu; ?>+0)
                                },
                                {
                                    "status": "Absent",
                                    "value": (<?php echo $sqlclasssectionstuab; ?>+0)
                                }
                            ],
                            "valueField": "value",
                            "titleField": "status",
                            "outlineAlpha": 0.4,
                            "depth3D": 25,
                            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                            "angle": 40,
                            "export": {
                                "enabled": true
                            }
                        });
                    });
                </script>
                <?php
                $script_content = ob_get_clean();
			while($rowatt=mysql_fetch_array($sql))
			{
				$sqla=mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id=(SELECT att_ref_id FROM essort_user_relation WHERE stu_id='".$rowatt['usr_application_id']."' LIMIT 1) AND att_date='".$date."'");
				//APPLICATION NO
				$resappno=mysql_fetch_array(mysql_query("SELECT emp_id FROM essort_user_header WHERE usr_id=(SELECT parent_id FROM essort_user_relation WHERE stu_id='".$rowatt['usr_application_id']."' LIMIT 1)"));

                $att_ref_id=mysql_fetch_array(mysql_query("SELECT att_ref_id FROM essort_user_relation WHERE stu_id='".$rowatt['usr_application_id']."'"));
				$rowusr=mysql_fetch_array($sqla);
				if(mysql_num_rows($sqla)==0)
				{
					$rowusr['att_in_time']='-';
					$rowusr['att_status']='A';
					$rowusr['attout_time']='-';
					$rowusr['attendence_id']='';
				}

				$rowatt['usr_fname']=$rowatt['usr_fname']." ".$rowatt['usr_mname']." ".$rowatt['usr_lname'];
				$arraydata.='<tr>
                    <tr>

                        <td class="text-center">'.$i.'</td>
                        <td>'.$rowatt['usr_fname'].'</td>
                        <td><a href="../school-admin/student-profile.php?stu_id= '.$rowatt['usr_application_id'].'"><img src="../images/images.png"></a></td>
                        <td>'.$resappno['emp_id'].'</td>
                        <td>'.$rowusr['att_status'].'</td>
                        <td>'.$rowusr['att_in_time'].'</td>
                        <td>'.$rowusr['attout_time'].$script_content.'</td>';
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
                        $arraydata.=
                        '<td class="text-center">
                           <a href="#"  class="editattend"
                               data-id="'.$rowusr['attendence_id'].'"
                               data-user="'.$att_ref_id['att_ref_id'].'"
                               data-in="'.$rowusr['att_in_time'].'"
                               data-out="'.$rowusr['attout_time'].'" >
                               <i class="fa fa-pencil-square font-icon-size" aria-hidden="true"></i>
                           </a>
                        </td>';

                        }
                        ?>
                    </tr>';
                    <?php
					$i++;
			}
			echo $arraydata;
			exit;


			}

		}
	}
	//#############################################################################################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchstuattfromchairman') ){
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
			$year=$_REQUEST['salyear'];
			$session_start_date=$_POST['session_start_date'];
			//$date=date("Y-m-d", strtotime($date));


			$sqlor = mysql_query("SELECT DATE_FORMAT(`off_day` , '%Y-%m-%d') as date
			FROM essort_holidays  WHERE occassion_type='Holiday' AND status='1'") OR DIE(mysql_error());
			$holidayss=array();
			while($rowm=mysql_fetch_array($sqlor))
			{
				$holidayss[]=$rowm['date'];
			}
			$sqlclasssectionstu=mysql_num_rows(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".$element."' AND att_session='".$year."'"));
			$todaydate=date('Y-m-d');
			$currstu=$obj->getWorkingDays($session_start_date,$todaydate,$holidayss);
			$sqlclasssectionstuab=$currstu-$sqlclasssectionstu;

			$arraydata='';
			$sql=mysql_query("SELECT YEAR( att_date ) AS y, MONTH( att_date ) AS m, COUNT( DISTINCT att_date ),'ABSENT','PRESENT','TOTAL'
			FROM essort_class_attendence
			WHERE stu_id = '".$element."' AND att_session='".$year."' GROUP BY y, m");
			$no_of_ros=mysql_num_rows($sql);
			if($no_of_ros==0)
			{
				echo '----------------';
                ob_start();
                ?>

                <script>
                    $(function () {
                        var chart = AmCharts.makeChart("chartdiv", {
                            "labelRadius": -40,
                            "labelText": "[[status]]: [[percents]]%",
                            "type": "pie",
                            "theme": "light",
                            "dataProvider": [
                                {
                                    "status": "Present",
                                    "value": (<?php echo $sqlclasssectionstu; ?>+0)
                                },
                                {
                                    "status": "Absent",
                                    "value": (<?php echo $sqlclasssectionstuab; ?>+0)
                                }
                            ],
                            "valueField": "value",
                            "titleField": "status",
                            "outlineAlpha": 0.4,
                            "depth3D": 25,
                            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                            "angle": 40,
                            "export": {
                                "enabled": true
                            }

                        });
                    });
                </script>
                <?php
                $script_content = ob_get_clean();
				$arraydata.='<tr>
																			<td colspan="4">No Data Found'.$script_content.'</td>

								</tr>';
								echo $arraydata;exit;
			}
           ?>
           <?php
			while($rowleavetble=mysql_fetch_array($sql))
				{
					$sql = mysql_query("SELECT DATE_FORMAT(`off_day` , '%Y-%m-%d') as date
					FROM essort_holidays  WHERE occassion_type='Holiday' AND DATE_FORMAT(off_day,'%m')='".$rowleavetble['m']."'") OR DIE(mysql_error());
					$holidays=array();
					while($row=mysql_fetch_array($sql))
					{
						$holidays[]=$row['date'];
					}
					$todaydate=date('Y-m-d');
					$start_date=date(''.$rowleavetble['y'].'-'.$rowleavetble['m'].'-01');
					$num_of_rows=$obj->getWorkingDays($start_date,$todaydate,$holidays);
					//PRESEENT DAYS
					$sqlp=mysql_query("SELECT attendence_id FROM essort_class_attendence
					WHERE MONTH(att_date) = '".$rowleavetble['m']."' AND stu_id = '".$element."' AND att_status='P'");
					$pnum_of_rows=mysql_num_rows($sqlp);
					//ABSENT DAYS
					$anum_of_rows=$num_of_rows-$pnum_of_rows;
					$rowleavetble['ABSENT']=$anum_of_rows;
					$rowleavetble['PRESENT']=$pnum_of_rows;
					$rowleavetble['TOTAL']=$num_of_rows;
					$rowatt[]=$rowleavetble;

				}
				$sqlclasssectionstu=mysql_num_rows(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".$element."' AND att_session='".$year."'"));
				$sqlclasssectionstuab=$num_of_rows-$sqlclasssectionstu;
				foreach($rowatt as $rowtblvlue)
				{
					ob_start();
                    ?>
                    <script>
                        $(function () {
                            var chart = AmCharts.makeChart("chartdiv", {
                                "labelRadius": -40,
                                "labelText": "[[status]]: [[percents]]%",
                                "type": "pie",
                                "theme": "light",
                                "dataProvider": [
                                    {
                                        "status": "Present",
                                        "value": (<?php echo $sqlclasssectionstu; ?>+0)
                                    },
                                    {
                                        "status": "Absent",
                                        "value": (<?php echo $sqlclasssectionstuab; ?>+0)
                                    }
                                ],
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.4,
                                "depth3D": 25,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 40,
                                "export": {
                                    "enabled": true
                                }

                            });
                        });
                    </script>
                    <?php
                    $script_content = ob_get_clean();
					$monthNum  = $rowtblvlue['m'];
					$dateObj   = DateTime::createFromFormat('!m', $monthNum);
					$monthName = $dateObj->format('F'); // March
					$arraydata.='<tr>
																			<td>'.$monthName.'</td>
																			<td>'.$rowtblvlue['TOTAL'].'</td>
																			<td>'.$rowtblvlue['PRESENT'].'</td>
																			<td>'.$rowtblvlue['ABSENT'].$script_content.'</td>
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
			$password=rand();
			$date=date("Y-m-d", strtotime($date));
			$sqldata=mysql_fetch_array(mysql_query("SELECT * FROM essort_application_family_info WHERE usr_application_id='".$element."' LIMIT 1"));
           $to = $sqldata['usr_r_email'];
           $subject = "Student Admission Approved";

           //$message = ;
           $message = "<b>Your Children Admission has been Approved</b>"."<br/>"."<span>Your login Id is :- ".$sqldata['usr_r_email']."</span>"."<br/>"."<span>and Password is :- ".$password."</span>";


           $header = "From:SSORT\r\n";
           //$header .= "Cc:afgh@somedomain.com \r\n";
           $header .= "MIME-Version: 1.0\r\n";
           $header .= "Content-type: text/html\r\n";
           $retval = mail ($to,$subject,$message,$header);
			//SELECT Parent DETAILS
			$sqlh = "insert into  essort_user_header set usr_fname='".$sqldata['usr_r_name']."',usr_mname='K',usr_lname='".$sqldata['usr_r_lname']."',usr_role='Parent',usr_email='".$sqldata['usr_r_email']."',password='".md5($password)."',usr_status='1',usr_mobile='".$sqldata['usr_r_contact_no']."'";
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
					$cond.=" AND salary_month='".$salmonth."'";
				}
			}
			$sqlsal=mysql_query("SELECT emp_id FROM essort_staff_salary ".$cond."");
			$dataarr=array();
			while($resultsal=mysql_fetch_array($sqlsal))
			{
				$dataarr[]=$resultsal['emp_id'];
			}

			$dataarr2=array();
			$result=$dataarr;

			if($salarydata!='')
			{
				$sqlsal2=mysql_query("SELECT emp_id FROM essort_user_header WHERE usr_fname like '".$salarydata."%'");

				while($resultsal=mysql_fetch_array($sqlsal2))
				{
					$dataarr2[]=$resultsal['emp_id'];
				}
				$result=array_intersect($dataarr,$dataarr2);
			}

			$res="";
			foreach($result  as $vlue)
			{
				$res.="'".$vlue."',";
			}

			//$res=implode(",",$result);
			/*if($uidconcat!='')
			{
				$string = $uidconcat;
			}
			if($uidconcat2!='')
			{
				if($string=='')
				{
					$string.= $uidconcat2;

				}
				else
				{
					$string.= ",".$uidconcat2;
				}
			}
			*/
			$res=rtrim($res,',');
			$sqlsal=mysql_query("SELECT * FROM essort_user_header as a JOIN  essort_user_details as b WHERE a.usr_id=b.usr_id AND a.usr_role='Teacher' AND a.emp_id IN (".$res.")");

			$no_of_rows=mysql_num_rows($sqlsal);
			if($no_of_rows>0)
			{
				$stfarray=array();
				while($rowrslt=mysql_fetch_array($sqlsal))
				{

					$sqlsald=mysql_fetch_array(mysql_query("SELECT salary_amount,salary_status FROM essort_staff_salary WHERE emp_id='".$rowrslt['emp_id']."'"));
					$rowrslt['usr_fname']=$rowrslt['usr_fname'];
					$rowrslt['dept_name']=$rowrslt['dept_name'];
					$rowrslt['salary_status']=$sqlsald['salary_status'];
					$rowrslt['salary_amount']=$sqlsald['salary_amount'];
					$stfarray[]=$rowrslt;
				}
				$tbldata='';
				$i=1;
				foreach($stfarray as $stfvlue)
				{
					$status='P';
					if($stfvlue['salary_status']=='Confirmed')
					{
						$status='A';
					}
					
					if($stfvlue['usr_pic']=='')
					{
						$stfvlue['usr_pic']='images.png';
					
					}
					
					$tbldata.='<tr>
						<td class="text-center">'.$i.'</td>
						<td>'.$stfvlue['usr_fname'].'</td>
						<td><a href="staff-profile.php?teach_id='.$stfvlue['usr_id'].'"><img src="../../'.$_REQUEST['session'].'/uploads/staff/'.$stfvlue['usr_pic'].'"></a></td>

						</td>
						<td>'.$stfvlue['emp_id'].'</td>
						<td>'.$stfvlue['dept_name'].'</td>
						<td>'.$stfvlue['salary_amount'].'</td>
						<td>'.$status.'</td>
						</tr>';

				$i++;
				}
				echo $tbldata;
				exit;
			}
			else
			{
				$tbldata='';
				$tbldata='<tr>
						<td colspan="7">No Data Found</td>
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
			$stfrslt=mysql_query("SELECT *,'usr_fname','dept_name',salary_status,'usr_pic' FROM essort_staff_salary ".$cond."");
			$no_of_rows=mysql_num_rows($stfrslt);
			if($no_of_rows>0)
			{
				$stfarray=array();
				while($rowrslt=mysql_fetch_array($stfrslt))
				{
					$sqlusrhde=mysql_fetch_array(mysql_query("SELECT * FROM essort_user_header as a JOIN  essort_user_details as b WHERE a.usr_id=b.usr_id AND a.emp_id='".$rowrslt['emp_id']."'"));
					$rowrslt['usr_fname']=$sqlusrhde['usr_fname'];
					$rowrslt['dept_name']='Teaching';
					$rowrslt['usr_pic']=$sqlusrhde['usr_pic'];
					$rowrslt['salary_status']=$rowrslt['salary_status'];
					$stfarray[]=$rowrslt;
				}
				$tbldata='';
				foreach($stfarray as $stfvlue)
				{
					if($stfvlue['usr_pic']=='')
					{
						$stfvlue['usr_pic']='images.png';
					}
					$tbldata.='<tr>
						<td class="text-center">1</td>
						<td>'.$stfvlue['usr_fname'].'</td>
						<td><a href="#"><img src="../../'.$_REQUEST['session'].'/uploads/staff/'.$stfvlue['usr_pic'].'"></a>
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
			$no_of_rows=mysql_num_rows($sql);
			if($no_of_rows>0)
			{
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
			else
			{
				$arrvlue='';
				$arrvlue.='<tr>
							<td colspan="2">No data Found</td>
							</tr>';
						echo $arrvlue;
				exit;

			}


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
			$maxdate=mysql_fetch_array(mysql_query($sql));
			$num_of_rows=mysql_num_rows($res);
			if($num_of_rows>0)
			{
			$sqlmew=mysql_fetch_array(mysql_query("SELECT min(off_day) as min,max(off_day) as max FROM essort_holidays WHERE usr_id='".$maxdate['usr_id']."' AND occassion='".$maxdate['occassion']."' AND additional_info='".$maxdate['additional_info']."'"));
			while($rowholiday=mysql_fetch_array($res))
			{
				$userData.='<div class="alert alert-success clearfix alert-height">
                                    <div class="notification-info">
                                        <ul class="clearfix notification-meta">
                                            <li class="pull-left notification-sender">
                                           <span class="alert-icon"><img src="../images/icons/event.ico" class="icon-size"></span> <span><a href="javascript:void(0);" data-event-id="' . $rowholiday['id'] . '">' . $rowholiday['occassion'] . '  - From'.date('d-m-Y',strtotime($sqlmew['min'])).' To '.date('d-m-Y',strtotime($sqlmew['max'])).'</a></span>
                                           <span class="pull-right">'.$rowholiday['occassion_type'].'</span>
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
	//############# Single Event ##################################
if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'single_event')) {
    require_once('' . $_REQUEST['session'] . '/classes/connection.php');
    require_once('classes/general_class.php');
    $obj = new General();
    $result = mysql_query("SELECT * FROM essort_holidays WHERE id='".$_POST['event_id']."'");
    $event_detail=mysql_fetch_array($result);
    if($event_detail){
        echo $event_detail['occassion'].'<br/>';
        echo $event_detail['off_day'].'<br/>'.'<br/>';
        echo $event_detail['additional_info'].'<br/>';

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
#################################TRASH DELETE MESSAGE########################################################
if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'trashmsgdlt')) {
    require_once('' . $_REQUEST['session'] . '/classes/connection.php');
    require_once('classes/general_class.php');
    $obj = new General();
    if (($_REQUEST['session'] == '')) {
        echo 1;
        exit; // require Parametre missing
    } else {
        $chkId = $_REQUEST['chkId'];

        $chkId = explode(",", $chkId);
        //print_r($chkId);
        foreach ($chkId as $chkvalue) {
            $sql = mysql_query("UPDATE essort_message_master SET delete_status='4' WHERE message_id='" . $chkvalue . "'");
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
                    $sql="UPDATE essort_message_master SET message_status='1' WHERE to_id='".$_REQUEST['id']."' AND to_role='".$role."' AND message_id='".$arrvlue."' ";
					if(mysql_query($sql)){
                        echo 1;
                    }
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
                    <span class="time" style="margin-left: 58px; font-size: 12px;"><?php echo date('d-m-Y',strtotime($row['date'])); ?>
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
    $sql = mysql_query("SELECT *,max(off_day) as max,min(off_day) as min FROM essort_holidays WHERE occassion ='".$occasion."'");
    $row = mysql_fetch_array($sql);
    if($row['occassion'] == NULL){
        echo 0;
        return 0;
    }
    else{
        ?>
        <div class="event-box">
            <div class="message-center">
                <a href="#">
                    <div class="user-img"> <img src="../images/event_img1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                    <div class="mail-contnet">
                        <h5><?php echo $row['occassion']; ?></h5>
                        <span class="mail-desc"><?php echo $row['additional_info']; ?></span>
                    <span class="time">
                        <?php
                        if($row['min'] == $row['max']){
                            echo date('d-m-Y',strtotime($row['min']));
                        }
                        else{
                            echo "From ".date('d-m-Y',strtotime($row['min']))." To ".date('d-m-Y',strtotime($row['max']));
                        }
                        ?></div>
                </a>
            </div>
        </div>
    <?php
    }
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
if(isset($_REQUEST['action']) && ($_REQUEST['action']=='attregisterindividaul') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');
    require_once('classes/general_class.php');
    $obj = new General();
	$staff_year=$_REQUEST['staffyear'];
	$lstaff_year = substr($staff_year, -4);
	$fstaff_year = substr($staff_year, 0,4);
    for($i=4;$i<16;$i++)
								{

								$monthNum  = $i;
								if($monthNum==13)
								{
									$monthNum=01;
									$year=$lstaff_year;
								}
								else if($monthNum==14)
								{
									$monthNum=02;
									$year=$lstaff_year;
								}
								else if($monthNum==15)
								{
									$monthNum=03;
									$year=$lstaff_year;
								}
								else
								{
									$monthNum=$monthNum;
									$year=$fstaff_year;
								}
								$dateObj   = DateTime::createFromFormat('!m', $monthNum);
								$monthName = $dateObj->format('F');
								$number = cal_days_in_month(CAL_GREGORIAN, $monthNum,$year); // 31
								?>

    <tr>
                                        <td><?php echo $monthName;?></td>
										<?php
										for($y=1;$y<=$number;$y++)
										{

										$date=$year."-".$monthNum."-".$y;
										$date=date('Y-m-d',strtotime($date));
										$obj = new General();
										$status=$obj->getCurrentAttendenece($date,$_REQUEST['id']);
										if($status=='AB')
										{
											$tag='absent';
											$status='A';
										}
										else if($status=='PR')
										{
											$tag='present';
											$status='P';
										}
										else if($status=='LV')
										{
											$tag='cancel';
											$status='L';
										}
										else
										{


										}
										?>
                                        <td class="<?php echo $tag;?>"><?php if($tag=='present'){
										?><a href="#" data-toggle="tooltip" data-original-title="In Time: 9:30AM<br/> Out Time: 2:30PM">
										<?php
										}
										?><?php echo $status;?></a>
                                        </td>
										<?php
										}
										?>



                                    </tr>
<?php
}
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
   $element=$_REQUEST['element'];
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
				$sqlatt=mysql_num_rows(mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id IN ($string) AND fee_quarter='".$element."'"));
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
                                        < <td><?php if (array_key_exists("A",$classvlue)) {echo $classvlue['A']['recieved_fee'];}  else { echo '-';} 
						?></td>
                        <td><?php if (array_key_exists("A",$classvlue)) {echo $classvlue['A']['pending_fee'];} else { echo '-'; }?></td>
                        <td><?php if (array_key_exists("A",$classvlue)) {echo $classvlue['A']['total_stu'];} else {echo '-';}?></td>
                        <td><?php if (array_key_exists("B",$classvlue)) {echo $classvlue['B']['recieved_fee'];} else {echo '-';}?></td>
                        <td><?php if (array_key_exists("B",$classvlue)) {echo $classvlue['B']['pending_fee'];} else {echo '-';}?></td>
                        <td><?php if (array_key_exists("B",$classvlue)) {echo $classvlue['B']['total_stu'];} else { echo '-';}?></td>
                        <td><?php if (array_key_exists("C",$classvlue)) {echo $classvlue['C']['recieved_fee'];} else { echo '-';}?></td>
                        <td><?php if (array_key_exists("C",$classvlue)) {echo $classvlue['C']['pending_fee']; } else { echo '-'; }?></td>
                        <td><?php if (array_key_exists("C",$classvlue))  {echo $classvlue['C']['total_stu']; } else {echo '-'; }?></td>
                        <td><?php if (array_key_exists("D",$classvlue)) { echo $classvlue['D']['recieved_fee'];} else {echo '-';}?></td>
                        <td><?php if (array_key_exists("D",$classvlue)) { echo $classvlue['D']['pending_fee'];} else { echo '-'; }?></td>
                        <td><?php if (array_key_exists("D",$classvlue)) { echo $classvlue['D']['total_stu'];} else { echo '-'; }?></td>
    </tr>
<?php
}
}
################################################################################################
/********************************FOR SELECT SCHOOL MONTH ON CHAIRMAN DASHBOARD**********************/
if(isset($_REQUEST['action']) && ($_REQUEST['action']=='staff_month') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');

    require_once('classes/general_class.php');
    $obj = new General();
    if(($_REQUEST['session']=='')){
        echo 1;exit;// required Parametre missing
    }else{
        $month = $_REQUEST['month'];
        $staffarray=array();
        $sstaffattarray=array();
        $sqlstaff=mysql_query("SELECT * FROM essort_user_header WHERE usr_role IN ('Teacher')");

        $num_of_staffs=mysql_num_rows($sqlstaff);
        while($rowstff=mysql_fetch_array($sqlstaff))
        {

            $staffarray[]=$rowstff;
            if($rowstff['att_ref_id']!='')
            {
                $sstaffattarray[]=$rowstff['att_ref_id'];
            }

        }

        $id=implode(",",$sstaffattarray);
        //echo $id;
        $sqlpreseent=mysql_num_rows(mysql_query("SELECT * FROM essort_class_attendence
        WHERE stu_id IN (".$id.") AND DATE_FORMAT(att_date, '%M')= '".$month."'"));
        $absent=$num_of_staffs-$sqlpreseent;
        //echo $month = $_REQUEST['month'];
?>
<script>
$(function(){
var chart = AmCharts.makeChart( "chartdiv_staffattendance", {

                                                    "labelRadius": -40,
"labelText": "[[status]]: [[percents]]%",

"type": "pie",
"theme": "light",
"dataProvider": [ {
"status": "Present",
"value": (<?php echo $sqlpreseent; ?>+0)
}, {
"status": "Absent",
"value": (<?php echo $absent; ?>+0)
}],
"valueField": "value",
"titleField": "status",
"outlineAlpha": 0.4,
"depth3D": 25,
"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
"angle": 40,
"export": {
"enabled": true
}

});
});
</script>
<?php
    }
}

#######################################################################
if(isset($_REQUEST['action']) && ($_REQUEST['action']=='staffgaraphindividual') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');

    require_once('classes/general_class.php');
    $obj = new General();
    if(($_REQUEST['session']=='')){
        echo 1;exit;// required Parametre missing
    }else{
	    $staffyear=$_REQUEST['staffyear'];
        $year = date("y",strtotime($_REQUEST['startsessiondate']));
		$todaydate=date('Y-m-d');

		$sql = mysql_query("SELECT DATE_FORMAT(`off_day` , '%Y-%m-%d') as date
            FROM essort_holidays  WHERE occassion_type='Holiday' AND DATE_FORMAT(off_day,'%y')='".$year."'") OR DIE(mysql_error());
			$holidays=array();
			while($row=mysql_fetch_array($sql))
			{
				$holidays[]=$row['date'];
			}
			$workingdayssession=$obj->getWorkingDays($_REQUEST['startsessiondate'],$todaydate,$holidays);
	$sqlattendancesqlsession=mysql_query("SELECT * FROM essort_class_attendence  WHERE stu_id='".$_REQUEST['id']."' AND att_session='".$_REQUEST['staffyear']."'");

	$no_of_days_present_session=mysql_num_rows($sqlattendancesqlsession);
	$no_of_days_absent_session=$workingdayssession-$no_of_days_present_session;
	$yearpresentpercentage=($no_of_days_present_session/$workingdayssession)*100;
	$yearabsentpercentage=($no_of_days_absent_session/$workingdayssession)*100;
        //echo $month = $_REQUEST['month'];
?>
<script>
$(function(){
var chart = AmCharts.makeChart( "chartdiv", {

                                                    "labelRadius": -40,
"labelText": "[[status]]: [[percents]]%",

"type": "pie",
"theme": "light",
"dataProvider": [ {
"status": "Present",
"value": (<?php echo $no_of_days_present_session; ?>+0)
}, {
"status": "Absent",
"value": (<?php echo $no_of_days_absent_session; ?>+0)
}],
"valueField": "value",
"titleField": "status",
"outlineAlpha": 0.4,
"depth3D": 25,
"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
"angle": 40,
"export": {
"enabled": true
}

});
});
</script>
<?php
    }
}


#######################################################################
if(isset($_REQUEST['action']) && ($_REQUEST['action']=='stu_fee') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');

    require_once('classes/general_class.php');
    $obj = new General();
    if(($_REQUEST['session']=='')){
        echo 1;exit;// required Parametre missing
    }else{
        $month = $_REQUEST['fee'];
        $staffarray=array();
        $sstaffattarray=array();
        $sqlstaff=mysql_query("SELECT * FROM essort_user_relation ");

        $num_of_staffs=mysql_num_rows($sqlstaff);
        while($rowstff=mysql_fetch_array($sqlstaff))
        {

            $staffarray[]=$rowstff;
            if($rowstff['stu_id']!='')
            {
                $sstaffattarray[]=$rowstff['stu_id'];
            }

        }

        $id=implode(",",$sstaffattarray);
        //echo $id;
        $sqlpreseent=mysql_num_rows(mysql_query("SELECT * FROM essort_fee_transaction
        WHERE user_id IN (".$id.") AND fee_quarter= '".$month."'"));
        $absent=$num_of_staffs-$sqlpreseent;
        //echo $month = $_REQUEST['month'];
?>
<script>
                                            $(function(){
                                                var chart = AmCharts.makeChart( "chartdiv_feescollection", {

                                                    "labelRadius": -40,
                                                    "labelText": "[[collection]]: [[percents]]%",

                                                    "type": "pie",
                                                    "theme": "light",
                                                    "dataProvider": [ {
                                                        "collection": "Received",
                                                        "value": (<?php echo $sqlpreseent; ?>+0)
                                                    }, {
                                                        "collection": "Pending",
                                                        "value": (<?php echo $absent; ?>+0)
                                                    }],
                                                    "valueField": "value",
                                                    "titleField": "collection",
                                                    "outlineAlpha": 0.4,
                                                    "depth3D": 25,
                                                    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                                    "angle": 40,
                                                    "export": {
                                                        "enabled": true
                                                    }

                                                });
                                            });
                                        </script>
<?php
    }
}

#######################################################################
if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchsturegister') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');

    require_once('classes/general_class.php');
    $obj = new General();
    if(($_REQUEST['session']=='')){
        echo 1;exit;// required Parametre missing
    }else{
	$class=$_REQUEST['classdata'];
	$sec=$_REQUEST['secdata'];
	$cond='';
	if(isset($_REQUEST['stuname']) && ($_REQUEST['stuname']))
	{
		$stuids='';
		$sqlemp=mysql_query("SELECT usr_application_id FROM  essort_application_header WHERE usr_fname like '%".$_REQUEST['stuname']."%'");
		$stuids='';
		while($row=mysql_fetch_array($sqlemp))
		{
			$stuids.=$row['usr_application_id'].",";
		}
		$stuids=trim($stuids,",");
		if($stuids!='')
		{
			$cond.="AND stu_id IN ($stuids)";
		}
	}
	//echo "SELECT *,'TOTAL_PRESENT' FROM essort_user_relation WHERE class_id='".$class."' AND sec_id='".$sec."' ".$cond."";
	$sql=mysql_query("SELECT *,'TOTAL_PRESENT' FROM essort_user_relation WHERE class_id='".$class."' AND sec_id='".$sec."' ".$cond."");
			$attregister=array();
			while($row=mysql_fetch_array($sql))
			{
				$date=date('Y-m-d');
				$month=$_REQUEST['attmonth'];
				$year=$_REQUEST['attsession'];
				if($month==1 || $month==2 || $month==3)
				{
					$year=substr($year,-4);
				}
				else
				{
					$year=substr($year, 0, 4);
				}
				//echo $year;
				$number = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
				//$attregister[$row['usr_fname']]=$row;
				$totalpresent=0;
				for($i=1;$i<=$number;$i++)
				{
					$attdate=$year."-".$month."-".$i;
					$attdate=date('Y-m-d',strtotime($attdate));
					$status=$obj->getCurrentAttendenece($attdate,$row['att_ref_id']);
					if($status=='AB')
										{
											$tag='absent';
											$status='A';
										}
										else if($status=='PR')
										{
											$tag='present';
											$status='P';
											$totalpresent++;
										}
										else if($status=='LV')
										{
											$tag='cancel';
											$status='L';
										}
										else
										{


										}
					$attregister[$row['stu_id']][$i]=$status;
					$attregister[$row['stu_id']]['TOTAL_PRESENT']=$totalpresent;
				}
				//print_r($attregister);


    }
	?>
	<thead>
      <tr>
        <th>Name</th>
        <!--<th>Emp ID</th>-->
		<?php
		for($i=1;$i<=$number;$i++)
		{
		?>
        <th><?php echo $i;?></th>
		   <?php
		   }
		   ?>
        <th>Total Present</th>

      </tr>
    </thead>
	 <tbody id="attdata">
	<?php
	$sqlstu=mysql_query("SELECT * FROM  essort_user_relation");
		$stuarr=array();
		while($rowarr=mysql_fetch_array($sqlstu))
		{
			$resstu=mysql_fetch_array(mysql_query("SELECT * FROM  essort_application_header WHERE usr_application_id='".$rowarr['stu_id']."'"));
			$stuarr[$rowarr['stu_id']]=$resstu['usr_fname'];
		}
	foreach($attregister as $key=>$attvlue)
				{
				?>
				<tr>
        <td><?php echo $stuarr[$key];?></td>
        <!--<td>1001</td>-->
        <?php
		for($i=1;$i<=$number;$i++)
		{
			if($attvlue[$i]=='A')
			{
				$tag='warning';
			}
			else if($attvlue[$i]=='P')
			{
				$tag='';
			}
			else if($attvlue[$i]=='L')
			{
				$tag='info';
			}
			else if($attvlue[$i]=='S')
			{
				$tag='danger';
			}
			else if($attvlue[$i]=='H')
			{
				$tag='danger';
			}
		?>
        <td class="<?php echo $tag;?>"><?php echo $attvlue[$i];?></td>
		   <?php
		   }
		   ?>
        <td><?php echo $attvlue['TOTAL_PRESENT']; ?></td>


      </tr>
				<?php
				}
				?>
				</tbody>
				<?php
	//echo json_encode($attregister);


}

}
#######################################################################
if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchstaffregister') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');

    require_once('classes/general_class.php');
    $obj = new General();
    if(($_REQUEST['session']=='')){
        echo 1;exit;// required Parametre missing
    }else{
	$cond='';
	if(isset($_REQUEST['emp_name']) && ($_REQUEST['emp_name']))
	{
		$stffids='';
		$sqlemp=mysql_query("SELECT usr_id FROM essort_user_header WHERE usr_fname like '%".$_REQUEST['emp_name']."%'");
		$stffids='';
		while($row=mysql_fetch_array($sqlemp))
		{
			$stffids.=$row['usr_id'].",";
		}
		$stffids=trim($stffids,",");
		if($stffids!='')
		{
			$cond.="AND usr_id IN ($stffids)";
		}
	}
	$sql=mysql_query("SELECT *,'TOTAL_PRESENT' FROM essort_user_header WHERE usr_role IN ('Teacher') $cond");
			$attregister=array();
			while($row=mysql_fetch_array($sql))
			{
				$date=date('Y-m-d');
				$month=$_REQUEST['attmonth'];
				$year=$_REQUEST['attsession'];
				if($month==1 || $month==2 || $month==3)
				{
					$year=substr($year,-4);
				}
				else
				{
					$year=substr($year, 0, 4);
				}
				echo $year;
				$number = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
				//$attregister[$row['usr_fname']]=$row;
				$totalpresent=0;
				for($i=1;$i<=$number;$i++)
				{
					$attdate=$year."-".$month."-".$i;
					$attdate=date('Y-m-d',strtotime($attdate));
					$status=$obj->getCurrentAttendenece($attdate,$row['att_ref_id']);
										if($status=='AB')
										{
											$tag='absent';
											$status='A';
										}
										else if($status=='PR')
										{
											$tag='present';
											$status='P';
											$totalpresent++;
										}
										else if($status=='LV')
										{
											$tag='cancel';
											$status='L';
										}
										else
										{


										}
					$attregister[$row['usr_fname']][$i]=$status;
					$attregister[$row['usr_fname']]['TOTAL_PRESENT']=$totalpresent;
				}
				print_r($attregister);


    }
	?>
	<thead>
      <tr>
        <th>Name</th>
        <!--<th>Emp ID</th>-->
		<?php
		for($i=1;$i<=$number;$i++)
		{
		?>
        <th><?php echo $i;?></th>
		   <?php
		   }
		   ?>
        <th>Total Present</th>

      </tr>
    </thead>
	 <tbody id="attdata">
	<?php
	foreach($attregister as $key=>$attvlue)
				{
				?>
				<tr>
        <td><?php echo $key;?></td>
        <!--<td>1001</td>-->
        <?php
		for($i=1;$i<=$number;$i++)
		{
			if($attvlue[$i]=='A')
			{
				$tag='warning';
			}
			else if($attvlue[$i]=='P')
			{
				$tag='';
			}
			else if($attvlue[$i]=='L')
			{
				$tag='info';
			}
			else if($attvlue[$i]=='S')
			{
				$tag='danger';
			}
			else if($attvlue[$i]=='H')
			{
				$tag='danger';
			}
		?>
        <td class="<?php echo $tag;?>"><?php echo $attvlue[$i];?></td>
		   <?php
		   }
		   ?>
        <td><?php echo $attvlue['TOTAL_PRESENT']; ?></td>


      </tr>
				<?php
				}
				?>
				</tbody>
				<?php
	//echo json_encode($attregister);


}

}

#######################################################################

/*************************FOR STUDENTS FEE SERCH ON School-student.php**************************/

/*************************FOR STUDENTS FEE SERCH ON School-student.php**************************/
if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'students_fee')) {
    require_once('' . $_REQUEST['session'] . '/classes/connection.php');
    require_once('classes/general_class.php');
    $obj = new General();
    if (($_REQUEST['session'] == '')) {
        echo 1;
        exit; // required Parametre missing
    } else {
        $classes = $_REQUEST['classes'];
        $section = $_REQUEST['section'];
        $studname = $_REQUEST['studname'];
        $role = $_REQUEST['role'];

		$sqlappheader=mysql_query("SELECT * FROM essort_application_header WHERE usr_fname like '%".$studname."%' AND usr_class_id='".$classes."'");
		$stuids="";
		$cond="";
		while($rowheader=mysql_fetch_array($sqlappheader))
		{
			$stuids.=$rowheader['usr_application_id'].",";
		}
		$stuids = rtrim($stuids, ",");   
		if($stuids!='')
		{
			$cond.=" AND stu_id IN (".$stuids.")";
		}
        ####################################################################################################################
        //SCHOOL STUDENTS.PHP
        $stusql=mysql_query("SELECT *, att_ref_id,'USERFNAME','USERLNAME',
        'att_status','att_intime','att_outtime' ,'app_no','att_id','amount','last_payment','last_date'
        FROM essort_user_relation WHERE class_id='".$classes."' AND sec_id='".$section."' $cond");
        if(mysql_num_rows($stusql) > 0)
        {
            $total_no_of_students= mysql_num_rows($stusql);
            $stuidarr=array();
            $stuatt=array();
            $amount = 0;
			$date =date('Y-m-d');
		$month =date("F",strtotime($date));
		
            while($rowstu=mysql_fetch_array($stusql))
            {
                $stuusql=mysql_fetch_array(mysql_query("SELECT * FROM essort_application_header WHERE usr_application_id=(SELECT stu_id FROM essort_user_relation WHERE att_ref_id='".$rowstu['att_ref_id']."' LIMIT 1) LIMIT 1"));
                $sqlatt=mysql_fetch_array(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id='".$rowstu['att_ref_id']."' AND att_date='".date('Y-m-d')."'"));
                //TOTAL FEE
                $sqltype=mysql_query("SELECT * FROM essort_fee_structure WHERE class_id='".$rowstu['class_id']."' AND sec_id='".$rowstu['sec_id']."'");
				$amount=0;
                while($rowtype=mysql_fetch_array($sqltype))
                {
                    if($rowtype['fee_elem_type']=='Monthly')
                    {
                        $rowtype['fee_elem_amount']=$rowtype['fee_elem_amount']*3;
                        $amount=$amount+$rowtype['fee_elem_amount'];
                    }
                    else
                    {
                        $a = $month;
						$montharr=explode(",",$rowtype['fee_elem_month']);
						if (in_array($a, $montharr)) {
							$amount=$amount+$rowtype['fee_elem_amount'];

						}
                    }

                }
                //last payment
                $sqllastpaymentsql=mysql_query("SELECT * FROM essort_fee_transaction WHERE user_id='".$rowstu['stu_id']."' ORDER BY fee_created_on DESC LIMIT 1");
                $laspaynumrows=mysql_num_rows($sqllastpaymentsql);
                $sqllastpayment=mysql_fetch_array($sqllastpaymentsql);
                if($laspaynumrows==0)
                {
                    $sqllastpayment['payment_amount_by_user']=0;
                    $sqllastpayment['fee_created_on']='-';
                }

                $rowstu['USERFNAME']=$stuusql['usr_fname'];
                $rowstu['USERLNAME']=$stuusql['usr_lname'];
                $rowstu['att_status']=$sqlatt['att_status'];
                $rowstu['att_intime']=$sqlatt['att_in_time'];
                $rowstu['att_id']=$sqlatt['attendence_id'];
                $rowstu['att_outtime']=$sqlatt['attout_time'];
                $rowstu['app_no']=$stuusql['usr_application_no'];
                $rowstu['amount']=$amount-$sqllastpayment['payment_amount_by_user'];
                $rowstu['last_payment']=$sqllastpayment['payment_amount_by_user'];
                $rowstu['last_date']=$sqllastpayment['fee_created_on'];

                $stuidarr[]=$rowstu;
            }
            $stunum_of_rows=mysql_num_rows($stusql);
			$link='../school-admin/school-admin-fee.php';
			if($role=='Principal')
			{
				$link='../principal/fees.php';
			}
			
				$i=1;
                foreach ($stuidarr as $stufeevalue) {
				
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo $stufeevalue['USERFNAME'];?></td>
                        <td><a href="../school-admin/school-profile.php"><img src="../images/images.png"></a>
                        </td>
                        <td><?php echo $stufeevalue['app_no'];?></td>
                        <td><?php echo $stufeevalue['last_payment'];?></td>
                        <td><?php echo $stufeevalue['last_date'];?></td>
                        <td><?php echo $stufeevalue['amount']?></td>
                        <td>
                            <a href="<?php echo $link;?>?id=<?php echo $stufeevalue['stu_id']?>"> <i class="fa fa-eye view_btn"
                                                                               aria-hidden="true"></i></a>

                        </td>

                    </tr>
                <?php
				$i++;
                }
        }
        else{
            ?>
            <tr>
                <td colspan="8">No record found</td>
            </tr>
            <?php
        }
    }
	}

#######################################################################
############################FOR CHECK PRINCIPAL ON MANAGE STAFF############################################
if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'staff_type')) {
    require_once('' . $_REQUEST['session'] . '/classes/connection.php');
    require_once('classes/general_class.php');
    $obj = new General();
    $staff_type = $_POST['staff_type'];
    if($staff_type == 'Principal'){
        $sql = mysql_query("SELECT * FROM essort_user_header WHERE  usr_role ='" . $staff_type . "'");
        if (mysql_num_rows($sql) > 0) {
            echo 1;
        }
    }

}
############################FOR INSERT CHECK DETAILS ############################################
if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'insert_cheque_details')) {
    require_once('' . $_REQUEST['session'] . '/classes/connection.php');
    require_once('classes/general_class.php');
    $obj = new General();
    $cheque_no_ajx = $_POST['cheque_no_ajx'];
    $user_id_ajx = $_POST['user_id_ajx'];

    $sql = mysql_query("UPDATE essort_fee_transaction
     SET
     status = 1
     WHERE user_id ='" . $user_id_ajx . "' AND cheque_no = '" . $cheque_no_ajx . "'");
    if (mysql_num_rows($sql) > 0) {
        echo 1;
        return 1;
    }

}
##############################FOR CHECK EXIST CARD NO#########################################
if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'cardentry')) {
    require_once('' . $_REQUEST['session'] . '/classes/connection.php');
    require_once('classes/general_class.php');
    $obj = new General();
    $cardno = $_POST['cardno'];
    $sql = mysql_query("SELECT att_ref_id FROM essort_user_header WHERE att_ref_id = '".$cardno."'");
    if (mysql_num_rows($sql) > 0) {
        echo 1;
    }
    else
    {
        echo 0;
    }
}


#######################################################################
if(isset($_REQUEST['action']) && ($_REQUEST['action']=='searchstugraph') ){
    require_once(''.$_REQUEST['session'].'/classes/connection.php');

    require_once('classes/general_class.php');
    $obj = new General();
    if(($_REQUEST['session']=='')){
        echo 1;exit;// required Parametre missing
    }else{
		$id=$_REQUEST['id'];
		$attsession=$_REQUEST['attsession'];
		$endyeararr=explode('-',$attsession);
		$endyear=$endyeararr[1];
		$session_start_date=$_REQUEST['session_start_date'];
		$session_end_date = date('Y-m-d', strtotime('+1 year',strtotime($session_start_date)));
		
		$todaydate = date('Y-m-d');
		//FIND ALL HOLIDAYS
		$sql = mysql_query("SELECT DATE_FORMAT(`off_day` , '%Y-%m-%d') as date
				FROM essort_holidays  WHERE occassion_type='Holiday' AND (DATE_FORMAT(off_day,'%Y-%m-%d') BETWEEN  '" . $session_start_date . "' AND '".$session_end_date."')") OR DIE(mysql_error());
		$holidays = array();
		while ($row = mysql_fetch_array($sql)) {
			$holidays[] = $row['date'];
		}
		//FIND ALL LEAVE OF STUDENT
		$sqlleave = mysql_query("SELECT leave_date as date
				FROM  essort_student_leave_info  WHERE usr_id=(SELECT stu_id FROM essort_user_relation WHERE att_ref_id='".$id."')") OR DIE(mysql_error());
		$leavearr = array();
		while ($row = mysql_fetch_array($sqlleave)) {
			$leavearr[] = $row['date'];
		}
		$holidays=array_merge($holidays,$leavearr);
		$workingdayssession = $obj->getWorkingDays($session_start_date, $session_end_date, $holidays);
	    $no_of_days_present_session=mysql_num_rows(mysql_query("SELECT * FROM essort_class_attendence WHERE stu_id=".$id." AND att_session='".$attsession."'"));
		$no_of_days_absent_session = $workingdayssession - $no_of_days_present_session;
		  $yearpresentpercentage = ($no_of_days_present_session / $workingdayssession) * 100;
    $yearabsentpercentage = ($no_of_days_absent_session / $workingdayssession) * 100;
	
			
		
        //echo $month = $_REQUEST['month'];
		 ob_start();
?>
<script>
$(function(){
var chart = AmCharts.makeChart( "chartdiv", {

                                                    "labelRadius": -40,
"labelText": "[[status]]: [[percents]]%",

"type": "pie",
"theme": "light",
"dataProvider": [ {
"status": "Present",
"value": (<?php echo $no_of_days_present_session; ?>+0)
}, {
"status": "Absent",
"value": (<?php echo $no_of_days_absent_session; ?>+0)
}],
"valueField": "value",
"titleField": "status",
"outlineAlpha": 0.4,
"depth3D": 25,
"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
"angle": 40,
"export": {
"enabled": true
}

});
});
</script>
<?php
  $script_content = ob_get_clean();
    }
	?>
	<tbody>
                        <tr>
                            <th>Present</th>
                            <td><?php echo $no_of_days_present_session."".$script_content;?></td>
                            <td><?php echo $yearpresentpercentage;?>%</td>
                        </tr>
                        <tr>
                            <th>Absent</th>
                            <td><?php echo $no_of_days_absent_session;?></td>
                            <td><?php echo $yearabsentpercentage;?>%</td>
                        </tr>
                        </tbody>
						<?php
}
#######################################################################

?>