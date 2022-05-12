<?php
session_start();

if (isset($_SESSION) && isset($_SESSION['user_id'])) {
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location:?page=connexion');
    }
    require('controllers/accueilController.php');
    exit;
}

if (isset($_GET['page'])) {
    if ($_GET['page'] == 'inscription') {
        require('controllers/inscriptionController.php');
        exit;
    } elseif ($_GET['page'] == 'connexion') {
        require('controllers/connexionController.php');
        exit;
    }
} else {
    require('controllers/connexionController.php');
    exit;
}
