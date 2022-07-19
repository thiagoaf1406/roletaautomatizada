<?php
header("Access-Control-Allow-Origin: *");
include '../classes/config.php';
$presente = date("Y-m-d H:i:s");
$minutos = "- 9 minutes";
$strto = strtotime($presente . $minutos);
$passado = date('Y-m-d H:i:s', $strto);

$usuarios = Usuario::find(0, array("playtech = 'Sim'"));
if(count($usuarios) >=1){
    $usuario = $usuarios[0];
    $usuario_id = $usuario->id;
    $entradas = Entrada::find(0, array("confirmada = 's' AND status = '' AND usuario = '".$usuario_id."'"), 'id DESC');
    foreach($entradas as $entrada){
        if($entrada->data_cadastro < $passado){
            $e = Entrada::find($entrada->id);
            $e->confirmada = 'n';
            $e->status = 'n';
            $e->save();
            deleteMessage($entrada->id);
        } else {
            $estrategias = Estrategia::find(0, array("numero = '".$entrada->estrategia."' AND usuario = '".$entrada->usuario."'"));
            $estrategia = $estrategias[0];
            $paginate = $estrategia->gales+1;
            $numeros = array();
            $red = 0;
            $resultados = Resultado::paginate(0, $paginate, "resultado_id > '".$entrada->confirmado_id."' AND roleta_id = '".$entrada->roleta_id."'", "resultado_id ASC");
            if(count($resultados) >= 1){
                foreach($resultados as $resultado){
                    if($resultado->cor == 'G' && $estrategia->zero == 'Sim'){
                        array_push($numeros, $resultado->numero);
                        marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                        break;
                    } elseif($resultado->cor == 'G' && $estrategia->zero == 'Não'){
                        array_push($numeros, $resultado->numero);
                        $red++;
                    } else {    
                        if($estrategia->numero == 1 || $estrategia->numero == 11){  
                            if($resultado->cor == 'R'){
                                array_push($numeros, $resultado->numero);
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            }
                        }// Vermelhos
                        if($estrategia->numero == 2 || $estrategia->numero == 10){  
                            if($resultado->cor == 'B'){
                                array_push($numeros, $resultado->numero);
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            }
                        } // Pretos
                        if($estrategia->numero == 3 || $estrategia->numero == 13){
                            $array = array(1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35);
                            if(in_array($resultado->numero, $array)){
                                array_push($numeros, $resultado->numero);
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            }
                           
                        } // Ímpares
                        if($estrategia->numero == 4 || $estrategia->numero == 12){
                            $array = array(2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36);
                            if(in_array($resultado->numero, $array)){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            }
                        } // Pares
                        if($estrategia->numero == 5 || $estrategia->numero == 15){
                            if($resultado->parte == 'A'){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            }
                        } // Altos
                        if($estrategia->numero == 6 || $estrategia->numero == 14){
                            if($resultado->parte == 'B'){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            }
                        } // Baixos
                        if($estrategia->numero == 7){
                            $array = array(2,3,5,6,8,9,11,12,14,15,17,18,20,21,23,24,26,27,29,30,32,33,35,36);
                            if(in_array($resultado->numero, $array)){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            } 
                        } // 2ª & 3ª Colunas
                        if($estrategia->numero == 8){
                            $array = array(1,3,4,6,7,9,10,12,13,15,16,18,19,21,22,24,25,27,28,30,31,33,34,36);
                            if(in_array($resultado->numero, $array)){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            } 
                            
                        } // 1ª & 3ª Colunas
                        if($estrategia->numero == 9){
                            $array = array(1,2,4,5,7,8,10,11,13,14,16,17,19,20,22,23,25,26,28,29,31,32,34,35);
                            if(in_array($resultado->numero, $array)){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            } 
                        } // 1ª & 2ª Colunas
                        if($estrategia->numero == 16 || $estrategia->numero == 28){
                            $array = array(1,4,7,10,13,16,19,22,25,28,31,34);
                            if(in_array($resultado->numero, $array)){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            } 
                        } // Primeira Coluna
                        if($estrategia->numero == 17 || $estrategia->numero == 29){
                            $array = array(2,5,8,11,14,17,20,23,26,29,32,35);
                            if(in_array($resultado->numero, $array)){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            } 
                        } // Segunda Coluna
                        if($estrategia->numero == 18 || $estrategia->numero == 30){
                            $array = array(3,6,9,12,15,18,21,24,27,30,33,36);
                            if(in_array($resultado->numero, $array)){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            }  
                        } // Terceira Coluna
                        if($estrategia->numero == 19 || $estrategia->numero == 31){
                            $array = array(1,2,3,4,5,6,7,8,9,10,11,12);
                            if(in_array($resultado->numero, $array)){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            } 
                        } // Primeira Dúzia
                        if($estrategia->numero == 20 || $estrategia->numero == 32){
                            $array = array(13,14,15,16,17,18,19,20,21,22,23,24);
                            if(in_array($resultado->numero, $array)){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            }  
                        } // Segundaa Dúzia
                        if($estrategia->numero == 21 || $estrategia->numero == 33){
                            $array = array(25,26,27,28,29,30,31,32,33,34,35,36);
                            if(in_array($resultado->numero, $array)){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            } 
                        } // Terceira Dúzia
                        if($estrategia->numero == 22){
                            $array = array(13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36);
                            if(in_array($resultado->numero, $array)){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            }  
                        } // Segunda e Terceira Dúzia
                        if($estrategia->numero == 23){
                            $array = array(1,2,3,4,5,6,7,8,9,10,11,12,25,26,27,28,29,30,31,32,33,34,35,36);
                            if(in_array($resultado->numero, $array)){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            } 
                        } // Primeira e Terceira Dúzia
                        if($estrategia->numero == 24){
                            $array = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24);
                            if(in_array($resultado->numero, $array)){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            } 
                        } // Primeira e Segunda Dúzia
                        if($estrategia->numero == 25){
                            $ultimoNumero = Resultado::find(0, array("resultado_id = '".$entrada->confirmado_id."'"));
                            if($ultimoNumero[0]->cor == 'R'){
                                if($resultado->cor == 'B'){
                                    array_push($numeros, $resultado->numero); 
                                    marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                    break;
                                } else {
                                    array_push($numeros, $resultado->numero);
                                    $red++;
                                } 
                            }
                            if($ultimoNumero[0]->cor == 'B'){
                                if($resultado->cor == 'R'){
                                    array_push($numeros, $resultado->numero); 
                                    marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                    break;
                                } else {
                                    array_push($numeros, $resultado->numero);
                                    $red++;
                                } 
                            }
                        } // Alternância Pretos/Vermelhos
                        if($estrategia->numero == 26){
                            $ultimoNumero = Resultado::find(0, array("resultado_id = '".$entrada->confirmado_id."'"));
                            if($ultimoNumero[0]->parte == 'B'){
                                if($resultado->parte == 'A'){
                                    array_push($numeros, $resultado->numero); 
                                    marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                    break;
                                } else {
                                    array_push($numeros, $resultado->numero);
                                    $red++;
                                } 
                            }
                            if($ultimoNumero[0]->cor == 'A'){
                                if($resultado->parte == 'B'){
                                    array_push($numeros, $resultado->numero); 
                                    marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                    break;
                                } else {
                                    array_push($numeros, $resultado->numero);
                                    $red++;
                                } 
                            }
                        } // Alternância Altos/Baixos
                        if($estrategia->numero == 27){
                            $ultimoNumero = Resultado::find(0, array("resultado_id = '".$entrada->confirmado_id."'"));
                            $pares = array(2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36);
                            $impares = array(1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35);
                            if(in_array($ultimoNumero[0]->numero, $pares)){
                                if(in_array($resultado->numero, $impares)){
                                    array_push($numeros, $resultado->numero); 
                                    marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                    break;
                                } else {
                                    array_push($numeros, $resultado->numero);
                                    $red++;
                                } 
                            }
                            if(in_array($ultimoNumero[0]->numero, $impares)){
                                if(in_array($resultado->numero, $pares)){
                                    array_push($numeros, $resultado->numero); 
                                    marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                    break;
                                } else {
                                    array_push($numeros, $resultado->numero);
                                    $red++;
                                }  
                            }
                        } // Alternância Pares/Ímpares
                        if($estrategia->numero == 34){  
                            if($resultado->numero == $estrategia->casa){
                                array_push($numeros, $resultado->numero); 
                                marcaGreen($resultado->resultado_id, $resultado->numero, $entrada->id, $numeros);
                                break;
                            } else {
                                array_push($numeros, $resultado->numero);
                                $red++;
                            } 
                        }// Vermelhos
                    }
                    if($red >= $paginate){
                        marcaRed($entrada->id, $numeros);
                        break;
                    }
                }
            } 
        }
    }
}

function marcaGreen($resultado_id, $numero, $entrada_id, $numeros){
    $e = Entrada::find($entrada_id);
    $e->status = 'g';
    $e->green_id = $resultado_id;
    $e->save();
    $numeros = array_reverse($numeros);
    $array = implode(" | ", $numeros);
    enviaSinalGreen($entrada_id, $array);
    $data['mensagem'] = 'Enviado sinal GREEN';
}
function marcaRed($entrada_id, $numeros){
    $e = Entrada::find($entrada_id);
    $e->status = 'r';
    $e->save();
    $numeros = array_reverse($numeros);
    $array = implode(" | ", $numeros);
    enviaSinalRed($entrada_id, $array);
    $data['mensagem'] = 'Enviado sinal RED';
}

function enviaSinalRed($id, $numeros){
    $entrada = Entrada::find($id);
    $roletas = Roleta::find(0, array("id = '".$entrada->roleta_id."'"));
    $msg = Mensagem::find(0, array("usuario = '".$entrada->usuario."'"));
    $mensagens = $msg[0];
    $mensagem = $mensagens->red;
    $mensagem = str_replace("{{numeros}}", $numeros, $mensagem);
    $EntradaGrupo = EntradaGrupo::find(0, array("entrada = '".$id."' AND tipo = 'confirma'"));
    foreach($EntradaGrupo as $eg){
        sendMessage($eg->grupo, $mensagem, $entrada->id, $eg->msg_id, $mensagens->marcacao);
    }
    $data['mensagem'] .= 'deu Red <br>';
}

function enviaSinalGreen($id, $numeros){
    
    $entrada = Entrada::find($id);
    $msg = Mensagem::find(0, array("usuario = '".$entrada->usuario."'"));
    $mensagens = $msg[0];
    $mensagem = $mensagens->green;
    $mensagem = str_replace("{{numeros}}", $numeros, $mensagem);
    $EntradaGrupo = EntradaGrupo::find(0, array("entrada = '".$id."' AND tipo = 'confirma'"));
    foreach($EntradaGrupo as $eg){
        sendMessage($eg->grupo, $mensagem, $entrada->id, $eg->msg_id, $mensagens->marcacao);
    }
    $data['mensagem'] .= 'deu Green <br>';
}

function sendMessage($chatID, $mensagem, $id, $msg_id, $marcacao){
    $robo = Sistema::find(1);
    $entrada = Entrada::find($id);
    if($marcacao == 'Responder'){
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
          CURLOPT_POSTFIELDS => array('chat_id' => $chatID, 'text' => $mensagem, 'reply_to_message_id' => $msg_id, 'parse_mode' => 'HTML', 'disable_web_page_preview' => true),
        ));
    } else {
        $entradaGrupo = EntradaGrupo::find(0, array("entrada = '".$id."' AND msg_id = '".$msg_id."'"));
        if(count($entradaGrupo) >=1){
            if(!empty($entradaGrupo[0]->msg_texto)){
                $texto = $entradaGrupo[0]->msg_texto;
                $texto .= PHP_EOL;
                $texto .= $mensagem; 
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://api.telegram.org/bot".$robo->token."/editMessageText",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => array('chat_id' => $chatID, 'message_id' => $msg_id, 'text' => $texto, 'parse_mode' => 'HTML', 'disable_web_page_preview' => true),
                ));
            } else {
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
                  CURLOPT_POSTFIELDS => array('chat_id' => $chatID, 'text' => $mensagem, 'reply_to_message_id' => $msg_id, 'parse_mode' => 'HTML', 'disable_web_page_preview' => true),
                ));
            }
        }
    }
    $response = curl_exec($curl);
    curl_close($curl);
    $resposta = json_decode($response);
}


function deleteMessage($id){
    $robo = Sistema::find(1);
    
    $entradaGrupo = EntradaGrupo::find(0, array("entrada = '".$id."'"));
    if(count($entradaGrupo) >=1){
        foreach($entradaGrupo as $eG){
            
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
              CURLOPT_POSTFIELDS => array('chat_id' => $eG->grupo, 'message_id' => $eG->msg_id),
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            print_r($response);
        }
    }
}
echo json_encode($data);
?>
