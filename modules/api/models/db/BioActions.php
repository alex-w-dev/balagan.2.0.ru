<?php

namespace app\modules\api\models\db;

use Yii;

/**
 * This is the model class for table "{{%bio_actions}}".
 *
 * @property integer $id_action
 * @property integer $id_section
 * @property string $name
 */
class BioActions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_actions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_action'], 'required'],
            [['id_action', 'id_section'], 'integer'],
            [['name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_action' => 'Id Action',
            'id_section' => 'Id Section',
            'name' => 'Name',
        ];
    }

    public static function getDescriptionedActions($whereIn = []){
        $connection = Yii::$app->getDb();
//        print_r_pre("
//            SELECT *
//            FROM ".BioActions::tableName()." as a
//            LEFT JOIN ".BioActionDiscription::tableName(). " as ad ON a.id_action = ad.id_action
//            WHERE a.id_action IN(".implode(',', $whereIn).")
//        ");
//        die()
        $command = $connection->createCommand("
            SELECT a.id_action, a.id_section, a.name, ad.id_discription, ad.disctiption
            FROM ".BioActions::tableName()." as a 
            LEFT JOIN ".BioActionDiscription::tableName(). " as ad ON a.id_action = ad.id_action 
            WHERE a.id_action IN(".implode(',', $whereIn).")
        ");
        return $command->queryAll();
    }
}
