<?php

$entradas = EntradaEvolution::paginate(0, 1, "usuario = '".$usuario_id."'", "id DESC");
if(count($entradas) == 0 OR count($entradas) > 0 && !empty($entradas[0]->confirmada) && !empty($entradas[0]->status)){
    $roletas = RoletaEvolution::paginate(0, 18, "status = 'On' AND usuario = '".$usuario_id."' AND numero != '".$entradas[0]->roleta_id."'", "RAND()");
    foreach($roletas as $rol){
        $roleta = $rol->numero;
        $bateu = 0;
        $resultados = ResultadoEvolution::paginate(0, 80, "roleta_id = '".$roleta."'", 'resultado_id DESC');
        $eestrategiaConfiguracao1 = EstrategiaEvolution::find(0, array("numero = '1' AND usuario = '".$usuario_id."'")); // Quebra de Sequência PRETOS ===========================
        $estrategiaConfiguracao1 = $eestrategiaConfiguracao1[0];
        if($estrategiaConfiguracao1->status == 'on'){
            echo '<br>Contando Sequência de PRETOS (1 - Quebra de Sequência PRETOS)';
            $i = 0;
            for($v = 0; $v < $estrategiaConfiguracao1->analisa; $v++){
                if($resultados[$v]->cor == 'B'){ 
                    echo '<br>'.$resultados[$v]->numero.' (Continua)';
                    $i++; 
                } else { 
                    echo '<br>'.$resultados[$v]->numero.'(Parou)';
                    break; 
                }
            }    
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao1->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                $data['salvando'] = "Here";
                if(salvaEntrada($resultados[0]->resultado_id, 1, $roleta, $usuario_id)){ 
                    exit; 
                } 
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }
        
        $eestrategiaConfiguracao2 = EstrategiaEvolution::find(0, array("numero = '2' AND usuario = '".$usuario_id."'")); // Quebra de Sequência VERMELHOS ===========================
        $estrategiaConfiguracao2 = $eestrategiaConfiguracao2[0];
        if($estrategiaConfiguracao2->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>VERMELHOS</b> (2 - Quebra de Sequência VERMELHOS)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            for($v = 0; $v < $estrategiaConfiguracao2->analisa; $v++){
                    if($resultados[$v]->cor == 'R'){ 
                        echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                        $i++; 
                    } else { 
                        echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                        break; 
                    }
                }    
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao2->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 2, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao3 = EstrategiaEvolution::find(0, array("numero = '3' AND usuario = '".$usuario_id."'")); // Quebra de Sequência de PARES ===========================
        $estrategiaConfiguracao3 = $eestrategiaConfiguracao3[0];
        if($estrategiaConfiguracao3->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>PARES</b> (3 - Quebra de Sequência PARES)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $pares = array(2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36);
            for($v = 0; $v < $estrategiaConfiguracao3->analisa; $v++){
                if(in_array($resultados[$v]->numero, $pares)){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao3->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 3, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao4 = EstrategiaEvolution::find(0, array("numero = '4' AND usuario = '".$usuario_id."'")); // Quebra de Sequência de ÍMPARES ===========================
        $estrategiaConfiguracao4 = $eestrategiaConfiguracao4[0];
        if($estrategiaConfiguracao4->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>ÍMPARES</b> (4 - Quebra de Sequência ÍMPARES)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $impares = array(1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35);
            for($v = 0; $v < $estrategiaConfiguracao4->analisa; $v++){
                if(in_array($resultados[$v]->numero, $impares)){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao4->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 4, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao5 = EstrategiaEvolution::find(0, array("numero = '5' AND usuario = '".$usuario_id."'")); // Quebra de Sequência de BAIXOS ===========================
        $estrategiaConfiguracao5 = $eestrategiaConfiguracao5[0];
        if($estrategiaConfiguracao5->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>BAIXOS</b> (5 - Quebra de Sequência BAIXOS)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            for($v = 0; $v < $estrategiaConfiguracao5->analisa; $v++){
                if($resultados[$v]->parte == 'B'){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao5->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 5, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao6 = EstrategiaEvolution::find(0, array("numero = '6' AND usuario = '".$usuario_id."'")); // Quebra de Sequência de ALTOS ===========================
        $estrategiaConfiguracao6 = $eestrategiaConfiguracao6[0];
        if($estrategiaConfiguracao6->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>ALTOS</b> (6 - Quebra de Sequência ALTOS)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            for($v = 0; $v < $estrategiaConfiguracao6->analisa; $v++){
                if($resultados[$v]->parte == 'A'){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao6->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 6, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao7 = EstrategiaEvolution::find(0, array("numero = '7' AND usuario = '".$usuario_id."'")); // Quebra de Sequência da 1ª Coluna ===========================
        $estrategiaConfiguracao7 = $eestrategiaConfiguracao7[0];
        if($estrategiaConfiguracao7->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>1ª Coluna</b> (7 - Quebra de Sequência da 1ª Coluna)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $array = array(1,4,7,10,13,16,19,22,25,28,31,34);
            for($v = 0; $v < $estrategiaConfiguracao7->analisa; $v++){
                $data['mensagem'] .= $resultados[$v]->numero.' ';
                if(in_array($resultados[$v]->numero, $array)){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao7->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 7, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao8 = EstrategiaEvolution::find(0, array("numero = '8' AND usuario = '".$usuario_id."'")); // Quebra de Sequência da 2ª Coluna ===========================
        $estrategiaConfiguracao8 = $eestrategiaConfiguracao8[0];
        if($estrategiaConfiguracao8->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>2ª Coluna</b> (8 - Quebra de Sequência da 2ª Coluna)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $array = array(2,5,8,11,14,17,20,23,26,29,32,35);
            for($v = 0; $v < $estrategiaConfiguracao8->analisa; $v++){
                if(in_array($resultados[$v]->numero, $array)){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao8->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 8, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao9 = EstrategiaEvolution::find(0, array("numero = '9' AND usuario = '".$usuario_id."'")); // Quebra de Sequência da 3ª Coluna ===========================
        $estrategiaConfiguracao9 = $eestrategiaConfiguracao9[0];
        if($estrategiaConfiguracao9->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>3ª Coluna</b> (9 - Quebra de Sequência da 3ª Coluna)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $array = array(3,6,9,12,15,18,21,24,27,30,33,36);
            //$resultados = ResultadoEvolution::paginate(0, $estrategiaConfiguracao9->analisa, "id = '".$roleta."'", 'resultado_id DESC');
            for($v = 0; $v < $estrategiaConfiguracao9->analisa; $v++){
                if(in_array($resultados[$v]->numero, $array)){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao9->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 9, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao10 = EstrategiaEvolution::find(0, array("numero = '10' AND usuario = '".$usuario_id."'")); // Repetição de Pretos ===========================
        $estrategiaConfiguracao10 = $eestrategiaConfiguracao10[0];
        if($estrategiaConfiguracao10->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>PRETOS</b> (10 - Repetição de PRETOS)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            for($v = 0; $v < $estrategiaConfiguracao10->analisa; $v++){
                if($resultados[$v]->cor == 'B'){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao10->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 10, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao11 = EstrategiaEvolution::find(0, array("numero = '11' AND usuario = '".$usuario_id."'")); // Repetição de VERMELHOS ===========================
        $estrategiaConfiguracao11 = $eestrategiaConfiguracao11[0];
        if($estrategiaConfiguracao11->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>VERMELHOS</b> (11 - Repetição de VERMELHOS)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            //$resultados = ResultadoEvolution::paginate(0, $estrategiaConfiguracao11->analisa, "id = '".$roleta."'", 'resultado_id DESC');
            for($v = 0; $v < $estrategiaConfiguracao11->analisa; $v++){
                if($resultados[$v]->cor == 'R'){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao11->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 11, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao12 = EstrategiaEvolution::find(0, array("numero = '12' AND usuario = '".$usuario_id."'")); // Repetição de PARES ===========================
        $estrategiaConfiguracao12 = $eestrategiaConfiguracao12[0];
        if($estrategiaConfiguracao12->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>PARES</b> (12 - Repetição de PARES)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            //$resultados = ResultadoEvolution::paginate(0, $estrategiaConfiguracao12->analisa, "id = '".$roleta."'", 'resultado_id DESC');
            for($v = 0; $v < $estrategiaConfiguracao12->analisa; $v++){
                $pares = array(2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36);
                if(in_array($resultados[$v]->numero, $pares)){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao12->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 12, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao13 = EstrategiaEvolution::find(0, array("numero = '13' AND usuario = '".$usuario_id."'")); // Repetição de ÍMPARES ===========================
        $estrategiaConfiguracao13 = $eestrategiaConfiguracao13[0];
        if($estrategiaConfiguracao13->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>ÍMPARES</b> (13 - Repetição de ÍMPARES)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            //$resultados = ResultadoEvolution::paginate(0, $estrategiaConfiguracao3->analisa, "id = '".$roleta."'", 'resultado_id DESC');
            for($v = 0; $v < $estrategiaConfiguracao13->analisa; $v++){
                $impares = array(1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35);
                if(in_array($resultados[$v]->numero, $impares)){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao13->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 13, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao14 = EstrategiaEvolution::find(0, array("numero = '14' AND usuario = '".$usuario_id."'")); // Repetição de BAIXOS ===========================
        $estrategiaConfiguracao14 = $eestrategiaConfiguracao14[0];
        if($estrategiaConfiguracao14->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>BAIXOS</b> (14 - Repetição de BAIXOS)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            //$resultados = ResultadoEvolution::paginate(0, $estrategiaConfiguracao3->analisa, "id = '".$roleta."'", 'resultado_id DESC');
            for($v = 0; $v < $estrategiaConfiguracao14->analisa; $v++){
                if($resultados[$v]->parte == 'B'){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao14->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 14, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao15 = EstrategiaEvolution::find(0, array("numero = '15' AND usuario = '".$usuario_id."'")); // Repetição de ALTOS ===========================
        $estrategiaConfiguracao15 = $eestrategiaConfiguracao15[0];
        if($estrategiaConfiguracao15->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>ALTOS</b> (15 - Repetição de ALTOS)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            //$resultados = ResultadoEvolution::paginate(0, $estrategiaConfiguracao3->analisa, "id = '".$roleta."'", 'resultado_id DESC');
            for($v = 0; $v < $estrategiaConfiguracao15->analisa; $v++){
                if($resultados[$v]->parte == 'A'){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao15->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 15, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao16 = EstrategiaEvolution::find(0, array("numero = '16' AND usuario = '".$usuario_id."'")); // Repetição da 1ª Coluna ===========================
        $estrategiaConfiguracao16 = $eestrategiaConfiguracao16[0];
        if($estrategiaConfiguracao16->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>1ª Coluna</b> (16 - Repetição de 1ª Coluna)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $array = array(1,4,7,10,13,16,19,22,25,28,31,34);
            //$resultados = ResultadoEvolution::paginate(0, $estrategiaConfiguracao16->analisa, "id = '".$roleta."'", 'resultado_id DESC');
            for($v = 0; $v < $estrategiaConfiguracao16->analisa; $v++){
                if(in_array($resultados[$v]->numero, $array)){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao16->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 16, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao17 = EstrategiaEvolution::find(0, array("numero = '17' AND usuario = '".$usuario_id."'")); // Repetição da 2ª Coluna ===========================
        $estrategiaConfiguracao17 = $eestrategiaConfiguracao17[0];
        if($estrategiaConfiguracao17->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>2ª Coluna</b> (17 - Repetição de 2ª Coluna)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $array = array(2,5,8,11,14,17,20,23,26,29,32,35);
            //$resultados = ResultadoEvolution::paginate(0, $estrategiaConfiguracao17->analisa, "id = '".$roleta."'", 'resultado_id DESC');
            for($v = 0; $v < $estrategiaConfiguracao17->analisa; $v++){
                if(in_array($resultados[$v]->numero, $array)){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao17->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 17, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao18 = EstrategiaEvolution::find(0, array("numero = '18' AND usuario = '".$usuario_id."'")); // Repetição da 3ª Coluna ===========================
        $estrategiaConfiguracao18 = $eestrategiaConfiguracao18[0];
        if($estrategiaConfiguracao18->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>3ª Coluna</b> (18 - Repetição 3ª Coluna)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $array = array(3,6,9,12,15,18,21,24,27,30,33,36);
            //$resultados = ResultadoEvolution::paginate(0, $estrategiaConfiguracao18->analisa, "id = '".$roleta."'", 'resultado_id DESC');
            for($v = 0; $v < $estrategiaConfiguracao18->analisa; $v++){
                if(in_array($resultados[$v]->numero, $array)){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao18->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 18, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }
        
        $eestrategiaConfiguracao19 = EstrategiaEvolution::find(0, array("numero = '19' AND usuario = '".$usuario_id."'")); // Repetição da DÚZIA BAIXA =========================== DÚZIA BAIXA
        $estrategiaConfiguracao19 = $eestrategiaConfiguracao19[0];
        if($estrategiaConfiguracao19->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>DÚZIA BAIXA</b> (19 - Repetição da DÚZIA BAIXA)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            for($v = 0; $v < $estrategiaConfiguracao19->analisa; $v++){
                $data['mensagem'] .= $resultado->numero.' ';
                if($resultados[$v]->numero >0 && $resultados[$v]->numero <= 12){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao19->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 19, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao20 = EstrategiaEvolution::find(0, array("numero = '20' AND usuario = '".$usuario_id."'")); // Repetição da DÚZIA MÉDIA =========================== DÚZIA MÉDIA
        $estrategiaConfiguracao20 = $eestrategiaConfiguracao20[0];
        if($estrategiaConfiguracao20->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>DÚZIA MÉDIA</b> (20 - Repetição da DÚZIA MÉDIA)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            for($v = 0; $v < $estrategiaConfiguracao20->analisa; $v++){
                if($resultados[$v]->numero >12 && $resultados[$v]->numero <= 24){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao20->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 20, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao21 = EstrategiaEvolution::find(0, array("numero = '21' AND usuario = '".$usuario_id."'")); // Repetição da DÚZIA ALTA =========================== DÚZIA ALTA
        $estrategiaConfiguracao21 = $eestrategiaConfiguracao21[0];
        if($estrategiaConfiguracao21->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>DÚZIA ALTA</b> (21 - Repetição da DÚZIA ALTA)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            for($v = 0; $v < $estrategiaConfiguracao21->analisa; $v++){
                if($resultados[$v]->numero >24 && $resultados[$v]->numero <= 36){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao21->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 21, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }
        
        $eestrategiaConfiguracao22 = EstrategiaEvolution::find(0, array("numero = '22' AND usuario = '".$usuario_id."'")); // Quebra de Sequência da DÚZIA BAIXA =========================== DÚZIA MÉDIA & DÚZIA ALTA
        $estrategiaConfiguracao22 = $eestrategiaConfiguracao22[0];
        if($estrategiaConfiguracao22->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>DÚZIA BAIXA</b> (22 - Quebra de Sequência da DÚZIA BAIXA)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            for($v = 0; $v < $estrategiaConfiguracao22->analisa; $v++){
                $data['mensagem'] .= $resultados[$v]->numero.' ';
                if($resultados[$v]->numero > 0 && $resultados[$v]->numero <= 12){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao22->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 22, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao23 = EstrategiaEvolution::find(0, array("numero = '23' AND usuario = '".$usuario_id."'")); // Quebra de Sequência da DÚZIA MÉDIA =========================== DÚZIA BAIXA & DÚZIA ALTA
        $estrategiaConfiguracao23 = $eestrategiaConfiguracao23[0];
        if($estrategiaConfiguracao23->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>DÚZIA MÉDIA</b> (23 - Quebra de Sequência da DÚZIA MÉDIA)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            for($v = 0; $v < $estrategiaConfiguracao23->analisa; $v++){
                if($resultados[$v]->numero >12 && $resultados[$v]->numero <= 24){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao23->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 23, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao24 = EstrategiaEvolution::find(0, array("numero = '24' AND usuario = '".$usuario_id."'")); //  Quebra de Sequência da DÚZIA ALTA =========================== DÚZIA BAIXA & DÚZIA MÉDIA
        $estrategiaConfiguracao24 = $eestrategiaConfiguracao24[0];
        if($estrategiaConfiguracao24->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>DÚZIA ALTA</b> (24 - Quebra de Sequência da DÚZIA ALTA)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $array = array(3,6,9,12,15,18,21,24,27,30,33,36);
            for($v = 0; $v < $estrategiaConfiguracao24->analisa; $v++){
                if($resultados[$v]->numero >24 && $resultado[$v]->numero <= 36){
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao24->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 24, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }
        
        $eestrategiaConfiguracao25 = EstrategiaEvolution::find(0, array("numero = '25' AND usuario = '".$usuario_id."'")); //  Alternância Pretos/Vermelhos =========================== DÚZIA BAIXA & DÚZIA MÉDIA
        $estrategiaConfiguracao25 = $eestrategiaConfiguracao25[0];
        if($estrategiaConfiguracao25->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Alternância <b>PRETOS/VERMELHOS</b> (25 - Contando Alternância <b>PRETOS/VERMELHOS</b>)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $cor = 'G';
            $totalAnalisa = $estrategiaConfiguracao25->analisa*2;
            for($v = 0; $v < $totalAnalisa; $v++){
                if($resultados[$v]->cor != $cor && $resultados[$v]->cor != 'G'){
                    $cor = $resultados[$v]->cor;
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $totalAnalisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 25, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }
        
        $eestrategiaConfiguracao26 = EstrategiaEvolution::find(0, array("numero = '26' AND usuario = '".$usuario_id."'")); //  Alternância Altos/baixos =========================== DÚZIA BAIXA & DÚZIA MÉDIA
        $estrategiaConfiguracao26 = $eestrategiaConfiguracao26[0];
        if($estrategiaConfiguracao26->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Alternância <b>ALTOS/BAIXOS</b> (26 - Contando Alternância <b>ALTOS/BAIXOS</b>)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $parte = 'Z';
            $totalAnalisa = $estrategiaConfiguracao26->analisa*2;
            for($v = 0; $v < $totalAnalisa; $v++){
                if($resultados[$v]->parte != $parte && $resultados[$v]->parte != 'Z'){
                    $parte = $resultados[$v]->parte;
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $totalAnalisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 26, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }
        
        $eestrategiaConfiguracao27 = EstrategiaEvolution::find(0, array("numero = '27' AND usuario = '".$usuario_id."'")); //  Alternância Altos/baixos =========================== DÚZIA BAIXA & DÚZIA MÉDIA
        $estrategiaConfiguracao27 = $eestrategiaConfiguracao27[0];
        if($estrategiaConfiguracao27->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Alternância <b>ALTOS/BAIXOS</b> (27 - Contando Alternância <b>ALTOS/BAIXOS</b>)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $parte = '';
            $pares = array(2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36);
            $impares = array(1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35);
            $totalAnalisa = $estrategiaConfiguracao27->analisa*2;
            for($v = 0; $v < $totalAnalisa; $v++){
                if($resultados[$v]->numero > 0){
                    if(in_array($resultados[$v]->numero, $impares) && $parte != 'I'){
                        $parte = 'I';
                        $i++;
                    } 
                    if(in_array($resultados[$v]->numero, $pares) && $parte != 'P'){
                        $parte = 'P';
                        $i++;
                    } 
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $totalAnalisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 27, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }
         
        $eestrategiaConfiguracao28 = EstrategiaEvolution::find(0, array("numero = '28' AND usuario = '".$usuario_id."'")); // Ausência da 1ª Coluna ===========================
        $estrategiaConfiguracao28 = $eestrategiaConfiguracao28[0];
        if($estrategiaConfiguracao28->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>2ª Coluna</b> (17 - Repetição de 2ª Coluna)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $array = array(1,4,7,10,13,16,19,22,25,28,31,34);
            for($v = 0; $v < $estrategiaConfiguracao28->analisa; $v++){
                if(in_array($resultados[$v]->numero, $array)){
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao28->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 28, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao29 = EstrategiaEvolution::find(0, array("numero = '29' AND usuario = '".$usuario_id."'")); // Ausência da 2ª Coluna ===========================
        $estrategiaConfiguracao29 = $eestrategiaConfiguracao29[0];
        if($estrategiaConfiguracao29->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Ausência de <b>2ª Coluna</b> (29 - Ausência de 2ª Coluna)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $array = array(2,5,8,11,14,17,20,23,26,29,32,35);
            for($v = 0; $v < $estrategiaConfiguracao29->analisa; $v++){
                if(in_array($resultados[$v]->numero, $array)){
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao29->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 29, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao30 = EstrategiaEvolution::find(0, array("numero = '30' AND usuario = '".$usuario_id."'")); // Ausência da 3ª Coluna ===========================
        $estrategiaConfiguracao30 = $eestrategiaConfiguracao30[0];
        if($estrategiaConfiguracao30->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>3ª Coluna</b> (30 - Repetição 3ª Coluna)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            $array = array(3,6,9,12,15,18,21,24,27,30,33,36);
            for($v = 0; $v < $estrategiaConfiguracao30->analisa; $v++){
                if(in_array($resultados[$v]->numero, $array)){
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao30->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 30, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }
        
        $eestrategiaConfiguracao31 = EstrategiaEvolution::find(0, array("numero = '31' AND usuario = '".$usuario_id."'")); // Ausência da DÚZIA BAIXA =========================== DÚZIA BAIXA
        $estrategiaConfiguracao31 = $eestrategiaConfiguracao31[0];
        if($estrategiaConfiguracao31->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>DÚZIA BAIXA</b> (31 - Repetição da DÚZIA BAIXA)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            for($v = 0; $v < $estrategiaConfiguracao31->analisa; $v++){
                $data['mensagem'] .= $resultados[$v]->numero.' ';
                if($resultados[$v]->numero >0 && $resultados[$v]->numero <= 12){
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao31->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 31, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao32 = EstrategiaEvolution::find(0, array("numero = '32' AND usuario = '".$usuario_id."'")); // Ausência da DÚZIA MÉDIA =========================== DÚZIA MÉDIA
        $estrategiaConfiguracao32 = $eestrategiaConfiguracao32[0];
        if($estrategiaConfiguracao32->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>DÚZIA MÉDIA</b> (32 - Repetição da DÚZIA MÉDIA)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            for($v = 0; $v < $estrategiaConfiguracao32->analisa; $v++){
                if($resultados[$v]->numero >12 && $resultados[$v]->numero <= 24){
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                    
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao32->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 32, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }

        $eestrategiaConfiguracao33 = EstrategiaEvolution::find(0, array("numero = '33' AND usuario = '".$usuario_id."'")); // Ausência da DÚZIA ALTA =========================== DÚZIA ALTA
        $estrategiaConfiguracao33 = $eestrategiaConfiguracao33[0];
        if($estrategiaConfiguracao33->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Sequência de <b>DÚZIA ALTA</b> (21 - Repetição da DÚZIA ALTA)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            for($v = 0; $v < $estrategiaConfiguracao33->analisa; $v++){
                if($resultados[$v]->numero >24 && $resultados[$v]->numero <= 36){
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                    
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao33->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 33, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }
        
        $eestrategiaConfiguracao34 = EstrategiaEvolution::find(0, array("numero = '34' AND usuario = '".$usuario_id."'")); // Ausência de Número =========================== Ausência de Número
        $estrategiaConfiguracao34 = $eestrategiaConfiguracao34[0];
        if($estrategiaConfiguracao34->status == 'on'){
            echo '<br><div class="col-md-12">';
            echo '<br><p>Contando Ausência de <b>NÚMERO</b> (34 - AUSÊNCIA DE NÚMERO)</p>';
            echo '<br><table class="table">';
            echo '<br><tr>';
            $i = 0;
            for($v = 0; $v < $estrategiaConfiguracao34->analisa; $v++){
                if($resultados[$v]->numero == $estrategiaConfiguracao34->casa){
                    echo '<br><td>'.$resultados[$v]->numero.'(Parou)</td>';
                    break; 
                } else { 
                    echo '<br><td>'.$resultados[$v]->numero.' (Continua)</td>';
                    $i++; 
                }
            }
            echo '<br></tr>';
            echo '<br></table>';
            if($i == $estrategiaConfiguracao34->analisa){
                echo '<br><p> <b>BATEU AQUI</b> </p>';
                if(salvaEntrada($resultados[0]->resultado_id, 34, $roleta, $usuario_id)){ 
                    exit; 
                    echo '<br><p> Salvou Entrada e enviou Sinal! </p>';
                }  else {
                    echo '<br><p> Deu algum erro! </p>';
                }
                $bateu++;
            } else {
                echo '<br><p> <b>AQUI NÃO BATEU!</b> </p>';
            }
            echo '<br></div>';
            echo '<br><hr>';
        }
        
        if($bateu >0){
            echo 'BATEU';
            break; 
        }
    }
}

function salvaEntrada($resultado, $estrategia_id, $roleta, $usuario_id){
    echo 'Salva entrada 1<br>';
    
    if($resultado > 0){
        echo 'Salva entrada 2<br>';
        $estrategias = EstrategiaEvolution::find(0, array("numero = '".$estrategia_id."' AND usuario = '".$usuario_id."'"));
        $estrategia = $estrategias[0];
        $confirma = $estrategia->confirma-1;
        $zeros = 0;
        if($estrategia->abortar == 'Sim'){
            $zs = ResultadoEvolution::paginate(0, $estrategia->analisa, "resultado_id <= '".$resultado."' AND roleta_id = '".$roleta."'", "resultado_id DESC");
            foreach($zs as $z){
                if($z->numero == 0){
                    $zeros++;
                }
            }
        }
        $numeros = ResultadoEvolution::paginate(0, 4, "resultado_id <= '".$resultado."' AND roleta_id = '".$roleta."'", "resultado_id DESC");
        if(count($numeros) >=1){
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
        if($estrategia->abortar == 'Sim' && $zero == 0){
            $entrada = new EntradaEvolution();
            $entrada->roleta_id = $roleta;
            $entrada->estrategia = $estrategia->numero;
            $entrada->usuario = $usuario_id;
            $entrada->analisado_id = $resultado;
            if($entrada->save()){
                if(enviaSinal($entrada->id, $usuario_id, $numero)){
                    echo '<br>Enviou Sinal <br>';
                    return true;
                } else {
                    echo '<br>Não Enviou Sinal <br>';
                    return false;
                }
            }
            print_r($entrada);
        }
        if($estrategia->abortar == 'Não'){
            $entrada = new EntradaEvolution();
            $entrada->roleta_id = $roleta;
            $entrada->estrategia = $estrategia->numero;
            $entrada->usuario = $usuario_id;
            $entrada->analisado_id = $resultado;
            if($entrada->save()){
                if(enviaSinal($entrada->id, $usuario_id, $numero)){
                    echo '<br>Enviou Sinal <br>';
                    return true;
                } else {
                    echo '<br>Não Enviou Sinal <br>';
                    return false;
                }
            }
            print_r($entrada);
        }
    }
}

function enviaSinal($id, $usuario_id, $numero){
    echo 'Here';
    $entrada = EntradaEvolution::find($id);
    $roletas = RoletaEvolution::find(0, array("numero = '".$entrada->roleta_id."' AND usuario = '".$usuario_id."'"));
    $estrategias = EstrategiaEvolution::find(0, array("numero = '".$entrada->estrategia."' AND usuario = '".$entrada->usuario."'"));
    $estrategia = $estrategias[0];
    $msg = MensagemEvolution::find(0, array("usuario = '".$usuario_id."'"));
    $mensagens = $msg[0];
    $mensagem = $mensagens->analisa;
    if(empty($roletas[0]->link)){
        $mensagem = str_replace("{{roleta}}", $roletas[0]->nome, $mensagem);
    } else {
        $mensagem = str_replace("{{roleta}}", '<b><a href="'.$roletas[0]->link.'">'.$roletas[0]->nome.'</a></b>', $mensagem);
    }
    $mensagem = str_replace("{{desktop}}", '<a href="'.$roletas[0]->link.'">Computador</a>', $mensagem);
    $mensagem = str_replace("{{mobile}}", '<a href="'.$roletas[0]->mobile.'">Celular</a>', $mensagem);
    $mensagemEstrategia = $estrategia->nome;
    $mensagem = str_replace("{{estrategia}}", $mensagemEstrategia, $mensagem);
    if(!empty($estrategia->observacao)){
        $mensagem = str_replace("{{observacao}}", $estrategia->observacao, $mensagem);
    }
    
    $mensagem = str_replace("{{sequencia}}", $numero, $mensagem);
    $grupos = Grupo::find(0, array("status = 'Ativo' AND usuario = '".$usuario_id."' AND evolution = 'Sim'"));
    foreach($grupos as $grupo){
        $hora = date("H:i:s");
        if($hora >= $grupo->horario_min && $hora <= $grupo->horario_max){
            $estrategiasGrupos = EstrategiasGruposEvolution::find(0, array("estrategia = '".$estrategia->id."' AND grupo = '".$grupo->id."' AND status = 'On'"));
            if(count($estrategiasGrupos) >=1){
                sendMessage($grupo->grupoID, $mensagem, $entrada->id);
            }
        }
    }
    return true;
}

function sendMessage($chatID, $mensagem, $id){
    $data['sendMessage'] = 'Here';
    $robo = Sistema::find(1);
    $curl = curl_init();
    $entrada = EntradaEvolution::find($id);
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
    $fp = fopen('logs/Log-'.$chatID.'.txt', 'a+');
    fwrite($fp, $response);
    fclose($fp);
    $msg_id = $resposta->result->message_id;
    $entradaGrupo = new EntradaGrupoEvolution();
    $entradaGrupo->msg_id = $msg_id;
    $entradaGrupo->tipo = 'analisa';
    $entradaGrupo->grupo = $chatID;
    $entradaGrupo->entrada = $id;
    $entradaGrupo->save();
}

function deleteMessage($id){
    $robo = Sistema::find(1);
    $entradaGrupo = EntradaGrupoEvolution::find(0, array("entrada = '".$id."'"));
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
        }
    }
}

echo json_encode($data);
?>