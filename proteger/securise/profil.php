<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
$pdo = new PDO('mysql:host=localhost;dbname=minecraft_data', 'root', 'root');

    if (!isset($_SESSION['auth']['id_users'])){
        header('Location: index.php'); 
        exit;
    }


    $id = (int) htmlentities(trim($_GET['id']));

    if(!is_int($id) || $id == 0){
        header('Location:index.php');
        exit;
    }

    $afficher_profil = $pdo->prepare("SELECT * FROM users WHERE id_users=?");
    $afficher_profil->execute(array($id));
    $afficher_profil = $afficher_profil->fetch();


    if(!isset($afficher_profil['id_users'])) {
        header('Location:index.php');
        exit;
    }

?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleprofile.css">
    <title>Profile Page</title>
</head>
<body>
    

    <div id="container_main">
        <div class="contain_profil">
            <div class="premiere_div">
                <div class="pics_zone_profile f_div">
                    <div class="parametre_img">

                        <div class="pdp_profil">
                            <?php
                                if($afficher_profil['avatar']) {
                            ?>

                            <div onClick="masquer_img()" class="img_session" style="background: url(<?= 'upload/' . $afficher_profil['id_users'] . '/' . $afficher_profil['avatar'] ?>) no-repeat; background-size: cover; width: 150px; height: 150px; border-radius: 100px; border: 1px grey solid;"> 
                            </div>

                            <?php
                            }
                            ?>
                        </div>

                        

                            <div class="info_user">
                                <div style="color:red; font-weight: bold;" class="un_info"><?= $afficher_profil['pseudo']?></div>
                                <div style="font-weight: bold;" class="deux_info"><?= $afficher_profil['email'] ?></div>
                                <!---<div style="font-weight: bold;" class="trois_info"><?= $afficher_profil['grade'] ?></div>--->
                            </div>
                        
                    </div>
                </div>

                <div class="profile_zone f_div">
                    <div style="height:100%;" class="info_profile">
                        <div class="name_profile_div">
                            <p>Biographie</p><br/>

                            

                            <div class="description_div">

                                <Form method="post">
                                <input type="button" class="btn_text_div" value="<?= $afficher_profil['biographie']; ?>">
                                
                                </form>

                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="deuxieme_div">
                <div class="hobbies_div">
                    <h3>Articles posté</h3><br/>
                    <div class="hobbie_case">
                        <?php 
                        $user_art = $afficher_profil['pseudo'];
                        ?>


                            <div class="article">
                                <?php
                                    $reqart = $pdo->query("SELECT * FROM articles WHERE author='$user_art'");

                                    while($article = $reqart->fetch()) {
                                        ?>
                                            <div class="article_div">
                                                <div class="art_f_div">
                                                    <h1><?= $article['titre']; ?></h1>
                                                    <p><?= $article['contenu'] ; ?></p>
                                                    <i>By <?= $article['author'] ?></i>
                                                </div>
                                                <div class="art_d_div">
                                                    <?php if($afficher_profil['pseudo'] === $article['author']){
                                                            ?>
                                                        <button class="btn_d_art">
                                                            <a href="modificationart.php?idArt=<?= $article['id_article'] ?>">
                                                                Modifier
                                                            </a>
                                                        </button>
                                                        <?php
                                                    }     
                
                                                        if($afficher_profil['pseudo'] === $article['author']){
                                                            ?>
                                                                    <form method="post">
                                                                        <button name="supprimer">
                                                                            Supprimer
                                                                        </button>
                                                                    </form>
                                                                
                                                            <?php  
                                                            if(isset($_POST['supprimer'])){
                                                                ?>
                                                                    
                                                                        <i>Etes-vous sûr de vouloir supprimer la publication ?</i>
                                                                        <form method="post">
                                                                            <button name="oui"><a href="fonction/supprimer.php?numArticle=<?= $article['id_article']; ?>">Oui</a></button> 
                                                                            <button name="non"><a href="index.php">Non</a></button>
                                                                        </form>
                                                                    
                                                                <?php
                                                            }
                                                        }
                                                        
                                                    ?>
                                                </div>
                                                
                                            </div>
                                        <?php
                                    }
                                ?>
                            </div>
                    </div>
                </div>

                <div class="divers_profile_zone d_div">
                    <div class="contact_div">
                        <?php 
                            $users_base = $pdo->prepare('SELECT * FROM users');
                            while($user = $users_base->fetch()) {
                                ?>
                                    <p><?= $user['pseudo']; ?></p>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="image_div_share">

                    </div>
                </div>
                
            </div>



        </div>

        
        
    </div>
    
    


    <script src="javascript/script.js"></script>
</body>
</html>