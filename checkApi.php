<?php
$postdata = array(
    'username' => 'dyupinars4@gmail.com',
    'password' => '123456',
    'phone' => '89529230181',
    'email' => 'dyupinars4@gmail.com',
    'male' => 1,
    'birthDay' => 7,
    'birthMonth' => 'Июнь',
    'birthYear' => 1988,
    'type' => 'pacient',
    'license' => 2903478289083489
     );

$filePath = realpath('7.jpg');

$postdata = array(
    'pacient_id' => 18,
    'doctor_id' => 19
);

/*$postdata = array(
    'token' => 'eceb135bef7ed51e9a173ae44c7eaa27',
    'file' => new CURLFile($filePath, 'image/jpeg', '123.jpg'),
);*/
//$postdata = array('image' => '@{'.$filePath.'};type=image/jpeg');

$url = 'user/getdoctorspacients';
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
print_r($output);
curl_close($ch);