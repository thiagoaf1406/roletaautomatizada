<?php
include '../../classes/config.php';
include '../controller/sessao.php';
$id = $_REQUEST['id'];

if(!empty($id)){
    $u = Grupo::find($id);
    $edicao = true;
    $titulo = 'Editar Grupo';
} else {
    $edicao = false;
    $titulo = 'Novo Grupo';
}
$ativa = 'Grupo';
$sistema = Sistema::find(1);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=TITULO?> - <?=$titulo?></title>
    <base href="<?=CMS?>">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png">
    <link href="assets/vendors/select2/select2.css" rel="stylesheet">
    <link href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
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
										    <input class="form-control m-b-10" type="text" id="grupoID" name="grupoID" placeholder="Id do Telegram *" value="<?=$u->grupoID?>" required>
                                        </div>
                                    </div>
                                    <? if($super == 'Sim'){ ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Usuário</label>
										    <select class="form-control m-b-10" id="usuario" name="usuario" required>
										        <option value="">Selecione</option>
										        <?
										            $usuarios = Usuario::find(0);
										            if(count($usuarios) >=1){
										                foreach($usuarios as $user){
										        ?>
										        
										        <option <? if($user->id == $u->usuario){ echo 'selected'; } ?> value="<?=$user->id?>"><?=$user->nome?></option>
										        <?
										                }
										            }
										        ?>
										    </select>
                                        </div>
                                    </div>
                                    <? } else { ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Usuário</label>
										    <select class="form-control m-b-10" id="usuario" name="usuario" required>
										        <option value="">Selecione</option>
										        <?
										            $usuarios = Usuario::find(0, array("admin = '".$_SESSION['admin_id']."'"));
										            if(count($usuarios) >=1){
										                foreach($usuarios as $user){
										        ?>
										        
										        <option <? if($user->id == $u->usuario){ echo 'selected'; } ?> value="<?=$user->id?>"><?=$user->nome?></option>
										        <?
										                }
										            }
										        ?>
										    </select>
                                        </div>
                                    </div>
                                    <? } ?>
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
                                    
                                    <div class="col-md-12">&nbsp;</div>
                                    <hr>
                                    <? if($super == 'Sim'){ ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Evolution</label>
										    <select class="form-control m-b-10" id="evolution" name="evolution" required>
										        <option value="">Selecione</option>
										        <option <? if($u->evolution == 'Sim'){ echo 'selected'; } ?> value="Sim">Sim</option>
										        <option <? if($u->evolution == 'Não'){ echo 'selected'; } ?> value="Não">Não</option>
										    </select>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Playtech</label>
										    <select class="form-control m-b-10" id="playtech" name="playtech" required>
										        <option value="">Selecione</option>
										        <option <? if($u->playtech == 'Sim'){ echo 'selected'; } ?> value="Sim">Sim</option>
										        <option <? if($u->playtech == 'Não'){ echo 'selected'; } ?> value="Não">Não</option>
										    </select>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pragmatic</label>
										    <select class="form-control m-b-10" id="pragmatic" name="pragmatic" required>
										        <option value="">Selecione</option>
										        <option <? if($u->pragmatic == 'Sim'){ echo 'selected'; } ?> value="Sim">Sim</option>
										        <option <? if($u->pragmatic == 'Não'){ echo 'selected'; } ?> value="Não">Não</option>
										    </select>
                                        </div>
                                    </div>
                                    <? } ?>
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
    </script>
</body>
</html>