<?php

namespace app\modules\api\models\db;

use Yii;

/**
 * This is the model class for table "{{%bio_user_measure}}".
 *
 * @property integer $id
 * @property integer $measure_id
 * @property integer $value_nominal_id
 * @property string $user_id
 * @property string $value
 * @property integer $type_value
 *
 * @property BioUser $user
 *
 *
 * Null - не имеет значения (родитель);
 *   0 - строка;
 *   1 – число типа float;
 *   2 – единичный выбор из списка возможных значений;
 *   3 – множественный выбор из списка возможных значений;
 *   4 – дата (dd.mm.yyyy)
 *   5 – text / memo)
 */
class BioUserMeasure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_user_measure}}';
    }


    public static function getValues($user_id){
        $values = self::findAll(['user_id'=>$user_id]);
        foreach($values as $index=>$value){
            if((int)$value['type_value'] == 3){
                $values[$index] = json_decode($value['value']);
            }
        }
        return $values;
    }

    public static function getValue($measure_id, $user_id){
        $value = self::findOne(['user_id'=>$user_id, 'measure_id'=>$measure_id]);
        if ($value && (int)$value['type_value'] == 3){
            $value['value'] = json_decode($value['value']);
        }
        return $value;
    }

    public static function setValue($data){
        $t = new self();
        $t->deleteAll(['user_id'=>$data['user_id'], 'measure_id'=>$data['measure_id']]);

        if(!$data['value'])return;

        if((int)$data['type_value'] == 3 ){
            $data['value'] = json_encode($data['value']);
        }

        $t->setAttributes($data);
        $t->save();
    }

    public static function setValues($data){
        foreach ($data as $d){
            self::setValue($d);
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['measure_id', 'user_id'], 'required'],
            [['measure_id', 'value_nominal_id', 'user_id', 'type_value'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => BioUser::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            /*'id' => 'ID',*/
            'measure_id' => 'Measure ID',
            'value_nominal_id' => 'Value Nominal ID',
            'user_id' => 'User ID',
            'value' => 'Value',
            'type_value' => 'Type Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(BioUser::className(), ['id' => 'user_id']);
    }

}
