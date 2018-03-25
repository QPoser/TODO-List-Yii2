<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 25.03.2018
 * Time: 10:57
 */

namespace app\controllers;


use app\forms\App\Task\TaskCreateForm;
use app\models\App\Task;
use app\services\TaskManageService;
use SebastianBergmann\Timer\RuntimeException;
use Yii;
use yii\web\Controller;

class TaskController extends Controller
{

    public $service;

    public function __construct($id, $module, TaskManageService $service, array $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionCreate()
    {
        $form = new TaskCreateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $task = $this->service->create($form);
                return $this->redirect(['task/view', 'id' => $task->id]);
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('/app/task/create', [
            'model' => $form,
        ]);
    }

    public function actionView($id)
    {
        $task = Task::find()->andWhere(['id' => $id, 'user_id' => Yii::$app->user->id])->limit(1)->one();
        if ($task) {
            $deals = $task->deals;
        }
        return $this->render('/app/task/view', [
            'task' => $task,
            'deals' => $deals,
        ]);
    }

}