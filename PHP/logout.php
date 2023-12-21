<?php
    session_start();
    $_SESSION['id'] = '';
    $_SESSION['user'] = '';
    $_SESSION['manter_sessao'] = false;
    session_unset();
    session_destroy();
    header("Location: ../index.php");
?>