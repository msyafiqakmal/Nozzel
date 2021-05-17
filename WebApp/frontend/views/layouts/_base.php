<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\FlatkitAsset;
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
<body>
    <?php $this->beginBody() ?>
    <div class="app" id="app">

        <!-- aside -->
        <div id="aside" class="box-shadow-z3 modal fade lg nav-expand" style="display: none !important;">
            <div class="left navside dark dk" layout="column" style="width: 280px;">
                <div flex class="hide-scroll">
                    <nav class="scroll">

                        <div class="text-center p-a">
                            <!-- brand -->
                            <a class="navbar-brand md" href="<?= Url::to( [ '/site/index' ] ); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="32" height="32">
                                    <path d="M 4 4 L 44 4 L 44 44 Z" fill="#a88add" />
                                    <path d="M 4 4 L 34 4 L 24 24 Z" fill="rgba(0,0,0,0.15)" />
                                    <path d="M 4 4 L 24 4 L 4  44 Z" fill="#0cc2aa" />
                                </svg>
                                <span class="hidden-folded inline">Utunity</span>
                            </a>
                            <!-- / brand -->
                        </div>


                        <ul class="nav">
                           <li class="nav-item">
                                <a class="nav-link text-u-c" href="<?= Url::to( [ '/site/index' ] ); ?>">
                                    <span class="nav-text">Home</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-u-c" href="<?= Url::to( ['/corporate/index' ] ); ?>">
                                    <span class="nav-text">Services</span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link text-u-c" href="<?= Url::to( [ '/listing/index' ] ); ?>">
                                    <span class="nav-text">Portfolio</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-u-c" href="<?= Url::to( [ '/blog/index' ] ); ?>">
                                    <span class="nav-text">Blog</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-u-c" href="<?= Url::to( [ '/site/about' ] ); ?>">
                                    <span class="nav-text">Company</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-u-c" href="<?= Url::to( [ '/site/contact' ] ); ?>">
                                    <span class="nav-text">Contact</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>


            </div>

        </div>

        <!-- content -->
        <div id="content" class="app-content box-shadow-z3" role="main">
            <?= $content ?>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
