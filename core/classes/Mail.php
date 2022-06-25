<?php

namespace core\classes;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail
{
    /**
     * @throws Exception
     */
    public function sendEmail($clientEmail, $subject, $content)
    {
        //não funciona para origem gmail
        $mail = new PHPMailer(true);

        try {
            //server settings
            $mail->SMTPDebug    = SMTP::DEBUG_OFF;
            $mail->CharSet      = 'UTF-8';
            $mail->isSMTP();
            $mail->Host         = EMAIL_HOST;
            $mail->SMTPAuth     = true;
            $mail->Username     = EMAIL_FROM;
            $mail->Password     = EMAIL_PASSWORD;
            $mail->SMTPSecure   = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port         = EMAIL_PORT;

            //envio
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($clientEmail);

            //conteúdo
            $mail->isHTML(true);
            $mail->Subject  = $subject;
            $mail->Body     = $content;

            $mail->send();
        } catch (Exception $e) {
            throw new Exception('Mensagem não pode ser enviada', $e);
        }
    }

    /**
     * @throws Exception
     */
    public function sendEmailRegisterConfirm($clientEmail, $purl)
    {
        $link = BASE_URL . '?pagina=confirmar_email&purl=' . $purl;

        $subject = APP_NAME . ' - Confirmação de cadastro';
        $content = '<p>Seja bem-vindo a nossa loja ' . APP_NAME . '.</p>';
        $content.= '<p>Para confirmar seu e-mail, clique no link abaixo</p>';
        $content.= '<p><a href="' . $link . '">Confirmar e-mail</a></p>';
        $content.= '<p><i><small>' . APP_NAME . '</small></i></p>';

        self::sendEmail($clientEmail, $subject, $content);

        return true;
    }
}