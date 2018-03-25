<?php
?>
    <h1>Edit task</h1>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'enableClientValidation' => true,
]); ?>

<?= $form->field($model, 'name')->textInput(['maxLength' => true]) ?>

<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>

<?php
ActiveForm::end();
?>