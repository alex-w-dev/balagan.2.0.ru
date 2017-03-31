<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <a href="<?=Yii::$app->urlManager->createUrl(['site/login'])?>">
        <span>
            Уже зарегистрированы?
        </span>
    </a>

   <!-- -->
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options'=>['class' => 'site-log-in-out-form'],
        'fieldConfig' => [
            'template' => "{input}\n<div class=\"\">{error}</div>",
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=>'ФИО']) ?>

        <div class="text-left registration-label">
            Дата рождения
        </div>
        <div class="edit-prfl-date">
            <div class="edit-prfl-date__day edit-prfl-date__item">
                <?php
                    echo $form->field($model, 'birthDay')->dropDownList($model->getBirthDays());
                ?>
            </div>
            <div class="edit-prfl-date__month edit-prfl-date__item">
                <?php
                echo $form->field($model, 'birthMonth')->dropDownList($model->getBirthMonths());
                ?>
            </div>
            <div class="edit-prfl-date__year edit-prfl-date__item">
                <?php
                echo $form->field($model, 'birthYear')->dropDownList($model->getBirthYears());
                ?>
            </div>
        </div>

        <div class="text-left registration-label">
            Пол
        </div>
        <?= $form->field($model, 'male', ['template'=>"<div class='registration-radio-list'>{input}</div>\n<div class=\"\">{error}</div>"])->radioList([0=>'Женский', 1=>'Мужской']) ?>

        <?= $form->field($model, 'district_name')->dropDownList($model->getDistricts()); ?>

        <?= $form->field($model, 'email')->textInput(['placeholder'=>'Email']) ?>

        <?= $form->field($model, 'phone')->textInput(['placeholder'=>'Ваш телефон']) ?>

        <?= $form->field($model, 'promo')->textInput(['placeholder'=>'Промокод']) ?>

        <?= $form->field($model, 'password')->passwordInput([
            'placeholder'=>'Пароль',
            'class'=>'form-control js-password'
        ]) ?>

        <!--?/*= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) */?-->

        <div class="form-group text-center">
                <?= Html::submitButton('Присоединиться', ['class' => 'button', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
