<?php
namespace app\components;

use yii\base\Component;
use yii\helpers\ArrayHelper;


/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 26.03.2018
 * Time: 22:17
 */
class LabelComponent extends Component
{

    public $tableName = '{{%component_labels}}';

    public function actionAssign($id, $text): bool
    {
        $label = new LabelModel();
        $label->assignId = $id;
        $label->name = $text;
        if ($label->validate()) {
            $label->save();
            return true;
        }
        return false;
    }

    public function findById($id): array
    {
        $labels = LabelModel::find()->andWhere(['assignId' => $id])->all();
        return ArrayHelper::getColumn($labels, 'name');
    }

    public function removeById($id): void
    {
        $labels = LabelModel::find()->andWhere(['assignId' => $id])->all();
        foreach ($labels as $label) {
            $label->delete();
        }
    }

}