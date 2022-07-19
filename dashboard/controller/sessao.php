<?php
session_start();
if(!isset($_SESSION["usuario_id"])){
  session_destroy();
  echo '<script> location.href="'.DASHBOARD.'login"; </script>';
  exit;
} else { 
    $usuario = Usuario::find($_SESSION["usuario_id"]);
    $nome_explode = explode(" ", $usuario->nome);
    $nome = $nome_explode[0];
    $sobrenome = $nome_explode[1];
}
$sistema = Sistema::find(1);
?>