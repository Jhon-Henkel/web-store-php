<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-1">
            <?php include (__DIR__ . '/layouts/admin-menu.php')?>
        </div>
        <div class="col-md-11">
            <h3>Clientes</h3>
            <hr>
            <?php if (count($data['clientes']) == 0): ?>
                <div class="alert alert-danger p-2 text-center">
                    <span class="me-3">
                        <i class="fa-solid fa-circle-info me-2"></i>
                        Não existem clientes cadastrados!
                    </span>
                </div>
            <?php else: ?>
                <table class="table table-striped table-sm" id="clientTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="col-1 text-center">Detalhes</th>
                            <th class="text-center">Cliente</th>
                            <th class="text-center">Pedidos</th>
                            <th class="text-center">E-mail</th>
                            <th class="text-center">Telefone</th>
                            <th class="text-center">Ativo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['clientes'] as $cliente): ?>
                            <tr>
                                <td class="col-1 text-center">
                                    <a href="?pagina=detalhes-cliente&id=<?= $cliente->id_cliente ?>">
                                        <i class="fa-solid fa-circle-info me-2"></i>
                                    </a>
                                </td>
                                <td class="text-center"><?= $cliente->nome_cliente ?></td>
                                <td class="text-center">
                                    <?php if ($cliente->totalPedidos != 0): ?>
                                        <a href="?pagina=pedidos-do-cliente&id=<?= $cliente->id_cliente ?>">
                                            <i class="fa-solid fa-eye ms-2 me-2"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?= $cliente->totalPedidos ?>
                                </td>
                                <td class="text-center"><?= $cliente->email_cliente ?></td>
                                <td class="text-center"><?= empty($cliente->telefone_cliente) ? 'Não cadastrado' : $cliente->telefone_cliente ?></td>
                                <td class="text-center">
                                    <?php if ($cliente->status_cliente == 1): ?>
                                        <i class="fa-solid fa-circle-check text-success"></i>
                                    <?php else: ?>
                                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>


<script>
    $(document).ready( function () {
        $('#clientTable').DataTable(
            {
                language: {
                    decimal: ',',
                    thousands: '.',
                    search: 'Procurar',
                    lengthMenu: 'Mostrar _MENU_ por página',
                    info: 'Mostrando _PAGE_ de _PAGES_',
                    infoEmpty: 'Sem resultados disponíveis',
                    infoFiltered: '(filtrado de _MAX_ resultados totais)',
                    zeroRecords: 'Nada para mostrar',
                    paginate: {
                        first: 'Primeira',
                        last: 'Ultima',
                        next: 'Próxima',
                        previous: 'Anterior'
                    },
                },
            }
        );
    } );

    function changeStatusFilter(){
        let filter = document.getElementById('statusList').value;
        window.location.href = window.location.pathname + '?' + $.param({
            'pagina' : 'pedidos',
            'status': filter
        })
    }

</script>