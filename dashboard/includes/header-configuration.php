<?php
$dbnew = mysql_connect('localhost', 'root', '',TRUE);
mysql_select_db("ssort_master", $dbnew);
$sqlsch = mysql_query("SELECT * FROM  essort_school_info WHERE sch_reg_no='" . $_SESSION['USER']['DB_NAME'] . "'", $dbnew);
$resultsch = mysql_fetch_array($sqlsch);
//print_r($resultsch);
$sch_name = $resultsch['sch_name'];
$sch_logo = $resultsch['sch_logo'];
$sch_location = $resultsch['sch_local_address'];
$dbname = $_SESSION['USER']['DB_NAME'];
//mysql_close($dbnew);
require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
require_once('../../classes/general_class.php');
$obj = new General();
$getmessage = $obj->getMessage();
/*$array= array();
$eventNotification = $obj->getEventsNotification();
$array[] = $eventNotification;*/

$sql = mysql_query("SELECT *,MAX(off_day) as maxoff,MIN(off_day) as minoff FROM
            essort_holidays WHERE occassion_type IN('Event','Holiday') AND status = 1
            AND DATE_FORMAT( `off_day` , '%Y-%m-%d' ) >= '" . date('Y-m-d') . "' GROUP BY occassion ORDER BY minoff desc LIMIT 5") OR DIE(mysql_error());
$eventcount = mysql_num_rows($sql);

?>
<nav class="navbar navbar-default navbar-static-top m-b-0">
<div class="navbar-header">
<a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse"
   data-target=".navbar-collapse">
    <i class="ti-menu"></i>
</a>
<ul class="nav navbar-top-links navbar-left hidden-xs active hamburger">
    <li>
        <a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light">
            <i class="fa fa-bars"></i>
        </a>
    </li>
    <li>

    </li>
</ul>
<div class="col-sm-1 logo-shift">
    <div class="top-left-part">
        <?php
        if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
            !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Teacher')
        ) {
        ?>
            <a class="logo navbar-brand" href="teacher.php">
                <img src="<?php echo HTTP_SERVER; ?>/<?php echo $dbname; ?>/uploads/<?php echo $sch_logo; ?>" style="height:60px;">  
            </a>
        <?php
        }
        if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
            !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'SAD')){
            ?>
            <a class="logo navbar-brand" href="school-admin.php">
                <img src="<?php echo HTTP_SERVER; ?>/<?php echo $dbname; ?>/uploads/<?php echo $sch_logo; ?>"
                     style="height:60px;"/>
            </a>
        <?php
        }
        ?>
    </div>
</div>
<!--en col-->

<div class="col-sm-5 col-xs-12 marg-left">
    <div class="school-loc">
        <h1 class="school-name"><?php echo $sch_name;?></h1>
        <!--
            <p class="address">Jagat Farm, Alpha block - Pari Chowk</p>
            <p class="address">Greator Noida</p>
        -->
    </div>
    <!--school-loc en-->
</div>
<!--en col-->
<ul class="nav navbar-top-links navbar-right pull-right profile-area">
<li class="dropdown">
    <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="javascript:void(0);">
        <img src="../images/icons/message.ico"/>
        <div class="notify">
            <span class="heartbit"></span>

            <span class="badge notify-badge">
                <?php
                $count = count($getmessage);
                echo $count;
                ?>
            </span><!--.bg-badge-->
        </div>
    </a>
    <ul class="dropdown-menu mailbox animated bounceInDown messages-panel">
        <li>
            <div class="drop-title">You have <?php echo $count; ?> new messages</div>
        </li>
        <li>
            <div class="message-center">
                <?php
				if($_SESSION['USER']['ROLE_ID'] == 'SAD')
							{
								$url="../school-admin/school-inbox.php";
							}else if($_SESSION['USER']['ROLE_ID'] == 'Teacher')
							{
								$url="../teacher/inbox.php";
							}
							else if($_SESSION['USER']['ROLE_ID'] == 'Principal')
							{
								$url="../principal/inbox.php";
							}
							else
							{
								$url="#";
							}
							
                foreach($getmessage as $row){
				
                    ?>
                    <a href="<?php echo $url;?>" >
                        <div class="user-img">
                            <?php
							
                            if($row['usr_pic'] == ''){
                                ?>
                                <img src="../../<?php echo $_SESSION['USER']['DB_NAME']?>/uploads/staff/images.png" alt="user" class="img-circle">
                                <span class="profile-status online pull-right"></span>
                            <?php
                            }
                            else{
                                ?>
                                <img src="../../<?php echo $_SESSION['USER']['DB_NAME']?>/uploads/staff/<?php echo $row['usr_pic']?>" alt="user" class="img-circle">
                                <span class="profile-status online pull-right"></span>
                            <?php
                            }
                            ?>

                        </div>
                        <div class="mail-contnet">
                            <h5><?php echo $row['usr_fname']." ".$row['usr_lname']; ?></h5>
                            <span class="mail-desc"><?php echo $row['subject']; ?></span>
                            <span class="time"><?php echo date('h:m A',strtotime($row['date'])); ?></span>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </li>
        <!--<li>
            <a class="text-center" href="javascript:void(0);">
                <strong>See all messages</strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </li>-->
        <li>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'SAD')
            ) {
                ?>
                <a class="text-center" href="../school-admin/school-inbox.php">
                    <strong>See all messages</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Teacher')
            ) {
                ?>
                <a class="text-center" href="../teacher/inbox.php">
                    <strong>See all messages</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Principal')
            ) {
                ?>
                <a class="text-center" href="../principal/inbox.php">
                    <strong>See all messages</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Chairman')
            ) {
                ?>
                <a class="text-center" href="../parents/inbox.php">
                    <strong>See all messages</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Parent')
            ) {
                ?>
                <a class="text-center" href="../parents/inbox.php">
                    <strong>See all messages</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'fee')
            ) {
                ?>
                <a class="text-center" href="javascript:void(0);">
                    <strong>See all messages</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            <?php
            }
            ?>
        </li>
    </ul>
    <!-- /.dropdown-messages -->
</li>
<!-- /.dropdown -->
<li class="dropdown">
    <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="javascript:void(0);">
        <!--<i class="fa fa-calendar-check-o"></i>-->
        <img src="../images/icons/event.ico"/>

        <div class="notify">
            <span class="heartbit"></span>
            <span class="badge notify-badge"><?php echo $eventcount; ?></span>
        </div>
    </a>
    <ul class="dropdown-menu dropdown-tasks animated bounceInDown events-panel">
        <?php
		
		if($_SESSION['USER']['ROLE_ID'] == 'SAD')
							{
								$urlevent="../school-admin/school-events-notification.php";
							}else if($_SESSION['USER']['ROLE_ID'] == 'Teacher')
							{
								$urlevent="../teacher/eventsholidays.php";
							}
							else if($_SESSION['USER']['ROLE_ID'] == 'Principal')
							{
								$urlevent="../principal/eventsholidays.php";
							}
							else
							{
								$urlevent="#";
							}
		
        $i = 1;
        while($row = mysql_fetch_array($sql)){
            ?>
            <li>
                <a href="<?php echo $urlevent;?>">
                    <div>
                        <p>
                            <strong><?php
                                if(strlen($row['occassion']) > 10){
                                    echo substr($row['occassion'],0,10)."...";
                                }
                                else{
                                    echo $row['occassion'];
                                }
                                ?></strong>
                            <span class="pull-right text-muted">
                                <?php
                                echo $row['minoff'];
                                ?>
                            </span>
                        </p>
                    </div>
                </a>
            </li>
            <?php
            $i++;
        }
        ?>
		
        <li class="divider"></li>
        <li>
            <a class="text-center" href="<?php echo $urlevent;?>">
                <strong>See All Events</strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
    <!-- /.dropdown-tasks -->
</li>
<!-- /.dropdown -->
<li class="dropdown profile">
    <a href="<?php echo $urlevent;?>" class="dropdown-toggle" data-toggle="dropdown">
        <img alt="" src="../images/icons/profile.png">
        <span class="username">Hello <?php echo $_SESSION['USER']['USER_NAME']; ?></span> 
        <b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
        <li>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'SAD')
            ) {
                ?>

                <!--<a href="../school-admin/profile.php">
                    <i class="fa fa-suitcase"></i> Profile
                </a>-->
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Teacher')
            ) {
                ?>
                <a href="../teacher/teacher-profile.php">
                    <i class="fa fa-suitcase"></i> Profile
                </a>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Principal')
            ) {
                ?>
                <a href="../principal/profile.php">
                    <i class="fa fa-suitcase"></i> Profile
                </a>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Chairman')
            ) {
                ?>
                <a href="javascript:void(0)">
                    <i class="fa fa-suitcase"></i> Profile
                </a>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Parent')
            ) {
                ?>
                <a href="../parents/profile.php">
                    <i class="fa fa-suitcase"></i> Profile
                </a>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'fee')
            ) {
                ?>
                <a href="javascript:void(0)">
                    <i class="fa fa-suitcase"></i> Profile
                </a>
            <?php
            }
            ?>
        </li>
        <li>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'SAD')
            ) {
                ?>
                <a href="../school-admin/change-password.php">
                    <i class="fa fa-cog"></i> Settings
                </a>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Teacher')
            ) {
                ?>
                <a href="../teacher/change-password.php">
                    <i class="fa fa-cog"></i> Settings
                </a>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Principal')
            ) {
                ?>
                <a href="../principal/change-password.php">
                    <i class="fa fa-cog"></i> Settings
                </a>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Chairman')
            ) {
                ?>
                <a href="../chairman/change-password.php">
                    <i class="fa fa-cog"></i> Settings
                </a>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Parent')
            ) {
                ?>
                <a href="../parents/change-password.php">
                    <i class="fa fa-cog"></i> Settings
                </a>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'fee')
            ) {
                ?>
                <a href="javascript:void(0)">
                    <i class="fa fa-cog"></i> Settings
                </a>
            <?php
            }
            ?>
        </li>
        <li>
            <a href="<?php echo HTTP_SERVER; ?>logout.php">
                <i class="fa fa-lock"></i> Logout
            </a>
        </li>
    </ul>
</li>
</ul>
</div>
<!-- /.navbar-header -->
<!-- /.navbar-top-links -->
<!-- /.navbar-static-side -->
</nav>