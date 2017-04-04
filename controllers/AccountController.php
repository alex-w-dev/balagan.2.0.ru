<?php

namespace app\controllers;

use app\models\BioFileHelper;
use app\models\BlackActions;
use app\models\BlackResponse;
use app\models\BlackResult;
use app\models\db\BioActions;
use app\models\db\BioDistrict;
use app\models\db\BioResponse;
use app\models\db\BioUser;
use app\models\db\BioUserMeasure;
use app\models\db\BioMeasure;
use app\models\db\BioUserPacient;
use app\models\forms\RegistrationForm;
use app\models\forms\UploadForm;
use moonland\phpexcel\Excel;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\BaseFileHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;
use app\models\forms\ContactForm;
use yii\web\UploadedFile;

class AccountController extends Controller
{
    public $user;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->user = BioUser::findByUserId(Yii::$app->user->getId());
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $time = time();
        $user = BioUser::findByUserId(Yii::$app->user->getId());
        $pacient = BioUserPacient::findByUserId(Yii::$app->user->getId());
        /* показать popup редкатирования профиля */
        $showEditProfilePopup = false;

        /* модель редактирования профиля */
        $editProfile = new RegistrationForm();
        /* обновим атрибуты для пациента - для формы */
        $editProfile->setAttributesPacient($user, $pacient);

        $postLoad = $editProfile->load(Yii::$app->request->post());
        $postRegister = $editProfile->register();
        if ($postLoad && $postRegister) {
            /* renew data */
            $user = BioUser::findByUserId(Yii::$app->user->getId());
            $pacient = BioUserPacient::findByUserId(Yii::$app->user->getId());
            //return $this->goBack();
        } else if ($postLoad && !$postRegister) { // ошибка регистрации
            $showEditProfilePopup = true;
        }

        /* название района проживания */
        $districtName = $editProfile->district_name;
        /* сколько лет */

        $ageOld = BioUserPacient::getPacientAge($pacient, 'y');

        /* to renew photo of account */
        $uplodPhotoModel = new UploadForm();


        /* TODO refactor this cOde!!! */
        /* avatar */
        $avatar = BioFileHelper::getMainFile(BioUser::getPhotoPath($user->path_key));
        //debug($avatar);
        if (!$avatar) $avatar = '/img/main-avatar.png';
        else $avatar = '/' . $avatar;


        return $this->render('index', [
            'editProfile' => $editProfile,
            'user' => $user,
            'pacient' => $pacient,
            'ageOld' => $ageOld,
            'districtName' => $districtName,
            'showEditProfilePopup' => $showEditProfilePopup,
            'uplodPhotoModel' => $uplodPhotoModel,
            'avatar' => $avatar
        ]);
    }


    public function actionUploadPhoto()
    {

        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->validate()) {
                $dir = BioUser::getPhotoPath($this->user['path_key']);
                BioFileHelper::deleteMainSymbols($dir); // create if not exist inside
                $model->file->saveAs($dir . BioFileHelper::$DIRECTORY_SEPARATOR . BioFileHelper::$MAIN_SUMBOL . uniqid() . '.' . $model->file->extension);

                return $this->redirect(['account/index']);
            }

            echo 'not validate<br>';
            print_r_pre($model->errors);
            die;
        }


        echo 'no post';
        die;

    }

    public function actionAnketa($id_parent = 0)
    {
        $pacient = BioUserPacient::findByUserId(Yii::$app->user->getId());
        $questionOptions = [
            'user_id' => Yii::$app->user->getId(),
            'male' => BioUserPacient::getPacientMale($pacient),
            'age' => BioUserPacient::getPacientAge($pacient, 'months')
        ];

        /* отображать вопросы смешанно , или строго раздельно группы от вопросов*/
        $MIXED = false;

        $data = [];

        $mGroups = new BioMeasure();
        /* получим блоки вопросов */
        $groups = $mGroups->groupGroups($id_parent, $questionOptions);

        $questions = array();
        /* сэкономим ресурсы сервера */
        if (!$groups && !$MIXED) {
            $mQuestions = new BioMeasure();
            /* получим вопросы */
            $questions = $mQuestions->groupGuestions($id_parent, $questionOptions);
        }
        /*print_r_pre($questions);
        die();*/
        /*print_r_pre($questionOptions);
        print_r_pre($groups);
        die;*/


        if ($MIXED) {
            $data['anketa_groups'] = '';
            if ($groups) {
                $data['anketa_groups'] = $this->renderPartial('anketa_groups', $this->dataAnketaQuestionGroups($groups, $id_parent));
            }

            $data['anketa_questions'] = '';
            if ($questions) {
                $data['anketa_questions'] = $this->renderPartial('anketa_questions', $this->dataAnketaQuestions($questions, $questionOptions, $id_parent));
            }
        } else {
            if ($groups) {
                /* отображать как горуппы вопросов */
                return $this->render('anketa_groups', $this->dataAnketaQuestionGroups($groups, $id_parent));
            } elseif ($questions) {
                /* отображать как вопросы */
                return $this->render('anketa_questions', $this->dataAnketaQuestions($questions, $questionOptions, $id_parent));
            }

        }


        if ($groups || $questions) {
            return $this->render('anketa_mixed', $data);
        } else {
            return $this->render('//site/error_build');
        }

    }

    /* контроллер отображающий вопросы как ГРУППЫ ВОПРОСОВ */
    public function dataAnketaQuestionGroups($groups, $id_parent = 0)
    {
        /* можно ли отправлять на расчет */
        $canSend = true;

        $measure = new BioMeasure();
        foreach ($groups as $index => $group) {
            $groups[$index]['answered'] = $measure->groupQuestionCountAnswered($group['id_measure'], Yii::$app->user->getId());
            $groups[$index]['answered']['proc'] = round(
                $groups[$index]['answered']['answered'] / $groups[$index]['answered']['need'] * 100
            );
            if ($groups[$index]['answered']['proc'] != 100) $canSend = false;
        }

        /*print_r_pre($questions);
        die();*/

        /* TODO  пофиксить 98% заполненности при 100% (блоки поле имеют скрытое), а пока костыль  - всегда отправить можно */
        $canSend = true;


        return array(
            'groups' => $groups,
            'canSend' => $canSend
        );
    }


    /* контроллер отображающий вопросы как СПИСОК ВОПРОСОВ */
    public function dataAnketaQuestions($questions, $questionOptions, $id_measure = 0)
    {
        if (!$id_measure) return $this->render('//site/error_build');

        $measure = new BioMeasure();

        $group = $measure->findMeasureById($id_measure);

        $next_group = $measure->findNextOfMeasure($group, $questionOptions);

        $prev_group = $measure->findPrevOfMeasure($group, $questionOptions);

        //$values = BioUserMeasure::getValues();


        return [
            'questions' => $questions,
            'group' => $group,
            'next_group' => $next_group,
            'prev_group' => $prev_group
        ];
    }

    /* THIS ACTION IS ON TESTING MODE */
    public function actionGetResult()
    {
        $originalBlackDir = BioUser::getBlackPath($this->user['path_key']) . BioFileHelper::$DIRECTORY_SEPARATOR . 'original';

        /* to renew always (FIXME at future) */
        BioFileHelper::deleteAllFiles($originalBlackDir);

        $originalBlackJson = BioFileHelper::fileGetContents($originalBlackDir);

        if (!$originalBlackJson) {

            $allUM = BioUserMeasure::findAll(['user_id' => Yii::$app->user->getId()]);
            /* по шаблону заполним данные с базы данных */
            $data = BlackResult::applyUMData($allUM);

            $originalBlackJson = BlackResult::curl($data);

            if ( ! $originalBlackJson ) debug('Server is not available, please try later...');


            BioFileHelper::filePutContents(
                $originalBlackJson,
                $originalBlackDir
            );
            /* результат расчетов с ящика */

        }

        $originalBlack = json_decode($originalBlackJson, true);

        /* информация о болячках */
        $risksPrepares = BlackResult::preparedRisks($originalBlack);

        /* рекомендуемые мероприятия */
        $actionsPrepared = BlackResult::preparedActions($originalBlack);

        /* названия полей рисков */
        $risksFieldsNames = BlackResult::getRiskFieldsNames();

        /* названия полей рисков */
        $сlassifiedRisksFieldsNames = BlackResult::getClassifiedRiskFieldsNames();

        return $this->render('get_result', [
            'risksPrepared' => $risksPrepares,
            'actionsPrepared' => $actionsPrepared,
            'risksFieldsNames' => $risksFieldsNames,
            'сlassifiedRisksFieldsNames' => $сlassifiedRisksFieldsNames
        ]);
    }


    public function actionSetvalue()
    {
        BioUserMeasure::setValue(Yii::$app->request->post());
        echo json_encode(['success' => true]);
    }

}
