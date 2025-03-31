<?php
// Configuração do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arubonsai";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Inicializar variáveis
$mensagemErro = "";

// Verificar se os dados foram enviados pelo formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];

    // Consulta para verificar se o CPF e o nome existem no banco de dados
    $sql = "SELECT * FROM funcionarios WHERE cpf = ? AND nome = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $cpf, $nome);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Redirecionar para a página restrita
        header("Location: indexfunc.php");
        exit;
    } else {
        // Mensagem de erro para exibir no formulário
        $mensagemErro = "CPF ou Nome inválidos. Tente novamente.";
    }

    $stmt->close();
}

$conn->close();
?>