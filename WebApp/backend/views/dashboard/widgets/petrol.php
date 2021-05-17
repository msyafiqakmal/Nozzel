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
<div class="box b-a">
    <div class="box-header">
        <div class="b-b b-primary nav-active-primary">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="" data-toggle="tab" data-target="#tab1">Predictive Analysis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="" data-toggle="tab" data-target="#tab2">Failures Summary</a>
                </li>
            </ul>
        </div>

    </div>
    <div class="tab-content p-a m-b-md">
        <div class="tab-pane animated fadeIn text-muted active" id="tab1">
            <div id="chart-container">
                <canvas id="mycanvas" style="width:100%;height:100%"></canvas>
            </div>

        </div>
        <div class="tab-pane animated fadeIn text-muted " id="tab2">
            Components
        </div>

    </div>
</div>


<script type="text/javascript">

    $.ajax({
        method: "GET",
        url: "<?= Url::to(['/api/stationsummary']); ?>",
        data: {'dataset': <?=$dataset?>, 'station_id':<?=$station_id?>, 'total_failure':<?=$total_failure?>}
    }).done(function (response) {
        $("#petrol-data").html(response);
    });


    var testid = [1,2,3,4,5];
    var readspeed = [6,7,8,9,10];
    var writespeed = [4,5,6,7,8];

    var chartdata = {
        labels : testid,
        datasets : [
            {
                label : "Read Speed in Gbps",
                data : readspeed,
                backgroundColor : "blue",
                borderColor : "lightblue",
                fill : false,
                lineTension : 0,
                pointRadius : 5
            }

            ,{
                label : "Write Speed in Mbps",
                data : writespeed,
                backgroundColor : "blue",
                borderColor : "darkblue",
                fill : false,
                lineTension : 0,
                pointRadius : 5
            }
        ]
    };

    var options = {
        title : {
            display : true,
            position : "top",
            text : "New Test Results",
            fontSize : 18,
            fontColor : "#111"
        },
        legend : {
            display : true,
            position : "bottom"
        }
    };

    if (chart) {
        chart.destroy();
    }
    var ctx = $('#mycanvas');
    var chart = new Chart( ctx, {
        type : "bar",
        data : chartdata,
        options : options
    });



</script>


