<?php

require_once '../../classes/config.php';

extract($_POST);

if(empty($id)){
    $Usuario = new Admin();
} else {
    $Usuario = Admin::find($id);
}
    $Usuario->fetch($_POST);

if($Usuario->save()){
    $data['sucesso'] = true;
} else {
    $data['sucesso'] = false;
}   

echo json_encode($data);