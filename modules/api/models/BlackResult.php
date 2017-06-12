<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 01.02.2017
 * Time: 18:17
 */

namespace app\modules\api\models;

use app\models\db\BioActions;
use app\models\db\BioResponse;
use yii\base\Model;

class BlackResult extends Model
{
    public static function getCurlAddress()
    {
        // return "http://fcrisk.ru:30851/index.php";
        return "http://fcrisk.ru:3306/RemoteServer.php";
    }

    public static function getCurlTemplate()
    {
        return [
            "jsonrpc" => "2.0",
            "method" => "calc",
            "params" => [
                "male" => 1,
                "birthday" => "2012-12-12",
                "dist" => 1111148000,
                "data" => [
                    "measure_id" => [],
                    "type_value" => [],
                    "value" => []
                ]
            ],
            "id" => 0
        ];
    }

    public static function applyUMData($allUM)
    {
        $data = self::getCurlTemplate();

        foreach ($allUM as $index => $um) {
            $temp = $um->toArray();
            $data['params']['data']['measure_id'][$index] = $temp['measure_id'];
            $data['params']['data']['type_value'][$index] = $temp['type_value'];
            $data['params']['data']['value'][$index] = ((int)$temp['type_value'] == 3)
                ? json_decode($temp['value'])
                : $temp['value'];
        }

        return $data;
    }

    public static function curl($data)
    {
        $url = self::getCurlAddress();

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        /*curl_exec($curl);
        debug(curl_getinfo($curl));*/

        return curl_exec($curl);
    }

    public static function getRiskFieldsNames()
    {
        return [
            'time_step' => 'Временной шаг',
            'P_fon' => 'Вероятность фоновая',
            "P" => 'Вероятность',
            "G" => 'Тяжесть',
            "R_fon" => 'Риск фоновый',
            "R" => 'Риск',
            "R_action" => 'Риск с учетом меропиятий',
            "R_add" => 'дополнительный риск',
            "R_add_action" => 'дополнительный риск с учетом меропиятий',
            "R_index" => 'приведенный индекс риска',
            "R_index_action" => 'приведенный индекс риска с учетом меропиятий',
        ];
    }

    public static function getClassifiedRiskFieldsNames()
    {
        $riskFieldNames = self::getRiskFieldsNames();
        return [
            'P' => [
                'title'=>'Вероятность',
                'children' => [
                    "P" => $riskFieldNames['P'],
                    'P_fon' => $riskFieldNames['P_fon'],
                ]
            ],
            'G' => [
                'title'=>'Тяжесть',
                'children' => [
                    "G" => $riskFieldNames['G'],
                ]
            ],
            'R' => [
                'title'=>'Риск',
                'children' => [
                    "R" => $riskFieldNames['R'],
                    "R_action" => $riskFieldNames['R_action'],
                    "R_fon" => $riskFieldNames['R_fon'],
                ]
            ],
            'R_add' => [
                'title'=>'Дополнительный риск',
                'children' => [
                    "R_add" => $riskFieldNames['R_add'],
                    "R_add_action" => $riskFieldNames['R_add_action'],
                ]
            ],
            'R_index' => [
                'title'=>'Приведенный индекс',
                'children' => [
                    "R_index" => $riskFieldNames['R_index'],
                    "R_index_action" => $riskFieldNames['R_index_action'],
                ]
            ]
        ];
    }

    public static function preparedRisks($data)
    {
        $risks = $data['result']['risk'];

        /* get names of responses */
        $bioResponse = BioResponse::find()->where([])->asArray()->all();
        $preparedBioResponse = [];
        foreach ($bioResponse as $bioResp) {
            $preparedBioResponse[$bioResp['id_response']] = $bioResp;
        }

        /* подготвленная информация с сервера */
        $risksPrepared = [];
        /* массив заготовка */
        $risksFieldsNames = self::getRiskFieldsNames();
        foreach ($risks as $id_response => $item) {
            $preparedResponse = [];
            foreach ($item['time_step'] as $i => $time_step) {
                $step = $risksFieldsNames;
                foreach ($step as $key => $val) {
                    $step[$key] = $item[$key][$i];
                }
                $preparedResponse[] = $step;
            }

            $risksPrepared[$id_response]['data'] = $preparedResponse;
            $risksPrepared[$id_response]['dataOriginal'] = $item;
            $risksPrepared[$id_response]['meta'] = $preparedBioResponse[$id_response];
            //$step++;

            /* $.plot.data */
            $dataPlot = [];
            $step = $risksFieldsNames;
            unset($step['time_step']);
            foreach ($item['time_step'] as $i => $time_step) {
                foreach ($step as $key => $val) {
                    $dataPlot[$key]['label'] = $val;
                    $dataPlot[$key]['data'][$i] = [$time_step, $item[$key][$i]];
                }
            }
            $risksPrepared[$id_response]['dataPlot'] = $dataPlot;
        }
        /*
         *   return example:
         *   Array(
         * [38] => Array
                (
                    [data] => Array
                        (
                            [0] => Array
                                (
                                    [time_step] => 20
                                    [P_fon] => 0.000216
                                    [P] => 2.91E-5
                                    [G] => 2.94E-5
                                    [R_fon] => 0
                                    [R] => 2.91E-5
                                    [R_action] => 2.91E-5
                                    [R_add] => 2.91E-5
                                    [R_add_action] => 2.91E-5
                                    [R_index] => 2.91E-5
                                    [R_index_action] => 2.91E-5
                                )
                             ...

                            [80] => Array
                                (
                                    [time_step] => 100
                                    [P_fon] => 0.2690784
                                    [P] => 1522985.6717283
                                    [G] => 1234.0930563
                                    [R_fon] => 0.0724032
                                    [R] => 1522985.6717283
                                    [R_action] => 1522985.3637283
                                    [R_add] => 1274418.5986234
                                    [R_add_action] => 1274418.2946234
                                    [R_index] => 1
                                    [R_index_action] => 1
                                )

                        )
                    [dataOriginal] => Array
                        (
                            [time_step] => Array
                                (
                                    [0] => 20
                                    ...
                                    [80] => 100
                                )

                            [P_fon] => Array
                                (
                                    [0] => 0.000216
                                    ...
                                    [80] => 0.2690784
                                )

                            [P] => Array
                                (
                                    [0] => 2.91E-5
                                    ...
                                    [80] => 1522985.6717283
                                )


                            [G] => Array
                                (
                                    [0] => 2.94E-5
                                    ...
                                    [80] => 1234.0930563
                                )

                            [R_fon] => Array
                                (
                                    [0] => 0
                                    ...
                                    [80] => 0.0724032
                                )

                            [R] => Array
                                (
                                    [0] => 2.91E-5
                                    ...
                                    [80] => 1522985.6717283
                                )

                            [R_action] => Array
                                (
                                    [0] => 2.91E-5
                                    ...
                                    [80] => 1522985.3637283
                                )

                            [R_add] => Array
                                (
                                    [0] => 2.91E-5
                                    ...
                                    [80] => 1274418.5986234
                                )

                            [R_add_action] => Array
                                (
                                    [0] => 2.91E-5
                                    ...
                                    [80] => 1274418.2946234
                                )

                            [R_index] => Array
                                (
                                    [0] => 2.91E-5
                                    ...
                                    [80] => 1
                                )

                            [R_index_action] => Array
                                (
                                    [0] => 2.91E-5
                                    ...
                                    [80] => 1
                                )

                        )
                    [meta] => Array
                        (
                            [id_response] => 38
                            [id_parent] => 2
                            [name] => Гипертензивная болезнь сердца
                            [order_n] => 21.0
                        )

                )
            )
         *
         * */
        return $risksPrepared;
    }

    public static function preparedActions($data)
    {
        $preparedActions = [];
        $other = [];
        $actions = $data['result']['action'];

        $whereIn = [];
        $allActionsTimeSteps = [];
        foreach ($actions as $action_id => $action) {
            $whereIn[] = $action_id;
            $allActionsTimeSteps = array_merge($allActionsTimeSteps, $action);
        }
        $allActionsTimeSteps = array_unique($allActionsTimeSteps);
        sort($allActionsTimeSteps);
        $minActionTimeStep = min($allActionsTimeSteps);
        $maxActionTimeStep = max($allActionsTimeSteps);
        // $allActionsTimeStepsFlipped = array_flip($allActionsTimeSteps);

        $other['allActionsTimeSteps'] = $allActionsTimeSteps;
        $other['minActionTimeStep'] = $minActionTimeStep;
        $other['maxActionTimeStep'] = $maxActionTimeStep;
        $other['actionTimeStepSize'] = $actionTimeStepSize = 1;

        /* название мероприятий которые нам рекомендуют */
        $result = BioActions::getDescriptionedActions($whereIn);
        $actionNames = [];
        foreach ($result as $r) {
            $actionNames[$r['id_action']] = $r;
        }


        foreach ($actions as $action_id => $actionSteps) {
            $action = [];
            foreach ($allActionsTimeSteps as $i) {
            //for ($i = $minActionTimeStep; $i <= $maxActionTimeStep; $i+=$actionTimeStepSize){
                if (in_array($i, $actionSteps)) {
                    $action[] = 1;
                } else {
                    $action[] = 0;
                }
            }
            /*foreach ($action as $a) {
                $action[$a] = $actionNames[$action_id];
            }*/
            $preparedActions[$action_id]['data'] = $action;
            $preparedActions[$action_id]['dataOriginal'] = $actionSteps;
            $preparedActions[$action_id]['meta'] = $actionNames[$action_id];
        }
        /*
         *  returns:
         *
        other => Array(
            [allActionsTimeSteps] => Array()
            [minActionTimeStep] => 45
            [maxActionTimeStep] => 99
            [actionTimeStepSize] => 1
        ),
        actions => Array(
            ...
            [1167] => Array(
                [data] => Array
                (
                    [0] => 1
                    ...
                    [51] => 0
                )

                [dataOriginal] => Array (
                    [0] => 45
                    ...
                    [27] => 99
                )
                [meta] => Array (
                    [id_action] => 1167
                    [id_section] => 2
                    [name] => Имя
                    [id_discription] => 223
                    [disctiption] => Описание
                )

            )
            ...
        )
         * */
        return ['other' => $other, 'actions' => $preparedActions];
    }
}