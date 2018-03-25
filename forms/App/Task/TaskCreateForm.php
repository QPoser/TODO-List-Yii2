<?php

namespace app\forms\App\Task;

use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 25.03.2018
 * Time: 10:59
 */
class TaskCreateForm extends Model
{
    public $name;

    public function rules()
    {
        return [
            [['name'], 'required'],
            ['name', 'string', 'max' => 255],
        ];
    }
}