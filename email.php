<?php

require_once('classes/email.class.php');

//###############SEND MAIL TO PG OWNER######################################
				$emailobj = new Email();
				$emailobj->mailaccount='anairas';
				$emailobj->to='jyoti.sharma@vibescom.in';
				$emailobj->toname='jyoit';
				$emailobj->from='jyotics09@gmail.com';
				$emailobj->fromname='nsme';
				$emailobj->subject = 'A visitor has tried to Enquire about a PG';
				$emailobj->body="dfgsdjgjfghjfdghfjdfgfdgfdgfdg";
				echo '<pre>';
				print_r($emailobj);
				echo $send= $emailobj->sendemail();
?>