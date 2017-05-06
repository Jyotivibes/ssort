<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="description" content="">
					<meta name="author" content="">
						<meta name="viewport" content="width=device-width, initial-scale=1">
							<title>School Management System - SMS | Add/View Designation</title>
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
                <div class="row bg-title">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting from 15 November 2016.</span></h4>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <ol class="breadcrumb bread-change">
                            <li>
                                <a href="javascript:void(0)">Configuration</a>
                            </li>
                            <li class="active">Designation Master</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div><!--en row-->

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 my-box">
                       <h4 class="h4">Add/View Designation</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <a href="#" data-toggle="modal" data-target="#addNewClass" class="btn btn-info pull-right"><span class="fa fa-plus"></span> Add New Designation</a>
                            </div>
                        </div>
                        <div class="row">
                         <div class="col-sm-12 col-xs-12">
                             <div class="table-responsive">
                                  <table class="table addclass" border="1">
                                    <thead>
                                      <tr>
                                        <th>Sl. No.</th>
                                        <th>Staff Type</th>
                                        <th>Designation</th>
                                        <th>Action</th>                                
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>1</td>
                                        <td>Teacher</td>
                                        <td>Teacher</td>
                                        <td>
                                            <a href="#" data-toggle="tooltip" data-original-title="Edit" ><span class="fa fa-pencil text-inverse m-r-10"></span></a>
                                            <a href="#" data-toggle="tooltip" data-original-title="Disable"><span class="fa fa fa-eye-slash text-inverse"></span></a>
                                        </td>                                
                                      </tr>
                                      <tr>
                                        <td>2</td>
                                        <td>Principal</td>
                                        <td>Principal</td>
                                        <td>
                                            <a href="#" data-toggle="tooltip" data-original-title="Edit" ><span class="fa fa-pencil text-inverse m-r-10"></span></a>
                                            <a href="#" data-toggle="tooltip" data-original-title="Disable"><span class="fa fa fa-eye-slash text-inverse"></span></a>
                                        </td>                                
                                      </tr>
                                      <tr>
                                        <td>3</td>
                                        <td>Non Teacher</td>
                                        <td>Accountant</td>
                                        <td>
                                            <a href="#" data-toggle="tooltip" data-original-title="Edit" ><span class="fa fa-pencil text-inverse m-r-10"></span></a>
                                            <a href="#" data-toggle="tooltip" data-original-title="Disable"><span class="fa fa fa-eye-slash text-inverse"></span></a>
                                        </td>                                
                                      </tr>
                                      <tr>
                                        <td>4</td>
                                        <td>Teacher</td>
                                        <td>Principal</td>
                                        <td>
                                            <a href="#" data-toggle="tooltip" data-original-title="Edit" ><span class="fa fa-pencil text-inverse m-r-10"></span></a>
                                            <a href="#" data-toggle="tooltip" data-original-title="Disable"><span class="fa fa fa-eye-slash text-inverse"></span></a>
                                        </td>                                
                                      </tr>
                                      <tr>
                                        <td>5</td>
                                        <td>Non Teacher</td>
                                        <td>Accountant</td>
                                        <td>
                                            <a href="#" data-toggle="tooltip" data-original-title="Edit" ><span class="fa fa-pencil text-inverse m-r-10"></span></a>
                                            <a href="#" data-toggle="tooltip" data-original-title="Disable"><span class="fa fa fa-eye-slash text-inverse"></span></a>
                                        </td>                                
                                      </tr>                             
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
<!--add new class st -->
<div class="modal fade" id="addNewClass" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
       <form>
        <div class="modal-header-1">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Designation</h4>
        </div>
        <div class="modal-body">     
           <div class="table-responsive">
              <table class="table addClassTable">
                <thead>
                  <tr>
                    <th>Staff Type</th>
                    <th>Designation</th>                                        
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select class="form-control input-sm">
                                <option>Teacher</option>
                                <option>Principal</option>
                                <option>Non-Teacher</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control input-sm" name="txtDesignation" placeholder="Enter Designation" /></td>
                    </tr>                    
                </tbody>
              </table>               
            </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-sm-12 col-xs-12 pull-right text-center">
                <button type="button" class="btn btn-default btn-color border-round"><i class="fa fa-plus"></i> Add Designation</button>
                <button type="button" class="btn btn-warning btn-color border-round"><i class="fa fa-times-circle"></i> Cancel</button>
            </div>        
          </div>
        </div>  
      </form>
      </div>
      
    </div>
  </div>    
<!--add new class en-->
</body>
</html>

