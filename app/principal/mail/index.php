<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'PHPMailer.php';
use PHPMailer\PHPMailer\PHPMailer;
include 'SMTP.php';
include 'Exception.php';


// Inicia a classe PHPMailer
$mail = new PHPMailer;
 
// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem será SMTP
 
try {
     $mail->Host = 'smtp.gmail.com'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
     $mail->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
     $mail->Port       = 587; //  Usar 587 porta SMTP
     $mail->SMTPSecure = 'tls';
     $mail->SMTPAutoTLS= true;
     $mail->Username = 'danielmaia150@gmail.com';    // Usuário do servidor SMTP (endereço de email)
     $mail->Password = base64_decode("ZEYlJWJiMDc5MQ==");   // Senha do servidor SMTP (senha do email usado)
     
 
     $mail->SMTPOptions = array(
       'ssl' => array(
         'verify_peer' => false,
         'verify_peer_name' => false,
         'allow_self_signed' => true
       )
    );
     
     //Define o remetente
     // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=    

     $mail->SetFrom('71500430@aluno.faculdadecotemig.br ', 'Nome do remetente'); //Seu e-mail
     //$mail->AddReplyTo('XXXX ', 'Nome do remetente'); //Seu e-mail
     $mail->Subject = 'Assunto teste novo';//Assunto do e-mail
 
 
     //Define os destinatário(s)
     //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     $mail->AddAddress('danielmaia150@gmail.com');
 
     //Campos abaixo são opcionais 
     //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     //$mail->AddCC('destinarario@dominio.com.br', 'Destinatario'); // Copia
     //$mail->AddBCC('destinatario_oculto@dominio.com.br', 'Destinatario2`'); // Cópia Oculta
     //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo
 
 
     //Define o corpo do email
     $mail->MsgHTML('corpo do email'); 
 
     ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
     //$mail->MsgHTML(file_get_contents('arquivo.html'));
     $mail->SMTPDebug = 2;
     $mail->Send();
     echo "Mensagem enviada com sucesso</p>".$mail->ErrorInfo."\n";
 
    //caso apresente algum erro é apresentado abaixo com essa exceção.
    }catch (phpmailerException $e) {
      echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
}
?>
