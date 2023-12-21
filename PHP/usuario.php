<?php
    session_start();
    include("login.php");
    include("header_conectado.php");
    include("connect_db.php");
    $referencia = $_GET['user'];
    $usuario = $connection->query("SELECT * FROM usuarios WHERE nome = '$referencia'") or die("Erro");
    $usuario = $usuario->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/usuario.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title><?php echo $referencia?></title>
</head>
<body>
<dialog class="embrulho">
        <span class="icon_close"><ion-icon name="close"></ion-icon></span>
        <form id="form_postar" class="form postar" method="POST" enctype="multipart/form-data">
            <div class='preview_postagem'>
                <textarea name="msg_teste" class="conteudo_do_post" placeholder="Conte-nos algo..." rows="8" maxlength="255"></textarea>
                <div id="display"><img id="display_foto_pra_postar" src=''></div>
            </div>
            <div class="input-group">
                <input id="foto_pra_postar" type="file" accept="image/x-png,image/jpeg,image/jpg" class="form-control foto_perfil" name="foto_pra_postar" placeholder="foto_de_perfil" aria-label="Username" aria-describedby="addon-wrapping">
                <label for="foto_pra_postar" id="label_foto"><i class="bi bi-card-image"></i></label>
            </div>
            <div class='hashtags_postagem'>
            <h4 class='o_conteudo_'>O conteúdo contém...</h4>
            <div class="zoofobias_postagem">
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
        </div>
            <button id='botao_postar' name="btn_postar" type="submit" class="btn btn-submit">Postar</button>
            <input type="hidden" name="btn_postar" value="true">
        </form>
    </dialog>
    <dialog class="embrulho denunciar">
        <span class="icon_close"><ion-icon name="close"></ion-icon></span>
        <form id="form_denuncia" class="form denunciar" method="POST" enctype="multipart/form-data">
            <h3>Denúncia</h3>
            <input type='radio' class='radio_denuncia' value='ferir_direitos_animais' id='ferir_direitos_animais' name='radio_denuncia'>
            <label for='ferir_direitos_animais'>A postagem fere os direitos dos animais</label><br>
            <input type='radio' class='radio_denuncia' value='mensagens_odio' id='mensagens_odio' name='radio_denuncia'>
            <label for='mensagens_odio'>A postagem profere mensagens de ódio</label><br>
            <input type='radio' class='radio_denuncia' value='apologia_zoofilia' id='apologia_zoofilia' name='radio_denuncia'>
            <label for='apologia_zoofilia'>A postagem apresente apologia à zoofilia</label><br>
            <input type='radio' class='radio_denuncia' value='minha_zoofobia' id='minha_zoofobia' name='radio_denuncia'>
            <label for='minha_zoofobia'>O conteúdo da postagem é sobre minha zoofobia</label><br>
            <input id="submeter_denuncia" name="btn_denunciar" type="submit" class="btn btn-submit" value='Denunciar'>
            <input type="hidden" name="btn_denunciar" value="true">
        </form>
    </dialog>
    <dialog class="embrulho embrulho_foto_perfil">
        <span class="icon_close"><ion-icon name="close"></ion-icon></span>
        <div class="form foto_de_perfil">
            <h3>Foto de Perfil</h3>
            <form action="editar_foto.php" id="form_foto_de_perfil" class="form form_foto_de_perfil" method="POST" enctype="multipart/form-data">
                <img id="display_input_foto_de_perfil" src="<?php echo $usuario['foto_perfil']?>">
                <div class="input-group">
                    <span class="input-group-text" id="addon-wrapping"><ion-icon name="paw"></ion-icon></span>
                    <input id="foto_de_perfil" type="file" accept="image/x-png,image/jpeg,image/jpg" class="form-control foto_perfil" name="foto_de_perfil" placeholder="foto_de_perfil" aria-label="Username" aria-describedby="addon-wrapping">
                    <label for="foto_de_perfil" id="label_foto_de_perfil">Submeta sua foto de perfil</label>
                </div>
                <button id="enviar_foto_de_perfil">Escolher</button>
            </form>
        </div>
    </dialog>
    <form id="form_editar" method="POST">
        <div class='informacoes_usuario'>
            <div class='informacoes_escritas_usuario'>
                <?php
                    if ($usuario['id'] == $_SESSION['id']){
                        $primeiro_nome = explode(" ", $usuario['nome'])[0];
                        echo "<p class='msg_bem_vindo'>Bem vindo(a), ".$primeiro_nome."!</p>
                                <div class='informacoes_menores'><p id='nome_usuario' class='nome_usuario'>".$usuario['nome']."</p>";
                    }else{
                        echo "<div class='informacoes_menores'><h2 id='nome_usuario' class='nome_usuario'>".$usuario['nome']."</h2>";
                    }
                ?>
                    <p class="email_usuario"><?php echo $usuario['email']?></p>
                </div>
            </div>
            <div class='foto_usuario'>
                <img id="foto_perfil_no_perfil" src = "<?php echo $usuario['foto_perfil']?>" alt="Foto_perfil_<?php echo $usuario['nome']?> " >
                <?php
                    if ($usuario['id'] == $_SESSION['id']){
                        echo "<button type='button' class='btn btn-secundary editar_foto_de_perfil'>Editar foto de perfil</button>";
                    }
                ?>
            </div>
            <div class='botoes_usuario'>
                <?php
                    if ($usuario['id'] == $_SESSION['id']){
                        echo "<div><button type='button' name='botao_editar' id='botao_editar' class='btn btn-terciary botao_editar'><i class='bi bi-pencil-square'></i> Editar</button>
                                <input type='hidden' name='botao_editar' value='true'></form></div>
                                <div><button type='button' name='botao_deletar_conta' id='botao_deletar_conta' class='btn btn-terciary botao_deletar_conta'><i class='bi bi-x-octagon'></i> Deletar</button>
                                <input type='hidden' name='botao_deletar_conta' value='true'></div>
                                <form id='form_usuario' action='logout.php'><button type='submit' class='btn btn-terciary botao_logout'><i class='bi bi-box-arrow-right'></i> Sair</button></form>";
                    }else{
                        $query_esta_seguindo = $connection->query("SELECT * FROM usuario_segue_artista WHERE id_artista='$usuario[id]' AND id_usuario='$_SESSION[id]'");
                        if ($query_esta_seguindo->num_rows == 0){
                            echo "<div class='div_seguir'><button id='botao_seguir' type='button' class='seguir usuario_$usuario[id] btn btn-terciary'>Seguir</button></div>";
                        }else{
                            echo "<div class='div_seguir'><button id='botao_seguir' type='button' class='deseguir usuario_$usuario[id] btn btn-terciary'>Deixar de seguir</button></div>";
                        }
                    }
                ?>
            </div>
        </div>
    </form>
    <?php
        $tem_zoofobias = $connection->query("SELECT * FROM usuario_tem_fobia WHERE id_usuario='$usuario[id]'");
        $seguindo = $connection->query("SELECT * FROM usuario_segue_artista WHERE id_usuario='$usuario[id]'");
        if ($usuario['id'] == $_SESSION['id']){
            if ($tem_zoofobias->num_rows !=0){
                echo "<div class='area_secoes'>
                    <h2 class='titulo_secoes'>Zoofobias</h2>
                    <div class='display_secao'>";
                while ($fobia = $tem_zoofobias->fetch_assoc()){
                    echo "<div id='$fobia[fobia]' class='fobia'><i class='bi bi-x-circle'></i>". ucwords($fobia['fobia']). "</div>";
                }
            }
            echo "</div></div><div class='area_secoes'>
                <h2 class='titulo_secoes'>Aumigos</h2>
                <div class='display_secao'>";
            while ($esta_seguindo = mysqli_fetch_assoc($seguindo)){
                if ($connection->query("SELECT * FROM usuario_segue_artista WHERE id_usuario='$esta_seguindo[id_artista]' AND id_artista='$usuario[id]'")->num_rows == 1){
                    $artista = $connection->query("SELECT * FROM usuarios WHERE id='$esta_seguindo[id_artista]'")->fetch_assoc();
                    echo "<a class='link_aumigo' href='usuario.php?user=$artista[nome]'><div class='aumigo'><img class='icone_aumigo' src='$artista[foto_perfil]'>$artista[nome]</div></a>";
                }
            }
            echo "</div></div>";
        }
        echo "<div class='area_secoes'><h2 class='titulo_secoes'>Postagens</h2><div class='display_secao'>";
        $query_posts = $connection->query("SELECT * FROM postagens WHERE id_escritor='$usuario[id]' ORDER BY id DESC");
        if ($query_posts->num_rows == 0){
            echo "<p class='msg_zero_postagens' >Parece que esse usuário ainda não interagiu...</p>";
        }
        while ($row = mysqli_fetch_assoc($query_posts)) {
            $id = $row['id_escritor'];
            $id_postagem = $row['id'];
            $conferir_se_e_comentario = $connection->query("SELECT * FROM comentarios WHERE id_comentario='$id_postagem'");
            $conferir_hashtags = $connection->query("SELECT hashtag FROM postagens_tem_hashtags WHERE id_postagem='$id_postagem'");
            if ($conferir_se_e_comentario->num_rows==0){
                $autor = mysqli_fetch_assoc($connection->query("SELECT * from usuarios WHERE id='$id'"));
                $nome = $autor['nome'];
                $foto = $autor['foto_perfil'];
                echo "<div id='postagem_$id_postagem' class='postagem'><div class='informacoes_escritor'><a href='usuario.php?user=$nome'><img src='$foto' class='foto_perfil_feed' alt='foto_perfil_$nome'>";
                echo "<div class='autor'>". $nome ."</div></a></div>";
            }else{
                $conferir_se_e_comentario = $conferir_se_e_comentario->fetch_assoc();
                $mae_do_comentario = $connection->query("SELECT * FROM postagens WHERE id='$conferir_se_e_comentario[id_postagem_mae]'")->fetch_assoc();
                $autor_da_mae_do_comentario = $connection->query("SELECT * FROM usuarios WHERE id='$mae_do_comentario[id_escritor]'")->fetch_assoc();
                $autor = mysqli_fetch_assoc($connection->query("SELECT * from usuarios WHERE id='$id'"));
                $nome = $autor['nome'];
                $foto = $autor['foto_perfil'];
                echo "<div id='postagem_$id_postagem' class='postagem'><div class='informacoes_escritor'><a href='usuario.php?user=$nome'><img src='$foto' class='foto_perfil_feed' alt='foto_perfil_$nome'>";
                echo "<div class='autor'>". explode(" ", $nome)[0] ."</div></a><a class='link_autor_da_mae_do_comentario' href='pagina_post.php?post=$id_postagem#postagem_$id_postagem'>Em comentário à ". $autor_da_mae_do_comentario['nome'] ."</a></div>";
            }
            echo "<a class='link_postagem' href='pagina_post.php?post=$id_postagem#postagem_$id_postagem'><p class='conteudo_postagem'>". $row['conteudo_texto']. "</p>";
            if ($row['imagem'] != ""){
                echo "<img class='imagem_postada' src='$row[imagem]'><br>";
            }
            echo "</a>";
            $query_verificacao_curtida = $connection->query("SELECT * FROM curtidas WHERE id_postagem = '$id_postagem' AND id_usuario = '$id_sessao'");
            if ($query_verificacao_curtida->num_rows == 0){
                echo "<div class='rodape_postagem'><button class='curtida curtidas_$row[id]' type='button'><i class='bi bi-chat-square-heart'></i></button>";
            }else{
                echo "<div class='rodape_postagem'><button class='curtida curtidas_$row[id] clicked' type='button'><i class='bi bi-chat-square-heart-fill'></i></button>";
            }
            if($id == $_SESSION['id']){
                $query_curtidas = $connection->query("SELECT COUNT(*) FROM curtidas WHERE id_postagem = '$id_postagem'");
                $query_curtidas = $query_curtidas->fetch_assoc();
                echo "<i id='$row[id]'>".$query_curtidas['COUNT(*)']."</i>";
            }
            echo "<button type='button' class='comentar' id='comentar_$id_postagem'><i class='bi bi-chat-text-fill'></i></button>";
            $query_quantidade_comentarios = $connection->query("SELECT COUNT(*) FROM comentarios WHERE id_postagem_mae='$id_postagem'")->fetch_assoc();
            if ($query_quantidade_comentarios['COUNT(*)'] != 0){
                echo $query_quantidade_comentarios['COUNT(*)'];
            }
            if($id == $_SESSION['id']){
                echo "<button type='button' name='deletar_postagem_$id_postagem' class='deletar_postagem' id='deletar_postagem_$id_postagem'><i class='bi bi-trash3-fill'></i></button>";
            }else{
                $query_verificar_se_ja_denunciou = $connection->query("SELECT * FROM postagens_tem_denuncias WHERE id_postagem='$id_postagem' AND id_usuario = $_SESSION[id]");
                if($query_verificar_se_ja_denunciou->num_rows >= 1){
                    echo "<div class='denuncia' id='local_denuncia_$id_postagem'><i class='bi bi-exclamation-triangle-fill'></i></div></div>";
                }else{
                    echo "<div id='local_denuncia_$id_postagem'><button type='button' name='denunciar_postagem_$id_postagem' class='denuncia denunciar_postagem' id='denunciar_postagem_$id_postagem'><i class='bi bi-exclamation-triangle'></i></button></div>";
                }
            }
            echo "</div></a></div>";
        }
        echo "</div></div>";
    ?>
    <div id="lado_esquerda">ㅤ</div>
    <div id="lado_direita">ㅤ</div>
    <div class="backdrop"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../JS/feed.js"></script>
    <script src="../JS/usuario.js"></script>
</body>
</html>