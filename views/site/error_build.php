<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error site-error__building">

    <h1><?=$name?></h1>
    <div class="">
        <?=Html::a("Перейти в мой профиль", Yii::$app->urlManager->createUrl('account/index'), array('class'=>'button'))?>
    </div>

</div>
