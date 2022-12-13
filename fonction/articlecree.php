<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

include_once('database.php');
?>

<?php
    
    

?>

<!doctype html>
<html>
<head>
    <title>Publication d'article</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style/article.css">
</head>

<?php
    if(isset($_POST['envoi'])){
        if(!empty($_POST['tag'])){
            if(!empty($_POST['titre']) AND !empty($_POST['contenu'])) {
                $titre = htmlspecialchars($_POST['titre']);
                $contenu = nl2br(htmlspecialchars($_POST['contenu']));
                $tag= $_POST['tag'];

                $author = $_SESSION['auth']['pseudo'];
                $id = $_SESSION['auth']['id_users'];

                // $author = $pdo->prepare("INSERT INTO articles($author) VALUES(?) WHERE id_users='$id'")
                // $author->execute();

                $insererArticle = $pdo->prepare('INSERT INTO articles(titre, contenu, author, tag)VALUES(?, ?, ?, ?)');
                $insererArticle->execute(array($titre, $contenu, $author, $tag));

                echo "L'article a bien été publié";
                header('Location: ../index.php');
            }else{
                echo "Veuillez remplir tous les champs";
            }
        }else {
            echo "Veuillez indiquez la catégorie de l'article";
        }
        
    }
?>

    
<body>
    <div class="form_div">
        <form method="POST" action="">

            <h2>Nouveau Sujet</h2>

            <div class="select_art">
                <select name="tag" id="format">
                    <option selected disabled>Catégorie de l'article</option>
                    <option value="general">Géneral</option>
                    <option value="divers">Divers</option>
                </select>
            </div>

            <input class="titre" type="text" name="titre" placeholder="Saisir le titre du sujet">
            <br>
            <textarea name="contenu" placeholder="Contenue du sujet"></textarea>
            <br>
            <input class="envoi" type="submit" name="envoi">
        </form>
    </div>
    
</body>
</html>