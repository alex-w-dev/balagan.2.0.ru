<!-- risksPrepared -->
<!-- $actionsPrepared -->

<div class="anketa get-result">
    <div id="global-tabs" class="response-tabs">
        <ul>
            <li><a href="#global-tabs-response">Риски</a></li>
            <li><a href="#global-tabs-actions">Мероприятия</a></li>
        </ul>
        <div id="global-tabs-response">

            <div id="response-tabs" class="response-tabs">
                <ul>
                    <?php foreach ($risksPrepared as $id_response => $response) { ?>
                        <li><a href="#response-tabs-<?= $id_response ?>"><?= $response['meta']['name'] ?></a></li>
                    <?php } ?>
                </ul>

                <?php foreach ($risksPrepared as $id_response => $response) { ?>
                    <div id="response-tabs-<?= $id_response ?>" class="response-tab">
                        <h3 class="response-tabs-h">Графики:</h3>
                        <div class="plot-control-panel">
                            <div>
                                Отображить риски:
                            </div>
                            <div class="plot-control-selects">
                                <select name="" id="plot-select-<?= $id_response ?>" class="plot-select form-control">
                                    <?php foreach ($сlassifiedRisksFieldsNames as $key => $class) { ?>
                                        <option value="<?= $key ?>"><?= $class['title'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="plot-control-checkboxes">
                                <?php foreach ($сlassifiedRisksFieldsNames as $key => $class) { ?>
                                    <?php foreach ($class['children'] as $childKey => $childName) { ?>
                                        <label class="plot-checkbox-label plot-checkbox-label__<?= $key ?>">
                                            <input type="checkbox" class="plot-checkbox plot-checkbox__<?= $key ?>"
                                                   value="<?= $childKey ?>" checked>
                                            <span><?= $childName ?></span>
                                        </label>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="plot-graphic" data-id="<?php echo $id_response; ?>"
                             id="plot-graphic-<?php echo $id_response; ?>" style="height:400px;"></div>

                        <h3 class="response-tabs-h">Общие данные:</h3>
                        <div class="get-result-response">
                            <div class="get-result-response__names">
                                <?php foreach ($risksFieldsNames as $index => $name) { ?>
                                    <div class="response-names__name">
                                        <span>
                                            <?= $name ?>
                                        </span>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="get-result-response__values">
                                <table class="table">
                                    <?php foreach ($risksFieldsNames as $index => $name) { ?>
                                        <?php if ($index == 'time_step') { ?>
                                            <tr class="response-values">
                                                <?php foreach ($response['dataOriginal'][$index] as $value) { ?>
                                                    <th class="response-values__value"><?= $value ?> <?= declOfNum($value, ['год', 'года', 'лет']) ?></th>
                                                <?php } ?>
                                            </tr>
                                            <?php continue;
                                        } ?>
                                        <tr class="response-values">
                                            <?php foreach ($response['dataOriginal'][$index] as $value) { ?>
                                                <td class="response-values__value"><?= $value ?></td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>


                    </div>
                <?php } ?>
            </div>
        </div>
        <div id="global-tabs-actions">
            <div class="get-result-recomendations">

                <div class="get-result-response">
                    <div class="get-result-response__names">
                        <div class="response-names__name"><span>Временной шаг</span></div>
                        <?php foreach ($actionsPrepared['actions'] as $action_id => $action) { ?>
                            <div class="response-names__name">
                        <span>
                            <?= $action['meta']['name'] ?>
                        </span>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="get-result-response__values">
                        <table class="table">
                            <tr class="response-values">
                                <?php
                                /*for($i = $actionsPrepared['other']['minActionTimeStep'];
                                          $i <= $actionsPrepared['other']['maxActionTimeStep'];
                                          $i+= $actionsPrepared['other']['actionTimeStepSize']
                                ){*/
                                foreach ($actionsPrepared['other']['allActionsTimeSteps'] as $i) { ?>
                                    <th class="response-values__value"><?= $i ?> <?= declOfNum($i, ['год', 'года', 'лет']) ?></th>
                                <?php } ?>
                            </tr>
                            <?php foreach ($actionsPrepared['actions'] as $action_id => $action) { ?>

                                <tr class="response-values">
                                    <?php foreach ($action['data'] as $value) { ?>
                                        <td class="response-values__value">
                                            <?php if ($value) { ?>
                                                +
                                            <?php } else { ?>
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
    </div>
</div>

<script src="/lib/flot/jquery.flot.js"></script>
<script src="/lib/flot/jquery.flot.navigate.js"></script>
<script src="/lib/flot/jquery.flot.threshold.js"></script>
<script src="/lib/flot/jquery.flot.crosshair.js"></script>
<script>
    var globalColors = [
        {
            color : '#0acbff',
            threshold : [{
                below: .2,
                color: "#53c4ce"
            }, {
                below: .4,
                color: '#bfd9ff'
            }, {
                below: .6,
                color: '#ffd1d1'
            }, {
                below: .8,
                color: '#ff8580'
            }, {
                below: 1,
                color: '#ff692f'
            }, {
                below: 99999999,
                color: '#ff1200'
            }]
        },
        {
            color : '#0dff09',
            threshold : [{
                below: .2,
                color: "#45ce37"
            }, {
                below: .4,
                color: '#baff93'
            }, {
                below: .6,
                color: '#ffd6d3'
            }, {
                below: .8,
                color: '#ff848a'
            }, {
                below: 1,
                color: '#ff5f69'
            }, {
                below: 99999999,
                color: '#ff1200'
            }]
        },
        {
            color : '#fffd21',
            threshold : [{
                below: .2,
                color: "#fcfa48"
            }, {
                below: .4,
                color: '#ffde93'
            }, {
                below: .6,
                color: '#ff976b'
            }, {
                below: .8,
                color: '#ff6c3f'
            }, {
                below: 1,
                color: '#ff4d17'
            }, {
                below: 99999999,
                color: '#ff1200'
            }]
        }
    ]

    var dataPlot = {
        <?php foreach($risksPrepared as $id_response => $response){ ?>
        '<?php echo $id_response; ?>': <?php echo json_encode($response['dataPlot'], JSON_UNESCAPED_UNICODE); ?> ,
        <?php } ?>
    };

    function declOfNum(number, titles) {
        number = parseInt(number);
        cases = [2, 0, 1, 1, 1, 2];
        return titles[(number % 100 > 4 && number % 100 < 20) ? 2 : cases[(number % 10 < 5) ? number % 10 : 5]];
    }


    function plotInit($context, values) {
        function AxesProection(item){
            var x = item.datapoint[0].toFixed(2),
                y = item.datapoint[1].toFixed(2);
            /* пунктирные линии */
            var plotOffset = plot.getPlotOffset();
            var panelOffset = $panel.offset();
            var X = item.pageX - panelOffset.left - plotOffset.left;
            $('#plot-tooltip-lineY').height($panel.height() - (item.pageY - panelOffset.top) - plotOffset.bottom);
            $('#plot-tooltip-lineX').width(X).css('margin-left', '-'+X+'px');
            $('#plot-tooltip-lineY, #plot-tooltip-lineX').css({top: item.pageY, left: item.pageX}).fadeIn(200);

            /* подписи на осях */
            $('#plot-lineY-label').css({
                top: item.pageY,
                left: panelOffset.left + plotOffset.left
            }).html('<div>'+y+'</div>').fadeIn(200);
            var t =  (panelOffset.top + $panel.height() - plotOffset.bottom);
            $('#plot-lineX-label').css({
                top: t,
                left: item.pageX
            }).html('<div>'+x+'</div>').fadeIn(200);

        }

        var $panel = $context.find('.plot-graphic');
        var id = $panel.attr('data-id');
        var namedData = dataPlot[id];
        var data = [];

        if (!values) values = getValuesPlotCheckboxes($context);

        var colorIndex = 0
        for (var i in namedData) {
            if (namedData.hasOwnProperty(i) && values.indexOf(i) != (-1)) {
                var _data = $.extend({}, globalColors[colorIndex],  namedData[i]);
                console.log(_data);
                _data.label = _data.label + ' = 0';
                data.push(_data);
                colorIndex++;
            }
        }

        /* NONE TRASHED */
        var plot = $.plot(
            $panel,
            data,
            {
                series: {
                    lines: {
                        show: true,
                        fill: true
                    },
                    shadowSize: 0
                },
                points: {
                    show: true,
                    radius: 2
                },
                grid: {
                    hoverable: true,
                    clickable: true
                },
                yaxis: {
                    /*zoomRange: [0.1, 0.4],*/
                    min: 0
                },
                xaxis: {
                    /*zoomRange: [0.1, 100],  годы */
                    tickDecimals: 0,
                    tickFormatter: function (str) {
                        return str + declOfNum(str, ['год', 'года', 'лет']);
                    }
                },
                crosshair: {
                    mode: "x"
                },
                zoom: {
                    interactive: true
                },
                pan: {
                    interactive: true
                }
            }
        );

        // add zoom out button

        /*$("<div class='plot-nav-img' style='right:20px;top:20px'>zoom out</div>")
         .appendTo($panel)
         .click(function (event) {
         event.preventDefault();
         plot.zoomOut();
         });*/

        // and add panning buttons

        // little helper for taking the repetitive work out of placing
        // panning arrows
        function addArrow(dir, right, top, offset) {
            $("<img class='plot-nav-img' src='/lib/flot/examples/navigate/arrow-" + dir + ".gif' style='right:" + right + "px;top:" + top + "px'>")
                .appendTo($panel)
                .click(function (e) {
                    e.preventDefault();
                    plot.pan(offset);
                });
        }
        addArrow("left", 55, 60, {left: -100});
        addArrow("right", 25, 60, {left: 100});
        addArrow("up", 40, 45, {top: -100});
        addArrow("down", 40, 75, {top: 100});

        /* tooltip */
        if( ! $('#plot-tooltip').length) $("<div id='plot-tooltip'></div>").css({
            position: "absolute",
            display: "none",
            border: "1px solid #fdd",
            padding: "2px",
            "background-color": "#fee",
            opacity: 0.80
        }).appendTo("body");

        if( ! $('#plot-tooltip-lineX').length) $("<div id='plot-tooltip-lineX'></div>").appendTo("body");
        if( ! $('#plot-tooltip-lineY').length) $("<div id='plot-tooltip-lineY'></div>").appendTo("body");
        if( ! $('#plot-lineY-label').length) $("<div id='plot-lineY-label'><div></div></div>").appendTo("body");
        if( ! $('#plot-lineX-label').length) $("<div id='plot-lineX-label'><div></div></div>").appendTo("body");

        $context.bind("plothover", function (event, pos, item) {
            if (item) {
                var x = item.datapoint[0].toFixed(2),
                    y = item.datapoint[1].toFixed(2);
                $("#plot-tooltip").html(
                        item.series.originSeries.label.replace(/=.*/, '')
                        + ' в '
                        + Math.round(x)
                        + ' '
                        + declOfNum(x, ['год', 'года', 'лет'])
                        + " = "
                        + y
                    )
                    .css({top: item.pageY+5, left: item.pageX+5})
                    .fadeIn(200);

                /* проекции на оси */
                AxesProection(item);
            } else {
                $("#plot-tooltip").hide();
                $('#plot-tooltip-lineY, #plot-tooltip-lineX, #plot-lineX-label, #plot-lineY-label').hide();
            }


            /**/latestPosition = pos;
            if (!updateLegendTimeout) {
                updateLegendTimeout = setTimeout(updateLegend, 50);
            }
        });

        /* proection */
        var legends;
        function renewLegends(){
            legends = $context.find(".legendLabel");

            /*legends.each(function () {
                // fix the widths so they don't jump around
                $(this).css('width', $(this).width());
            });*/
        }
        renewLegends();
        $context.bind("plotzoom", function (event, pos, item) {
            renewLegends();
            updateLegend();
        });

        var updateLegendTimeout = null;
        var latestPosition = null;

        function updateLegend() {

            updateLegendTimeout = null;

            var pos = latestPosition;

            var axes = plot.getAxes();
            if (pos.x < axes.xaxis.min || pos.x > axes.xaxis.max ||
                pos.y < axes.yaxis.min || pos.y > axes.yaxis.max) {
                return;
            }

            var i, j, _dataset = plot.getData(), dataset = [];

            _dataset.map(function(el){
                if(el.data.length) dataset.push(el)
            });

            for (i = 0; i < dataset.length; ++i) {

                var series = dataset[i];

                // Find the nearest points, x-wise

                for (j = 0; j < series.data.length; ++j) {
                    if (series.data[j][0] > pos.x) {
                        break;
                    }
                }

                // Now Interpolate

                var y,
                    p1 = series.data[j - 1],
                    p2 = series.data[j];
                if (p1 == null) {
                    y = p2[1];
                } else if (p2 == null) {
                    y = p1[1];
                } else {
                    y = p1[1] + (p2[1] - p1[1]) * (pos.x - p1[0]) / (p2[0] - p1[0]);
                }

                legends.eq(i).text(series.label.replace(/=.*/, "= " + y.toFixed(2)));
            }
        }

        $context.bind("plothover",  function (event, pos, item) {
        });
    }

    function getValuesPlotCheckboxes($context) {
        $plot = $context.find(".plot-control-panel");
        $selectVal = $plot.find('.plot-select').val();
        $plot.find('.plot-checkbox-label').hide();
        return $plot.find('.plot-checkbox-label__' + $selectVal).show().find('.plot-checkbox:checked').map(function () {
            return $(this).val();
        }).get();
    }
</script>

<script>
    $(function () {
        $("#global-tabs").tabs();
        $("#response-tabs")
            .tabs({
                create: function (event, ui) {
                    plotInit(ui.panel);
                },
                activate: function (event, ui) {
                    plotInit(ui.newPanel);
                }
            })
        $('.plot-select, .plot-checkbox').change(function () {
            plotInit($(this).closest('.response-tab'));
        })
    });
</script>