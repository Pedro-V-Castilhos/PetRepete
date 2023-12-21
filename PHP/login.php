<?php
require_once "connect_db.php";
$erros = array();

if (isset($_POST['btn_login'])) {
    if (!empty($_POST['usuario']) || !empty($_POST['senha'])){
        $login = $connection->real_escape_string($_POST['usuario']);
        $senha = $connection->real_escape_string($_POST['senha']);
        $senha_crip = hash('sha256', $senha);
        $lembrar_sessao = $_POST["lembrar_sessao"];

        $sql_code = "SELECT * FROM usuarios WHERE (nome='$login' OR email='$login') AND (senha = '$senha_crip' OR senha='$senha')";
        $sql_query = $connection->query($sql_code) or die("Falha na execução do codigo SQL: " . $connection->error);

        $qtde_usuarios = $sql_query->num_rows;

        if ($qtde_usuarios == 1){

            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)){
                session_start();
            }

            $_SESSION['user'] = $usuario['nome'];
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['manter_sessao'] = $lembrar_sessao;

            $response = array('redirect' => 'PHP/feed.php');
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }else{
            $erros[] = "Erro: A conta referida não existe";
            $response = array('message' => $erros[0]);
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }else{
        $erros[] = "Erro: Preencha seu login e/ou senha";
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