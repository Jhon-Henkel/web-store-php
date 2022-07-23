<?php

namespace core\controllers;

use core\classes\Mail;
use core\classes\Pdf;
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

        $admin = new AdminModel();
        $pendingOrders = $admin->countPendingOrders();
        $paidOrders = $admin->countPaidOrders();

        $data = [
            'totalPendingOrders' => $pendingOrders,
            'totalPaidOrders'    => $paidOrders
        ];

        Store::layoutAdmin([
            'admin/layouts/html_header.php',
            'admin/layouts/header.php',
            'admin/home.php',
            'admin/layouts/footer.php',
            'admin/layouts/html_footer.html'
        ], $data);
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

    public function logout()
    {
        unset ($_SESSION['admin']);
        unset ($_SESSION['user']);
        Store::redirect('inicio', true);
    }

    /**
     * @throws Exception
     */
    public function ordersList()
    {
        if (!Store::isAdminLogged()) {
            Store::redirect('inicio', true);
            return;
        }

        $status = '';
        $statusName = '';
        if (isset($_GET['status'])) {
            switch ($_GET['status']) {
                case 'pendente':
                    $status = ORDER_PENDENTE;
                    $statusName = $_GET['status'] . 's';
                    break;
                case 'pago':
                    $status = ORDER_PAGO;
                    $statusName = $_GET['status'] . 's';
                    break;
                case 'faturado':
                    $status = ORDER_FATURADO;
                    $statusName = $_GET['status'] . 's';
                    break;
                case 'enviado':
                    $status = ORDER_ENVIADO;
                    $statusName = $_GET['status'] . 's';
                    break;
                case 'entregue':
                    $status = ORDER_ENTREGUE;
                    $statusName = $_GET['status'] . 's';
                    break;
                case 'cancelado':
                    $status = ORDER_CANCELADO;
                    $statusName = $_GET['status'] . 's';
                    break;
                default:
                    $status = '';
                    $statusName = '';
                    break;
            }
        }

        $admin = new AdminModel();
        $orders = $admin->listOrders($status);

        $data = [
            'orders' => $orders,
            'status' => $statusName
        ];

        Store::layoutAdmin([
            'admin/layouts/html_header.php',
            'admin/layouts/header.php',
            'admin/orders.php',
            'admin/layouts/footer.php',
            'admin/layouts/html_footer.html'
        ], $data);
    }

    /**
     * @throws Exception
     */
    public function clientsList()
    {
        if (!Store::isAdminLogged()) {
            Store::redirect('inicio', true);
            return;
        }

        $admin = new AdminModel();
        $clients = $admin->listAllClients();

        $data = [
            'clientes' => $clients,
        ];

        Store::layoutAdmin([
            'admin/layouts/html_header.php',
            'admin/layouts/header.php',
            'admin/clients.php',
            'admin/layouts/footer.php',
            'admin/layouts/html_footer.html'
        ], $data);
    }

    /**
     * @throws Exception
     */
    public function clientDetails()
    {
        if (!Store::isAdminLogged()) {
            Store::redirect('inicio', true);
            return;
        }

        if (!isset($_GET['id'])) {
            Store::redirect('clientes', true);
            return;
        }

        $clientId = $_GET['id'];

        $admin = new AdminModel();

        $data = [
            'cliente'       => $admin->getClientById($clientId)[0],
            'totalPedidos'  => $admin->countOrdersByClientId($clientId)
        ];

        Store::layoutAdmin([
            'admin/layouts/html_header.php',
            'admin/layouts/header.php',
            'admin/clientDetails.php',
            'admin/layouts/footer.php',
            'admin/layouts/html_footer.html'
        ], $data);
    }

    /**
     * @throws Exception
     */
    public function clientOrderHistory()
    {
        if (!Store::isAdminLogged()) {
            Store::redirect('inicio', true);
            return;
        }

        if (!isset($_GET['id'])) {
            Store::redirect('clientes', true);
            return;
        }

        $clientId = $_GET['id'];

        $admin = new AdminModel();
        $orders = $admin->getOrdersByClientId($clientId);
        $client = $admin->getClientById($clientId)[0];

        $data = [
            'orders'    => $orders,
            'cliente'   => $client,
        ];

        Store::layoutAdmin([
            'admin/layouts/html_header.php',
            'admin/layouts/header.php',
            'admin/clientOrdersHistory.php',
            'admin/layouts/footer.php',
            'admin/layouts/html_footer.html'
        ], $data);
    }

    /**
     * @throws Exception
     */
    public function orderDetails()
    {
        if (!Store::isAdminLogged()) {
            Store::redirect('inicio', true);
            return;
        }

        if (!isset($_GET['id'])) {
            Store::redirect('pedidos', true);
            return;
        }

        $orderId = $_GET['id'];

        $admin = new AdminModel();
        $order = $admin->getOrdersByOrderId($orderId);
        $client = $admin->getClientById($order[0]->id_cliente);
        $products = $admin->getProductsInOrderByOrderId($orderId);

        $data = [
            'order'    => $order[0],
            'client'   => $client[0],
            'products' => $products,
        ];

        Store::layoutAdmin([
            'admin/layouts/html_header.php',
            'admin/layouts/header.php',
            'admin/orderDetails.php',
            'admin/layouts/footer.php',
            'admin/layouts/html_footer.html'
        ], $data);
    }

    /**
     * @throws Exception
     * TODO fazer histórico de status
     */
    public function setStatus()
    {
        if (!Store::isAdminLogged()) {
            Store::redirect('inicio', true);
            return;
        }

        if (!isset($_GET['status']) && !isset($_GET['orderId'])) {
            Store::redirect('inicio', true);
            return;
        }

        $status = $_GET['status'];
        $orderId = $_GET['orderId'];

        if (!in_array($status, ALL_ORDER_STATUS_STR)) {
            Store::redirect('inicio', true);
            return;
        }

        $admin = new AdminModel();
        $admin->setOrderStatus($status, $orderId);
        $admin->sendEmail($status, $orderId);

        Store::redirect('detalhes-pedido&id=' . $orderId, true);
    }

    /**
     * @throws Exception
     */
    public function printPdf()
    {
        if (!Store::isAdminLogged()) {
            Store::redirect('inicio', true);
            return;
        }

        if (!isset($_GET['orderId'])) {
            Store::redirect('inicio', true);
            return;
        }

        $orderId = $_GET['orderId'];
        $admin = new AdminModel();
        $order = $admin->getOrdersByOrderId($orderId);
        $products = $admin->getProductsInOrderByOrderId($orderId);
        $client = $admin->getClientById($order[0]->id_cliente);

        d($order);
        d($products);
        d($client);

        $pdf = new Pdf();
        $pdf->setHtml('teste');
        $pdf->setTemplate(getcwd() . '/assets/templates/pdf/template.pdf');
        $pdf->showPdf();
    }
}