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
use yii\widgets\Breadcrumbs;

?>

<div id="aside" class="app-aside modal fade nav-dropdown">
    <!-- fluid app aside -->
    <div class="left navside dark dk" layout="column" style="background-image: linear-gradient(60deg, #29323c 0%, #485563 100%);">
        <div class="navbar no-radius">
            <!-- brand -->
            <a class="navbar-brand md" href="<?= Url::to( [ '/dashboard/index' ] ); ?>">
                <?= Html::img('@web/images/logo.png', ['alt' => 'Azam Nemad']) ?>
                <span class="h4 hidden-folded block m-l-0">PETRONAS</span>
            </a>
            <div class="block p-a-sm b-t b-light text-center text-xs text-muted">GTD PREDICTIVE ANALYSIS</div>
            <!-- / brand -->
        </div>
        <div flex class="hide-scroll">
            <nav class="scroll nav-light">

                <ul class="nav" ui-nav>
                    <li>
                        <a href="<?= Url::to( [ '/dashboard/index' ] ); ?>" >
                            <span class="nav-icon">
                              <i class="material-icons">&#xe3fc;</i>
                            </span>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to( [ '/report/index' ] ); ?>" >
                            <span class="nav-icon">
                              <i class="material-icons">&#xe3fc;</i>
                            </span>
                            <span class="nav-text">Report Failure</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to( [ '/process/index' ] ); ?>" >
                            <span class="nav-icon">
                              <i class="material-icons">&#xe3fc;</i>
                            </span>
                            <span class="nav-text">Processing Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to( [ '/predictions/index' ] ); ?>" >
                            <span class="nav-icon">
                              <i class="material-icons">&#xe3fc;</i>
                            </span>
                            <span class="nav-text">Predictions Report</span>
                        </a>
                    </li>


                </ul>
            </nav>
        </div>
    </div>
</div>

