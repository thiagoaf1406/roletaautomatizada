<?php
include '../../../classes/config.php';
extract($_POST);
$objs = ProdutosGrupo::find(0, array("grupo = '".$grupo."'"));
$data['objs'] = $objs;
if(count($objs) >=1){
    foreach($objs as $obj){
        $data['html'] .= '<tr class="tr-produto">';
        $data['html'] .= '<td>'.Produto::campo($obj->produto, 'product_id').'</td>';
        $data['html'] .= '<td><img src="'.Produto::campo($obj->produto, 'product_logo').'" style="width:80px;"></td>';
        $data['html'] .= '<td>'.Produto::campo($obj->produto, 'product_title').'</td>';
        $data['html'] .= '<td><button class="btn btn-default btn-xs" onclick="excluirProduto('.$obj->id.')"><i class="fas fa-trash"></i> Excluir</button></td>';
        $data['html'] .= '</tr>';
    } 
} else {
        $data['html'] .= '<tr class="tr-produto">';
        $data['html'] .= '<td colspan="4"></td>';
        $data['html'] .= '</tr>';
} 
$data['sucesso'] = true;
$data['post'] = $_POST;
echo json_encode($data);