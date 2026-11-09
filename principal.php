<?php 
require __DIR__ . '/includes/proteger.php'; 
?> 
<!DOCTYPE html> 
<html lang="pt-BR"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Página principal</title> 
    <link rel="stylesheet" href="css/style.css"> 
</head> 
<body> 
    <header class="topo"> 
        <div> 
            <strong>SAEP CRUD</strong> 
            <span>Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</span> 
        </div> 
        <a class="botao secundario" href="logout.php">Sair</a> 
    </header> 
 
    <main class="container"> 
        <section class="hero"> 
            <h1>Painel principal</h1> 
            <p>Use o menu abaixo para gerenciar os produtos cadastrados.</p> 
            <a class="botao primario" href="produtos/listar.php">Abrir CRUD de produtos</a> 
        </section> 
    </main> 
</body> 
</html> 