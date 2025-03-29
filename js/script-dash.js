document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', () => {
        item.classList.toggle('active');
    });
});

window.onload = function() {

    document.getElementById("loginLojista")?.addEventListener('click', function(event) {
        event.preventDefault();
        window.location.href = 'dash-login.html'; 
    });

    const noAccountLink = document.querySelector('.no-account-link');
    if (noAccountLink) {
        noAccountLink.addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = 'dash-cadastro.html'; 
        });
    }

    const userIcon = document.querySelector('.user-icon-dash');
    if (userIcon) {
        userIcon.addEventListener('click', function(event) {
            window.location.href = 'dash-login.html'; 
        });
    }

    const closeIcon = document.querySelector('.close-icon');
    if (closeIcon) {
        closeIcon.addEventListener('click', function(event) {
            window.location.href = 'dash-index.html'; 
        });
    }

    const logOutIcon = document.querySelector('.logout-icon');
    if (logOutIcon) {
        logOutIcon.addEventListener('click', function(event) {
            window.location.href = 'dash-login.html'; 
        });
    }
}

function redirectToPage(url, delay) { 
    setTimeout(function() {
        window.location.href = url;
    }, delay);
}

function cancelAddFornecedor() {
    document.getElementById('fornecedor-nome').value = '';
    document.getElementById('cnpj').value = '';
    document.getElementById('telefone').value = '';
    window.location.reload();
    event.preventDefault(); 
}

function cancelAddProduto() {
    document.getElementById('produto-nome').value = '';
    document.getElementById('fornecedor_id').value = '';
    document.getElementById('quantidade').value = '';
    document.getElementById('cor').value = '';
    document.getElementById('tamanho').value = '';
    document.getElementById('preco_unitario').value = '';
    document.getElementById('descricao').value = '';
    window.location.reload();
    event.preventDefault(); 

}

document.querySelector("form").addEventListener("submit", function(event) {
    const senha = document.getElementById("password").value;
    const confirmaSenha = document.getElementById("confirm-password").value;

    if (senha !== confirmaSenha) {
        alert("As senhas não coincidem. Insira a mesma senha nos dois campos e tente novamente.");
        event.preventDefault(); 
    }
});
