<div class="container-fluid navigation">
    <div class="row">
        <div class="col-6 p-3">
            <h3><?= APP_NAME ?></h3>
        </div>
        <div class="col-6 p-3 text-end align-self-center">
            <?php if (\core\classes\Store::isAdminLogged()): ?>
                <i class="fa-solid fa-user me-1"></i>
                <?= $_SESSION['user'] ?>
                <span class="mx-2">|</span>
                <a href="?pagina=admin-logout" class="text-dark">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>