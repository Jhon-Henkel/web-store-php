<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\Mail;
use core\classes\Store;
use core\models\Client;
use Symfony\Component\Mime\Email;

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

        //envia o e-mail para o cliente
        $email = new Mail();
        $sendEmail = $email->sendEmailRegisterConfirm(strtolower(trim($_POST['cliente_email'])), $purl);

        if ($sendEmail) {
            echo 'email enviado';
        } else {
            echo 'aconteceu um erro';
        }

    }

    public function confirmMail()
    {
        if (Store::isClientLogged()) {
            $this->index();
            return;
        }

        //verifica se veio purl
        if (!isset($_GET['purl'])) {
            $this->index();
            return;
        }

        //valida o purl valido
        if (strlen($_GET['purl']) != 32) {
            $this->index();
            return;
        }

        $client = new Client();
        $clientConfirm = $client->validateRegister($_GET['purl']);

        if ($clientConfirm) {
            echo 'Conta verificada com sucesso!';
        } else {
            echo 'A conta não foi validada!';
        }
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