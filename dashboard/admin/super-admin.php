<?php
@session_start();
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='admin') )
	{ 	
		$user_id=$_SESSION['USER']['USER_NAME'];
	   //ssecho '<script>window.location="http://localhost/ssort/dashboard/admin/super-admin.php"</script>';	
	}
	else
	{
		echo "<script>window.location='http://localhost/ssort/admin/';</script>";
	
	}
include ('../../classes/group_class.php');
$obj=new GROUP();
$sql=mysql_query("SELECT * FROM essort_school_info");	
$num_of_rows=mysql_num_rows($sql);
$sqlgrp=mysql_query("SELECT * FROM essort_group");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | Super Admin</title>
    <?php include '../includes/headadmin.php'; ?>
</head>

<body> 
    <div id="wrapper">
         <?php include '../includes/header-superadmin.php'; ?>
        <!--sidebar nav st-->
        <?php include '../includes/sidebar-admin.php'; ?>
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
                        <h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting form 15 November 2016.</span></h4>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="../admin/super-admin.php">Admin</a>
                            </li>
                            <li class="active">Admin</li>
                        </ol>
                    </div>
                </div>


                <div class="row">
                     <div class="col-sm-12 col-xs-12 my-box">
                    
                         <div class="col-sm-4 new-gd">
                                <div class="new-block clr-block-1">
                                    <div class="col-md-8 new-left new_super">
                                        <h3><?php echo $num_of_rows;?></h3>
                                        <h4>Total Number of Schools</h4>
                                    </div>
                                    <div class="col-md-4 new-right">
                                            <img src="../images/school.png" class="img-responsive" alt="img"> </a>
                                    </div>
                                  <div class="clearfix"> </div>
                                </div>
			             </div>
                          <div class="col-sm-4 new-gd">
                                <div class="new-block clr-block-2">
                                    <div class="col-md-8 new-left new_super">
                                        <h3>123400</h3>
                                        <h4>Total Number of Students</h4>
                                        
                                    </div>
                                    <div class="col-md-4 new-right">
                                         <img src="../images/staff.png" class="img-responsive" alt="img">
                                    </div>
                                  <div class="clearfix"> </div>
                                </div>
			             </div>
                          <div class="col-sm-4 new-gd">
                                <div class="new-block clr-block-3 ">
                                    <div class="col-md-8 new-left new_super">
                                        <h3>450</h3>
                                        <h4>Total Number of Staff</h4>
                                        
                                    </div>
                                    <div class="col-md-4 new-right">
                                        <img src="../images/staff-new.png" class="img-responsive" alt="img"> </a>
                                    </div>
                                  <div class="clearfix"> </div>
                                </div>
			             </div>
               

                <div class="row">
                     <div class="col-sm-12 col-xs-12 new-gap">

                           <div class="profile-panel_one33">
                        
                                <div class="row make-gap2">    
                                    <div class="overlay-box superadmin">
                                        <div class="user-content text-center">
                                           
                                          <a href="../admin/create-group.php"><h4 class="text-white-1" ><i class="fa fa-plus" aria-hidden="true"></i> Add New Group</h4></a>
                                        </div>
                                    </div>
                                  
                                        
                                </div>
                         
                        </div>
                    </div>
               </div>

                    <!--en col-->
<!--Group-->
               <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <h4><b class="newcl">List of Registered Educational Groups</b></h4>
                    </div>
                        <div class="col-sm-6 col-xs-12 mar-e">
                            <form class="navbar-form" role="search">
                                <div class="input-group pull-right">
                                    <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                                    <div class="input-group-btn">
                                        <button class="btn btn-info" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                    </div>
                                </div>
                            </form>

                        </div>
                </div>

                    <div class="row">             
					<?php
					while($sqlrst=mysql_fetch_array($sqlgrp))
					{
				    ?>
                      <div class="col-sm-2 col-xs-12 ">                    
                           <div class="profile-panel_one4">                         
                                <div class="row make-gap2"> 
                                   <a href="group.php?id=<?php echo $sqlrst['grp_id'];?>">   
                                    <div class="overlay-box">
                                        <div class="user-content text-center">                                            
                                                <img src="../images/clients.png" class="thumb-chairman-sm img-responsive" alt="img">
                                                <h4 class="text-white-1"><?php echo $sqlrst['grp_name'];?></h4>                                            
                                        </div>
                                    </div>
                                    </a>
                                </div>
                        </div>
                    </div>
					<?php
					}
					?>
                    <!--<div class="col-sm-2 col-xs-12 ">                     
                           <div class="profile-panel_one4">                         
                                <div class="row make-gap2">  
                                   <a href="group.php">  
                                    <div class="overlay-box">
                                        <div class="user-content text-center">
                                                <img src="../images/clients.png" class="thumb-chairman-sm img-responsive" alt="img">
                                            <h4 class="text-white-1">Demo Metropolitan</h4>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                        </div>
                    </div>
                                                  
                         

                     <div class="col-sm-2 col-xs-12 ">
                           <div class="profile-panel_one4">
                                <div class="row make-gap2">   
                                   <a href="group.php"> 
                                    <div class="overlay-box">
                                        <div class="user-content text-center">                                            
                                                <img src="../images/clients.png" class="thumb-chairman-sm img-responsive" alt="img">
                                            <h4 class="text-white-1">Demo NNGS</h4>
                                        </div>
                                    </div>
                                    </a>
                           </div> 
                        </div>
                    </div>
                     <div class="col-sm-2 col-xs-12 ">
                    
                           <div class="profile-panel_one4">
                                <div class="row make-gap2">
                                   <a href="javascript:void(0)">    
                                    <div class="overlay-box ">
                                        <div class="user-content text-center">
                                            
                                                <img src="../images/clients.png" class="thumb-chairman-sm img-responsive" alt="img">
                                            <h4 class="text-white-1">Demo JICK</h4>
                                        </div>
                                    </div>
                                    </a>
                                        
                                </div>
                          
                        </div>
                    </div>
                     <div class="col-sm-2 col-xs-12 ">                     
                           <div class="profile-panel_one4">                         
                                <div class="row make-gap22">    
                                   <a href="javascript:void(0)">
                                        <div class="overlay-box ">
                                            <div class="user-content text-center">                                            
                                                    <img src="../images/clients.png" class="thumb-chairman-sm img-responsive" alt="img">
                                                <h4 class="text-white-1">Demo GPM</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                         
                        </div>
                    </div>
                    
                    
                     <div class="col-sm-2 col-xs-12 ">
                           <div class="profile-panel_one4">
                                <div class="row make-gap2">  
                                    <a href="javascript:void(0)">  
                                    <div class="overlay-box ">
                                        <div class="user-content text-center">
                                           
                                                <img src="../images/clients.png" class="thumb-chairman-sm img-responsive" alt="img">
                                            <h4 class="text-white-1">Demo VNSNK</h4>
                                        </div>
                                    </div>
                                  </a>  
                                </div>
                        
                        </div>
                    </div>
                    </div>
                        <div class="row">
                         
                          <div class="col-sm-2 col-xs-12 ">
                       
                           <div class="profile-panel_one4">
                         
                                <div class="row make-gap2">   
                                   <a href="javascript:void(0)"> 
                                    <div class="overlay-box">
                                        <div class="user-content text-center">
                                            
                                                <img src="../images/clients.png" class="thumb-chairman-sm img-responsive" alt="img">
                                            <h4 class="text-white-1">Demo CPS</h4>
                                        </div>
                                    </div>
                                  </a>
                                        
                                </div>
                        
                        </div>
                    </div>
                
                         
                          <div class="col-sm-2 col-xs-12 ">
                       
                           <div class="profile-panel_one4">
                         
                                <div class="row make-gap2">    
                                   <a href="javascript:void(0)">
                                    <div class="overlay-box">
                                        <div class="user-content text-center">                                            
                                                <img src="../images/clients.png" class="thumb-chairman-sm img-responsive" alt="img">
                                            <h4 class="text-white-1">Demo NCPSK</h4>
                                        </div>
                                    </div>
                                  </a>
                                        
                                </div>
                        
                        </div>
                    </div>
                          <div class="col-sm-2 col-xs-12 ">
                       
                           <div class="profile-panel_one4">
                         
                                <div class="row make-gap2">  
                                   <a href="javascript:void(0)">  
                                    <div class="overlay-box">
                                        <div class="user-content text-center">
                                            
                                                <img src="../images/clients.png" class="thumb-chairman-sm img-responsive" alt="img">
                                            <h4 class="text-white-1">Demo NSGT</h4>
                                        </div>
                                    </div>
                                  </a>
                                        
                                </div>
                        
                        </div>
                    </div>
                          <div class="col-sm-2 col-xs-12 ">
                       
                           <div class="profile-panel_one4">
                         
                                <div class="row make-gap2">
                                   <a href="javascript:void(0)">    
                                    <div class="overlay-box">
                                        <div class="user-content text-center">
                                            
                                                <img src="../images/clients.png" class="thumb-chairman-sm img-responsive" alt="img">
                                            <h4 class="text-white-1">Demo CDNTM</h4>
                                        </div>
                                    </div>
                                  </a>
                                        
                                </div>
                        
                        </div>
                    </div>
                          <div class="col-sm-2 col-xs-12 ">
                       
                           <div class="profile-panel_one4">
                         
                                <div class="row make-gap2">    
                                   <a href="javascript:void(0)">
                                    <div class="overlay-box">
                                        <div class="user-content text-center">                                            
                                                <img src="../images/clients.png" class="thumb-chairman-sm img-responsive" alt="img">
                                            <h4 class="text-white-1">Demo HITM</h4>
                                        </div>
                                    </div>
                                  </a>
                                        
                                </div>
                        
                              </div>
                    </div>
                          <div class="col-sm-2 col-xs-12 ">
                       
                           <div class="profile-panel_one4">
                         
                                <div class="row make-gap2">  
                                   <a href="javascript:void(0)">  
                                    <div class="overlay-box">
                                        <div class="user-content text-center">
                                            
                                                <img src="../images/clients.png" class="thumb-chairman-sm img-responsive" alt="img">
                                            <h4 class="text-white-1">Demo DDUG</h4>
                                        </div>
                                    </div>
                                  </a>
                                        
                                </div>
                        
                        </div>
                         </div>
                </div>-->
                          
                         <div class="col-sm-12">
                                <div class="text-center">
                                    <ul class="pagination pagination-small">
                                        <li class="disabled"><span>«</span></li>
                                        <li class="active"><span>1</span></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">6</a></li>
                                        <li><a href="#">7</a></li>
                                        <li><a href="#">8</a></li>
                                        <li><a href="#">9</a></li>
                                        <li><a href="#">10</a></li>
                                        <li><a href="#" rel="next">»</a></li>
                                    </ul>
                               </div>
                         </div>
				</div>
            </div> 
            </div>
        </div>
        <?php include'../includes/footer.php'; ?>
    </div>
    <?php include '../includes/footadmin.php'; ?>

   
   
</body>

</html>