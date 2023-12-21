<?php
//Início da sessão e chamada do banco de dados
    if(!isset($_SESSION)){
        session_start();
    }
    require_once "connect_db.php";

    $id_sessao = $_SESSION['id'];
//=====================================================================================//
  
    //Cria um vetor para armazenar os IDs de todos os posts "filhos" que devem ser deletados
    $filhos = array();

    //Define uma função que pegará todos os filhos de um determinado post

    function pegar_filhos($filhos, $connection, $id){
        array_push($filhos, $id); //Adiciona automaticamente o post pai ao array pra deletar
        $verificar_filhos = $connection->query("SELECT * FROM comentarios WHERE id_postagem_mae='$id'"); // Verifica todos os 'filhos' desse post
        $linhas = $verificar_filhos->num_rows; //Query para pegar o número de linhas
        if($linhas > 0){
          while($proximo_id = $verificar_filhos->fetch_assoc()['id_comentario']){ //Pega o id de todos os filhos
            pegar_filhos($filhos, $connection, $proximo_id);//A partir desses IDs chamam a função novamente para verificar se não existem 'netos'
          }
        }
        foreach($filhos as $filho){ //Deleta todas as postagens que foram adicionadas no vetor
          $connection->query("DELETE FROM postagens WHERE id='$filho'");
        }
    }

    $query = $connection->query("SELECT * FROM postagens WHERE id_escritor='$id_sessao'");

    while ($row = mysqli_fetch_assoc($query)){
        $id_postagem = $connection->query("SELECT * FROM comentarios WHERE id_postagem_mae='$row[id]'");
        while($comentario = mysqli_fetch_assoc($id_postagem)['id_comentario']){
            pegar_filhos($filhos, $connection, $comentario);
        }
    }

    $deletar_usuario = $connection->query("DELETE FROM usuarios WHERE id='$id_sessao'");

    //Deleta as variáveis de sessão

    $_SESSION['id'] = '';
    $_SESSION['user'] = '';
    $_SESSION['manter_sessao'] = '';

    $response = array('redirect' => '../index.php');
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
?>