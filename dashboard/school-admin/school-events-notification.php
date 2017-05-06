<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | Principal</title>
    <?php include '../includes/head.php'; ?>
</head>

<body>
    <div id="wrapper">
	<?php
	$formErr='';
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='SAD') )
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
		require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
		require_once('../../classes/general_class.php');
		$obj = new General();
        include_once 'stastics.php';
		if(isset($_REQUEST['SubmitSEN']))
		{	
			$res = $obj->ADDHOLIDAY();
			if($res == 3){
				$formErr='Required parameter missing';
				//echo "<script>alert('Required parameter missing');</script>";
				//echo "<script>window.location.href='school-events-notification.php';</script>";
			}
			else if($res == 0){
				$formErr='Problem in network.Please try again.';
				//echo "<script>alert('Problem in network.Please try again.');</script>";
			}
			else if($res == 1){
				$formErr='Event/Holidays added successfully';
				//echo "<script>alert('Circular Activities added successfully.');</script>";
				//echo "<script>window.location.href='school-events-notification.php';</script>";
			}
			
		}
	
		$sqlnote=mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM
		essort_holidays WHERE DATE_FORMAT(off_day,'%Y') = '".date('Y')."' GROUP BY occassion ORDER BY maxoff ASC");
	}
	else
	{
		echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
	} 
?>	
        <!-- Navigation -->
        <?php include'../includes/header-configuration.php'; ?>        
        <!--sidebar nav st-->
        <?php include '../includes/sidebar-school.php'; ?>
		
        <!--sidebar nav en-->
        <!-- Page Content -->
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



                <!--stu info st-->
                <div class="row"> 
                    <div class="row">
                <div class="col-sm-12 col-xs-12">
                <div class="my-box">
				<a href="javascript:void(0)" class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span class="fa fa-backward"></span> Back</a>
                    <h3 class="box-title">Search Event/Holiday</h3>
                    <div class="m-t-20 event-panel">
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <form>
                          <div class="form-group">
                              <div class="input-group">
                                  <input placeholder="Event name" class="form-control" id="tags" type="text">
                                  <!---->
                                  <a href="javascript:void(0);" class="input-group-addon" id="search_data">
                                      <span class="fa fa-search"></span>
                                  </a>
                              </div>
                          </div>
                          <!-- form-group -->
                        </form>
                    </div><!--en col-->   
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <button type="button" class="btn btn-default pull-right border-round btn-event-bg" data-toggle="modal" data-target="#myEventes"><span class="fa fa-calendar-check-o"></span> Create Event/ Holiday</button>
                        </div>
                    </div>
                  </div><!--en white-box-->
                </div><!--en col-->
            </div>
                    <div class="col-xs-12 my-box">
                      
                        <div class="table-responsive twenty_three">

                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>S. No.</th>
                                        <th>By</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Type </th>
                                        <th>Event / Holiday</th>
                                        <th>View</th>
                                         <!--<th>Action</th>-->
                                    </tr>
                                </thead>
                                <tbody id="TableData">
								<?php
                                $i = 0;
                                $array = array();
								while($row=mysql_fetch_array($sqlnote))
								{
                                    $array[] = $row;
                                    $i++;
								?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $row['usr_role'];?></td>
                                        <td><?php echo date('d-m-Y', strtotime($row['minoff']));?></td>
                                       <td><?php echo date('d-m-Y', strtotime($row['maxoff']));?></td>
                                       <td><?php echo $row['occassion_type'];?></td>
                                        <td><?php echo $row['occassion'];?></td>
                                        <td>
                                            <a data-toggle="modal" class="getdata"
                                               data-href="" data-subject="<?php echo $row['occassion_type'];?>"
                                               data-oc="<?php echo $row['occassion']; ?>"
                                               data-to="<?php echo date('d-m-Y', strtotime($row['maxoff'])); ?>"
                                               data-from="<?php echo date('d-m-Y', strtotime($row['minoff'])); ?>"
                                               data-info="<?php echo $row['additional_info']; ?>"
                                               data-id="<?php echo $row['occassion'];?>"> <i class="view_btn fa fa-eye getdata" style="cursor: pointer;" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
							}
							?>								
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--col-en-->
            </div>
            <!--col-en-->
        </div>
        <!-- .right-sidebar st here-->
    </div>
    <!-- /.container-fluid -->
    <?php include'../includes/footer.php'; ?>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Attendance</h4>
                </div>
                <div class="modal-body">
                    In Time
                    <input type="text" class="time start" placeholder="HH:MM:SS" /> Out Time
                    <input type="text" class="time end" placeholder="HH:MM:SS" />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal -->
    <!--event modal st-->
<div class="modal fade" id="myEventes" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header-1">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Event/Holiday</h4>
        </div>
       <!--st modal-body-->
	   <div id="holidaymsg"></div>
	   <form class="form-horizontal" method="post" name="fromeventnote" action="" onsubmit="return holidayValidate();">
          <div class="modal-body">     
           
              <div class="form-group">
                <!--radio st-->
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    
                      <input type="radio" name="type" id="type" value="Event">
                      <label for="checkbox7"> Event</label>
                  
                  </div>
                     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    
                      <input type="radio" name="type" value="Holiday">
                      <label for="checkbox7"> Holiday</label>
                    
                  </div>
                <!--radio en-->
              </div>
                <input type="hidden" class="form-control mydatepicker role" value="Admin" name="role">
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-1 control-label">Date:</label>  
                <label for="inputPassword3" class="col-sm-1 control-label">From:</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control date_form event_date" name="date_form">
                </div>
                  <label for="inputPassword3" class="col-sm-2 control-label">To:</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control date_to event_date" name="date_to">
                </div>
              </div>
               <div class="form-group marg-bott">
                <label for="textarea" class="col-sm-2 control-label">Subject:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control subject" placeholder="Subject" name="subject">
                </div>  
              </div> 
              <div class="form-group marg-bott">
                <label for="textarea" class="col-sm-2 control-label">Description:</label>
                <div class="col-sm-10">
                  <textarea rows="5" class="message" name="message"></textarea>
                </div>  
              </div>    
            
        </div>
		  <div class="modal-footer">
          <div class="row">
                    <div class="col-sm-12 col-xs-12 pull-right text-center">
                        <!--<button type="button" class="btn btn-default btn-color border-round"><i class="fa fa-calendar-check-o"></i> Create Event</button>-->
						<i class="fa fa-calendar-check-o"></i> <input type="submit" class="btn btn-default btn-color border-round" value="Submit" name="SubmitSEN">
                    </div>        
          </div>
        </div>  
		</form>
<!--end modal-body-->
      
      </div>

    </div>
  </div>    
<!--event modal en-->

    <div class="modal" id="Modalevent">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    <h4 class="modal-title">Event Details</h4>
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
                    <!--<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>-->
                    <h4 class="modal-title">No Record Found</h4>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/foot.php'; ?>

    <!--------------------------------FOR AUTO SEARCH EVENT AND HOLIDAYS  YESTERDAY NIGHT 4 A.M-------------------------------------->
    <script>
        $(function () {
            var availableHolidays = [
                <?php
                $i = 0;
                $size = count($array);
                foreach($array as $key=>$row){
                echo '"'.$row['occassion'].'"';
                echo ($size==++$i)?'':', ';
                }
                 ?>
            ];
            $("#tags").autocomplete({
                source: availableHolidays
            });
        });
        $(document).ready(function () {
            $("#search_data").click(function (event) {
                //alert("oijghibojgbkjgnb");
                var holiday = $("#tags").val();
                if (holiday.length == 0) {
                    $("#eventModals").find('.modal-body').html('No Record Found');
                    $("#eventModals").modal('show');
                    return false;
                }
                $.ajax({
                    url: "<?php echo HTTP_SERVER; ?>ajax.php?action=event_holidays&session=<?php echo $_SESSION['USER']['DB_NAME']; ?>",
                    type: "POST",
                    data: {
                        holiday: holiday
                    },
                    success: function (data) {
                        //console.log(data)
                        if(data == 0){

                            $("#eventModals").find('.modal-body').html(data);
                            $("#eventModals").modal('show');

                        }
                        else{
                            $("#Modalevent").find('.modal-body').html(data);
                            $("#Modalevent").modal('show');
                        }
                    }
                });
            });
        });
    </script>

	<script>
			$(".getdata").click(function() {
			 var dra=$(this).attr("data-id"); 
			 var subject=$(this).attr("data-subject"); 
			 var date_to=$(this).attr("data-to");
                //alert(date_to);
			 var date_from=$(this).attr("data-from");
			 var info=$(this).attr("data-info");
			 var href=$(this).attr("data-href");
			 $("#target").css("display", "block");
			 if(href=='')
			 {
				$("#target").css("display", "none");
			 }
             $("#success_message").html(dra);			 
             $("#subject_message").html(subject);
                //alert(date_from);
                //alert(date_to);
                var blank="";
                $("#date_from").html(blank);
                $("#date_to").html(blank);
                if (date_from === date_to) {
                    $("#date_from").html(date_from);
                }
                else {
                    $("#date_from").text(' From : ' + date_from);
                    $("#date_to").html(' To : ' + date_to);
                }
             $("#info").html(info);
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
                <p class="text-justify"  id="success_message"></p>
                <span id="date_from"></span>
                <span id="date_to"></span>
                <p class="text-justify"  id="info"></p>
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
<script>
 function holidayValidate(){

         var radios = document.getElementsByName("type");
         var formValid = false;

         var i = 0;
         while (!formValid && i < radios.length) {
             if (radios[i].checked) formValid = true;
             i++;
         }
         if (!formValid)
         {
             document.getElementById('holidaymsg').innerHTML='Please Select at least one from Event Or Holiday ';
             document.getElementById("type").focus();
             return false;
         }

	if(document.fromeventnote.date_form.value == '')
	{
		document.getElementById('holidaymsg').innerHTML='Please enter Date From';
		document.fromeventnote.date_form.focus();
		return false;
	}
	if(document.fromeventnote.date_to.value == '')
	{
		document.getElementById('holidaymsg').innerHTML='Please enter Date To';
		document.fromeventnote.date_to.focus();
		return false;
	}
     if(document.fromeventnote.date_form.value  > document.fromeventnote.date_to.value)
	{
		document.getElementById('holidaymsg').innerHTML='To date should be greater or equal to From date';
		document.fromeventnote.date_to.focus();
		return false;
	}
	if(document.fromeventnote.subject.value == '')
	{
		document.getElementById('holidaymsg').innerHTML='Please enter Subject';
		document.fromeventnote.subject.focus();
		return false;
	}
	if(document.fromeventnote.message.value == '')
	{
		document.getElementById('holidaymsg').innerHTML='Please enter message';
		document.fromeventnote.message.focus();
		return false;
	}
	return true;
}
</script>   
<script>   
$("#seldata").keyup(function(e) {
var action='searcheventbyname';
var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>'; 
var txtElement = $("#seldata").val(); 
var dataString = 'element='+txtElement+'&session='+session+'&action='+action;
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
					}
					else if(data==4){
						alert("Session Expired......Try Again.....");
						$("#preloader").css("display","none");
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						//window.location.reload();
					}
					else{
						//alert(data);
						$("#preloader").css("display","none");
						$("#TableData").html(data);
						//$('.loginform .user').val("");
						//$('.loginform .password').val("");
						//window.location.reload();
					}
				}
	}

  });
});
</script>
<script>
    jQuery('.event_date').datepicker({
        startDate:new Date(),
        format: 'dd-mm-yyyy',
        "autoclose": true,
        todayHighlight: true
    });
</script>
</body>

</html>