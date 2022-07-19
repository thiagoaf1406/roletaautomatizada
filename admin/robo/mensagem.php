<?php
include '../../classes/config.php';
include '../controller/sessao.php';
$ativa = 'mensagem';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$titulo?></title>
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
                        <h2 class="header-title">Robô Mensageiro</h2>
                        <div class="header-sub-title">
                            <nav class="breadcrumb breadcrumb-dash">
                                <a href="dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Início</a>
                                <a class="breadcrumb-item" href="#"><?=$titulo?></a>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4>Mensagem para Usuário</h4>
                            <p class="badge badge-pill badge-green font-size-12">Dica: Preencha corretamente todos os dados:</p>
                            <form id="form-mensagem" method="post" enctype="multipart/form-data">
                            <div class="m-t-25">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> TelegramID / @username </label>
										    <input class="form-control m-b-10" type="text" id="id" name="id" placeholder="TelegramID / @username / Número(com DDI DDD e número ex: +5583999999999) *" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Texto</label>
										    <textarea class="form-control m-b-10" id="texto" name="texto" rows="6" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">&nbsp;</div>
                                    <div class="col-md-12">
                                        <div class="form-group text-right">
                                            <button class="btn btn-primary">ENVIAR</button>
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
        $("#form-mensagem").submit(function(e){
            e.preventDefault();
            formDados = $("#form-mensagem").serialize();
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "https://robo.robomilionarioclube.com/robo/mensagemUsuario.php",
                data: formDados,
                processData: true,
                success: function(data){
                    console.log(data)
                    if(data.sucesso == true){
                       swal("Sucesso!", "Mensagem enviada com sucesso!", "success");
                       $("#form-mensagem")[0].reset();
                    } else {
                       swal("Erro!", "Ocorreu um erro! Tente novamente por favor.", "error");
                    }
                }
            });  
        });
    </script>
</body>
</html>