<header>
<dialog class="embrulho">
        <span class="icon_close"><ion-icon name="close"></ion-icon></span>
        <img class="logo_rosa" src="../Imagens/logo_rosa.jpg">
        <div class="form login">
            <h2>Entrar</h2>
            <form id="form_login" class="login" method="POST">
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="text" class="form-control" placeholder="usuario" name="usuario" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="password" class="form-control" placeholder="senha" name="senha" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="lembrar_esquecer">
                    <label><input id="lembrar_sessao" class="form-check-input" name="lembrar_sessao" type="checkbox"> Lembrar de mim</label>
                    <a href="#" id="esqueci_senha">Esqueci a senha</a>
                </div>
                <button name="btn_login" type="submit" class="btn btn-submit">Entrar</button>
                <input type="hidden" name="btn_login" value="true">
                <div class="link_cadastro">
                    <a href="#" class="link_para_cadastro" >Não sou cadastrado <ion-icon name="exit"></ion-icon></a>
                </div>
            </form>
        </div>

        <div class="form cadastro1">
            <h2>Cadastro</h2>
            <form id="form_cadastro" class="cadastro" method="POST">
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="text" id="cadastro_nome_usuario" class="form-control" name="nome_usuario_cadastro" placeholder="Usuário" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="text" class="form-control" name="email_cadastro" placeholder="Email" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="password" class="form-control" name="senha_cadastro" placeholder="Senha" aria-label="Username" aria-describedby="addon-wrapping">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="password" class="form-control" name="senha_conf" placeholder="Confirmação" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <input type='button' value="Próximo" class="btn btn-submit link_para_cadastro2">
                <div class="link_cadastro">
                    <a href="#" class="link_para_login">Já sou cadastrado <ion-icon name="exit"></ion-icon></a>
                </div>
        </div>

        <div class="form cadastro2">
            <span class="icon_back link_para_foto_perfil"><ion-icon name="chevron-back-circle-outline"></ion-icon></span>
            <h2>ZOOFOBIAS</h2>
                <div class="zoofobias">
                    <label><input class="form-check-input form_zoofobias" name="fobia_cachorro" type="checkbox" value="cachorro">Cachorros</label>
                    <label><input class="form-check-input form_zoofobias" name="fobia_gato" type="checkbox" value="gato">Gatos</label>
                    <label><input class="form-check-input form_zoofobias" name="fobia_cavalo" type="checkbox" value="cavalo">Cavalos</label>
                    <label><input class="form-check-input form_zoofobias" name="fobia_bovino" type="checkbox" value="bovino">Bovinos</label>
                    <label><input class="form-check-input form_zoofobias" name="fobia_passaro" type="checkbox" value="passaro">Pássaros</label>
                    <label><input class="form-check-input form_zoofobias" name="fobia_sapo" type="checkbox" value="sapo">Sapos</label>
                    <label><input class="form-check-input form_zoofobias" name="fobia_abelha" type="checkbox" value="abelha">Abelhas</label>
                    <label><input class="form-check-input form_zoofobias" name="fobia_rato" type="checkbox" value="rato">Ratos</label>
                    <label><input class="form-check-input form_zoofobias" name="fobia_hamster" type="checkbox" value="hamsters">Hamsters</label>
                    <label><input class="form-check-input form_zoofobias" name="fobia_aranha" type="checkbox" value="aranha">Aranhas</label>
                    <label><input class="form-check-input form_zoofobias" name="fobia_inseto" type="checkbox" value="inseto">Insetos</label>
                </div>
                <input type='button' value="Próximo" class="btn btn-submit link_para_cadastro3">
                <div class="link_cadastro">
                    <a href="#" class="link_para_login">Já sou cadastrado <ion-icon name="exit"></ion-icon></a>
                </div>
        </div>

        <div class="form cadastro3">
            <span class="icon_back link_para_cadastro2"><ion-icon name="chevron-back-circle-outline"></ion-icon></span>
            <h3>Tipo de conta</h3>
                <button name="btn_submit" type="submit" class="btn btn-primary">Conta pessoal</button>
                <input type='button' name="tipo_de_conta" value="Conta veterinária" class="btn btn-primary link_para_veterinario">
                <input type='button' name="tipo_de_conta" value="Conta comercial" class="btn btn-primary link_para_comercial">
                <input type='button' name="tipo_de_conta" value="Conta para campanha de adoção" class="btn btn-primary link_para_adocao">
                <input type="hidden" id='submit_cadastro1' name="btn_submit" value="true">
                <div class="link_cadastro">
                    <a href="#" class="link_para_login">Já sou cadastrado <ion-icon name="exit"></ion-icon></a>
                </div>
        </div>

        <div class="form veterinario">
          <span class="icon_back link_para_cadastro3"><ion-icon name="chevron-back-circle-outline"></ion-icon></span>
            <h2>Veterinário</h2>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="text" class="form-control link_lattes" name="link_lattes" placeholder="Link do Currículo Lattes" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input placeholder="Especialização" list="datalist_especializacao" class="form-select" name="especializacao" id="inputGroupSelect02">
                    <datalist id="datalist_especializacao">
                        <option value="Cirurgia"></option>
                        <option value="Acupuntura"></option>
                        <option value="Patologia"></option>
                        <option value="Medicina felina"></option>
                        <option value="Diágnostico por imagem"></option>
                        <option value="Anestesiologia"></option>
                        <option value="Pequenos animais"></option>
                        <option value="Veterinária do coletivo"></option>
                        <option value="Endocrinologia"></option>
                        <option value="Animais selvagens"></option>
                        <option value="Veterinária intensiva"></option>
                        <option value="Dermatologia"></option>
                        <option value="Cardiologia"></option>
                        <option value="Oftalmologia"></option>
                        <option value="Homeopatia"></option>
                        <option value="Oncologia"></option>
                        <option value="Inspeção de produtos animais e de origem animal"></option>
                        <option value="Nefrologia e Urologia"></option>
                        <option value="Nutricao e Nutrologia"></option>
                    </datalist>
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="text" class="form-control endereco_atendimento" name="endereco_atendimento" placeholder="Endereço de atendimento" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input id="curriculo" type="file" class="form-control curriculo" name="curriculo" placeholder="Currículo" aria-label="Username" aria-describedby="addon-wrapping">
                    <label for="curriculo" id="label_curriculo">Submeta seu diploma</label>
                </div>
                <button name="btn_submit" id='submit_cadastro2' type="submit" class="btn btn-submit">Cadastrar</button>
                <input type="hidden" name="btn_submit" value="true">
                <div class="link_cadastro">
                    <a href="#" class="link_para_login">Já sou cadastrado <ion-icon name="exit"></ion-icon></a>
                </div>
        </div>

        <div class="form comercial">
          <span class="icon_back link_para_cadastro3"><ion-icon name="chevron-back-circle-outline"></ion-icon></span>
            <h2>Comercial</h2>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="text" class="form-control cnpj" name="cnpj" placeholder="CNPJ" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="text" class="form-control telefone_comercial" name="telefone_comercial" placeholder="Telefone comercial" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="text" class="form-control nome_proprietario" name="nome_proprietario" placeholder="Proprietário" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="text" class="form-control endereco_fisico" name="endereco_fisico" placeholder="Endereço(deixe em branco em caso de e-commerce)" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="time" class="form-control abertura" name="horario_abertura" placeholder="Abertura" aria-label="Username" aria-describedby="addon-wrapping">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="time" class="form-control fechamento" name="horario_fechamento" placeholder="Fechamento" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <button name="btn_submit" id='submit_cadastro3' type="submit" class="btn btn-submit">Cadastrar</button>
                <input type="hidden" name="btn_submit" value="true">
                
                <div class="link_cadastro">
                    <a href="#" class="link_para_login">Já sou cadastrado <ion-icon name="exit"></ion-icon></a>
                </div>
        </div>

        <div class="form adocao">
          <span class="icon_back link_para_cadastro3"><ion-icon name="chevron-back-circle-outline"></ion-icon></span>
            <h2>Adoção</h2>
            <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="text" class="form-control nome_da_campanha" name="nome_da_campanha" placeholder="Nome da campanha" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="text" class="form-control telefone_oficial" name="telefone_oficial" placeholder="Telefone oficial" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="text" class="form-control responsavel" name="responsavel" placeholder="Responsável" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="text" class="form-control endereco_campanha" name="endereco_campanha" placeholder="Endereço" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="time" class="form-control abertura" name="horario_abertura_campanha" placeholder="Abertura" aria-label="Username" aria-describedby="addon-wrapping">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input type="time" class="form-control fechamento" name="horario_fechamento_campanha" placeholder="Fechamento" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <button name="btn_submit" id='submit_cadastro4' type="submit" class="btn btn-submit">Cadastrar</button>
                <input type="hidden" name="btn_submit" value="true">
                <div class="link_cadastro">
                    <a href="#" class="link_para_login">Já sou cadastrado <ion-icon name="exit"></ion-icon></a>
                </div>
                </form>
        </div>
    </dialog>
    <div class="backdrop"></div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php">
        <img id="logo_navbar" src="Imagens/logo_navbar.png" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
          <img id="cachorro" src="Imagens/cachorro.png" alt="">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link">
              <span class="icone_navbar"><img src="Imagens/icone_inicio.png"></span>
              <span class="texto_navbar">Início<span>
            </a>
          </li>
          <li class="nav-item">
            <a class="link_para_cadastro nav-link">
              <span class="icone_navbar"><img src="Imagens/icone_cadastro.png"></span>
              <span class="texto_navbar">Cadastro<span>
            </a>
          </li>
          <li class="nav-item">
            <a class="link_para_login nav-link">
              <span class="icone_navbar"><img src="Imagens/icone_login.png"></span>
              <span class="texto_navbar">Entrar<span>
            </a>
          </li>
        </ul>
        <img id="gatinho" src="Imagens/gatinho.png" alt="">
      </div>
    </div>
  </nav>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</header>