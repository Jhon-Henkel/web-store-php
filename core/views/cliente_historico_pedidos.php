<div class="container-fluid">
    <div class="row my-5">
        <div class="col-md-2">
            <?php
                include __DIR__ . '/cliente_perfil_menu.php';
                $utilString = new \core\util\UtilString();
                $utilData = new \core\util\UtilData();
            ?>
        </div>
        <div class="col-10">
            <h3 class="text-center">Histórico de pedidos</h3>
            <?php if (count($data['historyOrder']) == 0): ?>
                <p class="text-center">
                    Não existe histórico de pedidos para você.
                </p>
            <?php else: ?>
                <table class="table table-striped mt-5" id="orderHistory">
                    <thead class="table-primary">
                        <tr>
                            <th>Data pedido</th>
                            <th class="text-center">Código pedido</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Detalhes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['historyOrder'] as $order): ?>
                            <tr>
                                <td><?= $utilData->formatDateUsToBr($order->data_pedido) ?></td>
                                <td class="text-center"><?= $order->codido_pedido ?></td>
                                <td class="text-center"><?= $utilString->getStatusString($order->status_pedido) ?></td>
                                <td class="text-center">
                                    <a href="?pagina=detalhes_pedido&id=<?= \core\classes\Store::strEncryptAes($order->id_pedido) ?>">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="text-end">Total pedidos: <strong><?= count($data['historyOrder']) ?></strong></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#orderHistory').DataTable(
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