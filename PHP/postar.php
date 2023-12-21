<?php
    if (!isset($_SESSION)){
        session_start();
    }
    require_once "connect_db.php";
    $erros = array();
    $id_postagem_mae = $_GET['post_mae'];
    $id_sessao = $_SESSION['id'];


if (isset($_POST['btn_postar'])) {
    if (!empty($_POST['msg_teste'])){
        $conteudo = $connection->real_escape_string($_POST['msg_teste']);
        if(isset($_FILES["foto_pra_postar"]) && $_FILES["foto_pra_postar"]["error"] == 0) {
            $imagem = "../Imagens/post/" . $_FILES["foto_pra_postar"]["name"];
            if(move_uploaded_file($_FILES["foto_pra_postar"]["tmp_name"], $imagem)) {
                $exec_postar = $connection->query("INSERT INTO postagens(id_escritor, conteudo_texto, imagem) VALUES ('$id_sessao', CONCAT('$conteudo','<br>'), '$imagem')") or die("Erro na postagem");
            }
        }else{
            $exec_postar = $connection->query("INSERT INTO postagens(id_escritor, conteudo_texto) VALUES ('$id_sessao', CONCAT('$conteudo','<br>'))") or die("Erro na postagem");
        }
        $id_postagem = $connection->query("SELECT id from postagens WHERE id_escritor='$id_sessao' AND conteudo_texto=CONCAT('$conteudo','<br>')")->fetch_assoc()['id'];

        $fobias = ['cachorro', 'gato', 'cavalo', 'bovino', 'passaro', 'sapo', 'abelha', 'rato', 'hamster', 'aranha', 'inseto'];

        for ($x = 0; $x < count($fobias); $x++){
            if (isset($_POST['fobia_'. $fobias[$x]])){
                $sql_adicionar_hashtag = $connection->query("UPDATE postagens SET conteudo_texto = CONCAT(conteudo_texto, '#', '$fobias[$x]') WHERE id='$id_postagem'");
                $sql_fobias = "INSERT INTO postagens_tem_hashtags(id_postagem, hashtag) VALUES ('$id_postagem', '$fobias[$x]')";
                $query_fobia = $connection->query($sql_fobias) or die("Falha no cadastro: ".$connection->error);
            }
        }

        if($id_postagem_mae != 0){
            $query_comentar = $connection->query("INSERT INTO comentarios(usuario_escritor, id_postagem_mae, id_comentario) VALUES ('$id_sessao', '$id_postagem_mae', '$id_postagem')") or die("Erro no comentário");;
            
            $response = array('redirect' => 'pagina_post.php?post='.$id_postagem_mae);
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }else{
            $response = array('redirect' => 'feed.php');
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }else{
        $erros[] = "Escreva algo no seu post";
        $response = array('message' => $erros[0]);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
    if (!empty($erros)) {
        $response = array('message' => $erros[0]);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
?>