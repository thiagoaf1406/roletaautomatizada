<?php

require_once '../../../classes/config.php';

$table = 'grupos';
 
$primaryKey = 'id';

$columns = array(
    array('db' => 'grupoID', 'dt' => 0),
    array('db' => 'nome', 'dt' => 1),
    array('db' => 'usuario', 'dt' => 2, 'formatter' => function( $d, $row ){ return Usuario::campo($d, 'nome'); }),
    array('db' => 'status', 'dt' => 3),
    array('db' => 'id', 'dt' => 4, 'formatter' => function( $d, $row ){ return Grupo::gerarBotoes($d); }),
);

$sql_details = array('user' => USERNAME, 'pass' => PASSWORD, 'db'   => DATABASE, 'host' => 'localhost');
 
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, "id >= 0"));
?>