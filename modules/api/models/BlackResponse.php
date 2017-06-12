<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 01.02.2017
 * Time: 18:17
 */

namespace app\modules\api\models;


use yii\base\DynamicModel;
use yii\base\Model;

class BlackResponse extends Model
{
    public $Временной_шаг;
    public $Вероятность_фоновая;
    public $Вероятность;
    public $Тяжесть_фоновая;
    public $Тяжесть;
    public $Риск_фоновый;
    public $Риск;
    public $Риск_с_учетом_меропиятий;
    public $дополнительный_риск;
    public $доп_риск_с_учетом_меропиятий;
    public $приведенный_индекс_риска;
    public $привед_инд_риска_с_учет_меропр;
/*
    public $vremennoy_shag;
    public $veroyatnost_fonovaya;
    public $veroyantnost;
    public $tyazest_fonovaya;
    public $tyazest;
    public $risk_fonoviy;
    public $risk;
    public $risk_c_uchetom_meropriyat;
    public $dopolnitelniy_risk;
    public $dop_risk_c_uchetom_meropriyat;
    public $privedeniy_index_riska;
    public $prived_ind_risk_c_uchet_meropr;*/
}