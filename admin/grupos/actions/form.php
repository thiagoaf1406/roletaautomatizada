<?php
    include '../../../classes/config.php';
    
    extract($_POST);

    if(empty($id)){
        $param = new Grupo();
    } else {
        $param = Grupo::find($id);
    }
        $param->fetch($_POST);
    if($param->save()){
        $data['sucesso'] = true;
    } else {
        $data['sucesso'] = false;
    }   

    echo json_encode($data);
?>