<?php

require_once '../../../classes/config.php';

$table = 'roleta';
 
$primaryKey = 'id';


function status($id){
    $roleta = Roleta::find($id);
    $retorno = '<div class="form-group d-flex align-items-center">';
    $retorno .= '<div class="switch m-r-10">';
    if($roleta->status == 'On'){
        $retorno .= '<input type="checkbox" id="switch-'.$id.'" checked onclick="atualizaStatus(\'Off\', '.$id.')">';
    } else {
        $retorno .= '<input type="checkbox" id="switch-'.$id.'" onclick="atualizaStatus(\'On\', '.$id.')">';
    }
    $retorno .= '<label for="switch-'.$id.'"></label>';
    $retorno .= '</div>';
    $retorno .= '</div>';
    return $retorno;
}

$columns = array(
    array('db' => 'id', 'dt' => 0, 'formatter' => function( $d, $row ){ return '<a href="roletas/roleta?id='.$d.'"><i class="fa fa-edit"></i></a>';  }),
    array('db' => 'nome', 'dt' => 1),
    array('db' => 'link', 'dt' => 2),
    array('db' => 'id', 'dt' => 3, 'formatter' => function( $d, $row ){ return status($d);  }),
);

$sql_details = array('user' => USERNAME, 'pass' => PASSWORD, 'db' => DATABASE, 'host' => 'localhost');
 
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, "usuario = '".$_SESSION['usuario_id']."'"));

?>