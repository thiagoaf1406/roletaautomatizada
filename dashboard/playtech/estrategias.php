<?php
include '../../classes/config.php';
include '../controller/sessao.php';
$titulo = 'Estratégias';
$ativa = 'Playtech Estratégias';
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.22/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.2/kt-2.5.3/r-2.2.6/rr-1.2.7/sb-1.0.0/sp-1.2.1/datatables.min.css"/>
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
                        <h2 class="header-title">Playtech Estratégias</h2>
                        <div class="header-sub-title">
                            <nav class="breadcrumb breadcrumb-dash">
                                <a href="dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Início</a>
                                <a class="breadcrumb-item" href="#"><?=$titulo?></a>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4>Gerenciamento de Estratégias</h4>
                            <!--begin::Table-->
								<div class="table-responsive">
									<table id="tabela" class="display table" style="width:100%">
										<thead>
											<tr class="text-left">
											    <th></th>
												<th>Nome</th>
												<th>Apostar em</th>
												<th>Analisa</th>
												<th>Confirma</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
										  
										</tbody>
									</table>
								</div>
							<!--end::Table-->
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper END -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.22/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.2/kt-2.5.3/r-2.2.6/rr-1.2.7/sb-1.0.0/sp-1.2.1/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabela').DataTable({
                dom: 'Bfrtip',
                "paging":   false,
                "order": [[ 0, "asc" ]],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: ['copy', 'excel', 'pdf'],
                "processing": true,
                "serverSide": true,
                "ajax": "playtech/actions/estrategias.php",
                "language": {
                    "url": "assets/js/traducao.json"
                },
            });
        } );
        function atualizaStatus(status, id){
            status = status;
            id = id;
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "playtech/actions/atualizaEstrategia.php",
                data: {status:status, id:id},
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