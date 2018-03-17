<?php

namespace app\bootstrap;
use Yii;
use yii\mail\MailerInterface;

/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17.03.2018
 * Time: 21:39
 */
class SetUp implements \yii\base\BootstrapInterface
{

    public function bootstrap($app)
    {
        $container = Yii::$container;

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });
    }
}