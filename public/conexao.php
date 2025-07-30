<?php
 $usuario = 'root';
 $senha = '';
 $database = 'TCC';
 $host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if ($mysqli->error) {
    die("Falha ao conectar: " . $mysql->error);
}
