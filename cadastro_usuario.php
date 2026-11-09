<?php 
require __DIR__ . '/config/conexao.php'; 
 
$mensagem = ''; 
$tipoMensagem = ''; 
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $nome = trim($_POST['nome'] ?? ''); 
    $email = trim($_POST['email'] ?? ''); 
    $senha = $_POST['senha'] ?? ''; 
    $confirmarSenha = $_POST['confirmar_senha'] ?? ''; 
 
    if ($nome === '' || $email === '' || $senha === '') { 
        $mensagem = 'Preencha todos os campos obrigatórios.'; 
        $tipoMensagem = 'erro'; 
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        $mensagem = 'Digite um e-mail válido.'; 
        $tipoMensagem = 'erro'; 
    } elseif (strlen($senha) < 6) { 
        $mensagem = 'A senha deve ter pelo menos 6 caracteres.'; 
        $tipoMensagem = 'erro'; 
    } elseif ($senha !== $confirmarSenha) { 
        $mensagem = 'As senhas não coincidem.'; 
        $tipoMensagem = 'erro'; 
    } else { 
        $verificar = $pdo->prepare('SELECT id FROM usuarios WHERE email = ?'); 
        $verificar->execute([$email]); 
 
        if ($verificar->fetch()) { 
            $mensagem = 'Já existe um usuário cadastrado com este e-mail.'; 
            $tipoMensagem = 'erro'; 
        } else { 
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT); 
 
            $stmt = $pdo->prepare( 
                'INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)' 
            );
            $stmt->execute([$nome, $email, $senhaHash]); 
 
            header('Location: login.php?cadastro=ok'); 
            exit; 
        } 
    } 
} 
?> 
<!DOCTYPE html> 
<html lang="pt-BR"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Cadastro de usuário</title> 
    <link rel="stylesheet" href="css/style.css"> 
</head> 
<body class="pagina-auth"> 
    <main class="card auth-card"> 
        <h1>Criar conta</h1> 
        <p class="subtitulo">Cadastre um usuário para acessar o sistema.</p> 
 
        <?php if ($mensagem): ?> 
            <div class="mensagem <?= htmlspecialchars($tipoMensagem) ?>"> 
                <?= htmlspecialchars($mensagem) ?> 
            </div> 
        <?php endif; ?> 
 
        <form method="post" class="formulario"> 
            <label for="nome">Nome</label> 
            <input id="nome" name="nome" type="text" required 
                   value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>"> 
 
            <label for="email">E-mail</label> 
            <input id="email" name="email" type="email" required 
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"> 
 
            <label for="senha">Senha</label> 
            <input id="senha" name="senha" type="password" minlength="6" required> 
 
            <label for="confirmar_senha">Confirmar senha</label> 
            <input id="confirmar_senha" name="confirmar_senha" type="password" minlength="6" required> 
 
            <button type="submit" class="botao primario">Cadastrar</button> 
        </form> 
 
        <p class="rodape-card">Já possui conta? <a href="login.php">Entrar</a></p> 
    </main> 
</body>
</html>