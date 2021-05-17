<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="item dark">
    <div class="item-bg">
        <img src="<?= Yii::getAlias('@web') ?>/images/bg.jpg" class="blur opacity-3">
    </div>
    <div class="container p-a">
        <div class="p-y-lg text-center text-white">
            <div class="display-4 _300">Contact</div>
            <div class="h4 _400">If you have business inquiries or other questions, please fill out the form to contact us. Thank you.</div>
        </div>

    </div>
</div>

<div class="container padding">

    <div class="row m-a-0">
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'email') ?>
                </div>
                <div class="col-lg-12">
                    <?= $form->field($model, 'subject') ?>
                </div>
                <div class="col-lg-12">
                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                </div>
                <div class="col-lg-12">
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-dark dark no-radius', 'name' => 'contact-button']) ?>
                    </div>


                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>



</div>
