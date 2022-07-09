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
}