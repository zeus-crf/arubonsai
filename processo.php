
<?php
// Configuração do banco de dados
$host = "localhost";
$user = "root";
$password = "";
$dbname = "arubonsai";

// Conectar ao banco de dados
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber dados JSON
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(["error" => "Dados inválidos ou ausentes."]);
    exit;
}

// Processar os dados
foreach ($data as $item) {
    $mesa = $item['mesa'];
    $nome= $item['item'];
    $quantidade = $item['quantidade'];

    // Query para inserir no banco
    $sql = "INSERT INTO pedidos (mesa, item, quantidade) VALUES ('$mesa', '$nome', $quantidade)";
    
    if ($conn->query($sql) !== TRUE) {
        echo json_encode(["error" => "Erro ao salvar os dados no banco."]);
        exit;
    }
}

echo json_encode(["success" => "Carrinho salvo com sucesso!"]);
$conn->close();
?>