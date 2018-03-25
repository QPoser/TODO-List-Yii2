<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>Sign up</h1>
<?php
$form = ActiveForm::begin([
    'enableClientValidation' => true,
]); ?>

<?= $form->field($model, 'username')->textInput(['maxLength' => true]) ?>
<?= $form->field($model, 'email')->textInput(['maxLength' => true]) ?>
<?= $form->field($model, 'password')->passwordInput(['maxLength' => true]) ?>
<?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::className(), ['captchaAction' => 'page/captcha']) ?>

<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>

<?php
ActiveForm::end();
?>