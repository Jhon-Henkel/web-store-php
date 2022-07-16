<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-3">
            <?php include __DIR__ . '/layouts/admin-menu.php' ?>
        </div>

        <div class="col-md-9">
            <h4>Pedidos Pendentes</h4>
            <?php if ($data['totalPendingOrders'] == 0): ?>
                <div class="alert alert-danger p-2 text-center">
                    <span class="me-3">
                        <i class="fa-solid fa-circle-info me-2"></i>
                        Não existem pedidos pendentes
                    </span>
                </div>
            <?php else: ?>
                <div class="alert alert-info p-2 text-center">
                    <span class="me-3">
                        <i class="fa-solid fa-circle-info me-2"></i>
                        Existem
                        <strong>
                            <?= $data['totalPendingOrders'] ?>
                        </strong>
                        pedidos pendentes
                        <a href="?pagina=pedidos&status=pendente"><i class="fa-solid fa-eye ms-2"></i></a>
                    </span>
                </div>
            <?php endif; ?>
            <hr>
            <h4>Pedidos Pagos</h4>
            <?php if ($data['totalPaidOrders'] == 0): ?>
                <div class="alert alert-danger p-2 text-center">
                    <span class="me-3">
                        <i class="fa-solid fa-circle-info me-2"></i>
                        Não existem pedidos pagos
                    </span>
                </div>
            <?php else: ?>
                <div class="alert alert-info p-2 text-center">
                    <span class="me-3">
                        <i class="fa-solid fa-circle-info me-2"></i>
                        Existem
                        <strong>
                            <?= $data['totalPaidOrders'] ?>
                        </strong>
                        pedidos Pagos
                        <a href="?pagina=pedidos&status=pago"><i class="fa-solid fa-eye ms-2"></i></a>
                    </span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>