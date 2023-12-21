<?php
//Início da sessão e chamada do banco de dados

if (!isset($_SESSION)){
    session_start();
}
require_once "connect_db.php";
$erros = array();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

//=====================================================================================//

// Conferir se os inputs foram inseridos corretamente (Eu sei que tá feio, mas eu queria um output personalizado)

if (isset($_POST['btn_submit'])) {
    if (empty($_POST['nome_usuario_cadastro'])){
        $erros[] = "Erro: Digite seu nome de usuário";
        $response = array('message' => $erros[0]);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }else if (empty($_POST['email_cadastro'])){
        $erros[] = "Erro: Digite o seu email";
        $response = array('message' => $erros[0]);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }else if (empty($_POST['senha_cadastro'])){
        $erros[] = "Erro: Digite sua senha";
        $response = array('message' => $erros[0]);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }else if (empty($_POST['senha_conf'])){
        $erros[] = "Erro: Confirme sua senha";
        $response = array('message' => $erros[0]);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }else if ($_POST['senha_cadastro'] != $_POST['senha_conf']){
        $erros[] = "Erro: Confirmação de senha incompatível";
        $response = array('message' => $erros[0]);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }else{

        //Guarda nas variáveis os valores do _POST

        $nome_usuario = $connection->real_escape_string($_POST['nome_usuario_cadastro']);
        $email_usuario = $connection->real_escape_string($_POST['email_cadastro']);
        $senha_usuario = $connection->real_escape_string($_POST['senha_cadastro']);

        //Tratamento de erro se o usuário já está cadastrado

        $teste_usuario =  $connection->query("SELECT id FROM usuarios WHERE nome='$nome_usuario'");
        if ($teste_usuario->num_rows != 0){
            $erros[] = "Erro: Usuário já cadastrado";
            $response = array('message' => $erros[0]);
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }else{

            //Verifica qual o tipo de conta cadastrada

            if (!empty($_POST['link_lattes'])){
                $tipo_de_conta = 'veterinaria';
            }else if (!empty($_POST['cnpj'])){
                $tipo_de_conta = 'comercial';
            }else if (!empty($_POST['nome_da_campanha'])){
                $tipo_de_conta = 'campanha_adocao';
            }else{
                $tipo_de_conta = 'comum';
            }

            //Insere o usuário dentro da tabela 'usuarios' por padrão, e pega o id desse usuário recém cadastrado para prosseguir

            $sql_cadastro = "INSERT INTO usuarios(nome, senha, email, foto_perfil, tipo_conta) VALUES ('$nome_usuario', SHA2('$senha_usuario', 256), '$email_usuario', '../Imagens/perfil/usuario_generico.png', '$tipo_de_conta')";
            $query_cadastro = $connection->query($sql_cadastro) or die("Falha no cadastro: ". $connection->error);
            $query_id_usuario = $connection->query("SELECT id FROM usuarios WHERE nome='$nome_usuario'");
            $id_usuario = $query_id_usuario->fetch_array()['id'];

            //A partir daq ele só insere os usuários em suas respectivas tabelas(veterinario, comercio e campanha de adoção)

            if (!empty($_POST['link_lattes'])){

                $link_lattes = $connection->real_escape_string($_POST['link_lattes']);
                $especializacao = $connection->real_escape_string($_POST['especializacao']);
                $endereco_atendimento = $connection->real_escape_string($_POST['endereco_atendimento']);
                $diploma = $connection->real_escape_string($_POST['curriculo']);

                $sql_cadastro_veterinario = "INSERT INTO usuario_e_veterinario(usuario, lattes, diploma, endereco_clinica, especializacao) VALUES ('$id_usuario', '$link_lattes', '$diploma', '$endereco_atendimento', '$especializacao')";
                $query_cadastro_veterinario = $connection->query($sql_cadastro_veterinario) or die("Falha no cadastro: " . $connection->error);

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
                $mail->Subject = 'Novo veterinário cadastrado';
                $mail->Body = 'O usuário '. $id_usuario. ' se cadastrou como conta veterinária, favor verificar a procedência de seus dados no Banco de dados';
                $mail->send();

            }else if (!empty($_POST['cnpj'])){

                $cnpj = $connection->real_escape_string($_POST['cnpj']);
                $telefone_comercial = $connection->real_escape_string($_POST['telefone_comercial']);
                $nome_proprietario = $connection->real_escape_string($_POST['nome_proprietario']);
                $endereco_fisico = $connection->real_escape_string($_POST['endereco_fisico']);
                $hora_abertura = $connection->real_escape_string($_POST['horario_abertura']);
                $hora_fechamento = $connection->real_escape_string($_POST['horario_fechamento']);

                $sql_cadastro_comercial = "INSERT INTO usuario_e_comercio(usuario, cnpj, contato, nome_proprietario, endereco, horario_abrir, horario_fechar) VALUES ('$id_usuario', SHA2('$cnpj', 256), '$telefone_comercial', '$nome_proprietario', '$endereco_fisico', '$hora_abertura', '$hora_fechamento')";
                $query_cadastro_comercial = $connection->query($sql_cadastro_comercial) or die("Falha no cadastro: " . $connection->error);
                
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
                $mail->Subject = 'Novo comércio cadastrado';
                $mail->Body = 'O usuário '. $id_usuario. ' se cadastrou como conta comercial, favor verificar a procedência de seus dados no Banco de dados';
                $mail->send();
            
            }else if (!empty($_POST['nome_da_campanha'])){

                $nome_da_campanha = $connection->real_escape_string($_POST['nome_da_campanha']);
                $telefone_oficial = $connection->real_escape_string($_POST['telefone_oficial']);
                $responsavel = $connection->real_escape_string($_POST['responsavel']);
                $endereco_campanha = $connection->real_escape_string($_POST['endereco_campanha']);
                $hora_abertura_campanha = $connection->real_escape_string($_POST['horario_abertura_campanha']);
                $hora_fechamento_campanha = $connection->real_escape_string($_POST['horario_fechamento_campanha']);

                $sql_cadastro_adocao = "INSERT INTO usuario_e_adocao(id_usuario, nome_campanha, endereco, contato, nome_responsavel, horario_abrir, horario_fechar) VALUES ('$id_usuario', '$nome_da_campanha', '$endereco_campanha', '$telefone_oficial', '$responsavel', '$hora_abertura_campanha', '$hora_fechamento_campanha')";
                $query_cadastro_adocao = $connection->query($sql_cadastro_adocao) or die("Falha no cadastro: " . $connection->error);

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
                $mail->Subject = 'Nova campanha de adoção cadastrada';
                $mail->Body = 'O usuário '. $id_usuario. ' se cadastrou como conta de campanha de adoção, favor verificar a procedência de seus dados no Banco de dados';
                $mail->send();
            }

            //Um vetor com todas as zoofobias cadastradas é criado

            $fobias = ['cachorro', 'gato', 'cavalo', 'bovino', 'passaro', 'sapo', 'abelha', 'rato', 'hamster', 'aranha', 'inseto'];

            //A partir do vetor, verifica se essa zoofobia foi marcada e adiciona na tabela 'usuario_tem_fobia'

            for ($x = 0; $x < count($fobias); $x++){
                if (isset($_POST['fobia_'. $fobias[$x]])){
                    $sql_fobias = "INSERT INTO usuario_tem_fobia(id_usuario, fobia) VALUES ('$id_usuario', '$fobias[$x]')";
                    $query_fobia = $connection->query($sql_fobias) or die("Falha no cadastro: ".$connection->error);
                }
            }

            //Cria as variáveis padrão de sessão
            
            $_SESSION['id'] = $id_usuario;
            $_SESSION['user'] = $nome_usuario;
            $_SESSION['manter_sessao'] = true;

            //Redireciona de volta para o ajax, para ir pro feed

            $response = array('redirect' => '../index.php');
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        //Caso algum erro tenha passado sem a percepção, retorna o vetor erros e apresenta na tela

        if (!empty($erros)) {
            $response = array('message' => $erros[0]);
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }
}
?>