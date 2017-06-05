<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\web\Controller;

class UserController extends _ApiController
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return $behaviors;
    }

    public function actionAccount($action, $model = null, $params = [])
    {
        print_r('2123');

    }

    public function actionUpdate($action, $model = null, $params = [])
    {
        print_r('2123');

    }
}