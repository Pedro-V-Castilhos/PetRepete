<?php
    if (!isset($_SESSION)){
        session_start();
    }
    require_once "connect_db.php";
    $erros = array();
    $dados = array();
    
    $valor_pra_pesquisar = $_GET['value'];

    //$resultados = $connection->query("SELECT * FROM usuarios WHERE upper(nome) LIKE upper('%$valor_pra_pesquisar%') or upper(tipo_conta) LIKE upper('%$valor_pra_pesquisar%')");
    $resultados = $connection->query("SELECT * FROM usuarios WHERE LOCATE('$valor_pra_pesquisar', nome) > 0 ORDER BY LOCATE('$valor_pra_pesquisar', nome)");

    if ($resultados->num_rows == 0){
        array_push($dados, "<div class='informacoes_usuario'><p>Ops.. Parece que nenhum usuário corresponde a sua busca</p></div>");
    }else{
        while($row = mysqli_fetch_assoc($resultados)){
            array_push($dados, "<div class='informacoes_usuario'><a class='link_usuario' href='usuario.php?user=$row[nome]'><img src='$row[foto_perfil]' class='foto_perfil_feed' alt='foto_perfil_$row[nome]'><p class='autor'>$row[nome]</p></a></div>");
        }
    }

    $response = array('dados' => $dados);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
?>