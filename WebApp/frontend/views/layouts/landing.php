<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<?php $this->beginContent('@frontend/views/layouts/_base.php'); ?>
    <div class="primary" id="home" style="position: relative;">
        <div class="color-overlay"></div>
        <div class="h-v row-col" >

            <div class="row-cell v-b">
                <div class="container p-a-lg pos-rlt text-center">
                    <?php echo \frontend\widgets\HeaderLanding::widget(); ?>

                    <div class="block m-b-lg text-center">
                        <h1 class="_300 l-s-n-1x m-t m-b-md">Find your <span class="text-warn _400" id="typed1">Local Business</span> with us</h1>
                        <h4 class="text-muted m-b-lg _400">Delivering Secure & Scalable Business Directory</h4>

                        <form  method="get" action="<?= Url::to( [ '/listing/index' ] ); ?>">
                            <div class="inline w-xxl">
                                <div class="input-group input-group-lg">
                                    <input type="text" class="form-control b-light no-radius" placeholder="business name"/>
                                </div>
                            </div>
                            <div class="inline w-xxl">
                                <div class="input-group input-group-lg">
                                    <input type="text" class="form-control b-light no-radius" placeholder="location"/>
                                    <span class="input-group-btn">
												<button class="btn dark b-a b-light" type="submit"><i class="fa fa-search"></i> </button>
											  </span>
                                </div>
                            </div>
                        </form>
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
    <div ui-view class="app-body page-content white" id="view">
        <?= $content ?>
    </div>

    <?php echo \frontend\widgets\Footer::widget(); ?>

<?php $this->endContent(); ?>


<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {

        var typed1 = new Typed('#typed1', {
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

