<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17.03.2018
 * Time: 19:44
 */

namespace app\controllers;


use app\forms\RegisterForm;
use app\models\App\Deal;
use app\models\App\Task;
use app\models\User;
use app\services\DealManageService;
use app\services\UserManageService;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class PageController extends Controller
{

    public $deals;
    public $users;

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

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

        //$user = User::findOne(Yii::$app->user->id);
        //$deals = $user->deals;
        //ArrayHelper::multisort($deals, ['complete', 'priority', 'promptly', 'id'], [SORT_ASC, SORT_DESC, SORT_DESC, SORT_DESC]);

        $query = Deal::find()->andWhere(['user_id' => Yii::$app->user->id]);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 15]);
        $pages->pageSizeParam = false;
        $deals = $query->offset($pages->offset)->limit($pages->limit)->orderBy(['complete' => SORT_ASC, 'priority' => SORT_DESC, 'promptly' => SORT_DESC, 'id' => SORT_DESC])->all();

        return $this->render('desk', [
            'deals' => $deals,
            'pages' => $pages,
        ]);
    }

    public function actionTasks()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['user/login']);
        }

        //$user = User::findOne(Yii::$app->user->id);
        $query = Task::find()->andWhere(['user_id' => Yii::$app->user->id]);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
        $pages->pageSizeParam = false;
        $tasks = $query->offset($pages->offset)->limit($pages->limit)->orderBy(['id' => SORT_DESC])->all();

        return $this->render('tasks', [
            'tasks' => $tasks,
            'pages' => $pages,
        ]);
    }

    public function actionRedirect()
    {
        return $this->redirect(['deal/create']);
    }


}