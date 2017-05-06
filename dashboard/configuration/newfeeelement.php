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
		//$resultclass=mysql_fetch_array($sqlclass);
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
               <?php include '../includes/header-notice.php'; ?>

                <div class="row">
                    <div class="col-sm-12 my-box">
                        <h3>Add/View Fee Element
						<a href="javascript:void(0)" class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span class="fa fa-backward"></span> Back</a></h3>                        
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading bg-accordian">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne1">Add Fee Element</a>
                                    </h4> 
                                </div>
                                <div id="collapseOne1" class="panel-collapse in collapse">
                                    <div class="panel-body">
                                        <div class="form-group">
										   <div id="regTitle"></div>
							   <div class="input-group">
							   <input type="hidden" placeholder="Enter element" name="session" id="session" value="<?php echo $dbname;?>"/>
								<input type="text" class="form-control txtElement" placeholder="Enter element" name="txtElement" id="txtElement"  />
								<div class="input-group-btn">
								<!--<button type="button" class="btn btn-info bord-radius btn-theme input-sm"><span class="fa fa-plus"></span> Fee Element</button>-->
								<button type="submit" class="btn btn-info btn-theme bord-radius" id="addfeeelement">Save</button>
								</div>
							   </div>
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
                                    <th>Action</th>
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
                                    <td>
                                        <a href="editfeeelement.php?id=<?php echo $row['fee_id'];?>" data-toggle="tooltip" data-original-title="Edit" ><span class="fa fa-pencil text-inverse m-r-10"></span></a>
                                        <!--<a href="editfeeelement.php?id=<?php echo $row['fee_id'];?>" data-toggle="tooltip" data-original-title="Disable"><span class="fa fa fa-eye-slash text-inverse"></span></a>-->
                                    </td> 
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

