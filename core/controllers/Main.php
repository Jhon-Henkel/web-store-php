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
        if ($_SERVER['REQUEST_METHOD'] != 'post') {
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
        $results = $db->select('SELECT email FROM clientes WHERE email = :email', $params);

        if (count($results) != 0) {
            $_SESSION['error'] = 'E-mail já cadastrado na base de dados!';
            $this->registerClient();
            return;
        }

        
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