<div class="container-fluid">
    <div class="row mt-3 mb-5">
        <div class="col-md-1">
            <?php include (__DIR__ . '/layouts/admin-menu.php') ?>
        </div>
        <div class="col-md-11">
            <h3>Detalhes do pedido <?= $data['order']->codido_pedido ?></h3>
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

                <?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $data['order']->data_pedido); ?>
                <div class="col-2 fw-bold mt-2">Data Pedido:</div>
                <div class="col-10 mt-2"><?= $date->format('d/m/Y') ?></div>

                <div class="col-2 fw-bold mt-2">Status:</div>
                <div class="col-10 mt-2"><?= $data['order']->status_pedido ?></div>
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
                            <td class="text-center"><?= $product->valor_unitario ?></td>
                            <td class="text-center"><?= $product->quantidade ?></td>
                            <td class="text-center"><?= $product->quantidade * $product->valor_unitario ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>