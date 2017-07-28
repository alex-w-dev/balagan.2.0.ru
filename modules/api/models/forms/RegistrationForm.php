<?php

namespace app\modules\api\models\Forms;

use app\modules\api\models\db\BioDistrict;
use app\modules\api\models\db\BioUser;
use app\modules\api\models\db\BioUserPacient;
use app\modules\api\models\db\BioUserDoctor;
use app\modules\api\models\db\BioUserPartner;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegistrationForm extends Model
{

    public $name;
    public $surname;
    public $patronymic;
    public $birthDay;
    public $birthMonth;
    public $birthYear;
    public $male;
    public $email;
    public $phone;
    public $promo;
    public $password;
    public $district_code;
    public $user_id;
    public $polis;
    public $type;
    public $rememberMe = true;
    public $license;

    private $_user = false;


    const SCENARIO_DOCTOR = 'doctor';
    const SCENARIO_PACIENT = 'pacient';
    const SCENARIO_PARTNER = 'partner';
    const SCENARIO_PACIENT_EDIT = 'pacient_edit';
    const SCENARIO_DOCTOR_EDIT = 'doctor_edit';
    const SCENARIO_PARTNER_EDIT = 'partner_edit';

    public function scenarios()
    {
        return [
            self::SCENARIO_DOCTOR => ['license', 'phone', 'name', 'surname', 'password', 'email', 'type' , 'male', 'birthDay', 'birthMonth', 'birthYear', 'patronymic'],
            self::SCENARIO_PACIENT => ['district_code', 'phone', 'name', 'surname', 'password', 'email', 'type', 'male', 'birthDay', 'birthMonth', 'birthYear', 'patronymic'],
            self::SCENARIO_PACIENT_EDIT => ['district_code', 'phone', 'name', 'surname', 'male', 'birthDay', 'birthMonth', 'birthYear', 'patronymic'],
            self::SCENARIO_DOCTOR_EDIT => ['license', 'phone', 'name', 'surname', 'male', 'birthDay', 'birthMonth', 'birthYear', 'patronymic'],
            self::SCENARIO_PARTNER => ['phone', 'name', 'surname', 'password', 'email', 'type', 'male', 'birthDay', 'birthMonth', 'birthYear', 'patronymic'],
            self::SCENARIO_PARTNER_EDIT => ['phone', 'name', 'surname', 'male', 'birthDay', 'birthMonth', 'birthYear', 'patronymic'],
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required ^$
            [['phone', 'password', 'email', 'type', 'male', 'birthDay', 'birthMonth', 'birthYear', 'name', 'surname'], 'required', 'message' => 'Поле не должно быть пустым'],
            [['license'], 'required', 'on' => [self::SCENARIO_DOCTOR, self::SCENARIO_DOCTOR_EDIT], 'message' => 'Поле не должно быть пустым'],
            [['district_code'], 'required', 'on' => [self::SCENARIO_PACIENT, self::SCENARIO_PACIENT_EDIT], 'message' => 'Поле не должно быть пустым'],
            ['male', 'required', 'message' => 'Выберите пол.'],
            ['male', 'integer', 'min' => 0, 'max' => 1],
            [['polis'], 'string', 'max' => 45],
            [['license'], 'string', 'max' => 120],
            //['district_name', 'in', 'range' => $this->getDistricts(), 'message' => 'Пожалуйста выберите регион проживания.'],
            ['birthDay', 'in', 'range' => $this->getBirthDays(), 'message' => 'Пожалуйста выберите день.'],
            ['birthMonth', 'in', 'range' => [1,2,3,4,5,6,7,8,9,10,11,12], 'message' => 'Пожалуйста выберите месяц.'],
            ['birthYear', 'in', 'range' => $this->getBirthYears(), 'message' => 'Пожалуйста выберите год.'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // the email attribute should be a valid email address
            ['email', 'email', 'message' => 'Введите реальный E-Mail'],
           // [['email'], 'unique', 'message' => 'Пользователь с данным E-Mail был зарегистрирован ранее.'],
            ['phone', 'match', 'pattern' => '/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/u', 'message' => 'Неверный формат номера телефона.'],
            // password is validated by validatePassword()
            /*['password', 'validatePassword'],*/
            [['promo', 'polis', 'user_id', 'patronymic'], 'safe'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function register()
    {
        $time = time();
        if ($this->user_id) {
            $user = BioUser::findOne(['id' => $this->user_id]);
            $user->setAttributes([
                'id' => $this->user_id,
                'email' => $this->email,
                'name' => $this->name,
                'patronymic' => $this->patronymic,
                'surname' => $this->surname,
                'phone' => $this->phone,
                'updated' => $time
            ]);
        } else {
            $user = new BioUser();
            $user->setAttributes([
                'email' => $this->email,
                'name' => $this->name,
                'patronymic' => $this->patronymic,
                'surname' => $this->surname,
                'phone' => $this->phone,
                'passwd' => md5($this->password),
                'type' => $this->type,
                'status' => 1,
                'created' => $time,
                'updated' => $time,
                'auth_key' => uniqid("", rand(1000, 9999)),
                'access_token' => md5(md5(uniqid(rand(), 1)) . md5($this->email)),
                'path_key' => md5($this->email),
            ]);
        }

        if ($user->validate()) {
            $birthString = str_pad($this->birthDay, 2, '0', STR_PAD_LEFT) . '.' . str_pad($this->birthMonth, 2, '0', STR_PAD_LEFT) . '.' . $this->birthYear;
            $birthUnix = strtotime($birthString . " UTC");

            if ($this->user_id) {
                $pacient = BioUserPacient::findOne(['user_id' => $this->user_id]);
                $pacient->setAttributes([
                    'district_code' => $this->district_code,
                    'birthString' => $birthString,
                    'birthUnix' => $birthUnix,
                    'polis' => $this->polis,
                    'male' => $this->male,
                ]);
            } else {
                $user->save();
                if ($user->type == 'pacient') {
                    $pacient = new BioUserPacient();
                    $pacient->setAttributes([
                        'user_id' => $user->id,
                        'parent' => null,
                        'user_doctor_id' => null,
                        'polis' => $this->polis,
                        'district_code' => $this->district_code,
                        'male' => $this->male,
                        'birthString' => $birthString,
                        'birthUnix' => $birthUnix,
                    ]);
                    if (!$pacient->validate()) {
                        if (!$this->user_id) {
                            BioUser::deleteAll(['id' => $user->id]);
                        }
                        return false;
                    }
                    $pacient->save();

                } elseif ($user->type == 'doctor') {
                    $doctor = new BioUserDoctor();
                    $doctor->setAttributes([
                        'user_id' => $user->id,
                        'license' => $this->license,
                    ]);
                    if (!$doctor->validate()) {
                        if (!$this->user_id) {
                            BioUser::deleteAll(['id' => $user->id]);
                        }
                        return false;
                    }
                    $doctor->save();
                } elseif ($user->type == 'partner'){
                    $partner = new BioUserPartner();
                    $partner->setAttributes([
                        'user_id' => $user->id,
                    ]);
                    if (!$partner->validate()) {
                        if (!$this->user_id) {
                            BioUser::deleteAll(['id' => $user->id]);
                        }
                        return false;
                    }
                    $partner->save();
                }
            }

            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    public function updateUserById($id, $attributes)
    {
        $time = time();
        $user = BioUser::findOne(['id' => $id]);
        if ($user) {
            $this->setAttributes($user->attributes);
            $this->setAttributes($attributes);
             $user->setAttributes([
                'id' => $this->user_id,
                'name' => $this->name,
                'patronymic' => $this->patronymic,
                'surname' => $this->surname,
                'phone' => $this->phone,
                'updated' => $time
            ]);
        }

        if ($user->validate()) {
            $user->update();
            $birthString = str_pad($this->birthDay, 2, '0', STR_PAD_LEFT) . '.' . str_pad($this->birthMonth, 2, '0', STR_PAD_LEFT) . '.' . $this->birthYear;
            $birthUnix = strtotime($birthString . " UTC");

            if ($user->type == 'pacient') {
                $pacient = BioUserPacient::findOne(['user_id' => $id]);
                $pacient->setAttributes([
                    'district_code' => $this->district_code,
                    'birthString' => $birthString,
                    'birthUnix' => $birthUnix,
                    'polis' => $this->polis,
                    'male' => $this->male,
                ]);
                $pacient->update();
            } elseif ($user->type == 'doctor') {
                $doctor = BioUserDoctor::findOne(['user_id' => $id]);
                $doctor->setAttributes([
                    'license' => $this->license,
                ]);
                $doctor->update();
            } elseif ($user->type == 'partner'){
                $partner = BioUserPartner::findOne(['user_id' => $id]);
               /* $doctor->setAttributes([
                    'license' => $this->license,
                ]);*/
                $partner->update();
            }

            return true;
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = BioUser::findByEmail($this->email);
        }

        return $this->_user;
    }

    public function getUserInfo()
    {
        if ($this->_user === false) {
            $this->_user = BioUser::findByEmail($this->email);
        }
        $result = BioUser::getUserInfoById($this->_user->id);
        return $result;
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

    public function setAttributesPacient($user, $pacient)
    {

        /* название района проживания */
        $result = BioDistrict::findOne(['dist_code'=>$pacient->district_code]);
        $districtName = $result->dist_name;

        return $this->setAttributes(array_merge(
            $pacient->getAttributes(),
            $user->getAttributes(),
            [
                'district_name'=>$districtName,
                'password'=>'hidden',
                'birthDay'=>(int)gmdate("d", $pacient->birthUnix),
                'birthMonth'=>$this->getNumberToMonth()[gmdate("m", $pacient->birthUnix)],
                'birthYear'=>gmdate("Y", $pacient->birthUnix),
            ]
        ));
    }

}
