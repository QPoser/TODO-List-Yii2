<?php
use yii\helpers\Url;
?>
<div>
    <h1><?=$deal->name?></h1>
</div>
<div style="font-size: 18px;">
    <?php if ($deal->complete): ?>
        <p class="text-success">Задача выполнена</p>
        <a href="<?=Url::to(['deal/uncomplete', 'id' => $deal->id])?>" class="btn btn-warning">Set uncomplete</a>
    <?php else: ?>
        <?php if (strtotime($deal->end_date) < time()): ?>
            <p class="text-danger">Задача просрочена!</p>
        <?php endif; ?>
        <p class="text-success"><?=$deal->promptly ? 'Срочная!' : ''?></p>
        <p class="text-success"><?=$deal->priority ? 'Важная!' : ''?></p>
        <p>Дата окончания: <?=$deal->end_date?> </p>
        <a href="<?=Url::to(['deal/complete', 'id' => $deal->id])?>" class="btn btn-success">Complete</a>
    <?php endif; ?>
    <a href="<?=Url::to(['deal/delete', 'id' => $deal->id])?>" class="btn btn-danger">Delete</a>
</div>