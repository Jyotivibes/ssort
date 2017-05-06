<!-- Left navbar-header -->
<?php
if(isset($_POST['contactS']))
{
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    //$file = $_FILES['attach'];
    require_once('../../mismtc/PHPMailer-master/PHPMailerAutoload.php');

    $mail = new PHPMailer;

    //$mail->SMTPDebug = 1;                          // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                                                                                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ssort.sms@gmail.com';       // SMTP username
    $mail->Password = 'sms@ssort';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';

    $mail->From = 'noreply@gmail.com';
    $mail->FromName = 'Ssort';
    $mail->addAddress('shahbazkhan714@gmail.com');        // Add a recipient
    //$mail->AddAttachment($file);
    $mail->AddAttachment($_FILES['attach']['tmp_name'],
        $_FILES['attach']['name']);

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if (!$mail->send()) {
        echo 'Mail could not be sent.' . 'Mailer Error: ' . $mail->ErrorInfo;
    }
    else{
        echo "<script>alert('Message Send')</script>";
    }
}
?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li>
                <a href="../school-admin/school-admin.php" class="waves-effect bg-dashboard">
                    <img src="../images/icons/dashboard.png" class="icon-two-size">
                    <span class="hide-menu">Dashboard</span>
                    <span class="fa arrow"></span>
                </a>
            </li>
            <li>
                <a href="../school-admin/school-inbox.php" class="waves-effect bg-messages">
                    <img src="../images/icons/message.ico" class="icon-two-size">
                    <span class="hide-menu">Messages</span>
                    <span class="fa arrow"></span>
                </a>
            </li>
            <li>
                <a href="../school-admin/school-administration.php" class="waves-effect bg-assessment">
                    <img src="../images/icons/super_admin.png" class="icon-two-size">
                    <span class="hide-menu">Administration</span>
                    <span class="fa arrow"></span>
                </a>
            </li>

            <li>
                <a href="../school-admin/school-fee.php" class="waves-effect bg-fees">
                    <img src="../images/icons/fees.png" class="icon-two-size">
                    <span class="hide-menu">Fee</span>
                    <span class="fa arrow"></span>
                </a>
            </li>

            <li>
                <a href="../configuration/configuremaster.php" class="waves-effect bg-profile">
                    <img src="../images/icons/configure.png" class="icon-two-size">
                    <span class="hide-menu">Configuration</span>
                    <span class="fa arrow"></span>
                </a>
            </li>


            <li>
                <a href="javascript:void(0)" class="waves-effect bg-events" data-toggle="modal"
                   data-target="#myComposes">
                    <img src="../images/icons/event.ico" class="icon-two-size">
                    <span class="hide-menu">Contact SSORT</span>
                    <span class="fa arrow"></span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Left navbar-header end -->
<div class="modal fade" id="myComposes" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Message</h4>
            </div>
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Subject:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="subject">
                        </div>
                    </div>
                    <div class="form-group marg-bott">
                        <label for="textarea"  class="col-sm-2 control-label">Message:</label>
                        <div class="col-sm-10">
                            <textarea rows="5" class="message" name="message"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2 col-xs-12"></div>
                            <div class="col-sm-10">
                                <label class="btn btn-link pull-right marg-right">
                                    <span class="fa fa-paperclip"></span>
                                    Attachment <input class="hidden" name="attach" type="file">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 pull-right text-center">
                            <button type="submit" name="contactS" class="btn btn-default btn-color border-round"><i
                                    class="fa fa-paper-plane"></i> Send
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->