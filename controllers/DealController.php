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
use app\services\DealManageService;
use Yii;
use yii\web\Controller;

class DealController extends Controller
{

    protected $service;

    public function __construct($id, $module, DealManageService $service, array $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionView($id)
    {
        $deal = $this->findModel($id);

        $this->render('/app/deal/view', [
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
        return $this->render('/app/deal/create', [
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
                return $this->redirect(['/app/deal/view', 'id' => $deal->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('/app/deal/edit', [
            'model' => $form,
            'deal' => $deal,
        ]);
    }

    protected function findModel($id): Deal
    {
        if (($model = Deal::findOne($id)) !== null) {
            return $model;
        }
        throw new \RuntimeException('Deal not found.');
    }

}