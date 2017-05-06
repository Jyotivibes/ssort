<?php
$dbnew = mysql_connect('localhost', 'ssort_school12', 'x5@q}nvg.vRK');
mysql_select_db("ssort_master", $dbnew);
//echo "SELECT * FROM  essort_school_info WHERE sch_reg_no='".$_SESSION['USER']['DB_NAME']."'";
$sqlsch=mysql_query("SELECT * FROM  essort_school_info WHERE sch_reg_no='".$_SESSION['USER']['DB_NAME']."'",$dbnew);
//echo "SELECT * FROM  essort_school_info WHERE sch_reg_no='".$_SESSION['USER']['DB_NAME']."'";
$resultsch=mysql_fetch_array($sqlsch);
$sch_name=$resultsch['sch_name'];
$sch_logo=$resultsch['sch_logo'];
$dbname=$_SESSION['USER']['DB_NAME'];
//mysql_close($dbnew);

?>
<nav class="navbar navbar-default navbar-static-top m-b-0">
<div class="navbar-header">
<a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
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
                    <a class="logo navbar-brand" href="index.php">
                    <img src="<?php echo HTTP_SERVER; ?>/<?php echo $dbname; ?>/uploads/<?php echo $sch_logo;?>" style="height:60px;width:auto;"/>
                </a>
            </div>
</div>   <!--en col-->

<div class="col-sm-5 col-xs-12 marg-left">
<div class="school-loc">
    <h1 class="school-name"><?php echo $sch_name;?></h1>
<!--
    <p class="address">Jagat Farm, Alpha block - Pari Chowk</p>  
    <p class="address">Greator Noida</p>	    
-->
</div> <!--school-loc en-->

</div><!--en col-->
<ul class="nav navbar-top-links navbar-right pull-right profile-area">
<li class="dropdown">
<a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="javascript:void(0);">
<!--<i class="icon-envelope"></i>-->
    <img src="../images/icons/mail.ico" />
<div class="notify">
    <!--<span class="heartbit"></span>
    <span class="point"></span>-->  
    <span class="heartbit"></span>
     <span class="badge notify-badge">4</span><!--.bg-badge-->
</div>
</a>
<ul class="dropdown-menu mailbox animated bounceInDown messages-panel">
<li>
    <div class="drop-title">You have 4 new messages</div>
</li>
<li>
    <div class="message-center">
        <a href="javascript:void(0);">
            <div class="user-img">
                	<img src="../images/student-pic.jpg" alt="user" class="img-circle">
                    <span class="profile-status online pull-right"></span>
                </div>
                <div class="mail-contnet">
                    <h5>Pavan kumar</h5>
                    <span class="mail-desc">Just see the my admin!</span>
                    <span class="time">9:30 AM</span>
                </div>
            </a>
            <a href="javascript:void(0);">
                <div class="user-img">
                    <img src="../images/avatar1_small.jpg" alt="user" class="img-circle">
                        <span class="profile-status busy pull-right"></span>
                    </div>
                    <div class="mail-contnet">
						<h5>Pavan kumar</h5>
						<span class="mail-desc">Just see the my admin!</span>
						<span class="time">9:30 AM</span>
                	</div>
                </a>
                <a href="javascript:void(0);">
                    <div class="user-img">
                        <img src="../images/avatar1_small.jpg" alt="user" class="img-circle">
                            <span class="profile-status away pull-right"></span>
                        </div>
                        <div class="mail-contnet">
							<h5>Pavan kumar</h5>
							<span class="mail-desc">Just see the my admin!</span>
							<span class="time">9:30 AM</span>
						</div>
                    </a>
                    <a href="javascript:void(0);">
                        <div class="user-img">
                            <img src="../images/avatar1_small.jpg" alt="user" class="img-circle">
                                <span class="profile-status offline pull-right"></span>
                            </div>
                            <div class="mail-contnet">
                                <h5>Pavan kumar</h5>
                                <span class="mail-desc">Just see the my admin!</span>
                                <span class="time">9:02 AM</span>
                            </div>
                        </a>
                    </div>
                </li>
                <li>
                    <a class="text-center" href="javascript:void(0);">
                        <strong>See all messages</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-messages -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="javascript:void(0);">
                <!--<i class="fa fa-calendar-check-o"></i>-->
                <img src="../images/icons/event.ico" />
                <div class="notify">
                    <!--<span class="heartbit"></span>
                    <span class="point"></span>-->
                    <span class="heartbit"></span>
                    <span class="badge notify-badge">4</span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-tasks animated bounceInDown events-panel">
                <li>
                    <a href="javascript:void(0);">
                        <div>
                            <p>
                                <strong>Event 1</strong>
                                <span class="pull-right text-muted">Annual Function</span>
                            </p>                           
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="javascript:void(0);">
                        <div>
                            <p>
                                <strong>Event 2</strong>
                                <span class="pull-right text-muted">Annual Function</span>
                            </p>                            
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="javascript:void(0);">
                        <div>
                            <p>
                                <strong>Event 3</strong>
                                <span class="pull-right text-muted">Annual Function</span>
                            </p>                            
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="javascript:void(0);">
                        <div>
                            <p>
                                <strong>Event 4</strong>
                                <span class="pull-right text-muted">Annual Function</span>
                            </p>                            
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="javascript:void(0);">
                        <strong>See All Events</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-tasks -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown profile">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                <img alt="" src="../images/icons/profile.png">
                    <span class="username">Hello <?php echo $_SESSION['USER']['USER_NAME']; ?></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <?php
                        if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                            !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'SAD')) {
                        ?>
                        <a href="../school-admin/profile.php">
                            <i class="fa fa-suitcase"></i> Profile
                        </a>
                        <?php
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                            !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Teacher')) {
                            ?>
                            <a href="../teacher/teacher-profile.php">
                                <i class="fa fa-suitcase"></i> Profile
                            </a>
                        <?php
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                            !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Principal')) {
                            ?>
                            <a href="../principal/profile.php">
                                <i class="fa fa-suitcase"></i> Profile
                            </a>
                        <?php
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                            !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Chairman')) {
                            ?>
                            <a href="javascript:void(0)">
                                <i class="fa fa-suitcase"></i> Profile
                            </a>
                        <?php
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                            !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Parent')) {
                            ?>
                            <a href="../parents/profile.php">
                                <i class="fa fa-suitcase"></i> Profile
                            </a>
                        <?php
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                            !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'fee')) {
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
                            !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'SAD')) {
                            ?>
                            <a href="../school-admin/change-password.php">
                                <i class="fa fa-cog"></i> Settings
                            </a>
                        <?php
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                            !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Teacher')) {
                            ?>
                            <a href="../teacher/change-password.php">
                                <i class="fa fa-cog"></i> Settings
                            </a>
                        <?php
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                            !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Principal')) {
                            ?>
                            <a href="../principal/change-password.php">
                                <i class="fa fa-cog"></i> Settings
                            </a>
                        <?php
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                            !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Chairman')) {
                            ?>
                            <a href="../chairman/change-password.php">
                                <i class="fa fa-cog"></i> Settings
                            </a>
                        <?php
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                            !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Parent')) {
                            ?>
                            <a href="../parents/change-password.php">
                                <i class="fa fa-cog"></i> Settings
                            </a>
                        <?php
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) &&
                            !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'fee')) {
                            ?>
                            <a href="javascript:void(0)">
                                <i class="fa fa-cog"></i> Settings
                            </a>
                        <?php
                        }
                        ?>
                    </li>
                    <li>
                        <a href="<?php echo HTTP_SERVER;?>logout.php">
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