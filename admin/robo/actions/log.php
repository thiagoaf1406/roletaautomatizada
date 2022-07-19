<?php

require_once '../../../classes/config.php';

$table = 'updates';
 
$primaryKey = 'id';

$columns = array(
    array('db' => 'update_id', 'dt' => 0),
    array('db' => 'nome', 'dt' => 1),
    array('db' => 'texto', 'dt' => 2),
    array('db' => 'date', 'dt' => 3, 'formatter' => function( $d, $row ){ return formataDataHora($d); }),
);

$sql_details = array('user' => USERNAME, 'pass' => PASSWORD, 'db'   => DATABASE, 'host' => 'localhost');
 
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, "id >= 0"));
?>