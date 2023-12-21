<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once "connect_db.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer-master/src/Exception.php';
    require '../PHPMailer-master/src/PHPMailer.php';
    require '../PHPMailer-master/src/SMTP.php';

    $id_sessao = $_SESSION['id'];
    $post = $_GET['post'];

    $motivo = $_POST['radio_denuncia'];

    if ($motivo == 'ferir_direitos_animais'){
        $motivo = "Ferir os direitos dos animais";
    }else if($motivo == 'mensagens_odio'){
        $motivo = "Mensagens de ódio";
    }else if($motivo == 'apologia_zoofilia'){
        $motivo = "Zoofilia";
    }else if($motivo == 'minha_zoofobia'){
        $motivo = "É a minha zoofobia(não deveria aparecer para mim)";
    }else{
        $erros[] = "Erro: Selecione um motivo para a denúncia";
        $response = array('message' => $erros[0]);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    $query_denunciar_post = $connection->query("INSERT INTO postagens_tem_denuncias(id_usuario, id_postagem, motivo_denuncia) VALUES('$id_sessao','$post', '$motivo')");

    $query_verificar_qtde_de_denuncias = $connection->query("SELECT * FROM postagens_tem_denuncias WHERE id_postagem='$post'");
    if($query_verificar_qtde_de_denuncias->num_rows >= 3){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'pedro.castilhos@estudante.ifgoiano.edu.br';
        $mail->Password = 'D@guinh0';
        $mail->Port = 587;
        $mail->setFrom('pedro.castilhos@estudante.ifgoiano.edu.br');
        $mail->addReplyTo('no-reply@email.com.br');
        $mail->addAddress('pedro.castilhos@estudante.ifgoiano.edu.br', 'PetRepete');
        $mail->isHTML(true);
        $mail->Subject = 'Postagem '. $post . ' atingiu o limite de denuncias';
        $mail->Body = 'Email de alerta! A postagem '. $post . ' atingiu o número limite de denúncias, favor verificar no banco de dados e averiguar a situação futura da postagem';
        $mail->send();
    }
    header('Location:'. $_GET['url']);
?>