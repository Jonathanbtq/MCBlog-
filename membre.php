<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 

    include_once('fonction/database.php');

    $membre = $pdo->prepare('SELECT * FROM users');
    $membre->execute();

    $all_users = $pdo->query('SELECT * FROM users');
    if(isset($_GET['s']) AND !empty($_GET['s'])){
        $recherche = htmlspecialchars($_GET['s']);
        $all_users = $pdo->query('SELECT * FROM users WHERE pseudo LIKE "%'. $recherche. '%"');
    }

}
?>

<!doctype html>
<html lang="fr">
    <head>
    <meta charset="utf-8">
    <title>Admin Zone</title>
    <link rel="stylesheet" href="style/index.css">
    <script src="script.js"></script>
    </head>

    <?php include_once('patron/header.php'); ?>
    
    

    <div class="membre_box">
        <div id="main_membre_container">

            <body>
                <form method="GET">
                    <input class="inputmembre" type="text" value="" name="s" placeholder="Rechercher utilisateur" autocomplete="off"></input>
                    <input class="inputFind" type="submit" name="envoyer">
                </form>
            </body>

            <section class="afficher_utilisateur">
                    <?php
                        if($all_users->rowCount() > 0){
                            while($user = $all_users->fetch()){
                                ?>
                                <button>
                                    <a href="voirprofile.php?authorp=<?= $user['pseudo']; ?>">
                                        <div class="info_user">
                                            <div  class="connect_nav" style="background: url(<?= 'upload/' . $user['id_users'] . '/' . $user['avatar'] ?>) no-repeat; height: 60px; width: 60px; background-size: cover;"> </div>
                                            <p><?= $user['pseudo']; ?></p>
                                        </div>
                                    </a>
                                </button>
                                <?php
                            }
                            
                        }else{
                            ?>
                                <p>Aucun utilisateur trouvé</p>
                            <?php
                        }
                    ?>
            </section>
        </div>
    </div>
    

    
</html>