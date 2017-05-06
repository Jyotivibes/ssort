<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | School Notice & Circulars</title>
    <?php include '../includes/head.php'; ?>


</head>

<body>
    <div id="wrapper">
	<?php
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='SAD') )
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
		require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
		require_once('../../classes/general_class.php');
		$obj = new General();
		$formErr='';
		if(isset($_REQUEST['SubmitSNC']))
		{	
			$res = $obj->ADDSCHOOLNOTICE();
			if($res == 2){
				$formErr='Please select only .jpg or .jpeg or .png image';
				//echo "<script>alert('Please select only .jpg or .jpeg or .png image');</script>";
				//echo "<script>window.location.href='school-notice-circular.php';</script>";
			}
			else if($res == 3){
				$formErr='Required parameter missing';
				//echo "<script>alert('Required parameter missing');</script>";
				//echo "<script>window.location.href='school-notice-circular.php';</script>";
			}
			else if($res == 0){
				$formErr='Problem in network.Please try again';
				//echo "<script>alert('Problem in network.Please try again.');</script>";
			}
			else if($res == 1){


                $formErr='Circular Activities added successfully';
                echo "<meta http-equiv='refresh' content='3'>";
                //header( "refresh:4;url=school-notice-circular.php" );
				//echo "<script>alert('Circular Activities added successfully.');</script>";
				//echo "<script>window.location.href='school-notice-circular.php';</script>";
			}
		}
	    $sqlnote=mysql_query("SELECT * FROM  essort_circular_activities WHERE STR_TO_DATE(valid_till, '%Y-%m-%d')>='".date('Y-m-d')."'");
	}
	else
	{
		echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
	} 
?>	
        <!-- Navigation -->
        <?php include '../includes/header-configuration.php'; ?>

        <!--sidebar nav st-->
        <?php include '../includes/sidebar-school.php'; ?>
		
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
                        <?php include_once("../includes/header-notice.php"); ?>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="javascript:void(0);">School</a>
                            </li>
                            <li class="active">Notice & Circulars</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <!--notice circular row st-->
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="my-box">
                            <h3 class="box-title box-title pad-b-10">Notice & Circulars
							    <a href="javascript:void(0)" class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span class="fa fa-backward"></span> Back</a>
                            </h3>


                            <div class="form-group">
                                <div class="input-group">
                                    <input placeholder="Search circular" class="form-control input-sm"
                                           id="notice_circular" type="text">
                                    <!---->
                                    <a href="javascript:void(0);" class="input-group-addon" id="search_notice">
                                        <span class="fa fa-search"></span>
                                    </a>
                                </div>
                            </div>
                          <!-- form-group -->

                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModales">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add Notice</button>
                                </div>
                            </div>

                            <div class="m-t-20">
                                <!--table st-->
                                <div class="table-responsive color-table info-table overflow_remove">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Notice/Circular</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($cirarray as $row)
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo date('d-m-Y', strtotime($row['date']));?></td>
                                            <td>
                                                <?php
                                                if(strlen($row['subject']) > 30){
                                                    echo substr($row['subject'],0,30).". . .";
                                                }
                                                else{
                                                    echo $row['subject'];
                                                }
                                                ?>

                                            </td>
                                            <td>
                                                <a href="javascript:void(0);">
                                                    <a data-toggle="modal" class="getdata"
                                                       data-href="<?php echo $row['attachment']; ?>"
                                                       data-subject="<?php echo $row['subject'];?>"
                                                       data-id="<?php echo $row['message'];?>"
                                                       data-date="<?php echo date('d-m-Y', strtotime($row['date']));?>">
                                                        <i style="cursor: pointer; cursor: hand;" class="fa fa-eye"></i></a>
                                                    <?php
                                                    if($row['attachment']!='')
                                                    {
                                                        ?>
                                                        <a href="../school-admin/uploads/<?php echo $row['attachment']; ?>" target="_blank">
                                                            <span class="glyphicon glyphicon-download-alt">  </span>
                                                        </a>
                                                    <?php
                                                    }
                                                    ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                                <!--table en-->
                            </div>
                        </div>
                        <!--en white-box-->
                    </div>
                    <!--en col-->
                </div>
                <!--en row-->

                <!--notice circular row en-->

            </div>

            <!-- .right-sidebar st here-->
        </div>
        <!-- /.container-fluid -->
       <?php include'../includes/footer.php'; ?>
    </div>
    <!-- /#page-wrapper -->
    <!--latest circular st-->
<!--latest circular en-->

        <?php include '../includes/foot.php'; ?>
		<script>
			$(".getdata").click(function() {
			 var dra=$(this).attr("data-id"); 
			 var subject=$(this).attr("data-subject"); 
			 var date=$(this).attr("data-date");
			 var href=$(this).attr("data-href");
			 $("#target").css("display", "block");
			 if(href=='')
			 {
				$("#target").css("display", "none");
			 }
			 
             $("#success_message").html(dra);			 
             $("#date").html(date);
             $("#subject_message").html(subject);
            $("#target").attr("href", "<?php echo HTTP_SERVER;?>dashboard/school-admin/uploads/"+href+"");			 
			  $("#myViewmodal").modal('show');
			

			});
		</script>
    <!-- /#page-wrapper -->
<div class="modal fade" id="myViewmodal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"  id="subject_message">Did this Notice & Circulars is relevent</h4>
            </div>
            <div class="modal-body">
                <p class="text-justify" id="date"></p>
                <p class="text-justify" id="success_message"></p>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 pull-right text-center">
                        <a href="#" class="btn btn-link marg-right" id="target" target="_blank"><span class="fa fa-paperclip"></span> Download Attachment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
    <!-- Modal -->
    <div class="modal fade" id="myModales" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Notice & Circular </h4>
                </div>
				<div id="noticemsg"></div>
				<form action="" method="post" name="noticeform" onsubmit="return circularValidate();" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="pwd">Subject:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control subject" placeholder="" name="subject">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="pwd">Message:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control message" rows="5" id="comment" type="text" name="message"></textarea>
                        </div>
                    </div>
                    <br>
                   <div class="form-group">
                        <label class="control-label col-sm-3" for="pwd">Select File:</label>
                        <div class="col-sm-9">
                            <input type="file" name="attach" id="fileChooser"  />
                            <small>(Only PDF/JPEG Files)</small>
                            <br>
                            <br>
                        </div>
                    </div>
                   <div class="form-group">
                        <label class="control-label col-sm-3 " for="pwd">Valid Till:</label>
                    </div>
                   <div class="input-group date">
                       <input class="form-control date_form" id="till_date" placeholder="Valid Till" name="date_form" type="text">

                       <div class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                       </div>
                   </div>
                    <br>
                    <br>
                </div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-info" value="Submit" name="SubmitSNC">
                </div>
				</form>
                
            </div>

        </div>
    </div>
        <!-- /#wrapper -->
  <script>

 function circularValidate(){

	if(document.noticeform.subject.value == '')
	{
		document.getElementById('noticemsg').innerHTML='Please enter Subject';
		document.noticeform.subject.focus();
		return false;
	}
	if(document.noticeform.message.value == '')
	{
		document.getElementById('noticemsg').innerHTML='Please enter message';
		document.noticeform.message.focus();
		return false;
	}
     var ext = $('#fileChooser').val().split('.').pop().toLowerCase();
     if($.inArray(ext, ['gif','png','jpg','jpeg','pdf','doc','docx']) == -1) {
         document.getElementById('noticemsg').innerHTML='Please select Valid File';
         return false;
     }
     if(document.noticeform.date_form.value == '')
     {
         document.getElementById('noticemsg').innerHTML='Please Valid Date';
         document.noticeform.date_form.focus();
         return false;
     }
     
	return true;
}
</script> 
<!--<script>
		function myFunction() {
			var x = document.getElementById("text").value;
			var action='sea/*rchcircular';
			var session = '<?php /* echo $_SESSION['USER']['DB_NAME']; */ ?>';
			var dataString = 'element='+x+'&action='+action+'&session='+session;
			$.ajax({
			type:'POST',
			data:dataString,
			url:'../../ajax.php',
			success:function(data) {
	        if(data!="")
				{
					//window.location.reload();
					if(data==1){
						alert("Required Parameter Missing");
						$("#preloader").css("display","none");
						return false;  
					}
					else if(data==4){
						alert("Session Expired......Try Again.....");
						$("#preloader").css("display","none");
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						window.location.reload();
					}
					else{
						var mydata = JSON.parse(data);
						$.each(mydata.data, function (i, item) {
						var html += "cdsf";
						});
						//$("#preloader").css("display","none");
						$("#circulardata").html(html).show();
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						//window.location.reload();
						
					}
				}
	}

  });
		}
	</script>  -->
    <!--------------------------FOR SEARCH MODEL------------------>
    <div class="modal" id="eventModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    <h4 class="modal-title">Notice Circular</h4>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="eventModals">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    <h4 class="modal-title">No Record Found</h4>
                </div>
            </div>
        </div>
    </div>

    <script>
        /*******************************FOR AUTO SEARCH**************************************/
        $(function () {
            var noticecircular = [
                <?php
                $i = 0;
                $size = count($cirarray);
                foreach($cirarray as $key=>$row){
                    echo '"'.$row['subject'].'"';
                    echo ($size==++$i)?'':', ';
                }
                ?>
            ];
            $("#notice_circular").autocomplete({
                source: noticecircular
            });
        });
        $(document).ready(function () {
            $("#search_notice").click(function (event) {
                var notice_circular = $("#notice_circular").val();
                if (notice_circular.length == 0) {
                    $("#eventModal").find('.modal-body').html('No Record found');
                    $("#eventModal").modal('show');
                    return false;
                }
                $.ajax({
                    url: "<?php echo HTTP_SERVER; ?>ajax.php?action=notice_circular&session=<?php echo $_SESSION['USER']['DB_NAME']; ?>",
                    type: "POST",
                    data: {
                        notice_circular: notice_circular
                    },
                    success: function (data) {
//console.log(data)
                        if (data == 0) {

                            $("#eventModals").find('.modal-body').html(data);
                            $("#eventModals").modal('show');

                        }
                        else {
                            $("#eventModal").find('.modal-body').html(data);
                            $("#eventModal").modal('show');
                        }


                    }
                });
            });
        });
    </script>
    <script>
        jQuery('#till_date').datepicker({
            startDate:new Date(),
            format: 'dd-mm-yyyy',
            "autoclose": true,
            todayHighlight: true
        });
    </script>
</body>

</html>