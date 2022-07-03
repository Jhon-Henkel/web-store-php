function addToCart(id_pdt) {

    axios.default.withCredentials = true;
    axios.get('?pagina=carrinho_add&id_pdt=' + id_pdt)
        .then(function (response){
            document.getElementById('cartPdt').innerText = response.data;
        });
}

function confirmExcludeCart() {
    var elementExclude = document.getElementById("confirmExcludeCart");
    elementExclude.style.display = "inline";
}

function confirmExcludeCartOff() {
    var elementExclude = document.getElementById("confirmExcludeCart");
    elementExclude.style.display = "none";
}

function showAlterarEndereco() {
    var endereco = document.getElementById("alterarEndereco");
    if (endereco.checked === true) {
        document.getElementById("novoEndereco").style.display = 'block';
    } else {
        document.getElementById("novoEndereco").style.display = 'none';
    }
}

function alternativeData() {
    axios({
        method: 'post',
        url: '?pagina=dados_alternativos',
        data: {
            endereco: document.getElementById('enderecoAlternativo').value,
            cidade: document.getElementById('cidadeAlternativa').value,
            telefone: document.getElementById('telefoneAlternativo').value,
            email: document.getElementById('emailAlternativo').value
        }
    }).then(function (response) {

    });
}