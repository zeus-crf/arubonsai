document.addEventListener("DOMContentLoaded", () => {
    const cart = [];
    const cartModal = document.getElementById("cart-modal");
    const cartItemsContainer = document.getElementById("cart-items");
    const cartTotalElement = document.getElementById("cart-total");
    const cartCountElement = document.getElementById("cart-count");
    const checkoutBtn = document.getElementById("checkout-btn");

    // Atualizar o carrinho modal
    function updateCartModal() {
        cartItemsContainer.innerHTML = ""; // Limpa os itens do modal
        let total = 0;

        cart.forEach((item, index) => {
            total += item.quantity * parseFloat(item.price);

            const itemElement = document.createElement("div");
            itemElement.className = "flex justify-between items-center mb-2";

            itemElement.innerHTML = `
                <p id="item" name="item">${item.name}</p>
                <p id="quantidade" name="quantidade" class="text-gray-500 text-sm">(Qtd: ${item.quantity})</p>
                <button class="text-red-500 remove-item" data-index="${index}">Remover</button>
            `;

            cartItemsContainer.appendChild(itemElement);
        });

        cartCountElement.textContent = cart.reduce((acc, item) => acc + item.quantity, 0);
    }

    // Aumentar quantidade do item
    document.querySelectorAll(".increase").forEach((button) => {
        button.addEventListener("click", () => {
            const countElement = button.previousElementSibling;
            let count = parseInt(countElement.textContent);
            count++;
            countElement.textContent = count;
        });
    });

    // Diminuir quantidade do item
    document.querySelectorAll(".decrease").forEach((button) => {
        button.addEventListener("click", () => {
            const countElement = button.nextElementSibling;
            let count = parseInt(countElement.textContent);
            if (count > 0) {
                count--;
                countElement.textContent = count;
            }
        });
    });

    // Adicionar ao carrinho
    document.querySelectorAll(".add-to-cart-btn").forEach((button) => {
        button.addEventListener("click", () => {
            const name = button.getAttribute("data-name");
            const price = button.getAttribute("data-price");
            const countElement = button.previousElementSibling.querySelector(".count");
            const quantity = parseInt(countElement.textContent);

            if (quantity > 0) {
               
                const existingItem = cart.find((item) => item.name === name);

                if (existingItem) {
                    existingItem.quantity += quantity;
                } else {
                    cart.push({ name, price, quantity });
                }

                countElement.textContent = "0"; 
                updateCartModal(); 
            } else {
                alert("Por favor, selecione uma quantidade válida.");
            }
        });
    });

        
    // Remover item do carrinho ou diminuir a quantidade
cartItemsContainer.addEventListener("click", (event) => {
    if (event.target.classList.contains("remove-item")) {
        const index = event.target.getAttribute("data-index");
        const item = cart[index];

        if (item.quantity > 1) {
            item.quantity--; 
        } else {
            cart.splice(index, 1); 
        }

        updateCartModal(); // Atualiza o modal
    }
});


    // Abrir o modal
    document.getElementById("cart-btn").addEventListener("click", () => {
        cartModal.style.display = "flex";
        updateCartModal();
    });

    document.getElementById("close-modal-btn").addEventListener("click", () => {
        cartModal.style.display = "none"; 
    });

    // Finalizar pedido
    
    checkoutBtn.addEventListener("click", (e) => {
        e.preventDefault(); 

        const mesa = document.getElementById("mesa").value.trim();
        if (!mesa) {
            alert("Por favor, informe o número da mesa!");
            return;
        }

        const cartData = cart.map(item => ({
            item: item.name,
            quantidade: item.quantity,
            mesa: mesa,
        }));

        if (cartData.length === 0) {
            alert("Seu carrinho está vazio!");
            return;
        }

        fetch('http://localhost/Projeto/processo.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(cartData),
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            }
            throw new Error('Erro ao salvar o pedido.');
        })
        .then(data => {
            alert('Pedido enviado com sucesso!');
            cart.length = 0; 
            updateCartModal(); 
            cartModal.style.display = "none"; 
        })
        .catch(error => {
            console.error('Erro ao enviar o pedido:', error);
            alert('Houve um erro ao enviar o pedido. Tente novamente.');
        });
    });
});