<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Admin | Student Approval Status</title>
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

    } else {
        echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
    }
    ?>
    <?php include '../includes/header-configuration.php'; ?>
    <!--sidebar nav st-->
    <?php include '../includes/sidebar-school.php'; ?>
    <!--sidebar nav en-->
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
            <!-------------------FOR CIRCULAR ACTIVITIES ON HEADER---------------------------------->
            <?php include '../includes/header-notice.php'; ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 my-box">
                    <!--<a href="javascript:void(0)"
                       class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span
                            class="fa fa-backward"></span> Back</a>-->

                    <h3 class="m-b-20">Student Approval Status
                        <a href="javascript:void(0)"
                           class="btn btn-theme bord-radius pull-right text-white back-webpage input-sm"><span
                                class="fa fa-backward"></span> Back</a>
                    </h3>
                    <div id="alertmessage"></div>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Application No.</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Section</th>
                                        <th class="text-nowrap">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($appdata as $appvlue) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $appvlue['usr_application_no'];?></td>
                                            <td><?php echo $appvlue['usr_fname'];?></td>
                                            <td>
                                                <select class="form-control input-sm" id="class<?php echo $i; ?>">
                                                    <option
                                                        value="<?php echo $appvlue['usr_class_id']; ?>"><?php echo $appvlue['class_name'];?></option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control input-sm section_valid" id="section<?php echo $i; ?>">

                                                    <option value="">Select</option>
                                                    <?php
                                                    $appvlue['section'] = substr(trim($appvlue['section']), 0, -1);
                                                    $secarr = explode(",", $appvlue['section']);

                                                    $appvlue['sec_id'] = substr(trim($appvlue['sec_id']), 0, -1);
                                                    $secidarr = explode(",", $appvlue['sec_id']);
                                                    $y = 0;
                                                    foreach ($secarr as $secvlue) {
                                                        ?>
                                                        <option
                                                            value="<?php echo $secidarr[$y]; ?>"><?php echo $secvlue;?></option>
                                                        <?php
                                                        $y++;
                                                    }
                                                    ?>
                                                </select>

                                            </td>
                                            <td class="text-nowrap">
                                                <div class="input-group">
                                                    <a href="javascript:void(0)"
                                                       class="input-group-addon fa-check-color">
                                                        <span class="fa fa-check"></span>
                                                    </a>
                                                    <button type="button" class="btn btn-info btn-theme approve"
                                                            id="buttun<?php echo $i; ?>"
                                                            data-id="<?php echo $appvlue['usr_application_id']; ?>">
                                                        Approve
                                                    </button>
                                                    <!--data-toggle="modal" data-target="#submitResponse" -->
                                                </div>
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
                        <!--en col-->
                    </div>
                    <!--en row-->
                </div>
                <!--col-12-en-->
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
    $(".approve").click(function (e) {
        /*var valid = $(".section_valid").val();
        if(valid == ""){
            $("#alertmessage").html("<h4>Please Select Section</h4>");
            return false;
        }*/
        var action = 'approvestatus';
        var session = '<?php echo $_SESSION['USER']['DB_NAME']; ?>';
        var txtElement = $(this).attr("data-id");
        var Id = $(this).attr("id");
        var lastChar = Id.substr(Id.length - 1);
        var cls = $("#class" + lastChar + "").val();
        var sec = $("#section" + lastChar + "").val();
        var dataString = 'element=' + txtElement + '&id=' + Id + '&session=' + session + '&cls=' + cls + '&sec=' + sec + '&action=' + action;
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
                    } else if (data == 5) {
                        //alert("Successfully");
                        $("#preloader").css("display", "none");
                        //$('.loginform .user').val("");
                        //$('.loginform .password').val("");
                        //alert("Student approval Success");
                        window.location.reload();
                    }
                }
            }

        });

    });
</script>
</body>
</html>

