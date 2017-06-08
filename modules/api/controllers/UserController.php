<?php
namespace app\modules\api\controllers;

class UserController extends _ApiController
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return $behaviors;
    }

    public function actionAccount()
    {
        print_r('2123');

    }

    public function actionUpdate($action, $model = null, $params = [])
    {
        print_r('2123');

    }
}