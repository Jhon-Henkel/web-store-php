<div class="container-fluid">
    <div class="row">
        <div class="cell-12">

            <h3>Carrinho</h3>

            <a href="?pagina=clean_cart" class="btn btn-primary btn-sm">Limpar carrinho</a>

            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php if ($cart = null): ?>
                            <p>Carrinho vazio</p>
                            <p><a href="?pagina=loja" class="btn btn-primary">Voltar a loja</a> </p>
                        <?php else: ?>
                            <div style="margin-bottom: 80px">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th class="text-end">Valor total</th>
                                            <th></th>
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
                                                <td><img class="img-fluid" width="50px" src="assets/images/products/<?=$product['image']?>"></td>
                                                <td><?= $product['title'] ?></td>
                                                <td><?= $product['qtd'] ?></td>
                                                <td class="text-end"><?= $product['price'] ?></td>
                                                <td><button class="btn btn-danger"><i class="fas fa-times"></i></button></td>
                                            </tr>
                                        <?php else: ?>
                                            <tr>
                                                <td>Total:</td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-end"><?= $data['cart']['total'] ?></td>
                                                <td></td>
                                            </tr>
                                        <?php endif;?>
                                            <?php $index ++ ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>