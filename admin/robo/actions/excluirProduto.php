<?php
include '../../../classes/config.php';
extract($_POST);
$ep = ProdutosGrupo::find($id);
if($ep->destroy()){
    $data['sucesso'] = true;
} else {
     $data['sucesso'] = false;
}

echo json_encode($data);