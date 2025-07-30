<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['email'])) {
    die('voce nao pode acessar a pagina sem estar logado. <p><a href="login.php">fazer login</a></p>');
}
?>