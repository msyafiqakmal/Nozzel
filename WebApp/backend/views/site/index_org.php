<?php

/* @var $this yii\web\View */

$this->title = 'DASHBOARD | GTD PREDICTIVE ANALYSIS';
?>

<div id="main1"></div>

<div class="box">
    <div class="box-header">
        <h3>Line with fill</h3>
        <small>Simple usage</small>
    </div>
    <div class="box-body">
        <div id="main" style="width:600px;height:300px"></div>
    </div>
</div>

<?php
$script = <<< JS

var chart = echarts.init(document.getElementById('main1'));

chart.showLoading();

$.getJSON('https://s3-us-west-2.amazonaws.com/s.cdpn.io/95368/obama_budget_proposal_2012.list.json', function (obama_budget_2012) {
    chart.hideLoading();

    option = {
        tooltip : {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow',
                label: {
                    show: true
                }
            }
        },
        toolbox: {
            show : true,
            feature : {
                mark : {show: true},
                dataView : {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        legend: {
            data:['Growth', 'Budget 2011', 'Budget 2012'],
            itemGap: 5
        },
        grid: {
            top: '12%',
            left: '1%',
            right: '10%',
            containLabel: true
        },
        xAxis: [
            {
                type : 'category',
                data : obama_budget_2012.names
            }
        ],
        yAxis: [
            {
                type : 'value',
                name : 'Budget (million USD)',
                axisLabel: {
                    formatter: function (a) {
                        a = +a;
                        return isFinite(a)
                            ? echarts.format.addCommas(+a / 1000)
                            : '';
                    }
                }
            }
        ],
        dataZoom: [
            {
                show: true,
                start: 94,
                end: 100
            },
            {
                type: 'inside',
                start: 94,
                end: 100
            },
            {
                show: true,
                yAxisIndex: 0,
                filterMode: 'empty',
                width: 30,
                height: '80%',
                showDataShadow: false,
                left: '93%'
            }
        ],
        series : [
            {
                name: 'Budget 2011',
                type: 'bar',
                data: obama_budget_2012.budget2011List
            },
            {
                name: 'Budget 2012',
                type: 'bar',
                data: obama_budget_2012.budget2012List
            }
        ]
    };

    chart.setOption(option);

});

 
var myChart = echarts.init(document.getElementById('main'));

// loading---------------------
myChart.showLoading({
    text: 'We\'re building the buildings as fast as we can...please wait! ',    //loading text
});

// ajax getting data...............

// ajax callback
myChart.hideLoading();

// use the chart-------------------
var option = {
    legend: {                                   // legend configuration
        padding: 5,                             // The inner padding of the legend, in px, defaults to 5. Can be set as array - [top, right, bottom, left].
        itemGap: 10,                            // The pixel gap between each item in the legend. It is horizontal in a legend with horizontal layout, and vertical in a legend with vertical layout.
        data: ['Gas-95', 'Gas-97']
    },
    tooltip: {                                  // tooltip configuration
        trigger: 'item',                        // trigger type. Defaults to data trigger. Can also be: 'axis'
    },
    xAxis: [                                    // The horizontal axis in Cartesian coordinates
        {
            type: 'category',                   // Axis type. xAxis is category axis by default. As for value axis, please refer to the 'yAxis' chapter.
            data: ['PS-1', 'PS-2', 'PS-3', 'PS-4', 'PS-5', 'PS-6', 'PS-7', 'PS-8', 'PS-9', 'PS-10', 'PS-11', 'PS-12']
        }
    ],
    yAxis: [                                    // The vertical axis in Cartesian coordinates
        {
            type: 'value',                      // Axis type. yAxis is value axis by default. As for category axis, please refer to the 'xAxis' chapter.
            boundaryGap: [0.1, 0.1],            // Blank border on each side of the coordinate axis. Value in the array represents percentage.
            splitNumber: 3                      // Applicable to value axis. The number of segments. Defaults to 5.
        }
    ],
    series: [
        {
            name: 'Gas-95',                        // series name
            type: 'line',                       // chart type, line, scatter, bar, pie, radar
            data: [10, 23, 45, 56, 233, 343, 454, 89, 343, 123, 45, 123]
        },
        {
            name: 'Gas-97',                    // series name
            type: 'line',                       // chart type, line, scatter, bar, pie, radar
            data: [45, 123, 145, 526, 233, 343, 44, 829, 33, 123, 45, 13]
        }
    ]
};

myChart.setOption(option);

// Add some data------------------
option.legend.data.push('Disel');
option.series.push({
        name: 'Disel',                            // series name
        type: 'line',                           // chart type, line, scatter, bar, pie, radar
        data: [34, 45, 23, 56, 78, 343, 34, 89, 343, 123, 45, 123]
});
myChart.setOption(option);


// Clear the chart-------------------
//myChart.clear();

// Dispose the chart-------------------
//myChart.dispose();
                    


 


JS;
$this->registerJs($script);
?>

<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="box">
            <div class="box-header">
                <h3>Line with fill</h3>
                <small>Simple usage</small>
            </div>
            <div class="box-body">
                <div ui-jp="plot" ui-refresh="app.setting.color" ui-options="
              [
                {
                  data: [[1, 2], [2, 1.6], [3, 2.4], [4, 2.1], [5, 1.7], [6, 1.5], [7, 1.7]],
                  points: { show: true, radius: 3},
                  splines: { show: true, tension: 0.45, lineWidth: 0, fill: 0.4}
                }
              ],
              {
                colors: ['#0cc2aa'],
                series: { shadowSize: 3 },
                xaxis: { show: true, font: { color: '#ccc' }, position: 'bottom' },
                yaxis:{ show: true, font: { color: '#ccc' }, min:1},
                grid: { hoverable: true, clickable: true, borderWidth: 0, color: 'rgba(120,120,120,0.5)' },
                tooltip: true,
                tooltipOpts: { content: '%x.0 is %y.4',  defaultTheme: false, shifts: { x: 0, y: -40 } }
              }
            " style="height:200px" >
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="box">
            <div class="box-header">
                <h3>Basic Line</h3>
                <small class="block text-muted">label, custom line shadow</small>
            </div>
            <div class="box-body">
                <div ui-jp="chart" ui-options=" {
                  tooltip : {
                      trigger: 'axis'
                  },
                  legend: {
                      data:['Max','Min']
                  },
                  calculable : true,
                  xAxis : [
                      {
                          type : 'category',
                          boundaryGap : false,
                          data : ['Mon','Tue','Wed','Thu','Fri','Sat','Sun']
                      }
                  ],
                  yAxis : [
                      {
                          type : 'value',
                          axisLabel : {
                              formatter: '{value} °C'
                          }
                      }
                  ],
                  series : [
                      {
                          name:'Max',
                          type:'line',
                          data:[11, 11, 15, 13, 12, 13, 10],
                          markPoint : {
                              data : [
                                  {type : 'max', name: 'Max'},
                                  {type : 'min', name: 'Min'}
                              ]
                          },
                          markLine : {
                              data : [
                                  {type : 'average', name: 'Average'}
                              ]
                          }
                      },
                      {
                          name:'Min',
                          type:'line',
                          data:[1, -2, 2, 5, 3, 2, 0],
                          markPoint : {
                              data : [
                                  {name : 'Min of Week', value : -2, xAxis: 1, yAxis: -1.5}
                              ]
                          },
                          markLine : {
                              data : [
                                  {type : 'average', name : 'Average'}
                              ]
                          }
                      }
                  ]
                }" style="height:300px" >
                </div>
            </div>
        </div>
    </div>

</div>



<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>




<!-- ############ PAGE START-->

<div class="row-col">
    <div class="col-xs-4 v-m">
        <h1 class="_800 l-s-n-4x inline m-r-sm">5,600</h1>
        <span class="inline l-h-1x">
              Markets <br>
              <small class="text-muted">From africa to asia</small>
            </span>
    </div>
    <div class="col-xs-4 v-m">
        <h1 class="_800 l-s-n-4x inline m-r-sm text-primary">31,000</h1>
        <span class="inline l-h-1x">
              Employees  <br>
              <small class="text-muted">From 16 countries</small>
            </span>
    </div>
    <div class="col-xs-4 v-m">
        <h1 class="_800 l-s-n-4x text-white text-shadow inline m-r-sm">4,300</h1>
        <span class="inline l-h-1x">
              Suppliers  <br>
              <small class="text-muted">From Nike to PE</small>
            </span>
    </div>
</div>

<div class="row-col primary">
    <div class="col-xs-4 lt">
        <div class="p-a-md">
			<span class="pull-right">
				<i class="fa text fa-caret-up text-success"></i>
			</span>
            <span class="_500">Views</span>
            <div class="h3 _700 m-y">
                2,045k
            </div>
            <div>
                <span ui-jp="sparkline" ui-refresh="app.setting.color" ui-options="[2,3,4,6,5,4,3,5,4,3,4,3,4,3,2,2], {type:'line', height:20, width: '70', lineWidth:2, valueSpots:{'0:':'#fff'}, lineColor:'#fff', spotColor:'#fff', fillColor:'transparent', highlightLineColor:'#fff', spotRadius:0}" class="sparkline inline"></span>
            </div>
        </div>
    </div>
    <div class="col-xs-4 bg">
        <div class="p-a-md">
			<span class="pull-right">
				<i class="fa text fa-caret-down text-warn"></i>
			</span>
            <span class="_500">Referrals</span>
            <div class="h3 _700 m-y">
                69k
            </div>
            <div>
                <span ui-jp="sparkline" ui-refresh="app.setting.color" ui-options="[4,4,3,5,4,3,5,3,4,6,5,3,2,3,4,6], {type:'line', height:20, width: '70', lineWidth:2, valueSpots:{'0:':'#fff'}, lineColor:'#fff', spotColor:'#fff', fillColor:'transparent', highlightLineColor:'#fff', spotRadius:0}" class="sparkline inline"></span>
            </div>
        </div>
    </div>
    <div class="col-xs-4 dk">
        <div class="p-a-md">
			<span class="pull-right">
				<i class="fa text fa-caret-down text-danger"></i>
			</span>
            <span class="_500">Members</span>
            <div class="h3 _700 m-y">
                4,560
            </div>
            <div>
                <span ui-jp="sparkline" ui-refresh="app.setting.color" ui-options="[2,1,5,3,4,3,5,4,3,5,6,7,6,4,3,2], {type:'line', height:20, width: '70', lineWidth:2, valueSpots:{'0:':'#fff'}, lineColor:'#fff', spotColor:'#fff', fillColor:'transparent', highlightLineColor:'#fff', spotRadius:0}" class="sparkline inline"></span>
            </div>
        </div>
    </div>
</div>
<div class="row-col primary">
    <div class="col-md-8">
        <div class="row-col">
            <div class="col-sm-6">
                <div class="p-a-md p-r-0">
                    <h6 class="m-b-sm">Sales Overview</h6>
                    <p class="text-sm">
                        <i class="fa fa-caret-down text-warn"></i> <span class="text-muted">Min:</span> $39,050
                        <i class="fa fa-caret-up text-success m-l-sm"></i> <span class="text-muted">Max:</span> $78,560
                    </p>
                    <div class="list no-padding">
                        <div class="list-item">
                            <div class="list-left">
                                <div class="progress progress-xs w-64 m-y-sm">
                                    <div class="progress-bar dark-white" style="width: 45%"></div>
                                </div>
                            </div>
                            <div class="list-body">
                                Google advertise network
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="list-left">
                                <div class="progress progress-xs w-64 m-y-sm">
                                    <div class="progress-bar dark-white" style="width: 25%"></div>
                                </div>
                            </div>
                            <div class="list-body">
                                Apple app store
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="list-left">
                                <div class="progress progress-xs w-64 m-y-sm">
                                    <div class="progress-bar dark-white" style="width: 55%"></div>
                                </div>
                            </div>
                            <div class="list-body">
                                Flatty inc.
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="list-left">
                                <div class="progress progress-xs w-64 m-y-sm">
                                    <div class="progress-bar dark-white" style="width: 35%"></div>
                                </div>
                            </div>
                            <div class="list-body">
                                Other app stores.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 dk">
                <div class="p-a-md">
                    <div class="clearfix m-b-lg">
                        <div class="pull-right">
                            <ul class="nav">
                                <li class="nav-item inline">
                                    <a class="nav-link">
                                        <i class="material-icons md-18">&#xe863;</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <span>Total: $3,000</span>
                    </div>
                    <div ui-jp="plot" ui-refresh="app.setting.color" ui-options="
		              [{data: 10, label: &#x27;Apple&#x27;}, {data: 15, label: &#x27;Google&#x27;}, {data: 35, label: &#x27;Flatty&#x27;}, {data: 45, label: &#x27;Other&#x27;}],
		              {
		                series: { pie: { show: true, tilt: 0.6, offset:{left: -30}, stroke: { width: 0 }, label: { show: true, threshold: 0.05 } } },
		                legend: {backgroundColor: 'transparent'},
		                colors: ['rgba(255,255,255,0.5)','rgba(255,255,255,0.6)','rgba(255,255,255,0.8)','#0cc2aa'],
		                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#fff' },
		                tooltip: true,
		                tooltipOpts: { content: '%s: %p.0%' }
		              }
		            " style="height:200px"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 lt v-b">
        <div class="p-a-md">
            <h6 class="m-b-sm">Market in 2015</h6>
            <small class="text-muted">Quick view of the trending of this year.</small>
        </div>
        <div style="overflow-x:hidden">
            <div style="margin: 0 -2px">
                <div ui-jp="plot" ui-refresh="app.setting.color" ui-options="
	              [
	                {
	                  data: [[1, 6.1], [2, 6.3], [3, 6.4], [4, 6.6], [5, 7.0], [6, 7.7], [7, 8.3]],
	                  points: { show: true, radius: 0},
	                  splines: { show: true, tension: 0.45, lineWidth: 3, fill: 0.1 }
	                }
	              ],
	              {
	                colors: ['#fff'],
	                series: { shadowSize: 3 },
	                xaxis: { show: false, font: { color: '#ccc' }, position: 'bottom' },
	                yaxis:{ show: false, font: { color: '#ccc' }, max:10, min: 2},
	                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },
	                tooltip: true,
	                tooltipOpts: { content: '%x.0 is %y.4',  defaultTheme: false, shifts: { x: 0, y: -40 } }
	              }
	            " style="height:224px" >
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ############ PAGE END-->


