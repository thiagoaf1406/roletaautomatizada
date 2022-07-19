<?php
include '../classes/config.php';
include 'controller/sessao.php';
$sistema = Sistema::find(1);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=TITULO?> - Perfil</title>
    <link rel="shortcut icon" href="assets/images/logo/favicon.png">
    <link href="assets/vendors/select2/select2.css" rel="stylesheet">
    <link href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/form-usuario.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <style>
         .label-switch{ width:140px; }
    </style>
</head>
<body>
    <div class="app">
        <div class="layout">
            <!-- Header -->
            <?php include 'includes/header.php'; ?>
            <!-- Header -->
            <!-- Menu -->
            <?php include 'includes/menu.php'; ?>
            <!-- Menu -->
            <!-- Page Container START -->
            <div class="page-container">
                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="page-header">
                        <h2 class="header-title">Perfil</h2>
                        <div class="header-sub-title">
                            <nav class="breadcrumb breadcrumb-dash">
                                <a href="dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Início</a>
                                <a class="breadcrumb-item" href="#">Perfil</a>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4>Perfil</h4>
                            <p class="badge badge-pill badge-green font-size-12">Dica: Preencha corretamente todos os dados:</p>
                            <form id="form-perfil" method="post" enctype="multipart/form-data">
                            <div class="m-t-25">
                                <div class="row">
                            	    <div class="col-md-6">
                                        <div class="preview-imagem">
                                            <input type="hidden" id="imagem" name="imagem" value="<?=$usuario->imagem?>">
                                            <input type="file" id="imagemUpload" onchange="uploadImagem(this)" style="display:none;">
                                            <?if($usuario->imagem){ ?>
                                            <img src="<?=URL?>imagens/usuarios/<?=$usuario->imagem?>" class="thumb-imagem">
                                            <? } else { ?>
                                            <img src="<?=URL?>imagens/usuarios/logo.png" class="thumb-imagem">
                                            <? } ?>
                                        </div>
                                        <div class="media upload-imagem">
                                            <div class="imagem-label">
                                                <h5 class="m-b-5 font-size-18">Foto</h5>
                                                <p class="opacity-07 font-size-13 m-b-0">
                                                    Dimensões Recomendadas: <br>
                                                    770x480px - Tam. Máx: 300kb
                                                </p>
                                                <button type="button" class="btn btn-tone btn-primary botao-imagem">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">&nbsp;</div>
                            
                           				<input type="hidden" id="id" name="id" value="<?=$usuario->id?>">
                           			<div class="col-md-6">
                                        <div class="form-group">	
                                            <input class="form-control m-b-10" type="text" id="nome" name="nome" placeholder="Seu Nome *" value="<?=$usuario->nome?>" required>
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
										    <input class="form-control m-b-10" type="email" id="email" name="email" placeholder="Seu E-mail *" value="<?=$usuario->email?>" readonly required>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control m-b-10" type="password" id="senha" name="senha" placeholder="Senha *" value="<?=base64_decode($usuario->senha)?>" required>
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
                <!-- Content Wrapper END -->
                <!-- Footer START -->
                <?php include 'includes/footer.php'; ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/perfil.js"></script>
    <script src="assets/js/funcoes.js"></script>
</body>
</html>