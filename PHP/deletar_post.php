<?php
    require_once "connect_db.php";

    $id_post = (int)$_GET['post'];
    $url = $_GET['url'];

    $filhos = array();

    function pegar_filhos($filhos, $connection, $id){
        array_push($filhos, $id);
        $verificar_filhos = $connection->query("SELECT * FROM comentarios WHERE id_postagem_mae='$id'");
        $linhas = $verificar_filhos->num_rows;
        if($linhas > 0){
          while($proximo_id = $verificar_filhos->fetch_assoc()['id_comentario']){
            pegar_filhos($filhos, $connection, $proximo_id);
          }
        }
        foreach($filhos as $filho){
          $connection->query("DELETE FROM postagens WHERE id='$filho'");
        }
    }

    $query_principal = $connection->query("SELECT * FROM comentarios WHERE id_postagem_mae='$id_post'");

    while ($row = mysqli_fetch_assoc($query_principal)){
        pegar_filhos($filhos, $connection, $row['id_comentario']);
    };

    $query_deletar_post = $connection->query("DELETE FROM postagens WHERE id='$id_post'");
    $response = array('redirect' => $url);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
?>