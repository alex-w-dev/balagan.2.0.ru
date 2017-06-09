<?php
namespace app\modules\api\controllers;

use app\models\db\BioUser;
use Yii;

class UserController extends _ApiController
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return $behaviors;
    }

    public function actionIndex($access_token)
    {
        $user = BioUser::findByAccessToken($access_token);
        return $user;

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