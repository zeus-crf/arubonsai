<?php
session_start();

// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'arubonsai');

// Verifica erro de conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se a sessão já está ativa
if (!isset($_SESSION['cpf']) || !isset($_SESSION['nome'])) {
    // Se não estiver logado, redireciona para o login
    header("Location: loginFunc.php");
    exit();
}

// Fecha conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos Aru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="./assets/logon.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style> header { background-color: #26432D; } </style>
</head>
<body class="bg-gray-100 font-sans">
    <header class="w-full h-[420px] bg-cover bg-center">
        <div class="w-full h-full flex flex-col justify-center items-center">
            <img src="./assets/logon.jpeg" alt="Logo" class="w-32 h-32 rounded-full shadow-lg hover:scale-110 duration-200">
            <h1 class="text-4xl mt-4 mb-2 font-bold text-white">Arubonsai</h1>
            <span class="text-white font-medium">Av Automóvel Clube, Santa Cruz da Serra</span>
            <div class="bg-green-800 hr px-4 py-1 rounded-lg mt-5" id="date-span">
                <span class="text-white font-medium">Seg á Dom - 18:00 ás 22:00</span>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-6">
        <div class="mx-auto max-w-7xl px-2 my-2">
            <h2 class="font-bold text-2xl">Pedidos</h2>
        </div>
        <div id="pedidos-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 mx-auto max-w-7xl px-2 mb-16"></div>
    </div>

    <script>
    // Carregar pedidos agrupados por mesa e horário
    function carregarPedidos() {
        fetch('pedidos.php')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('pedidos-container');
                container.innerHTML = ''; // Limpa o container

                data.forEach(grupo => {
                    const div = document.createElement('div');
                    div.className = 'bg-white shadow-lg rounded-lg p-6 border border-gray-200';

                    // Cabeçalho com o número da mesa e horário
                    div.innerHTML = `<h2 class="text-xl font-bold text-gray-700 mb-4">Mesa ${grupo.mesa}</h2>
                                     <p class="text-sm text-gray-500">Horário: ${grupo.hora}</p>`;

                    // Lista de itens
                    const lista = document.createElement('ul');
                    lista.className = 'space-y-2';

                    grupo.itens.forEach(pedido => {
                        const item = document.createElement('li');
                        item.className = 'text-gray-600';
                        item.innerHTML = `<span class="font-semibold">${pedido.item}</span> (${pedido.quantidade})`;
                        lista.appendChild(item);
                    });

                    div.appendChild(lista);

                    // Botão para limpar os pedidos do grupo
                    const botao = document.createElement('button');
                    botao.className =
                        'mt-4 px-4 py-2 bg-green-500 text-white font-medium rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2';
                    botao.innerText = 'Limpar Pedidos';
                    botao.onclick = () => removerPedidosGrupo(grupo.mesa, grupo.hora, grupo.itens);
                    div.appendChild(botao);

                    container.appendChild(div);
                });
            });
    }

    // Função para remover pedidos de uma mesa específica
    function removerPedidosGrupo(mesa, hora, itens) {
        if (confirm(`Tem certeza que deseja remover os pedidos da Mesa ${mesa} no horário ${hora}?`)) {
            fetch('remover_pedido.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `mesa=${mesa}&hora=${hora}&itens=${encodeURIComponent(JSON.stringify(itens))}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Pedidos da Mesa ${mesa} no horário ${hora} foram removidos!`);
                        carregarPedidos(); // Atualiza a lista
                    } else {
                        alert('Erro ao remover os pedidos.');
                    }
                });
        }
    }

    // Inicializar
    carregarPedidos();
</script>

</body>
</html>
