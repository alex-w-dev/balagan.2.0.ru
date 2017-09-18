<?php

namespace app\modules\api\models\db;

use Yii;

class BioDoctorSchedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_doctor_schedule}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctor_id', 'clinic_id', 'price', 'reception_date', 'start_time', 'end_time', 'reception_time'], 'required'],
            [['doctor_id', 'clinic_id', 'price'], 'number'],
        ];
    }
}