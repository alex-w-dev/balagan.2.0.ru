<?php
$postdata = array(
    'name' => '34523453wer45',
    'surname' => 'asdasd',
    'password' => 'pat2',
    'phone' => '89529230181',
    'email' => 'pat2@pa4t2.pat2',
    'male' => 1,
    'birthDay' => 18,
    'birthMonth' => 7,
    'birthYear' => 1988,
    'token' => '6c05331c122d93edb3e15431cb7d7ac6',
    'type' => 'pacient',
    'district_code' => 1101000000
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

/*$postdata = array(
    'token' => '6c05331c122d93edb3e15431cb7d7ac6',
    //'pacient_id' => 18,
    //'doctor_id' => 19,
    //'enabled' => 'all'
    'file' => new CURLFile($filePath, 'image/jpeg', '123.jpg'),
);*/

//$postdata = array('image' => '@{'.$filePath.'};type=image/jpeg');

$url = 'user/login';
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