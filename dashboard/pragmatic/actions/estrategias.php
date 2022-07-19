<?php

require_once '../../../classes/config.php';

$table = 'estrategiasPragmatic';
 
$primaryKey = 'id';

function status($id){
    $estrategia = EstrategiaPragmatic::find($id);
    $retorno = '<div class="form-group d-flex align-items-center">';
    $retorno .= '<div class="switch m-r-10">';
    if($estrategia->status == 'on'){
        $retorno .= '<input type="checkbox" id="switch-'.$id.'" checked onclick="atualizaStatus(\'off\', '.$id.')">';
    } else {
        $retorno .= '<input type="checkbox" id="switch-'.$id.'" onclick="atualizaStatus(\'on\', '.$id.')">';
    }
    $retorno .= '<label for="switch-'.$id.'"></label>';
    $retorno .= '</div>';
    $retorno .= '</div>';
    return $retorno;
}

$columns = array(
    array('db' => 'id', 'dt' => 0, 'formatter' => function( $d, $row ){ return '<a href="pragmatic/estrategia?id='.$d.'"><i class="fa fa-edit"></i></a>';  }),
    array('db' => 'nome', 'dt' => 1),
    array('db' => 'apostar', 'dt' => 2),
    array('db' => 'analisa', 'dt' => 3),
    array('db' => 'confirma', 'dt' => 4),
    array('db' => 'id', 'dt' => 5, 'formatter' => function( $d, $row ){ return status($d);  }),
);

$sql_details = array('user' => USERNAME, 'pass' => PASSWORD, 'db' => DATABASE, 'host' => 'localhost');
 
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, "usuario = '".$_SESSION['usuario_id']."'"));
?>