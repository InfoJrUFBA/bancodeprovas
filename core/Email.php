<?php

namespace Core;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


include '../vendor/autoload.php';


class Email{

    public function send ($name, $email, $token) {

        $mail = new PHPMailer(true);
        try {

            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com.';
            $mail->SMTPAuth = true;
            $mail->Username = 'sistemabdp@gmail.com';
            $mail->Password = 'melhordiretoria';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->CharSet="utf8";

            $mail->setFrom('sistemabdp@gmail.com', 'Equipe de suporte');
            $mail->addAddress($_POST["email"], $_POST["name"]);

            $mail->isHTML(true);
            $mail->Subject = 'E-mail de confirmação';
            $mail->Body    = "<p>Olá, " . $_POST["name"] . ". Seja bem vindo(a) ao nosso Banco de Provas.</p>
            <p>Seu email ainda não foi confirmado. Por favor, clique no link abaixo para confirmar o seu email.</p>
            <a href='http://localhost:8000/validation/" . $token . "'>http://localhost:8000/validation/". $token . ".</a>
            <center><b>Email automático de confirmação. Favor não responder.</b></center>";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

    }

}
