<div class="container-fluid">
    <div class="row">
        <div class="cell-12">

            <div class="container">
                <div class="row">
                    <div class="col">
                        <hr>
                            <h3 class="text-center my-4">Resumo</h3>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col">
                            <div style="margin-bottom: 80px">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-start">Produto</th>
                                        <th class="text-center">Quantidade</th>
                                        <th class="text-end">Valor total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $index = 0;
                                    $totalRows = count($data['cart']);
                                    ?>
                                    <?php foreach ($data['cart'] as $product): ?>
                                        <?php if ($index < $totalRows -1): ?>
                                            <tr>
                                                <td class="align-middle"><h6><?= $product['title'] ?></h6></td>
                                                <td class="text-center align-middle"><h6><?= $product['qtd'] ?></h6></td>
                                                <td class="text-end align-middle"><h6><b><?= 'R$ ' . number_format($product['price'], 2, ',', '.') ?></b></h6></td>
                                            </tr>
                                        <?php else: ?>
                                            <tr>
                                                <td></td>
                                                <td class="text-end"><h4><b>Total:</b></h4></td>
                                                <td class="text-end align-middle">
                                                    <h4>
                                                        <b>
                                                            <?= 'R$ ' .  number_format($data['total'], 2, ',', '.') ?>
                                                        </b>
                                                    </h4>
                                                </td>
                                            </tr>
                                        <?php endif;?>
                                        <?php $index ++ ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <h5 class="bg-dark text-white p-2">Dados do Cliente</h5>
                            <div class="row">
                                <div class="col">
                                    <p>Nome: <strong><?= $data['client']->nome_cliente ?></strong></p>
                                    <p>Endereço: <strong><?= $data['client']->endereco_cliente ?></strong></p>
                                    <p>Cidade: <strong><?= $data['client']->cidade_cliente ?></strong></p>
                                </div>
                                <div class="col">
                                    <p>Telefone: <strong><?= $data['client']->telefone_cliente ?></strong></p>
                                    <p>Email: <strong><?= $data['client']->email_cliente ?></strong></p>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" onchange="showAlterarEndereco()" type="checkbox" name="alterarEndereco" id="alterarEndereco">
                                <label class="form-check-label" for="alterarEndereco">Alterar endereço</label>
                            </div>
                            <div id="novoEndereco" style="display: none">
                                <div class="mb-3">
                                    <label class="form-label" for="enderecoAlternativo">Endereço: </label>
                                    <input class="form-control" type="text" id="enderecoAlternativo">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="cidadeAlternativa">Cidade: </label>
                                    <input class="form-control" type="text" id="cidadeAlternativa">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="emailAlternativo">Email: </label>
                                    <input class="form-control" type="email" id="emailAlternativo">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="telefoneAlternativo">Telefone: </label>
                                    <input class="form-control" type="tel" id="telefoneAlternativo">
                                </div>
                            </div>
                            <div class="row my-5">
                                <div class="col">
                                    <a class="btn btn-danger" href="?pagina=carrinho">Cancelar</a>
                                </div>
                                <div class="col text-end">
                                    <a class="btn btn-primary" href="?pagina=escolher_forma_pagamento" onclick="alternativeData()">Escolher método de pagamento</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>