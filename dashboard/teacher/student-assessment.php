<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Teacher | Student Assessment</title>
  <?php include '../includes/head.php'; ?>
  <!--attendance-->
  <script type="text/javascript" src="js/jquery.canvasjs.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
  <div id="wrapper">
    <!-- Navigation -->
    <?php
		if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Teacher')) {
			$user_id = $_SESSION['USER']['USER_NAME'];
			require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
			require_once('../../classes/assessment_class.php');
			$obj = new Assessment();
			$classsectiondata = $obj->findclasssectionofteacher($_SESSION['USER']['USER_ID']);
			$studentarr = $obj->getstu($classsectiondata[0]['class_id'],$classsectiondata[0]['section_id']);
			//print_r($studentarr);
			
		} else {
			echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
		}

?>
<!-- Left navbar-header -->
<?php include '../includes/header-configuration.php'; ?>
<?php include '../includes/sidebar-teacher.php'; ?>   
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
                        <li class="active">Assessment</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			

    <!--inbox st-->
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <div class="my-box">
          <div class="row">
            <div class="col-sm-9 col-xs-12">
              <h3>Assessment / Result</h3>
            </div>
            <div class="col-sm-3 col-xs-12">
              <form>
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" name="search" placeholder="Student Name" id="stuname" class="form-control input-sm" />
                    <a href="javascript:void(0)" class="input-group-addon"><span class="fa fa-search"></span></a>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="panel panel-default">    
                <div class="panel-body">
                  <!--student assessment st-->
                  <div class="table-responsive">
                    <table class="table table-bordered std-assessment">
                      <thead>
                        <tr>
                          <th><strong>#</strong></th>
                          <th><strong>Admission No.</strong></th>
                          <th><strong>Profile</strong></th>
                          <th><strong>Student Name</strong></th>
                          <th><strong>Grade</strong></th>
                          <th class="text-nowrap"><strong>Action</strong></th>
                        </tr>
                      </thead>
                      <tbody id="stutable">
					  <?php
					  $i=1;
					  foreach($studentarr as $stuarr)
					  {
						  if($stuarr['PIC']=='')
						  {
							$stuarr['PIC']='images.png';
						  }
					  ?>
                        <tr>
                          <td class="wd-table-col2"><?php echo $i;?></td>
                          <td class="wd-table-col-admission"><?php echo $stuarr['admission_no'];?></td>
                          <td class="wd-table-col-profile">
                           <div class="profile-pic">
                            <a href="student-profile.php?stu_id=<?php echo $stuarr['stu_id']; ?>"><img src="../../<?php echo $_SESSION['USER']['DB_NAME']; ?>/uploads/student/<?php echo  $stuarr['PIC']; ?>" class="img-circle img-responsive img-thumbnail img-padding" /></a> 
                          </div>

                        </td>
                        <td class="wd-table-col1"><?php echo $stuarr['STUNAME'];?></td>
                        <td class="wd-table-col1">A</td>
                        <td class="text-nowrap wd-table-col1">
                        <a href="student-assessment-edit.php?id=<?php echo $stuarr['stu_id']; ?>"" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                          <a href="view-assessment.php?id=<?php echo $stuarr['stu_id']; ?>"" data-toggle="tooltip" data-original-title="View"> <i class="fa fa-eye text-inverse"></i> </a> 
                        </td>
                      </tr>
					  <?php
					  $i++;
					  }
					  ?>

            </tbody>
          </table>
        </div>
        <!--student assessment en-->
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

<script>
$(document).ready(function(){
$("#stuname").keyup(function(){
var stuname=$("#stuname").val();
//alert(stuname);
$.ajax({
	url:'<?php echo HTTP_SERVER; ?>ajax_assessment.php?action=searchstudent',
	type :'POST',
	data: {
			stuname: stuname,
			session: '<?php echo $_SESSION['USER']['DB_NAME']; ?>',
			classdata: "<?php echo $classsectiondata[0]['class_id']; ?>",
			section: "<?php echo $classsectiondata[0]['section_id']; ?>",
			session: '<?php echo $_SESSION['USER']['DB_NAME']; ?>'
		  },
			success: function (data) {
					var json = $.parseJSON(data);
					$( "#stutable" ).empty();
					var count=1;
                    $.each(json, function(i, value) {
                     $('#stutable').append('<tr><td class="wd-table-col2">'+count+'</td><td class="wd-table-col-admission">'+value.admission_no+'</td><td class="wd-table-col-profile"><div class="profile-pic"><a href="student-profile.php?stu_id='+value.stu_id+'"><img src="../../<?php echo $_SESSION['USER']['DB_NAME']; ?>/uploads/student/'+value.PIC+'" class="img-circle img-responsive img-thumbnail img-padding" /></a></div> </td> <td class="wd-table-col1">'+value.STUNAME+'</td><td class="wd-table-col1">'+value.GRADE+'</td><td class="text-nowrap wd-table-col1"><a href="student-assessment-edit.php?id='+value.stu_id+'" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a><a href="view-assessment.php?id='+value.stu_id+'" data-toggle="tooltip" data-original-title="View"> <i class="fa fa-eye text-inverse"></i> </a></td></tr>');
					 count = count + 1
                 });

			}
			

});

});


});

</script>
<?php include'../includes/footer.php'; ?>
</div>
<!-- /#page-wrapper -->

<!-- /#wrapper -->


<?php include '../includes/foot.php'; ?>


<!--reply modal en-->    

</body>
</html>

