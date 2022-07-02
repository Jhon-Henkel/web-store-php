<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Client
{

    public function validateEmail($email)
    {
        $db         = new Database();
        $params     = [':email' => strtolower(trim($email))];
        $results    = $db->select('SELECT email_cliente FROM clientes WHERE email_cliente = :email', $params);

        if (count($results) != 0) {
            return true;
        }
        return false;
    }

    public function insertClient()
    {
        $db = new  Database();

        $purl = Store::generateMd5UniqId();

        $params = [
            ":email_cliente"    => strtolower(trim($_POST['cliente_email'])),
            ":senha_cliente"    => trim(password_hash($_POST['cliente_senha1'], PASSWORD_BCRYPT)),
            ":nome_cliente"     => trim($_POST['cliente_nome']),
            ":endereco_cliente" => trim($_POST['cliente_endereco']),
            ":cidade_cliente"   => trim($_POST['cliente_cidade']),
            ":telefone_cliente" => trim($_POST['cliente_telefone']),
            ":purl_cliente"     => $purl,
            ":status_cliente"   => 0
        ];

        $db->insert("
            INSERT INTO clientes VALUES(
                0,
                :email_cliente,
                :senha_cliente,
                :nome_cliente,
                :endereco_cliente,
                :cidade_cliente,
                :telefone_cliente,
                :purl_cliente,
                :status_cliente,
                NOW(),
                null,
                null
            )
        ", $params);

        return $purl;
    }

    public function validateRegister($purl)
    {
        $db = new Database();
        $params = [':purl' => $purl];
        $result = $db->select('SELECT * FROM clientes WHERE purl_cliente = :purl', $params);

        if (count($result) != 1) {
            return false;
        }

        $idClient = $result[0]->id_cliente;

        $params = [
            ':idCliente' => $idClient
        ];
        $db->update('UPDATE clientes 
                SET 
                    status_cliente = 1, 
                    purl_cliente = null, 
                    data_modificacao = NOW() 
                WHERE 
                    id_cliente = :idCliente', $params);

        return true;
    }

    public function validateLogin($user, $pass)
    {
        $params = [
            ':user' => $user,
        ];

        $db = new Database();
        $results = $db->select('
            SELECT * FROM clientes 
            WHERE email_cliente = :user 
            AND status_cliente = 1
            AND data_delete IS NULL', $params);

        if (count($results) == 0) {
            return false;
        } else {

            $user = $results[0];

            if (!password_verify($pass, $user->senha_cliente)) {
                return false;
            }

            return $user;
        }
    }

    public function searchClient($client)
    {
        $db = new Database();

        $params = [
            ':id_client' => $client
        ];

        $results = $db->select('SELECT * FROM clientes WHERE id_cliente = :id_client', $params);
        return $results[0];
    }
}