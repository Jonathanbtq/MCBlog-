<?php
    session_start();
    global $pdo;

    $pdo = new PDO('mysql:host=localhost;dbname=minecraft_data', 'root', 'root');

    $userinfo['grade'] = $_SESSION['auth']['grade'];

    if(isset($_SESSION['auth']['id_users'])) {
        if(isset($_GET['supprimer']) AND !empty($_GET['supprimer'])) {
            $supprimer = (int) $_GET['supprimer'];

            $req = $pdo->prepare('DELETE FROM users WHERE id_users = ?');
            $req->execute(array($supprimer));
        }

    } else {
        echo $userinfo['grade'];
    }

    if(isset($_SESSION['auth']['id_users'])) {
        if(isset($_GET['id']) AND !empty($_GET['id'])) {

            ?> <a href="../../profile.php?id=<?= $m['id_users'] ?>"></a><?php
        }

    } else {
        echo $userinfo['grade'];
    }
  
$membre = $pdo->query('SELECT * FROM users');

?>

<!doctype html>
<html lang="fr">
    <head>
    <meta charset="utf-8">
    <title>Admin Zone</title>
    <link rel="stylesheet" href="style/index.css">
    <script src="script.js"></script>
    </head>

    <body>
        <ul>
            <?php while($m = $membre->fetch()) {
                ?>
                <li><?= $m['id_users'] ?> / <?= $m['pseudo'] ?> - 
                <a href="profil.php?id=<?= $m['id_users'] ?>">Profil</a> - 
                <a href="index.php?supprimer=<?= $m['id_users'] ?>">Bannir</a></li>
            <?php } ?>
        </ul>
    </body>
</html>