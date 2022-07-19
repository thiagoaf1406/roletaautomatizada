<?php

include '../classes/config.php';

date_default_timezone_set('America/Recife');

$debug = file_get_contents('php://input');

$meu_arquivo = 'debug.txt';
$handle = fopen($meu_arquivo, 'a') or die('Erro ao abrir o arquivo:  '.$meu_arquivo);
$texto_novo = "\r\n".$debug;
fwrite($handle, $texto_novo);

$updates = json_decode($debug, true);

if(isset($updates['update_id']) && isset($updates['message'])){
   
    $update = new Update();
    $update->update_id = $updates['update_id'];
    $update->message_id = $updates['message']['message_id'];
    $update->chatID = $updates['message']['from']['id'];
    $update->nome = $updates['message']['from']['first_name'].' '.$updates['message']['from']['last_name'];
    $update->texto = $updates['message']['text'];
    $update->date = date('Y-m-d H:i:s', $updates['message']['date']);
    $update->save();

    $chatID = $updates['message']['from']['id'];
    $comando = $updates['message']['text'];
    
}
if(isset($updates['update_id']) && isset($updates['my_chat_member'])){
    $chatID = $updates['my_chat_member']['chat']['id'];
    $chatTitle = $updates['my_chat_member']['chat']['title'];
    $grupos = Grupo::find(0, array("grupoID = '".$chatID."'"));
    if(count($grupos) ==0){
        $grupo = new Grupo();
        $grupo->grupoID = $chatID;
        $grupo->nome = $chatTitle;
        $grupo->horario_max = '23:59:00';
        $grupo->save();
    }
}
?>
