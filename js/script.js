
window.onload = function() {

    const userIcon = document.querySelector('.icons img[src="icons/user-icon.png"]');
    const dropdownMenu = document.getElementById('dropdownMenu');

    function toggleDropdownMenu() {
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    }

    if (userIcon) {
        userIcon.addEventListener('click', toggleDropdownMenu);
    }

    window.addEventListener('click', (event) => {
        if (!userIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });

    const closeIcon = document.querySelector('.close-icon');
    if (closeIcon) {
        closeIcon.addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = 'index.html'; 
        });
    }

    const noAccountLink = document.querySelector('.no-account-link');
    if (noAccountLink) {
        noAccountLink.addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = 'loja-cadastro.html'; 
        });
    }

 
    function redirectToCesta(event) {
        event.preventDefault();
        window.location.href = 'loja-cesta.html';
    }
    document.querySelectorAll('.icons img[src="icons/cart-icon.png"]').forEach(icon => {
        icon.addEventListener('click', redirectToCesta);
    });

    function redirectToNovidades(event) {
        event.preventDefault();
        window.location.href = 'loja-novidades.html';
    }
    document.querySelectorAll('.novidades').forEach(icon => {
        icon.addEventListener('click', redirectToNovidades);
    });

    document.getElementById("loginUsuario")?.addEventListener('click', function(event) {
        event.preventDefault();
        window.location.href = 'loja-login.html';  
    });

    document.getElementById("loginLojista")?.addEventListener('click', function(event) {
        event.preventDefault();
        window.location.href = 'dash-login.html'; 
    });

};


const products = [
    { id: 1, name: "Camiseta Básica", color: "Branca", size: "P", price: "159,90", image: "images/prod01.jpg" },
    { id: 2, name: "Camiseta Básica", color: "Branca", size: "M", price: "159,90", image: "images/prod01.jpg" },
    { id: 3, name: "Camiseta Básica", color: "Branca", size: "G", price: "159,90", image: "images/prod01.jpg" },
    { id: 4, name: "Camiseta Básica", color: "Branca", size: "X", price: "159,90", image: "images/prod01.jpg" },
    { id: 5, name: "Calça Jeans Básica", color: "Azul", size: "12", price: "209,90", image: "images/prod02.jpg" },
    { id: 6, name: "Calça Jeans Básica", color: "Azul", size: "14", price: "209,90", image: "images/prod02.jpg" },
    { id: 7, name: "Calça Jeans Básica", color: "Azul", size: "16", price: "209,90", image: "images/prod02.jpg" },
    { id: 8, name: "Calça Jeans Básica", color: "Azul", size: "18", price: "209,90", image: "images/prod02.jpg" }
];

function addProducts() {
    const productList = document.getElementById("product-list");
    if (!productList) {
        console.error("Elemento com id 'product-list' não encontrado.");
        return;
    }
    productList.innerHTML = ""; 

    products.forEach(product => {
        const productElement = createProduct(product);  
        productList.appendChild(productElement);
    });
}

function createProduct(product) {
    const productElement = document.createElement("div");
    productElement.classList.add("product");

    productElement.innerHTML = `
        <input type="checkbox" class="product-checkbox" id="product-${product.id}">
        <img src="${product.image || 'images/default-image.jpg'}" alt="${product.name}">
        <div class="product-details">
            <p><strong>${product.name}</strong></p>
            <p>Cor: ${product.color}</p>
            <p>Tam: ${product.size}</p>
            <p>${product.price}</p>
        </div>
    `;
    return productElement;
}


function getSelectedProducts() {
    const selectedProducts = [];
    const checkboxes = document.querySelectorAll(".product-checkbox:checked"); 

    checkboxes.forEach(checkbox => {
        const productElement = checkbox.closest(".product");
        const productId = checkbox.id.split('-')[1]; 
        const product = products.find(product => product.id == productId); 

        if (product) {
            selectedProducts.push({
                ...product, 
                quantity: 1  
            });
        }
    });

    console.log("Produtos selecionados:", selectedProducts); 
    return selectedProducts;
}

function addToCart() {
    const selectedProducts = getSelectedProducts();
    if (selectedProducts.length > 0) {
        let cartProducts = JSON.parse(localStorage.getItem("cartProducts")) || [];

        selectedProducts.forEach(selectedProduct => {
            const existingProduct = cartProducts.find(product => product.id === selectedProduct.id);
            if (existingProduct) {
                existingProduct.quantity += 1; 
            } else {
                cartProducts.push(selectedProduct);  
            }
        });

        localStorage.setItem("cartProducts", JSON.stringify(cartProducts));
        alert("Produtos adicionados à cesta!");
    } else {
        alert("Nenhum produto selecionado.");
    }
}


function displayCartProducts() {
    const cartItemsContainer = document.getElementById("cart-items");
    const cartProducts = JSON.parse(localStorage.getItem("cartProducts")) || []; 

    if (cartProducts.length === 0) {
        cartItemsContainer.innerHTML = "<p>Seu carrinho está vazio.</p>";
        return;
    }

    cartItemsContainer.innerHTML = "";  

    cartProducts.forEach((product, index) => {
        const productElement = document.createElement("div");
        productElement.classList.add("cart-item");

        productElement.innerHTML = `
            <img src="${product.image || 'images/default-image.jpg'}" alt="${product.name}">
            <div class="cart-item-details">
                <p><strong>${product.name}</strong></p>
                <p>Cor: ${product.color}</p>
                <p>Tam: ${product.size}</p>
                <p>${product.price}</p>
            </div>
            <button class="remove-btn" data-index="${index}">X</button>
        `;

        cartItemsContainer.appendChild(productElement);

        productElement.querySelector(".remove-btn").addEventListener("click", function(event) {
            const productIndex = event.target.dataset.index;
            removeProductFromCart(productIndex);
        });
    });

    updateCartSummary();
}

function removeProductFromCart(index) {
    let cartProducts = JSON.parse(localStorage.getItem("cartProducts")) || [];
    cartProducts.splice(index, 1);  
    localStorage.setItem("cartProducts", JSON.stringify(cartProducts));  
    displayCartProducts();  
    updateCartSummary();  
}


function updateCartSummary() {
    const cartProducts = JSON.parse(localStorage.getItem("cartProducts")) || [];

    if (cartProducts.length === 0) {
        document.getElementById("subtotal").textContent = `R$ 0.00`;
        document.getElementById("total").textContent = `R$ 0.00`;
        return;  
    }

    const subtotal = cartProducts.reduce((total, product) => total + (parseFloat(product.price.replace(",", ".")) * product.quantity), 0);
    const discount = applyDiscount(subtotal);
    const total = subtotal - discount;

    document.getElementById("subtotal").textContent = `R$ ${subtotal.toFixed(2)}`;
    document.getElementById("total").textContent = `R$ ${total.toFixed(2)}`;
}

function applyDiscount(subtotal) {
    const coupon = document.getElementById("coupon-input").value;
    let discount = 0;

    if (coupon === "DESCONTO10") {
        discount = subtotal * 0.10;
    } document.getElementById("apply-coupon-btn").addEventListener("click", function() {
        updateCartSummary();  
    });

    return discount;

}

window.addEventListener("DOMContentLoaded", (event) => {
    if (window.location.pathname.includes("novidades.html")) {
        addProducts(); 
        document.getElementById("add-to-cart-btn").addEventListener("click", addToCart);
    } else if (window.location.pathname.includes("cesta.html")) {
        displayCartProducts(); 
        document.getElementById("checkout-btn").addEventListener("click", updateCartSummary);
    }
});



//validar senha
document.querySelector("form").addEventListener("submit", function(event) {
    const senha = document.getElementById("password").value;
    const confirmaSenha = document.getElementById("confirm-password").value;

    if (senha !== confirmaSenha) {
        alert("As senhas não coincidem. Insira a mesma senha nos dois campos e tente novamente.");
        event.preventDefault(); 
    }
});


   