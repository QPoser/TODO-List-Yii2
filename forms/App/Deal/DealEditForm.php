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
use app\models\App\Deal;
use yii\base\Model;

class DealEditForm extends Model
{
    public $name;
    public $priority;
    public $promptly;
    public $end_date;
    public $task_id;
    public $labels;

    public function __construct(Deal $deal, array $config = [])
    {
        if ($deal) {
            $this->name = $deal->name;
            $this->priority = $deal->priority;
            $this->promptly = $deal->promptly;
            $this->end_date = $deal->getEndDate();
            $this->task_id = $deal->task_id;
            $this->labels = $deal->labels;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'end_date'], 'required'],
            [['priority', 'promptly'], 'boolean'],
            [['name'], 'string', 'max' => 255],
            ['task_id', 'integer'],
            ['labels', 'string']
        ];
    }

}