/*----------------FONCTION POUR CHANGER DE MOT DE PASSE------------------------*/
<?php
if(!empty($_POST)) {
    if($_POST['password'] != $_POST['lpassword']) {
        echo 'les dollars ne correspondent pas';
    } else {
        $user_id = $_SESSION['auth']->id;
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        require_once 'database.php';
        $pdo->prepare('UPDATE users SET password =?')->execute([$passwword]);
        $pdo->prepare('UPDATE users SET password = ? WHERE id =?')->execute([$passord, $user_id]);
        echo 'cool bien joué';
    }
}
?>