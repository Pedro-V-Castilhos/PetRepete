const popup = document.querySelector(".embrulho");
const popup_foto_de_perfil = document.querySelector(".embrulho_foto_perfil");
const popup_denuncia = document.querySelector(".embrulho.denunciar");
const backdrop = document.querySelector('.backdrop');
const link_para_postar = document.querySelectorAll(".link_para_postar");
const botao_close = document.querySelectorAll('.icon_close');
const curtidas = document.querySelectorAll('.curtida');
const link_comentar = document.querySelectorAll('.comentar');
const deletar_post = document.querySelectorAll('.deletar_postagem');
const denunciar_postagem = document.querySelectorAll('.denunciar_postagem');
const submeter_denuncia = document.querySelector('#submeter_denuncia');
var post_mae = 0;
var id_denunciar = 0;

deletar_post.forEach(function(botao){
    botao.onclick = function(){
        id = botao.id.slice(17);
        $.ajax({
            url: "../PHP/deletar_post.php?post=" + id + "&&url=" + window.location.href,
            success: function(response){
                if(response.redirect){
                    window.location.href = response.redirect;
                }else if(response.message){
                    alert(response.message);
                }
            },
            error: function(xhr, status, error){
                window.alert("Erro:", xhr, status, error);
            }
        })
    }
})

denunciar_postagem.forEach(function(botao){
    botao.onclick = function(){
        id_denunciar = botao.id.slice(19);
        document.querySelector('#form_denuncia').action = 'denunciar_post.php?post=' + id_denunciar + '&&url=' + window.location.href;
        abrir_denuncia();
    }
})

document.querySelector('#form_denuncia').onsubmit = function(){
    submeter_denuncia.disabled = true;
}

link_comentar.forEach(function(link){
    link.onclick = function(){
        abrir_postar();
        post_mae = link.id.slice(9);
    }
})

link_para_postar.forEach(function(link){
    link.onclick = function(){
        abrir_postar();
        post_mae = 0;
    };
})



curtidas.forEach(function(individual){
    var indice = individual.classList.item(1).slice(9);
    individual.onclick = function(){
        if (!individual.classList.contains('clicked')){
            $.ajax({
                url: "../PHP/curtir.php?curtir=" + indice,
                success: function(){
                    document.querySelector('.curtidas_' + indice).classList.add('clicked');
                    document.querySelector('.curtidas_' + indice).innerHTML = "<i class='bi bi-chat-square-heart-fill'></i>";
                    if (document.getElementById(indice) != null){
                        document.getElementById(indice).innerHTML = parseInt(document.getElementById(indice).innerHTML) + 1;
                    }
                },
                error: function(xhr, status, error){
                    window.alert("Erro:", xhr, status, error);
                }
            })
        }else{
            $.ajax({
                url: "../PHP/curtir.php?descurtir=" + indice,
                success: function(){
                    document.querySelector('.curtidas_' + indice).classList.remove('clicked');
                    document.querySelector('.curtidas_' + indice).innerHTML = "<i class='bi bi-chat-square-heart'></i>";
                    if (document.getElementById(indice) != null){
                        document.getElementById(indice).innerHTML = parseInt(document.getElementById(indice).innerHTML) - 1;
                    }
                },
                error: function(xhr, status, error){
                    window.alert("Erro:", xhr, status, error);
                }
            })
        }
    }
});

function abrir_postar(id_post_mae){
    popup.classList.add('ativo');
    backdrop.classList.add('aberto')
}

function abrir_denuncia(){
    popup_denuncia.classList.add('ativo');
    backdrop.classList.add('aberto');
}

botao_close.forEach(function(botao){
    botao.onclick = function(){
        popup_denuncia.classList.remove('ativo');
        popup.classList.remove('ativo')
        backdrop.classList.remove('aberto')
        if (popup_foto_de_perfil != null){
            popup_foto_de_perfil.classList.remove('ativo')
        }
    }
})

$(function(){
    $(document).on("submit", "#form_postar", function(event){
        event.preventDefault();
        var form = $('#form_postar')[0];
        var data = new FormData(form);

        $.ajax({
            type:"POST",
            enctype: 'multipart/form-data',
            url: "../PHP/postar.php?post_mae=" + post_mae,
		    data: data,
            processData: false,
            contentType: false,
            cache: false,
		    success: function(response) {
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else if (response.message) {
                    alert(response.message);
                }
		    },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        })
    })
})


$(function(){
    $('#foto_pra_postar').change(function(){
        const foto = $(this)[0].files[0];
        const fileReader = new FileReader();
        fileReader.onloadend = function(){
            $('#display_foto_pra_postar').attr('src', fileReader.result);
        }
        fileReader.readAsDataURL(foto);
    })
})

const txtarea = document.querySelector(".conteudo_do_post");

txtarea.addEventListener("keydown", function(){
    console.log('Ts')
    txtarea.style.height = "1px";
    txtarea.style.height = txtarea.scrollHeight+"px";
 });

