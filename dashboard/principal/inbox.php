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

        if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Principal') )
        {
            $user_id=$_SESSION['USER']['USER_NAME'];
            require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
            require_once('../../classes/general_class.php');
            require_once('../../classes/staff_class.php');
            $obj = new General();
			$obj2 = new Staff();
			$optionstaff = $obj2->optionofstaff();
            //include_once 'stastics.php';
            if(isset($_REQUEST['SendM']) )
            {
                $addmessage = $obj->ADDMESSAGE();
                if($addmessage == 1){
                    echo "<script>alert('Message send')</script>";
                }

            }
			#######GET ALL MESSAGES##################
				if(isset($_REQUEST['page'])=='')
				{
					$page=1;
				}
				else
				{
					$page=$_REQUEST['page'];
				
				}
				if(isset($_REQUEST['type'])=='')
				{
					$type=0;
				}
				else if($_REQUEST['type']=='unread')
				{
					$type=2;
				}
				else if($_REQUEST['type']=='read')
				{
					$type=1;
				}
				else if($_REQUEST['type']=='delete')
				{
					$type=4;
				
				}
				else
				{
					$type=0;
				}
				
				if(isset($_REQUEST['records'])=='')
				{
					$records=20;
				}
				else
				{
					$records=$_REQUEST['records'];
				
				}
				$sqlmsgs = $obj->VIEWALLMESSAGE($_SESSION['USER']['USER_ID'],$_SESSION['USER']['ROLE_ID'],$page,$type,$records);
				$countarr = $obj->getnoofmessages($_SESSION['USER']['USER_ID'],$_SESSION['USER']['ROLE_ID'],$page,$type,$records);
			#######GET ALL MESSAGES##################

        }
        else{
            echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
        }

        ?>

        <!-- Navigation -->
        <?php include '../includes/header-configuration.php'; ?>
        <!-- Left navbar-header -->
        <?php include'../includes/sidebar-principal.php'; ?>
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
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <?php include_once("../includes/header-notice-circular.php"); ?>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="<?php echo TEACHER_DASHBOARD_LINK;?>">Dashboard</a>
                            </li>
                            <li class="active">Messages</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
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

                                                                <label for="checkbox0"></label>
                                                            </div>
                                                        </th>
                                                        <th colspan="4">
                                                            <div class="btn-group drop-down">
                                                                <select class="form-control no-style typemsg">
                                                                    <option value="all">All</option>
                                                                    <option value="read" <?php if(isset($_REQUEST['type']) && ($_REQUEST['type']=='read')) { echo 'selected';} else {echo ''; }?>>Read</option>
                                                                    <option value="unread" <?php if(isset($_REQUEST['type']) && ($_REQUEST['type']=='unread')) { echo 'selected';} else {echo ''; }?>>Unread</option>
                                                                    <option value="delete" <?php if(isset($_REQUEST['type']) && ($_REQUEST['type']=='delete')) { echo 'selected';} else {echo ''; }?>>Trash</option>
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

                                                        </th>
                                                        <th>


                                                            <nav aria-label="Page navigation" class="pull-left">
                                                                <ul class="pagination page">
                                                                    <li><a href=""></a></li>show
                                                                    <select id="record">
                                                                        <?php
                                                                        $data = array();
                                                                        $records_fetchable=array(
                                                                            5=>'5 items',
                                                                            10=>'10 items',
                                                                            15=>'15 items',
                                                                            20=>'20 items',
                                                                            );
                                                                        $records=0;
                                                                        if(isset($_REQUEST['records']))
                                                                        {
                                                                            $records=$_REQUEST['records'];

                                                                        }
                                                                        else
                                                                        {
                                                                            $records=20;

                                                                        }

                                                                        foreach($records_fetchable as $key=>$value){
                                                                            $selected=($records==$key)?'selected="selected"':'';
                                                                            echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <li>entries</li>
                                                                </ul>
                                                            </nav>
                                                        </th>
                                                    </tr></thead>
                                                    <tbody class="pagingdata" id="pagingdata">
                                                    <?php
														$max_per_page = $records; //Max results per pag
														$pages = ceil($countarr / $max_per_page);
														if($countarr>0)
														{
															$i=1;
															foreach($sqlmsgs as $msgvlue)
															{
																$from_name=$msgvlue['from_name'];
																//DATE
																$messages_id='';
																foreach ($msgvlue['messages'] as $key => $row) {
																	// replace 0 with the field's index/key
																	$dates[$key]  = $row['date'];
																	$messages_id.=$row['message_id'].",";
																}

																//array_multisort($dates, SORT_ASC, $msgvlue['messages']);
																?>
        <tr class="unread accordion-toggle"  data-id="<?php echo $messages_id;?>" data-toggle="collapse" data-target="#message-open<?php echo $i;?>" style="cursor: pointer;">
            <td>
                <div class="checkbox m-t-0 m-b-0">
                    <input class="checkbox-toggle chkNumber" type="checkbox" value="<?php echo $msgvlue['message_id'];?>">
                    <label for="checkbox0"></label>
                </div>
            </td>

            <td class="max-texts <?php if($msgvlue['message_status']==2) echo'bold-text'; ?>" colspan="2">
                <a href="javascript:void(0);">
                    <span class="btn-name"> <?php if($msgvlue['message_status']==2) ?><?php echo $msgvlue['from_name'];?> <?php                             if($msgvlue['message_status']==2)  ?>
                    </span>
                </td>
                <td class="max-texts <?php if($msgvlue['message_status']==2) echo'bold-text'; ?>">
                    <span class="label label-info m-r-10"><?php echo $msgvlue['from_role'];?></span> <?php echo $msgvlue['subject'];?>..</a>
                </td>

                <td colspan="3" class="max-texts <?php if($msgvlue['message_status']==2) echo'bold-text'; ?>"><span><?php echo date('h:i:s',strtotime($msgvlue['date'])).",".date('d-m-Y',strtotime($msgvlue['date']));?></span></td>
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
                                    foreach($msgvlue['messages'] as $msgvlued)
                                    {
                                        if($msgvlued['from_id']==$_SESSION['USER']['USER_ID'])
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
                                                    <strong class="pull-left"><?php echo $msgvlued['from_name'];?></strong>
                                                    <span class="pull-right"><?php echo $msgvlued['date'];?></span>
                                                </p>
                                                <p class="text-justify para-space"><?php echo $msgvlued['message'];?></p>
                                                <?php if($msgvlued['attachment']!='')
                                                {
                                                    ?>
                                                    <strong class="text-left btn-block">Attachment:  <a href="<?php echo HTTP_SERVER."".$_SESSION['USER']['DB_NAME'].'/uploads/msg/'.$msgvlued['attachment'].'';?>"><?php echo $msgvlued['attachment']; ?></a>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            $y++;
                                        }
                                        ?>
                           
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <?php
        $i++;
    }
}
else
{

    echo '<tr class="unread accordion-toggle" data-toggle="collapse" data-target="#message-open" style="cursor: pointer;">
    <td>
        <div class="checkbox m-t-0 m-b-0">

            <label for="checkbox0"></label>    
        </div>
    </td>      

    <td class="max-texts bold-text" colspan="2">
       <a href="javascript:void(0);"><span class="btn-link btn-name"><strong></strong></span> <span class="label label-info m-r-10"></span> No Record Found..</a>
   </td>

   <td colspan="3" class="bold-text"><span></span></td>
</tr>';
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
                <input id="checkbox0" class="checkbox-toggle chkSelectAll" value="check all" type="checkbox">
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
    <tr>
        <th colspan="6">
            <nav aria-label="Page navigation" class="text-center">
                <?php
				$typeurl="";
				if(isset($_REQUEST['type']) && ($_REQUEST['type']!=''))
				{
					$typeurl = $_REQUEST['type'];
				}
                
                if($typeurl == ''){
                    $typeurl = 'all';
                }
				$pagedata="";
				if(isset($_REQUEST['page']) && ($_REQUEST['page']!=''))
				{
					$pagedata=$_REQUEST['page'];
				}
                if($pagedata=='')
                {
                    $pagedata=1;

                }

                $start=$pagedata-1;
                if($start==0)
                {
                    $start=1;
                }
                $end=$pagedata+1;
                if($end>$pages)
                {
                    $end=$pages;
                }
                ?>
                <ul class="pagination">
                    <li>
                        <a class="<?php if($pagedata==1) echo'btn disabled'; ?>" href="<?php echo HTTP_SERVER."".'dashboard/teacher/inbox.php?page='.$start.'&type='.$typeurl.'&records='.$max_per_page.'';?>" aria-label="Previous">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>

                    <?php

                    for($i=1;$i<=$pages;$i++)
                    {
                        ?>
                        <li class="<?php if($pagedata==$i) {echo 'active';} else {echo '';}?>"><a href="<?php echo HTTP_SERVER."".'dashboard/teacher/inbox.php?page='.$i.'&type='.$typeurl.'&records='.$max_per_page.'';?>" id="<?php echo $i;?>" class="paging"><?php echo $i;?></a></li>
                        <?php
                    }
                    ?>
							<li>
                                <a class="<?php if($pages==$pagedata) echo'btn disabled'; ?>" href="<?php echo HTTP_SERVER."".'dashboard/teacher/inbox.php?page='.$end.'&type='.$typeurl.'&records='.$max_per_page.'';?>" aria-label="Next">
                                    <span aria-hidden="true">»</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </th>
            </tr>
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
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="from_role" value="Admin">
                    <input type="hidden" name="from_id" value="<?php echo $_SESSION['USER']['USER_ID'];?>">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">To:</label>
                        <div class="col-sm-10">
                            <select class="wd-select to_role" name="to_role">
                                <option>--select--</option>
                                <option value="Principal">Principal</option>
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
                    <div class="form-group marg-bott">
                        <label for="textarea" class="col-sm-2 control-label">Attachment:</label>
                        <div class="col-sm-10">
                            <label class="btn btn-default btn-color border-round marg-right">
                                <span class="fa fa-paperclip"></span> Browse<input type="file" name="attach" style="display: none;" id="upload-file">
                            </label><span id="file-name"></span>
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
                            <input type="text" id="data_role" class="form-control" name="to_role" readonly>
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
                    <div class="form-group marg-bott">
                        <label for="textarea" class="col-sm-2 control-label">Attachment:</label>
                        <div class="col-sm-10">
                            <label class="btn btn-default btn-color border-round marg-right">
                                <span class="fa fa-paperclip"></span> Browse<input type="file" name="attach" style="display: none;" id="upload-file-1">
                            </label><span id="file-name-1"></span>
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
                // alert(dataString);
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
                                window.location.reload();
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
        var action='mymsgs';
        var session = '<?php echo $_SESSION['USER']['DB_NAME'];?>';
        var id = '<?php echo $_SESSION['USER']['USER_ID'];?>';
        var role = '<?php echo $_SESSION['USER']['ROLE_ID'];?>';
        var selectedCountry = $(".typemsg option:selected").val();
        var dataString = 'seelectedoption='+selectedCountry+'&session='+session+'&role='+role+'&action='+action;
//alert(dataString);

function getQueryVariable(url, variable) {
    var query = url.substring(1);
    var vars = query.split('&');
    for (var i=0; i<vars.length; i++) {
        var pair = vars[i].split('=');
        if (pair[0] == variable) {
            return pair[1];
        }
    }

    return false;
}


var url = window.location.href;
if (url.indexOf('?') > -1){
    if (url.indexOf('type') > -1){
        var w = getQueryVariable(url, 'type');
                //alert(selectedCountry);
                var params = {'type':''+selectedCountry+''};
                //alert(params);
                var pathname = window.location.pathname;
                var url = '<?php echo HTTP_SERVER;?>/dashboard/school-admin/school-inbox.php?' + jQuery.param(params);
                //url.replace(url.split('/')[5], 'edited');
                //url += '&type='+selectedCountry;


            }
            else
            {
                url += '&type='+selectedCountry;
            }
        }else{
            if (url.indexOf('type') > -1){
                url += '&type='+selectedCountry;

            }
            else
            {
                url += '?type='+selectedCountry;
            }
        }
        var qs = new String(window.location);

        window.location.href = url;
    });
</script>
<!--FOR SHOW IMAGE NAME ON UPLOAD-->
<script>
    $(document).ready(function(){
        $('#upload-file').change(function(){
            var fileName = $('#upload-file').val();
            var final = fileName.substring(fileName.lastIndexOf("\\") + 1, fileName.length);
            $('#file-name').html(final);
        });
        $('#upload-file-1').change(function(){
            var fileName = $('#upload-file-1').val();
            var final = fileName.substring(fileName.lastIndexOf("\\") + 1, fileName.length);
            $('#file-name-1').html(final);
        });
        $('#contact-file').change(function(){
            var fileName = $('#contact-file').val();
            var final = fileName.substring(fileName.lastIndexOf("\\") + 1, fileName.length);
            $('#contact-name').html(final);
        });
    });

</script>

<script type="text/javascript">
    $(".to_role").change(function(e) {
        var action='mymsgs';
        var session = '<?php echo $_SESSION['USER']['DB_NAME'];?>';
        var id = '<?php echo $_SESSION['USER']['USER_ID'];?>';
        var role = '<?php echo $_SESSION['USER']['ROLE_ID'];?>';
        var selectedCountry = $(".to_role option:selected").val();
        var dataString = 'seelectedoption='+selectedCountry+'&session='+session+'&role='+role+'&action='+action;
//alert(selectedCountry);
if(selectedCountry=='Teacher')
{
    $("#teacher_id").css("display", "block");
}
else
{
    $("#teacher_id").css("display", "none");
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
        var accodian_row = this;
        var dataString = 'data='+data+'&session='+session+'&role='+role+'&id='+id+'&action='+action;
//alert(dataString);
$.ajax({
    type:'POST',
    data:dataString,
    url:'../../ajax.php',
    success:function(data) {
                //alert(data);
                if(data != "1")
                {
                    return false;
                }
                $(accodian_row).find('.bold-text').removeClass('bold-text');
                $(this).nextAll('td').removeClass('bold-text');
            }

        });

});
</script>
</body>
</html>

