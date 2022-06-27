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
                            <p>carrinho...</p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>