<?
include '../classes/config.php';

$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
mysqli_query($con, "SET NAMES 'utf8mb4'");
$select = "SELECT * FROM `mensagens` WHERE `id` = 1";
$query = mysqli_query($con, $select);
$r = mysqli_fetch_array($query);
print $r['analisa'];
//$insert = "INSERT INTO `mensagens` (`id`, `analisa`, `confirma`, `red`, `green`, `usuario`) VALUES (NULL, '".$r[0]->analisa."', '".$r[0]->confirma."', '".$r[0]->red."', '".$r[0]->green."', '".$param->id."')";
//$query = mysqli_query($con, $insert);