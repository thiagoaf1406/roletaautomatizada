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
    <title><?=TITULO?> - <?=$titulo?></title>
    <link rel="shortcut icon" href="assets/images/logo/favicon.png">
    <link href="assets/vendors/select2/select2.css" rel="stylesheet">
    <link href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/form-usuario.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/vendors/dropzone/dropzone.css" rel="stylesheet">
    <style>
         .label-switch{ width:140px; }
         .dropzone {
            min-height: 30px;
            border: 2px solid rgba(0, 0, 0, 0.3);
            background: #f1f1f1;
            border-radius:5px;
            padding: 10px 10px;
        }
        .dropzone .dz-message {
            text-align: center;
            margin: 15px 0;
        }
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
                        <h2 class="header-title">Sistema</h2>
                        <div class="header-sub-title">
                            <nav class="breadcrumb breadcrumb-dash">
                                <a href="dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Início</a>
                                <a class="breadcrumb-item" href="#">Sistema</a>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4>Configurações</h4>
                            <p class="badge badge-pill badge-green font-size-12"></p>
                            <form id="form-sistema" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="id" name="id" value="1">
                                <div class="m-t-25">
                                    <div class="row">
                                	    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Logotipo do Sistema</label>
                                                <div class="position-relative">
    													<? if(!empty($sistema->logo)){ ?>
    														<img style="width:80%; margin-bottom:10px;" class="ImagemCarregada" src="assets/images/logo/<?=$sistema->logo?>" alt="" />
    														<input type="hidden" id="logo" name="logo" value="<?=$sistema->logo?>">
    														<div id="dZUploadImagem" class="dropzone novaFoto dpZoneImagemCarregada">
    												      <div class="dz-default dz-message">Atualizar <b>Logotipo</b></div>
    														</div>
    													<? } else { ?>
    														<div id="dZUploadImagem" class="dropzone">
    												            <div class="dz-default dz-message">Arraste e solte o <b>Logotipo</b> aqui ou clique para procurar!</div>
    												            <input type="hidden" id="logo" name="logo">
    														</div>
    													<? } ?>
                                                    <div class="help-block font-small-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="modal-imagem" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="modalLabel">Logotipo</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="img-container">
														<img id="image" src="assets/images/logo/imagem.jpg" alt="Picture">
													</div>
												</div>
												<div class="modal-footer">
													<button id="cancel-upload" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<button id="crop-upload" type="button" class="btn btn-primary" data-dismiss="modal">Upload</button>
												</div>
											</div>
										</div>
									</div>
                               			<div class="col-md-6">
                                            <div class="form-group">	
                                                <label>Status do Sistema</label>
                                                <select class="form-control m-b-10" id="status" name="status" required>
    										        <option value="">Selecione</option>
    										        <option <? if($sistema->status == 'On'){ echo 'selected'; } ?> value="On">On</option>
    										        <option <? if($sistema->status == 'Off'){ echo 'selected'; } ?> value="Off">Off</option>
    										    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Token do Robô Telegram</label>
                                                <div class="position-relative">
    												<input type="text" class="form-control" id="token" name="token" value="<?=$sistema->token?>">
                                                    <div class="help-block font-small-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">&nbsp;</div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Webhook Telegram <?='https://'.$_SERVER['HTTP_HOST'];?>/telegram/webhook.php</label>
                                                <div class="position-relative">
                                                    <? if(!empty($sistema->webhook)){ ?>
    												<input type="text" class="form-control" id="webhook" name="webhook" value="<?=$sistema->webhook?>">
    												<? } else { ?>
    												<input type="text" class="form-control" id="webhook" name="webhook" value="https://<?=$_SERVER['HTTP_HOST']?>/telegram/webhook.php">
    												<? } ?>
                                                    <div class="help-block font-small-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Webhook Telegram</label>
                                                <div class="position-relative">
    												<button class="btn btn-warning btn-tone" type="button" onclick="setWebook()">Setar Webhook no Telegram</button>
                                                    <div class="help-block font-small-3"></div>
                                                </div>
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
    <link href="assets/vendors/cropper/cropper.min.css" rel="stylesheet">
    <script src="assets/vendors/dropzone/dropzone.js"></script>
    <script src="assets/vendors/cropper/cropper.js"></script>
    <script src="assets/vendors/cropper/jquery-cropper.js"></script>
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
        function setWebook(){
            webhook = $("#webhook").val();
            token = $("#token").val();
            if(webhook && token){
                window.open('https://api.telegram.org/bot'+token+'/setWebhook?url='+webhook);
            } else {
                swal("Erro!", "Os campos Token e WebHook precisam estar preenchidos", "error");
            }
        }
        Dropzone.autoDiscover = false;
        $(document).ready(function () {
			var myImagem = new Dropzone(
					"#dZUploadImagem",
					{
						autoProcessQueue: false,
						paramName: "file",
						url: "controller/upload-imagem.php?tipo=logo",
						acceptedFiles: ".jpg,.png,.jpeg",
						maxFiles: 1,
						addRemoveLinks: true,
						success: function (file, response) {
							fileNameImagem = response;
							console.log("Successfully uploaded : " + fileNameImagem);
							$("#logo").val(fileNameImagem);
						},
						error: function (file, response) {
							console.log(response + '('+ file.name +')');
						}
					}
			);
            myImagem.on('thumbnail', function (file) {
				if (file.cropped) {
					return;
				}

				var cachedFilename = file.name;
				myImagem.removeFile(file);

				var $cropperModal = $('#modal-imagem');
				var $uploadCrop = $cropperModal.find('#crop-upload');
				var $cancelCrop = $cropperModal.find('#cancel-upload');
				var $img = $('#image');

				var reader = new FileReader();
				reader.onloadend = function () {

						$cropperModal.find('.image-container').html($img);
						$img.attr('src', reader.result);

						$img.cropper({
						        aspectRatio: 1/1, 
								autoCropArea: 1,
								movable: true,
								cropBoxResizable: true,
								minContainerHeight : 400,
								minContainerWidth : 450
						});
				};

				reader.readAsDataURL(file);
				$cropperModal.modal({backdrop: 'static', keyboard: false});

				$uploadCrop.on('click', function() {
						myImagem.removeAllFiles(true)
						var blob = $img.cropper(
							'getCroppedCanvas',
							{
								width: 600, //LARGURA DA IMAGEM AQUI
								height: 600 //ALTURA DA IMAGEM
							}
						).toDataURL();
						// transform it to Blob object
						var newFile = dataURItoBlob(blob);
						// set 'cropped to true' (so that we don't get to that listener again)
						newFile.cropped = true;
						// assign original filename
						newFile.name = cachedFilename;
						// add cropped file to dropzone
						myImagem.addFile(newFile);
						// upload cropped file with dropzone
						myImagem.processQueue();
						$cropperModal.modal('hide');

						setTimeout(() => {
							$img.cropper("destroy");
						});
				});


				$cancelCrop.on('click', function() {
					$img.cropper("destroy");
					myImagem.removeAllFiles(true)
				})

				function dataURItoBlob(dataURI) {
						var byteString = atob(dataURI.split(',')[1]);
						var ab = new ArrayBuffer(byteString.length);
						var ia = new Uint8Array(ab);
						for (var i = 0; i < byteString.length; i++) {
								ia[i] = byteString.charCodeAt(i);
						}
						return new Blob([ab], { type: 'image/jpeg' });
				}
			});
        });
        $("#form-sistema").submit(function(e){
            e.preventDefault();
            formDados = $("#form-sistema").serialize();
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "controller/sistema",
                data: formDados,
                processData: true,
                success: function(data){
                    console.log(data)
                    if(data.sucesso == true){
                       swal("Sucesso!", "Configurações salvas com sucesso!", "success");
                       setTimeout(function(){ location.href="<?=CMS?>"; }, 1000);
                    } else {
                       swal("Erro!", "Ocorreu um erro! Tente novamente por favor.", "error");
                    }
                }
            });  
        });
    </script>
</body>
</html>