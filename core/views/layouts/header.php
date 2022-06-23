<?php
use core\classes\Store;
//$_SESSION['client'] = true;
?>

<div class="container-fluid navigation">
    <div class="row">
        <div class="col-6 p-3">
            <a href="?pagina=inicio">
                <h3><?= APP_NAME ?></h3>
            </a>
        </div>
        <div class="col-6 text-end p-3">
            <a href="?pagina=inicio" class="nav-item">Inicio</a>
            <a href="?pagina=loja" class="nav-item">Loja</a>

            <!--verifica se existe cliente na sessão-->
            <?php if (store::isClientLogged()): ?>
                <a href="" class="nav-item">Minha conta</a>
                <a href="" class="nav-item">Logout</a>
            <?php else: ?>
                <a href="?pagina=cliente_cadastro" class="nav-item">Criar conta</a>
                <a href="" class="nav-item">Login</a>
            <?php endif; ?>

            <a href="?pagina=carrinho"><i class="fa-solid fa-cart-shopping"></i></i></a>
            <span class="badge bg-warning"></span>
        </div>
    </div>
</div>