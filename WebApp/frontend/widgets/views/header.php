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

<div  class="navbar-md white box-shadow">
    <div class="container">
        <div class="navbar">
            <!-- Open side - Naviation on mobile -->
            <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up">
                <i class="material-icons">&#xe5d2;</i>
            </a>
            <!-- / -->

            <!-- brand -->
            <a class="navbar-brand md" href="<?= Url::to( [ '/site/index' ] ); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="32" height="32">
                    <path d="M 4 4 L 44 4 L 44 44 Z" fill="#f77a99" />
                    <path d="M 4 4 L 34 4 L 24 24 Z" fill="rgba(0,0,0,0.15)" />
                    <path d="M 4 4 L 24 4 L 4  44 Z" fill="#fcc100" />
                </svg>

                <span class="hidden-folded inline">Directory</span>
            </a>
            <!-- / brand -->


            <!-- navbar collapse -->
            <div class="collapse navbar-toggleable-sm text-center no-bg text-warn-hover" id="navbar-1">
                <!-- link and dropdown -->
                <ul class="nav navbar-nav pull-right m-r-lg">
                    <?php echo \frontend\widgets\MenuTop::widget(); ?>
                </ul>
                <!-- / link and dropdown -->
            </div>
            <!-- / navbar collapse -->
        </div>
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
