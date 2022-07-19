<?php
$hash = $_GET['hash'];
if($hash == '1234'){
require '../classes/config.php';
require '../vendor/autoload.php';

$setWebhook = TelegramAPI::setWebhook();

print_r($setWebhook);
}
