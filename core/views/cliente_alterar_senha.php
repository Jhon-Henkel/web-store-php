<div class="container">
    <div class="row my-5">
        <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1">
            <form action="?pagina=alterar_senha_submit" method="post">
                <div>
                    <label class="form-label" for="senhaAtual">Senha atual: </label>
                    <input class="form-control" id="senhaAtual" type="password" name="senhaAtual" required>

                    <label class="form-label" for="senhaNova1">Nova senha: </label>
                    <input class="form-control" id="senhaNova1" type="password" name="senhaNova1" required>

                    <label class="form-label" for="senhaNova2">Repetir nova senha: </label>
                    <input class="form-control" id="senhaNova2" type="password" name="senhaNova2" required>
                </div>
                <div class="text-center">
                    <a class="btn btn-danger btn-sm my-4 btn-100" href="?pagina=perfil">Cancelar</a>
                    <input class="btn btn-primary btn-sm my-4 btn-100" type="submit" value="Salvar">
                </div>
            </form>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger text-center p-2">
                    <?= $_SESSION['error'] ?>
                    <?php unset($_SESSION['error']) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>