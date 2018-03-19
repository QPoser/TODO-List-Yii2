<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 18.03.2018
 * Time: 11:51
 */

namespace app\forms\App\Deal;

/*
 *
 */
class DealEditForm
{
    public $name;
    public $priority;
    public $promptly;
    public $end_date;
    public $task_id;

    public function rules()
    {
        return [
            [['name', 'end_date'], 'required'],
            [['priority', 'promptly'], 'boolean'],
            [['name'], 'string', 'max' => 255],
            ['task_id', 'integer'],
        ];
    }

}