<div class="anketa get-result">
    <h2>Риски:</h2>
    <div id="response-tabs" class="response-tabs">
        <ul>
            <?php foreach($risksPrepared as $id_response => $response){ ?>
                <li><a href="#response-tabs-<?=$id_response?>"><?=$response['meta']['name']?></a></li>
            <?php } ?>
        </ul>

        <?php foreach($risksPrepared as $id_response => $response){ ?>
            <div id="response-tabs-<?=$id_response?>">

                <div class="get-result-response">
                    <div class="get-result-response__names">
                        <?php foreach($risksFieldsNames as $index => $name){ ?>
                            <div class="response-names__name">
                                <span>
                                    <?=$name?>
                                </span>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="get-result-response__values">
                        <table class="table">
                            <?php foreach($risksFieldsNames as $index => $name){ ?>
                                <?php if ($index == 'time_step'){ ?>
                                    <tr class="response-values">
                                        <?php foreach($response['dataOriginal'][$index] as $value){ ?>
                                            <th class="response-values__value"><?=$value?> <?=declOfNum($value, ['год', 'года', 'лет'])?></th>
                                        <?php } ?>
                                    </tr>
                                <?php continue; } ?>
                                <tr class="response-values">
                                    <?php foreach($response['dataOriginal'][$index] as $value){ ?>
                                        <td class="response-values__value"><?=$value?></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                     <!--<div class="get-result-response__values">
                        <?php foreach($risksFieldsNames as $index => $name){ ?>
                            <div class="response-values">
                                <div class="response-values__lent">
                                    <?php foreach($response['dataOriginal'][$index] as $value){ ?>
                                        <div class="response-values__value"><?=$value?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>-->
                </div>


            </div>
        <?php } ?>
    </div>

    <h2>Рекомендации:</h2>

    <div class="get-result-recomendations">

        <div class="get-result-response">
            <div class="get-result-response__names">
                <div class="response-names__name"><span>Временной шаг</span></div>
                <?php foreach($actionNames as $action_id => $action){ ?>
                    <div class="response-names__name">
                        <span>
                            <?=$action['name']?>
                        </span>
                    </div>
                <?php } ?>
            </div>
            <div class="get-result-response__values">
                <table class="table">
                    <tr class="response-values">
                        <?php for($i = $minActionTimeStep; $i <= $maxActionTimeStep; $i++){ ?>
                            <th class="response-values__value"><?=$i?> <?=declOfNum($i, ['год', 'года', 'лет'])?></th>
                        <?php } ?>
                    </tr>
                    <?php foreach($actionNames as $action_id => $action){ ?>
                        <tr class="response-values">
                            <?php foreach($preparedActions[$action_id] as $value){ ?>
                                <td class="response-values__value">
                                    <?php if ($value != -1){ ?>
                                        +
                                    <?php } else {?>
                                        -
                                    <?php } ?>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    $( function() {
        $( "#response-tabs" ).tabs();
    });
</script>