<?php 
session_start(); 
require __DIR__ . '/config/conexao.php'; 
 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { 
    header('Location: login.php'); 
    exit; 
} 
 
$email = trim($_POST['email'] ?? ''); 
$senha = $_POST['senha'] ?? ''; 
 
$stmt = $pdo->prepare('SELECT id, nome, email, senha FROM usuarios WHERE email = ?'); 
$stmt->execute([$email]); 
$usuario = $stmt->fetch(); 
 
if ($usuario && password_verify($senha, $usuario['senha'])) { 
    session_regenerate_id(true); 
    $_SESSION['usuario_id'] = $usuario['id']; 
    $_SESSION['usuario_nome'] = $usuario['nome']; 
 
    header('Location: principal.php'); 
    exit; 
} 
 
header('Location: login.php?erro=1'); 
exit; 