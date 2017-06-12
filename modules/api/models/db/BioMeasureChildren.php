<?php

namespace app\modules\api\models\db;

use Yii;

/**
 * This is the model class for table "{{%bio_measure_children}}".
 *
 * @property integer $id_measure
 * @property string $children
 */
class BioMeasureChildren extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_measure_children}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_measure'], 'required'],
            [['id_measure'], 'integer'],
            [['children'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_measure' => 'Id Measure',
            'children' => 'Children',
        ];
    }
}
