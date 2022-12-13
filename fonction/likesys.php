<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
$pdo = new PDO('mysql:host=localhost;dbname=minecraft_data', 'root', 'root');

    if(isset($_GET['t'], $_GET['id'], $_SESSION['auth']['id_users']) AND !empty($_GET['id']) AND !empty($_GET['t']) AND !empty($_SESSION['auth']['id_users'])){
        $getid = (int) $_GET['id'];
        $gett = (int) $_GET['t'];
        
        $sessionid = $_SESSION['auth']['id_users'];

        $check = $pdo->prepare('SELECT id_article FROM articles WHERE id_article=?');
        $check->execute(array($getid));

        if($check->rowCount() == 1){
            if($gett == 1){
                $check_like = $pdo->prepare('SELECT id FROM likes WHERE id_article = ? AND id_membre = ?');
                $check_like->execute(array($getid, $sessionid));

                $del = $pdo->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_membre = ?');
                $del->execute(array($getid, $sessionid));

                if($check_like->rowCount() == 1) {
                    $del = $pdo->prepare('DELETE FROM likes WHERE id_article = ? AND id_membre = ?');
                    $del->execute(array($getid, $sessionid));
                }else{
                    $ins = $pdo->prepare('INSERT INTO likes (id_article, id_membre) VALUES (?, ?)');
                    $ins->execute(array($getid, $sessionid));
                }
            }elseif($gett == 2){
                $check_like = $pdo->prepare('SELECT id FROM dislikes WHERE id_article = ? AND id_membre = ?');
                $check_like->execute(array($getid, $sessionid));

                $del = $pdo->prepare('DELETE FROM likes WHERE id_article = ? AND id_membre = ?');
                $del->execute(array($getid, $sessionid));

                if($check_like->rowCount() == 1) {
                    $del = $pdo->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_membre = ?');
                    $del->execute(array($getid, $sessionid));
                }else{
                    $ins = $pdo->prepare('INSERT INTO dislikes (id_article, id_membre) VALUES (?, ?)');
                    $ins->execute(array($getid, $sessionid));
                }
            }
            header('Location: ../index.php');
        }else{
        exit('Erreur fatale');
        }
    }
?>