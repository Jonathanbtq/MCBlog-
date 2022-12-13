<?php 
    session_start(); 
    global $pdo;
?>

<!doctype html>
<html lang="fr">
    <head>
    <meta charset="utf-8">
    <title>Connect</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    </head>

    <?php include_once('patron/header.php'); ?>
    <body>


    <div id="container_main">
        <div class="contain">

            <div class="ifm_cmpt">
                <?php
                    if(isset($_SESSION['pseudo']) && (isset($_SESSION['email'])))
                    {
                        ?>
                            <i>Pseudo : <?= $_SESSION['pseudo']; ?></i><br/>
                            <i>email : <?= $_SESSION['email']; ?></i>
                        <?php
                    } else {
                        echo "Veuillez vous connectez à votre compte";
                    }
                    ?>
            </div>

            
       
                
            
            <div class="login">
                
                <?php 
                    if(!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['lpassword'])) {
                        include_once('fonction/fonction.php');
                        include_once('fonction/database.php');

                        $req = $pdo->prepare('SELECT * FROM users WHERE pseudo = :pseudo OR email = :pseudo');
                        $req->execute(['pseudo' => $_POST['pseudo']]);
                        $user = $req->fetch();
                        if(password_verify($_POST['lpassword'], $user['password'])){
                            $_SESSION['auth'] = $user;
                            echo 'Vous etes maintenant connecté';
                            header('location: profile.php');
                            exit();
                        } else {
                            echo 'Identifiant ou mot de passe incorrecte';
                        }
                    }
                ?>        

                <h1>Connection :</h1>
                    
                <form method="post">
                    <div class="mb-3">
                        <label for="">Pseudo ou email</label>
                        <input type="text" name="pseudo" placeholder="Email or Pseudo"></input>
                    </div>
                    <div class="mb-3">
                        <label for="message">Mot De Passe</label>
                        <input type="password" name="lpassword" placeholder="Password"></input>
                    </div>

                    <input type="submit" name="formlogin" id="formlogin" value="Connexion" class="btn_submit">  
                </form>
                
                

            </div>

            <div class="creation_div">
                <a href="creation_compte.php">
                    <input type="submit"  value="Créer vous un compte !">
                </a>
            </div>
                
                
        </div>
    </div>

    </body>
</html>