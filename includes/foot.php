<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/modernizer.js"></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/custom.js"></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/retina-1.1.0.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/imagesloaded.pkgd.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/smoothscroll.js" ></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/jquery.singlePageNav.min.js" ></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/jquery.mobile-events.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/jquery.slider.js"></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/jquery.inview.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/nivo-lightbox.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/controller.js"></script>

<script type="text/javascript" src="<?php echo HTTP_SERVER;?>js/jquery-ui.js"></script>
<!--<script type="text/javascript" src="<?php /*echo HTTP_SERVER;*/?>js/jquery-1.12.4.js"></script>-->



                            
							
							
 <script type="text/javascript">
////// Login Form validation CHECKOUT
function loginformValidationCheckout(){
//alert('hiii');
	if($(".loginform .user").val()==''){
		alert("Please enter your email address");
		$(".loginform .user").focus();
		return false;
	}
	//if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test($('.loginform .user').val()))) 
	//{
		//alert('Invalid Email ID. Please enter the correct Email ID.');
		//$(".loginform .user").focus();
		//return false;
	//}
	if($(".loginform .password").val()==''){		
		alert("Please enter password");
		$(".loginform .password").focus();
		return false;
	}
	if($(".loginform .dbname").val()==''){		
		alert("DB Not Exist");
		$(".loginform .dbname").focus();
		return false;
	}
	//$("#preloader").css("display","block");
	var user_email = $('.loginform .user').val();
	//alert(user_email);
	var user_password = $('.loginform .password').val();
	var user_dbname = $('.loginform .dbname').val();
	//alert(user_dbname);
	var xhr=$.post("<?php echo HTTP_SERVER;?>ajax.php",{action:'userlogin',user_email:user_email,user_password:user_password,user_dbname:user_dbname});
			xhr.done(function(data){
			//alert(data);
			if(data!="")
				{
					//window.location.reload();
					if(data==1){
						alert("Please enter email and password");
						$("#preloader").css("display","none");
						return false;
					}else if(data==9){
						alert("The email or password you entered is incorrect");
						$("#preloader").css("display","none");
						return false;
					}else if(data==3){
						alert("Your email address is not verified yet");
						$("#preloader").css("display","none");
						return false;
					}else if(data==5){
						//alert("Login Successfully");
						$("#preloader").css("display","none");
						$('.loginform .user').val("");
						$('.loginform .password').val("");
						window.location.reload();
					}
				}
			});
			xhr.fail(function(data){
			//alert("error in network for login");
			$("#preloader").css("display","none");
			return false;
			});
			return false;
}
/////////////////////////////

function loginformValidationChairman(){
//alert('hiii');
	if($(".loginform .user").val()==''){
		alert("Please enter your email address");
		$(".loginform .user").focus();
		return false;
	}
	if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test($('.loginform .user').val()))) 
	{
		alert('Invalid Email ID. Please enter the correct Email ID.');
		$(".loginform .user").focus();
		return false;
	}
	if($(".loginform .password").val()==''){		
		alert("Please enter password");
		$(".loginform .password").focus();
		return false;
	}
	if($(".loginform .dbname").val()==''){		
		alert("DB Not Exist");
		$(".loginform .dbname").focus();
		return false;
	}
	//$("#preloader").css("display","block");
	var user_email = $('.loginform .user').val();
	//alert(user_email);
	var user_password = $('.loginform .password').val();
	var user_dbname = $('.loginform .dbname').val();
	//alert(user_dbname);
	var xhr=$.post("<?php echo HTTP_SERVER;?>ajax.php",{action:'chairmanlogin',user_email:user_email,user_password:user_password,user_dbname:user_dbname});
			xhr.done(function(data){
			//alert(data);
			if(data!="")
				{
					//window.location.reload();
					if(data==1){
						alert("Please enter email and password");
						$("#preloader").css("display","none");
						return false;
					}else if(data==9){
						alert("The email or password you entered is incorrect");
						$("#preloader").css("display","none");
						return false;
					}else if(data==3){
						alert("Your email address is not verified yet");
						$("#preloader").css("display","none");
						return false;
					}else if(data==5){
						//alert("Login Successfully");
						$("#preloader").css("display","none");
						$('.loginform .user').val("");
						$('.loginform .password').val("");
						window.location.reload();
					}
				}
			});
			xhr.fail(function(data){
			//alert("error in network for login");
			$("#preloader").css("display","none");
			return false;
			});
			return false;
}

////// Contact Form validation CHECKOUT
function contactformValidationCheckout(){
//alert('hiii');

	if($(".contactform .name").val()==''){
		//alert("Please enter your Name");
		document.getElementById('alertmsg').value='Please enter your Name';
		$(".contactform .name").focus();
		return false;
	}
	//if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test($('.loginform .user').val()))) 
	//{
	//	alert('Invalid Email ID. Please enter the correct Email ID.');
	//	$(".loginform .user").focus();
	//	return false;
	//}
	if($(".contactform .email").val()==''){		
		//alert("Please enter email");
		$(".contactform .email").focus();
		return false;
	}
	if($(".contactform .subject").val()==''){		
		//alert("Please enter Subject");
		$(".contactform .subject").focus();
		return false;
	}
	//$("#preloader").css("display","block");
	var user_email = $('.contactform .email').val();
	//alert(user_email);
	var user_name = $('.contactform .name').val();
	var user_subject = $('.contactform .subject').val();
	var user_message = $('.contactform .msg').val();
	//alert(user_name);
	var xhr=$.post("<?php echo HTTP_SERVER;?>ajax.php",{action:'contactus',user_name:user_name,user_email:user_email,user_subject:user_subject,user_message:user_message});
			xhr.done(function(data){
			//alert(data);
			if(data!="")
				{
					//window.location.reload();
					if(data==1){
						alert("Please enter email and password");
						$("#preloader").css("display","none");
						return false;
					}else if(data==0){
						alert("Network Error.Please Try Again");
						$("#preloader").css("display","none");
						return false;
					}else if(data==5){
						alert("Sent Successfully");
						$("#preloader").css("display","none");
						return false;
					}
				}
			});
			xhr.fail(function(data){
			//alert("error in network for login");
			$("#preloader").css("display","none");
			return false;
			});
			return false;
}
//#####################################AUTOCOMPLTE########################################
function autocomplet() {
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#country_id').val();
	var action='autocomplete';
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {keyword:keyword,action:action},
			success:function(data){
			//alert(data);
				$('#country_list_id').show();
				$('#country_list_id').html(data);
			}
		});
	} else {
		$('#country_list_id').hide();
	}
}
//###########################

// set_item : this function will be executed when we select an item

 $(document).ready(function(){


     $(".set_itemclass").click( function()
         {
             alert('button clicked');
             var keyword = $(this).html();
             alert(keyword);
             var action='finddata';
             alert(keyword);

         }
     );
 });
		
//#################################################


  $(".submitmain").click( function()
           {
             //alert('button clicked');
			 var keyword = $('#tags').val();
               if(keyword.length == 0){
                   alert("No record found");
                   return false;
               }
		     var action='finddata';
               $.ajax({
                   url: "<?php echo HTTP_SERVER; ?>ajax.php?action=finddata",
                   type: "POST",
                   data: {
                       keyword: keyword
                   },
                   success: function (data) {
                       if(data == 0){
                           alert("No record found");
                           return false;
                       }
                       else{
                           window.location.href = "<?php echo HTTP_SERVER; ?>/"+data;
                       }
                   }
               });

           }
        );
</script>
<script>
    $(function () {
        var availableSchool = [
            <?php
$i = 0;
$size = count($list);
foreach($list as $key=>$row){
    echo '"'.$row['sch_name'].'"';
    echo ($size==++$i)?'':', ';
}
?>
        ];
        $("#tags").autocomplete({
            source: availableSchool
        });
    });

</script>
