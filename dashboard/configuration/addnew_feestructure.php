<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>Configuration | Add New Fee Structure</title>
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
		
		$sql=mysql_query("SELECT * FROM essort_classes");
		$sqlsection=mysql_query("SELECT * FROM essort_section");
		$sqlfee=mysql_query("SELECT * FROM essort_fee_detail");
		$sqlpay=mysql_query("SELECT * FROM essort_fee_pay_type");
		while($rowpay=mysql_fetch_array($sqlpay))
		{
			$pay.='<option value='.$rowpay['fee_type_name'].'>'.$rowpay['fee_type_name'].'</option>';
		}
		if(isset($_REQUEST['SubmitFS']))
		{	
			$res = $obj->ADDFEESTRUCTURE();
			if($res == 3){
				$formErr='Required parameter missing';
				$reurl='addnew_feestructure.php';
			}
			else if($res == 0){
				$formErr='Problem in network.Please try again.';
				$reurl='addnew_feestructure.php';
			}
			else if($res == 1){
				$formErr='Fee Structure added successfully';
				$reurl='addnew_feestructure.php';
			}
		}
	}
	else
	{
		echo "<script>window.location='".HTTP_SERVER."index.php';</script>";
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
                <?php include '../includes/header-notice.php'; ?>
                <div class="row">
                    <div class="col-sm-12 my-box">
					<a href="javascript:void(0)" class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span class="fa fa-backward"></span> Back</a>
                        <h3>Create Fee For Class</h3>                                                
                        <!--st element-->
                            <div class="row m-t-20">
                                <div  class="col-sm-12 col-xs-12" id="crFee">
                                    <div class="table-responsive">
									<div id="alertfeemsg"></div>
                                       <form method="post" action="" name="feestructure" onsubmit="return manageFeeStructure();">
                                            <table class="table color-table primary-table" id="feeStructure" width="30%">   
                                                <tbody>
                                                    <tr>   
                                                        <td>Class</td>
                                                        <td>
                                                            <select name="class" class="form-control input-sm class"  id="selClass" onchange="showSubTypechk(this.value);">
															<option value="">Select Class</option>
															<?php
															while($row=mysql_fetch_array($sql))
															{
															?>
                                                                <option value="<?php echo $row['class_id']; ?>"><?php echo $row['class_name'];?></option>
                                                            <?php
															}
															?>
                                                            </select>
                                                        </td> 
                                                        <td></td>
                                                        <td>
															<div id="section">
                                                           
															</div>
                                                        </td>                                                               
                                                    </tr>                                                                   
                                                </tbody>
                                             </table>
                                              <table class="table color-table primary-table"> 
                                                        <thead>
                                                           <tr>
                                                            <th>Section</th>
                                                            <th>Type</th>
                                                            <th>Amount</th>
															<th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
														<?php
														$i=1;
														while($rowfee=mysql_fetch_array($sqlfee))
														{
														?>
                                                          <tr>
                                                               <td><input type="hidden" name="fee_elem_id[]" value="<?php echo $rowfee['fee_id'];?>"><?php echo $rowfee['fee_elem_name'];?></td> 
                                                               <td>
															   <select class="form-control input-sm selClass" id="selClass<?php echo $i;?>" name="pay[]">
															   <option value="">Select</option>
															  <?php echo $pay;?>
															   </select>
																</td> 
                                                               <td> <input type="text" class="form-control input-sm" id="amount<?php echo $i;?>" placeholder="Enter Amount" name="txtAmount[]"></td> 
															    <td><div id="month<?php echo $i;?>" style="display:none;"><input type="checkbox" name="month[]" value="April">April <input type="checkbox" name="month[]" value="July">July <input type="checkbox" name="month[]" value="October">October<input type="checkbox" name="month[]"  value="January">January</div></td> 
                                                               </tr>
                                                         <?php
														 $i++;
														}
														?>														 
                                                        </tbody>
														
														
                                               </table>
											   <!--<div class="m-t-10 m-b-10 text-center"><a href="feestructure_fullview.php" class="btn btn-info bord-radius">Save</a></div>-->
											   <input type="submit" class="m-t-10 m-b-10 text-center" name="SubmitFS" value="Save">
                                        </form>
                                    </div>                                
                                    
                                </div><!--en col-->
                            </div><!--en row-->   
                        <!--en element-->
                    </div>                    
                </div><!--en row-->
            </div>
        </div><!--en page-wrapper-->
 <?php include'../includes/footer.php'; ?>
</div><!--en wrapper-->
<?php include '../includes/foot.php'; ?>  
<?php
#Show form error message
if( $formErr!="" )
{
	?>
	<script>
		$('#myModalLabel').html('');
		$('#error_message').html("<?php echo $formErr; ?>");
		$('#alert_modal').modal('show');
		var url = "<?php echo $reurl;?>";    
		window.location.href = url;  
	</script>
	<?php
}
?>
<script>
 function manageFeeStructure(){
	if(document.feestructure.class.value == '')
	{
		document.getElementById('alertfeemsg').innerHTML='Please Select Class';
		document.feestructure.class.focus();
		return false;
	}
	checked = $("input[type=checkbox]:checked").length;
	if(!checked) {
        document.getElementById('alertfeemsg').innerHTML='You must check at least one checkbox.';
        return false;
      }
	return true;
}
</script>
<script type="text/javascript">
$(".selClass").change(function(e) {
var id = $(this).attr('id');
var selectedCountry = $("#"+id+"").val();
var yourString = id.replace ( /[^\d.]/g, '' );
if(selectedCountry=='Quarterly')
{
	$("#month"+yourString+"").css("display", "none");
}
 else
 {
	$("#month"+yourString+"").css("display", "none");
 }
});
</script>

</body>
</html>

