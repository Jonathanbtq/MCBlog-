<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
$pdo = new PDO('mysql:host=localhost;dbname=minecraft_data', 'root', 'root');

                if(isset($_POST['modifier'])) {
                    $id = $_SESSION['auth']['id_users'];
                    $biographie = $_POST['biographie'];

                    $user = "SELECT * FROM users WHERE id_users = ?";
                    $biographie = $_POST['biographie'];
                    if(!empty($user)) {
                        $reqHobb = $pdo->query("UPDATE users set biographie = '$biographie' WHERE id_users ='$id'");
                        $reqHobb->execute(array($biographie));
                        $user = $reqHobb->fetch(); 
                        die('Biographie enregistré');
                        header('Location: profile.php');
                    } else {
                        echo 'Hehe';
                    }
                    
                } else {
                    
                }               
        ?>