<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17.03.2018
 * Time: 19:44
 */

namespace app\controllers;


use app\forms\RegisterForm;
use Yii;
use yii\web\Controller;

class PageController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }


}