<?php
session_start();
if(!isset($_SESSION["admin_id"])){
  session_destroy();
  echo '<script> location.href="'.CMS.'login"; </script>';
  exit;
} else { 
    $usuario = Admin::find($_SESSION["admin_id"]);
    $super = $usuario->super;
    $nome_explode = explode(" ", $usuario->nome);
    $nome = $nome_explode[0];
    $sobrenome = $nome_explode[1];
}
$sistema = Sistema::find(1);
?>