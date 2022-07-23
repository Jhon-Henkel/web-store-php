<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-2">
            <?php include (__DIR__ . '/layouts/admin-menu.php') ?>
        </div>
        <div class="col-md-10">
            <h3>Detalhes Cliente</h3>
            <hr>
            <div class="row mt-3">
                <div class="col-2 fw-bold">Nome:</div>
                <div class="col-10"><?= $data['cliente']->nome_cliente ?></div>

                <div class="col-2 fw-bold mt-2">Endereço:</div>
                <div class="col-10 mt-2"><?= $data['cliente']->endereco_cliente ?></div>

                <div class="col-2 fw-bold mt-2">Cidade:</div>
                <div class="col-10 mt-2"><?= $data['cliente']->cidade_cliente ?></div>

                <div class="col-2 fw-bold mt-2">Telefone:</div>
                <div class="col-10 mt-2"><?= empty($data['cliente']->telefone_cliente) ? 'Não cadastrado' : $data['cliente']->telefone_cliente ?></div>

                <div class="col-2 fw-bold mt-2">E-mail:</div>
                <div class="col-10 mt-2"><?= $data['cliente']->email_cliente ?></div>

                <?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $data['cliente']->data_cadastro); ?>
                <div class="col-2 fw-bold mt-2">Data Cadastro:</div>
                <div class="col-10 mt-2"><?= $date->format('d/m/Y') ?></div>

                <div class="col-2 fw-bold mt-2">Status:</div>
                <div class="col-10 mt-2">
                    <?php if ($data['cliente']->status_cliente == 0): ?>
                        <i class="fa-solid fa-circle-xmark text-danger me-2"></i>
                        Inativo
                    <?php else: ?>
                        <i class="fa-solid fa-circle-check text-success me-2"></i>
                        Ativo
                    <?php endif;?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php if ($data['totalPedidos'] == 0): ?>
                        <div class="alert alert-danger text-center mt-5">
                            <i class="fa-solid fa-circle-xmark text-danger"></i>
                            Não existem pedidos para esse cliente!
                        </div>
                    <?php else: ?>
                        <a href="?pagina=pedidos-do-cliente&id=<?= $data['cliente']->id_cliente ?>" class="btn btn-primary btn-sm mt-2">Ver pedidos</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>