<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\widgets\uploadPhoto;

use yii\base\Widget;
use yii\helpers\Html;
use yii\bootstrap\Nav;

class UploadPhoto extends Widget
{

    public $action;
    public $model;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('index.php', [
            'action'=>$this->action,
            'model'=>$this->model
        ]);
    }

}
