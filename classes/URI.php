<?php
class URI extends ActiveRecord {

public static function Protocolo(){
    
    $ht = explode("/", $_SERVER['SERVER_PROTOCOL']);
    
    if($ht[0] == 'HTTP'){
        $protocolo = 'http://'; //Atribui o valor http
    } else {
        $protocolo = 'https://'; //Atribui o valor https
    }
    return $protocolo;
}

public static function Host(){
    $host = $_SERVER['HTTP_HOST']; //Atribui o valor www.example.com.br

    return $host;
}

public static function scriptName(){
    $scr = dirname($_SERVER['SCRIPT_NAME']);
   
    if(!empty($scr) || substr_count($scr, '/') > 1){
       $scriptName = $scr . '/'; //atribui o valor do diretório com uma "/" na sequência
    }else{
        $scriptName = ''; //atribui um valor vazio
    }
   
    return $scriptName;
}

public static function base(){
    
    $finalBase = self::Protocolo() . self::Host() . self::scriptName();
   
    return $finalBase;
}
}
?>