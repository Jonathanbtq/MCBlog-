<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
$pdo = new PDO('mysql:host=localhost;dbname=minecraft_data', 'root', 'root');
include_once 'fonction/fonction.php';
include_once 'fonction/database.php';
logged_only();

$id = htmlentities(trim($_GET['id']));

$postreq = $pdo->prepare("SELECT * FROM postuser WHERE id_post=?");
$postreq->execute(array($id));

$postinfo = $postreq->fetch();

?>

<!doctype html>
<html lang="fr">
    <head>
    <meta charset="utf-8">
    <title><?= $postinfo['titre']?> - <?= $postinfo['author'] ?></title>
    <link rel="stylesheet" href="style/postadd.css">
    </head>

    <?php include_once('fonction/database.php'); ?>
    <?php include_once('patron/header.php'); ?>
    <body>

    <?php 
    $name = $postinfo['author'];
    $postuser = $pdo->prepare("SELECT * FROM users WHERE pseudo=$name");

    $postuser = $postuser->fetch();
    ?>

    <div class="container_post_main post_add_body">
        <div class="container_post_width post_add_container">
            <div class="pic_post_div">
                <?php $cheminimg = 'upload/' . $postinfo['id_user'] . '/postimg/' . $postinfo['primaryimg']; ?>
                <div class="top_big_img_post" style="background: url(<?= $cheminimg ?>); background-size: cover;"></div>
                <div class="galery_post_div"></div>
            </div>
            <div class="text_post_div">
                <div class="top_post_div">
                    <i><?= $postinfo['category']; ?></i>
                    <h1><?= $postinfo['titre']; ?></h1>
                    <p><?= $postinfo['date']; ?></p>
                    <p><span class="spl_spn_post"><?= $postinfo['views']; ?></span> Views</p>
                    <div class="info_top_post_div">

                    </div>
                </div>
            </div>
            <!--ZONE TEXT (PROFIL/DESCRIPTION ECT--->
            <div class="btd_post_div">
                
                <div class="post_info_author">
                    <div class="img_session_post" style="background: url(<?= 'upload/' . $postinfo['id_user'] . '/' . $postinfo['avatar'] ?>) no-repeat; background-size: cover; width: 50px; height: 50px;"></div>
                    <div class="user_post_info">
                        <p><?= $postinfo['author']; ?></p>
                        Grade : <?= $postuser['grade']; ?>
                    </div>
                </div>

                <div class="post_info_descr">
                    <p><?= $postinfo['contenu']; ?></p>
                </div>

            </div>
            <div class="commentaire_bott_div">

            </div>
        </div>
    </div>

    </body>
</html>