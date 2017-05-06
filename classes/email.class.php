<?php
class Email
{ 
	var $mailaccount = '';
	var $to = '';
	var $toname = '';
	var $from = '';
	var $fromname  = '';
	var $bcc = '';
	var $cc = '';
	var $subject = "";
	var $body = "";
	var $allbcc = array();
	var $allcc = array();
	var $allto = array();
	var $alltoname = array();
	var $temp_tonamelist = '';
	var $tem_bcclist = '';
	var $tem_cclist = '';
	var $tonamelist = '';
	
	
	function getMailAccount($for)
	{
		
		$array = Array();
		if($for == 'anairas')
		{
			 $array['api_user'] = "vibescom";
			$array['api_key'] = "123-vibes-456";
			
		}
		return $array; 
	}
	
	function validate()
	{
		// trim all the variables
		if($this->mailaccount == '')
		{
			return "Mail Account is Empty.";
		}
		
		$mail_account = $this->getMailAccount($this->mailaccount);
		if(!(isset($mail_account['api_user'])) || $mail_account['api_user'] == '')
		{
			return "Mail Account <b>".$this->mailaccount."</b> does't exit.";
		}
		
		if($this->to == '')
		{
			return "Email To List is blank";
		}
		
		$tolist = explode(",",$this->to);
		if($this->toname != "")
		{
			$tonamelist = explode(",",$this->toname);
			if(sizeof($tonamelist) != sizeof($tolist))
			{
				return "Count of Email To List and Email Toname are not same";
			}
		}
		//echo $this->allto;
		for($z=0;$z<sizeof($tolist);$z++)
		{
			$tolist[$z] = trim($tolist[$z]);
			if($this->toname != "")
			{
				$tonamelist[$z] = trim($tonamelist[$z]);
			}
			if($tolist[$z]== '')
			{
				continue;
			}
			// pattern match for Email
			else if (!filter_var($tolist[$z],FILTER_VALIDATE_EMAIL)) 
			{
				return "To EmailId : <b>".$tolist[$z]."</b> is not valid";
			} 
			else
			{
				array_push($this->allto,$tolist[$z]);
				if($this->toname != "")
				{
					array_push($this->alltoname,$tonamelist[$z]);
				}
			}
		}
		
		if($this->bcc != "")
		{
			$bcclist = explode(",",$this->bcc);
			if(sizeof($bcclist) > 10)
			{
				return "Bcc List can't be greater than 10 Email-Ids.";
			}
			for($i=0;$i<sizeof($bcclist);$i++)
			{
				$bcclist[$i] = trim($bcclist[$i]);
				if($bcclist[$i]== '')
				{
					continue;
				}
				else if (!filter_var($bcclist[$i], FILTER_VALIDATE_EMAIL)) 
				{
					return "BCC EmailId : <b>".$bcclist[$i]."</b> is not valid";
				}
				else
				{
					array_push($this->allbcc,$bcclist[$i]);
				}
			}
		}
		
		
		if($this->cc != "")
		{
			$cclist = explode(",",$this->cc);
			if(sizeof($cclist) > 10)
			{
				return "CC List can't be greater than 10 Email-Ids.";
			}
			for($i=0;$i<sizeof($cclist);$i++)
			{
				$cclist[$i] = trim($cclist[$i]);
				if($cclist[$i]== '')
				{
					continue;
				}
				else if (!filter_var($cclist[$i], FILTER_VALIDATE_EMAIL)) 
				{
					return "CC EmailId : <b>".$cclist[$i]."</b> is not valid";
				}
				else
				{
					array_push($this->allcc,$cclist[$i]);
				}
			}
		}
		
		if($this->fromname == '')
		{
			return "From Name is Empty.";
		}
		 
		if($this->from == '')
		{
			return "From EmailId is Empty.";
		}
		// pattern match check for From Email
		if(!filter_var($this->from, FILTER_VALIDATE_EMAIL)) 
		{
			return "From EmailId : <b>".$this->from."</b> is not valid";
		}
		if($this->subject == '')
		{
			return "Subject is Empty.";
		}
		if($this->body == '')
		{
			return "Body is Empty.";
		}
		return "0";
	}
	
	function sendemail()
	{
		$validate_res = $this->validate();
		if($validate_res != "0")
		{
			return $validate_res;
		}
		
		$message = preg_replace('/\"/', '\\"', $this->body);
		$arr = $this->getMailAccount($this->mailaccount);
		
		if($this->bcc != "")
		{
			for($i=0;$i<sizeof($this->allbcc);$i++)
			{
				$this->tem_bcclist .= " -F bcc[]=".trim($this->allbcc[$i]);
			}
		}
		
		if($this->cc != "")
		{
			for($i=0;$i<sizeof($this->allcc);$i++)
			{
				$this->tem_cclist .= " -F cc[]=".trim($this->allcc[$i]);
			}
		}
		
		$temp_tolist = '';
		$temp_tolist1 = '';
		$error = '';
		for($i=0;$i<sizeof($this->allto);$i++)
		{	
			//$msg = urlencode($message);
			if(sizeof($this->alltoname) > 0)
			{
				$temp_tolist .= "&to=".$this->allto[$i]."&toname=".$this->alltoname[$i]."";
			}
			else
			{
				$temp_tolist .= "&to=".$this->allto[$i];
			}
			$temp_tolist1 .= $this->allto[$i].",";
			
			$sendemail = 0;
			ob_start();	//ratnesh
			if(($i+1) % 20 == 0)
			{
				//$rtnMSG1 = system("curl ".$temp_tolist." -F subject=\"".$this->subject."\" -F text=\"\" --form-string html=\"".$message."\" ".$this->tem_bcclist." ".$this->tem_cclist." -F from=".$this->from." -F fromname=".$this->fromname." -F api_user=".$arr['api_user']." -F api_key=".$arr['api_key']." https://sendgrid.com/api/mail.send.json");
				//$this->tem_bcclist = '';
			   //	$this->tem_cclist = '';
				$url="https://api.sendgrid.com/api/mail.send.json?api_user=".$arr['api_user']."&api_key=".$arr['api_key']."".$temp_tolist."&subject=".$this->subject."&text=".$message."&from=".$this->from."";
				$rtnMSG1 = file_get_contents($url);
				
				
				$sendemail = 1;
			}
			else if(($i+1) == sizeof($this->allto))
			{
				$url="https://api.sendgrid.com/api/mail.send.json?api_user=".$arr['api_user']."&api_key=".$arr['api_key']."".$temp_tolist."&subject=".$this->subject."&text=".$message."&from=".$this->from."";
				
				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => $url,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"Access-Control-Allow-Origin: *"
					 ),
				));
				$rtnMSG1 = curl_exec($curl);
				$err = curl_error($curl);
				print_r($err);
				exit();
			
				$sendemail = 1;
			}
			ob_end_clean();	//ratnesh
			if($sendemail == 1)
			{
				$obj1 = json_decode($rtnMSG1);
				if(($obj1->message=='success')) 
				{}
				else
				{
					$error .= "\n"."<br/>".$obj1->message."\n"."<br/>";
					for($m=0; $m<sizeof($obj1->errors); $m++)
					{
						$error .= $obj1->errors[$m]."<br/>"."\n";
					}
					$error .= "\n"."<br/>for emails"."\n"."<br/>".$temp_tolist1;
				}
				$temp_tolist = '';
				$temp_tolist1 = '';
				$sendemail = 0;
			}
		}
		
		$obj1 = json_decode($rtnMSG1);
		if($error == '')
		{
			return "1";
		}
		else
		{
			return $error;
		}
	}
}
?>