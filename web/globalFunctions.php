<?php

    function print_r_pre($DATA, $NAME_VARIABLE = '') {
        echo '
          <div style="background: #eee !important; color: #000 !important; font-size: 12px !important; margin: 10px; padding: 10px;">
          <br /><br />
            ' . ($NAME_VARIABLE != '' ? '<br />VARIABLE: ' . $NAME_VARIABLE . '<br />' : '') . '
            <pre style="white-space: pre-wrap;">';
        print_r($DATA);
        echo '</pre>
          </div>
        ';
    }

    /* declOfNum($count, ['найдена', 'найдено', 'найдены']); */
    function declOfNum($number, $titles) {
        $cases = [2, 0, 1, 1, 1, 2];
        return $titles[ ($number%100>4 && $number%100<20)? 2 : $cases[($number%10<5)?$number%10:5] ];
    }


    function debug($var, $get = false) {
        if($get && !$_GET['asd'])return false;
        print_r_pre($var);
        die;
    }