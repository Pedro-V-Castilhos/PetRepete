
const input_foto_perfil = document.querySelector('.foto_perfil');
const label_foto_perfil = document.querySelector('#label_foto_de_perfil');
const exibir_foto_perfil = document.querySelector('#display_input_foto_de_perfil');

const quadrados_fobias = document.querySelectorAll('.fobia');

$(function(){
    $(document).on("click", "#botao_editar", function(event){
        event.preventDefault();
        document.querySelector(".nome_usuario").innerHTML = "<input name='nome_usuario' type='text' value=" + document.querySelector(".nome_usuario").innerHTML + "></input>";
        document.querySelector(".email_usuario").innerHTML = "<input name='email_usuario' type='text' value=" + document.querySelector(".email_usuario").innerHTML + "></input>";
        document.querySelector("#botao_editar").type = "submit"
        document.querySelector("#botao_editar").id = "enviar_edicao";
    })
})

$(function(){
    $(document).on("click", "#botao_seguir", function(event){
        event.preventDefault();
        var id_usuario = document.querySelector("#botao_seguir").classList[1].slice(8);

        if(document.querySelector('#botao_seguir').classList[0] == 'seguir'){
            $.ajax({
                url:"../PHP/seguir_usuario.php?seguir=" + id_usuario,
                success: function(){
                    document.querySelector('.div_seguir').innerHTML = "<button id='botao_seguir' type='button' class='deseguir usuario_" + id_usuario + " btn btn-terciary'>Deixar de seguir</button>";
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText); // Exibe o erro no console
                }
            })
        }else{
            $.ajax({
                url:"../PHP/seguir_usuario.php?deseguir=" + document.querySelector("#botao_seguir").classList[1].slice(8),
                success: function(){
                    document.querySelector('.div_seguir').innerHTML = "<button id='botao_seguir' type='button' class='seguir usuario_" + id_usuario + " btn btn-terciary'>Seguir</button>";
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText); // Exibe o erro no console
                }
            })
        }
    })
})

$(function(){
    $(document).on("click", "#botao_deletar_conta", function(event){
        console.log('AQQQQ')
        event.preventDefault();
        $.ajax({
            url:"../PHP/deletar_conta.php",
            success: function(response){
                if (response.redirect){
                    window.location.href = response.redirect;
                }else if(response.message){
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText); // Exibe o erro no console
            }
        })
    })
})

$(function(){
    $(document).on("submit", "#form_editar", function(event){
        event.preventDefault();

        $.ajax({
            type:"POST",
            url: "../PHP/editar_usuario.php",
		    data: $(this).serialize(),
		    dataType: "json",
		    success: function(response) {
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else if (response.message) {
                    alert(response.message); // Exibe a mensagem de erro no console
                }
		    },
            error: function(xhr, status, error) {
                alert(xhr.responseText); // Exibe o erro no console
            }
        })
    })
})

$(function(){
    $(document).on("submit", "#form_editar", function(event){
        event.preventDefault();

        $.ajax({
            type:"POST",
            url: "../PHP/editar_usuario.php",
		    data: $(this).serialize(),
		    dataType: "json",
		    success: function(response) {
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else if (response.message) {
                    alert(response.message); // Exibe a mensagem de erro no console
                }
		    },
            error: function(xhr, status, error) {
                alert(xhr.responseText); // Exibe o erro no console
            }
        })
    })
})

function abrir_editar_foto(){
    popup_foto_de_perfil.classList.add('ativo');
    backdrop.classList.add('aberto');
}

const botao_editar_foto_perfil = document.querySelector('.editar_foto_de_perfil');

if (botao_editar_foto_perfil != null){
    botao_editar_foto_perfil.onclick = function(){
        abrir_editar_foto();
    }
}

$(function(){
    $('#foto_de_perfil').change(function(){
        label_foto_perfil.innerHTML = input_foto_perfil.files[0].name;
        const foto = $(this)[0].files[0];
        const fileReader = new FileReader();
        fileReader.onloadend = function(){
            $('#display_input_foto_de_perfil').attr('src', fileReader.result);
        }
        fileReader.readAsDataURL(foto);
    })
})

botao_close.onclick = function(){
    popup.classList.remove('ativo')
    popup_foto_de_perfil.classList.remove('ativo')
    backdrop.classList.remove('aberto')
};

quadrados_fobias.forEach(function(fobia){
    fobia.onclick = function(){
        fobia_pra_deletar = fobia.id;
        $.ajax({
            type:"POST",
            url: "../PHP/deletar_fobia.php?nome_usuario&&fobia=" + fobia_pra_deletar,
		    data: $(this).serialize(),
		    dataType: "json",
		    success: function(response) {
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else if (response.message) {
                    alert(response.message); // Exibe a mensagem de erro no console
                }
		    },
            error: function(xhr, status, error) {
                alert(xhr.responseText); // Exibe o erro no console
            }
        })
    }
})