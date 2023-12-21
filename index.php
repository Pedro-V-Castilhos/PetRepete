<?php
    if (!isset($_SESSION)){
        session_start();
    }
    require_once "PHP/login.php";
    $_SESSION['ja_foi_pro_index'] = true;
    if (!empty($_SESSION['id'])){
        if ($_SESSION['manter_sessao'] == false){
            session_destroy();
            header('Location: index.php');
        }else{
            header('Location: PHP/feed.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>PetRepete</title>
</head>
<?php
    include("PHP/connect_db.php");
    include("PHP/header.php");
?>
<body>
    <div id="lado_esquerda">ㅤ</div>
    <div id="lado_direita">ㅤ</div>
    <div id="gradiente_roxo">ㅤ<div>

    <div class="frame1">

        <div id="div_porco_apresentacao"><img id="porco_apresentacao" src="Imagens/pagina_inicial_porquinho.png"></div>

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="Imagens/carrossel1.jpg" class="d-block" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="Imagens/carrossel2.jpg" class="d-block" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="Imagens/carrossel3.jpg" class="d-block" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="Imagens/carrossel4.jpg" class="d-block" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="Imagens/carrossel5.jpg" class="d-block" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <center><img id="dogs_out" src="Imagens/dogs_out.png"><hr><img id='aumigos_iconicos' src='Imagens/aumigos_iconicos.png'><hr><img id='quadro_sobre_zoofobias' src='Imagens/quadro_sobre_zoofobias.png'></center>
    <div class='rodape'><div class='contatos'><h2>Contatos:</h2><p>pedro.castilhos@estudante.ifgoiano.edu.br</p><p>joana.amorim@estudante.ifgoiano.edu.br</p></div><p class='copyright'>&copy 2023</p></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="JS/header.js"></script>
</body>
</html>