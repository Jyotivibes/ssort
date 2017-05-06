<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-clockpicker.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/sidebar-nav.min.js"></script>
<script src="../js/jquery.slimscroll.js"></script>
<script src="../js/waves.js"></script>
<script src="../js/jquery.waypoints.js"></script>
<script src="../js/jquery.counterup.min.js"></script>
<script src="../js/raphael-min.js"></script>
<script src="../js/custom.min.js"></script>
<script src="../js/jquery.sparkline.min.js"></script>
<script src="../js/jquery.toast.js"></script>
<script src="../js/personal.js"></script><!--custom-->

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

<!--New Calender-->
<script src="../calendaropen/js/moment.min.js"></script> 
<script src="../calendaropen/js/ion.calendar.js"></script> 
<script>
$(function(){
    $("#calendar-fancy").ionCalendar({
        lang: "en",
        years: "2000-2030",
        onClick: function(date){
            $("#result-1").html("onClick:<br/>" + date);
        }
    });
       $("#mydate").ionDatePicker();
});
</script>
<!--new calender end-->

<!--am chart js st-->    
<script src="../amchart/js/amcharts.js"></script>
<script src="../amchart/js/pie.js"></script>
<script src="../amchart/js/light.js"></script>
<script src="../amchart/js/onpage.js"></script>
<!--bar chart-->
<script src="../amchart/barchart/js/amcharts.js"></script>
<script src="../amchart/barchart/js/serial.js"></script>
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
<!--<script src="../js/bootstrap-timepicker.min.js"></script>-->


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

<!--bar chart st-->
<script>
var chart = AmCharts.makeChart("barchart", {
    "theme": "light",
    "type": "serial",
    "dataProvider": [{
        "month": "April",
        "Absent": 7,
        "Present":24
    }, {
        "month": "May",
        "Absent": 9,
        "Present": 22
    }, {
        "month": "June",
        "Absent": 10,
        "Present": 20
    }, {
        "month": "July",
        "Absent": 8,
        "Present": 23
    }, {
        "month": "Aug",
        "Absent": 11,
        "Present": 20
    }, {
        "month": "Sept",
        "Absent": 7,
        "Present": 23
    }, {
        "month": "Oct",
        "Absent": 8,
        "Present": 22
    }, {
        "month": "Nov",
        "Absent": 8,
        "Present": 22
    }, {
        "month": "Dec",
        "Absent": 9,
        "Present": 22
    },{
        "month": "Jan",
        "Absent": 4,
        "Present": 27
    },{
        "month": "Feb",
        "Absent": 7,
        "Present": 22
    },{
        "month": "March",
        "Absent":9,
        "Present": 22
    }],
    "valueAxes": [{
        "stackType": "3d",
        "unit": "",
        "position": "left",
        "title": "Number of Days",
    }],
    "startDuration": 1,
    "graphs": [{
        "balloonText": "Days - Absent, [[category]]: <b>[[value]]</b>",
        "fillAlphas": 1,
        "lineAlpha": 0,
        "title": "Absent",
        "type": "column",
        "valueField": "Absent"
    }, {
        "balloonText": "Days - Present, [[category]] : <b>[[value]]</b>",
        "fillAlphas": 1,
        "lineAlpha": 0,
        "title": "Present",
        "type": "column",
        "valueField": "Present"
    }],
    "plotAreaFillAlphas": 1,
    "depth3D": 60,
    "angle": 30,
    "categoryField": "month",
    "categoryAxis": {
        "gridPosition": "start"
    },
    "export": {
                "enabled": true
     }
});
jQuery('.chart-input').off().on('input change',function() {
                var property       = jQuery(this).data('property');
                var target                            = chart;
                chart.startDuration = 0;

                if ( property == 'topRadius') {
                                target = chart.graphs[0];
               if ( this.value == 0 ) {
          this.value = undefined;
               }
                }

                target[property] = this.value;
                chart.validateNow();
});
</script>
<!--bar chart en-->



