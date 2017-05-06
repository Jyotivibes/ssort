<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | Fees</title>
    <?php include '../includes/head.php'; ?>
</head>

<body>
    <div id="wrapper">
	<?php
    if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Principal') )
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
		require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
		require_once('../../classes/general_class.php');
		require_once('../../classes/config.php');
		$obj = new General();
		//ALL CLASSES
		$sql=mysql_query("SELECT *,'element_name' FROM essort_fee_structure WHERE class_id='".$_REQUEST['class_id']."' AND sec_id='".$_REQUEST['sec_id']."'");
			$element=array();
			while($row=mysql_fetch_array($sql))
			{
				$sqlelemname=mysql_fetch_array(mysql_query("SELECT fee_elem_name FROm essort_fee_detail WHERE fee_id='".$row['fee_elem_id']."'"));
				$row['element']=$sqlelemname['fee_elem_name'];
				$element[]=$row;
			}
			$no_of_element_count=count($element);
		//print_r($classarr);
		
		$sqlfirst=mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='first'"));
		$sqlsec=mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='second'"));         
		$sqlthird=mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='third'"));
		$sqlfourth=mysql_fetch_array(mysql_query("SELECT * FROM essort_fee_timeline WHERE ftime_equarter='fourth'"));  

		$button1=mysql_num_rows(mysql_query("SELECT * FROM  essort_fee_structure_approval WHERE app_class='".$_REQUEST['class_id']."' AND app_sec='".$_REQUEST['sec_id']."' AND  app_quarter='first'"));
		$button2=mysql_num_rows(mysql_query("SELECT * FROM  essort_fee_structure_approval WHERE app_class='".$_REQUEST['class_id']."' AND app_sec='".$_REQUEST['sec_id']."' AND  app_quarter='second'"));
		$button3=mysql_num_rows(mysql_query("SELECT * FROM  essort_fee_structure_approval WHERE app_class='".$_REQUEST['class_id']."' AND app_sec='".$_REQUEST['sec_id']."' AND  app_quarter='third'"));
		$button4=mysql_num_rows(mysql_query("SELECT * FROM  essort_fee_structure_approval WHERE app_class='".$_REQUEST['class_id']."' AND app_sec='".$_REQUEST['sec_id']."' AND  app_quarter='fourth'"));
		    
	}
	else    
	{
		echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
	} 
?>	
        <!-- Navigation -->
        <?php include'../includes/header-configuration.php'; ?>
        <!--sidebar nav st-->
        <?php include '../includes/sidebar-principal.php'; ?>
		<!--#################################################################################-->
<div id="count" style="display:none;"><?php echo $no_of_element_count;?></div>
<div id="paydiv" style="display:none;"><?php echo $type;?></div>
<div id="pendingdues" style="display:none;"><?php echo $amount;?></div>
<div id="penality" style="display:none;"><?php echo $penality;?></div>
<div id="firstquarterdiscount" style="display:none;"><?php echo $firstquarterdiscount;?></div>
<div id="secquarterdiscount" style="display:none;"><?php echo $secquarterdiscount;?></div>
<div id="thirdquarterdiscount" style="display:none;"><?php echo $thirdquarterdiscount;?></div>
<div id="fourthquarterdiscount" style="display:none;"><?php echo $fourthquarterdiscount;?></div>
<!--#################################################################################-->
        <!--sidebar nav en-->
        <!-- Page Content -->
        <div id="page-wrapper" class="bg-texture">
            <div>
                <div id="clouds">
                    <div class="cloud x1"></div>
                    <!-- Time for multiple clouds to dance around -->
                    <div class="cloud x2"></div>
                    <div class="cloud x3"></div>
                    <div class="cloud x4"></div>
                    <div class="cloud x5"></div>
                </div>

            </div>

            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <?php include_once("../includes/header-notice-circular.php"); ?>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="<?php echo DASHBOARD_LINK;?>">Dashboard</a>
                            </li>
                            <li class="active">Fees Structure</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!--en row-->

                <!--fees st-->
             
 

         
                <!--en row-->


                <div class="row">
                     <div class="col-sm-12 col-xs-12">
                        <div class="my-box">                            
                              <h4><?php echo $sch_name;?></h4>
                              <!-- <h5>Class - Nursery</h5>
                                <h5>Session 2016-2017</h5>
                                <h5>Total Session Fees - <span class="fa fa-inr"></span> 55000/-</h5>-->
                         </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="my-box">
                            
                            <section class="m-t-20">
                                <!--accordian st-->
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading bg-accordian">
                                            <h4 class="panel-title">
                                                First Quarter (Apr-Jun)
                                                 <span class="pull-right text-fff"><?php echo $sqlfirst['ftime_sdate']."".$sqlfirst['ftime_edate']; ?></span>
                                              </h4>
                                        </div>
                                        <div class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table color-table primary-table">
                                                        <thead>
                                                            <tr>
                                                                <th>S. NO.</th>
                                                                <th>Apr</th>
                                                                <th>May</th>
                                                                <th>Jun</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                          <?php
															$i=1;
															foreach($element as $vlue)
															{
																?>
																<tr>
																	<td><?php echo $vlue['element'];?></td>
																	<td><div id="April<?php echo $i;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "April" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div></td>
																	<td><div id="May<?php echo $i;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "May" . '\b/', $vlue['fee_elem_month']))echo $vlue['fee_elem_amount'];?></div></td>
																	<td><div id="June<?php echo $i;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "June" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div></td>
																</tr>
																<?php
																$i++;
															}
															?>
                                                            
                                                            <tr>
                                                                <td class="total-border"><strong>Total</strong>
                                                                </td>
                        <td class="total-border" colspan="3"><div id="firstquarterfee">...</div>...</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <a class="btn btn-link text-muted text-fancy btn-block text-center">Payment date: <?php echo $sqlfirst['ftime_sdate']."".$sqlfirst['ftime_edate']; ?> </a>
                                                                </td>
                                                            </tr>
                                                             <tr>
															 <td colspan="4">
                                                                    <a <?php if($button1>1) echo 'disabled'; ?> class="btn btn-info btn-right text-center pull-right border-round btn-color Approve" data-quarter="first">Approve</a>
                                                                </td>
															
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--en table responsive-->
                                            </div>
                                        </div>
                                    </div>
                       
                                </div>
                                <!--accordian en-->
                            </section>
                        </div>
                        <!--en white-box-->
                    </div>
<!--                one-->
                                        <div class="col-sm-6 col-xs-12">
                        <div class="my-box">
                           
                            <section class="m-t-20">
                                <!--accordian st-->
                                <div class="panel-group" id="accordion">
                       
                                    <div class="panel panel-default">
                                        <div class="panel-heading bg-accordian">
                                            <h4 class="panel-title">
                                                Second Quarter (Jul-Sept)
                                                <span class="pull-right text-fff"><?php echo $sqlsec['ftime_sdate']."".$sqlsec['ftime_edate']; ?> </span>
                                      </h4>
                                        </div>
                                        <div class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table color-table primary-table">
                                                        <thead>
                                                            <tr>
                                                                <th>S. NO.</th>
                                                                <th>Jul</th>
                                                                <th>Aug</th>
                                                                <th>Sept</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                    $i=1;
                    foreach($element as $vlue)
                    {
                        ?>
                        <tr>
                            <td><?php echo $vlue['element'];?></td>
                            <td><div id="July<?php echo $i;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "July" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div></td>
                            <td><div id="August<?php echo $i;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "August" . '\b/', $vlue['fee_elem_month']))echo $vlue['fee_elem_amount'];?></div></td>
                            <td><div id="September<?php echo $i;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "September" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>                                                            <tr>
                                                                <td class="total-border"><strong>Total</strong>
                                                                </td>
                        <td class="total-border" colspan="3"><div id="secondquarterfee">...</div>...</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <a class="btn btn-link text-muted text-fancy btn-block text-center">Payment date: <?php echo $sqlsec['ftime_sdate']."".$sqlsec['ftime_edate']; ?>  </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <a class="btn btn-info btn-right text-center pull-right border-round btn-color Approve" data-quarter="second">Approve</a>
                                                                </td>
                                                            </tr> 
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--en table responsive-->
                                            </div>
                                        </div>
                                    </div>
                             
                                </div>
                                <!--accordian en-->
                            </section>
                        </div>
                        <!--en white-box-->
                    </div>
                                        <div class="col-sm-6 col-xs-12">
                        <div class="my-box">
                          
                            <section class="m-t-20">
                                <!--accordian st-->
                                <div class="panel-group" id="accordion">
                               
                                    <div class="panel panel-default">
                                        <div class="panel-heading bg-accordian">
                                            <h4 class="panel-title">
                                                Third Quarter (Oct-Dec)
                                                <span class="pull-right text-fff"><?php echo $sqlthird['ftime_sdate']."".$sqlthird['ftime_edate']; ?>  </span>
                                              </h4>
                                        </div>
                                        <div class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table color-table primary-table">
                                                        <thead>
                                                            <tr>
                                                                <th>S. NO.</th>
                                                                <th>Oct</th>
                                                                <th>Nov</th>
                                                                <th>Dec</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           <?php
                    $i=1;
                    foreach($element as $vlue)
                    {
                        ?>
                        <tr>
                            <td><?php echo $vlue['element'];?></td>
                            <td><div id="October<?php echo $i;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "October" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div></td>
                            <td><div id="November<?php echo $i;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "November" . '\b/', $vlue['fee_elem_month']))echo $vlue['fee_elem_amount'];?></div></td>
                            <td><div id="December<?php echo $i;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "December" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                                                            <tr>
                                                                <td class="total-border"><strong>Total</strong>
                                                                </td>
                        <td class="total-border" colspan="3"><div id="thirdquarterfee" >...</div></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <a class="btn btn-link text-muted text-fancy btn-block text-center">Payment date: <?php echo $sqlthird['ftime_sdate']."".$sqlthird['ftime_edate']; ?> </a>
                                                                </td>
                                                            </tr>
                                                             <tr>
                                                                <td colspan="4">
                                                                    <a class="btn btn-info btn-right text-center pull-right border-round btn-color Approve"  data-quarter="third">Approve</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--en table responsive-->
                                            </div>
                                        </div>
                                    </div>
                                    
                                    

                                
                                </div>
                                <!--accordian en-->
                            </section>
                        </div>
                        <!--en white-box-->
                    </div>
                                        <div class="col-sm-6 col-xs-12">
                        <div class="my-box">
                   
                            <section class="m-t-20">
                                <!--accordian st-->
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading bg-accordian">
                                            <h4 class="panel-title">
                                                Fourth Quarter (Jan-Mar)
                                                <span class="pull-right text-fff"><?php echo $sqlfourth['ftime_sdate']."".$sqlfourth['ftime_edate']; ?></span>
                                             </h4>
                                        </div>
                                        <div class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table color-table primary-table">
                                                        <thead>
                                                            <tr>
                                                                <th>S. NO.</th>
                                                                <th>Jan</th>
                                                                <th>Feb</th>
                                                                <th>Mar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           <?php
                    $i=1;
                    foreach($element as $vlue)
                    {
                        ?>
                        <tr>

                            <td><?php echo $vlue['element'];?></td>
                            <td><div id="January<?php echo $i;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "January" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div></td>
                            <td><div id="February<?php echo $i;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "February" . '\b/', $vlue['fee_elem_month']))echo $vlue['fee_elem_amount'];?></div></td>
                            <td><div id="March<?php echo $i;?>"><?php if($vlue['fee_elem_month']=='' || preg_match('/\b' . "March" . '\b/', $vlue['fee_elem_month'])) echo $vlue['fee_elem_amount'];?></div></td>
                        </tr>
                        <?php
                        $i++;
                    }
					?>
                                                            <tr>
                                                                <td class="total-border"><strong>Total</strong>
                                                                </td>
                        <td class="total-border" colspan="3"><div id="fourthquarterfee">...</div></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4">  
                                                                    <a class="btn btn-link text-muted text-fancy btn-block text-center">Payment date: <?php echo $sqlfourth['ftime_sdate']."".$sqlfourth['ftime_edate']; ?></a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <a class="btn btn-info btn-right text-center pull-right border-round btn-color Approve" data-quarter="fourth">Approve</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--en table responsive-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--accordian en-->
                            </section>
                        </div>
                        <!--en white-box-->
                    </div>
                    <!--en col-->
                </div>
                <!--en row-->
                <!--fees en-->
              
            </div>
            <!--container-fluid-->

            <!-- .right-sidebar st here-->
        </div>
        <!-- /.container-fluid -->
         <?php include'../includes/footer.php'; ?>
    </div>
    <!-- /#page-wrapper -->
  
    <!-- /#wrapper -->
  

    <?php include '../includes/foot.php'; ?>
    <!--Style Switcher -->
    <!--<script src="js/jQuery.style.switcher.js"></script>-->
	<script type="text/javascript">
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
		//AFTER DISCOUNT
		var disscountrate=0;
		var firstquarterdiscount=document.getElementById("firstquarterdiscount").innerHTML;
		var disscountrate= (parseInt(onequarterfee) * parseInt(firstquarterdiscount))/100;
		//alert(disscountrate);
		var secquarterfee=parseInt(julyblnc) + parseInt(augblnc) + parseInt(sepblnc);
		 //AFTER DISCOUNT
		var secdisscountrate=0;
		var secquarterdiscount=document.getElementById("secquarterdiscount").innerHTML;
		var secdisscountrate= (parseInt(secquarterfee) * parseInt(secquarterdiscount))/100;
		//alert(secdisscountrate);
        var thirdquarterfee=parseInt(octblnc) + parseInt(novblnc) + parseInt(decblnc);
		//THIRD QUARTER DISCOUNT
		var thrddisscountrate=0;
		var thrdquarterdiscount=document.getElementById("thirdquarterdiscount").innerHTML;
		var thrddisscountrate= (parseInt(thirdquarterfee) * parseInt(thrdquarterdiscount))/100;
		//alert(thrddisscountrate);
		
		
        var fourthquarterfee=parseInt(janblnc) + parseInt(febblnc) + parseInt(marblnc);
		//THIRD QUARTER DISCOUNT
		var forthdisscountrate=0;
		var forthquarterdiscount=document.getElementById("fourthquarterdiscount").innerHTML;
		var forthdisscountrate= (parseInt(fourthquarterfee) * parseInt(forthquarterdiscount))/100;
		//alert(forthdisscountrate);
		
        //alert(fourthquarterfee);
		var pendingfquarter=1;
	    var pendingsquarter=1;
	    var pendingtquarter=1;
	    var pendingfrquarter=1;
		var amount=0;
		if (pendingfquarter==0)
		{
		  var amount=parseInt(amount) + parseInt(onequarterfee);
		  var tag='<tr id="rowToClone1"><td class="total-border"><strong>First Quarter Discount</strong></td><td class="total-border" colspan="3"><div id="pendingdues">'+amount+'</div></td></tr>';
		}
		if(pendingsquarter==0)
		{
			var amount=parseInt(amount) + parseInt(secquarterfee);
			 var tag='<tr id="rowToClone1"><td class="total-border"><strong>Second Quarter Discount</strong></td><td class="total-border" colspan="3"><div id="pendingdues">'+amount+'</div></td></tr>';
		}
		if(pendingtquarter==0)
		{
			var amount=parseInt(amount) + parseInt(thirdquarterfee);
			 var tag='<tr id="rowToClone1"><td class="total-border"><strong>Third Quarter Discount</strong></td><td class="total-border" colspan="3"><div id="pendingdues">'+amount+'</div></td></tr>';
		}
		if(pendingfrquarter==0)
		{
			var amount=parseInt(amount) + parseInt(fourthquarterfee);
			var tag='<tr id="rowToClone1"><td class="total-border"><strong>Fourth Quarter Discount</strong></td><td class="total-border" colspan="3"><div id="pendingdues">'+amount+'</div></td></tr>';
		}
		//alert(tag);
		 var totalfee= parseInt(onequarterfee) + parseInt(secquarterfee)+ parseInt(thirdquarterfee) + parseInt(fourthquarterfee);
		 //alert(onequarterfee);
        document.getElementById("firstquarterfee").innerHTML=onequarterfee;
        document.getElementById("secondquarterfee").innerHTML=secquarterfee;
        document.getElementById("thirdquarterfee").innerHTML=thirdquarterfee;
        document.getElementById("fourthquarterfee").innerHTML=fourthquarterfee;
        //document.getElementById("totalfee").innerHTML=totalfee;
        var pendingdues=amount;
        var penality=document.getElementById("penality").innerHTML;
        if(document.getElementById("paydiv").innerHTML=='first')
        {

            var a = $('#collapse1').html();
            var field=document.getElementById("firstquarterfee").innerHTML;
            var b = $('#newdiv').html(a);
            $('#newdiv').append('<tr id="rowToClone1"><td class="total-border"><strong>Previous Dues</strong></td><td class="total-border" colspan="3"><div id="pendingdues">'+pendingdues+'</div></td></tr><tr><td class="total-border"><strong>Penalty</strong></td><td class="total-border" colspan="3"><div id="penality">'+penality+'</div></td></tr><tr><td class="total-border"><strong>Net Total</strong></td><td class="total-border" colspan="3"><div id="grandtotal">...</div></td></tr><tr><td class="total-border" colspan="4" align="right"> <a href="javascript:void(0);" class="btn btn-success bord-radius">Click here for online payment</a></td></tr>')


        }
        else if(document.getElementById("paydiv").innerHTML=='second')
        {

            var a = $('#collapse2').html();
            var field=document.getElementById("secondquarterfee").innerHTML;
            var b = $('#newdiv').html(a);
            $('#newdiv').append('<tr id="rowToClone1"><td class="total-border"><strong>Previous Dues</strong></td><td class="total-border" colspan="3"><div id="pendingdues">'+pendingdues+'</div></td></tr><tr><td class="total-border"><strong>Penalty</strong></td><td class="total-border" colspan="3"><div id="penality">'+penality+'</div></td></tr><tr><td class="total-border"><strong>Net Total</strong></td><td class="total-border" colspan="3"><div id="grandtotal">...</div></td></tr><tr><td class="total-border" colspan="4" align="right"> <a href="javascript:void(0);" class="btn btn-success bord-radius">Click here for online payment</a></td></tr>')


        }
        else if(document.getElementById("paydiv").innerHTML=='third')
        {

            var a = $('#collaps3').html();
            var field=document.getElementById("thirdquarterfee").innerHTML;
            var b = $('#newdiv').html(a);
            $('#newdiv').append('<tr id="rowToClone1"><td class="total-border"><strong>Previous Dues</strong></td><td class="total-border" colspan="3"><div id="pendingdues">'+pendingdues+'</div></td></tr><tr><td class="total-border"><strong>Penalty</strong></td><td class="total-border" colspan="3"><div id="penality">'+penality+'</div></td></tr><tr><td class="total-border"><strong>Net Total</strong></td><td class="total-border" colspan="3"><div id="grandtotal">...</div></td></tr><tr><td class="total-border" colspan="4" align="right"> <a href="javascript:void(0);" class="btn btn-success bord-radius">Click here for online payment</a></td></tr>')


        }
        else if(document.getElementById("paydiv").innerHTML=='fourth')
        {

            var a = $('#collapse4').html();
            var field=document.getElementById("fourthquarterfee").innerHTML;
            var b = $('#newdiv').html(a);
            $('#newdiv').append('<tr id="rowToClone1"><td class="total-border"><strong>Previous Dues</strong></td><td class="total-border" colspan="3"><div id="pendingdues">'+pendingdues+'</td></tr><tr><td class="total-border"><strong>Penality</strong></td><td class="total-border" colspan="3"><div id="penality">'+penality+'</div></td></tr><tr><td class="total-border"><strong>Net Total</strong></td><td class="total-border" colspan="3"><div id="grandtotal">...</div></td></tr><tr><td class="total-border" colspan="4" align="right"> <a href="javascript:void(0);" class="btn btn-success bord-radius">Click here for online payment</a></td></tr>')


        }
        var grandtotal=0;
        var grandtotal = parseInt(field) + parseInt(penality)+ parseInt(pendingdues);
        //document.getElementById("grandtotal").innerHTML=grandtotal;
        //document.getElementById("totalfee").innerHTML=grandtotal;
    });
</script>
<div class="modal fade" id="fee_approval" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Fee Structure Approval</h4>

            </div>

            <div class="modal-body" >
                <span id="from"></span>
                <span id="l_to"></span>
                <p id="reason" class="text-justify"></p>
            </div>
            <div class="modal-footer">
                <div class="row">
                </div>
            </div>
        </div>

    </div>
</div>

<script>
  $(document).ready(function () {
        $(".Approve").click(function (event) {
            var quarter=$(this).attr("data-quarter");
            $.ajax({
                url: "<?php echo HTTP_SERVER; ?>ajax.php?action=approvefeestructure&session=<?php echo $_SESSION['USER']['DB_NAME']; ?>",
                type: "POST",
                data: {
                    classdata: '<?php echo $_REQUEST['class_id']?>',
                    secdata: '<?php echo $_REQUEST['sec_id'];?>',
                    quarter: quarter
                },
                success: function (data) {
                if (data == 1) {

                        $("#fee_approval").find('.modal-body').html("Fee structure Approved");
                        $("#fee_approval").modal('show');

                    }
                    else {
                        $("#fee_approval").find('.modal-body').html("Not Approve");
                        $("#fee_approval").modal('show');
                    }


                }
            });
        });
    });
</script>

</body>

</html>