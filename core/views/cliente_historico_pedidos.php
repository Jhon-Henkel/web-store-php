<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center">Histórico de pedidos</h3>

            <?php if (count($data['historyOrder']) == 0): ?>
                <p class="text-center">
                    Não existe histórico de pedidos para você.
                </p>
            <?php else: ?>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Data pedido</th>
                            <th class="text-center">Código pedido</th>
                            <th class="text-center">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['historyOrder'] as $order): ?>
                            <tr>
                                <td><?= $order->data_pedido ?></td>
                                <td class="text-center"><?= $order->codido_pedido ?></td>
                                <td class="text-center"><?= $order->status_pedido ?></td>
                                <td>
                                    <a href="?pagina=detalhes_pedido&id=<?= \core\classes\Store::strEncryptAes($order->id_pedido) ?>"><i class="fa-solid fa-circle-info"></i></a>
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