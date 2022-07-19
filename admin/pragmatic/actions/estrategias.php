<?php

require_once '../../../classes/config.php';

$table = 'estrategiasPragmatic';
 
$primaryKey = 'id';

$columns = array(
    array('db' => 'id', 'dt' => 0, 'formatter' => function( $d, $row ){ return '<a href="pragmatic/estrategia?id='.$d.'"><i class="fa fa-edit"></i></a>';  }),
    array('db' => 'nome', 'dt' => 1),
    array('db' => 'apostar', 'dt' => 2),
    array('db' => 'analisa', 'dt' => 3),
    array('db' => 'confirma', 'dt' => 4),
    array('db' => 'status', 'dt' => 5),
);

$sql_details = array('user' => USERNAME, 'pass' => PASSWORD, 'db' => DATABASE, 'host' => 'localhost');
 
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, "usuario = 0"));
?>