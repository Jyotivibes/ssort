$(function(){
    var chart = AmCharts.makeChart( "chartdiv1", {
     
  "labelRadius": -40,
  "labelText": "[[status]]: [[percents]]%", 
        
  "type": "pie",
  "theme": "light",
  "dataProvider": [ {
    "status": "Present",
    "value": 125
  }, {
    "status": "Absent",
    "value": 90
  }],
  "valueField": "value",
  "titleField": "status",
  "outlineAlpha": 0.4,
  "depth3D": 25,  
  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
  "angle": 40,
  "export": {
    "enabled": true
  }     
        
});
});
$(function(){
    var chart = AmCharts.makeChart( "chartdiv2", {
     
  "labelRadius": -40,
  "labelText": "[[status]]: [[percents]]%", 
        
  "type": "pie",
  "theme": "light",
  "dataProvider": [ {
    "status": "Present",
    "value": 125
  }, {
    "status": "Absent",
    "value": 90
  }],
  "valueField": "value",
  "titleField": "status",
  "outlineAlpha": 0.4,
  "depth3D": 25,  
  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
  "angle": 40,
  "export": {
    "enabled": true
  }     
        
});
});

// sunny 23-11-2016
