<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'MyAngkasa Holdings Sdn Bhd | Corporate Website';
?>

<!-- HEADER CORPORATE -->
<?php echo \frontend\widgets\HeaderCorporate::widget(); ?>

<!-- ARTICLES CONTENT -->
<div ui-view class="app-body page-content white" id="view">


    <!-- SEARC ARTICLE -->
    <div class="light p-a p-x-xl b-b">
        <div class="">

            <div class="row m-x-sm">
                <div class="col-sm-12 col-md-4">
                    <!-- Search -->
                    <div class="input-group w-xxl">
                        <span class="input-group-addon text-muted no-border no-bg"><i class="fa fa-search"></i></span>
                        <div class="organization-search">
                            <input type="text" id="search" placeholder="Search events..." class="form-control text-md no-border no-bg" style="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8">

                    <div class="pull-right m-t-xs">
                        <!-- Types -->
                        <div class="btn-group dropdown">
                            <button class="btn _400 no-bg dropdown-toggle" data-toggle="dropdown">Types</button>
                            <div class="dropdown-menu dropdown-menu-scale pull-right">
                                <a class="dropdown-item">All</a>
                                <a class="dropdown-item">Ongoing</a>
                                <a class="dropdown-item">Upcoming</a>
                                <a class="dropdown-item">This week</a>
                                <a class="dropdown-item">Ended</a>
                            </div>
                        </div>

                        <!-- SORTS -->
                        <div class="btn-group dropdown">
                            <button class="btn _400 no-bg" data-toggle="dropdown"> <i class="fa  fa-sort-amount-desc"></i></button>
                            <div class="dropdown-menu dropdown-menu-scale pull-right">
                                <a class="dropdown-item" href>Alphabatical</a>
                                <a class="dropdown-item" href>Latest</a>
                                <a class="dropdown-item" href>Oldest</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="padding">


        <div class="row">
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                <div class="box card-item list-item p-a-0">
                    <a href="http://ukuya.com/poic/default/events/view/13th-organic-food-manufacturing-conference"
                       class="block img-card item_url b-b b-light"
                       title="13th Organic Food &amp; Manufacturing Conference event Nutiva Inc.">
                        <img class="img-responsive"
                             src="http://ukuyacommunity.s3.amazonaws.com/default/event/502_1468232726.jpg"
                             alt="13th Organic Food &amp; Manufacturing Conference event Nutiva Inc." >
                    </a>
                    <span class="item_status">
                            <span class="label info pull-right m-t-n-sm text-u-c no-radius wrapper-xs" style="position: relative; margin-top:-10px;">event upcoming</span>
                        </span>
                    <div class="box-body">
                        <div style="height:40px; position: relative; overflow: hidden ">
                            <a href="http://ukuya.com/poic/default/events/view/13th-organic-food-manufacturing-conference" title="13th Organic Food &amp; Manufacturing Conference event Nutiva Inc.">
                                <span class="_500">13th Organic Food &amp; Manufacturing Conference</span>
                            </a>
                        </div>
                        <div class="block m-t">
                             <span class="block text-xs text-muted">
                                  <span class="text-muted m-r-xxs"><i class="fa fa-clock-o "></i></span>
                                  <span class="text-u-c item_started">May 18 9:00 am</span>
                             </span>
                            <span class="block text-xs text-muted text-ellipsis">
                              <span class="m-r-xs"><i class="fa fa-map-marker"></i> </span>
                              <span class="item_short_address">Kuala Lumpur MALAYSIA</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                <div class="box card-item list-item p-a-0">
                    <a href="http://ukuya.com/poic/default/events/view/13th-organic-food-manufacturing-conference"
                       class="block img-card item_url b-b b-light"
                       title="13th Organic Food &amp; Manufacturing Conference event Nutiva Inc.">
                        <img class="img-responsive"
                             src="http://ukuyacommunity.s3.amazonaws.com/default/event/502_1468232726.jpg"
                             alt="13th Organic Food &amp; Manufacturing Conference event Nutiva Inc." >
                    </a>
                    <span class="item_status">
                            <span class="label info pull-right m-t-n-sm text-u-c no-radius wrapper-xs" style="position: relative; margin-top:-10px;">event upcoming</span>
                        </span>
                    <div class="box-body">
                        <div style="height:40px; position: relative; overflow: hidden ">
                            <a href="http://ukuya.com/poic/default/events/view/13th-organic-food-manufacturing-conference" title="13th Organic Food &amp; Manufacturing Conference event Nutiva Inc.">
                                <span class="_500">13th Organic Food &amp; Manufacturing Conference</span>
                            </a>
                        </div>
                        <div class="block m-t">
                                 <span class="block text-xs text-muted">
                                      <span class="text-muted m-r-xxs"><i class="fa fa-clock-o "></i></span>
                                      <span class="text-u-c item_started">May 18 9:00 am</span>
                                 </span>
                            <span class="block text-xs text-muted text-ellipsis">
                                  <span class="m-r-xs"><i class="fa fa-map-marker"></i> </span>
                                  <span class="item_short_address">Kuala Lumpur MALAYSIA</span>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                <div class="box card-item list-item p-a-0">
                    <a href="http://ukuya.com/poic/default/events/view/13th-organic-food-manufacturing-conference"
                       class="block img-card item_url b-b b-light"
                       title="13th Organic Food &amp; Manufacturing Conference event Nutiva Inc.">
                        <img class="img-responsive"
                             src="http://ukuyacommunity.s3.amazonaws.com/default/event/502_1468232726.jpg"
                             alt="13th Organic Food &amp; Manufacturing Conference event Nutiva Inc." >
                    </a>
                    <span class="item_status">
                            <span class="label info pull-right m-t-n-sm text-u-c no-radius wrapper-xs" style="position: relative; margin-top:-10px;">event upcoming</span>
                        </span>
                    <div class="box-body">
                        <div style="height:40px; position: relative; overflow: hidden ">
                            <a href="http://ukuya.com/poic/default/events/view/13th-organic-food-manufacturing-conference" title="13th Organic Food &amp; Manufacturing Conference event Nutiva Inc.">
                                <span class="_500">13th Organic Food &amp; Manufacturing Conference</span>
                            </a>
                        </div>
                        <div class="block m-t">
                                 <span class="block text-xs text-muted">
                                      <span class="text-muted m-r-xxs"><i class="fa fa-clock-o "></i></span>
                                      <span class="text-u-c item_started">May 18 9:00 am</span>
                                 </span>
                            <span class="block text-xs text-muted text-ellipsis">
                                  <span class="m-r-xs"><i class="fa fa-map-marker"></i> </span>
                                  <span class="item_short_address">Kuala Lumpur MALAYSIA</span>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                <div class="box card-item list-item p-a-0">
                    <a href="http://ukuya.com/poic/default/events/view/13th-organic-food-manufacturing-conference"
                       class="block img-card item_url b-b b-light"
                       title="13th Organic Food &amp; Manufacturing Conference event Nutiva Inc.">
                        <img class="img-responsive"
                             src="http://ukuyacommunity.s3.amazonaws.com/default/event/502_1468232726.jpg"
                             alt="13th Organic Food &amp; Manufacturing Conference event Nutiva Inc." >
                    </a>
                    <span class="item_status">
                            <span class="label info pull-right m-t-n-sm text-u-c no-radius wrapper-xs" style="position: relative; margin-top:-10px;">event upcoming</span>
                        </span>
                    <div class="box-body">
                        <div style="height:40px; position: relative; overflow: hidden ">
                            <a href="http://ukuya.com/poic/default/events/view/13th-organic-food-manufacturing-conference" title="13th Organic Food &amp; Manufacturing Conference event Nutiva Inc.">
                                <span class="_500">13th Organic Food &amp; Manufacturing Conference</span>
                            </a>
                        </div>
                        <div class="block m-t">
                                 <span class="block text-xs text-muted">
                                      <span class="text-muted m-r-xxs"><i class="fa fa-clock-o "></i></span>
                                      <span class="text-u-c item_started">May 18 9:00 am</span>
                                 </span>
                            <span class="block text-xs text-muted text-ellipsis">
                                  <span class="m-r-xs"><i class="fa fa-map-marker"></i> </span>
                                  <span class="item_short_address">Kuala Lumpur MALAYSIA</span>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- preloader -->
            <div class="pull-center m-y-lg preloader"></div>

    </div>
</div>

<!-- FOOTER CORPORATE -->
<div class="" id="contact">
    <?php echo \frontend\widgets\FooterCorporate::widget(); ?>
</div>
