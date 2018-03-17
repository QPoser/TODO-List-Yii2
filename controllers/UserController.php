<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17.03.2018
 * Time: 20:40
 */

namespace app\controllers;


use app\forms\RegisterForm;
use app\services\UserManageService;
use Yii;
use yii\web\Controller;

class UserController extends Controller
{

    protected $service;

    public function __construct($id, $module, UserManageService $service, array $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionRegister()
    {
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $this->service->signup($model);
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->redirect(['page/index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        return $this->render('login', [

        ]);
    }

    public function actionConfirm($token)
    {
        try {
            $this->service->confirm($token);
            Yii::$app->session->setFlash('success', 'Your email is confirmed.');
            return $this->redirect(['user/login']);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['page/index']);
        }
    }

}