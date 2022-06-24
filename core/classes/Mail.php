<?php

namespace core\classes;

use Exception;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class Mail
{
    public function sendEmail($clientEmail, $contentSubject, $textContent, $htmlContent)
    {
        try {
            $transport = Transport::fromDsn('smtp.gmail.com');
            $mailer = new Mailer($transport);

            $email = (new Email())
                ->from('sys4soft.phpstore@gmail.com')
                ->to($clientEmail)
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject($contentSubject)
                ->text($textContent)
                ->html($htmlContent);

            $mailer->send($email);
        } catch (Exception $e) {
            echo "Mensagem não pode ser enviada!!!";
        }
    }
}