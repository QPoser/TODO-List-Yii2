<?php
?>
<h1>Create new deal</h1>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'enableClientValidation' => true,
]); ?>

<?= $form->field($model, 'name')->textInput(['maxLength' => true]) ?>
<?= $form->field($model, 'end_date')->textInput(['value' => date('Y-m-d H:i')]) ?>
<?= $form->field($model, 'priority')->checkbox() ?>
<?= $form->field($model, 'promptly')->checkbox() ?>

<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>

<?php
ActiveForm::end();
?>