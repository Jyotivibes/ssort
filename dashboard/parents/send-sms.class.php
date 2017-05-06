<?php
class SMS
{ 
	var $accountName = '';
	var $message = '';
	var $mobile = '';
	var $CLI = '';
	var $allmobile = array();
	var $error_code = "";
	var $error_xml = "";
	
	function getErrorCodeMessage($str)
	{
		$errcode=array();
		$errcode['101'] = 'Missing mobile number.';
		$errcode['102'] = 'Missing message.';
		$errcode['103'] = 'Missing senderID.';
		$errcode['104'] = 'Missing user name.';
		$errcode['105'] = 'Missing Password';
		$errcode['106'] = 'Missing message ID';
		$errcode['201'] = 'Invalid user name or password';
		$errcode['202'] = 'Invalid mobile number';
		$errcode['203'] = 'Invalid senderID';
		$errcode['204'] = 'Empty message';
		$errcode['205'] = 'This route is dedicated for high traffic. You should Try with minimum 20 Mobile Numbers in each request.';
		$errcode['206'] = 'Invalid Date Format Please use this format (2013-06-17 19:18:48).';
		$errcode['301'] = 'Not have sufficient balance to send sms.';
		$errcode['302'] = 'Expired user account.';
		$errcode['303'] = 'Banned user account.';
		$errcode['304'] = 'User not exist.';
		$errcode['305'] = 'Send sms limit exceed (Only 99 SMS Can Be Sent At A Time).';
		$errcode['306'] = 'Unable to fetch balance.';
		$errcode['2'] = 'User Already Exist.';
		$errcode['5'] = 'Invalid User Name.';
		$errcode['8'] = 'User Type Not Defined.';
		$errcode['402'] = 'Unable To Get SMS Sending Records. Message Not Sent';
		$errcode['1'] = 'Unable to connect database.';
		$errcode['2'] = 'Unnable to select database.';
		$errcode['201'] = 'Invalid user name or password';
		$errcode['202'] = 'Invalid message ID';
		$errcode['302'] = 'Expired user account.';
		$errcode['303'] = 'Banned user account.';
		$errcode['304'] = 'User not exist.';
		$errcode['400'] = 'Fatal Error In Loading �Sent Reports Details';
		$errcode['401'] = 'Invalid Message Id or Delivery Report Not generated yet';
		$errcode['501'] = 'Some Operator Side Issue. Please Contact To Your Provider.';
		$errcode['600'] = 'Sender id must be Verified';
		$errcode['601'] = 'Sender id must be numeric';
		$errcode['602'] = 'Your Current Route is disabled,Kindly Select another Route';
		$errcode['603'] = 'This Sender ID is blacklisted, Please Use a different Sender ID.';
		$errcode['604'] = 'Please Enter Atleast One Correct Number To Send SMS';
		$errcode['605'] = 'Unable To Get Your Balance';
		$errcode['606'] = 'Scheduled Date Cannot Be More than Three Weeks';
		$errcode['607'] = 'Scheduled Date Cannot Be Less Than Current Date';
		$errcode['608'] = 'Scheduled SMS Cannot Be Less Than Current Time';
		$errcode['609'] = 'End Time Cannot Be Less Than Or Equal To Schedule Time';
		$errcode['610'] = 'Duration can not be set to be zero';
		$errcode['611'] = 'You Do Not Have Sufficient Balance To Send SMS.';
		$errcode['612'] = 'All numbers are Dnd Kindly Enter 1 Non Dnd Number';
		$errcode['613'] = 'No voice file found Please enter voice file and proceed';
		$errcode['614'] = 'Invalid file Type,Allow Extension are wav,wave,mp3,wma,ra,m4a,arm';
		$errcode['615'] = 'Unable to Create your request,Please contact your administrator';
		$errcode['616'] = 'Unable to save file .';
		$errcode['617'] = 'Unable to Update user balance record';
		$errcode['618'] = 'File not Uploaded';
		$errcode['619'] = 'All Mobile Numbers are blocked Please Enter Atleast One Correct Number To Send SMS';

		$str = explode(":",$str);
		$new_str=trim($str[1]);
		if(isset($errcode[$new_str]) && $errcode[$new_str] != '')
		{
			return $errcode[$new_str];
		}
		else
		{
			return "Error code: ".$new_str." is not defined";
		}
	}
	
	function getUsernamePass($for)
	{
		$array = Array();
		if($for == 'vibescom')
		{
			$array['username'] = "imperishapi";
			$array['password'] = "del12345";
		}
		
		
		return $array; 
	}
	
	function validate()
	{
		if($this->accountName == '')
		{
			return "SMS Account name is blank.";
		}
		
		$sms_account = $this->getUsernamePass($this->accountName);
		if(!(isset($sms_account['username'])) || $sms_account['username'] == '')
		{
			return "SMS Account <b>".$this->accountName."</b> does't exit.";
		}
		
		if($this->message == '')
		{
			return "Message is empty.";
		}
		
		if($this->CLI == '')
		{
			return "CLI is empty.";
		}
		
		if($this->mobile == '')
		{
			return "Mobile field can't be blank.";
		}
		$temp_mobile = explode(",",$this->mobile);
		for($z=0;$z<sizeof($temp_mobile);$z++)
		{
			$temp_mobile[$z] = trim($temp_mobile[$z]);
			if($temp_mobile[$z] == '')
			{
				continue;
			}
			$mobile_replace = preg_replace("/^\+?91/","",$temp_mobile[$z]);
			if (strlen($mobile_replace) != 10 ) 
			{
				return "Mobile Number <b>".$temp_mobile[$z]."</b> length should be of 10 digits only.";
			}
			else
			{
				array_push($this->allmobile,$temp_mobile[$z]);
			}
		}
		return "0";
	}
	function sendsms()
	{
		$validate_res = $this->validate();
		if($validate_res != "0")
		{
			return $validate_res;
		}
		$arr = Array();
		$msg = urlencode($this->message);
		$arr = $this->getUsernamePass($this->accountName);
		$temp_mobile = '';
		
		for($i=0;$i<sizeof($this->allmobile);$i++)
		{
			if($temp_mobile == '')
			{
				$temp_mobile = $this->allmobile[$i];
			}
			else
			{
				$temp_mobile .= ",".$this->allmobile[$i];
			}
			
			if(($i+1) % 50 == 0)
			{
				//$url = "http://india.msg91.com/sendhttp.php?user=".$arr['username']."&password=".$arr['password']."&mobiles=".$temp_mobile."&message=".$msg."&sender=".$this->CLI;
				echo "URL::::::::::::::::::::::".$url = "http://203.212.70.200/smpp/sendsms?username=".$arr['username']."&password=".$arr['password']."&to=".$temp_mobile."&text=".$msg."&category=bulk&from=".$this->CLI;
				$xml = file_get_contents($url);
				if(preg_match("/^code/", $xml))
				{
					$this->error_code = $this->getErrorCodeMessage($xml);
					$this->error_xml .= "\n"."<br/>Error code: ".$this->error_code."\n"."<br/>"."\n"."for Mobile nos "."\n"."<br/>".$temp_mobile;
				}
				$temp_mobile = '';
			}
			else if(($i+1) == sizeof($this->allmobile))
			{
				//$url = "http://india.msg91.com/sendhttp.php?user=".$arr['username']."&password=".$arr['password']."&mobiles=".$temp_mobile."&message=".$msg."&sender=".$this->CLI;
				//$url = "http://203.212.70.200/smpp/sendsms?username=".$arr['username']."&password=".$arr['password']."&to=".$temp_mobile."&text=".$msg."&category=bulk&from=".$this->CLI;
				$url = "http://203.212.70.200/smpp/sendsms?username=".$arr['username']."&password=".$arr['password']."&to=".$temp_mobile."&from=SSORT&text=".$msg."&category=bulk";
				
				//$xml = file_get_contents($url);
                $ch = curl_init($url);
                $xml = curl_exec($ch);

				//echo $url;
				//print_r($xml);
				if(preg_match("/^code/", $xml))
				{
					$this->error_code = $this->getErrorCodeMessage($xml);
					$this->error_xml .= "\n"."<br/><br/>Error code: ".$this->error_code."\n"."<br/>"."\n"."for Mobile nos "."\n"."<br/>".$temp_mobile;
				}
			}
		}
		
		if($this->error_xml == '')
		{
			return "SMS Sent Successfully";
		}
		else
		{
			return $this->error_xml;
		}
	}
}
?>