<?php

/**
 * Description of SendEmail
 *
 * @author Fernando
 */
require_once 'PHPMailer-5.2.8/PHPMailerAutoload.php';
require_once 'EmailMessages.php';

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
        $this->mail->Body = EmailMessages::subscriptionConfirmationHTML($personName);
        $this->mail->AltBody = EmailMessages::subscriptionConfirmationNormal($personName);
        $this->mail->addAddress($address);
        if (!$this->mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
        return '';
    }

    public function sendOrderConfirmation($personName, $pedidoVO, $restaurantName, $date, $address) {
        $this->mail->Subject = 'Confirmação de pedido - Sabor Virtual';
        $this->mail->Body = EmailMessages::orderConfirmationHTML($personName, $pedidoVO, $restaurantName, $date);
        $this->mail->AltBody = EmailMessages::orderConfirmationNormal($personName, $restaurantName, $date);
        $this->mail->addAddress($address);
        if (!$this->mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

    public function sendContactEmail($name, $email, $message, $address = 'contato.saborvitual@gmail.com') {
        $this->mail->Subject = 'Contato';
        $this->mail->Body = EmailMessages::contactMessageHTML($name, $email, $message);
        $this->mail->AltBody = EmailMessages::contactMessageNormal($name, $email, $message);
        $this->mail->addAddress($address);
        if (!$this->mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

    public function sendPasswordRecoverEmail($personName, $link, $address) {
        $this->mail->Subject = $personName;
        $this->mail->Body = EmailMessages::recoverPasswordHTML($personName, $link);
        $this->mail->AltBody = EmailMessages::recoverPasswordNormal($personName, $link);
        $this->mail->addAddress($address);
        if (!$this->mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

}
