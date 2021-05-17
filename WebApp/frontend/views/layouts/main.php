<?php $this->beginContent('@frontend/views/layouts/_base.php'); ?>

    <div class="app" id="app">
        <div id="content" class="app-content box-shadow-z0" role="main">
            <?php echo \frontend\widgets\Header::widget(); ?>
            <div ui-view class="app-body" id="view" style="min-height: 550px;">
                <?= $content ?>
            </div>
            <?php echo \frontend\widgets\Footer::widget(); ?>
        </div>
    </div>

<?php $this->endContent(); ?>