<?php

namespace app\modules\api\models\db;

use Yii;

/**
 * This is the model class for table "{{%bio_measure}}".
 *
 * @property integer $id_measure
 * @property integer $id_parent
 * @property string $name
 * @property integer $typevalue
 * @property string $sort_order
 * @property integer $age_low
 * @property integer $age_high
 * @property integer $male
 */
class BioMeasure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bio_measure}}';
    }

    /*
     */
    public static function commonWhereOptions($options)
    {
        return "(( age_low <= '".$options['age']."' AND  age_high >= '".$options['age']."' )
                AND ( male = '".$options['male']."' OR male = '2' ))";
    }



    /**
     * @inheritdoc
     */
//    public static function getBlockedMeasureIds()
//    {
//        return [
//            1, /* анкетирование */
//            2, /* анкета */
//            800, /* Лабораторные тестирования */
//            5000, /* Врачебный осмотр */
//            6000, /* Функциональные исследования */
//            /*5001,  Анамнез жизни */
//            10855, /* Внешний осмотр */
//
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_measure', 'id_parent'], 'required'],
            [['id_measure', 'id_parent', 'typevalue', 'age_low', 'age_high', 'male'], 'integer'],
            [['sort_order'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_measure' => 'Id Measure',
            'id_parent' => 'Id Parent',
            'name' => 'Name',
            'typevalue' => 'Typevalue',
            'sort_order' => 'Sort Order',
            'age_low' => 'Age Low',
            'age_high' => 'Age High',
            'male' => 'Male',
        ];
    }


    public function groupGuestions($id_measure, $options)
    {
        $questions = BioMeasure::find()
            ->where("
                id_parent = '".$id_measure."' 
                AND section = '0' 
                AND ". self::commonWhereOptions($options) ."
            ")
            ->orderBy(['(sort_order+0)' => SORT_ASC])
            ->asArray()
            ->all();

        $i = 1;
        foreach ($questions as $index => $question) {
            $questions[$index]['value'] = BioUserMeasure::getValue($question['id_measure'], $options['user_id']);
            /*if(!empty($questions[$index]['value'])){
                echo $question['id_measure'];
                echo '<br/>';
            }*/
            $questions[$index]['values'] = BioValueNominal::find()
                ->where(['id_measure' => $question['id_measure']])
                ->orderBy(['sort_order' => SORT_ASC])
                ->asArray()
                ->all();

            //if($question['typevalue'] == 'NULL'){
            $questions[$index]['children'] = $this->groupGuestions($question['id_measure'], $options);
            //}
        }

        return $questions;
    }

    /* select qustins as group of questions */
    public function groupGroups($id_parent, $options)
    {
        return BioMeasure::find()
            ->where("
                id_parent = '".$id_parent."' 
                AND section = '1' 
                AND ". self::commonWhereOptions($options) ."
            ")
            ->orderBy(['(sort_order+0)' => SORT_ASC])
            ->asArray()
            ->all();
    }

    /* get Measure */
    public function findMeasureById($id_measure){
        return self::find()
            ->where(array('id_measure' => $id_measure))
            ->asArray()
            ->one();
    }

    /* get nex in level of group questions */
    public function findNeighborOfMeasure($measure, $options, $sign, $sort){
        return self::find()
            ->where(array('id_parent' => $measure['id_parent']))
            ->andWhere(self::commonWhereOptions($options))
            ->andWhere('sort_order '.$sign.' :sort_order', ['sort_order' => $measure['sort_order']])
            ->orderBy(['(sort_order+0)' => $sort])
            ->limit(1)
            ->asArray()
            ->one();
    }


    /* get nex in level of group questions */
    public function findNextOfMeasure($measure, $options){
        return $this->findNeighborOfMeasure($measure, $options, '>', SORT_ASC);
    }

    /* get prev in level of group questions */
    public function findPrevOfMeasure($measure, $options){
        return $this->findNeighborOfMeasure($measure, $options, '<', SORT_DESC);
    }

    public function groupQuestionCountAnswered($id_measure, $questionOptions, $return = ['need' => 0, 'answered' => 0])
    {


        $children = BioMeasureChildren::find()->where(['id_measure' => $id_measure])->asArray()->one();
        $need_arr = explode(',', $children['children']);

        //$return['need'] = count($need_arr);
       $realCount = (new \yii\db\Query())->select(['COUNT(*) as count'])->from(BioMeasure::tableName())->where("
                id_measure IN (".$children['children'].") 
                AND section = '0' 
                AND ". self::commonWhereOptions($questionOptions) ."
            ")->createCommand()->queryOne();

        $return['need'] = $realCount['count'];
        $data = (new \yii\db\Query())->select(['COUNT(*) as count'])->from(BioUserMeasure::tableName())->where(['user_id' => $questionOptions['user_id'], 'measure_id' => $need_arr])->createCommand()->queryOne();

        $return['answered'] = $data['count'];

        return $return;
    }
}
