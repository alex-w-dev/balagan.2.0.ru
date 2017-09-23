<?php

namespace app\modules\api\models\db;

use app\models\db\BioUser;
use Yii;

class BioScheduleTemplates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_schedule_templates}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_name', 'doctor_id', 'link_date'], 'required'],
            [['doctor_id'], 'integer'],
            [['pacient_id'], 'safe'],
        ];
    }

}