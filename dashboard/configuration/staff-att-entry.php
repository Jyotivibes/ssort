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
        //include_once "stastics.php";
        $attid = $obj->ADDATTENDANCESTAFFID();

        if(isset($_POST['card_no'])){
            $cardno = $obj->ADDCARDNUMBER();
            if($cardno == 1){
                $formErr='Attendance Number Added successfully';
                $reurl='staff-att-entry.php';
            }
            else{
                echo "<script>alert('Error');location.reload();</script>";
            }
        }
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

                    <h3 class="m-b-20">Staff Card Number Entry
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
                                        <th>Staff Name</th>
                                        <th>Emp Id</th>
                                        <th>Edit</th>
                                        <th class="att_id" style="display: none;">Attendance Id</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($attid as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $row['usr_fname']." ".$row['usr_mname']." ".$row['usr_lname'];?></td>
                                            <td>
                                                <?php echo $row['emp_id']; ?>
                                            </td>
                                            <td>
                                                <a data-toggle="modal" class="update"
                                                   data-id="<?php echo $row['usr_id'];?>">
                                                    <i class=" fa fa-pencil" style="cursor: pointer;" aria-hidden="true"></i>
                                                </a>
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
</div>
<!--en wrapper-->
<?php include '../includes/foot.php'; ?>
<!---------MODAL FOR EENTER CARD NUMBER------------->
<div class="modal fade" id="myModalasa" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form method="post" action="" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header modal-header-1">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Card Number entry</h4>
                </div>
                <div class="modal-body">
                    <div id="alertmsg"></div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Card Number:</label>
                        <div class="col-sm-5">
                            <input type="hidden" id="att_id" class="form-control" value="" name="userid">
                            <input type="text" id="cardnumber" class="form-control" autocomplete="off"  name="cardnumber">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" name="card_no" class="btn btn-info">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $( ".update" ).click(function() {
            var id = $(this).attr("data-id");
            $("#att_id").val(id);
            $("#myModalasa").modal("show");
        });
    });
    jQuery(document).ready(function(){
       /* var cardno = jQuery("#cardnumber").val();
        if(cardno == ""){
            jQuery("#alertmsg").html("Enter Card No.");
            jQuery("#alertmsg").focus();
            return false;
        }*/
        jQuery("#cardnumber").keyup(function(){
            var cardno = jQuery("#cardnumber").val();
            if(cardno=='')
            {
                $("#alertmsg").html("");
                return false;
            }
            $.ajax({
                url: "<?php echo HTTP_SERVER; ?>ajax.php?action=cardentry&session=<?php echo $_SESSION['USER']['DB_NAME']; ?>",
                type: "POST",
                data:{
                    cardno : cardno
                },
                success:function(data){
                    if(data == 1){
                        $("#alertmsg").html("This card number is already exist.");
                        /*$("#cardnumber").focus();
                        return false;*/
                        $("#submit").attr('disabled',true);
                        //this.submit();
                    }
                    else{
                        $("#alertmsg").html("");
                        $("#submit").attr('disabled',false);
                    }
                }
            })

        })
    })
</script>
</body>
</html>

