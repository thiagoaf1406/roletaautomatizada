$(document).ready(function() {
    $('#tabela').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'excel', 'pdf'
        ],
        columnDefs: [
            { className: 'text-right', targets: [3] },
        ],
        "processing": true,
        "serverSide": true,
        "ajax": "tabelas/usuarios.php",
        "language": {
            "url": "assets/js/traducao.json"
        },
    });
} );
$("#form-usuario").submit(function(e){
    e.preventDefault();
    formDados = $("#form-usuario").serialize();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "../controller/cms/usuario",
            data: formDados,
            processData: true,
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
function usuarioExcluir(id){
    id = id;
    swal({
        title: "Tem certeza que deseja mesmo Excluir?",
        text: "Essa ação será irreversível.",
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
                    url: "../controller/cms/usuarioExcluir",
                    data: { id: id },
                    processData: true,
                    success: function(data){
                        if(data.sucesso == true){
                           swal("Sucesso!", "Excluído com sucesso!", "success");
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
var SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
  onKeyPress: function(val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

$('.telefone').mask(SPMaskBehavior, spOptions);