<header>
    <?php
        if (!isset($_SESSION)){
            session_start();
        }
        $id_sessao = $_SESSION['id'];
        $referencia = $connection->query("SELECT nome FROM usuarios WHERE id='$id_sessao'");
        $referencia = $referencia->fetch_assoc();
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <a class="navbar-brand" href="feed.php">
            <img id="logo_navbar" src="../Imagens/logo_navbar.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <img id="cachorro" src="../Imagens/cachorro.png" alt="">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="feed.php">
                <span class="icone_navbar"><img src="../Imagens/icone_feed.png"></span>
                <span class="texto_navbar">Feed<span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pagina_pesquisa.php">
                <span class="icone_navbar"><img src="../Imagens/icone_pesquisa.png"></span>
                <span class="texto_navbar">Pesquisa<span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="usuario.php?user=<?php echo $referencia['nome']?>">
                <span class="icone_navbar"><img src="../Imagens/icone_usuario.png"></span>
                <span class="texto_navbar">Perfil<span>
                </a>
            </li>
            </ul>
            <img id="gatinho" src="../Imagens/gatinho.png" alt="">
        </div>
        </div>
    </nav>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</header>