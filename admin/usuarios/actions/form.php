<?php
    include '../../../classes/config.php';
    include '../../controller/sessao.php';
    extract($_POST);

    if(empty($id)){
        $param = new Usuario();
    } else {
        $param = Usuario::find($id);
    }
    
    $param->fetch($_POST);
    if(empty($admin)){
        $param->admin = $_SESSION["admin_id"];
    }
    if($param->save()){
        if(empty($id)){
            $estrategias = Estrategia::find(0, array("usuario = 0"));
            if(count($estrategias) >=1){
                foreach($estrategias as $e){
                    $ee = new Estrategia();
                    $ee->numero = $e->numero;
                    $ee->nome = $e->nome;
                    $ee->status = $e->status;
                    $ee->usuario = $param->id;
                    $ee->analisa = $e->analisa;
                    $ee->observacao = $e->observacao;
                    $ee->confirma = $e->confirma;
                    $ee->apostar = $e->apostar;
                    $ee->abortar = $e->abortar;
                    $ee->gales = $e->gales;
                    $ee->zero = $e->zero;
                    $ee->casa = $e->casa;
                    $ee->save();
                }
            }
            $roletas = Roleta::find(0, array("usuario = 0"));
            if(count($roletas) >=1){
                foreach($roletas as $e){
                    $ee = new Roleta();
                    $ee->numero = $e->numero;
                    $ee->nome = $e->nome;
                    $ee->status = $e->status;
                    $ee->usuario = $param->id;
                    $ee->link = $e->link;
                    $ee->save();
                }
            }
            
            $estrategias = EstrategiaEvolution::find(0, array("usuario = 0"));
            if(count($estrategias) >=1){
                foreach($estrategias as $e){
                    $ee = new EstrategiaEvolution();
                    $ee->numero = $e->numero;
                    $ee->nome = $e->nome;
                    $ee->status = $e->status;
                    $ee->usuario = $param->id;
                    $ee->analisa = $e->analisa;
                    $ee->observacao = $e->observacao;
                    $ee->confirma = $e->confirma;
                    $ee->apostar = $e->apostar;
                    $ee->casa = $e->casa;
                    $ee->gales = $e->gales;
                    $ee->abortar = $e->abortar;
                    $ee->zero = $e->zero;
                    $ee->save();
                }
            }
            $roletas = RoletaEvolution::find(0, array("usuario = 0"));
            if(count($roletas) >=1){
                foreach($roletas as $e){
                    $ee = new RoletaEvolution();
                    $ee->numero = $e->numero;
                    $ee->nome = $e->nome;
                    $ee->status = $e->status;
                    $ee->usuario = $param->id;
                    $ee->link = $e->link;
                    $ee->save();
                }
            }
            $estrategias = EstrategiaPragmatic::find(0, array("usuario = 0"));
            if(count($estrategias) >=1){
                foreach($estrategias as $e){
                    $ee = new EstrategiaPragmatic();
                    $ee->numero = $e->numero;
                    $ee->nome = $e->nome;
                    $ee->status = $e->status;
                    $ee->usuario = $param->id;
                    $ee->analisa = $e->analisa;
                    $ee->observacao = $e->observacao;
                    $ee->confirma = $e->confirma;
                    $ee->apostar = $e->apostar;
                    $ee->casa = $e->casa;
                    $ee->gales = $e->gales;
                    $ee->abortar = $e->abortar;
                    $ee->zero = $e->zero;
                    $ee->save();
                }
            }
            $roletas = RoletaPragmatic::find(0, array("usuario = 0"));
            if(count($roletas) >=1){
                foreach($roletas as $e){
                    $ee = new RoletaPragmatic();
                    $ee->numero = $e->numero;
                    $ee->nome = $e->nome;
                    $ee->status = $e->status;
                    $ee->usuario = $param->id;
                    $ee->link = $e->link;
                    $ee->save();
                }
            }
            
            $entrada = new Entrada();
            $entrada->usuario = $param->id;;
            $entrada->confirmada = 'n';
            $entrada->status = 'n';
            $entrada->save();
            
            $entradaEvolution = new EntradaEvolution();
            $entradaEvolution->usuario = $param->id;;
            $entradaEvolution->confirmada = 'n';
            $entradaEvolution->status = 'n';
            $entradaEvolution->save();
            
            $entradaPragmatic = new EntradaPragmatic();
            $entradaPragmatic->usuario = $param->id;;
            $entradaPragmatic->confirmada = 'n';
            $entradaPragmatic->status = 'n';
            $entradaPragmatic->save();
            
            $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
            mysqli_query($con, "SET NAMES 'utf8mb4'");

            $selectPlaytech = "SELECT * FROM `mensagens` WHERE `id` = 1";
            $queryPlaytech = mysqli_query($con, $selectPlaytech);
            $r = mysqli_fetch_array($queryPlaytech);
            $insertPlaytech = "INSERT INTO `mensagens` (`id`, `analisa`, `confirma`, `red`, `green`, `usuario`, `marcacao`, `gales`, `zero`) 
            VALUES (NULL, '".$r['analisa']."', '".$r['confirma']."', '".$r['red']."', '".$r['green']."', '".$param->id."', '".$r['marcacao']."', '".$r['gales']."', '".$r['zero']."')";
            $queryPlaytech = mysqli_query($con, $insertPlaytech);
            
            $selectEvolution = "SELECT * FROM `mensagensEvolution` WHERE `id` = 1";
            $queryEvolution = mysqli_query($con, $selectEvolution);
            $r = mysqli_fetch_array($queryEvolution);
            $insertEvolution = "INSERT INTO `mensagensEvolution` (`id`, `analisa`, `confirma`, `red`, `green`, `usuario`, `marcacao`, `gales`, `zero`) 
            VALUES (NULL, '".$r['analisa']."', '".$r['confirma']."', '".$r['red']."', '".$r['green']."', '".$param->id."', '".$r['marcacao']."', '".$r['gales']."', '".$r['zero']."')";
            $queryEvolution = mysqli_query($con, $insertEvolution);
            
            $selectPragmatic = "SELECT * FROM `mensagensPragmatic` WHERE `id` = 1";
            $queryPragmatic = mysqli_query($con, $selectPragmatic);
            $r = mysqli_fetch_array($queryPragmatic);
            $insertPragmatic = "INSERT INTO `mensagensPragmatic` (`id`, `analisa`, `confirma`, `red`, `green`, `usuario`, `marcacao`, `gales`, `zero`) 
            VALUES (NULL, '".$r['analisa']."', '".$r['confirma']."', '".$r['red']."', '".$r['green']."', '".$param->id."', '".$r['marcacao']."', '".$r['gales']."', '".$r['zero']."')";
            $queryPragmatic = mysqli_query($con, $insertPragmatic);
            
        }
        
        $data['sucesso'] = true;
    } else {
        $data['sucesso'] = false;
    }   

    echo json_encode($data);
?>