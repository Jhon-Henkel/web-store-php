<?php
namespace core\classes;

class Store
{
    public static function layout($structures, $data = null)
    {
        //verifica se structure é array
        if (!is_array($structures)) {
            throw new \Exception('Coleção de estruturas inválida!');
        }

        //variáveis
        if (!empty($data) && is_array($data)) {
            extract($data);
        }

        //apresenta as views da aplicação conforme estrutura
        foreach ($structures as $structure) {
            include '../core/views/' . $structure;
        }
    }

    public static function isClientLogged()
    {
        //verifica se existe um cliente com sessão
        return isset($_SESSION['client']);
    }
}