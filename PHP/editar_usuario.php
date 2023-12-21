<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once "connect_db.php";
    $erros = array();

    if(isset($_POST['botao_editar'])){
        $id_sessao = $_SESSION['id'];
        if(!empty($_POST['nome_usuario'])){
            if(!empty($_POST['email_usuario'])){
                $nome_usuario = $_POST['nome_usuario'];
                $email_usuario = $_POST['email_usuario'];
                $sql_update = "UPDATE usuarios SET nome='$nome_usuario', email='$email_usuario' WHERE id=$id_sessao";
                $connection->query($sql_update);
                $response = array('redirect' => 'usuario.php?user='. $_POST['nome_usuario']);
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }else{
                $erros[] = "Escreva um novo email";
                $response = array('message' => $erros[0]);
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
        }else{
            $erros[] = "Escreva um novo nome de usuário";
            $response = array('message' => $erros[0]);
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }
?>