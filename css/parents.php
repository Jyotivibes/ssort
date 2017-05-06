<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parents | Parents</title>
    <?php include '../includes/head.php'; ?>
</head>
<body>
<div id="wrapper">
<?php
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='Parent') )
{
    $user_id=$_SESSION['USER']['USER_NAME'];
    require_once('../../'.$_SESSION['USER']['DB_NAME'].'/classes/connection.php');
    require_once('../../classes/general_class.php');
    $obj = new General();
    $circularNotice = $obj->getCircularActivities();
    $eventNotification = $obj->getEventsNotification();
    include_once 'stastics.php';
	if(isset($_REQUEST['submitM'])){
        $addmessage = $obj->ADDMESSAGE();
        if($addmessage == 1){
            echo "<script>alert('Message send')</script>";
        }
    }

}
else
{
    echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
}
?>
<!-- header Navigation st-->
<?php include '../includes/header-configuration.php'?>
<!-- header Navigation en-->

<!--sidebar nav st-->
<?php include '../includes/sidebar.php'; ?>
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
                <a href="parents.php">Student</a>
            </li>
            <li class="active">Dashboard</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <a href="inbox.php">
            <div class="white-box text-center co-messages">
                <h1 class="text-white counter">
                    <!--  <i class="fa fa-envelope fa-messages"></i>-->
                    <img src="../images/icons/message.ico" class="icon-size" />
                </h1>
                <p class="text-muted">Messages</p>
            </div>
        </a>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <a href="attendance.php">
            <div class="white-box text-center co-attendance">
                <h1 class="text-white counter">
                    <img src="../images/icons/attendance.png" class="icon-size" />
                </h1>
                <p class="text-muted">Attendance</p>
            </div>
        </a>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <a href="fees.php">
            <div class="white-box text-center co-fees">
                <h1 class="counter">
                    <img src="../images/icons/fees.png" class="icon-size" />
                </h1>
                <p class="text-muted">Fee</p>
            </div>
        </a>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <a href="eventsholidays.php">
            <div class="white-box text-center co-events">
                <h1 class="counter">
                    <img src="../images/icons/event.ico" class="icon-size" />
                </h1>
                <p class="text-muted">Events & Holidays</p>
            </div>
        </a>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <a href="noticecircular.php">
            <div class="white-box text-center co-notifications">
                <h1 class="text-white counter">
                    <img src="../images/icons/notification.png" class="icon-size" />
                </h1>
                <p class="text-muted">Notice & Circulars</p>
            </div>
        </a>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <a href="javascript:void(0);">
            <div class="white-box text-center co-assessment">
                <h1 class="text-white counter">
                    <img src="../images/icons/assessment.png" class="icon-size" />
                </h1>
                <p class="text-muted">Assessment</p>
            </div>
        </a>
    </div>
</div>
<!--stu info st-->
<div class="row">
<div class="col-md-7 col-sm-12 col-xs-12">
    <div class="my-box">
        <h3 class="box-title">Demo International School - Location</h3>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="panel message-center panel-embose bg-color-box">
                    <div class="content">
                        <!--<img src="../images/<?php /*echo $stuadata[0]['usr_photo']; */?>" alt="user" class="img-circle student-profile">-->
                        <?php
                        $filename = "../images/".$stuadata[0]['usr_photo'];
                        if($stuadata[0]['usr_photo'] == ""){
                            ?>
                            <img src="../images/images.png" class="img-circle student-profile" />
                            <?php
                        }
                        elseif(file_exists($filename)){
                            ?>
                            <img src="../images/<?php echo $stuadata[0]['usr_photo']; ?>" class="img-circle student-profile"/>
                                <?php
                        }
                        else{
                            ?>
                            <img src="../images/images.png" class="img-circle student-profile" />
                                <?php
                            }
                            ?>
                        <div>
                            <strong><?php echo $stuadata[0]['usr_fname']."".$stuadata[0]['usr_mname']."".$stuadata[0]['usr_lname'];?></strong>
                            <h6><?php echo $stuarray[0]['class_name'];?> - <?php echo $stuarray[0]['section_name'];?></h6>
                            <h6>Enrollment No. - 2345</h6>
                        </div>
                    </div>
                </div><!--en panel-->
            </div><!--en col-->


        </div><!--en row-->
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <div class="panel message-center panel-embose bg-parents shadow-box-height">
                    <div class="content">
                        <!--<img src="../images/father-pic.jpg" alt="user" class="img-circle">-->
                        <?php
                        $filenameFather = "../images/".$sqlfather['usr_father_photo'];
                        if($sqlfather['usr_father_photo'] == ""){
                            ?>
                            <img src="../images/images.png" class="img-circle" />
                        <?php
                        }
                        elseif(file_exists($filenameFather)){
                            ?>
                            <img src="../images/<?php echo $sqlfather['usr_father_photo']; ?>" class="img-circle"/>
                        <?php
                        }
                        else{
                            ?>
                            <img src="../images/images.png" />
                        <?php
                        }
                        ?>
                        <div>
                            <strong><?php echo $sqlfather['usr_r_name'];?></strong>
                            <h6>Father</h6>
                            <h6><?php echo $sqlfather['usr_r_primary_contact'];?></h6>
                        </div>
                    </div>
                </div><!--en panel-->

                <div class="panel message-center panel-embose bg-parents shadow-box-height">
                    <div class="content">
                        <!--<img src="../images/mother-pic.jpg" alt="user" class="img-circle">-->
                        <?php
                        $filenameFather = "../images/".$sqlmother['usr_mother_photo'];
                        if($sqlmother['usr_mother_photo'] == ""){
                            ?>
                            <img src="../images/images.png" class="img-circle" />
                        <?php
                        }
                        elseif(file_exists($filenameFather)){
                            ?>
                            <img src="../images/<?php echo $sqlmother['usr_mother_photo']; ?>" class="img-circle"/>
                        <?php
                        }
                        else{
                            ?>
                            <img src="../images/images.png" class="img-circle"/>
                        <?php
                        }
                        ?>

                        <div>
                            <strong><?php echo $sqlmother['usr_r_name'];?></strong>
                            <h6>Mother</h6>
                            <h6><?php echo $sqlmother['usr_r_primary_contact'];?></h6>
                        </div>
                    </div>
                </div><!--en panel-->
            </div><!--en col-->

            <div class="col-sm-6 col-xs-12">
                <div class="panel message-center panel-embose bg-school box-padding">
                    <div class="content">
                        <?php
                        $filenamePrincipal = "../images/".$sqlprincipal['usr_pic'];
                        if($sqlprincipal['usr_pic'] == ""){
                            ?>
                            <img src="../images/images.png" class="img-circle principal-profile" />
                        <?php
                        }
                        elseif(file_exists($filenamePrincipal)){
                            ?>
                            <img src="../images/<?php echo $sqlprincipal['usr_pic']; ?>" class="img-circle principal-profile"/>
                        <?php
                        }
                        else{
                            ?>
                            <img src="../images/images.png" class="img-circle principal-profile"/>
                        <?php
                        }
                        ?>

                        <div>
                            <strong>Ms. <?php echo $sqlprincipal['usr_fname'];?><?php echo $sqlprincipal['usr_mname'];?> <?php echo $sqlprincipal['usr_lname'];?></strong>
                            <h6>Principal</h6>
                        </div>
                        <div class="info-panel">
                            <a href="#">
                                <img src="../images/icons/chat.png" class="icon-two-size effect-icon" data-toggle="tooltip" data-placement="top" title="Message">
                            </a>
                             <a href="#" data-toggle="modal" data-target="#myMail" class="getdata"
                               data-pid="<?php echo $sqlprincipal['usr_id']; ?>"
                               data-prole ="<?php echo $sqlprincipal['usr_role']; ?>"
                               data-pname="<?php echo $sqlprincipal['usr_fname']." ".$sqlprincipal['usr_mname']." ".$sqlprincipal['usr_lname']; ?>">
                                <img src="../images/icons/mail.ico" class="icon-two-size effect-icon" data-toggle="tooltip" data-placement="top" title="E-mail">
                            </a>
                        </div>
                    </div>
                </div><!--en panel-->
            </div><!--en col-->

            <div class="col-sm-6 col-xs-12">
                <div class="panel message-center panel-embose bg-school box-padding">
                    <div class="content">
                        <!--<img src="../images/clteacher-pic.jpg" alt="user" class="img-circle teacher-profile">-->
                        <?php
                        $filenameTeacher = "../images/".$classteacherdata['usr_pic'];
                        if($classteacherdata['usr_pic'] == ""){
                            ?>
                            <img src="../images/images.png" class="img-circle teacher-profile" />
                        <?php
                        }
                        elseif(file_exists($filenameTeacher)){
                            ?>
                            <img src="../images/<?php echo $classteacherdata['usr_pic']; ?>" class="img-circle teacher-profile"/>
                        <?php
                        }
                        else{
                            ?>
                            <img src="../images/images.png" class="img-circle teacher-profile"/>
                        <?php
                        }
                        ?>
                        <div>
                            <strong><?php echo $classteacherdata['usr_fname']." ".$classteacherdata['usr_mname']." ".$classteacherdata['usr_lname']; ?></strong>
                            <h6>Class Teacher</h6>
                        </div>
                        <div class="info-panel">
                            <a href="#"><img src="../images/icons/chat.png" class="icon-two-size effect-icon" data-toggle="tooltip" data-placement="top" title="Message"></a>
                           <a href="#" data-toggle="modal" data-target="#myMail" class="getdata" data-pid="<?php echo $classteacherdata['usr_id']; ?>"
                               data-prole ="<?php echo $classteacherdata['usr_role']; ?>"
                               data-pname="<?php echo $classteacherdata['usr_fname']." ".$classteacherdata['usr_mname']." ".$classteacherdata['usr_lname']; ?>"><img src="../images/icons/mail.ico" class="icon-two-size effect-icon"  data-toggle="tooltip" data-placement="top" title="E-mail"></a>
                        </div>
                    </div>
                </div><!--en message center-->
            </div><!--en col-->
        </div><!--en row-->
    </div>
    <!--progress st-->
    <div class="my-box comment-center">
        <div class="comment-body comment-profile">
            <div class="panel-attendance">
                <span class="text-heavy">Month's Attendance</span>
                <div class="circle__content">80.00%</div>

                <a href="javascript:void(0)" class="pull-right label-success label" >Present</a> <span class="pull-right text-today">Today</span>
            </div>

            <div class="pull-right in-out-time">
                <a href="javascript:void(0)" class="pull-left label-info label m-r-8 padding-time" >IN TIME <span class="btn-block m-t-5">9:30AM</span></a>
                <a href="javascript:void(0)" class="pull-right label-warning label padding-time" >OUT TIME<span class="btn-block m-t-5">2:30PM</span></a>
            </div>
        </div>
    </div>
    <!--progress en-->
    <!--graph st-->
    <div class="my-box rem-extra">
        <h3 class="text-center">Session 2016-2017</h3>
        <div id="chartdiv" class="bg-chart"></div>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table color-table info-table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Days</th>
                            <th>%</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Present</td>
                            <td>80</td>
                            <td>80%</td>
                        </tr>
                        <tr>
                            <td>Absent</td>
                            <td>20</td>
                            <td>20%</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--en row-->
    </div>
    <!--graph en-->

</div><!--col-en-->
<div class="col-md-5 col-sm-12 col-xs-12 m-top-20">
<div class="my-box"> 
                       <h3 class="box-title">My Subject</h3>                       
                        <section class="panel section-panel">                            
                           <!--subject teacher st-->
                               <div class="table-responsive">
                                  <table class="table table-hover table-scroll teacher-profile">
                                    <thead>
                                      <tr>
                                        <th><strong>#</strong></th>
                                        <th><strong>Teacher Name</strong></th>
                                        <th><strong>Subject</strong></th>                                        
                                      </tr>
                                    </thead>
                                    <tbody class="panel-scroll">
                                      <tr>
                                        <td>1</td>
                                        <td>Deshmukh</td>
                                        <td>Math</td>                                        
                                      </tr>
                                      <tr>
                                        <td>2</td>
                                        <td>Amar</td>
                                        <td>Physics</td>                                       
                                      </tr>
                                      <tr>
                                        <td>3</td>
                                        <td>Rajesh</td>
                                        <td>English</td>                                        
                                      </tr>                                      
                                      <tr>
                                        <td>4</td>
                                        <td>Kiran singh</td>
                                        <td>Hindi</td>                                       
                                      </tr>
                                      <tr>
                                        <td>1</td>
                                        <td>Deshmukh</td>
                                        <td>Math</td>                                        
                                      </tr>
                                      <tr>
                                        <td>2</td>
                                        <td>Amar</td>
                                        <td>Physics</td>                                       
                                      </tr>
                                      <tr>
                                        <td>3</td>
                                        <td>Rajesh</td>
                                        <td>English</td>                                        
                                      </tr>                                      
                                      <tr>
                                        <td>4</td>
                                        <td>Kiran singh</td>
                                        <td>Hindi</td>                                       
                                      </tr>                                               
                                    </tbody>
                                  </table>
                                </div>
                            <!--subject teacher en--> 
                        </section>
                    </div>
    <!--calendar st-->
    <div class="my-box">
        <!--<div id="calendar-fancy"></div>-->
        <div id="calendar-fancy"></div>
        <!--<img src="../images/calendar.jpg" class="img-responsive" />-->

        <section class="panel section-panel">
            <header class="panel-heading heading-event">
                <h3 class="box-title">Upcoming Events & Holidays - <span class="today" id="todaydate"></span></h3>
            </header>
            <div class="panel-body panel-scroll" id="eventoccassion">
                <?php
                $i=1;
                while($row = mysql_fetch_array($eventNotification)){
                    if($i%2==0)
                    {
                        $tag='success';
                    }
                    else
                    {
                        $tag='info';
                    }
                    ?>
                    <div class="alert alert-<?php echo $tag;?> clearfix alert-height">
                        <div class="notification-info">
                            <ul class="clearfix notification-meta">
                                <li class="pull-left notification-sender">
                                    <span><a href="" data-toggle="modal" data-target="#myMail"
                                                         class="getholidays"
                                                         data-oc="<?php echo $row['occassion']; ?>"
                                                         data-to="<?php echo date('d-m-Y', strtotime($row['maxoff'])); ?>"
                                                         data-from="<?php echo date('d-m-Y', strtotime($row['minoff'])); ?>"
                                                         data-info="<?php echo $row['additional_info']; ?>">
                                                        <?php echo $row['occassion']; ?>
                                                    </a></span>
                                </li>

                            </ul>

                        </div>
                    </div>
                    <?php
                    $i++;
                }
                ?>


            </div>
        </section>
    </div>
    <!--latest circular st-->
    <div class="my-boxses height-latest-circle">
        <h3 class="box-title latest-cir">Latest Circular</h3>
        <div class="feeds-panel">
            <ul class="feeds">
                <?php
                while($row = mysql_fetch_array($circularNotice)){
                    ?>
                    <li id="activity_<?php echo $row['id'];  ?>" class="data" data-toggle="modal" data-target="#latestCircular" data-id="<?php echo $row['message']; ?>">
                        <div class="bg-success"><i class="fa fa-calendar"></i></div>
                        <?php
                        if(strlen($row['message'])> 20){
                            echo $str = substr($row['message'],0,20)." . . .";
                        }
                        else{
                            echo $row['message'];
                        }
                        ?>
                        <span class="text-muted"><?php echo $row['date']; ?></span>
                    </li>
                <?php
                }
                ?>

            </ul>
        </div>
    </div>
    <!--latest circular en-->
</div>
<!--calendar en-->
</div><!--col-en-->
</div>
<!--stu info en-->
<!-- .right-sidebar st here-->
</div>
<!-- /.container-fluid -->
<?php include'../includes/footer.php'; ?>
</div>
<!-- /#page-wrapper -->


<!--mail modal st-->
<div class="modal fade" id="myMails" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Email to contact</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
                    <div class="form-group">
                        <input type="hidden" name="from_id" value="<?php echo $select_user['usr_id']; ?>">
                        <input type="hidden" name="from_role" value="<?php echo $select_user['usr_role']; ?>">
                        <input type="hidden" name="to_role" id="p_role">
                        <input type="hidden" name="teacher_id" id="p_id">
                        <label for="inputPassword3" class="col-sm-2 control-label">Subject:</label>
                        <div class="col-sm-10">
                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                        </div>
                    </div>
                    <div class="form-group marg-bott">
                        <label for="textarea" class="col-sm-2 control-label">Message:</label>
                        <div class="col-sm-10">
                            <textarea rows="5" name="message" class="message"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2 col-xs-12"></div>
                            <div class="col-sm-10 text-right">
                                <label for="files" class="btn btn-default"><span class="fa fa-paperclip"></span> Attach File</label>
                                <input id="files" name="attach" style="visibility:hidden;" type="file" />
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 pull-right text-center">
                        <input type="submit" name="submitM" class="btn btn-default btn-color border-round" value="Send">
                           <!-- <i class="fa fa-paper-plane"></i> </button>-->
                    </div>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>
<!--mail modal en-->
<!--mail modal en-->

<!--latest circular st-->
<div class="modal fade" id="latestCircular" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Latest Circular</h4>
            </div>
            <div class="modal-body" id="showCircularModal">
                <p>Latest Circular</p>
            </div>
        </div>
    </div>
</div>
<!--latest circular en-->
<!-- /#wrapper -->

<?php include '../includes/foot.php'; ?>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();

    });
</script>

<script>
    $(document).ready(function(){
        $(".data").click(function(){
            var linkId=$(this).attr("data-id")
            $("#showCircularModal").html(linkId);
            $("#latestCircular").modal('show');

        });
    });
</script>

<script>
    $(".getdata").click(function() {
        var pid=$(this).attr("data-pid");
        var prole=$(this).attr("data-prole");
        var pname=$(this).attr("data-pname");
        $("#p_id").val(pid);
        $("#p_role").val(prole);
        $("#p_name").val(pname);
        $("#myMails").modal('show');
    });
</script>
<!--------------------------------FOR UPCOMING EVENTS HOLIDAYS---------------------------------------->
<script>
    $(".getholidays").click(function () {
        var oc = $(this).attr("data-oc");
        var to = $(this).attr("data-to");
        var from = $(this).attr("data-from");
        var info = $(this).attr("data-info");
        $("#oc").html(oc);
        if (from == to) {
            $("#from_day").html(from);
        }
        else {
            $("#from_day").text(' From : ' + from);
            $("#to_day").text(' To : ' + to);
        }
        $("#info").html(info);
        $("#HolidayModal").modal('show');
    });
</script>
<!--mail modal st-->
<div class="modal fade" id="HolidayModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="oc"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <span id="from_day"></span>
                    <span id="to_day"></span>

                    <p id="info"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script>
    $(".getCircular").click(function () {
        var dra = $(this).attr("data-id");
        var subject = $(this).attr("data-subject");
        var href = $(this).attr("data-href");
        var date = $(this).attr("data-date");
        $("#target").css("display", "block");
        if (href == '') {
            $("#target").css("display", "none");
        }

        $("#success_message").html(dra);
        $("#subject_message").html(subject);
        $("#date").html(date);
        $("#target").attr("href", "<?php echo HTTP_SERVER;?>dashboard/school-admin/uploads/" + href + "");
        $("#getCircular").modal('show');


    });
</script>
<!-- /#page-wrapper -->
<div class="modal fade" id="getCircular" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1" >
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="subject_message">Did this Notice & Circulars is relevent</h4>

            </div>

            <div class="modal-body" >
                <p id="date"></p>
                <p id="success_message" class="text-justify"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 pull-right text-center">
                        <a href="#" class="btn btn-link marg-right" id="target" target="_blank"><span
                                class="fa fa-paperclip"></span> Download Attachment</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>
