<?php

$rotas = array(
    'inicio'            => 'main@index',
    'loja'              => 'main@store',

    //cliente
    'cliente_cadastro'  => 'main@registerClientForm',
    'cliente_criar'     => 'main@registerClient',
    'confirmar_email'   => 'main@confirmMail',

    //login
    'login'             => 'main@login',
    'login_submit'      => 'main@loginSubmit',
    'logout'            => 'main@logout',

    //checkout
    'carrinho_add'      => 'cart@addToCart',
    'remover_produto'   => 'cart@removeProduct',
    'clean_cart'        => 'cart@cleanCart',
    'carrinho'          => 'cart@cart',
);

//define a ação caso a rota não esteja mapeada em rodas
$action = 'inicio';

//verifica se existe a ação na query string
if (isset($_GET['pagina'])) {

    //verifica se ação existe nas rotas
    if(!key_exists($_GET['pagina'], $rotas)) {
        $action = 'inicio';
    } else {
        $action = $_GET['pagina'];
    }
}

//trata a definição de rota
$partes     = explode('@', $rotas[$action]);
$controller = 'core\\controllers\\' . ucfirst($partes[0]);
$method     = $partes[1];

$ctr = new $controller();
$ctr->$method();