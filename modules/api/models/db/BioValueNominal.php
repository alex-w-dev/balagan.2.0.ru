<?php

namespace app\modules\api\models\db;

use Yii;

/**
 * This is the model class for table "{{%bio_value_nominal}}".
 *
 * @property integer $id_valnominal
 * @property integer $id_measure
 * @property string $valnominal
 * @property integer $sort_order
 */
class BioValueNominal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_value_nominal}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_valnominal', 'id_measure'], 'required'],
            [['id_valnominal', 'id_measure', 'sort_order'], 'integer'],
            [['valnominal'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_valnominal' => 'Id Valnominal',
            'id_measure' => 'Id Measure',
            'valnominal' => 'Valnominal',
            'sort_order' => 'Sort Order',
        ];
    }
}
