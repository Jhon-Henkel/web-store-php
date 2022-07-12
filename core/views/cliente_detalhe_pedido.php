<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Detalhes do pedido</h1>

            <div class="row">
                <div class="col">
                    <div class="p-2 my-3">
                        <span><strong>Data do pedido: </strong></span>
                        <?= $data['order']->data_pedido ?>
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
                        <?= !empty($data['order']->telefone_cliente) ? $data['order']->telefone_cliente : 'Não cadastrado' ?>
                    </div>
                    <div class="p-2 my-3">
                        <span><strong>Código do pedido: </strong></span>
                        <?= $data['order']->codido_pedido ?>
                    </div>
                </div>
                <div class="col">
                    <div  class="p-2 my-3">
                        <span><strong>Status: </strong></span>
                        <?php switch ($data['order']->status_pedido) {
                            case ORDER_PENDENTE:
                                echo 'Pendente';
                                break;
                            case ORDER_PAGO:
                                echo 'Pago';
                                break;
                            case ORDER_FATURADO:
                                echo 'Faturado';
                                break;
                            case ORDER_ENVIADO:
                                echo 'Enviado';
                                break;
                            case ORDER_ENTREGUE:
                                echo 'Entregue';
                                break;
                            case ORDER_CANCELADO:
                                echo 'Cancelado';
                                break;
                            default:
                                echo 'Sem Status definido';
                                break;
                            }
                        ?>
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
                                    <td class="text-end"><?= 'R$ ' . number_format($product->valor_unitario, 2, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-end">Total: <strong><?= 'R$ ' . number_format($data['total'], 2, ',', '.') ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-3 mb-5">
                <div class="col text-center">
                    <a class="btn btn-primary" href="?pagina=historico_pedidos">Voltar</a>
                </div>
                <div class="mb-5">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
</div>