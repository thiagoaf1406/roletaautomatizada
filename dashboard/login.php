<?php
include '../classes/config.php';
session_start();
if(!isset($_SESSION["usuario_id"])){
    session_destroy();
} else { 
    $usuario = Usuario::find($_SESSION["usuario_id"]);
    $nome_explode = explode(" ", $usuario->nome);
    $nome = $nome_explode[0];
    $sobrenome = $nome_explode[1];
    echo '<script> location.href="'.DASHBOARD.'"; </script>';
    exit;
}
$sistema = Sistema::find(1);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=TITULO?> - Here</title>
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
                                    <form id="form-login" method="post">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="userName">E-mail:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail de Cadastro" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password">Senha:</label>
                                            <div class="input-affix m-b-10">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="font-size-13 text-muted">
                                                    <a class="float-right font-size-13 text-muted" href="recuperar-senha">Esqueceu sua senha? </a>
                                                </span>
                                                <button class="btn btn-primary">ACESSAR</button>
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
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script>
         $("#form-login").submit(function(e){
            e.preventDefault();
            dadosLogin = $("#form-login").serialize();
            $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "controller/login.php",
                    data: dadosLogin,
                    success: function(data){
                        if(data.sucesso == true){
                            swal("Logado!", "Login efetuado com sucesso.", "success");
                            setTimeout(function(){ location.href="<?=DASHBOARD?>" }, 1500);
                        } else {
                            
                                swal("Algo deu errado!", "Verifique E-mail/Senha e tente novamente!", "error");
                          
                        }
                    },
                    error: function(e){
                        console.log(e.message);
                    }
            });  
        });  
    </script>
</body>
</html>