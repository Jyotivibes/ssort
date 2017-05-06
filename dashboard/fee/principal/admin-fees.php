<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management Solutions - SMS | Admin Fee</title>
    <?php include '../includes/headteacher.php'; ?>

 
</head>

<body>
  
    <div id="wrapper">
        <!-- Navigation -->
        <?php include'../includes/header-principal.php'; ?>
        <!--sidebar nav st-->
        <?php include '../includes/sidebar-principal.php'; ?>
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
                <div class="row bg-title">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting from 15 November 2016.</span></h4>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="../principal/principal.php">Principal</a>
                            </li>
                            <li class="active">Admin Fee</li>
                        </ol>
                    </div>
                </div>


                <div class="row">
					<div class="col-sm-12 col-xs-12 my-box">
						<div class="col-sm-2 col-xs-12">
                          <h5>NUR</h5>
						</div>
                        <div class="col-sm-2 col-xs-12">
                          2
						</div>
                        <div class="col-sm-2 col-xs-12">
                          3
						</div>
                        <div class="col-sm-2 col-xs-12">
                          4
						</div>
                        <div class="col-sm-2 col-xs-12">
                          5
						</div>
                        <div class="col-sm-2 col-xs-12">
                          6
						</div>
                        
					</div>
				</div>
                <!--col-en-->
            </div>
            <!--stu info en-->
            <!-- .right-sidebar st here-->
        </div>
        <!-- /.container-fluid -->
         <?php include'../includes/footer.php'; ?>
    </div>
    <!-- /#page-wrapper -->
   
    <!-- /#wrapper -->
    <?php include '../includes/footteacher.php'; ?>
  
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

</body>

</html>