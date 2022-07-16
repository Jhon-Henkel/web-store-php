<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-3">
            <?php include (__DIR__ . '/layouts/admin-menu.php') ?>
        </div>

        <div class="col-md-9">
            <h3>Pedidos <?= ucfirst($data['status']) ?></h3>
            <?php if (count($data['orders']) == 0): ?>
                <hr>
                <p class="text-center">Não existem pedidos <?= $data['status'] ?>!</p>
            <?php else: ?>
                <table class="table table-striped" id="ordersTable">
                    <thead class="table-primary">
                        <tr>
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
                                <td><?= $order->data_pedido ?></td>
                                <td><?= $order->codido_pedido ?></td>
                                <td><?= $order->nome_cliente ?></td>
                                <td><?= $order->email_cliente ?></td>
                                <td><?= $order->telefone_cliente ?></td>
                                <td><?= $order->status_pedido ?></td>
                                <td><?= $order->updated_at ?></td>
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
</script>