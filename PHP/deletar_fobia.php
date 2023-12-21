<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once "connect_db.php";

    $id_sessao = $_SESSION['id'];
    $nome_usuario = $_SESSION['user'];
    $fobia_pra_deletar = $_GET['fobia'];

    $query_deletar_fobia = $connection->query("DELETE FROM usuario_tem_fobia WHERE id_usuario='$id_sessao' AND fobia='$fobia_pra_deletar'");

    $response = array('redirect' => 'usuario.php?user='. $nome_usuario);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
?>