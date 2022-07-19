<?php
require_once '../../classes/config.php';
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
mysqli_query($con, "SET NAMES 'utf8mb4'");

extract($_POST);

$update = "UPDATE `mensagens` SET `analisa` = '".$analisa."', `confirma` = '".$confirma."', `green` = '".$green."', `red` = '".$red."', `gales` = '".$gales."', `zero` = '".$zero."', `marcacao` = '".$marcacao."' WHERE `id` = '".$id."' AND `usuario` = '".$_SESSION['usuario_id']."'";
$query = mysqli_query($con, $update);

if($query){
    $data['sucesso'] = true;
} else {
    $data['sucesso'] = false;
}   

echo json_encode($data);