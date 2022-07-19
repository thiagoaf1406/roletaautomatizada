<?php

require_once '../../../classes/config.php';

$table = 'roleta';
 
$primaryKey = 'id';

$columns = array(
    array('db' => 'id', 'dt' => 0, 'formatter' => function( $d, $row ){ return '<a href="playtech/roleta?id='.$d.'"><i class="fa fa-edit"></i></a>';  }),
    array('db' => 'nome', 'dt' => 1),
    array('db' => 'link', 'dt' => 2),
    array('db' => 'status', 'dt' => 3),
);

$sql_details = array('user' => USERNAME, 'pass' => PASSWORD, 'db' => DATABASE, 'host' => 'localhost');
 
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, "id < 31 AND usuario = 0"));
?>