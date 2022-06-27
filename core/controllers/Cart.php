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
        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
            $data = ['cart' => null];
        } else {
            $ids = array();
            foreach ($_SESSION['cart'] as $id => $qtd) {
                $ids[] = $id;
            }

            $ids = implode(',', $ids);

            $product = new Product();
            $results = $product->searchProductsIds($ids);

            $data = array();
            foreach ($_SESSION['cart'] as $idPdt => $qtdTmp) {
                foreach ($results as $product) {
                    if ($product->id_pdt == $idPdt) {

                        $image = $product->imagem_pdt;
                        $title = $product->nome_pdt;
                        $qtd = $qtdTmp;
                        $price = $product->preco_pdt * $qtd;

                        $data[] = [
                            'imagem' => $image,
                            'title' => $title,
                            'qtd' => $qtd,
                            'price' => $price
                        ];
                        break;
                    }
                }
            }

            $totalPrice = 0;

            foreach ($data as $item) {
                $totalPrice += $item['price'];
            }

            $data['total'] = $totalPrice;
            d($data);
        }

        Store::layout([
            'layouts/html_header.php',
            'layouts/header.php',
            'carrinho.php',
            'layouts/footer.php',
            'layouts/html_footer.html'
        ], $data);
    }
}