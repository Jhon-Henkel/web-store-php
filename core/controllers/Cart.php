<?php

namespace core\controllers;

use core\classes\Store;

class Cart
{
    public function addToCart()
    {
        $idPdt = $_GET['id_pdt'];
        $_SESSION[''] = $idPdt;

        echo 'Adicionado ao carrinho';
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