<div class="container">
    <div class="row my-5">
        <div class="col-sm-4 offset-sm-4">
            <h3 class="text-center">Login Admin</h3>

            <form action="?pagina=admin-login-submit" method="post">
                <div class="my-3">

                    <div class="my-3">
                        <label class="text-start">Administrador:</label>
                        <input class="form-control" type="text" name="adminLogin" placeholder="Admin" required>
                    </div>

                    <div class="my-3">
                        <label>Senha:</label>
                        <input class="form-control" type="password" name="adminPass" placeholder="Senha" required>
                    </div>

                    <div class="my-3 text-center">
                        <input class="btn btn-primary" type="submit" value="login">
                    </div>
            </form>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger text-center">
                    <?= $_SESSION['error'] ?>
                    <?php unset($_SESSION['error']) ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>