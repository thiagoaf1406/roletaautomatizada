<?php
header("Access-Control-Allow-Origin: *");
include '../classes/config.php';

$data['hora'] = date("H:i:s");
$presente = date("Y-m-d H:i:s");
$minutos = "- 9 minutes";
$strto = strtotime($presente . $minutos);
$passado = date('Y-m-d H:i:s', $strto);

$usuarios = Usuario::find(0, array("pragmatic = 'Sim'"));
if(count($usuarios) >=1){
    $usuario = $usuarios[0];
    $usuario_id = $usuario->id;
    include 'execRoleta.php';
}
?>