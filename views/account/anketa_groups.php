<?php
/**
 * Created by PhpStorm.
 * User: Sasha
 * Date: 10.12.2016
 * Time: 18:02
 */
$this->title = "Анкета";
?>

<h1>Анкета</h1>

<div class="anketa">
    <div class="anketa-buttonset js-question-tabs">
        <div class="button">Все блоки вопросов</div>
        <div class="button clear">Неотвеченные</div>
        <div class="button clear">Законченные</div>
    </div>
    <div class="anketa-group-list">
        <?php foreach ($groups as $index => $group) { ?>
            <a href="<?=  Yii::$app->urlManager->createUrl(['account/anketa', 'id_parent' => $group['id_measure']]) ?>"
               class="anketa-group-list-item">
                <div class="anketa-group-list-item-title"><?= $group['name'] ?></div>
                <div class="anketa-group-list-item-scale">
                    <div class="anketa-group-list-item-scale__text">
                        <span>Готово</span>
                        <span><?= $group['answered']['proc'] ?>%</span>
                    </div>
                    <div class="anketa-group-list-item-scale__scale-container">
                        <div class="anketa-group-list-item-scale__scale-scale"
                             style="width:<?= $group['answered']['proc'] ?>%"></div>
                    </div>
                </div>
                <?php if ($group['answered']['need'] == $group['answered']['answered']) { ?>
                    <div class="anketa-group-list-item-lost">Вы ответили на все вопросы</div>
                <?php } else { ?>
                    <div class="anketa-group-list-item-lost">Вы ответили на <?= $group['answered']['answered'] ?>
                        вопросов из <?= $group['answered']['need'] ?></div>
                <?php } ?>
            </a>
        <?php } ?>
        <a href=""  class="anketa-group-list-item"></a>
        <a href=""  class="anketa-group-list-item"></a>
        <a href=""  class="anketa-group-list-item"></a>
    </div>

    <div class="anketa-buttonset anketa-buttonset__bottom">
        <?php if ($canSend) { ?>
            <a href="<?= Yii::$app->urlManager->createUrl(['account/get-result']) ?>" class="button">Отправить на
                обработку</a>
        <?php } else { ?>
            <div class="button disabled">Отправить на обработку</div>
            <div class="anketa-buttonset__info">Возможно после заполнения всех вопросов анкеты</div>
        <?php } ?>
    </div>
</div>

<script>
    $('.js-question-tabs .button').click(function () {
        if ($(this).hasClass('clear')) {
            $('.js-question-tabs .button').addClass('clear');
            $(this).removeClass('clear');
            switch ($(this).index()) {
                case 1: /*Неотвеченные*/
                    $('.anketa-group-list-item').show();
                    $(".anketa-group-list-item:contains('100%')").hide();
                    break;

                case 2: /*Законченные*/
                    $('.anketa-group-list-item').hide();
                    $(".anketa-group-list-item:contains('100%')").show();
                    break;
                default:
                    $('.anketa-group-list-item').show();
            }
        } else {
            return
        }
    })
</script>