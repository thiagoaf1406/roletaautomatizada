<?php
    if(0 < $_FILES['file']['error']){
        $data['sucesso'] = false;
    } else {
        if($_REQUEST['tipo'] == 'ebook'){
            move_uploaded_file($_FILES['file']['tmp_name'], '../../../arquivos/'.$_FILES['file']['name']);
        }
        if($_REQUEST['tipo'] == 'imagemEbook'){
            move_uploaded_file($_FILES['file']['tmp_name'], '../../../imagens/ebooks/'.trim($_FILES['file']['name']));
        }
        if($_REQUEST['tipo'] == 'portfolio'){
            move_uploaded_file($_FILES['file']['tmp_name'], '../../../imagens/portfolio/'.trim($_FILES['file']['name']));
        }
        if($_REQUEST['tipo'] == 'post'){
            move_uploaded_file($_FILES['file']['tmp_name'], '../../../imagens/posts/'.trim($_FILES['file']['name']));
        }
        if($_REQUEST['tipo'] == 'usuario'){
            move_uploaded_file($_FILES['file']['tmp_name'], '../../imagens/usuarios/'.trim($_FILES['file']['name']));
        }
        if($_REQUEST['tipo'] == 'solucao'){
            move_uploaded_file($_FILES['file']['tmp_name'], '../../../imagens/tarjas/'.trim($_FILES['file']['name']));
        }
        $data['tipo'] = $_REQUEST['tipo'];
        $data['arquivo'] = trim($_FILES['file']['name']);
        $data['sucesso'] = true;
    }
    echo json_encode($data);
?>