<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use backend\assets\FlatkitAsset;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

FlatkitAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>

        <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />

        <!-- for ios 7 style, multi-resolution icon of 152x152 -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
        <link rel="apple-touch-icon" href="../assets/images/logo.png">
        <meta name="apple-mobile-web-app-title" content="Flatkit">
        <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
        <meta name="mobile-web-app-capable" content="yes">

        <?php $this->head() ?>
    </head>
    <body class="container">
    <?php $this->beginBody() ?>
    <div class="app" id="app">

        <!-- aside -->
        <?php if (!Yii::$app->user->isGuest) { echo \backend\widgets\Aside::widget(); } ?>
        <!-- / -->

        <!-- content -->
        <div id="content" class="app-content box-shadow-z0" role="main">
            <?php if (!Yii::$app->user->isGuest) { echo \backend\widgets\Header::widget(); }?>
            <?php echo \backend\widgets\Footer::widget(); ?>
            <div ui-view class="app-body" id="view">
                <div class="padding">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>

<?php //echo \frontend\widgets\Header::widget(); ?>
