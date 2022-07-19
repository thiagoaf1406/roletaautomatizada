<?
    include '../../../classes/config.php';
    $hoje = date("Y-m-d").' 00:00:00';
    $now = date("Y-m-d H:i:s");
    
    $id = $_POST['id'];
    $roleta = RoletaEvolution::find($id);
    
    $ganhos = count(EntradaEvolution::find(0, array("usuario = '".$_SESSION['usuario_id']."' AND confirmada = 's' AND status = 'g' AND roleta_id = '".$roleta->numero."' AND data_cadastro BETWEEN '".$hoje."' AND '".$now."'")));
    $perdas = count(EntradaEvolution::find(0, array("usuario = '".$_SESSION['usuario_id']."' AND confirmada = 's' AND status = 'r' AND roleta_id = '".$roleta->numero."' AND data_cadastro BETWEEN '".$hoje."' AND '".$now."'")));
    $confirmadas = count(EntradaEvolution::find(0, array("usuario = '".$_SESSION['usuario_id']."' AND confirmada = 's' AND roleta_id = '".$roleta->numero."' AND data_cadastro BETWEEN '".$hoje."' AND '".$now."'")));

    if($ganhos >0){
        $total = ($ganhos/$confirmadas)*100;
    } else {
        $total = $confirmadas*100;
    }
    
    $porcentagem = round($total, 2).'%';
    
    $data['ganhos'] = $ganhos;
    $data['perdas'] = $perdas;
    $data['porcentagem'] = $porcentagem;
    
    if($confirmadas >=1){
        $data['sucesso'] = true;
    } else {
        $data['sucesso'] = false;
    }
    echo json_encode($data);
?>