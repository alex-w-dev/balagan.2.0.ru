<?php

namespace app\modules\api\models\db;

use app\modules\api\models\BioFileHelper;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%bio_user}}".
 *
 * @property string $id
 * @property string $email
 * @property string $phone
 * @property string $passwd
 * @property string $type
 * @property integer $status
 * @property string $created
 * @property string $updated
 * @property string $auth_key
 * @property string $path_key
 * @property string $access_token
 *
 * @property BioUserDoctor $bioUserDoctor
 * @property BioUserPacient $bioUserPacient
 */
class BioUser extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_user}}';
    }

    public static function findByUserId($user_id){
        return self::find()->where(['id'=>$user_id])->one();
    }

    public static function findByAccessToken($access_token){
        return self::find()->where(['access_token'=>$access_token])->one();
    }

    /* path to images of profile MAIN_DIRECTORY */
    public static function getMainDirectoryPath($path_key){
        /* this finction can't to be changed!!!! */
        return '/'. $path_key;
    }

    /* path to images of profile photo */
    public static function getPhotoPath($path_key){
        return self::getMainDirectoryPath($path_key).'/'.'photo';
    }

    /* path to results of black */
    public static function getBlackPath($path_key){
        return self::getMainDirectoryPath($path_key).'/'.'black';
    }


    const SCENARIO_DOCTOR = 'doctor';
    const SCENARIO_PACIENT = 'pacient';

    public function scenarios()
    {
        return [
            self::SCENARIO_DOCTOR => ['license', 'phone', 'name', 'surname', 'password', 'email', 'type' , 'male', 'birthDay', 'birthMonth', 'birthYear', 'patronymic'],
            self::SCENARIO_PACIENT => ['district_code', 'phone', 'name', 'surname', 'password', 'email', 'type', 'male', 'birthDay', 'birthMonth', 'birthYear', 'patronymic'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'phone', 'passwd', 'type', 'created', 'updated', 'name', 'surname'], 'required'],
            [['status', 'created', 'updated'], 'integer'],
            [['email'], 'string', 'max' => 100],
            [['passwd', 'type', 'auth_key', 'path_key'], 'string', 'max' => 45],
            [['access_token', 'patronymic', 'surname'], 'string', 'max' => 255],
            [['license'], 'required', 'on' => self::SCENARIO_DOCTOR],
            [['district_code, birthDay, birthMonth, birthYear'], 'required', 'on' => self::SCENARIO_PACIENT],
            ['birthDay', 'in', 'range' => $this->getBirthDays(), 'message' => 'Пожалуйста выберите день.'],
            ['birthMonth', 'in', 'range' => [1,2,3,4,5,6,7,8,9,10,11,12], 'message' => 'Пожалуйста выберите месяц.'],
            ['birthYear', 'in', 'range' => $this->getBirthYears(), 'message' => 'Пожалуйста выберите год.'],
            [['email'], 'unique'],
            ['phone', 'match', 'pattern' => '/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/u', 'message' => 'Неверный формат номера телефона.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'phone' => 'Номер телефона',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'passwd' => 'Passwd',
            'type' => 'Type',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
            'auth_key' => 'Auth Key',
            'path_key' => 'Path Key',
            'access_token' => 'Access Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBioUserDoctor()
    {
        return $this->hasOne(BioUserDoctor::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBioUserPacient()
    {
        return $this->hasOne(BioUserPacient::className(), ['user_id' => 'id']);
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email]);
    }

    /**
     * Finds user by username
     *
     * @param string $id
     * @return static|null
     */
    public static function findById($id)
    {
        return self::findOne(['id' => $id]);
    }


    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->passwd === md5($password);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['access_token' => $token]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;//Here I return a value of my authKey column
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($auth_key)
    {
        return $this->auth_key === $auth_key;
    }


    public function getBirthDays()
    {
        $array = [0 => 'День'];
        for ($i = 1; $i <= 31; $i++) {
            $array[$i] = $i;
        }

        return $array;
    }

    public function getNumberToMonth()
    {
        $array = array();
        $array['01'] = 'Январь';
        $array['02'] = 'Февраль';
        $array['03'] = 'Март';
        $array['04'] = 'Апрель';
        $array['05'] = 'Май';
        $array['06'] = 'Июнь';
        $array['07'] = 'Июль';
        $array['08'] = 'Август';
        $array['09'] = 'Сентябрь';
        $array['10'] = 'Октябрь';
        $array['11'] = 'Ноябрь';
        $array['12'] = 'Декабрь';

        return $array;
    }

    public function getBirthMonths()
    {
        $array = [0 => 'Месяц'];
        foreach ($this->getNumberToMonth() as $val) {
            $array[$val] = $val;
        }

        return $array;
    }

    public function getDistricts()
    {
        $array = [0 => 'Регоин проживания'];
        foreach (BioDistrict::find()->where([])->asArray()->all() as $district) {
            $array[$district['dist_name']] = $district['dist_name'];
        }
        return $array;
    }

    public function getBirthYears()
    {
        $array = [0 => 'Год'];
        for ($i = (int)gmdate('Y'); $i >= 1900; $i--) {
            $array[$i] = $i;
        }

        return $array;
    }

    public static function getUserInfoById($user_id)
    {
        $user = BioUser::findByUserId($user_id);
        $result['user_info'] = $user->attributes;
        $result['avatar'] = BioUser::getUserAvatar($user_id);
        if ($user->type == 'pacient') {
            $pacient = BioUserPacient::findByUserId($user->id);
            $result['pacient_info'] = $pacient->attributes;
            $dist = BioDistrict::find()->where(['dist_code' => $pacient->district_code])->one();
            if(!empty($dist)){
                $result['pacient_info']['district_name'] = $dist->dist_name;
            }
        }
        if ($user->type == 'doctor') {
            $doctor = BioUserDoctor::findByUserId($user->id);
            $result['doctor_info'] = $doctor->attributes;
        }

        return $result;
    }

    public static function getUserAvatar($user_id)
    {
        $result = [];
        $user = BioUser::findByUserId($user_id);
        if(!empty($user)){
            $dir = BioUser::getMainDirectoryPath($user->path_key);
            $filePath = Yii::getAlias('@app').'/uploads'.$dir.'/photo';
            $fileUrl = Yii::getAlias('@web').'/uploads'.$dir.'/photo';
            if(file_exists($filePath)){
                BioFileHelper::normalizeDir($filePath);
                $files = scandir($filePath);
                if(count($files) > 2){
                    foreach ($files as $file){
                        if(strlen($file) > 2){
                            if(strpos($file, 'min')){
                                $result['min'] = $fileUrl.'/'.$file;
                            }
                            if(strpos($file, 'big')){
                                $result['big'] = $fileUrl.'/'.$file;
                            }
                        }
                    }
                }
            }
        }

        return $result;
    }
}
