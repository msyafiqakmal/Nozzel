<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/9/2017
 * Time: 7:30 PM
 */

use yii\helpers\Url;
use yii\helpers\Html;
?>


<!-- DATA per Petrol Station -->
<?php

$num_pumps=count($station_data);
$business_name=$station_data[0]['business_partner_name'];


?>




<div class="box b-a">
    <div class="box-header">
        <div class="b-b b-primary nav-active-primary">
            <div class="h5"><span class="text-muted">Predictive Analysis:</span> <span><?=$business_name?></span></div>
        </div>

    </div>
    <div class="tab-content p-a m-b-md">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                <div class="box white">
<!--                    <div class="box-header dker b-b">--><?//=$station_id?><!--</div>-->
                    <div class="box-body lter">
                        <div class="streamline b-l m-l">

                            <div class="sl-item b-info">
                                <div class="sl-content">
                                    <div class="sl-date text-muted">Station ID</div>
                                    <div class="text-md"><?=$station_id?></div>
                                </div>
                            </div>
                            <div class="sl-item b-warning">
                                <div class="sl-content">
                                    <div class="sl-date text-muted">Num. of Pumps</div>
                                    <div class="text-md"><?=$num_pumps?></div>
                                </div>
                            </div>
                            <div class="sl-item b-warning">
                                <div class="sl-content">
                                    <div class="sl-date text-muted">Num. Reported Failures</div>
                                    <div class="text-md"><?=$total_failure?></div>
                                </div>
                            </div>
                            <div class="sl-item b-warning">
                                <div class="sl-content">
                                    <div class="sl-date text-muted"><span class="text-md">Primax 95</span><br/> Num. Pump predicted</div>
                                    <div class="text-md">
                                        <span id="num_pump_predicted_95" class="_500">
                                            <span class="text-muted">No Data</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="sl-item b-warning">
                                <div class="sl-content">
                                    <div class="sl-date text-muted"><span class="text-md">Primax 97</span><br/> Num. Pump predicted</div>
                                    <div class="text-md">
                                        <span id="num_pump_predicted_97" class="_500">
                                            <span class="text-muted">No Data</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="sl-item b-warning">
                                <div class="sl-content">
                                    <div class="sl-date text-muted"><span class="text-md">Diesel</span><br/> Num. Pump predicted</div>
                                    <div class="text-md">
                                        <span id="num_pump_predicted_90" class="_500">
                                            <span class="text-muted">No Data</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

<!--                <div class="pie-chart-container">-->
<!--                    <canvas id="pie-chartcanvas-1"></canvas>-->
<!--                </div>-->
            </div>
            <div class="col-xs-12 col-md-9">
                <div class="box b-a lime-50" id="chart_box_95">
                    <canvas id="station_summary_95" style="width:100%;height:320px"></canvas>
                </div>
                <div class="box b-a cyan-50" id="chart_box_97">
                    <canvas id="station_summary_97" style="width:100%;height:320px"></canvas>
                </div>
                <div class="box b-a green-50" id="chart_box_90">
                    <canvas id="station_summary_90" style="width:100%;height:320px"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>


<form id="gas-select" class="p-x-xs">
<div class="form-group row">
      <label class="col-sm-2 form-control-label">Gas type</label>
      <div class="col-sm-10">
        <select name="gas_type" id="gas_type" class="form-control input-c">
          <option value="95" selected>Primax 95</option>
          <option value="97">Primax 97</option>
          <option value="90">Diesel</option>
        </select>
      </div>
</div>
</form>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<table id="predictions-report" class="display table table-striped b-t b-b" style="width:100%">
        <thead>
            <tr>
                <th>Business Partner Name</th>
                <th>Pump</th>
                <th>Equipment</th>
                <th>Gas Type</th>
                <th>Completion Date</th>
                <th>Lifetime Prediction</th>
                <th>Expected Failure</th>
                <th>Remaining Expected Life</th>

            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Business Partner Name</th>
                <th>Pump</th>
                <th>Equipment</th>
                <th>Gas Type</th>
                <th>Completion Date</th>
                <th>Lifetime Prediction</th>
                <th>Expected Failure</th>
                <th>Remaining Expected Life</th>

            </tr>
        </tfoot>
</table>


<!-- SUMMARY CHARTS PER GAS TYPE -->
<script type="text/javascript">
    //UPDATE 95
    $.ajax({
        method: "POST",
        url: "<?= Url::to(['/api/stationsummary']); ?>",
        data: {'dataset': '<?=$dataset?>', 'station_id':'<?=$station_id?>', 'total_failure':'<?=$total_failure?>', 'gas_type':'95'}
    }).done(function (data) {

        if (data!=0){
            $("#num_pump_predicted_95").html(data.pump.length)
            var chartdata_95= {
                labels : data.pump,
                datasets : [
                    {
                        type: 'line',
                        label : "Predicted",
                        data : data.lifetime_predicted,
                        backgroundColor : "#f44455",
                        borderColor : "#f77a99",
                        fill : false,
                        lineTension : 0,
                        pointRadius : 5
                    },
                    {
                        type: 'bar',
                        label : "Latest",
                        data : data.lifetime,
                        backgroundColor : "rgba(0, 0, 0, 0.1)",
                        borderColor : "rgba(0,0,0,0.5)",
                        //fill : false,
                        //lineTension : 0,
                        //pointRadius : 5
                    }
                ]
            };

            var options_95 = {
                "hover": {
                    "animationDuration": 0,
                    onHover: function(e) {
                        var point = this.getElementAtEvent(e);
                        if (point.length) e.target.style.cursor = 'pointer';
                        else e.target.style.cursor = 'default';
                    }
                },
                title : {
                    display : true,
                    position : "top",
                    text : "Primax 95",
                    fontSize : 16,
                    fontColor : "#000"
                },
                legend : {
                    display : true,
                    position : "top",
                    onHover: function(e) {
                        e.target.style.cursor = 'pointer';
                    }
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return 'Pump ' +value;
                            }
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Num. of Days',
                            fontColor: "#aaa",
                            fontSize:11
                        }
                    }],
                }
            };

            if (chart_95) {
                chart_95.destroy();
            }
            var ctx_95 = $('#station_summary_95');
            var chart_95 = new Chart( ctx_95, {
                type : "bar",
                data : chartdata_95,
                options : options_95
            });
        } else {
            $('#chart_box_95').html('<div class="p-a text-center">No Data for <span class="font-weight-bold">Primax 95</span></div>');
        }
    });


    //UPDATE 97
    $.ajax({
        method: "POST",
        url: "<?= Url::to(['/api/stationsummary']); ?>",
        data: {'dataset': '<?=$dataset?>', 'station_id':'<?=$station_id?>', 'total_failure':'<?=$total_failure?>', 'gas_type':'97'}
    }).done(function (data) {

        if (data!=0) {

            $("#num_pump_predicted_97").html(data.pump.length)
            var chartdata_97 = {
                labels: data.pump,
                datasets: [
                    {
                        type: 'line',
                        label: "Predicted",
                        data: data.lifetime_predicted,
                        backgroundColor: "#f44455",
                        borderColor: "#f77a99",
                        fill: false,
                        lineTension: 0,
                        pointRadius: 5
                    },
                    {
                        type: 'bar',
                        label: "Latest",
                        data: data.lifetime,
                        backgroundColor: "rgba(0, 0, 0, 0.1)",
                        borderColor: "rgba(0,0,0,0.5)",
                        //fill : false,
                        //lineTension : 0,
                        //pointRadius : 5
                    }
                ]
            };

            var options_97 = {
                "hover": {
                    "animationDuration": 0,
                    onHover: function (e) {
                        var point = this.getElementAtEvent(e);
                        if (point.length) e.target.style.cursor = 'pointer';
                        else e.target.style.cursor = 'default';
                    }
                },
                title: {
                    display: true,
                    position: "top",
                    text: "Primax 97",
                    fontSize: 16,
                    fontColor: "#000"
                },
                legend: {
                    display: true,
                    position: "top",
                    onHover: function (e) {
                        e.target.style.cursor = 'pointer';
                    }
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            // Include a dollar sign in the ticks
                            callback: function (value, index, values) {
                                return 'Pump ' + value;
                            }
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Num. of Days',
                            fontColor: "#aaa",
                            fontSize: 11
                        }
                    }],
                }
            };

            if (chart_97) {
                chart_97.destroy();
            }
            var ctx_97 = $('#station_summary_97');
            var chart_97 = new Chart(ctx_97, {
                type: "bar",
                data: chartdata_97,
                options: options_97
            });
        } else {
            $('#chart_box_97').html('<div class="p-a text-center">No Data for <span class="font-weight-bold">Primax 97</span></div>');
        }
    });


    // UPDATE 90
    $.ajax({
        method: "POST",
        url: "<?= Url::to(['/api/stationsummary']); ?>",
        data: {'dataset': '<?=$dataset?>', 'station_id':'<?=$station_id?>', 'total_failure':'<?=$total_failure?>', 'gas_type':'90'}
    }).done(function (data) {

        if (data!=0){
            $("#num_pump_predicted_90").html(data.pump.length)
            var chartdata_90= {
                labels : data.pump,
                datasets : [
                    {
                        type: 'line',
                        label : "Predicted",
                        data : data.lifetime_predicted,
                        backgroundColor : "#f44455",
                        borderColor : "#f77a99",
                        fill : false,
                        lineTension : 0,
                        pointRadius : 5
                    },
                    {
                        type: 'bar',
                        label : "Latest",
                        data : data.lifetime,
                        backgroundColor : "rgba(0, 0, 0, 0.1)",
                        borderColor : "rgba(0,0,0,0.5)",
                        //fill : false,
                        //lineTension : 0,
                        //pointRadius : 5
                    }
                ]
            };

            var options_90 = {
                "hover": {
                    "animationDuration": 0,
                    onHover: function(e) {
                        var point = this.getElementAtEvent(e);
                        if (point.length) e.target.style.cursor = 'pointer';
                        else e.target.style.cursor = 'default';
                    }
                },
                title : {
                    display : true,
                    position : "top",
                    text : "Diesel",
                    fontSize : 16,
                    fontColor : "#000"
                },
                legend : {
                    display : true,
                    position : "top",
                    onHover: function(e) {
                        e.target.style.cursor = 'pointer';
                    }
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return 'Pump ' +value;
                            }
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Num. of Days',
                            fontColor: "#aaa",
                            fontSize:11
                        }
                    }],
                }
            };

            if (chart_90) {
                chart_90.destroy();
            }
            var ctx_90 = $('#station_summary_90');
            var chart_90 = new Chart( ctx_90, {
                type : "bar",
                data : chartdata_90,
                options : options_90
            });
        } else {
            $('#chart_box_90').html('<div class="p-a text-center">No Data for <span class="font-weight-bold">Diesel</span></div>');
        }
    });



</script>

<!-- DATA TABLE -->
<script type="text/javascript">

        var todayDate = moment();

        $(document).ready(loadTable($("#gas-select option:selected").val()));

        function loadTable(selected_gas_type){
            // alert("fn loadedddd");
    prediction_table = $('#predictions-report').DataTable( {
        "processing": true,
        "serverSide": false,
            "ajax": {
                "url":"<?= Url::to(['/api/predictionreportbystation']); ?>",
                "type": "POST",
                "data": {
                    'station_id':'<?=$station_id?>',
                    'gas_type':selected_gas_type
                },

                "dataSrc": function ( json ) {
                  for ( var i=0, ien=json.data.length ; i<ien ; i++ ) {
                    // json.data[i][] = 'huehuehue';
                    json.data[i].business_partner_name = json.data[i].business_partner_name;
                    json.data[i].pump = json.data[i].pump;
                    json.data[i].equipment = "Nozzle";
                    json.data[i].gas_type = json.data[i].gas_type;
                    var predict_days = json.data[i].lifetime_predicted;
                    //get last corrective maintenance date, add predict_day into to get failure date
                    var expected_failure = moment(json.data[i].completion_date, "YYYY-MM-DD").add(predict_days, 'days').format("DD/MM/YYYY"); 
                    var completion_date = moment(json.data[i].completion_date, "YYYY-MM-DD").format("DD/MM/YYYY");
                    var label = "green";
                    var todayDate = moment();

                    var remaining_life = moment(expected_failure,"DD/MM/YYYY").diff(todayDate, 'days');


                    if(remaining_life <= 7){
                        label = "red";
                    }else if(remaining_life <= 30){
                        label = "warn";
                    }else{
                        label = "green";
                    }

                    remaining_life = "<span class='label "+label+"'>"+remaining_life+"</span>"; // to add styling inside the table
                    json.data[i].remaining_life = remaining_life;
                    json.data[i].lifetime_predicted = predict_days;
                    json.data[i].expected_failure = expected_failure;
                    json.data[i].completion_date = completion_date;

                    // console.log("AJAX MODIFY TABLE");
                    // console.log("Current data : "+json.data[i].business_partner_name);
                  }
                  return json.data;
                }
            },
            "processing": true,
            "columns": [
                { "data": "business_partner_name" },
                { "data": "pump" },
                { "data": "equipment" },
                { "data": "gas_type" },
                { "data": "completion_date" },
                { "data": "lifetime_predicted" },
                { "data": "expected_failure" },
                { "data": "remaining_life" }
            ]
        } );
        }

        


        // To insert more row of data into datatable
        // var equipments = [];
        // equipments.push("Nozzle");

        // prediction_table.row.add(equipments);
        // prediction_table.draw();

    </script>


<?php
/*
<!-- PIE for GAS TYPE -->
<script type="text/javascript">
    $(function(){

        //get the pie chart canvas
        var ctx1 = $("#pie-chartcanvas-1");

        //pie chart data
        var data1 = {
            labels: ["95", "97", "Disel"],
            datasets: [
                {
                    label: "TeamA Score",
                    data: [10, 50, 25],
                    backgroundColor: [
                        "#DEB887",
                        "#A9A9A9",
                        "#DC143C"
                    ]
                }
            ]
        };


        //options
        var options = {
            //responsive: true,
            title: {
                display: true,
                position: "top",
                text: "Gas Type",
                fontSize: 11,
                fontColor: "#111"
            },
            legend: {
                display: false,
                position: "bottom",
                labels: {
                    fontColor: "#333",
                    fontSize: 11
                }
            }
        };

        if (chart1) {
            chart1.destroy();
        }

        //create Chart class object
        var chart1 = new Chart(ctx1, {
            type: "pie",
            data: data1,
            options: options
        });
    });


    $( "#gas-select" ).change(function() {
        // alert( "In development" );
        prediction_table.destroy();
        loadTable($("#gas-select option:selected").val());
    });
</script>
 */?>



