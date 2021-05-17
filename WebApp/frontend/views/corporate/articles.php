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
                            <input type="text" id="search" placeholder="Search articles..." class="form-control text-md no-border no-bg" style="">
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
                                <a class="dropdown-item">Blog Articles</a>
                                <a class="dropdown-item">Group Articles</a>
                                <a class="dropdown-item">Organization Articles</a>
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

            <!-- preloader -->
            <div class="pull-center m-y-lg preloader"></div>

    </div>
</div>

<!-- FOOTER CORPORATE -->
<div class="" id="contact">
    <?php echo \frontend\widgets\FooterCorporate::widget(); ?>
</div>
