<?php

namespace core\models;

use core\classes\Database;
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
}