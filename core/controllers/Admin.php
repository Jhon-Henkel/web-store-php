<?php

namespace core\controllers;

use core\classes\Store;
use core\models\AdminModel;
use Exception;

class Admin
{
    /**
     * @throws Exception
     */
    public function index()
    {
        if (!Store::isAdminLogged()) {
            Store::redirect('admin-login', true);
            return;
        }

        Store::layoutAdmin([
            'admin/layouts/html_header.php',
            'admin/layouts/header.php',
            'admin/home.php',
            'admin/layouts/footer.php',
            'admin/layouts/html_footer.html'
        ]);
    }

    /**
     * @throws Exception
     */
    public function adminLogin()
    {
        if (Store::isAdminLogged()) {
            Store::redirect('inicio', true);
            return;
        }

        Store::layoutAdmin([
            'admin/layouts/html_header.php',
            'admin/layouts/header.php',
            'admin/admin_login.php',
            'admin/layouts/footer.php',
            'admin/layouts/html_footer.html'
        ]);
    }

    /**
     * @throws Exception
     */
    public function adminLoginSubmit()
    {
        if (Store::isAdminLogged()) {
            Store::redirect('inicio', true);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect('inicio', true);
            return;
        }

        if (
            !isset($_POST['adminLogin'])
            || !isset($_POST['adminPass'])
        ) {
            $_SESSION['error'] = 'Login ou senha inválido, tente novamente';
            Store::redirect('admin-login', true);
            return;
        }

        $adminUser = (trim($_POST['adminLogin']));
        $adminPass = $_POST['adminPass'];

        $admin = new AdminModel();
        $isValid = $admin->validateLoginAdmin($adminUser, $adminPass);

        if (!$isValid) {
            $_SESSION['error'] = 'Login Inválido';
            Store::redirect('admin-login', true);
            return;
        }

        $_SESSION['admin']  = $isValid->id_admin;
        $_SESSION['user']   = $isValid->usuario_admin;

        Store::redirect('inicio', true);
    }
}