<?php

$rotas = array(
    'inicio'    => 'main@index',
    'loja'      => 'main@loja',
    'carrinho'  => 'loja@carrinho'
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