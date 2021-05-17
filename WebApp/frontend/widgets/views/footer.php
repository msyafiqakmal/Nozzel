<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/9/2017
 * Time: 7:30 PM
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>
<footer class="pos-rlt">

    <div class="footer p-a b-t container">
        <div class="row">
            <div class="col-sm-2 clearfix">
                <!-- brand -->
                <a class="navbar-brand md" href="<?= Url::to( [ '/site/index' ] ); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="32" height="32">
                        <path d="M 4 4 L 44 4 L 44 44 Z" fill="#f77a99" />
                        <path d="M 4 4 L 34 4 L 24 24 Z" fill="rgba(0,0,0,0.15)" />
                        <path d="M 4 4 L 24 4 L 4  44 Z" fill="#fcc100" />
                    </svg>
                </a>
                <!-- / brand -->
            </div>
            <div class="col-sm-8">
                <div class="text-sm-center text-xs-left m-y text-primary-hover">
                    <div class="nav text-sm">
                        <a class="nav-link m-r" href="<?= Url::to( [ '/site/index' ] ); ?>">
                            <span>Home</span>
                        </a>
                        <a class="nav-link m-r" href="<?= Url::to( [ '/listing/index' ] ); ?>">
                            <span>Directory listing</span>
                        </a>
                        <a class="nav-link m-r" href="<?= Url::to( [ '/site/about' ] ); ?>">
                            <span>About us</span>
                        </a>
                        <a class="nav-link m-r" href="<?= Url::to( [ '/site/contact' ] ); ?>">
                            <span>Contact</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="pull-right pull-none-xs inline m-y">
                    <a href class="btn btn-icon btn-social rounded btn-sm white">
                        <i class="fa fa-facebook"></i>
                        <i class="fa fa-facebook indigo"></i>
                    </a>
                    <a href class="btn btn-icon btn-social rounded btn-sm white">
                        <i class="fa fa-twitter"></i>
                        <i class="fa fa-twitter light-blue"></i>
                    </a>
                    <a href class="btn btn-icon btn-social rounded btn-sm white">
                        <i class="fa fa-google-plus"></i>
                        <i class="fa fa-google-plus red"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="m-y"></div>
        <div class="text-center">
            <small class="text-muted">&copy; <?= date('Y')?> <?= Html::encode(Yii::$app->name) ?> by UKUYA</small>
        </div>
    </div>
</footer>