<?php

namespace core\controllers;

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

        //criação do novo cliente
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