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
                    setTimeout(function(){ location.href="dashboard" }, 2000);
                } else {
                    swal("Algo deu errado!", "Verifique E-mail/Senha e tente novamente!", "error");
                }
            },
            error: function(e){
                console.log(e.message);
            }
    });  
});  