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
                            <div class="row">
                                <div class="col">
                                    Cancelar
                                </div>
                                <div class="col text-end">
                                    escolher método de pagamento
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>