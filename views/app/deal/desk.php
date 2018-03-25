<?php

use app\models\App\Deal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<a href="<?=Url::to(['deal/create'])?>" class="btn btn-success">Add deal</a><br><br>
<a href="<?=Url::to(['deal/deals'])?>" class="btn <?= empty(Yii::$app->request->queryParams['date']) ? 'btn-success' : 'btn-primary'?>">All deals</a>
<a href="<?=Url::to(['deal/deals', 'date' => 'today'])?>" class="btn <?= Yii::$app->request->queryParams['date'] == 'today' ? 'btn-success' : 'btn-primary'?>">Today deals</a>
<a href="<?=Url::to(['deal/deals', 'date' => 'weekly'])?>" class="btn <?= Yii::$app->request->queryParams['date'] == 'weekly' ? 'btn-success' : 'btn-primary'?>">Weekly deals</a>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'attribute' => 'name',
            'value' => function (Deal $model) {
                return Html::a(Html::encode($model->name), ['deal/view/' . $model->id]);
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'complete',
            'value' => function (Deal $model) {
                return $model->complete ? 'Yes' : 'No';
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'priority',
            'value' => function (Deal $model) {
                return $model->priority ? 'Yes' : 'No';
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'promptly',
            'value' => function (Deal $model) {
                return $model->promptly ? 'Yes' : 'No';
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'end_date',
            'value' => function (Deal $model) {
                return strtotime($model->end_date) < time() ? $model->end_date . ' (overdue)' : $model->end_date;
            },
            'format' => 'raw',
        ],
        ['class' => \yii\grid\ActionColumn::class, 'template' => '{complete} {update} {delete}', 'buttons' => [
                'complete' => function ($url, $model) {
                    if ($model->complete) {
                        return Html::a('<span class="glyphicon glyphicon-remove text-warning"></span>', Url::to(['deal/uncomplete/' . $model->id]), [
                            'title' => 'Set uncomplete', 'data-pjax' => '0'
                        ]);
                    } else {
                        return Html::a('<span class="glyphicon glyphicon-ok text-warning"></span>', Url::to(['deal/complete/' . $model->id]), [
                            'title' => 'Set complete', 'data-pjax' => '0'
                        ]);
                    }
                },
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['deal/edit/' . $model->id]), [
                            'title' => 'Edit', 'data-pjax' => '0'
                    ]);
                },
                'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to(['deal/delete/' . $model->id]), [
                        'title' => 'Delete', 'data-pjax' => '0'
                    ]);
                },
        ]],
    ],
]); ?>

