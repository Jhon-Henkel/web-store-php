<div class="container">
    <div class="row my-5">
        <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1">
            <form action="" method="post">
                <div>
                    <label class="form-label" for="email">Email: </label>
                    <input class="form-control" id="email" type="email" name="email" required value="<?= $data['personalData']->email_cliente ?>">

                    <label class="form-label" for="nome">Nome: </label>
                    <input class="form-control" id="nome" type="text" name="nome" required value="<?= $data['personalData']->nome_cliente ?>">

                    <label class="form-label" for="endereco">Endereço: </label>
                    <input class="form-control" id="endereco" type="text" name="endereco" required value="<?= $data['personalData']->endereco_cliente ?>">

                    <label class="form-label" for="cidade">Cidade: </label>
                    <input class="form-control" id="cidade" type="text" name="cidade" required value="<?= $data['personalData']->cidade_cliente ?>">

                    <label class="form-label" for="telefone">Email: </label>
                    <input class="form-control" id="telefone" type="text" name="telefone" required value="<?= $data['personalData']->telefone_cliente ?>">
                </div>
                <div>
                    <a class="btn btn-danger btn-sm my-4" href="?pagina=perfil">Cancelar</a>
                    <input class="btn btn-primary btn-sm my-4" type="submit" value="Salvar dados">
                </div>
            </form>
        </div>
    </div>
</div>