const popup = document.querySelector(".embrulho");
const form_login = document.querySelector(".form.login");
const form_cadastro1 = document.querySelector(".form.cadastro1");
const form_cadastro2 = document.querySelector(".form.cadastro2");
const form_cadastro3 = document.querySelector(".form.cadastro3");
const form_veterinario = document.querySelector('.form.veterinario');
const form_comercial = document.querySelector('.form.comercial');
const form_adocao = document.querySelector('.form.adocao');
const botao_close = document.querySelector('.icon_close');

const input_foto_perfil = document.querySelector('.foto_perfil');
const label_foto_perfil = document.querySelector('#label_foto_de_perfil');
const exibir_foto_perfil = document.querySelector('#display_input_foto_de_perfil');
const input_curriculo = document.querySelector('.curriculo');
const label_curriculo = document.querySelector('#label_curriculo');

const link_para_login = document.querySelectorAll('.link_para_login');
const link_para_cadastro = document.querySelectorAll(".link_para_cadastro");
const link_para_foto_perfil = document.querySelectorAll(".link_para_foto_perfil");
const link_para_cadastro2 = document.querySelectorAll('.link_para_cadastro2');
const link_para_cadastro3 = document.querySelectorAll('.link_para_cadastro3');
const link_para_veterinario = document.querySelectorAll('.link_para_veterinario');
const link_para_comercial = document.querySelectorAll('.link_para_comercial');
const link_para_adocao = document.querySelectorAll('.link_para_adocao');
const backdrop = document.querySelector(".backdrop");

$(function(){
    $(document).on("submit", "#form_login", function(event){
        event.preventDefault();

        $.ajax({
            type:"POST",
            url: "../PHP/login.php",
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
    $(document).on("submit", "#form_cadastro", function(event){
        document.querySelector('#submit_cadastro1').disabled = true;
        document.querySelector('#submit_cadastro2').disabled = true;
        document.querySelector('#submit_cadastro3').disabled = true;
        document.querySelector('#submit_cadastro4').disabled = true;
        event.preventDefault();

        $.ajax({
            type:"POST",
            url: "../PHP/cadastro.php",
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

input_curriculo.onchange = function(){
    label_curriculo.innerHTML = input_curriculo.files[0].name;
}

function abrir_login(){
    backdrop.classList.add('aberto')
    popup.classList.add('ativo');
    form_login.classList.add('popup_aba_aberta');
    form_cadastro1.classList.remove('popup_aba_aberta');
    form_cadastro2.classList.remove('popup_aba_aberta');
    form_cadastro3.classList.remove('popup_aba_aberta');
    form_veterinario.classList.remove('popup_aba_aberta');
    form_comercial.classList.remove('popup_aba_aberta');
    form_adocao.classList.remove('popup_aba_aberta');
}

function abrir_cadastro(){
    popup.classList.add('ativo');
    backdrop.classList.add('aberto')
    form_login.classList.remove('popup_aba_aberta');
    form_cadastro1.classList.add('popup_aba_aberta');
    form_cadastro2.classList.remove('popup_aba_aberta');
    form_cadastro3.classList.remove('popup_aba_aberta');
    form_veterinario.classList.remove('popup_aba_aberta');
    form_comercial.classList.remove('popup_aba_aberta');
    form_adocao.classList.remove('popup_aba_aberta');
}

function abrir_foto_perfil(){
    popup.classList.add('ativo');
    backdrop.classList.add('aberto')
    form_login.classList.remove('popup_aba_aberta');
    form_cadastro1.classList.remove('popup_aba_aberta');
    form_cadastro2.classList.remove('popup_aba_aberta');
    form_cadastro3.classList.remove('popup_aba_aberta');
    form_veterinario.classList.remove('popup_aba_aberta');
    form_comercial.classList.remove('popup_aba_aberta');
    form_adocao.classList.remove('popup_aba_aberta');
}

function abrir_cadastro2(){
    popup.classList.add('ativo');
    backdrop.classList.add('aberto')
    form_login.classList.remove('popup_aba_aberta');
    form_cadastro1.classList.remove('popup_aba_aberta');
    form_cadastro2.classList.add('popup_aba_aberta');
    form_cadastro3.classList.remove('popup_aba_aberta');
    form_veterinario.classList.remove('popup_aba_aberta');
    form_comercial.classList.remove('popup_aba_aberta');
    form_adocao.classList.remove('popup_aba_aberta');
}

function abrir_cadastro3(){
    popup.classList.add('ativo');
    backdrop.classList.add('aberto')
    form_login.classList.remove('popup_aba_aberta');
    form_cadastro1.classList.remove('popup_aba_aberta');
    form_cadastro2.classList.remove('popup_aba_aberta');
    form_cadastro3.classList.add('popup_aba_aberta');
    form_veterinario.classList.remove('popup_aba_aberta');
    form_comercial.classList.remove('popup_aba_aberta');
    form_adocao.classList.remove('popup_aba_aberta');
    document.querySelector('.link_lattes').value = "";
    document.querySelector('.especializacao').value = "";
    document.querySelector('.endereco_atendimento').value = "";
    document.querySelector('.curriculo').value = "";
    document.querySelector('.cnpj').value = "";
    document.querySelector('.telefone_comercial').value = "";
    document.querySelector('.nome_proprietario').value = "";
    document.querySelector('.endereco_fisico').value = "";
    document.querySelector('.abertura').value = "";
    document.querySelector('.fechamento').value = "";
    document.querySelector('.nome_da_campanha').value = "";
    document.querySelector('.telefone_oficial').value = "";
    document.querySelector('.responsavel').value = "";
    document.querySelector('.endereco_campanha').value = "";
}

function abrir_veterinario(){
    popup.classList.add('ativo');
    backdrop.classList.add('aberto')
    form_login.classList.remove('popup_aba_aberta');
    form_cadastro1.classList.remove('popup_aba_aberta');
    form_cadastro2.classList.remove('popup_aba_aberta');
    form_cadastro3.classList.remove('popup_aba_aberta');
    form_veterinario.classList.add('popup_aba_aberta');
    form_comercial.classList.remove('popup_aba_aberta');
    form_adocao.classList.remove('popup_aba_aberta');
}

function abrir_comercial(){
    popup.classList.add('ativo');
    backdrop.classList.add('aberto')
    form_login.classList.remove('popup_aba_aberta');
    form_cadastro1.classList.remove('popup_aba_aberta');
    form_cadastro2.classList.remove('popup_aba_aberta');
    form_cadastro3.classList.remove('popup_aba_aberta');
    form_veterinario.classList.remove('popup_aba_aberta');
    form_comercial.classList.add('popup_aba_aberta');
    form_adocao.classList.remove('popup_aba_aberta');
}

function abrir_adocao(){
    popup.classList.add('ativo');
    backdrop.classList.add('aberto')
    form_login.classList.remove('popup_aba_aberta');
    form_cadastro1.classList.remove('popup_aba_aberta');
    form_cadastro2.classList.remove('popup_aba_aberta');
    form_cadastro3.classList.remove('popup_aba_aberta');
    form_veterinario.classList.remove('popup_aba_aberta');
    form_comercial.classList.remove('popup_aba_aberta');
    form_adocao.classList.add('popup_aba_aberta');
}

link_para_login.forEach(function(link){
    link.onclick = function(){
        abrir_login();
    };
});

link_para_cadastro.forEach(function(link){
    link.onclick = function(){
        abrir_cadastro();
    };
});

link_para_foto_perfil.forEach(function(link){
    link.onclick = function(){
        abrir_foto_perfil();
    }
})

link_para_cadastro2.forEach(function(link){
    link.onclick = function(){
        abrir_cadastro2();
    };
});

link_para_cadastro3.forEach(function(link){
    link.onclick = function(){
        abrir_cadastro3();
    };
});

link_para_veterinario.forEach(function(link){
    link.onclick = function(){
        abrir_veterinario();
    };
});

link_para_comercial.forEach(function(link){
    link.onclick = function(){
        abrir_comercial();
    };
});

link_para_adocao.forEach(function(link){
    link.onclick = function(){
        abrir_adocao();
    };
});

botao_close.onclick = function(){
    popup.classList.remove('ativo')
    backdrop.classList.remove('aberto')
};