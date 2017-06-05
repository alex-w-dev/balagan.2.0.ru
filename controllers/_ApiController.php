<?php
namespace app\controllers;
use yii\rest\ActiveController;
use yii\web\Controller;

class _ApiController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter' ] = [
            'class' => \yii\filters\Cors::className(),
        ];
        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];
        $behaviors['access'] = [
            'class' => \yii\filters\AccessControl::className(),
            'only' => ['create', 'update', 'delete'],
            'rules' => [
                [
                    'actions' => ['create', 'update', 'delete'],
                    'allow' => false,
                    'roles' => ['@'],
                ],
            ],
        ];
        // here’s where I add behavior (read below)
        return $behaviors;
    }

    public function actionAccount($action, $model = null, $params = [])
    {
        print_r('2123');

    }

    public function actionUser($id = 'dasd')
    {
        return $id;

    }

    public function actionUpdate($action, $model = null, $params = [])
    {
        print_r('2123');

    }
}