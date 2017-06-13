<?php
namespace app\modules\api\controllers;

use app\models\db\BioUser;
use app\modules\api\models\Forms\RegistrationForm;
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

    public function actionRegister()
    {
        $this->layout = "main-l";

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegistrationForm();
        $model->setAttributes(Yii::$app->request->post());
        if ($model->validate()){
            if ($user = $model->register()) {
                return [
                    'success' => true,
                    'user' => $user,
                ];
            }
        } else {
            return [
                'success' => false,
                'errors' => $model->getErrors(),
            ];
        }



    }

    public function actionUpdate($action, $model = null, $params = [])
    {
        print_r('2123');

    }
}