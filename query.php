<?php
        require_once('connection.php');
		require_once('general_class.php');
		require_once('config.php');
		$obj = new General();
		$sql=mysql_query("SELECT * FROM essort_contact_info");

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
 
</head>

<body> 
    <div id="wrapper">
        
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
                       
                    </div>
                    
                </div>


                <div class="row">
                     <div class="col-sm-12 col-xs-12 my-box">
                         <div class="table-responsive">
							<table class="table table-bordered">

							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Subject</th>
								<th>Message</th>
							</tr>
<?php
while($row=mysql_fetch_array($sql))
{
?>
							<tr>
								<td><?php echo $row['name'] ?></td>
								<td><?php echo $row['email'] ?></td>
								<td><?php echo $row['subject'] ?></td>
								<td><?php echo $row['message'] ?></td>
							</tr>
<?php
}
?>
							</table>
						 </div>
					</div><!--en col-->
            </div> 
            </div>
        </div>
      
    </div>
    

   
   
</body>

</html>