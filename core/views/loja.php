<?php //$product = $products[0]; ?>

<div class="container bottonSpace">
    <div class="row">
        <div class="col-12 text-center my-5">
            <h3>Listagem de produtos</h3>

            <a href="?pagina=loja&c=todos" class="btn btn-primary">Todos</a>
            <?php foreach ($categories as $category): ?>
                <a href="?pagina=loja&c=<?= $category ?>" class="btn btn-primary">
                    <?= ucfirst(preg_replace("/\_/", " ", $category)) ?>
                </a>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="row">
        <?php if (count($products) == 0): ?>
            <div class="text-center my-5">
                <h3>Não existem produtos disponíveis</h3>
            </div>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="col-sm-4 col-6 p-2">
                    <div class="text-center p-3 card">
                        <img class="img-fluid" src="assets/images/products/<?= $product->imagem_pdt ?>">
                        <h3><?= $product->nome_pdt ?></h3>
                        <h2><?= 'R$ ' . preg_replace('/\./', ',', $product->preco_pdt) ?></h2>
                        <div>
                            <?php if ($product->qtd_pdt_estoque <= 0): ?>
                                <button class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-cart-shopping me-2"></i>
                                    Out of stock
                                </button>
                            <?php else: ?>
                                <button class="btn btn-primary btn-sm" onclick="addToCart(<?= $product->id_pdt ?>)">
                                    <i class="fa-solid fa-cart-shopping me-2"></i>
                                    Adicionar
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>