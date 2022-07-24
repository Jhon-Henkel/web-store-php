<div class="container-fluid">
    <div class="row my-5">
        <div class="col-md-2">
            <?php
                include __DIR__ . '/cliente_perfil_menu.php';
            ?>
        </div>
        <div class="col-md-10">
            <h2 class="text-center mb-5">Dados pessoais</h2>
            <table class="table table-striped">
                <?php foreach ($data['clientData'] as $key=>$value): ?>
                <?php
                    if ($key == 'Telefone' && $value == '') {
                        $value = 'Não informado';
                    }
                ?>
                    <tr>
                        <td class="text-start"><?= $key ?>: </td>
                        <td ><strong><?= $value ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>