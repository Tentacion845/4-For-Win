<?php
session_start();

if (isset($_SESSION) && isset($_SESSION['user_id'])) {
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location:?action=connexion');
    }
    // var_dump("Islogged", $_SESSION);
    require('controllers/accueilController.php');
    exit;
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'inscription') {
        require('controllers/inscriptionController.php');
        exit;
    } elseif ($_GET['action'] == 'connexion') {
        require('controllers/connexionController.php');
        exit;
    }
} else {
    require('controllers/connexionController.php');
    exit;
}
