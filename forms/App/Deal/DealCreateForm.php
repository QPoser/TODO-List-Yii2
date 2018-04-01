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
 * @var promptly
 * @var complete
 * @var end_date
 * @var task_id
 */
use yii\base\Model;

class DealCreateForm extends Model
{
    public $name;
    public $priority;
    public $promptly;
    public $end_date;
    public $task_id;
    public $labels;

    public function rules()
    {
        return [
            [['name', 'end_date'], 'required'],
            [['priority', 'promptly'], 'boolean'],
            [['name'], 'string', 'max' => 255],
            ['task_id', 'integer'],
            ['labels', 'string'],
        ];
    }
}