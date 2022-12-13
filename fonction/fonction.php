<?php

function debug($variable) {
    echo '<pre>' .print_r($variable, true) . '</pre>';
}

function logged_only(){
    if(!isset($_SESSION['auth'])) {
    echo "Vous n'avez pas le droit d'acceder a cette page";
    header('Location: connect.php');
    exit();
    }
}

?>

