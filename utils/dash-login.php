<?php
session_start();

if (!isset($_SESSION['lojista_logged_in']) || $_SESSION['lojista_logged_in'] !== true) {
    header('Location: ../dash-login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/styles-dash.css">
</head>
<body>
    <div class="container-cadastro">
        <div class="form-box">
            <h2>Login</h2>
            <form id="form-dash" method="POST" action="processa-dash-login.php">
                <div class="form-field">
                    <label for="email" class="label-login">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="meu@email.com" class="input-field" required>
                </div>
                <div class="form-field">
                    <label for="password" class="label-login">Senha</label>
                    <input type="password" id="password" name="password" class="input-field" required>
                    <p class="password-forgotten"> 
                        <a href="" target="_blank" class="password-forgotten-link">Esqueci minha senha.</a>
                    </p>
                </div>
                <button type="submit" class="submit-btn">Entrar</button>

                <div class="no-account">
                    <p>
                        Não tem uma conta? 
                        <a class="no-account-link" href="../dash-cadastro.html">Cadastre-se</a>.
                    </p> 
                </div>
            </form>
            <a href="../dash-index.html">
                <img src="../icons/close-icon.png" alt="Fechar" class="close-icon">
            </a>
        </div>        
    </div>

    <script src="../js/script-dash.js"></script>
</body>
</html>
