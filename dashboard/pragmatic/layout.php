<?php
include '../../classes/config.php';
include '../controller/sessao.php';
$ativa = 'Pragmatic Layout';
$sistema = Sistema::find(1);
$mensagens = MensagemPragmatic::find(0, array("usuario = '".$_SESSION['usuario_id']."'"));
$mensagem = $mensagens[0];
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
    <link href="assets/css/form-usuario.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <style>
         .label-switch{ width:140px; }
         label{font-weight:bold;}
    </style>
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
                        <h2 class="header-title">Pragmatic - Layout de Mensagens</h2>
                        <div class="header-sub-title">
                            <nav class="breadcrumb breadcrumb-dash">
                                <a href="dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Início</a>
                                <a class="breadcrumb-item" href="#">Layout de Mensagens</a>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4>Mensagens</h4>
                            <p class="badge badge-pill badge-green font-size-12">Dica: Não altere o texto que está entre chaves {{ }} </p>
                            <form id="form-perfil" method="post" enctype="multipart/form-data">
                            <div class="m-t-25">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Variáveis</h5>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table">
                                                    <tr>
                                                        <th>Variável</th>
                                                        <th>Descrição</th>
                                                        <th>Aplicação</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{roleta}}</td>
                                                        <td>Nome da Roleta</td>
                                                        <td>Possível entrada, Confirmação Entrada</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{estrategia}}</td>
                                                        <td>Nome da Estratégia</td>
                                                        <td>Possível entrada, Confirmação Entrada</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{observacao}}</td>
                                                        <td>Descrição da sequência que está saindo</td>
                                                        <td>Possível entrada</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{instrucaoGales}}</td>
                                                        <td>Texto de instrução para Martingale</td>
                                                        <td>Confirmação Entrada</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{gales}}</td>
                                                        <td>Variável com o número de gales da estratégia</td>
                                                        <td>Instrução de Gales</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table">
                                                    <tr>
                                                        <th>Variável</th>
                                                        <th>Descrição</th>
                                                        <th>Aplicação</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{instrucao}}</td>
                                                        <td>Texto informando em que apostar</td>
                                                        <td>Confirmação Entrada</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{sequencia}}</td>
                                                        <td>Sequência de números analisados</td>
                                                        <td>Possível entrada</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{zero}}</td>
                                                        <td>Texto informando cobertura do zero</td>
                                                        <td>Confirmação Entrada</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{numeros}}</td>
                                                        <td>Número(s) sorteado(s) até o Green</td>
                                                        <td>Green, Red</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{desktop}}</td>
                                                        <td>Link da roleta para computador</td>
                                                        <td>Possível entrada, Confirmação Entrada</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{mobile}}</td>
                                                        <td>Link da roleta para celular/tablet</td>
                                                        <td>Possível entrada, Confirmação Entrada</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        
                                    </div>
                       				<input type="hidden" id="id" name="id" value="<?=$mensagem->id?>">
                           			<div class="col-md-6">
                                        <div class="form-group">
                                            <label>Possível Entrada</label>	
                                            <textarea class="form-control m-b-10" id="analisa" name="analisa" rows="10" required><?=$mensagem->analisa?></textarea>
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
										    <label>Confirmação de Entrada</label>	
                                            <textarea class="form-control m-b-10" id="confirma" name="confirma" rows="10" required><?=$mensagem->confirma?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Instrução de Gales</label>	
                                            <textarea class="form-control m-b-10" id="gales" name="gales" rows="10" required><?=$mensagem->gales?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Instrução Zero</label>	
                                            <textarea class="form-control m-b-10" id="zero" name="zero" rows="10" required><?=$mensagem->zero?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Green</label>	
                                            <textarea class="form-control m-b-10" id="green" name="green" rows="10" required><?=$mensagem->green?></textarea>
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
										    <label>Red</label>	
                                            <textarea class="form-control m-b-10" id="red" name="red" rows="10" required><?=$mensagem->red?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Marcação de Green/Red</label>
										    <select class="form-control m-b-10" id="marcacao" name="marcacao" required>
										        <option value="">Selecione</option>
										        <option <? if($mensagem->marcacao == 'Responder'){ echo 'selected'; } ?> value="Responder">Responder Mensagem</option>
										        <option <? if($mensagem->marcacao == 'Editar'){ echo 'selected'; } ?> value="Editar">Editar Mensagem</option>
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
    <script src="assets/js/funcoes.js"></script>
    <script>
        $("#form-perfil").submit(function(e){
            e.preventDefault();
            formDados =  $("#form-perfil").serialize();
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "pragmatic/actions/layout",
                data: formDados,
                processData: true,
                success: function(data){
                    console.log(data)
                    if(data.sucesso == true){
                       swal("Sucesso!", "Layout salvo com sucesso!", "success");
                       setTimeout(function(){ location.reload(); }, 1500);
                    } else {
                       swal("Erro!", "Ocorreu um erro! Tente novamente por favor.", "error");
                    }
                }
            });  
        });
    </script>
</body>
</html>