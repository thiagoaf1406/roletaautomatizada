<?php

require_once '../../../classes/config.php';

$table = 'estrategias';
 
$primaryKey = 'id';

$columns = array(
    array('db' => 'id', 'dt' => 0, 'formatter' => function( $d, $row ){ return '<a href="roleta/estrategia?id='.$d.'"><i class="fa fa-edit"></i></a>';  }),
    array('db' => 'nome', 'dt' => 1),
    array('db' => 'apostar', 'dt' => 2),
    array('db' => 'analisa', 'dt' => 3),
    array('db' => 'confirma', 'dt' => 4),
    array('db' => 'lucro', 'dt' => 5),
    array('db' => 'status', 'dt' => 6),
);

$sql_details = array('user' => USERNAME, 'pass' => PASSWORD, 'db' => DATABASE, 'host' => 'localhost');
 
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, "id != 10 AND id != 11 AND id != 12 AND id != 13 AND id != 14 AND id != 15 AND id != 16 AND id != 17 AND id != 18 AND id != 19 AND id != 20 AND id != 21"));
?>