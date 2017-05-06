<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | School Students</title>
    <?php include '../includes/head.php'; ?>


</head>
<body>

    <div id="wrapper">
        <?php
        if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'SAD')) {
            $user_id = $_SESSION['USER']['USER_NAME'];
            require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
            require_once('../../classes/general_class.php');
            $obj = new General();
            include_once 'stastics.php';
            $formErr='';
            if(isset($_REQUEST['EditA']))
            {
             $res = $obj->EDITATT();

             if($res == 2){
                $formErr='Required parameter missing';
            }
            else if($res == 0){
                $formErr='Problem in network.Please try again.';

            }
            else if($res == 1){
                $formErr='Edit Attendance successfully';
                $reurl='school-students.php';
            }
        }


        $date = date('Y-m-d');
        $month = date('F', strtotime($date));

        $montharr = array("April", "May", "June");
        $monthsecarr = array("July", "August", "September");
        $monththirdcarr = array("October", "November", "December");
        $monthfourthcarr = array("January", "February", "March");
        if (in_array($month, $montharr)) {
            $type = 'first';
        } elseif (in_array($month, $monthsecarr)) {
            $type = 'second';

        } elseif (in_array($month, $monththirdcarr)) {
            $type = 'third';

        } else {
            $type = 'fourth';

        }
        $staffarray=array();
        $stufeesql=mysql_query("SELECT stu_id FROM essort_user_relation") or die(mysql_error());
        while($rowstff=mysql_fetch_array($stufeesql))
        {
           $staffarray[]=$rowstff['stu_id'];
       }

       $id=implode(",",$staffarray);

       $feerecievedsql=mysql_query("SELECT * FROM essort_fee_transaction
        WHERE user_id IN (".$id.") AND fee_quarter='".$type."'");
       $feerecieved=mysql_num_rows($feerecievedsql);
       $feepending=$num_of_students-$feerecieved;


   } else {
    echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
}
?>
<!-- Navigation -->
<?php include'../includes/header-configuration.php'; ?>
<!--sidebar nav st-->
<?php include '../includes/sidebar-school.php'; ?>
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
      <?php include_once("../includes/header-notice.php"); ?>

      <!--notice circular row st-->
      <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="my-box">

                <section class="m-t-40">
                    <!--tab st-->
                    <div class="sttabs-1 sttabs tabs-style-flip-1">
                        <nav>
                            <ul>
                                <li class="tab-current tab-current-1"><a href="#student"><strong>Students Attendance</strong></a></li>
                                <li><a href="#staff"><strong> Students Fee</strong></a></li>

                            </ul>
                        </nav>
                        <div class="content-wrap">

                            <section id="#student" class="content-current">

                                <div class="row">
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="col-sm-12 col-xs-12">
                                            <!--latest circular st-->
                                            <div class="mar-top clearfix">
                                               <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                  <select class="form-control elementnme" id="class1" onchange="showSubType(this.value,this.id);">
                                                     <option>Select Class</option>
                                                     <?php echo $class;?>
                                                 </select>
                                             </div>
                                         </div> -->
                                         <!-- <div class="col-md-6 col-sm-6 col-xs-12" id="section">
                                            <div class="form-group">
                                              <select class="form-control elementnme" id="section1">
                                                  <option value="<?php echo $sqlsection['section_id'];?>"> <?php echo $sqlsection['section_name'];?></option>
                                              </select>
                                          </div>
                                      </div> -->

                                  </div>
                              </div>
                              <div class="my-box comment-center">
                                <div class="c_teach_att_search clearfix">
                                 <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                       <select class="form-control elementnme" id="class1" onchange="showSubType(this.value,this.id);">
                                           <option>Select Class</option>
                                           <?php echo $class;?>
                                       </select>
                                   </div>
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                 <select class="form-control elementnme" id="section1">
                                  <option value="<?php echo $sqlsection['section_id'];?>"> <?php echo $sqlsection['section_name'];?></option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="">
                            <div class="input-group date elementnme" data-provide="datepicker">
                                <input type="text" class="form-control" id="date" value="<?php echo date('m/d/Y');?>">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="">
                            <div class="input-group">
                                <input type="search" class="form-control elementnme" id="elementnme" placeholder="Search by Name or Admission Number">

                                <div class="input-group-addon" id="glycerin">
                                    <span class="glyphicon glyphicon-search glycerin" id="targetresult"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive new_tbl_height_two2">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-bg1">
                                <th>S No.</th>
                                <th>Name</th>
                                <th>Profile</th>
                                <th>Admission No.</th>
                                <th>Status</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                                <th>Edit</th>

                            </tr>
                        </thead>
                        <tbody class="c_teach_tabel" id="Table">
                            <?php
                            $i=1;
                            foreach ($stuidarr as $stuvar) {
                                if($stuvar['usr_pic']=='')
                                {
                                    $stuvar['usr_pic']='images.png';
                                }
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i;?></td>
                                    <td><?php echo $stuvar['USERFNAME'];?></td>
                                    <td><a href="student-profile.php?stu_id=<?php echo $stuvar['stu_id']; ?>"><img src="../../<?php echo $_SESSION['USER']['DB_NAME'];?>/uploads/student/<?php echo $stuvar['usr_pic']; ?>"></a></td>
                                    <td><?php echo $stuvar['app_no']?></td>
                                    <td><?php if($stuvar['att_status']!='') {echo $stuvar['att_status'];} else {
                                       echo '-';
                                   }?></td>

                                   <td><?php if($stuvar['att_intime']!='') {echo $stuvar['att_intime'];} else {
                                       echo '-';
                                   }?></td>
                                   <td><?php if($stuvar['att_outtime']!='') {echo $stuvar['att_outtime'];} else {
                                       echo '-';
                                   }?></td>
                                   <td class="text-center">
                                       <?php if($stuvar['att_ref_id']!=''){echo '<a href="#"  class="editattend"  data-id="'.$stuvar['att_id'].'" data-user="'.$stuvar['att_ref_id'].'" data-in="'.$stuvar['att_intime'].'" data-out="'.$stuvar['att_outtime'].'" >
                                       <i class="fa fa-pencil-square font-icon-size" aria-hidden="true"></i>
                                   </a>';}?>

                               </td>
                           </tr>
                           <?php
                           $i++;
                       }
                       ?>
                   </tbody>
               </table>
           </div>
       </div>
       <a href="student-month-attendance.php?class=<?php echo DEFAULT_CLASS; ?>&section=<?php echo $sqlsection['section_id'];?>" id="fullmonth"><button type="button" class="pull-right btn btn-info">View Full Month Attendance</button></a>
       <!--progress en-->
   </div>
   <!--col-en-->
   <div class="col-md-4 col-sm-4 col-xs-12">
    <!--latest circular st-->
    <div class="my-box clearfix">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <select class="form-control selattside" id="seldata">
                    <option value="">Select</option>
                    <?php
                    foreach ($stuidarr as $stuvar) {
                        ?>
                        <option
                        value="<?php echo $stuvar['att_ref_id']; ?>" <?php if ($stuvar['att_ref_id'] == DEFAULT_STU) echo 'selected';?>><?php echo $stuvar['USERFNAME'];?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <select class="form-control selattside" id="salyear">
                    <option value="2016-2017" <?php if (DEFAULT_SESSION == '2016-2017') echo 'selected'; ?>>2016-2017</option>
                    <option value="2017-2018" <?php if (DEFAULT_SESSION == '2017-2018') echo 'selected'; ?>>2017-2018</option>
                </select>
            </div>
        </div>
        <div id="chartdiv"></div>
        <script>
            $(function () {
                var chart = AmCharts.makeChart("chartdiv", {
                    "labelRadius": -40,
                    "labelText": "[[status]]: [[percents]]%",
                    "type": "pie",
                    "theme": "light",
                    "dataProvider": [
                    {
                        "status": "Present",
                        "value": (<?php echo $sqlclasssectionstu; ?>+0)
                    },
                    {
                        "status": "Absent",
                        "value": (<?php echo $sqlclasssectionstuab; ?>+0)
                    }
                    ],
                    "valueField": "value",
                    "titleField": "status",
                    "outlineAlpha": 0.4,
                    "depth3D": 25,
                    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                    "angle": 40,
                    "export": {
                        "enabled": true
                    }

                });
            });
        </script>

        <div>
            <table class="table table-bordered">
                <thead>
                    <tr class="table-bg1">
                        <th>Month</th>
                        <th>No of Days</th>
                        <th>Days Present</th>
                        <th>Days Absent</th>
                    </tr>
                </thead>
                <tbody class="c_teach_tabel" id="SideTable">
                    <?php
                    Foreach ($rowstutble as $rowstuvalue) {
                        $monthNum = $rowstuvalue['m'];
                        $dateObj = DateTime::createFromFormat('!m', $monthNum);
                            $monthName = $dateObj->format('F'); // March
                            ?>
                            <tr>
                                <td><?php echo $monthName;?></td>
                                <td><?php echo $rowstuvalue['TOTAL'];?></td>
                                <td><?php echo $rowstuvalue['PRESENT'];?></td>
                                <td><?php echo $rowstuvalue['ABSENT'];?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <a href="attendance-student.php?id=<?php echo DEFAULT_STU; ?>" id="viewdetail"
                     class="btn btn-link pull-right v-detail"><span class="fa fa-eye"></span> View Detail</a><!---->
                 </div>
             </div>

         </div>
     </div>

     <!--latest circular en-->
 </div>

</section>

<!--Second  tabs start-->

<section id="#staff" class="">
    <div class="row">
        <div class="col-sm-offset-9 col-sm-3 pull-left">
            <select class="form-control" id="sel1">
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>April</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>August</option>
                <option>September</option>
                <option>October</option>
                <option>November</option>
                <option>December</option>
            </select>
        </div>
        <div class="col-sm-12 col-xs-12 mar-top my-box">


            <div class="col-sm-4 col-xs-12">
                <div class="panel message-center panel-embose bg-color-box user-img tot-staff-bg">
                    <div class="content">
                        <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">

                        <div>
                            <span>Total Students</span>

                            <h1 class="my-white"><?php echo $num_of_students;?></h1>
                        </div>
                    </div>
                </div>
                <!--en panel-->
            </div>
            <!--en col-->
            <div class="col-sm-4 col-xs-12">
                <div class="panel message-center panel-embose bg-color-box staffp-bg">
                    <div class="content">
                        <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">

                        <div>
                            <span>Students Fee Received</span>

                            <h1 class="my-white"><?php echo $feerecieved;?></h1>
                        </div>
                    </div>
                </div>
                <!--en panel-->
            </div>
            <!--en col-->
            <div class="col-sm-4 col-xs-12">
                <div class="panel message-center panel-embose bg-color-box staffa-bg">
                    <div class="content">
                        <img src="../images/eduaction.png" alt="user" class="new_img_with img-circle">

                        <div>
                            <span>Students Fee Pending</span>

                            <h1 class="my-white"><?php echo $feepending;?></h1>
                        </div>
                    </div>
                </div>
                <!--en panel-->
            </div>
            <!--en col-->

            <!--latest circular st-->
            <div class="clearfix">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <h5>Select Class</h5>
                        <select class="form-control" id="class2" onchange="showSubType(this.value,this.id);">
                          <option value="">Select</option>
                          <?php echo $class;?>
                      </select>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <h5>Select Section</h5>
                    <select class="form-control" id="section2">
                      <option value="<?php echo $sqlsection['section_id'];?>"> <?php echo $sqlsection['section_name'];?></option>
                  </select>
              </div>
          </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="table-bg1">
                    <th>S No.</th>
                    <th>Name</th>
                    <th>Profile</th>
                    <th>Admission No.</th>
                    <th>Last Payment Amount</th>
                    <th>Last Payment Date</th>
                    <th>Current Dues</th>
                    <th>View Details</th>

                </tr>
            </thead>
            <tbody class="c_teach_tabel" id="studentfee">
                <?php
                $i=1;
                foreach ($stuidarr as $stufeevalue) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i;?></td>
                        <td><?php echo $stufeevalue['USERFNAME'];?></td>
                        <td><a href="student-profile.php?stu_id=<?php echo $stuvar['stu_id']; ?>"><img src="../images/images.png"></a>
                        </td>
                        <td><?php echo $stufeevalue['app_no'];?></td>
                        <td><?php echo $stufeevalue['last_payment'];?></td>
                        <td><?php echo $stufeevalue['last_date'];?></td>
                        <td><?php echo $stufeevalue['amount']?></td>
                        <td>
                            <a href="../school-admin/school-admin-fee.php?id=<?php echo $stufeevalue['ID'];?>"> <i class="fa fa-eye view_btn"
                             aria-hidden="true"></i></a>
                         </td>
                     </tr>
                     <?php
                     $i++;
                 }
                 ?>
             </tbody>
         </table>
     </div>
 </div>
</div>
</section>
<!--end second tab-->
</div>
<!-- /content -->
</div>
<!--tab en-->
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
<?php
if( $formErr!="" )
{
    ?>
    <script>
        $('#myModalLabel').html('');
        $('#error_message').html("<?php echo $formErr; ?>");
        $('#alert_modal').modal('show');
        var url = "<?php echo $reurl;?>";
        window.location.href = url;
    </script>
    <?php
}
?>
<!--Style Switcher -->
<!--<script src="js/jQuery.style.switcher.js"></script>-->
<!-- Modal -->
<script>
    function TimeValidation() {
        var intime = jQuery("#intime").val();
        var outtime = jQuery("#outtime").val();
        //alert(outtime);
        if(outtime!='')
        {
            if (intime > outtime) {
                document.getElementById("inouterror").innerHTML = 'Out time should be Greater than InTime';
                document.getElementById("outtime").focus();
                return false;
            }
        }
        else
        {
            if(intime=='')
            {
                document.getElementById("inouterror").innerHTML = 'In time must be Fiiled';
                return false;
            }

        }
    }
</script>

<script>
    jQuery(document).ready(function(){
        $(document).on('click','.editattend',function(e){
            //alert("click is working");
            var user= jQuery(this).attr("data-user");
            var id= jQuery(this).attr("data-id");
            var intime= jQuery(this).attr("data-in");
            var outtime= jQuery(this).attr("data-out");
            var date = jQuery("#date").val();
			//alert(date);
			//alert(user);
            jQuery("#outtime").val(outtime);
            jQuery("#user").val(user);
            jQuery("#intime").val(intime);
            jQuery("#att_id").val(id);
            jQuery("#date_popup").val(date);
            jQuery("#myModal").modal('show');
        });
    });
</script>

<div class="modal fade my-modal" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Attendance</h4>
              <div id="inouterror"></div>
          </div>
          <form class="form-inline" method="post" action="" onsubmit="return TimeValidation();">
            <div class="modal-body">
             <input class="form-control" value="09:30" type="hidden" id="att_id" name="att_id">
             <input class="form-control" value="" type="hidden" id="user" name="id">
             <input class="form-control" type="hidden" id="date_popup" name="att_date" >
             <input class="form-control" value="<?php echo CURRENT_SESSION;?>" type="hidden" name="curr_session">
             <div class="col-lg-6">
                <label>Intime</label>
                <div class="input-group clockpicker">
                    <input class="form-control" value="09:30" type="text" id="intime" name="intime">
                    <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
                </div>
            </div>
            <div class="col-lg-6">
                <label>Outtime</label>
                <div class="input-group clockpicker">
                    <input class="form-control" value="09:30" type="text" id="outtime" name="outtime">
                    <span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
           <div class="col-lg-12">
              <input type="submit" class="btn btn-default" name="EditA" value="Submit">
          </div>
      </div>
  </form>
</div>

</div>
</div>
<!-- Modal -->

<script type="text/javascript">
    $(".elementnme").bind("change keyup", function(e) {
        var action = 'searchstuatt';
        var action1 = 'getallstuofsection';
        var session = '<?php echo $dbname; ?>';
        var sessionstartdate = '<?php echo SESSION_START_DATE; ?>';
        var sessionrange = '<?php echo DEFAULT_SESSION; ?>';
        var txtElement = $("#elementnme").val();
        var date = $("#date").val();
        var classv = $("#class1").val();
        var secv = $("#section1").val();
        $("#fullmonth").attr("href", "student-month-attendance.php?class="+classv+"&section="+secv+"")

        var dataString = 'element=' + txtElement + '&session=' + session + '&class=' + classv + '&section=' + secv + '&sessionstartdate=' + sessionstartdate + '&sessionrange=' + sessionrange + '&date=' + date + '&action=' + action;
        $.ajax({
            type: 'POST',
            data: dataString,
            url: '../../ajax.php',
            success: function (data) {
                //alert(data);
                if (data == "") {
                    return false;
                }
                //window.location.reload();
                if (data == 1) {
                    alert("Required Parameter Missing");
                    $("#preloader").css("display", "none");
                    return false;
                }
                else if (data == 4) {
                    alert("Session Expired......Try Again.....");
                    $("#preloader").css("display", "none");
                    //$('.loginform .user').val("");
                    //$('.loginform .password').val("");
                    window.location.reload();
                }
                else {
                    $("#preloader").css("display", "none");
                    $("#Table").html(data);
                    //$('.loginform .user').val("");
                    //$('.loginform .password').val("");
                    //window.location.reload();
                }

            }

        });

    });
</script>

<script>

    $("#section1").change(function (e) {
        var action = 'getallstuofsection';
        var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>';
        var classv = $("#class1").val();
        var secv = $("#section1").val();
        $("#fullmonth").attr("href", "student-month-attendance.php?class="+classv+"&section="+secv+"")

        var dataString = 'session=' + session + '&class=' + classv + '&section=' + secv + '&action=' + action;

        //alert(dataString);
        $.ajax({
            type: 'POST',
            data: dataString,
            url: '../../ajax.php',
            success: function (data) {
                //alert(data);
                $( "#seldata" ).empty();
                if (data != "") {
                    var json = $.parseJSON(data);
                    var keys = Object.keys(json);
                    $.each(json, function(i, value) {
                     $('#seldata').append('<option value='+value.stu_id+'>'+value.usr_name+'</option>');
                 });



                }
            }

        });
    });
</script>
<!----------FOR COLOCK PICKER---------------->
<script>
    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });

    $('.clockpicker').clockpicker({
        donetext: 'Done',
    })
    .find('input').change(function(){
        console.log(this.value);
    });

    $('#check-minutes').click(function(e){
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show')
        .clockpicker('toggleView', 'minutes');
    });
</script>
<script>

    $(".selattside").change(function (e) {
        var action = 'searchstaffatt';
        var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>';
        var txtElement = $("#seldata").val();
        var selyear = $("#salyear").val();
        var dataString = 'element=' + txtElement + '&session=' + session + '&salyear=' + selyear + '&action=' + action;
        $("#viewdetail").attr('href', 'attendance-student.php?id=' + txtElement);

        //alert(dataString);
        $.ajax({
            type: 'POST',
            data: dataString,
            url: '../../ajax.php',
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
                        $("#preloader").css("display", "none");
                        //$('.loginform .user').val("");
                        //$('.loginform .password').val("");
                        //window.location.reload();
                    }
                    else {
                        //alert(data);
                        $("#preloader").css("display", "none");
                        $("#SideTable").html(data);
                        //$('.loginform .user').val("");
                        //$('.loginform .password').val("");
                        //window.location.reload();
                    }
                }
            }

        });
    });
</script>
<!-------------------FOR STUDENT CALSS AND SECTION SELECTION----------------->
<script>
    $(document).ready(function () {
        $("#section2").change(function () {
            var classes = $("#class2").val();
            var section = $("#section2").val();
            $.ajax({
                url: "<?php echo HTTP_SERVER; ?>ajax.php?action=students_fee&session=<?php echo $_SESSION['USER']['DB_NAME']; ?>",
                type: "POST",
                data: {
                    classes: classes,
                    section: section
                },
                success: function (data) {
                    $("#studentfee").html(data);
                }
            });
        });
    });
</script>
<script>
    $(function(){
        var chart = AmCharts.makeChart( "chartdiv", {

            "labelRadius": -40,
            "labelText": "[[status]]: [[percents]]%",

            "type": "pie",
            "theme": "light",
            "dataProvider": [ {
                "status": "Present",
                "value": (<?php echo $sqlclasssectionstu; ?>+0)
            }, {
                "status": "Absent",
                "value": (<?php echo $sqlclasssectionstuab;?>+0)
            }],
            "valueField": "value",
            "titleField": "status",
            "outlineAlpha": 0.4,
            "depth3D": 25,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 40,
            "export": {
                "enabled": true
            }

        });
    });
</script>


</body>
</html>