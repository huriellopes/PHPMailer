<?php

/*
* Auhor: Huriel Lopes
* Description: Script de envio de e-mail em php com a função PHPMailer
* Create: 01/12/2017
*/

// Carrega as Classes do PHPMailer
require_once __DIR__ . "/PHPMailer/class.phpmailer.php";
require_once __DIR__ . "/PHPMailer/class.smtp.php";

//ini_set('display_errors','1');

sleep(1);

// Via Post
$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Inicializando o erro como true
$erro = true;

// Variaveis, Pegando os dados via post (Alterar como Desejado)
$nome       = $post['nome'];
$sobrenome  = $post['sobrenome'];
$email      = $post['email'];
$telefone   = $post['telefone'];
$uf         = $post['uf'];
$cidade     = $post['cidade'];
$assunto    = $post['tiposervico'];
$msg        = $post['mensagem'];


// Configuração do envio de e-mail
$mail = new PHPMailer; // Instancia 
$mail->CharSet = "UTF-8"; // Aceita Caracteres Especiais
//$mail->SMTPDebug = 3; // Debuga o SMTP (Descomente para debugar o PHPMailer)
$mail->IsSMTP(); // Seta o Tipo de Protocolo
$mail->Host = "Host SMPT"; // Define o Servidor SMTP
$mail->SMTPAuth = true; // Habilita a Autenticação via SMTP
$mail->Username = "contato@dominio.com.br"; // Usuário do SMTP (E-Mail Cadastrado no Servidor)
$mail->Password = "**************"; // Senha do SMTP (Senha do E-Mail Cadastrado no Servidor)
$mail->SMTPSecure = "tls"; // Tipo de Segurança
$mail->Port = 587; // Porta de Conexão
$mail->FromName = "{$nome}"; // Nome do Remetente
$mail->From = "contato@dominio.com.br"; // Email do Destino
$mail->AddAddress("contato@dominio.com.br"); // E-Mail que Recebera a Menssagem
$mail->IsHTML(true); //Formato da mensagem de e-mail
$mail->Subject = "Contato via Site: {$nome} "; // Assunto do E-Mail
$mail->Body = "<strong>Nome</strong>: {$nome} {$sobrenome}" . 
              "<br>" . 
              "<strong>Assunto</strong>: {$assunto}" . 
              "<br>" . 
              "<strong>E-Mail</strong>: {$email}" . 
              "<br>" . 
              "<strong>Cidade/Estado</strong>: {$cidade} " . "-" . " {$uf} " .
              "<br>" .
              "<strong>Telefone</strong>: {$telefone}" . 
              "<br><br>" .
              "<strong>Mensagem</strong>: " .
              "<br><br>" . 
              "<p>{$msg}</p>"; // Corpo do E-Mail


/* Verificação de envio */

// Atribui uma variavel!
$enviado = $mail->Send();

// Varefica o envio
if($enviado){
    $erro = false;
    echo json_encode($enviado); // Transforma em JSON, para fazer requisição ajax
    return true;
}else{
    return false;
}

?>