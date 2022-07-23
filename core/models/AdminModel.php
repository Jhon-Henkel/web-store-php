<?php

namespace core\models;

use core\classes\Database;
use core\classes\Mail;
use Exception;

class AdminModel
{
    /**
     * @throws Exception
     */
    public function validateLoginAdmin($adminUser, $adminPass)
    {
        $params = [
            ':adminUser' => $adminUser,
        ];

        $db = new Database();
        $results = $db->select('
            SELECT * FROM admin_login 
            WHERE usuario_admin = :adminUser 
            AND deleted_at IS NULL', $params);

        if (count($results) == 0) {
            return false;
        } else {

            $adminUser = $results[0];

            if (!password_verify($adminPass, $adminUser->senha_admin)) {
                return false;
            }

            return $adminUser;
        }
    }

    /**
     * @throws Exception
     */
    public function countPendingOrders()
    {
        $db = new Database();
        $count = $db->select('SELECT count(*) total FROM pedidos WHERE status_pedido = 0');

        return $count[0]->total;
    }

    /**
     * @throws Exception
     */
    public function countPaidOrders()
    {
        $db = new Database();
        $count = $db->select('SELECT count(*) total FROM pedidos WHERE status_pedido = 1');

        return $count[0]->total;
    }

    /**
     * @throws Exception
     */
    public function listOrders($status): ?array
    {
        $db = new Database();
        $sql = 'SELECT * FROM pedidos p LEFT JOIN clientes c ON p.id_cliente = c.id_cliente';

        if ($status != '') {
            $sql .=' WHERE p.status_pedido = ' . $status;
        }

        $sql .= ' ORDER BY p.id_pedido DESC';

        return $db->select($sql);
    }

    /**
     * @throws Exception
     */
    public function listAllClients(): ?array
    {
        $db = new Database();
        return $db->select(
            'SELECT 
                    c.*, 
                    COUNT(p.id_pedido) totalPedidos 
                FROM clientes c 
                LEFT JOIN pedidos p 
                ON c.id_cliente = p.id_cliente
                GROUP BY c.id_cliente
            '
        );
    }

    /**
     * @throws Exception
     */
    public function getClientById($id): ?array
    {
        $db = new Database();
        $params = [
            ':id' => $id,
        ];

        return $db->select('SELECT * FROM clientes WHERE id_cliente = :id', $params);
    }

    /**
     * @throws Exception
     */
    public function countOrdersByClientId($id)
    {
        $db = new Database();
        $params = [
            ':id' => $id
        ];

        return $db->select('SELECT COUNT(*) total FROM pedidos WHERE id_cliente = :id', $params)[0]->total;
    }

    /**
     * @throws Exception
     */
    public function getOrdersByClientId($id): ?array
    {
        $db = new Database();
        $params = [
            ':id' => $id,
        ];

        return $db->select('SELECT * FROM pedidos WHERE id_cliente = :id', $params);
    }

    /**
     * @throws Exception
     */
    public function getOrdersByOrderId($id): ?array
    {
        $db = new Database();
        $params = [
            ':id' => $id
        ];

        return $db->select('SELECT * FROM pedidos WHERE id_pedido = :id', $params);
    }

    public function getProductsInOrderByOrderId($id): ?array
    {
        $db = new Database();
        $params = [
            ':id' => $id
        ];
        return $db->select('SELECT * FROM pedidos_produtos WHERE id_pedido = :id', $params);
    }

    public function getStatusString($status): string
    {
        switch ($status) {
            case ORDER_PENDENTE:
                return 'Pendente';
            case ORDER_PAGO:
                return 'Pago';
            case ORDER_FATURADO:
                return 'Faturado';
            case ORDER_ENVIADO:
                return 'Enviado';
            case ORDER_ENTREGUE:
                return 'Entregue';
            case ORDER_CANCELADO:
                return 'Cancelado';
        }
        return 'Status não definido';
    }

    /**
     * @throws Exception
     */
    public function setOrderStatus($status, $orderId)
    {
        $statusId = $this->getStatusId($status);

        $db = new Database();
        $params = [
            ':status' => $statusId,
            ':order'  => $orderId
        ];

        $db->update('UPDATE pedidos SET status_pedido = :status, updated_at = NOW() WHERE id_pedido = :order', $params);
    }

    /**
     * @throws Exception
     */
    public function getStatusId($strStatus): int
    {
        switch ($strStatus) {
            case 'Pendente':
                return ORDER_PENDENTE;
            case 'Pago':
                return ORDER_PAGO;
            case 'Faturado':
                return ORDER_FATURADO;
            case 'Enviado':
                return ORDER_ENVIADO;
            case 'Entregue':
                return ORDER_ENTREGUE;
            case 'Cancelado':
                return ORDER_CANCELADO;
        }
        throw new Exception('Status não definido');
    }

    public function getIconStatus($status)
    {
        switch ($status) {
            case 'Pendente':
                return '<i class="fa-solid fa-circle-exclamation"></i>';
            case 'Pago':
                return '<i class="fa-solid fa-sack-dollar"></i>';
            case 'Faturado':
                return '<i class="fa-solid fa-file-invoice-dollar"></i>';
            case 'Enviado':
                return '<i class="fa-solid fa-truck-arrow-right"></i>';
            case 'Entregue':
                return '<i class="fa-solid fa-clipboard-check"></i>';
            case 'Cancelado':
                return '<i class="fa-solid fa-ban"></i>';
        }
    }

    /**
     * @throws Exception
     */
    public function sendEmail($status, $orderId)
    {
        $mail = new Mail();
        $admin = new AdminModel();
        $order = $admin->getOrdersByOrderId($orderId);
        $clientMail = $order[0]->email_cliente;
        $orderCode = $order[0]->codido_pedido;

        switch ($status) {
            case 'Pendente':
                $mail->sendEmailOrderPending($clientMail, $orderCode);
                break;
            case 'Pago':
                $mail->sendEmailOrderPaid($clientMail, $orderCode);
                break;
            case 'Faturado':
                $mail->sendEmailOrderBilled($clientMail, $orderCode);
                break;
            case 'Enviado':
                $mail->sendEmailOrderSend($clientMail, $orderCode);
                break;
            case 'Entregue':
                $mail->sendEmailOrderFinish($clientMail, $orderCode);
                break;
            case 'Cancelado':
                $mail->sendEmailOrderCanceled($clientMail, $orderCode);
        }
    }
}