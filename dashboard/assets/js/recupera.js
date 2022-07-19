 $("#form-recupera").submit(function(e){
    e.preventDefault();
    dadosLogin = $("#form-recupera").serialize();
    $.ajax({
            type: "POST",
            dataType: "json",
            url: "controller/recupera.php",
            data: dadosLogin,
            success: function(data){
                console.log(data)
                if(data.sucesso == true){
                    swal("Sucesso!", "Sua senha foi enviada para o E-mail.", "success");
                    setTimeout(function(){ location.href="https://academiakorpus.com.br/tv/cms/" }, 1500);
                } else {
                    swal("Algo deu errado!", "Verifique o E-mail e tente novamente!", "error");
                }
            },
            error: function(e){
                console.log(e.message);
            }
    });  
});  