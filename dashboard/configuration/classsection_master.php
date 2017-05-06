<?php
require_once '../../classes/config.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>School Management System - SMS | Class Type</title>
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
		if(isset($_REQUEST['SubmitC']))
		{	
			$res = $obj->ADDCLASSESSECTION();
			$formErr='';
			if($res == 2){
				//echo "<script>alert('Required parameter missing');</script>";
				//echo "<script>window.location.href='create-group.php';</script>";
				$formErr='Required parameter missing';
			}
			else if($res == 3){
				//echo "<script>alert('Problem in network.Please try again.');</script>";
				$formErr='Class Already Exist.';
			}
			else if($res == 3){
				//echo "<script>alert('Problem in network.Please try again.');</script>";
				$formErr='Class Already Exist.';
			}
			else if($res == 0){
				//echo "<script>alert('Problem in network.Please try again.');</script>";
				$formErr='Problem in network.Please try again.';
			}
			else if($res == 1){
				//echo "<script>alert('Class detail added successfully.');</script>";
				//echo "<script>window.location.href='classsection_master.php';</script>";
				$formErr='Class detail added successfully.';
			}
		}
		//SUBMITE
		if(isset($_REQUEST['SubmitE']))
		{	
			$res = $obj->UPDATECLASSESSECTION();
			$formErr='';
			if($res == 2){
				//echo "<script>alert('Required parameter missing');</script>";
				//echo "<script>window.location.href='create-group.php';</script>";
				$formErr='Required parameter missing';
			}
			else if($res == 3){
				//echo "<script>alert('Problem in network.Please try again.');</script>";
				$formErr='Section Updated.';
			}
			else if($res == 0){
				//echo "<script>alert('Problem in network.Please try again.');</script>";
				$formErr='Problem in network.Please try again.';
			}
			else if($res == 1){
				//echo "<script>alert('Class detail added successfully.');</script>";
				//echo "<script>window.location.href='classsection_master.php';</script>";
				$formErr='Class detail added successfully.';
			}
			else if($res == 4){
				//echo "<script>alert('Class detail added successfully.');</script>";
				//echo "<script>window.location.href='classsection_master.php';</script>";
				$formErr='Error...You can not able to decrease Section';
			}
		}
		$sqlclass=mysql_query("SELECT * FROM  essort_classes");
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
                <!------------------------FOR NEWS AND NOTIFICATION IN HEADER SECTION------------------->
                <?php include_once("../includes/header-notice.php"); ?>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 my-box">
					<a href="javascript:void(0)" class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span class="fa fa-backward"></span> Back</a>
                       <h4 class="h4">Add/View Class Type</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <a href="#" data-toggle="modal" data-target="#addNewClass" class="btn btn-info pull-right"><span class="fa fa-plus"></span> Add New Class</a>
                            </div>
                        </div>
                        <div class="row">
                         <div class="col-sm-12 col-xs-12">
                             <div class="table-responsive">
                                 <table class="table addclass" border="1" id="editfrm">
                                    <thead>
                                      <tr>
                                        <th>Sl. No.</th>
                                        <th>Class</th>
                                        <th>Section</th>
                                        <th>Action</th>                                
                                      </tr>
                                    </thead>
                                    <tbody>
									<?php
									$i=1;
									while($row=mysql_fetch_array($sqlclass))
									{
										
										$section='';
										//echo "SELECT * FROM essort_section WHERE class_id='".$row['class_id']."'";
										$sqlsection=mysql_query("SELECT * FROM essort_section WHERE class_id='".$row['class_id']."'");
										while($rows=mysql_fetch_array($sqlsection))
										{
											$section.=$rows['section_name'].",";
										}
									?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td id="class<?php echo $i;?>"><?php echo $row['class_name'];?></td>
                                        <td id="section<?php echo $i;?>"><?php echo substr(trim($section), 0, -1);?></td>
                                        <td>
                                           <a href="#" data-toggle="modal"  class="classid" id="editclass<?php echo $i;?>" data-id="<?php echo $row['class_id'];?>" data-target="#editClassSection"><span class="fa fa-pencil text-inverse m-r-10"></span></a>
                                           <!-- <a href="#" data-toggle="tooltip" data-original-title="Disable"><span class="fa fa fa-eye-slash text-inverse"></span></a>-->
                                        </td>                                
                                      </tr>
                                    <?php
									$i++;
									}
									?>									 
                                    </tbody>
                                  </table>
                            </div><!--table responsive-->
                         </div><!--en col-->
                         </div><!--en row-->
                    </div><!--col-en-->
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
	</script>
	<?php
}
?>
<!--add new class st -->
<div class="modal fade" id="addNewClass" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header-1">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Class</h4>
        </div>
		 <div id="alertmsg"></div>
		<form method="post" action="" enctype="mutlipart/form-data" class="myform2" name="frmclass" onsubmit="return classsectionValidate();" >
        <div class="modal-body">     
           <div class="table-responsive">
				<table class="table addClassTable">
                <tbody>
                  <tr>
                    <td width="30%"><strong>Class Name</strong></td>  
                    <td colspan="4"><input type="text" class="form-control input-sm txtClassName" name="txtClassName" /></td>    
                  </tr>
                  <tr>
                    <td width="30%"><strong>Section Name</strong></td>  
                    <td>
                        <input type="text" class="form-control input-sm" name="txtSection1" />                            
                    </td>
                    <td>
                        <input type="text" class="form-control input-sm" name="txtSection2" />                            
                    </td>
                    <td>
                        <input type="text" class="form-control input-sm" name="txtSection3" />                            
                    </td>
                    <td>
                        <input type="text" class="form-control input-sm" name="txtSection4" />                            
                    </td>                                                                        
                  </tr>
                  <tr>
                        <td>&nbsp;</td>                    
                        <td>
                            <input type="text" class="form-control input-sm" name="txtSection5" />
                        </td>
                        <td>
                            <input type="text" class="form-control input-sm" name="txtSection6" />
                        </td>
                        <td>
                            <input type="text" class="form-control input-sm" name="txtSection7" />
                        </td>
                        <td>
                            <input type="text" class="form-control input-sm" name="txtSection8" />
                        </td>
                    </tr>                       
                </tbody>                
              </table>
			 </div>            
        </div>
		<div class="modal-footer">
          <div class="row">
            <div class="col-sm-12 col-xs-12 pull-right text-center">
				<button type="submit" class="btn btn-default btn-color border-round" name="SubmitC">Add</button>
                <button type="button" class="reset btn btn-color border-round"><i class="fa fa-times-circle"></i> Cancel</button>
            </div>
          </div>
        </div> 
    </form>		
      </div>
      
    </div>
  </div>    
<!--add new class en-->
<!--st edit class-->
<div class="modal fade" id="editClassSection" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header-1">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Class & Sections</h4>
        </div>
		<form method="post" action="" enctype="mutlipart/form-data"  id="" name="frmeditclass" class="frmeditclass"><!--onsubmit="return classsectionValidate();" -->
        <div class="modal-body">     
           <div class="">
              <table class="table addClassTable">
                <tbody>
				 <tr>
                    <!--<td width="30%"><strong>Class Id</strong></td> -->
                    <td colspan="4" style="display: none;"><input type="text" class="form-control input-sm" id="editclass_id" name="editclass_id" /></td>
                  </tr>
                  <tr>
                    <td width="30%"><strong>Class Name</strong></td>  
                    <td colspan="4"><input type="text" class="form-control input-sm" name="txtClassEdit" id="txtClassEdit" /></td>    
                  </tr>
                  <tr>
                    <td width="30%"><strong>Section Name</strong></td>  
                    <td>
                        <input type="text" class="form-control input-sm" name="txtsectionEdit0" id="txtsectionEdit0" />                            
                    </td>
                    <td>
                        <input type="text" class="form-control input-sm" name="txtsectionEdit1"   id="txtsectionEdit1"/>                            
                    </td>
                    <td>
                        <input type="text" class="form-control input-sm" name="txtsectionEdit2"  id="txtsectionEdit2" />                            
                    </td>
                    <td>
                        <input type="text" class="form-control input-sm" name="txtsectionEdit3"  id="txtsectionEdit3" />                            
                    </td>                                                                        
                  </tr>
                  <tr>   
                        <td>&nbsp;</td>                    
                        <td>
                            <input type="text" class="form-control input-sm" name="txtsectionEdit4"   id="txtsectionEdit4"/>
                        </td>
                        <td>
                            <input type="text" class="form-control input-sm" name="txtsectionEdit5"  id="txtsectionEdit5" />
                        </td>
                        <td>
                            <input type="text" class="form-control input-sm" name="txtsectionEdit6"  id="txtsectionEdit6" />
                        </td>
                        <td>
                            <input type="text" class="form-control input-sm" name="txtsectionEdit7"   id="txtsectionEdit7"/>
                        </td>
                    </tr>                       
                </tbody>                
              </table>
            </div>            
        </div>
		
        <div class="modal-footer">
          <div class="row">
            <div class="col-sm-12 col-xs-12 pull-right text-center">
				<button type="submit" class="btn btn-default btn-color border-round" name="SubmitE">Add</button>
                <button type="button" class="reset btn btn-color border-round"  data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
            </div>        
          </div>
        </div>  
		</form>
      </div>
      
    </div>
  </div>  
<!--en edit class-->
<script>
$(document).on("click", ".classid", function () {
     var myBookId = $(this).data('id');
	 var action='editdatabyclass';
	 var session = '<?php echo $_SESSION['USER']['DB_NAME'];?>'; 
	 $(".frmeditclass #editclass_id").val(myBookId);
	 var classname = $("#class_id").val(); 
	 var id=$(this).attr('id');
	 var suffix = id.match(/\d+/);
	 //alert(suffix);
	 var r = $("#editfrm #class"+suffix+"").text();
	 var s = $("#editfrm #section"+suffix+"").text();
	 $("#txtClassEdit").val(r);
	 var array = $("#editfrm #section"+suffix+"").text().split(",");
	 //var sectionn = $("#section"+suffix+"").val(); 
	     $("#txtsectionEdit1").val();
		 $("#txtsectionEdit2").val();
		 $("#txtsectionEdit3").val();
		 $("#txtsectionEdit4").val();
		 $("#txtsectionEdit5").val();
		 $("#txtsectionEdit6").val();
		 $("#txtsectionEdit7").val();
		 $("#txtsectionEdit8").val();
	 $.each(array,function(i){
		 $("#txtsectionEdit"+i+"").val(array[i]);
		  //alert(array[i]);
		});

});
</script>
<script>
 function classsectionValidate(){
	if(document.frmclass.txtClassName.value == '')
	{
		document.getElementById('alertmsg').innerHTML='Please enter class Name';
		document.frmclass.txtClassName.focus();
		return false;
	}
	if(document.frmclass.txtSection1.value == '')
	{
		document.getElementById('alertmsg').innerHTML='Please enter Atleast one Section';
		document.frmclass.txtSection1.focus();
		return false;
	}
	return true;
}
</script>
<!--FOR CANCEL BUTTON-->
<script>
    $(document).ready(function() {
        $(".reset").click(function() {
            $(':input','.myform2').val("");
        });
    });
</script>
</body>
</html>

