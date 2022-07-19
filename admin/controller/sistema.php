<?php

require_once '../../classes/config.php';

extract($_POST);


    $Usuario = Sistema::find(1);
    $Usuario->fetch($_POST);

if($Usuario->save()){
    $data['sucesso'] = true;
} else {
    $data['sucesso'] = false;
}   

echo json_encode($data);