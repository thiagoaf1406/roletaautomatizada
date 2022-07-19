$(function(){
    $('#imagem').change(function(){
        var input = this;
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if(input.files[0].size > 600000){
           $('#imagem').val('');
           $('#img').attr('src', 'https://bordacomunicacao.com.br/painel/assets/images/avatars/avatar.jpg');
           swal("Erro!", "Imagem maior do que o permitido! (600kb)", "error");
           return false;
        } else {
            console.log(input.files[0].size)
        }
        if(input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();
            reader.onload = function (e) {
               $('#img').attr('src', e.target.result);
            }
           reader.readAsDataURL(input.files[0]);
        } else {
            $('#img').attr('src', 'https://bordacomunicacao.com.br/painel/assets/images/avatars/avatar.jpg');
        }
    });
    
    $('#geral').click(function(event) {
        if(this.checked) {
            $('.check-niveis').each(function() {
                this.checked = true;       
                this.value = 'Sim';
            });
        }else{
            $('.check-niveis').each(function() {
                this.checked = false; 
                this.value = 'Não';
            });         
        }
    });
  
    $('.check-niveis').click(function(e){
        if($(this).is(':checked')){
              $(this).val("Sim");
        } else {
              $(this).val("Não");
        }
    });
    $('.check-unidades').click(function(e){
        if($(this).is(':checked')){
              $(this).val("Sim");
        } else {
              $(this).val("Não");
        }
    });
    
});

$("#form-usuario").submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "controller/form-usuario.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data)
                if(data.sucesso == true){
                   swal("Sucesso!", "Usuário salvo com sucesso!", "success");
                   setTimeout(function(){ location.href="usuarios" }, 3000);
                } else {
                   swal("Erro!", "Ocorreu um erro! Tente novamente por favor.", "error");
                }
            }
        });  
});

$('.rg').mask('99.999.999-9');
$('.cep').mask('00000-000');
$('.cpf').mask('000.000.000-00', {reverse: true});
$('.date').mask('00/00/0000');

var SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
  onKeyPress: function(val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

$('.telefone').mask(SPMaskBehavior, spOptions);
