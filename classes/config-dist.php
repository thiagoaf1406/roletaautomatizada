<?php
@session_start();
ini_set("display_errors", 0);
date_default_timezone_set('America/Recife');

define('STATUS_SISTEMA','sim');
define('DELAY_SISTEMA','2');
define('REFRESH','10');
define('PAGINATE','2');

define('PAGINATE_PLAYTECH', 0);
define('PAGINATE_EVOLUTION', 0);
define('PAGINATE_PRAGMATIC', 0);

//define('AMBIENTE','sandbox');
define('AMBIENTE','produção');

define('TITULO','Cassino Roleta');

define('HOSTNAME','localhost');
define('DATABASE','fabiomelomktrole_db');
define('USERNAME','fabiomelomktrole_db');
define('PASSWORD','QP0@]*qh_[Qp');

define('HOSTNAMESEVEN','162.240.59.30');
define('DATABASESEVEN','sev3ncom_bet365');
define('USERNAMESEVEN','sev3ncom_bet365');
define('PASSWORDSEVEN','VM#j#5PHVLXm');

define('HOSTNAME_EVO','localhost');
define('DATABASE_EVO','realbots_evolution');
define('USERNAME_EVO','realbots_evolution');
define('PASSWORD_EVO','VM#j#5PHVLXm');

define('HOSTNAME_PRAG','localhost');
define('DATABASE_PRAG','realbots_pragmatic');
define('USERNAME_PRAG','realbots_pragmatic');
define('PASSWORD_PRAG','VM#j#5PHVLXm');

define('DASHBOARD','https://'.$_SERVER['HTTP_HOST'].'/dashboard/'); // URL do Painel do Usuário do Sistema
define('ADMIN','https://'.$_SERVER['HTTP_HOST'].'/admin/'); // URL do Painel Admin do sistema
define('CMS','https://'.$_SERVER['HTTP_HOST'].'/admin/'); // URL do Painel Admin do sistema
define('URL','https://'.$_SERVER['HTTP_HOST'].'/'); // URL do Sistema

$root = dirname( $_SERVER["PHP_SELF"] ) == DIRECTORY_SEPARATOR ? "" : dirname( $_SERVER["PHP_SELF"] );
define( "ROOT", $root );

spl_autoload_register(function($class) {
	require_once dirname(__FILE__).'/'.$class.'.php';
});

function mask($val, $mask){
	$maskared = '';
	$k = 0;
	for($i = 0; $i<=strlen($mask)-1; $i++)
	{
		if($mask[$i] == '#')
		{
			if(isset($val[$k]))
				$maskared .= $val[$k++];
		}
		else
		{
			if(isset($mask[$i]))
				$maskared .= $mask[$i];
		}
	}
	return $maskared;
}

function str2Upper($value) {
	$original = "ªàáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ";
    $replacer = "ªÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß";
    $value = strtr( strtoupper($value), $original, $replacer );
    return $value;
}

function str2Lower($value) {
    $original = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß";
	$replacer = "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ";
    $value = strtr( strtolower($value), $original, $replacer );
    return $value;
}

function stripSpecial($value) {
    $original = "àáâãäçèéêëìíîïñòóôõö÷øùüúþÿ";
	$replacer = "aaaaaceeeeiiiinooooo-ouuuby";
    $value = strtr( strtolower($value), $original, $replacer );
    return $value;
}

function removerAcento($str){
    $from = 'ÀÁÃÂÉÊÍÓÕÔÚÜÇàáãâéêíóõôúüç';
    $to   = 'AAAAEEIOOOUUCaaaaeeiooouuc';
    return strtr($str, $from, $to);
}

function listaimagemRemoveAcentos($str, $enc = "UTF-8"){

	$acentos = array(
	'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
	'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
	'C' => '/&Ccedil;/',
	'c' => '/&ccedil;/',
	'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
	'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
	'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
	'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
	'N' => '/&Ntilde;/',
	'n' => '/&ntilde;/',
	'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
	'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
	'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
	'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
	'Y' => '/&Yacute;/',
	'y' => '/&yacute;|&yuml;/',
	'a.' => '/&ordf;/',
	'o.' => '/&ordm;/');

   	return preg_replace($acentos,
                       array_keys($acentos),
                       htmlentities($str,ENT_NOQUOTES, $enc));
}

function toURL($value) {
	$value = listaimagemRemoveAcentos($value, "UTF-8");
	$value = urlencode($value);
	$value = str_replace("+", "-", $value);
    return str2Lower($value);
}

function truncate($string, $qtd) {
	return substr($string, 0, $qtd);
}

function mes($digito=0) {

	$digito = $digito==0?date('n'):(int)$digito;
	
	$meses = array('',
	'Janeiro',
	'Fevereiro',
	'Março',
	'Abril',
	'Maio',
	'Junho',
	'Julho',
	'Agosto',
	'Setembro',
	'Outubro',
	'Novembro',
	'Dezembro'
	);
	return $meses[$digito];
}

function pegaMes($mes){
    switch($mes){
        case '1':
            return 'Jan';
            break;
        case '2':
            return 'Fev';
            break;
        case '3':
            return 'Mar';
            break;
        case '4':
            return 'Abr';
            break;
        case '5':
            return 'Mai';
            break;
        case '6':
            return 'Jun';
            break;
        case '7':
            return 'Jul';
            break;
        case '8':
            return 'Ago';
            break;
        case '9':
            return 'Set';
            break;
        case '10':
            return 'Out';
            break;
        case '11':
            return 'Nov';
            break;
        case '12':
            return 'Dez';
            break;
    }
}

function formataData($data){
    $d = date_create($data);
    $d = date_format($d, "d/m/Y");
    if($data == '0000-00-00 00:00:00'){
        return '';
    } else {
        return $d;
    }
}

function formataDataHora($data){
    $d = date_create($data);
    $d = date_format($d, "d/m/Y H:i:s");
    if($data == '0000-00-00 00:00:00'){
        return '';
    } else {
        return $d;
    }
}

function dia($digito=0) {
	$digito = $digito==0?date('N'):(int)$digito;
	$dias = array('',
	'Segunda-Feira',
	'Terça-Feira',
	'Quarta-Feira',
	'Quinta-Feira',
	'Sexta-Feira',
	'Sábado',
	'Domingo'
	);
	return $dias[$digito];
}

function limpaUrl($str){

	$str = strtolower(utf8_decode($str)); $i=1;
	$str = strtr($str, utf8_decode('àáâãäåæçèéêëìíîïñòóôõöøùúûýýÿ'), 'aaaaaaaceeeeiiiinoooooouuuyyy');
	$str = preg_replace("/([^a-z0-9])/",'-',utf8_encode($str));
	while($i>0) $str = str_replace('--','-',$str,$i);
	if (substr($str, -1) == '-') $str = substr($str, 0, -1);
	return $str;
}

function gerarBotoes($id, $form, $classe){
     
    $botoes  = '<div class="dropdown dropdown-animated scale-right">';
    $botoes  .= '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Ações</button>';
    $botoes  .= '<div class="dropdown-menu">';
    $botoes  .= '<form action="form_'.$form.'" method="post"><input type="hidden" id="id" name="id" value="'.$id.'"><button class="dropdown-item" type="submit"><i class="fa fa-edit"></i> Editar</button></form>';
    $botoes  .= '<button class="dropdown-item acao-excluir" type="button" data-id="'.$id.'" onclick="acaoArquivar(this)" data-classe="'.$classe.'"><i class="fa fa-trash"></i> Arquivar</button>';
    $botoes  .= '</div>';
    $botoes  .= '</div> ';
	
	return $botoes;
}
?>