<?php
    session_start();
    require_once "login.php";
    include("connect_db.php");
    include("header_conectado.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/feed.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Post</title>
</head>
<body>
    <div class="lado esquerdo">ㅤ</div>
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
            <label for='ferir_direitos_animais'>Ferir os direitos dos animais</label><br>
            <input type='radio' class='radio_denuncia' value='mensagens_odio' id='mensagens_odio' name='radio_denuncia'>
            <label for='mensagens_odio'>Proferir mensagens de ódio</label><br>
            <input type='radio' class='radio_denuncia' value='apologia_zoofilia' id='apologia_zoofilia' name='radio_denuncia'>
            <label for='apologia_zoofilia'>Apologia à zoofilia</label><br>
            <input type='radio' class='radio_denuncia' value='minha_zoofobia' id='minha_zoofobia' name='radio_denuncia'>
            <label for='minha_zoofobia'>O conteúdo da postagem é sobre minha zoofobia</label><br>
            <button id="submeter_denuncia" name="btn_denunciar" type="submit" class="btn btn-submit">Denunciar</button>
            <input type="hidden" name="btn_postar" value="true">
        </form>
    </dialog>
    <?php
        function carregar_post($connection, $id_do_post, $id_sessao, $tipo_de_msg){
            $post_mae = $connection->query("SELECT * FROM postagens WHERE id='$id_do_post'")->fetch_assoc();
            $id_escritor = $post_mae['id_escritor'];
            $escritor = $connection->query("SELECT * from usuarios WHERE id='$id_escritor'")->fetch_assoc();
            $conferir_hashtags = $connection->query("SELECT hashtag FROM postagens_tem_hashtags WHERE id_postagem='$id_do_post'");
            $continuar = true;
            while($hashtag = $conferir_hashtags->fetch_assoc()){
                $conferir_se_usuario_tem_fobia = $connection->query("SELECT * FROM usuario_tem_fobia WHERE id_usuario = '$_SESSION[id]' AND fobia='$hashtag[hashtag]'");
                if ($conferir_se_usuario_tem_fobia->num_rows == 1){
                    $continuar = false;
                    break;
                }else{
                    $continuar = true;
                }
            }
            if ($continuar){
                $continuar = true;
                $nome = $escritor['nome'];
                $foto = $escritor['foto_perfil'];
                echo "<div id='postagem_$post_mae[id]' class='$tipo_de_msg'><div class='informacoes_escritor'><a href='usuario.php?user=$nome'><img class='foto_perfil_feed' src='$foto'>";
                echo "<div class='autor'>". explode(" ", $nome)[0] ."</div></a></div>";
                echo "<a class='$tipo_de_msg-linha link_postagem' href='pagina_post.php?post=$post_mae[id]#postagem_$post_mae[id]'><p class='conteudo_postagem'>". $post_mae['conteudo_texto']. "</p>";
                $query_verificacao_curtida = $connection->query("SELECT * FROM curtidas WHERE id_postagem = '$id_do_post' AND id_usuario = '$id_sessao'");
                if ($post_mae['imagem'] != ""){
                    echo "<img class='imagem_postada' src='$post_mae[imagem]'><br>";
                }
                echo "</a>";
                if ($query_verificacao_curtida->num_rows == 0){
                    echo "<div class='rodape_postagem'><button class='curtida curtidas_$id_do_post' type='button'><i class='bi bi-chat-square-heart'></i></button>";
                }else{
                    echo "<div class='rodape_postagem'><button class='curtida curtidas_$id_do_post clicked' type='button'><i class='bi bi-chat-square-heart-fill'></i></button>";
                }
                if($id_escritor == $_SESSION['id']){
                    $query_curtidas = $connection->query("SELECT COUNT(*) FROM curtidas WHERE id_postagem = '$id_do_post'");
                    $query_curtidas = $query_curtidas->fetch_assoc();
                    echo "<i id='$id_do_post'>".$query_curtidas['COUNT(*)']."</i>";
                }
                echo "<button type='button' class='comentar' id='comentar_$id_do_post'><i class='bi bi-chat-text-fill'></i></button></a>";
                $query_quantidade_comentarios = $connection->query("SELECT COUNT(*) FROM comentarios WHERE id_postagem_mae='$id_do_post'")->fetch_assoc();
                if ($query_quantidade_comentarios['COUNT(*)'] != 0){
                    echo $query_quantidade_comentarios['COUNT(*)'];
                }
                if($id_escritor == $_SESSION['id']){
                    echo "<button type='button' name='deletar_postagem_$id_do_post' class='deletar_postagem' id='deletar_postagem_$id_do_post'><i class='bi bi-trash3-fill'></i></button></div></div>";
                }else{
                    $query_verificar_se_ja_denunciou = $connection->query("SELECT * FROM postagens_tem_denuncias WHERE id_postagem='$id_do_post' AND id_usuario = $_SESSION[id]");
                    if($query_verificar_se_ja_denunciou->num_rows >= 1){
                        echo "<div class='denuncia' id='local_denuncia_$id_do_post'><i class='bi bi-exclamation-triangle-fill'></i></div></div></div>";
                    }else{
                        echo "<div id='local_denuncia_$id_do_post'><button type='button' name='denunciar_postagem_$id_do_post' class='denuncia denunciar_postagem' id='denunciar_postagem_$id_do_post'><i class='bi bi-exclamation-triangle'></i></button></div></div></div>";
                    }
                }
                if($tipo_de_msg == 'mae'){
                    echo "<div class='linha_parentesco'>ㅤ</div>";
                }
            }
        }
        $id_post = $_GET['post'];
        $id_sessao = $_SESSION['id'];
        $tem_postagem_mae = $id_post;
        $arvore_genealogica = array();
        while ($tem_postagem_mae != 0){
            $query_postagens_mae = $connection->query("SELECT * FROM comentarios WHERE id_comentario=$tem_postagem_mae");
            if($query_postagens_mae->num_rows != 0){
                $query_postagens_mae = $query_postagens_mae->fetch_assoc();
                $id_do_post_mae = $query_postagens_mae['id_postagem_mae'];
            }else{
                $id_do_post_mae = 0;
            }
            if ($id_do_post_mae != 0){
                array_unshift($arvore_genealogica, $id_do_post_mae);
            }
            $tem_postagem_mae = $id_do_post_mae;
        }
        foreach($arvore_genealogica as $id_mae){
            carregar_post($connection, $id_mae, $id_sessao, 'mae');
        }
        carregar_post($connection, $id_post, $id_sessao, 'postagem');
        $comentarios = $connection->query("SELECT * FROM comentarios WHERE id_postagem_mae='$id_post'");
        while($row = mysqli_fetch_assoc($comentarios)){
            carregar_post($connection, $row['id_comentario'], $id_sessao, 'filho');
        }
        echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    ?>
    <div class="lado direito">ㅤ</div>
    <div class="backdrop"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../JS/feed.js"></script>
</body>
</html>