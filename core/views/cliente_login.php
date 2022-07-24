<div class="container">
    <div class="row my-5">
        <div class="col-sm-4 offset-sm-4">
            <h3 class="text-center">Login</h3>
            <form action="?pagina=login_submit" method="post">
                <div class="my-3">
                    <div class="my-3">
                        <label class="text-start">Usuário:</label>
                        <input class="form-control" type="email" name="user_email" placeholder="Usuário" required>
                    </div>
                    <div class="my-3">
                        <label>Senha:</label>
                        <input class="form-control" type="password" name="user_pass" placeholder="Senha" required>
                    </div>
                    <div class="my-3 text-center">
                        <button class="btn btn-primary btn-150 btn-sm" type="submit">
                            <i class="fa-solid fa-user-check"></i>
                            Login
                        </button>
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