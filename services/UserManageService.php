<?php

namespace app\services;
use app\forms\RegisterForm;
use app\models\User;
use app\repositories\UserRepository;
use SebastianBergmann\Timer\RuntimeException;
use yii\mail\MailerInterface;

/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17.03.2018
 * Time: 20:42
 */
class UserManageService
{

    private $users;
    private $mailer;

    function __construct(MailerInterface $mailer, UserRepository $users)
    {
        $this->mailer = $mailer;
        $this->users = $users;
    }

    public function signup(RegisterForm $form): void
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );

        $this->save($user);

        $sent = $this->mailer
            ->compose(
                ['html' => 'signup/emailConfirmToken-html', 'text' => 'signup/emailConfirmToken-text'],
                ['user' => $user]
            )
            ->setTo($form->email)
            ->setSubject('Signup confirm for ' . \Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new RuntimeException('Email sending error.');
        }

    }

    public function confirm(string $token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }

        $user = $this->users->getByEmailConfirmToken($token);

        $user->confirmSignup();
        $this->save($user);
    }

    public function save(User $user)
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }



}