<?php
session_start();

// Verifica se o CPF e o nome estão na sessão (usuário autenticado)
if (!isset($_SESSION['cpf']) || !isset($_SESSION['nome'])) {
    header("Location: loginFunc.html"); // Se não estiver logado, redireciona para o login
    exit();
}

echo "<h1>Bem-vindo à Área Restrita!</h1>";
echo "<p>Você está logado como: " . $_SESSION['nome'] . " (CPF: " . $_SESSION['cpf'] . ")</p>";
echo '<a href="logout.php">Sair</a>';
?>
