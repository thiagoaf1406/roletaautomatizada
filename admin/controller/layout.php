<?php
require_once '../../classes/config.php';
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
mysqli_query($con, "SET NAMES 'utf8mb4'");

extract($_POST);

$update = "UPDATE `mensagens` SET `analisa` = '".$analisa."', `confirma` = '".$confirma."', `green` = '".$green."', `red` = '".$red."' WHERE `id` = 1";
$query = mysqli_query($con, $update);

if($query){
    $data['sucesso'] = true;
} else {
    $data['sucesso'] = false;
}   

echo json_encode($data);