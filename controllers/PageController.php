<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17.03.2018
 * Time: 19:44
 */

namespace app\controllers;


use app\forms\RegisterForm;
use app\models\User;
use app\services\DealManageService;
use app\services\UserManageService;
use Yii;
use yii\web\Controller;

class PageController extends Controller
{

    public $deals;
    public $users;

    public function __construct($id, $module, DealManageService $deals, UserManageService $users, array $config = [])
    {
        $this->users = $users;
        $this->deals = $deals;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDeals()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['user/login']);
        }
        $user = User::findOne(Yii::$app->user->id);
        $deals = $user->deals;
        return $this->render('desk', [
            'deals' => $deals,
        ]);
    }

    public function actionTasks()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['user/login']);
        }
        $user = User::findOne(Yii::$app->user->id);
        $tasks = $user->tasks;
        return $this->render('tasks', [
            'tasks' => $tasks
        ]);
    }

    public function actionRedirect()
    {
        return $this->redirect(['deal/create']);
    }


}