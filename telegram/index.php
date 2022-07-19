<?php
require '../classes/config.php';
require '../vendor/autoload.php';

use TelegramBot\Api\BotApi;
use Spatie\Emoji\Emoji;

$robo = Robo::find(1);
$grupo = Grupo::find(1);
//$nm = new BotApi($robo->token);
//$mensagem = 'Teste '.Emoji::fully-qualified();
//$nm->sendMessage($grupo->grupoID, $mensagem);
//print_r(Emoji::all());
$kick = new BotApi($robo->token);
$kick->kickChatMember('-1001566149991', '967142649');
