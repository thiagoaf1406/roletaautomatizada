<?php
include '../../classes/config.php';
include '../controller/sessao.php';
$id = $_REQUEST['id'];

$u = Roleta::find($id);
$edicao = true;
$titulo = 'Editar Roleta';

$ativa = 'Roletas';
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
                        <h2 class="header-title">Roleta</h2>
                        <div class="header-sub-title">
                            <nav class="breadcrumb breadcrumb-dash">
                                <a href="dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Início</a>
                                <a class="breadcrumb-item" href="#"><?=$titulo?></a>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4>Dados da Roleta</h4>
                            <p class="badge badge-pill badge-green font-size-12">Dica: Preencha corretamente todos os dados:</p>
                            <form id="form-roleta" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="id" name="id" value="<?=$id?>">
                            <div class="m-t-25">
                                <div class="row">
                           			<input type="hidden" id="id" name="id" value="<?=$id?>">
                           			<div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input class="form-control m-b-10" type="text" placeholder="Nome da Roleta *" value="<?=$u->nome?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Link</label>
                                            <input class="form-control m-b-10" type="text" id="link" name="link" placeholder="Link da Roleta *" value="<?=$u->link?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
										    <select class="form-control m-b-10" id="status" name="status" required>
										        <option value="">Selecione</option>
										        <option <? if($u->status == 'On'){ echo 'selected'; } ?> value="On">On</option>
										        <option <? if($u->status == 'Off'){ echo 'selected'; } ?> value="Off">Off</option>
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
        $("#form-roleta").submit(function(e){
            e.preventDefault();
            formDados = $("#form-roleta").serialize();
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "roletas/actions/atualiza",
                data: formDados,
                processData: true,
                success: function(data){
                    console.log(data)
                    if(data.sucesso == true){
                       swal("Sucesso!", "Roleta salva com sucesso!", "success");
                       setTimeout(function(){ location.href="roletas/"; }, 1000);
                    } else {
                       swal("Erro!", "Ocorreu um erro! Tente novamente por favor.", "error");
                    }
                }
            });  
        });
    </script>
</body>
</html>