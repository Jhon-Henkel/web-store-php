<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\Store;

class Main
{
    public function index()
    {
        Store::layout([
            'layouts/html_header.php',
            'layouts/header.php',
            'inicio.php',
            'layouts/footer.php',
            'layouts/html_footer.html'
        ]);
    }

    public function store()
    {
        Store::layout([
            'layouts/html_header.php',
            'layouts/header.php',
            'loja.php',
            'layouts/footer.php',
            'layouts/html_footer.html'
        ]);
    }

    public function registerClientForm()
    {
        if (Store::isClientLogged()) {
            $this->index();
            return;
        }

        Store::layout([
            'layouts/html_header.php',
            'layouts/header.php',
            'cliente_cadastro.php',
            'layouts/footer.php',
            'layouts/html_footer.html'
        ]);
    }

    /**
     * @throws \Exception
     */
    public function registerClient()
    {
        if (Store::isClientLogged()) {
            $this->index();
            return;
        }

        //valida se foi feito uma requisição diferente de post
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        //verifica senhas
        if ($_POST['cliente_senha1'] !== $_POST['cliente_senha2']) {
            $_SESSION['error'] = 'As senhas não são iguais!';
            $this->registerClient();
            return;
        }

        //valida se e-mail ja existe
        $db = new Database();
        $params = [
            ':email' => strtolower(trim($_POST['cliente_email']))
        ];
        $results = $db->select('SELECT email_cliente FROM clientes WHERE email_cliente = :email', $params);

        if (count($results) != 0) {
            $_SESSION['error'] = 'E-mail já cadastrado na base de dados!';
            $this->registerClient();
            return;
        }

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

        //criar o link purl para enviar por e-mail
        $link_purl = 'https://loja.com.br/?pagina=confirmar_email&purl=' . $purl;

        die('cadastrado');
    }

    public function cart()
    {
        Store::layout([
            'layouts/html_header.php',
            'layouts/header.php',
            'carrinho.php',
            'layouts/footer.php',
            'layouts/html_footer.html'
        ]);
    }
}