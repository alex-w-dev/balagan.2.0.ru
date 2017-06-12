<?php

namespace app\modules\api\models\db;

use Yii;

/**
 * This is the model class for table "{{%bio_user_pacient}}".
 *
 * @property string $user_id
 * @property string $parent
 * @property string $user_doctor_id
 * @property string $district_code
 * @property string $polis
 * @property integer $male
 * @property string $birthString
 * @property integer $birthUnix
 *
 * @property BioMedication[] $bioMedications
 * @property BioDistrict $districtCode
 * @property BioUserDoctor $userDoctor
 * @property BioUserPacient $parent0
 * @property BioUserPacient[] $bioUserPacients
 * @property BioUser $user
 */
class BioUserPacient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_user_pacient}}';
    }


    public static function findByUserId($user_id){
        return self::find()->where(['user_id'=>$user_id])->one();
    }

    /* $user  = pacient_id | BioUserPacient
     * $format =  'years' |'months'| date_diff() formats */
    public static function getPacientAge($user, $format){
        if(is_numeric($user)){
            $user = self::findByUserId($user);
        }

        $diff = date_diff(new \DateTime($user->birthString), new \DateTime());
        switch ($format){
            case 'years':
                return $diff->y;
                break;
            case 'months':
                return $diff->y * 12 + $diff->m;
                break;
            default:
                return $diff->$format;
        }
    }

    /* $user  = pacient_id | BioUserPacient */
    public static function getPacientMale($user){
        if(is_numeric($user)){
            $user = self::findByUserId($user);
        }

        return $user->male;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'parent', 'user_doctor_id', 'male', 'birthUnix'], 'integer'],
            [['district_code'], 'number'],
            [['birthString', 'polis'], 'string', 'max' => 45],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => BioUserPacient::className(), 'targetAttribute' => ['parent' => 'user_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => BioUser::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
        /* DEFAULT */
        /*return [
            [['user_id', 'parent', 'user_doctor_id', 'district_code'], 'required'],
            [['user_id', 'parent', 'user_doctor_id', 'male', 'birthUnix'], 'integer'],
            [['district_code'], 'number'],
            [['birthString'], 'string', 'max' => 45],
            [['district_code'], 'exist', 'skipOnError' => true, 'targetClass' => BioDistrict::className(), 'targetAttribute' => ['district_code' => 'dist_code']],
            [['user_doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => BioUserDoctor::className(), 'targetAttribute' => ['user_doctor_id' => 'user_id']],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => BioUserPacient::className(), 'targetAttribute' => ['parent' => 'user_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => BioUser::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];*/
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'parent' => 'Parent',
            'user_doctor_id' => 'User Doctor ID',
            'district_code' => 'District Code',
            'male' => 'Male',
            'polis' => 'Полис',
            'birthString' => 'Birth String',
            'birthUnix' => 'Birth Unix',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBioMedications()
    {
        return $this->hasMany(BioMedication::className(), ['user_pacient_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrictCode()
    {
        return $this->hasOne(BioDistrict::className(), ['dist_code' => 'district_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDoctor()
    {
        return $this->hasOne(BioUserDoctor::className(), ['user_id' => 'user_doctor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(BioUserPacient::className(), ['user_id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBioUserPacients()
    {
        return $this->hasMany(BioUserPacient::className(), ['parent' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(BioUser::className(), ['id' => 'user_id']);
    }
}
