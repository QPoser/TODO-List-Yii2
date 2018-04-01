<?php
namespace app\components;

use yii\base\Component;


/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 26.03.2018
 * Time: 22:17
 */
class LabelComponent extends Component
{

    public $tableName = '{{%component_labels}}';

    public function actionAssign($id, $label)
    {
        $label = new LabelModel();
        $label->assignId = $id;
        $label->name = $label;
        $label->save();
    }

    public function actionAssignArray($id, $labels)
    {

    }

}