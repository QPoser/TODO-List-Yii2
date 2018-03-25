<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 25.03.2018
 * Time: 10:57
 */

namespace app\services;


use app\forms\App\Task\TaskCreateForm;
use app\forms\App\Task\TaskEditForm;
use app\models\App\Task;
use app\repositories\TaskRepository;

class TaskManageService
{

    public $tasks;

    function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    public function create(TaskCreateForm $form): Task
    {
        $task = Task::create(
            $form->name
        );
        $this->tasks->save($task);
        return $task;
    }

    public function edit($id, TaskEditForm $form): Task
    {
        $task = $this->tasks->get($id);
        $task->edit($form->name);
        $this->tasks->save($task);
        return $task;
    }
}