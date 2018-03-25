<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 18.03.2018
 * Time: 12:14
 */

namespace app\controllers;


use app\forms\App\Deal\DealCreateForm;
use app\forms\App\Deal\DealEditForm;
use app\models\App\Deal;
use app\models\User;
use app\services\DealManageService;
use Yii;
use yii\web\Controller;

class DealController extends Controller
{

    protected $service;

    public function __construct($id, $module, DealManageService $service, array $config = [])
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['user/login']);
        }
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionComplete($id)
    {
        $deal = $this->service->setComplete($id);

        return $this->render('/app/deal/view', [
            'deal' => $deal,
        ]);
    }

    public function actionUncomplete($id)
    {
        $deal = $this->service->setUncomplete($id);

        return $this->render('/app/deal/view', [
           'deal' => $deal,
        ]);
    }

    public function actionView($id)
    {
        $deal = $this->findModel($id);

        return $this->render('/app/deal/view', [
            'deal' => $deal,
        ]);
    }

    public function actionCreate()
    {
        $form = new DealCreateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $deal = $this->service->create($form);
                return $this->redirect(['deal/view', 'id' => $deal->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        $user = User::findOne(Yii::$app->user->id);
        $tasks = $user->tasks;
        return $this->render('/app/deal/create', [
            'tasks' => $tasks,
            'model' => $form,
        ]);
    }

    public function actionEdit($id)
    {
        $deal = $this->findModel($id);

        $form = new DealEditForm($deal);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($deal->id, $form);
                return $this->redirect(['deal/view', 'id' => $deal->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        $user = User::findOne(Yii::$app->user->id);
        $tasks = $user->tasks;
        return $this->render('/app/deal/edit', [
            'model' => $form,
            'deal' => $deal,
            'tasks' => $tasks,
        ]);
    }

    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['page/deals']);

    }

    protected function findModel($id): Deal
    {
        if (($model = Deal::find()->andWhere(['id' => $id, 'user_id' => Yii::$app->user->id])->limit(1)->one()) !== null) {
            return $model;
        }
        throw new \RuntimeException('Deal not found.');
    }

}