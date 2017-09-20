<?php
$postdata = array(
    'name' => '34523453wer45',
    'surname' => 'adb4d3871eeeaf17b5d98002676c2d68',
    //'password' => 'pat2',
    'phone' => '89529230181',
    //'email' => 'pat2@pa4t2.pat2',
    'male' => 1,
    'birthDay' => 18,
    'birthMonth' => 7,
    'birthYear' => 1988,
    'token' => 'adb4d3871eeeaf17b5d98002676c2d68',
    'type' => 'pacient',
    'district_code' => 1101000000,
    'license' => '12312371892371231'
     );

$filePath = realpath('8.jpg');

/*$postdata = array(
    'token' => 'e974ecf5a71803917404bed52e5429b1',
    'pacient_id' => 18,
    'doctor_id' => 19,
    'enabled' => 1,
    'read' => 'all',
    'notice_id' => 3,
);*/

$postdata = array(
    //'token' => '4b37daa9c5ba3577827280a34919bd16',
    'token' => 'ceda0c7725ee32404c0a5812f513d8c5',
    'user_id' => 35,
    'measure_data' =>'[{"type_value":"1","value":"","measure_id":"1329"},{"type_value":"1","value":"","measure_id":"1340"},{"type_value":"1","value":"","measure_id":"1341"},{"type_value":"1","value":"","measure_id":"1342"},{"type_value":"1","value":"","measure_id":"1343"},{"type_value":"1","value":"","measure_id":"1344"},{"type_value":"1","value":"","measure_id":"1345"},{"type_value":"1","value":"","measure_id":"1346"},{"type_value":"1","value":"","measure_id":"1347"},{"type_value":"1","value":"","measure_id":"1339"},{"type_value":"1","value":"","measure_id":"1338"},{"type_value":"1","value":"","measure_id":"1330"},{"type_value":"1","value":"","measure_id":"1331"},{"type_value":"1","value":"","measure_id":"1332"},{"type_value":"1","value":"","measure_id":"1333"},{"type_value":"1","value":"","measure_id":"1334"},{"type_value":"1","value":"","measure_id":"1335"},{"type_value":"1","value":"123","measure_id":"1336"},{"type_value":"1","value":"321","measure_id":"1337"},{"type_value":"1","value":"123","measure_id":"1348"}]',
    //'mixed' => false,
    'id_parent' => 846,
    'find' => '23',
    'email' => 'panov@webmedved.ru'
    //'pacient_id' => 18,
    //'doctor_id' => 19,
    //'enabled' => 'all'
    //'file' => new CURLFile($filePath, 'image/jpeg', '123.jpg'),
);

$postdata = array(
    'token' => '1c823e1d3ee4c393af6e3a6a2925cee2',
    'reception_date' => '2017-09-20',
);

//$postdata = array('image' => '@{'.$filePath.'};type=image/jpeg');

$url = 'user/get-day-schedule';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://api.biogenom.ru/api/'.$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
$output = curl_exec($ch);
if ($output === FALSE) {
    //Тут-то мы о ней и скажем
    echo "cURL Error: " . curl_error($ch);
    return;
}
var_dump($output);
echo '<pre>';
var_dump(json_decode($output, true));
curl_close($ch);