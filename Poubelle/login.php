<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
?>



<?php 
    if(!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['lpassword'])) {
                        require_once 'fonction/fonction.php';
                        include_once 'fonction/database.php';
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

