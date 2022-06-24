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
            ":email"    => strtolower(trim($_POST['cliente_email'])),
            ":password" => trim(password_hash($_POST['cliente_senha1'], PASSWORD_BCRYPT)),
            ":nome"     => trim($_POST['cliente_nome']),
            ":endereço" => trim($_POST['cliente_endereco']),
            ":cidade"   => trim($_POST['cliente_cidade']),
            ":telefone" => trim($_POST['cliente_telefone']),
            ":purl"     => $purl,
            ":status"   => 0
        ];

        $db->insert("
            INSERT INTO clientes (
                email_cliente,                  
                senha_cliente,                  
                nome_cliente,                  
                endereco_cliente,                  
                cidade_cliente,                  
                telefone_cliente,                  
                purl_cliente,                  
                status_cliente                  
            )VALUES(
                :email,
                :password,
                :nome,
                :endereco,
                :cidade,
                :telefone,
                :purl,
                :status
            )
        ", $params);

        return $purl;
    }

}