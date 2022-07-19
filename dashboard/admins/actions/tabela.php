<?php

require_once '../../../classes/config.php';

$table = 'admins';
 
$primaryKey = 'id';

$columns = array(
    array('db' => 'id', 'dt' => 0),
    array('db' => 'nome', 'dt' => 1),
    array('db' => 'email', 'dt' => 2),
    array('db' => 'chatID', 'dt' => 3),
    array('db' => 'telefone', 'dt' => 4),
    array('db' => 'id', 'dt' => 5, 'formatter' => function( $d, $row ){ return Admin::gerarBotoes($d); }),
);

$sql_details = array('user' => USERNAME, 'pass' => PASSWORD, 'db'   => DATABASE, 'host' => 'localhost');
 
echo json_encode(SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, "id >= 0"));