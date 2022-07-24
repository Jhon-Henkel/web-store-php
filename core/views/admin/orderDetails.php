<div class="container-fluid">
    <div class="row mt-3 mb-5">
        <div class="col-md-2">
            <?php
            use core\util\UtilString;
            use core\util\UtilData;
            use core\models\AdminModel;

            include (__DIR__ . '/layouts/admin-menu.php');

            $date = new UtilData();
            $utilString = new UtilString();
            $admin = new AdminModel();
            ?>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col">
                    <h3>Detalhes do pedido <strong><?= $data['order']->codido_pedido ?></strong></h3>
                </div>
                <?php
                    $orderStatus = $utilString->getStatusString($data['order']->status_pedido);
                ?>
                <div class="col text-end">
                    <div class="text-center p-3 badge bg-warning status-click" onclick="modal()">
                        Status:
                        <?= $orderStatus ?>
                    </div>
                    <?php if ($orderStatus == ALL_ORDER_STATUS_STR[1]): ?>
                        <div>
                            <a class="btn btn-sm btn-primary mt-2 btn-100" href="?pagina=imprimir-pdf&orderId=<?= $data['order']->id_pedido ?>">
                                <i class="fa-solid fa-print"></i>
                                imprimir
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <hr>
            <div class="row mt-3">
                <div class="col-2 fw-bold mt-2">Cliente:</div>
                <div class="col-10 mt-2">
                    <?= $data['client']->nome_cliente ?>
                    <a href="?pagina=detalhes-cliente&id=<?= $data['client']->id_cliente ?>">
                        <i class="fa-solid fa-eye ms-2"></i>
                    </a>
                </div>

                <div class="col-2 fw-bold mt-2">Endereço entrega:</div>
                <div class="col-10 mt-2"><?= $data['order']->endereco_entrega ?></div>

                <div class="col-2 fw-bold mt-2">Cidade entrega:</div>
                <div class="col-10 mt-2"><?= $data['order']->cidade_entrega ?></div>

                <div class="col-2 fw-bold mt-2">Telefone:</div>
                <div class="col-10 mt-2"><?= empty($data['order']->telefone_cliente) ? 'Não cadastrado' : $data['order']->telefone_cliente ?></div>

                <div class="col-2 fw-bold mt-2">E-mail:</div>
                <div class="col-10 mt-2"><?= $data['order']->email_cliente ?></div>

                <div class="col-2 fw-bold mt-2">Data Pedido:</div>
                <div class="col-10 mt-2"><?= $date->formatDateUsToBr($data['order']->data_pedido) ?></div>
            </div>
            <hr>
            <h4>Produtos</h4>
            <table class="table table-striped table-sm">
                <thead class="table-primary">
                    <tr>
                        <th>Produto</th>
                        <th class="text-center">Valor/und</th>
                        <th class="text-center">Quantidade</th>
                        <th class="text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['products'] as $product): ?>
                        <tr>
                            <td><?= $product->nome_produto ?></td>
                            <td class="text-center"><?= $utilString->formatPrice($product->valor_unitario) ?></td>
                            <td class="text-center"><?= $product->quantidade ?></td>
                            <td class="text-center"><?= $utilString->formatPrice($product->quantidade * $product->valor_unitario) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alterar status do pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <?php foreach (ALL_ORDER_STATUS_STR as $status): ?>
                    <?php if ($orderStatus == $status): ?>
                        <p class="btn btn-outline-primary btn-sm btn-150 mb-2">
                            <?= $admin->getIconStatus($status) ?>
                            <?= $status ?>
                        </p>
                        <br>
                    <?php else: ?>
                            <a class="btn btn-primary btn-sm btn-150 nav-item mb-2" href="?pagina=alterar-status&status=<?= $status ?>&orderId=<?= $data['order']->id_pedido ?>">
                                <?= $admin->getIconStatus($status) ?>
                                <?= $status ?>
                            </a>
                        <br>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function modal() {
        var modal = new bootstrap.Modal(document.getElementById('modal'))
        modal.show();
    }
</script>