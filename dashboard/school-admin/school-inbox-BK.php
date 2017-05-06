<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>School Management Solutions - SMS | Inbox</title>
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
	   if(isset($_REQUEST['SendM']) )
		{
			$addmessage = $obj->ADDMESSAGE();
			if($addmessage == 1){
				//echo "<script>alert('Message send')</script>";
				$formErr='Message send';
			}
			
		}
		
    }
    else{
        echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
    }

    ?>
	
<!-- Navigation -->
 <?php include '../includes/header-configuration.php'; ?>
<!-- Left navbar-header -->
<?php include '../includes/sidebar-school.php'; ?>
<!-- Left navbar-header end -->
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
<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
<h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting from 15 November 2016.</span></h4>
</div>
<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
<ol class="breadcrumb">
<li>
<a href="javascript:void(0);">Chairman</a>
</li>
<li class="active">Inbox</li>
</ol>
</div>

</div>

<!--inbox st-->
<div class="row">
<div class="col-sm-12 col-xs-12">
<div class="my-box">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="panel panel-default">    
    <div class="panel-body">
        <div class="inbox-center table-responsive">
            <table class="table table-hover" border="0">
            <thead>
            <tr><th width="30">
            <div class="checkbox m-t-0 m-b-0">
            <input id="checkbox0" class="checkbox-toggle chkSelectAll" value="check all" type="checkbox">
            <label for="checkbox0"></label>
            </div>
            </th>
            <th colspan="4">
            <div class="btn-group drop-down">
               <select class="form-control no-style typemsg"> 
                   <option value="0">Read</option>
                   <option value="1">Unread</option>
                </select>
            </div>

            <div class="btn-group">
            <a href="" class="btn btn-default waves-effect waves-light border-round">
                <span class="fa fa-refresh"></span>
            </a>
            </div>
            
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-dafault btn-color waves-effect waves-light border-round" data-toggle="modal" data-target="#myCompose">New Message 
                <span class="fa fa-pencil-square-o"></span> 
                </button>
            </div>
            
            <!--<button type="button" class="btn btn-info waves-effect waves-light border-round pull-right btn-trash btnGetAll" value="Trash">Trash 
            <span class="fa fa-trash"></span> 
            </button>    -->
            </th>

            <th>
            <nav aria-label="Page navigation" class="pull-left">
            <ul class="pagination page">
            <li><a href="#">1-50 of 624</a></li>
            </ul>
            </nav>
            <div class="dropdown pull-left">
            <a href="#" class="btn dropdown-toggle btn-caret" data-toggle="dropdown" data-placement="right">
            <strong class="caret"></strong>
            </a>
            <ul class="dropdown-menu drop-menu">
            <li class="dropdown-header">Show up to:</li>
            <li class="divider"></li>
            <li>
            <a href="#">5 items</a>
            </li> 
            <li>
            <a href="#">10 items</a>
            </li> 
            <li>
            <a href="#">15 items</a>
            </li> 
            <li>
            <a href="#">20 items</a>
            </li> 
            </ul>
            </div>
            </th>
            </tr></thead>
            <tbody>
			<?php
			$i=1;
			$messages_id='';
			foreach($sqlmsgs as $msgvlue)
			{
			foreach ($msgvlue['messages'] as $key => $row) {
				// replace 0 with the field's index/key
				$dates[$key]  = $row['date'];
				$messages_id.=$row['message_id'].",";
			}

			array_multisort($dates, SORT_ASC, $msgvlue['messages']);
			?>
            <tr class="unread accordion-toggle" data-id="<?php echo $messages_id;?>" data-toggle="collapse" data-target="#message-open<?php echo $i;?>" style="cursor: pointer;">
            <td>
            <div class="checkbox m-t-0 m-b-0">
            <input class="checkbox-toggle chkNumber" type="checkbox" value="<?php echo $msgvlue['message_id'];?>">
            <label for="checkbox0"></label>    
            </div>
            </td>      
			
				<td class="max-texts bold-text" colspan="2">
				<a href="javascript:void(0);"><span class="btn-link btn-name"><strong><?php echo $msgvlue['from_name'];?></strong></span> <span class="label label-info m-r-10"><?php echo $msgvlue['from_role'];?></span> <?php echo $msgvlue['subject'];?>..</a>
				</td>
			
            <td colspan="3" class="bold-text"><span><?php echo $msgvlue['date'];?></span></td>
            </tr>
			
            <!--open st-->
            <tr>
                <td colspan="6" class="hiddenRow">
                    <div class="panel panel-default accordian-body collapse" id="message-open<?php echo $i;?>">
                    <div class="panel-heading text-right">
                            <a href="#" data-toggle="modal"  class="btn btn-default btn-color myReply" data-id="<?php echo $msgvlue['from_id'];?>"  data-role="<?php echo $msgvlue['from_role'];?>" data-subject="<?php echo $msgvlue['subject'];?>">
                            Reply <span class="fa fa-share"></span></a>
                    </div>
                    <div class="panel-wrapper">
                      <div class="panel-body">
					  <?php
					  $y=1;
					  foreach($msgvlue['messages'] as $msgvlue)
					  {
						if($msgvlue['from_name']==$_SESSION['USER']['USER_NAME'])
						{
							
							$firsttag='reciever';
							$sectag='right';
						
						}
						else
						{
							$firsttag='sender';
							$sectag='left';
						}
					  ?>
                        <div class="row message-gap">  
                            <div class="<?php echo $firsttag;?> col-sm-12 <?php echo $sectag;?>-arrow pull-<?php echo $sectag;?>"> 
                                <p class="info-user">
                                    <strong class="pull-left"><?php echo $msgvlue['from_name'];?></strong>
                                    <span class="pull-right"><?php echo $msgvlue['date'];?></span>
                                </p>    
                                <p class="text-justify para-space"><?php echo $msgvlue['message'];?></p>
                                <?php if($msgvlue['attachment']!='')
								{
								?>
									<strong class="text-left btn-block">Attachment:  <a href="<?php echo HTTP_SERVER."".'dashboard/teacher/uploads/'.$msgvlue['attachment'].'';?>"><span class="fa fa-download"></span> <?php echo $msgvlue['attachment'];?></a></strong>
								<?php
								}
								?>
                            </div>    
                          </div>
                        <?php
						$y++;
						}
						?>
                          <!--<div class="row message-gap">
                              <div class="receiver col-sm-12 right-arrow pull-right">  
                                <p class="info-user">
                                    <span class="pull-left">11/Nov-2016 7:10PM</span>
                                    <strong class="pull-right">Chirag Sharma</strong>
                                </p>
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                              </div>
                          </div>  -->    
                      </div>
                    </div>
                  </div>
                </td>
            </tr>
			<?php
			$i++;
			}
            ?>
            <!--open en-->    

           
            
                 <!--open st-->
            <tr>
                <td colspan="6" class="hiddenRow">
                    <div class="panel panel-default accordian-body collapse" id="message-open6">
                    <div class="panel-heading text-right">
                            <a href="#" data-toggle="modal" data-target="#myReply" class="btn btn-default btn-color">
                            Reply <span class="fa fa-share"></span></a>
                    </div>
                    <div class="panel-wrapper">
                      <div class="panel-body">
                        <div class="row message-gap">  
                            <div class="sender col-sm-12 left-arrow pull-left"> 
                                <p class="info-user">
                                    <strong class="pull-left">Admin</strong>
                                    <span class="pull-right">11/Nov-2016 7:10PM</span>
                                </p>    
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                <strong class="text-left btn-block">Attachment:  <a href="#"><span class="fa fa-download"></span> Report card</a></strong>
                            </div>    
                          </div>

                          <div class="row message-gap">
                              <div class="receiver col-sm-12 right-arrow pull-right">  
                                <p class="info-user">
                                    <span class="pull-left">11/Nov-2016 7:10PM</span>
                                    <strong class="pull-right">Aman Sharma</strong>
                                </p>
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                              </div>
                          </div>      
                      </div>
                    </div>
                  </div>
                </td>
            </tr>
            <!--open en-->     
            </tbody>

            <tfoot>
                <tr>
                    <th width="30">
                    <div class="checkbox m-t-0 m-b-0">
                    <input id="checkbox0" class="checkbox-toggle" value="check all" type="checkbox">
                    <label for="checkbox0"></label>
                    </div>
                    </th>
                    <th colspan="4">
                    <div class="btn-group">
                        <button type="button" class="btn btn-dafault dropdown-toggle btn-color waves-effect waves-light border-round btnGetAll" data-toggle="dropdown" value="Delete">Delete 
                            <span class="fa fa-trash"></span>
                        </button>
                    </div>

                    <div class="btn-group">
                        <a href="" type="button" class="btn btn-default waves-effect waves-light border-round">
                            <span class="fa fa-refresh"></span>
                        </a>
                    </div>                
                    </th>

                    <th>
                    <div class="btn-group pull-left">
                    <button type="button" class="btn btn-dafault btn-color waves-effect waves-light border-round" data-toggle="modal" data-target="#myCompose">New Message 
                    <span class="fa fa-pencil-square-o"></span> 
                    </button>
                    </div>  
                    </th>
                </tr>
                <!--<tr>
                    <th colspan="6">
                        <nav aria-label="Page navigation" class="text-center">
                          <ul class="pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                              </a>
                            </li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">»</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                    </th>
                </tr>-->
            </tfoot>
            </table>
        </div>
    </div><!--en panel body-->    
</div><!--en panel-->    
</div><!--en inbox col-->
</div><!--en row-->
</div>
</div>
</div>    
<!--inbox en-->
</div>
<!-- .right-sidebar st here-->
</div>
<!-- /.container-fluid -->
 <?php include'../includes/footer.php'; ?>
</div>
<!-- /#page-wrapper -->

<!-- /#wrapper -->


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
<!--Style Switcher -->
<!--<script src="js/jQuery.style.switcher.js"></script>-->
<!-- Modal -->
<div class="modal fade" id="myCompose" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header-1">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">New Message</h4>
</div>
<form class="form-horizontal" method="post" action="">
<div class="modal-body">     

<input type="hidden" name="from_role" value="Admin">
<input type="hidden" name="from_id" value="<?php echo $_SESSION['USER']['USER_ID'];?>">
<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">To:</label>
<div class="col-sm-10">
<select class="wd-select to_role" name="to_role">
<option>--select--</option>
<option value="Principal">Principal</option>
<option value="Admin">Admin</option>
<option value="Teacher">Teacher</option>
</select>
</div>
</div>
<div class="form-group" id="teacher_id" style="display:none;">
                <label for="inputEmail3" class="col-sm-2 control-label">To:</label>
                <div class="col-sm-10">
					<select class="wd-select" name="teacher_id">
                    <?php echo $optionstaff;?>
                 </select>
                </div>
              </div>
			  
<div class="form-group">
<label for="inputPassword3" class="col-sm-2 control-label">Subject:</label>
<div class="col-sm-10">
<input type="text" class="form-control" name="subject">
</div>
</div>
<div class="form-group marg-bott">
<label for="textarea" class="col-sm-2 control-label">Message:</label>
<div class="col-sm-10">
<textarea rows="5" class="message" name="message"></textarea>
</div>  
</div>    
 <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2 col-xs-12"></div>
                            <div class="col-sm-10">
                                <label class="btn btn-link pull-right marg-right">
                                    <span class="fa fa-paperclip"></span>
                                    Attachment <input type="file" class="hidden" name="attach">
                                </label>
                            </div>
                        </div>
                    </div>    


</div>
<div class="modal-footer">
<div class="row">
<div class="col-sm-12 col-xs-12 pull-right text-center">
<input type="submit" class="btn btn-default btn-color border-round" value="Send" name="SendM">
</div>        
</div>
</div>  
</form>
</div>

</div>
</div>
<!-- Modal -->
   <script>
			$(".myReply").click(function() {
			 var dra=$(this).attr("data-id"); 
			 var subject=$(this).attr("data-subject"); 
			 var data_role=$(this).attr("data-role"); 
			  $('#data_role').val(data_role);
			  $('#data_role_to').val(dra);
			  $('#data_subject').val(subject);
			  $("#myReply").modal('show');
			

			});
		</script> 
<!--reply modal st-->
<div class="modal fade" id="myReply" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header-1">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reply</h4>
        </div>
		 <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="modal-body">     
          
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">To:</label>
                <div class="col-sm-10" id="role">
				<input type="hidden" id="from_role" value="Admin" name="from_role">
				<input type="hidden" id="data_role_hidden" name="from_id" id="from_role_id" value="<?php echo $_SESSION['USER']['USER_ID']; ?>">
				<input type="text" id="data_role" name="to_role" readonly>
				<input type="hidden" id="data_role_to" name="teacher_id">
				<!--<select class="wd-select">
                    <option>--select--</option>
                    <option>Principal</option>
                    <option>Admin</option>
                    <option>Teacher</option>
                 </select>-->
                </div>
              </div>
			  <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Subject:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="data_subject" name="subject" readonly>
                </div>
              </div>
              <div class="form-group marg-bott">
                <label for="textarea" class="col-sm-2 control-label">Message:</label>
                <div class="col-sm-10">
                  <textarea rows="5" class="message" name="message" ></textarea>
                </div>  
              </div>    
             <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2 col-xs-12"></div>
                            <div class="col-sm-10">
                                <label class="btn btn-link pull-right marg-right">
                                    <span class="fa fa-paperclip"></span>
                                    Attachment <input type="file" class="hidden" name="attach">
                                </label>
                            </div>
                        </div>
                    </div>    
               
            
        </div>
        <div class="modal-footer">
          <div class="row">
                    <div class="col-sm-12 col-xs-12 pull-right text-center">
                        <input type="submit" class="btn btn-default btn-color border-round" value="Send" name="SendM"><!--<i class="fa fa-paper-plane"></i> Send</button>-->
                    </div>        
          </div>
        </div>  
		</form>
      </div>
      
    </div>
  </div>    
<!--reply modal en--> 
<script>   
//######################################CHECKBOX########################################################

    $(function () {
      $('.btnGetAll').click(function () {
        if ($('.chkNumber:checked').length) {
          var chkId = '';
          $('.chkNumber:checked').each(function () {
            chkId += $(this).val() + ",";
          });
          chkId = chkId.slice(0, -1);
		 // alert($(this).attr("value"));
         // alert(chkId);
		  if($(this).attr("value")=='Trash')
		  {
			 var action='trashmsg';
		  }
		  else
		  {
			var action='deletemsg';
		  }
		  var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>'; 
		  var dataString = 'action='+action+'&session='+session+'&chkId='+chkId;
		  //AJAX START
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
									//$('.loginform .user').val("");
									//$('.loginform .password').val("");
									//window.location.reload();
								}
							}
				}

  });
  
		  //AJAX END
        }
        else {
          alert('Nothing Selected');
        }
      });

      $('.chkSelectAll').click(function () {
        $('.chkNumber').prop('checked', $(this).is(':checked'));
      });

      $('.chkNumber').click(function () {
        if ($('.chkNumber:checked').length == $('.chkNumber').length) {
          $('.chkSelectAll').prop('checked', true);
        }
        else {
          $('.chkSelectAll').prop('checked', false);
        }
      });

    });
//######################################CHECKBOX########################################################
</script>
<script type="text/javascript">
$(".typemsg").change(function(e) {

var selectedCountry = $(".typemsg option:selected").val();
var url = '<?php echo HTTP_SERVER;?>';
var id='id';
var url += "?" + id + '=' + selectedCountry;
alert(url);
window.location.replace(url);
  
});
</script>

<script type="text/javascript">
$(".to_role").change(function(e) {
var action='mymsgs';
var session = '<?php echo $_SESSION['USER']['USER_ID'];?>'; 
var id = '<?php echo $_SESSION['USER']['USER_ID'];?>'; 
var role = '<?php echo $_SESSION['USER']['ROLE_ID'];?>'; 
var selectedCountry = $(".to_role option:selected").val();
var dataString = 'seelectedoption='+selectedCountry+'&session='+session+'&role='+role+'&action='+action;
//alert(selectedCountry);

if(selectedCountry=='Teacher')
{
	$("#teacher_id").css("display", "block");
}
  
});
</script>
<script type="text/javascript">
$(".accordion-toggle").click(function(e) {
var action='readtounread';
var session = '<?php echo $_SESSION['USER']['DB_NAME'];?>'; 
var id = '<?php echo $_SESSION['USER']['USER_ID'];?>'; 
var role = '<?php echo $_SESSION['USER']['ROLE_ID'];?>'; 
var data = $(this).attr("data-id");
var dataString = 'data='+data+'&session='+session+'&role='+role+'&id='+id+'&action='+action;
//alert(dataString);
 $.ajax({
	type:'POST',
	data:dataString,
	url:'../../ajax.php',
	success:function(data) {
		//alert(data);
		if(data!="")
				{
					
				}
	}

  });
  
});
</script>
</body>
</html>

