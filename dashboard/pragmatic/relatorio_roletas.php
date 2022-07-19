<?php
include '../../classes/config.php';
include '../controller/sessao.php';
$ativa= 'Pragmatic Relatório Roletas';
$sistema = Sistema::find(1);
$hoje = date("Y-m-d").' 00:00:00';
$now = date("Y-m-d H:i:s");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <base href="<?=DASHBOARD?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=TITULO?> - Dashboard</title>
    <link rel="shortcut icon" href="assets/images/logo/favicon.png">
    <link href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <?php include '../includes/header.php'; ?>
            <!-- Header END -->

            <!-- Side Nav START -->
            <?php include '../includes/menu.php'; ?>
            <!-- Side Nav END -->
            <!-- Page Container START -->
            <div class="page-container">
                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="page-header no-gutters">
                        <div class="d-md-flex align-items-md-center justify-content-between">
                            <div class="media m-v-10 align-items-center">
                                <div class="media-body m-l-15">
                                    <h4 class="m-b-0">Pragmatic Relatório Roletas</h4>
                                    <span class="text-gray">Selecione a Roleta</span>
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-control">
                                    <select class="form-control" onchange="filtraRoleta(this)">
                                        <option value="">Selecione...</option>
                                        <?php foreach(RoletaPragmatic::find(0, array("usuario = '".$_SESSION['usuario_id']."'")) as $r){ ?>
                                        <option value="<?=$r->id?>"><?=$r->nome?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Dados da Roleta</h3>
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
                                                <span id="ganhos"></span>
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
                                                <span id="perdas"></span>
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
                                                <span id="porcentagem"></span>
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
                        <div class="col-lg-12 entradas">
                           
                                
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper END -->
                <!-- Footer START -->
                <?php include '../includes/footer.php'; ?>
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
    <script>
        function filtraRoleta(elm){
            id = $(elm).val();
            $("#ganhos").text('0');
            $("#perdas").text('0');
            $("#porcentagem").text('0');
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "pragmatic/actions/filtraRoleta",
                data: { id:id },
                processData: true,
                success: function(data){
                    console.log(data)
                    if(data.sucesso == true){
                       $("#ganhos").text(data.ganhos);
                       $("#perdas").text(data.perdas);
                       $("#porcentagem").text(data.porcentagem);
                    } else {
                       swal("Erro!", "Nenhum entrada encontrada para essa roleta hoje.", "error");
                    }
                }
            });  
        }
    </script>
</body>

</html>