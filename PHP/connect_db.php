<?php

//O código queridinho que eu chamo em todos os outros

//Variáveis referentes ao container do banco de dados

$servername = "db_petRepete:3306";
$username = "root";
$password = "M@cacoSabid0";
$db_name = "petrepete";

//Conexão

$connection = new mysqli($servername, $username, $password, $db_name);

//Verificação de erros

if ($connection->connect_error){
    die("Conexão falhou: " . $connection->connect_error);
};
?>