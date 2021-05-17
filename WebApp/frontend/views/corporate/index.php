<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'MyAngkasa Holdings Sdn Bhd | Corporate Website';
?>

<!-- HOME HEADER -->
<div class="app-header navbar-md white b-b box-shadow box-shadow-z4">
    <div class="container">
        <div class="navbar">
            <!-- Open side - Naviation on mobile -->
            <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up">
                <i class="material-icons">&#xe5d2;</i>
            </a>
            <!-- / -->

            <!-- brand -->
            <a class="navbar-brand md" href="<?= Url::to( [ '/corporate/index' ] ); ?>">
                <img src="http://ukuyacommunity.s3.amazonaws.com/default/organization/13443/58c0ad7a3a374-1489022330.png">
                <span class="hidden-folded inline">MyAngkasa Holdings Sdn Bhd</span>
            </a>
            <!-- / brand -->


            <!-- navbar collapse -->
            <div class="collapse navbar-toggleable-sm text-center no-bg text-dark-hover" id="navbar-1">
                <!-- link and dropdown -->
                <ul class="nav navbar-nav nav-active-border top b-dark pull-right m-r-lg">
                    <li class="nav-item">
                        <a class="nav-link text-u-c" href="#home-corporate" ui-scroll-to="home-corporate">
                            <span class="nav-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-u-c" href="#articles" ui-scroll-to="articles">
                            <span class="nav-text">Articles</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-u-c" href="#events" ui-scroll-to="events">
                            <span class="nav-text">Events</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-u-c" href="#contact" ui-scroll-to="contact">
                            <span class="nav-text">Contact</span>
                        </a>
                    </li>
                </ul>
                <!-- / link and dropdown -->
            </div>
            <!-- / navbar collapse -->
        </div>
    </div>
</div>

<!-- HOME SLIDER -->
<div class="primary"
     id="home-corporate"
     style="position: relative;"
>
    <div class="color-overlay"></div>
    <div class="h-v row-col" >

        <div class="row-cell v-b">
            <div class="container p-a-lg pos-rlt text-center">


                <div class="block m-b-lg text-center">
                    <div class="center-block w-128 m-t-lg animated fadeInDown">
                        <img class="b-a b-light b-3x img-responsive" alt="." src="http://ukuyacommunity.s3.amazonaws.com/default/organization/13443/58c0ad7a3a374-1489022330.png">
                    </div>
                    <h4 class="display-4 _700 l-s-n-3x m-t m-b-md animated fadeInDown" data-delay="300" data-animation="fadeInDown" data-ride="animated">
                            <span class="text-white ng-binding" style="text-shadow: 0px 10px 5px rgba(0,0,0,0.2), 10px 15px 5px rgba(0,0,0,0.05),-10px 15px 5px rgba(0,0,0,0.05);">
                                MyAngkasa Holdings Sdn Bhd
                            </span>
                    </h4>

                    <h4 class="text-muted m-b-lg _400">Logan of the company if its exist in system</h4>

                </div>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>

            </div>
        </div>
    </div>
</div>


<!-- HOME CONTENT -->
<div ui-view class="page-content white" id="view">

        <div class="p-a p-t-lg b-b grey-300 box-shadow box-shadow-z3">
            <div class="container text-lg text-center">
                <div class="row">
                    <div class="col-md-3 m-b">
                        <span class="block text-u-c text-xs">Type</span>
                        <span class="block text-uc h4">Limited Company</span>
                    </div>
                    <div class="col-md-3 m-b">
                        <span class="block text-u-c text-xs">Industry</span>
                        <span class="block text-uc h4">Automotive</span>
                    </div>
                    <div class="col-md-3 m-b">
                        <span class="block text-u-c text-xs">Founded</span>
                        <span class="block text-uc h4">2011</span>
                    </div>
                    <div class="col-md-3 m-b">
                        <span class="block text-u-c text-xs">Registration</span>
                        <span class="block text-uc h4">938663-H</span>
                    </div>
                </div>
            </div>
        </div>


        <!-- ABOUT US -->
        <div class="padding p-t-lg p-b-0 light">
            <div class="container text-lg text-center p-x-lg">
                <p>MyANGKASA Holdings Sdn Bhd (MHSB) is a holding company owned 100% by the National Cooperative Malaysia Berhad (ANGKASA) founded on December 2012.</p>
                <p>holding company owned 100% by the National Cooperative Malaysia Berhad (ANGKASA) founded on December 2012.</p>
            </div>
        </div>


        <!-- Articles -->
        <div class="padding light" id="articles" >
            <div class="divider m-t-lg"></div>
            <div class="box-header m-b text-center">
                <span class="text-u-c h3 _300">Articles</span>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="box card-item list-item text-left">
                        <a class="block img-card b-b b-light" href="http://ukuya.com/poic/default/post/view/nutiva-foundation-building-strong-communities" title="NUTIVA FOUNDATION: Building Strong Communities">
                            <img class="img-responsive" src="http://nutivakitchen.wpengine.com/wp-content/uploads/2014/02/05_jeremy-and-boys-cornfield-1024x576.jpg" alt="NUTIVA FOUNDATION: Building Strong Communities">
                        </a>

                        <div class="box-body">
                            <a class="text-black" href="http://ukuya.com/poic/default/post/view/nutiva-foundation-building-strong-communities" title="NUTIVA FOUNDATION: Building Strong Communities">
                                <span class="_500">NUTIVA FOUNDATION: Building Strong Communities</span>
                            </a>
                            <div class="text-right text-muted text-xs">
                                <i class="i i-clock2 m-r-xs"></i> <span class="item_modified">Jul 11</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="box card-item list-item text-left">
                        <a class="block img-card b-b b-light" href="http://ukuya.com/poic/default/post/view/nutiva-foundation-building-strong-communities" title="NUTIVA FOUNDATION: Building Strong Communities">
                            <img class="img-responsive" src="http://nutivakitchen.wpengine.com/wp-content/uploads/2014/02/05_jeremy-and-boys-cornfield-1024x576.jpg" alt="NUTIVA FOUNDATION: Building Strong Communities">
                        </a>

                        <div class="box-body">
                            <a class="text-black" href="http://ukuya.com/poic/default/post/view/nutiva-foundation-building-strong-communities" title="NUTIVA FOUNDATION: Building Strong Communities">
                                <span class="_500">NUTIVA FOUNDATION: Building Strong Communities</span>
                            </a>
                            <div class="text-right text-muted text-xs">
                                <i class="i i-clock2 m-r-xs"></i> <span class="item_modified">Jul 11</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="box card-item list-item text-left">
                        <a class="block img-card b-b b-light" href="http://ukuya.com/poic/default/post/view/nutiva-foundation-building-strong-communities" title="NUTIVA FOUNDATION: Building Strong Communities">
                            <img class="img-responsive" src="http://nutivakitchen.wpengine.com/wp-content/uploads/2014/02/05_jeremy-and-boys-cornfield-1024x576.jpg" alt="NUTIVA FOUNDATION: Building Strong Communities">
                        </a>

                        <div class="box-body">
                            <a class="text-black" href="http://ukuya.com/poic/default/post/view/nutiva-foundation-building-strong-communities" title="NUTIVA FOUNDATION: Building Strong Communities">
                                <span class="_500">NUTIVA FOUNDATION: Building Strong Communities</span>
                            </a>
                            <div class="text-right text-muted text-xs">
                                <i class="i i-clock2 m-r-xs"></i> <span class="item_modified">Jul 11</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="box card-item list-item text-left">
                        <a class="block img-card b-b b-light" href="http://ukuya.com/poic/default/post/view/nutiva-foundation-building-strong-communities" title="NUTIVA FOUNDATION: Building Strong Communities">
                            <img class="img-responsive" src="http://nutivakitchen.wpengine.com/wp-content/uploads/2014/02/05_jeremy-and-boys-cornfield-1024x576.jpg" alt="NUTIVA FOUNDATION: Building Strong Communities">
                        </a>

                        <div class="box-body">
                            <a class="text-black" href="http://ukuya.com/poic/default/post/view/nutiva-foundation-building-strong-communities" title="NUTIVA FOUNDATION: Building Strong Communities">
                                <span class="_500">NUTIVA FOUNDATION: Building Strong Communities</span>
                            </a>
                            <div class="text-right text-muted text-xs">
                                <i class="i i-clock2 m-r-xs"></i> <span class="item_modified">Jul 11</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer text-center">
                <a class="btn btn-outline b-black text-black no-radius" href="<?= Url::to( [ '/corporate/articles' ] ); ?>">more articles</a>
            </div>
        </div>
        <!-- /Articles -->


        <!-- Events -->
        <div class="padding light grey-200" id="events">
            <div class="divider m-t-lg"></div>
            <div class="box-header m-b text-center">
                <span class="text-u-c h3 _300">Events</span>
            </div>
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
            <div class="box-footer text-center">
                <a class="btn btn-outline b-black text-black no-radius" href="<?= Url::to( [ '/corporate/events' ] ); ?>">more events</a>
            </div>
        </div>
        <!-- /Events -->

</div>

<!-- FOOTER CORPORATE -->
<div class="" id="contact">
<?php echo \frontend\widgets\FooterCorporate::widget(); ?>
</div>


<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {

        var typed1 = new Typed('#typedCorporate', {
            strings: ['Business Partners', 'Investors', 'Opportunities', 'Local Business'],
            typeSpeed: 30,
            backSpeed: 10,
            backDelay: 1500,
            startDelay: 2000,
            loop: false,
            fadeOut: true,
            loop: true
        });

    });
</script>