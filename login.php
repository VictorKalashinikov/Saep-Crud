<?php 
session_start(); 
 
if (!empty($_SESSION['usuario_id'])) { 
    header('Location: principal.php'); 
    exit; 
} 
 
$mensagem = ''; 
if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok') { 
    $mensagem = 'Cadastro realizado. Agora faça o login.'; 
} 
if (isset($_GET['erro'])) { 
    $mensagem = 'E-mail ou senha inválidos.'; 
} 
?> 
<!DOCTYPE html> 
<html lang="pt-BR"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Login</title> 
    <link rel="stylesheet" href="css/style.css"> 
</head> 
<body class="pagina-auth"> 
    <main class="card auth-card"> 
        <h1>Login</h1> 
        <p class="subtitulo">Entre para acessar o CRUD de produtos.</p> 
 
        <?php if ($mensagem): ?> 
            <div class="mensagem info"><?= htmlspecialchars($mensagem) ?></div> 
        <?php endif; ?> 
 
        <form action="autenticar.php" method="post" class="formulario"> 
            <label for="email">E-mail</label> 
            <input id="email" name="email" type="email" required autocomplete="email"> 
 
            <label for="senha">Senha</label> 
            <input id="senha" name="senha" type="password" required autocomplete="current-password">
            <button type="submit" class="botao primario">Entrar</button> 
        </form> 
 
        <p class="rodape-card">Ainda não tem conta? <a href="cadastro_usuario.php">Cadastrar usuário</a></p> 
    </main> 
</body> 
</html> 