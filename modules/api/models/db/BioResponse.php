<?php

namespace app\modules\api\models\db;

use Yii;

/**
 * This is the model class for table "{{%bio_response}}".
 *
 * @property integer $id_response
 * @property integer $id_parent
 * @property string $name
 * @property string $order_n
 */
class BioResponse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_response}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_response'], 'required'],
            [['id_response', 'id_parent'], 'integer'],
            [['order_n'], 'number'],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_response' => 'Id Response',
            'id_parent' => 'Id Parent',
            'name' => 'Name',
            'order_n' => 'Order N',
        ];
    }
}
