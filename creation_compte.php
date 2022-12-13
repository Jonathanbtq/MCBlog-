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
    <?php include_once('fonction/fonction.php'); ?>
    <body>


        <div id="container_main">
            <div class="contain">

                <div class="creation_compte">
                    <h1>Création de compte :</h1>

                

                    <?php if (!empty($errors)): ?>
                        <div class="alert">
                            <p>Vous n'avez pas rempli le formulaire correctement</p>
                            <ul>
                                <?php foreach($errors as $error): ?>
                                    <li><?= $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="post">

                        <div class="mb-3">
                            <label for="email" class="form_label"></label>
                            <input type="email" class="form_control" id="email" name="email" placeholder="Email" aria-describedby="email-help"></input>
                        </div>
                        <div class="mb-3">
                            <label for="message"></label>
                            <input placeholder="Pseudo" name="pseudo"></input>
                        </div>
                        <div class="mb-3">
                            <label for="message"></label>
                            <input type="password" placeholder="Password" name="password"></input>
                        </div>
                        <div class="mb-3">
                            <label for="message"></label>
                            <input type="password" placeholder="Confirm Password" name="cpassword"></input>
                        </div>

                        <input type="submit" name="formsend" id="formsend" value="Création" class="btn_submit">
                        
                    </form>

                    <?php include 'fonction/signin.php'; ?>
                </div>
            
            </div>
        </div>

    </body>