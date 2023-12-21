<?php
//Início da sessão e chamada do banco de dados
    if (!isset($_SESSION)){
        session_start();
    }
    require_once "connect_db.php";
    $id_usuario = $_SESSION['id'];
//=====================================================================================//

//Confere se o usuário vai curtir ou deixar de curtir uma postagem
//Nos dois casos, somente pega o id da postagem em questão e adiciona ou deleta a linha correspondente na tabela 'postagens_tem_curtidas'

    if (isset($_GET['curtir'])){
        $id_postagem = $_GET['curtir'];
        $query_curtir = $connection->query("INSERT INTO curtidas(id_postagem, id_usuario) VALUES ('$id_postagem', '$id_usuario')");
    }else{
        $id_postagem = $_GET['descurtir'];
        $query_curtir = $connection->query("DELETE FROM  curtidas WHERE id_postagem = '$id_postagem' and id_usuario = '$id_usuario'");
    }
?>