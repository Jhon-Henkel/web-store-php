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
            <h3>Histórico de pedidos do <strong><?= $data['cliente']->nome_cliente ?></strong></h3>
            <hr>
            <div class="row">
                <div class="col">
                    <div>
                        <strong>Nome: </strong>
                        <?= $data['cliente']->email_cliente ?>
                    </div>
                    <div>
                        <strong>Endereço: </strong>
                        <?= $data['cliente']->endereco_cliente ?>
                    </div>
                    <div>
                        <strong>Cidade: </strong>
                        <?= $data['cliente']->cidade_cliente ?>
                    </div>
                </div>
                <div class="col">
                    <div class="col">
                        <strong>Telefone: </strong>
                        <?= $data['cliente']->telefone_cliente ?>
                    </div>
                    <div class="col">
                        <strong>Status: </strong>
                        <?= $data['cliente']->status_cliente ?>
                    </div>
                    <div class="col">
                        <strong>Cadastrado em: </strong>
                        <?= $date->formatDateUsToBr($data['cliente']->data_cadastro) ?>
                    </div>
                </div>
            </div>
            <hr>
            <?php if (count($data['orders']) == 0): ?>
                <hr>
                <p class="text-center">Não existem pedidos para esse cliente!</p>
            <?php else: ?>
                <table class="table table-striped table-sm" id="ordersTable">
                    <thead class="table-primary">
                    <tr>
                        <th>Data</th>
                        <th>Código</th>
                        <th>Status</th>
                        <th>Ultima atualização</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data['orders'] as $order): ?>
                        <tr>
                            <td><?= $date->formatDateUsToBr($order->data_pedido) ?></td>
                            <td><?= $order->codido_pedido ?></td>
                            <td><?= $admin->getStatusString($order->status_pedido) ?></td>
                            <td><?= $order->updated_at ? $date->formatDateUsToBr($order->updated_at) : 'Nunca atualizado' ?></td>
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