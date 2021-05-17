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

<div class="app-header white box-shadow">
    <div class="navbar">
        <!-- Open side - Naviation on mobile -->
        <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up">
            <i class="material-icons">&#xe5d2;</i>
        </a>
        <!-- / -->

        <!-- Page title - Bind to $state's title -->
        <div class="navbar-item pull-left h5" ng-bind="$state.current.data.title" id="pageTitle"></div>

        <!-- navbar right -->
        <ul class="nav navbar-nav pull-right">
            <li class="nav-item dropdown">
                <a class="nav-link" href="" data-toggle="dropdown">
                      <span class="avatar w-32">
                          <?= Html::img('@web/images/a0.jpg', ['alt' => 'Azam Nemad']) ?>
                      </span>
                    <span class="hidden-md-down nav-text m-l-sm text-left">
                        <span class="_500">Azam Nemad</span>
                        <small class="text-muted">Administrator</small>
                      </span>
                </a>
                <div class="dropdown-menu pull-right dropdown-menu-scale">
                    <a class="dropdown-item">
                        <span>Inbox</span>
                        <span class="label warn m-l-xs">3</span>
                    </a>
                    <a class="dropdown-item">
                        <span>Profile</span>
                    </a>
                    <a class="dropdown-item">
                        <span>Settings</span>
                        <span class="label primary m-l-xs">3/9</span>
                    </a>
                    <?php
                    echo Html::beginForm(['/site/logout'], 'post')
                        .Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'dropdown-item']
                        )
                        .Html::endForm();
                    ?>
                </div>
            </li>
        </ul>
        <!-- / navbar right -->

        <!-- navbar collapse -->
        <div class="collapse navbar-toggleable-sm" id="collapse">
            <!-- search form -->
            <form class="navbar-form form-inline pull-right pull-none-sm navbar-item v-m" role="search">
                <div class="form-group l-h m-a-0">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm p-x b-a rounded" placeholder="Search projects...">
                    </div>
                </div>
            </form>
            <!-- / search form -->

            <!-- link and dropdown -->
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href data-toggle="dropdown">
                        <i class="fa fa-fw fa-plus text-muted"></i>
                        <span>New</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-scale">
                        <a class="dropdown-item" ui-sref="app.inbox.compose">
                            <span>Inbox</span>
                        </a>
                        <a class="dropdown-item" ui-sref="app.todo">
                            <span>Todo</span>
                        </a>
                        <a class="dropdown-item" ui-sref="app.note.list">
                            <span>Note</span>
                            <span class="label primary m-l-xs">3</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" ui-sref="app.contact">Contact</a>
                    </div>

                </li>
            </ul>
            <!-- / -->
        </div>
        <!-- / navbar collapse -->
    </div>
</div>


<?php
/*
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
$menuItems = [
    ['label' => 'Home', 'url' => ['/site/index']],
    ['label' => 'About', 'url' => ['/site/about']],
    ['label' => 'Contact', 'url' => ['/site/contact']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
*/
?>
