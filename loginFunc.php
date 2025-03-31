<?php
session_start();

// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'arubonsai');
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Processar o login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];

    // Validar CPF
    if (strlen($cpf) == 11) {
        // Consultar no banco de dados
        $sql = "SELECT * FROM funcionarios WHERE cpf = ? AND nome = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $cpf, $nome);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Criar a sessão para o usuário
            $_SESSION['cpf'] = $cpf;
            $_SESSION['nome'] = $nome;
            header("Location: indexfunc.php"); // Redireciona após login bem-sucedido
            exit();
        } else {
            $erroMensagem = "CPF ou Nome inválidos.";
        }

        $stmt->close();
    } else {
        $erroMensagem = "CPF inválido.";
    }
}

// Destruir a sessão em todas as requisições, forçando o login novamente
session_unset();
session_destroy();

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Funcionários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: white;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            text-align: center;
            font-size: 30px;
            margin-bottom: 30px;
            color: #333;
        }

        .form-container {
            max-width: 400px;
            width: 90%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .InputBox {
            position: relative;
            margin-bottom: 30px;
        }

        .InputUser {
            background: none;
            border: none;
            border-bottom: 1px solid #333;
            outline: none;
            width: 100%;
            font-size: 16px;
            padding: 8px 0;
            color: #333;
        }

        .LabelInput {
            position: absolute;
            pointer-events: none;
            transition: 0.5s;
            font-size: 16px;
            top: 10px;
            left: 0;
            color: #888;
        }

        .InputUser:focus ~ .LabelInput,
        .InputUser:valid ~ .LabelInput {
            top: -20px;
            font-size: 12px;
            color: green;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: center;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            .form-container {
                padding: 15px;
            }

            .InputUser {
                font-size: 14px;
            }

            .LabelInput {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 20px;
            }

            button {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form method="POST">
            <h1>Login Funcionário</h1>
            <div class="InputBox">
                <input type="text" id="cpf" name="cpf" maxlength="11" class="InputUser" required>
                <label class="LabelInput" for="cpf">Digite seu CPF:</label>
            </div>
            <div class="InputBox">
                <input type="text" id="nome" name="nome" class="InputUser" required>
                <label class="LabelInput" for="nome">Digite seu Nome:</label>
            </div>
            <?php if (isset($erroMensagem)): ?>
                <div class="error-message"> <?= htmlspecialchars($erroMensagem) ?> </div>
            <?php endif; ?>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
