<?php
namespace app\modules\api\controllers;
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
//        $behaviors['access'] = [
//            'class' => \yii\filters\AccessControl::className(),
//            'rules' => [
//                [
//                    'allow' => true,
//                    'roles' => ['@'],
//                ],
//            ],
//        ];
        // here’s where I add behavior (read below)
        return $behaviors;
    }
}