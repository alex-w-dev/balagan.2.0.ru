<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%bio_district}}".
 *
 * @property string $dist_code
 * @property string $dist_name
 *
 * @property BioUserPacient[] $bioUserPacients
 */
class BioDistrict extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_district}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dist_code'], 'required'],
            [['dist_code'], 'number'],
            [['dist_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dist_code' => 'Dist Code',
            'dist_name' => 'Dist Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBioUserPacients()
    {
        return $this->hasMany(BioUserPacient::className(), ['district_code' => 'dist_code']);
    }
}
