<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 18.03.2018
 * Time: 12:11
 */

namespace app\services;


use app\forms\App\Deal\DealCreateForm;
use app\models\App\Deal;
use app\repositories\DealRepository;
use app\repositories\TaskRepository;

class DealManageService
{

    private $deals;
    private $tasks;

    function __construct(DealRepository $deals, TaskRepository $tasks)
    {
        $this->deals = $deals;
        $this->tasks = $tasks;
    }

    public function create(DealCreateForm $form): Deal
    {
        if ($form->task_id) {
            $task = $this->tasks->get($form->task_id);
        }
        $deal = Deal::create(
            $form->name,
            $form->priority,
            $form->end_date,
            $form->task_id ? $task->getPrimaryKey() : 0
        );
        $this->deals->save($deal);
        return $deal;
    }

}