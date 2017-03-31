<?php
use yii\widgets\ActiveForm;

?>
<a href="" class="js-open-popup" data-selector="#change-profile-photo" >
    <img src="/img/photo-icon.png" alt="">
</a>

<div class="all-hide js-popup" id="change-profile-photo">
    <div class="popup-wall js-close-popup"></div>
    <div class="popup-window">
        <div class="popup-close-button js-close-popup"></div>
        <div class="popup-title">Фотография</div>
        <div class="popup-content">
            <div class="change-profile-photo-link">Выбрать из галереи</div>
            <div class="change-profile-photo-link">Сделать фотографию</div>
            <div class="change-profile-photo-link" onclick="openPopup('#change-profile-photo-load'); closePopup('#change-profile-photo'); return false" >Загрузить фотографию</div>
        </div>
    </div>
</div>

<div class="all-hide js-popup" id="change-profile-photo-load">
    <div class="popup-wall js-close-popup"></div>
    <div class="popup-window">
        <div class="popup-close-button js-close-popup"></div>
        <div class="popup-title">Загрузить фотографию</div>
        <div class="popup-content">
            <?php $form = ActiveForm::begin(['action'=> $action, 'options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'file')->fileInput() ?>

            <button>Отправить</button>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>