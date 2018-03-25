<?php
use yii\helpers\Url;
?>

<a href="<?=Url::to(['task/create'])?>" class="btn btn-primary">Add task</a>

<?php foreach ($tasks as $task):?>

    <div class="deal" style="padding: 1px 10px; box-shadow: 0 0 1px black; margin: 10px 0; font-size: 18px;">
        <h3><a href="<?= Url::to(['task/view' , 'id' => $task->id]) ?>"><?=$task->name?></a></h3>
        <p>Tasks: <?= count($task->deals) ?></p>
    </div>


<?php endforeach;