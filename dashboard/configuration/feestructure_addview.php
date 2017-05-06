<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>Configuration | Fee Structure Master</title>
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
		$obj = new General();
		$sqlfeestru=mysql_query("SELECT *,'ELEMENTS' FROM  essort_fee_structure GROUP BY class_id,sec_id");
		$stuarrfee=array();
		while($feestrurow=mysql_fetch_array($sqlfeestru))
		{
			$sqlel=mysql_query("SELECT fee_elem_id FROM essort_fee_structure WHERE class_id='".$feestrurow['class_id']."' AND sec_id='".$feestrurow['sec_id']."'");
			$fee_elem_name='';
			//CLASS NAME
			$sqlclass=mysql_fetch_array(mysql_query("SELECT class_name FROM essort_classes WHERE class_id='".$feestrurow['class_id']."'"));
			$sqlsec=mysql_fetch_array(mysql_query("SELECT section_name FROM essort_section WHERE class_id='".$feestrurow['class_id']."' AND section_id='".$feestrurow['sec_id']."'"));
			while($elstnt=mysql_fetch_array($sqlel))
			{
				//echo "SELECT fee_elem_name FROM essort_fee_detail WHERE fee_id='".$elstnt['fee_elem_id']."'";
				$sqlelem=mysql_fetch_array(mysql_query("SELECT fee_elem_name FROM essort_fee_detail WHERE fee_id='".$elstnt['fee_elem_id']."'"));
				$fee_elem_name.=$sqlelem['fee_elem_name']."/";
				
			}
			$feestrurow['ELEMENTS']=$fee_elem_name;
			$feestrurow['class_id']=$sqlclass['class_name'];  
			$feestrurow['sec_id']=$sqlsec['section_name'];  
			$stuarrfee[]=$feestrurow;
		}
		//print_r($stuarrfee);
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
                            <li class="active">Fee Master</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div><!--en row-->

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 my-box">
					<a href="javascript:void(0)" class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span class="fa fa-backward"></span> Back</a>
                       <h4 class="h4">Add/View Fee Structure</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">                              
                                <a href="addnew_feestructure.php" class="btn btn-info pull-right"><span class="fa fa-plus"></span> Create Fee For Class</a>
                                 <a href="newfeeelement.php" class="btn btn-info pull-right m-r-10"><span class="fa fa-inr"></span>Manage Fee Element</a>
                            </div>
                        </div>    


 <div class="row m-t-20">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="table-responsive">
                                   <table class="table table-bordered color-table primary-table">
                                      <thead>
                                       <tr>
                                               <th>Class</th>
                                               <th>Section</th>
                                               <th>Elements</th>
											   <th>View</th>
                                               
                                       </tr>
                                      </thead>
                                      <tbody>
									  <?php
									  $i=0;
									  foreach($stuarrfee as $stuvaluefee)
									  {
										?>
                                          <tr>
                                              <td><?php echo $stuvaluefee['class_id'];?></td>
                                              <td><?php echo $stuvaluefee['sec_id'];?></td>
                                              <td><?php echo $stuvaluefee['ELEMENTS'];?></td>
                                              <td><a href="feestructure_fullview.php?class=<?php echo $stuvaluefee[1];?>&sec=<?php echo $stuvaluefee[2];?>"><i class="view_btn fa fa-eye" aria-hidden="true"></i></a>
                                              </td>
                                          </tr>
										<?php
										$i++;
										}
										?>
                                      </tbody>
                                   </table>
                               </div> 
                            </div><!--en col-->
                        </div> <!--en row-->   
						
						
                    </div><!--col-en-->
                </div><!--en row-->
				
				
            </div>
        </div><!--en page-wrapper-->
 <?php include'../includes/footer.php'; ?>
</div><!--en wrapper-->
<?php include '../includes/foot.php'; ?>  

</body>
</html>

