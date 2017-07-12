<?php

namespace app\modules\api\models\db;

use Yii;

class BioUserNotice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_user_notice}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'notice_type_id', 'read'], 'required'],
            [['user_id', 'notice_type_id', 'read'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'user id',
            'notice_type_id' => 'notice type',
            'read' => 'read',
        ];
    }
}