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
            <h1 class="text-center">Detalhes do pedido</h1>

            <div class="row">
                <div class="col">
                    <div class="p-2 my-3">
                        <span><strong>Data do pedido: </strong></span>
                        <?= $utilData->formatDateUsToBr($data['order']->data_pedido) ?>
                    </div>
                    <div class="p-2 my-3">
                        <span><strong>Endereço: </strong></span>
                        <?= $data['order']->endereco_entrega ?>
                    </div>
                    <div class="p-2 my-3">
                        <span><strong>Cidade: </strong></span>
                        <?= $data['order']->cidade_entrega ?>
                    </div>
                </div>
                <div class="col">
                    <div class="p-2 my-3">
                        <span><strong>Email: </strong></span>
                        <?= $data['order']->email_cliente ?>
                    </div>
                    <div class="p-2 my-3">
                        <span><strong>Telefone: </strong></span>
                        <?= !empty($data['order']->telefone_cliente) ? $data['order']->telefone_cliente : 'Não informado' ?>
                    </div>
                    <div class="p-2 my-3">
                        <span><strong>Código do pedido: </strong></span>
                        <?= $data['order']->codido_pedido ?>
                    </div>
                </div>
                <div class="col">
                    <div  class="p-2 my-3">
                        <span><strong>Status: </strong></span>
                        <?= $utilString->getStatusString($data['order']->status_pedido) ?>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th class="text-center">Quantidade</th>
                                <th class="text-end">Valor unitário</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['products'] as $product): ?>
                                <tr>
                                    <td><?= $product->nome_produto ?></td>
                                    <td class="text-center"><?= $product->quantidade ?></td>
                                    <td class="text-end"><?= $utilString->formatPrice($product->valor_unitario) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-end">Total: <strong><?= $utilString->formatPrice($data['total']) ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-3 mb-5">
                <div class="col text-center">
                    <a class="btn btn-primary" href="?pagina=historico_pedidos">
                        <i class="fa-solid fa-circle-chevron-left"></i>
                        Voltar
                    </a>
                </div>
                <div class="mb-5">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
</div>