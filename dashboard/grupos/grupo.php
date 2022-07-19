<?php
include '../../classes/config.php';
include '../controller/sessao.php';
$id = $_REQUEST['id'];

$grupos = Grupo::find(0, array("id = '".$id."' AND usuario = '".$_SESSION['usuario_id']."'"));
if(count($grupos) >=1){
$u = $grupos[0];
$edicao = true;
$titulo = 'Editar Grupo';

$ativa = 'Grupo';
$sistema = Sistema::find(1);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=TITULO?> - <?=$titulo?></title>
    <base href="<?=DASHBOARD?>">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png">
    <link href="assets/vendors/select2/select2.css" rel="stylesheet">
    <link href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <style>
        td{ padding:6px 10px !important; font-size:11px; line-height:11px; }
    </style>
</head>
<body>
    <div class="app">
        <div class="layout">
            <!-- Header -->
            <?php include '../includes/header.php'; ?>
            <!-- Header -->
            <!-- Menu -->
            <?php include '../includes/menu.php'; ?>
            <!-- Menu -->
            <!-- Page Container START -->
            <div class="page-container">
                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="page-header">
                        <h2 class="header-title">Grupos</h2>
                        <div class="header-sub-title">
                            <nav class="breadcrumb breadcrumb-dash">
                                <a href="dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Início</a>
                                <a class="breadcrumb-item" href="#"><?=$titulo?></a>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4>Dados do Grupo</h4>
                            <p class="badge badge-pill badge-green font-size-12">Dica: Preencha corretamente todos os dados:</p>
                            <form id="form-grupo" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="id" name="id" value="<?=$id?>">
                                <div class="m-t-25">
                                <div class="row">
                           			<input type="hidden" id="id" name="id" value="<?=$id?>">
                           			<div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome</label>
										    <input class="form-control m-b-10" type="text" id="nome" name="nome" placeholder="Nome do Grupo*" value="<?=$u->nome?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>GrupoID</label>
										    <input class="form-control m-b-10" type="text" id="grupoID" name="grupoID" placeholder="Id do Telegram *" value="<?=$u->grupoID?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Horário de Funcionamento (mínimo)</label>
										    <input class="form-control m-b-10" type="time" id="horario_min" name="horario_min" value="<? if(!empty($u->horario_min)){ echo $u->horario_min; } else { echo '00:00'; } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Horário de Funcionamento (máximo)</label>
										    <input class="form-control m-b-10" type="time" id="horario_max" name="horario_max" value="<? if(!empty($u->horario_max)){ echo $u->horario_max; } else { echo '23:59'; } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
										    <select class="form-control m-b-10" id="status" name="status" required>
										        <option value="">Selecione</option>
										        <option <? if($u->status == 'Ativo'){ echo 'selected'; } ?> value="Ativo">Ativo</option>
										        <option <? if($u->status == 'Inativo'){ echo 'selected'; } ?> value="Inativo">Inativo</option>
										    </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">&nbsp;</div>
                                    <div class="col-md-12">
                                        <div class="form-group text-right">
                                            <button class="btn btn-primary">SALVAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="card">
                        <div class="card-body">
                            <h4>Playtech - Estratégias do Grupo</h4>
                            <p class="badge badge-pill badge-blue font-size-12">Dica: ligue e desligue de acordo com suas prioridades:</p>
                            <div class="m-t-25">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <th>Estratégia</th>
                                                <th>Status</th>
                                            </tr>
                                            <?  
                                                $estrategiasGrupos = EstrategiasGrupos::find(0, array("usuario = '".$_SESSION['usuario_id']."' AND grupo = '".$u->id."'"));
                                                if(count($estrategiasGrupos) >=1){
                                                    foreach($estrategiasGrupos as $estrategiaGrupo){
                                                        $estrategia = Estrategia::find($estrategiaGrupo->estrategia);
                                            ?>
                                            <tr>
                                                <td><?=$estrategia->nome?></td>
                                                <td>
                                                    <div class="form-group" style="margin-bottom:0;">
                                                    <div class="switch m-r-10">
                                                    <? if($estrategiaGrupo->status == 'On'){ ?>
                                                        <input type="checkbox" id="switch-<?=$estrategiaGrupo->id?>" checked onclick="atualizaStatusEstrategia('Off', '<?=$estrategiaGrupo->id?>')">
                                                    <? } else { ?>
                                                        <input type="checkbox" id="switch-<?=$estrategiaGrupo->id?>" onclick="atualizaStatusEstrategia('On', '<?=$estrategiaGrupo->id?>')">
                                                    <? } ?>
                                                    <label for="switch-<?=$estrategiaGrupo->id?>"></label>
                                                    </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <? } } else { ?>
                                                <?
                                                    $estrategias = Estrategia::find(0, array("usuario = '".$_SESSION['usuario_id']."'"));
                                                    if(count($estrategias) >=1){
                                                        foreach($estrategias as $estrategia){
                                                            $estrategiasGrupos = EstrategiasGrupos::find(0, array("grupo = '".$u->id."' AND estrategia = '".$estrategia->id."'"));
                                                            if(count($estrategiasGrupos) ==0){
                                                                $e = new EstrategiasGrupos();
                                                                $e->usuario = $_SESSION['usuario_id'];
                                                                $e->estrategia = $estrategia->id;
                                                                $e->grupo = $u->id;
                                                                $e->status = 'On';
                                                                $e->save();
                                                            }
                                                        }  
                                                        echo '<script>location.reload();</script>';
                                                    } ?>
                                            <? } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card">
                        <div class="card-body">
                            <h4>Evolution - Estratégias do Grupo</h4>
                            <p class="badge badge-pill badge-blue font-size-12">Dica: ligue e desligue de acordo com suas prioridades:</p>
                            <div class="m-t-25">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <th>Estratégia</th>
                                                <th>Status</th>
                                            </tr>
                                            <?  
                                                $estrategiasGrupos = EstrategiasGruposEvolution::find(0, array("usuario = '".$_SESSION['usuario_id']."' AND grupo = '".$u->id."'"));
                                                if(count($estrategiasGrupos) >=1){
                                                    foreach($estrategiasGrupos as $estrategiaGrupo){
                                                        $estrategia = EstrategiaEvolution::find($estrategiaGrupo->estrategia);
                                            ?>
                                            <tr>
                                                <td><?=$estrategia->nome?></td>
                                                <td>
                                                    <div class="form-group" style="margin-bottom:0;">
                                                    <div class="switch m-r-10">
                                                    <? if($estrategiaGrupo->status == 'On'){ ?>
                                                        <input type="checkbox" id="switch-<?=$estrategiaGrupo->id?>" checked onclick="atualizaStatusEstrategiaEvolution('Off', '<?=$estrategiaGrupo->id?>')">
                                                    <? } else { ?>
                                                        <input type="checkbox" id="switch-<?=$estrategiaGrupo->id?>" onclick="atualizaStatusEstrategiaEvolution('On', '<?=$estrategiaGrupo->id?>')">
                                                    <? } ?>
                                                    <label for="switch-<?=$estrategiaGrupo->id?>"></label>
                                                    </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <? } } else { ?>
                                                <?
                                                    $estrategias = EstrategiaEvolution::find(0, array("usuario = '".$_SESSION['usuario_id']."'"));
                                                    if(count($estrategias) >=1){
                                                        foreach($estrategias as $estrategia){
                                                            $estrategiasGrupos = EstrategiasGruposEvolution::find(0, array("grupo = '".$u->id."' AND estrategia = '".$estrategia->id."'"));
                                                            if(count($estrategiasGrupos) ==0){
                                                                $e = new EstrategiasGruposEvolution();
                                                                $e->usuario = $_SESSION['usuario_id'];
                                                                $e->estrategia = $estrategia->id;
                                                                $e->grupo = $u->id;
                                                                $e->status = 'On';
                                                                $e->save();
                                                            }
                                                        }  
                                                        echo '<script>location.reload();</script>';
                                                    } ?>
                                            <? } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card">
                        <div class="card-body">
                            <h4>Pragmatic - Estratégias do Grupo</h4>
                            <p class="badge badge-pill badge-blue font-size-12">Dica: ligue e desligue de acordo com suas prioridades:</p>
                            <div class="m-t-25">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <th>Estratégia</th>
                                                <th>Status</th>
                                            </tr>
                                            <?  
                                                $estrategiasGrupos = EstrategiasGruposPragmatic::find(0, array("usuario = '".$_SESSION['usuario_id']."' AND grupo = '".$u->id."'"));
                                                if(count($estrategiasGrupos) >=1){
                                                    foreach($estrategiasGrupos as $estrategiaGrupo){
                                                        $estrategia = EstrategiaPragmatic::find($estrategiaGrupo->estrategia);
                                            ?>
                                            <tr>
                                                <td><?=$estrategia->nome?></td>
                                                <td>
                                                    <div class="form-group" style="margin-bottom:0;">
                                                    <div class="switch m-r-10">
                                                    <? if($estrategiaGrupo->status == 'On'){ ?>
                                                        <input type="checkbox" id="switch-<?=$estrategiaGrupo->id?>" checked onclick="atualizaStatusEstrategiaPragmatic('Off', '<?=$estrategiaGrupo->id?>')">
                                                    <? } else { ?>
                                                        <input type="checkbox" id="switch-<?=$estrategiaGrupo->id?>" onclick="atualizaStatusEstrategiaPragmatic('On', '<?=$estrategiaGrupo->id?>')">
                                                    <? } ?>
                                                    <label for="switch-<?=$estrategiaGrupo->id?>"></label>
                                                    </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <? } } else { ?>
                                                <?
                                                    $estrategias = EstrategiaPragmatic::find(0, array("usuario = '".$_SESSION['usuario_id']."'"));
                                                    if(count($estrategias) >=1){
                                                        foreach($estrategias as $estrategia){
                                                            $estrategiasGrupos = EstrategiasGruposPragmatic::find(0, array("grupo = '".$u->id."' AND estrategia = '".$estrategia->id."'"));
                                                            if(count($estrategiasGrupos) ==0){
                                                                $e = new EstrategiasGruposPragmatic();
                                                                $e->usuario = $_SESSION['usuario_id'];
                                                                $e->estrategia = $estrategia->id;
                                                                $e->grupo = $u->id;
                                                                $e->status = 'On';
                                                                $e->save();
                                                            }
                                                        }  
                                                        echo '<script>location.reload();</script>';
                                                    } ?>
                                            <? } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Footer START -->
                <?php include '../includes/footer.php'; ?>
                <!-- Footer END -->
            </div>
            <!-- Page Container END -->
        </div>
    </div>
    <!-- Core Vendors JS -->
    <script src="assets/js/vendors.min.js"></script>
    <!-- page js -->
    <script src="assets/vendors/sweetalert/sweetalert.js"></script>
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="assets/vendors/quill/quill.min.js"></script>
    <script src="assets/js/pages/form-elements.js"></script>
    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>
    <script>
        $("#form-grupo").submit(function(e){
            e.preventDefault();
            formDados = $("#form-grupo").serialize();
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "grupos/actions/form",
                data: formDados,
                processData: true,
                success: function(data){
                    console.log(data)
                    if(data.sucesso == true){
                       swal("Sucesso!", "Grupo salvo com sucesso!", "success");
                       setTimeout(function(){ location.href="grupos/"; }, 1500);
                    } else {
                       swal("Erro!", "Ocorreu um erro! Tente novamente por favor.", "error");
                    }
                }
            });  
        });
        function atualizaStatusEstrategia(status, id){
            status = status;
            id = id;
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "grupos/actions/atualizaStatusEstrategia",
                data: {id:id, status:status},
                processData: true,
                success: function(data){
                    console.log(data)
                    if(data.sucesso == true){

                    } else {
                       swal("Erro!", "Ocorreu um erro! Tente novamente por favor.", "error");
                    }
                }
            });  
        }
        function atualizaStatusEstrategiaPragmatic(status, id){
            status = status;
            id = id;
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "grupos/actions/atualizaStatusEstrategiaPragmatic",
                data: {id:id, status:status},
                processData: true,
                success: function(data){
                    console.log(data)
                    if(data.sucesso == true){

                    } else {
                       swal("Erro!", "Ocorreu um erro! Tente novamente por favor.", "error");
                    }
                }
            });  
        }
        function atualizaStatusEstrategiaEvolution(status, id){
            status = status;
            id = id;
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "grupos/actions/atualizaStatusEstrategiaEvolution",
                data: {id:id, status:status},
                processData: true,
                success: function(data){
                    console.log(data)
                    if(data.sucesso == true){

                    } else {
                       swal("Erro!", "Ocorreu um erro! Tente novamente por favor.", "error");
                    }
                }
            });  
        }
    </script>
</body>
</html>
<? } ?>