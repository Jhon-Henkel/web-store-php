function addToCart(id_pdt) {

    axios.default.withCredentials = true;
    axios.get('?pagina=addToCart&id_pdt=' + id_pdt)
        .then(function (response){
            console.log(response);
        });

}