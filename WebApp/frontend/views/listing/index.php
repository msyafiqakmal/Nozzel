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

$this->title = 'Services | Enterprise Apps Design & Development';
?>
<div class="box-header p-a white b-b box-shadow box-shadow-z3 b-a">
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <!-- Search -->
            <div class="input-group w-xxl">
                <span class="input-group-addon no-border no-bg"><i class="fa fa-search"></i></span>
                <div class="organization-search">
                    <input type="text" id="search" placeholder="Search organizations..." class="form-control text-lg no-border no-bg" style="">
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8">

            <div class="pull-right m-t-xs">
                <!-- industry -->
                <div class="btn-group dropdown">
                    <button class="btn no-bg dropdown-toggle" data-toggle="dropdown">Industries</button>
                    <div class="dropdown-menu dropdown-menu-scale w-xl p-a-0">
                        <a class="dropdown-item">Industry 1</a>
                        <a class="dropdown-item">Industry 2</a>
                        <a class="dropdown-item">Industry 3</a>
                        <a class="dropdown-item">Industry 4</a>
                        <a class="dropdown-item">Industry 5</a>
                        <div class="box-footer light m-t b-t p-y-sm">
                            <input class="form-control" placeholder="search for industry">
                        </div>
                    </div>
                </div>

                <!-- Types -->
                <div class="btn-group dropdown">
                    <button class="btn no-bg dropdown-toggle" data-toggle="dropdown">Types</button>
                    <div class="dropdown-menu dropdown-menu-scale w-xl pull-right">
                        <a class="dropdown-item">Foreign Company</a>
                        <a class="dropdown-item">Limited Company</a>
                        <a class="dropdown-item">Limited Liability Partnership</a>
                        <a class="dropdown-item">Partnership</a>
                        <a class="dropdown-item">Sole Proprietorship</a>
                    </div>
                </div>

                <!-- Sectors -->
                <div class="btn-group dropdown">
                    <button class="btn no-bg dropdown-toggle" data-toggle="dropdown">Sectors</button>
                    <div class="dropdown-menu dropdown-menu-scale w-xl pull-right">
                        <a class="dropdown-item">Corporate</a>
                        <a class="dropdown-item">Government</a>
                        <a class="dropdown-item">Non-profit</a>
                        <a class="dropdown-item">Partnership</a>
                        <a class="dropdown-item">Individuals, Groups</a>
                    </div>
                </div>

                <!-- SORTS -->
                <div class="btn-group dropdown">
                    <button class="btn no-bg" data-toggle="dropdown"> <i class="fa  fa-sort-amount-desc"></i></button>
                    <div class="dropdown-menu dropdown-menu-scale pull-right">
                        <a class="dropdown-item" href>Alphabatical</a>
                        <a class="dropdown-item" href>Updated</a>
                        <a class="dropdown-item" href>Location</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class=" padding">

    <!-- ############ PAGE START-->
    <div class="list p-y">

        <!-- ITEM 1 -->
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <a class="box card-item list-item text-left" href="<?= Url::to( [ '/corporate/index' ] ); ?>"  target="_blank">
                <span class="list-left">
                    <span class="block w-64">
                        <img class="img-full img-responsive" src="http://ukuyadev.s3.amazonaws.com/default/organization/1_1475216062.png">
                    </span>
                </span>
                <div class="clear list-body">
                    <div class="block" style="height:100px !important;">
                        <div class="block text-ellipsis m-b-xs text-black _600">1001 Tech Sdn Bhd</div>
                        <div class="block text-ellipsis m-b-xs text-sm text-muted _500">Oil and Gas</div>
                        <div class="block text-ellipsis m-b-xs text-sm text-muted _400">co operative societies</div>
                    </div>
                </div>
                <div class="clear box-footer p-a-xs text-right b-t" style="height:24px !important;">
                    <div class="block text-right text-sm text-sm text-muted">
                        <i class="fa fa-map-marker"></i> Petaling Jaya <span class="text-u-c ng-binding">Malaysia</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- ITEM 2 -->
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <a class="box card-item list-item text-left" href="<?= Url::to( [ '/corporate/index' ] ); ?>"  target="_blank">
                <span class="list-left">
                    <span class="block w-64">
                        <img class="img-full img-responsive" src="http://ukuyadev.s3.amazonaws.com/default/organization/4/585a12cd3d13e-1482298061.jpg">
                    </span>
                </span>
                <div class="clear list-body">
                    <div class="block" style="height:100px !important;">
                        <div class="block text-ellipsis m-b-xs text-black _600">3CTech Solutions Sdn Bhd</div>
                        <div class="block text-ellipsis m-b-xs text-sm text-muted _500">Cloud Computing & Services</div>
                        <div class="block text-ellipsis m-b-xs text-sm text-muted _400">co operative societies</div>
                    </div>
                </div>
                <div class="clear box-footer p-a-xs text-right b-t" style="height:24px !important;">
                    <div class="block text-right text-sm text-sm text-muted">
                        <i class="fa fa-map-marker"></i> Petaling Jaya <span class="text-u-c ng-binding">Malaysia</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- ITEM 3 -->
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <a class="box card-item list-item text-left" href="<?= Url::to( [ '/corporate/index' ] ); ?>"  target="_blank">
                <span class="list-left">
                    <span class="block w-64">
                        <img class="img-full img-responsive" src="https://dummyimage.com/270x270/777777/ffffff.jpg&text=ON">
                    </span>
                </span>
                <div class="clear list-body">
                    <div class="block" style="height:100px !important;">
                        <div class="block text-ellipsis m-b-xs text-black _600">Organization name</div>
                        <div class="block text-ellipsis m-b-xs text-sm text-muted _500">Industry</div>
                        <div class="block text-ellipsis m-b-xs text-sm text-muted _400">sector</div>
                    </div>
                </div>
                <div class="clear box-footer p-a-xs text-right b-t" style="height:24px !important;">
                    <div class="block text-right text-sm text-sm text-muted">
                        <i class="fa fa-map-marker"></i> Petaling Jaya <span class="text-u-c ng-binding">Malaysia</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- ITEM 4 -->
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <a class="box card-item list-item text-left" href="<?= Url::to( [ '/corporate/index' ] ); ?>"  target="_blank">
                <span class="list-left">
                    <span class="block w-64">
                        <img class="img-full img-responsive" src="https://dummyimage.com/270x270/777777/ffffff.jpg&text=ON">
                    </span>
                </span>
                <div class="clear list-body">
                    <div class="block" style="height:100px !important;">
                        <div class="block text-ellipsis m-b-xs text-black _600">Organization name</div>
                        <div class="block text-ellipsis m-b-xs text-sm text-muted _500">Industry</div>
                        <div class="block text-ellipsis m-b-xs text-sm text-muted _400">sector</div>
                    </div>
                </div>
                <div class="clear box-footer p-a-xs text-right b-t" style="height:24px !important;">
                    <div class="block text-right text-sm text-sm text-muted">
                        <i class="fa fa-map-marker"></i> Petaling Jaya <span class="text-u-c ng-binding">Malaysia</span>
                    </div>
                </div>
            </a>
        </div>

    </div>
    <!-- ############ PAGE END-->


</div>

<script type="text/javascript">

</script>
