
$("#form-perfil").submit(function(e){
    e.preventDefault();
    formDados = $("#form-perfil").serialize();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "controller/perfil.php",
            data: formDados,
            processData: true,
            success: function(data){
                console.log(data)
                if(data.sucesso == true){
                   swal("Sucesso!", "Perfil atualizado com sucesso!", "success");
                } else {
                   swal("Erro!", "Ocorreu um erro! Tente novamente por favor.", "error");
                }
            }
        });  
});
function uploadImagem(elm){
    var file_data = $(elm).prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    form_data.append('tipo', 'usuario');
    $.ajax({
        url: 'controller/upload.php', 
        dataType: 'json', 
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(data){
           if(data.sucesso == true){
               $("#imagem").val(data.arquivo);
               $(".thumb-imagem").attr("src", "../imagens/usuarios/"+data.arquivo);
           } else {
               
           }
        }
    });
}
$('.botao-imagem').click(function(){
    $("#imagemUpload").click();
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