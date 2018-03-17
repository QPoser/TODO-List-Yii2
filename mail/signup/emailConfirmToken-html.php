<?php


use yii\helpers\Html;

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['user/confirm', 'token' => $user->email_confirm_token]);
?>
<div class="password-reset">
    <p>Hi <?= Html::encode($user->username) ?>,</p>

    <p>Follow the link below to confirm your email:</p>
    <p><?=$user->email_confirm_token?></p>
    <p><?=$confirmLink?></p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>
