<?php
include '../classes/config.php'; 
$sistema = Sistema::find(1);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Recuperar Senha</title>
    <link rel="shortcut icon" href="assets/images/logo/favicon.png">
    <link href="assets/css/app.min.css" rel="stylesheet">
</head>
<body>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between m-b-30">
                                        <img class="img-fluid" alt="" src="<?=ADMIN?>assets/images/logo/<?=$sistema->logo?>" style="width:80%; margin-left:10%;">
                                    </div>
                                    <form id="form-recupera" method="post">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="email">E-mail:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="E-mail de Cadastro">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="font-size-13 text-muted">
                                                    <a class="float-right font-size-13 text-muted" href="login">Voltar para Login</a>
                                                </span>
                                                <button type="submit" class="btn btn-primary">RECUPERAR</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="">© <?=date("Y")?> <?=TITULO?> - Todos os Direitos Reservados</span>
                    <ul class="list-inline">

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Core Vendors JS -->
    <script src="assets/js/vendors.min.js"></script>
    <script src="assets/vendors/sweetalert/sweetalert.js"></script>
    <!-- page js -->
    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/recupera.js"></script>
</body>
</html>