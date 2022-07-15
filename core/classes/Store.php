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

    public static function layoutAdmin($structures, $data = null)
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
            include '../../core/views/' . $structure;
        }
    }

    public static function isClientLogged(): bool
    {
        return isset($_SESSION['client']);
    }

    public static function isAdminLogged(): bool
    {
        return isset($_SESSION['admin']);
    }

    public static function generateMd5UniqId(): string
    {
        return md5(uniqid());
    }

    public static function redirect($route = '', $admin = false)
    {
        if (!$admin) {
            header('location:' . BASE_URL . '?pagina=' . $route);
        } else {
            header('location:' . BASE_URL . 'admin/' . '?pagina=' . $route);
        }
    }

    public static function generateOrderCode(): string
    {
        $cod = '';
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $cod .= substr(str_shuffle($chars), 0,2);
        $cod .= rand(100000, 9999999);
        return $cod;
    }

    public static function strEncryptAes($str): string
    {
        return bin2hex(openssl_encrypt($str, 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV));
    }

    public static function strDecryptAes($str): string
    {
        return openssl_decrypt(hex2bin($str), 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV);
    }
}