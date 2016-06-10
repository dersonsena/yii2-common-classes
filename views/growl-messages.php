<?php
/** @var $session \yii\web\Session */
use kartik\growl\Growl;
use yii\helpers\Html;

$session = Yii::$app->session;

if($session->hasFlash('growl')) {

    $message = $session->getFlash('growl');

    Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'success',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-check-circle',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1,
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3500,
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
}