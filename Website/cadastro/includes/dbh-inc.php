<?php


$dsn = "mysql:host=localhost;dbname=sqlsite";
$dbusername = "root";
$dbpassword = "";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo "Conexão com banco de dados falhou". $e->getMessage();

    
}
