$(function(){

    $('.login-open').click(function(){        
        $('.login').hide();
    });
    
    /*Tooltip*/
    $("[rel='tooltip']").tooltip();
    
    /*Login to dashboard*/
    $('.dashboard-login').on('click',function(){        
        var $user=($('.user').val().toLowerCase()); 
        var $pass=($('.password').val().toLowerCase());
        if($user=='parents' && $pass=='parentsssort'){
            window.location.href="dashboard/parents/parents.php";             
        }       
        else if($user=='teacher' && $pass=='teacherssort'){
            window.location.href="dashboard/teacher/teacher.php";           
        }
        else if($user=='chairman' && $pass=='chairmanssort'){
            window.location.href="dashboard/chairman/chairman.php";            
        }
        else if($user=='principal' && $pass=='principalssort'){
            window.location.href="dashboard/principal/principal.php";            
        }
        else if($user=='school' && $pass=='schoolssort'){
            window.location.href="dashboard/school-admin/school-admin.php";            
        }        
        else if($user=='admin' && $pass=='adminssort'){
            window.location.href="../dashboard/admin/super-admin.php";            
        }
        else if($user=='fee' && $pass=='feessort'){
            window.location.href="dashboard/fee/school-fee.php";            
        }
        else{           
           $('#invalidLogin').modal('toggle');
        }
    });  
    
    var first = true;
    /*Login animation*/
    $('#signin').on('click',function(){        
        if(first){
            $('.mega-menu').animate({
             'right':'-70px',
                'display':'block'
            },'slow');
        }else{            
            $('.mega-menu').animate({
                'right':'-350px',                                
            },'slow');
        }        
        first=!first;        
    });
    /*sign In on responsive*/
    $(window).resize(function(){
        var wd= $(window).width();
        if(wd<1280)
        {            
            $('#signin').off('click');
            $('.mega-menu').css({
                'position':'relative',
                'right':'',
                'left':'-400px',
                'top':'5px'
            });
            
            $('#signin').on('click',function(){
                if(first){
                $('.mega-menu').animate({
                    'left':'-40px',
                    'display':'block'
                },'slow');
                }else{            
                    $('.mega-menu').animate({
                        'left':'-400px',                                
                    },'slow');
                }        
                first=!first; 
            });
        } 
        
        
        /*en if*/
   });
    
    /*Set logo*/
    $(document).on('scroll',function(){
        var $brand=$('.logo');
        if($(this).scrollTop()>400)
            {
                $brand.css('margin-top','10px');
            }
        else if($(this).scrollTop()<=400)
            {
                $brand.addClass('logo-mob');
            }
    });
    
    /*smooth scroll*/
    $(document).on('click', 'a.enquire', function(event){
    event.preventDefault();
    $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top-60
    }, 3000);
        console.log(scrollTop);
   });
    
    $(document).on('click', 'a.lmore', function(event){
    event.preventDefault();
    $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top-60
    }, 1000);
   });
    
    /*load welcome modal on page load*/
    $("#ssortWelcome").modal('show');
    
});



									
