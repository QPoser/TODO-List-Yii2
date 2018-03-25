<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 25.03.2018
 * Time: 11:04
 */

namespace app\forms\App\Task;


use app\models\App\Task;
use yii\base\Model;

class TaskEditForm extends Model
{

    public $name;

    public function __construct(Task $task, array $config = [])
    {
        if ($task) {
            $this->name = $task->name;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['name', 'string', 'max' => 255],
        ];
    }

}