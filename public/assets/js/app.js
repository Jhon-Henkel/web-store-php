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