<?php
include '../classes/config.php';
include 'controller/sessao.php';
$ativa= 'relatorio';
$sistema = Sistema::find(1);
$hoje = date("Y-m-d").' 00:00:00';
$now = date("Y-m-d H:i:s");
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
                                    <h4 class="m-b-0">Relatório do Sistema</h4>
                                    <span class="text-gray">Entradas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Dados Geral</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="m-b-0">Entradas</p>
                                            <h2 class="m-b-0">
                                                <span><?=count(Entrada::find(0))?></span>
                                            </h2>
                                        </div>
                                        <div class="avatar avatar-icon avatar-lg avatar-purple">
                                            <i class="anticon anticon-alert"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="m-b-0">Confirmadas</p>
                                            <h2 class="m-b-0">
                                                <span><?=count(Entrada::find(0, array("confirmada = 's'")))?></span>
                                            </h2>
                                        </div>
                                        <div class="avatar avatar-icon avatar-lg avatar-blue">
                                            <i class="anticon anticon-like"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="m-b-0">Não Confirmadas</p>
                                            <h2 class="m-b-0">
                                                <span><?=count(Entrada::find(0, array("confirmada = 'n'")))?></span>
                                            </h2>
                                        </div>
                                        <div class="avatar avatar-icon avatar-lg avatar-gold">
                                            <i class="anticon anticon-dislike"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">    
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="m-b-0">Ganhos</p>
                                            <h2 class="m-b-0">
                                                <span><?=count(Entrada::find(0, array("status = 'g'")))?></span>
                                            </h2>
                                        </div>
                                        <div class="avatar avatar-icon bg-success avatar-lg">
                                            <i class="anticon anticon-rise"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="m-b-0">Perdas</p>
                                            <h2 class="m-b-0">
                                                <span><?=count(Entrada::find(0, array("status = 'r'")))?></span>
                                            </h2>
                                        </div>
                                        <div class="avatar avatar-icon avatar-lg bg-danger">
                                            <i class="anticon anticon-fall"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="m-b-0">Porcentagem Acertos</p>
                                            <h2 class="m-b-0">
                                                <span>
                                                <?
                                                    $confirmadas = count(Entrada::find(0, array("confirmada = 's'")));
                                                    
                                                    $ganhos = count(Entrada::find(0, array("status = 'g'")));
                                                    $total = ($ganhos/$confirmadas)*100;
                                                    echo round($total, 2).'%';
                                                ?>
                                                </span>
                                            </h2>
                                        </div>
                                        <div class="avatar avatar-icon avatar-lg bg-warning">
                                            <i class="anticon anticon-thunderbolt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Dados do dia</h3>
                        </div>
                    </div>
                    <div class="row">    
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="m-b-0">Ganhos Hoje</p>
                                            <h2 class="m-b-0">
                                                
                                                <span><?=count(Entrada::find(0, array("status = 'g' AND data_cadastro BETWEEN '".$hoje."' AND '".$now."'")))?></span>
                                            </h2>
                                        </div>
                                        <div class="avatar avatar-icon bg-success avatar-lg">
                                            <i class="anticon anticon-rise"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="m-b-0">Perdas Hoje</p>
                                            <h2 class="m-b-0">
                                                <span><?=count(Entrada::find(0, array("status = 'r' AND data_cadastro BETWEEN '".$hoje."' AND '".$now."'")))?></span>
                                            </h2>
                                        </div>
                                        <div class="avatar avatar-icon avatar-lg bg-danger">
                                            <i class="anticon anticon-fall"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="m-b-0">Porcentagem Acertos(Hoje)</p>
                                            <h2 class="m-b-0">
                                                <span>
                                                <?
                                                    $confirmadas = count(Entrada::find(0, array("confirmada = 's' AND data_cadastro BETWEEN '".$hoje."' AND '".$now."'")));
                                                    
                                                    $ganhos = count(Entrada::find(0, array("status = 'g' AND data_cadastro BETWEEN '".$hoje."' AND '".$now."'")));
                                                    $total = ($ganhos/$confirmadas)*100;
                                                    echo round($total, 2).'%';
                                                ?>
                                                </span>
                                            </h2>
                                        </div>
                                        <div class="avatar avatar-icon avatar-lg bg-warning">
                                            <i class="anticon anticon-thunderbolt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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