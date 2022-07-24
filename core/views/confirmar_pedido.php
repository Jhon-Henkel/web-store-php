<div class="container">
    <div class="row my-5">
        <div class="col text-center">
            <h3 class="text-center">Pedido efetuado com sucesso!!!</h3>
            <p>Muito obrigado pela sua preferencia</p>
            <div class="my-5">
                <h4>Dados pagamento</h4>
                <p>Pix: <strong>123456789</strong></p>
                <?php $utilString = new \core\util\UtilString() ?>
                <p>Código pedido: <strong><?= $cdOrder ?></strong></p>
                <p>Total pedido: <strong><?= $utilString->formatPrice($totalOrder) ?></strong></p>
            </div>
            <p>
                Vai receber um e-mail com a confirmação do pedido e os dados de pagamento
                <br>
                O seu pedido só será confirmado após a confirmação de pagamento.
            </p>
            <p>
                <small>
                    Por favor, verifique seu e-mail, caso o e-mail não se encontre na caixa de entrada,
                    <br>
                    verifique o <strong>SPAM</strong> e a <strong>lixeira</strong>.
                </small>
            </p>
            <div class="my-5">
                <a href="?pagina=inicio" class="btn btn-primary">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                    Voltar ao inicio
                </a>
            </div>
        </div>
    </div>
</div>