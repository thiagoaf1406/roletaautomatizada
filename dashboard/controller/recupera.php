<?php
require_once '../../../classes/config.php';

$email = isset($_POST["email"]) ? addslashes(trim($_POST["email"])) : '';

$usuarios = Usuario::find(0, array("email = '".$email."'"));

if(count($usuarios) == 1) {

    $senha = base64_decode($usuarios[0]->senha);
    
    $msg = '<!doctype html>
    <html lang="pt-br">
    <head>
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <meta charset="UTF-8">
    <style>
    a, a:visited {text-decoration: none; }
    body {background: #fff;color: #ddd000;}
    table {
    	background: #f1f1f8;
    	overflow: hidden;
    	-webkit-border-radius: 5px;
    	-moz-border-radius: 5px;
    	border-radius: 5px;
    }
    .botao {
    	color: #fff;
    	text-transform: uppercase;
    	background: #0066b3;
    	padding: 5px;
    	margin-left: 0px;
    }
    .botao:hover { background: #2d4562; }
    </style>
    </head>
    <body>
    <table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <td width="170" rowspan="4" align="center" style="padding-top: 25px"><a href="" target="_blank" style="padding-left: 30px"><img width="119" height="40" src="https://roletaautomatizada2.com/admin/assets/images/logo/roleta.png" /></a> </td>
        </tr>
        <tr>
          <td width="470" colspan="2"></td>
        </tr>
        <tr>
          <td colspan="2" style="font-size: 18px; color: #333; height: 25px; text-align: center; font-family: Arial, Helvetica, sans-serif;">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center"><span style="font-size: 18px; color: #333; height: 25px; text-align: center; font-family: Arial, Helvetica, sans-serif;"><strong>Cassino Roleta</strong></span></td>
        </tr>
        <tr>
          <td colspan="2"><br></td>
        </tr>
        <tr>
          <td colspan="2" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 17px; color: #333; padding: 20px 20px 0px 20px;">Recuperação de senha:</td>
        </tr>
        <tr>
          <td colspan="2"><br></td>
        </tr>
        <tr>
          <td colspan="2" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 20px; color: #333; padding: 0px 20px 0px 20px;"><strong style="color: #2d4562">Senha:</strong> "' . $senha . '"</td>
        </tr>
        <tr>
          <td colspan="2"><br></td>
        </tr>
        <tr>
          <td colspan="2"><br></td>
        </tr>
        <tr>
          <td colspan="2"><br></td>
        </tr>
        <tr>
          <td colspan="2" style="font-size: 11px; color: #fff; text-align: center; padding: 15px 0px; font-family: Arial, Helvetica, sans-serif; background: #2d4562;">© Copyright Cassino Roleta - Todos os Direitos Reservados.</td>
        </tr>
      </tbody>
    </table>
    </body>
    </html>';
    
    $subject = '[ Cassino Roleta ] Recuperação de Senha';
    $mail = new PHPMailer();
    $mail->IsMail(true);
    $mail->SetFrom('mensagem@roletaautomatizada2.com', 'Cassino Roleta');
    $mail->AddAddress($usuarios[0]->email, $usuarios[0]->nome);
    $mail->IsHTML(true);
    $mail->CharSet = 'utf-8';
    $mail->Subject = $subject;
    $mail->MsgHTML($msg);
    $enviado = $mail->Send();
    $mail->ClearAllRecipients();
    $mail->ClearAttachments();

	if($enviado){
	    $data['sucesso'] = true;
	} else {
	    $data['sucesso'] = false;
	}
} else {
    $data['sucesso'] = false;
}

echo json_encode($data);
?>