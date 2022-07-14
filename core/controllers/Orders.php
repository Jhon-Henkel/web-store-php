<?php

namespace core\controllers;

use core\classes\Database;
use Exception;

class Orders
{
    /**
     * @throws Exception
     */
    public function saveOrder($orderData, $productsData)
    {
        $db = new Database();
        $params = [
            ':id_cliente'       => $orderData['id_cliente'],
            ':endereco_entrega' => $orderData['endereco'],
            ':cidade_entrega'   => $orderData['cidade'],
            ':email_cliente'    => $orderData['email'],
            ':telefone_cliente' => $orderData['telefone'],
            ':codido_pedido'    => $orderData['cod_pedido'],
            ':status_pedido'    => $orderData['status'],
            ':observacoes'      => $orderData['msg'],
        ];

        $db->insert('
            INSERT INTO pedidos VALUES (
                0,
                :id_cliente,
                :endereco_entrega,
                NOW(),
                :cidade_entrega,
                :email_cliente,
                :telefone_cliente,
                :codido_pedido,
                :status_pedido,
                :observacoes,
                NOW(),
                null,
                null
            )', $params);

        $idOrder = $db->select('SELECT MAX(id_pedido) AS id_pedido FROM pedidos')[0]->id_pedido;

        foreach ($productsData as $productData) {
            $params = [
            ':id_pedido'        => $idOrder,
            ':nome_produto'     => $productData['nome'],
            ':valor_unitario'   => $productData['valorUnd'],
            ':quantidade'       => $productData['quantidade'],
        ];

        $db->insert('
            INSERT INTO pedidos_produtos VALUES (
                0,
                :id_pedido,
                :nome_produto,
                :valor_unitario,
                :quantidade,
                NOW()
            )', $params);
        }
    }

    /**
     * @throws Exception
     */
    public function searchOrders($idClient): array
    {
        $params = [
            ':id' => $idClient
        ];

        $db = new Database();
        return $db->select('SELECT * FROM pedidos WHERE id_cliente = :id ORDER BY data_pedido DESC', $params);
    }

    /**
     * @throws Exception
     */
    public function searchOrderByClientById($clientId, $orderId)
    {
        $params = [
            ':idClient' => $clientId,
            ':idOrder'  => $orderId
        ];

        $db = new Database();
        $order = $db->select('SELECT * FROM pedidos WHERE id_pedido = :idOrder AND id_cliente = :idClient', $params);

        if (count($order) == 1) {
            $params = [':idOrder' => $orderId];
            $itens = $db->select('SELECT * FROM pedidos_produtos WHERE id_pedido = :idOrder', $params);
            return [
                'order' => $order[0],
                'itens' => $itens
            ];
        }

        return null;
    }

    /**
     * @throws Exception
     */
    public function checkOrderStatus($codOrder) :array
    {
        $params = [
            ':cod' => $codOrder,
        ];

        $db = new Database();
        return $db->select('SELECT status_pedido FROM pedidos WHERE codido_pedido = :cod', $params);
    }

    /**
     * @throws Exception
     */
    public function setStatusPaidOut($codOrder): bool
    {
        $params = [
            ':cod' => $codOrder,
        ];
        $db = new Database();

        $db->update("UPDATE pedidos SET status_pedido = '" . ORDER_PAGO . "', updated_at = NOW() WHERE codido_pedido = :cod", $params);

        return true;
    }
}