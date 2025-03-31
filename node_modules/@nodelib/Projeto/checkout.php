<?php

include "conexaoaru.php";



// Inclui o arquivo de conexão com o banco de dados


// Lê os dados enviados via fetch
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['error' => 'Nenhum dado recebido.']);
    exit;
}

// Aqui você pode processar os dados recebidos
$tableNumber = isset($data['tableNumber']) ? (int)$data['tableNumber'] : null;
$cart = isset($data['cartItems']) ? $data['cartItems'] : null;
$itemName = $conn->real_escape_string($item['name']);
$itemQuantity = (int)$item['quantity'];
// Exemplo de inserção no banco de dados
$sql = "INSERT INTO pedidos (table_number, item_name, quantity) VALUES ('$tableNumber', '$itemName', '$itemQuantity')";
if (mysqli_query($conn, $sql)) {
    echo json_encode(['message' => 'Usuário inserido com sucesso!']);
} else {
    echo json_encode(['error' => 'Erro ao inserir no banco de dados: ' . mysqli_error($conn)]);
}

mysqli_close($conn);
?>




?>