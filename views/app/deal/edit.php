<?php
?>
    <h1>Edit deal</h1>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'enableClientValidation' => true,
]); ?>

<?= $form->field($model, 'name')->textInput(['maxLength' => true]) ?>
<?// $form->field($model, 'end_date')->textInput(['value' => date('Y-m-d H:i')]) ?>
<?= $form->field($model, 'end_date')->widget(\kartik\datetime\DateTimePicker::className(), [
    'options' => ['placeholder' => 'Select date'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd H:i',
    ]
]) ?>
<?= $form->field($model, 'priority')->checkbox() ?>
<?= $form->field($model, 'promptly')->checkbox() ?>
<?php if ($tasks):
    $arTasks = \yii\helpers\ArrayHelper::map($tasks, 'id', 'name');
    ?>
    <?= $form->field($model, 'task_id')->dropDownList($arTasks, ['prompt' => 'Select task']) ?>
<?php endif; ?>

<?php if ($labelComponent = Yii::$app->get('labels', false)): ?>
    <?= $form->field($model, 'labels')->textInput() ?>
    <?php endif; ?>



<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>

<?php
ActiveForm::end();
?>