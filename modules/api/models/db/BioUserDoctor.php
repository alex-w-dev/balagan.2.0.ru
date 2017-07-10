<?php

namespace app\modules\api\models\db;

use Yii;

class BioUserDoctor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_user_doctor}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['license'], 'string', 'max' => 120],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => BioUser::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'license' => 'license',
            'user_id' => 'User ID',
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
