<?php

const APP_NAME          = 'PhpWebStore';
const APP_VERSION       = '1.0.0';
const BASE_URL          = 'http://localhost/Web-Store/public/';

//MYSQL
const MYSQL_SERVER      = 'localhost';
const MYSQL_DATABASE    = 'php_store';
const MYSQL_USER        = 'root';
const MYSQL_PASS        = '';
const MYSQL_CHARSET     = 'utf8';

//E-mail
const EMAIL_HOST        = 'smtp-mail.outlook.com';
const EMAIL_FROM        = 'phpstorejhon@outlook.com';
const EMAIL_PASSWORD    = 'Jhonphpstore';
const EMAIL_PORT        = 587;

//AES encrypt
const AES_KEY           = 'GAynLeXnL3sR8sCAcnQ7qx5D4oCqyDbo';
const AES_IV            = '3MRBpL39Lt59ptCH';

//Status pedido
const ORDER_PENDENTE        = 0;
const ORDER_PAGO            = 1;
const ORDER_FATURADO        = 2;
const ORDER_ENVIADO         = 3;
const ORDER_ENTREGUE        = 4;
const ORDER_CANCELADO       = 5;
const ALL_ORDER_STATUS_STR  = array('Pendente', 'Pago', 'Faturado', 'Enviado', 'Entregue', 'Cancelado');