<?php

namespace core\controllers;

use core\classes\Functions;

class Main
{
    public function index()
    {
        $data = [
            'titulo'    => 'Título da página definido no método index',
            'clientes'  => ['João', 'Ana', 'Carlos']
        ];

        functions::layout([
            'layouts/html_header.html',
            'pagina_inicial.php',
            'layouts/html_footer.html'
        ], $data);
    }

    public function loja()
    {
        echo 'loja';
    }
}