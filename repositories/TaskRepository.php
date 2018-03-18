<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 18.03.2018
 * Time: 12:15
 */

namespace app\repositories;


use app\models\App\Task;

class TaskRepository
{
    public function get($id): Task
    {
        if (!$task = Task::findOne($id)) {
            throw new \DomainException('Task is not found');
        }
        return $task;
    }

    public function save(Task $task): void
    {
        if (!$task->save()) {
            throw new \RuntimeException('Saving error');
        }
    }

    public function remove(Task $task): void
    {
        if (!$task->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}