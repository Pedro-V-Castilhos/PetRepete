<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once "connect_db.php";
    
    $id_usuario = $_SESSION['id'];

    if(isset($_GET['seguir'])){
        $query_seguir = $connection->query("INSERT INTO usuario_segue_artista(id_artista, id_usuario) VALUES ('$_GET[seguir]', $id_usuario)");
    }else if (isset($_GET['deseguir'])){
        $query_deseguir = $connection->query("DELETE FROM usuario_segue_artista WHERE id_artista='$_GET[deseguir]' AND id_usuario='$id_usuario'");
    }
?>