<?php

namespace app\forms;
use app\models\User;
use yii\base\Model;


class RegisterForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $captcha;

    public function rules(): array
    {
        return [
            [['username', 'email', 'captcha'], 'required'],
            ['email', 'email'],
            [['username', 'email'], 'string', 'max' => 255],
            ['captcha', 'captcha', 'captchaAction' => 'page/captcha'],
            [['username', 'email'], 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => 6],
        ];
    }


}