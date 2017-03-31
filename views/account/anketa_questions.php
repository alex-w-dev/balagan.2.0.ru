<?php
/**
 * Created by PhpStorm.
 * User: Sasha
 * Date: 10.12.2016
 * Time: 18:02
 */
$this->title = $group['name'];
?>

<div class="anketa anketa-questions">
    <h1 class="anketa-question-title">
        <?=$group['name']?>
    </h1>
    <div class="anketa-question-list">
        <?php foreach($questions as $index => $question){ ?>

            <?= $this->render('_question', [
                'question' => $question
            ]) ?>

        <?php } ?>
    </div>

    <div class="anketa-questions-buttonset anketa-questions-buttonset__fixed ">
        <a href="<?=Yii::$app->urlManager->createUrl(['account/anketa'])?>" class="button">Сохранить</a>
        <div class="anketa-questions-buttonset-navigation">
            <?php if ($prev_group){ ?>
                <a href="<?=Yii::$app->urlManager->createUrl(['account/anketa', 'id_parent'=>$prev_group['id_measure']])?>" class="anketa-questions-prev active"></a>
            <?php }else{ ?>
                <a class="anketa-questions-prev"></a>
            <?php } ?>

            <?php if ($next_group){ ?>
                <a href="<?=Yii::$app->urlManager->createUrl(['account/anketa', 'id_parent'=>$next_group['id_measure']])?>" class="anketa-questions-next active"></a>
            <?php }else{ ?>
                <a class="anketa-questions-next"></a>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    /* функция свысчитаывает показывать anketa-questions-buttonset фиксированно или нет */
    function redrawButtonset(){
        var buttonset = $('.anketa-questions-buttonset');
        // $('.anketa-question-list').first().offset().top
        // document.documentElement.clientHeight
        // $(window).scrollTop()
        // $('.anketa-question-list').height()
        var scriollBot = $(window).scrollTop() + document.documentElement.clientHeight - buttonset.outerHeight() * 2;
        var offsetBot = $('.anketa-question-list').first().outerHeight() + $('.anketa-question-list').first().offset().top

        if(scriollBot < offsetBot){
            buttonset.addClass('anketa-questions-buttonset__fixed');
        }else{
            buttonset.removeClass('anketa-questions-buttonset__fixed');
        }

        buttonset.width($('.anketa-question-list').first().width());
        buttonset.css('left', $('.b-content').first().offset().left + 'px');
    }
    (function(){
        /* изменить ответ аккаунта . сохранить ответ */
        $('.anketa-question-list-item-values textarea, .anketa-question-list-item-values input').change(function () {
            var $form = $(this).closest('form');
            $.post(
                $form.attr('action'),
                $form.serialize(),
                function(data){
                },
                'json'
            )
        })

        redrawButtonset();
        $(window).scroll(function(){
            redrawButtonset();
        })
    })()
</script>