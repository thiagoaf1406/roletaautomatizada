<?php

require_once '../../../classes/config.php';

$table = 'grupos';
 
$primaryKey = 'id';

$columns = array(
    array('db' => 'grupoID', 'dt' => 0),
    array('db' => 'nome', 'dt' => 1),
    array('db' => 'status', 'dt' => 2),
    array('db' => 'id', 'dt' => 3, 'formatter' => function( $d, $row ){ return Grupo::gerarBotoes($d); }),
);

$sql_details = array('user' => USERNAME, 'pass' => PASSWORD, 'db'   => DATABASE, 'host' => 'localhost');
 
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, "usuario = '".$_SESSION['usuario_id']."'"));
?>