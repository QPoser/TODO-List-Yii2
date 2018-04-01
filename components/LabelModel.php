<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 01.04.2018
 * Time: 17:35
 */

namespace app\components;


use Yii;
use yii\db\ActiveRecord;

class LabelModel extends ActiveRecord
{

    public $name;
    public $assignId;

    public function rules()
    {
        return [
            [['name', 'assignId'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['assignId'], 'integer'],
        ];
    }

    public static function tableName()
    {
        return Yii::$app->labels->tableName; //'{{%component_labels}}';
    }

}