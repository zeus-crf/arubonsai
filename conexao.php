<?php
$servername = "localhost";
$username = "root";  // Altere se o usuário do MySQL for diferente
$password = "";      // Altere se houver senha configurada
$dbname = "arubonsai"; // Nome do banco de dados

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
