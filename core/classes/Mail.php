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

    /**
     * @throws Exception
     */
    public function sendEmailOrderConfirmed($clientMail, $orderData)
    {
        $subject = APP_NAME . ' Confirmação de pedido ' . $orderData['pagamento']['orderCode'];
        $content = '<p>Este e-mail serve para confirmar seu pedido</p>';
        $content .= '<p>Dados do pedido:</p>';
        $content .= '<ul>';
        foreach ($orderData['produtos'] as $produto) {
            $content .= '<ul>' . $produto . '</ul>';
        }
        $content .= '</ul>';
        $content .= '<p>Total: <strong>' . $orderData['total'] . '</strong></p>';
        $content .= '<hr>';
        $content .= '<p>Dados de pagamento: <strong>' . $orderData['pagamento']['pix'] . '</strong></p>';
        $content .= '<p>Código do pedido: <strong>' . $orderData['pagamento']['orderCode'] . '</strong></p>';
        $content .= '<p>Valor a pagar: <strong>' . $orderData['total'] . '</strong></p>';
        $content .= '<p>O seu pedido só será processado após a confirmação de pagamento.</p>';
        $content .= '<hr>';

        self::sendEmail($clientMail, $subject, $content);
    }

    /**
     * @throws Exception
     */
    public function sendEmailOrderPending($clientMail, $orderId)
    {
        $subject = APP_NAME . ' - Pedido '. $orderId . ' pendente';
        $content = '<p>Informamos que por algum motivo o seu pedido retornou para o status pendente</p>';
        $content .= '<p>Verifique se o pagamento está concluído, caso sim, entre em contato com nossa equipe</p>';
        $content .= '<p>Até breve ;)</p>';
        $content .= '<p>Att. equipe </p>' . APP_NAME;

        self::sendEmail($clientMail, $subject, $content);
    }

    /**
     * @throws Exception
     */
    public function sendEmailOrderPaid($clientMail, $orderId)
    {
        $subject = APP_NAME . ' - Pedido '. $orderId . ' pago';
        $content = '<p>Muito obrigado poor efetuar o seu pagamento ;)</p>';
        $content .= '<p>Logo seu pedido será faturado o estará pronto para despacho</p>';
        $content .= '<p>Não se preocupe, assim que tivermos novas movimentações iremos te notificar</p>';
        $content .= '<p>Até breve ;)</p>';
        $content .= '<p>Att. equipe </p>' . APP_NAME;

        self::sendEmail($clientMail, $subject, $content);
    }

    /**
     * @throws Exception
     */
    public function sendEmailOrderBilled($clientMail, $orderId)
    {
        $subject = APP_NAME . ' - Pedido '. $orderId . ' faturado';
        $content = '<p>Seu pedido se encontra faturado e em breve será despachado!</p>';
        $content .= '<p>Não se preocupe, assim que tivermos novas movimentações iremos te notificar</p>';
        $content .= '<p>Até breve ;)</p>';
        $content .= '<p>Att. equipe </p>' . APP_NAME;

        self::sendEmail($clientMail, $subject, $content);
    }

    /**
     * @throws Exception
     */
    public function sendEmailOrderSend($clientMail, $orderId)
    {
        $subject = APP_NAME . ' - Pedido '. $orderId . ' enviado';
        $content = '<p>Seu pedido se encontra enviado e em breve estará com você!</p>';
        $content .= '<p>Não se preocupe, assim que tivermos novas movimentações iremos te notificar</p>';
        $content .= '<p>Até breve ;)</p>';
        $content .= '<p>Att. equipe </p>' . APP_NAME;

        self::sendEmail($clientMail, $subject, $content);
    }

    /**
     * @throws Exception
     */
    public function sendEmailOrderFinish($clientMail, $orderId)
    {
        $subject = APP_NAME . ' - Pedido '. $orderId . ' entregue';
        $content = '<p>Seu pedido se encontra entregue espero que tenha gostado!</p>';
        $content .= '<p>Gratos pela preferencia ;)</p>';
        $content .= '<p>Att. equipe </p>' . APP_NAME;

        self::sendEmail($clientMail, $subject, $content);
    }

    /**
     * @throws Exception
     */
    public function sendEmailOrderCanceled($clientMail, $orderId)
    {
        $subject = APP_NAME . ' - Pedido '. $orderId . ' cancelado';
        $content = '<p>Seu pedido se encontra cancelado!</p>';
        $content .= '<p>Estamos esperando você fazer um novo pedido.</p>';
        $content .= '<p>Até breve ;)</p>';
        $content .= '<p>Att. equipe </p>' . APP_NAME;

        self::sendEmail($clientMail, $subject, $content);
    }
}