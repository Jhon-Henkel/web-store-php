<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-2">
            <?php
            use core\util\UtilData;
            use core\models\AdminModel;

            include (__DIR__ . '/layouts/admin-menu.php');

            $date = new UtilData();
            $admin = new AdminModel();
            ?>
        </div>

        <div class="col-md-10">
            <h3>Pedidos <?= ucfirst($data['status']) ?></h3>
            <hr>
            <div class="d-inline-flex mb-2">
                <div>
                    <a href="?pagina=pedidos" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-check-to-slot me-1"></i>
                        Todos pedidos
                    </a>
                </div>
                <?php
                    $status = 'Todos';
                    if (isset($_GET['status'])) {
                        $status = $_GET['status'];
                    }
                ?>
                <div class="d-inline-flex ms-3">
                    <label class="me-2" for="statusList">Selecionar status: </label>
                    <select class="form-select-sm" id="statusList" onchange="changeStatusFilter()">
                        <option value="" <?= $status == 'todos' ? 'selected' : '' ?>>Todos</option>
                        <option value="pendente" <?= $status == 'pendente' ? 'selected' : '' ?>>Pendente</option>
                        <option value="pago" <?= $status == 'pago' ? 'selected' : '' ?>>Pago</option>
                        <option value="faturado" <?= $status == 'faturado' ? 'selected' : '' ?>>Faturado</option>
                        <option value="enviado" <?= $status == 'enviado' ? 'selected' : '' ?>>Enviado</option>
                        <option value="entregue" <?= $status == 'entregue' ? 'selected' : '' ?>>Entregue</option>
                        <option value="cancelado" <?= $status == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                    </select>
                </div>
            </div>
            <?php if (count($data['orders']) == 0): ?>
                <hr>
                <p class="text-center">
                    Não existem pedidos
                    <strong>
                        <?= $data['status'] ?>
                    </strong>
                </p>
            <?php else: ?>
                <table class="table table-striped table-sm" id="ordersTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="col-1 text-center">Detalhes</th>
                            <th>Data</th>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Status</th>
                            <th>Atualizado em</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['orders'] as $order): ?>
                            <tr>
                                <td class="col-1 text-center">
                                    <a href="?pagina=detalhes-pedido&id=<?= $order->id_pedido ?>">
                                        <i class="fa-solid fa-circle-info me-2"></i>
                                    </a>
                                </td>
                                <td><?= $date->formatDateUsToBr($order->data_pedido) ?></td>
                                <td><?= $order->codido_pedido ?></td>
                                <td><?= $order->nome_cliente ?></td>
                                <td><?= $order->email_cliente ?></td>
                                <td><?= $order->telefone_cliente ?></td>
                                <td><?= $admin->getStatusString($order->status_pedido) ?></td>
                                <td><?= $order->updated_at ? $date->formatDateUsToBr($order->updated_at) : 'Nunca atualizado'  ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#ordersTable').DataTable(
            {
                language: {
                    decimal: ',',
                    thousands: '.',
                    search: 'Procurar',
                    lengthMenu: 'Mostrar _MENU_ por página',
                    info: 'Mostrando _PAGE_ de _PAGES_',
                    infoEmpty: 'Sem resultados disponíveis',
                    infoFiltered: '(filtrado de _MAX_ resultados totais)',
                    zeroRecords: 'Nada para mostrar',
                    paginate: {
                        first: 'Primeira',
                        last: 'Ultima',
                        next: 'Próxima',
                        previous: 'Anterior'
                    },
                },
            }
        );
    } );

    function changeStatusFilter(){
        let filter = document.getElementById('statusList').value;
        window.location.href = window.location.pathname + '?' + $.param({
            'pagina' : 'pedidos',
            'status': filter
        })
    }

</script>