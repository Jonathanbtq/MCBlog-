<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
$pdo = new PDO('mysql:host=localhost;dbname=minecraft_data', 'root', 'root');

$suppr = $pdo->prepare('DELETE FROM articles WHERE id_article=:id LIMIT 1');

$suppr->bindValue(':id', $_GET['numArticle'], PDO::PARAM_INT);

$execok = $suppr->execute();

if($execok){
    header('Location: ../index.php');
} else {
    echo 'Une erreur est survenue';
}


?>