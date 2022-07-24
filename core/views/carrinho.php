<div class="container-fluid">
    <div class="row">
        <div class="cell-12">

            <div class="container">
                <div class="row">
                    <div class="col">
                        <hr>
                        <h3 class="text-center my-4">Seu carrinho</h3>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php if (is_null($data['cart'])): ?>
                            <div class="mt-4 text-center">
                                <p class="text-center"><h3>Não foram encontrados produtos em seu carrinho...</h3></p>
                                <hr class="mt-5">
                                <a href="?pagina=loja" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-circle-chevron-left"></i>
                                    Continuar comprando
                                </a>
                            </div>
                        <?php else: ?>
                            <div style="margin-bottom: 80px">
                                <
                                table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="text-start">Produto</th>
                                            <th class="text-center">Quantidade</th>
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
                                                    <td class="align-middle"><h6><?= $product['title'] ?></h6></td>
                                                    <td class="text-center align-middle"><h6><?= $product['qtd'] ?></h6></td>
                                                    <td class="text-end align-middle"><h6><b><?= 'R$ ' . number_format($product['price'], 2, ',', '.') ?></b></h6></td>
                                                    <td class="text-center align-middle">
                                                        <a href="?pagina=remover_produto&idPdt=<?= $product['id'] ?>" class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-end"><h5><b>Total:</b></h5></td>
                                                    <td class="text-end align-middle">
                                                        <h5>
                                                            <b>
                                                                <?= 'R$ ' .  number_format($data['cart']['total'], 2, ',', '.') ?>
                                                            </b>
                                                        </h5>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            <?php endif;?>
                                            <?php $index ++ ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-primary btn-sm" onclick="confirmExcludeCart()">
                                            <i class="fa-solid fa-trash"></i>
                                            Limpar carrinho
                                        </button>
                                        <span class="ms-3" style="display: none" id="confirmExcludeCart">
                                            Tem Certeza?
                                            <a class="btn btn-outline-success btn-sm btn-100" href="?pagina=clean_cart">
                                                <i class="fa-solid fa-circle-check"></i>
                                                Sim
                                            </a>
                                            <button onclick="confirmExcludeCartOff()" class="btn btn-outline-danger btn-sm btn-100">
                                                <i class="fa-solid fa-circle-xmark"></i>
                                                Não
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col text-end">
                                        <a href="?pagina=loja" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-circle-chevron-left"></i>
                                            Continuar comprando
                                        </a>
                                        <a href="?pagina=finalizar_pedido" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-check-to-slot me-1"></i>
                                            Resumo do pedido
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>