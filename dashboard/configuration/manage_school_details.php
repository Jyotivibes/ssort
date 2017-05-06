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
<div id="wrapper">
<?php
if(isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID']=='SAD') )
{
    $dbnew = mysql_connect('localhost', 'ssort_school12', 'x5@q}nvg.vRK',TRUE);
	mysql_select_db("ssort_master", $dbnew);
    //include_once ('../../classes/group_class.php');
    //$obj = new GROUP();

    if(isset($_POST['update'])){
        if ($_FILES['image']['name'] != '' && $_FILES['image']['size'] > 0 || $_FILES['logo']['name'] != '' && $_FILES['logo']['size'] > 0) {
            $image = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
                move_uploaded_file($image_tmp, '../../img/' . $image);
            $logo = $_FILES['logo']['name'];
            $logo_tmp = $_FILES['logo']['tmp_name'];
                move_uploaded_file($logo_tmp, "../../" . $_SESSION['USER']['DB_NAME'] . "/uploads/" . $logo);
            }
            else {
                $image = $_REQUEST['imageOld'];
                $logo = $_REQUEST['logoOld'];

            }

        //$image="../img/".$image;
        $sqlupdt = mysql_query("
            UPDATE
                essort_school_info
            SET
                sch_background_image = '".$image."',
                sch_fb_link = '".$_POST['sch_fb_link']."',
                sch_twitter_link = '".$_POST['sch_twitter_link']."',
                sch_gplus_link = '".$_POST['sch_gplus_link']."',
                sch_linkedin = '".$_POST['sch_linked_link']."',
                sch_youtube = '".$_POST['sch_youtube_link']."',
                sch_logo = '".$logo."'
            WHERE
                sch_reg_no='" . $_SESSION['USER']['DB_NAME'] . "'
        ") ;

        if($sqlupdt == true){
            echo "Image uploaded";
        }
        else{
            mysql_error();
        }
    }
}
else
{
    echo "<script>window.location='".HTTP_SERVER."/index.php';</script>";
}
//$sql=mysql_query("SELECT * FROM essort_user_header WHERE usr_role='Principal' LIMIT 1");
//$row=mysql_fetch_array($sql);
?>
<?php include '../includes/header-configuration.php'; ?>

<!--sidebar nav st-->
<?php include '../includes/sidebar-school.php'; ?>
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

<?php include '../includes/header-notice.php'; ?>

<!--stu info st-->

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 my-box">
        <h3 class="m-b-20">Manage School Details</h3>

        <form method="post" name="stuform" action="" enctype="multipart/form-data" class="stuform"
              onsubmit="return validateStudent();">
            <div id="alertstumsg"></div>
            <!--accordian st-->
                <div class="panel panel-default">
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <fieldset class="newFieldset">
                                <div class="row">
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">School Image</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-image"></i></div>
                                                <input type="file" name="image" class="form-control input-sm class fileChooser" id="">
                                                <input name="imageOld" type="hidden" value="<?php echo $resultsch['sch_background_image']; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->

                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Facebook</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-facebook"></i></div>
                                                <input placeholder="Facebook Link" class="form-control input-sm class" value="<?php echo $resultsch['sch_fb_link'];?>" type="text" name="sch_fb_link">
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Twitter</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-twitter"></i></div>
                                                <input placeholder="Twitter Link" class="form-control input-sm class" value="<?php echo $resultsch['sch_twitter_link'];?>" type="text" name="sch_twitter_link">
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Google Plus</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-google-plus"></i></div>
                                                <input placeholder="Google+ Link" class="form-control input-sm class" value="<?php echo $resultsch['sch_gplus_link'];?>" type="text" name="sch_gplus_link">
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->
                                </div>
                                <!--en row-->

                                <div class="row">
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">LinkedIn</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-linkedin"></i></div>
                                                <input placeholder="Linked In" class="form-control input-sm class" value="<?php echo $resultsch['sch_linkedin'];?>" type="text" name="sch_linked_link">
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Youtube</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-youtube"></i></div>
                                                <input placeholder="Youtube" class="form-control input-sm class" value="<?php echo $resultsch['sch_youtube'];?>" type="text" name="sch_youtube_link">
                                            </div>
                                        </div>
                                    </div>
                                    <!--en col-3-->
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Logo</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-image"></i></div>
                                                <input type="file" name="logo" class="form-control input-sm class fileChooser" id="">
                                                <input name="logoOld" type="hidden" value="<?php echo $resultsch['sch_logo']; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--en row-->

                                    <!--en col-3-->

                                <!--en row-->
                                <div class="row">
                                    <div class="col-md-12 col-sm text-center">
                                        <!--<button type="submit" class="btn btn-success btn-theme m-r-10 bord-radius">Submit</button>-->
                                        <input type="submit" class="btn btn-success btn-theme m-r-10 bord-radius" value="Update" name="update">
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                    </div>
                </div>
            </form>
    </div>
</div><!--col-en-->

    <!--latest circular en-->
</div>
</div>
<?php include'../includes/footer.php'; ?>
<?php include '../includes/foot.php'; ?>
</body>
</html>

