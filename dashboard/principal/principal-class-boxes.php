<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | Chairman - Individual School </title>
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
		//ALL CLASSES
		$sqlclass= mysql_query("SELECT * FROM  essort_classes");
		$class=array();
		while($rowclass=mysql_fetch_array($sqlclass))
		{
			$class[$rowclass['class_id']]=$rowclass['class_name'];
		}
		$sql = mysql_query("SELECT *,'class_name' FROM  essort_section");
		$classarr=array();
		while($row=mysql_fetch_array($sql))
		{
			$row['class_name']=$class[$row['class_id']];
			$classarr[]=$row;
		
		}
		//print_r($classarr);
		
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
              <?php include_once '../includes/header-notice.php';?>

                <!--notice circular row st-->
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="my-box">
                            <section class="m-t-40">
                                <!--fee structure st-->
                                    <h2 class="text-left"><?php echo $sch_name;?> - <?php echo $sch_location;?></h2>
                                    <div class="row make-gap">    
									<?php
									foreach($classarr as $classvlue)
									{
									?>
                                        <div class="col-sm-2 col-xs-12 part box-effect side-gap">
                                            <a href="class-fees-structure.php?class_id=<?php echo $classvlue['class_id'];?>&sec_id=<?php echo $classvlue['section_id']?>" class="class-link">
                                              <img src="../images/icons/class.png" class="img-responsive img-circle img-school" />
                                              <h5 class="text-center head-new">
                                                    <div class="c_school_cambridge"></div><?php echo $classvlue['class_name']."-".$classvlue['section_name']; ?></h5>
                                            </a>
                                        </div>
									<?php
									}
									?>
                                    </div><!--end row-->
                                    
                                    
                                <!--fee structure en-->
                            </section>
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
    <!--Style Switcher -->
    <!--<script src="js/jQuery.style.switcher.js"></script>-->
</body>

</html>