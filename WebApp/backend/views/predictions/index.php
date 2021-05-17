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


    <script type="text/javascript">

        var todayDate = moment();

    	$(document).ready(function() {
    prediction_table = $('#predictions-report').DataTable( {
	        "ajax": {
	        	"url":"<?= Url::to(['/api/predictionreport']); ?>",
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
	} );


    	// To insert more row of data into datatable
    	// var equipments = [];
    	// equipments.push("Nozzle");

    	// prediction_table.row.add(equipments);
    	// prediction_table.draw();

    </script>