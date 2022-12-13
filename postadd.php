<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
$pdo = new PDO('mysql:host=localhost;dbname=minecraft_data', 'root', 'root');
include_once 'fonction/fonction.php';
include_once 'fonction/database.php';
logged_only();
?>

<?php
$postadd = $pdo->query("SELECT * FROM postuser");
$postadd->execute(array());

    if(isset($_POST['envoyer'])){
        if(!empty($_POST['titre']) && !empty($_POST['category']) && !empty($_POST['description'])){
            $titre = htmlspecialchars($_POST['titre']);
            $category = $_POST['category'];
            $description = nl2br(htmlspecialchars($_POST['description']));

            $avatar = $_SESSION['auth']['avatar'];
            $id_user = $_SESSION['auth']['id_users'];
            $author = $_SESSION['auth']['pseudo'];
            $codeyt = $_POST['youtubevdo'];
            $seed = $_POST['seed'];
            $tag = $_POST['tag'];

            if(!empty($_FILES['fileUpload'])){
                $dossier = "upload/" . $_SESSION['auth']['id_users'] . "/";
    
                if(!is_dir($dossier)) {
                    mkdir($dossier);
                }
    
                $dossier .= "postimg/";
    
                if(!is_dir($dossier)) {
                    mkdir($dossier);
                }
    
                $nameFile = $_FILES['fileUpload']['name'];
                $typeFile = $_FILES['fileUpload']['type'];
                $sizeFile = $_FILES['fileUpload']['size'];
                $tmpFile = $_FILES['fileUpload']['tmp_name'];
                $errFile = $_FILES['fileUpload']['error'];
    
                $extensions = ['png', 'jpg', 'jpeg', 'gif'];
                $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
    
                $extension = explode('.', $nameFile);
    
                $max_size = 5000000;
    
                if(in_array($typeFile, $type)){
                    
                    if(count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)){
                        if($sizeFile <= $max_size && $errFile == 0){
                            
                            if(move_uploaded_file($tmpFile, $dossier . $nameFile)){
                                $addpost = $pdo->prepare('INSERT INTO postuser(titre, category, contenu, avatar, id_user, author, codeyt, seed, tag, primaryimg) VALUES(?,?,?,?,?,?,?,?,?,?)');
                                $addpost->execute(array($titre, $category, $description, $avatar, $id_user, $author, $codeyt, $seed, $tag, $nameFile));
                                echo "Upload effectué";
                                header('Location: profile.php');
                            }else {
                                echo "oops";
                            }
                        }else{
                            echo "oops";
                        }
                    }else{
                        echo "oops 2";
                    }
                        
                    
                }else{
                    echo "Erreur type non autorisé";
                }
            } else{
                $addpost = $pdo->prepare('INSERT INTO postuser(titre, category, contenu, avatar, id_user, author, codeyt, seed, tag) VALUES(?,?,?,?,?,?,?,?,?)');
                $addpost->execute(array($titre, $category, $description, $avatar, $id_user, $author, $codeyt, $seed, $tag));
            }           
        }else{ 
            echo 'Veuillez remplir tout les champs';
        }
    } 

    

    
       
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style/postadd.css">
        <title>Map Content</title>
    </head>
    <body>
        
        <?php include_once('patron/header.php'); ?>

        <div class="post_add_body">
            <div class="post_add_container">
                <div class="warning_post_add">
                    <div class="warning_post_add_h"><h2>Rules: Do Not</h2></div>
                    <div class="container_rule_post_add">
                        <ul>
                            <li class="post_add_li">Post without in-game screenshots. An image is worth a 
                                thousand words.</li>
                            <li class="post_add_li">Post content that includes work by others unless it is 
                                content specifically provided for reuse and does not make up the majority 
                                of the content you are posting (ex: tree packs), or you provide proof of 
                                permission to use it.</li>
                            <li class="post_add_li">Post portions of larger builds already posted. Unless 
                                you were part of a team build and allowed to post the part of the build 
                                you created.</li>
                            <li class="post_add_li">Post servers in the projects section. You are free to 
                                post builds that you make on a server, but the focus must be on the build 
                                itself and not the server.</li>
                        </ul>
                    </div>
                </div>
                <div class="btn_img_postadd">
                    <button class="btn_post_img_hover">MAP CONTENT</button>
                    <button class="btn_post_img">ADD IMAGE GALLERY</button>
                </div>
                
                <form method="post" class="form_post" enctype="multipart/form-data">
                    <div class="prem_post_add">
                        <input class="input_post_add postadd_btn" type="text" name="titre" placeholder="Titre"></input>
                        <div class="postadd_input_cat">
                            Category<input class="input_postadd" type="text" name="category" placeholder="Category">
                        </div>
                        <input class="input postadd_btn" type="text" name="youtubevdo" placeholder="Optional Youtube Video Code">

                        <div class="prof_post_contenu_add">
                            <label for="description">Contenu</label>
                            <div class="cont_add_post_box">
                                <div class="top_add_post_div">
                                    <button class="tox_btn_post"></button>
                                    <button class="tox_btn_post"></button>
                                    <button class="tox_btn_post"></button>
                                    <button class="tox_btn_post"></button>
                                    <button class="tox_btn_post"></button>

                                    <button class="tox_btn_post"></button>
                                    <button class="tox_btn_post"></button>
                                    <button class="tox_btn_post"></button>
                                    <button class="tox_btn_post"></button>
                                </div>
                                <div class="bot_add_post_div">
                                    <input name="description" class="" type="text" placeholder="Text / description">
                                </div>
                                
                            </div>
                            <div class="postadd_option">
                                <input type="text" class="postadd_btn" name="seed" placeholder="World Seed">
                                <input style="margin-top:0;" type="text" class="postadd_btn" name="tag" placeholder="Type an Tag">
                            </div>
                            
                        </div>
                        <div class="btn_post_add">
                            <button class="btn_box_post">Save Brouillon</button>
                            <button class="btn_box_post" type="submit" name="envoyer"></button>
                        </div>
                    </div>
                    

                    <div class="postadd_img_div" style="display:none;">
                        <h3>Images (0)</h3>
                        <ul class="ul_postadd_img">
                            <li class="">Add up to 20 images.</li>
                            <li class="">The first image is the primary image. It will represent your submission in site listings.</li>
                            <li class="">To reorder, click & drag the thumbnail of the image into desired gallery location.</li>
                        </ul>
                        <div class="postadd_img_post_container">
                            <div class="img_prev_postadd">
                                <div class="box_input_postadd">
                                    <div class="img_postadd_input"></div>
                                    <input type="file" id="fileUpload" name="fileUpload">
                                </div>
                                <div id="uploadedImage"></div>
                            </div>
                                
                            <div class="container_upl_imgpostadd">
                                <div class="btn_hidden_input_postadd">+ IMAGES</div>
                                    
                                    

                            </div>
                            <div class="plus_add_imgpostadd"></div>
                        </div>
                    </div>
                </form>

                
            </div>

            <?php include_once('patron/footer.php'); ?>
        </div>
        
        
        <script src="javascript/postadd.js"></script>

    </body>
</html>