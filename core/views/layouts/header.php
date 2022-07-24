<?php
    use core\classes\Store;

    $totalPdt = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $pdt) {
            $totalPdt += $pdt;
        }
    }
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
            <?php if (store::isClientLogged()): ?>
                <a href="?pagina=perfil" class="nav-item">
                    <i class="fa-solid fa-house-chimney-user text-white"></i> <?= $_SESSION['clientName'] ?>
                </a>
                <a href="?pagina=logout" class="nav-item">
                    <i class="fa-solid fa-arrow-right-from-bracket text-white"></i>
                </a>
            <?php else: ?>
                <a href="?pagina=cliente_cadastro" class="nav-item">Criar conta</a>
                <a href="?pagina=login" class="nav-item">Login</a>
            <?php endif; ?>
            <a class="nav-item" href="?pagina=carrinho">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
            <span class="badge bg-warning" id="cartPdt"><?= $totalPdt ?></span>
        </div>
    </div>
</div>