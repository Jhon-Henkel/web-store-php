<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\Store;
use core\models\Client;

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

        $client = new Client();

        if ($client->validateEmail($_POST['cliente_email'])) {
            $_SESSION['error'] = 'E-mail já cadastrado na base de dados!';
            $this->registerClient();
            return;
        }

        $purl = $client->insertClient();

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