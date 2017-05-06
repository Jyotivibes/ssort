
<!--<script src="../js/jquery.min.js"></script>-->
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
<script src="../js/personal.js"></script>
<!--tabs-->
<script src="../js/cbpFWTabs.js"></script>
<script type="text/javascript">
      (function() {
                [].slice.call( document.querySelectorAll( '.sttabs' ) ).forEach( function( el ) {
                    new CBPFWTabs( el );
                });

            })();
</script>

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
			var action='searchevent';
			var session='<?php echo $_SESSION['USER']['DB_NAME'];?>';
			var dataString = 'date='+date+'&session='+session+'&action='+action;
			$.ajax({
			type:'POST',
			data:dataString,
			url:'../../ajax.php',
			success:function(data) {
				//alert(data);
				if(data!="")
						{
							$("#eventoccassion").html(data);
                            var date_string=date.substring(0,date.indexOf('T'));
                          $("#todaydate").text(date_string);
						}
			}

		  });
        }
    });
       $("#mydate").ionDatePicker();
});
</script>
<!--new calender end-->

<!-- Date Picker Plugin JavaScript -->
<script src="../js/bootstrap-datepicker.min.js"></script>
<script>
 /*Date Picker*/
    jQuery('.mydatepicker, #datepicker').datepicker({format: 'dd-mm-yyyy'});
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
<!--am chart js st-->    
<script src="../amchart/js/amcharts.js"></script>
<script src="../amchart/js/pie.js"></script>
<script src="../amchart/js/light.js"></script>
<script src="../amchart/js/onpage.js"></script>
<!--bar chart-->
<script src="../amchart/barchart/js/amcharts.js"></script>
<script src="../amchart/barchart/js/serial.js"></script>
<!--am chart js en-->
<!----------------------FOR DOWNLOAD PDF AND EXCEL START------------------------>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"/>
<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"/>
<!----------------------FOR DOWNLOAD PDF AND EXCEL END------------------------>
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
var chart = AmCharts.makeChart("barchart", {
    "theme": "light",
    "type": "serial",
    "dataProvider": [{
        "month": "April",
        "Present": <?php echo ($rowtble['April']['PRESENT'])+0;?>,
        "Absent": <?php echo ($rowtble['April']['ABSENT'])+0;?>
    }, {
        "month": "May",
         "Present": <?php echo ($rowtble['May']['PRESENT'])+0;?>,
        "Absent": <?php echo ($rowtble['May']['ABSENT'])+0;?>
    }, {
        "month": "June",
        "Present": <?php echo ($rowtble['June']['PRESENT'])+0;?>,
        "Absent": <?php echo ($rowtble['June']['ABSENT'])+0;?>
    }, {
        "month": "July",
         "Present": <?php echo ($rowtble['July']['PRESENT'])+0;?>,
        "Absent": <?php echo ($rowtble['July']['ABSENT'])+0;?>
    }, {
        "month": "Aug",
         "Present": <?php echo ($rowtble['August']['PRESENT'])+0;?>,
        "Absent": <?php echo ($rowtble['August']['ABSENT'])+0;?>
    }, {
        "month": "Sept",
        "Present": <?php echo ($rowtble['September']['PRESENT'])+0;?>,
        "Absent": <?php echo ($rowtble['September']['ABSENT'])+0;?>
    }, {
        "month": "Oct",
        "Present": <?php echo ($rowtble['October']['PRESENT'])+0;?>,
        "Absent": <?php echo ($rowtble['October']['ABSENT'])+0;?>
    }, {
        "month": "Nov",
        "Present": <?php echo ($rowtble['November']['PRESENT'])+0;?>,
        "Absent": <?php echo ($rowtble['November']['ABSENT'])+0;?>
    }, {
        "month": "Dec",
        "Present": <?php echo ($rowtble['December']['PRESENT'])+0;?>,
        "Absent": <?php echo ($rowtble['December']['ABSENT'])+0;?>
    },{
        "month": "Jan",
        "Present": <?php echo ($rowtble['January']['PRESENT'])+0;?>,
        "Absent": <?php echo ($rowtble['January']['ABSENT'])+0;?>
    },{
        "month": "Feb",
         "Present": <?php echo ($rowtble['February']['PRESENT'])+0;?>,
        "Absent": <?php echo ($rowtble['February']['ABSENT'])+0;?>
    },{
        "month": "March",
        "Present": <?php echo ($rowtble['March']['PRESENT'])+0;?>,
        "Absent": <?php echo ($rowtble['March']['ABSENT'])+0;?>
    }],
    "valueAxes": [{
        "stackType": "3d",
        "unit": "",
        "position": "left",
        "title": "Number of Days"
    }],
    "startDuration": 1,
    "graphs": [{
        "balloonText": "Days - Present, [[category]]: <b>[[value]]</b>",
        "fillAlphas": 1,
        "lineAlpha": 0,
        "title": "Present",
        "type": "column",
        "valueField": "Present"
    }, {
        "balloonText": "Days - Absent, [[category]] : <b>[[value]]</b>",
        "fillAlphas": 1,
        "lineAlpha": 0,
        "title": "Absent",
        "type": "column",
        "valueField": "Absent"
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
        

<script>
            var chart;
            var chartData = [
                {
                    "location": "Noida",
                    "Absent": 56700
                },
                {
                    "location": "Gurgaon",
                    "Absent": 28680
                },
                {
                    "location": "Ghaziabad",
                    "Absent": 75890                   
                },
                {
                    "location": "Meerut",
                    "Absent": 98990                   
                },
                {
                    "location": "Lucknow",
                    "Absent": 73810                    
                }
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "location";
                chart.color = "#000";
                chart.fontSize = 14;
                chart.startDuration = 1;
                chart.plotAreaFillAlphas = 0.2;
                // the following two lines makes chart 3D
                chart.angle = 30;
                chart.depth3D = 60;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridAlpha = 0.2;
                categoryAxis.gridPosition = "start";
                categoryAxis.gridColor = "red";
                categoryAxis.axisColor = "red";
                categoryAxis.axisAlpha = 0.5;
                categoryAxis.dashLength = 5;
                categoryAxis.labelRotation = 90;
                categoryAxis.fontSize = 11;
                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.stackType = "3d"; // This line makes chart 3D stacked (columns are placed one behind another)
                valueAxis.gridAlpha = 0.2;
                valueAxis.gridColor = "red";
                valueAxis.axisColor = "red";
                valueAxis.axisAlpha = 0.5;
                valueAxis.dashLength = 5;
                valueAxis.title = "Salary Amount";
                valueAxis.titleColor = "#999";
                valueAxis.unit = "";
                chart.addValueAxis(valueAxis);
                

                // GRAPHS
                // first graph
                var graphone = new AmCharts.AmGraph();
                graphone.title = "Absent";
                graphone.valueField = "Absent";
                graphone.type = "column";
                graphone.lineAlpha = 0;
                graphone.lineColor = "#fdc9bb";
                graphone.fillAlphas = 1;
                graphone.balloonText = "Total Salary Amount, [[category]] (2016): <b>[[value]]</b>";
                chart.addGraph(graphone);

                // second graph
                var graphtwo = new AmCharts.AmGraph();
                graphtwo.title = "Present";
                graphtwo.valueField = "Present";
                graphtwo.type = "column";
                graphtwo.lineAlpha = 0;
                graphtwo.lineColor = "#00C292";
                graphtwo.fillAlphas = 1;
                graphtwo.balloonText = "Days - Present, [[category]] (2016): <b>[[value]]</b>";
                chart.addGraph(graphtwo);

                chart.write("barchartschool");
            });
        </script>
        <script>

var chart = AmCharts.makeChart("stackedbar", {
    "theme": "light",
    "type": "serial",
    "dataProvider": [{
        "country": "Apr",
         "year2004": 200000,
       
    }, {
        "country": "May",
        "year2004": 170000,
        
    }, {
        "country": "Jun",
       "year2004": 225000,
       
    }, {
        "country": "July",
        "year2004": 220000,
       
    }, {
        "country": "Aug",
        "year2004": 215000,
       
    }],
    "valueAxes": [{
        "stackType": "3d",
        "unit": "",
        "position": "left",
//        "title": "GDP growth rate",
    }],
    "startDuration": 1,
    "graphs": [{
        "balloonText": " [[category]]: <b>[[value]]</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "2004",
        "type": "column",
        "valueField": "year2004"
    }, {
            "balloonText": "[[category]]: <b>[[value]]</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "2016",
        "type": "column",
        "valueField": "year2005"
    }],
    "plotAreaFillAlphas": 0.1,
    "depth3D": 60,
    "angle": 30,
    "categoryField": "country",
    "categoryAxis": {
        "gridPosition": "start"
    },
    "export": {
    	"enabled": true
     }
});
jQuery('.chart-input').off().on('input change',function() {
	var property	= jQuery(this).data('property');
	var target		= chart;
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

<script>
            var chart;
            var chartData = [
                {
                    "location": "Noida",
                    "Absent": 56700
                },
                {
                    "location": "Gurgaon",
                    "Absent": 28680
                },
                {
                    "location": "Ghaziabad",
                    "Absent": 75890                   
                },
                {
                    "location": "Meerut",
                    "Absent": 98990                   
                },
                {
                    "location": "Lucknow",
                    "Absent": 73810                    
                }
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "location";
                chart.color = "#000";
                chart.fontSize = 14;
                chart.startDuration = 1;
                chart.plotAreaFillAlphas = 0.2;
                // the following two lines makes chart 3D
                chart.angle = 30;
                chart.depth3D = 60;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridAlpha = 0.2;
                categoryAxis.gridPosition = "start";
                categoryAxis.gridColor = "red";
                categoryAxis.axisColor = "red";
                categoryAxis.axisAlpha = 0.5;
                categoryAxis.dashLength = 5;
                categoryAxis.labelRotation = 90;
                categoryAxis.fontSize = 11;
                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.stackType = "3d"; // This line makes chart 3D stacked (columns are placed one behind another)
                valueAxis.gridAlpha = 0.2;
                valueAxis.gridColor = "red";
                valueAxis.axisColor = "red";
                valueAxis.axisAlpha = 0.5;
                valueAxis.dashLength = 5;
                valueAxis.title = "Salary Amount";
                valueAxis.titleColor = "#999";
                valueAxis.unit = "";
                chart.addValueAxis(valueAxis);
                

                // GRAPHS
                // first graph
                var graphone = new AmCharts.AmGraph();
                graphone.title = "Absent";
                graphone.valueField = "Absent";
                graphone.type = "column";
                graphone.lineAlpha = 0;
                graphone.lineColor = "#fdc9bb";
                graphone.fillAlphas = 1;
                graphone.balloonText = "Total Salary Amount, [[category]]: <b>[[value]]</b>";
                chart.addGraph(graphone);

                // second graph
                var graphtwo = new AmCharts.AmGraph();
                graphtwo.title = "Present";
                graphtwo.valueField = "Present";
                graphtwo.type = "column";
                graphtwo.lineAlpha = 0;
                graphtwo.lineColor = "#00C292";
                graphtwo.fillAlphas = 1;
                graphtwo.balloonText = "Days - Present, [[category]]: <b>[[value]]</b>";
                chart.addGraph(graphtwo);

                chart.write("barchartschool_old");
            });
        </script>
      
<script>
var chart;
var chartData = [
    {
        "location": "Noida",
        "Absent": 56700
    },
    {
        "location": "Gurgaon",
        "Absent": 28680
    },
    {
        "location": "Ghaziabad",
        "Absent": 75890                   
    },
    {
        "location": "Meerut",
        "Absent": 98990                   
    },
    {
        "location": "Lucknow",
        "Absent": 73810                    
    }
];


AmCharts.ready(function () {
    // SERIAL CHART
    chart = new AmCharts.AmSerialChart();
    chart.dataProvider = chartData;
    chart.categoryField = "location";
    chart.color = "#000";
    chart.fontSize = 14;
    chart.startDuration = 1;
    chart.plotAreaFillAlphas = 0.2;
    // the following two lines makes chart 3D
    chart.angle = 30;
    chart.depth3D = 60;

    // AXES
    // category
    var categoryAxis = chart.categoryAxis;
    categoryAxis.gridAlpha = 0.2;
    categoryAxis.gridPosition = "start";
    categoryAxis.gridColor = "red";
    categoryAxis.axisColor = "red";
    categoryAxis.axisAlpha = 0.5;
    categoryAxis.dashLength = 5;
    categoryAxis.labelRotation = 90;
    categoryAxis.fontSize = 11;
    // value
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.stackType = "3d"; 
    valueAxis.gridAlpha = 0.2;
    valueAxis.gridColor = "red";
    valueAxis.axisColor = "red";
    valueAxis.axisAlpha = 0.5;
    valueAxis.dashLength = 5;
    valueAxis.title = "Fees Collection";
    valueAxis.titleColor = "#999";
    valueAxis.unit = "";
    chart.addValueAxis(valueAxis);


    // GRAPHS
    // first graph
    var graphone = new AmCharts.AmGraph();
    graphone.title = "Absent";
    graphone.valueField = "Absent";
    graphone.type = "column";
    graphone.lineAlpha = 0;
    graphone.lineColor = "#fdc9bb";
    graphone.fillAlphas = 1;
    graphone.balloonText = "Total Salary Amount, [[category]]: <b>[[value]]</b>";
    chart.addGraph(graphone);

    // second graph
    var graphtwo = new AmCharts.AmGraph();
    graphtwo.title = "Present";
    graphtwo.valueField = "Present";
    graphtwo.type = "column";
    graphtwo.lineAlpha = 0;
    graphtwo.lineColor = "#00C292";
    graphtwo.fillAlphas = 1;
    graphtwo.balloonText = "Days - Present, [[category]]: <b>[[value]]</b>";
    chart.addGraph(graphtwo);

    chart.write("barchartstudent");
});
        </script>      

<script>
function showSubType(str1,str2) {
		var lastChar = str2.substr(str2.length - 1); // => "1"
		var formData = "action=getsection&db=<?php echo $_SESSION['USER']['DB_NAME'];?>&q="+str1;  //Name value Pair
		$.ajax({
		url : "../../ajax.php",
		type: "POST",
		data : formData,
		success: function(data, textStatuemailChecks, jqXHR)
		{
			 //alert("section"+lastChar+"")
			document.getElementById("section"+lastChar+"").innerHTML = data; 
		},
		error: function (jqXHR, textStatus, errorThrown)
		{ 
			alert("error in network for login"); 
			//preloader").css("display","none");
		}
	 });
}
//SHOW SUBTYPE IN CHECKBOX
function showSubTypechk(str1) {
		var formData = "action=getsectioncheckbox&db=<?php echo $_SESSION['USER']['DB_NAME'];?>&q="+str1;  //Name value Pair
		$.ajax({
		url : "../../ajax.php",
		type: "POST",
		data : formData,
		success: function(data, textStatuemailChecks, jqXHR)
		{
			 //alert("section"+lastChar+"")
			document.getElementById("section").innerHTML = "<b>Section:</b>"+data; 
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert("error in network for login"); 
			//preloader").css("display","none");
		}
	 });
}

</script>
<!--modal window st-->
<div id="submitResponse" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Do you want to save changes you made to document before closing?</p>                
            </div>
            <div class="modal-footer btn-center">
                <button type="button" class="btn btn-primary btn-theme bord-radius" data-dismiss="modal">Close</button>                
            </div>
        </div>
    </div>
</div>
<!-----------------POPUP AFTER CLICK ON CALENDER MARKING------------->
<script>
    $(document).ready(function(){
        $(document).on('click','a[data-event-id]',function(e){
            var event_id= jQuery(this).attr('data-event-id');
            $.ajax({
                'url':'<?php echo HTTP_SERVER; ?>ajax.php?action=single_event&session=<?php echo $_SESSION['USER']['DB_NAME']; ?>',
                'type':'post',
                'data':{
                    'event_id':event_id
                },
                'success':function(result){
                    $('#common_popup').find('.modal-content .modal-body').html(result);
                    $('#common_popup').modal('show');
                },
                'error':function(xhr, status, errorThrown){
                    console.log(xhr.responseText);
                }
            });

        });
    });
</script>
<script>
    var getUrlParameter = function getUrlParameter(sParam) {

        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;


        for (i = 0; i < sURLVariables.length; i++) {

            sParameterName = sURLVariables[i].split('=');


            if (sParameterName[0] === sParam) {

                return sParameterName[1] === undefined ? true : sParameterName[1];

            }

        }

    };

    function UpdateQueryString(key, value, url) {

        console.log(key);

        if (!url)
            url = window.location.href;

        var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
            hash;


        if (re.test(url)) {

            if (typeof value !== 'undefined' && value !== null)
                return url.replace(re, '$1' + key + "=" + value + '$2$3');

            else {

                hash = url.split('#');

                url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');

                if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                    url += '#' + hash[1];

                return url;

            }

        } else {

            if (typeof value !== 'undefined' && value !== null) {

                var separator = url.indexOf('?') !== -1 ? '&' : '?';

                hash = url.split('#');

                url = hash[0] + separator + key + '=' + value;

                if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                    url += '#' + hash[1];

                return url;

            } else
                return url;

        }

    }

    function removeURLParameter(url, parameter) {
        //prefer to use l.search if you have a location/link object
        var urlparts = url.split('?');
        if (urlparts.length >= 2) {

            var prefix = encodeURIComponent(parameter) + '=';
            var pars = urlparts[1].split(/[&;]/g);

            //reverse iteration as may be destructive
            for (var i = pars.length; i-- > 0;) {
                //idiom for string.startsWith
                if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                    pars.splice(i, 1);
                }
            }

            url = urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
            return url;
        } else {
            return url;
        }
    }
    function updateUrlNoPageLoad(url_value) {
        //https://developer.mozilla.org/en-US/docs/Web/API/History_API#The_pushState()_method
        window.history.pushState({}, '', url_value);
    }
    $("#record").change(function(){
        var records = $("#record").val();
        var current_url = window.location.href;
        var new_url = UpdateQueryString('records', records, current_url);
        window.location.href=new_url;
    })
</script>
<div id="common_popup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header-1">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" >Event Occasion</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>