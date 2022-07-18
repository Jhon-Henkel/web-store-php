<?php

$rotas = array(
    //admin
    'inicio'            => 'admin@index',
    'admin-login'       => 'admin@adminLogin',
    'admin-login-submit'=> 'admin@adminLoginSubmit',
    'admin-logout'      => 'admin@logout',

    //clientes
    'clientes'          => 'admin@clientsList',
    'detalhes-cliente'  => 'admin@clientDetails',
    'pedidos-do-cliente'=> 'admin@clientOrderHistory',

    //pedidos
    'pedidos'           => 'admin@ordersList',
    'detalhes-pedido'   => 'admin@orderDetails',
    'alterar-status'    => 'admin@setStatus',

);

//define a ação caso a rota não esteja mapeada em rodas
$action = 'inicio';

//verifica se existe a ação na query string
if (isset($_GET['pagina'])) {

    //verifica se ação existe nas rotas
    if(key_exists($_GET['pagina'], $rotas)) {
        $action = $_GET['pagina'];
    }
}

//trata a definição de rota
$partes     = explode('@', $rotas[$action]);
$controller = 'core\\controllers\\' . ucfirst($partes[0]);
$method     = $partes[1];

$ctr = new $controller();
$ctr->$method();