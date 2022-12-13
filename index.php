<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 


    if(isset($_SESSION['auth']['id_users'])){
        if(isset($_GET['authorp']) AND !empty($_GET['authorp'])) {
            ?> <a href="voirprofile.php?authorp=<?= $article['author']; ?>"></a><?php
        }
    }

}
?>

<!doctype html>
<html lang="fr">
    <head>
    <meta charset="utf-8">
    <title>Mc'Partage - Accueil</title>
    <link rel="stylesheet" href="style/index.css">
    </head>

    <?php include_once('fonction/database.php'); ?>
    <?php include_once('patron/header.php'); ?>
    <body>

    <div id="container_main">
        <div class="container_index">
            <div class="contain_index">
                <div class="contain_titre_index">
                    <h1 class="contain_h">Articles posté</h1>
                </div>

                <div class="btn_crea_index">
                    <button class="btn_art">
                        <a href="fonction/articlecree.php">
                            Nouveau sujet
                        </a>
                    </button>
                </div>

                <div class="divers_h_index">
                    <h2 class="contain_h_divers">Article Géneral</h2>
                </div>

                <div class="article">
                    <?php
                        $recupArt = $pdo->query('SELECT * FROM articles WHERE tag="general" ORDER BY "date" DESC LIMIT 30');
                        while($article = $recupArt->fetch()) {
                            ?>
                                <div class="article_div">
                                    <div class="art_f_div">
                                        <h1><?= $article['titre']; ?></h1>
                                        <div class="info_art_index">
                                            <a href="voirprofile.php?authorp=<?= $article['author'] ?>">
                                                By <?= $article['author'] ?>
                                            </a>
                                            Date: <?= $article['date'] ?>
                                        </div>
                                        
                                        <p><?= $article['contenu'] ; ?></p>
                                        
                                    </div>
                                    <div class="art_d_div">
                                        <div class="btn_art_d_div">
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
                                        <div class="like_art_d_div">
                                            <?php
                                                $id_article_art = $article['id_article'] ;

                                                $likes = $pdo->prepare('SELECT id FROM likes WHERE id_article = ?');
                                                $likes->execute(array($id_article_art));
                                                $likes = $likes->rowCount();

                                                $dislikes = $pdo->prepare('SELECT id FROM dislikes WHERE id_article = ?');
                                                $dislikes->execute(array($id_article_art));
                                                $dislikes = $dislikes->rowCount();
                                            ?>
                                            <a href="fonction/likesys.php?t=1&id=<?= $article['id_article'] ?>" class="like_btn_index">
                                            </a> <?= $likes ?>
                                            <a href="fonction/likesys.php?t=2&id=<?= $article['id_article'] ?>" class="dislike_btn_index">
                                            </a><?= $dislikes ?>
                                        </div>

                                        
                                    </div>
                                    
                                </div>
                            <?php
                        }
                    ?>
                </div>

                <div class="article_divers">
                    <div class="divers_h_index">
                        <h2 class="contain_h_divers">Divers articles</h2>
                    </div>
                    <div class="article_box_index">

                        <?php
                            $recupArt = $pdo->query('SELECT * FROM articles WHERE tag="divers" ORDER BY "date" DESC LIMIT 30');
                            while($article = $recupArt->fetch()) {
                                ?>
                                <div class="article_div">
                                    <div class="art_f_div">
                                        <h1><?= $article['titre']; ?></h1>
                                        <a href="voirprofile.php?authorp=<?= $article['author'] ?>">
                                            By <?= $article['author'] ?>
                                        </a>
                                        <p><?= $article['contenu'] ; ?></p>
                                        
                                    </div>
                                    <div class="art_d_div">

                                        <div class="btn_art_d_div">
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
                                        <div class="like_art_d_div">
                                            <?php
                                                $id_article_art = $article['id_article'] ;
                                                
                                                $likes = $pdo->prepare('SELECT id FROM likes WHERE id_article = ?');
                                                $likes->execute(array($id_article_art));
                                                $likes = $likes->rowCount();

                                                $dislikes = $pdo->prepare('SELECT id FROM dislikes WHERE id_article = ?');
                                                $dislikes->execute(array($id_article_art));
                                                $dislikes = $dislikes->rowCount();
                                            ?>
                                            <a href="fonction/likesys.php?t=1&id=<?= $article['id_article'] ?>"class="like_btn_index">
                                                J'aime
                                            </a> <?= $likes ?>
                                            <a href="fonction/likesys.php?t=2&id=<?= $article['id_article'] ?>" class="dislike_btn_index">                                            
                                            </a> <?= $dislikes ?>
                                        </div>

                                        
                                    </div>
                                    
                                </div>
                            <?php
                        }                            
                        ?>

                    </div>
                </div>
            </div>
        
            <div class="section_container_div_index">
                <aside class="content_deux_aside">
                    <div class="asd_prem_div">
                        <div class="h_aside_index">
                            <h1>Informations</h1>
                        </div>

                        <div class="img_aside_head">

                        </div>
                        
                        <div class="asd_information">
                                
                            <div class="asd_information_bloc">
                                <h3>Mise à jour:</h3>
                                <p>1. Mise en place de la partie chatbox, avec canaux différents</p>
                                <p>2. développement d'une partie mise a jours Minecraft</p>
                            </div>

                        </div>
                    </div>
                </aside>

                <section class="aside_container_div">
                    <div class="aside_h_index">
                        <h1>Mise A jours</h1>
                    </div>
                    <div class="aside_index_art">
                        <div class="art_asd_index">
                            <h1>Minecraft 1.19 - Wild Update</h1>
                            <p>La mise à jour 1.19 de Minecraft sera la "Wild Update". Cette mise à jour de 
                                Minecraft se concentre sur l'ajout d'un nouveau biome, le "Deep Dark", qui 
                                ajoutera de nouvelles structures souterraines et une créature terrifiante : 
                                    le Warden. Le biome marais sera enrichi et il y aura même des mangroves 
                                    qui abriteront de nouvelles créatures telles que les têtards et les 
                                    grenouilles.</p>
                        </div>
                    </div>
                </section>
            </div>
            

            

        </div>
        

    </div>
        







        <?php include_once('patron/footer.php'); ?>
        <script src="javascript/script.js"></script>



    </body>
</html>