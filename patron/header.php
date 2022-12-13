<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="../style/style.css">
    </head>
    <body>
                <div id="container_main">
                    <div class="container">                
                        <nav>
                                <div class="nav_width">

                                    <header>
                                        <h1>MC'partage</h1>
                                    </header>

                                    <div class="nav_connect">
                                        <div class="info_div">
                                            <div class="prenom_info">
                                                <?php echo $_SESSION['auth']['pseudo']; ?><br/>
                                            </div>

                                            <div class="btn_connection">
                                                
                                                <?php   $actualmsg = "Connection";
                                                        $newmsg = "Deconnexion";

                                                if(empty($_SESSION['auth'])) {  ?>
                                                    <a href="connect.php">
                                                        <button class="btn_connec" name="btn_connec" id="btn_connec">
                                                            <?php                                                                                                                
                                                                echo $actualmsg;
                                                                    
                                                                if(isset($_POST['btn_connec'])) {
                                                                    if(empty($_SESSION['auth']))
                                                                    {
                                                                        echo '<a href="connect.php"></a>';
                                                                    }
                                                                }
                                                            ?>
                                                        </button>
                                                    </a>


                                                <?php }elseif($newmsg){ ?>
                                                    <a href="fonction/logout.php">
                                                        <button class="btn_connec" name="btn_connec" id="btn_connec">
                                                            <?php
                                                                echo $newmsg;
                                                            ?>
                                                        </button>
                                                    </a>
                                                <?php } ?>
                                                
                                            </div>
                                        </div>
                                        

                                        <div class="img_header">
                                            <a href="profile.php">
                                                    <div  class="connect_nav" style="background: url(<?= 'upload/' . $_SESSION['auth']['id_users'] . '/' . $_SESSION['auth']['avatar'] ?>) no-repeat; height: 60px; width: 60px; background-size: cover;"> </div>
                                            </a>
                                        </div>
                                        
                                        <div class="derou_container_header">
                                            <i class="fa-solid fa-angle-down derou_header">
                                                <ul class="derou_div_header">
                                                    <li class="btn_profil btn_derou_header">
                                                        <a href="profile.php" class="btn_derou_header">
                                                            Profil
                                                        </a>
                                                    </li>
                                                    <li class="btn_disconnect btn_derou_header">
                                                        <a href="fonction/logout.php" class="btn_derou_header">
                                                            Se Deconnecter
                                                        </a>
                                                    </li>
                                                </ul>
                                            </i>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                
                        </nav>
                    </div>
                    
                    <div class="nav_btn">
                        <a href="index.php">
                            <button class="btn_nav acceuil">
                                ACCEUIL
                            </button>
                        </a>

                        <a href="chatbox.php">
                            <button class="btn_nav connect">
                                CHATBOX
                            </button>
                        </a>

                        <a href="membre.php">
                            <button class="btn_nav membre">
                                MEMBRE
                            </button>
                        </a>    

                        <a href="profile.php">
                            <button class="btn_nav profil">
                                PROFIL
                            </button>
                        </a>
                    </div>
                </div>

                <script src="javascript/header.js"></script>
                <script src="https://kit.fontawesome.com/d02ac30c3f.js" crossorigin="anonymous"></script>
    </body>
</html>
            