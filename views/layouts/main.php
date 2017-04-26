<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use app\widgets\BTopNav;
use yii\bootstrap\NavBar;
//use app\assets\AppAsset;


//AppAsset::register($this);
$top_menu = BTopNav::widget([
    'options' => ['class' => 'list-inline top-nav'],
    'items' => [
        ['label' => 'О компании', 'url' => ['/site/stub/41']],
        ['label' => 'Новости', 'url' => ['/site/stub/54']],
        ['label' => 'Медицинская платформа', 'url' => ['/account/index']],
        ['label' => 'Сервисы', 'url' => ['/site/stub/42']],
        ['label' => 'Отзывы', 'url' => ['/site/stub/43']],
        ['label' => 'Контакты', 'url' => ['/site/contact']],
        /*Yii::$app->user->isGuest ? (
        ['label' => 'Login', 'url' => ['/site/login']]
        ) : (
            '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
        )*/
    ],
]);

$left_menu = Nav::widget([
    /*'options' => ['class' => 'list-inline top-nav'],*/
    'items' => [
        ['label' => 'Мой профиль', 'url' => ['/account']],
        ['label' => 'Полный отчет по состоянию здоровья', 'url' => ['/site/stub/4']],
        ['label' => 'Риски для здоровья', 'url' => ['/site/stub/5']],
        ['label' => 'Медико-профилактические мероприятия', 'url' => ['/site/stub/6']],
        ['label' => 'Комплексная индивидуальная программа', 'url' => ['/site/stub?7']],
        ['label' => 'История лечения', 'url' => ['/site/stub?8']],
        ['label' => 'Результаты анализов', 'url' => ['/site/stub?9']],
        ['label' => 'История покупок', 'url' => ['/site/stub/410']],
        ['label' => 'Возврат 2-НДФЛ', 'url' => ['/site/stub/411']],
        ['label' => 'Анкета', 'url' => ['/account/anketa']],
    ],
]);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- Bootstrap -->
    <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="/lib/slick/slick.css" rel="stylesheet">
    <link href="/lib/jquery-ui/biogenom-theme.css" rel="stylesheet">

    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/main-mobile.css" rel="stylesheet" media="all and (max-width: 767px)">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/lib/jquery.min.js"></script>
</head>
<body>
<div class="container-fluid fixed-top  mobile-hide">
    <div class="top">
        <div class="row top-nav-bar text-nowrap mobile-hide">
            <div class="col-sm-7">
                <?php
                    echo $top_menu;
                ?>
            </div>
            <div class="col-sm-5 text-right ">
                <nav>
                    <ul class="list-inline top-nav ">
                        <li>Пермь</li>
                        <li>+7 (342) 200-86-24</li>
                        <li>8 800 555 96 24</li>
                        <li><a href="#" class="top-nav_callback js-open-popup" data-selector="#callback-popup" >Заказать звонок</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row top-user-bar  mobile-hide">
            <div class="col-sm-4 mobile-logo-bar ">
                <a href="http://biogenom.ru">
                    <img src="/img/logo.png" class="top-user-bar-logo">
                </a>
            </div>
            <div class="col-sm-8  text-right">
                <table class="top-account-widget">
                    <tr>
                        <td>
                            <!--<div class="relative">
                                <div class="top-bell dropdown-toggle" data-toggle="dropdown" submenu="#submenu-bell">
                                    <div class="top-bell-count">1</div>
                                </div>
                                <ul class="dropdown-menu  dropdown-menu-right" role="menu" id="bell-dropdown-menu"
                                    aria-labelledby="dropdownMenu">
                                    <li>
                                        <span class="dropdown-menu_title">Мои уведомления</span>
                                    </li>
                                    <li><a href="#">
                                            <div>Готовы анализы крови</div>
                                            <div class="under-a">15 минут назад</div>
                                        </a>
                                    </li>
                                    <li><a href="#">
                                            <div>Принять витмины</div>
                                            <div class="under-a">1 час назад</div>
                                        </a>
                                    </li>
                                    <li><a href="#">
                                            <div>Готовы анализы крови</div>
                                            <div class="under-a">2 часа назад</div>
                                        </a>
                                    </li>
                                </ul>
                            </div>-->
                        </td>
                        <td class="">
                            <div class="top-account-widget-name-item">
                                Маргарита
                            </div>
                            <!--<div class="top-account-widget-name-item">
                                У вас 90 бонусов
                            </div>-->
                        </td>
                        <td class="">
                            <div class="relative">
                                <table class="dropdown-toggle" data-toggle="dropdown">
                                    <tr>
                                        <td>
                                            <div class="top-under-avatar ">
                                                <img class="top-avatar" src="/img/top-avatar.png">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="top-avatar-more"></div>
                                        </td>
                                    </tr>
                                </table>

                                <ul class="dropdown-menu dropdown-menu-right" id="avatar-dropdown-menu" role="menu"
                                    aria-labelledby="dropdownMenu">
                                    <li>
                                        <?=Html::a("Мой профиль", Yii::$app->urlManager->createUrl('account/index'))?>
                                    </li>
                                    <li>
                                        <?=Html::a("Анкета", Yii::$app->urlManager->createUrl('account/anketa'))?>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="<?=Yii::$app->urlManager->createUrl(['site/logout'])?>">Выйти</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="left-menu col-sm-3 left-main-col mobile-hide">
        <div class="left-nav-bar ">
            <?=$left_menu?>
        </div>
        <div class="left-social">
            <a href="https://vk.com/biogenom">
                <img src="/img/vk.png" alt="">
            </a>
            <a href="https://www.facebook.com/biogenom">
                <img src="/img/fb.png" alt="">
            </a>
        </div>
    </div>
</div>

<div class="fixed-top-mobile mobile-show">
    <div class="mobile-logo-bar ">
        <img src="/img/menu-button-mobile.png" class="top-user-bar-logo menu-button-mobile js-toggle-mobile-menu">
        <img src="/img/logo-mobile.png" class="top-user-bar-logo mobile-show">
    </div>
    <div class="text-right">
        <!--<div class="relative">
            <div class="top-bell dropdown-toggle" data-toggle="dropdown" submenu="#submenu-bell">
                <div class="top-bell-count">1</div>
            </div>
            <ul class="dropdown-menu  dropdown-menu-right" role="menu" id="bell-dropdown-menu"
                aria-labelledby="dropdownMenu">
                <li>
                    <span class="dropdown-menu_title">Мои уведомления</span>
                </li>
                <li><a href="#">
                        <div>Готовы анализы крови</div>
                        <div class="under-a">15 минут назад</div>
                    </a>
                </li>
                <li><a href="#">
                        <div>Принять витмины</div>
                        <div class="under-a">1 час назад</div>
                    </a>
                </li>
                <li><a href="#">
                        <div>Готовы анализы крови</div>
                        <div class="under-a">2 часа назад</div>
                    </a>
                </li>
            </ul>
        </div>-->
    </div>
</div>
<div class="js-mobile-menu all-hide">
    <div class="fixed-mobile-menu-bg  js-toggle-mobile-menu"></div>
    <div class="fixed-mobile-menu">
        <div class="fixed-mobile-menu__account">
            <div class="fixed-mobile-menu__account-item">
                <div class="relative">
                    <table class="dropdown-toggle" data-toggle="dropdown">
                        <tr>
                            <td>
                                <div class="top-under-avatar ">
                                    <img class="top-avatar" src="/img/top-avatar.png">
                                </div>
                            </td>
                        </tr>
                    </table>

                    <ul class="dropdown-menu dropdown-menu-right avatar-dropdown-menu" role="menu"
                        aria-labelledby="dropdownMenu">
                        <li><?=Html::a("Мой профиль", Yii::$app->urlManager->createUrl('account/index'))?></li>
                        <li><?=Html::a("Анкета", Yii::$app->urlManager->createUrl('account/anketa'))?></li>
                        <li class="divider"></li>
                        <li><a href="#">Выйти</a></li>
                    </ul>
                </div>
            </div>
            <div class="fixed-mobile-menu__account-item">
                <div class="top-account-widget-name-item">
                    Маргарита
                </div>
                <!--<div class="top-account-widget-name-item">
                    У вас 90 бонусов
                </div>-->
            </div>
        </div>

        <div class="left-nav-bar fixed-mobile-menu__item">
            <?=$left_menu?>
        </div>
        <!--<div class="mobile-uvedomleniya-left fixed-mobile-menu__item">
            <ul>
                <li><a href="#">
                        <div>Готовы анализы крови</div>
                        <div class="under-a">15 минут назад</div>
                    </a>
                </li>
                <li><a href="#">
                        <div>Принять витмины</div>
                        <div class="under-a">1 час назад</div>
                    </a>
                </li>
                <li class="mobile-hide"><a href="#">
                        <div>Готовы анализы крови</div>
                        <div class="under-a">2 часа назад</div>
                    </a>
                </li>
            </ul>
            <div class="mobile-uvedomleniya-show-more">
                <div class="button js-toggle" data-selector=".mobile-uvedomleniya-left ul .mobile-hide" >Все уведомления</div>
            </div>
        </div>-->
        <div class="left-mobile-menu-footer fixed-mobile-menu__item">
            <?=$top_menu?>
        </div>
        <div class="left-mobile-menu-contacts fixed-mobile-menu__item">
            <div class="left-mobile-menu-contacts__item">Пермь</div>
            <div class="left-mobile-menu-contacts__item">+7 (342) 200-86-24</div>
            <div class="left-mobile-menu-contacts__item">8 800 555 96 24</div>
            <div class="left-mobile-menu-contacts__item">
                <div class="button js-open-popup" data-selector="#callback-popup" >Заказать звонок</div>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid middle">
    <div class="row ">
        <div class="col-sm-3 left-main-col">
        </div>
        <div class="col-sm-9 right-main-col">
            <div class="b-content">
                <?= $content ?>
            </div>

            <div class="footer">
                <div class="footer-col  mobile-hide">
                    <ul class="nav">
                        <li><a href="#">О нас</a></li>
                        <li><a href="#">О компании</a></li>
                        <li><a href="#">Миссия и цели</a></li>
                        <li><a href="#">Команда</a></li>
                        <li><a href="#">Корпоративная культура</a></li>
                    </ul>
                </div>
                <div class="footer-col mobile-hide">
                    <ul class="nav">
                        <li><a href="#">Сотрудничество</a></li>
                        <li><a href="#">Партнерство</a></li>
                        <li><a href="#">Отзывы клиентов</a></li>
                    </ul>
                </div>
                <div class="footer-col mobile-hide">
                    <ul class="nav">
                        <li><a href="#">Документы</a></li>
                        <li><a href="#">Правила оказания услуг</a></li>
                        <li><a href="#">Лицензии</a></li>
                    </ul>
                </div>
                <div class="footer-col mobile-hide">
                    <ul class="nav">
                        <li><a href="#">Контакты</a></li>
                        <li>
                            <div class="footer-contacts">
                                <div class="footer-contacts-item">Пермь, Горького, 60</div>
                                <div class="footer-contacts-item">Biogenom@biogenom</div>
                                <div class="footer-contacts-item">8 800 555 96 24</div>
                            </div>
                        </li>
                    </ul>
                </div>


                <div class="bottom-social mobile-show">
                    <a href="#">
                        <img src="/img/vk.png" alt="">
                    </a>
                    <a href="#">
                        <img src="/img/fb.png" alt="">
                    </a>
                </div>

                <div class="rights">
                    2013-<?= date("Y", time()) ?> ООО “Биогеном” все права защищены
                </div>
            </div>
        </div>
    </div>
</div>



<div class="all-hide js-popup" id="callback-popup">
    <div class="popup-wall js-close-popup"></div>
    <div class="popup-window">
        <div class="popup-close-button js-close-popup"></div>
        <div class="popup-title">Заказать звонок</div>
        <div class="popup-content">
            <form action="">
                <div class="form-group">
                    <input type="text" name="name" class="popup-input-text form-control" placeholder="Ваше имя">
                </div>
                <div class="form-group">
                    <input type="text" name="phone" class="popup-input-text form-control" placeholder="Телефон">
                </div>
                <div class="form-group">
                    <input type="submit" name="phone" class="button">
                </div>
            </form>
        </div>
    </div>
</div>





<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/lib/autoresize/autosize.js"></script>
<script>
    jQuery.each(jQuery('textarea[data-autoresize]'), function() {
        var offset = this.offsetHeight - this.clientHeight;
        var resizeTextarea = function(el) {
            jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
        };
        jQuery(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');
    });
</script>
<script src="/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="/lib/jquery-ui/jquery-ui.min.js"></script>
<script src="/lib/jquery-ui/datepicker-ru.js"></script>
<script>
    $(document).ready(
        function () {
            var events = [
                {
                    id: 1,
                    title: "Five K for charity",
                    date: new Date("12/08/2016")
                },
                {
                    id: 2,
                    title: "Five K for charity",
                    date: new Date("12/04/2016")
                },
                {
                    id: 3,
                    title: "Meeting with manager",
                    date: new Date("12/09/2016")
                },
                {
                    id: 4,
                    title: "Meeting with manager",
                    date: new Date("12/10/2016")
                }
            ];
            $("#main-calendar").datepicker({
                'showOtherMonths': true,
                // hook handler/*
                beforeShowDay: function (tdate) {
                    var result = [true, '', null];
                    var matching = $.grep(events, function(event) {
                        return event.date.valueOf() === tdate.valueOf();
                    });

                    if (matching.length) {
                        result = [true, 'ui-datepicker-highlight', null];
                    }
                    return result;
                },
                // event handler
                onSelect: function () {
                    var id = $(this).find(".ui-datepicker-current-day").attr("data-id");
                    console.log(id);
                    mydata = $(this).data("mydata"),
                        selectedData = null;
                    $.each(mydata, function () {
                        if (this.id == id) {
                            selectedData = this;
                        }
                    });
                    if (selectedData) {
                        alert(selectedData);
                    }
                }
            })
        }
    );
</script>

<script src="/lib/slick/slick.js"></script>
<script>

    function initSlick($element) {
        var count = parseInt(($element.attr('data-slick-count') || 3))
        $element.slick({
            infinite: true,
            slidesToShow: count,
            slidesToScroll: count,
            'nextArrow': '<div class="slick-next"></div>',
            'prevArrow': '<div class="slick-prev"></div>'
        })
    }
    function initSlickAll() {
        initSlick($('.prfl-recomended .bio-slick-list'));
        initSlick($('.prfl-issledovaniya .bio-slick-list'));
    }

    $(window).load(function(){
        initSlickAll();
        /* if($('html').width() > 768) initSlickAll();
         $(window).resize(function () {
         if($('html').width() < 768)$('.bio-slick-list').slick('unslick');
         else initSlickAll()
         })*/
    })

    $(document).ready(
        function () {
            $('.js-destroy-slick').click(function () {
                var $parent = $(this).closest('.prfl-row-content');
                if ($parent.hasClass('unslicked')) {
                    initSlick($parent.find('.bio-slick-list'));
                    $(this).text(($(this).attr('data-old-text') || 'Смотреть все'));
                    $parent.removeClass('unslicked')
                } else {
                    $parent.find('.bio-slick-list').slick('unslick');
                    $(this).attr('data-old-text', $(this).text());
                    $(this).text('Скрыть');
                    $parent.addClass('unslicked')
                }
                return false
            })

        }
    );
</script>
<script src="/lib/jquery.nicescroll.min.js"></script>
<script>
    $(document).ready(
        function () {
            $(".left-menu, .prfl-riski-list, .prfl-calendar-list").niceScroll({
                'cursorcolor': "#C4C4C4",
                'cursoropacitymin': "1",
                'cursorwidth': 5,
                'cursorborder': "none",
                /*'touchbehavior': true,*/
                'background': "#E3E3E3"
            });
        }
    );
</script>

<script>
    $(function(){
        $('.js-show-hidden-part-calendar-list-items').click(function () {
            $('.prfl-calendar-list').toggleClass('js-hidden-part-calendar-list-items');
            return false
        })
    })
</script>
<script src="/js/main.js"></script>
</body>
</html>