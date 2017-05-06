
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Notice & Circular</title>
    <?php include '../includes/head.php'; ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>    
    <div id="wrapper">
	<?php
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Principal') )
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
		require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
		require_once('../../classes/general_class.php');
		$obj = new General();
		include_once 'stastics.php';
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
                        <h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting from 15 November 2016.</span></h4>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="javascript:void(0);">Principal</a>
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
                                <form class="form-default pull-right">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input placeholder="Search circular" class="form-control input-sm" type="text">
                                            <a href="#" class="input-group-addon">
                                                <span class="fa fa-search"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- form-group -->
                                </form>
                            </h3>
                            <div class="m-t-20">
                                <!--table st-->
                                <div class="table-responsive color-table info-table overflow_remove">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Subject</th>
                                                <th>Notice/Circular</th>
                                                <th>See more</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        while($row = mysql_fetch_array($sqlnote)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row['date']; ?></td>
                                                <td><?php echo $row['subject']; ?></td>
                                                <td><?php
                                                    $split = $row['message'];
                                                    echo $str = strlen($split) > 30 ? substr($split,0,30).". . ." : $split;
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="view_noticecircular.php?noticeId=<?php echo $row['id']; ?>">
                                                         <a data-toggle="modal" class="getdata" data-href="<?php echo $row['attachment']; ?>" data-subject="<?php echo $row['subject'];?>" data-id="<?php echo $row['message'];?>"><i class="fa fa-eye"></i></a>
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

    <!-- /#wrapper -->
    <?php include '../includes/foot.php'; ?>
	<script>
			$(".getdata").click(function() {
			 var dra=$(this).attr("data-id"); 
			 var subject=$(this).attr("data-subject"); 
			 var href=$(this).attr("data-href"); 
			 $("#target").css("display", "block");
			 if(href=='')
			 {
				$("#target").css("display", "none");
			 }
             $("#success_message").html(dra);			 
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
            <div class="modal-header-1" id="subject_message">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Did this Notice & Circulars is relevent</h4>
            </div>
            <div class="modal-body" id="success_message">
                <p class="text-justify"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
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
    <!--Style Switcher -->
    <!--<script src="js/jQuery.style.switcher.js"></script>-->
</body>

</html>