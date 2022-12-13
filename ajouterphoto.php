<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

$pdo = new PDO('mysql:host=localhost;dbname=minecraft_data', 'root', 'root');


if(!empty($_POST)){
    extract($_POST);
    $valid = (boolean) true;

    if(isset($_POST['envoyer'])) {
        $dossier = "upload/" . $_SESSION['auth']['id_users'] . "/";

        if(!is_dir($dossier)) {
            mkdir($dossier);
        }

        $dossier .= "album/";

        if(!is_dir($dossier)) {
            mkdir($dossier);
        }
        

        $PoidsMaxImage = 5242880; // poids maximum de 5 Mo

        if($_FILES['album']['size'] <= $PoidsMaxImage) {
            $ListeExtension = array('jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');
            $ListeExtensionIE = array('jpg' => 'image/');

            $ExtensionsValides = array('jpg', 'jpeg', 'png'); // format ok

            $fichier = basename($_FILES['album']['name']);
            $fichier_extension = strtolower(substr(strrchr($fichier, '.'), 1));

            if(in_array($fichier_extension, $ExtensionsValides)) {
                $fichier = md5(uniqid(rand(), true)) . '.' . $fichier_extension;

                if(move_uploaded_file($_FILES['album']['tmp_name'], $dossier . $fichier)) {

                    if(file_exists($dossier . $_SESSION['album']) && isset($_SESSION['album'])) {
                        unlink($dossier . $_SESSION['album']);
                    }

                    $verif_ext = getimagesize($dossier .$fichier);

                    if($verif_ext['mime'] == $ListeExtension[$fichier_extension]  ||  $verif_ext['mime'] == $ListeExtensionIE[$fichier_extension]) {
                        $filename = $dossier . $fichier;

                        if(in_array($fichier_extension, array('jpg', 'jpeg', 'pjpg', 'pjpeg'))) {
                            $image = imagecreatefromjpeg($filename);
                        }

                        if(in_array($fichier_extension, array('png'))) {
                            $image = imagecreatefrompng($filename);
                        }

                        $width = 720;
                        $height = 720;

                        list($width_orig, $height_orig) = getimagesize($filename);

                        $whFact = $width / $height;
                        $imgWhFact = $width_orig / $height_orig;

                        if($whFact <= $imgWhFact) {
                            $width = $width;
                            $height = $width / $imgWhFact;
                        }else{
                            $height = $height;
                            $width = $height / $imgWhFact;
                        }

                        $image_p = imagecreatetruecolor($width, $height);
                        imagealphablending($image_p, false);
                        imagesavealpha($image_p, true);

                        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                        imagedestroy($image);

                        if(in_array($fichier_extension, array('jpg', 'jpeg', 'pjpg', 'pjpeg'))) {
                            header('Content-Type: image/jpeg');
                            $exif = exif_read_data($filename);

                            if(!empty($exif['Orientation'])){
                                switch($exif['Orientation']){
                                    case 8:
                                        $image_p = imagerotate($image_p, 90, 0);
                                    break;
                                    case 3:
                                        $image_p = imagerotate($image_p, 180, 0);
                                    break;
                                    case 6:
                                        $image_p = imagerotate($image_p, -90, 0);
                                    break;

                                }
                            }
                            
                            imagejpeg($image_p, $filename, 75);
                            imagedestroy($image_p);

                            
                        }
                        if(in_array($fichier_extension, array('png'))){
                            header('Content-Type: image/png');

                            imagepng($image_p, $filename, 8);
                            imagedestroy($image_p);
                        }

                        $req = $pdo->prepare("INSERT INTO album (id_utilisateur, nom, date) VALUES (?, ?, ?)");

                        $req->execute(array($_SESSION['auth']['id_users'], $fichier, date('Y-m-d H:i:s')));

                        header('Location: profile.php');
                        exit;

                    }else{

                        header('Location: profile.php');
                        exit;

                    }
                } else {
                    unlink("upload/" . $_SESSION['id_users'] . '/' . $dossier . $fichier);
                    echo 'Impossible de déplacer le fichier';
                    header('location: ajouterphoto.php');
                    exit;
                }
            }

        }else{
            echo 'nope';
        }




        
        
    }
}

?>

<!doctype html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="style/index.css">
    <script src="script.js"></script>
    </head>

    <?php include_once('fonction/database.php'); ?>
    <?php include_once('patron/header.php'); ?>
    <body>

        <div id="container_main">
            <div class="container_idex">

            <div class="btn_pdp">
                                                                   
                <form method="post" enctype="multipart/form-data">
                    Ficher : <input type="file" name="album">
                        <input type="submit" name="envoyer" value="Envoyer le fichier">
                </form>

            </div>                                       
                                                                                                   
            </div>
        </div>
    
    </body>
</html>