<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>Configuration | Master</title>
							<?php include '../includes/head.php'; ?>	
</head>
<body>
<div id="wrapper">
 <?php include '../includes/header-configuration.php'; ?>
 <?php include '../includes/sidebar-configuration.php'; ?>          
    
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
               <?php include '../includes/header-notice.php';?>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 my-box">
					<h1 class="full-panel">
                        <a href="javascript:void(0)" class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span class="fa fa-backward"></span> Back</a>
</h1>

                          <div class="row">
                             <div class="col-sm-4 col-xs-12">                               
                                   <div class="class-panel panel-embose">
                                        <div class="row make-gap">    
                                            <div class="overlay-box class-type">
                                                <div class="user-content text-center">
                                                    <a href="javascript:void(0);">
                                                        <img src="../images/icons/classtype.jpg" class="thumb-chairman-sc img-circle" alt="img"> </a>
                                                    <h4 class="text-white-1"><b>Class/Section Master</b></h4>
                                                </div>
                                            </div>
                                        </div>
                                   </div> 
                            </div><!--en col-->                             
                            
                           
                            <div class="col-sm-4 col-xs-12">
                                <div class="students-panel panel-embose manage-subject">
                                        <div class="row make-gap">    
                                            <div class="overlay-box fee-structure">
                                                <div class="user-content text-center">
                                                    <a href="javascript:void(0)" >
                                                        <img src="../images/icons/subject.png" class="thumb-chairman-sc" alt="img"> </a>
                                                    <h4 class="text-white-1"><b>Subject Master</b></h4>
                                                </div>
                                            </div>
                                        </div>
                                   </div>      
                            </div><!--en col-->
							
							 <div class="col-sm-4 col-xs-12">                       
                                   <div class="students-panel panel-embose staff-panel">
                                        <div class="row make-gap">    
                                            <div class="overlay-box fee-structure">
                                                <div class="user-content text-center">
                                                    <a href="javascript:void(0)" >
                                                        <img src="../images/icons/fees.png" class="thumb-chairman-sc img-circle" alt="img"> </a>
                                                    <h4 class="text-white-1"><b>Fee Structure Master</b></h4>
                                                </div>
                                            </div>
                                        </div>
                                   </div>                         
                            </div><!--en col-->
                              <div class="col-sm-4 col-xs-12">
                                  <a href="subject-allocation.php" >
                                      <div class="students-panel panel-embose manage-student">
                                          <div class="row make-gap">
                                              <div class="overlay-box">
                                                  <div class="user-content text-center">
                                                      <img src="../images/icons/admin.png" class="thumb-chairman-sc img-circle" alt="img">
                                                      <h4 class="text-white-1"><b>Subject Allocation</b></h4>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </a>
                              </div><!--en col-->
                        </div><!--en row-->
                    </div><!--col-en-->
                </div><!--en row-->
            </div>
        </div><!--en page-wrapper-->
 <?php include'../includes/footer.php'; ?>
</div><!--en wrapper-->
<?php include '../includes/foot.php'; ?>  
</body>
</html>

