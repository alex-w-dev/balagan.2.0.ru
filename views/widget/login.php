<?php
use app\widgets\BTopNav;

$this->registerCssFile("@web/css/widget/login.css");

$top_menu_reg = BTopNav::widget([
    'options' => ['class' => 'list-inline top-nav'],
    'items' => [
        ['label' => 'Регистрация', 'url' => ['/site/registration'], 'linkOptions' => ['target' => '_parent'], 'options'=> ['class'=>"log-in-out-item"]],
        ['label' => 'Войти', 'url' => ['/site/login'], 'linkOptions' => ['target' => '_parent'], 'options'=> ['class'=>"log-in-out-item"]],
    ],
    'encodeLabels' => false,
]);
?>

<?php if ($user){ ?>
    <a class="widget-login" target="_parent" href="<?php echo \yii\helpers\Url::to('/account'); ?>">
        <div class="widget-login__image_container">
            <div class="widget-login__image">
                <img class="avatar" src="<?=$avatar?>">
            </div>
        </div>
        <div class="widget-login__username">
            <span><?=$user['username']?></span>
        </div>
    </a>
<?php } else { ?>
    <div class="log-in-out">
        <?=$top_menu_reg?>
    </div>
<?php } ?>