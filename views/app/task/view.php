<?php
use yii\helpers\Url;
?>
<div>
    <h1><?=$task->name?></h1>
</div>
<div style="font-size: 18px;">
    <a href="<?=Url::to(['task/edit', 'id' => $task->id])?>" class="btn btn-primary">Edit</a>
    <a href="<?=Url::to(['task/delete', 'id' => $task->id])?>" class="btn btn-danger">Delete</a>
    <hr>
    <?php if ($deals): ?>
        <h3>Deals of this task</h3>
        <hr>
        <?php foreach ($deals as $deal): ?>
            <p><a href="<?=Url::to(['deal/view/' . $deal->id])?>"><?=$deal->id?>. <?=$deal->name?></a></p><hr>
        <?php endforeach; ?>
    <?php else: ?>
        <h3>This task has not deals</h3>
    <?php endif; ?>
</div>