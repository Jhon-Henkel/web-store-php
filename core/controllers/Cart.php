<?php

namespace core\controllers;

use core\classes\Store;
use core\models\Product;

class Cart
{
    public function addToCart()
    {
        if (!isset($_GET['id_pdt'])) {
            echo $_SESSION['cart'] ?? 0;
            return;
        }

        $idPdt      = $_GET['id_pdt'];
        $cart       = array();
        $product    = new Product();
        $results    = $product->validateStockProduct($idPdt);

        if (!$results) {
            echo $_SESSION['cart'] ?? 0;
            return;
        }

        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        }

        if (key_exists($idPdt, $cart)) {
            $cart[$idPdt] ++;
        } else {
            $cart[$idPdt] = 1;
        }

        $_SESSION['cart'] = $cart;

        $totalPdt = 0;
        foreach ($cart as $pdt) {
            $totalPdt += $pdt;
        }

        echo $totalPdt;
    }

    public function cleanCart()
    {
        unset ($_SESSION['cart']);
        $this->cart();
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