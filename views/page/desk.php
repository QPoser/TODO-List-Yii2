<?php

use yii\helpers\Url;
?>

<a href="<?=Url::to(['deal/create'])?>" class="btn btn-primary">Add deal</a>

<?php foreach ($deals as $deal):?>

<div class="deal" style="padding: 1px 10px; box-shadow: 0 0 1px black; margin: 10px 0; font-size: 18px;">
    <h3><a href="<?= Url::to(['deal/view' , 'id' => $deal->id]) ?>"><?=$deal->name?></a></h3>
    <?php if ($deal->complete): ?>
        <p class="text-success">Deal complete</p>
        <a href="<?=Url::to(['deal/uncomplete', 'id' => $deal->id])?>" class="btn btn-warning">Set uncomplete</a>
    <?php else: ?>
    <?=strtotime($deal->end_date) < time() ? '<p class="text-danger">Задача просрочена, нужно было сделать до '. $deal->end_date . '</p>' : '<p class="">Задачу нужно сделать до ' . $deal->end_date . '</p>' ?>
        <p class="text-success"><?=$deal->priority ? 'Важная' : '' ?></p>
        <p class="text-success"><?=$deal->promptly ? 'Срочная' : '' ?></p>
        <a href="<?=Url::to(['deal/complete', 'id' => $deal->id])?>" class="btn btn-success">Complete</a>
    <?php endif; ?>
</div>


<?php endforeach;
