<?php
namespace app\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\BaseActiveRecord;
use yii\helpers\Json;

/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 25.03.2018
 * Time: 20:38
 */
class CustomLogBehavior extends Behavior
{
    public function events()
    {
        return [
            BaseActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            BaseActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
            BaseActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }

    public function afterSave($event)
    {
        $model = $event->sender;
        Yii::info('User ' . Yii::$app->user->id . ' save ' . $model::className() . ' id = ' . $model->id, 'app_category');
        Yii::info($event->changedAttributes, 'app_category');
        Yii::info($model->attributes, 'app_category');
    }

    public function afterDelete($event)
    {
        $model = $event->sender;
        Yii::info('User ' . Yii::$app->user->id . ' delete ' . $model::className() . ' id = ' . $model->id, 'app_category');
    }
}