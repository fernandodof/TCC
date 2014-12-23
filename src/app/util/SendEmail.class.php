<?php

/**
 * Description of SendEmail
 *
 * @author Fernando
 */
require_once 'PHPMailer-5.2.8/PHPMailerAutoload.php';

class SendEmail {

    private $mail;

    public function __construct() {
        $this->setUpMail();
    }

    private function setUpMail() {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'contato.saborvitual@gmail.com';
        $this->mail->Password = 'saborvirtual!@#$%';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;
        $this->mail->CharSet = "UTF-8";

        $this->mail->From = 'contato.saborvirtual@saborvirtual.com';
        $this->mail->FromName = 'Sabor Virtual';
        $this->mail->addReplyTo('contato.saborvirtual@saborvirtual.com', 'Sabor Virtual');
        $this->mail->isHTML();
    }

    public function sendSubscribeConfirmation($personName, $address) {
        $this->mail->Subject = 'Confirmação de Cadastro - Sabor Virtual';
        $this->mail->Body = "<!DOCTYPE html>
                            <html>
                                <head>
                                    <title>Confirmaçao de cadastro</title>
                                    <meta charset='UTF-8'>
                                    <meta name='viewport' content='width=device-width', initial-scale=1.0>
                                </head>
                                <body>
                                    <div style='text-align: center; margin: 0 auto;'>
                                        <img style='width: 150px; width: 150px;' src='http://i62.tinypic.com/3093c02.png' alt='logo'>

                                        <h4 style='margin-top: 40px;
                                                   width: 100%;
                                                   clear: left;
                                                   float: left;'>
                                            Sabor Virtual - Cadastro realizado com sucesso</h4>

                                        <h4>Olá <strong>" . $personName . "</strong>, O seu cadastro no Sabor Virtual foi realizado com sucesso !</h4>

                                     </div>
                                </body>
                            </html>";
        $this->mail->AltBody = "Olá " . $personName . ", O seu cadastro no Sabor Virtual foi realizado com sucesso !";
        $this->mail->addAddress($address);
        if (!$this->mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

}
