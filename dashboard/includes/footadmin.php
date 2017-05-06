<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-clockpicker.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/sidebar-nav.min.js"></script>
<script src="../js/jquery.slimscroll.js"></script>
<script src="../js/waves.js"></script>
<script src="../js/jquery.waypoints.js"></script>
<script src="../js/jquery.counterup.min.js"></script>
<script src="../js/raphael-min.js"></script>
<script src="../js/moment.js"></script>
<script src="../js/custom.min.js"></script>
<script src="../js/jquery.sparkline.min.js"></script>
<script src="../js/jquery.toast.js"></script>
<script src="../js/personal.js"></script><!--custom js-->

<!--tabs-->
<script src="../js/cbpFWTabs.js"></script>
<script type="text/javascript">
  (function() {
            [].slice.call( document.querySelectorAll( '.sttabs' ) ).forEach( function( el ) {
                new CBPFWTabs( el );
            });

    })();
</script>
<!--sunny 12-11-2016-->
<!--am chart js st-->    
<script src="../amchart/js/amcharts.js"></script>
<script src="../amchart/js/pie.js"></script>
<script src="../amchart/js/light.js"></script>
<script src="../amchart/js/onpage.js"></script>
<!--am chart js en-->        

<script type="text/javascript">  
$(document).ready(function() {
     $.toast({
        heading: '<i class="fa fa-graduation-cap"></i> Welcome to School Management System',
        text: '',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'info',
        hideAfter: 3500,         
        stack: 6
      });
});
</script>

<script type="text/javascript">
			$(".max_min_button").click(function(){
				if($(this).html() == "-"){
					$(this).html("+");
				}
				else{
					$(this).html("-");
				}
				var thisParent = $(this).parent();
				$(thisParent).next(".news_body").slideToggle();
			});
</script>


<script>
    // Clock pickers
    $('#single-input').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    'default': 'now'
    });

    $('.clockpicker').clockpicker({
    donetext: 'Done',
    })
    .find('input').change(function(){
    console.log(this.value);
    });

    $('#check-minutes').click(function(e){
    // Have to stop propagation here
    e.stopPropagation();
    input.clockpicker('show')
    .clockpicker('toggleView', 'minutes');
    });
</script>

<!-- Date range Plugin JavaScript -->



<!-- js date range picker -->
<script src="../js/bootstrap-datepicker.min.js"></script>
<script src="../js/daterangepicker.js"></script>
<!--date picker st-->
<script>
// Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
      });      
    jQuery('#date-range').datepicker({
        toggleActive: true
      });
    jQuery('#datepicker-inline').datepicker({        
        todayHighlight: true
      });
</script>




