<?php
include 'conexao.php';

$sql = "SELECT * FROM produtos WHERE categoria = 'Aperitivos' ";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="./assets/logon.jpeg">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="./styles/output.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        
        <title>Aru Sushi Lounge</title>


    </head>
    <style>
        header{
            background-color: #26432D;
        }
    </style>
<body>
    <!--HEADER-->
    <header class="w-full h-[420px] bg-teal-500 bg-cover bg-center">
        <div class="w-full h-full flex flex-col justify-center items-center">
            <img src="./assets/logon.jpeg" alt="Logo" class="w-32 h-32 rounded-full shadow-lg hover:scale-110 duration-200">
        <h1 class="text-4xl mt-4 mb-2 font-bold text-white">Aru Sushi Lounge</h1>
        
    <span class="text-white font-medium">Av Automóvel Clube, Santa Cruz da Serra</span>

    <div class="bg-green-800 hr px-4 py-1 rounded-lg mt-5"id="date-span">
        <span class="text-white font-medium">Seg á Dom - 18:00 ás 22:00</span>
    </div>

    </div>
    </header>
    <!-- FIM HEADER-->

    <h2 class="text-2xl md:text-3xl font-bold text-center mt-9 mb-6">Conheça o nosso Cardápio</h2>

    <!--LINKS-->
    <ul class="text-center flex justify-around decoration-8 mb-6 items-center">

    <div >
        <form action="indexbebidas.php" method="post">
        <button name="cat-bebidas" value="<?php echo 'Bebidas' ?>" class="hover:text-green-600"><li><a href="zeus-crf.github.io/arubonsai/indexbebidas.php">Bedidas</a></li></button>
        </form>
    </div> 
    <span class="opacity-50">|</span>
    
    <button class="bg-zinc-900 in text-primary-foreground py-2 px-4 rounded-lg w-32 text-white shadow-md transition duration-300 hover:bg-primary/80 focus:outline-none focus:ring-2 focus:ring-ring hover:bg-green-600/65 valid:">Inicio</button>
    <span class="opacity-50">|</span>
      
    <div >
        <button class="hover:text-green-600"><li><a href="zeus-crf.github.io/arubonsai/indexsobremasas.php">Sobremesas</a></li></button>
    </div> 
    </ul>


    <!--LINKS-->
<!--Inicio Menu-->
 
        <div class ="mx-auto max-w-7xl px-2 my-2">
            <h2 class="font-bold text-2xl">Aperitivos</h2>
        </div>
        <div class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-7 md:gap-10 mx-auto max-w-7xl px-2 mb-16">
     <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <!--PRODUTO ITEM-->
                <div class="flex gap-2">
                    <img src="<?= $row['imagem'] ?>" id="item-<?= $row['id'] ?>" class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300">
                    
                    <div class="w-62">
                        <p class="font-bold"><?= $row['nome'] ?></p>
                        <p id="t-<?= $row['id'] ?>" class="text-sm text-justify"><?= $row['descricao'] ?></p>
                        
                        <div class="flex items-center gap-2 justify-between mt-3">
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center space-x-30">
                                    <div class="flex items-center border border-green-600 rounded-lg p-2 h-8 mt-5">
                                        <button id="decrease-<?= $row['id'] ?>" class="text-red-500 decrease bg-secondary text-secondary-foreground p-2 rounded-l-lg hover:bg-secondary/80 remove-from-cart-btn">-</button>
                                        <span id="count-<?= $row['id'] ?>" class="border-t border-b px-4 count">0</span>
                                        <button id="increase-<?= $row['id'] ?>" class="p-2 increase rounded-r-lg bg-secondary text-secondary-foreground hover:bg-secondary/80" data-name="<?= $row['nome'] ?>" data-price="32.90">+</button>
                                    </div>
                                    <button class="bg-green-800 an text-white mt-5 px-4 py-2 rounded-lg ml-4 flex items-center justify-around gap-2 add-to-cart-btn" data-name="<?= $row['nome'] ?>" data-price="32.90">Adicionar
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                                            <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0"/>
                                        </svg>
                                    </button>
                                </div>        
                            </div>
                        </div>
                    </div>
                </div>
                <!--FIM PRODUTO ITEM-->
            <?php endwhile; ?>
        <?php else: ?>
            <p>Não há produtos cadastrados.</p>
        <?php endif; ?>
</div>

<?php
include 'conexao.php';

$sql = "SELECT * FROM produtos WHERE categoria = 'sushi' ";
$result = $conn->query($sql);
?>


            
<div class ="mx-auto max-w-7xl px-2 my-2">
            <h2 class="font-bold text-2xl">Sushis</h2>
        </div>

        <div class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-7 md:gap-10 mx-auto max-w-7xl px-2 mb-16">
     <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <!--PRODUTO ITEM-->
                <div class="flex gap-2">
                    <img src="<?= $row['imagem'] ?>" id="item-<?= $row['id'] ?>" class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300">
                    
                    <div class="w-62">
                        <p class="font-bold"><?= $row['nome'] ?></p>
                        <p id="t-<?= $row['id'] ?>" class="text-sm text-justify"><?= $row['descricao'] ?></p>
                        
                        <div class="flex items-center gap-2 justify-between mt-3">
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center space-x-30">
                                    <div class="flex items-center border border-green-600 rounded-lg p-2 h-8 mt-5">
                                        <button id="decrease-<?= $row['id'] ?>" class="text-green-500 decrease bg-secondary text-secondary-foreground p-2 rounded-l-lg hover:bg-secondary/80 remove-from-cart-btn">-</button>
                                        <span id="count-<?= $row['id'] ?>" class="border-t border-b px-4 count">0</span>
                                        <button id="increase-<?= $row['id'] ?>" class="p-2 increase rounded-r-lg bg-secondary text-secondary-foreground hover:bg-secondary/80" data-name="<?= $row['nome'] ?>" data-price="32.90">+</button>
                                    </div>
                                    <button class="bg-green-800 text-white mt-5 px-4 py-2 rounded-lg ml-4 flex items-center justify-around gap-2 add-to-cart-btn" data-name="<?= $row['nome'] ?>" data-price="32.90">Adicionar
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                                            <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0"/>
                                        </svg>
                                    </button>
                                </div>        
                            </div>
                        </div>
                    </div>
                </div>
                <!--FIM PRODUTO ITEM-->
            <?php endwhile; ?>
        <?php else: ?>
            <p>Não há produtos cadastrados.</p>
        <?php endif; ?>
</div>


<?php
include 'conexao.php';

$sql = "SELECT * FROM produtos WHERE categoria = 'Prato alternativo' ";
$result = $conn->query($sql);
?>

<div class ="mx-auto max-w-7xl px-2 my-2">
            <h2 class="font-bold text-2xl">Pratos Alternativos</h2>
        </div>

        
        <div class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-7 md:gap-10 mx-auto max-w-7xl px-2 mb-16">
     <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <!--PRODUTO ITEM-->
                <div class="flex gap-2">
                    <img src="<?= $row['imagem'] ?>" id="item-<?= $row['id'] ?>" class="w-28 h-28 rounded-md hover:scale-110 hover:-rotate-2 duration-300">
                    
                    <div class="w-62">
                        <p class="font-bold"><?= $row['nome'] ?></p>
                        <p id="t-<?= $row['id'] ?>" class="text-sm text-justify"><?= $row['descricao'] ?></p>
                        
                        <div class="flex items-center gap-2 justify-between mt-3">
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center space-x-30">
                                    <div class="flex items-center border border-green-600 rounded-lg p-2 h-8 mt-5">
                                        <button id="decrease-<?= $row['id'] ?>" class="text-green-500 decrease bg-secondary text-secondary-foreground p-2 rounded-l-lg hover:bg-secondary/80 remove-from-cart-btn">-</button>
                                        <span id="count-<?= $row['id'] ?>" class="border-t border-b px-4 count">0</span>
                                        <button id="increase-<?= $row['id'] ?>" class="p-2 increase rounded-r-lg bg-secondary text-secondary-foreground hover:bg-secondary/80" data-name="<?= $row['nome'] ?>" data-price="32.90">+</button>
                                    </div>
                                    <button class="bg-green-800 text-white mt-5 px-4 py-2 rounded-lg ml-4 flex items-center justify-around gap-2 add-to-cart-btn" data-name="<?= $row['nome'] ?>" data-price="32.90">Adicionar
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                                            <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0"/>
                                        </svg>
                                    </button>
                                </div>        
                            </div>
                        </div>
                    </div>
                </div>
                <!--FIM PRODUTO ITEM-->
            <?php endwhile; ?>
        <?php else: ?>
            <p>Não há produtos cadastrados.</p>
        <?php endif; ?>
</div>














<!--BUTTON CART FOOTER-->
<footer class="w-full fo bg-green-800 py-3 fixed bottom-0 z-40 flex items-center justify-center">
        <button class="flex items-center gap-2 text-white font-bold" id="cart-btn">
            (<span id="cart-count">0</span>)
            Veja seu Pedido
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-check-fill" viewBox="0 0 16 16">
                <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm6.854 7.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
            </svg>
        </button>
    </footer>
    <!-- FIM BUTTON CART FOOTER-->

    <div
    class="bg-black/60 w-full h-full fixed top-0 left-0 z-[99] items-center justify-center hidden"
    id="cart-modal"
>
    <div class="bg-white p-5 rounded-md min-w-[90%] md:min-w-[600px]">
        <h2 class="text-center font-bold text-2xl mb-2">Meu Pedido</h2>
        <form id="form1" action="" method="post">
        <div id="cart-items" class="flex justify-between mb-2 flex-col"></div>

        <p class="font-bold mt-4">Mesa:</p>
        <input
            type="text"
            placeholder="Digite a sua mesa:"
            id="mesa"
            class="w-full border-2 p-1 my-1"
             name="mesa"
        />

        <p class="text-red-500 hidden" id="address-warn">Digite a sua mesa!</p>

        <div class="flex items-center justify-between mt-5 w-full">
            <button id="close-modal-btn" type="button">Fechar</button>
            <button
                id="checkout-btn"
                class="bg-green-800 text-white px-4 py-1 rounded"
            >
                Finalizar Pedido
            </button>
        </div>
        </form>
    </div>
</div>









    

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="script2.js"></script>


</body>
</html>

<?php
$conn->close();
?>
