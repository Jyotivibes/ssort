<?php
require_once("classes/connection.php");
require_once('../classes/general_class.php');
$obj = new General();

if(@$_GET['code']){
@$getEmail = $_GET['email'];
@$getCode = $_GET['code'];

$query = mysql_query("SELECT * FROM essort_user_header WHERE usr_email='".$getEmail."'");
while($row = mysql_fetch_array($query)){
    //$dbcode = $row['password_reset'];
    $dbmail = $row['usr_email'];
    $usr_pass_code = $row['usr_pass_code'];
}
if($getEmail == $dbmail && $getCode == $usr_pass_code){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SSORT - Smart Solutions on Realtime Technologies</title>
    <!--include head st-->

    <?php
    require_once('classes/config.php');
    include '../includes/head.php';

    ?>
    <!--include head en-->
</head>
<body style="background-image: url(../img/login-bg.jpg); width: 100%; background-position: center center; background-size: cover;
    background-repeat: no-repeat;
    height: 100%;">
<!-- full bg st -->
<section>
    <div class="container">
        <div class="row">
            <div class="wrapper"><!--wrapper st-->
                <div class="login-message">
                    <div class="col-sm-9 col-xs-12">
                        <h3 class="login-text"><span>Best School Management System for a 360 Degree Visibility and Administration of your Institution.</span></h3>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <div class="social social-icons">
                            <a href="javascript:void(0)" class="btn btn-facebook" rel="tooltip" data-original-title="Facebook">
                                <i aria-hidden="true" class="fa fa-facebook"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-twitter" rel="tooltip" data-original-title="Twitter">
                                <i aria-hidden="true" class="fa fa-twitter"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-googleplus" rel="tooltip" data-original-title="Google plus">
                                <i aria-hidden="true" class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div><!--en login-message-->


                <!--login st-->
                <div id="outer">
                    <div id="blueDiv">
                        <h2 class="text-center txt-white">Reset Password</h2>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-group">
                                <label for="newpassword">New password</label>
                                <input type="password" class="form-control" placeholder="Enter New Password" name="resetpass">
                            </div>
                            <div class="form-group">
                                <label for="confirmpassword">Confirm password</label>
                                <input type="password" class="form-control" id="confirmpassword" placeholder="Re Enter password" name="cpass">
                                <input type="hidden" name="emailmatch" value="<?php echo $dbmail; ?>">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-default" name="update_pass">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--login en-->
            </div><!--en wrapper-->
        </div>
    </div>
</section>

<!--include footer st-->
<?php include '../includes/foot.php'; ?>
<!--include footer en-->
</body>
    </html>
<?php
}
else{
    ?>
    <script>
        alert("This link has been expired");window.location.href=('index.php');
    </script>
<?php
}

}
if(isset($_POST['update_pass'])){
    $newpass = $_POST['resetpass'];
    $cpass= $_POST['cpass'];
    $email = $_POST['emailmatch'];
    @$code = $_GET['code'];

    if($newpass == $cpass){
        $enc_pass= md5($newpass);
        mysql_query("UPDATE essort_user_header SET password='".md5($newpass)."' WHERE usr_email='".$email."'");
        mysql_query("UPDATE essort_user_header SET usr_pass_code=0 WHERE usr_email='".$email."'");
        ?>
        <script>
            alert("Your Password has been updated");window.location.href=('index.php');
        </script>
<?php
    }
}
elseif(@$_GET['code']== ""){
    echo "<script>window.location.href='index.php';</script>";
}
?>

