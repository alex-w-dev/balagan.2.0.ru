<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Войти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <a href="<?=Yii::$app->urlManager->createUrl(['site/registration'])?>">
        <span>
            Еще  не зарегистрированы?
        </span>
    </a>

   <!-- <div class="edit-prfl-date">
        <div class="edit-prfl-date__day edit-prfl-date__item">
            <select name="" id="" class="form-control">
                <option value="13">31</option>
                <option value="1">21</option>
                <option value="1">1</option>
            </select>
        </div>
        <div class="edit-prfl-date__month edit-prfl-date__item">
            <select name="" id="" class="form-control">
                <option value="март">март</option>
                <option value="март">март</option>
                <option value="март">март</option>
            </select></div>
        <div class="edit-prfl-date__year edit-prfl-date__item">
            <select name="" id="" class="form-control">
                <option value="1111">1111</option>
                <option value="1111">1111</option>
                <option value="1111">1111</option>
            </select></div>
    </div>-->
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options'=>['class' => 'site-log-in-out-form'],
        'fieldConfig' => [
            'template' => "{input}\n<div class=\"\">{error}</div>",
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=>'ФИО']) ?>

        <?= $form->field($model, 'password')->passwordInput([ 'placeholder'=>'Пароль', 'class'=>'form-control js-password']) ?>

        <?php /*= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) */ ?>

        <div class="form-group text-center">
                <?= Html::submitButton('Войти', ['class' => 'button', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
