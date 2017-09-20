<?php

namespace app\modules\api\models\db;

use app\models\db\BioUser;
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

    public static function getClinicNameByScheduleId($schedule_id)
    {
        $schedule = BioDoctorSchedule::find()->where(['schedule_id' =>$schedule_id])->one();
        if($schedule){
           $clinic = BioClinicList::find()->where(['clinic_id' => $schedule->clinic_id])->one();
           if($clinic){
               return $clinic->clinic_name;
           }
        }
        return 'Не известно';
    }

    public static function getPriceByScheduleId($schedule_id)
    {
        $schedule = BioDoctorSchedule::find()->where(['schedule_id' =>$schedule_id])->one();
        if($schedule){
            return $schedule->price;
        }
        return 'Не известно';
    }

    public static function getFullSchedule($schedule_ids)
    {
        $result = [];
        if(count($schedule_ids) > 0){
            foreach ($schedule_ids as $schedule_id){
                $schedule = self::find()->where(['schedule_id' =>$schedule_id])->all();
                $clinic_name = self::getClinicNameByScheduleId($schedule_id);
                $price = self::getPriceByScheduleId($schedule_id);
                if(count($schedule) > 0) {
                    foreach ($schedule as $record){
                        if(!empty($record->pacient_id)){
                            $user = BioUser::findByUserId($record->pacient_id);
                            $pacient = $user->surname . ' ' . $user->name . ' ' . $user->patronymic;
                        } else {
                            $pacient = "Нет записи";
                        }
                        $result[$record->record_id]['start_time'] = date('H:i', strtotime($record->start_time));
                        $result[$record->record_id]['end_time'] = $record->end_time;
                        $result[$record->record_id]['pacient_id'] = $record->pacient_id;
                        $result[$record->record_id]['clinic_name'] = $clinic_name;
                        $result[$record->record_id]['pacient_fio'] = $pacient;
                        $result[$record->record_id]['price'] = $price;
                    }
                }
            }
        }

        return $result;
    }

}