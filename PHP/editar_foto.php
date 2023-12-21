<?php
if(!isset($_SESSION)){
    session_start();
}
require_once "connect_db.php";

$id_usuario = $_SESSION['id'];

if(isset($_FILES["foto_de_perfil"]) && $_FILES["foto_de_perfil"]["error"] == 0) {
    $imagem = "../Imagens/perfil/" . $_FILES["foto_de_perfil"]["name"];
    if(move_uploaded_file($_FILES["foto_de_perfil"]["tmp_name"], $imagem)) {
        $query = $connection->query("UPDATE usuarios SET foto_perfil='$imagem' WHERE id='$id_usuario'");
        if(mysqli_affected_rows($connection)){
            header("Location: usuario.php?user=". $_SESSION['user']);
            exit;
        } else{
            header("Location: usuario.php?user=". $_SESSION['user']);
            exit;
        }
    }
}
?>