<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 18.03.2018
 * Time: 11:51
 */

namespace app\forms\App\Deal;

/*
 * @var string name
 * @var created_at
 * @var priority
 * @var complete
 * @var end_date
 * @var task_id
 */
use yii\base\Model;

class DealCreateForm extends Model
{
    public $name;
    public $priority;
    public $complete;
    public $end_date;
    public $task_id;

    public function rules()
    {
        return [
            [['name', 'priority', 'end_date'], 'required'],
            [['complete'], 'boolean'],
            [['name'], 'string', 'max' => 255],
            ['task_id', 'integer'],
        ];
    }
}