<div class="container-fluid">
    <div class="row">
        <div class="cell-12">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <hr>
                            <h3 class="text-center my-4">Resumo do Pedido</h3>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                            <div style="margin-bottom: 80px">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-start">Produto</th>
                                        <th class="text-center">Quantidade</th>
                                        <th class="text-end">Valor total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $utilString = new \core\util\UtilString() ?>
                                    <?php foreach ($data['cart'] as $product): ?>
                                        <tr>
                                            <td class="align-middle"><h6><?= $product['title'] ?></h6></td>
                                            <td class="text-center align-middle"><h6><?= $product['qtd'] ?></h6></td>
                                            <td class="text-end align-middle">
                                                <h6>
                                                    <b>
                                                        <?= $utilString->formatPrice($product['price']) ?>
                                                    </b>
                                                </h6>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td></td>
                                        <td class="text-end"><h4><b>Total:</b></h4></td>
                                        <td class="text-end align-middle">
                                            <h4>
                                                <b>
                                                    <?= $utilString->formatPrice($data['total']) ?>
                                                </b>
                                            </h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h5 class="bg-opacity-10 bg-primary p-2">Dados do Cliente</h5>
                            <div class="row">
                                <div class="col">
                                    <p>Nome: <strong><?= $data['client']->nome_cliente ?></strong></p>
                                    <p>Endereço: <strong><?= $data['client']->endereco_cliente ?></strong></p>
                                    <p>Cidade: <strong><?= $data['client']->cidade_cliente ?></strong></p>
                                </div>
                                <div class="col">
                                    <p>
                                        Telefone:
                                        <strong>
                                            <?= $data['client']->telefone_cliente ? $data['client']->telefone_cliente : 'Não informado' ?>
                                        </strong>
                                    </p>
                                    <p>Email: <strong><?= $data['client']->email_cliente ?></strong></p>
                                </div>
                            </div>

                            <h5 class="bg-opacity-10 bg-primary p-2">Dados para pagamento</h5>
                            <div class="row">
                                <div class="col">
                                    <p>Pix: <strong>3258741</strong></p>
                                    <p>Código do pedido: <strong><?= $_SESSION['orderCode'] ?></strong></p>
                                    <p>Total: <strong><?= $utilString->formatPrice($data['total']) ?></strong></p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-check">
                                <input class="form-check-input" onchange="showAlterarEndereco()" type="checkbox" name="alterarEndereco" id="alterarEndereco">
                                <label class="form-check-label" for="alterarEndereco">Alterar endereço</label>
                            </div>
                            <div id="novoEndereco" style="display: none">
                                <div class="mb-3">
                                    <label class="form-label" for="enderecoAlternativo">Novo Endereço: </label>
                                    <input class="form-control" type="text" id="enderecoAlternativo">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="cidadeAlternativa">Nova Cidade: </label>
                                    <input class="form-control" type="text" id="cidadeAlternativa">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="emailAlternativo">Novo E-mail: </label>
                                    <input class="form-control" type="email" id="emailAlternativo">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="telefoneAlternativo">Novo Telefone: </label>
                                    <input class="form-control" type="tel" id="telefoneAlternativo">
                                </div>
                            </div>
                            <div class="row my-5">
                                <div class="col">
                                    <a class="btn btn-primary btn-sm btn-175" href="?pagina=carrinho">
                                        <i class="fa-solid fa-circle-chevron-left"></i>
                                        Voltar ao carrinho
                                    </a>
                                </div>
                                <div class="col text-end">
                                    <a class="btn btn-primary btn-sm btn-175" href="?pagina=confirmar_pedido" onclick="alternativeData()">
                                        <i class="fa-solid fa-money-check-dollar"></i>
                                        Finalizar Pedido
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>