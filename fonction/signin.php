<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
?>


<?php
if(!empty($_POST)) {

    $errors = array();
    require_once 'database.php';

    if(empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo'])) {
        $errors['pseudo'] = "Votre pseudo n'est pas valide (alphanumérique)";
    } else {
        $req = $pdo->prepare('SELECT id_users FROM users WHERE pseudo = ?');
        $req->execute([$_POST['pseudo']]);
        $user = $req->fetch();
        if($user){
            $errors['pseudo'] = 'Ce pseudo est deja pris';
        }
    }

    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Votre email n'est pas valide";
    }  else {
        $req = $pdo->prepare('SELECT id_users FROM users WHERE email = ?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        if($user){
            $errors['email'] = 'Ce email est deja utilisé par un autre compte';
        }
    }

    if(empty($_POST['password']) || $_POST['password'] != $_POST['cpassword']) {
        $errors['password'] = "Vous devez rentrer un mot de passe valide";
    }
    
    if(empty($errors)) {

    $grade = "Membre";
    
    $req = $pdo->prepare("INSERT INTO users SET pseudo = ?, password = ?, email = ?, grade = ?");
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $req->execute([$_POST['pseudo'], $password, $_POST['email'], $grade]);
    $_SESSION['auth'] = $user;
    die('Notre compte a bien été créé');
}

}

?>

