<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
$pdo = new PDO('mysql:host=localhost;dbname=minecraft_data', 'root', 'root');
include_once 'fonction/fonction.php';
include_once 'fonction/database.php';
logged_only();

    //$req = $pdo->prepare("SELECT * FROM users WHERE id_users= ?");
    //$req->execute(array($_SESSION['auth']['id_users']));
    //$voir_utilisateur = $req->fetch();

    // ALBUM
    $utilisateur_id = (int) $_SESSION['auth']['id_users'];

    $req = $pdo->prepare('SELECT * FROM album WHERE id_utilisateur=?');
    $req->execute(array($utilisateur_id));
    $voir_album = $req->fetchAll();

    // FIN ALBUM

    if(isset($_POST['envoyer'])) {
        $dossier = 'upload/' . $_SESSION['auth']['id_users'] . "/";
        $id = $_SESSION['auth']['id_users'];

        if(!is_dir($dossier)) {
            mkdir($dossier);
        }

        $fichier = basename($_FILES['avatar']['name']);
        if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) {

            if(file_exists("upload/" . $_SESSION['auth']['id_users'] . '/' . $_SESSION['auth']['avatar']) && isset($_SESSION['auth']['avatar'])) {
                unlink("upload/" . $_SESSION['auth']['id_users'] . '/' . $_SESSION['auth']['avatar']);
            }

            $_SESSION['avatar'] = $fichier;
            $reqavatar = $pdo->query("UPDATE users set avatar ='$fichier' WHERE id_users ='$id'");
            $reqavatar->execute(array($fichier, $_SESSION['auth']['id_users']));

            exit;
        } else {
            echo 'Erreur';
            exit;
        }
    }
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/styleprofile.css">
    <title>Profile Page</title>
</head>
<body>
    
<?php include_once('patron/header.php'); ?>

    <div id="container_main">
        <div class="contain_profil">
            <div class="premiere_div">
                <div class="pics_zone_profile f_div">
                    <div class="parametre_img">

                        <div class="pdp_profil">
                            <?php
                                if($_SESSION['auth']['avatar']) {
                            ?>

                            <div onClick="masquer_img()" class="img_session" style="background: url(<?= 'upload/' . $_SESSION['auth']['id_users'] . '/' . $_SESSION['auth']['avatar'] ?>) no-repeat; background-size: cover; width: 150px; height: 150px; border-radius: 100px; border: 1px grey solid;"> 
                            </div>

                            <?php
                            }else{
                                ?><div onClick="masquer_img()"  class="avatar_null_profile img_session" style="width: 150px; height: 150px; border-radius: 100px; border: 1px grey solid;"></div><?php
                            }
                            ?>
                        </div>

                        

                            <div class="info_user">
                                <div style="color:red; font-weight: bold;" class="un_info"><?= $_SESSION['auth']['pseudo']?></div>
                                <!---<div style="font-weight: bold;" class="trois_info"><?= $_SESSION['auth']['grade'] ?></div>--->
                            </div>

                            <div class="btn_pdp">
                                                                   
                                <form class="btn_form" method="post" enctype="multipart/form-data">
                                    Change : <input type="file" name="avatar">
                                    <input type="submit" name="envoyer" value="Envoyer le fichier">
                                </form>
                            </div>
                        
                    </div>
                </div>

                <div class="profile_zone f_div">
                    <div style="height:100%;" class="info_profile">
                        <div class="name_profile_div">
                            <p>Description</p><br/>

                            

                            <div class="description_div">
                                <div class="desc_div_profil"  onClick="masquer_div()"><?= $_SESSION['auth']['biographie']; ?></div>

                                <Form method="post">

                                    <input type="hidden" name="numContact" value="<?= $_SESSION['auth']['id_users']; ?>">    

                                    <input name="biographie" type="text" class="text_div" style="display:none;" value="<?php if(!empty($_SESSION['auth']['biographie'])){echo $_SESSION['auth']['biographie'];}; ?>">
                                
                                    <Input type="submit" name="modifier" class="btn_text" style="display:none;">
                                
                                <?php include_once('profile/biographie.php'); ?>
                                
                                </form>

                                
                            </div>
                            

                            <!------SCRIPT AJOUT DE BIOGRAPHIE--------->
                            
                            

                        </div>
                    </div>
                </div>
            </div>

            <div class="prem_b_profil_container">
                <div class="h_prem_div">
                    <h2>Content Gallery</h2>
                </div>
                <div class="add_post_profil">
                    <a href="postadd.php">
                        Post +
                    </a>
                    
                </div>
                    <div class="post_profil">
                            <?php
                                $user_post = $_SESSION['auth']['pseudo'];
                                $user_id = $_SESSION['auth']['id_users'];
                                $reqpost = $pdo->query("SELECT * FROM postuser WHERE author='$user_post'");

                                while($postuser = $reqpost->fetch()) {
                                    ?>
                                        <div class="post_div_prof">
                                            <?php $cheminimg = 'upload/' . $postuser['id_user']  . '/postimg/' . $postuser['primaryimg'];?>
                                            <div class="img_prof_post" style="background: url(<?= $cheminimg ?>);  background-size: cover;"></div>
                                            
                                            <div class="art_prof_div">
                                                <a href="post.php?id=<?= $postuser['id_post']; ?>" class="art_prof_h">
                                                    <p class="art_prof_h"><?= $postuser['titre']; ?></p>
                                                </a>
                                                <p class="art_prof_desc"><?= $postuser['category']; ?></p>
                                                
                                                <div class="divers_art_prof">                             
                                                    <a href="voirprofile.php?authorp=<?= $postuser['author'] ?>">
                                                        <p class="p_art_prof"><?= $postuser['author']; ?></p>
                                                    </a>
                                                    <p style="background: url(<?= 'upload/' . $postuser['id_user'] . '/' . $postuser['avatar']?>) no-repeat; background-size: cover; width: 15px; height: 15px; border-radius: 100px; border: none;"></p>
                                                    <i><?= $postuser['date']; ?></i>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                    </div>
            </div>

            <div class="deuxieme_div">
                <div class="hobbies_div">
                    <h3>Articles posté</h3><br/>
                    <div class="hobbie_case">
                        <?php 
                        $user_art = $_SESSION['auth']['pseudo'];
                        ?>


                            <div class="article">
                                <?php
                                    $reqart = $pdo->query("SELECT * FROM articles WHERE author='$user_art'");

                                    while($article = $reqart->fetch()) {
                                        ?>
                                            <div class="article_div">
                                                <div class="art_f_div">
                                                    <h1><?= $article['titre']; ?></h1>
                                                    <p><?= $article['contenu']; ?></p>
                                                </div>
                                                <div class="art_d_div">
                                                    <?php if($_SESSION['auth']['pseudo'] === $article['author']){
                                                            ?>
                                                        <button class="btn_d_art">
                                                            <a href="modificationart.php?idArt=<?= $article['id_article'] ?>">
                                                                Modifier
                                                            </a>
                                                        </button>
                                                        <?php
                                                    }     
                
                                                        if($_SESSION['auth']['pseudo'] === $article['author']){
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

                    <!-----------PHOTO_ZONE----------------->

                <div class="share_img_div">
                    <h3>Galerie</h3>
                    <div class="galerie_img">
                        <a href="ajouterphoto.php">+</a>
                    </div>
                    
                    <div class="galerie">
                    
                            
                            <?php
                            foreach($voir_album as $va){

                                if(file_exists(__DIR__ . '/upload/' . $_SESSION['auth']['id_users'] . '/album/' . $va['nom'])){
                                    $chemin_avatar = 'upload/' . $_SESSION['auth']['id_users'] . '/album/' . $va['nom'];
                                }else{
                                    $chemin_avatar = '/upload/defaut/defaut.jpg';
                                }
                                
                                
                                ?>
                                    <div class="img_session_galerie">
                                        <div class="img_background" style="background: url(<?= $chemin_avatar ?>) no-repeat; background-size: cover; width: 120px; height: 120px;"></div>
                                    </div>
                                <?php
                            }

                            ?>
                    </div>
                </div>

            </div>

            

        </div>

            <?php include_once('patron/footer.php'); ?>
        
    </div>


    
    


    <script src="javascript/script.js"></script>
</body>
</html>