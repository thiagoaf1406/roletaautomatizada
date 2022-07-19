<?php

require_once '../../../classes/config.php';

$table = 'roleta_evolution';
 
$primaryKey = 'id';


function status($id){
    $roleta = RoletaEvolution::find($id);
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
    array('db' => 'id', 'dt' => 0, 'formatter' => function( $d, $row ){ return '<a href="evolution/roleta?id='.$d.'"><i class="fa fa-edit"></i></a>';  }),
    array('db' => 'nome', 'dt' => 1),
    array('db' => 'id', 'dt' => 2, 'formatter' => function( $d, $row ){ return status($d);  }),
    array('db' => 'link', 'dt' => 3),
);

$sql_details = array('user' => USERNAME, 'pass' => PASSWORD, 'db' => DATABASE, 'host' => 'localhost');
 
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, "usuario = '".$_SESSION['usuario_id']."'"));

?>