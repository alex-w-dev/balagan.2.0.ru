<?php

namespace app\modules\api\models\db;

use Yii;

class BioClinicList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_clinic_list}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clinic_name'], 'required'],
            [['clinic_adress'], 'safe'],
        ];
    }
}