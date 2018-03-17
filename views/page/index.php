<?php


echo 'index';

if (Yii::$app->user->isGuest) {
    echo '1';
} else {
    echo '2';
}