<div class="container">
    <div class="row my-5">
        <div class="col">
            <table class="table table-striped">
                <?php foreach ($data['clientData'] as $key=>$value): ?>
                    <tr>
                        <td class="text-start"><?= $key ?>: </td>
                        <td ><strong><?= $value ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>