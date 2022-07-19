<?php
include '../../../classes/config.php';
extract($_POST);
$produtosGrupos = ProdutosGrupo::find(0, array("grupo = '".$grupo."' AND produto = '".$produto."'"));
if(count($produtosGrupos) ==0){
    $ep = new ProdutosGrupo();
    $ep->grupo = $grupo;
    $ep->produto = $produto;
    if($ep->save()){
        $data['sucesso'] = true;
    } else {
         $data['sucesso'] = false;
    }
} else {
    $data['sucesso'] = false;
}

echo json_encode($data);