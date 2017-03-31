<div class="anketa-question-list-item">
    <div class="anketa-question-list-item-title"><?=$question['name']?></div>
    <div class="anketa-question-list-item-values">
        <form action="<?= Yii::$app->urlManager->createUrl(['account/setvalue']) ?>">
            <input type="hidden" name="measure_id"  value="<?=$question['id_measure']?>">
            <input type="hidden" name="type_value" value="<?=$question['typevalue']?>">
            <input type="hidden" name="user_id" value="<?= Yii::$app->user->getId() ?>">
            <?php if ($question['typevalue'] == "NULL"){ ?>

            <?php } elseif ($question['typevalue'] == 0){ ?>
                <!-- текст -->
                <textarea name="value" id="" data-autoresize rows="1" placeholder="Введите" data-id_valnominal="<?=($question['values'])?$question['values'][0]['id_valnominal']:'0'?>"><?=($question['value'])?$question['value']['value']:''?></textarea>
            <?php } elseif ($question['typevalue'] == 1){ ?>
                <!--число типа float)-->
                <textarea name="value" id="" data-autoresize rows="1" placeholder="Введите число / номер" class="js-only-float" data-id_valnominal="<?=($question['values'])?$question['values'][0]['id_valnominal']:'0'?>"><?=($question['value'])?$question['value']['value']:''?></textarea>
            <?php } elseif ($question['typevalue'] == 2){ ?>
                <!--    единичный выбор из списка возможных значений;-->
                <?php foreach($question['values'] as $index => $value){ ?>
                    <label for="<?=$value['id_valnominal']?>" class="radio">
                        <input type="radio" value="<?=$value['id_valnominal']?>" name="value" <?=($question['value'] && $question['value']['value'] == $value['id_valnominal'])?'checked':''?> id="<?=$value['id_valnominal']?>">
                        <span><?=$value['valnominal']?></span>
                    </label>
                <?php } ?>
            <?php } elseif ($question['typevalue'] == 3){ ?>
                <!--множественный выбор из списка возможных значений -->
                <?php foreach($question['values'] as $index => $value){ ?>
                    <label for="<?=$value['id_valnominal']?>" class="checkbox">
                        <input type="checkbox" value="<?=$value['id_valnominal']?>" name="value[]" <?=($question['value'] && $question['value']['value'] && in_array($value['id_valnominal'], $question['value']['value']))?'checked':''?>  id="<?=$value['id_valnominal']?>" >
                        <span><?=$value['valnominal']?></span>
                    </label>
                <?php } ?>
            <?php } elseif ($question['typevalue'] == 4){ ?>
                дата (dd.mm.yyyy) (<?=$question['typevalue']?>)
            <?php } elseif ($question['typevalue'] == 5){ ?>
                text / memo) (<?=$question['typevalue']?>)
            <?php }else{?>
                неизвестный тип данных
            <?php } ?>
        </form>
    </div>

    <?php if ($question['children']){ ?>
        <?php foreach($question['children'] as $index => $child){ ?>
            <?= $this->render('_question', [
                'question' => $child
            ]) ?>
        <?php } ?>
    <?php } ?>
</div>
