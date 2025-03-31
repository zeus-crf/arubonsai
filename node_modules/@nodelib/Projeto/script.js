const menu = document.getElementById("menu");
const cartBtn = document.getElementById("cart-btn");
const cartModal = document.getElementById("cart-modal");
const cartItemsContainer = document.getElementById("cart-items");
const checkoutBtn = document.getElementById("checkout-btn");
const closeModalBtn = document.getElementById("close-modal-btn");
const cartCounter = document.getElementById("cart-count");
const addressInput = document.getElementById("address");
const addressWarn = document.getElementById("address-warn");
const pop01 = document.getElementById("pop-01");
const item01 = document.getElementById("item-1");
const btnx = document.getElementById("btn-x");
const t1 = document.getElementById("t-1");

console.log("script.js carregado corretamente!");






let cart = [];

// Função para abrir o pop-up
item01.addEventListener("click", function() {
    pop01.style.display = "flex";
});

t1.addEventListener("click", function() {
    pop01.style.display = "flex";
});

// Função para fechar o pop-up

// Fechar o pop-up ao clicar fora
pop01.addEventListener("click", function(event) {
    if (event.target === pop01) {
        pop01.style.display = "none";
    }
});

// Abrir o modal do carrinho
cartBtn.addEventListener("click", function() {
    updateCartModal();  // Atualiza o modal antes de abrir
    cartModal.style.display = "flex";
});



// Fechar o modal ao clicar fora
cartModal.addEventListener("click", function(event) {
    if (event.target === cartModal) {
        cartModal.style.display = "none";
    }
});

// Fechar o modal com o botão
closeModalBtn.addEventListener("click", function() {
    cartModal.style.display = "none";
});

// Função para adicionar ao carrinho
function addToCart(name, quantity, price) {
    const existingItemIndex = cart.findIndex(item => item.name === name);

    if (existingItemIndex >= 0) {
        cart[existingItemIndex].quantity += quantity;
    } else {
        cart.push({ name, quantity, price });
    }

    updateCartModal();  // Atualiza o modal após adicionar o item
}

// Atualizar o modal do carrinho
function updateCartModal() {
    cartItemsContainer.innerHTML = "";
    let total = 0;

    cart.forEach(item => {
        const cartItemElement = document.createElement("div");
        cartItemElement.classList.add("flex", "justify-between", "mb-4");

        cartItemElement.innerHTML = `
            <div>
                <p class="font-medium">${item.name}</p>
                <p>Qtd: ${item.quantity}</p>
            </div>
            <button class="remove-from-cart-btn" data-name="${item.name}">Remover</button>
        `;

        cartItemsContainer.appendChild(cartItemElement);
        total += item.price * item.quantity;  // Calcula o total

    });

    // Atualiza o contador de itens no carrinho
    cartCounter.textContent = cart.length;
}

// Remover item do carrinho
cartItemsContainer.addEventListener("click", function(event) {
    if (event.target.classList.contains("remove-from-cart-btn")) {
        const name = event.target.getAttribute("data-name");
        removeItemCart(name);
    }
});

// Função para remover item do carrinho
function removeItemCart(name) {
    const index = cart.findIndex(item => item.name === name);

    if (index !== -1) {
        const item = cart[index];

        // Se a quantidade for maior que 1, reduz a quantidade
        if (item.quantity > 1) {
            item.quantity -= 1;
        } else {
            // Se a quantidade for 1, remove o item do array
            cart.splice(index, 1);
        }

        updateCartModal();  // Atualiza o modal após a remoção/redução da quantidade
    }
}

// Função para adicionar itens ao carrinho
const items2 = [
    // Entradas
    { id: 'fish-ball', name: 'Fish Ball', price: 32.90 },
    { id: 'missoshiro', name: 'Missoshiro', price: 32.90 },
    { id: 'lula', name: 'Anel de Lula', price: 22.90 },
    { id: 'tempura', name: 'Tempura', price: 22.90 },
    { id: 'isca-peixe', name: 'Isca de Peixe', price: 24.90 },
    { id: 'guioza', name: 'Guioza', price: 18.90 },

    // Espetinhos
    { id: 'espetinho-carne', name: 'Espetinho de Carne', price: 12.90 },
    { id: 'espetinho-frango', name: 'Espetinho de Frango', price: 10.90 },
    { id: 'espetinho-camarao', name: 'Espetinho de Camarão', price: 10.90 },
    { id: 'espetinho-lula', name: 'Espetinho de Lula', price: 13.90 },

    // Sushis
    { id: 'sushi-salmao', name: 'Sushi de Salmão', price: 13.90 },
    { id: 'sushi-kani', name: 'Sushi de Kani', price: 13.90 },
    { id: 'sushi-polvo', name: 'Sushi de Polvo', price: 13.90 },

    // Bebidas não alcoólicas
    { id: 'coca-cola', name: 'Coca Cola', price: 5.90 },
    { id: 'guarana', name: 'Guaraná', price: 5.90 },
    { id: 'soda-italiana', name: 'Soda Italiana', price: 22.00 },

    // Bebidas alcoólicas
    { id: 'caipirinha', name: 'Caipirinha', price: 15.90 },
    { id: 'caipivodka', name: 'Caipivodka', price: 16.90 },
    { id: 'gintonica', name: 'Gin Tônica', price: 26.00 },
    { id: 'pina-colada', name: 'Pina Colada', price: 26.00 },
    { id: 'lagoa-azul', name: 'Lagoa Azul', price: 25.00 }
];


// Inicializa contadores e eventos para cada item
items2.forEach(item => {
    const countElement = document.getElementById(`count-${item.id}`);
    const increaseButton = document.getElementById(`increase-${item.id}`);
    const decreaseButton = document.getElementById(`decrease-${item.id}`);

    if (countElement && increaseButton && decreaseButton) {
        let count = 0;

        increaseButton.addEventListener('click', () => {
            count++;
            countElement.textContent = count;
        });

        decreaseButton.addEventListener('click', () => {
            if (count > 0) {
                count--;
                countElement.textContent = count;
            }
        });

        document.querySelector(`.add-to-cart-btn[data-name="${item.name}"]`).addEventListener('click', () => {
            if (count > 0) {
                addToCart(item.name, count, item.price);  // Incluindo o preço
                count = 0;  // Reseta a contagem após adicionar
                countElement.textContent = count;  // Atualiza a exibição
            } else {
                alert('Por favor, adicione pelo menos 1 item.');
            }
        });
    }
});

// Finalizar pedido
checkoutBtn.addEventListener('click', () => {   
    const tableNumber = addressInput.value;

    if (!tableNumber) {
        addressWarn.classList.remove("hidden");
        return;
    }

    const data = {
        tableNumber: tableNumber,
        cartItems: cart,  // Ajustado para 'cartItems' conforme o PHP
    };

    fetch('checkout.php', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) alert(data.message);
        if (data.error) alert(data.error);
    })
    .catch(error => {
        console.error('Erro ao enviar pedido:', error);
        alert('Houve um erro ao enviar o pedido.');
    });
}); // Fecha o addEventListener corretamente
