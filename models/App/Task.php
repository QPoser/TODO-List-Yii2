<?php
namespace app\models\App;
use Yii;
use yii\db\ActiveRecord;
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 18.03.2018
 * Time: 11:46
 */
class Task extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%tasks}}';
    }

    public static function create($name)
    {
        $task = new static();
        $task->name = $name;
        $task->created_at = time();
        $task->user_id = Yii::$app->user->id;
        return $task;
    }

    public function edit($name): void
    {
        $this->name = $name;
    }

    public function getDeals()
    {
        return $this->hasMany(Deal::className(), ['task_id' => 'id']);
    }

}