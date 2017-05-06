<?php
session_start();
    $user_id = $_SESSION['USER']['USER_NAME'];
    $user_role = $_SESSION['USER']['ROLE_ID'];
    require_once('../../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
    require_once('../../../classes/general_class.php');
    $obj = new General();

if(!empty($_GET['call'])){
    $function_name=$_GET['call'];
    $function_name();
}

/***************************************FOR ALL EVENT AND HOLIDAYS************************************/
function getevent(){
    $occasion = $_POST['holiday'];
    $sql = mysql_query("SELECT * FROM essort_holidays WHERE occassion ='".$occasion."'");
    if(mysql_num_rows($sql) <= 0){
        echo 0;
        return 0;
    }
    $row = mysql_fetch_array($sql);
    ?>
    <div class="event-box">
        <div class="message-center">
            <a href="#">
                <div class="user-img"> <img src="../images/event_img1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                <div class="mail-contnet">
                    <h5><?php echo $row['occassion']; ?></h5>
                    <span class="mail-desc"><?php echo $row['additional_info']; ?></span>
                    <span class="time"><?php echo date('d-m-Y',strtotime($row['off_day'])); ?></div>
            </a>
        </div>
    </div>
    <?php
}
/***************************************FOR ALL EVENT ************************************/
function all_event(){
    $event = $_POST['all_event'];
    $sql = mysql_query("SELECT * FROM essort_holidays WHERE occassion_type='Event' AND  occassion ='".$event."'");
    if(mysql_num_rows($sql) <= 0){
        echo 0;
        return 0;
    }
    $row = mysql_fetch_array($sql);
    ?>
    <div class="event-box">
        <div class="message-center">
            <a href="#">
                <div class="user-img"> <img src="../images/event_img1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                <div class="mail-contnet">
                    <h5><?php echo $row['occassion']; ?></h5>
                    <span class="mail-desc">
                        <?php echo $row['additional_info']; ?>
                    </span>
                    <span class="time"><?php echo date('d-m-Y',strtotime($row['off_day'])); ?></span>
                </div>
            </a>
        </div>
    </div>
<?php
}
/***************************************FOR ALL HOLIDAYS************************************/
function all_holidays(){
    $holidays = $_POST['all_holidays'];
    $sql = mysql_query("SELECT * FROM essort_holidays WHERE occassion_type='Holiday' AND  occassion ='".$holidays."'");
    if(mysql_num_rows($sql) <= 0){
        echo 0;
        return 0;
    }
    $row = mysql_fetch_array($sql);
    ?>
    <div class="event-box">
        <div class="message-center">
            <a href="#">
                <div class="user-img"> <img src="../images/event_img1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                <div class="mail-contnet">
                    <h5><?php echo $row['occassion']; ?></h5>
                    <span class="mail-desc">
                        <?php echo $row['additional_info']; ?>
                    </span>
                    <span class="time"><?php echo date('d-m-Y',strtotime($row['off_day'])); ?></span>
                </div>
            </a>
        </div>
    </div>
<?php
}
/***************************************FOR NOTICE CIRCULAR************************************/
function notice_circular(){
    $notice_circular = $_POST['notice_circular'];
    $sql = mysql_query("SELECT * FROM essort_circular_activities WHERE  subject ='".$notice_circular."'");
    if(mysql_num_rows($sql) <= 0){
    echo 0;
        return 0;
    }
    $row = mysql_fetch_array($sql);
    ?>
    <div class="event-box">
        <div class="message-center">
            <a href="#">
                <div class="user-img"> <img src="../images/event_img1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                <div class="mail-contnet">
                    <h5><?php echo $row['subject']; ?></h5>
                    <span class="mail-desc">
                        <?php echo $row['message']; ?>
                    </span>
                    <span class="time"><?php echo date('d-m-Y',strtotime($row['date'])); ?>
                        <?php
                        if($row['attachment']!='')
                        {
                            ?>
                            <a href="../school-admin/uploads/<?php echo $row['attachment']; ?>" target="_blank">Download Attachment
                            </a>
                        <?php
                        }
                        ?>
                    </span>

                </div>
            </a>
        </div>
    </div>
<?php
}
?>
