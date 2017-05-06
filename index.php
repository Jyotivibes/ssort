<?php
require_once('classes/config.php');
require_once('classes/connection.php');


require_once('classes/general_class.php');
$obj = new General();

?>
<!doctype html>
<!--[if lt IE 7]><html class="no-js ie6 oldie"><![endif]-->
<!--[if IE 7]><html class="no-js ie7 oldie"><![endif]-->
<!--[if IE 8]><html class="no-js ie8 oldie"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>SSORT - Smart Solutions on Realtime Technologies</title>
	<link rel="shortcut icon" href="img/favicons/favicon.ico" type="image/x-icon" />
	<!-- cdn font -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300' rel='stylesheet' type='text/css'>
    <?php include'includes/head.php'; ?>

	<script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>

<script>
    var recaptchaMail;
    var recaptchaDelete;
    var myCallBack = function()
	{
        //Render the recaptchaMail on the element with ID "recaptchaMail"
        recaptchaMail = grecaptcha.render('recaptchaMail', {
          'sitekey' : '6LcKThoUAAAAAHoD71bEqbtHEbECz_sKTPz90hzc' //Replace this with your Site key
        });
    };
</script>

</head>
<body id="demo2" data-skin="light">
	<!-- wrap start -->
	<div id="wrap">
		<!-- header start -->
		<?php include'includes/header.php'; ?>
		<!-- header end -->

		<!-- slider start -->
		<section class="slider" id="slider" data-transition="soft-scale">

			<div class="slider-loader">&nbsp;</div>

			<ul class="slides">

                <li id="slide_5" class="slide" data-parallax="true">
					<div class="slide-canvas container clearfix">
                        <div id="layer_4" class="layer" data-effect="fade-top">
							<img alt="" class="align-right" src="img/demo/elements.png" />
						</div>
						<div id="layer_3" class="layer" data-effect="fade-bottom">
							<h1 class="slide-title">School Management System</h1>
							<p class="slide-slogan">A unique smart solution to manage your school efficiently. It is an online system that provides better work flexbility and transparency between parents & school Management through user friendly online interface.</p>
							<a class="button enquire" href="#sec_contact">Enquire Now</a>
							<a class="button2 lmore" href="#sec_features">LEARN MORE</a>
						</div>
					</div>
				</li>

				<li id="slide_2" class="slide" data-parallax="true">
					<div class="slide-canvas container clearfix">

						<div id="layer_3" class="layer" data-effect="fade-bottom">
							<h1 class="slide-title">Online Accessible</h1>
							<p class="slide-slogan">SSORT’s solution works worldwide with no geographical boundaries. We provide the web based interface so that it will be monitored from anywhere / anytime.</p>
							<a class="button enquire" href="#sec_contact">Enquire Now</a>
							<a class="button2 lmore" href="#sec_features">LEARN MORE</a>
						</div>

						<div id="layer_4" class="layer" data-effect="fade-top">
							<img alt="" class="align-right" src="img/demo/onlineaccess.png">
						</div>

					</div>
				</li>

				<li id="slide_3" class="slide" data-parallax="true">
					<div class="slide-canvas container clearfix">

						<div id="layer_5" class="layer" data-effect="fade-right">
							<img alt="" src="img/demo/attendance.png">
						</div>

						<div id="layer_6" class="layer" data-effect="fade-left">
							<h1 class="slide-title">One Step Innovative Attendance Solution</h1>
							<p class="slide-slogan">SSORT’s attendance solution is designed with the latest techniques using RFID / Biometric to overcome daily challenges of student / staff attendance. With this solution, we connect school management / administrator, class teachers, parents & students seamlessly on daily basis.</p>
							<a class="button enquire" href="#sec_contact">Enquire Now</a>
							<a class="button2 lmore" href="#sec_features">LEARN MORE</a>
						</div>

					</div>
				</li>

				<li id="slide_1" class="slide" data-parallax="true">
					<div class="slide-canvas container clearfix">
						<div id="layer_6" class="layer" data-effect="fade-left">
							<h1 class="slide-title">Instant SMS Alert</h1>
							<p class="slide-slogan">An automatic SMS will be sent to parents on entry & exit of their child even in case of absent from school. Also, school can avail the facility to send SMS to parents for any event.</p>
							<a class="button enquire" href="#sec_contact">Enquire Now</a>
							<a class="button2 lmore" href="#sec_features">LEARN MORE</a>
						</div>

						<div id="layer_5" class="layer" data-effect="fade-right">
							<img alt="" src="img/demo/smsalert.png">
						</div>

					</div>
				</li>

				<li id="slide_4" class="slide" data-parallax="true">
					<div class="slide-canvas container clearfix">

						<div id="layer_5" class="layer" data-effect="fade-right">
							<img alt="" src="img/demo/payment.png">
						</div>

						<div id="layer_6" class="layer" data-effect="fade-left">
							<h1 class="slide-title">Online Payment Gateway</h1>
							<p class="slide-slogan">SSORT’s solution helps parents to pay school fees by using online payment gateway from anywhere / anytime. No need to stand in long queues at school or in bank. </p>
							<a class="button enquire" href="#sec_contact">Enquire Now</a>
							<a class="button2 lmore" href="#sec_features">LEARN MORE</a>
						</div>
					</div>
				</li>

			</ul>
		</section>
		<!-- slider end -->

		<!-- content start -->
		<section id="content">

			<!-- content boxes -->
			<section id="sec_features" class="section">
                <div class="row m-b-20">
                   <div class="col-sm-12 col-xs-12">
                        <h1 class="text-center m-b-30">FEATURES</h1>
                   </div>
                </div>
				<div class="child-element content-box clearfix" data-animate="true" data-columns="3">
					<div class="box">
						<div class="box-icon icon-graduation"></div>
						<h3 class="box-title">Online Admission Solution</h3>
						<div class="box-content">SSORT’s online admission solution helps school to reduce admission challenges like getting printed brochure, forms etc. Keeping records of forms submitted & other documents. Long queues at reception. Parents can apply online for their child’s admission and they will be notified via SMS & E-mail after draw at school. </div>
					</div>

					<div class="box">
						<div class="box-icon icon-bell"></div>
						<h3 class="box-title">Instant SMS Alert</h3>
						<div class="box-content">An automatic SMS will be sent to parents on entry & exit of their child even in case of absent from school. Also, school can avail the facility to send SMS to parents for any event.</div>
					</div>

					<div class="box">
						<div class="box-icon fa fa-male"></div>
						<h3 class="box-title">One Step Innovative Attendance Solution</h3>
						<div class="box-content">SSORT’s attendance solution is designed with the latest techniques using RFID / Biometric to overcome daily challenges of student / staff attendance. With this solution, we connect school management / administrator, class teachers, parents & students seamlessly on daily basis.</div>
					</div>

				</div>

				<div class="child-element content-box clearfix" data-animate="true" data-columns="3">

					<div class="box">
						<div class="box-icon icon-calendar"></div>
						<h3 class="box-title">Real Time Attendance</h3>
						<div class="box-content">SSORT provides fast, secure & accurate attendance information to management / administrator, class teachers & parents on-time with a single touch. This solution have web based interface, which can be monitored from anywhere / anytime.</div>
					</div>

					<div class="box">
						<div class="box-icon fa fa-inr"></div>
						<h3 class="box-title">Fee Automation</h3>
						<div class="box-content">SSORT’s Fee Automation solution minimizes the manual procedure which involves a lot of time & clerical work & manpower. This solution provides to collect multiple type of full/part payment of fees with ease & accuracy without any manual changes and duplicity. SMS notification will be sent to parents to remind them about due fees amount & date. </div>
					</div>

					<div class="box">
						<div class="box-icon fa fa-credit-card"></div>
						<h3 class="box-title">Online Payment Gateway</h3>
						<div class="box-content">SSORT’s solution helps parents to pay school fees by using online payment gateway from anywhere / anytime. No need to stand in long queues at school or in bank. Parents will get receipt on their E-mail & also will be notified via SMS after successful payment. School will also be notified on realtime basis on every payment made by any parent.</div>
					</div>

				</div>

				<div class="child-element content-box clearfix" data-animate="true" data-columns="3">

					<div class="box">
						<div class="box-icon fa fa-laptop"></div>
						<h3 class="box-title">Online Accessible</h3>
						<div class="box-content">SSORT’s solution works worldwide with no geographical boundaries. We provide the web based interface so that it will be monitored from anywhere / anytime.</div>
					</div>

					<div class="box">
						<div class="box-icon fa fa-cogs"></div>
						<h3 class="box-title">Less Admin Work</h3>
						<div class="box-content">SSORT’s solution is designed to eliminate manual work related to attendance & fees collection system and other school’s day to day activities. </div>
					</div>

					<div class="box">
						<div class="box-icon fa fa-clock-o"></div>
						<h3 class="box-title">Time & Cost Saving</h3>
						<div class="box-content">SSORT is an economical solution designed to increase efficiency, reduce costs & help the schools in managing day-to-day challenges.</div>
					</div>

				</div>

				<div class="child-element content-box clearfix" data-animate="true" data-columns="3">

					<div class="box">
						<div class="box-icon fa fa-lock"></div>
						<h3 class="box-title">Safe & Secure</h3>
						<div class="box-content">SSORT solution is helping our customers to manage their day to day work safe & secure. It helps to create an environment of confidence and helps management to feel secure. This innovative solution ensures safety & security of school’s confidential data.</div>
					</div>

					<div class="box">
						<div class="box-icon fa fa-users"></div>
						<h3 class="box-title">Teacher’s & Student’s Training</h3>
						<div class="box-content">SSORT believes quality in education system hence we designed teacher’s training program in collaboration with “Big Brain” on advance teaching techniques so that every teacher will start using new techniques available internationally. Also, we will provide training to class 10th & 12th students to choose right path in their career.  </div>
					</div>

					<div class="box">
						<div class="box-icon fa fa-file"></div>
						<h3 class="box-title">Online Result Solution</h3>
						<div class="box-content">SSORT will provide online result solution to provide mark sheet of student to their parents via E-mail. Teachers require to capture marks in our result module and system will generate the mark sheet.</div>
					</div>

				</div>

				<div class="child-element content-box clearfix" data-animate="true" data-columns="3">

					<div class="box">
						<div class="box-icon icon-bars"></div>
						<h3 class="box-title">Result Assessment Solution</h3>
						<div class="box-content">SSORT believes every teacher & student is special and has their own quality. By using our Intelligence solution in collaboration with “Cloud Signals” we help school management to know well in advance about weakness & strong area of their teachers. </div>
					</div>

					<div class="box">
						<div class="box-icon fa fa-envelope"></div>
						<h3 class="box-title">Messenger</h3>
						<div class="box-content">SSORT in collaboration with “Cloud Signals” will provide messenger platform between teachers & parents without knowing each other’s mobile number.</div>
					</div>

					<div class="box">
						<div class="box-icon icon-pie"></div>
						<h3 class="box-title">Reporting</h3>
						<div class="box-content">SSORT provide attendance reports on Daily /Weekly /Monthly /Quarterly /Yearly basis. The reports will be viewed easily by management, parents and other staff members. Reports can be shared / viewed via PDF or can be downloaded as excel sheet.</div>
					</div>

				</div>
			</section>

			<!-- animated sections -->
			<section id="demo-animated-sec" class="section" data-layout="100%" data-cover="true" data-fixed="false" data-parallax="true" data-animate="true" data-content="50%">
				<div class="container">
					<div id="layer_11" class="layer" data-effect="fade-left">
						<h1 class="title title-main">About Us</h1>
						<p class="slogan text-justify">Opstand Solutions is the leading business integrator & end-to-end solution provider. Opstand's unique solutions empower its customers to achieve more by optimizing costs, increasing revenue and reducing time to value so they can always deliver on their customer promises.</p>
						<p class="slogan text-justify">With unwavering customer passion and unmatched industry expertise built on a rich heritage of growth, innovation and market leadership, Opstand Solutions is laser-focused on creating customer value and making businesses more safe & secure, efficient, sustainable & profitable.</p>
						<a class="button enquire" href="#sec_contact"><i class="icon-download"></i>Enquire Now</a>
						<a class="button2 lmore" href="#sec_features">LEARN MORE</a>
					</div>
					<div id="layer_12" class="layer" data-effect="fade-right">
						<img alt="" src="img/demo/monitor1.png">
					</div>
				</div>
			</section>


			<!-- pricing table -->
			<section id="sec_pricing" class="section text-align-center">
				<h1 id="pricing-title" class="title-main">Sales Enquiry</h1>
				<p id="pricing-slogan">We offer best price as per your requirement. Take a step toward to digitalization of education system now!!. We are available to serve you. </p>
				<p>you can also email us at  <a href="#"><span class="fa fa-envelope"></span> info@opstand.in</a></p>
				<div class="i-separator animate clearfix"><i class='fa fa-inr'></i></div>
			</section>

			<!-- testimonials -->
			<section id="sec_testimonials" class="section" data-layout="100%" data-cover="true" data-fixed="true" data-parallax="false">
				<div class="container">
					<div class="child-element testimonials" >
						<div class="testimonial">
							<div class="text"><strong>"</strong> Education System is going to be vast and preferred educational technologies to the Globe. <br>Bringing the value for today and tomorrow’s school. <strong>"</strong>
							</div>
							<img alt="" src="img/demo/testimonial_1.jpg" />
							<span class="name">Ranjana Singh</span>
							<span class="title">Business Head</span>
						</div>
						<div class="testimonial">
							<div class="text"><strong>"</strong> Education System is going to be vast and preferred educational technologies to the Globe. <br>Bringing the value for today and tomorrow’s school. <strong>"</strong>
							</div>
							<img alt="" src="img/demo/testimonial_2.jpg">
							<span class="name">Puneet Gupta</span>
							<span class="title">Education Manager</span>
						</div>
						<div class="testimonial">
							<div class="text"><strong>"</strong> Education System is going to be vast and preferred educational technologies to the Globe. <br>Bringing the value for today and tomorrow’s school. <strong>"</strong>
							</div>
							<img alt="" src="img/demo/testimonial_3.jpg">
							<span class="name">michael Yogi</span>
							<span class="title">Executive</span>
						</div>
					</div>
				</div>
			</section>

            <!-- contact form -->
            <section id="sec_contact" class="section text-align-center" data-layout="100%" data-cover="false" data-fixed="false"
                     data-parallax="false">
                <div class="container">

                    <h1 id="contact-title" class="title-main">Get in touch</h1>

                    <p id="contact-slogan">Say hello or leave a feedback for our service. We will reply during 24 hours.</p>

                    <div class="i-separator animate clearfix"><i class='icon-envelope'></i></div>
                    <br>

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <h1 class="title-main text-form"><strong>For Query</strong> Assistance</h1>

                            <form method="post" action="">
                                <div class="row">
                                    <div id="alertmsg"></div>
                                    <div class="col12" data-animate="true" data-effect="fade-bottom">
                                        <input type="text" id="name" name="uname" class="name" data-icon="icon-user2" placeholder="Name">
                                    </div>
                                    <div class="col12" data-animate="true" data-effect="fade-bottom">
                                        <input type="email" id="email" name="uemail" data-icon="icon-envelope2" placeholder="Email">
                                    </div>
                                    <div class="col12" data-animate="true" data-effect="fade-bottom">
                                        <input type="text" id="subject" name="subject" data-icon="icon-tag2" placeholder="Subject">
                                    </div>
                                    <div class="col12" data-animate="true" data-effect="fade-bottom">
                                        <textarea class="texta-resize msg" id="message" name="message" required data-icon="icon-comments"
                                                  placeholder="Message"></textarea>
                                    </div>
                                    <div class="capta-wrap col12">
                                        <div id="recaptchaMail"></div>
                                        <span class="captcha" style="color: red;font-size:12px;text-align:right;"> </span>
                                    </div>
                                    <div class="col12 text-align-center" data-animate="true" data-effect="scale">
                                        <button id="submit" type="submit"  onclick="//return contactformValidationCheckout();"><span class="icon-paperplane"></span> Send message</button>

                                    </div>

                                </div>
                            </form>
                        </div>
                        <!--en col-->

                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <h1 class="title-main text-form"><strong>Join</strong> Us</h1>

                            <form method="post" action="">
                                <div class="row">
                                    <div id="alertmsgg"></div>
                                    <div class="col12" data-animate="true" data-effect="fade-bottom">
                                        <input type="text" id="jname" name="name" data-icon="icon-user2" placeholder="Name">
                                    </div>
                                    <div class="col12" data-animate="true" data-effect="fade-bottom">
                                        <input type="text" id="jphone" name="phone" required data-icon="icon-phone" placeholder="Phone">
                                    </div>
                                    <div class="col12" data-animate="true" data-effect="fade-bottom">
                                        <input type="email" id="jemail" name="email" data-icon="icon-envelope2" placeholder="Email"
                                               required>
                                    </div>
                                    <div class="col12" data-animate="true" data-effect="fade-bottom">
                                        <textarea class="texta-resize" id="jmessage" name="message" required data-icon="icon-comments"
                                                  placeholder="Message"></textarea>
                                    </div>
                                    <!--<div class="capta-wrap col12">
                                        <div id="recaptchaMail"></div>
                                        <span class="captcha" style="color: red;font-size:12px;text-align:right;"> </span>
                                    </div>-->
                                    <div class="col12 text-align-center" data-animate="true" data-effect="scale">
                                        <button type="submit" id="jsubmit" name="jsubmit"><i class="fa fa-plus"></i> Join Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--en col-->
                    </div>
                    <!--en row-->
                </div>
            </section>
            <!-- counter here -->

		</section>
		<!-- content end -->

		<!-- footer start -->
		<?php include'includes/footer.php'; ?>
		<!-- footer end -->

	</div>

	<!-- wrap end -->
<a class="icon-arrow-up7" id="top" href="#wrap"></a>

<?php include'includes/foot.php'; ?>
<!--modal st-->
<!--
<div id="ssortWelcome" class="modal fade topWelcome">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-center">WELCOME TO SSORT</h4>
            </div>
            <div class="modal-body">
				<p class="text-center">Opstand Solutions is the leading business integrator & end-to-end solution provider. </p>                
            </div>
            <div class="modal-footer btn-center">
                <a href="javascript:void(0);" type="submit" class="btn btn-primary">OK</a>
            </div>
        </div>
    </div>
</div>
-->
<!--modal en-->
<script>
    jQuery(document).ready(function(){
        jQuery(":input").keyup(function(){
             jQuery("#alertmsg").text(" ");
        });
        jQuery("#submit").click(function(){
            var name = jQuery("#name").val();
            var email = jQuery("#email").val();
            var subject = jQuery("#subject").val();
            var message = jQuery("#message").val();
            var response = grecaptcha.getResponse();

            if(name == ""){
                jQuery("#alertmsg").html("Please insert Your Name");
                jQuery("#name").focus();
                return false;
            }
            else if(email == ""){
                jQuery("#alertmsg").html("Please insert Email Id");
                jQuery("#email").focus();
                return false;
            }
            else if(subject == ""){
                jQuery("#alertmsg").html("Please insert Subject");
                jQuery("#subject").focus();
                return false;
            }
            else if(message == ""){
                jQuery("#alertmsg").html("Please insert Message");
                jQuery("#message").focus();
                return false;
            }
            /*else if(response.length == 0){
                jQuery("#alertmsg").html("Please Verify Captcha");
                return false;
            }*/
            else{
                //alert("hello");
                window.location.href ='thank-you.php';
            }
        })
        jQuery("#jsubmit").click(function(){
            var name = jQuery("#jname").val();
            var phone = jQuery("#jphone").val();
            var email = jQuery("#jemail").val();
            var message = jQuery("#jmessage").val();
            var response = grecaptcha.getResponse();
            if(name == ""){
                jQuery("#alertmsgg").html("Please Enter Your Name");
                jQuery("#jname").focus();
                return false;
            }
            else if(phone == ""){
                jQuery("#alertmsgg").html("Please Enter Your Phone Number");
                jQuery("#jphone").focus();
                return false;
            }
            else if(email == ""){
                jQuery("#alertmsgg").html("Please Enter Your  Email Id");
                jQuery("#jemail").focus();
                return false;
            }

            else if(message == ""){
                jQuery("#alertmsgg").html("Please Enter Your Message");
                jQuery("#jmessage").focus();
                return false;
            }
            /*else if(response.length == 0){
                jQuery("#alertmsg").html("Please Verify Captcha");
                return false;
            }*/
            else{
                alert("hello");
                window.location.href ='thank-you.php';
            }
        })
            $("#name").keypress(function (e){
                var code =e.keyCode || e.which;
                if((code<65 || code>90)
                    &&(code<97 || code>122)&&code!=32&&code!=46)
                {
                    //alert("Only alphabates are allowed");
                    return false;
                }
            });
    })
</script>

</body>
</html>