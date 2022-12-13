<?php

define ('HOST','localhost');
define ('DB_NAME','php2');
define ('USER','root');
define ('PASS','');

try{
    $pdo = new PDO('mysql:host=localhost;dbname=minecraft_data', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e;
}
?>