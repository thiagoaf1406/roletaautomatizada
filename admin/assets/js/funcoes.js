$("#form-categoria").submit(function(e){
    e.preventDefault();
    dadosForm = $("#form-categoria").serialize();
    $.ajax({
            type: "POST",
            dataType: "json",
            url: "controller/geral.php",
            data: dadosForm,
            success: function(data){
                console.log(data)
                if(data.sucesso == true){
                    swal("Sucesso!", "Cadastro/Edição realizado com sucesso.", "success");
                } else {
                    swal("Algo deu errado!", "Verifique os dados e tente novamente!", "error");
                }
            },
            error: function(e){
                console.log(e.message);
            }
    });  
});  


function acaoArquivar(elm){
    
    id = $(elm).attr('data-id');
    classe = $(elm).attr('data-classe');
    swal({
        title: "Tem certeza que deseja arquivar?!",
        text: "Você poderá desarquivar a qualquer momento acessando o menu Arquivados.",
        icon: "warning",
        buttons: [
            'Não, cancelar!',
            'Sim, Tenho certeza!'
        ],
        className: "sweet-newsletter",
        dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "controller/acaoArquivar.php",
                    data: { id: id, classe:classe },
                    processData: true,
                    success: function(data){
                        if(data.sucesso == true){
                           swal("Sucesso!", "Arquivado com sucesso!", "success");
                           setTimeout(function(){ location.reload() }, 3000);
                        } else {
                            swal("Erro!", "Ocorreu um erro! Tente novamente por favor.", "error");
                        }
                    }
                }); 
            } else {

            }
        });
}

function marcaLida(usuario, notificacao, elm){
    usuario:usuario;
    notificacao:notificacao;
    $.ajax({
            type: "POST",
            dataType: "json",
            url: "controller/marcaLida.php",
            data: { usuario:usuario, notificacao:notificacao },
            success: function(data){
                console.log(data)
                if(data.sucesso == true){
                    $(elm).closest(".dropdown-item").removeClass("d-block");
                    $(elm).closest(".dropdown-item").hide();
                    pegaNotificacoes()
                } else {
                    swal("Algo deu errado!", "Verifique os dados e tente novamente!", "error");
                }
            },
            error: function(e){
                console.log(e.message);
            }
    });
}

var audio = new Audio('https://bordacomunicacao.com.br/arquivos/notificacao.mp3');

/*function verificaNotificacoes(){
    ultima = $("#ultimaNotificacao").val();
    console.log("ultima = "+ultima)
    $.ajax({
            type: "POST",
            dataType: "json",
            url: "controller/verificaNotificacoes.php",
            data: { ultima:ultima },
            success: function(data){
                if(data.sucesso == true){
                    pegaNotificacoes();
                    $(".alert-notificacao").addClass("show");
                    audio.play();
                    setTimeout(function(){ $(".alert-notificacao").removeClass("show"); }, 5000);
                } else {

                }
            },
            error: function(e){
                console.log(e.message);
            }
    });  
}

function pegaNotificacoes(){
    $.ajax({
            type: "POST",
            dataType: "json",
            url: "controller/pegaNotificacoes.php",
            success: function(data){
                console.log(data)
                $(".notificacoes").html(data.html);
                $(".contagem").text(data.count);
            },
            error: function(e){
                console.log(e.message);
            }
    });  
}

$(document).ready(function(){
    pegaNotificacoes();
    setInterval(function(){ verificaNotificacoes(); }, 6000);
});
*/