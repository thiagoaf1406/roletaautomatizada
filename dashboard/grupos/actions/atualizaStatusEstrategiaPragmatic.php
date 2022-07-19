<?php
    include '../../../classes/config.php';
    
    extract($_POST);
    
    $param = EstrategiasGruposPragmatic::find($id);
    $param->fetch($_POST);
    
    if($param->save()){
        $data['sucesso'] = true;
    } else {
        $data['sucesso'] = false;
    }   

    echo json_encode($data);
?>