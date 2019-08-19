<?php

/**
 * Retourne le resultat d'un call API
 */
function callApi($url, $params = [], $method = 'GET', $responseInArray = true){

    $curl = curl_init();
 
    curl_setopt_array($curl, array(
          CURLOPT_PORT => "8000",
          CURLOPT_URL => "$url?accept=application/json",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $method,
          CURLOPT_POSTFIELDS => json_encode($params),
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "accept: application/json",
            "cache-control: no-cache"
       ),
    ));
 
  $data = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    return false;
  }
  $response = json_decode($data, true);
  if(isset($response['detail'])){
    //var_dump($response);
    return false;
  }
  return json_decode($data, $responseInArray);
 }