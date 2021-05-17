<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/9/2017
 * Time: 7:30 PM
 */

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'DASHBOARD | GTD PREDICTIVE ANALYSIS';
?>

<div class="row">
    <div class="col-xs-12 col-sm-4">
        <div class="box p-a">
            <div class="pull-left m-r">
	            <span class="w-48 rounded  accent">
	              <i class="material-icons"></i>
	            </span>
            </div>
            <div class="clear">
                <h4 class="m-a-0 text-lg _300"><?=number_format($count_failures_notnull)?> <span class="text-sm">Total Failures</span></h4>
                <small class="text-muted">from <?=number_format($count_failures_all)?> records</small>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-4">
        <div class="box p-a">
            <div class="pull-left m-r">
	            <span class="w-48 rounded primary">
	              <i class="material-icons"></i>
	            </span>
            </div>
            <div class="clear">
                <h4 class="m-a-0 text-lg _300"><a href=""><?=number_format($transactions_sum_failured_pump)?><span class="text-sm"> Transactions</span></a></h4>
                <small class="text-muted">from <span><?=number_format($transactions_sum_all, 0)?></span> transactions</small>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-4">
        <div class="box p-a">
            <div class="pull-left m-r">
	            <span class="w-48 rounded warn">
	              <i class="material-icons"></i>
	            </span>
            </div>
            <div class="clear">
                <h4 class="m-a-0 text-lg _300"><a href=""><?=number_format($total_parts_notnull)?> <span class="text-sm">Equipments Repaired</span></a></h4>
                <small class="text-muted">Total <?=number_format($total_parts_all)?> Replacements</small>
            </div>
        </div>
    </div>
</div>

<!-- GRAPHS -->
<div class="box b-a">
    <div class="box-header">
        <h3>Number of Failures</h3>
        <small>Presented number of existing and predicted failures for each petrol station.</small>
    </div>
    <div class="box-body white">

        <div id="chart-container">
            <canvas id="graphCanvas" style="width:100%;height:100%"></canvas>
        </div>
    </div>
</div>



<!-- Response -->
<div id="petrol-data" class=""></div>

<script type="text/javascript">
    $(document).ready(function () {
        //showGraph();
    });


    $.ajax('<?= Url::to( [ '/api/failuretotal' ] ); ?>').done(function (data) {
        var chartdata = {
            labels: data.station_id,
            datasets: [
                {
                    label: 'Number of Failures',
                    backgroundColor: '#2ec7c9',
                    borderColor: '#07a2a4',
                    hoverBackgroundColor: '#f77a99', //'#59678c',
                    hoverBorderColor: '#f44455',
                    data: data.num_failure
                }
            ]
        };

        var graphTarget = $("#graphCanvas");

        var barGraph = new Chart(graphTarget, {
            type: 'bar',
            data: chartdata,
            options: {
                "hover": {
                    "animationDuration": 0,
                     onHover: function(e) {
                        var point = this.getElementAtEvent(e);
                        if (point.length) e.target.style.cursor = 'pointer';
                        else e.target.style.cursor = 'default';
                    }
                },
                "animation": {
                    "duration": 1,
                    "onComplete": function() {
                        var chartInstance = this.chart,
                            ctx = chartInstance.ctx;

                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function(dataset, i) {
                            var meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function(bar, index) {
                                var data = dataset.data[index];
                                ctx.fillText(data, bar._model.x, bar._model.y - 5);
                            });
                        });
                    }
                },
                legend: {
                    "display": false,
                    onHover: function(e) {
                        e.target.style.cursor = 'pointer';
                    }
                },
                tooltips: {
                    "enabled": true
                },
                scales: {
                    yAxes: [{
                        display: true,
                        gridLines: {
                            display: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Num. of Failures',
                            fontColor: "#aaa",
                            fontSize:11
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            beginAtZero: true
                        },

                        scaleLabel: {
                            display: true,
                            labelString: 'Stations',
                            fontColor: "#aaa",
                            fontSize:11
                        }
                    }]
                },
                onClick: function(c,i) {
                    e = i[0];
                    var x_value = this.data.labels[e._index];
                    var y_value = this.data.datasets[0].data[e._index];
                    getReport(e._index,x_value,y_value)
                }
            }
        });

    });

    function getReport(index,x,y) {
        $.ajax({
            method: "POST",
            url: "<?= Url::to(['/dashboard/petrol']); ?>",
            data: {'dataset': index, 'station_id':x, 'total_failure':y}
        }).done(function (response) {
            $("#petrol-data").html(response);
        });
    }

    




</script>

<!-- ############ PAGE END-->


