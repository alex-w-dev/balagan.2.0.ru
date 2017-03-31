<?php

namespace app\controllers;

use app\models\db\BioMeasure;
use app\models\db\BioMeasureChildren;
use yii;
use yii\helpers\HtmlPurifier;

class BlackController extends \JsonRpc2\Controller
{
    private $childrenMeasure = array();


    private function getChildrenMeasureData($data, $id_measure = 0)
    {
        $arrKeys = array_keys($data->id_parent, $id_measure);
        $array = array();
        foreach ($arrKeys as $index) {
            /* добавляем своих детей */
            $array[] = $data->id_measure[$index];
            /* добавляем ДЕТЕЙ своих детей */
            $array = array_merge($array, $this->getChildrenMeasureData($data, $data->id_measure[$index]));
        }
        if ($array && $id_measure) {
            $this->childrenMeasure[$id_measure] = implode(',', $array);
        }
        return $array;

    }

    public function actionPut_table($table_name, $data)
    {
        $connection = Yii::$app->getDb();
        if ($table_name == 'measure') {

            $this->renewTable('bio_measure', [
                'id_measure',
                'id_parent',
                'name',
                'typevalue',
                'sort_order',
                'age_low',
                'age_high',
                'male' ,
                'section'
            ], $data, [
                'id_measure' => ['int'],
                'id_parent' => ['int']
            ]);

            /*
             * ЕСЛИ ВДРУГ ЧЕ, БЕРЕМ $data не из данных от сервера а из BD
             *
             */
            /*$bio = BioMeasure::findBySql("SELECT `id_measure`, `id_parent` FROM ".BioMeasure::tableName()."")->asArray()->all();
            $data_ = new \stdClass();
            $data_->id_measure = array();
            $data_->id_parent = array();
            foreach($bio as $index => $b){
                $data_->id_measure[$index] = $b['id_measure'];
                $data_->id_parent[$index] = $b['id_parent'];
            }

            print_r_pre($data_);
            die();*/


            $this->getChildrenMeasureData($data);
            $insert_arr = array();
            foreach ($this->childrenMeasure as $id_measure => $children) {
                $insert_arr[] = "('" . $id_measure . "','" . $children . "')";
            }


            $command = $connection->createCommand(
                "
                    SET FOREIGN_KEY_CHECKS = 0;
                    TRUNCATE `bio_measure_children`;
                    INSERT INTO `bio_measure_children` (
                        id_measure, 
                        children
                    ) VALUES " . implode(',', $insert_arr) . ";
                    
                    SET FOREIGN_KEY_CHECKS = 1;
                "
            );

            $command->query();


        } elseif ($table_name == 'value_nominal') {

            $this->renewTable('bio_value_nominal', [
                'id_valnominal',
                'id_measure',
                'valnominal',
                'sort_order'
            ], $data, [
                'id_valnominal' => ['int'],
                'id_measure' => ['int']
            ]);

        } elseif ($table_name == 'districts') {

            $this->renewTable('bio_district', [
                'dist_code',
                'dist_name'
            ], $data, [
                'dist_code' => ['trim'],
                'dist_name' => ['trim']
            ]);

        } elseif ($table_name == 'response') {

            $this->renewTable('bio_response', [
                'id_response',
                'id_parent',
                'name',
                'order_n'
            ], $data);

        } elseif ($table_name == 'actions') {

            $this->renewTable('bio_actions', [
                'id_action',
                'id_section',
                'name'
            ], $data);

        } elseif ($table_name == 'action_sections') {

            $this->renewTable('bio_action_sections', [
                'id_section',
                'id_parent',
                'name',
                'sort_order'
            ], $data);

        } elseif ($table_name == 'action_discription') {

            /* ошибка при импорте настороне ящика */
            if(empty($data->id_discription)){
                foreach ($data->id_action as $i => $v){
                    $data->id_discription[$i] = $i + 1;
                }
            }

            $this->renewTable('bio_action_discription', [
                'id_action',
                'id_discription',
                'disctiption'
            ], $data, [
                'disctiption'=>['purify']
            ]);

        } else {

            return ["message" => "fail: table not found!"];
        }


        return ["message" => "success"];
    }


    private function renewTable($tableName, $columns, $data, $types = [])
    {
        $data = (array)$data;
        $connection = Yii::$app->getDb();
        $insertArray = [];

        for ($i = 0; $i < count($data[$columns[0]]); $i++) {
            $valArray = [];
            foreach ($columns as $columnName) {
                $value = $data[$columnName][$i];

                if (isset($types[$columnName])) {
                    if (in_array('trim', $types[$columnName])) {
                        $value = trim($value);
                    }
                    if (in_array('int', $types[$columnName])) {
                        $value = (int)$value;
                    }
                    if (in_array('purify', $types[$columnName])) {
                        $value = HtmlPurifier::process(str_replace("'", '"', $value));
                    }
                }

                $valArray[] = $value;
            }
            /* добавим строку в массив для добавления в БД */
            $insertArray[] = "('" . implode("', '", $valArray) . "')";
        }

        $command = $connection->createCommand(
            "
                    SET FOREIGN_KEY_CHECKS = 0;
                    TRUNCATE `" . $tableName . "`;
                    INSERT INTO `" . $tableName . "` (" . implode(',', $columns) . ")
                    VALUES " . implode(',', $insertArray) . ";
                    SET FOREIGN_KEY_CHECKS = 1;
                "
        );
        $command->query();

        return true;
    }


}
