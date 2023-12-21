var pesquisar = false;

$(function(){
    $('#barra_de_pesquisa').keydown(function(){
        clearTimeout(this.interval);
        this.interval = setTimeout(function(){
            pesquisar = true;
            if (pesquisar){
                $.ajax({
                    url: "../PHP/pesquisar_usuarios.php?value=" + document.querySelector("#barra_de_pesquisa").value,
                    success: function(response){
                        document.querySelector("#resultados_pesquisa").innerHTML = "";
                        response.dados.forEach(element => {
                            document.querySelector("#resultados_pesquisa").innerHTML += element;
                        });
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText, status, error);
                    }
                })
            }
        }, 1000);
    })
})