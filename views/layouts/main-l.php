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
        ['label' => '<img src="/img/logo-min.png" class="top-user-bar-logo">', 'url' => 'http://biogenom.ru/', 'options'=> ['class'=>"mobile-hide__important"]],
        ['label' => 'Медплатформа', 'url' => 'http://biogenom.ru/%d0%be-%d0%bf%d1%80%d0%be%d0%b3%d1%80%d0%b0%d0%bc%d0%bc%d0%b5/'],
//        ['label' => 'Маркет', 'url' => ['/site/stub/3']],
//        ['label' => 'Запись к врачу', 'url' => ['/account']],
        ['label' => 'Новости', 'url' => 'http://biogenom.ru/news/'],
        ['label' => 'О компании', 'url' => 'http://biogenom.ru/o-nas/%D0%BE-%D0%BA%D0%BE%D0%BC%D0%BF%D0%B0%D0%BD%D0%B8%D0%B8/'],
        ['label' => 'Контакты', 'url' => 'http://biogenom.ru/%D0%BA%D0%BE%D0%BD%D1%82%D0%B0%D0%BA%D1%82%D1%8B/'],
    ],
    'encodeLabels' => false,
]);
$top_menu_reg = BTopNav::widget([
    'options' => ['class' => 'list-inline top-nav'],
    'items' => [
        ['label' => 'Регистрация', 'url' => ['/site/registration'], 'options'=> ['class'=>"log-in-out-item"]],
        ['label' => 'Войти', 'url' => ['/site/login'], 'options'=> ['class'=>"log-in-out-item"]],
    ],
    'encodeLabels' => false,
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

    <link href="/css/main-l.css" rel="stylesheet">
    <link href="/css/main-l-mobile.css" rel="stylesheet" media="all and (max-width: 767px)">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<div class="container-fluid fixed-top  mobile-hide">
    <div class="top">
        <div class="row top-user-bar mobile-hide">
            <div class="col-sm-8 mobile-logo-bar ">
                <?=$top_menu?>
            </div>
            <div class="col-sm-4  text-right">
                <div class="log-in-out">
                    <?=$top_menu_reg?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fixed-top-mobile mobile-show">
    <div class="mobile-logo-bar ">
        <img src="/img/menu-button-mobile.png" class="top-user-bar-logo menu-button-mobile js-toggle-mobile-menu">
        <img src="/img/logo-mobile.png" class="top-user-bar-logo mobile-show">
    </div>
</div>
<div class="js-mobile-menu all-hide">
    <div class="fixed-mobile-menu-bg  js-toggle-mobile-menu"></div>
    <div class="fixed-mobile-menu">
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
        <div class="col-sm-12">
            <div class="b-content">
                <?= $content ?>
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

<div class="all-hide js-popup" id="edit-profile-popup">
    <div class="popup-wall js-close-popup"></div>
    <div class="popup-window">
        <div class="popup-close-button js-close-popup"></div>
        <div class="popup-title">Личные данные</div>
        <div class="popup-content">
            <form action="">
                <table class="edit-prfl-table">
                    <tr>
                        <td>ФИО</td>
                        <td>
                            <input type="text" name="fio" class="form-control" value="Пручковская Маргарита Сергеевна">
                        </td>
                    </tr>
                    <tr>
                        <td>Дата</td>
                        <td>
                            <div class="edit-prfl-date">
                                <div class="edit-prfl-date__day edit-prfl-date__item">
                                    <select name="" id="" class="form-control">
                                        <option value="13">31</option>
                                        <option value="1">21</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="edit-prfl-date__month edit-prfl-date__item">
                                    <select name="" id="" class="form-control">
                                        <option value="март">март</option>
                                        <option value="март">март</option>
                                        <option value="март">март</option>
                                    </select></div>
                                <div class="edit-prfl-date__year edit-prfl-date__item">
                                    <select name="" id="" class="form-control">
                                        <option value="1111">1111</option>
                                        <option value="1111">1111</option>
                                        <option value="1111">1111</option>
                                    </select></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Адрес</td>
                        <td>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="text" name="fio" class="form-control" value="Петропавловская, 33">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Номер полиса ОМС</td>
                        <td>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="text" name="fio" class="form-control" value="1234567890">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Дата</td>
                        <td>
                            <div class="edit-prfl-date">
                                <div class="edit-prfl-date__day edit-prfl-date__item">
                                    <select name="" id="" class="form-control">
                                        <option value="13">31</option>
                                        <option value="1">21</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="edit-prfl-date__month edit-prfl-date__item">
                                    <select name="" id="" class="form-control">
                                        <option value="март">март</option>
                                        <option value="март">март</option>
                                        <option value="март">март</option>
                                    </select></div>
                                <div class="edit-prfl-date__year edit-prfl-date__item">
                                    <select name="" id="" class="form-control">
                                        <option value="1111">1111</option>
                                        <option value="1111">1111</option>
                                        <option value="1111">1111</option>
                                    </select></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Дата</td>
                        <td>
                            <div class="edit-prfl-date">
                                <div class="edit-prfl-date__day edit-prfl-date__item">
                                    <select name="" id="" class="form-control">
                                        <option value="13">31</option>
                                        <option value="1">21</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="edit-prfl-date__month edit-prfl-date__item">
                                    <select name="" id="" class="form-control">
                                        <option value="март">март</option>
                                        <option value="март">март</option>
                                        <option value="март">март</option>
                                    </select></div>
                                <div class="edit-prfl-date__year edit-prfl-date__item">
                                    <select name="" id="" class="form-control">
                                        <option value="1111">1111</option>
                                        <option value="1111">1111</option>
                                        <option value="1111">1111</option>
                                    </select></div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="form-group mobile-hide">
                    <input type="submit" name="phone" class="button">
                </div>
                <div class="mobile-show edit-profile-actions">
                    <div class="edit-profile-actions__item">
                        <a class="go-back js-close-popup" href="#">
                            Редактирование профиля
                        </a>
                    </div>
                    <div class="edit-profile-actions__item">
                        <button type="submit"><img src="/img/all-right-mobile.png" alt=""></button>
                    </div>
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