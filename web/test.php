<?php
    $url = "http://biogenom.loc/black";
    $content = json_encode([
  "jsonrpc"=> "2.0",
  "method"=> "put_table",
  "params"=> [
    "table_name"=> "measure",
   "data" => [
        "id_measure" => [1,2,3,6,8],
     "id_parent" => [1,2,3,6,8],
     "name"=> ['Анкетирование','Анкета','О себе','Пол','Полис'],
     "typevalue"=>  [0,1,2,3,3],
     "sort_order"=> [1,1,2,1,3],
     "age_low"=> [0,0,0,0,0],
     "age_high"=> [1200,1200,1200,1200,1200],
     "male"=> [2,2,2,2,2]
  ]
  ],
   "id"=> 0
]);


    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    $json_response = curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
echo '<br>';
echo '<br>';
echo '<br>';
    /*if ( $status != 201 ) {
        die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }*/

print_r($json_response);
echo '<br>';
echo '<br>';
echo '<br>';

    curl_close($curl);

    $response = json_decode($json_response, true);

    print_r($response);