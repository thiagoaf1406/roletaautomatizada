<?php
$entradas = Entrada::find(0, array("confirmada = '' AND status = '' AND usuario = '".$usuario_id."'"));
foreach($entradas as $entrada){
    if($entrada->data_cadastro < $passado){
        $e = Entrada::find($entrada->id);
        $e->confirmada = 'n'; 
        $e->status = 'n';
        $e->save();
        deleteMessage($entrada->id);
    } else {
        $estrategias = Estrategia::find(0, array("numero = '".$entrada->estrategia."' AND usuario = '".$usuario_id."'"));
        $estrategia = $estrategias[0];
        $analisa = intval($estrategia->analisa);
        $confirma = intval($estrategia->confirma);
        $paginate = $confirma - $analisa;
        $resultados = Resultado::paginate(0, $paginate, "resultado_id > '".$entrada->analisado_id."' AND roleta_id = '".$entrada->roleta_id."'", "resultado_id ASC");
        if(count($resultados) >0){
            if(count($resultados) <= $paginate){
                $data['mensagem'] .= 'Entrada => '.$entrada->id.' | Roleta => '.$entrada->roleta_id.' | Estratégia => '.$entrada->estrategia.'<br>';
                $pares = array(2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36);
                $impares = array(1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35);
                $primeira_coluna = array(1,4,7,10,13,16,19,22,25,28,31,34);
                $segunda_coluna = array(2,5,8,11,14,17,20,23,26,29,32,35);
                $terceira_coluna = array(3,6,9,12,15,18,21,24,27,30,33,36);
                $primeira_duzia = array(1,2,3,4,5,6,7,8,9,10,11,12);
                $segunda_duzia = array(13,14,15,16,17,18,19,20,21,22,23,24);
                $terceira_duzia = array(25,26,27,28,29,30,31,32,33,34,35,36);
                $contagem = 0;
                
                if($entrada->estrategia == 1 || $entrada->estrategia == 10){
                    foreach($resultados as $resultado){ if($resultado->cor == 'B'){ $contagem++; } }
                }
                if($entrada->estrategia == 2 || $entrada->estrategia == 11){
                    foreach($resultados as $resultado){ if($resultado->cor == 'R'){ $contagem++; } }
                }
                if($entrada->estrategia == 3 || $entrada->estrategia == 12){
                    foreach($resultados as $resultado){ if(in_array($resultado->numero, $pares)){ $contagem++; } }
                }
                if($entrada->estrategia == 4 || $entrada->estrategia == 13){
                    foreach($resultados as $resultado){ if(in_array($resultado->numero, $impares)){ $contagem++; } }
                }
                if($entrada->estrategia == 5 || $entrada->estrategia == 14){
                    foreach($resultados as $resultado){ if($resultado->parte == 'B'){ $contagem++; } }
                }
                if($entrada->estrategia == 6 || $entrada->estrategia == 15){
                    foreach($resultados as $resultado){ if($resultado->parte == 'A'){ $contagem++; } }
                }
                if($entrada->estrategia == 7 || $entrada->estrategia == 16){
                    foreach($resultados as $resultado){ if(in_array($resultado->numero, $primeira_coluna)){ $contagem++; } }
                }
                if($entrada->estrategia == 8 || $entrada->estrategia == 17){
                    foreach($resultados as $resultado){ if(in_array($resultado->numero, $segunda_coluna)){ $contagem++; } }
                }
                if($entrada->estrategia == 9 || $entrada->estrategia == 18){
                    foreach($resultados as $resultado){ if(in_array($resultado->numero, $terceira_coluna)){ $contagem++; } }
                }
                if($entrada->estrategia == 19 || $entrada->estrategia == 22){
                    foreach($resultados as $resultado){ if(in_array($resultado->numero, $primeira_duzia)){ $contagem++; } }
                }
                if($entrada->estrategia == 20 || $entrada->estrategia == 23){
                    foreach($resultados as $resultado){ if(in_array($resultado->numero, $segunda_duzia)){ $contagem++; } }
                }
                if($entrada->estrategia == 21 || $entrada->estrategia == 24){
                    foreach($resultados as $resultado){ if(in_array($resultado->numero, $terceira_duzia)){ $contagem++; } }
                }
                if($entrada->estrategia == 25){
                    $analisados = Resultado::find(0, array("resultado_id = '".$entrada->analisado_id."'"));
                    $analisado = $analisados[0];
                    $cor = $analisado->cor;
                    foreach($resultados as $resultado){
                        if($resultado->cor != $cor && $cor != 'G'){
                            $cor = $resultado->cor;
                            $contagem++; 
                        } 
                    }
                }
                if($entrada->estrategia == 26){
                    $analisados = Resultado::find(0, array("resultado_id = '".$entrada->analisado_id."'"));
                    $analisado = $analisados[0];
                    $parte = $analisado->parte;
                    foreach($resultados as $resultado){
                        if($resultado->parte != $parte && $resultado->parte != 'Z'){
                            $parte = $resultado->parte;
                            $contagem++; 
                        } 
                    }
                }
                if($entrada->estrategia == 27){
                    $analisados = Resultado::find(0, array("resultado_id = '".$entrada->analisado_id."'"));
                    $analisado = $analisados[0];
                    if(in_array($analisado->numero, $pares)){
                        $parte = 'P';
                    }elseif(in_array($analisado->numero, $impares)){
                        $parte = 'I';
                    } else {
                        $parte = 'Z';
                    }
                    foreach($resultados as $resultado){
                        if($parte == 'I' && in_array($resultado->numero, $pares)){
                            $parte = 'P';
                            $contagem++; 
                        } elseif($parte == 'P' && in_array($resultado->numero, $impares)){
                            $parte = 'I';
                            $contagem++; 
                        } 
                    }
                }
                if($entrada->estrategia == 28){
                    foreach($resultados as $resultado){ if(!in_array($resultado->numero, $primeira_coluna)){ $contagem++; } }
                }
                if($entrada->estrategia == 29){
                    foreach($resultados as $resultado){ if(!in_array($resultado->numero, $segunda_coluna)){ $contagem++; } }
                }
                if($entrada->estrategia == 30){
                    foreach($resultados as $resultado){ if(!in_array($resultado->numero, $terceira_coluna)){ $contagem++; } }
                }
                if($entrada->estrategia == 31){
                    foreach($resultados as $resultado){ if(!in_array($resultado->numero, $primeira_duzia)){ $contagem++; } }
                }
                if($entrada->estrategia == 32){
                    foreach($resultados as $resultado){ if(!in_array($resultado->numero, $segunda_duzia)){ $contagem++; } }
                }
                if($entrada->estrategia == 33){
                    foreach($resultados as $resultado){ if(!in_array($resultado->numero, $terceira_duzia)){ $contagem++; } }
                }
                if($entrada->estrategia == 34){
                    foreach($resultados as $resultado){ if($resultado->numero != $estrategia->casa){ $contagem++; } }
                }
                if($contagem == 0){
                    $e = Entrada::find($entrada->id);
                    $e->confirmada = 'n'; 
                    $e->status = 'n';
                    $e->save();
                    deleteMessage($entrada->id);
                    
                } elseif($contagem == $paginate){
                    
                    $numeros = Resultado::paginate(0, $estrategia->confirma, "resultado_id <= '".$resultados[0]->resultado_id."' AND roleta_id = '".$entrada->roleta_id."'", "resultado_id DESC");
                    if(count($numeros)  >=1){
                        $countNumeros = count($numeros)-1;
                        for($ns = 0; $ns <= $countNumeros; $ns++){
                            if($ns < $countNumeros){
                                $numero .= $numeros[$ns]->numero.', ';
                            } else {
                                $numero .= $numeros[$ns]->numero;
                            }
                        }
                    } else {
                        $numero = '';
                    }
                    $e = Entrada::find($entrada->id);
                    $e->confirmada = 's';
                    $e->confirmado_id = $resultados[0]->resultado_id;
                    $e->save();
                    enviaSinal($entrada->id, $numero);
                }
            } else {
                $e = Entrada::find($entrada->id);
                $e->confirmada = 'n'; 
                $e->status = 'n';
                $e->save();
                deleteMessage($entrada->id);
            }
        }
    }
}


function enviaSinal($id, $sequencia){
    $data['mensagem'] .= 'Enviando sinal <br>';
    $entrada = Entrada::find($id);
    $roletas = Roleta::find(0, array("numero = '".$entrada->roleta_id."' AND usuario = '".$entrada->usuario."'"));
    $estrategias = Estrategia::find(0, array("numero = '".$entrada->estrategia."' AND usuario = '".$entrada->usuario."'"));
    $estrategia = $estrategias[0];
    $msg = Mensagem::find(0, array("usuario = '".$entrada->usuario."'"));
    $mensagens = $msg[0];
    $mensagem = $mensagens->confirma;
    if(empty($roletas[0]->link)){
        $mensagem = str_replace("{{roleta}}", $roletas[0]->nome, $mensagem);
    } else {
        $mensagem = str_replace("{{roleta}}", '<b><a href="'.$roletas[0]->link.'">'.$roletas[0]->nome.'</a></b>', $mensagem);
    }
    $mensagem = str_replace("{{sequencia}}", $sequencia, $mensagem);
    $mensagem = str_replace("{{cassino}}", '<b><a href="https://casino.bet365.com/Play/LiveRoulette">Bet365</a></b>', $mensagem);
    
    $mensagem = str_replace("{{zero}}", $mensagens->zero, $mensagem);

    $mensagem = str_replace("{{instrucaoGales}}", $mensagens->gales, $mensagem);
    $mensagem = str_replace("{{gales}}", $estrategia->gales, $mensagem);
    
    $mensagemEstrategia = $estrategia->nome;
    $mensagem = str_replace("{{estrategia}}", $mensagemEstrategia, $mensagem);
    $instrucao = '<b>'.$estrategia->apostar.'</b>';
    $mensagem = str_replace("{{instrucao}}", $instrucao, $mensagem);

    $EntradaGrupo = EntradaGrupo::find(0, array("entrada = '".$id."' AND tipo = 'analisa'"));
    foreach($EntradaGrupo as $eg){
        sendMessage($eg->grupo, $mensagem, $entrada->id, $eg->msg_id);
    }
}


function sendMessage($chatID, $mensagem, $id, $msg_id){
    $robo = Sistema::find(1);
    $entrada = Entrada::find($id);
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
      CURLOPT_POSTFIELDS => array('chat_id' => $chatID, 'text' => $mensagem, 'parse_mode' => 'HTML', 'disable_web_page_preview' => true),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $resposta = json_decode($response);
    $msg_id = $resposta->result->message_id;
    $entradaGrupo = new EntradaGrupo();
    $entradaGrupo->msg_id = $msg_id;
    $entradaGrupo->grupo = $chatID;
    $entradaGrupo->tipo = 'confirma';
    $entradaGrupo->entrada = $id;
    $entradaGrupo->msg_texto = $mensagem;
    $entradaGrupo->save();
    apagaMessage($entrada->id);
}

function apagaMessage($id){
    $robo = Sistema::find(1);
   
    $entradaGrupo = EntradaGrupo::find(0, array("entrada = '".$id."' AND tipo = 'analisa'"));
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