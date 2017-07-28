<?php

namespace app\modules\api\models\db;

use Yii;

class BioDoctorPacientConnection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_doctor_pacient_connection}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctor_id', 'pacient_id'], 'required'],
            [['doctor_id', 'pacient_id'], 'integer'],
            [['doctor_id', 'pacient_id'], 'unique', 'targetAttribute' => ['doctor_id', 'pacient_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doctor_id' => 'doctor id',
            'pacient_id' => 'pacient id',
        ];
    }

    public function findByPacientAndDoctor(){
        return self::find()->where(['pacient_id'=>$this->pacient_id])->andWhere(['doctor_id'=>$this->doctor_id])->one();
    }

    public static function findDoctorByPacient($pacient_id){
        return self::find()->where(['pacient_id'=>$pacient_id])->one();
    }

}