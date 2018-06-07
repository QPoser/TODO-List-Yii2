<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 07.06.2018
 * Time: 17:22
 */

namespace app\controllers;


use yii\web\Controller;

class ErrorController extends Controller
{

	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

}