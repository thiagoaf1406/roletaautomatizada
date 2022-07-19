<?php
require_once '../../classes/config.php';

$email = isset($_POST["email"]) ? addslashes(trim($_POST["email"])) : '';
$senha = isset($_POST["senha"]) ? base64_encode(addslashes(trim($_POST["senha"]))) : '';
$data['post'] = $_POST;
$usuarios = Admin::find(0, array("email = '".$email."' AND senha = '".$senha."'"));
$data['usuarios'] = count($usuarios);
if(count($usuarios) >= 1) {
	$usuario = $usuarios[0];
	session_start();
	$_SESSION["admin_id"] = $usuario->id;
	$_SESSION["admin_nome"] = $usuario->nome; 
	$data['sucesso'] = true;
} else {
    $data['sucesso'] = false;
}

echo json_encode($data);
?>