<?php
namespace Core;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../vendor/autoload.php';

class Email {
    public function send ($name, $email, $token, $password = NULL) {
        $mail = new PHPMailer(true);

        try {

            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sistemabdp@gmail.com';
            $mail->Password = 'melhordiretoria';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->CharSet="utf8";

            $mail->setFrom('sistemabdp@gmail.com', 'Banco de Provas');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);

            if (isset($password)) {
                $mail->Subject = 'Recuperação de Senha';
                $mail->Body    = "<p>Olá. Uma nova senha foi solicitada para sua conta no Banco de Prova.<br>
                                Sua nova senha de acesso é <i>{$password}</i>.<br>
                                Recomendamos que você altere sua senha.";
            } else {
                $mail->Subject = 'E-mail de Confirmação';
                $mail->Body    = "<p>Olá, {$name}. Seja bem vindo(a) ao nosso Banco de Provas.</p>
                <p>Seu email ainda não foi confirmado. Por favor, clique no link abaixo para confirmar o seu email.</p>
                <a href='http://{$_SERVER['HTTP_HOST']}/validation/{$token}'>http://{$_SERVER['HTTP_HOST']}/validation/{$token}</a><br><br>
                <center><b>Email automático de confirmação. Favor não responder.</b></center>";
            }
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

    }

}
