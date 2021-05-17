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

<li class="nav-item">
    <a class="nav-link text-u-c" href="<?= Url::to( [ '/listing/index' ] ); ?>">
        <span class="nav-text">Directory listing</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link text-u-c" href="<?= Url::to( [ '/site/about' ] ); ?>">
        <span class="nav-text">About us</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link text-u-c" href="<?= Url::to( [ '/site/contact' ] ); ?>">
        <span class="nav-text">Contact</span>
    </a>
</li>
