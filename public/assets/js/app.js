function addToCart(id_pdt) {

    axios.default.withCredentials = true;
    axios.get('?pagina=carrinho_add&id_pdt=' + id_pdt)
        .then(function (response){
            document.getElementById('cartPdt').innerText = response.data;
        });
}

function cleanCart() {
    axios.default.withCredentials = true;
    axios.get('?pagina=clean_cart')
        .then(function (response){
            document.getElementById('cartPdt').innerText = 0;
        });
}