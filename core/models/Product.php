<?php

namespace core\models;

use core\classes\Database;

class Product
{
    public function productList()
    {
        $db = new Database();
        $product = $db->select('SELECT * FROM produtos WHERE status_pdt = 1');

        return $product;
    }
}