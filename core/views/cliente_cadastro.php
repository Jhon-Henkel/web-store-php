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
                    <input class="form-control" type="text" name="endereco_cliente" placeholder="Onde você mora?" required>
                </div>

                <div class="my-3">
                    <label>Cidade</label>
                    <input class="form-control" type="text" name="cidade_cliente" placeholder="Onde você mora?" required>
                </div>

                <div class="my-3">
                    <label>Telefone</label>
                    <input class="form-control" type="text" name="telefone_cliente" placeholder="Seu telefone">
                </div>

                <div class="my-4">
                    <input class="btn btn-primary" type="submit" value="Cadastrar">
                </div>

            </form>

        </div>
    </div>
</div>