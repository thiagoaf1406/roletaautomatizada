<?php
require '../classes/config.php';

$teste = 'Teste';

$envio = sendMessage('thiagoaf1406', $teste);
print_r($envio);

function sendMessage($chatID, $mensagem){
    $robo = Sistema::find(1);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.telegram.org/bot".$robo->token."/getMe",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    $resposta = json_decode($response);
    return $resposta;
}

