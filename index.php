<?php
session_start();

if (isset($_SESSION) && isset($_SESSION['user_id'])) {
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location:?action=connexion');
    }
    var_dump("Islogged", $_SESSION);
    require('accueilController.php');
    exit;
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'inscription') {
        require('inscriptionController.php');
        exit;
    } elseif ($_GET['action'] == 'connexion') {
        require('connexionController.php');
        exit;
    }
} else {
    require('connexionController.php');
    exit;
}
