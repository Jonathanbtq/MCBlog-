<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

$pdo = new PDO('mysql:host=localhost;dbname=minecraft_data', 'root', 'root');

if(isset($_POST['valider'])) {
    if(!empty($_POST['message'])) {
        $message = nl2br(htmlspecialchars($_POST['message']));
        $pseudo = $_SESSION['auth']['pseudo'];
        $avatar = $_SESSION['auth']['avatar'] ;
        $id_user = $_SESSION['auth']['id_users'];
        $tag = 'general';


        $inserermessage = $pdo->prepare('INSERT INTO chatbox(message, pseudo, avatar, id_user, tag_chat) VALUES(?, ?, ?, ?, ?)');
        $inserermessage->execute(array($message, $pseudo, $avatar, $id_user, $tag));
    }else{
        echo 'Veuillez remplir tout les champs';
    }
}

if(isset($_POST['validerSur'])) {
    if(!empty($_POST['message'])) {
        $message = nl2br(htmlspecialchars($_POST['message']));
        $pseudo = $_SESSION['auth']['pseudo'];
        $avatar = $_SESSION['auth']['avatar'] ;
        $id_user = $_SESSION['auth']['id_users'];
        $tag = 'survie';


        $inserermessage = $pdo->prepare('INSERT INTO chatbox(message, pseudo, avatar, id_user, tag_chat) VALUES(?, ?, ?, ?, ?)');
        $inserermessage->execute(array($message, $pseudo, $avatar, $id_user, $tag));
    }else{
        echo 'Veuillez remplir tout les champs';
    }
}

if(isset($_POST['validerCrea'])) {
    if(!empty($_POST['message'])) {
        $message = nl2br(htmlspecialchars($_POST['message']));
        $pseudo = $_SESSION['auth']['pseudo'];
        $avatar = $_SESSION['auth']['avatar'] ;
        $id_user = $_SESSION['auth']['id_users'];
        $tag = 'creatif';


        $inserermessage = $pdo->prepare('INSERT INTO chatbox(message, pseudo, avatar, id_user, tag_chat) VALUES(?, ?, ?, ?, ?)');
        $inserermessage->execute(array($message, $pseudo, $avatar, $id_user,  $tag));
    }else{
        echo 'Veuillez remplir tout les champs';
    }
}

if(isset($_POST['validerMods'])) {
    if(!empty($_POST['message'])) {
        $message = nl2br(htmlspecialchars($_POST['message']));
        $pseudo = $_SESSION['auth']['pseudo'];
        $avatar = $_SESSION['auth']['avatar'] ;
        $id_user = $_SESSION['auth']['id_users'];
        $tag = 'mods';


        $inserermessage = $pdo->prepare('INSERT INTO chatbox(message, pseudo, avatar, id_user, tag_chat) VALUES(?, ?, ?, ?, ?)');
        $inserermessage->execute(array($message, $pseudo, $avatar, $id_user, $tag));
    }else{
        echo 'Veuillez remplir tout les champs';
    }
}
?>

<!doctype html>
<html lang="fr">
    <head>
    <meta charset="utf-8">
    <title>ChatBox</title>
    <link rel="stylesheet" href="style/chatbox.css">
    </head>

    <?php include_once('fonction/database.php'); ?>
    <?php include_once('patron/header.php'); ?>
    <body>

        <div id="container_main">
            <h1>Canaux de discussion</h1>
            <div class="container_wdt_chat">
                <div class="container_chat_categorie">
                    <div class="ul_categorie">
                        <div class="li_chat general_chat" onClick="chat_onglet()">
                            Général
                        </div>
                        <div class="li_chat survie_chat" onClick="chat_survie_onglet()">
                            Survie
                        </div>
                        <div class="li_chat creatif_chat" onClick="chat_creatif_onglet()">
                            Créatif
                        </div>
                        <div class="li_chat mods_chat" onClick="chat_mods_onglet()">
                            Mods
                        </div>
                    </div>
                </div>

                <div class="chat_container_main">
                    <div class="container_index_chat">

                        <div class="message_box_general">
                            <?php
                            
                                $recupMessages = $pdo->query('SELECT * FROM chatbox WHERE tag_chat="general"');
                                while($message = $recupMessages->fetch()) {
                                    ?>
                                        <div class="message">
                                            <div class="img_pdp" style="background: url(<?= 'upload/' . $message['id_user'] . '/' . $message['avatar']?>) no-repeat; background-size: cover; width: 50px; height: 50px; border-radius: 100px; border: 1px grey solid;">
                                            </div>
                                            <div class="msg">
                                                <b><?= $message['pseudo']; ?></b>
                                                <p><?= $message['message']; ?></p>
                                            </div>
                                            
                                        </div>
                                    <?php
                                }

                            ?>
                        </div>
                        <div class="form_div">
                            <form method="post">
                                <textarea name="message"></textarea>
                                <br>
                                <input type="submit" name="valider">
                            </form>
                        </div>

                    </div>
                </div>



                <div class="chat_container_main_surv">
                    <div class="container_survie_chat">

                        <div class="message_box_general">
                            <?php
                            
                                $recupMessages = $pdo->query('SELECT * FROM chatbox WHERE tag_chat="survie"');
                                while($message = $recupMessages->fetch()) {
                                    ?>
                                        <div class="message">
                                            <div class="img_pdp" style="background: url(<?= 'upload/' . $message['id_user'] . '/' . $message['avatar']?>) no-repeat; background-size: cover; width: 50px; height: 50px; border-radius: 100px; border: 1px grey solid;">
                                            </div>
                                            <div class="msg">
                                                <b><?= $message['pseudo']; ?></b>
                                                <p><?= $message['message']; ?></p>
                                            </div>
                                            
                                        </div>
                                    <?php
                                }

                            ?>
                        </div>
                        <div class="form_div">
                            <form method="post">
                                <textarea name="message"></textarea>
                                <br>
                                <input type="submit" name="validerSur">
                            </form>
                        </div>

                    </div>
                </div>



                <div class="chat_container_main_crea">
                    <div class="container_creatif_chat">

                        <div class="message_box_general">
                            <?php
                            
                                $recupMessages = $pdo->query('SELECT * FROM chatbox WHERE tag_chat="creatif"');
                                while($message = $recupMessages->fetch()) {
                                    ?>
                                        <div class="message">
                                            <div class="img_pdp" style="background: url(<?= 'upload/' . $message['id_user'] . '/' . $message['avatar']?>) no-repeat; background-size: cover; width: 50px; height: 50px; border-radius: 100px; border: 1px grey solid;">
                                            </div>
                                            <div class="msg">
                                                <b><?= $message['pseudo']; ?></b>
                                                <p><?= $message['message']; ?></p>
                                            </div>
                                            
                                        </div>
                                    <?php
                                }

                            ?>
                        </div>
                        <div class="form_div">
                            <form method="post">
                                <textarea name="message"></textarea>
                                <br>
                                <input type="submit" name="validerCrea">
                            </form>
                        </div>

                    </div>
                </div>



                <div class="chat_container_main_mods">
                    <div class="container_mods_chat">

                        <div class="message_box_general">
                            <?php
                            
                                $recupMessages = $pdo->query('SELECT * FROM chatbox WHERE tag_chat="mods"');
                                while($message = $recupMessages->fetch()) {
                                    ?>
                                        <div class="message">
                                            <div class="img_pdp" style="background: url(<?= 'upload/' . $message['id_user'] . '/' . $message['avatar']?>) no-repeat; background-size: cover; width: 50px; height: 50px; border-radius: 100px; border: 1px grey solid;">
                                            </div>
                                            <div class="msg">
                                                <b><?= $message['pseudo']; ?></b>
                                                <p><?= $message['message']; ?></p>
                                            </div>
                                            
                                        </div>
                                    <?php
                                }

                            ?>
                        </div>
                        <div class="form_div">
                            <form method="post">
                                <textarea placeholder="Message" name="message"></textarea>
                                <br>
                                <input type="submit" name="validerMods">
                            </form>
                        </div>

                    </div>
                </div>
            

            </div>
            
        </div>

        <script src="javascript/chatbox.js"></script>

    </body>
</html>