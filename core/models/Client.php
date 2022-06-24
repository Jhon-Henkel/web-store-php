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
                NOW(),
                null
            )
        ", $params);

        return $purl;
    }

}