<?php
require_once('connection.php');
require_once('email.class.php');
require_once('config.php');

class GROUP extends Connection{
	function __construct(){
		$this->createConnection();
	}
	function addGROUP(){
		//print_r($_REQUEST);
		if(isset($_REQUEST['group_name'] ,$_REQUEST['hq_address'])){
		
			$group_name = mysql_real_escape_string($_POST['group_name']);
			$group_login_email = mysql_real_escape_string($_POST['group_email']);
			$group_login_password = md5(123456);
			$group_address = $_POST['hq_address'];
			$group_city = $_POST['group_city'];
			$group_pincode = $_POST['group_pincode'];
			$group_contact1 = $_POST['group_contact1'];
			$group_contact2 = $_POST['group_contact2'];
			$group_alemail = $_POST['group_alemail'];
			$group_no_of_schools = $_POST['group_no_of_schools'];
			$chairman_name = $_POST['chairman_name'];
			$chairman_middlename = $_POST['chairman_middlename'];
			$chairman_lastname = $_POST['chairman_lastname'];
			$chairman_landlineno = $_POST['chairman_landlineno'];
			$chairman_contactno = $_POST['chairman_contactno'];
			$chairman_email = $_POST['chairman_email'];
			//Group Logo
			$addQuery='';
			$allExtarray = array("jpg","jpeg","png");
			if($_FILES["group_logo"]["name"]!='')
			{                            
				$ext10 = explode(".",$_FILES["group_logo"]["name"]);
				$ext =  strtolower(end($ext10));
				$img_name = substr($_FILES["group_logo"]["name"],0,-(strlen($ext)+1));
				$file_name = str_replace(" ","_",$img_name);                
		   
				if(!in_array($ext,$allExtarray))
				{                
					return 2;
				}      
				$upload_image = time().'_'.$file_name.'.'.$ext;
				//$dir_name=''.HTTP_SERVER_ADMIN.'uploads';
				$dir_name=$_SERVER['DOCUMENT_ROOT'] . '/development/admin/uploads';
				if(file_exists($dir_name."/".$upload_image))
				{                    
					@unlink($dir_name."/".$upload_image);
				}
				if(move_uploaded_file($_FILES["group_logo"]["tmp_name"],$dir_name."/".$upload_image))
				{
					$addQuery .= " , grp_logo='".$upload_image."'";
				}
			}else{
				return 4;
			}
			
			//chairman Logo
			$addchairmanimage='';
			if($_FILES["chairman_image"]["name"]!='')
			{                            
				$ext10 = explode(".",$_FILES["chairman_image"]["name"]);
				$ext =  strtolower(end($ext10));
				$img_name = substr($_FILES["chairman_image"]["name"],0,-(strlen($ext)+1));
				$file_name = str_replace(" ","_",$img_name);                
		   
				if(!in_array($ext,$allExtarray))
				{                
					return 2;
				}      
				$upload_image = time().'_'.$file_name.'.'.$ext;
				$dir_name=$_SERVER['DOCUMENT_ROOT'] . '/development/admin/uploads';
				if(file_exists($dir_name."/".$upload_image))
				{                    
					@unlink($dir_name."/".$upload_image);
				}
				if(move_uploaded_file($_FILES["chairman_image"]["tmp_name"],$dir_name."/".$upload_image))
				{
					$addchairmanimage .= " , grp_chairman_image='".$upload_image."'";
				}
			}else{
				return 5;
			}
			
			$group_other_info = '';
			//**************************************************************************************************/
			//INSERT GROUP 
			$insertPgQuery=mysql_query("insert into essort_group set grp_name ='".$group_name."' , grp_hq_address='".$group_address."' ,grp_city='".$group_city."', grp_pincode='".$group_pincode."' ,grp_contact1='".$group_contact1."',grp_contact2='".$group_contact2."', grp_email='".$group_login_email."',grp_alemail='".$group_alemail."',grp_no_of_schools='".$group_no_of_schools."',grp_chairman_name='".$chairman_name."',grp_chairman_mname='".$chairman_middlename."',grp_chairman_lname='".$chairman_lastname."',grp_chairman_landlineno='".$chairman_landlineno."',grp_chairman_contactno='".$chairman_contactno."',grp_chairman_email='".$chairman_email."',grp_password='".$group_login_password."' ".$addQuery."  ".$addchairmanimage."");
			if($insertPgQuery){
				
				
			}else{
				return 0;
			}
			
			
			return 1;
			
		}else{
			return 3;
		}
	}
	
	function UPDATEGROUP(){
		//print_r($_REQUEST);
		if(isset($_REQUEST['group_name'] ,$_REQUEST['hq_address'])){
		
			$group_name = mysql_real_escape_string($_POST['group_name']);
			$group_login_email = mysql_real_escape_string($_POST['group_email']);
			$group_login_password = md5(123456);
			$group_address = $_POST['hq_address'];
			$group_city = $_POST['group_city'];
			$group_pincode = $_POST['group_pincode'];
			$group_contact1 = $_POST['group_contact1'];
			$group_contact2 = $_POST['group_contact2'];
			$group_alemail = $_POST['group_alemail'];
			$group_no_of_schools = $_POST['group_no_of_schools'];
			$chairman_name = $_POST['chairman_name'];
			$chairman_middlename = $_POST['chairman_middlename'];
			$chairman_lastname = $_POST['chairman_lastname'];
			$chairman_landlineno = $_POST['chairman_landlineno'];
			$chairman_contactno = $_POST['chairman_contactno'];
			$chairman_email = $_POST['chairman_email'];
			//Group Logo
			$addQuery='';
			$allExtarray = array("jpg","jpeg","png");
			if($_FILES["group_logo"]["name"]!='')
			{                            
				$ext10 = explode(".",$_FILES["group_logo"]["name"]);
				$ext =  strtolower(end($ext10));
				$img_name = substr($_FILES["group_logo"]["name"],0,-(strlen($ext)+1));
				$file_name = str_replace(" ","_",$img_name);                
		   
				if(!in_array($ext,$allExtarray))
				{                
					return 2;
				}      
				$upload_image = time().'_'.$file_name.'.'.$ext;
				//$dir_name=''.HTTP_SERVER_ADMIN.'uploads';
				$dir_name=$_SERVER['DOCUMENT_ROOT'] . '/development/uploads';
				if(file_exists($dir_name."/".$upload_image))
				{                    
					@unlink($dir_name."/".$upload_image);
				}
				if(move_uploaded_file($_FILES["group_logo"]["tmp_name"],$dir_name."/".$upload_image))
				{
					$addQuery .= " , grp_logo='".$upload_image."'";
				}
			}
			//chairman Logo
			$addchairmanimage='';
			if($_FILES["chairman_image"]["name"]!='')
			{                            
				$ext10 = explode(".",$_FILES["chairman_image"]["name"]);
				$ext =  strtolower(end($ext10));
				$img_name = substr($_FILES["chairman_image"]["name"],0,-(strlen($ext)+1));
				$file_name = str_replace(" ","_",$img_name);                
		   
				if(!in_array($ext,$allExtarray))
				{                
					return 2;
				}      
				$upload_image = time().'_'.$file_name.'.'.$ext;
				$dir_name=$_SERVER['DOCUMENT_ROOT'] . '/development/uploads';
				if(file_exists($dir_name."/".$upload_image))
				{                    
					@unlink($dir_name."/".$upload_image);
				}
				if(move_uploaded_file($_FILES["chairman_image"]["tmp_name"],$dir_name."/".$upload_image))
				{
					$addchairmanimage .= " , grp_chairman_image='".$upload_image."'";
				}
			}
			
			$group_other_info = '';
			//**************************************************************************************************/
			//INSERT GROUP 
			$insertPgQuery=mysql_query("update essort_group set grp_name ='".$group_name."' , grp_hq_address='".$group_address."' ,grp_city='".$group_city."', grp_pincode='".$group_pincode."' ,grp_contact1='".$group_contact1."',grp_contact2='".$group_contact2."', grp_email='".$group_login_email."',grp_alemail='".$group_alemail."',grp_no_of_schools='".$group_no_of_schools."',grp_chairman_name='".$chairman_name."',grp_chairman_mname='".$chairman_middlename."',grp_chairman_lname='".$chairman_lastname."',grp_chairman_landlineno='".$chairman_landlineno."',grp_chairman_contactno='".$chairman_contactno."',grp_chairman_email='".$chairman_email."',grp_password='".$group_login_password."' ".$addQuery."  ".$addchairmanimage." WHERE ");
			if($insertPgQuery){
				
				
			}else{
				return 0;
			}
			
			
			return 1;
			
		}else{
			return 3;
		}
	}
	
	/********************************************8*/
	
	function addSchool(){
                                //print_r($_REQUEST);
                //,$_REQUEST['sch_affiliated_by'],$_REQUEST['sch_affiliation_no'],$_REQUEST['sch_tag_line'],$_REQUEST['sch_logo'],$_REQUEST['sch_image1'],$_REQUEST['sch_image2'],$_REQUEST['sch_desc'],$_REQUEST['sch_local_address'],$_REQUEST['sch_city'],$_REQUEST['sch_state'],$_REQUEST['sch_pin'],$_REQUEST['sch_country'],$_REQUEST['sch_contact_person_name'],$_REQUEST['sch_contact_phone'],$_REQUEST['sch_contact_phone1'],$_REQUEST['sch_contact_phone2'],$_REQUEST['sch_contact_email1'],$_REQUEST['sch_contact_email2'],$_REQUEST['sch_bank_name_address'],$_REQUEST['sch_bank_account_no'],$_REQUEST['sch_bank_ifsc_code'],$_REQUEST['sch_brochure1'],$_REQUEST['sch_brochure2'])
                                if(isset($_REQUEST['group_name'] ,$_REQUEST['school_name']))
                                {
                                                //$group_other_info = $_POST['group_other_info'];
                                //**************************************************************************************************/
                                                //INSERT PG INFORMATIONS sch_tag_line
                                                $sch_desc='Children come to us as toddlers. They will leave school as young adults, their personalities and potential largely determined by their experiences in school. The primary school years are perhaps the most significant. By the age of eleven the child has learnt how to read and has grasped the rudiments of number and quantity. But more than that, they should have learnt to love reading, to be fascinated by numbers, and to enjoy finding out things in answer to their own questions.';
												
												
                                                $insertPgQuery=mysql_query("insert into essort_school_info set grp_id ='".$_REQUEST['group_name']."' ,sch_name='".$_REQUEST['school_name']."' ,sch_affiliated_by='".$_REQUEST['sch_affiliated_by']."', sch_affiliation_no='".$_REQUEST['sch_affiliation_no']."' , sch_tag_line='".$_REQUEST['sch_tag_line']."', sch_desc='".$sch_desc."', sch_local_address='".$_REQUEST['sch_local_address']."', sch_city='".$_REQUEST['sch_city']."', sch_state='".$_REQUEST['sch_state']."', sch_pin='".$_REQUEST['sch_pin']."', sch_country='".$_REQUEST['sch_country']."', sch_contact_person_name='".$_REQUEST['sch_contact_person_name']."', sch_contact_phone='".$_REQUEST['sch_contact_phone']."', sch_contact_phone1='".$_REQUEST['sch_contact_phone1']."', sch_contact_phone2='".$_REQUEST['sch_contact_phone2']."', sch_contact_email1='".$_REQUEST['sch_contact_email1']."', sch_contact_email2='".$_REQUEST['sch_contact_email2']."', sch_bank_name_address='".$_REQUEST['sch_bank_name_address']."', sch_bank_account_no='".$_REQUEST['sch_bank_account_no']."', sch_bank_ifsc_code='".$_REQUEST['sch_bank_ifsc_code']."', sch_fb_link='".$_REQUEST['sch_fb_link']."', sch_twitter_link='".$_REQUEST['sch_twitter_link']."', sch_gplus_link='".$_REQUEST['sch_gplus_link']."'");
                                                
												if($insertPgQuery){
                                                                $pg_id=mysql_insert_id();
                                                                //$gcode='S';
                                                                //$code=$gcode."".$pg_id; 
                                                                $code=$_REQUEST['sch_url']; 
                                                                $allExtarray = array("jpg","jpeg","png");
                                                                $addchairmanimage='';
                                                                if (!file_exists($code)) {
																		mkdir('../../'.$code.'', 0777, true);
																		mkdir('../../'.$code.'/uploads', 0777, true);
																		$desc="".$code."/classes/";
																		mkdir('../../'.$desc.'', 0777, true);
                                                                    }

                                                                if($_FILES["sch_logo"]["name"]!='')
                                                                {                            
                                                                                $ext10 = explode(".",$_FILES["sch_logo"]["name"]);
                                                                                $ext =  strtolower(end($ext10));
                                                                                $img_name = substr($_FILES["sch_logo"]["name"],0,-(strlen($ext)+1));
                                                                                $file_name = str_replace(" ","_",$img_name);                
                                                   
                                                                                if(!in_array($ext,$allExtarray))
                                                                                {                
                                                                                                return 2;
                                                                                }      
                                                                                $upload_image = time().'_'.$file_name.'.'.$ext;
                                                                                $dir_name=$_SERVER['DOCUMENT_ROOT'] . 'ssort/'.$code.'/uploads';
                                                                                if(file_exists($dir_name."/".$upload_image))
                                                                                {                    
                                                                                                @unlink($dir_name."/".$upload_image);
                                                                                }
                                                                                if(move_uploaded_file($_FILES["sch_logo"]["tmp_name"],$dir_name."/".$upload_image))
                                                                                {
                                                                                                $addchairmanimage .= " , sch_logo='".$upload_image."'";
                                                                                }
                                                                }
                /*****************************LOGIN BACKGROUND IMAGE************************************/
                $addbgimage='';
                if($_FILES["sch_background_image"]["name"]!='')
                {
                    $ext1 = explode(".",$_FILES["sch_background_image"]["name"]);
                    $ext2 =  strtolower(end($ext1));
                    $img_b_name = substr($_FILES["sch_background_image"]["name"],0,-(strlen($ext2)+1));
                    $file_b_name = str_replace(" ","_",$img_b_name);

                    if(!in_array($ext2,$allExtarray))
                    {
                        return 2;
                    }
                    $upload_b_image = time().'_'.$file_b_name.'.'.$ext2;
                    $dir_name=$_SERVER['DOCUMENT_ROOT'] . 'ssort/'.$code.'/uploads';
                    if(file_exists($dir_name."/".$upload_b_image))
                    {
                        @unlink($dir_name."/".$upload_b_image);
                    }
                    if(move_uploaded_file($_FILES["sch_background_image"]["tmp_name"],$dir_name."/".$upload_b_image))
                    {
                        $addbgimage .= " , sch_background_image='".$upload_b_image."'";
                    }
                }
                /************************LOGIN BACKGROUND IMAGE NOT INSERTING JYOTI MAM PLEASE DO THIS*********************************/
                                                                $updatePgQuery=mysql_query("update essort_school_info set sch_reg_no ='".$code."' ".$addchairmanimage." ".$addbgimage." WHERE sch_id='".$pg_id."'");
																##############CREATE DB SCRIPT###########################
																error_reporting(E_ALL); 
																ini_set('display_errors', 1);
																require("xmlapi.php"); // this can be downlaoded from https://github.com/CpanelInc/xmlapi-php/blob/master/xmlapi.php

																$opts = array( "cpanelUserName" => "ssort", //Cpanel UserUserName 
																"cpanelPassword" => "yFaNy~{8]ize", //Cpanel UserPassword 
																"dbPassword" => "DatabasePassword", //DatabasePassword
																"dbusername" => "DatabaseUserbame", //DatabaseUsername 
																); 


																$host = "gains.nanosupercloud.com";
																$xmlapi = new xmlapi($host);   
																$xmlapi->set_port( 2083 );   
																//$xmlapi->password_auth($opts['user'],$opts['pass']);  
																$xmlapi->password_auth($opts['cpanelUserName'],$opts['cpanelPassword']);  
																$xmlapi->set_debug(0);//output actions in the error log 1 for true and 0 false 

																$cpaneluser="ssort";
																$databasename=$code;
																$databaseuser=$code."user";
																$databasepass="U,VM;(_H7cv";
																
																$createdb = $xmlapi->api1_query($cpaneluser, "Mysql", "adddb", array($databasename));   
																//create user 
																$usr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduser", array($databaseuser, $databasepass));    
																//print_r($usr);
																//add user 
																$addusr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduserdb", array("".$cpaneluser."_".$databasename."", "".$cpaneluser."_".$databaseuser."", 'all'));
																#########################################
																 $dbmaster = mysql_connect('localhost', 'ssort_school12', 'x5@q}nvg.vRK');
                                                                 mysql_select_db("eesort_master", $dbmaster);
																$sqlmaster=mysql_fetch_array(mysql_query("SELECT * FROM essort_school_info LIMIT 1",$dbmaster));
																$sqldbsetting=mysql_fetch_array(mysql_query("SELECT * FROM eesort_db_setting WHERE database_school_id='".$sqlmaster['sch_reg_no']."'",$dbmaster));
																
																###############################################33
																$dbnew = mysql_connect('localhost', $sqldbsetting['database_user'],$sqldbsetting['database_pass']);
                                                                mysql_select_db($sqlmaster['sch_reg_no'], $dbnew);
																
																echo "SHOW TABLES FROM ".$sqlmaster['sch_reg_no']."";
                                                                $sqltable = mysql_query("SHOW TABLES FROM ".$sqlmaster['sch_reg_no']."",$dbnew)  OR die('Query Main error:<br />' .mysql_error());
																
																$prefix='ssort_';
																echo $hostname=$prefix."".$databaseuser;
																echo $databasepass;
																 $dbneww = mysql_connect('localhost', $hostname, $databasepass); 
																 $dbname=$prefix."".$code;
                                                                  mysql_select_db($dbname, $dbneww);
																###############################################33
                                                                while ($row = mysql_fetch_array($sqltable))
                                                                {
																	echo "SHOW CREATE TABLE ".$row['Tables_in_'.$sqlmaster['sch_reg_no'].'']."";
																	
                                                                                $ca=mysql_query("SHOW CREATE TABLE ".$row['Tables_in_'.$sqlmaster['sch_reg_no'].'']."",$dbnew) OR die('Query 2 error:<br />' .mysql_error());
                                                                                $tableinfo = mysql_fetch_row($ca);
                                                                                print_r($tableinfo);
                                                                                //echo $tableinfo[1];
                                                                               
                                                                                $createsyntax = "CREATE TABLE IF NOT EXISTS ";
                                                                                $createsyntax .= substr($tableinfo[1], 13);
                                                                                echo $createsyntax;
                                                                                $createsyntaxres=mysql_query($createsyntax,$dbneww) OR die('Query 3 error:<br />' .mysql_error());
                                                                                //exit;
                                                                                $source = "../../classes/config.php";
                                                                                $sourceconn = "../../classes/connection.php";
                                                                                $sourceloginconn = "../../signin.php";
                                                                                /*if (!file_exists($code)) {
                                                                                                mkdir('../../'.$code.'', 0777, true);
                                                                                                $desc="".$code."/classes/";
                                                                                                mkdir('../../'.$desc.'', 0777, true);
                                                                                }*/
                                                                                                
                                                                                                
                                                                                $dest = "../../".$code."/classes/config.php";
                                                                                $destconn = "../../".$code."/classes/connection.php";
                                                                                $destloginconn = "../../".$code."/index.php";
                                                                                copy($source, $dest);
                                                                                copy($sourceconn, $destconn);
                                                                                copy($sourceloginconn, $destloginconn);
                                                                                file_put_contents($destconn,str_replace('ssort_school12',''.$code.'',file_get_contents($destconn)));
										
										file_put_contents($destconn,str_replace('x5@q}nvg.vRK','U,VM;(_H7cv',file_get_contents($destconn)));
										
                
                                                                }
                                                                //INSERT SCHOOL ADMIN DETAILS
                                                                $pass=rand();
                                                                $sqlschool="INSERT INTO essort_user_header SET usr_role='SAD',usr_fname='".$_REQUEST['sch_contact_person_name']."',usr_gender='',usr_dob='',usr_phone='".$_REQUEST['sch_contact_phone']."',usr_mobile='".$_REQUEST['sch_contact_phone']."',usr_status='0',usr_email='".$_REQUEST['sch_contact_email1']."',password='".$pass."'";
                                                                $addsqlres=mysql_query($sqlschool,$dbneww) OR die('Query School User error:<br />' .mysql_error());
                                                                //exit;
                                                }else{
                                                                return 0;
                                                }
                                                
                                                
                                                return 1;
                                                
                                }else{
                                                return 3;
                                }
                }

	/******************************************** SHOW TABLES FROM DATABASE *******************************************************/
	/******************************************* PG BOOKING STATUS *************************************************************************/
	function sendMail($to , $toname , $subject , $bodyData){
	
		$emailobj = new Emailclass();
		$emailobj->mailaccount='vibescom';
		$emailobj->to=$to;
		$emailobj->toname=$toname;
		//$emailObj1->bcc=Email_BCC;
		$emailobj->from=ORDEREMAIL;
		$emailobj->fromname=ORDERNAME;
		$emailobj->subject = $subject;
		$emailobj->body.="
				<table style='width:600px; margin:0 auto; padding: 10px 0; border-collapse: collapse; table-layout: auto;vertical-align: top;'>
				<tr>
					<td align='left' style='padding: 7px; border-collapse: collapse; font-size: 12px; font-family:Verdana, Geneva, sans-serif;'>
						<table class='tables2' style=' width: 100%; border-collapse: collapse; table-layout: auto;vertical-align: top; margin: 0px 0 5px;'>
							<tr>
								<th width='48%' colspan='2' style='padding: 2px; border-collapse: collapse; font-size: 12px; table-layout: auto; vertical-align: middle;text-align:left;'>
									<img src='".IMAGEPATH."'/>
								</th>
							</tr>
							".$bodyData."
							<tr>
								<td width='15%' style='padding: 3px 3px 3px 3px;'></td><td style='padding: 3px 3px 3px 3px;'></td>
							</tr>
							<tr>
								<td width='50%' style='padding: 3px 3px 3px 3px;'>
								Thanks, <br/>							
								".ORDERNAME."<br/>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				</table>";
		$send= $emailobj->sendemail();
		
		/*print_r($emailobj);
		echo '--------';
		echo $send;
		die();*/
		return $send;
	
	}
}
?>