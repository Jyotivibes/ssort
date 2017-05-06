<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>School Management System - SMS | Fee Structure Full View</title>
							<?php include '../includes/head.php'; ?>	
</head>
<body>
<div id="wrapper">
 <?php include '../includes/header-configuration.php'; ?>
 <?php include '../includes/sidebar-configuration.php'; ?>          
   <?php
 if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='SAD') )
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
		require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
		require_once('../../classes/general_class.php');
		require_once('../../classes/config.php');
		$obj = new General();
		$sql=mysql_query("SELECT *,'ELEMENTS' FROM  essort_fee_structure WHERE class_id='".$_REQUEST['class']."' AnD sec_id='".$_REQUEST['sec']."'");
		$no_of_element_count=mysql_num_rows($sql);
		$stuarr=array();
		while($rowarr=mysql_fetch_array($sql))
		{
			$sqlelem=mysql_fetch_array(mysql_query("SELECT fee_elem_name FROM essort_fee_detail WHERE fee_id='".$rowarr['fee_elem_id']."'"));
			$rowarr['ELEMENTS']=$sqlelem['fee_elem_name'];
			$stuarr[]=$rowarr;
		}
		//print_r($stuarr);
	}
	else
	{
		echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
	} 
 ?> 
    <div id="page-wrapper" class="bg-texture">
        <div>
            <div id="clouds">
                <div class="cloud x1"></div>           
                <div class="cloud x2"></div>
                <div class="cloud x3"></div>
                <div class="cloud x4"></div>
                <div class="cloud x5"></div>
            </div>
        </div>

            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting from 15 November 2016.</span></h4>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="javascript:void(0)">Configuration</a>
                            </li>
                            <li class="active">Structure 1</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div><!--en row-->

                <div class="row">
                    <div class="col-sm-12 my-box">
                        <h3><?php echo $_REQUEST['sname'];?></h3>                                                
                        <!--st element-->
                            <div class="row m-t-20">
                                <div  class="col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table color-table primary-table full-view table-bordered dataTable">
                                                        <thead>
                                                           <tr>                                                                
                                                                <td colspan="14" align="right"><strong>Total</strong></td>
                                                            </tr>   
                                                            <tr>
                                                                <th>#</th>
                                                                <th>&nbsp;</th>
                                                                <th colspan="3">Q1</th>
                                                                <th colspan="3">Q2</th>
                                                                <th colspan="3">Q3</th>
                                                                <th colspan="3">Q4</th>
                                                            </tr>                                                            
                                                        </thead>
                                                        <tbody>
                                                           <tr>
                                                                <th>&nbsp;</th>
                                                                <th>Element</th>
                                                                <th>Apr</th>
                                                                <th>May</th>
                                                                <th>Jun</th>
                                                                
                                                                <th>Jul</th>
                                                                <th>Aug</th>
                                                                <th>Sep</th>
                                                                
                                                                <th>Oct</th>
                                                                <th>Nov</th>
                                                                <th>Dec</th>
                                                                
                                                                <th>Jan</th>
                                                                <th>Feb</th>
                                                                <th>Mar</th>                                                                
                                                            </tr>
															<div id="count"><?php echo $no_of_element_count;?></div>
															<?php
															foreach($stuarr as $key=>$vlue)
															{
															?>
															
                                                            <tr>
                                                                <td id="a"><input type="hidden" id="a" value="<?php echo $key+1;?>" ><?php echo $key+1;?></td>
                                                                <td><?php echo $vlue['ELEMENTS']; ?><input type="hidden" id="a<?php echo $key+1;?>" value="<?php echo $vlue['ELEMENTS']; ?>" ></td>
                                                                <td id="April<?php echo $key+1;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "April" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></td>
                                                                <td id="May<?php echo $key+1;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "May" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></td>
                                                                <td id="June<?php echo $key+1;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "June" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></td>
                                                                
                                                                <td id="July<?php echo $key+1;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "July" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></td>
                                                                <td id="August<?php echo $key+1;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "August" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></td>
                                                                <td id="September<?php echo $key+1;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "September" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></td>
                                                                
                                                                <td id="October<?php echo $key+1;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "October" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></td>
                                                                <td id="November<?php echo $key+1;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "November" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></td>
                                                                <td id="December<?php echo $key+1;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "December" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></td>    
                                                                
                                                                <td id="January<?php echo $key+1;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "January" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></td>  
                                                                <td id="February<?php echo $key+1;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "February" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></td>
                                                                <td id="March<?php echo $key+1;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "March" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></td>
															</tr>
															<?php
															}
															?>
                                                                                                                                                                           <tr>
																 <td id=""></td>
                                                                <td id="">Total</td>
                                                                <td id="apriltotal"></td>
                                                                <td id="maytotal"></td>
                                                                <td id="junetotal"></td>
                                                                <td id="julytotal"></td>
                                                                <td id="augusttotal"></td>
                                                                <td id="septembertotal"></td>
                                                                <td id="octobertotal"></td>
                                                                <td id="novembertotal"></td>
                                                                
                                                                <td id="decembertotal"></td>
                                                                <td id="januarytotal"></td>
                                                                <td id="februarytotal"></td>
                                                                <td id="marchtotal"></td>
                                                                
                                                                
															</tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th><strong>Net Total</strong></th>
                                                                <th colspan="13"><div id="totalfee">...</div></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                    </div>
                                <!--en table responsive-->    
                                </div><!--en col-->
                            </div><!--en row-->   
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 text-center">
                                     <!--<a href="#" class="btn btn-info bord-radius btn-theme" id="savefeestructure">Save</a>-->
                                </div>
                            </div>
                        <!--en element-->
                    </div>                    
                </div><!--en row-->
            </div>
        </div><!--en page-wrapper-->
 <?php include'../includes/footer.php'; ?>
</div><!--en wrapper-->
<?php include '../includes/foot.php'; ?>  
<script type="text/javascript">
$("#savefeestructure").click(function(e) {
var action='addfeestructure';
var db='<?php echo $_SESSION['USER']['DB_NAME'];?>';
var sname='<?php echo $_REQUEST['sname'];?>';
var srlcount=parseInt($('#count').val());
//alert(srlcount);
var myArray = [];
for (var i = 1; i <= srlcount; i++) { 
	var textvlue=$('#a'+i).val(); 
	myArray.push(textvlue); 
    }
  //alert(myArray); 
  var xhttp=$.post("../../ajax.php",{action:'addfeestructure',myArray:myArray,db:db,sname:sname}); 
  xhttp.done(function(data){
  if(data!="")
				{
					//window.location.reload();
					if(data==1){
						alert("Required Parameter Missing");
						$("#preloader").css("display","none");
						return false;  
					}else if(data==5){
						alert("Successfully Added Structure");
						window.location.reload();
					}
				}
	});
    xhttp.fail(function(data){
		return false;
	});
	return false;
 
});
</script>
<script>
$(function() {
var fname = document.getElementById('count').innerHTML;
	var aprilblnc=0;
	var mayblnc=0;
	var juneblnc=0;
	var julyblnc=0;
	var augblnc=0;
	var sepblnc=0;
	var octblnc=0;
	var novblnc=0;
	var decblnc=0;
	var janblnc=0;
	var febblnc=0;
	var marblnc=0;
	var penality=0;
	for (var i = 1; i <= fname; i++) 
			{
				var aprildata=document.getElementById("April"+i+"").innerHTML;
				if(aprildata=='')
				{
					var aprildata=0;
				}
				var maydata=document.getElementById("May"+i+"").innerHTML;
				if(maydata=='')
				{
					var maydata=0;
				}
				var junedata=document.getElementById("June"+i+"").innerHTML;
				if(junedata=='')
				{
					var junedata=0;
				}
				var julydata=document.getElementById("July"+i+"").innerHTML;
				if(julydata=='')
				{
					var julydata=0;
				}
				var augustdata=document.getElementById("August"+i+"").innerHTML;
				if(augustdata=='')
				{
					var augustdata=0;
				}
				var septemberdata=document.getElementById("September"+i+"").innerHTML;
				if(septemberdata=='')
				{
					var septemberdata=0;
				}
				var octoberdata=document.getElementById("October"+i+"").innerHTML;
				if(octoberdata=='')
				{
					var octoberdata=0;
				}
				var novemberdata=document.getElementById("November"+i+"").innerHTML;
				if(novemberdata=='')
				{
					var novemberdata=0;
				}
				var decemberdata=document.getElementById("December"+i+"").innerHTML;
				if(decemberdata=='')
				{
					var decemberdata=0;
				}
				var januarydata=document.getElementById("January"+i+"").innerHTML;
				if(januarydata=='')
				{
					var januarydata=0;
				}
				var februarydata=document.getElementById("February"+i+"").innerHTML;
				if(februarydata=='')
				{
					var februarydata=0;
				}
				var marchdata=document.getElementById("March"+i+"").innerHTML;
				if(marchdata=='')
				{
					var marchdata=0;
				}
				var aprilblnc = parseInt(aprilblnc) + parseInt(aprildata);
				var mayblnc = parseInt(mayblnc) + parseInt(maydata);
				var juneblnc = parseInt(juneblnc) + parseInt(junedata);
				var julyblnc = parseInt(julyblnc) + parseInt(julydata);
				var augblnc = parseInt(augblnc) + parseInt(augustdata);
				var sepblnc = parseInt(sepblnc) + parseInt(septemberdata);
				var octblnc = parseInt(octblnc) + parseInt(octoberdata);
				var novblnc = parseInt(novblnc) + parseInt(novemberdata);
				var decblnc = parseInt(decblnc) + parseInt(decemberdata);
				var janblnc = parseInt(janblnc) + parseInt(januarydata);
				var febblnc = parseInt(febblnc) + parseInt(februarydata);
				var marblnc = parseInt(marblnc) + parseInt(marchdata);
				
				
			}
			var onequarterfee=parseInt(aprilblnc) + parseInt(mayblnc) + parseInt(juneblnc);
			var secquarterfee=parseInt(julyblnc) + parseInt(augblnc) + parseInt(sepblnc);
			var thirdquarterfee=parseInt(octblnc) + parseInt(novblnc) + parseInt(decblnc);
			var fourthquarterfee=parseInt(janblnc) + parseInt(febblnc) + parseInt(marblnc);
			//alert(fourthquarterfee);
			var totalfee= parseInt(onequarterfee) + parseInt(secquarterfee)+ parseInt(thirdquarterfee) + parseInt(fourthquarterfee);
			document.getElementById("apriltotal").innerHTML=aprilblnc;
			document.getElementById("maytotal").innerHTML=mayblnc;
			document.getElementById("junetotal").innerHTML=juneblnc;
			document.getElementById("julytotal").innerHTML=julyblnc;
			document.getElementById("augusttotal").innerHTML=augblnc;
			document.getElementById("septembertotal").innerHTML=sepblnc;
			document.getElementById("octobertotal").innerHTML=octblnc;
			document.getElementById("novembertotal").innerHTML=novblnc;
			document.getElementById("decembertotal").innerHTML=decblnc;
			document.getElementById("januarytotal").innerHTML=janblnc;
			document.getElementById("februarytotal").innerHTML=febblnc;
			document.getElementById("marchtotal").innerHTML=marblnc;
			document.getElementById("totalfee").innerHTML=totalfee;
			});
</script>
</body>
</html>

