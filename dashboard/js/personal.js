$(function(){        
 $('.open-close').on('click',function(){        
   var colors = ['bg-dboard','bg-mess','bg-attend','bg-fe','bg-ev','bg-noti','bg-pro','bg-assess'];     
     var index=0;
        $('#side-menu > li > a').each(function() {                          
            if (index < colors.length) {                
                $(this).toggleClass(colors[index]);
                index++;
            }
        });
     $('#side-menu li').toggleClass('rem-bborder');     
     $('.hide-menu + span').toggleClass('arrow-show');
 });
    /*Tooltip*/
    
    $("[rel='tooltip']").tooltip();
    
    /*sunny*/
    $('[data-toggle="tooltip"]').tooltip();   
    
  /*Current date st*/
   var date=mdy();
    $(".today").text(date);
    
    function mdy() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        if(dd<10) {
            dd='0'+dd
        } 

        if(mm<10) {
            mm='0'+mm
        } 

        today = dd+'/'+mm+'/'+yyyy;
        return today;
    }
    /*Current date en*/
    
    /*open new url*/  
    $('table.table tr.accordion-toggle').hover(function () {        
       $(this).css('cursor','pointer');
    });
    
    //Imtesal
        //parents settings change password codes 
    $('.c_cursor_pointer_show_pass').mousedown(function(){
        $(this).css({opacity:0.5});
        $('#c_pass, #n_pass,#r_n_pass').attr('type', 'text');
    });
    $('.c_cursor_pointer_show_pass').mouseup(function(){ 
        $(this).css({opacity:0.9});
        $('#c_pass, #n_pass,#r_n_pass').attr('type', 'password');
    });
/*accordian expand stop on checkbox click*/
    $('input[type="checkbox"]').on('click',function(e){               
         e.stopPropagation();
    });
$('#box').hide();
$("#button").click(function(){
    var $ins=$(this).text();    
    if($(this).text() == "+"){
        $(this).text('-');
    }
    else if($(this).text() == "-"){
        $(this).text('+');
    }
    $("#box").slideToggle();    
});

    /*main menu*/
    $('#side-menu li').hover(function(){
        if($('#side-menu').hasClass('slim-nav'))
            {
               $(this).css('width','215px');//$(this).css('width','215px');
               $(this).siblings().css('width','60px');
            }
    },function(){
        $(this).css('width','auto');        
    });
    
    $('.open-close').click(function(){
        $('#side-menu').toggleClass('slim-nav');
        if($('#side-menu').hasClass('slim-nav'))
        {
            $('#side-menu li').css('width','60px');
        }
        else{          
            $('#side-menu li').css('width','auto');
        }
    });
/*Redirection*/
    $('.principal-profile').on('click',function(){        
        window.location.href='principal-profile.php';
    });
	/*Subject Teacher*/    
	$(".teacher-profile tr").on('click',function(){
		location.href="../parents/teacher-profile.php";
	});

    $('.teacher-profile').on('click',function(){        
        window.location.href='teacher-profile.php';
    });
    $('.student-profile').on('click',function(){        
        window.location.href='profile.php';
    });
     /*chairman*/
    $('.staff-box').on('click',function(){
        window.location.href='chairman-staff-status.php';
    });
    $('.students-box').on('click',function(){
        window.location.href='chairman-students-status.php';
    });
    $('.fees-box').on('click',function(){
        window.location.href='chairman-fees-structure.php';
    });
    /*principal*/
    $('.principal-staff').on('click',function(){
        window.location.href='admin-staff.php';
    });
    $('.principal-students').on('click',function(){
        window.location.href='admin-students.php';
    });
    $('.principal-fees').on('click',function(){
        window.location.href='principal-class-boxes.php';
    });
    $('.principal-events').on('click',function(){
        window.location.href='admin-events-notification.php';
    });
    $('.cl-profile').on('click',function(){
        window.location.href='teacher-profile.php';
    });
    $('.principal-profile').on('click',function(){
        window.location.href='principal-profile.php';
    });
    $('.total-student').on('click',function(){
        window.location.href='teacher-att.php';
    });
    $('.present-student').on('click',function(){
        window.location.href='teacher-att.php';
    });
    //school
    $('.school-staff').on('click',function(){
        window.location.href='school-staff.php';
    });
    $('.school-students').on('click',function(){
        window.location.href='school-students.php';
    });
    $('.school-events-notice').on('click',function(){
        window.location.href='school-events-notification.php';
    });
    $('.school-notice-circular').on('click',function(){
        window.location.href='school-notice-circular.php';
    });
    $('.school-inbox').on('click',function(){
        window.location.href='school-inbox.php';
    });
     $('.school-administration').on('click',function(){
        window.location.href='school-administration.php';
    });
    $('.school-feees').on('click',function(){
        window.location.href='school-fees.php';
    });
    $('.school-configure').on('click',function(){
        window.location.href='school-configure.php';
    });
     $('.fee-fee').on('click',function(){
        window.location.href='school-fee.php';
    });
	$('.stu-register').on('click',function(){
        window.location.href='registration.php';
    });
	$('#approval-status').on('click',function(){
        window.location.href='student-approval-status.php';
    });

    //school
    
    /*configuration st*/
    $('.configuration').on('click',function(){
        window.location.href='../configuration/configuremaster.php';
    });
    /*configuration en*/
    
    /*st manage master*/
    $('.create-master').on('click',function(){
        window.location.href='../configuration/master.php';
    });
     
    $('.class-type').on('click',function(){
        window.location.href='../configuration/classsection_master.php';
    });
    $('.view-section').on('click',function(){
        window.location.href='../configuration/section_addview.php';
    });
    $('.view-designation').on('click',function(){
        window.location.href='../configuration/designation_addview.php';
    });
    $('.fee-structure').on('click',function(){
        window.location.href='../configuration/feestructure_addview.php';
    });
	$('.manage-staff').on('click',function(){ 
        window.location.href='../configuration/manage_staff.php';
    });
	$('.manage-subject').on('click',function(){ 
        window.location.href='../configuration/subject_master.php';
    });

    /*en manage master*/
    
    /*scroll to*/
    $('.absent-student').on('click',function(){
       $('html,body').animate({
           scrollTop:$("#onleave").offset().top
       },2000);      
    });  
    
    //sunny 26-11-2016
    $("input[name='test']").click(function() {
        $('#show-me').css('display', ($(this).val() === 'a') ? 'block' : 'none');
        $('#show-meb').css('display', ($(this).val() === 'b') ? 'block' : 'none');
        $('#show-mec').css('display', ($(this).val() === 'c') ? 'block' : 'none');
        $('#show-med').css('display', ($(this).val() === 'd') ? 'block' : 'none');
    });
    $("input[name='test2']").click(function() {
        $('#show-mee').css('display', ($(this).val() === 'e') ? 'block' : 'none');
        $('#show-mef').css('display', ($(this).val() === 'f') ? 'block' : 'none');
        $('#show-meg').css('display', ($(this).val() === 'g') ? 'block' : 'none');
        $('#show-meh').css('display', ($(this).val() === 'h') ? 'block' : 'none');
    });
    
    $('#edit-form').click(function(){
        $('input[type="text"],input[type="file"]').removeAttr('disabled');        
        $(this).after('<button type="button" class="btn btn-info bord-radius" id="cancel" onclick="return editgroupValidationCheckout();"><span class="fa fa-times-circle"></span> Cancel</button>');
		$(this).after('<button type="button" class="btn btn-info bord-radius m-r-15" id="submit"><span class="fa fa-cog"></span> Submit</button>');
		$(this).hide();
        $(this).off('click');
    });
});




$(document).ready(function()
{
	$('.search-Events').keyup(function()
	{     
        searchEvent($(this).val());        
	});
    
    $('.input-holidays').keyup(function()
	{     
        searchHoliday($(this).val());        
	});
	
	$('.back-webpage').on('click',function(){
        //history.back();
        history.go(-1);
    });

    
    /*Add more Element*/
	
    $('#addmore_Element').on('click',function(){
	//var srlcount=parseInt(document.getElementById('srlconnect').val);
	var srlcount=parseInt($('#srlconnect').val());
	var val2=1;
    var idvalue =srlcount+val2;  
    //alert(idvalue);
	//document.getElementById('srlconnect').value=idvalue;
	$('#srlconnect').val(idvalue);
	$('#feeStructure tr:last').after("<tr> \
											<input type='text' class='form-control' id='srlconnect"+idvalue+"' value='"+idvalue+"'>\
                                            <td><label for='element3'>Element Name</label></td> \
                                            <td> \
                                                <select class='form-control input-sm' name='element3' id='element"+idvalue+"'> \
                                                    <option value='Admission Fee'>Admission Fee</option> \
                                                    <option value='Orientation Fee'>Orientation Fee</option> \
                                                    <option value='Annual Charges'>Annual Charges</option> \
                                                    <option value='Activity Charges'>Activity Charges</option> \
                                                    <option value='School Magazine'>School Magazine</option> \
                                                    <option value='Educational Tour'>Educational Tour</option> \
                                                    <option value='Tuition Fees'>Tuition Fees</option> \
                                                    <option value='Development Fee'>Development Fee</option> \
                                                </select> \
                                            </td>  \
                                        </tr>");
										
										
    });
	 //$('#srlconnect').val(idvalue);
	 //document.getElementById('srlconnect').value=idvalue;
	 
	 $('#add-row').on('click',function(){
		
        var srlcount=parseInt($('#staffconnect').val());
        var val2=1; 
		var htmlClass = $('#hiddenclass').html();
		var htmlSub = $('#hiddensub').html();
		var idvalue =srlcount+val2;  
		//alert(idvalue); 
        $('#staffconnect').val(idvalue);      
        $('#new-staff tr').eq(-2).after("<tr> \
                                            <td> \
                                                   <select class='form-control input-sm' name='class"+idvalue+"' id='class"+idvalue+"' onchange='showSubType(this.value,this.id);'>"+htmlClass+"</select> \
                                               </td> \
<td> \
                                                   <select class='form-control input-sm' name='section"+idvalue+"' id='section"+idvalue+"'></select> \
                                               </td> \
<td colspan='2'> \
                                                   <select class='form-control input-sm' name='subject"+idvalue+"'>"+htmlSub+"</select> \
                                               </td> \
                                        <td colspan='2'> \
                                                   <label><input type='checkbox' name='chkClTeacher"+idvalue+"' id='chkClTeacher"+idvalue+"' value='1'/></label> \
                                               </td></tr>");    
    });

});

function searchEvent(inputVal)
{    
	var table = $('.table-events');
	table.find('tr').each(function(index, row)
	{
		var allCells = $(row).find('td');
		if(allCells.length > 0)
		{
			var found = false;            
			allCells.each(function(index, td)
			{
				var regExp = new RegExp(inputVal, 'i');
				if(regExp.test($(td).text()))
				{
					found = true;
					return false;
				}
			});
			if(found == true)$(row).show();else $(row).hide();
		}
	});
}

function searchHoliday(inputVal)
{    
	var table = $('.table-holidays');
	table.find('tr').each(function(index, row)
	{
		var allCells = $(row).find('td');
		if(allCells.length > 0)
		{
			var found = false;            
			allCells.each(function(index, td)
			{
				var regExp = new RegExp(inputVal, 'i');
				if(regExp.test($(td).text()))
				{
					found = true;
					return false;
				}
			});
			if(found == true)$(row).show();else $(row).hide();
		}
	});
}



 

 
 
