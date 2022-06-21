<?php
session_start();

require_once '../config.php';
require_once '../vendor/autoload.php';

$db = new \core\classes\Database();

$clientes = $db->select("SELECT * FROM clientes");
d($clientes);