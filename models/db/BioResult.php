<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%bio_result}}".
 *
 * @property integer $user_id
 * @property string $data
 */
class BioResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_result}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['data'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'data' => 'Data',
        ];
    }
}
