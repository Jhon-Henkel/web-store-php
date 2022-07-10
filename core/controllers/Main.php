<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\Mail;
use core\classes\Store;
use core\models\Client;
use core\models\Product;
use Exception;

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
        $product     = new Product();
        $productList = $product->productList($_GET['c'] ?? 'todos');
        $categories  = $product->searchCategories();

        Store::layout([
            'layouts/html_header.php',
            'layouts/header.php',
            'loja.php',
            'layouts/footer.php',
            'layouts/html_footer.html'
        ], [
            'products'  => $productList,
            'categories'=> $categories,
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
     * @throws Exception
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

            Store::layout([
                'layouts/html_header.php',
                'layouts/header.php',
                'cliente_cadastro_sucesso.php',
                'layouts/footer.php',
                'layouts/html_footer.html'
            ]);
            return;

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

            Store::layout([
                'layouts/html_header.php',
                'layouts/header.php',
                'cliente_cadastro_confirmado.php',
                'layouts/footer.php',
                'layouts/html_footer.html'
            ]);
            return;

        } else {
            Store::redirect('inicio');
        }
    }

    public function login()
    {
        if (Store::isClientLogged()) {
            Store::redirect('inicio');
            return;
        }

        Store::layout([
            'layouts/html_header.php',
            'layouts/header.php',
            'cliente_login.php',
            'layouts/footer.php',
            'layouts/html_footer.html'
        ]);
    }

    public function loginSubmit()
    {
        if (Store::isClientLogged()) {
            Store::redirect('inicio');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect('inicio');
            return;
        }

        if (
            !isset($_POST['user_email'])
            || !isset($_POST['user_pass'])
            || !filter_var(trim($_POST['user_email']), FILTER_VALIDATE_EMAIL)
        ) {
            $_SESSION['error'] = 'E-mail ou senha inválido, tente novamente';
            Store::redirect('login');
            return;
        }

        $user = (trim(strtolower($_POST['user_email'])));
        $pass = $_POST['user_pass'];

        $client = new Client();
        $isValid = $client->validateLogin($user, $pass);

        if (!$isValid) {
            $_SESSION['error'] = 'Login Inválido';
            Store::redirect('login');
            return;
        }

        $_SESSION['client']     = $isValid->id_cliente;
        $_SESSION['email']      = $isValid->email_cliente;
        $_SESSION['clientName'] = $isValid->nome_cliente;

        if (isset($_SESSION['tmpCart'])) {
            unset($_SESSION['tmpCart']);
            Store::redirect('finalizar_pedido_resumo');
        } else {
            Store::redirect('inicio');
        }
    }

    public function logout()
    {
        unset ($_SESSION['client']);
        unset ($_SESSION['email']);
        unset ($_SESSION['clientName']);

        Store::redirect('inicio');
    }

    public function perfil()
    {
        if (!Store::isClientLogged()) {
            Store::redirect('inicio');
            return;
        }

        $client = new Client();

        $dtemp = $client->searchClient($_SESSION['client']);

        $data = [
            'clientData'  => [
                'Email'     => $dtemp->email_cliente,
                'Nome'      => $dtemp->nome_cliente,
                'Endereço'  => $dtemp->endereco_cliente,
                'Cidade'    => $dtemp->cidade_cliente,
                'Telefone'  => $dtemp->telefone_cliente,
            ]
        ];

        Store::layout([
            'layouts/html_header.php',
            'layouts/header.php',
            'cliente_perfil_nav.php',
            'cliente_perfil.php',
            'layouts/footer.php',
            'layouts/html_footer.html'
        ], $data);
    }

    /**
     * @throws Exception
     */
    public function alterPersonalData()
    {
        if (!Store::isClientLogged()) {
            Store::redirect('inicio');
            return;
        }

        $client = new Client();

        $data = [
            'personalData' => $client->searchClient($_SESSION['client']),
        ];

        Store::layout([
            'layouts/html_header.php',
            'layouts/header.php',
            'cliente_perfil_nav.php',
            'cliente_alterar_dados_pessoais.php',
            'layouts/footer.php',
            'layouts/html_footer.html'
        ], $data);
    }

    public function alterPersonalDataSubmit()
    {
        if (!Store::isClientLogged()) {
            Store::redirect('inicio');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect('inicio');
            return;
        }

        $email = trim(strtolower($_POST['email']));
        $nome = trim($_POST['nome']);
        $endereco = trim($_POST['endereco']);
        $cidade = trim($_POST['cidade']);
        $telefone = trim($_POST['telefone']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email)) {
            $_SESSION['error'] = 'E-mail inválido!';
            $this->alterPersonalData();
        }

        if (empty($nome) || empty($endereco) || empty($cidade)) {
            $_SESSION['error'] = 'Preencha os dados corretamente!';
            $this->alterPersonalData();
        }

        $client = new Client();
        $result = $client->validateEmailNotInUse($email);

        if ($result) {
            $_SESSION['error'] = 'E-mail já cadastrado!';
            $this->alterPersonalData();
        }

        $client->updateClient($email, $nome, $endereco, $cidade, $telefone);

        Store::redirect('perfil');

    }

    public function alterPassword()
    {
        echo 'alterPassword';
    }

    public function alterPasswordSubmit()
    {
        echo 'alterPasswordSubmit';
    }

    public function orderHistory()
    {
        echo 'orderHistory';
    }
}