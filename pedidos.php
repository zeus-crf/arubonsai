<?php
// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'arubonsai');

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Consulta SQL para buscar os pedidos em ordem cronológica
$sql = "SELECT mesa, item, quantidade, DATE_FORMAT(timestamp, '%H:%i') AS hora 
        FROM pedidos 
        ORDER BY timestamp ASC"; // Ordenar por horário

$result = $conn->query($sql);

// Verifica se a consulta SQL teve erro
if (!$result) {
    die("Erro na consulta: " . $conn->error);
}

$pedidos = array(); // Array para armazenar os pedidos

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Agrupar os pedidos por mesa e horário
        $mesaHora = $row['mesa'] . '-' . $row['hora'];
        
        if (!isset($pedidos[$mesaHora])) {
            $pedidos[$mesaHora] = array(
                'mesa' => $row['mesa'],
                'hora' => $row['hora'],
                'itens' => array()
            );
        }

        $pedidos[$mesaHora]['itens'][] = array(
            'item' => $row['item'],
            'quantidade' => $row['quantidade']
        );
    }
}

$conn->close();

// Define o cabeçalho para JSON e retorna os dados agrupados
header('Content-Type: application/json; charset=utf-8');
echo json_encode(array_values($pedidos), JSON_UNESCAPED_UNICODE);
?>
