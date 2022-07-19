<?php
    include '../../../classes/config.php';
    
    extract($_POST);

    $param = Usuario::find($id);
  
    if($param->destroy()){
        $estrategias = Estrategia::find(0, array("usuario = '".$id."'"));
        if(count($estrategias) >=1){
            foreach($estrategias as $e){
                $ee = Estrategia::find($e->id);
                $ee->destroy();
            }
        }
        $grupos = Grupo::find(0, array("usuario = '".$id."'"));
        if(count($grupos) >=1){
            foreach($estrategias as $e){
                $ee = Grupo::find($e->id);
                $ee->destroy();
            }
        }
        $roletas = Roleta::find(0, array("usuario = '".$id."'"));
        if(count($roletas) >=1){
            foreach($roletas as $e){
                $ee = Roleta::find($e->id);
                $ee->destroy();
            }
        }
        $data['sucesso'] = true;
    } else {
        $data['sucesso'] = false;
    }   

    echo json_encode($data);
?>