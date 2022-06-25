<?php //$product = $products[0]; ?>

<div class="container-fluid bottonSpace">
    <div class="row">
        <div class="col-12">
            <h3>Listagem de produtos</h3>
        </div>
    </div>

    <div class="row">

        <?php foreach ($products as $product): ?>

        <div class="col-sm-4">
            <div class="text-center p-3">
                <img class="img-fluid" src="assets/images/products/<?= $product->imagem_pdt ?>">
                <h3><?= $product->nome_pdt ?></h3>
                <h2><?= $product->preco_pdt ?></h2>
                <p><small><?= $product->descricao_pdt ?></small></p>
                <div>
                    <button class="btn btn-primary">+ Carrinho</button>
                </div>
            </div>
        </div>

        <?php endforeach; ?>

    </div>
</div>