<?php
    include '../../../classes/config.php';
    
    extract($_POST);

    $param = Admin::find($id);
  
    if($param->destroy()){
        $data['sucesso'] = true;
    } else {
        $data['sucesso'] = false;
    }   

    echo json_encode($data);
?>