<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
$pdo = new PDO('mysql:host=localhost;dbname=minecraft_data', 'root', 'root');



if(isset($_GET['idArt']) AND !empty($_GET['idArt'])){
    $getid = $_GET['idArt'];

    $obj = $pdo->prepare('SELECT * FROM articles WHERE id_article=?');
    $obj->execute(array($getid));

    if($obj->rowCount() > 0){
        $articleInfo = $obj->fetch();
        $titre = $articleInfo['titre'];
        $contenu = str_replace ('<br />', '', $articleInfo['contenu']);

        if(isset($_POST['valider'])){
            $titre_saisi = htmlspecialchars($_POST['titre']);
            $desc_saisi = nl2br(htmlspecialchars($_POST['contenu']));

            $updateArt = $pdo->prepare('UPDATE articles SET titre = ?, contenu = ? WHERE id_article =?');
            $updateArt->execute(array($titre_saisi, $desc_saisi, $getid));

            header('Location: index.php');
        }

        
    }else{
        echo "Aucun article trouvé";
    }
}else{
    echo "Aucun identifiant trouvé";
}

include_once('fonction/database.php');
?>

<!doctype html>
<html>
<head>
    <title>Publication d'article</title>
    <meta charset="utf-8">
</head>

<body>
    <h1>Modifier la publication</h1>

    <form method="POST">

        <input type="hidden" name="id_art" value="<?= $id_article ?>">
        
        <input type="text" name="titre" value="<?= $titre; ?>">
        <br>
        <textarea name="contenu"><?= $contenu; ?></textarea>
        <br>
        <input type="submit" name="valider">
    </form>
</body>
</html>