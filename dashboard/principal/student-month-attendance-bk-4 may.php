<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | School Administration</title>
    <?php include '../includes/head.php'; ?>
</head>

<body>


<div id="loader" style="display:none;">
      <div id="status"></div>
   </div>

   
   
<div id="wrapper">
<?php
if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Principal')) {
    $user_id = $_SESSION['USER']['USER_NAME'];
    require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
    require_once('../../classes/general_class.php');
    $obj = new General();
    //echo '<script>window.location="http://localhost/sms/dashboard/teacher/teacher.php"</script>';
    $sql = mysql_query("SELECT *,'TOTAL_PRESENT' FROM essort_user_relation WHERE class_id = '".$_REQUEST['class']."' AND sec_id= '".$_REQUEST['section']."'");
    $attregister = array();
    while ($row = mysql_fetch_array($sql)) {
        $date = date('Y-m-d');
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $number = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
        $attregister[$row['stu_id']] = $row;
        $totalpresent = 0;
        for ($i = 1; $i <= $number; $i++) {
            $attdate = $year . "-" . $month . "-" . $i;
            $attdate = date('Y-m-d', strtotime($attdate));
            $status = $obj->getCurrentAttendenece($attdate, $row['att_ref_id']);
            if ($status == 'AB') {
                $tag = 'absent';
                $status = 'A';
            } else if ($status == 'PR') {
                $tag = 'present';
                $status = 'P';
                $totalpresent++;
            } else if ($status == 'LV') {
                $tag = 'cancel';
                $status = 'L';
            } else {


            }
            $attregister[$row['stu_id']][$i] = $status;
            $attregister[$row['stu_id']]['TOTAL_PRESENT'] = $totalpresent;
        }

        //print_r($attregister);
    }
    #####################################################
    $sqlstu = mysql_query("SELECT * FROM  essort_user_relation");
    $stuarr = array();
    while ($rowarr = mysql_fetch_array($sqlstu)) {
        $resstu = mysql_fetch_array(mysql_query("SELECT * FROM  essort_application_header WHERE usr_application_id='" . $rowarr['stu_id'] . "'"));
        $stuarr[$rowarr['stu_id']] = $resstu['usr_fname'];
    }
} else {
    echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
}
//$sql=mysql_query("SELECT * FROM essort_user_header WHERE usr_role='Principal' LIMIT 1");
//$row=mysql_fetch_array($sql);
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
                        <a href="<?php echo DASHBOARD_LINK;?>">School</a>
                    </li>
                    <li class="active">Full Attendance</li>
                </ol>
            </div>
        </div>


        <div class="row">

            <div class="col-sm-12">

                <div class="table-responsive my-box school-tb">
                    <div class="col-sm-4">
                        <select class="form-control attsession" id="attsession">

							<option value="2017-2018" <?php if(DEFAULT_SESSION=='2017-2018') echo 'selected'; ?>>2017-2018</option>
                            <option value="2016-2017" <?php if(DEFAULT_SESSION=='2016-2017') echo 'selected'; ?>>2016-2017</option>
                            <option value="2015-2016" <?php if(DEFAULT_SESSION=='2015-2016') echo 'selected'; ?>>2015-2016</option>
                            <option value="2014-2015" <?php if(DEFAULT_SESSION=='2014-2015') echo 'selected'; ?>>2014-2015</option>
                            <option value="2013-2014" <?php if(DEFAULT_SESSION=='2013-2014') echo 'selected'; ?>>2013-2014</option>
                            <option value="2012-2013" <?php if(DEFAULT_SESSION=='2012-2013') echo 'selected'; ?>>2012-2013</option>

                        </select>
                    </div>
                    <div class="col-sm-4"><select class="form-control attsession" id="attmonth">
                            <option value="1" <?php if($month=='1') echo 'selected'; ?>>January</option>
                            <option value="2" <?php if($month=='2') echo 'selected'; ?>>February</option>
                            <option value="3" <?php if($month=='3') echo 'selected'; ?>>March</option>
                            <option value="4"  <?php if($month=='4') echo 'selected'; ?>>April</option>
                            <option value="5"  <?php if($month=='5') echo 'selected'; ?>>May</option>
                            <option value="6"  <?php if($month=='6') echo 'selected'; ?>>June</option>
                            <option value="7"  <?php if($month=='7') echo 'selected'; ?>>July</option>
                            <option value="8"  <?php if($month=='8') echo 'selected'; ?>>August</option>
                            <option value="9"  <?php if($month=='9') echo 'selected'; ?>>September</option>
                            <option value="10"  <?php if($month=='10') echo 'selected'; ?>>October</option>
                            <option value="11"  <?php if($month=='11') echo 'selected'; ?>>November</option>
                            <option value="12"  <?php if($month=='12') echo 'selected'; ?>>December</option>
                        </select></div>

                    <div class="col-sm-4">
                        <form>
                            <div class="form-group">
                                <div class="input-group">
                                    <input placeholder="Student name" class="attsession form-control" type="text" id="stu_name">
                                    <a href="#" class="input-group-addon" data-toggle="modal" data-target="#eventModal">
                                        <span class="fa fa-search"></span>
                                    </a>
                                </div>
                            </div>
                            <!-- form-group -->
                        </form>
                    </div>
                    <table class="table table-bordered" id="attdata">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <!--<th>Emp ID</th>-->
                            <?php
                            for ($i = 1; $i <= $number; $i++) {
                                ?>
                                <th><?php echo $i;?></th>
                            <?php
                            }
                            ?>
                            <th>Total Present</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($attregister as $key => $attvlue) {
                            ?>
                            <tr>
                                <td><?php echo $stuarr[$key];?></td>
                                <!--<td>1001</td>-->
                                <?php
                                for ($i = 1; $i <= $number; $i++) {
                                    if ($attvlue[$i] == 'A') {
                                        $tag = 'warning';
                                    } else if ($attvlue[$i] == 'P') {
                                        $tag = '';
                                    } else if ($attvlue[$i] == 'L') {
                                        $tag = 'info';
                                    } else if ($attvlue[$i] == 'S') {
                                        $tag = 'danger';
                                    } else if ($attvlue[$i] == 'H') {
                                        $tag = 'danger';
                                    }
                                    ?>
                                    <td class="<?php echo $tag; ?>"><?php echo $attvlue[$i];?></td>
                                <?php
                                }
                                ?>
                                <td><?php echo $attvlue['TOTAL_PRESENT']; ?></td>


                            </tr>
                        <?php
                        }
                        ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
<?php include'../includes/footer.php'; ?>
</div>


<?php include '../includes/foot.php'; ?>
<script>
    $(".attsession").bind("keyup change", function () {
        var action = 'searchsturegister';
        var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>';
        var attmonth = $("#attmonth").val();
        var attsession = $("#attsession").val();
        var classdata = '<?php echo $_REQUEST['class'];?>';
        var secdata = '<?php echo $_REQUEST['section'];?>';
        var stuname = $("#stu_name").val();
        var dataString = 'attsession=' + attsession + '&stuname=' + stuname + '&session=' + session + '&attmonth=' + attmonth + '&classdata=' + classdata + '&secdata=' + secdata + '&action=' + action;
		
//alert(dataString);
     $.ajax({ 
            type: 'POST',
            data: dataString,
            url: '../../ajax.php',
			//beforeSend: function() {
             // $("#loader").show();
           //},
		   success: function (data) {
			//alert(data);
				 if (data != "") {
                    //window.location.reload();
                    if (data == 1) {
                        alert("Required Parameter Missing");
                        $("#preloader").css("display", "none");
                        return false;
                    }
                    else if (data == 4) {
                        alert("Session Expired......Try Again.....");
                        window.location.reload();
                    }
                    else {
                         $("#attdata").html(data);
						 // $("#loader").hide();
						  
                    }
                }
            }

        });
    });
    //##############################################################################################
</script>
<script>
    $(document).ready(function () {
        $('#attdata').DataTable({
            paging: false,
            ordering: false,
            searching: false,
            info: false,

//            select: false,
//            select: {
//                info: false
//            }
            dom: 'frtipB',
//            dom: 'B<"clear">lfrtip',
            buttons: {
                buttons: [
                    { extend: 'excel', className: 'btn btn-default', text: 'Download As Excel'},
                    { extend: 'pdfHtml5', orientation: 'landscape',
                        pageSize: 'LEGAL', className: 'btn btn-default', text: 'Download As PDF' }

                ]

            }
//            buttons: [
//                'excel', 'pdf'
//            ]
        });
    });
</script>

</body>

</html>