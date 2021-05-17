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
                        <a class="nav-link text-u-c" href="<?= Url::to( [ '/corporate/index' ] ); ?>">
                            <span class="nav-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-u-c" href="<?= Url::to( [ '/corporate/articles' ] ); ?>">
                            <span class="nav-text">Articles</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-u-c" href="<?= Url::to( [ '/corporate/events' ] ); ?>">
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
