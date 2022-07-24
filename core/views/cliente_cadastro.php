<div class="container">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center">Cadastro de cliente</h3>
            <form action="?pagina=cliente_criar" method="post">
                <div class="my-3">
                    <label>E-mail</label>
                    <input class="form-control" type="email" name="cliente_email" placeholder="email@dominio.com" required>
                </div>
                <div class="my-3">
                    <label>Senha</label>
                    <input class="form-control" type="password" name="cliente_senha1" placeholder="senha" required>
                </div>
                <div class="my-3">
                    <label>Confirme sua senha</label>
                    <input class="form-control" type="password" name="cliente_senha2" placeholder="senha" required>
                </div>
                <div class="my-3">
                    <label>Nome Completo</label>
                    <input class="form-control" type="text" name="cliente_nome" placeholder="Seu nome" required>
                </div>
                <div class="my-3">
                    <label>Endereço</label>
                    <input class="form-control" type="text" name="cliente_endereco" placeholder="Onde você mora?" required>
                </div>
                <div class="my-3">
                    <label>Cidade</label>
                    <input class="form-control" type="text" name="cliente_cidade" placeholder="Onde você mora?" required>
                </div>
                <div class="my-3">
                    <label>Telefone</label>
                    <input class="form-control" type="text" name="cliente_telefone" placeholder="Seu telefone">
                </div>
                <div class="my-4">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa-solid fa-user-check"></i>
                        Cadastrar
                    </button>
                </div>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger text-center p-2">
                        <?= $_SESSION['error'] ?>
                        <?php unset ($_SESSION['error']) ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>