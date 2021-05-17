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

$this->title = 'Process by Python | GTD PREDICTIVE ANALYSIS';
?>

<div class="box b-a white">
    <div class="box-header"></div>
    <div class="box-body">
        <p class="btn-groups text-center">
            <button id="btnUpdate" class="btn btn-outline b-primary text-primary">Update predictions</button>
            <button class="btn btn-outline b-black text-black disabled">Retrain module</button>
        </p>
    </div>
</div>


<!-- RESULTS -->
<div class="text-center">
    <div id="processTime" class="h4 text-center "></div>
    <div id="processResult" class="h3"></div>
</div>



<script type="text/javascript">

    $(document).ready(function() {





        $("#btnUpdate").click(function(){

            $("#processTime").html("0%")
            $("#processTime").show();

            $("#processResult").hide();

            var interval = setInterval(function(){
                if (window.Pace.bar.progress!=100){
                    $("#processTime").html(Math.round(window.Pace.bar.progress)+'%');
                }
            },100);


            var start_time = new Date().getTime();

            jQuery.ajax({
                url: '<?= Url::to( [ '/process/test' ] ); ?>',
                type: 'GET',
                contentType: 'application/json',
//                xhrFields: {
//                    onprogress: function (e) {
//                        //console.log(window.Pace.bar.progress);
//                        if (e.lengthComputable) {
//                            console.log(e.loaded / e.total * 100 + '%');
//                        }
//                    }
//                },
                success: function (data){
//                    #alert(data);
//                    #var request_time = new Date().getTime() - start_time;
//                    alert(request_time);
                      $("#processResult").show();
                      $("#processResult").html(data)

                }
            }).complete(function() {
                $("#processTime").html("0%")
                $("#processTime").hide();
            });
        });

    });
</script>



