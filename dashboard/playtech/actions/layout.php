<?php
include '../../../classes/config.php';

extract($_POST);

$mensagem = Mensagem::find($id);
$mensagem->fetch($_POST);

if($mensagem->save()){
    $data['sucesso'] = true;
} else {
    $data['sucesso'] = false;
}   

echo json_encode($data);