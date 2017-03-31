<?php
use \yii\widgets\ActiveForm;

$this->title = 'Личный кабинет';
?>
<div class="prfl">
    <div class="row prfl-main">
        <div class="prfl-avatar relative">
            <img src="<?=$avatar?>" alt="">
            <div class="mobile-show prfl-avatar_actions prfl-avatar_actions-top"></div>
            <div class="prfl-avatar_actions">
                <span class="prfl-avatar_actions--name mobile-show">
                    <?=$user->username?>
                </span>


                <!-- форма новой фотографии начало -->
                <?php
                echo \app\widgets\uploadPhoto\UploadPhoto::widget([
                    'action'=>['account/upload-photo'],
                    'model'=>$uplodPhotoModel
                ])
                ?>
                <!-- форма новой фотографии конец-->
            </div>

        </div>
        <div class="col-sm-8 prfl-contacts">
            <div class="prfl-main-title mobile-hide">
                <h1>Личные данные</h1>
            </div>
            <div class="contacts-table">
                <table>
                    <tr class="mobile-hide">
                        <td>ФИО</td>
                        <td><?=$user->username?></td>
                    </tr>
                    <tr>
                        <td>Дата рождения</td>
                        <td><?=$pacient->birthString?> <span class="gray-4">(<?=$ageOld?> <?=declOfNum($ageOld, ['год', 'года', 'лет'])?>)</span></td>
                    </tr>
                    <tr>
                        <td>Регион проживания</td>
                        <td><?=$districtName?></td>
                    </tr>
                    <tr>
                        <td>Номер полиса ОМС</td>
                        <td><?=$pacient->polis?></td>
                    </tr>
                    <tr>
                        <td>Первое обследование</td>
                        <td>16.09.2016</td>
                    </tr>
                    <tr>
                        <td>Повторная сдача анализа</td>
                        <td>27.11.2016</td>
                    </tr>
                </table>
            </div>
            <div class="prfl-contacts-buttonset">
                <div class="button js-open-popup" data-selector="#edit-profile-popup" >Редактировать</div>
            </div>
        </div>
    </div>
    <div class="row prfl-row">
        <div class="prfl-row-title">
            <h2>Риски для здоровья</h2>
        </div>
        <div class="prfl-row-content">
            <div class="prfl-riski">
                <div class="prfl-riski-left">
                    <div class="prfl-riski-intro">
                        <div class="prfl-riski-intro_item">
                            <div class="scale-container">
                                <div class="scale scale-blue"></div>
                            </div>
                            <div class="prfl-riski-text prfl-riski-text-intro">
                                Ваше состояние
                            </div>
                        </div>
                        <div class="prfl-riski-intro_item">
                            <div class="scale-container">
                                <div class="scale scale-green"></div>
                            </div>
                            <div class="prfl-riski-text prfl-riski-text-intro">
                                Эталонное состояние
                            </div>
                        </div>
                    </div>
                    <div class="prfl-riski-image mobile-hide">
                        <img src="/img/enalon.png" alt="">
                    </div>
                </div>
                <div class="prfl-riski-right">
                    <div class="prfl-riski-list">
                        <div class="prfl-riski-list-item">
                            <div class="prfl-riski-list-item_title prfl-riski-text">
                                Риск сердечно сосудистых заболеваний
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-blue">
                                        <div class="scale-text">100%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-green" style="width: 45%"></div>
                                </div>
                            </div>
                            <div class="prfl-riski-text-small">
                                45% – эталонное состояние
                            </div>
                        </div>
                        <div class="prfl-riski-list-item">
                            <div class="prfl-riski-list-item_title prfl-riski-text">
                                Риск сердечно сосудистых заболеваний
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-blue" style="width: 35%">
                                        <div class="scale-text">35%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-green" style="width: 35%"></div>
                                </div>
                            </div>
                            <div class="prfl-riski-text-small">
                                35% – эталонное состояние
                            </div>
                        </div>
                        <div class="prfl-riski-list-item">
                            <div class="prfl-riski-list-item_title prfl-riski-text">
                                Риск сердечно сосудистых заболеваний
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-blue"  style="width: 65%">
                                        <div class="scale-text">65%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-green" style="width: 35%"></div>
                                </div>
                            </div>
                            <div class="prfl-riski-text-small">
                                35% – эталонное состояние
                            </div>
                        </div>
                        <div class="prfl-riski-list-item  mobile-hide">
                            <div class="prfl-riski-list-item_title prfl-riski-text">
                                Риск сердечно сосудистых заболеваний
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-blue">
                                        <div class="scale-text">100%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-green" style="width: 35%"></div>
                                </div>
                            </div>
                            <div class="prfl-riski-text-small">
                                35% – эталонное состояние
                            </div>
                        </div>
                        <div class="prfl-riski-list-item  mobile-hide">
                            <div class="prfl-riski-list-item_title prfl-riski-text">
                                Риск сердечно сосудистых заболеваний
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-blue">
                                        <div class="scale-text">100%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-green" style="width: 35%"></div>
                                </div>
                            </div>
                            <div class="prfl-riski-text-small">
                                35% – эталонное состояние
                            </div>
                        </div>
                        <div class="prfl-riski-list-item  mobile-hide">
                            <div class="prfl-riski-list-item_title prfl-riski-text">
                                Риск сердечно сосудистых заболеваний
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-blue">
                                        <div class="scale-text">100%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-green" style="width: 35%"></div>
                                </div>
                            </div>
                            <div class="prfl-riski-text-small">
                                35% – эталонное состояние
                            </div>
                        </div>
                        <div class="prfl-riski-list-item  mobile-hide">
                            <div class="prfl-riski-list-item_title prfl-riski-text">
                                Риск сердечно сосудистых заболеваний
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-blue">
                                        <div class="scale-text">100%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-green"  style="width: 35%"></div>
                                </div>
                            </div>
                            <div class="prfl-riski-text-small">
                                35% – эталонное состояние
                            </div>
                        </div>
                        <div class="prfl-riski-list-item  mobile-hide">
                            <div class="prfl-riski-list-item_title prfl-riski-text">
                                Риск сердечно сосудистых заболеваний
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-blue">
                                        <div class="scale-text">100%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-green" style="width: 35%"></div>
                                </div>
                            </div>
                            <div class="prfl-riski-text-small">
                                35% – эталонное состояние
                            </div>
                        </div>
                        <div class="prfl-riski-list-item mobile-hide">
                            <div class="prfl-riski-list-item_title prfl-riski-text">
                                Риск сердечно сосудистых заболеваний
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-blue">
                                        <div class="scale-text">100%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-green" style="width: 35%"></div>
                                </div>
                            </div>
                            <div class="prfl-riski-text-small">
                                35% – эталонное состояние
                            </div>
                        </div>
                        <div class="prfl-riski-list-item mobile-hide">
                            <div class="prfl-riski-list-item_title prfl-riski-text">
                                Риск сердечно сосудистых заболеваний
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container">
                                    <div class="scale scale-blue">
                                        <div class="scale-text">100%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="prfl-riski-list-item_scale">
                                <div class="scale-container" style="width: 35%">
                                    <div class="scale scale-green"></div>
                                </div>
                            </div>
                            <div class="prfl-riski-text-small">
                                35% – эталонное состояние
                            </div>
                        </div>
                    </div>
                    <div class="mobile-show">
                        <div class="button js-toggle" data-selector=".prfl-riski-list-item.mobile-hide">Показать все</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row prfl-row prfl-row-calendar">
        <div class="prfl-row-title mobile-hide">
            <h2>Ближайшие медико-профилактические мероприятия</h2>
        </div>
        <div class="prfl-row-content prfl-row-content-calendar">
            <div class="prfl-calendar">
                <div class="prfl-calendar-left">
                    <div class="main-calendar" id="main-calendar"></div>
                </div>
                <div class="prfl-row-title mobile-show">
                    <h2>Ближайшие медико-профилактические мероприятия</h2>
                </div>
                <div class="prfl-calendar-right">
                    <div class="prfl-calendar-list js-hidden-part-calendar-list-items">
                        <div class="prfl-calendar-list-title">
                            Сегодня 24 ноября
                        </div>
                        <div class="prfl-calendar-list-item">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">12:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">14:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">19:00</div>
                            </div>
                        </div>
                        <div class="prfl-calendar-list-item">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">12:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">14:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">19:00</div>
                            </div>
                        </div>
                        <div class="prfl-calendar-list-item">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">12:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">14:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">19:00</div>
                            </div>
                        </div>
                        <div class="prfl-calendar-list-item all-hide">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">12:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">14:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">19:00</div>
                            </div>
                        </div>
                        <div class="prfl-calendar-list-item all-hide">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">12:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">14:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">19:00</div>
                            </div>
                        </div>
                        <div class="prfl-calendar-list-item all-hide">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">12:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">14:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">19:00</div>
                            </div>
                        </div>
                        <div class="prfl-calendar-list-item all-hide">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">12:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">14:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">19:00</div>
                            </div>
                        </div>
                        <div class="prfl-calendar-list-item all-hide">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">12:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">14:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">19:00</div>
                            </div>
                        </div>
                        <div class="prfl-calendar-list-item all-hide">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">12:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">14:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">19:00</div>
                            </div>
                        </div>
                        <div class="prfl-calendar-list-item all-hide">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">12:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">14:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">19:00</div>
                            </div>
                        </div>
                        <div class="prfl-calendar-list-item mobile-hide all-hide">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">12:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">14:00</div>
                                <div class="prfl-calendar-list-item_timesmap-item">19:00</div>
                            </div>
                        </div>
                        <div class="prfl-calendar-list_show-all-items">
                            <a href="#" class="js-toggle mobile-hide" data-selector=".prfl-calendar-list-item.all-hide">смотреть все мероприятия на сегодня</a>

                            <div class="mobile-show button js-toggle" data-selector=".prfl-calendar-list-item.all-hide">Смотреть все на сегодня</div>
                        </div>

                        <div class="prfl-calendar-list-title">
                            25 ноября – 25 декабря
                        </div>

                        <div class="prfl-calendar-list-item__all-month">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">25 ноября в 18:30</div>
                            </div>
                        </div>

                        <div class="prfl-calendar-list-item__all-month">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">25 ноября в 18:30</div>
                            </div>
                        </div>

                        <div class="prfl-calendar-list-item__all-month">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">25 ноября в 18:30</div>
                            </div>
                        </div>

                        <div class="prfl-calendar-list-item__all-month">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">25 ноября в 18:30</div>
                            </div>
                        </div>
                        <div class="prfl-calendar-list-item__all-month">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">25 ноября в 18:30</div>
                            </div>
                        </div>
                        <div class="prfl-calendar-list-item__all-month">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">25 ноября в 18:30</div>
                            </div>
                        </div>
                        <div class="prfl-calendar-list-item__all-month">
                            <div class="prfl-calendar-list-item_title prfl-calendar-text">
                                Массаж шеи
                            </div>
                            <div class="prfl-calendar-list-item_timesmap">
                                <div class="prfl-calendar-list-item_timesmap-item">25 ноября в 18:30</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row prfl-row">
        <div class="prfl-row-title">
            <h2>Дополнительные исследования проблемных зон</h2>
        </div>
        <div class="prfl-row-content">
            <div class="prfl-issledovaniya relative text-center">
                <div class="bio-slick-list" data-slick-count="4">
                    <a href="#" class="bio-slick-list-item">
                        <div class="bio-slick-list-item_image">
                            <img src="/img/dop-issled.png" alt="">
                        </div>
                        <div class="bio-slick-list-item_title">
                            ЭКГ спинного
                            мозга
                        </div>
                    </a>
                    <a href="#" class="bio-slick-list-item">
                        <div class="bio-slick-list-item_image">
                            <img src="/img/dop-issled.png" alt="">
                        </div>
                        <div class="bio-slick-list-item_title">
                            ЭКГ спинного
                            мозга
                        </div>
                    </a>
                    <a href="#" class="bio-slick-list-item">
                        <div class="bio-slick-list-item_image">
                            <img src="/img/dop-issled.png" alt="">
                        </div>
                        <div class="bio-slick-list-item_title">
                            ЭКГ спинного
                            мозга
                        </div>
                    </a>
                    <a href="#" class="bio-slick-list-item">
                        <div class="bio-slick-list-item_image">
                            <img src="/img/dop-issled.png" alt="">
                        </div>
                        <div class="bio-slick-list-item_title">
                            ЭКГ спинного
                            мозга
                        </div>
                    </a>
                    <a href="#" class="bio-slick-list-item">
                        <div class="bio-slick-list-item_image">
                            <img src="/img/dop-issled.png" alt="">
                        </div>
                        <div class="bio-slick-list-item_title">
                            ЭКГ спинного
                            мозга
                        </div>
                    </a>
                    <a href="#" class="bio-slick-list-item">
                        <div class="bio-slick-list-item_image">
                            <img src="/img/dop-issled.png" alt="">
                        </div>
                        <div class="bio-slick-list-item_title">
                            ЭКГ спинного
                            мозга
                        </div>
                    </a>
                    <a href="#" class="bio-slick-list-item">
                        <div class="bio-slick-list-item_image">
                            <img src="/img/dop-issled.png" alt="">
                        </div>
                        <div class="bio-slick-list-item_title">
                            ЭКГ спинного
                            мозга
                        </div>
                    </a>
                </div>
                <a href="#" class="button bio-slick-list-button js-destroy-slick">Смотреть все</a>
            </div>
        </div>
    </div>
    <div class="row prfl-row">
        <div class="prfl-row-title">
            <h2>Сервисы</h2>
        </div>
        <div class="prfl-row-content">
            <div class="prfl-services">
                <a href="#" class="prfl-service">
                    <div class="prfl-service_icon prfl-service_icon-1"></div>
                    <div class="prfl-service_title">
                        <span>Запись к врачу</span>
                    </div>
                </a>
                <a href="#" class="prfl-service">
                    <div class="prfl-service_icon prfl-service_icon-2"></div>
                    <div class="prfl-service_title">
                        <span>Интернет-аптека</span>
                    </div>
                </a>
                <a href="#" class="prfl-service">
                    <div class="prfl-service_icon prfl-service_icon-3"></div>
                    <div class="prfl-service_title">
                        <span>Санаторно-курортное лечение</span>
                    </div>
                </a>
                <a href="#" class="prfl-service">
                    <div class="prfl-service_icon prfl-service_icon-4"></div>
                    <div class="prfl-service_title">
                        <span>Питание</span>
                    </div>
                </a>
                <a href="#" class="prfl-service">
                    <div class="prfl-service_icon prfl-service_icon-5"></div>
                    <div class="prfl-service_title">
                        <span>Процедуры</span>
                    </div>
                </a>
                <a href="#" class="prfl-service">
                    <div class="prfl-service_icon prfl-service_icon-6"></div>
                    <div class="prfl-service_title">
                        <span>Телемедицина</span>
                    </div>
                </a>
                <a href="#" class="prfl-service">
                    <div class="prfl-service_icon prfl-service_icon-7"></div>
                    <div class="prfl-service_title">
                        <span>Фитнес</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row prfl-row">
        <div class="prfl-row-title">
            <h2>Рекомендуемые товары</h2>
        </div>
        <div class="prfl-row-content">
            <div class="prfl-recomended relative text-left">
                <div class="bio-slick-list" data-slick-count="3">
                    <a href="#" class="bio-slick-list-item">
                        <div class="bio-slick-list-item_image">
                            <img src="/img/ibuprofen.png" alt="">
                        </div>
                        <div class="bio-slick-list-item_title">
                            Ибупрофен 1
                        </div>
                    </a>
                    <a href="#" class="bio-slick-list-item">
                        <div class="bio-slick-list-item_image">
                            <img src="/img/noshpa.png" alt="">
                        </div>
                        <div class="bio-slick-list-item_title">
                            Ношпа 2
                        </div>
                    </a>
                    <a href="#" class="bio-slick-list-item">
                        <div class="bio-slick-list-item_image">
                            <img src="/img/ibuprofen.png" alt="">
                        </div>
                        <div class="bio-slick-list-item_title">
                            Ибупрофен 3
                        </div>
                    </a>
                    <a href="#" class="bio-slick-list-item">
                        <div class="bio-slick-list-item_image">
                            <img src="/img/noshpa.png" alt="">
                        </div>
                        <div class="bio-slick-list-item_title">
                            Ношпа 4
                        </div>
                    </a>
                    <a href="#" class="bio-slick-list-item">
                        <div class="bio-slick-list-item_image">
                            <img src="/img/ibuprofen.png" alt="">
                        </div>
                        <div class="bio-slick-list-item_title">
                            Ибупрофен 5
                        </div>
                    </a>
                    <a href="#" class="bio-slick-list-item">
                        <div class="bio-slick-list-item_image">
                            <img src="/img/noshpa.png" alt="">
                        </div>
                        <div class="bio-slick-list-item_title">
                            Ношпа 6
                        </div>
                    </a>
                    <a href="#" class="bio-slick-list-item">
                        <div class="bio-slick-list-item_image">
                            <img src="/img/ibuprofen.png" alt="">
                        </div>
                        <div class="bio-slick-list-item_title">
                            Ибупрофен 7
                        </div>
                    </a>
                </div>
                <a href="#" class="button bio-slick-list-button  js-destroy-slick">Смотреть все</a>
            </div>
        </div>
    </div>
</div>

<!-- форма редактирования профиля - начало -->
<div class="<?=($showEditProfilePopup)?'':'all-hide'?> js-popup" id="edit-profile-popup">
    <div class="popup-wall js-close-popup"></div>
    <div class="popup-window">
        <div class="popup-close-button js-close-popup"></div>
        <div class="popup-title">Личные данные</div>
        <div class="popup-content">

            <?php $form = ActiveForm::begin([
                'id' => 'edit-form',
                /*'enableAjaxValidation' => true,*/
                /*'options'=>['class' => 'site-log-in-out-form'],*/
                'fieldConfig' => [
                    'template' => "{input}\n<div class=\"\">{error}</div>",
                ],
            ]); ?>
                <table class="edit-prfl-table">
                    <tr>
                        <td>ФИО</td>
                        <td>
                            <?= $form->field($editProfile, 'username')->textInput(['autofocus' => true, 'placeholder'=>'ФИО']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Ваш телефон</td>
                        <td>
                            <?= $form->field($editProfile, 'phone')->textInput(['placeholder'=>'Ваш телефон']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Ваш телефон</td>
                        <td>
                            <?= $form->field($editProfile, 'email')->textInput(['placeholder'=>'Email']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Дата</td>
                        <td>
                            <div class="edit-prfl-date">
                                <div class="edit-prfl-date__day edit-prfl-date__item">
                                    <?php echo $form->field($editProfile, 'birthDay')->dropDownList($editProfile->getBirthDays()); ?>
                                </div>
                                <div class="edit-prfl-date__month edit-prfl-date__item">
                                    <?php
                                    echo $form->field($editProfile, 'birthMonth')->dropDownList($editProfile->getBirthMonths());
                                    ?>
                                </div>
                                <div class="edit-prfl-date__year edit-prfl-date__item">
                                    <?php
                                    echo $form->field($editProfile, 'birthYear')->dropDownList($editProfile->getBirthYears());
                                    ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Регион проживания</td>
                        <td>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?= $form->field($editProfile, 'district_name')->dropDownList($editProfile->getDistricts()); ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Пол</td>
                        <td>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?= $form->field($editProfile, 'male', ['template'=>"<div class='registration-radio-list'>{input}</div>\n<div class=\"\">{error}</div>"])->radioList([0=>'Женский', 1=>'Мужской']) ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Номер полиса ОМС</td>
                        <td>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?= $form->field($editProfile, 'polis')->textInput([ 'placeholder'=>'Номер полиса ОМС	
']) ?>
                                </div>
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
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- форма редактирования профиля конец -->

