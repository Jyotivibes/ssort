<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Configuration | Subject Allocation</title>
    <?php include '../includes/head.php'; ?>
</head>
<body>
<div id="wrapper">
    <?php include '../includes/header-configuration.php'; ?>
    <?php include '../includes/sidebar-configuration.php'; ?>
    <?php
    if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'SAD')) {
        $user_id = $_SESSION['USER']['USER_NAME'];
        require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
        require_once('../../classes/general_class.php');
        $obj = new General();
        /*$sql = mysql_query("select * from essort_classes ec
        INNER JOIN essort_section es
        INNER JOIN essort_subject_master esc
        ON
        ec.class_id = es.class_id");*/
        $sql = mysql_query("select * from essort_section es
        INNER JOIN essort_classes ec
        ON
        ec.class_id = es.class_id");
        $sbjct = mysql_query("select * from essort_subject_master");
        $array = array();
        while ($data = mysql_fetch_array($sbjct)) {
            //$data = $array;
            $array[] = $data;
        }
        if (isset($_POST['submit'])) {
            $suballoc = $obj->SUBJECTALLOCATION();
            if($suballoc ==1){
            echo "<script>alert('Subject Allocated Successfully');</script>";
            }
            elseif($suballoc == 2){
            echo "<script>alert('Query Error');</script>";
            }


            /*print_r($sec);
            echo "<pre>";
            echo "<br/>";
            print_r($sub);
            echo "<pre>";*/
        }
        //echo '<script>window.location="http://localhost/sms/dashboard/teacher/teacher.php"</script>';
    } else {
        echo "<script>window.location='http://localhost/ssort/index.php';</script>";
    }
    //SELECT SCHOOL NAME

    ?>

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
            <?php include_once("../includes/header-notice.php"); ?>

            <div class="row">
                <div class="col-sm-12 my-box">
                    <h3>Subject Allocation</h3>

                    <!--st element-->
                    <div class="row m-t-20">
                        <div class="col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <form method="post" name="myform" action="" onsubmit="return checkCheckBoxes(this);">
                                    <table
                                        class="table table-bordered color-table primary-table subject-alocation-wrap">
                                        <thead>
                                        <tr>
                                            <th>Class</th>
                                            <th>Section</th>
                                            <th colspan="10" class="text-center">Subject</th>
                                            <!--<th></th>
                                            <th></th>-->
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        while ($row = mysql_fetch_array($sql)) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $row['class_name']; ?></td>
                                                <input type="hidden" name="section_id[]"
                                                       value="<?php echo $row['section_id']; ?>">
                                                <td class="text-center"><?php echo $row['section_name']; ?></td>
                                                <?php
                                                foreach ($array as $val) {
                                                    ?>
                                                    <td>
                                                        <label class="checkbox-inline">
                                                           <input type="checkbox" class="is_checked"
                                                                   name="subject_id[<?php echo $row['section_id'] ?>][]"
                                                                   value="<?php echo $val['sub_id']; ?>"><?php echo $val['sub_name']; ?>
																   <!--<select>
																   <option></option>
																   </select>-->
                                                        </label>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                        <!--<tr>
                                            <td class="text-center">1</td>
                                            <td class="text-center">B</td>
                                            <td>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    1</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    2</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>

                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="text-center">C</td>
                                            <td>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    1</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    2</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="">Option
                                                    3</label>


                                            </td>

                                        </tr>-->
                                        <tr>

                                            <td colspan="11" align="center" >
                                                <button type="submit" name="submit" id="submit_subj"
                                                        class="btn btn-info bord-radius btn-theme">Save
                                                </button>

                                                <input type="checkbox" name="submit" id="select_all"
                                                       class="btn btn-info bord-radius btn-theme" style="margin: 0;">
                                                <label for="submit">Select All</label>
                                            </td>
                                            <!--<td colspan="" align="right">

                                            </td>-->
                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <!--en table responsive-->
                            <!--en table responsive-->
                        </div>
                        <!--en col-->
                    </div>
                    <!--en row-->
                    <!--en element-->
                </div>
            </div>
            <!--en row-->
        </div>
    </div>
    <!--en page-wrapper-->
    <?php include'../includes/footer.php'; ?>
</div>
<!--en wrapper-->
<?php include '../includes/foot.php'; ?>
<script type="text/javascript">
    $("#submit_subj").click(function () {

        var subject_validation = 0;
        $(".is_checked:checked").each(function () {
            subject_validation = 1;
        });
        if (subject_validation == 0) {
            alert("Please checked atleast one subject");
            return false;
        }
    });
    $("#select_all").click(function(){
        $(".is_checked").prop('checked', $(this).prop('checked'));
    });
</script>
</body>
</html>

