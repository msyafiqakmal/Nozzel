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

$this->title = 'Report Failure | GTD PREDICTIVE ANALYSIS';
?>

<div class="row">
    <div class="col-sm-6">

        <div class="box b-a grey-50">
            <div class="box-body">
                <form class="form-horizontal" action="" method="post" name="uploadCSV"
                      enctype="multipart/form-data">
                    <div class="input-row">
                        <label class="col-md-4 control-label">Choose CSV File</label>
                        <input class="form-control" type="file" name="file" id="file" accept=".csv">
                        <button class="btn btn-sm no-radius m-t black " type="submit" id="upload" name="upload">Upload</button>
                        <br />

                    </div>
                    <div id="labelError"></div>
                </form>
            </div>
        </div>




    </div>
    <div class="col-sm-6 p-x-lg">


                <div class="box b-a b-danger">
                    <div class="box-header">
                        <?=$message?>
                    </div>
                    <?php if (isset($total_uploads) and $total_uploads>0 ):?>
                        <div class="box-body text-center">
                            <span class="block m-b h4 _300">Number uploaded records</span>
                            <span class="h3"><?=$total_uploads?></span>
                        </div>
                        <div class="box-footer text-center">
                            <span>Do you want migrate?</span>
                            <div class="btn-groups m-t">
                                <form class="inline" action="" method="post">
                                    <button class="btn btn-fw no-radius btn-outline b-danger text-danger" type="submit" id="clean" name="clean">Clean</button>
                                </form>
                                <form class="inline" action="" method="post">
                                    <button class="btn btn-fw no-radius blue" type="submit" id="migrate" name="migrate">Migrate</button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

    </div>
</div>




<script type="text/javascript">
$(document).ready(function() {
        $("#frmCSVImport").on("submit",function() {

            $("#response").attr("class", "");
            $("#response").html("");

            var fileType = ".csv";
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+("+ fileType + ")$");

            if (!regex.test($("#file").val().toLowerCase())) {
                $("#response").addClass("error");
                $("#response").addClass("display-block");
                $("#response").html("Invalid File. Upload : <b>" + fileType+ "</b> Files.");
                return false;
            }
            return true;
        });
});
</script>