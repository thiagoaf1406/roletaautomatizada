<?php
include '../classes/config.php';
include 'controller/sessao.php';
$ativa= '';
$sistema = Sistema::find(1);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title><?=TITULO?> - Dashboard</title>
    <link rel="shortcut icon" href="assets/images/logo/favicon.png">
    <link href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <?php include 'includes/header.php'; ?>
            <!-- Header END -->

            <!-- Side Nav START -->
            <?php include 'includes/menu.php'; ?>
            <!-- Side Nav END -->
            <!-- Page Container START -->
            <div class="page-container">
                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="page-header no-gutters">
                        <div class="d-md-flex align-items-md-center justify-content-between">
                            <div class="media m-v-10 align-items-center">
                                <div class="media-body m-l-15">
                                    <h4 class="m-b-0">Bem vindo, <?=$nome?></h4>
                                    <span class="text-gray">Painel de Gestão</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--<div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="m-b-0">Admins</p>
                                            <h2 class="m-b-0">
                                                <span><?=count(Admin::find(0))?></span>
                                            </h2>
                                        </div>
                                        <div class="avatar avatar-icon avatar-lg avatar-green">
                                            <i class="anticon anticon-share-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="m-b-0">Estrategias</p>
                                            <h2 class="m-b-0">
                                            <span><?=count(Estrategia::find(0, array("status = 'On' AND usuario = '".$_SESSION['usuario_id']."'")))?></span>
                                            </h2>
                                        </div>
                                        <div class="avatar avatar-icon avatar-lg avatar-blue">
                                            <i class="anticon anticon-picture"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="m-b-0">Grupos</p>
                                            <h2 class="m-b-0">
                                                <span><?=count(Grupo::find(0, array("usuario = '".$_SESSION['usuario_id']."'")))?></span>
                                            </h2>
                                        </div>
                                        <div class="avatar avatar-icon avatar-lg avatar-gold">
                                            <i class="anticon anticon-user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="m-b-0">Greens</p>
                                            <h2 class="m-b-0">
                                                <span><?=count(Entrada::find(0, array("status = 'g' AND usuario = '".$_SESSION['usuario_id']."'")))?></span>
                                            </h2>
                                        </div>
                                        <div class="avatar avatar-icon avatar-lg avatar-blue">
                                            <i class="anticon anticon-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    
                    <div class="row">
                        <div class="col-lg-12">
                           
                                
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper END -->
                <!-- Footer START -->
                <?php include 'includes/footer.php'; ?>
                <!-- Footer END -->
            </div>
            <!-- Page Container END -->
    <!-- Core Vendors JS -->
    <script src="assets/js/vendors.min.js"></script>
    <script src="assets/vendors/sweetalert/sweetalert.js"></script>
    <!-- page js -->
    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/pages/dashboard-project.js"></script>
    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/funcoes.js"></script>
</body>

</html>