<?php
header("Access-Control-Allow-Origin: *");
include '../classes/config.php';

$hoje = date("Y-m-d");
$presente = date("Y-m-d H:i:s");
$minutos = "- 4 minutes";
$strto = strtotime($presente . $minutos);
$passado = date('Y-m-d H:i:s', $strto);

$usuarios = Usuario::find(0, array("playtech = 'Sim'"));
if(count($usuarios) >=1){
    $usuario = $usuarios[0];
    $usuario_id = $usuario->id;
    include 'execConfirma.php';
}
?>