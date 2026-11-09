<?php 
session_start(); 
 
if (!empty($_SESSION['usuario_id'])) { 
    header('Location: principal.php'); 
} else { 
    header('Location: login.php'); 
} 
exit; 