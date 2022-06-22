<?php

namespace core\controllers;

use core\classes\Store;

class Main
{
    public function index()
    {
        $data = [
            'titulo'    => APP_NAME . ' ' . APP_VERSION
        ];

        Store::layout([
            'layouts/html_header.php',
            'layouts/header.php',
            'inicio.php',
            'layouts/footer.php',
            'layouts/html_footer.html'
        ], $data);
    }

    public function loja()
    {
        echo 'loja';
    }
}