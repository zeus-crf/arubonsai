<?php
$conn = new mysqli('localhost', 'root', '', 'arubonsai');

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Obtem os dados do POST
$mesa = intval($_POST['mesa']);
$hora = $_POST['hora'];
$itens = json_decode($_POST['itens'], true);

$success = true;

foreach ($itens as $item) {
    $sql = "DELETE FROM pedidos WHERE mesa = ? AND item = ? AND DATE_FORMAT(timestamp, '%H:%i') = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $mesa, $item['item'], $hora);
    if (!$stmt->execute()) {
        $success = false;
        break;
    }
    $stmt->close();
}

$conn->close();
echo json_encode(['success' => $success]);
?>
