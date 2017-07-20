<?php
$postdata = array(
    'name' => '34523453wer45',
    'surname' => 'asdasd',
    'password' => '123456',
    'phone' => '89529230181',
    'email' => 'dyupinars2312436123@gmail.com',
    'male' => 1,
    'birthDay' => 7,
    'birthMonth' => 6,
    'birthYear' => 1988,
    'token' => '7ab782c32193ad9e8f5bdd771600b39c',
    'type' => 'pacient',
    'district_code' => 1101000000
     );

$filePath = realpath('7.jpg');

/*$postdata = array(
    'token' => 'e974ecf5a71803917404bed52e5429b1',
    'pacient_id' => 18,
    'doctor_id' => 19,
    'enabled' => 1,
    'read' => 'all',
    'notice_id' => 3,
);*/

/*$postdata = array(
    'token' => '7ab782c32193ad9e8f5bdd771600b39c',
    'pacient_id' => 18,
    'doctor_id' => 19,
    //'enabled' => 'all'
    //'file' => new CURLFile($filePath, 'image/jpeg', '123.jpg'),
);*/

//$postdata = array('image' => '@{'.$filePath.'};type=image/jpeg');

$url = 'user/register';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://biogenom.loc/api/'.$url);
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