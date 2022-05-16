
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>amCharts tutorial: Loading external data</title>
  <style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
</head>
<body>


      <div class="card" style="margin-top:50px;box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);width:80%;margin-left:10%;">
       <h4 class="card-header"> 
        <div class="row">
            <div class="col">
              <div style=""><i class="fa fa-users"  style="padding-right:10px;font-size:15px;padding-top: 5px"></i>Chart
              </div>
            </div>
        </div>
       </h4>
  
       <div class="card-body" style="margin: -10px 0px 0px 0px;">
            
          <div id="chartdiv" style="width: 100%; height: 500px;"></div>
     
        </div>
     </div>  
  

<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: true,
  panY: false,
  wheelX: "panX",
  wheelY: "zoomX",
  layout: root.verticalLayout
}));

// Add scrollbar
// https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
chart.set("scrollbarX", am5.Scrollbar.new(root, {
  orientation: "horizontal"
}));

var data = <?php echo $data; ?>;
console.log(data);

// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
  categoryField: "category",
  renderer: am5xy.AxisRendererX.new(root, {}),
  tooltip: am5.Tooltip.new(root, {
    themeTags: ["axis"],
    animationDuration: 200
  })
}));

xAxis.data.setAll(data);

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  min: 0,
  renderer: am5xy.AxisRendererY.new(root, {})
}));

// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/

var series0 = chart.series.push(am5xy.ColumnSeries.new(root, {
  name: "Income",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value1",
  categoryXField: "category",
  clustered: false,
  tooltip: am5.Tooltip.new(root, {
    labelText: "2004: {valueY}"
  })
}));

series0.columns.template.setAll({
  width: am5.percent(80),
  tooltipY: 0
});


series0.data.setAll(data);


var series1 = chart.series.push(am5xy.ColumnSeries.new(root, {
  name: "Income",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value2",
  categoryXField: "category",
  clustered: false,
  tooltip: am5.Tooltip.new(root, {
    labelText: "2005: {valueY}"
  })
}));

series1.columns.template.setAll({
  width: am5.percent(50),
  tooltipY: 0
});

series1.data.setAll(data);

var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
chart.appear(1000, 100);
series0.appear();
series1.appear();

}); // end am5.ready()
</script>
</body>
</html>
@endsection

