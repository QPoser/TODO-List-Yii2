<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<a href="<?=Url::to(['task/create'])?>" class="btn btn-primary">Add task</a>

<?php foreach ($tasks as $task):?>

    <div class="deal" style="padding: 1px 10px; box-shadow: 0 0 1px black; margin: 10px 0; font-size: 18px;">
        <h3><a href="<?= Url::to(['task/view' , 'id' => $task->id]) ?>"><?=$task->name?></a></h3>
        <?php $deals = $task->deals; ?>
        <?php if ($deals): ArrayHelper::multisort($deals, ['complete', 'priority', 'promptly', 'id'], [SORT_ASC, SORT_DESC, SORT_DESC, SORT_DESC]); ?>
            <h4>Deals:</h4>
            <?php foreach ($deals as $deal): ?>
                <p><a href="<?=Url::to(['deal/view', 'id' => $deal->id])?>"><?=$deal->name?> <?=$deal->complete ? '<span class="text-success">(Completed)</span>' : ''?></a></p>
            <?php endforeach; ?>
        <?php else: ?>
            <h4>No deals</h4>
        <?php endif; ?>
    </div>


<?php endforeach; ?>

<?= LinkPager::widget([
    'pagination' => $pages,
    'registerLinkTags' => true
]); ?>

