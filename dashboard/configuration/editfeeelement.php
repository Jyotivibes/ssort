<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>School Management System - SMS | New Fee Element</title>
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
		
		$sql=mysql_query("SELECT * FROM  essort_fee_detail");
		$sqlfeeelemname=mysql_fetch_array(mysql_query("SELECT * FROM  essort_fee_detail WHERE fee_id='".$_REQUEST['id']."'"));
		//$resultclass=mysql_fetch_array($sqlclass);
		if(isset($_REQUEST['editfeeelement']))
		{	
			$res = $obj->UPDATEFEEELEMENT();
			if($res == 2){
				//echo "<script>alert('Required parameter missing');</script>";
				//echo "<script>window.location.href='create-group.php';</script>";
				$formErr='Required parameter missing';
				$reurl='newfeeelement.php';
			}
			else if($res == 0){
				$formErr='Problem in network.Please try again.';
				//echo "<script>window.location.href='subject_master.php';</script>";
				$reurl='newfeeelement.php';
			}
			else if($res == 1){
				$formErr='Fee Updated successfully.';
				//echo "<script>window.location.href='subject_master.php';</script>";
				$reurl='newfeeelement.php';
			}
			else if($res == 5){
				$formErr='Already This Subject Exist.';
				$reurl='newfeeelement.php';
			}
		}
	}
	else
	{
		echo "<script>window.location='http://localhost/ssort/index.php';</script>";
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
                            <li class="active">Fee Element</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div><!--en row-->

                <div class="row">
                    <div class="col-sm-12 my-box">
                        <h3>Edit Fee Element
						<a href="javascript:void(0)" class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span class="fa fa-backward"></span> Back</a></h3>                        
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading bg-accordian">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne1">Edit Fee Element</a>
                                    </h4> 
                                </div>
                                <div id="collapseOne1" class="panel-collapse in collapse">
                                    <div class="panel-body">
                                        <div class="form-group">
										   <div id="regTitle"></div>
										   <form action="" method="post">
											   <div class="input-group"> 
											  <input type="hidden"  name="fee_id" id="fee_id" value="<?php echo $sqlfeeelemname['fee_id'];?>"/>
												<input type="text" class="form-control txtElement" placeholder="Enter element" name="txtElement" id="txtElement" value="<?php echo $sqlfeeelemname['fee_elem_name'];?>" />
												<div class="input-group-btn">
												<!--<button type="button" class="btn btn-info bord-radius btn-theme input-sm"><span class="fa fa-plus"></span> Fee Element</button>-->
												<input type="submit" class="btn btn-info btn-theme bord-radius" name="editfeeelement" value="Add">
												</div>
											   </div>
										</form>
							   
</div>

                                            </div><!--en row--> 

											
                                    </div>
                                </div>
                            </div>     
                        </div><!--en accordian-->
                        <!--st element-->
                            <div class="row m-t-20">
                            <div  class="col-sm-12 col-xs-12">
                            <div class="table-responsive">
                            <table class="table table-bordered color-table primary-table">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Element</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
							<?Php
							while($row=mysql_fetch_array($sql))
							{
							?>
                                <tr>
                                    <td><?php echo $row['fee_id'];?></td>
                                    <td><?php echo $row['fee_elem_name'];?></td>
                                   
                                </tr>
                             <?php
							}
							?>							 
                            </tbody>
                            </table>
                            </div>
                            <!--en table responsive-->    
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
<script type="text/javascript">
$("#addfeeelement").click(function(e) {
var action='addfeeelement';
var session = $("#session").val(); 
var txtElement = $("#txtElement").val(); 
if (txtElement=='')
{
	$('#regTitle').html('Enter element Name');
	return false;  
}
var dataString = 'element='+txtElement+'&session='+session+'&action='+action;
//alert(dataString);

 $.ajax({
	type:'POST',
	data:dataString,
	url:'../../ajax.php',
	success:function(data) {
		//alert(data);
		if(data!="")
				{
					//window.location.reload();
					if(data==1){
						alert("Required Parameter Missing");
						$("#preloader").css("display","none");
						return false;  
					}else if(data==5){
						//alert("Successfully");
						$("#preloader").css("display","none");
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						window.location.reload();
					}
				}
	}

  });
  
});
</script>
</body>
</html>

