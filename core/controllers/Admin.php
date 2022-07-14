<?php

namespace core\controllers;

use core\classes\Store;
use Exception;

class Admin
{
    /**
     * @throws Exception
     */
    public function index()
    {
        Store::layoutAdmin([
            'admin/layouts/html_header.php',
            'admin/layouts/header.php',
            'admin/home.php',
            'admin/layouts/footer.php',
            'admin/layouts/html_footer.html'
        ]);
    }
}