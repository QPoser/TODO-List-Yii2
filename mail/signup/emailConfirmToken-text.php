<?php

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['user/confirm', 'token' => $user->email_confirm_token]);
?>
    Hi <?= $user->username ?>,

    Follow the link below to confirm your email:

<?= $confirmLink ?>