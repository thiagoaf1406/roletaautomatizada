<?php

class TelegramAPI extends ActiveRecord {

	public static function emoji($icone){

        $pattern = '@\\\x([0-9a-fA-F]{2})@x';
        $emoji = preg_replace_callback(
          $pattern,
          function ($captures) {
            return chr(hexdec($captures[1]));
          },
          $utf8Byte
        );
        return $emoji;
	}
	
	public static function sendMessage($chatID, $mensagem){
        $robo = Robo::find(1);
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.telegram.org/bot".$robo->token."/sendMessage",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => array('chat_id' => $chatID,'text' => $mensagem, 'parse_mode' => 'HTML'),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
    }
    
    public static function deleteMessage($chatID, $msg_id){
        $robo = Robo::find(1);
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.telegram.org/bot".$robo->token."/deleteMessage",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => array('chat_id' => $chatID,'message_id' => $msg_id),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
    }
    
    public static function unbanChatMember($chatID, $userID){
        $robo = Robo::find(1);
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.telegram.org/bot".$robo->token."/unbanChatMember",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => array('chat_id' => $chatID, 'user_id' => $userID, 'only_if_banned' => true),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    
    public static function createChatInviteLink($chatID){
        $robo = Robo::find(1);
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.telegram.org/bot".$robo->token."/createChatInviteLink",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => array('chat_id' => $chatID, 'member_limit' => 1, 'creates_join_request' => false),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public static function getChatMember($chatID, $userID){
        $robo = Robo::find(1);
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.telegram.org/bot".$robo->token."/getChatMember",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => array('chat_id' => $chatID, 'user_id' => $userID),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    
    public static function getChat($chatID){
        $robo = Robo::find(1);
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.telegram.org/bot".$robo->token."/getChat",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => array('chat_id' => $chatID),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    
    public static function setWebhook(){
        $robo = Robo::find(1);
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.telegram.org/bot".$robo->token."/setWebhook",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => array('url' => 'https://robomilionarioclube.com/telegram/webhook'),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;
    }
}
?>