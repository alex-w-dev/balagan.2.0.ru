<?php

namespace app\modules\api\models\db;

use Yii;

class BioRecordToDoctor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_record_to_doctor}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['schedule_id', 'start_time', 'end_time'], 'required'],
            [['schedule_id', 'pacient_id'], 'integer'],
            [['pacient_id'], 'safe'],
        ];
    }

    public static function getFullSchedule($schedule_id)
    {
        $schedule = self::find()->where(['schedule_id' =>$schedule_id])->all();
        $result = [];
        if(count($schedule) > 0) {
            foreach ($schedule as $record){
                $result[$record->record_id]['start_time'] = $record->start_time;
                $result[$record->record_id]['end_time'] = $record->end_time;
                $result[$record->record_id]['pacient_id'] = $record->pacient_id;
            }
        }

        return $result;
    }

}